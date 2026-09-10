<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIGE (SIGE)') - SENA Empresa ERP</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Icons -->
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
            --sena-orange: #e65100;
            --sena-orange-hover: #bf4300;
        }

        body {
            font-family: 'Poppins', 'Nunito', sans-serif;
            background-color: #f4f7f6;
            color: #333333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navbar */
        .egresados-navbar {
            background: linear-gradient(135deg, var(--sena-dark) 0%, var(--sena-navy) 100%);
            border-bottom: 3px solid var(--sena-orange);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            padding: 10px 0;
        }

        .logo-img {
            max-height: 38px;
            width: auto;
            background: #ffffff;
            padding: 2px;
            border-radius: 50%;
        }

        .btn-sena-orange {
            background-color: var(--sena-orange);
            color: #ffffff !important;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-sena-orange:hover {
            background-color: var(--sena-orange-hover);
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 81, 0, 0.35);
        }

        .nav-link-custom {
            color: rgba(255, 255, 255, 0.85);
            font-size: 13.5px;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 8px;
            transition: all 0.25s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            color: #ffb74d;
            background: rgba(255, 255, 255, 0.08);
        }

        .card-custom {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .avatar-circle-sm {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, var(--sena-orange), #ff9800);
            color: #ffffff;
            font-weight: 700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .footer-bottom {
            background: var(--sena-dark);
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            padding: 18px 0;
            margin-top: auto;
        }

        /* Glassmorphism details */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Header Navbar -->
    <header class="egresados-navbar sticky-top">
        <div class="container d-flex flex-wrap align-items-center justify-content-between gap-3">
            
            <!-- Left Branding -->
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('egresados.index') }}" class="text-white text-decoration-none d-flex align-items-center gap-2">
                    <img src="{{ asset('general/assets/img/cefaempresa.png') }}" alt="SENA Empresa" class="logo-img">
                    <div>
                        <span class="fs-6 fw-bold d-block text-white">SENA EMPRESA</span>
                        <small class="text-white-50 fs-8">Procesos de Apoyo • <strong style="color: #ffb74d;">SIGE</strong></small>
                    </div>
                </a>
            </div>

            <!-- Middle Navigation Links -->
            <div class="d-none d-lg-flex align-items-center gap-1">
                <a href="{{ route('egresados.index') }}" class="nav-link-custom {{ Route::is('egresados.index') ? 'active' : '' }}">
                    <i class="fas fa-graduation-cap"></i> SIGE
                </a>
                <a href="{{ route('egresados.create') }}" class="nav-link-custom {{ Route::is('egresados.create') ? 'active' : '' }}">
                    <i class="fas fa-user-plus"></i> Registrar Egresado
                </a>
            </div>

            <!-- Right Actions & User Profile Area -->
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-light rounded-pill px-3 fw-semibold d-none d-sm-inline-flex align-items-center gap-1" title="Volver al Portal ERP Principal">
                    <i class="fas fa-arrow-left"></i> <span>Portal ERP</span>
                </a>

                <a href="{{ route('egresados.create') }}" class="btn btn-sm btn-sena-orange">
                    <i class="fas fa-plus-circle"></i> <span>Nuevo Egresado</span>
                </a>

                @auth
                    <!-- Profile & Role Badge Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-dark bg-opacity-50 border border-secondary border-opacity-50 text-white rounded-pill px-2 py-1 d-flex align-items-center gap-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="avatar-circle-sm">
                                {{ Auth::user()->initials }}
                            </div>
                            <div class="text-start d-none d-md-block pe-1">
                                <span class="fw-bold fs-8 text-white d-block lh-1">{{ Str::limit(Auth::user()->full_name, 18) }}</span>
                                <span class="badge bg-warning text-dark fs-8 p-1" style="font-size: 10px !important; font-weight: 700;">
                                    {{ Auth::user()->primary_role }}
                                </span>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 p-2 mt-2" style="min-width: 240px;">
                            <li class="p-2 border-bottom">
                                <div class="fw-bold text-dark fs-7">{{ Auth::user()->full_name }}</div>
                                <small class="text-muted fs-8">{{ Auth::user()->email }}</small>
                                <div class="mt-1">
                                    <span class="badge bg-warning bg-opacity-15 text-warning-emphasis border border-warning border-opacity-25 rounded-pill px-2 py-1 fs-8" style="color: #c43e00;">
                                        <i class="fas fa-user-shield me-1"></i> {{ Auth::user()->primary_role }}
                                    </span>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 rounded-3 text-dark fw-semibold d-flex align-items-center gap-2 mt-1" href="{{ route('home') }}">
                                    <i class="fas fa-home text-muted"></i> Ir al Portal Principal
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item py-2 rounded-3 text-danger fw-semibold d-flex align-items-center gap-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-master').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                </a>
                                <form id="logout-form-master" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content Wrapper -->
    <main class="container py-4 my-2 flex-grow-1">
        
        <!-- Alerts for feedback messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 p-3 d-flex align-items-center gap-2" role="alert">
                <i class="fas fa-check-circle fs-4 text-success"></i>
                <div>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 p-3 d-flex align-items-center gap-2" role="alert">
                <i class="fas fa-exclamation-circle fs-4 text-danger"></i>
                <div>
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 p-3" role="alert">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="fas fa-exclamation-triangle fs-4 text-danger"></i>
                    <strong class="text-danger">Por favor corrige los siguientes errores:</strong>
                </div>
                <ul class="mb-0 ps-3 fs-7">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-bottom">
        <div class="container d-md-flex py-3 justify-content-between align-items-center text-center text-md-start">
            <div class="copyright text-white-50">
                &copy; {{ date('Y') }} <strong><span class="text-white">SENA Empresa • SIGE</span></strong>. Centro de Formación Agroindustrial "La Angostura". Todos los derechos reservados.
            </div>
            <div class="credits text-white-50 mt-2 mt-md-0">
                Modelo Didáctico ERP • ADSO / SENA Empresa
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
