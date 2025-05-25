@php
    // This is a comment to satisfy PHP block requirement
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi manajemen toko online untuk mengelola barang, penjualan, pembelian, dan laporan.">
    <title>{{ config('app.name', 'Toko Online') }} - @yield('title')</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebarMenu" aria-label="Navigasi Utama">
                <div class="position-sticky">
                    <div class="text-center p-3 text-white">
                        <h4>Toko Online</h4>
                    </div>
                    <hr class="text-white">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" aria-current="{{ Route::is('dashboard') ? 'page' : '' }}">
                                <i class="fas fa-tachometer-alt me-2" aria-hidden="true"></i> Dashboard
                            </a>
                        </li>

                        <li class="nav-item mt-2">
                            <div class="text-white ps-3 pb-1">Master Data</div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kategori.index') }}" class="nav-link {{ Route::is('kategori.*') ? 'active' : '' }}" aria-current="{{ Route::is('kategori.*') ? 'page' : '' }}">
                                <i class="fas fa-tag me-2" aria-hidden="true"></i> Kategori
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('barang.index') }}" class="nav-link {{ Route::is('barang.*') ? 'active' : '' }}" aria-current="{{ Route::is('barang.*') ? 'page' : '' }}">
                                <i class="fas fa-box me-2" aria-hidden="true"></i> Barang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('supplier.index') }}" class="nav-link {{ Route::is('supplier.*') ? 'active' : '' }}" aria-current="{{ Route::is('supplier.*') ? 'page' : '' }}">
                                <i class="fas fa-truck me-2" aria-hidden="true"></i> Supplier
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pembeli.index') }}" class="nav-link {{ Route::is('pembeli.*') ? 'active' : '' }}" aria-current="{{ Route::is('pembeli.*') ? 'page' : '' }}">
                                <i class="fas fa-users me-2" aria-hidden="true"></i> Pembeli
                            </a>
                        </li>

                        <li class="nav-item mt-2">
                            <div class="text-white ps-3 pb-1">Transaksi</div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pembelian.index') }}" class="nav-link {{ Route::is('pembelian.*') ? 'active' : '' }}" aria-current="{{ Route::is('pembelian.*') ? 'page' : '' }}">
                                <i class="fas fa-shopping-cart me-2" aria-hidden="true"></i> Pembelian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penjualan.index') }}" class="nav-link {{ Route::is('penjualan.*') ? 'active' : '' }}" aria-current="{{ Route::is('penjualan.*') ? 'page' : '' }}">
                                <i class="fas fa-cash-register me-2" aria-hidden="true"></i> Penjualan
                            </a>
                        </li>

                        <li class="nav-item mt-2">
                            <div class="text-white ps-3 pb-1">Laporan</div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.penjualan') }}" class="nav-link {{ Route::is('laporan.penjualan') ? 'active' : '' }}" aria-current="{{ Route::is('laporan.penjualan') ? 'page' : '' }}">
                                <i class="fas fa-chart-bar me-2" aria-hidden="true"></i> Laporan Penjualan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.stok') }}" class="nav-link {{ Route::is('laporan.stok') ? 'active' : '' }}" aria-current="{{ Route::is('laporan.stok') ? 'page' : '' }}">
                                <i class="fas fa-cubes me-2" aria-hidden="true"></i> Laporan Stok
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.barang-terjual') }}" class="nav-link {{ Route::is('laporan.barang-terjual') ? 'active' : '' }}" aria-current="{{ Route::is('laporan.barang-terjual') ? 'page' : '' }}">
                                <i class="fas fa-chart-line me-2" aria-hidden="true"></i> Barang Terjual
                            </a>
                        </li>

                        <li class="nav-item mt-4">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-sign-out-alt me-2" aria-hidden="true"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Navbar for Mobile -->
                <nav class="navbar navbar-expand-md navbar-light bg-light d-md-none mb-3">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <span class="navbar-brand">{{ config('app.name', 'Toko Online') }}</span>
                    </div>
                </nav>

                <!-- Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title')</h1>
                    <div class="text-muted">
                        <i class="fas fa-user me-1" aria-hidden="true"></i> {{ Auth::user()->username }} ({{ ucfirst(Auth::user()->role) }})
                    </div>
                </div>

                <!-- Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('scripts')
</body>
</html>
