<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusTokoModel;
use App\Models\SalesModel;
use Illuminate\Support\Facades\DB;

class ForwardController extends Controller
{
    public function prosesStatusToko($yearAwal, $yearAkhir)
    {
        /*
        |--------------------------------------------------------------------------
        | Hapus data lama untuk periode yang sama
        |--------------------------------------------------------------------------
        */

        StatusTokoModel::where('year_awal', $yearAwal)
            ->where('year_akhir', $yearAkhir)
            ->delete();

        /*
        |--------------------------------------------------------------------------
        | Data tahun awal
        |--------------------------------------------------------------------------
        */

        $salesAwal = SalesModel::select(
                'shopping_mall',
                DB::raw('SUM(total_sales) as total_sales')
            )
            ->whereYear('invoice_date', $yearAwal)
            ->groupBy('shopping_mall')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Data tahun akhir
        |--------------------------------------------------------------------------
        */

        $salesAkhir = SalesModel::select(
                'shopping_mall',
                DB::raw('SUM(total_sales) as total_sales')
            )
            ->whereYear('invoice_date', $yearAkhir)
            ->groupBy('shopping_mall')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Ubah tahun awal menjadi array
        |--------------------------------------------------------------------------
        */

        $tahunAwal = [];

        foreach ($salesAwal as $item) {

            $tahunAwal[$item->shopping_mall]
                = $item->total_sales;
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan hasil
        |--------------------------------------------------------------------------
        */

        $hasil = [];

        foreach ($salesAkhir as $item) {

            $mall = $item->shopping_mall;

            $sales_awal =
                $tahunAwal[$mall] ?? null;

            $sales_akhir =
                $item->total_sales;

            /*
            |--------------------------------------------------------------------------
            | Growth %
            |--------------------------------------------------------------------------
            */

            if (
                is_null($sales_awal)
                || $sales_awal == 0
            ) {

                $growth = null;

                $status = 'Data Awal';

            } else {

                $growth =
                    (($sales_akhir - $sales_awal)
                    / $sales_awal) * 100;

                /*
                |--------------------------------------------------------------------------
                | Forward Chaining
                |--------------------------------------------------------------------------
                */

                if ($growth > 15) {

                    $status = 'Naik';

                } elseif ($growth < 0) {

                    $status = 'Turun';

                } else {

                    $status = 'Stagnan';
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan ke database
            |--------------------------------------------------------------------------
            */

            StatusTokoModel::create([

                'shopping_mall' => $mall,

                'year_awal' => $yearAwal,

                'year_akhir' => $yearAkhir,

                'sales_awal' => $sales_awal ?? 0,

                'sales_akhir' => $sales_akhir,

                'growth_percent' => $growth ?? 0,

                'status_toko' => $status
            ]);

            $hasil[] = [

                'shopping_mall' => $mall,

                'sales_awal' => $sales_awal,

                'sales_akhir' => $sales_akhir,

                'growth_percent' => $growth,

                'status_toko' => $status
            ];
        }

        return response()->json([
            'message' => 'Forward Chaining berhasil',
            'periode' => $yearAwal . ' - ' . $yearAkhir,
            'jumlah_toko' => count($hasil),
            'data' => $hasil
        ]);
    }

    public function trenPenjualanToko(Request $request) // Untuk menampilkan status toko pada menu tren penjualan toko
    {
        /*
        |--------------------------------------------------------------------------
        | Filter
        |--------------------------------------------------------------------------
        */

        $tahun = $request->tahun ?? 2022;

        $toko = $request->toko ?? 'all';

        /*
        |--------------------------------------------------------------------------
        | Dropdown Tahun
        |--------------------------------------------------------------------------
        */

        $tahunList = SalesModel::selectRaw('YEAR(invoice_date) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        /*
        |--------------------------------------------------------------------------
        | Dropdown Toko
        |--------------------------------------------------------------------------
        */

        $tokoList = SalesModel::select('shopping_mall')
            ->distinct()
            ->orderBy('shopping_mall')
            ->pluck('shopping_mall');

        /*
        |--------------------------------------------------------------------------
        | Status Cabang
        |--------------------------------------------------------------------------
        */

        $statusCabang = StatusTokoModel::where(
                'year_akhir',
                $tahun
            );

        if ($toko != 'all') {

            $statusCabang->where(
                'shopping_mall',
                $toko
            );
        }

        $statusCabang = $statusCabang
            ->orderBy('shopping_mall')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Data Grafik Line Chart
        |--------------------------------------------------------------------------
        */

        $queryChart = SalesModel::whereYear(
            'invoice_date',
            $tahun
        );

        if ($toko != 'all') {

            $queryChart->where(
                'shopping_mall',
                $toko
            );
        }

        $chartData = $queryChart
            ->selectRaw("
                MONTH(invoice_date) as bulan,
                SUM(total_sales) as total_penjualan
            ")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $chartLabels = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ];

        $chartSales = [];

        for ($i = 1; $i <= 12; $i++) {

            $bulan = $chartData
                ->where('bulan', $i)
                ->first();

            $chartSales[] = $bulan
                ? $bulan->total_penjualan
                : 0;
        }

        /*
        |--------------------------------------------------------------------------
        | Insight
        |--------------------------------------------------------------------------
        */

        $jumlahNaik = $statusCabang
            ->where('status_toko', 'Naik')
            ->count();

        $jumlahTurun = $statusCabang
            ->where('status_toko', 'Turun')
            ->count();

        $jumlahStagnan = $statusCabang
            ->where('status_toko', 'Stagnan')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'owner.tren-penjualan-toko',
            compact(
                'tahun',
                'toko',
                'tahunList',
                'tokoList',
                'statusCabang',
                'chartLabels',
                'chartSales',
                'jumlahNaik',
                'jumlahTurun',
                'jumlahStagnan'
            )
        );
    }
}