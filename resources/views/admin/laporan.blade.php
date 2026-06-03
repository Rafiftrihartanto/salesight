    @extends('layouts.admin')

    @section('content')

    <h1 class="text-3xl font-bold mb-2">
        Laporan Penjualan
    </h1>

    <p class="text-gray-500 mb-8">
        Ringkasan berdasarkan produk
    </p>

    <div class="grid grid-cols-3 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-400">Total Jenis Produk</p>
            <h2 class="text-3xl font-bold mt-3">
        {{ $totalProduk }}
    </h2>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-400">Total Pendapatan</p>
            <h2 class="text-3xl font-bold mt-3">
        Rp {{ number_format($totalPendapatan,0,',','.') }}
    </h2>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-400">Total Qty Terjual</p>
            <h2 class="text-3xl font-bold mt-3">
        {{ $totalQty }}
    </h2>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-indigo-50 text-indigo-700">

            <tr>

                <th class="p-5 text-left">Nama Produk</th>
                <th class="p-5 text-left">Qty</th>
                <th class="p-5 text-left">Pendapatan</th>
                <th class="p-5 text-left">Persentase</th>

            </tr>

            </thead>

            <tbody>

            @foreach($laporan as $item)

    <tr class="border-t">

        <td class="p-5 font-semibold">
            {{ $item->category }}
        </td>

        <td class="p-5">
            {{ $item->total_qty }}
        </td>

        <td class="p-5 font-bold">
            Rp {{ number_format($item->total_pendapatan,0,',','.') }}
        </td>

        <td class="p-5 text-indigo-600 font-bold">

            {{ number_format(
                ($item->total_pendapatan / $totalPendapatan) * 100,
                1
            ) }}%

        </td>

    </tr>

    @endforeach

            </tbody>

        </table>

    </div>

    @endsection