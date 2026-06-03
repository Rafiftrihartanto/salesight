@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Manajemen Data Transaksi
        </h1>

        <p class="text-gray-500 mt-1">
            Kelola dan pantau data penjualan dengan mudah
        </p>
    </div>

</div>

<!-- Action Button -->
<div class="flex justify-between items-center mb-6">

    <div class="flex gap-3">

        <button
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl shadow">
            + Tambah Data
        </button>

        <button
            class="bg-white border px-5 py-3 rounded-xl hover:bg-gray-50">
            Import CSV
        </button>

    </div>

    <div class="flex gap-3">

        <input
            type="text"
            placeholder="Cari produk..."
            class="border rounded-xl px-4 py-3 w-64">

        <button
            class="bg-white border px-5 py-3 rounded-xl hover:bg-gray-50">
            Filter
        </button>

    </div>

</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-indigo-50 text-indigo-700">

        <tr class="text-sm">

            <th class="text-left p-5">NO</th>
            <th class="text-left p-5">TANGGAL</th>
            <th class="text-left p-5">NAMA PRODUK</th>
            <th class="text-left p-5">JUMLAH</th>
            <th class="text-left p-5">HARGA SATUAN</th>
            <th class="text-left p-5">TOTAL HARGA</th>
            <th class="text-left p-5">AKSI</th>

        </tr>

        </thead>

        <tbody>

        <tr class="border-t hover:bg-gray-50">

            <td class="p-5">1</td>
            <td class="p-5">07 Apr 2025</td>
            <td class="p-5 font-semibold">Indomie Goreng</td>
            <td class="p-5">48 pcs</td>
            <td class="p-5">Rp3.500</td>
            <td class="p-5 font-bold">Rp168.000</td>

            <td class="p-5 flex gap-2">

                <button
                    class="bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg text-sm">
                    Edit
                </button>

                <button
                    class="bg-red-100 text-red-600 px-4 py-2 rounded-lg text-sm">
                    Hapus
                </button>

            </td>

        </tr>

        <tr class="border-t hover:bg-gray-50">

            <td class="p-5">2</td>
            <td class="p-5">07 Apr 2025</td>
            <td class="p-5 font-semibold">Telur Ayam</td>
            <td class="p-5">90 pcs</td>
            <td class="p-5">Rp22.500</td>
            <td class="p-5 font-bold">Rp2.025.000</td>

            <td class="p-5 flex gap-2">

                <button
                    class="bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg text-sm">
                    Edit
                </button>

                <button
                    class="bg-red-100 text-red-600 px-4 py-2 rounded-lg text-sm">
                    Hapus
                </button>

            </td>

        </tr>

        <tr class="border-t hover:bg-gray-50">

            <td class="p-5">3</td>
            <td class="p-5">06 Apr 2025</td>
            <td class="p-5 font-semibold">Gula Pasir 1kg</td>
            <td class="p-5">30 pcs</td>
            <td class="p-5">Rp14.000</td>
            <td class="p-5 font-bold">Rp420.000</td>

            <td class="p-5 flex gap-2">

                <button
                    class="bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg text-sm">
                    Edit
                </button>

                <button
                    class="bg-red-100 text-red-600 px-4 py-2 rounded-lg text-sm">
                    Hapus
                </button>

            </td>

        </tr>

        </tbody>

    </table>

</div>

@endsection