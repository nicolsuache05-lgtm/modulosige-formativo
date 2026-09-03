<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Panel de Control — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Fraunces + Plus Jakarta Sans / Work Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
      :root {
        --forest: #013819;
        --forest-deep: #012410;
        --green: #39A900;
        --green-dark: #2a7c00;
        --green-soft: #EAF7EE;
        --moss: #62E31D;
        --bg: #FCFCFA;
        --card: #FFFFFF;
        --ink: #16261C;
        --ink-soft: #6B7A70;
        --line: #E8EFE9;
        --gold: #D9A441;
      }

      * { box-sizing: border-box; }
      html, body { margin: 0; padding: 0; }

      body {
        font-family: 'Plus Jakarta Sans', 'Work Sans', sans-serif;
        background: var(--bg);
        color: var(--ink);
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
      }

      .app {
        display: grid;
        grid-template-columns: 250px 1fr;
        min-height: 100vh;
      }

      /* ---------------- SIDEBAR ---------------- */
      .sidebar {
        background: linear-gradient(180deg, var(--forest) 0%, var(--forest-deep) 100%);
        color: #ffffff;
        display: flex;
        flex-direction: column;
        padding: 22px 16px;
        border-right: 1px solid rgba(255, 255, 255, 0.08);
      }

      .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 4px 8px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.14);
        margin-bottom: 16px;
        text-decoration: none;
        color: #ffffff;
      }

      .brand-badge {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        padding: 2px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        border: 2px solid rgba(98, 227, 29, 0.6);
      }
      .brand-badge img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 7px;
      }

      .brand-name {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 18px;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .brand-tag {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 9px;
        font-weight: 800;
        background: var(--green);
        color: #ffffff;
        padding: 2px 6px;
        border-radius: 999px;
      }
      .brand-sub {
        font-size: 10.5px;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 2px;
      }

      .nav-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: rgba(255, 255, 255, 0.45);
        padding: 8px 12px 6px;
        margin-top: 6px;
      }

      nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        border-radius: 10px;
        color: rgba(255, 255, 255, 0.82);
        text-decoration: none;
        font-size: 13.5px;
        font-weight: 500;
        margin-bottom: 3px;
        transition: all 0.15s ease;
      }
      nav a i, nav a svg {
        width: 18px;
        font-size: 15px;
        text-align: center;
        flex-shrink: 0;
      }
      nav a:hover {
        background: rgba(255, 255, 255, 0.09);
        color: #ffffff;
        transform: translateX(2px);
      }
      nav a.active {
        background: #ffffff;
        color: var(--forest-deep);
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
      }
      nav a.active i, nav a.active svg {
        color: var(--green);
      }
      nav a .badge {
        margin-left: auto;
        background: rgba(255, 255, 255, 0.18);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
      }
      nav a.active .badge {
        background: var(--green-soft);
        color: var(--forest-deep);
      }

      .sidebar-foot {
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.14);
      }
      .logout-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        border-radius: 10px;
        background: transparent;
        border: none;
        width: 100%;
        text-align: left;
        transition: all 0.15s ease;
        text-decoration: none;
      }
      .logout-btn:hover {
        background: rgba(239, 68, 68, 0.15);
        color: #fca5a5;
      }

      /* ---------------- MAIN ---------------- */
      .main {
        display: flex;
        flex-direction: column;
        min-width: 0;
      }

      .topbar {
        background: var(--forest);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 36px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      .topbar-left {
        display: flex;
        align-items: center;
        gap: 14px;
      }

      .portal-link-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 999px;
        text-decoration: none;
        transition: all 0.2s ease;
      }
      .portal-link-btn:hover {
        background: var(--green);
        border-color: var(--green);
        color: #ffffff;
      }

      .topbar-right {
        display: flex;
        align-items: center;
        gap: 18px;
      }

      .icon-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        color: #ffffff;
        transition: all 0.2s ease;
        border: none;
      }
      .icon-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-1px);
      }
      .icon-btn .dot {
        position: absolute;
        top: 6px;
        right: 7px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #E8A23C;
        border: 1.5px solid var(--forest);
      }

      .user-chip {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        padding: 4px 10px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        transition: background 0.2s ease;
      }
      .user-chip:hover {
        background: rgba(255, 255, 255, 0.14);
      }
      .user-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--green);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 12px;
      }

      /* ---------------- CONTENT ---------------- */
      .content {
        padding: 34px 40px 48px;
        flex: 1;
      }

      .page-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 14px;
      }
      .page-title {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 28px;
        margin: 0 0 6px;
        color: var(--forest-deep);
        letter-spacing: -0.5px;
      }
      .page-title span {
        color: var(--green);
      }
      .page-desc {
        font-size: 14.5px;
        color: var(--ink-soft);
        margin: 0;
      }
      .period-pill {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--card);
        border: 1px solid var(--line);
        padding: 8px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
        color: var(--ink-soft);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
      }
      .period-pill i {
        color: var(--green);
      }

      /* Stat cards */
      .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
      }
      .stat-card {
        background: var(--card);
        border-radius: 16px;
        padding: 22px 22px 20px;
        border: 1px solid var(--line);
        display: flex;
        flex-direction: column;
        gap: 14px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
      }
      .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(1, 56, 25, 0.06);
        border-color: rgba(57, 169, 0, 0.35);
      }

      .stat-top {
        display: flex;
        align-items: center;
        gap: 12px;
      }
      .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--green-soft);
        color: var(--forest);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
      }
      .stat-title {
        font-size: 13.5px;
        color: var(--ink-soft);
        font-weight: 600;
      }
      .stat-value {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 32px;
        color: var(--forest-deep);
        line-height: 1;
        letter-spacing: -0.5px;
      }
      .stat-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 10px;
        border-top: 1px solid var(--line);
      }
      .stat-trend {
        font-size: 12px;
        font-weight: 700;
        color: var(--green);
        display: flex;
        align-items: center;
        gap: 5px;
      }
      .stat-trend.down {
        color: #dc2626;
      }
      .stat-link {
        font-size: 12.5px;
        color: var(--forest);
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: color 0.15s ease;
      }
      .stat-link:hover {
        color: var(--green);
        text-decoration: underline;
      }

      /* Lower section: activity + progress */
      .lower-grid {
        display: grid;
        grid-template-columns: 1.55fr 1fr;
        gap: 24px;
      }

      .panel {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 24px 26px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
      }
      .panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--line);
      }
      .panel-title {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 18px;
        color: var(--forest-deep);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .panel-title i {
        color: var(--green);
        font-size: 15px;
      }
      .panel-action {
        font-size: 12.5px;
        color: var(--green);
        font-weight: 700;
        text-decoration: none;
        transition: color 0.15s ease;
      }
      .panel-action:hover {
        color: var(--forest);
        text-decoration: underline;
      }

      .activity-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 13px 0;
        border-bottom: 1px solid var(--line);
      }
      .activity-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
      }
      .activity-dot {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--green-soft);
        color: var(--forest);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
        margin-top: 1px;
      }
      .activity-text {
        font-size: 13.5px;
        color: var(--ink);
        line-height: 1.45;
      }
      .activity-text b {
        font-weight: 700;
        color: var(--forest-deep);
      }
      .activity-time {
        font-size: 11.5px;
        color: var(--ink-soft);
        margin-top: 3px;
      }

      .progress-item {
        margin-bottom: 20px;
      }
      .progress-item:last-child {
        margin-bottom: 0;
      }
      .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 13.5px;
        margin-bottom: 8px;
      }
      .progress-label span:first-child {
        color: var(--ink);
        font-weight: 600;
      }
      .progress-label span:last-child {
        color: var(--forest);
        font-weight: 800;
      }
      .progress-track {
        height: 8px;
        background: var(--green-soft);
        border-radius: 20px;
        overflow: hidden;
      }
      .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--forest) 0%, var(--green) 100%);
        border-radius: 20px;
        transition: width 1s ease-in-out;
      }

      @media (max-width: 1080px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .lower-grid { grid-template-columns: 1fr; }
      }
      @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
        .content { padding: 24px 18px 36px; }
        .topbar { padding: 12px 18px; }
      }
    </style>
</head>
<body>

<div class="app">

  <!-- SIDEBAR INSTITUCIONAL -->
  <aside class="sidebar">
    <a href="{{ route('egresados.dashboard') }}" class="brand">
      <div class="brand-badge">
        <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA">
      </div>
      <div>
        <div class="brand-name">
          <span>SIGE</span>
          <span class="brand-tag">CEFA</span>
        </div>
        <div class="brand-sub">Gestión de Egresados</div>
      </div>
    </a>

    <div class="nav-label">General</div>
    <nav>
      <a href="{{ route('egresados.dashboard') }}" class="active">
        <i class="fa-solid fa-gauge-high"></i>
        <span>Inicio</span>
      </a>
      <a href="{{ route('egresados.index') }}">
        <i class="fa-solid fa-user-graduate"></i>
        <span>Egresados</span>
      </a>
      <a href="#">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Instructores</span>
      </a>
      <a href="#">
        <i class="fa-solid fa-clipboard-question"></i>
        <span>Encuestas</span>
        <span class="badge">78</span>
      </a>
      <a href="#">
        <i class="fa-solid fa-chart-pie"></i>
        <span>Reportes</span>
      </a>
    </nav>

    <div class="nav-label">Actividad</div>
    <nav>
      <a href="#">
        <i class="fa-regular fa-calendar-days"></i>
        <span>Eventos</span>
        <span class="badge">5</span>
      </a>
      <a href="#">
        <i class="fa-solid fa-briefcase"></i>
        <span>Ofertas laborales</span>
      </a>
      <a href="#">
        <i class="fa-regular fa-bell"></i>
        <span>Notificaciones</span>
        <span class="badge">3</span>
      </a>
    </nav>

    <div class="nav-label">Portal Público</div>
    <nav>
      <a href="{{ route('egresados.welcome') }}">
        <i class="fa-solid fa-house"></i>
        <span>Portal Egresados</span>
      </a>
    </nav>

    <div class="sidebar-foot">
      @auth
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
          <button type="submit" class="logout-btn">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Cerrar sesión</span>
          </button>
        </form>
      @else
        <a href="{{ route('login', ['redirect' => route('egresados.dashboard')]) }}" class="logout-btn">
          <i class="fa-solid fa-arrow-right-to-bracket"></i>
          <span>Iniciar sesión</span>
        </a>
      @endauth
    </div>
  </aside>

  <!-- MAIN VIEWPORT -->
  <div class="main">
    
    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-left">
        <a href="{{ route('egresados.welcome') }}" class="portal-link-btn">
          <i class="fa-solid fa-globe text-xs"></i>
          <span>Ver Portal Público</span>
        </a>
      </div>

      <div class="topbar-right">
        <button class="icon-btn" title="Notificaciones" aria-label="Notificaciones">
          <i class="fa-regular fa-bell"></i>
          <div class="dot"></div>
        </button>

        <div class="user-chip" title="Usuario activo">
          <div class="user-avatar">
            @auth
              {{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->name ?? 'CA', 0, 2)) }}
            @else
              CA
            @endauth
          </div>
          <span>
            @auth
              {{ Auth::user()->full_name ?? Auth::user()->name ?? 'Coordinación Académica' }}
            @else
              Coordinación Académica
            @endauth
          </span>
          <i class="fa-solid fa-chevron-down text-[10px] text-white/60 ms-1"></i>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="content">
      
      <!-- Page Head -->
      <div class="page-head">
        <div>
          <h1 class="page-title">
            ¡Bienvenido(a), <span>{{ Auth::check() ? (Auth::user()->first_name ?? Auth::user()->name ?? 'Coordinación Académica') : 'Coordinación Académica' }}</span>!
          </h1>
          <p class="page-desc">Desde aquí puedes gestionar y hacer seguimiento a los egresados del centro.</p>
        </div>

        <div class="period-pill">
          <i class="fa-regular fa-calendar-days"></i>
          <span>{{ ucfirst(\Carbon\Carbon::now()->locale('es')->translatedFormat('F Y')) }}</span>
        </div>
      </div>

      <!-- Stats Grid (6 Cards) -->
      <div class="stats-grid">
        
        <!-- Card 1: Total Egresados -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div class="stat-title">Total egresados</div>
          </div>
          <div class="stat-value">
            {{ isset($totalEgresados) && $totalEgresados > 0 ? number_format($totalEgresados) : '1.245' }}
          </div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-arrow-trend-up"></i>
              <span>↑ 4.2% este mes</span>
            </div>
            <a href="{{ route('egresados.index') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 2: Egresados Activos -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-user-check"></i>
            </div>
            <div class="stat-title">Egresados activos</div>
          </div>
          <div class="stat-value">
            {{ isset($totalActivos) && $totalActivos > 0 ? number_format($totalActivos) : '892' }}
          </div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-circle-check"></i>
              <span>Con datos actualizados</span>
            </div>
            <a href="{{ route('egresados.index') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 3: Egresados Empleados -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="stat-title">Egresados empleados</div>
          </div>
          <div class="stat-value">
            {{ isset($totalEmpleados) && $totalEmpleados > 0 ? number_format($totalEmpleados) : '564' }}
          </div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-chart-line"></i>
              <span>{{ isset($tasaEmpleo) ? $tasaEmpleo . '%' : '45%' }} de vinculación</span>
            </div>
            <a href="{{ route('egresados.index', ['employment_status' => 'Empleado']) }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 4: Encuestas Pendientes -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-clipboard-list"></i>
            </div>
            <div class="stat-title">Encuestas pendientes</div>
          </div>
          <div class="stat-value">78</div>
          <div class="stat-meta">
            <div class="stat-trend down">
              <i class="fa-solid fa-clock"></i>
              <span>Por responder</span>
            </div>
            <a href="#" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 5: Eventos Programados -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-regular fa-calendar-check"></i>
            </div>
            <div class="stat-title">Eventos programados</div>
          </div>
          <div class="stat-value">5</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-bullhorn"></i>
              <span>Próximos eventos</span>
            </div>
            <a href="#" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 6: Reportes Generados -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-file-invoice"></i>
            </div>
            <div class="stat-title">Reportes generados</div>
          </div>
          <div class="stat-value">12</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-arrow-up-right-dots"></i>
              <span>Este mes</span>
            </div>
            <a href="#" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- Lower Grid: Actividad Reciente + Avance por Programa -->
      <div class="lower-grid">
        
        <!-- Panel Izquierdo: Actividad Reciente -->
        <div class="panel">
          <div class="panel-head">
            <h3 class="panel-title">
              <i class="fa-solid fa-bolt"></i>
              <span>Actividad reciente</span>
            </h3>
            <a href="{{ route('egresados.index') }}" class="panel-action">Ver todo</a>
          </div>

          <div class="activity-row">
            <div class="activity-dot">
              <i class="fa-solid fa-check"></i>
            </div>
            <div>
              <div class="activity-text"><b>Juan Pérez</b> actualizó su información laboral</div>
              <div class="activity-time">Hace 20 minutos</div>
            </div>
          </div>

          <div class="activity-row">
            <div class="activity-dot">
              <i class="fa-solid fa-clipboard-check"></i>
            </div>
            <div>
              <div class="activity-text">Se cerró la encuesta <b>"Seguimiento laboral 2026-1"</b></div>
              <div class="activity-time">Hace 3 horas</div>
            </div>
          </div>

          <div class="activity-row">
            <div class="activity-dot">
              <i class="fa-solid fa-briefcase"></i>
            </div>
            <div>
              <div class="activity-text">Nueva oferta laboral publicada: <b>Técnico Agropecuario</b></div>
              <div class="activity-time">Ayer</div>
            </div>
          </div>

          <div class="activity-row">
            <div class="activity-dot">
              <i class="fa-solid fa-user-plus"></i>
            </div>
            <div>
              <div class="activity-text"><b>15 egresados</b> completaron su registro este mes</div>
              <div class="activity-time">Hace 2 días</div>
            </div>
          </div>
        </div>

        <!-- Panel Derecho: Avance por Programa -->
        <div class="panel">
          <div class="panel-head">
            <h3 class="panel-title">
              <i class="fa-solid fa-chart-simple"></i>
              <span>Avance por programa</span>
            </h3>
          </div>

          <div class="progress-item">
            <div class="progress-label">
              <span>Gestión Agroempresarial</span>
              <span>82%</span>
            </div>
            <div class="progress-track">
              <div class="progress-fill" style="width: 82%"></div>
            </div>
          </div>

          <div class="progress-item">
            <div class="progress-label">
              <span>ADSO (Desarrollo de Software)</span>
              <span>68%</span>
            </div>
            <div class="progress-track">
              <div class="progress-fill" style="width: 68%"></div>
            </div>
          </div>

          <div class="progress-item">
            <div class="progress-label">
              <span>Producción Agrícola</span>
              <span>54%</span>
            </div>
            <div class="progress-track">
              <div class="progress-fill" style="width: 54%"></div>
            </div>
          </div>

          <div class="progress-item">
            <div class="progress-label">
              <span>Contabilización</span>
              <span>41%</span>
            </div>
            <div class="progress-track">
              <div class="progress-fill" style="width: 41%"></div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

</div>

</body>
</html>
