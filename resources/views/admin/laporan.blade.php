@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-extrabold text-slate-900">Laporan Penjualan</h1>
    <p class="text-sm text-slate-500 mt-1">Ringkasan berdasarkan produk &middot; semua data transaksi</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between h-32">
        <div class="flex justify-between items-start">
            <p class="text-sm font-semibold text-slate-500">Total Jenis Produk</p>
            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                <i data-lucide="package" class="w-4 h-4"></i>
            </div>
        </div>
        <h3 class="text-3xl font-extrabold text-slate-900">7</h3>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between h-32">
        <div class="flex justify-between items-start">
            <p class="text-sm font-semibold text-slate-500">Total Pendapatan</p>
            <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center text-green-600">
                <i data-lucide="dollar-sign" class="w-4 h-4"></i>
            </div>
        </div>
        <h3 class="text-3xl font-extrabold text-slate-900">Rp8.129.000</h3>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between h-32">
        <div class="flex justify-between items-start">
            <p class="text-sm font-semibold text-slate-500">Total Qty Terjual</p>
            <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center text-orange-500">
                <i data-lucide="shopping-cart" class="w-4 h-4"></i>
            </div>
        </div>
        <h3 class="text-3xl font-extrabold text-slate-900">492</h3>
    </div>

</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white">
        <div>
            <h2 class="text-base font-bold text-slate-800">Rekap Per Produk</h2>
            <p class="text-xs text-slate-400 mt-1">Diurutkan berdasarkan total pendapatan tertinggi</p>
        </div>
        <button class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors shadow-sm">
            <i data-lucide="download" class="w-4 h-4"></i> Export
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            
            <thead>
                <tr class="bg-white border-b border-slate-100 text-[11px] font-bold text-slate-400 tracking-wider uppercase">
                    <th class="px-6 py-4 w-12">#</th>
                    <th class="px-6 py-4">NAMA PRODUK</th>
                    <th class="px-6 py-4 text-center">JML TRANSAKSI</th>
                    <th class="px-6 py-4 text-center">TOTAL QTY</th>
                    <th class="px-6 py-4">TOTAL PENDAPATAN</th>
                    <th class="px-6 py-4 w-48">PERSENTASE</th>
                </tr>
            </thead>
            
            <tbody class="text-sm text-slate-600">
                
                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-5 text-slate-400 font-medium">1</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <i data-lucide="package" class="w-4 h-4"></i>
                            </div>
                            <span class="font-bold text-slate-800">Telur Ayam (10 butir)</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center font-bold text-slate-600">2x</td>
                    <td class="px-6 py-5 text-center font-bold text-slate-600">150 <span class="text-xs font-medium text-slate-400 ml-0.5">pcs</span></td>
                    <td class="px-6 py-5 font-extrabold text-slate-900">Rp3.375.000</td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-end">
                                <span class="text-xs font-bold text-blue-700">41.5%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: 41.5%"></div>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-5 text-slate-400 font-medium">2</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <i data-lucide="package" class="w-4 h-4"></i>
                            </div>
                            <span class="font-bold text-slate-800">Beras 5kg</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center font-bold text-slate-600">2x</td>
                    <td class="px-6 py-5 text-center font-bold text-slate-600">20 <span class="text-xs font-medium text-slate-400 ml-0.5">pcs</span></td>
                    <td class="px-6 py-5 font-extrabold text-slate-900">Rp1.500.000</td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-end">
                                <span class="text-xs font-bold text-blue-700">18.5%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: 18.5%"></div>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-5 text-slate-400 font-medium">3</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <i data-lucide="package" class="w-4 h-4"></i>
                            </div>
                            <span class="font-bold text-slate-800">Minyak Goreng 2L</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center font-bold text-slate-600">2x</td>
                    <td class="px-6 py-5 text-center font-bold text-slate-600">43 <span class="text-xs font-medium text-slate-400 ml-0.5">pcs</span></td>
                    <td class="px-6 py-5 font-extrabold text-slate-900">Rp1.376.000</td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-end">
                                <span class="text-xs font-bold text-blue-700">16.9%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: 16.9%"></div>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-5 text-slate-400 font-medium">4</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <i data-lucide="package" class="w-4 h-4"></i>
                            </div>
                            <span class="font-bold text-slate-800">Gula Pasir 1kg</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center font-bold text-slate-600">2x</td>
                    <td class="px-6 py-5 text-center font-bold text-slate-600">75 <span class="text-xs font-medium text-slate-400 ml-0.5">pcs</span></td>
                    <td class="px-6 py-5 font-extrabold text-slate-900">Rp1.050.000</td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-end">
                                <span class="text-xs font-bold text-blue-700">12.9%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: 12.9%"></div>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-5 text-slate-400 font-medium">5</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <i data-lucide="package" class="w-4 h-4"></i>
                            </div>
                            <span class="font-bold text-slate-800">Indomie Goreng</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center font-bold text-slate-600">2x</td>
                    <td class="px-6 py-5 text-center font-bold text-slate-600">120 <span class="text-xs font-medium text-slate-400 ml-0.5">pcs</span></td>
                    <td class="px-6 py-5 font-extrabold text-slate-900">Rp420.000</td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-end">
                                <span class="text-xs font-bold text-blue-700">5.2%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: 5.2%"></div>
                            </div>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
@endsection