<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Panel del Instructor — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Fraunces + Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Jost:wght@500;600;700;800&display=swap" rel="stylesheet">
    
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
        --moss: #62E31D;
        --bg: #F4F7F6;
        --card: #FFFFFF;
        --ink: #16261C;
        --ink-soft: #6B7A70;
        --line: #E8EFE9;
      }

      * { box-sizing: border-box; }
      html, body { margin: 0; padding: 0; }

      body {
        font-family: 'Poppins', 'Open Sans', sans-serif;
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
        font-family: 'Poppins', 'Jost', sans-serif;
        font-weight: 700;
        font-size: 18px;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .brand-tag {
        font-family: 'Poppins', 'Open Sans', sans-serif;
        font-size: 9px;
        font-weight: 800;
        background: #0288d1;
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
        color: #0288d1;
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
        border-bottom: 3px solid #39A900;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
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
        background: rgba(57, 169, 0, 0.2);
        border: 1px solid #39A900;
        color: #ffffff;
        font-size: 12px;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 999px;
        text-decoration: none;
        transition: all 0.2s ease;
      }
      .portal-link-btn:hover {
        background: var(--green);
        border-color: #62E31D;
        box-shadow: 0 2px 10px rgba(57, 169, 0, 0.4);
        color: #ffffff;
      }

      .topbar-right {
        display: flex;
        align-items: center;
        gap: 16px;
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
        background: rgba(57, 169, 0, 0.25);
        color: #62E31D;
        transform: translateY(-1px);
      }
      .icon-btn .dot {
        position: absolute;
        top: 6px;
        right: 7px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #62E31D;
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
        transition: all 0.2s ease;
        color: #ffffff;
        user-select: none;
      }
      .user-chip:hover {
        background: rgba(57, 169, 0, 0.2);
        border-color: rgba(98, 227, 29, 0.4);
      }
      .user-dropdown-wrapper {
        position: relative;
      }
      .user-dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        min-width: 230px;
        background: #001A29;
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-top: 2px solid var(--green);
        border-radius: 14px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.45);
        padding: 6px 0;
        z-index: 1000;
        backdrop-filter: blur(10px);
      }
      .user-dropdown-menu.show {
        display: block;
        animation: dropFade 0.15s ease-out;
      }
      @keyframes dropFade {
        from { opacity: 0; transform: translateY(-6px); }
        to { opacity: 1; transform: translateY(0); }
      }
      .user-dropdown-header {
        padding: 10px 16px 8px;
      }
      .user-dropdown-name {
        font-weight: 700;
        font-size: 13.5px;
        color: #ffffff;
      }
      .user-dropdown-role {
        font-size: 10.5px;
        font-weight: 700;
        color: var(--moss);
        text-transform: uppercase;
        margin-top: 2px;
        letter-spacing: 0.4px;
      }
      .user-dropdown-email {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.6);
        margin-top: 2px;
      }
      .user-dropdown-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.08);
        margin: 5px 0;
      }
      .user-dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 16px;
        font-size: 12.5px;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        font-family: inherit;
        font-weight: 600;
        transition: all 0.15s;
      }
      .user-dropdown-item i {
        width: 16px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.6);
      }
      .user-dropdown-item:hover {
        background: rgba(57, 169, 0, 0.18);
        color: #62E31D;
      }
      .user-dropdown-item:hover i {
        color: #62E31D;
      }
      .user-dropdown-item.logout-item {
        color: #FCA5A5;
      }
      .user-dropdown-item.logout-item i {
        color: #F87171;
      }
      .user-dropdown-item.logout-item:hover {
        background: rgba(220, 38, 38, 0.2);
        color: #ffffff;
      }
      .user-dropdown-item.logout-item:hover i {
        color: #ffffff;
      }
      .user-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #39A900 0%, #002336 100%);
        border: 1.5px solid #62E31D;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', 'Jost', sans-serif;
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
        font-family: 'Poppins', 'Jost', sans-serif;
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
      .stat-icon.blue { background: rgba(57, 169, 0, 0.12); color: var(--green); }
      .stat-icon.amber { background: var(--amber-soft); color: #D97706; }
      .stat-icon.purple { background: rgba(0, 35, 54, 0.1); color: var(--forest); }

      .stat-title {
        font-size: 13.5px;
        color: var(--ink-soft);
        font-weight: 600;
      }
      .stat-value {
        font-family: 'Poppins', 'Jost', sans-serif;
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
        flex-wrap: wrap;
        gap: 10px;
      }
      .panel-title {
        font-family: 'Poppins', 'Jost', sans-serif;
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

      /* Custom Table */
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
        padding: 13px 14px;
        border-bottom: 1px solid var(--line);
        color: var(--ink);
        vertical-align: middle;
      }
      .table-custom tr:last-child td {
        border-bottom: none;
      }
      .table-custom tr:hover td {
        background: rgba(57, 169, 0, 0.02);
      }

      .badge-status {
        display: inline-flex;
        align-items: center;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
      }
      .badge-green { background: #EAF7EE; color: #236B00; border: 1px solid #C4ECCB; }
      .badge-blue { background: #EBF3FF; color: #1E40AF; border: 1px solid #BFDBFE; }
      .badge-amber { background: #FEF7EA; color: #B45309; border: 1px solid #FDE68A; }
      .badge-purple { background: #F5EFFF; color: #6D28D9; border: 1px solid #DDD6FE; }

      /* Progress Bars */
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

      /* Activity List */
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
        background: var(--green-soft);
        color: var(--green);
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

      /* Filter bar */
      .filter-bar {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
      }
      .filter-select, .filter-input {
        padding: 6px 12px;
        background: #F9FBFA;
        border: 1px solid var(--line);
        border-radius: 8px;
        font-size: 12.5px;
        color: var(--ink);
        outline: none;
        transition: border-color 0.2s;
      }
      .filter-select:focus, .filter-input:focus {
        border-color: var(--green);
        background: #ffffff;
      }
      .btn-filter {
        background: var(--green);
        color: #ffffff;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s;
      }
      .btn-filter:hover {
        background: var(--green-dark);
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
  <!-- 1. SIDEBAR INSTRUCTOR SIGE                     -->
  <!-- ============================================== -->
  <aside class="sidebar">
    <a href="{{ route('egresados.instructor.dashboard') }}" class="brand">
      <div class="brand-badge">
        <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA">
      </div>
      <div>
        <div class="brand-name">
          <span>SIGE</span>
          <span class="brand-tag">Instructor</span>
        </div>
        <div class="brand-sub">CEFA La Angostura</div>
      </div>
    </a>

    <div class="nav-label">General</div>
    <nav>
      <a href="{{ route('egresados.instructor.dashboard') }}" class="active">
        <i class="fa-solid fa-gauge-high"></i>
        <span>Inicio</span>
      </a>
      <a href="{{ route('egresados.instructor.directorio') }}">
        <i class="fa-solid fa-user-graduate"></i>
        <span>Egresados Fichas</span>
      </a>
      <a href="{{ route('egresados.instructor.encuestas.index') }}">
        <i class="fa-solid fa-clipboard-question"></i>
        <span>Encuestas</span>
      </a>
      <a href="{{ route('egresados.instructor.reportes.index') }}">
        <i class="fa-solid fa-file-invoice"></i>
        <span>Reportes</span>
      </a>
      <a href="{{ route('egresados.instructor.eventos.index') }}">
        <i class="fa-regular fa-calendar-check"></i>
        <span>Eventos</span>
      </a>
    </nav>

    <div class="nav-label">Portal Público</div>
    <nav>
      <a href="{{ route('egresados.welcome') }}">
        <i class="fa-solid fa-house"></i>
        <span>Portal Egresados</span>
      </a>
    </nav>
  </aside>

  <!-- ============================================== -->
  <!-- 2. MAIN VIEWPORT                               -->
  <!-- ============================================== -->
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
        <button class="icon-btn" title="Notificaciones">
          <i class="fa-regular fa-bell"></i>
          <span class="dot"></span>
        </button>

        <div class="user-dropdown-wrapper">
          <div class="user-chip" id="userMenuBtn" onclick="toggleUserMenu(event)" title="Opciones de Cuenta">
            <div class="user-avatar">
              {{ Auth::check() ? (Auth::user()->initials ?? 'IN') : 'IN' }}
            </div>
            <span>{{ Auth::check() ? (Auth::user()->first_name ?? Auth::user()->name ?? 'Instructor Egresados') : 'Instructor Egresados' }}</span>
            <i class="fa-solid fa-chevron-down" id="userMenuChevron" style="font-size: 10px; opacity: 0.7; transition: transform 0.2s;"></i>
          </div>

          <div class="user-dropdown-menu" id="userDropdownMenu">
            <div class="user-dropdown-header">
              <div class="user-dropdown-name">{{ Auth::check() ? (Auth::user()->first_name ?? Auth::user()->name ?? 'Instructor Egresados') : 'Instructor Egresados' }}</div>
              <div class="user-dropdown-role"><i class="fa-solid fa-circle" style="font-size: 6px; color: var(--moss); margin-right: 4px;"></i> Rol: Instructor CEFA</div>
              <div class="user-dropdown-email">{{ Auth::check() ? (Auth::user()->email ?? 'instructor@sena.edu.co') : 'instructor@sena.edu.co' }}</div>
            </div>
            
            <div class="user-dropdown-divider"></div>

            <a href="{{ route('egresados.welcome') }}" class="user-dropdown-item">
              <i class="fa-solid fa-globe"></i>
              <span>Portal Público SIGE</span>
            </a>

            <div class="user-dropdown-divider"></div>

            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
              @csrf
              <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
              <button type="submit" class="user-dropdown-item logout-item">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Cerrar Sesión</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="content">
      
      <!-- Page Head -->
      <div class="page-head">
        <div>
          <h1 class="page-title">
            ¡Bienvenido(a), <span>{{ Auth::check() ? (Auth::user()->first_name ?? Auth::user()->name ?? 'Instructor(a)') : 'Instructor(a)' }}</span>!
          </h1>
          <p class="page-desc">Monitoreo, estado laboral y seguimiento de aprendices egresados en tus fichas de formación.</p>
        </div>

        <div class="period-pill">
          <i class="fa-regular fa-calendar-days"></i>
          <span>{{ ucfirst(\Carbon\Carbon::now()->locale('es')->translatedFormat('F Y')) }}</span>
        </div>
      </div>

      <!-- Stats Grid (6 Cards Identical Style) -->
      <div class="stats-grid">
        
        <!-- Card 1: Total Egresados -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div class="stat-title">Total Egresados Fichas</div>
          </div>
          <div class="stat-value">{{ number_format($totalEgresados) }}</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-circle-check"></i>
              <span>Bajo seguimiento</span>
            </div>
            <a href="{{ route('egresados.instructor.directorio') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 2: Egresados Empleados -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon blue">
              <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="stat-title">Egresados Vinculados</div>
          </div>
          <div class="stat-value">{{ number_format($totalEmpleados) }}</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-arrow-trend-up"></i>
              <span>Sector productivo</span>
            </div>
            <a href="{{ route('egresados.instructor.directorio', ['status' => 'EN FORMACIÓN']) }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 3: Emprendedores -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon amber">
              <i class="fa-solid fa-rocket"></i>
            </div>
            <div class="stat-title">Emprendimientos Activos</div>
          </div>
          <div class="stat-value">{{ number_format($totalEmprendedores) }}</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-bolt"></i>
              <span>Fondo Emprender</span>
            </div>
            <a href="{{ route('egresados.instructor.directorio', ['status' => 'INDUCCIÓN']) }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 4: Formación Continua -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon purple">
              <i class="fa-solid fa-award"></i>
            </div>
            <div class="stat-title">Formación Continua</div>
          </div>
          <div class="stat-value">{{ number_format($totalEstudiantes) }}</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>Cursos complementarios</span>
            </div>
            <a href="{{ route('egresados.instructor.directorio', ['status' => 'CONDICIONADO']) }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 5: Encuestas Diligenciadas -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-clipboard-check"></i>
            </div>
            <div class="stat-title">Encuestas Respondidas</div>
          </div>
          <div class="stat-value">142</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-arrow-up"></i>
              <span>78% de respuesta</span>
            </div>
            <a href="{{ route('egresados.instructor.encuestas.index') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 6: Fichas Asignadas -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon blue">
              <i class="fa-solid fa-layer-group"></i>
            </div>
            <div class="stat-title">Fichas en Monitoreo</div>
          </div>
          <div class="stat-value">{{ count($courses) }}</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-chalkboard-user"></i>
              <span>Sede La Angostura</span>
            </div>
            <a href="{{ route('egresados.instructor.directorio') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- Lower Section (Table + Widgets) -->
      <div class="lower-grid">
        
        <!-- Left Panel: Table of Egresados with filters -->
        <div class="panel">
          <div class="panel-head">
            <h2 class="panel-title">
              <i class="fa-solid fa-table-list"></i>
              <span>Seguimiento de Aprendices por Ficha</span>
            </h2>
            
            <form action="{{ route('egresados.instructor.dashboard') }}" method="GET" class="filter-bar">
              <select name="course_id" onchange="this.form.submit()" class="filter-select">
                <option value="">-- Todas las Fichas --</option>
                @foreach($courses as $course)
                  <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                    Ficha {{ $course->code }}
                  </option>
                @endforeach
              </select>

              <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o doc..." class="filter-input">
              <button type="submit" class="btn-filter">Filtrar</button>
              
              @if(request('course_id') || request('search'))
                <a href="{{ route('egresados.instructor.dashboard') }}" style="font-size: 12px; color: #DC2626; text-decoration: none; font-weight: 600;">
                  <i class="fa-solid fa-xmark"></i> Limpiar
                </a>
              @endif
            </form>
          </div>

          <div style="overflow-x: auto;">
            <table class="table-custom">
              <thead>
                <tr>
                  <th>Egresado(a)</th>
                  <th>Programa / Ficha</th>
                  <th>Contacto</th>
                  <th>Estado</th>
                  <th style="text-align: center;">Acción</th>
                </tr>
              </thead>
              <tbody>
                @forelse($egresadosSeguimiento as $egresado)
                  <tr>
                    <td>
                      <div style="font-weight: 700; color: var(--forest-deep);">
                        {{ $egresado->person->first_name ?? 'Sin Nombre' }} {{ $egresado->person->first_last_name ?? '' }}
                      </div>
                      <div style="font-size: 11px; color: var(--ink-soft); font-family: monospace;">
                        {{ $egresado->person->document_type ?? 'CC' }}: {{ $egresado->person->document_number ?? 'S/N' }}
                      </div>
                    </td>
                    <td>
                      <div style="font-weight: 600; color: var(--ink);">
                        {{ $egresado->course->program->name ?? 'Programa General' }}
                      </div>
                      <div style="font-size: 11px; color: var(--green); font-weight: 700;">
                        Ficha: {{ $egresado->course->code ?? 'N/A' }}
                      </div>
                    </td>
                    <td>
                      <div style="font-size: 12px;">
                        <i class="fa-solid fa-phone" style="font-size: 10px; color: var(--ink-soft); margin-right: 4px;"></i>
                        {{ $egresado->person->telephone1 ?? 'No registra' }}
                      </div>
                      <div style="font-size: 11px; color: var(--ink-soft);">
                        {{ $egresado->person->misena_email ?? ($egresado->person->personal_email ?? 'No registra') }}
                      </div>
                    </td>
                    <td>
                      @php
                        $st = $egresado->apprentice_status;
                        $badgeClass = match($st) {
                          'EN FORMACIÓN' => 'badge-blue',
                          'INDUCCIÓN' => 'badge-amber',
                          'CONDICIONADO' => 'badge-purple',
                          default => 'badge-green',
                        };
                        $badgeLabel = match($st) {
                          'EN FORMACIÓN' => 'EMPLEADO',
                          'INDUCCIÓN' => 'EMPRENDEDOR',
                          'CONDICIONADO' => 'ESTUDIANDO',
                          default => 'GRADUADO',
                        };
                      @endphp
                      <span class="badge-status {{ $badgeClass }}">
                        {{ $badgeLabel }}
                      </span>
                    </td>
                    <td style="text-align: center;">
                      <a href="{{ route('egresados.superadmin.perfil', ['id' => $egresado->id]) }}" title="Ver Ficha y Hoja de Vida" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: var(--green-soft); color: var(--green); text-decoration: none; transition: all 0.2s;">
                        <i class="fa-solid fa-arrow-right"></i>
                      </a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: var(--ink-soft);">
                      <i class="fa-regular fa-folder-open" style="font-size: 24px; display: block; margin-bottom: 8px; color: var(--green);"></i>
                      No se encontraron egresados con los filtros seleccionados.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div style="margin-top: 16px;">
            {{ $egresadosSeguimiento->links() }}
          </div>
        </div>

        <!-- Right Panels (Avance + Actividad) -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
          
          <!-- Widget: Avance por Programa -->
          <div class="panel">
            <div class="panel-head">
              <h2 class="panel-title">
                <i class="fa-solid fa-chart-line"></i>
                <span>Avance por Programa</span>
              </h2>
            </div>

            <div class="progress-item">
              <div class="progress-label">
                <span>Gestión Agroempresarial</span>
                <span>82%</span>
              </div>
              <div class="progress-track">
                <div class="progress-fill" style="width: 82%;"></div>
              </div>
            </div>

            <div class="progress-item">
              <div class="progress-label">
                <span>ADSO (Desarrollo de Software)</span>
                <span>68%</span>
              </div>
              <div class="progress-track">
                <div class="progress-fill" style="width: 68%;"></div>
              </div>
            </div>

            <div class="progress-item">
              <div class="progress-label">
                <span>Producción Agropecuaria</span>
                <span>74%</span>
              </div>
              <div class="progress-track">
                <div class="progress-fill" style="width: 74%;"></div>
              </div>
            </div>

            <div class="progress-item">
              <div class="progress-label">
                <span>Control de Calidad de Alimentos</span>
                <span>90%</span>
              </div>
              <div class="progress-track">
                <div class="progress-fill" style="width: 90%;"></div>
              </div>
            </div>
          </div>

          <!-- Widget: Actividad Reciente -->
          <div class="panel">
            <div class="panel-head">
              <h2 class="panel-title">
                <i class="fa-solid fa-bolt"></i>
                <span>Actividad de Seguimiento</span>
              </h2>
              <a href="{{ route('egresados.instructor.directorio') }}" class="panel-action">Ver todo</a>
            </div>

            <div class="activity-row">
              <div class="activity-dot">
                <i class="fa-solid fa-check"></i>
              </div>
              <div>
                <div class="activity-text">
                  <b>Juan Pérez</b> actualizó su vinculación laboral en <b>ADSO</b>
                </div>
                <div class="activity-time">Hace 20 minutos</div>
              </div>
            </div>

            <div class="activity-row">
              <div class="activity-dot" style="background: var(--green-soft); color: var(--green);">
                <i class="fa-solid fa-clipboard-check"></i>
              </div>
              <div>
                <div class="activity-text">
                  <b>Laura Muñoz</b> completó la encuesta de impacto CEFA
                </div>
                <div class="activity-time">Hace 1 hora</div>
              </div>
            </div>

            <div class="activity-row">
              <div class="activity-dot" style="background: var(--amber-soft); color: #D97706;">
                <i class="fa-solid fa-rocket"></i>
              </div>
              <div>
                <div class="activity-text">
                  <b>Carlos Dussán</b> registró emprendimiento piscícola
                </div>
                <div class="activity-time">Hace 3 horas</div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<script>
  function toggleUserMenu(e) {
    e.stopPropagation();
    const menu = document.getElementById('userDropdownMenu');
    const chevron = document.getElementById('userMenuChevron');
    const isOpen = menu.classList.contains('show');
    if (isOpen) {
      menu.classList.remove('show');
      if (chevron) chevron.style.transform = 'rotate(0deg)';
    } else {
      menu.classList.add('show');
      if (chevron) chevron.style.transform = 'rotate(180deg)';
    }
  }

  document.addEventListener('click', function(e) {
    const menu = document.getElementById('userDropdownMenu');
    const chevron = document.getElementById('userMenuChevron');
    const btn = document.getElementById('userMenuBtn');
    if (menu && menu.classList.contains('show')) {
      if (!menu.contains(e.target) && !btn.contains(e.target)) {
        menu.classList.remove('show');
        if (chevron) chevron.style.transform = 'rotate(0deg)';
      }
    }
  });
</script>

</body>
</html>
