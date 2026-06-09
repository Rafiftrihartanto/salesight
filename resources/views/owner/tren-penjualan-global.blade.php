@extends('layouts.owner')

@section('content')

<div class="tren-global-content">

    <div class="tren-global-header">
        <div class="tren-global-title">Tren Penjualan Global</div>
        <div class="tren-global-subtitle">Analisis tren penjualan keseluruhan semua cabang</div>
    </div>

    <div class="tren-global-chart-card">
        <div class="tren-global-chart-header">
            <div class="tren-global-card-title">Grafik Tren Tahunan</div>
            <form method="GET" action="{{ route('owner.tren-global') }}">
                <select name="tahun" onchange="this.form.submit()" class="tren-global-year-select">
                    @foreach($tahunList as $itemTahun)
                        <option value="{{ $itemTahun }}" {{ $tahun == $itemTahun ? 'selected' : '' }}>
                            Tahun {{ $itemTahun }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="tren-global-chart-wrapper">
            <canvas id="globalSalesChart"></canvas>
        </div>
    </div>

    <div class="tren-global-bottom-cards">

        <div class="tren-global-info-card">
            <div class="tren-global-info-title">Perbandingan Penjualan</div>

            <div class="tren-global-comparison active">
                <div class="tren-global-comparison-title">Tahun Dipilih — {{ $labelBulanIni }}</div>
                <div class="tren-global-comparison-value">
                    Rp {{ number_format($penjualanBulanIni, 0, ',', '.') }}
                </div>
            </div>

            <div class="tren-global-comparison">
                <div class="tren-global-comparison-title gray">Tahun Sebelumnya — {{ $labelBulanLalu }}</div>
                <div class="tren-global-comparison-value">
                    Rp {{ number_format($penjualanBulanLalu, 0, ',', '.') }}
                </div>
            </div>

            <div class="tren-global-alert">
                <div class="tren-global-alert-text">
                    <i data-lucide="info" style="width:16px; height:16px; display:inline-block; vertical-align:middle; margin-right:4px;"></i>
                    {{ $statusPerbandingan }}
{{ number_format(abs($persentaseSelisih), 1) }}% dibanding {{ $labelBulanLalu }}
                </div>
            </div>
        </div>

        <div class="tren-global-info-card">
            <div class="tren-global-info-title">Insight Penjualan ({{ $tahun }})</div>

            <div class="tren-global-insight warning">
                <div class="tren-global-insight-top">
                    <div class="tren-global-icon orange">
                        <i data-lucide="trending-up" style="color: white; width: 20px; height: 20px;"></i>
                    </div>
                    <div class="tren-global-insight-text orange-text">Bulan Penjualan Tertinggi</div>
                </div>
                <div class="tren-global-insight-detail">
                    <div class="tren-global-insight-month">{{ $labelTertinggi }}</div>
                    <div class="tren-global-insight-sales">Rp{{ number_format($nilaiTertinggi, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="tren-global-insight danger">
                <div class="tren-global-insight-top">
                    <div class="tren-global-icon red">
                        <i data-lucide="trending-down" style="color: white; width: 20px; height: 20px;"></i>
                    </div>
                    <div class="tren-global-insight-text red-text">Bulan Penjualan Terendah</div>
                </div>
                <div class="tren-global-insight-detail">
                    <div class="tren-global-insight-month">{{ $labelTerendah }}</div>
                    <div class="tren-global-insight-sales">Rp{{ number_format($nilaiTerendah, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="tren-global-average">
                <div class="tren-global-average-title">Growth Bulanan (%)</div>
                <div class="tren-global-average-grid">
                    @forelse($growthBulanan as $growth)
                        <div class="growth-badge {{ $growth['growth'] > 0 ? 'positive' : ($growth['growth'] < 0 ? 'negative' : 'neutral') }}">
                            <span class="month">{{ $growth['bulan'] }}</span>
                            <span class="val">{{ $growth['growth'] > 0 ? '+' : '' }}{{ $growth['growth'] }}%</span>
                        </div>
                    @empty
                        <span style="color:#94a3b8; font-size:12px; grid-column: span 4;">Belum ada tren pertumbuhan</span>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    const canvas = document.getElementById('globalSalesChart');
    
    const labels = {!! json_encode($chartLabels) !!};
    const salesData = {!! json_encode($chartSales) !!};

    new Chart(canvas, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Penjualan',
                data: salesData,
                borderColor: '#314cff',
                backgroundColor: 'rgba(49, 76, 255, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#314cff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.raw.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f1f5f9' },
                    border: { display: false },
                    ticks: {
                        callback: function(value) {
                            if(value >= 1000000) return 'Rp' + (value / 1000000) + 'Jt';
                            if(value >= 1000) return 'Rp' + (value / 1000) + 'Rb';
                            return value;
                        }
                    }
                },
                x: {
                    grid: { display: false },
                    border: { display: false }
                }
            }
        }
    });
});
</script>

@endsection