<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesModel;

class TrenPenjualanGlobalController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun ?? 2022;

        $tahunList = SalesModel::selectRaw(
                'YEAR(invoice_date) as tahun'
            )
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Perbandingan Penjualan

        $penjualanBulanan = SalesModel::whereYear(
                'invoice_date',
                $tahun
            )
            ->selectRaw("
                MONTH(invoice_date) as bulan,
                SUM(total_sales) as total_penjualan
            ")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulanIni = $penjualanBulanan->last();

        $bulanLalu = $penjualanBulanan
            ->slice(-2, 1)
            ->first();

        $penjualanBulanIni = $bulanIni
            ? $bulanIni->total_penjualan
            : 0;

        $penjualanBulanLalu = $bulanLalu
            ? $bulanLalu->total_penjualan
            : 0;

        $selisihNominal =
            $penjualanBulanIni -
            $penjualanBulanLalu;

        if ($penjualanBulanLalu > 0) {

        $persentaseSelisih =
            ($selisihNominal / $penjualanBulanLalu) * 100;

        } else {
            $persentaseSelisih = 0;
        }

        if ($persentaseSelisih > 0) {
            $statusPerbandingan = '+';
        } elseif ($persentaseSelisih < 0) {
            $statusPerbandingan = '-';
        } else {
            $statusPerbandingan = 'Stabil';
        }

        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $labelBulanIni =
            $bulanIni
                ? $namaBulan[$bulanIni->bulan]
                : '-';

        $labelBulanLalu =
            $bulanLalu
                ? $namaBulan[$bulanLalu->bulan]
                : '-';

        return view(
            'owner.tren-penjualan-global',
            compact(
                'tahun',
                'tahunList',
                'labelBulanIni',
                'labelBulanLalu',
                'penjualanBulanIni',
                'penjualanBulanLalu',
                'persentaseSelisih',
                'statusPerbandingan'
            )
        );
    }
}