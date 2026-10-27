<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración y Seguridad • SENA Empresa ERP</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS, Icons & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('general/assets/img/cefaempresa.png') }}">

    <style>
        :root {
            --sena-green: #39A900;
            --sena-green-hover: #2d8500;
            --sena-neon: #62E31D;
            --sena-dark: #00131E;
            --sena-navy: #001A29;
            --sena-light-navy: #00324D;
            --admin-cyan: #00b4d8;
            --admin-blue: #0077b6;
        }

        body {
            font-family: 'Poppins', 'Nunito', sans-serif;
            background-color: #f8faf9;
            color: #2c3e50;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top Navbar */
        .navbar-admin {
            background: linear-gradient(135deg, var(--sena-dark) 0%, var(--sena-navy) 100%);
            border-bottom: 3px solid var(--admin-cyan);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            padding: 12px 0;
            transition: all 0.3s ease;
        }

        .navbar-admin .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 14px !important;
            transition: all 0.25s ease;
            border-radius: 8px;
        }

        .navbar-admin .nav-link:hover,
        .navbar-admin .nav-link.active {
            color: var(--admin-cyan) !important;
            background: rgba(255, 255, 255, 0.08);
        }

        .logo-img {
            max-height: 42px;
            width: auto;
            background: #ffffff;
            padding: 2px;
            border-radius: 50%;
        }

        .btn-admin {
            background: linear-gradient(135deg, var(--admin-cyan) 0%, var(--admin-blue) 100%);
            color: #ffffff !important;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            padding: 9px 22px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(0, 180, 216, 0.3);
        }

        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 180, 216, 0.45);
        }

        .btn-outline-admin {
            border: 2px solid var(--admin-cyan);
            color: #ffffff !important;
            background: transparent;
            font-weight: 600;
            border-radius: 50px;
            padding: 8px 20px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline-admin:hover {
            background: var(--admin-cyan);
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        /* Hero Banner */
        .hero-admin {
            background: linear-gradient(135deg, #00131e 0%, #002235 50%, #003859 100%);
            color: #ffffff;
            padding: 60px 0 50px 0;
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid var(--admin-cyan);
        }

        .hero-admin::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0, 180, 216, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .card-custom {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-card-kpi {
            border-radius: 16px;
            padding: 24px;
            background: #ffffff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border-left: 5px solid var(--admin-cyan);
            transition: all 0.3s ease;
        }

        .stat-card-kpi:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .avatar-circle {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--admin-cyan), var(--admin-blue));
            color: #ffffff;
            font-weight: 700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .footer-bottom {
            background: var(--sena-dark);
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            padding: 20px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <!-- Header Navbar -->
    <nav class="navbar-admin sticky-top">
        <div class="container d-flex flex-wrap align-items-center justify-content-between gap-3">
            
            <!-- Branding -->
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.welcome') }}" class="text-white text-decoration-none d-flex align-items-center gap-2">
                    <img src="{{ asset('general/assets/img/cefaempresa.png') }}" alt="SENA Empresa" class="logo-img">
                    <div>
                        <span class="fs-6 fw-bold d-block text-white">SENA EMPRESA</span>
                        <small class="text-white-50 fs-8">Procesos de Apoyo • <strong style="color: var(--admin-cyan);">Administración</strong></small>
                    </div>
                </a>
            </div>

            <!-- Links -->
            <div class="d-none d-lg-flex align-items-center gap-1">
                <a href="{{ route('admin.welcome') }}" class="nav-link active">
                    <i class="fas fa-home me-1"></i> Inicio
                </a>
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-chart-pie me-1"></i> Dashboard
                </a>
                <a href="{{ route('admin.usuarios.index') }}" class="nav-link">
                    <i class="fas fa-users-cog me-1"></i> Usuarios
                </a>
                <a href="{{ route('admin.roles.index') }}" class="nav-link">
                    <i class="fas fa-user-shield me-1"></i> Roles
                </a>
                <a href="{{ route('admin.permisos.index') }}" class="nav-link">
                    <i class="fas fa-key me-1"></i> Permisos
                </a>
                <a href="{{ route('admin.auditoria.index') }}" class="nav-link">
                    <i class="fas fa-history me-1"></i> Auditoría
                </a>
            </div>

            <!-- Profile & ERP Access -->
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-light rounded-pill px-3 fw-semibold d-none d-sm-inline-flex align-items-center gap-1">
                    <i class="fas fa-arrow-left"></i> <span>Portal ERP</span>
                </a>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-admin">
                        <i class="fas fa-tachometer-alt"></i> <span>Ir al Tablero</span>
                    </a>
                @else
                    <a href="{{ route('login', ['redirect' => route('admin.dashboard')]) }}" class="btn btn-sm btn-admin">
                        <i class="fas fa-sign-in-alt"></i> <span>Ingresar</span>
                    </a>
                @endauth
            </div>

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-admin">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-15 border border-white border-opacity-25 mb-3">
                        <i class="fas fa-shield-alt text-warning"></i>
                        <span class="fs-7 fw-semibold">Gobierno de Seguridad y Accesos • SENA Empresa</span>
                    </div>
                    <h1 class="fw-bold display-5 mb-3 text-white">
                        Administración Centralizada y Auditoría
                    </h1>
                    <p class="lead text-white-50 mb-4" style="max-width: 680px;">
                        Supervisa el control de usuarios, asignación dinámica de roles y privilegios, catálogo de permisos por aplicativo y trazabilidad completa mediante bitácoras de auditoría en la plataforma ERP SENA Empresa.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-admin px-4 py-2 fs-6">
                            <i class="fas fa-chart-pie"></i> Tablero de Control
                        </a>
                        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-admin px-4 py-2 fs-6">
                            <i class="fas fa-users-cog"></i> Gestión de Usuarios
                        </a>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold">
                            <i class="fas fa-user-shield"></i> Roles y Permisos
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 text-center">
                    <div class="card border-0 rounded-4 p-4 shadow-lg text-start" style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.15) !important;">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="avatar-circle">
                                <i class="fas fa-user-shield fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-white mb-0">Estado del Sistema</h5>
                                <small class="text-white-50">Gobierno de Seguridad Activo</small>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-0 text-white-50 fs-7">
                            <li class="py-2 border-bottom border-white border-opacity-10 d-flex justify-content-between">
                                <span><i class="fas fa-users text-info me-2"></i> Usuarios del ERP:</span>
                                <strong class="text-white">{{ $totalUsuarios }}</strong>
                            </li>
                            <li class="py-2 border-bottom border-white border-opacity-10 d-flex justify-content-between">
                                <span><i class="fas fa-user-tag text-warning me-2"></i> Roles Definidos:</span>
                                <strong class="text-white">{{ $totalRoles }}</strong>
                            </li>
                            <li class="py-2 border-bottom border-white border-opacity-10 d-flex justify-content-between">
                                <span><i class="fas fa-key text-success me-2"></i> Permisos en BD:</span>
                                <strong class="text-white">{{ $totalPermisos }}</strong>
                            </li>
                            <li class="pt-2 d-flex justify-content-between">
                                <span><i class="fas fa-history text-danger me-2"></i> Eventos Auditados:</span>
                                <strong class="text-white">{{ $totalAuditorias }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="py-5 flex-grow-1">
        <div class="container">

            <!-- KPI Cards Row -->
            <div class="row g-4 mb-5">
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-card-kpi" style="border-left-color: var(--admin-cyan);">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted fs-7 text-uppercase fw-semibold">Usuarios Totales</span>
                                <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalUsuarios }}</h3>
                            </div>
                            <div class="rounded-circle p-3 bg-info bg-opacity-10 text-info fs-3">
                                <i class="fas fa-users-cog"></i>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                            <i class="fas fa-id-badge me-1 text-info"></i> Cuentas en plataforma
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="stat-card-kpi" style="border-left-color: #ffb703;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted fs-7 text-uppercase fw-semibold">Roles Registrados</span>
                                <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalRoles }}</h3>
                            </div>
                            <div class="rounded-circle p-3 bg-warning bg-opacity-10 text-warning fs-3">
                                <i class="fas fa-user-shield"></i>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                            <i class="fas fa-layer-group me-1 text-warning"></i> Perfiles de acceso
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="stat-card-kpi" style="border-left-color: #39A900;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted fs-7 text-uppercase fw-semibold">Permisos Disponibles</span>
                                <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalPermisos }}</h3>
                            </div>
                            <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success fs-3">
                                <i class="fas fa-key"></i>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                            <i class="fas fa-check-double me-1 text-success"></i> Acciones granulares
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="stat-card-kpi" style="border-left-color: #e63946;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted fs-7 text-uppercase fw-semibold">Bitácora Auditoría</span>
                                <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalAuditorias }}</h3>
                            </div>
                            <div class="rounded-circle p-3 bg-danger bg-opacity-10 text-danger fs-3">
                                <i class="fas fa-history"></i>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                            <i class="fas fa-fingerprint me-1 text-danger"></i> Trazabilidad del ERP
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submódulos del Módulo Admin -->
            <div class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h3 class="fw-bold text-dark mb-1">Módulos de Gestión Administrativa</h3>
                        <p class="text-muted fs-6 mb-0">Selecciona el área de administración que deseas supervisar o configurar.</p>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Card 1: Usuarios -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-custom h-100 p-4 text-center">
                            <div class="rounded-circle p-3 bg-info bg-opacity-10 text-info mx-auto mb-3" style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-users-cog fs-3"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Gestión de Usuarios</h5>
                            <p class="text-muted fs-7 mb-4 flex-grow-1">
                                Creación, asignación de personas vinculadas, credenciales de acceso y asignación de roles.
                            </p>
                            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-semibold w-100">
                                <i class="fas fa-arrow-right me-1"></i> Administrar
                            </a>
                        </div>
                    </div>

                    <!-- Card 2: Roles -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-custom h-100 p-4 text-center">
                            <div class="rounded-circle p-3 bg-warning bg-opacity-10 text-warning mx-auto mb-3" style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-shield fs-3"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Control de Roles</h5>
                            <p class="text-muted fs-7 mb-4 flex-grow-1">
                                Definición de roles institucionales, asignación por aplicación y matriz de permisos por rol.
                            </p>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-outline-warning rounded-pill px-4 fw-semibold w-100 text-dark">
                                <i class="fas fa-arrow-right me-1"></i> Administrar
                            </a>
                        </div>
                    </div>

                    <!-- Card 3: Permisos -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-custom h-100 p-4 text-center">
                            <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success mx-auto mb-3" style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-key fs-3"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Catálogo de Permisos</h5>
                            <p class="text-muted fs-7 mb-4 flex-grow-1">
                                Inventario institucional de permisos técnicos asignables a roles en cada aplicación del ERP.
                            </p>
                            <a href="{{ route('admin.permisos.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-4 fw-semibold w-100">
                                <i class="fas fa-arrow-right me-1"></i> Explorar
                            </a>
                        </div>
                    </div>

                    <!-- Card 4: Auditoría -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-custom h-100 p-4 text-center">
                            <div class="rounded-circle p-3 bg-danger bg-opacity-10 text-danger mx-auto mb-3" style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-history fs-3"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Logs de Auditoría</h5>
                            <p class="text-muted fs-7 mb-4 flex-grow-1">
                                Registro inmutable de eventos: creaciones, modificaciones y eliminaciones realizadas por los usuarios.
                            </p>
                            <a href="{{ route('admin.auditoria.index') }}" class="btn btn-sm btn-outline-danger rounded-pill px-4 fw-semibold w-100">
                                <i class="fas fa-arrow-right me-1"></i> Inspeccionar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section: Roles Destacados y Usuarios Recientes -->
            <div class="row g-4">
                <!-- Roles Destacados -->
                <div class="col-lg-6">
                    <div class="card card-custom p-4 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                            <h5 class="fw-bold text-dark mb-0">
                                <i class="fas fa-shield-alt text-warning me-2"></i> Roles con Mayor Cobertura
                            </h5>
                            <a href="{{ route('admin.roles.index') }}" class="fs-8 text-primary fw-semibold text-decoration-none">Ver todos</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 fs-7">
                                <thead class="table-light">
                                    <tr>
                                        <th>Rol</th>
                                        <th>Slug</th>
                                        <th class="text-center">Usuarios</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rolesDestacados as $r)
                                        <tr>
                                            <td>
                                                <strong>{{ $r->name }}</strong>
                                            </td>
                                            <td><code>{{ $r->slug }}</code></td>
                                            <td class="text-center">
                                                <span class="badge bg-primary bg-opacity-15 text-primary rounded-pill px-3 py-1">
                                                    {{ $r->users_count }} usuarios
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-3">No hay roles registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Usuarios Recientes -->
                <div class="col-lg-6">
                    <div class="card card-custom p-4 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                            <h5 class="fw-bold text-dark mb-0">
                                <i class="fas fa-user-plus text-info me-2"></i> Cuentas Recientes
                            </h5>
                            <a href="{{ route('admin.usuarios.index') }}" class="fs-8 text-primary fw-semibold text-decoration-none">Ver todos</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 fs-7">
                                <thead class="table-light">
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Correo</th>
                                        <th>Rol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ultimosUsuarios as $u)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-circle-sm" style="width: 28px; height: 28px; font-size: 11px;">
                                                        {{ $u->initials }}
                                                    </div>
                                                    <div>
                                                        <strong>{{ $u->nickname }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $u->email }}</td>
                                            <td>
                                                <span class="badge bg-success bg-opacity-15 text-success rounded-pill px-2 py-1">
                                                    {{ $u->primary_role }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-3">No hay usuarios registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-bottom">
        <div class="container text-center">
            <div class="row align-items-center gy-2">
                <div class="col-md-6 text-md-start">
                    <span>&copy; {{ date('Y') }} <strong>SENA Empresa</strong> - Centro de Formación Agroindustrial 'La Angostura'.</span>
                </div>
                <div class="col-md-6 text-md-end">
                    <span>Módulo de Administración • SENA ERP</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
