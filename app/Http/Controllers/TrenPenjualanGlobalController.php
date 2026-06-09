<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class TrenPenjualanGlobalController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil ID Cabang
        $branches = Branch::where('user_id', Auth::id())->get();
        $ownerBranchIds = [];
        foreach ($branches as $b) {
            $ownerBranchIds[] = $b->id ?? $b->branch_id;
        }

        if (empty($ownerBranchIds)) {
            return $this->returnEmptyView();
        }

        // 2. Tarik Tahun
        $tahunRaw = SalesModel::whereIn('branch_id', $ownerBranchIds)
            ->selectRaw('YEAR(invoice_date) as tahun')
            ->distinct()
            ->pluck('tahun')
            ->toArray();

        $tahunList = [];
        foreach ($tahunRaw as $t) {
            if (!empty($t))
                $tahunList[] = (string) $t;
        }

        if (empty($tahunList)) {
            $tahunList = [(string) date('Y')];
        }
        rsort($tahunList);

        // ==========================================
// 3. BAGIAN ANTI ERROR (MENGHANCURKAN ARRAY)
// ==========================================
        $reqTahun = $request->input('tahun');

        // Jika dari URL berbentuk Array, paksa ambil isinya yang pertama
        if (is_array($reqTahun)) {
            $reqTahun = $reqTahun[0] ?? null; // ✅ ambil index [0]
        }

        // Ambil elemen PERTAMA dari tahunList sebagai fallback
        $fallbackTahun = is_array($tahunList) && count($tahunList) > 0
            ? $tahunList[0]  // ✅ tambahkan [0]
            : date('Y');

        // Kunci mati $tahun sebagai String murni
        $tahun = (string) ($reqTahun ? $reqTahun : $fallbackTahun);
        // ==========================================

        // 4. Tarik Data Penjualan
        $penjualanBulanan = SalesModel::whereIn('branch_id', $ownerBranchIds)
            ->whereYear('invoice_date', '=', $tahun)
            ->selectRaw("MONTH(invoice_date) as bulan, SUM(total_sales) as total_penjualan")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        $namaBulanFull = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];

        // 5. Siapkan Data Grafik
        $chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $chartSales = array_fill(0, 12, 0.0);

        for ($i = 1; $i <= 12; $i++) {
            if (isset($penjualanBulanan[$i])) {
                $chartSales[$i - 1] = (float) $penjualanBulanan[$i]->total_penjualan;
            }
        }

        // 6. Perbandingan Tahun Ini vs Tahun Sebelumnya
        $totalTahunIni = SalesModel::whereIn('branch_id', $ownerBranchIds)
            ->whereYear('invoice_date', '=', (int) $tahun)
            ->sum('total_sales');

        $totalTahunLalu = SalesModel::whereIn('branch_id', $ownerBranchIds)
            ->whereYear('invoice_date', '=', (int) $tahun - 1)
            ->sum('total_sales');

        $penjualanBulanIni = (float) $totalTahunIni;   // rename semantik di view nanti
        $penjualanBulanLalu = (float) $totalTahunLalu;

        $labelBulanIni = 'Tahun ' . $tahun;
        $labelBulanLalu = 'Tahun ' . ((int) $tahun - 1);

        $selisihNominal = $penjualanBulanIni - $penjualanBulanLalu;
        $persentaseSelisih = (float) ($penjualanBulanLalu > 0
            ? ($selisihNominal / $penjualanBulanLalu) * 100
            : 0);

        $statusPerbandingan = 'Stabil';
        if ($persentaseSelisih > 0)
            $statusPerbandingan = 'Naik';
        elseif ($persentaseSelisih < 0)
            $statusPerbandingan = 'Turun';

        // 7. Insight Tertinggi & Terendah
        $bulanTertinggi = $penjualanBulanan->sortByDesc('total_penjualan')->first();
        $bulanTerendah = $penjualanBulanan->sortBy('total_penjualan')->first();

        $labelTertinggi = (string) ($bulanTertinggi ? $namaBulanFull[$bulanTertinggi->bulan] : '-');
        $nilaiTertinggi = (float) ($bulanTertinggi ? $bulanTertinggi->total_penjualan : 0);

        $labelTerendah = (string) ($bulanTerendah ? $namaBulanFull[$bulanTerendah->bulan] : '-');
        $nilaiTerendah = (float) ($bulanTerendah ? $bulanTerendah->total_penjualan : 0);

        // 8. Growth Bulanan
        $growthBulanan = [];
        $keys = array_values($penjualanBulanan->keys()->toArray());
        sort($keys);

        for ($i = 1; $i < count($keys); $i++) {
            $bSkrg = $penjualanBulanan[$keys[$i]];
            $bSblm = $penjualanBulanan[$keys[$i - 1]];

            $growth = $bSblm->total_penjualan > 0
                ? (($bSkrg->total_penjualan - $bSblm->total_penjualan) / $bSblm->total_penjualan) * 100
                : 0;

            $growthBulanan[] = [
                'bulan' => (string) substr($namaBulanFull[$bSkrg->bulan], 0, 3),
                'growth' => (float) round($growth, 1)
            ];
        }

        return view('owner.tren-penjualan-global', compact(
            'tahun',
            'tahunList',
            'labelBulanIni',
            'labelBulanLalu',
            'penjualanBulanIni',
            'penjualanBulanLalu',
            'persentaseSelisih',
            'statusPerbandingan',
            'labelTertinggi',
            'labelTerendah',
            'nilaiTertinggi',
            'nilaiTerendah',
            'growthBulanan',
            'chartLabels',
            'chartSales'
        ));
    }

    private function returnEmptyView()
    {
        return view('owner.tren-penjualan-global', [
            'tahun' => date('Y'),
            'tahunList' => [date('Y')],
            'labelBulanIni' => 'Tahun ' . date('Y'),
            'labelBulanLalu' => 'Tahun ' . (date('Y') - 1),
            'penjualanBulanIni' => 0,
            'penjualanBulanLalu' => 0,
            'persentaseSelisih' => 0,
            'statusPerbandingan' => 'Stabil',
            'labelTertinggi' => '-',
            'labelTerendah' => '-',
            'nilaiTertinggi' => 0,
            'nilaiTerendah' => 0,
            'growthBulanan' => [],
            'chartLabels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'chartSales' => array_fill(0, 12, 0)
        ]);
    }
}