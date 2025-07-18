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
            --gradient-info: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%); /* New gradient for info/status */
            --gradient-delete: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); /* New gradient for delete */
            --gradient-logout: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
            --gradient-back: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--dark-color);
            display: flex;
            flex-direction: column;
        }

        /* General Container Styling */
        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            flex: 1;
            width: 100%;
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

        .logout-btn, .back-to-dashboard-btn {
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
        .back-to-dashboard-btn {
            background: var(--gradient-back);
        }

        .logout-btn:hover, .back-to-dashboard-btn:hover {
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

        /* Content Display Area (General styling, now used for detail pages) */
        .content-display {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-heavy);
            margin-top: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            min-height: 400px;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .content-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        .content-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-color);
            flex-grow: 1;
        }

        .action-buttons-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
        }

        .action-button {
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
            border: none;
            color: white;
            text-decoration: none; /* For potential links */
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        /* Specific button styles */
        .btn-refresh { background: var(--gradient-success); }
        .btn-update { background: var(--gradient-primary); }
        .btn-status { background: var(--gradient-info); }
        .btn-delete { background: var(--gradient-delete); }
        .btn-warning { background: var(--gradient-warning); } /* For 'Kurangi' */
        .btn-add { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); } /* New button for Add */


        /* Table Styling */
        .data-table-container {
            overflow-x: auto;
            flex-grow: 1;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .data-table th, .data-table td {
            border: 1px solid var(--border-color);
            padding: 12px 15px;
            text-align: left;
        }

        .data-table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
        }

        .data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .data-table tr:hover {
            background-color: #e2e8f0;
        }
        
        .data-table td {
            color: var(--dark-color);
        }

        .loading-display, .error-display {
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
            border-left: 44px solid var(--danger-color);
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
            .data-table th, .data-table td {
                padding: 8px 10px;
            }
            .data-table {
                font-size: 0.8rem;
            }
            .action-buttons-container {
                flex-direction: column; /* Stack buttons vertically on small screens */
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
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            flex: 1;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1001;
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

        /* Specific visibility for pages */
        #dashboard-page,
        #detail-rencana-page,
        #detail-produksi-page,
        #detail-bahanbaku-page,
        #detail-produkjadi-page,
        #detail-pengiriman-page,
        #detail-penjualan-page,
        #detail-kpi-page,
        #detail-user-page { /* Added for User Management Page */
            display: none;
        }

        /* KPI Specific Styles */
        .kpi-metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem; /* Adjust margin-top to separate from buttons */
        }

        .kpi-card {
            background: var(--light-color);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-light);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
            animation: fadeIn 0.5s ease-out; /* Add fade-in for individual cards */
        }

        .kpi-card h4 {
            font-size: 1.1rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .kpi-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .kpi-value i {
            font-size: 1.5rem;
            color: var(--secondary-color);
        }

        .kpi-description {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .kpi-graph {
            width: 100%;
            height: 10px;
            background-color: var(--border-color);
            border-radius: 5px;
            overflow: hidden;
            margin-top: 0.75rem;
        }

        .kpi-bar {
            height: 100%;
            background: var(--gradient-success); /* Default green */
            width: 0%; /* Will be set by JS */
            transition: width 0.5s ease-out;
            border-radius: 5px;
        }

        .kpi-bar.red {
            background: var(--gradient-delete);
        }

        .kpi-bar.orange {
            background: var(--gradient-warning);
        }
        /* Style for a simple line chart */
        .kpi-line-chart {
            width: 100%;
            height: 150px; /* Fixed height for the chart */
            background-color: var(--light-color);
            border-radius: 12px;
            box-shadow: var(--shadow-light);
            padding: 1rem;
            margin-top: 1.5rem;
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            position: relative;
            overflow: hidden;
        }

        .kpi-line-chart .line-chart-bar {
            flex: 1;
            background-color: var(--secondary-color);
            margin: 0 2px;
            transition: height 0.5s ease-out, background-color 0.3s ease;
            position: relative;
            bottom: 0;
            border-radius: 3px 3px 0 0;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            font-size: 0.7rem;
            color: white;
            font-weight: bold;
            padding-top: 5px;
        }
        .kpi-line-chart .line-chart-bar span {
            position: absolute;
            top: -1.2em;
            color: var(--dark-color);
            font-size: 0.8em;
            text-align: center;
        }
        .kpi-line-chart .line-chart-label {
            position: absolute;
            bottom: -1.5em;
            font-size: 0.7em;
            color: #6b7280;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="dashboard-page" class="container">
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
                <div class="module-card tooltip" data-tooltip="Kelola akun pengguna sistem" onclick="navigateToDetail('user')">
                    <div class="module-header">
                        <div class="module-icon" style="background: linear-gradient(135deg, #4c51bf 0%, #667eea 100%);">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="module-info">
                            <h3>Manajemen Pengguna</h3>
                            <p>Tambah, edit, hapus akun</p>
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

                <div class="module-card tooltip" data-tooltip="Kelola rencana dan jadwal produksi" onclick="navigateToDetail('rencana')">
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

                <div class="module-card tooltip" data-tooltip="Monitor proses produksi aktual" onclick="navigateToDetail('produksi')">
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

                <div class="module-card tooltip" data-tooltip="Kelola stok bahan mentah" onclick="navigateToDetail('bahanbaku')">
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

                <div class="module-card tooltip" data-tooltip="Kelola inventori produk jadi" onclick="navigateToDetail('produkjadi')">
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

                <div class="module-card tooltip" data-tooltip="Tracking pengiriman produk" onclick="navigateToDetail('pengiriman')">
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

                <div class="module-card tooltip" data-tooltip="Manajemen pelanggan dan penjualan" onclick="navigateToDetail('penjualan')">
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

                <div class="module-card tooltip" data-tooltip="Analytics dan pelaporan bisnis" onclick="navigateToDetail('kpi')">
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
        </main>
    </div>

    <div id="loginPage" class="login-container" style="display: flex;">
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

    <div id="detail-user-page" class="container">
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <i class="fas fa-industry"></i>
                    <span>SIMDB Enterprise</span>
                </div>
                <div class="nav-actions">
                    <button class="back-to-dashboard-btn" onclick="showDashboard()">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </button>
                    <div class="time-display">
                        <i class="fas fa-clock"></i>
                        <span id="currentTimeDetailUser"></span>
                    </div>
                    <div class="status-indicator status-online">
                        <div class="status-dot online"></div>
                        <span>System Online</span>
                    </div>
                </div>
            </div>
        </header>
        <main class="main-content">
            <div class="content-display fade-in">
                <div class="content-header">
                    <h2 class="content-title">Detail Manajemen Pengguna</h2>
                    <div class="action-buttons-container">
                        <button class="action-button btn-refresh" onclick="loadDetailData('user_get', 'user')">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <button class="action-button btn-add" onclick="handleAction('user_add', 'user')">
                            <i class="fas fa-user-plus"></i> Tambah Pengguna
                        </button>
                        <button class="action-button btn-update" onclick="handleAction('user_update', 'user')">
                            <i class="fas fa-user-edit"></i> Edit Pengguna
                        </button>
                        <button class="action-button btn-delete" onclick="handleAction('user_delete', 'user')">
                            <i class="fas fa-user-minus"></i> Hapus Pengguna
                        </button>
                    </div>
                </div>
                <div id="user-data-output" class="data-table-container">
                    <div class="loading-display">
                        <div class="loading-spinner"></div>
                        <p>Mengambil data pengguna...</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="detail-rencana-page" class="container">
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <i class="fas fa-industry"></i>
                    <span>SIMDB Enterprise</span>
                </div>
                <div class="nav-actions">
                    <button class="back-to-dashboard-btn" onclick="showDashboard()">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </button>
                    <div class="time-display">
                        <i class="fas fa-clock"></i>
                        <span id="currentTimeDetailRencana"></span>
                    </div>
                    <div class="status-indicator status-online">
                        <div class="status-dot online"></div>
                        <span>System Online</span>
                    </div>
                </div>
            </div>
        </header>
        <main class="main-content">
            <div class="content-display fade-in">
                <div class="content-header">
                    <h2 class="content-title">Detail Perencanaan Produksi</h2>
                    <div class="action-buttons-container">
                        <button class="action-button btn-refresh" onclick="loadDetailData('rencana_get', 'rencana')">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <button class="action-button btn-update" onclick="handleAction('rencana_update', 'rencana')">
                            <i class="fas fa-edit"></i> Update
                        </button>
                        <button class="action-button btn-delete" onclick="handleAction('rencana_delete', 'rencana')">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </div>
                </div>
                <div id="rencana-data-output" class="data-table-container">
                    <div class="loading-display">
                        <div class="loading-spinner"></div>
                        <p>Mengambil data perencanaan produksi...</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="detail-produksi-page" class="container">
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <i class="fas fa-industry"></i>
                    <span>SIMDB Enterprise</span>
                </div>
                <div class="nav-actions">
                    <button class="back-to-dashboard-btn" onclick="showDashboard()">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </button>
                    <div class="time-display">
                        <i class="fas fa-clock"></i>
                        <span id="currentTimeDetailProduksi"></span>
                    </div>
                    <div class="status-indicator status-online">
                        <div class="status-dot online"></div>
                        <span>System Online</span>
                    </div>
                </div>
            </div>
        </header>
        <main class="main-content">
            <div class="content-display fade-in">
                <div class="content-header">
                    <h2 class="content-title">Detail Proses Produksi</h2>
                    <div class="action-buttons-container">
                        <button class="action-button btn-refresh" onclick="loadDetailData('produksi_get', 'produksi')">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <button class="action-button btn-status" onclick="handleAction('produksi_status', 'produksi')">
                            <i class="fas fa-info-circle"></i> Status
                        </button>
                        <button class="action-button btn-delete" onclick="handleAction('produksi_delete', 'produksi')">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </div>
                </div>
                <div id="produksi-data-output" class="data-table-container">
                    <div class="loading-display">
                        <div class="loading-spinner"></div>
                        <p>Mengambil data proses produksi...</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="detail-bahanbaku-page" class="container">
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <i class="fas fa-industry"></i>
                    <span>SIMDB Enterprise</span>
                </div>
                <div class="nav-actions">
                    <button class="back-to-dashboard-btn" onclick="showDashboard()">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </button>
                    <div class="time-display">
                        <i class="fas fa-clock"></i>
                        <span id="currentTimeDetailBahanBaku"></span>
                    </div>
                    <div class="status-indicator status-online">
                        <div class="status-dot online"></div>
                        <span>System Online</span>
                    </div>
                </div>
            </div>
        </header>
        <main class="main-content">
            <div class="content-display fade-in">
                <div class="content-header">
                    <h2 class="content-title">Detail Gudang Bahan Baku</h2>
                    <div class="action-buttons-container">
                        <button class="action-button btn-refresh" onclick="loadDetailData('bahanbaku_get', 'bahanbaku')">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <button class="action-button btn-warning" onclick="handleAction('bahanbaku_kurangi', 'bahanbaku')">
                            <i class="fas fa-minus-circle"></i> Kurangi Stok
                        </button>
                        <button class="action-button btn-delete" onclick="handleAction('bahanbaku_delete', 'bahanbaku')">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </div>
                </div>
                <div id="bahanbaku-data-output" class="data-table-container">
                    <div class="loading-display">
                        <div class="loading-spinner"></div>
                        <p>Mengambil data gudang bahan baku...</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="detail-produkjadi-page" class="container">
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <i class="fas fa-industry"></i>
                    <span>SIMDB Enterprise</span>
                </div>
                <div class="nav-actions">
                    <button class="back-to-dashboard-btn" onclick="showDashboard()">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </button>
                    <div class="time-display">
                        <i class="fas fa-clock"></i>
                        <span id="currentTimeDetailProdukJadi"></span>
                    </div>
                    <div class="status-indicator status-online">
                        <div class="status-dot online"></div>
                        <span>System Online</span>
                    </div>
                </div>
            </div>
        </header>
        <main class="main-content">
            <div class="content-display fade-in">
                <div class="content-header">
                    <h2 class="content-title">Detail Gudang Produk Jadi</h2>
                    <div class="action-buttons-container">
                        <button class="action-button btn-refresh" onclick="loadDetailData('produkjadi_get', 'produkjadi')">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <button class="action-button btn-warning" onclick="handleAction('produkjadi_keluar', 'produkjadi')">
                            <i class="fas fa-sign-out-alt"></i> Produk Keluar
                        </button>
                        <button class="action-button btn-delete" onclick="handleAction('produkjadi_delete', 'produkjadi')">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </div>
                </div>
                <div id="produkjadi-data-output" class="data-table-container">
                    <div class="loading-display">
                        <div class="loading-spinner"></div>
                        <p>Mengambil data gudang produk jadi...</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="detail-pengiriman-page" class="container">
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <i class="fas fa-industry"></i>
                    <span>SIMDB Enterprise</span>
                </div>
                <div class="nav-actions">
                    <button class="back-to-dashboard-btn" onclick="showDashboard()">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </button>
                    <div class="time-display">
                        <i class="fas fa-clock"></i>
                        <span id="currentTimeDetailPengiriman"></span>
                    </div>
                    <div class="status-indicator status-online">
                        <div class="status-dot online"></div>
                        <span>System Online</span>
                    </div>
                </div>
            </div>
        </header>
        <main class="main-content">
            <div class="content-display fade-in">
                <div class="content-header">
                    <h2 class="content-title">Detail Distribusi & Pengiriman</h2>
                    <div class="action-buttons-container">
                        <button class="action-button btn-refresh" onclick="loadDetailData('pengiriman_get', 'pengiriman')">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <button class="action-button btn-status" onclick="handleAction('pengiriman_status', 'pengiriman')">
                            <i class="fas fa-truck"></i> Update Status
                        </button>
                        <button class="action-button btn-delete" onclick="handleAction('pengiriman_delete', 'pengiriman')">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </div>
                </div>
                <div id="pengiriman-data-output" class="data-table-container">
                    <div class="loading-display">
                        <div class="loading-spinner"></div>
                        <p>Mengambil data distribusi & pengiriman...</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="detail-penjualan-page" class="container">
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <i class="fas fa-industry"></i>
                    <span>SIMDB Enterprise</span>
                </div>
                <div class="nav-actions">
                    <button class="back-to-dashboard-btn" onclick="showDashboard()">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </button>
                    <div class="time-display">
                        <i class="fas fa-clock"></i>
                        <span id="currentTimeDetailPenjualan"></span>
                    </div>
                    <div class="status-indicator status-online">
                        <div class="status-dot online"></div>
                        <span>System Online</span>
                    </div>
                </div>
            </div>
        </header>
        <main class="main-content">
            <div class="content-display fade-in">
                <div class="content-header">
                    <h2 class="content-title">Detail Penjualan & Pelanggan</h2>
                    <div class="action-buttons-container">
                        <button class="action-button btn-refresh" onclick="loadDetailData('penjualan_get', 'penjualan')">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <button class="action-button btn-status" onclick="handleAction('penjualan_status', 'penjualan')">
                            <i class="fas fa-chart-bar"></i> Update Status
                        </button>
                        <button class="action-button btn-delete" onclick="handleAction('penjualan_delete', 'penjualan')">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </div>
                </div>
                <div id="penjualan-data-output" class="data-table-container">
                    <div class="loading-display">
                        <div class="loading-spinner"></div>
                        <p>Mengambil data penjualan & pelanggan...</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="detail-kpi-page" class="container">
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <i class="fas fa-industry"></i>
                    <span>SIMDB Enterprise</span>
                </div>
                <div class="nav-actions">
                    <button class="back-to-dashboard-btn" onclick="showDashboard()">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </button>
                    <div class="time-display">
                        <i class="fas fa-clock"></i>
                        <span id="currentTimeDetailKPI"></span>
                    </div>
                    <div class="status-indicator status-online">
                        <div class="status-dot online"></div>
                        <span>System Online</span>
                    </div>
                </div>
            </div>
        </header>
        <main class="main-content">
            <div class="content-display fade-in">
                <div class="content-header">
                    <h2 class="content-title">Detail Laporan Bisnis & KPI</h2>
                    <div class="action-buttons-container">
                        <button class="action-button btn-refresh" onclick="processAndDisplayKPI('all_kpis', 'Ringkasan KPI')">
                            <i class="fas fa-sync-alt"></i> Refresh Semua KPI
                        </button>
                        <button class="action-button btn-info" onclick="processAndDisplayKPI('produksi_get', 'KPI Produksi')">
                            <i class="fas fa-chart-pie"></i> KPI Produksi
                        </button>
                        <button class="action-button btn-info" onclick="processAndDisplayKPI('penjualan_get', 'KPI Penjualan')">
                            <i class="fas fa-chart-line"></i> KPI Penjualan
                        </button>
                        <button class="action-button btn-info" onclick="processAndDisplayKPI('pengiriman_get', 'KPI Distribusi')">
                            <i class="fas fa-truck-loading"></i> KPI Distribusi
                        </button>
                    </div>
                </div>
                <div id="kpi-data-output" class="data-table-container">
                    <div class="loading-display">
                        <div class="loading-spinner"></div>
                        <p>Pilih jenis KPI untuk menampilkan laporan.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <script>
        // Configuration
        const API_URLS = {
            login: 'http://192.168.1.36/user_management_module/login.php',
            // User Management (Mahasiswa 2)
            user_get: 'http://192.168.1.36/user_management_module/get_users.php',
            user_add: 'http://192.168.1.36/user_management_module/add_user.php',
            user_update: 'http://192.168.1.36/user_management_module/update_user.php',
            user_delete: 'http://192.168.1.36/user_management_module/delete_user.php',

            // Perencanaan Produksi (Mahasiswa 3)
            rencana_get: 'http://192.168.1.36/perencanaan_produksi/public/index.php?url=rencana',
            rencana_update: 'http://192.168.1.36/perencanaan_produksi/public/index.php?url=rencana/update',
            rencana_delete: 'http://192.168.1.36/perencanaan_produksi/public/index.php?url=rencana/hapus',

            // Proses Produksi (Mahasiswa 4)
            produksi_get: 'http://192.168.1.36/proses_produksi/public/index.php?url=produksi',
            produksi_status: 'http://192.168.1.36/proses_produksi/public/index.php?url=produksi/status',
            produksi_delete: 'http://192.168.1.36/proses_produksi/public/index.php?url=produksi/hapus',

            // Gudang Bahan Baku (Mahasiswa 5)
            bahanbaku_get: 'http://192.168.1.36/gudang_bahan_baku/public/index.php?url=stok',
            bahanbaku_kurangi: 'http://192.168.1.36/gudang_bahan_baku/public/index.php?url=stok/kurangi',
            bahanbaku_delete: 'http://192.168.1.36/gudang_bahan_baku/public/index.php?url=stok/hapus',
            
            // Gudang Produk Jadi (Mahasiswa 6)
            produkjadi_get: 'http://192.168.1.36/gudang_produk_jadi/public/index.php?url=produk',
            produkjadi_keluar: 'http://192.168.1.36/gudang_produk_jadi/public/index.php?url=produk/keluar',
            produkjadi_delete: 'http://192.168.1.36/gudang_produk_jadi/public/index.php?url=produk/hapus',

            // Distribusi & Pengiriman (Mahasiswa 7)
            pengiriman_get: 'http://192.168.1.36/distribusi_pengiriman/public/index.php?url=pengiriman',
            pengiriman_status: 'http://192.168.1.36/distribusi_pengiriman/public/index.php?url=pengiriman/status',
            pengiriman_delete: 'http://192.168.1.36/distribusi_pengiriman/public/index.php?url=pengiriman/hapus',

            // Manajemen Pelanggan & Penjualan (Mahasiswa 8)
            penjualan_get: 'http://192.168.1.36/manajemen_pelanggan/public/index.php?url=penjualan',
            penjualan_status: 'http://192.168.1.36/manajemen_pelanggan/public/index.php?url=penjualan/status',
            penjualan_delete: 'http://192.168.1.36/manajemen_pelanggan/public/index.php?url=penjualan/hapus',

            // Laporan Bisnis & KPI (Mahasiswa 9) - Now directly fetched data from respective modules
            // These keys map to the _get endpoints of relevant modules for raw data
            // Note: These should correspond to the actual data fetching URLs of each module.
            kpi_produksi_data: 'produksi_get', // Uses production module's get endpoint for raw data
            kpi_penjualan_data: 'penjualan_get', // Uses sales module's get endpoint for raw data
            kpi_distribusi_data: 'pengiriman_get' // Uses delivery module's get endpoint for raw data
        };

        const MODULE_TITLES = {
            user: 'Manajemen Pengguna', // New
            user_get: 'Data Pengguna',
            user_add: 'Tambah Pengguna',
            user_update: 'Edit Pengguna',
            user_delete: 'Hapus Pengguna',

            rencana: 'Perencanaan Produksi',
            rencana_get: 'Data Perencanaan Produksi',
            rencana_update: 'Update Perencanaan Produksi',
            rencana_delete: 'Hapus Perencanaan Produksi',

            produksi: 'Proses Produksi',
            produksi_get: 'Data Proses Produksi',
            produksi_status: 'Update Status Produksi',
            produksi_delete: 'Hapus Proses Produksi',

            bahanbaku: 'Gudang Bahan Baku',
            bahanbaku_get: 'Data Gudang Bahan Baku',
            bahanbaku_kurangi: 'Kurangi Stok Bahan Baku',
            bahanbaku_delete: 'Hapus Bahan Baku',
            
            produkjadi: 'Gudang Produk Jadi',
            produkjadi_get: 'Data Gudang Produk Jadi',
            produkjadi_keluar: 'Produk Jadi Keluar',
            produkjadi_delete: 'Hapus Produk Jadi',

            pengiriman: 'Distribusi & Pengiriman',
            pengiriman_get: 'Data Distribusi & Pengiriman',
            pengiriman_status: 'Update Status Pengiriman',
            pengiriman_delete: 'Hapus Pengiriman',

            penjualan: 'Penjualan & Pelanggan',
            penjualan_get: 'Data Penjualan & Pelanggan',
            penjualan_status: 'Update Status Penjualan',
            penjualan_delete: 'Hapus Penjualan',

            kpi: 'Laporan Bisnis & KPI', // Main KPI module title
            kpi_produksi_data: 'Laporan KPI Produksi',
            kpi_penjualan_data: 'Laporan KPI Penjualan',
            kpi_distribusi_data: 'Laporan KPI Distribusi',
            all_kpis: 'Ringkasan KPI' // For the general KPI refresh
        };

        const DETAIL_PAGE_MAP = {
            user: { pageId: 'detail-user-page', outputId: 'user-data-output', timeId: 'currentTimeDetailUser' }, // New
            rencana: { pageId: 'detail-rencana-page', outputId: 'rencana-data-output', timeId: 'currentTimeDetailRencana' },
            produksi: { pageId: 'detail-produksi-page', outputId: 'produksi-data-output', timeId: 'currentTimeDetailProduksi' },
            bahanbaku: { pageId: 'detail-bahanbaku-page', outputId: 'bahanbaku-data-output', timeId: 'currentTimeDetailBahanBaku' },
            produkjadi: { pageId: 'detail-produkjadi-page', outputId: 'produkjadi-data-output', timeId: 'currentTimeDetailProdukJadi' },
            pengiriman: { pageId: 'detail-pengiriman-page', outputId: 'pengiriman-data-output', timeId: 'currentTimeDetailPengiriman' },
            penjualan: { pageId: 'detail-penjualan-page', outputId: 'penjualan-data-output', timeId: 'currentTimeDetailPenjualan' },
            kpi: { pageId: 'detail-kpi-page', outputId: 'kpi-data-output', timeId: 'currentTimeDetailKPI' }
        };

        let currentModuleKey = null;
        let currentKpiSourceKey = null; // Stores the API_URLS key (e.g., 'produksi_get') for the last loaded KPI report
        let notificationTimeout;

        document.addEventListener('DOMContentLoaded', function() {
            updateTime();
            setInterval(updateTime, 1000);

            const cards = document.querySelectorAll('.module-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('fade-in');
            });

            checkAuth(); // Call checkAuth on page load

            // Handle login form submission
            document.getElementById('loginForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                performLogin();
            });
        });

        function checkAuth() {
            const isLoggedIn = localStorage.getItem('isLoggedIn');
            const loginPage = document.getElementById('loginPage');
            const dashboardPage = document.getElementById('dashboard-page');

            if (isLoggedIn === 'true') {
                loginPage.style.display = 'none';
                dashboardPage.style.display = 'flex';
                hideAllDetailPages();
            } else {
                loginPage.style.display = 'flex'; // Ensure login page is visible if not logged in
                dashboardPage.style.display = 'none';
                hideAllDetailPages();
            }
        }

        async function performLogin() {
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const loginMessage = document.getElementById('loginMessage');

            const username = usernameInput.value;
            const password = passwordInput.value;

            loginMessage.style.display = 'none';

            if (!username || !password) {
                loginMessage.textContent = 'Nama pengguna dan kata sandi tidak boleh kosong.';
                loginMessage.style.display = 'block';
                return;
            }

            try {
                const response = await fetch(API_URLS.login, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username, password }),
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    localStorage.setItem('isLoggedIn', 'true');
                    localStorage.setItem('userRole', data.user.role); // Store user role if available
                    showSuccessMessage('Login berhasil!');
                    document.getElementById('loginPage').style.display = 'none';
                    document.getElementById('dashboard-page').style.display = 'flex';
                    hideAllDetailPages();
                } else {
                    loginMessage.textContent = data.message || 'Login gagal. Silakan coba lagi.';
                    loginMessage.style.display = 'block';
                    showErrorMessage(data.message || 'Login gagal.');
                    localStorage.setItem('isLoggedIn', 'false');
                }
            } catch (error) {
                loginMessage.textContent = 'Terjadi kesalahan saat menghubungi server. Pastikan server modul login berjalan dan dapat diakses. Detail: ' + error.message;
                loginMessage.style.display = 'block';
                showErrorMessage('Kesalahan jaringan: ' + error.message);
                localStorage.setItem('isLoggedIn', 'false');
            }
        }

        function logout() {
            localStorage.removeItem('isLoggedIn');
            localStorage.removeItem('userRole');
            showSuccessMessage('Anda telah berhasil keluar.');
            currentModuleKey = null;
            currentKpiSourceKey = null; // Reset KPI source on logout

            // Clear all data outputs to ensure a clean state upon re-login
            document.querySelectorAll('.data-table-container').forEach(el => el.innerHTML = `<div class="loading-display"><div class="loading-spinner"></div><p>Pilih modul untuk menampilkan data</p></div>`);
            
            document.getElementById('dashboard-page').style.display = 'none';
            hideAllDetailPages();
            document.getElementById('loginPage').style.display = 'flex'; // Show login page
        }

        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleString('id-ID', {
                day: '2-digit', month: '2-digit', year: 'numeric',
                hour: '2-digit', minute: '2-digit', second: '2-digit'
            });
            const currentTimeElement = document.getElementById('currentTime');
            if (currentTimeElement) {
                currentTimeElement.textContent = timeString;
            }
            for (const key in DETAIL_PAGE_MAP) {
                const timeElement = document.getElementById(DETAIL_PAGE_MAP[key].timeId);
                if (timeElement) {
                    timeElement.textContent = timeString;
                }
            }
        }

        function hideAllPages() {
            document.getElementById('loginPage').style.display = 'none';
            document.getElementById('dashboard-page').style.display = 'none';
            hideAllDetailPages();
        }

        function hideAllDetailPages() {
            for (const key in DETAIL_PAGE_MAP) {
                document.getElementById(DETAIL_PAGE_MAP[key].pageId).style.display = 'none';
            }
        }

        function showDashboard() {
            hideAllDetailPages();
            document.getElementById('loginPage').style.display = 'none';
            document.getElementById('dashboard-page').style.display = 'flex';
            currentModuleKey = null;
            currentKpiSourceKey = null; // Reset KPI source on dashboard return
        }

        function navigateToDetail(module) {
            if (localStorage.getItem('isLoggedIn') !== 'true') {
                showErrorMessage('Anda harus login untuk mengakses modul ini.');
                logout();
                return;
            }

            currentModuleKey = module;
            hideAllPages();
            
            const detailPageInfo = DETAIL_PAGE_MAP[module];
            if (detailPageInfo) {
                document.getElementById(detailPageInfo.pageId).style.display = 'flex';
                document.getElementById(detailPageInfo.pageId).scrollIntoView({ behavior: 'smooth' });

                if (module === 'kpi') {
                    const outputContainer = document.getElementById(detailPageInfo.outputId);
                    outputContainer.innerHTML = `<div class="loading-display"><div class="loading-spinner"></div><p>Pilih jenis KPI untuk menampilkan laporan.</p></div>`;
                    currentKpiSourceKey = null; // Reset for KPI page
                    processAndDisplayKPI('all_kpis', 'Ringkasan KPI'); // Load overall KPI on entering page
                } else {
                    loadDetailData(`${module}_get`, module);
                }
            } else {
                showErrorMessage(`Detail page for module '${module}' not found.`);
                showDashboard();
            }
        }

        async function loadDetailData(apiEndpointKey, moduleKey) {
            const detailPageInfo = DETAIL_PAGE_MAP[moduleKey];
            if (!detailPageInfo) {
                displayError({ message: `Configuration missing for module: ${moduleKey}` }, document.createElement('div'));
                return;
            }
            const outputContainer = document.getElementById(detailPageInfo.outputId);
            
            if (!outputContainer) {
                console.error(`Output container with ID '${detailPageInfo.outputId}' not found.`);
                return;
            }

            showLoading(outputContainer);
            updateSystemStatus('loading');

            try {
                const url = API_URLS[apiEndpointKey];
                if (!url) {
                    throw new Error(`API URL not defined for endpoint: ${apiEndpointKey}`);
                }

                const response = await fetch(url);
                if (!response.ok) {
                    let errorBody = await response.text();
                    try {
                        const errorJson = JSON.parse(errorBody);
                        errorBody = errorJson.message || errorJson.error || errorBody;
                    } catch (e) {
                        // Not a JSON error, use plain text
                    }
                    throw new Error(`HTTP ${response.status}: ${response.statusText}. Detail: ${errorBody}`);
                }
                const data = await response.json();
                displayTableData(data, outputContainer);
                updateSystemStatus('online');
                showSuccessMessage(`Data ${MODULE_TITLES[apiEndpointKey] || MODULE_TITLES[moduleKey] || ''} berhasil dimuat`);
            } catch (error) {
                displayError(error, outputContainer);
                updateSystemStatus('online');
                showErrorMessage(`Gagal memuat data ${MODULE_TITLES[apiEndpointKey] || MODULE_TITLES[moduleKey] || ''}: ${error.message}`);
            }
        }

        /**
         * Processes raw data from module APIs and displays relevant KPI metrics and a simple chart.
         * @param {string} sourceKey The key from API_URLS (e.g., 'produksi_get') or 'all_kpis'.
         * @param {string} displayTitle The title for the KPI report (e.g., 'KPI Produksi').
         */
        async function processAndDisplayKPI(sourceKey, displayTitle) {
            const outputContainer = document.getElementById(DETAIL_PAGE_MAP.kpi.outputId);
            showLoading(outputContainer);
            updateSystemStatus('loading');

            let allKpiData = {
                produksi: [],
                penjualan: [],
                pengiriman: []
            };

            try {
                if (sourceKey === 'all_kpis') {
                    currentKpiSourceKey = 'all_kpis';
                    const [produksiRes, penjualanRes, pengirimanRes] = await Promise.allSettled([
                        fetch(API_URLS.produksi_get),
                        fetch(API_URLS.penjualan_get),
                        fetch(API_URLS.pengiriman_get)
                    ]);

                    if (produksiRes.status === 'fulfilled' && produksiRes.value.ok) {
                        allKpiData.produksi = Array.isArray(await produksiRes.value.json()) ? await produksiRes.value.json() : [];
                    } else {
                        console.error("Gagal memuat data produksi untuk KPI:", produksiRes.reason || (produksiRes.value ? await produksiRes.value.text() : ''));
                        showErrorMessage("Gagal memuat data produksi untuk KPI.");
                    }
                    if (penjualanRes.status === 'fulfilled' && penjualanRes.value.ok) {
                        allKpiData.penjualan = Array.isArray(await penjualanRes.value.json()) ? await penjualanRes.value.json() : [];
                    } else {
                        console.error("Gagal memuat data penjualan untuk KPI:", penjualanRes.reason || (penjualanRes.value ? await penjualanRes.value.text() : ''));
                        showErrorMessage("Gagal memuat data penjualan untuk KPI.");
                    }
                    if (pengirimanRes.status === 'fulfilled' && pengirimanRes.value.ok) {
                        allKpiData.pengiriman = Array.isArray(await pengirimanRes.value.json()) ? await pengirimanRes.value.json() : [];
                    } else {
                        console.error("Gagal memuat data pengiriman untuk KPI:", pengirimanRes.reason || (pengirimanRes.value ? await pengirimanRes.value.text() : ''));
                        showErrorMessage("Gagal memuat data pengiriman untuk KPI.");
                    }
                    displayOverallKPISummary(allKpiData, outputContainer);

                } else {
                    currentKpiSourceKey = sourceKey;
                    const urlToFetch = API_URLS[sourceKey];
                    const response = await fetch(urlToFetch);
                    if (!response.ok) {
                        let errorBody = await response.text();
                        try {
                            const errorJson = JSON.parse(errorBody);
                            errorBody = errorJson.message || errorJson.error || errorBody;
                        } catch (e) { /* Not JSON */ }
                        throw new Error(`HTTP ${response.status}: ${response.statusText}. Detail: ${errorBody}`);
                    }
                    const rawData = await response.json();
                    const processedData = Array.isArray(rawData) ? rawData : (rawData ? [rawData] : []);

                    displaySpecificKPIReport(processedData, outputContainer, displayTitle, sourceKey);
                }
                updateSystemStatus('online');
                showSuccessMessage(`Laporan ${displayTitle} berhasil dimuat.`);

            } catch (error) {
                displayError(error, outputContainer);
                updateSystemStatus('online');
                showErrorMessage(`Gagal memuat laporan ${displayTitle}: ${error.message}`);
            }
        }

        /**
         * Displays the overall KPI summary from all modules.
         * @param {object} kpiData Object containing arrays of raw data for produksi, penjualan, pengiriman.
         * @param {HTMLElement} outputElement The container to display the KPI cards and charts.
         */
        function displayOverallKPISummary(kpiData, outputElement) {
            let htmlContent = '<h3>Ringkasan Kinerja Bisnis</h3><div class="kpi-metrics-grid">';
            let productionTrend = [];
            let salesTrend = [];
            let deliveryTrend = [];

            // Production KPIs
            const totalUnits = (kpiData.produksi || []).reduce((sum, item) => sum + (parseInt(item.jumlah_unit) || 0), 0);
            const completedProductions = (kpiData.produksi || []).filter(item => item.status_produksi === 'Selesai').length;
            const inProgressProductions = (kpiData.produksi || []).filter(item => item.status_produksi === 'Dalam Proses').length;
            
            htmlContent += renderKPICard('Total Unit Produksi', totalUnits, 'Unit berhasil diproduksi.', 'fas fa-factory', '', 1500);
            htmlContent += renderKPICard('Produksi Selesai', completedProductions, 'Proses produksi selesai.', 'fas fa-check-circle', '', (kpiData.produksi || []).length);
            // Dummy data for production trend (replace with actual historical data if available)
            productionTrend = [
                { label: 'Jan', value: 800 }, { label: 'Feb', value: 950 }, { label: 'Mar', value: 1100 },
                { label: 'Apr', value: 900 }, { label: 'Mei', value: 1200 }, { label: 'Jun', value: totalUnits }
            ];

            // Sales KPIs
            const totalRevenue = (kpiData.penjualan || []).reduce((sum, item) => sum + (parseFloat(item.total_harga) || 0), 0);
            const totalOrders = (kpiData.penjualan || []).length;
            const completedOrders = (kpiData.penjualan || []).filter(item => item.status_pesanan === 'Selesai').length;
            
            htmlContent += renderKPICard('Total Pendapatan', `Rp ${totalRevenue.toLocaleString('id-ID')}`, 'Total penjualan bersih.', 'fas fa-money-bill-wave', '', 50000000);
            htmlContent += renderKPICard('Pesanan Selesai', completedOrders, 'Jumlah pesanan yang sudah dibayar.', 'fas fa-shopping-cart', '', totalOrders);
             // Dummy data for sales trend (replace with actual historical data if available)
            salesTrend = [
                { label: 'Jan', value: 20000000 }, { label: 'Feb', value: 25000000 }, { label: 'Mar', value: 30000000 },
                { label: 'Apr', value: 22000000 }, { label: 'Mei', value: 35000000 }, { label: 'Jun', value: totalRevenue }
            ];

            // Distribution KPIs
            const totalDeliveries = (kpiData.pengiriman || []).length;
            const deliveredSuccess = (kpiData.pengiriman || []).filter(item => item.status_pengiriman === 'Terkirim').length;
            const deliveredFailed = (kpiData.pengiriman || []).filter(item => item.status_pengiriman === 'Gagal').length;
            const avgDeliveryTime = calculateAvgDeliveryTime(kpiData.pengiriman || []);

            htmlContent += renderKPICard('Pengiriman Berhasil', deliveredSuccess, 'Jumlah pengiriman sukses.', 'fas fa-truck', '', totalDeliveries);
            htmlContent += renderKPICard('Pengiriman Gagal', deliveredFailed, 'Jumlah pengiriman yang gagal.', 'fas fa-exclamation-triangle', 'red', totalDeliveries);
            htmlContent += renderKPICard('Rata-rata Waktu Kirim', `${avgDeliveryTime} hari`, 'Estimasi rata-rata waktu pengiriman.', 'fas fa-clock', '', 7);
            // Dummy data for delivery success rate trend (replace with actual historical data if available)
            deliveryTrend = [
                { label: 'Jan', value: 90 }, { label: 'Feb', value: 92 }, { label: 'Mar', value: 88 },
                { label: 'Apr', value: 95 }, { label: 'Mei', value: 91 }, { label: 'Jun', value: (deliveredSuccess / totalDeliveries * 100) || 0 }
            ];

            htmlContent += '</div>'; // close kpi-metrics-grid

            // Add combined charts for overall view
            htmlContent += renderLineChart(productionTrend, 'Tren Produksi Bulanan (Unit)');
            htmlContent += renderLineChart(salesTrend, 'Tren Penjualan Bulanan (Rp)');
            htmlContent += renderLineChart(deliveryTrend, 'Persentase Pengiriman Berhasil (%)');

            outputElement.innerHTML = htmlContent;
        }

        /**
         * Displays a specific KPI report with its metrics and chart.
         * @param {Array} processedData The raw data array for the specific module.
         * @param {HTMLElement} outputElement The container to display the KPI report.
         * @param {string} displayTitle The title for this specific KPI report.
         * @param {string} sourceKey The API source key (e.g., 'produksi_get').
         */
        function displaySpecificKPIReport(processedData, outputElement, displayTitle, sourceKey) {
            let kpiMetricsHtml = `<h3>${displayTitle}</h3><div class="kpi-metrics-grid">`;
            let chartHtml = '';
            let hasData = processedData.length > 0;

            if (sourceKey === 'produksi_get') {
                const totalUnits = processedData.reduce((sum, item) => sum + (parseInt(item.jumlah_unit) || 0), 0);
                const completedProductions = processedData.filter(item => item.status_produksi === 'Selesai').length;
                const inProgressProductions = processedData.filter(item => item.status_produksi === 'Dalam Proses').length;

                const productionTrend = [
                    { label: 'Jan', value: 800 }, { label: 'Feb', value: 950 }, { label: 'Mar', value: 1100 },
                    { label: 'Apr', value: 900 }, { label: 'Mei', value: 1200 }, { label: 'Jun', value: totalUnits }
                ];

                kpiMetricsHtml += `
                    ${renderKPICard('Total Unit Produksi', totalUnits, 'Total unit yang diproduksi.', 'fas fa-factory', '', 1500)}
                    ${renderKPICard('Produksi Selesai', completedProductions, 'Jumlah proses produksi yang telah selesai.', 'fas fa-check-circle', '', processedData.length)}
                    ${renderKPICard('Dalam Proses', inProgressProductions, 'Jumlah proses produksi yang sedang berjalan.', 'fas fa-spinner', 'orange', processedData.length)}
                `;
                chartHtml += renderLineChart(productionTrend, 'Tren Produksi Bulanan (Unit)');

            } else if (sourceKey === 'penjualan_get') {
                const totalRevenue = processedData.reduce((sum, item) => sum + (parseFloat(item.total_harga) || 0), 0);
                const totalOrders = processedData.length;
                const completedOrders = processedData.filter(item => item.status_pesanan === 'Selesai').length;
                const pendingOrders = processedData.filter(item => item.status_pesanan !== 'Selesai').length;

                const salesTrend = [
                    { label: 'Jan', value: 20000000 }, { label: 'Feb', value: 25000000 }, { label: 'Mar', value: 30000000 },
                    { label: 'Apr', value: 22000000 }, { label: 'Mei', value: 35000000 }, { label: 'Jun', value: totalRevenue }
                ];

                kpiMetricsHtml += `
                    ${renderKPICard('Total Pendapatan', `Rp ${totalRevenue.toLocaleString('id-ID')}`, 'Total penjualan bersih.', 'fas fa-money-bill-wave', '', 50000000)}
                    ${renderKPICard('Pesanan Selesai', completedOrders, 'Jumlah pesanan yang sudah dibayar dan diproses.', 'fas fa-shopping-cart', '', totalOrders)}
                    ${renderKPICard('Pesanan Tertunda', pendingOrders, 'Jumlah pesanan yang belum selesai.', 'fas fa-hourglass-half', 'orange', totalOrders)}
                `;
                chartHtml += renderLineChart(salesTrend, 'Tren Penjualan Bulanan (Rp)');

            } else if (sourceKey === 'pengiriman_get') {
                const totalDeliveries = processedData.length;
                const deliveredSuccess = processedData.filter(item => item.status_pengiriman === 'Terkirim').length;
                const deliveredFailed = processedData.filter(item => item.status_pengiriman === 'Gagal').length;
                const avgDeliveryTime = calculateAvgDeliveryTime(processedData);

                const deliveryTrend = [
                    { label: 'Jan', value: 90 }, { label: 'Feb', value: 92 }, { label: 'Mar', value: 88 },
                    { label: 'Apr', value: 95 }, { label: 'Mei', value: 91 }, { label: 'Jun', value: (deliveredSuccess / totalDeliveries * 100) || 0 }
                ];

                kpiMetricsHtml += `
                    ${renderKPICard('Pengiriman Berhasil', deliveredSuccess, 'Jumlah pengiriman yang sukses.', 'fas fa-truck', '', totalDeliveries)}
                    ${renderKPICard('Pengiriman Gagal', deliveredFailed, 'Jumlah pengiriman yang gagal atau dikembalikan.', 'fas fa-exclamation-triangle', 'red', totalDeliveries)}
                    ${renderKPICard('Rata-rata Waktu Kirim', `${avgDeliveryTime} hari`, 'Estimasi rata-rata waktu pengiriman.', 'fas fa-clock', '', 7)}
                `;
                chartHtml += renderLineChart(deliveryTrend, 'Persentase Pengiriman Berhasil (%)');
            } else {
                kpiMetricsHtml = `<div class="loading-display"><p>Tidak ada laporan KPI yang cocok untuk ${displayTitle}.</p></div>`;
                hasData = false;
            }

            kpiMetricsHtml += '</div>'; // Close kpi-metrics-grid
            outputElement.innerHTML = `${kpiMetricsHtml}${chartHtml}`;

            if (!hasData) {
                outputElement.innerHTML = `<div class="loading-display"><p>Tidak ada data untuk menampilkan laporan ${displayTitle}.</p></div>`;
            }
        }


        // Helper to render a KPI card
        const renderKPICard = (title, value, description, iconClass, colorClass = '', maxValue = 1) => {
            let percentage = 0;
            if (typeof value === 'number' && maxValue > 0) {
                percentage = (value / maxValue) * 100;
            } else if (typeof value === 'string' && value.includes('Rp') && maxValue > 0) {
                 // For currency, extract number and calculate
                const numValue = parseFloat(value.replace(/[^0-9,-]+/g,"").replace(",", "."));
                if (!isNaN(numValue)) {
                    percentage = (numValue / maxValue) * 100;
                }
            }
            percentage = Math.min(100, Math.max(0, percentage)); // Cap between 0 and 100

            return `
                <div class="kpi-card">
                    <h4>${title}</h4>
                    <div class="kpi-value">
                        <i class="${iconClass}"></i>
                        <span>${value}</span>
                    </div>
                    <p class="kpi-description">${description}</p>
                    <div class="kpi-graph">
                        <div class="kpi-bar ${colorClass}" style="width: ${percentage}%;"></div>
                    </div>
                </div>
            `;
        };

        // Helper to render a simple line chart (as bar chart for simplicity here)
        const renderLineChart = (data, title) => {
            if (!data || data.length === 0) {
                return '<p style="text-align: center; color: #6b7280; margin-top: 1rem;">Tidak ada data untuk grafik.</p>';
            }

            const maxVal = Math.max(...data.map(d => d.value));
            const chartBars = data.map(point => {
                const height = maxVal > 0 ? (point.value / maxVal) * 100 : 0;
                return `
                    <div class="line-chart-bar" style="height: ${height}%;">
                        <span>${point.value.toLocaleString('id-ID')}</span>
                        <div class="line-chart-label">${point.label}</div>
                    </div>
                `;
            }).join('');

            return `
                <div style="margin-top: 2rem;">
                    <h4>${title}</h4>
                    <div class="kpi-line-chart">
                        ${chartBars}
                    </div>
                </div>
            `;
        };

        // Dummy function to calculate average delivery time (replace with actual logic if dates are available)
        function calculateAvgDeliveryTime(deliveryData) {
            // For demonstration, assume 3 days avg, or calculate if data has start/end dates
            if (deliveryData && deliveryData.length > 0) {
                // Example: if data had 'order_date' and 'delivery_date'
                // let totalDays = 0;
                // let deliveredCount = 0;
                // deliveryData.forEach(item => {
                //     if (item.order_date && item.delivery_date) {
                //         const orderDate = new Date(item.order_date);
                //         const deliveryDate = new Date(item.delivery_date);
                //         const diffTime = Math.abs(deliveryDate - orderDate);
                //         const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                //         totalDays += diffDays;
                //         deliveredCount++;
                //     }
                // });
                // return deliveredCount > 0 ? (totalDays / deliveredCount).toFixed(1) : 'N/A';
                return 3.5; // Placeholder
            }
            return 'N/A';
        }


        function showLoading(outputElement) {
            outputElement.innerHTML = `
                <div class="loading-display">
                    <div class="loading-spinner"></div>
                    <p>Mengambil data dari server...</p>
                </div>
            `;
        }

        function displayTableData(data, outputElement) {
            if (!data || (Array.isArray(data) && data.length === 0)) {
                outputElement.innerHTML = `<div class="loading-display"><p>Tidak ada data untuk ditampilkan.</p></div>`;
                return;
            }

            const dataArray = Array.isArray(data) ? data : [data];

            const table = document.createElement('table');
            table.classList.add('data-table');

            const thead = table.createTHead();
            const headerRow = thead.insertRow();
            // Define desired order and display names for user management table
            const userTableKeys = ['id_user', 'username', 'role', 'created_at'];
            const allKeys = [...new Set(dataArray.flatMap(obj => Object.keys(obj)))]; // Fallback for other modules

            let displayKeys;
            if (outputElement.id === 'user-data-output') {
                displayKeys = userTableKeys;
            } else {
                displayKeys = allKeys;
            }
            
            displayKeys.forEach(key => {
                const th = document.createElement('th');
                th.textContent = formatHeader(key);
                headerRow.appendChild(th);
            });

            const tbody = table.createTBody();
            dataArray.forEach(item => {
                const row = tbody.insertRow();
                displayKeys.forEach(key => {
                    const cell = row.insertCell();
                    // Custom display for known JSON/array fields
                    if (key === 'bahan_terpakai' || key === 'produk_dikirim' || key === 'produk_dibeli') {
                        try {
                            const parsed = JSON.parse(item[key]);
                            if (Array.isArray(parsed)) {
                                cell.innerHTML = `<ul>${parsed.map(i => `<li>${i.nama_item || i.nama || 'Item'} (${i.jumlah || i.qty || '-'})</li>`).join('')}</ul>`;
                            } else if (typeof parsed === 'object' && parsed !== null) {
                                // For single JSON objects like {nama: "...", jumlah: "..."}, try to format as list item
                                const parts = [];
                                if (parsed.nama_item) parts.push(parsed.nama_item);
                                else if (parsed.nama) parts.push(parsed.nama);
                                if (parsed.jumlah) parts.push(`(${parsed.jumlah})`);
                                else if (parsed.qty) parts.push(`(${parsed.qty})`);
                                
                                if (parts.length > 0) {
                                    cell.textContent = parts.join(' ');
                                } else {
                                    cell.textContent = JSON.stringify(parsed);
                                }
                            } else {
                                cell.textContent = item[key] !== undefined && item[key] !== null ? item[key] : '-';
                            }
                        } catch (e) {
                            cell.textContent = item[key] !== undefined && item[key] !== null ? item[key] : '-';
                        }
                    } else if (key === 'password') {
                        cell.textContent = '********'; // Hide passwords
                    } 
                    else if (key === 'id_user' && item.user_id) { // Handle potential user_id instead of id_user
                        cell.textContent = item.user_id;
                    }
                    else {
                        cell.textContent = item[key] !== undefined && item[key] !== null ? item[key] : '-';
                    }
                });
            });

            outputElement.innerHTML = '';
            outputElement.appendChild(table);
        }

        function formatHeader(key) {
            // Specific formatting for user management keys
            if (key === 'id_user') return 'ID User';
            if (key === 'created_at') return 'Created At';

            return key.replace(/_/g, ' ').replace(/\b\w/g, char => char.toUpperCase());
        }

        function displayError(error, outputElement) {
            outputElement.innerHTML = `
                <div class="error-display">
                    <h3><i class="fas fa-exclamation-triangle"></i> Error Loading Data</h3>
                    <p><strong>Error:</strong> ${error.message}</p>
                    <p><strong>Module:</strong> ${MODULE_TITLES[currentModuleKey] || 'Tidak diketahui'}</p>
                    <p><strong>Time:</strong> ${new Date().toLocaleString('id-ID')}</p>
                    <hr style="margin: 1rem 0; border: none; height: 1px; background: rgba(239, 68, 68, 0.3);">
                    <p><small>Pastikan server modul sedang berjalan dan dapat diakses, serta responsnya adalah JSON yang valid.</small></p>
                </div>
            `;
        }

        function refreshCurrentData() {
            if (currentModuleKey === 'kpi') {
                // For KPI, always refresh the currently displayed KPI or the overall summary if none was selected
                processAndDisplayKPI(currentKpiSourceKey || 'all_kpis', MODULE_TITLES[currentKpiSourceKey] || 'Ringkasan KPI');
            } else if (currentModuleKey) {
                // For other modules, use their regular get endpoint
                loadDetailData(`${currentModuleKey}_get`, currentModuleKey);
            } else {
                showErrorMessage('Tidak ada modul yang dipilih untuk di-refresh.');
            }
        }

        async function handleAction(actionKey, moduleKey) {
            if (localStorage.getItem('isLoggedIn') !== 'true') {
                showErrorMessage('Anda harus login untuk melakukan tindakan ini.');
                logout();
                return;
            }

            const url = API_URLS[actionKey];
            if (!url) {
                showErrorMessage(`Aksi API tidak didefinisikan untuk: ${actionKey}`);
                return;
            }

            let method = 'POST';
            let bodyData = {};
            let itemId = null;
            const userRole = localStorage.getItem('userRole');

            // Permission check for User Management actions
            if (moduleKey === 'user' && userRole !== 'admin') {
                showErrorMessage('Anda tidak memiliki izin untuk mengelola pengguna.');
                return;
            }

            switch (actionKey) {
                case 'user_add':
                    const newUsername = prompt('Masukkan Nama Pengguna baru:');
                    if (!newUsername) { showErrorMessage('Nama Pengguna tidak boleh kosong.'); return; }
                    const newPassword = prompt('Masukkan Kata Sandi untuk pengguna baru:');
                    if (!newPassword) { showErrorMessage('Kata Sandi tidak boleh kosong.'); return; }
                    const newRole = prompt('Masukkan Role (admin, operator, viewer) untuk pengguna baru:');
                    if (!newRole || !['admin', 'operator', 'viewer'].includes(newRole.toLowerCase())) { 
                        showErrorMessage('Role tidak valid. Harus admin, operator, atau viewer.'); return; 
                    }
                    bodyData = { username: newUsername, password: newPassword, role: newRole };
                    method = 'POST';
                    break;
                case 'user_update':
                    itemId = prompt('Masukkan ID Pengguna yang akan di-update:');
                    if (!itemId) { showErrorMessage('ID Pengguna tidak boleh kosong.'); return; }
                    const currentData = (await (await fetch(API_URLS.user_get)).json()).find(u => (u.id_user || u.id) == itemId);
                    if (!currentData) { showErrorMessage('Pengguna dengan ID tersebut tidak ditemukan.'); return; }

                    const updatedUsername = prompt(`Masukkan Nama Pengguna baru (saat ini: ${currentData.username || '-'}, kosongkan jika tidak diubah):`);
                    const updatedPassword = prompt('Masukkan Kata Sandi baru (kosongkan jika tidak diubah):');
                    const updatedRole = prompt(`Masukkan Role baru (saat ini: ${currentData.role || '-'}, kosongkan jika tidak diubah):`);
                    
                    bodyData = { id: itemId };
                    if (updatedUsername) bodyData.username = updatedUsername;
                    if (updatedPassword) bodyData.password = updatedPassword;
                    if (updatedRole && ['admin', 'operator', 'viewer'].includes(updatedRole.toLowerCase())) bodyData.role = updatedRole;
                    else if (updatedRole) { showErrorMessage('Role tidak valid. Harus admin, operator, atau viewer.'); return; }

                    if (Object.keys(bodyData).length === 1 && bodyData.id) {
                        showErrorMessage('Tidak ada data yang diubah. Aksi dibatalkan.');
                        return;
                    }
                    method = 'PUT'; // Assuming PUT for update
                    break;
                case 'user_delete':
                    itemId = prompt('Masukkan ID Pengguna yang akan dihapus:');
                    if (!itemId) { showErrorMessage('ID Pengguna tidak boleh kosong.'); return; }
                    if (!confirm(`Anda yakin ingin menghapus pengguna dengan ID ${itemId}?`)) {
                        showErrorMessage('Aksi hapus dibatalkan.');
                        return;
                    }
                    bodyData = { id: itemId };
                    method = 'DELETE';
                    break;
                case 'rencana_update':
                    itemId = prompt('Masukkan ID Rencana Produksi yang akan di-update:');
                    if (!itemId) { showErrorMessage('ID tidak boleh kosong.'); return; }
                    const newPlan = prompt('Masukkan data update (JSON, e.g., {"field":"value"}):');
                    try {
                        bodyData = { ...JSON.parse(newPlan), id: itemId };
                    } catch (e) {
                        showErrorMessage('Format JSON tidak valid.');
                        return;
                    }
                    method = 'PUT';
                    break;
                case 'produksi_status':
                case 'pengiriman_status':
                case 'penjualan_status':
                    itemId = prompt(`Masukkan ID untuk ${MODULE_TITLES[moduleKey]} yang akan diubah statusnya:`);
                    if (!itemId) { showErrorMessage('ID tidak boleh kosong.'); return; }
                    const newStatus = prompt(`Masukkan status baru untuk ID ${itemId}:`);
                    if (!newStatus) { showErrorMessage('Status tidak boleh kosong.'); return; }
                    bodyData = { id: itemId, status: newStatus };
                    method = 'PUT'; // Or PATCH depending on API design
                    break;
                case 'bahanbaku_kurangi':
                case 'produkjadi_keluar':
                    itemId = prompt(`Masukkan ID untuk ${MODULE_TITLES[moduleKey]} yang stoknya akan dikurangi:`);
                    if (!itemId) { showErrorMessage('ID tidak boleh kosong.'); return; }
                    const quantity = prompt(`Masukkan jumlah yang akan dikurangi/dikeluarkan untuk ID ${itemId}:`);
                    if (!quantity || isNaN(quantity) || parseInt(quantity) <= 0) {
                        showErrorMessage('Jumlah harus angka positif.');
                        return;
                    }
                    bodyData = { id: itemId, quantity: parseInt(quantity) };
                    method = 'POST'; // Or PUT/PATCH
                    break;
                case 'rencana_delete':
                case 'produksi_delete':
                case 'bahanbaku_delete':
                case 'produkjadi_delete':
                case 'pengiriman_delete':
                case 'penjualan_delete':
                    itemId = prompt(`Masukkan ID untuk ${MODULE_TITLES[moduleKey]} yang akan dihapus:`);
                    if (!itemId) { showErrorMessage('ID tidak boleh kosong.'); return; }
                    if (!confirm(`Anda yakin ingin menghapus item dengan ID ${itemId} dari ${MODULE_TITLES[moduleKey]}?`)) {
                        showErrorMessage('Aksi hapus dibatalkan.');
                        return;
                    }
                    bodyData = { id: itemId };
                    method = 'DELETE';
                    break;
                default:
                    showErrorMessage('Aksi tidak dikenal.');
                    return;
            }

            showNotificationDebounced(`Melakukan aksi '${MODULE_TITLES[actionKey] || actionKey}'...`, 'loading');
            updateSystemStatus('loading');

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: { 'Content-Type': 'application/json' },
                    body: (method !== 'GET' && method !== 'DELETE') ? JSON.stringify(bodyData) : null,
                });

                const data = await response.json();

                if (response.ok) {
                    showSuccessMessage(data.message || `${MODULE_TITLES[actionKey] || actionKey} berhasil.`);
                    // Refresh data after successful action
                    if (moduleKey === 'user') {
                        loadDetailData('user_get', 'user');
                    } else if (moduleKey === 'kpi') {
                         // If it was a KPI action (shouldn't happen with current setup, but good for safety)
                         processAndDisplayKPI(currentKpiSourceKey || 'all_kpis', MODULE_TITLES[currentKpiSourceKey] || 'Ringkasan KPI');
                    }
                    else {
                        loadDetailData(`${moduleKey}_get`, moduleKey);
                    }
                } else {
                    throw new Error(data.message || `API Error: HTTP ${response.status}`);
                }
            } catch (error) {
                showErrorMessage(`${MODULE_TITLES[actionKey] || actionKey} gagal: ${error.message}`);
            } finally {
                updateSystemStatus('online');
            }
        }

        function updateSystemStatus(status) {
            const statusIndicators = document.querySelectorAll('.status-indicator');
            statusIndicators.forEach(statusIndicator => {
                const statusDot = statusIndicator.querySelector('.status-dot');
                const statusText = statusIndicator.querySelector('span');

                if (statusDot && statusText) {
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
            });
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

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
        }, 200);

        function showSuccessMessage(message) {
            showNotificationDebounced(message, 'success');
        }

        function showErrorMessage(message) {
            showNotificationDebounced(message, 'error');
        }

        document.addEventListener('keydown', (event) => {
            if (document.getElementById('loginPage').style.display === 'none') {
                event.preventDefault();

                switch (event.key.toLowerCase()) {
                    case 'r':
                        refreshCurrentData();
                        break;
                    case 'u': // User Management
                        navigateToDetail('user');
                        break;
                    case 'p':
                        navigateToDetail('rencana');
                        break;
                    case 'o':
                        navigateToDetail('produksi');
                        break;
                    case 'b':
                        navigateToDetail('bahanbaku');
                        break;
                    case 'j':
                        navigateToDetail('produkjadi');
                        break;
                    case 'k':
                        navigateToDetail('pengiriman');
                        break;
                    case 's':
                        navigateToDetail('penjualan');
                        break;
                    case 'i':
                        navigateToDetail('kpi');
                        break;
                    case 'l':
                        logout();
                        break;
                    case 'escape':
                        showDashboard();
                        break;
                    default:
                        break;
                }
            }
        });
    </script>
</body>
</html>
