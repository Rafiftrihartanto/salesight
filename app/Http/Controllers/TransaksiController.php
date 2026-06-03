<?php

namespace App\Http\Controllers;

use App\Models\SalesModel;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Tampilkan form input data
    public function create()
    {
        return view('admin.input-data');
    }

    // Simpan data transaksi
    public function store(Request $request)
    {
        $request->validate([
            'invoice_no' => 'required',
            'customer_id' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'total_sales' => 'required'
        ]);

        SalesModel::create($request->all());

        return redirect()
            ->route('admin.data-transaksi')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // Form edit data
    public function edit($id)
    {
        $sales = SalesModel::findOrFail($id);

        return view('admin.edit-data', compact('sales'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $sales = SalesModel::findOrFail($id);

        $sales->update($request->all());

        return redirect()
            ->route('admin.data-transaksi')
            ->with('success', 'Data berhasil diperbarui');
    }

    // Hapus data
    public function destroy($id)
    {
        $sales = SalesModel::findOrFail($id);

        $sales->delete();

        return redirect()
            ->route('admin.data-transaksi')
            ->with('success', 'Data berhasil dihapus');
    }
}