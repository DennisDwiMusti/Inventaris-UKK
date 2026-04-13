<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inventory Management - SMK Wikrama</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700,800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            :root {
                --primary: #4f46e5; /* Indigo 600 */
                --primary-hover: #4338ca;
                --text-dark: #0f172a;
                --text-muted: #64748b;
                --bg-light: #f8fafc;
            }

            body {
                font-family: 'Figtree', sans-serif;
                background-color: var(--bg-light);
                margin: 0;
                padding: 0;
                color: var(--text-dark);
                line-height: 1.6;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 24px;
            }

            /* Navbar */
            .header {
                padding: 20px 0;
                background-color: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(12px);
                position: sticky;
                top: 0;
                z-index: 1000;
                border-bottom: 1px solid #e2e8f0;
            }

            .header-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .header-logo {
                height: 45px;
                transition: transform 0.3s ease;
            }

            .login-btn {
                background-color: var(--primary);
                color: white;
                padding: 10px 24px;
                text-decoration: none;
                border-radius: 10px;
                font-weight: 600;
                transition: all 0.2s;
                border: none;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
            }

            .login-btn:hover {
                background-color: var(--primary-hover);
                transform: translateY(-1px);
            }

            /* Main Hero */
            .hero-section {
                padding: 80px 0 60px;
                text-align: center;
            }

            .main-title {
                font-size: 3.5rem;
                font-weight: 800;
                color: var(--text-dark);
                line-height: 1.1;
                margin-bottom: 20px;
                letter-spacing: -0.025em;
            }

            .main-title span {
                color: var(--primary);
            }

            .main-subtitle {
                font-size: 1.2rem;
                color: var(--text-muted);
                max-width: 650px;
                margin: 0 auto 50px;
            }

            .hero-image-container {
                background: white;
                padding: 15px;
                border-radius: 24px;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
                max-width: 850px;
                margin: 0 auto;
                border: 1px solid #e2e8f0;
            }

            .main-image {
                width: 100%;
                border-radius: 16px;
                display: block;
            }

            /* Workflow Cards */
            .workflow-section {
                padding: 100px 0;
                text-align: center;
            }

            .section-tag {
                color: var(--primary);
                font-weight: 700;
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 0.1em;
            }

            .workflow-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 24px;
                margin-top: 50px;
            }

            .workflow-card {
                background: white;
                padding: 32px;
                border-radius: 20px;
                border: 1px solid #e2e8f0;
                transition: all 0.3s ease;
            }

            .workflow-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
                border-color: var(--primary);
            }

            .card-icon {
                width: 64px;
                height: 64px;
                background: #f5f3ff;
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                color: var(--primary);
                font-size: 1.5rem;
            }

            .card-title {
                font-weight: 700;
                font-size: 1.15rem;
                margin-bottom: 10px;
            }

            /* Footer */
            .footer-wrapper {
                background-color: white;
                border-top: 1px solid #e2e8f0;
                padding: 60px 0 40px;
            }

            .footer-grid {
                display: grid;
                grid-template-columns: 2fr 1fr 1fr;
                gap: 40px;
            }

            .footer-col h3 {
                font-size: 1rem;
                font-weight: 700;
                margin-bottom: 20px;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .footer-links {
                list-style: none;
                padding: 0;
            }

            .footer-links li { margin-bottom: 12px; }
            .footer-links a {
                text-decoration: none;
                color: var(--text-muted);
                transition: color 0.2s;
            }

            .footer-links a:hover { color: var(--primary); }

            /* Modal Styling */
            .modal-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, 0.6);
                backdrop-filter: blur(4px);
                z-index: 2000;
                align-items: center;
                justify-content: center;
            }

            .modal-content {
                background: white;
                padding: 40px;
                border-radius: 24px;
                width: 100%;
                max-width: 420px;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                position: relative;
            }

            .modal-title {
                font-size: 1.75rem;
                font-weight: 800;
                text-align: center;
                margin-bottom: 8px;
            }

            .form-group { margin-bottom: 20px; }
            .form-group label {
                display: block;
                font-weight: 600;
                font-size: 0.9rem;
                margin-bottom: 8px;
                color: var(--text-dark);
            }

            .form-group input {
                width: 100%;
                padding: 12px 16px;
                border-radius: 12px;
                border: 1px solid #e2e8f0;
                background: #f8fafc;
                font-size: 1rem;
                outline: none;
                transition: all 0.2s;
            }

            .form-group input:focus {
                border-color: var(--primary);
                background: white;
                box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            }

            .modal-actions {
                display: grid;
                grid-template-columns: 1fr 2fr;
                gap: 12px;
                margin-top: 30px;
            }

            .btn-submit {
                background: var(--primary);
                color: white;
                border: none;
                padding: 12px;
                border-radius: 12px;
                font-weight: 700;
                cursor: pointer;
            }

            .btn-close {
                background: #f1f5f9;
                color: var(--text-muted);
                border: none;
                padding: 12px;
                border-radius: 12px;
                font-weight: 600;
                cursor: pointer;
            }

            @keyframes slideUp {
                from { transform: translateY(20px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            .modal-content { animation: slideUp 0.3s ease-out; }
        </style>
    </head>
    <body>
        <header class="header">
            <div class="container header-content">
                <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="Logo SMK Wikrama" class="header-logo" onerror="this.style.display='none'">
                <button class="login-btn" id="openLoginBtn">
                    <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> Masuk ke Sistem
                </button>
            </div>
        </header>

        <main>
            <section class="hero-section">
                <div class="container">
                    <h1 class="main-title">Inventory System<br><span>SMK Wikrama Bogor</span></h1>
                    <p class="main-subtitle">Solusi cerdas manajemen aset dan inventaris sekolah yang terintegrasi, cepat, dan transparan.</p>
                    <div class="hero-image-container">
                        <img src="{{ asset('assets/images/main-image.png') }}" alt="Dashboard Preview" class="main-image" onerror="this.src='https://placehold.co/800x450/4f46e5/ffffff?text=Inventory+System+Preview'">
                    </div>
                </div>
            </section>

            <section class="workflow-section">
                <div class="container">
                    <span class="section-tag">Fitur Utama</span>
                    <h2 style="font-size: 2.25rem; font-weight: 800; margin-top: 10px;">Alur Kerja Sistem Kami</h2>

                    <div class="workflow-grid">
                        <div class="workflow-card">
                            <div class="card-icon"><i class="fas fa-database"></i></div>
                            <h3 class="card-title">Manajemen Data</h3>
                            <p style="color: var(--text-muted); font-size: 0.95rem;">Input dan kelola ribuan data barang dengan kategori yang terorganisir.</p>
                        </div>
                        <div class="workflow-card">
                            <div class="card-icon"><i class="fas fa-tools"></i></div>
                            <h3 class="card-title">Perbaikan Barang</h3>
                            <p style="color: var(--text-muted); font-size: 0.95rem;">Pantau status kerusakan dan proses perbaikan barang secara real-time.</p>
                        </div>
                        <div class="workflow-card">
                            <div class="card-icon"><i class="fas fa-exchange-alt"></i></div>
                            <h3 class="card-title">Peminjaman Aset</h3>
                            <p style="color: var(--text-muted); font-size: 0.95rem;">Sistem peminjaman yang aman bagi guru, staf, dan siswa.</p>
                        </div>
                        <div class="workflow-card">
                            <div class="card-icon"><i class="fas fa-file-export"></i></div>
                            <h3 class="card-title">Laporan Excel</h3>
                            <p style="color: var(--text-muted); font-size: 0.95rem;">Ekspor data inventaris ke format Excel hanya dengan satu klik.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="footer-wrapper">
            <div class="container footer-grid">
                <div class="footer-col">
                    <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="Logo" style="height: 50px; margin-bottom: 20px;">
                    <p style="font-weight: 700; color: var(--text-dark); margin-bottom: 5px;">SMK WIKRAMA BOGOR</p>
                    <p>smkwikrama@sch.id</p>
                    <p>(0251) 8242411</p>
                </div>
                <div class="footer-col">
                    <h3>Tautan Cepat</h3>
                    <ul class="footer-links">
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Panduan Sistem</a></li>
                        <li><a href="#" style="color: #ef4444; font-weight: 600;">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Lokasi</h3>
                    <p>Jl. Raya Wangun<br>Kel. Sindangsari<br>Bogor Timur, Jawa Barat</p>
                </div>
            </div>
            <div class="container" style="margin-top: 50px; text-align: center; color: #94a3b8; font-size: 0.85rem;">
                &copy; 2026 SMK Wikrama Bogor. All rights reserved.
            </div>
        </footer>

        <div id="loginModal" class="modal-overlay">
            <div class="modal-content">
                <h2 class="modal-title">Selamat Datang</h2>
                <p style="text-align: center; color: var(--text-muted); margin-bottom: 30px;">Silakan login untuk mengelola sistem</p>

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@gmail.com" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>Password Akun</label>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>

                    @if($errors->any())
                        <div style="background: #fef2f2; color: #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 0.85rem; font-weight: 600; text-align: center; border: 1px solid #fee2e2;">
                            <i class="fas fa-exclamation-circle" style="margin-right: 5px;"></i> Email atau password salah!
                        </div>
                    @endif

                    <div class="modal-actions">
                        <button type="button" class="btn-close" id="closeModalBtn">Batal</button>
                        <button type="submit" class="btn-submit">Masuk Sekarang</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const openBtn = document.getElementById('openLoginBtn');
                const closeBtn = document.getElementById('closeModalBtn');
                const modal = document.getElementById('loginModal');

                if (openBtn) openBtn.onclick = () => modal.style.display = 'flex';
                if (closeBtn) closeBtn.onclick = () => modal.style.display = 'none';

                window.onclick = (e) => {
                    if (e.target === modal) modal.style.display = 'none';
                };

                @if($errors->any())
                    modal.style.display = 'flex';
                @endif
            });
        </script>
    </body>
</html>
