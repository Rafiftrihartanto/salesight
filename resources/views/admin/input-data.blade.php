@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-extrabold text-slate-900">Input Data Transaksi</h1>
    <p class="text-sm text-slate-500 mt-1">Tambahkan pencatatan data penjualan baru ke dalam sistem</p>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 flex items-start gap-3 max-w-2xl">
    <div class="mt-0.5 text-green-600"><i data-lucide="check-circle-2" class="w-5 h-5"></i></div>
    <div>
        <h4 class="text-sm font-bold text-green-800">Berhasil!</h4>
        <p class="text-sm text-green-600 mt-0.5">{{ session('success') }}</p>
    </div>
</div>
@endif

@if(session('error'))
<div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 flex items-start gap-3 max-w-2xl">
    <div class="mt-0.5 text-red-600"><i data-lucide="alert-circle" class="w-5 h-5"></i></div>
    <div>
        <h4 class="text-sm font-bold text-red-800">Terjadi Kesalahan!</h4>
        <p class="text-sm text-red-600 mt-0.5">{{ session('error') }}</p>
    </div>
</div>
@endif

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden max-w-2xl">
    
    <form action="#" method="POST" class="p-6 md:p-8 space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Transaksi <span class="text-red-500">*</span></label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="calendar" class="w-4 h-4 {{ $errors->has('tanggal') ? 'text-red-400' : 'text-slate-400' }}"></i>
                </div>
                <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required 
                    class="block w-full pl-11 pr-4 py-3 bg-white border rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 transition-all
                    {{ $errors->has('tanggal') ? 'border-red-300 focus:ring-red-500 focus:border-red-500 bg-red-50/30' : 'border-slate-200 focus:ring-blue-500 focus:border-transparent' }}">
            </div>
            @error('tanggal')
                <p class="mt-1.5 text-xs font-semibold text-red-500 flex items-center gap-1"><i data-lucide="info" class="w-3 h-3"></i> {{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Produk <span class="text-red-500">*</span></label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="package" class="w-4 h-4 {{ $errors->has('produk') ? 'text-red-400' : 'text-slate-400' }}"></i>
                </div>
                <select name="produk" required 
                    class="block w-full pl-11 pr-10 py-3 bg-white border rounded-xl text-sm text-slate-700 appearance-none focus:outline-none focus:ring-2 transition-all cursor-pointer
                    {{ $errors->has('produk') ? 'border-red-300 focus:ring-red-500 focus:border-red-500 bg-red-50/30' : 'border-slate-200 focus:ring-blue-500 focus:border-transparent' }}">
                    <option value="" disabled {{ old('produk') == '' ? 'selected' : '' }}>Pilih produk...</option>
                    <option value="indomie" {{ old('produk') == 'indomie' ? 'selected' : '' }}>Indomie Goreng</option>
                    <option value="telur" {{ old('produk') == 'telur' ? 'selected' : '' }}>Telur Ayam (10 butir)</option>
                    <option value="gula" {{ old('produk') == 'gula' ? 'selected' : '' }}>Gula Pasir 1kg</option>
                    <option value="beras" {{ old('produk') == 'beras' ? 'selected' : '' }}>Beras 5kg</option>
                    <option value="minyak" {{ old('produk') == 'minyak' ? 'selected' : '' }}>Minyak Goreng 2L</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                </div>
            </div>
            @error('produk')
                <p class="mt-1.5 text-xs font-semibold text-red-500 flex items-center gap-1"><i data-lucide="info" class="w-3 h-3"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah <span class="text-red-500">*</span></label>
                <input type="number" id="input-jumlah" name="jumlah" value="{{ old('jumlah') }}" min="1" placeholder="Misal: 10" required 
                    class="block w-full px-4 py-3 bg-white border rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 transition-all
                    {{ $errors->has('jumlah') ? 'border-red-300 focus:ring-red-500 focus:border-red-500 bg-red-50/30' : 'border-slate-200 focus:ring-blue-500 focus:border-transparent' }}">
                @error('jumlah')
                    <p class="mt-1.5 text-xs font-semibold text-red-500 flex items-center gap-1"><i data-lucide="info" class="w-3 h-3"></i> {{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                <input type="number" id="input-harga" name="harga_satuan" value="{{ old('harga_satuan') }}" min="0" placeholder="Misal: 5000" required 
                    class="block w-full px-4 py-3 bg-white border rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 transition-all
                    {{ $errors->has('harga_satuan') ? 'border-red-300 focus:ring-red-500 focus:border-red-500 bg-red-50/30' : 'border-slate-200 focus:ring-blue-500 focus:border-transparent' }}">
                @error('harga_satuan')
                    <p class="mt-1.5 text-xs font-semibold text-red-500 flex items-center gap-1"><i data-lucide="info" class="w-3 h-3"></i> {{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="p-4 bg-slate-50 border border-slate-100 rounded-xl mt-2">
            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                Estimasi Total Pendapatan
            </label>
            <input type="text" id="input-total" readonly placeholder="Rp0" 
                class="block w-full bg-transparent text-xl md:text-2xl font-extrabold text-slate-300 cursor-not-allowed focus:outline-none border-none p-0">
        </div>

        <div class="pt-6 border-t border-slate-100 flex justify-end">
            <button type="submit" class="w-full md:w-auto px-8 py-3 bg-blue-600 text-white font-bold text-sm rounded-xl hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 shadow-sm shadow-blue-600/30">
                <i data-lucide="save" class="w-4 h-4"></i> Simpan Data
            </button>
        </div>

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahInput = document.getElementById('input-jumlah');
        const hargaInput = document.getElementById('input-harga');
        const totalInput = document.getElementById('input-total');

        function hitungTotal() {
            const jumlah = parseFloat(jumlahInput.value) || 0;
            const harga = parseFloat(hargaInput.value) || 0;
            const total = jumlah * harga;

            if (total > 0) {
                totalInput.value = 'Rp' + total.toLocaleString('id-ID');
                totalInput.classList.remove('text-slate-300');
                totalInput.classList.add('text-blue-600'); 
            } else {
                totalInput.value = 'Rp0';
                totalInput.classList.add('text-slate-300');
                totalInput.classList.remove('text-blue-600');
            }
        }

        // Hitung otomatis saat diketik
        jumlahInput.addEventListener('input', hitungTotal);
        hargaInput.addEventListener('input', hitungTotal);

        // Jalankan hitungTotal saat halaman pertama dimuat
        hitungTotal();
    });
</script>
@endsection