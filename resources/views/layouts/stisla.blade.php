<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>FinTrack - @yield('title', 'Dashboard')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/stisla/2.3.0/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/stisla/2.3.0/css/components.css">
    
    <!-- Custom CSS -->
    <style>
        body { 
            font-family: 'Nunito', 'Segoe UI', sans-serif; 
            background-color: #f4f6f9; 
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                    <h5 class="navbar-brand text-white mb-0">FinTrack Dashboard</h5>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=6777ef&color=fff" class="rounded-circle mr-1" style="width: 30px;">
                            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('dashboard') }}">FinTrack</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('dashboard') }}">FT</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Menu</li>
                        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu-header">Data</li>
                        <li class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-tags"></i><span>Kategori</span></a>
                        </li>
                        <li class="{{ request()->routeIs('wallets.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('wallets.index') }}"><i class="fas fa-wallet"></i><span>Wallet</span></a>
                        </li>
                        <li class="{{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('transactions.index') }}"><i class="fas fa-exchange-alt"></i><span>Transaksi</span></a>
                        </li>
                    </ul>
                </aside>
            </div>

            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('page-title', 'Dashboard')</h1>
                    </div>
                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2026 FinTrack
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stisla/2.3.0/js/stisla.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stisla/2.3.0/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stisla/2.3.0/js/custom.js"></script>
</body>
</html>