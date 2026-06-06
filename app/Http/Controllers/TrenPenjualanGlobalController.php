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

        return view(
            'owner.tren-penjualan-global',
            compact(
                'tahun',
                'tahunList'
            )
        );
    }
}
