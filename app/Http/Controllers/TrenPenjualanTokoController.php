<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusTokoModel;
use App\Models\SalesModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class TrenPenjualanTokoController extends Controller
{
    public function prosesStatusToko($yearAwal, $yearAkhir)
{
    $userId   = Auth::user()->user_id;
    $branches = Branch::where('user_id', $userId)->get();

    StatusTokoModel::where('user_id', $userId)
        ->where('year_awal', $yearAwal)
        ->where('year_akhir', $yearAkhir)
        ->delete();

    $hasil = [];

    foreach ($branches as $branch) {

        $salesAwal = SalesModel::where('branch_id', $branch->branch_id)
            ->whereYear('invoice_date', $yearAwal)
            ->sum('total_sales');

        $salesAkhir = SalesModel::where('branch_id', $branch->branch_id)
            ->whereYear('invoice_date', $yearAkhir)
            ->sum('total_sales');

        if ($salesAkhir == 0) continue;

        // ==========================================
        // MESIN INFERENSI FORWARD CHAINING
        // ==========================================
        $growth = null;
        $status = null;

        // R1: Toko Baru — tidak ada data tahun sebelumnya
        if ($salesAwal == 0 && $salesAkhir > 0) {
            $growth = null;
            $status = 'Toko Baru';
        }
        // R2: Berkembang Pesat — growth >= 20%
        elseif (is_null($status)) {
            $growth = (($salesAkhir - $salesAwal) / $salesAwal) * 100;
            if ($growth >= 20) {
                $status = 'Berkembang Pesat';
            }
        }

        // R3: Tumbuh — growth 5% s/d < 20%
        if (is_null($status) && !is_null($growth)) {
            if ($growth >= 5) {
                $status = 'Tumbuh';
            }
        }

        // R4: Stagnan — growth -5% s/d < 5%
        if (is_null($status) && !is_null($growth)) {
            if ($growth >= -5) {
                $status = 'Stagnan';
            }
        }

        // R5: Menurun — growth -20% s/d < -5%
        if (is_null($status) && !is_null($growth)) {
            if ($growth >= -20) {
                $status = 'Menurun';
            }
        }

        // R6: Kritis — growth < -20% (default jika tidak ada rule yang cocok)
        if (is_null($status)) {
            $status = 'Kritis';
        }
        // ==========================================

        StatusTokoModel::create([
            'user_id'        => $userId,
            'shopping_mall'  => $branch->name,
            'year_awal'      => $yearAwal,
            'year_akhir'     => $yearAkhir,
            'sales_awal'     => $salesAwal,
            'sales_akhir'    => $salesAkhir,
            'growth_percent' => $growth ?? 0,
            'status_toko'    => $status,
        ]);

        $hasil[] = [
            'branch'      => $branch->name,
            'sales_awal'  => $salesAwal,
            'sales_akhir' => $salesAkhir,
            'growth'      => $growth,
            'status'      => $status,
        ];
    }

    return response()->json([
        'message'     => 'Forward Chaining berhasil',
        'periode'     => "$yearAwal - $yearAkhir",
        'jumlah_toko' => count($hasil),
        'data'        => $hasil,
    ]);
}

    public function trenPenjualanToko(Request $request)
    {
        $userId    = Auth::user()->user_id;
        $branchIds = Branch::where('user_id', $userId)->pluck('branch_id');

        // Jika owner belum punya cabang atau belum ada data → empty state
        $adaData = SalesModel::whereIn('branch_id', $branchIds)->exists();

        if (!$adaData) {
            return view('owner.tren-penjualan-toko', [
                'tahun'               => date('Y'),
                'toko'                => 'all',
                'tahunList'           => collect(),
                'tokoList'            => collect(),
                'statusCabang'        => collect(),
                'chartLabels'         => ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                'chartDatasets'       => [],
                'jumlahNaik'          => 0,
                'jumlahTurun'         => 0,
                'jumlahStagnan'       => 0,
                'pertumbuhanTertinggi'=> null,
                'penurunanTerbesar'   => null,
                'dataForwardTersedia' => false,
                'isEmpty'             => true,
            ]);
        }

        // Dropdown tahun — dari data transaksi
        $tahunList = SalesModel::whereIn('branch_id', $branchIds)
            ->selectRaw('YEAR(invoice_date) as tahun')
            ->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        // Dropdown toko — dari tabel branches (nama yang diinput owner)
        // key = branch_id, value = name
        $tokoList = Branch::where('user_id', $userId)
            ->orderBy('name')
            ->pluck('name', 'branch_id');

        $tahun = $request->tahun ?? $tahunList->first() ?? date('Y');
        $toko  = $request->toko  ?? 'all'; // nilai = branch_id atau 'all'

        // Nama toko yang dipilih (untuk filter status)
        $namaTokoDipilih = null;
        if ($toko !== 'all') {
            $namaTokoDipilih = Branch::where('branch_id', $toko)
                ->where('user_id', $userId)
                ->value('name');
        }

        // Status Toko dari Forward Chaining
        $statusQuery = StatusTokoModel::where('user_id', $userId)
            ->where('year_akhir', $tahun);

        if ($namaTokoDipilih) {
            $statusQuery->where('shopping_mall', $namaTokoDipilih);
        }

        $statusCabang        = $statusQuery->orderBy('shopping_mall')->get();
        $dataForwardTersedia = $statusCabang->count() > 0;

        // Insight pertumbuhan
        $pertumbuhanTertinggi = null;
        $penurunanTerbesar    = null;

        if ($dataForwardTersedia) {
            $baseInsight = StatusTokoModel::where('user_id', $userId)
                ->where('year_akhir', $tahun);

            $pertumbuhanTertinggi = (clone $baseInsight)
                ->orderByDesc('growth_percent')->first();

            $penurunanTerbesar = (clone $baseInsight)
                ->orderBy('growth_percent')->first();
        }

        // Data Grafik — loop dari branches, bukan shopping_mall
        $chartLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $chartDatasets = [];

        $targetBranches = $toko === 'all'
            ? Branch::where('user_id', $userId)->orderBy('name')->get()
            : Branch::where('user_id', $userId)->where('branch_id', $toko)->get();

        foreach ($targetBranches as $branch) {
            $dataBulanan = SalesModel::where('branch_id', $branch->branch_id)
                ->whereYear('invoice_date', $tahun)
                ->selectRaw('MONTH(invoice_date) as bulan, SUM(total_sales) as total_penjualan')
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();

            $sales = [];
            for ($i = 1; $i <= 12; $i++) {
                $b       = $dataBulanan->where('bulan', $i)->first();
                $sales[] = $b ? (float) $b->total_penjualan : 0;
            }

            $chartDatasets[] = [
                'label' => $branch->name, // ← nama dari tabel branches
                'data'  => $sales,
            ];
        }

        // Summary badge
        $jumlahNaik    = $statusCabang->where('status_toko', 'Naik')->count();
        $jumlahTurun   = $statusCabang->where('status_toko', 'Turun')->count();
        $jumlahStagnan = $statusCabang->where('status_toko', 'Stagnan')->count();

        return view('owner.tren-penjualan-toko', compact(
            'tahun', 'toko', 'tahunList', 'tokoList',
            'statusCabang', 'chartLabels', 'chartDatasets',
            'jumlahNaik', 'jumlahTurun', 'jumlahStagnan',
            'pertumbuhanTertinggi', 'penurunanTerbesar', 'dataForwardTersedia'
        ) + ['isEmpty' => false]);
    }
}