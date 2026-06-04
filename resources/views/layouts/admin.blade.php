<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salesight - Admin Panel</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Icon Library: Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased flex h-screen overflow-hidden">

    <!-- SIDEBAR KIRI -->
    <aside class="w-64 bg-white border-r border-slate-100 flex flex-col justify-between flex-shrink-0 h-screen">
        
        <!-- Bagian Atas: Logo & Menu -->
        <div>
            <!-- Logo Area (Persis seperti Owner) -->
            <div class="h-24 flex items-center px-6 border-b border-slate-50 mb-4">
                <div class="flex items-center gap-3">
                    <!-- Ikon Logo -->
                    <div class="w-11 h-11 bg-blue-600 rounded-[14px] shadow-lg shadow-blue-600/30 flex items-center justify-center text-white">
                        <i data-lucide="bar-chart-2" class="w-6 h-6"></i>
                    </div>
                    <!-- Teks Logo & Badge -->
                    <div class="flex flex-col justify-center">
                        <span class="text-[22px] font-extrabold tracking-tight text-slate-900 leading-none mb-1.5">Salesight</span>
                        <div class="flex">
                            <span class="bg-blue-50 text-blue-600 text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">
                                ADMIN
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Navigasi -->
            <div class="px-5">
                <p class="text-xs font-bold text-slate-400 tracking-wider mb-4 px-2">NAVIGASI</p>
                
                <nav class="space-y-1.5">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800 font-medium' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        <span class="text-sm">Dashboard</span>
                    </a>

                    <a href="{{ route('admin.transaksi') }}" 
                       class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.transaksi') ? 'bg-blue-50 text-blue-600 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800 font-medium' }}">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        <span class="text-sm">Data Transaksi</span>
                    </a>

                    <a href="{{ route('admin.input') }}" 
                       class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.input') ? 'bg-blue-50 text-blue-600 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800 font-medium' }}">
                        <i data-lucide="file-plus-2" class="w-5 h-5"></i>
                        <span class="text-sm">Input Data</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Bagian Bawah: Info Mode & Logout -->
        <div class="p-5 border-t border-slate-50">
            
            <!-- Info Card (Admin Mode) -->
            <div class="bg-blue-50/70 rounded-xl p-4 mb-4">
                <p class="text-sm font-bold text-blue-600 leading-tight">Admin Mode</p>
                <p class="text-[12px] text-slate-500 font-medium mt-0.5">Data entry & kelola transaksi</p>
            </div>

            <!-- Tombol Keluar -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf 
                <button type="submit" class="w-full flex items-center justify-center gap-2.5 px-4 py-2 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                    <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                </button>
            </form>
        </div>
        
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 overflow-y-auto w-full h-screen">
        <div class="p-8 lg:p-10">
            @yield('content')
        </div>
    </main>

    <!-- Initialize Icons -->
    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
</body>
</html>