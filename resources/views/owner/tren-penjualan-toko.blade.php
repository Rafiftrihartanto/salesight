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

            <div class="tren-toko-chart-placeholder">
                <canvas id="salesChart"></canvas>
            </div>

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

                @if(!$dataForwardTersedia)

                    <div class="tren-toko-empty">

                        Data transaksi tahun
                        <strong>{{ $tahun }}</strong>
                        belum dapat diproses menggunakan
                        Forward Chaining.

                        <br><br>

                        Penyebab:
                        <ul>
                            <li>Tidak memiliki tahun pembanding</li>
                            <li>Atau data tahun belum lengkap</li>
                        </ul>

                    </div>

                @else

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
                @endif

            </div>

            <!-- Insight Toko -->
            <div class="tren-toko-insight-card">

                <div class="tren-toko-section-title-wrapper">
                    <div class="tren-toko-section-title">Pertumbuhan Toko</div>
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
                                    Pertumbuhan Tertinggi
                                </div>

                                @if($dataForwardTersedia)
                                <div class="tren-toko-insight-value">
                                    {{ $pertumbuhanTertinggi->shopping_mall }}
                                </div>
                                <div class="tren-toko-insight-growth positive">
                                    +{{ number_format(
                                        $pertumbuhanTertinggi->growth_percent,
                                        2
                                    ) }}%
                                </div>
                                @else
                                <div class="tren-toko-insight-growth positive">
                                    -
                                </div>
                                @endif
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
                                    Penurunan Terbesar
                                </div>
                                <div class="tren-toko-insight-value">
                                     @if($dataForwardTersedia)
                                        {{ $penurunanTerbesar->shopping_mall }}
                                    @else
                                        
                                    @endif
                                </div>

                                <div class="tren-toko-insight-growth negative">
                                    @if($dataForwardTersedia)
                                        {{ number_format(
                                            $penurunanTerbesar->growth_percent,
                                            2
                                        ) }}%
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const labels = @json($chartLabels);
const datasets = @json($chartDatasets);

new Chart(
    document.getElementById('salesChart'),
    {
        type: 'line',

        data: {
            labels: labels,

            datasets: datasets.map(item => ({
                label: item.label,
                data: item.data,
                borderWidth: 2,
                tension: 0.3,
                fill: false
            }))
        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: true
                }
            },

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    }
);

</script>

@endsection