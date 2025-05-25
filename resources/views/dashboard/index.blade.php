@php
    // This is a comment to satisfy PHP block requirement
@endphp

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Statistik Utama -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Total Barang</h6>
                            <h4 class="mb-0">{{ $totalBarang }}</h4>
                        </div>
                        <div>
                            <i class="fas fa-box fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Total Penjualan</h6>
                            <h4 class="mb-0">{{ $totalPenjualan }}</h4>
                        </div>
                        <div>
                            <i class="fas fa-shopping-cart fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Total Pendapatan</h6>
                            <h4 class="mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                        </div>
                        <div>
                            <i class="fas fa-money-bill-wave fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Pendapatan Bulanan -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Pendapatan Bulanan {{ date('Y') }}</h5>
                    <!-- Add your chart or graph here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


