<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi manajemen toko online untuk mengelola barang, penjualan, pembelian, dan laporan.">
    <title>{{ config('app.name', 'Toko Online') }} - @yield('title')</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-hover: #3a5bc7;
            --sidebar-width: 280px;
            --sidebar-bg: #ffffff;
            --sidebar-text: #4a4a4a;
            --sidebar-active: #f8f9fa;
            --sidebar-icon: #d1d3e2;
            --sidebar-icon-active: #4e73df;
            --content-bg: #ffffff; /* White background */
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--content-bg);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            position: fixed;
            height: 100vh;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all var(--transition-speed) ease;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            height: 4.375rem;
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-brand-text {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar-brand-text i {
            margin-right: 0.5rem;
        }

        .close-btn {
            display: none;
            background: none;
            color: #000000a5;
            border: none;
            border-radius: 50%;
            width: 2rem;
            height: 2rem;
            font-size: 1rem;
            line-height: 1;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
        }

        .sidebar-divider {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            margin: 1rem 0;
        }

        .sidebar-heading {
            padding: 0 1rem;
            font-weight: 600;
            font-size: 0.75rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.13em;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--sidebar-text);
            font-weight: 500;
            transition: all var(--transition-speed) ease;
            border-left: 0.25rem solid transparent;
        }

        .nav-link:hover {
            color: var(--primary-color);
            background-color: var(--sidebar-active);
        }

        .nav-link i {
            font-size: 0.85rem;
            margin-right: 0.5rem;
            color: var(--sidebar-icon);
        }

        .nav-link.active {
            color: var(--primary-color);
            background-color: var(--sidebar-active);
            border-left-color: var(--primary-color);
            font-weight: 600;
        }

        .nav-link.active i {
            color: var(--sidebar-icon-active);
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 1rem;
            scrollbar-width: thin;
            scrollbar-color: #d1d3e2 #f8f9fa;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: #f8f9fa;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: #d1d3e2;
            border-radius: 3px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: #b7b9cc;
        }

        .logout-btn {
            padding: 1rem;
            background-color: rgba(0, 0, 0, 0.03);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            transition: all var(--transition-speed) ease;
        }

        .top-navbar {
            height: 4.375rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            z-index: 100;
        }

        .content-header {
            padding: 1.5rem;
            background-color: transparent;
        }

        .content-container {
            padding: 1.5rem;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                width: 100%;
                margin-left: 0;
            }

            .sidebar-collapse-btn {
                display: inline-block !important;
            }

            .close-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        /* Toggle Button */
        .sidebar-collapse-btn {
            display: none;
            border: none;
            background: transparent;
            font-size: 1.25rem;
            color: #6c757d;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-fade {
            animation: fadeIn 0.5s ease-in-out;
        }

        .animate-zoom-in {
            animation: zoomIn 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Toastr customization */
        .toast {
            border-radius: 0.5rem !important;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar animate-zoom-in">
            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}" class="sidebar-brand-text">
                    <i class="fas fa-store"></i>
                    Toko Online
                </a>
                <button class="close-btn animate-slide-up">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="sidebar-nav">
                <div class="sidebar-divider"></div>
                <ul class="nav flex-column">
                    <li class="nav-item animate-slide-up">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" aria-current="{{ Route::is('dashboard') ? 'page' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-heading animate-slide-up">Master Data</li>
                    <li class="nav-item animate-slide-up">
                        <a href="{{ route('kategori.index') }}" class="nav-link {{ Route::is('kategori.*') ? 'active' : '' }}">
                            <i class="fas fa-tag"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li class="nav-item animate-slide-up">
                        <a href="{{ route('barang.index') }}" class="nav-link {{ Route::is('barang.*') ? 'active' : '' }}">
                            <i class="fas fa-box"></i>
                            <span>Barang</span>
                        </a>
                    </li>
                    <li class="nav-item animate-slide-up">
                        <a href="{{ route('supplier.index') }}" class="nav-link {{ Route::is('supplier.*') ? 'active' : '' }}">
                            <i class="fas fa-truck"></i>
                            <span>Supplier</span>
                        </a>
                    </li>
                    <li class="nav-item animate-slide-up">
                        <a href="{{ route('pembeli.index') }}" class="nav-link {{ Route::is('pembeli.*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            <span>Pembeli</span>
                        </a>
                    </li>

                    <li class="sidebar-heading animate-slide-up">Transaksi</li>
                    <li class="nav-item animate-slide-up">
                        <a href="{{ route('pembelian.index') }}" class="nav-link {{ Route::is('pembelian.*') ? 'active' : '' }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Pembelian</span>
                        </a>
                    </li>
                    <li class="nav-item animate-slide-up">
                        <a href="{{ route('penjualan.index') }}" class="nav-link {{ Route::is('penjualan.*') ? 'active' : '' }}">
                            <i class="fas fa-cash-register"></i>
                            <span>Penjualan</span>
                        </a>
                    </li>

                    <li class="sidebar-heading animate-slide-up">Laporan</li>
                    <li class="nav-item animate-slide-up">
                        <a href="{{ route('laporan.penjualan') }}" class="nav-link {{ Route::is('laporan.penjualan') ? 'active' : '' }}">
                            <i class="fas fa-chart-bar"></i>
                            <span>Laporan Penjualan</span>
                        </a>
                    </li>
                    <li class="nav-item animate-slide-up">
                        <a href="{{ route('laporan.stok') }}" class="nav-link {{ Route::is('laporan.stok') ? 'active' : '' }}">
                            <i class="fas fa-cubes"></i>
                            <span>Laporan Stok</span>
                        </a>
                    </li>
                    <li class="nav-item animate-slide-up">
                        <a href="{{ route('laporan.barang-terjual') }}" class="nav-link {{ Route::is('laporan.barang-terjual') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i>
                            <span>Barang Terjual</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="logout-btn animate-slide-up">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content animate-fade">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand top-navbar">
                <div class="container-fluid">
                    <button class="sidebar-collapse-btn" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="navbar-nav ms-auto">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>
                                <span>{{ Auth::user()->username }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content Header -->
            <div class="content-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">@yield('title')</h1>
                    @yield('breadcrumb')
                </div>
            </div>

            <!-- Main Content -->
            <div class="content-container">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Sidebar toggle functionality
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const closeBtn = document.querySelector('.close-btn');

        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });

        closeBtn.addEventListener('click', function() {
            sidebar.classList.remove('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                event.target !== sidebarToggle &&
                !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });

        // Toastr notifications
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 5000,
            extendedTimeOut: 2000,
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut'
        };

        @if(session('success'))
            toastr.success('{{ session('success') }}', 'Sukses');
        @endif

        @if(session('error'))
            toastr.error('{{ session('error') }}', 'Error');
        @endif

        // Active link indicator
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
