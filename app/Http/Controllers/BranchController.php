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
}
