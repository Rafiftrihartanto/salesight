@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold">
            Selamat Datang, Admin Fulan 👋
        </h1>

        <p class="text-gray-500 mt-1">
            Ringkasan data penjualan Anda
        </p>

    </div>

    <a href="{{ route('admin.input-data') }}"
       class="bg-indigo-600 text-white px-5 py-3 rounded-xl shadow">
        + Tambah Data
    </a>

</div>

<!-- CARD -->
<div class="grid grid-cols-4 gap-5 mb-8">

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-gray-400">Total Transaksi</p>
        <h2 class="text-3xl font-bold mt-3">
            {{ number_format($totalTransaksi) }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-gray-400">Total Pendapatan</p>
        <h2 class="text-3xl font-bold mt-3">
            Rp {{ number_format($totalRevenue,0,',','.') }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-gray-400">Kategori</p>
        <h2 class="text-3xl font-bold mt-3">
            {{ $totalKategori }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow">
        <p class="text-gray-400">Customer</p>
        <h2 class="text-3xl font-bold mt-3">
            {{ number_format($totalCustomer) }}
        </h2>
    </div>

</div>

<div class="grid grid-cols-3 gap-6">

    <!-- CHART -->
    <div class="col-span-2 bg-white rounded-2xl shadow p-6">

        <h2 class="font-bold text-xl mb-4">
            Top 5 Produk
        </h2>

        <canvas id="salesChart"></canvas>

    </div>

    <!-- TRANSAKSI TERBARU -->
    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="font-bold text-xl mb-4">
            Transaksi Terbaru
        </h2>

        @foreach($transaksiTerbaru as $item)

        <div class="border-b py-3">

            <div class="flex justify-between">

                <div>
                    <p class="font-semibold">
                        {{ $item->category }}
                    </p>

                    <small class="text-gray-500">
                        {{ $item->invoice_date }}
                    </small>
                </div>

                <div class="font-bold">
                    Rp {{ number_format($item->total_sales,0,',','.') }}
                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(
document.getElementById('salesChart'),
{
    type:'bar',
    data:{
        labels:[
            @foreach($topProduk as $item)
                "{{ $item->category }}",
            @endforeach
        ],
        datasets:[{
            data:[
                @foreach($topProduk as $item)
                    {{ $item->revenue }},
                @endforeach
            ]
        }]
    }
});

</script>

@endsection