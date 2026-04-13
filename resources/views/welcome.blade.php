<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inventory Management - SMK Wikrama</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,800&display=swap" rel="stylesheet" />

        <style>
            :root {
                --primary-blue: #3b82f6;
                --primary-hover: #2563eb;
                --text-dark: #0f172a;
                --text-muted: #64748b;
                --bg-light: #f8fafc;
            }

            body {
                font-family: 'Figtree', sans-serif;
                background-color: #ffffff;
                margin: 0;
                padding: 0;
                color: var(--text-dark);
                line-height: 1.6;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px 0;
                position: sticky;
                top: 0;
                background-color: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                z-index: 900;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
            }

            .header-left, .header-right {
                display: flex;
                align-items: center;
            }

            .header-logo {
                height: 50px;
                width: auto;
                transition: transform 0.3s ease;
            }

            .header-logo:hover {
                transform: scale(1.05);
            }

            .login-btn {
                background-color: #2196f3;
                color: white;
                padding: 10px 28px;
                text-decoration: none;
                border-radius: 4px;
                font-weight: 500;
                transition: all 0.3s ease;
                cursor: pointer;
                border: none;
                font-size: 1rem;
            }

            .login-btn:hover {
                background-color: #1976d2;
            }

            .main-section {
                text-align: center;
                padding: 80px 0 40px;
            }

            .main-title {
                font-size: 3rem;
                font-weight: 800;
                color: var(--text-dark);
                margin-bottom: 10px;
                line-height: 1.2;
            }

            .main-subtitle {
                font-size: 1.1rem;
                color: var(--text-muted);
                max-width: 600px;
                margin: 0 auto 40px auto;
                font-weight: 400;
            }

            .main-image {
                width: 100%;
                max-width: 750px;
                height: auto;
                display: block;
                margin: 0 auto;
            }

            .workflow-section {
                text-align: center;
                padding: 60px 0 80px;
            }

            .workflow-title {
                font-size: 2.5rem;
                font-weight: 600;
                color: var(--text-dark);
                margin-bottom: 5px;
            }

            .workflow-subtitle {
                font-size: 1.1rem;
                color: var(--text-muted);
                margin-bottom: 50px;
            }

            .workflow-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 25px;
            }

            .grid-item {
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .panel {
                aspect-ratio: 1 / 1;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 20px;
                overflow: hidden;
            }

            .panel img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .panel-text {
                font-size: 1.15rem;
                font-weight: 500;
                color: var(--text-dark);
                margin: 0;
            }
            .footer-wrapper {
                background-color: #fcfcfc;
                border-top: 1px solid #f0f0f0;
                padding: 50px 0 30px 0;
            }

            .footer {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 40px;
            }

            .footer-col {
                display: flex;
                flex-direction: column;
            }

            .footer-logo {
                width: 70px;
                height: auto;
                margin-bottom: 15px;
            }

            .footer-col p {
                color: var(--text-muted);
                margin: 4px 0;
                font-size: 1rem;
            }

            .footer-col h3 {
                font-size: 1.2rem;
                color: var(--text-dark);
                margin-top: 0;
                margin-bottom: 20px;
                font-weight: 600;
            }

            .footer-links {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .footer-links li {
                margin-bottom: 12px;
            }

            .footer-links a {
                text-decoration: none;
                color: var(--text-muted);
                font-size: 1rem;
            }

            .footer-links a.highlight-red {
                color: #dc2626;
            }

            .modal-overlay {
                display: none;
                position: fixed;
                z-index: 9999;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                align-items: center;
                justify-content: center;
                animation: fadeIn 0.3s ease;
            }

            .modal-content {
                background-color: #fff;
                padding: 40px;
                border-radius: 8px;
                width: 100%;
                max-width: 450px;
                box-shadow: 0 15px 30px rgba(0,0,0,0.2);
                animation: slideDown 0.3s ease;
            }

            .modal-title {
                text-align: center;
                font-size: 2rem;
                font-weight: 600;
                margin-top: 0;
                margin-bottom: 30px;
                color: #1a1a1a;
            }

            .form-group {
                margin-bottom: 20px;
                text-align: left;
            }

            .form-group label {
                display: block;
                font-size: 1rem;
                color: #333;
                margin-bottom: 8px;
                font-weight: 500;
            }

            .form-group input {
                width: 100%;
                padding: 12px 15px;
                font-size: 0.95rem;
                border: 1px solid #e4e4e7;
                border-radius: 4px;
                background-color: #fafafa;
                box-sizing: border-box;
            }

            .form-group input:focus {
                outline: none;
                border-color: #4bdba3;
                box-shadow: 0 0 0 2px rgba(75, 219, 163, 0.2);
            }

            .modal-actions {
                display: flex;
                gap: 15px;
                margin-top: 30px;
            }

            .modal-btn {
                padding: 10px 24px;
                border: none;
                border-radius: 4px;
                font-size: 1rem;
                font-weight: 500;
                cursor: pointer;
                transition: opacity 0.2s;
                color: white;
            }

            .modal-btn:hover {
                opacity: 0.9;
            }

            .btn-close {
                background-color: #ff7849;
            }

            .btn-submit {
                background-color: #4bdba3;
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            @keyframes slideDown {
                from { transform: translateY(-30px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header class="header">
                <div class="header-left">
                    <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="Logo SMK Wikrama" class="header-logo">
                </div>
                <div class="header-right">
                    <button class="login-btn" id="openLoginBtn">Login</button>
                </div>
            </header>

            <section class="main-section">
                <h1 class="main-title">Inventory Management of<br>SMK Wikrama</h1>
                <p class="main-subtitle">Management of incoming and outgoing items at SMK Wikrama Bogor.</p>
                <img src="{{ asset('assets/images/main-image.png') }}" alt="Main Inventory Illustration" class="main-image">
            </section>

            <section class="workflow-section">
                <h2 class="workflow-title">Our system flow</h2>
                <p class="workflow-subtitle">Our inventory system workflow</p>

                <div class="workflow-grid">
                    <div class="grid-item">
                        <div class="panel">
                            <img src="{{ asset('assets/images/item-data.png') }}" alt="Items Data Icon">
                        </div>
                        <p class="panel-text">Items Data</p>
                    </div>

                    <div class="grid-item">
                        <div class="panel">
                            <img src="{{ asset('assets/images/technician.png') }}" alt="Management Technician Icon">
                        </div>
                        <p class="panel-text">Management Technician</p>
                    </div>

                    <div class="grid-item">
                        <div class="panel">
                            <img src="{{ asset('assets/images/management.png') }}" alt="Managed Lending Icon">
                        </div>
                        <p class="panel-text">Managed Lending</p>
                    </div>

                    <div class="grid-item">
                        <div class="panel">
                            <img src="{{ asset('assets/images/area.png') }}" alt="All Can Borrow Icon">
                        </div>
                        <p class="panel-text">All Can Borrow</p>
                    </div>
                </div>
            </section>
        </div>

        <div class="footer-wrapper">
            <div class="container">
                <footer class="footer">
                    <div class="footer-col">
                        <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="Logo SMK Wikrama" class="footer-logo">
                        <p>smkwikrama@sch.id</p>
                        <p>001-7876-2876</p>
                    </div>
                    <div class="footer-col">
                        <h3>Our Guidelines</h3>
                        <ul class="footer-links">
                            <li><a href="#">Terms</a></li>
                            <li><a href="#" class="highlight-red">Privacy policy</a></li>
                            <li><a href="#">Cookie Policy</a></li>
                            <li><a href="#">Discover</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h3>Our address</h3>
                        <p>Jalan Wangun Tengah</p>
                        <p>Sindangsari</p>
                        <p>Jawa Barat</p>
                    </div>
                </footer>
            </div>
        </div>

        <div id="loginModal" class="modal-overlay">
            <div class="modal-content">
                <h2 class="modal-title">Login</h2>
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    @error('email')
                        <div style="color: #ef4444; margin-bottom: 15px; font-size: 0.9rem; text-align: center;">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" required autocomplete="current-password">
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="modal-btn btn-close" id="closeModalBtn">Close</button>
                        <button type="submit" class="modal-btn btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Tangkap elemen-elemen yang dibutuhkan
                const openBtn = document.getElementById('openLoginBtn');
                const closeBtn = document.getElementById('closeModalBtn');
                const modal = document.getElementById('loginModal');

                // Pastikan tombol Login ada sebelum menambahkan event (mencegah JS error)
                if (openBtn) {
                    openBtn.addEventListener('click', function(e) {
                        e.preventDefault(); // Mencegah aksi default
                        modal.style.display = 'flex';
                    });
                }

                // Pastikan tombol Close ada
                if (closeBtn) {
                    closeBtn.addEventListener('click', function() {
                        modal.style.display = 'none';
                    });
                }

                // Menutup modal jika area gelap di luar kotak form diklik
                window.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                    }
                });

                // Membuka modal secara otomatis JIKA ada error validasi dari Laravel
                @if($errors->any())
                    if (modal) {
                        modal.style.display = 'flex';
                    }
                @endif
            });
        </script>
    </body>
</html>
