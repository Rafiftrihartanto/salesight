@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-extrabold text-slate-900">Manajemen Data Transaksi</h1>
    <p class="text-sm text-slate-500 mt-1">Kelola dan pantau data penjualan dengan mudah</p>
</div>

<div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
    
    <div class="flex items-center gap-3 w-full md:w-auto">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 shadow-sm transition-colors w-full md:w-auto justify-center">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Data
        </button>
        <button class="bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 shadow-sm transition-colors w-full md:w-auto justify-center">
            <i data-lucide="upload" class="w-4 h-4"></i> Import CSV
        </button>
    </div>

    <div class="flex items-center gap-3 w-full md:w-auto">
        <div class="relative w-full md:w-64">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
            </div>
            <input type="text" class="block w-full pl-9 pr-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition-all" placeholder="Cari produk...">
        </div>
        
        <button class="bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 px-4 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 shadow-sm transition-colors shrink-0">
            <i data-lucide="sliders-horizontal" class="w-4 h-4"></i> Filter
        </button>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-blue-50/50 border-b border-slate-100 text-[11px] font-bold text-blue-600 tracking-wider uppercase">
                    <th class="px-6 py-4">NO</th>
                    <th class="px-6 py-4">TANGGAL</th>
                    <th class="px-6 py-4">NAMA PRODUK</th>
                    <th class="px-6 py-4">JUMLAH</th>
                    <th class="px-6 py-4">HARGA SATUAN (RP)</th>
                    <th class="px-6 py-4">TOTAL HARGA (RP)</th>
                    <th class="px-6 py-4 text-center">AKSI</th>
                </tr>
            </thead>
            
            <tbody class="text-sm text-slate-600">
                
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-slate-400">1</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                            <span class="font-semibold text-slate-700">07 Apr 2025</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <i data-lucide="package" class="w-4 h-4"></i>
                            </div>
                            <span class="font-bold text-slate-800 leading-tight">Indomie Goreng</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800">48<span class="text-xs font-medium text-slate-400 ml-1">pcs</span></td>
                    <td class="px-6 py-4 text-slate-500">Rp3.500</td>
                    <td class="px-6 py-4 font-extrabold text-slate-900">Rp168.000</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <button class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 border border-blue-100 hover:bg-blue-100 rounded-lg text-xs font-bold transition-colors">
                                <i data-lucide="edit-2" class="w-3.5 h-3.5"></i> Edit
                            </button>
                            <button class="flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 rounded-lg text-xs font-bold transition-colors">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus
                            </button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-slate-400">2</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                            <span class="font-semibold text-slate-700">07 Apr 2025</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <i data-lucide="package" class="w-4 h-4"></i>
                            </div>
                            <span class="font-bold text-slate-800 leading-tight">Telur Ayam (10 butir)</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800">90<span class="text-xs font-medium text-slate-400 ml-1">pcs</span></td>
                    <td class="px-6 py-4 text-slate-500">Rp22.500</td>
                    <td class="px-6 py-4 font-extrabold text-slate-900">Rp2.025.000</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <button class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 border border-blue-100 hover:bg-blue-100 rounded-lg text-xs font-bold transition-colors">
                                <i data-lucide="edit-2" class="w-3.5 h-3.5"></i> Edit
                            </button>
                            <button class="flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 rounded-lg text-xs font-bold transition-colors">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus
                            </button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-slate-400">3</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                            <span class="font-semibold text-slate-700">06 Apr 2025</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <i data-lucide="package" class="w-4 h-4"></i>
                            </div>
                            <span class="font-bold text-slate-800 leading-tight">Gula Pasir 1kg</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800">30<span class="text-xs font-medium text-slate-400 ml-1">pcs</span></td>
                    <td class="px-6 py-4 text-slate-500">Rp14.000</td>
                    <td class="px-6 py-4 font-extrabold text-slate-900">Rp420.000</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <button class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 border border-blue-100 hover:bg-blue-100 rounded-lg text-xs font-bold transition-colors">
                                <i data-lucide="edit-2" class="w-3.5 h-3.5"></i> Edit
                            </button>
                            <button class="flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 rounded-lg text-xs font-bold transition-colors">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus
                            </button>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-slate-100 flex items-center justify-between bg-slate-50/50">
        <span class="text-xs font-medium text-slate-500">Menampilkan 1-3 dari 12 data</span>
        <div class="flex items-center gap-1">
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400 bg-white cursor-not-allowed">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
            </button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-blue-600 text-white bg-blue-600 font-bold text-xs">1</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 bg-white hover:bg-slate-50 font-bold text-xs">2</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 bg-white hover:bg-slate-50 font-bold text-xs">3</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 bg-white hover:bg-slate-50">
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </button>
        </div>
    </div>
</div>
@endsection