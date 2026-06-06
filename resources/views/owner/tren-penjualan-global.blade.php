@extends('layouts.owner')

@section('content')

<div class="tren-global-content">

    <!-- Header -->
    <div class="tren-global-header">

        <div class="tren-global-title">
            Tren Penjualan Global
        </div>

        <div class="tren-global-subtitle">
            Analisis tren penjualan keseluruhan semua cabang
        </div>

    </div>

    <!-- Chart Card -->
    <div class="tren-global-chart-card">

        <div class="tren-global-chart-header">

        <div>
            <div class="tren-global-card-title">
                Tren Penjualan Global
            </div>
        </div>

        <div>
            <form
                method="GET"
                action="{{ route('owner.tren-global') }}"
            >

                <select
                    name="tahun"
                    onchange="this.form.submit()"
                    class="tren-global-year-select"
                >

                    @foreach($tahunList as $itemTahun)

                        <option
                            value="{{ $itemTahun }}"
                            {{ $tahun == $itemTahun ? 'selected' : '' }}
                        >
                            {{ $itemTahun }}
                        </option>

                    @endforeach

                </select>

            </form>
        </div>

</div>

        <div class="tren-global-chart-placeholder">

        </div>

    </div>

    <!-- Bottom Cards -->
    <div class="tren-global-bottom-cards">

        <!-- Perbandingan Penjualan -->
        <div class="tren-global-info-card">

            <div class="tren-global-info-title">
                Perbandingan Penjualan
            </div>

            <div class="tren-global-comparison active">

                <div class="tren-global-comparison-title">
                    {{ $labelBulanIni }}
                </div>

                <div class="tren-global-comparison-value">
                    Rp {{ number_format($penjualanBulanIni, 0, ',', '.') }}
                </div>

            </div>

            <div class="tren-global-comparison">

                <div class="tren-global-comparison-title gray">
                    {{ $labelBulanLalu }}
                </div>

                <div class="tren-global-comparison-value">
                    Rp {{ number_format($penjualanBulanLalu, 0, ',', '.') }}
                </div>

            </div>

            <div class="tren-global-alert">
                <div class="tren-global-alert-text">

                    Selisih :

                    Rp {{ number_format($selisih, 0, ',', '.') }}

                </div>
            </div>

        </div>

        <!-- Insight Penjualan -->
        <div class="tren-global-info-card">

            <div class="tren-global-info-title">
                Insight Penjualan
            </div>

            <!-- Tertinggi -->
            <div class="tren-global-insight warning">

                <div class="tren-global-insight-top">

                    <div class="tren-global-icon orange">
                        <img src="{{ asset('img/BulanTertinggi.png') }}" alt="">
                    </div>

                    <div class="tren-global-insight-text orange-text">
                        Bulan Penjualan Tertinggi
                    </div>

                </div>

            </div>

            <!-- Terendah -->
            <div class="tren-global-insight danger">

                <div class="tren-global-insight-top">

                    <div class="tren-global-icon red">
                        <img src="{{ asset('img/BulanTerendah.png') }}" alt="">
                    </div>

                    <div class="tren-global-insight-text red-text">
                        Bulan Penjualan Terendah
                    </div>

                </div>

            </div>

            <!-- Rata-rata -->
            <div class="tren-global-average">

                <div class="tren-global-comparison-title">
                    Rata-rata Penjualan Bulanan
                </div>

                <div class="tren-global-average-value">
                    
                </div>

            </div>

        </div>

    </div>

</div>

@endsection