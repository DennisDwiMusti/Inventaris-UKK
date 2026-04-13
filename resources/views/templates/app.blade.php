<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Template - SMK Wikrama</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #3b82f6;
            --sidebar-text: #cbd5e1;
            --sidebar-muted: #64748b;

            --body-bg: #f1f5f9;
            --surface-white: #ffffff;

            --text-main: #0f172a;
            --text-muted: #475569;

            --primary: #3b82f6;
            --danger: #ef4444;
            --danger-hover: #fee2e2;
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
            box-shadow: 4px 0 15px rgba(0,0,0,0.05);
            z-index: 10;
        }

        .sidebar-menu {
            list-style: none;
            padding: 24px 0;
        }

        .menu-section {
            padding: 24px 24px 8px;
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--sidebar-muted);
            letter-spacing: 1.2px;
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
            font-size: 0.95rem;
            font-weight: 500;
            border-radius: 8px;
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
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }

        .sidebar-link i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 12px;
            text-align: center;
            opacity: 0.9;
        }

        .dropdown-btn {
            justify-content: space-between;
        }

        .dropdown-btn .fa-chevron-right {
            font-size: 0.75rem;
            margin-right: 0;
            transition: transform 0.3s ease;
            opacity: 0.7;
        }

        .dropdown-btn.active .fa-chevron-right {
            transform: rotate(90deg);
        }

        .dropdown-container {
            display: none;
            list-style: none;
            margin-top: 4px;
            margin-bottom: 8px;
        }

        .dropdown-container.show {
            display: block;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-item {
            padding: 2px 16px;
        }

        .dropdown-item a {
            display: flex;
            align-items: center;
            padding: 10px 16px 10px 52px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.9rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .dropdown-item a:hover, .dropdown-item a.active {
            background-color: rgba(255, 255, 255, 0.05);
            color: white;
        }

        .main-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-y: auto;
        }

        .hero-header {
            background-image: linear-gradient(to right, rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.4)), url('{{ asset('assets/images/bgtemplate.png') }}');
            background-size: cover;
            background-position: center;
            height: 240px;
            color: white;
            padding: 32px 48px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .hero-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .welcome-section {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .welcome-logo {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            padding: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            object-fit: contain;
        }

        .welcome-text h2 {
            font-size: 1.6rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.3px;
        }

        .welcome-text p {
            color: #cbd5e1;
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .hero-right {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hero-right i {
            font-size: 0.85rem;
        }

        .sub-navbar {
            background-color: var(--surface-white);
            padding: 12px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            position: relative;
            z-index: 5;
        }

        .sub-nav-left p {
            color: var(--text-muted);
            font-weight: 500;
            margin: 0;
            font-size: 0.95rem;
        }

        .user-dropdown {
            position: relative;
        }

        .sub-nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            color: var(--text-main);
            padding: 6px 12px 6px 6px;
            border-radius: 30px;
            border: 1px solid transparent;
            transition: all 0.2s;
        }

        .sub-nav-right:hover, .sub-nav-right.active {
            background-color: var(--body-bg);
            border-color: #e2e8f0;
        }

        .sub-nav-right .fa-user-circle {
            font-size: 2rem;
            color: var(--sidebar-muted);
        }

        .sub-nav-right span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .sub-nav-right .fa-chevron-down {
            font-size: 0.7rem;
            color: var(--text-muted);
            transition: transform 0.3s ease;
            margin-left: 4px;
        }

        .sub-nav-right.active .fa-chevron-down {
            transform: rotate(180deg);
        }

        .user-dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background-color: var(--surface-white);
            min-width: 200px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1);
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 8px;
            z-index: 100;
            animation: fadeIn 0.2s ease-out;
        }

        .user-dropdown-menu.show {
            display: block;
        }

        .user-dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            color: var(--danger);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .user-dropdown-item i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .user-dropdown-item:hover {
            background-color: var(--danger-hover);
            color: #b91c1c;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .content-area {
            padding: 32px 48px;
            flex-grow: 1;
        }

    </style>
</head>
<body>

    <aside class="sidebar">
        <ul class="sidebar-menu">
            <div class="menu-section">Menu</div>
            <li class="sidebar-item">
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <div class="menu-section">Items Data</div>
            <li class="sidebar-item">
                <a href="{{ route('categories.index') }}" class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('items.index') }}" class="sidebar-link {{ request()->routeIs('items.*') ? 'active' : '' }}">
                    <i class="fas fa-boxes"></i>
                    <span>Items</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-handshake"></i>
                    <span>Lending</span>
                </a>
            </li>

            <div class="menu-section">Accounts</div>
            <li class="sidebar-item">
                <div class="sidebar-link dropdown-btn {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <div style="display: flex; align-items: center;">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </div>
                <ul class="dropdown-container {{ request()->routeIs('users.*') ? 'show' : '' }}">
                    <li class="dropdown-item">
                        <a href="{{ route('users.index', ['role' => 'admin']) }}" class="{{ request('role') == 'admin' ? 'active' : '' }}">Admin</a>
                    </li>
                    <li class="dropdown-item">
                        <a href="{{ route('users.index', ['role' => 'staf']) }}" class="{{ request('role') == 'staf' ? 'active' : '' }}">Operator</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>

    <main class="main-wrapper">

        <header class="hero-header">
            <div class="hero-left">
                <div class="welcome-section">
                    <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="Logo" class="welcome-logo" onerror="this.style.display='none'">
                    <div class="welcome-text">
                        <h2>Welcome Back, Admin Wikrama</h2>
                        <p>Inventory Management System</p>
                    </div>
                </div>
            </div>
            <div class="hero-right">
                <i class="far fa-calendar-alt"></i>
                {{ date('d F, Y') }}
            </div>
        </header>

        <nav class="sub-navbar">
            <div class="sub-nav-left">
                <p>Check menu in sidebar</p>
            </div>

            <div class="user-dropdown">
                <div class="sub-nav-right" id="userDropdownBtn">
                    <i class="far fa-user-circle"></i>
                    <span>Admin Wikrama</span>
                    <i class="fas fa-chevron-down"></i>
                </div>

                <div class="user-dropdown-menu" id="userDropdownMenu">
                    <a href="{{ route('logout') }}" class="user-dropdown-item">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
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
            var sidebarDropdownBtns = document.querySelectorAll(".sidebar .dropdown-btn");

            sidebarDropdownBtns.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    dropdownContent.classList.toggle("show");
                });
            });

            var userBtn = document.getElementById("userDropdownBtn");
            var userMenu = document.getElementById("userDropdownMenu");

            userBtn.addEventListener("click", function(event) {
                event.stopPropagation();
                userMenu.classList.toggle("show");
                this.classList.toggle("active");
            });

            window.addEventListener("click", function(event) {
                if (!event.target.matches('#userDropdownBtn') && !event.target.closest('#userDropdownBtn')) {
                    if (userMenu.classList.contains('show')) {
                        userMenu.classList.remove('show');
                        userBtn.classList.remove('active');
                    }
                }
            });
        });
    </script>
</body>
</html>
