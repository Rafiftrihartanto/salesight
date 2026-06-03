<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil daftar NAMA CABANG milik owner yang sedang login
        // Ini dipakai untuk mencocokkan dengan kolom 'shopping_mall' di tabel transaksi
        $ownerBranches = Branch::where('user_id', Auth::id())->pluck('name');

        // 2. Query dasar: Ambil transaksi HANYA dari cabang-cabang milik owner ini
        $query = Transaction::whereIn('shopping_mall', $ownerBranches);

        // Siapkan variabel waktu (Tahun & Bulan ini)
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        // --- MENGHITUNG STATISTIK ---
        
        // Total Cabang (dari tabel branches)
        $totalCabang = $ownerBranches->count();

        // Transaksi Tahun Berjalan
        $transaksiTahunIni = (clone $query)->whereYear('invoice_date', $currentYear);
        
        $totalTransaksi = $transaksiTahunIni->count();
        $totalPenjualanTahun = $transaksiTahunIni->sum('total_sales');

        // Omset Bulan Ini
        $omsetBulanIni = (clone $query)->whereYear('invoice_date', $currentYear)
                                       ->whereMonth('invoice_date', $currentMonth)
                                       ->sum('total_sales');

        // Rata-rata Harian (Omset tahun ini dibagi jumlah hari yang sudah berlalu di tahun ini)
        $daysInYear = Carbon::now()->dayOfYear; 
        $rataRataHarian = $daysInYear > 0 ? $totalPenjualanTahun / $daysInYear : 0;

        // Rata-rata Per Transaksi
        $rataRataPerTransaksi = $totalTransaksi > 0 ? $totalPenjualanTahun / $totalTransaksi : 0;

        // Kirim data ke view
        return view('owner.dashboard', compact(
            'totalCabang',
            'totalTransaksi',
            'totalPenjualanTahun',
            'omsetBulanIni',
            'rataRataHarian',
            'rataRataPerTransaksi'
        ));
    }
}