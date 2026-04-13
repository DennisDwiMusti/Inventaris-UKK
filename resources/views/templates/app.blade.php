<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris - SMK Wikrama</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: #4f46e5;
            --sidebar-text: #94a3b8;

            --body-bg: #f8fafc;
            --surface-white: #ffffff;

            --text-main: #1e293b;
            --text-muted: #64748b;

            --primary: #4f46e5;
            --danger: #ef4444;
            --danger-hover: #fef2f2;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background-color: var(--body-bg);
            overflow: hidden;
            color: var(--text-main);
        }

        .sidebar {
            width: 280px;
            background-color: var(--sidebar-bg);
            color: white;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
        }

        .sidebar-menu {
            list-style: none;
            padding: 24px 0;
        }

        .menu-section {
            padding: 24px 28px 12px;
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            color: #475569;
            letter-spacing: 0.05em;
        }

        .sidebar-item {
            padding: 2px 16px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .sidebar-link:hover {
            background-color: var(--sidebar-hover);
            color: white;
        }

        .sidebar-link.active {
            background-color: var(--sidebar-active);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .sidebar-link i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 12px;
            text-align: center;
        }

        .dropdown-btn .fa-chevron-right {
            font-size: 0.7rem;
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .dropdown-btn.active .fa-chevron-right {
            transform: rotate(90deg);
        }

        .dropdown-container {
            display: none;
            list-style: none;
            margin-top: 4px;
            padding-left: 20px;
        }

        .dropdown-container.show {
            display: block;
        }

        .dropdown-item a {
            display: block;
            padding: 10px 16px 10px 32px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .dropdown-item a:hover, .dropdown-item a.active {
            color: white;
            background: rgba(255,255,255,0.05);
        }

        .main-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-y: auto;
        }

        .hero-header {
            background-image: linear-gradient(to bottom, rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.7)), url('{{ asset("assets/images/bgtemplate.png") }}');
            background-size: cover;
            background-position: center;
            min-height: 220px;
            color: white;
            padding: 40px 48px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .welcome-logo {
            width: 70;
            height: 70px;
            border-radius: 12px;
            padding: 5px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.2);
        }

        .welcome-text h2 {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.025em;
        }

        .date-badge {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 8px 18px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sub-navbar {
            background-color: var(--surface-white);
            padding: 0 48px;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            margin-top: -35px;
            margin-left: 48px;
            margin-right: 48px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            z-index: 10;
        }

        .sub-nav-left p {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .sub-nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 12px;
            transition: all 0.2s;
        }

        .sub-nav-right:hover {
            background: #f1f5f9;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #475569;
            font-weight: 800;
            font-size: 0.8rem;
        }

        .user-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            width: 180px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            margin-top: 8px;
            overflow: hidden;
        }

        .user-dropdown-menu.show { display: block; }

        .user-dropdown-item {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--danger);
            font-size: 0.9rem;
            font-weight: 600;
        }

        .user-dropdown-item:hover { background: var(--danger-hover); }

        .content-area {
            padding: 40px 48px;
            flex-grow: 1;
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <ul class="sidebar-menu">
            <div class="menu-section">Utama</div>
            <li class="sidebar-item">
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-grid-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <div class="menu-section">Data Inventaris</div>

            @if(Auth::check() && Auth::user()->role == 'admin')
            <li class="sidebar-item">
                <a href="{{ route('categories.index') }}" class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group"></i>
                    <span>Kategori</span>
                </a>
            </li>
            @endif

            <li class="sidebar-item">
                <a href="{{ route('items.index') }}" class="sidebar-link {{ request()->routeIs('items.*') ? 'active' : '' }}">
                    <i class="fas fa-boxes-stacked"></i>
                    <span>Barang</span>
                </a>
            </li>

            @if(Auth::check() && Auth::user()->role == 'operator')
            <li class="sidebar-item">
                <a href="{{ route('lendings.index') }}" class="sidebar-link {{ request()->routeIs('lendings.*') ? 'active' : '' }}">
                    <i class="fas fa-hand-holding-heart"></i>
                    <span>Peminjaman</span>
                </a>
            </li>
            @endif

            <div class="menu-section">Pengaturan Akun</div>
            <li class="sidebar-item">
                <div class="sidebar-link dropdown-btn {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fas fa-user-gear"></i>
                    <span>Manajemen User</span>
                    <i class="fas fa-chevron-right"></i>
                </div>
                <ul class="dropdown-container {{ request()->routeIs('users.*') ? 'show' : '' }}">

                    @if(Auth::check() && Auth::user()->role == 'admin')
                        <li class="dropdown-item">
                            <a href="{{ route('users.index', ['role' => 'admin']) }}" class="{{ request('role') == 'admin' ? 'active' : '' }}">Admin</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{ route('users.index', ['role' => 'operator']) }}" class="{{ request('role') == 'operator' ? 'active' : '' }}">Operator</a>
                        </li>
                    @elseif(Auth::check() && Auth::user()->role == 'operator')
                        <li class="dropdown-item">
                            <a href="{{ route('users.edit', Auth::user()->id) }}" class="{{ request()->routeIs('users.edit') ? 'active' : '' }}">
                                <span style="font-size: 1.2rem; margin-right: 6px; line-height: 1;">&bull;</span> Edit
                            </a>
                        </li>
                    @endif

                </ul>
            </li>
        </ul>
    </aside>
    <main class="main-wrapper">

        <header class="hero-header">
            <div style="display: flex; align-items: center; gap: 20px;">
                <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="Logo" class="welcome-logo" onerror="this.src='https://ui-avatars.com/api/?name=W&background=4f46e5&color=fff'">
                <div class="welcome-text">
                    <h2>Halo, {{ Auth::check() ? Auth::user()->name : 'Tamu' }}</h2>
                    <p style="opacity: 0.8; font-weight: 500;">Sistem Inventaris {{ Auth::check() ? '('.ucfirst(Auth::user()->role).')' : '' }}</p>
                </div>
            </div>
            <div class="date-badge">
                <i class="far fa-calendar-check"></i>
                {{ date('d F, Y') }}
            </div>
        </header>

        <nav class="sub-navbar">
            <div class="sub-nav-left">
                <p><i class="fas fa-chevron-left" style="font-size: 0.7rem; margin-right: 8px;"></i> Navigasi Menu</p>
            </div>

            <div style="position: relative;">
                <div class="sub-nav-right" id="userDropdownBtn">
                    <div class="user-avatar">{{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 2)) : '?' }}</div>
                    <span>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
                    <i class="fas fa-chevron-down" style="font-size: 0.7rem; color: #94a3b8;"></i>
                </div>

                <div class="user-dropdown-menu" id="userDropdownMenu">
                    <a href="{{ route('logout') }}" class="user-dropdown-item">
                        <i class="fas fa-power-off"></i> Logout Akun
                    </a>
                </div>
            </div>
        </nav>

        <section class="content-area">
            @yield('content')
        </section>

    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdownBtns = document.querySelectorAll(".dropdown-btn");
            dropdownBtns.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    this.classList.toggle("active");
                    var container = this.nextElementSibling;
                    container.classList.toggle("show");
                });
            });

            var userBtn = document.getElementById("userDropdownBtn");
            var userMenu = document.getElementById("userDropdownMenu");

            userBtn.addEventListener("click", function(e) {
                e.stopPropagation();
                userMenu.classList.toggle("show");
            });

            document.addEventListener("click", function() {
                userMenu.classList.remove("show");
            });
        });
    </script>
</body>
</html>
