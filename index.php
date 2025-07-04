<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMDB Enterprise</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Variabel CSS dan Gaya Umum */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #3b82f6;
            --accent-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --border-color: #e5e7eb;
            --shadow-light: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-heavy: 0 20px 25px rgba(0, 0, 0, 0.1);
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-success: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            --gradient-warning: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            --gradient-logout: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%); /* Warna baru untuk logout */
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--dark-color);
            display: flex; /* Menggunakan flexbox untuk mengatur layout utama */
            flex-direction: column;
        }

        /* Container untuk Dashboard (akan disembunyikan saat belum login) */
        #dashboard {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            flex: 1; /* Mengisi sisa ruang vertikal */
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-light);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            height: 70px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .logo i {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2rem;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .time-display {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--dark-color);
            font-weight: 500;
            padding: 8px 16px;
            background: var(--light-color);
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .status-online {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-color);
        }

        .status-loading {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        /* Tombol Logout di Header */
        .logout-btn {
            background: var(--gradient-logout);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
            width: 100%;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.8) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .dashboard-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            font-weight: 400;
        }

        /* Module Grid */
        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .module-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-heavy);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .module-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .module-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .module-card:hover::before {
            transform: scaleX(1);
        }

        .module-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .module-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            background: var(--gradient-primary);
        }

        .module-info h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .module-info p {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .module-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .module-status {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .status-dot.online {
            background: var(--accent-color);
        }

        .status-dot.offline {
            background: var(--danger-color);
        }

        .module-action {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .module-action:hover {
            transform: scale(1.05);
        }

        /* Content Display Area */
        .content-display {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-heavy);
            margin-top: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .content-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        .content-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .refresh-btn {
            background: var(--gradient-success);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: auto;
        }

        .refresh-btn:hover {
            transform: scale(1.05);
        }

        .data-display {
            background: #1e293b;
            color: #e2e8f0;
            padding: 1.5rem;
            border-radius: 12px;
            font-family: 'Fira Code', 'Consolas', monospace;
            font-size: 0.9rem;
            line-height: 1.6;
            overflow-x: auto;
            white-space: pre-wrap;
            border: 1px solid #334155;
        }

        .loading-display {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }

        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 4px solid var(--border-color);
            border-top: 4px solid var(--secondary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }

        .error-display {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid var(--danger-color);
        }

        /* Animations */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-container {
                padding: 0 1rem;
                height: 60px;
            }

            .logo {
                font-size: 1.2rem;
            }

            .main-content {
                padding: 1rem;
            }

            .dashboard-title {
                font-size: 2rem;
            }

            .modules-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .module-card {
                padding: 1.5rem;
            }

            .content-display {
                padding: 1.5rem;
            }

            .nav-actions {
                gap: 0.5rem;
            }

            .time-display,
            .status-indicator {
                font-size: 0.8rem;
                padding: 6px 12px;
            }
        }

        /* Additional Improvements */
        .tooltip {
            position: relative;
        }

        .tooltip::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: var(--dark-color);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s;
            z-index: 1000;
        }

        .tooltip:hover::after {
            opacity: 1;
            visibility: visible;
            bottom: calc(100% + 5px);
        }

        /* Notification Styles */
        .notification {
            position: fixed;
            top: 90px;
            right: 20px;
            background: var(--accent-color);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: var(--shadow-heavy);
            z-index: 1000;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notification-success {
            background: var(--accent-color);
        }

        .notification-error {
            background: var(--danger-color);
        }

        /* Login Page Styles */
        .login-container {
            /* Dihapus display: none; agar default-nya flex */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            flex: 1;
            position: fixed; /* Menjadikan overlay penuh layar */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1001; /* Pastikan di atas dashboard */
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(15px);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: var(--shadow-heavy);
            text-align: center;
            max-width: 450px;
            width: 90%;
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: fadeIn 0.5s ease-out;
        }

        .login-card h2 {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 800;
        }

        .login-card .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .login-card label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .login-card input[type="text"],
        .login-card input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 1rem;
            color: var(--dark-color);
            transition: all 0.2s ease;
            background-color: var(--light-color);
        }

        .login-card input[type="text"]:focus,
        .login-card input[type="password"]:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .login-button {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            justify-content: center;
            margin-top: 1rem;
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
        }

        .login-message {
            margin-top: 1.5rem;
            color: var(--danger-color);
            font-weight: 500;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div id="dashboard" class="container" style="display: none;">
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <i class="fas fa-industry"></i>
                    <span>SIMDB Enterprise</span>
                </div>
                <div class="nav-actions">
                    <div class="time-display">
                        <i class="fas fa-clock"></i>
                        <span id="currentTime"></span>
                    </div>
                    <div class="status-indicator status-online">
                        <div class="status-dot online"></div>
                        <span>System Online</span>
                    </div>
                    <button class="logout-btn" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i>
                        Log Out
                    </button>
                </div>
            </div>
        </header>

        <main class="main-content">
            <div class="dashboard-header fade-in">
                <h1 class="dashboard-title">Sistem Informasi Manufaktur & Distribusi</h1>
                <p class="dashboard-subtitle">Dashboard terpusat untuk mengelola seluruh proses bisnis manufaktur</p>
            </div>

            <div class="modules-grid">
                <div class="module-card tooltip" data-tooltip="Kelola rencana dan jadwal produksi" onclick="loadData('rencana')">
                    <div class="module-header">
                        <div class="module-icon" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="module-info">
                            <h3>Perencanaan Produksi</h3>
                            <p>Rencana dan jadwal produksi</p>
                        </div>
                    </div>
                    <div class="module-stats">
                        <div class="module-status">
                            <div class="status-dot online"></div>
                            <span>Ready</span>
                        </div>
                        <button class="module-action">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <div class="module-card tooltip" data-tooltip="Monitor proses produksi aktual" onclick="loadData('produksi')">
                    <div class="module-header">
                        <div class="module-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="module-info">
                            <h3>Proses Produksi</h3>
                            <p>Monitor produksi real-time</p>
                        </div>
                    </div>
                    <div class="module-stats">
                        <div class="module-status">
                            <div class="status-dot online"></div>
                            <span>Active</span>
                        </div>
                        <button class="module-action">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <div class="module-card tooltip" data-tooltip="Kelola stok bahan mentah" onclick="loadData('bahanbaku')">
                    <div class="module-header">
                        <div class="module-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div class="module-info">
                            <h3>Gudang Bahan Baku</h3>
                            <p>Manajemen stok material</p>
                        </div>
                    </div>
                    <div class="module-stats">
                        <div class="module-status">
                            <div class="status-dot online"></div>
                            <span>Operational</span>
                        </div>
                        <button class="module-action">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <div class="module-card tooltip" data-tooltip="Kelola inventori produk jadi" onclick="loadData('produkjadi')">
                    <div class="module-header">
                        <div class="module-icon" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <div class="module-info">
                            <h3>Gudang Produk Jadi</h3>
                            <p>Inventori siap kirim</p>
                        </div>
                    </div>
                    <div class="module-stats">
                        <div class="module-status">
                            <div class="status-dot online"></div>
                            <span>Ready</span>
                        </div>
                        <button class="module-action">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <div class="module-card tooltip" data-tooltip="Tracking pengiriman produk" onclick="loadData('pengiriman')">
                    <div class="module-header">
                        <div class="module-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="module-info">
                            <h3>Distribusi & Pengiriman</h3>
                            <p>Tracking & logistik</p>
                        </div>
                    </div>
                    <div class="module-stats">
                        <div class="module-status">
                            <div class="status-dot online"></div>
                            <span>Shipping</span>
                        </div>
                        <button class="module-action">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <div class="module-card tooltip" data-tooltip="Manajemen pelanggan dan penjualan" onclick="loadData('penjualan')">
                    <div class="module-header">
                        <div class="module-icon" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="module-info">
                            <h3>Penjualan & Pelanggan</h3>
                            <p>CRM dan transaksi</p>
                        </div>
                    </div>
                    <div class="module-stats">
                        <div class="module-status">
                            <div class="status-dot online"></div>
                            <span>Processing</span>
                        </div>
                        <button class="module-action">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <div class="module-card tooltip" data-tooltip="Analytics dan pelaporan bisnis" onclick="loadData('kpi')">
                    <div class="module-header">
                        <div class="module-icon" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="module-info">
                            <h3>Laporan Bisnis & KPI</h3>
                            <p>Analytics & insights</p>
                        </div>
                    </div>
                    <div class="module-stats">
                        <div class="module-status">
                            <div class="status-dot online"></div>
                            <span>Analyzing</span>
                        </div>
                        <button class="module-action">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="content-display" id="contentDisplay" style="display: none;">
                <div class="content-header">
                    <h2 class="content-title" id="contentTitle">Data Module</h2>
                    <button class="refresh-btn" onclick="refreshCurrentData()">
                        <i class="fas fa-sync-alt"></i>
                        Refresh
                    </button>
                </div>
                <div id="output">
                    <div class="loading-display">
                        <div class="loading-spinner"></div>
                        <p>Pilih modul untuk menampilkan data</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="loginPage" class="login-container">
        <div class="login-card">
            <h2>Selamat Datang di SIMDB Enterprise</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan nama pengguna" required>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
                </div>
                <button type="submit" class="login-button">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
                <p id="loginMessage" class="login-message" style="display: none;"></p>
            </form>
        </div>
    </div>

    <script>

        // Configuration
        const API_URLS = {
            // URL untuk API login Mahasiswa 2
            // Ganti '192.168.1.9' dengan IP Address AKTUAL komputer Mahasiswa 2
            // Ganti 'user_management_module' dengan nama "Quick App" yang Anda buat di Laragon
            login: 'http://192.168.1.14/user_management_module/login.php', 
            // URL untuk modul API lainnya (dari Mahasiswa 3-9)
            rencana: 'http://192.168.1.7/manajemen_barang/perencanaan_produksi/public/index.php',
            produksi: 'http://192.168.1.10/proses_produksi/public/produksi',
            bahanbaku: 'http://192.168.1.10/gudang_bahan_baku/public/stok',
            produkjadi: 'http://192.168.1.10/gudang_produk_jadi/public/produk',
            pengiriman: 'http://192.168.1.10/distribusi_pengiriman/public/pengiriman',
            penjualan: 'http://192.168.1.10/manajemen_pelanggan/public/penjualan',
            kpi: 'http://192.168.1.10/laporan_kpi/public/kpi/produksi'
        };

        const MODULE_TITLES = {
            rencana: 'Perencanaan Produksi',
            produksi: 'Proses Produksi',
            bahanbaku: 'Gudang Bahan Baku',
            produkjadi: 'Gudang Produk Jadi',
            pengiriman: 'Distribusi & Pengiriman',
            penjualan: 'Penjualan & Pelanggan',
            kpi: 'Laporan Bisnis & KPI'
        };

        let currentModule = null;
        let notificationTimeout;

        // Inisialisasi Aplikasi saat DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            updateTime();
            setInterval(updateTime, 1000); // Perbarui waktu setiap detik

            // Tambahkan animasi pada kartu modul
            const cards = document.querySelectorAll('.module-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('fade-in');
            });

            // Periksa status autentikasi saat halaman dimuat
            // Ini akan menentukan apakah form login atau dashboard yang ditampilkan
            checkAuth();

            // Event listener untuk form login
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // Mencegah form submit default
                    performLogin();
                });
            }
        });

        // --- Authentication Functions ---

        /**
         * Memeriksa status autentikasi pengguna dari localStorage.
         * Menampilkan dashboard jika sudah login, atau halaman login jika belum.
         */
        function checkAuth() {
            const isLoggedIn = localStorage.getItem('isLoggedIn');
            const loginPage = document.getElementById('loginPage');
            const dashboard = document.getElementById('dashboard');

            if (isLoggedIn === 'true') {
                loginPage.style.display = 'none';
                dashboard.style.display = 'flex';
            } else {
                loginPage.style.display = 'flex'; // Pastikan login page selalu terlihat jika belum login
                dashboard.style.display = 'none';
            }
        }

        /**
         * Mengirim kredensial login ke API Mahasiswa 2.
         * Memperbarui UI berdasarkan respons dari API.
         */
        async function performLogin() {
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const loginMessage = document.getElementById('loginMessage');

            const username = usernameInput.value;
            const password = passwordInput.value;

            loginMessage.style.display = 'none'; // Sembunyikan pesan error sebelumnya

            // Validasi input sisi klien (opsional tapi baik)
            if (!username || !password) {
                loginMessage.textContent = 'Nama pengguna dan kata sandi tidak boleh kosong.';
                loginMessage.style.display = 'block';
                return; // Hentikan fungsi jika input kosong
            }

            try {
                const response = await fetch(API_URLS.login, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ username, password }),
                });

                const data = await response.json(); // Menguraikan respons JSON

                if (response.ok && data.status === 'success') {
                    // Jika login berhasil
                    localStorage.setItem('isLoggedIn', 'true');
                    localStorage.setItem('userRole', data.user.role); // Simpan role (akan selalu 'admin')
                    showSuccessMessage('Login berhasil!');
                    // Sembunyikan login page dan tampilkan dashboard
                    document.getElementById('loginPage').style.display = 'none';
                    document.getElementById('dashboard').style.display = 'flex';
                } else {
                    // Jika login gagal (status API 'error' atau HTTP status bukan 200 OK)
                    // Pesan kesalahan dari API akan ditampilkan jika ada, jika tidak, pesan default
                    loginMessage.textContent = data.message || 'Login gagal. Silakan coba lagi.';
                    loginMessage.style.display = 'block';
                    showErrorMessage(data.message || 'Login gagal.');
                    localStorage.setItem('isLoggedIn', 'false'); // Pastikan status login diatur ke false
                }
            } catch (error) {
                // Tangani error jaringan atau server tidak merespons
                loginMessage.textContent = 'Terjadi kesalahan saat menghubungi server. Pastikan server modul login berjalan dan dapat diakses. Detail: ' + error.message;
                loginMessage.style.display = 'block';
                showErrorMessage('Kesalahan jaringan: ' + error.message);
                localStorage.setItem('isLoggedIn', 'false'); // Pastikan status login diatur ke false
            }
        }

        /**
         * Melakukan proses logout.
         * Menghapus status login dari localStorage dan kembali ke halaman login.
         */
        function logout() {
            localStorage.removeItem('isLoggedIn'); // Hapus status login
            localStorage.removeItem('userRole'); // Hapus role pengguna
            showSuccessMessage('Anda telah berhasil keluar.');
            currentModule = null; // Reset modul yang sedang dipilih

            // Sembunyikan area konten (jika sedang menampilkan data modul)
            const contentDisplay = document.getElementById('contentDisplay');
            if (contentDisplay) {
                contentDisplay.style.display = 'none';
            }
            // Reset pesan di area output
            const output = document.getElementById('output');
            if (output) {
                output.innerHTML = `
                    <div class="loading-display">
                        <div class="loading-spinner"></div>
                        <p>Pilih modul untuk menampilkan data</p>
                    </div>
                `;
            }
            // Tampilkan kembali halaman login dan sembunyikan dashboard
            document.getElementById('dashboard').style.display = 'none';
            document.getElementById('loginPage').style.display = 'flex';
        }

        // --- Other Dashboard Functions (tidak ada perubahan dari sebelumnya) ---

        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            const currentTimeElement = document.getElementById('currentTime');
            if (currentTimeElement) {
                currentTimeElement.textContent = timeString;
            }
        }

        async function loadData(module) {
            // Pastikan user sudah login sebelum memuat data modul
            if (localStorage.getItem('isLoggedIn') !== 'true') {
                showErrorMessage('Anda harus login untuk mengakses modul ini.');
                logout(); // Arahkan kembali ke halaman login
                return;
            }

            currentModule = module;
            const contentDisplay = document.getElementById('contentDisplay');
            const output = document.getElementById('output');
            const title = document.getElementById('contentTitle');

            if (contentDisplay) {
                contentDisplay.style.display = 'block';
                contentDisplay.scrollIntoView({ behavior: 'smooth' });
            }

            if (title) {
                title.textContent = MODULE_TITLES[module] || module;
            }

            showLoading();
            updateSystemStatus('loading');

            try {
                const response = await fetch(API_URLS[module]);
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                const data = await response.json();
                displayData(data);
                updateSystemStatus('online');
                showSuccessMessage(`Data ${MODULE_TITLES[module] || ''} berhasil dimuat`);
            } catch (error) {
                displayError(error);
                updateSystemStatus('online');
                showErrorMessage(`Gagal memuat data ${MODULE_TITLES[module] || ''}: ${error.message}`);
            }
        }

        function showLoading() {
            const output = document.getElementById('output');
            if (output) {
                output.innerHTML = `
                    <div class="loading-display">
                        <div class="loading-spinner"></div>
                        <p>Mengambil data dari server...</p>
                    </div>
                `;
            }
        }

        function displayData(data) {
            const output = document.getElementById('output');
            if (output) {
                const formattedData = JSON.stringify(data, null, 2);
                output.innerHTML = `<div class="data-display">${escapeHtml(formattedData)}</div>`;
            }
        }

        function displayError(error) {
            const output = document.getElementById('output');
            if (output) {
                output.innerHTML = `
                    <div class="error-display">
                        <h3><i class="fas fa-exclamation-triangle"></i> Error Loading Data</h3>
                        <p><strong>Error:</strong> ${error.message}</p>
                        <p><strong>Module:</strong> ${MODULE_TITLES[currentModule] || 'Tidak diketahui'}</p>
                        <p><strong>Time:</strong> ${new Date().toLocaleString('id-ID')}</p>
                        <hr style="margin: 1rem 0; border: none; height: 1px; background: rgba(239, 68, 68, 0.3);">
                        <p><small>Pastikan server modul sedang berjalan dan dapat diakses.</small></p>
                    </div>
                `;
            }
        }

        function refreshCurrentData() {
            if (currentModule) {
                loadData(currentModule);
            } else {
                showErrorMessage('Tidak ada modul yang dipilih untuk di-refresh.');
            }
        }

        function updateSystemStatus(status) {
            const statusIndicator = document.querySelector('.status-indicator');
            const statusDot = statusIndicator ? statusIndicator.querySelector('.status-dot') : null;
            const statusText = statusIndicator ? statusIndicator.FquerySelector('span') : null;

            if (statusIndicator && statusDot && statusText) {
                statusIndicator.className = 'status-indicator';
                statusDot.className = 'status-dot';

                switch (status) {
                    case 'online':
                        statusIndicator.classList.add('status-online');
                        statusDot.classList.add('online');
                        statusText.textContent = 'System Online';
                        break;
                    case 'loading':
                        statusIndicator.classList.add('status-loading');
                        statusDot.classList.add('online');
                        statusText.textContent = 'Loading Data';
                        break;
                    default:
                        statusIndicator.classList.add('status-online');
                        statusDot.classList.add('online');
                        statusText.textContent = 'System Online';
                }
            }
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Debounce function to prevent rapid notification pop-ups
        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                const context = this;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), delay);
            };
        }

        const showNotificationDebounced = debounce((message, type) => {
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(n => n.remove());

            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            setTimeout(() => {
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }, 200); // 200ms debounce delay

        function showSuccessMessage(message) {
            showNotificationDebounced(message, 'success');
        }

        function showErrorMessage(message) {
            showNotificationDebounced(message, 'error');
        }

        // Add keyboard shortcuts
        document.addEventListener('keydown', (event) => {
            // Prevent default action for keys used as shortcuts
            // Hanya izinkan shortcut jika dashboard terlihat (sudah login)
            if (document.getElementById('dashboard').style.display === 'flex') {
                if (['r', 'R', 'p', 'P', 'o', 'O', 'b', 'B', 'j', 'J', 'k', 'K', 's', 'S', 'i', 'I', 'l', 'L'].includes(event.key)) {
                    event.preventDefault();
                }

                switch (event.key) {
                    case 'r':
                    case 'R':
                        refreshCurrentData();
                        break;
                    case 'p':
                    case 'P':
                        loadData('rencana');
                        break;
                    case 'o': // 'o' for prOduksi
                    case 'O':
                        loadData('produksi');
                        break;
                    case 'b': // 'b' for bahan baku
                    case 'B':
                        loadData('bahanbaku');
                        break;
                    case 'j': // 'j' for produk jadi
                    case 'J':
                        loadData('produkjadi');
                        break;
                    case 'k': // 'k' for pengiriman (kirim)
                    case 'K':
                        loadData('pengiriman');
                        break;
                    case 's': // 's' for penjualan (sales)
                    case 'S':
                        loadData('penjualan');
                        break;
                    case 'i': // 'i' for kpi (insight)
                    case 'I':
                        loadData('kpi');
                        break;
                    case 'l':
                    case 'L': // 'L' for Logout
                        logout();
                        break;
                    default:
                        break;
                }
            }
        });
    </script>
</body>
</html>