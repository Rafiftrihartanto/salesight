<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BranchController extends Controller
{
    // Menampilkan halaman kelola cabang beserta datanya
    public function index()
    {
        // Ambil data cabang khusus milik owner yang sedang login
        $branches = Branch::where('user_id', Auth::id())->get();
        return view('owner.kelola-cabang', compact('branches'));
    }

    // Memproses form tambah cabang dan membuat token
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        // LOGIKA GENERATE TOKEN (Contoh: SLS-JKT-01)
        // 1. Ambil 3 huruf pertama dari lokasi (misal: "Jakarta" jadi "JAK")
        $locCode = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $request->location), 0, 3));
        
        // 2. Buat angka random 2 digit (01-99)
        $randomNumber = str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT);
        
        // 3. Gabungkan jadi Token
        $branchCode = "SLS-{$locCode}-{$randomNumber}";

        // Simpan ke database
        Branch::create([
            'user_id'     => Auth::id(),
            'name'        => $request->name, // Nama shopping_mall
            'location'    => $request->location,
            'branch_code' => $branchCode,
            'status'      => 'aktif',
        ]);

        return redirect()->back()->with('success', 'Cabang baru berhasil ditambahkan! Token: ' . $branchCode);
    }

    // Memproses update data cabang
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'status'   => 'required|in:aktif,nonaktif',
        ]);

        $branch = Branch::where('branch_id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $branch->update([
            'name'     => $request->name,
            'location' => $request->location,
            'status'   => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data cabang ' . $branch->name . ' berhasil diperbarui!');
    }

    // Memproses penghapusan data cabang
    public function destroy($id)
    {
        // Cari cabang berdasarkan ID dan pastikan itu milik owner yang sedang login
        $branch = Branch::where('branch_id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $branchName = $branch->name; // Simpan nama untuk pesan sukses
        
        // Hapus data dari database
        $branch->delete();

        return redirect()->back()->with('success', 'Cabang ' . $branchName . ' berhasil dihapus secara permanen.');
    }

    public function daftarToko()
    {
        // 1. Ambil semua cabang milik owner yang login
        $branches = \App\Models\Branch::where('user_id', \Illuminate\Support\Facades\Auth::id())->get();

        $currentYear = \Carbon\Carbon::now()->year;
        $currentMonth = \Carbon\Carbon::now()->month;
        $namaBulan = \Carbon\Carbon::now()->translatedFormat('F'); // Mendapatkan nama bulan (Mei, Juni, dll)

        // 2. Ambil ID cabang dan total keseluruhan penjualan owner untuk hitung % kontribusi
        // PENTING: Ganti 'id' jadi 'branch_id' kalau primary key tabelmu menggunakan nama itu
        $branchIds = $branches->pluck('id'); 
        $totalOwnerSales = \App\Models\Sale::whereIn('branch_id', $branchIds)->sum('total_sales');

        $tokoData = [];
        $themes = ['theme-blue', 'theme-orange', 'theme-green', 'theme-purple', 'theme-red'];

        // 3. Looping perhitungan setiap cabang
        foreach ($branches as $index => $branch) {
            $idCabang = $branch->id ?? $branch->branch_id; // Antisipasi nama kolom ID
            $query = \App\Models\Sale::where('branch_id', $idCabang);

            $totalPenjualan = (clone $query)->sum('total_sales');
            $totalTransaksi = (clone $query)->count();
            
            $omsetBulanIni = (clone $query)->whereYear('invoice_date', $currentYear)
                                           ->whereMonth('invoice_date', $currentMonth)
                                           ->sum('total_sales');

            $kontribusi = $totalOwnerSales > 0 ? ($totalPenjualan / $totalOwnerSales) * 100 : 0;
            $rataRata = $totalTransaksi > 0 ? $totalPenjualan / $totalTransaksi : 0;

            $tokoData[] = [
                'name' => $branch->name ?? 'Cabang ' . ($index + 1),
                'location' => $branch->location ?? 'Lokasi belum diatur', // Ganti nama kolom jika ada kolom kota/lokasi
                'code' => $branch->branch_code ?? 'SLS-0' . ($index + 1),
                'status' => 'Aktif', // Bisa diubah jika ada logika non-aktif di databasemu
                'total_penjualan' => $totalPenjualan,
                'total_transaksi' => $totalTransaksi,
                'omset_bulan_ini' => $omsetBulanIni,
                'kontribusi' => round($kontribusi, 1),
                'rata_rata' => $rataRata,
                'theme' => $themes[$index % count($themes)], // Efek rotasi warna
                'initial' => strtoupper(substr($branch->name ?? 'C', 0, 1))
            ];
        }

        // 4. Urutkan toko dari penjualan tertinggi ke terendah (Untuk dapatkan lencana Top Store)
        usort($tokoData, function($a, $b) {
            return $b['total_penjualan'] <=> $a['total_penjualan'];
        });

        return view('owner.daftar-toko', compact('tokoData', 'namaBulan'));
    }
}
