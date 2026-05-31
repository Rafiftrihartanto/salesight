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
}
