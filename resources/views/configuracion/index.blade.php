<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - Sistema de Préstamos</title>
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
        .config-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #2a2a2a;
        }
        .config-item:last-child {
            border-bottom: none;
        }
        .config-label {
            display: flex;
            flex-direction: column;
        }
        .config-label h3 {
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .config-label p {
            color: #888;
            font-size: 12px;
        }
        .btn-primary-custom {
            background: #0d6efd;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-primary-custom:hover {
            background: #0b5ed7;
        }
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
            .page-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
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

    <div class="main-content" id="mainContent">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-title">Principal</div>
            <div class="sidebar-menu">
                <a href="{{ route('dashboard') }}" data-section="dashboard">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('equipos.index') }}" data-section="equipos">
                    <i class="fas fa-laptop"></i> Equipos
                </a>
                <a href="{{ route('prestamos.index') }}" data-section="prestamos">
                    <i class="fas fa-exchange-alt"></i> Préstamos
                </a>
                <a href="{{ route('alumnos.index') }}" data-section="alumnos">
                    <i class="fas fa-users"></i> Alumnos
                </a>
            </div>

            <div class="sidebar-title">Sistema</div>
            <div class="sidebar-menu">
                <a href="{{ route('reportes.index') }}" data-section="reportes">
                    <i class="fas fa-chart-bar"></i> Reportes
                </a>
                <a href="{{ route('configuracion.index') }}" class="active" data-section="configuracion">
                    <i class="fas fa-cog"></i> Configuración
                </a>
            </div>
        </div>

        <div class="content">
            <div class="page-header">
                <h1><i class="fas fa-cog"></i> Configuración del Sistema</h1>
                <p>Administra la configuración general de la aplicación</p>
            </div>

            <div class="section">
                <div class="section-title">
                    <i class="fas fa-sliders-h"></i>
                    Configuración General
                </div>

                <div class="config-item">
                    <div class="config-label">
                        <h3>Nombre de la Institución</h3>
                        <p>Nombre que aparece en el sistema</p>
                    </div>
                    <button class="btn-primary-custom"><i class="fas fa-edit"></i> Editar</button>
                </div>

                <div class="config-item">
                    <div class="config-label">
                        <h3>Email de Contacto</h3>
                        <p>Email para notificaciones del sistema</p>
                    </div>
                    <button class="btn-primary-custom"><i class="fas fa-edit"></i> Editar</button>
                </div>

                <div class="config-item">
                    <div class="config-label">
                        <h3>Teléfono de Contacto</h3>
                        <p>Número para consultas</p>
                    </div>
                    <button class="btn-primary-custom"><i class="fas fa-edit"></i> Editar</button>
                </div>

                <div class="config-item">
                    <div class="config-label">
                        <h3>Dirección</h3>
                        <p>Ubicación física de la institución</p>
                    </div>
                    <button class="btn-primary-custom"><i class="fas fa-edit"></i> Editar</button>
                </div>
            </div>

            <div class="section">
                <div class="section-title">
                    <i class="fas fa-lock"></i>
                    Seguridad
                </div>

                <div class="config-item">
                    <div class="config-label">
                        <h3>Cambiar Contraseña</h3>
                        <p>Actualiza tu contraseña de acceso</p>
                    </div>
                    <button class="btn-primary-custom"><i class="fas fa-key"></i> Cambiar</button>
                </div>

                <div class="config-item">
                    <div class="config-label">
                        <h3>Respaldos de Base de Datos</h3>
                        <p>Realiza copias de seguridad</p>
                    </div>
                    <button class="btn-primary-custom"><i class="fas fa-download"></i> Respaldar</button>
                </div>
            </div>

            <div class="section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Acerca del Sistema
                </div>
                <div style="color: #aaa; font-size: 14px; line-height: 1.8;">
                    <p><strong>Versión:</strong> 1.0.0</p>
                    <p><strong>Última Actualización:</strong> 04/05/2026</p>
                    <p><strong>Desarrollador:</strong> Sistema de Gestión de Préstamos - UPQ</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        let sidebarCollapsed = false;

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

        window.addEventListener('load', function() {
            const wasCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (wasCollapsed) {
                sidebarToggle.click();
            }
        });

        sidebar.style.transition = 'all 0.3s ease';
    </script>
</body>
</html>

