<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\HasilEdasModel;
use App\Models\SalesModel;

class KontribusiTokoController extends Controller
{
    public function prosesEdas($tahun) //Untuk menjalankan metode edas
    {
        /*
        |--------------------------------------------------------------------------
        | Hapus data EDAS tahun yang sama (optional)
        |--------------------------------------------------------------------------
        */
        HasilEdasModel::where('periode_year', $tahun)->delete();

        /*
        |--------------------------------------------------------------------------
        | Ambil data dan agregasi per toko
        |--------------------------------------------------------------------------
        */
        $data = SalesModel::select(
            'shopping_mall',

            DB::raw('SUM(total_sales) as total_sales'),

            DB::raw('COUNT(invoice_no) as total_transaction'),

            DB::raw('SUM(quantity) as total_quantity'),

            DB::raw('AVG(total_sales) as average_sales')
        )
            ->whereYear('invoice_date', $tahun)
            ->groupBy('shopping_mall')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Validasi data kosong
        |--------------------------------------------------------------------------
        */
        if ($data->count() == 0) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Hitung rata-rata tiap kriteria (AV)
        |--------------------------------------------------------------------------
        */
        $avg_sales = $data->avg('total_sales');

        $avg_transaction = $data->avg('total_transaction');

        $avg_quantity = $data->avg('total_quantity');

        $avg_average_sales = $data->avg('average_sales');

        /*
        |--------------------------------------------------------------------------
        | Bobot kriteria
        |--------------------------------------------------------------------------
        */
        $weights = [
            'sales' => 0.4,
            'transaction' => 0.3,
            'quantity' => 0.2,
            'average_sales' => 0.1
        ];

        /*
        |--------------------------------------------------------------------------
        | Proses EDAS
        |--------------------------------------------------------------------------
        */
        $results = [];

        foreach ($data as $item) {

            /*
            |--------------------------------------------------------------------------
            | PDA (Positive Distance from Average)
            |--------------------------------------------------------------------------
            */

            $pda_sales = max(
                0,
                ($item->total_sales - $avg_sales)
                / $avg_sales
            );

            $pda_transaction = max(
                0,
                ($item->total_transaction - $avg_transaction)
                / $avg_transaction
            );

            $pda_quantity = max(
                0,
                ($item->total_quantity - $avg_quantity)
                / $avg_quantity
            );

            $pda_average_sales = max(
                0,
                ($item->average_sales - $avg_average_sales)
                / $avg_average_sales
            );

            /*
            |--------------------------------------------------------------------------
            | NDA (Negative Distance from Average)
            |--------------------------------------------------------------------------
            */

            $nda_sales = max(
                0,
                ($avg_sales - $item->total_sales)
                / $avg_sales
            );

            $nda_transaction = max(
                0,
                ($avg_transaction - $item->total_transaction)
                / $avg_transaction
            );

            $nda_quantity = max(
                0,
                ($avg_quantity - $item->total_quantity)
                / $avg_quantity
            );

            $nda_average_sales = max(
                0,
                ($avg_average_sales - $item->average_sales)
                / $avg_average_sales
            );

            /*
            |--------------------------------------------------------------------------
            | Hitung SP
            |--------------------------------------------------------------------------
            */

            $sp =
                ($pda_sales * $weights['sales']) +
                ($pda_transaction * $weights['transaction']) +
                ($pda_quantity * $weights['quantity']) +
                ($pda_average_sales * $weights['average_sales']);

            /*
            |--------------------------------------------------------------------------
            | Hitung SN
            |--------------------------------------------------------------------------
            */

            $sn =
                ($nda_sales * $weights['sales']) +
                ($nda_transaction * $weights['transaction']) +
                ($nda_quantity * $weights['quantity']) +
                ($nda_average_sales * $weights['average_sales']);

            /*
            |--------------------------------------------------------------------------
            | Simpan sementara
            |--------------------------------------------------------------------------
            */

            $results[] = [

                'shopping_mall' => $item->shopping_mall,

                'periode_year' => $tahun,

                'total_sales' => $item->total_sales,

                'total_transaction' => $item->total_transaction,

                'total_quantity' => $item->total_quantity,

                'average_sales' => $item->average_sales,

                'pda_sales' => $pda_sales,
                'pda_transaction' => $pda_transaction,
                'pda_quantity' => $pda_quantity,
                'pda_average_sales' => $pda_average_sales,

                'nda_sales' => $nda_sales,
                'nda_transaction' => $nda_transaction,
                'nda_quantity' => $nda_quantity,
                'nda_average_sales' => $nda_average_sales,

                'sp' => $sp,

                'sn' => $sn
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Cari nilai max SP dan max SN
        |--------------------------------------------------------------------------
        */

        $maxSp = collect($results)->max('sp');

        $maxSn = collect($results)->max('sn');

        /*
        |--------------------------------------------------------------------------
        | Hitung NSP, NSN, dan Appraisal Score
        |--------------------------------------------------------------------------
        */

        foreach ($results as &$result) {

            /*
            |--------------------------------------------------------------------------
            | NSP
            |--------------------------------------------------------------------------
            */

            if ($maxSp == 0) {
                $nsp = 0;
            } else {
                $nsp = $result['sp'] / $maxSp;
            }

            /*
            |--------------------------------------------------------------------------
            | NSN
            |--------------------------------------------------------------------------
            */

            if ($maxSn == 0) {
                $nsn = 1;
            } else {
                $nsn = 1 - ($result['sn'] / $maxSn);
            }

            /*
            |--------------------------------------------------------------------------
            | Appraisal Score
            |--------------------------------------------------------------------------
            */

            $as = ($nsp + $nsn) / 2;

            $result['nsp'] = $nsp;
            $result['nsn'] = $nsn;

            $result['appraisal_score'] = $as;
        }

        /*
        |--------------------------------------------------------------------------
        | Sorting ranking
        |--------------------------------------------------------------------------
        */

        usort($results, function ($a, $b) {
            return $b['appraisal_score']
                <=> $a['appraisal_score'];
        });

        /*
        |--------------------------------------------------------------------------
        | Simpan ke database
        |--------------------------------------------------------------------------
        */

        foreach ($results as $index => $result) {

            HasilEdasModel::create([

                'shopping_mall' => $result['shopping_mall'],

                'periode_year' => $result['periode_year'],

                'total_sales' => $result['total_sales'],

                'total_transaction' => $result['total_transaction'],

                'total_quantity' => $result['total_quantity'],

                'average_sales' => $result['average_sales'],

                'pda_sales' => $result['pda_sales'],
                'pda_transaction' => $result['pda_transaction'],
                'pda_quantity' => $result['pda_quantity'],
                'pda_average_sales' => $result['pda_average_sales'],

                'nda_sales' => $result['nda_sales'],
                'nda_transaction' => $result['nda_transaction'],
                'nda_quantity' => $result['nda_quantity'],
                'nda_average_sales' => $result['nda_average_sales'],

                'sp' => $result['sp'],
                'sn' => $result['sn'],

                'nsp' => $result['nsp'],
                'nsn' => $result['nsn'],

                'appraisal_score' => $result['appraisal_score'],

                'ranking_position' => $index + 1
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Return response
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'message' => 'Perhitungan EDAS berhasil',
            'data' => $results
        ]);
    }

    public function kontribusiToko(Request $request) // Untuk menampilkan hasil edas pada menu kontribusi toko
    {
        $tahun = $request->tahun ?? 2022;

        /*
        |--------------------------------------------------------------------------
        | Ambil data EDAS berdasarkan tahun
        |--------------------------------------------------------------------------
        */

        $tahunList = HasilEdasModel::select('periode_year')
            ->distinct()
            ->orderBy('periode_year', 'desc')
            ->pluck('periode_year');


        $data = HasilEdasModel::where(
            'periode_year',
            $tahun
        )
            ->orderBy('ranking_position', 'asc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Total sales keseluruhan
        |--------------------------------------------------------------------------
        */

        $totalSales = $data->sum('total_sales');


        /*
        |--------------------------------------------------------------------------
        | Hitung persentase kontribusi
        |--------------------------------------------------------------------------
        */

        foreach ($data as $item) {

            if ($totalSales > 0) {

                $item->persentase =
                    ($item->total_sales / $totalSales) * 100;

            } else {

                $item->persentase = 0;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Toko terbaik
        |--------------------------------------------------------------------------
        */

        $best = $data->first();

        /*
        |--------------------------------------------------------------------------
        | Toko terburuk
        |--------------------------------------------------------------------------
        */

        $worst = $data->last();

        /*
        |--------------------------------------------------------------------------
        | Ringkasan
        |--------------------------------------------------------------------------
        */

        $jumlahCabang = $data->count();

        $rataRataCabang =
            $jumlahCabang > 0
            ? $totalSales / $jumlahCabang
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Tampilan Visualisasi
        |--------------------------------------------------------------------------
        */

        $chartLabels = $data->pluck('shopping_mall');
        $chartScores = $data->pluck('appraisal_score');

        $chartLabels = $data
            ->pluck('shopping_mall')
            ->toArray();

        $chartScores = $data
            ->pluck('appraisal_score')
            ->map(function ($score) {
                return round($score, 4);
            })
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Return view
        |--------------------------------------------------------------------------
        */

        return view(
            'owner.kontribusi-toko',
            compact(
                'data',
                'best',
                'worst',
                'totalSales',
                'jumlahCabang',
                'rataRataCabang',
                'tahun',
                'tahunList',
                'chartLabels',
                'chartScores'
            )
        );
    }

    public function trenPenjualanToko(Request $request) //Untuk menampilkan hasil edas pada menu tren penjualan toko
    {
        $tahun = $request->tahun ?? 2023;

        $toko = $request->toko ?? 'all';

        $tahunList = SalesModel::selectRaw('YEAR(invoice_date) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $tokoList = SalesModel::select('shopping_mall')
            ->distinct()
            ->orderBy('shopping_mall')
            ->pluck('shopping_mall');

        return view(
            'owner.tren-penjualan-toko',
            compact(
                'tahun',
                'toko',
                'tahunList',
                'tokoList'
            )
        );
    }
}