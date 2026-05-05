<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Préstamos')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0f0f0f;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar */
        .navbar-dark {
            background: linear-gradient(90deg, #1a1a1a 0%, #252525 100%);
            border-bottom: 1px solid #333;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: 700;
            color: #fff !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand i {
            color: #0d6efd;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info {
            text-align: right;
            color: #aaa;
            font-size: 13px;
        }

        .user-info .user-name {
            color: #fff;
            font-weight: 600;
            font-size: 14px;
        }

        .logout-btn {
            background: #8b3a3a;
            border: none;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #a84a4a;
        }

        /* Toggle Button */
        .sidebar-toggle-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            margin-right: 20px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle-btn:hover {
            color: #0d6efd;
        }

        /* Main Container */
        .main-content {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 0;
            min-height: calc(100vh - 70px);
            transition: grid-template-columns 0.3s ease;
        }

        .main-content.sidebar-collapsed {
            grid-template-columns: 0px 1fr;
        }

        /* Sidebar */
        .sidebar {
            background: #1a1a1a;
            border-right: 1px solid #333;
            padding: 30px 20px;
            overflow-y: auto;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            width: 0;
            padding: 0;
            opacity: 0;
        }

        .sidebar-title {
            font-size: 12px;
            font-weight: 700;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 15px;
            margin-top: 25px;
            padding-left: 10px;
        }

        .sidebar-title:first-child {
            margin-top: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #aaa;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .sidebar-menu a:hover {
            background: #2a2a2a;
            color: #0d6efd;
        }

        .sidebar-menu a.active {
            background: #0d6efd;
            color: #fff;
        }

        .sidebar-menu i {
            width: 20px;
            text-align: center;
        }

        /* Content Area */
        .content {
            padding: 40px;
            overflow-y: auto;
        }

        .page-header {
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 32px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #888;
            font-size: 14px;
        }

        /* Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, #1f1f1f 0%, #252525 100%);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: #0d6efd;
            box-shadow: 0 5px 20px rgba(13, 110, 253, 0.1);
            transform: translateY(-3px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stat-icon.blue {
            background: #0d6efd;
            color: #fff;
        }

        .stat-icon.green {
            background: #198754;
            color: #fff;
        }

        .stat-icon.orange {
            background: #fd7e14;
            color: #fff;
        }

        .stat-icon.purple {
            background: #6f42c1;
            color: #fff;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 13px;
            color: #888;
            text-transform: uppercase;
        }

        /* Sections */
        .section {
            background: linear-gradient(135deg, #1f1f1f 0%, #252525 100%);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #0d6efd;
        }

        /* Tables */
        .table-dark {
            background: transparent;
            color: #e0e0e0;
        }

        .table-dark thead {
            border-bottom: 2px solid #333;
        }

        .table-dark th {
            color: #aaa;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            padding: 15px 10px;
            background: transparent;
        }

        .table-dark td {
            padding: 15px 10px;
            border-bottom: 1px solid #2a2a2a;
            vertical-align: middle;
        }

        .table-dark tbody tr:hover {
            background: #1a1a1a;
        }

        .badge-success {
            background: #198754;
        }

        .badge-warning {
            background: #fd7e14;
        }

        /* Buttons */
        .btn-primary-custom {
            background: #0d6efd;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-custom:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        ::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .content {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 24px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-dark">
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <div style="display: flex; align-items: center;">
                <button class="sidebar-toggle-btn" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="navbar-brand">
                    <i class="fas fa-book"></i>
                    Sistema de Préstamos
                </div>
            </div>
            <div class="nav-user">
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name ?? 'Usuario' }}</div>
                    <div>Administrador</div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-title">Principal</div>
            <div class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" data-section="dashboard">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('equipos.index') }}" class="{{ request()->routeIs('equipos.index') ? 'active' : '' }}" data-section="equipos">
                    <i class="fas fa-laptop"></i> Equipos
                </a>
                <a href="{{ route('prestamos.index') }}" class="{{ request()->routeIs('prestamos.index') ? 'active' : '' }}" data-section="prestamos">
                    <i class="fas fa-exchange-alt"></i> Préstamos
                </a>
                <a href="{{ route('alumnos.index') }}" class="{{ request()->routeIs('alumnos.index') ? 'active' : '' }}" data-section="alumnos">
                    <i class="fas fa-users"></i> Alumnos
                </a>
            </div>

            <div class="sidebar-title">Sistema</div>
            <div class="sidebar-menu">
                <a href="{{ route('reportes.index') }}" class="{{ request()->routeIs('reportes.index') ? 'active' : '' }}" data-section="reportes">
                    <i class="fas fa-chart-bar"></i> Reportes
                </a>
                <a href="{{ route('configuracion.index') }}" class="{{ request()->routeIs('configuracion.index') ? 'active' : '' }}" data-section="configuracion">
                    <i class="fas fa-cog"></i> Configuración
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        let sidebarCollapsed = false;

        // Check local storage for sidebar state on load
        const storedSidebarState = localStorage.getItem('sidebarCollapsed');
        if (storedSidebarState === 'true') {
            sidebarCollapsed = true;
            sidebar.classList.add('collapsed');
            mainContent.classList.add('sidebar-collapsed');
            sidebarToggle.innerHTML = '<i class="fas fa-chevron-right"></i>';
        } else {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('sidebar-collapsed');
            sidebarToggle.innerHTML = '<i class="fas fa-bars"></i>';
        }

        sidebarToggle.addEventListener('click', function() {
            sidebarCollapsed = !sidebarCollapsed;

            if (sidebarCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('sidebar-collapsed');
                sidebarToggle.innerHTML = '<i class="fas fa-chevron-right"></i>';
                localStorage.setItem('sidebarCollapsed', 'true');
            } else {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('sidebar-collapsed');
                sidebarToggle.innerHTML = '<i class="fas fa-bars"></i>';
                localStorage.setItem('sidebarCollapsed', 'false');
            }
        });

        // Add active class to sidebar links based on current route
        const currentPath = window.location.pathname;
        const sidebarLinks = document.querySelectorAll('.sidebar-menu a');
        sidebarLinks.forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        sidebar.style.transition = 'all 0.3s ease';
    </script>
    @yield('scripts')
</body>
</html>
