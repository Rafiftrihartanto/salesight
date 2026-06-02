@extends('layouts.owner')

@section('content')

<div class="dt-wrapper">
    
    <!-- HEADER -->
    <div class="dt-header">
        <div class="dt-title-group">
            <h1 class="dt-title">Daftar Toko</h1>
            <p class="dt-subtitle">Profil dan performa semua cabang bisnis Salesight</p>
        </div>
        <a href="{{ route('owner.kelola-cabang') }}" class="dt-btn-primary">
            <i data-lucide="git-branch"></i> Kelola Cabang
        </a>
    </div>

    <!-- GRID DAFTAR TOKO -->
    <div class="dt-grid">
        
        <!-- CARD 1: Biru (Toko Jakarta Pusat) -->
        <div class="dt-card theme-blue">
            <div class="dt-card-top">
                <div class="dt-avatar">J</div>
                <div class="dt-info">
                    <h3>Toko Jakarta Pusat</h3>
                    <p><i data-lucide="map-pin"></i> Jakarta Pusat, DKI Jakarta</p>
                </div>
            </div>
            
            <div class="dt-badges">
                <span class="dt-badge-status"><span class="dot"></span> Aktif</span>
                <span class="dt-badge-top"><i data-lucide="trophy"></i> Top Store</span>
            </div>

            <div class="dt-stats">
                <div class="dt-stat-item">
                    <p>TOTAL PENJUALAN</p>
                    <h4>Rp654jt</h4>
                </div>
                <div class="dt-stat-item">
                    <p>TRANSAKSI</p>
                    <h4>4.440</h4>
                </div>
            </div>

            <div class="dt-highlight">
                <p>Penjualan Bulan Ini (Mei)</p>
                <h2>Rp47.800.000</h2>
            </div>

            <div class="dt-progress-container">
                <div class="dt-progress-text">
                    <span>Kontribusi</span>
                    <span>29.7%</span>
                </div>
                <div class="dt-progress-bar">
                    <div class="dt-progress-fill" style="width: 29.7%;"></div>
                </div>
            </div>

            <div class="dt-card-footer">
                <span class="dt-code">SLS-JKT-01</span>
                <span class="dt-avg"><i data-lucide="shopping-cart"></i> 147rb / txn</span>
            </div>
        </div>

        <!-- CARD 2: Kuning/Orange (Toko Surabaya) -->
        <div class="dt-card theme-orange">
            <div class="dt-card-top">
                <div class="dt-avatar">S</div>
                <div class="dt-info">
                    <h3>Toko Surabaya</h3>
                    <p><i data-lucide="map-pin"></i> Surabaya, Jawa Timur</p>
                </div>
            </div>
            
            <div class="dt-badges">
                <span class="dt-badge-status"><span class="dot"></span> Aktif</span>
            </div>

            <div class="dt-stats">
                <div class="dt-stat-item">
                    <p>TOTAL PENJUALAN</p>
                    <h4>Rp555jt</h4>
                </div>
                <div class="dt-stat-item">
                    <p>TRANSAKSI</p>
                    <h4>3.712</h4>
                </div>
            </div>

            <div class="dt-highlight">
                <p>Penjualan Bulan Ini (Mei)</p>
                <h2>Rp40.000.000</h2>
            </div>

            <div class="dt-progress-container">
                <div class="dt-progress-text">
                    <span>Kontribusi</span>
                    <span>25.2%</span>
                </div>
                <div class="dt-progress-bar">
                    <div class="dt-progress-fill" style="width: 25.2%;"></div>
                </div>
            </div>

            <div class="dt-card-footer">
                <span class="dt-code">SLS-SBY-03</span>
                <span class="dt-avg"><i data-lucide="shopping-cart"></i> 150rb / txn</span>
            </div>
        </div>

        <!-- CARD 3: Hijau (Toko Bandung Kota) -->
        <div class="dt-card theme-green">
            <div class="dt-card-top">
                <div class="dt-avatar">B</div>
                <div class="dt-info">
                    <h3>Toko Bandung Kota</h3>
                    <p><i data-lucide="map-pin"></i> Bandung, Jawa Barat</p>
                </div>
            </div>
            
            <div class="dt-badges">
                <span class="dt-badge-status"><span class="dot"></span> Aktif</span>
            </div>

            <div class="dt-stats">
                <div class="dt-stat-item">
                    <p>TOTAL PENJUALAN</p>
                    <h4>Rp488jt</h4>
                </div>
                <div class="dt-stat-item">
                    <p>TRANSAKSI</p>
                    <h4>3.255</h4>
                </div>
            </div>

            <div class="dt-highlight">
                <p>Penjualan Bulan Ini (Mei)</p>
                <h2>Rp38.000.000</h2>
            </div>

            <div class="dt-progress-container">
                <div class="dt-progress-text">
                    <span>Kontribusi</span>
                    <span>22.2%</span>
                </div>
                <div class="dt-progress-bar">
                    <div class="dt-progress-fill" style="width: 22.2%;"></div>
                </div>
            </div>

            <div class="dt-card-footer">
                <span class="dt-code">SLS-BDG-02</span>
                <span class="dt-avg"><i data-lucide="shopping-cart"></i> 150rb / txn</span>
            </div>
        </div>

        <!-- CARD 4: Ungu (Toko Medan) -->
        <div class="dt-card theme-purple">
            <div class="dt-card-top">
                <div class="dt-avatar">M</div>
                <div class="dt-info">
                    <h3>Toko Medan</h3>
                    <p><i data-lucide="map-pin"></i> Medan, Sumatera Utara</p>
                </div>
            </div>
            
            <div class="dt-badges">
                <span class="dt-badge-status"><span class="dot"></span> Aktif</span>
            </div>

            <div class="dt-stats">
                <div class="dt-stat-item">
                    <p>TOTAL PENJUALAN</p>
                    <h4>Rp215jt</h4>
                </div>
                <div class="dt-stat-item">
                    <p>TRANSAKSI</p>
                    <h4>1.890</h4>
                </div>
            </div>

            <div class="dt-highlight">
                <p>Penjualan Bulan Ini (Mei)</p>
                <h2>Rp18.500.000</h2>
            </div>

            <div class="dt-progress-container">
                <div class="dt-progress-text">
                    <span>Kontribusi</span>
                    <span>14.5%</span>
                </div>
                <div class="dt-progress-bar">
                    <div class="dt-progress-fill" style="width: 14.5%;"></div>
                </div>
            </div>

            <div class="dt-card-footer">
                <span class="dt-code">SLS-MDN-05</span>
                <span class="dt-avg"><i data-lucide="shopping-cart"></i> 113rb / txn</span>
            </div>
        </div>

        <!-- CARD 5: Merah (Toko Yogyakarta) -->
        <div class="dt-card theme-red">
            <div class="dt-card-top">
                <div class="dt-avatar">Y</div>
                <div class="dt-info">
                    <h3>Toko Yogyakarta</h3>
                    <p><i data-lucide="map-pin"></i> Yogyakarta, DIY</p>
                </div>
            </div>
            
            <div class="dt-badges">
                <!-- Status nonaktif kini menggunakan bullet -->
                <span class="dt-badge-status status-nonaktif"><span class="dot"></span> Nonaktif</span>
            </div>

            <div class="dt-stats">
                <div class="dt-stat-item">
                    <p>TOTAL PENJUALAN</p>
                    <h4>Rp120jt</h4>
                </div>
                <div class="dt-stat-item">
                    <p>TRANSAKSI</p>
                    <h4>980</h4>
                </div>
            </div>

            <div class="dt-highlight">
                <p>Penjualan Bulan Ini (Mei)</p>
                <h2>Rp0</h2>
            </div>

            <div class="dt-progress-container">
                <div class="dt-progress-text">
                    <span>Kontribusi</span>
                    <span>8.4%</span>
                </div>
                <div class="dt-progress-bar">
                    <div class="dt-progress-fill" style="width: 8.4%;"></div>
                </div>
            </div>

            <div class="dt-card-footer">
                <span class="dt-code">SLS-YGY-04</span>
                <span class="dt-avg"><i data-lucide="shopping-cart"></i> 122rb / txn</span>
            </div>
        </div>

    </div>

</div>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

@endsection