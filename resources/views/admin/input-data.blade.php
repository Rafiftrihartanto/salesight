@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-center min-h-screen">

    <div class="bg-white w-[500px] rounded-3xl shadow-xl p-8">

        <div class="flex justify-between items-center mb-6">

            <div>
                <p class="text-indigo-600 text-sm font-semibold">
                    + Tambah Data Baru
                </p>

                <h1 class="text-3xl font-bold mt-2">
                    Input Data Transaksi
                </h1>
            </div>

            <button class="text-gray-400 text-2xl">
                ✕
            </button>

        </div>

        <div class="space-y-5">

            <div>
                <label class="block mb-2 font-medium">
                    Tanggal Transaksi
                </label>

                <input type="date"
                       class="w-full border rounded-xl px-4 py-3">
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    Nama Produk
                </label>

                <select class="w-full border rounded-xl px-4 py-3">
                    <option>Indomie Goreng</option>
                    <option>Telur Ayam</option>
                    <option>Gula Pasir</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="block mb-2 font-medium">
                        Jumlah
                    </label>

                    <input type="number"
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        Harga Satuan
                    </label>

                    <input type="number"
                           class="w-full border rounded-xl px-4 py-3">
                </div>

            </div>

            <div>
                <label class="block mb-2 font-medium">
                    Total Harga
                </label>

                <input type="text"
                       placeholder="Rp0"
                       class="w-full border rounded-xl px-4 py-3 bg-gray-100">
            </div>

            <div class="flex gap-4 pt-4">

                <button
                    class="w-1/2 border rounded-xl py-3 hover:bg-gray-100">
                    Batal
                </button>

                <button
                    class="w-1/2 bg-indigo-600 text-white rounded-xl py-3 hover:bg-indigo-700">
                    Simpan Transaksi
                </button>

            </div>

        </div>

    </div>

</div>

@endsection