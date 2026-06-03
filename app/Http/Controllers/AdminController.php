<?php

namespace App\Http\Controllers;

use App\Models\SalesModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        $totalRevenue = SalesModel::sum('total_sales');

        $totalTransaksi = SalesModel::count();

        $totalKategori = SalesModel::distinct('category')
            ->count('category');

        $totalCustomer = SalesModel::distinct('customer_id')
            ->count('customer_id');

        $topProduk = SalesModel::selectRaw("
                category,
                SUM(total_sales) as revenue
            ")
            ->groupBy('category')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get();

        $transaksiTerbaru = SalesModel::orderBy(
                'invoice_date',
                'desc'
            )
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalTransaksi',
            'totalKategori',
            'totalCustomer',
            'topProduk',
            'transaksiTerbaru'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Data Transaksi
    |--------------------------------------------------------------------------
    */
    public function dataTransaksi()
    {
        $sales = SalesModel::orderBy(
                'invoice_date',
                'desc'
            )
            ->paginate(10);

        return view(
            'admin.data-transaksi',
            compact('sales')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Laporan
    |--------------------------------------------------------------------------
    */
    public function laporan()
    {
        $laporan = SalesModel::selectRaw("
                category,
                SUM(quantity) as total_qty,
                SUM(total_sales) as total_pendapatan
            ")
            ->groupBy('category')
            ->orderByDesc('total_pendapatan')
            ->get();

        $totalProduk = $laporan->count();

        $totalPendapatan = $laporan->sum(
            'total_pendapatan'
        );

        $totalQty = $laporan->sum(
            'total_qty'
        );

        return view('admin.laporan', compact(
            'laporan',
            'totalProduk',
            'totalPendapatan',
            'totalQty'
        ));
    }
}