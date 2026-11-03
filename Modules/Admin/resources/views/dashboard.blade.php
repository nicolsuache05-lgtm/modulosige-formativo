<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Panel de Seguridad y Control — SENA Empresa ERP</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('general/assets/img/cefaempresa.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('general/assets/img/cefaempresa.png') }}">

    <!-- Google Fonts: Fraunces + Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
      :root {
        --forest: #001A29;
        --forest-deep: #00131E;
        --sena-dark: #00131E;
        --sena-navy: #001A29;
        --sena-navy-light: #002336;
        --green: #39A900;
        --green-dark: #2a7c00;
        --green-soft: #EAF7EE;
        --blue-soft: #EBF3FF;
        --amber-soft: #FEF7EA;
        --purple-soft: #F5EFFF;
        --red-soft: #FEE2E2;
        --moss: #62E31D;
        --bg: #F4F7F6;
        --card: #FFFFFF;
        --ink: #16261C;
        --ink-soft: #6B7A70;
        --line: #E8EFE9;
        --admin-blue: #0288d1;
      }

      * { box-sizing: border-box; }
      html, body { margin: 0; padding: 0; }

      body {
        font-family: 'Plus Jakarta Sans', sans-serif;
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
        position: sticky;
        top: 0;
        height: 100vh;
        overflow-y: auto;
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
        border: 2px solid rgba(2, 136, 209, 0.6);
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
        background: var(--admin-blue);
        color: #ffffff;
        padding: 2px 7px;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
      nav a i {
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
      nav a.active i {
        color: var(--admin-blue);
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
        background: var(--admin-blue);
        border-color: var(--admin-blue);
        color: #ffffff;
      }

      .topbar-right {
        display: flex;
        align-items: center;
        gap: 16px;
      }

      .btn-new-user {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--admin-blue);
        color: #ffffff;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 999px;
        text-decoration: none;
        transition: all 0.2s ease;
      }
      .btn-new-user:hover {
        background: #0277bd;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(2, 136, 209, 0.3);
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
        background: #00E5FF;
        border: 1.5px solid var(--forest);
      }

      .user-chip {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        padding: 4px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        transition: background 0.2s ease;
        color: #ffffff;
      }
      .user-chip:hover {
        background: rgba(255, 255, 255, 0.14);
      }
      .user-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--admin-blue);
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
        color: var(--admin-blue);
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
        color: var(--admin-blue);
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
        box-shadow: 0 10px 24px rgba(2, 136, 209, 0.08);
        border-color: rgba(2, 136, 209, 0.35);
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
        background: var(--blue-soft);
        color: var(--admin-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
      }
      .stat-icon.green { background: var(--green-soft); color: var(--green); }
      .stat-icon.amber { background: var(--amber-soft); color: #D97706; }
      .stat-icon.purple { background: var(--purple-soft); color: #7C3AED; }

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
        color: var(--admin-blue);
        display: flex;
        align-items: center;
        gap: 5px;
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
        color: var(--admin-blue);
        text-decoration: underline;
      }

      /* Lower section */
      .lower-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
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
        color: var(--admin-blue);
        font-size: 15px;
      }
      .panel-action {
        font-size: 12.5px;
        color: var(--admin-blue);
        font-weight: 700;
        text-decoration: none;
        transition: color 0.15s ease;
      }
      .panel-action:hover {
        color: var(--forest);
        text-decoration: underline;
      }

      /* Table custom */
      .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 13px;
      }
      .table-custom th {
        background: #F9FBFA;
        color: var(--ink-soft);
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 12px 14px;
        border-bottom: 1px solid var(--line);
        text-align: left;
      }
      .table-custom td {
        padding: 12px 14px;
        border-bottom: 1px solid var(--line);
        color: var(--ink);
        vertical-align: middle;
      }
      .table-custom tr:last-child td {
        border-bottom: none;
      }
      .table-custom tr:hover td {
        background: rgba(2, 136, 209, 0.03);
      }

      .badge-event {
        display: inline-flex;
        align-items: center;
        padding: 3px 9px;
        border-radius: 999px;
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
      }
      .badge-created { background: #EAF7EE; color: #236B00; border: 1px solid #C4ECCB; }
      .badge-updated { background: #EBF3FF; color: #1E40AF; border: 1px solid #BFDBFE; }
      .badge-deleted { background: #FEE2E2; color: #991B1B; border: 1px solid #FECACA; }

      /* Progress */
      .progress-item {
        margin-bottom: 18px;
      }
      .progress-item:last-child {
        margin-bottom: 0;
      }
      .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 13.5px;
        margin-bottom: 7px;
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
        background: #EBF3FF;
        border-radius: 20px;
        overflow: hidden;
      }
      .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--forest) 0%, var(--admin-blue) 100%);
        border-radius: 20px;
        transition: width 1s ease-in-out;
      }

      /* Activity timeline */
      .activity-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--line);
      }
      .activity-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
      }
      .activity-dot {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--blue-soft);
        color: var(--admin-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        flex-shrink: 0;
        margin-top: 2px;
      }
      .activity-text {
        font-size: 13px;
        color: var(--ink);
        line-height: 1.4;
      }
      .activity-text b {
        font-weight: 700;
        color: var(--forest-deep);
      }
      .activity-time {
        font-size: 11px;
        color: var(--ink-soft);
        margin-top: 2px;
      }

      @media (max-width: 1100px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .lower-grid { grid-template-columns: 1fr; }
      }
      @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
        .content { padding: 20px 16px 36px; }
        .topbar { padding: 12px 18px; }
      }
    </style>
</head>
<body>

<div class="app">

  <!-- ============================================== -->
  <!-- 1. SIDEBAR ADMINISTRACIÓN                      -->
  <!-- ============================================== -->
  <aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="brand">
      <div class="brand-badge">
        <img src="{{ asset('general/assets/img/cefaempresa.png') }}" alt="SENA Empresa">
      </div>
      <div>
        <div class="brand-name">
          <span>ADMIN</span>
          <span class="brand-tag">ERP</span>
        </div>
        <div class="brand-sub">Seguridad y Gobierno</div>
      </div>
    </a>

    <div class="nav-label">General</div>
    <nav>
      <a href="{{ route('admin.dashboard') }}" class="active">
        <i class="fa-solid fa-gauge-high"></i>
        <span>Inicio</span>
      </a>
      <a href="{{ route('admin.usuarios.index') }}">
        <i class="fa-solid fa-users-gear"></i>
        <span>Usuarios</span>
      </a>
      <a href="{{ route('admin.roles.index') }}">
        <i class="fa-solid fa-user-shield"></i>
        <span>Roles</span>
      </a>
      <a href="{{ route('admin.permisos.index') }}">
        <i class="fa-solid fa-key"></i>
        <span>Permisos</span>
      </a>
      <a href="{{ route('admin.auditoria.index') }}">
        <i class="fa-solid fa-clock-rotate-left"></i>
        <span>Auditoría</span>
      </a>
    </nav>

    <div class="nav-label">Módulos ERP</div>
    <nav>
      <a href="{{ route('home') }}">
        <i class="fa-solid fa-house"></i>
        <span>Portal Principal</span>
      </a>
      <a href="{{ route('egresados.dashboard') }}">
        <i class="fa-solid fa-user-graduate"></i>
        <span>Módulo Egresados</span>
      </a>
    </nav>

    <div style="margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <input type="hidden" name="redirect" value="{{ route('admin.welcome') }}">
        <button type="submit" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 9px 12px; border-radius: 10px; background: rgba(220, 38, 38, 0.15); border: 1px solid rgba(220, 38, 38, 0.3); color: #FCA5A5; font-size: 12.5px; font-weight: 700; cursor: pointer; transition: all 0.2s ease;">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          <span>Cerrar Sesión</span>
        </button>
      </form>
    </div>
  </aside>

  <!-- ============================================== -->
  <!-- 2. MAIN VIEWPORT                               -->
  <!-- ============================================== -->
  <div class="main">
    
    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-left">
        <a href="{{ route('admin.welcome') }}" class="portal-link-btn">
          <i class="fa-solid fa-shield-halved text-xs"></i>
          <span>Portal Administración</span>
        </a>
      </div>

      <div class="topbar-right">
        <a href="{{ route('admin.usuarios.create') }}" class="btn-new-user">
          <i class="fa-solid fa-user-plus text-xs"></i>
          <span>Nuevo Usuario</span>
        </a>

        <button class="icon-btn" title="Alertas de Seguridad">
          <i class="fa-regular fa-bell"></i>
          <span class="dot"></span>
        </button>

        <div class="user-chip" title="Usuario Administrador">
          <div class="user-avatar">
            {{ Auth::check() ? (Auth::user()->initials ?? 'AD') : 'AD' }}
          </div>
          <span>{{ Auth::check() ? (Auth::user()->first_name ?? Auth::user()->name ?? 'Administrador') : 'Administrador' }}</span>
          <i class="fa-solid fa-chevron-down" style="font-size: 10px; opacity: 0.7;"></i>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="content">
      
      <!-- Page Head -->
      <div class="page-head">
        <div>
          <h1 class="page-title">
            ¡Bienvenido(a), <span>{{ Auth::check() ? (Auth::user()->first_name ?? Auth::user()->name ?? 'Administración') : 'Administración' }}</span>!
          </h1>
          <p class="page-desc">Tablero central de supervisión, control de accesos, roles y trazabilidad de SENA Empresa ERP.</p>
        </div>

        <div class="period-pill">
          <i class="fa-regular fa-calendar-days"></i>
          <span>{{ ucfirst(\Carbon\Carbon::now()->locale('es')->translatedFormat('F Y')) }}</span>
        </div>
      </div>

      <!-- Stats Grid (6 Cards Identical Style) -->
      <div class="stats-grid">
        
        <!-- Card 1: Total Usuarios -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-users-gear"></i>
            </div>
            <div class="stat-title">Usuarios Registrados</div>
          </div>
          <div class="stat-value">{{ number_format($totalUsuarios) }}</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-circle-check"></i>
              <span>Cuentas activas</span>
            </div>
            <a href="{{ route('admin.usuarios.index') }}" class="stat-link">
              <span>Ver usuarios</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 2: Roles de Seguridad -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon amber">
              <i class="fa-solid fa-user-shield"></i>
            </div>
            <div class="stat-title">Roles de Aplicación</div>
          </div>
          <div class="stat-value">{{ number_format($totalRoles) }}</div>
          <div class="stat-meta">
            <div class="stat-trend" style="color: #D97706;">
              <i class="fa-solid fa-lock"></i>
              <span>Políticas activas</span>
            </div>
            <a href="{{ route('admin.roles.index') }}" class="stat-link">
              <span>Ver roles</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 3: Permisos Técnicos -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon green">
              <i class="fa-solid fa-key"></i>
            </div>
            <div class="stat-title">Permisos del Sistema</div>
          </div>
          <div class="stat-value">{{ number_format($totalPermisos) }}</div>
          <div class="stat-meta">
            <div class="stat-trend" style="color: var(--green);">
              <i class="fa-solid fa-shield-check"></i>
              <span>Control granular</span>
            </div>
            <a href="{{ route('admin.permisos.index') }}" class="stat-link">
              <span>Ver catálogo</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 4: Bitácora de Auditoría -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon purple">
              <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div class="stat-title">Trazabilidad de Eventos</div>
          </div>
          <div class="stat-value">{{ number_format($totalAuditorias) }}</div>
          <div class="stat-meta">
            <div class="stat-trend" style="color: #7C3AED;">
              <i class="fa-solid fa-fingerprint"></i>
              <span>Auditoría forense</span>
            </div>
            <a href="{{ route('admin.auditoria.index') }}" class="stat-link">
              <span>Ver bitácora</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 5: Altas / Creaciones -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon green">
              <i class="fa-solid fa-user-plus"></i>
            </div>
            <div class="stat-title">Registros Creados</div>
          </div>
          <div class="stat-value">{{ number_format($auditoriasPorEvento['created'] ?? 0) }}</div>
          <div class="stat-meta">
            <div class="stat-trend" style="color: var(--green);">
              <i class="fa-solid fa-arrow-up"></i>
              <span>Nuevos ingresos</span>
            </div>
            <a href="{{ route('admin.auditoria.index') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 6: Modificaciones -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="stat-title">Cambios Auditados</div>
          </div>
          <div class="stat-value">{{ number_format($auditoriasPorEvento['updated'] ?? 0) }}</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-arrows-rotate"></i>
              <span>Actualizaciones</span>
            </div>
            <a href="{{ route('admin.auditoria.index') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- Lower Section (Table + Widgets) -->
      <div class="lower-grid">
        
        <!-- Left Panel: Table of Recent Users -->
        <div class="panel">
          <div class="panel-head">
            <h2 class="panel-title">
              <i class="fa-solid fa-users"></i>
              <span>Usuarios Recientes en el Sistema</span>
            </h2>
            <a href="{{ route('admin.usuarios.index') }}" class="panel-action">Ver directorio completo</a>
          </div>

          <div style="overflow-x: auto;">
            <table class="table-custom">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Correo Electrónico</th>
                  <th>Rol Principal</th>
                  <th>Fecha de Alta</th>
                  <th style="text-align: center;">Acción</th>
                </tr>
              </thead>
              <tbody>
                @forelse($ultimosUsuarios as $u)
                  <tr>
                    <td>
                      <div style="font-weight: 700; color: var(--forest-deep);">
                        {{ $u->person->first_name ?? $u->name }} {{ $u->person->first_last_name ?? '' }}
                      </div>
                      <div style="font-size: 11px; color: var(--ink-soft); font-family: monospace;">
                        <code>{{ $u->nickname }}</code>
                      </div>
                    </td>
                    <td>
                      <div style="font-size: 12.5px; color: var(--ink);">
                        {{ $u->email }}
                      </div>
                    </td>
                    <td>
                      <span class="badge-event badge-updated">
                        {{ $u->roles->first()->name ?? 'Usuario ERP' }}
                      </span>
                    </td>
                    <td>
                      <div style="font-size: 12px; color: var(--ink-soft);">
                        {{ $u->created_at ? $u->created_at->format('d/m/Y H:i') : 'Reciente' }}
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <a href="{{ route('admin.usuarios.edit', $u->id) }}" title="Gestionar Usuario" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: var(--blue-soft); color: var(--admin-blue); text-decoration: none; transition: all 0.2s;">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: var(--ink-soft);">
                      <i class="fa-regular fa-user" style="font-size: 24px; display: block; margin-bottom: 8px; color: var(--admin-blue);"></i>
                      No hay usuarios registrados recientemente.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- Right Panels (Roles Coverage + Security Actions) -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
          
          <!-- Widget: Cobertura por Rol -->
          <div class="panel">
            <div class="panel-head">
              <h2 class="panel-title">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Usuarios por Rol Principal</span>
              </h2>
            </div>

            @php
              $maxUsers = $rolesPopulares->max('users_count') ?: 1;
            @endphp

            @foreach($rolesPopulares as $rol)
              @php
                $pct = round(($rol->users_count / $maxUsers) * 100);
              @endphp
              <div class="progress-item">
                <div class="progress-label">
                  <span>{{ $rol->name }}</span>
                  <span>{{ $rol->users_count }}</span>
                </div>
                <div class="progress-track">
                  <div class="progress-fill" style="width: {{ $pct }}%;"></div>
                </div>
              </div>
            @endforeach
          </div>

          <!-- Widget: Bitácora Forense -->
          <div class="panel">
            <div class="panel-head">
              <h2 class="panel-title">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Eventos de Auditoría</span>
              </h2>
              <a href="{{ route('admin.auditoria.index') }}" class="panel-action">Ver bitácora</a>
            </div>

            @forelse($ultimasAuditorias as $auditoria)
              <div class="activity-row">
                <div class="activity-dot" style="{{ $auditoria->event === 'created' ? 'background: var(--green-soft); color: var(--green);' : ($auditoria->event === 'deleted' ? 'background: var(--red-soft); color: #DC2626;' : 'background: var(--blue-soft); color: var(--admin-blue);') }}">
                  <i class="fa-solid {{ $auditoria->event === 'created' ? 'fa-plus' : ($auditoria->event === 'deleted' ? 'fa-trash' : 'fa-pen') }}"></i>
                </div>
                <div>
                  <div class="activity-text">
                    <b>{{ $auditoria->user->nickname ?? 'Sistema' }}</b> ejecutó 
                    <span class="badge-event {{ $auditoria->event === 'created' ? 'badge-created' : ($auditoria->event === 'deleted' ? 'badge-deleted' : 'badge-updated') }}" style="font-size: 9.5px; padding: 1px 6px;">{{ $auditoria->event }}</span>
                    sobre <b>{{ class_basename($auditoria->auditable_type ?? 'Registro') }}</b>
                  </div>
                  <div class="activity-time">
                    {{ $auditoria->created_at ? $auditoria->created_at->diffForHumans() : 'Hace un momento' }} • IP: {{ $auditoria->ip_address ?? '127.0.0.1' }}
                  </div>
                </div>
              </div>
            @empty
              <div class="activity-row">
                <div class="activity-dot">
                  <i class="fa-solid fa-shield-check"></i>
                </div>
                <div>
                  <div class="activity-text">
                    <b>Servicio de Auditoría</b> activo y monitoreando
                  </div>
                  <div class="activity-time">En tiempo real</div>
                </div>
              </div>
            @endforelse
          </div>

        </div>

      </div>

    </div>

  </div>

</div>

</body>
</html>
