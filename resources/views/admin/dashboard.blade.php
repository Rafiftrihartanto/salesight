@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 flex items-center gap-2">
            Selamat Datang, Admin Fulan 👋
        </h1>
        <p class="text-sm text-slate-500 mt-1">Ringkasan data penjualan Anda - 30 Apr 2025</p>
    </div>
    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold flex items-center gap-2 shadow-sm transition-colors">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Data
    </button>
</div>

<div class="grid grid-cols-4 gap-6 mb-8">
    
    <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-semibold text-slate-400 mb-1">Total<br>Transaksi</p>
                <h3 class="text-2xl font-extrabold text-slate-800 mt-3">12</h3>
                <p class="text-[11px] text-slate-400 mt-1">data tersimpan</p>
            </div>
            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                <i data-lucide="clipboard-list" class="w-4 h-4"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-semibold text-slate-400 mb-1">Total<br>Pendapatan</p>
                <h3 class="text-2xl font-extrabold text-slate-800 mt-3">Rp8.129.000</h3>
                <p class="text-[11px] text-slate-400 mt-1">keseluruhan</p>
            </div>
            <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center text-green-600">
                <i data-lucide="dollar-sign" class="w-4 h-4"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-semibold text-slate-400 mb-1">Total Qty<br>Terjual</p>
                <h3 class="text-2xl font-extrabold text-slate-800 mt-3">492</h3>
                <p class="text-[11px] text-slate-400 mt-1">unit / pcs</p>
            </div>
            <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center text-orange-500">
                <i data-lucide="package" class="w-4 h-4"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-semibold text-slate-400 mb-1">Rata-rata /<br>Transaksi</p>
                <h3 class="text-2xl font-extrabold text-slate-800 mt-3">Rp677.417</h3>
                <p class="text-[11px] text-slate-400 mt-1">per transaksi</p>
            </div>
            <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600">
                <i data-lucide="trending-up" class="w-4 h-4"></i>
            </div>
        </div>
    </div>

</div>

<div class="grid grid-cols-3 gap-6">
    
    <div class="col-span-2 bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col">
        <div class="mb-6">
            <h2 class="text-base font-bold text-slate-800">Top 5 Produk</h2>
            <p class="text-xs text-slate-400 mt-1">Berdasarkan total pendapatan (ribu Rp)</p>
        </div>
        
        <div class="flex-1 flex items-end gap-6 pt-4 relative">
            <div class="absolute inset-0 flex flex-col justify-between pointer-events-none pb-6 pl-10">
                <div class="border-b border-dashed border-slate-200 w-full"></div>
                <div class="border-b border-dashed border-slate-200 w-full"></div>
                <div class="border-b border-dashed border-slate-200 w-full"></div>
                <div class="border-b border-slate-200 w-full"></div>
            </div>

            <div class="flex flex-col justify-between h-full text-[10px] text-slate-400 font-semibold absolute left-0 pb-6 w-8 text-right">
                <span>3400</span>
                <span>2550</span>
                <span>1700</span>
                <span>850</span>
                <span>0</span>
            </div>

            <div class="w-full h-full flex justify-around items-end pl-12 pb-6 relative z-10">
                <div class="w-16 bg-blue-600 rounded-t-lg" style="height: 98%;"></div>
                <div class="w-16 bg-blue-600/90 rounded-t-lg" style="height: 45%;"></div>
                <div class="w-16 bg-blue-600/80 rounded-t-lg" style="height: 40%;"></div>
                <div class="w-16 bg-blue-600/70 rounded-t-lg" style="height: 30%;"></div>
                <div class="w-16 bg-blue-600/60 rounded-t-lg" style="height: 12%;"></div>
            </div>
        </div>
        
        <div class="flex justify-around items-center pl-12 pt-3">
            <span class="text-[10px] font-semibold text-slate-400">Telur Ayam</span>
            <span class="text-[10px] font-semibold text-slate-400">Beras 5kg</span>
            <span class="text-[10px] font-semibold text-slate-400">Minyak 2L</span>
            <span class="text-[10px] font-semibold text-slate-400">Gula Pasir</span>
            <span class="text-[10px] font-semibold text-slate-400">Indomie Goreng</span>
        </div>
    </div>

    <div class="col-span-1 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
        <div class="p-5 border-b border-slate-100 bg-white">
            <h2 class="text-base font-bold text-slate-800">Transaksi Terbaru</h2>
            <p class="text-xs text-slate-400 mt-1">5 entri terakhir yang ditambahkan</p>
        </div>
        
        <div class="flex-1 overflow-y-auto">
            <div class="p-4 border-b border-slate-50 hover:bg-slate-50 transition-colors flex justify-between items-center">
                <div>
                    <h4 class="text-sm font-bold text-slate-800">Indomie Goreng</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">07 Apr 2025 · 48 pcs</p>
                </div>
                <div class="text-sm font-bold text-slate-900">Rp168.000</div>
            </div>

            <div class="p-4 border-b border-slate-50 hover:bg-slate-50 transition-colors flex justify-between items-center">
                <div>
                    <h4 class="text-sm font-bold text-slate-800">Telur Ayam (10 butir)</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">07 Apr 2025 · 90 pcs</p>
                </div>
                <div class="text-sm font-bold text-slate-900">Rp2.025.000</div>
            </div>

            <div class="p-4 border-b border-slate-50 hover:bg-slate-50 transition-colors flex justify-between items-center">
                <div>
                    <h4 class="text-sm font-bold text-slate-800">Gula Pasir 1kg</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">06 Apr 2025 · 30 pcs</p>
                </div>
                <div class="text-sm font-bold text-slate-900">Rp420.000</div>
            </div>

            <div class="p-4 border-b border-slate-50 hover:bg-slate-50 transition-colors flex justify-between items-center">
                <div>
                    <h4 class="text-sm font-bold text-slate-800">Beras 5kg</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">06 Apr 2025 · 12 pcs</p>
                </div>
                <div class="text-sm font-bold text-slate-900">Rp900.000</div>
            </div>

            <div class="p-4 hover:bg-slate-50 transition-colors flex justify-between items-center">
                <div>
                    <h4 class="text-sm font-bold text-slate-800">Minyak Goreng 2L</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">05 Apr 2025 · 18 pcs</p>
                </div>
                <div class="text-sm font-bold text-slate-900">Rp576.000</div>
            </div>
        </div>
    </div>

</div>
@endsection