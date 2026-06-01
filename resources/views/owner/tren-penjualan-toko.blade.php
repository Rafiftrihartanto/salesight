@extends('layouts.owner')

@section('content')

<div class="tren-toko-content">

    <div class="tren-toko-section">

        <!-- Header Page -->
        <div class="tren-toko-page-header">
            <div class="tren-toko-heading">
                <div class="tren-toko-title">Tren Penjualan Toko</div>
            </div>

            <div class="tren-toko-paragraph">
                <p class="tren-toko-subtitle">Analisis tren penjualan per cabang</p>
            </div>
        </div>

        <!-- Chart Card -->
        <div class="tren-toko-card">

            <div class="tren-toko-card-header">
                <div class="tren-toko-card-title-group">
                    <div class="tren-toko-card-title-wrapper">
                        <div class="tren-toko-card-title">Tren Penjualan per Toko</div>
                    </div>

                    <div class="tren-toko-card-subtitle-wrapper">
                        <div class="tren-toko-card-subtitle">
                            Perbandingan penjualan antar cabang
                        </div>
                    </div>
                </div>
            </div>

            <div class="tren-toko-chart-placeholder"></div>

            <!-- Dropdown Filter -->
            <div class="tren-toko-filter-frame">

            <form
                method="GET"
                action="{{ route('owner.tren-toko') }}"
                style="display:flex; gap:10px;"
            >

                <!-- Tahun -->
                <select
                    name="tahun"
                    onchange="this.form.submit()"
                    class="tren-toko-year-select"
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

                <!-- Toko -->
                <select
                    name="toko"
                    onchange="this.form.submit()"
                    class="tren-toko-year-select"
                >

                    <option value="all">
                        Semua Toko
                    </option>

                    @foreach($tokoList as $itemToko)

                        <option
                            value="{{ $itemToko }}"
                            {{ $toko == $itemToko ? 'selected' : '' }}
                        >
                            {{ $itemToko }}
                        </option>

                    @endforeach

                </select>

            </form>

        </div>

        </div>

        <!-- Bottom Cards -->
        <div class="tren-toko-bottom-wrapper">
        
            <!-- Status Cabang -->
            <div class="tren-toko-status-card">

                <div class="tren-toko-section-title-wrapper">
                    <div class="tren-toko-section-title">Status Toko</div>
                </div>

                <div class="tren-toko-status-scroll">

                    @foreach($statusCabang as $item)

                    <div class="tren-toko-status-item">

                        <div class="
                            tren-toko-status-dot
                            @if($item->status_toko == 'Naik')
                                green
                            @elseif($item->status_toko == 'Turun')
                                red
                            @else
                                orange
                            @endif
                        ">
                        </div>

                        <div class="tren-toko-status-name-wrapper">

                            <div class="tren-toko-status-name">
                                {{ $item->shopping_mall }}
                            </div>

                        </div>

                        <div class="
                            tren-toko-status-badge
                            @if($item->status_toko == 'Naik')
                                badge-naik
                            @elseif($item->status_toko == 'Turun')
                                badge-turun
                            @else
                                badge-stagnan
                            @endif
                        ">

                            <div class="tren-toko-status-text">
                                {{ $item->status_toko }}
                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

            <!-- Insight Toko -->
            <div class="tren-toko-insight-card">

                <div class="tren-toko-section-title-wrapper">
                    <div class="tren-toko-section-title">Insight Toko</div>
                </div>

                <div class="tren-toko-insight-list">

                    <div class="tren-toko-insight-box blue-box">

                        <div class="tren-toko-insight-header">
                            <div class="tren-toko-insight-icon-wrapper blue-icon">
                                <div class="tren-toko-insight-icon">
                                    <img class="tren-toko-vector" src="{{ asset('img/ptinggi.png') }}" alt="">
                                </div>
                            </div>

                            <div class="tren-toko-insight-text-wrapper">
                                <div class="tren-toko-insight-title blue-text">
                                    Toko Penjualan Tertinggi
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tren-toko-insight-box yellow-box">

                        <div class="tren-toko-insight-header">
                            <div class="tren-toko-insight-icon-wrapper yellow-icon">
                                <div class="tren-toko-insight-icon">
                                    <img class="tren-toko-vector" src="{{ asset('img/prendah.png') }}" alt="">
                                </div>
                            </div>

                            <div class="tren-toko-insight-text-wrapper small">
                                <div class="tren-toko-insight-title yellow-text">
                                    Toko Aktif Terendah
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection