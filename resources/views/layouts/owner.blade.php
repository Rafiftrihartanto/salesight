<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salesight Owner</title>

    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owner-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owner-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owner-tren-global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tren-penjualan-toko.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owner-kontribusi-toko.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owner-kelola-cabang.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owner-daftar-toko.css') }}">
    </head>
<body>
    <div class="layout-wrapper">
        
        @include('sidebar.owner-sidebar')
        
        <div class="main-content">
            <main>
                @yield('content')
            </main>
        </div>

    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
    
    @yield('scripts')
</body>
</html>