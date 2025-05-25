@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>

    <!-- Statistik Utama -->
    <div class="row mb-4">
        <!-- Total Barang Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBarang }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Penjualan Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Penjualan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPenjualan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Pendapatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Grafik Pendapatan Bulanan -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pendapatan Bulanan {{ date('Y') }}</h6>
                </div>
                <div class="card-body">
                    @if($penjualanBulanan->isNotEmpty())
                        <div class="chart-area">
                            <canvas id="monthlyRevenueChart" height="300"></canvas>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Tidak ada data penjualan untuk tahun ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Inventory Status -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Status Stok Barang</h6>
                </div>
                <div class="card-body">
                    @if($totalBarang > 0)
                        <h4 class="small font-weight-bold">Barang Stok Rendah <span class="float-right">{{ $barangLowStock->count() }}</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $barangLowStock->count() > 0 ? ($barangLowStock->count()/$totalBarang)*100 : 0 }}%"
                                aria-valuenow="{{ $barangLowStock->count() > 0 ? ($barangLowStock->count()/$totalBarang)*100 : 0 }}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Barang Habis <span class="float-right">{{ $barangOutOfStock->count() }}</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ $barangOutOfStock->count() > 0 ? ($barangOutOfStock->count()/$totalBarang)*100 : 0 }}%"
                                aria-valuenow="{{ $barangOutOfStock->count() > 0 ? ($barangOutOfStock->count()/$totalBarang)*100 : 0 }}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Tidak ada barang yang terdaftar dalam sistem.
                        </div>
                    @endif

                    <div class="mt-4">
                        @if($barangLowStock->count() > 0)
                            <div class="alert alert-warning">
                                <strong>Perhatian!</strong> Ada {{ $barangLowStock->count() }} barang dengan stok rendah.
                            </div>
                        @endif

                        @if($barangOutOfStock->count() > 0)
                            <div class="alert alert-danger">
                                <strong>Perhatian!</strong> Ada {{ $barangOutOfStock->count() }} barang yang habis.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if($penjualanBulanan->isNotEmpty())
<script>
    // Monthly Revenue Chart
    var ctx = document.getElementById('monthlyRevenueChart').getContext('2d');
    var monthlyRevenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Pendapatan',
                data: [
                    @foreach(range(1, 12) as $month)
                        @php
                            $found = false;
                            foreach($penjualanBulanan as $penjualan) {
                                if($penjualan->bulan == $month) {
                                    echo $penjualan->total_pendapatan . ',';
                                    $found = true;
                                    break;
                                }
                            }
                            if(!$found) echo '0,';
                        @endphp
                    @endforeach
                ],
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(78, 115, 223, 1)',
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                fill: 'origin'
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.raw.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
@endif
@endsection
