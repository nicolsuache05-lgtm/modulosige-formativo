<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Reportes y Estadísticas — Instructor CEFA</title>

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
        border: 2px solid rgba(98, 227, 29, 0.6);
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
        background: linear-gradient(135deg, #39A900 0%, #2a7c00 100%);
        color: #ffffff;
        padding: 2px 8px;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1px solid rgba(98, 227, 29, 0.5);
        box-shadow: 0 2px 8px rgba(57, 169, 0, 0.35);
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
        background: rgba(57, 169, 0, 0.16);
        color: #62E31D;
        transform: translateX(3px);
      }
      nav a:hover i {
        color: #62E31D;
      }
      nav a.active {
        background: linear-gradient(90deg, #39A900 0%, #2a7c00 100%);
        color: #ffffff;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35);
        border: 1px solid rgba(98, 227, 29, 0.4);
      }
      nav a.active i {
        color: #ffffff;
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
        font-size: 14px;
        color: var(--ink-soft);
        margin: 0;
      }

      .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--forest);
        color: #ffffff;
        padding: 10px 18px;
        border-radius: 12px;
        font-size: 13.5px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
      }
      .btn-primary:hover {
        background: var(--green);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(57, 169, 0, 0.25);
      }

      /* Stats Grid */
      .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 28px;
      }
      .stat-card {
        background: var(--card);
        border-radius: 16px;
        padding: 20px 22px;
        border: 1px solid var(--line);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        transition: all 0.25s ease;
      }
      .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        border-color: rgba(57, 169, 0, 0.3);
      }
      .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
      }
      .stat-label {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--ink-soft);
      }
      .stat-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
      }
      .stat-icon.blue { background: rgba(57, 169, 0, 0.12); color: var(--green); }
      .stat-icon.green { background: var(--green-soft); color: var(--green); }
      .stat-icon.amber { background: var(--amber-soft); color: #D97706; }
      .stat-icon.purple { background: rgba(0, 35, 54, 0.08); color: var(--forest); }

      .stat-value {
        font-family: 'Poppins', 'Jost', sans-serif;
        font-weight: 700;
        font-size: 26px;
        color: var(--forest-deep);
        margin-bottom: 4px;
      }
      .stat-sub {
        font-size: 11.5px;
        color: var(--ink-soft);
      }

      /* Flash alert */
      .flash-alert {
        background: #ECFDF5;
        border: 1px solid #A7F3D0;
        color: #065F46;
        padding: 12px 18px;
        border-radius: 12px;
        margin-bottom: 22px;
        font-size: 13.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      /* Card Container */
      .card-box {
        background: var(--card);
        border-radius: 16px;
        border: 1px solid var(--line);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        overflow: hidden;
      }
      .card-box-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
      }
      .card-box-title {
        font-family: 'Poppins', 'Jost', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: var(--forest-deep);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .card-box-desc {
        font-size: 12.5px;
        color: var(--ink-soft);
        margin: 2px 0 0;
      }

      /* Table */
      .table-wrapper {
        overflow-x: auto;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
      }
      th {
        background: #F9FBFA;
        padding: 12px 20px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--ink-soft);
        border-bottom: 1px solid var(--line);
      }
      td {
        padding: 16px 20px;
        border-bottom: 1px solid var(--line);
        vertical-align: middle;
      }
      tr:last-child td {
        border-bottom: none;
      }
      tr:hover td {
        background: #FAFCFB;
      }

      .report-title {
        font-weight: 700;
        color: var(--forest-deep);
        font-size: 14px;
        margin-bottom: 2px;
      }
      .report-sub {
        font-size: 12px;
        color: var(--ink-soft);
      }

      .format-badge {
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.5px;
      }
      .format-excel { background: #E8F5E9; color: #2E7D32; border: 1px solid #C8E6C9; }
      .format-pdf { background: #FFEBEE; color: #C62828; border: 1px solid #FFCDD2; }
      .format-csv { background: #E3F2FD; color: #1565C0; border: 1px solid #BBDEFB; }

      .action-btns {
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--green-soft);
        color: var(--green);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
        text-decoration: none;
        font-size: 13px;
      }
      .btn-icon:hover {
        background: var(--green);
        color: #ffffff;
      }

      /* Modal */
      .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 19, 30, 0.6);
        backdrop-filter: blur(4px);
        z-index: 100;
        align-items: center;
        justify-content: center;
        padding: 20px;
      }
      .modal-box {
        background: #ffffff;
        border-radius: 20px;
        width: 100%;
        max-width: 600px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
      }
      .modal-head {
        padding: 22px 26px;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .modal-title {
        font-family: 'Poppins', 'Jost', sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: var(--forest-deep);
        margin: 0;
      }
      .modal-close {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: none;
        border: 1px solid var(--line);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--ink-soft);
      }
      .modal-body {
        padding: 26px;
      }
      .form-group {
        margin-bottom: 16px;
      }
      .form-label {
        display: block;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 6px;
        color: var(--ink);
      }
      .form-control {
        width: 100%;
        padding: 9px 13px;
        background: #FAFCFB;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Poppins', 'Open Sans', sans-serif;
        outline: none;
      }
      .form-control:focus {
        border-color: var(--green);
        background: #ffffff;
      }
      .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
      }
      .modal-foot {
        padding: 18px 26px;
        border-top: 1px solid var(--line);
        display: flex;
        justify-content: flex-end;
        gap: 10px;
      }
      .btn-cancel {
        padding: 9px 18px;
        background: #F4F7F6;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
      }
      .btn-submit {
        padding: 9px 20px;
        background: var(--green);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
      }

      @media (max-width: 1100px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .stats-grid { grid-template-columns: 1fr 1fr; }
      }
      @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
        .content { padding: 20px 16px; }
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
      <a href="{{ route('egresados.instructor.dashboard') }}">
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
      <a href="{{ route('egresados.instructor.reportes.index') }}" class="active">
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

      @if(session('success'))
      <div class="flash-alert">
        <div style="display: flex; align-items: center; gap: 10px;">
          <i class="fa-solid fa-circle-check" style="font-size: 18px; color: var(--green);"></i>
          <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: #065F46;">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      @endif

      <!-- Page Header -->
      <div class="page-head">
        <div>
          <h1 class="page-title">Reportes y <span>Estadísticas</span></h1>
          <p class="page-desc">Consolidados analíticos de egresados, inserción laboral y seguimiento a fichas formativas.</p>
        </div>
        <div>
          <button type="button" class="btn-primary" onclick="openModal()">
            <i class="fa-solid fa-file-circle-plus"></i>
            <span>Generar Reporte</span>
          </button>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Reportes Generados</span>
            <div class="stat-icon blue"><i class="fa-solid fa-file-invoice"></i></div>
          </div>
          <div class="stat-value">{{ $totalGenerados }}</div>
          <div class="stat-sub">Archivos descargables</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Egresados en Fichas</span>
            <div class="stat-icon green"><i class="fa-solid fa-user-graduate"></i></div>
          </div>
          <div class="stat-value">{{ $totalEgresados }}</div>
          <div class="stat-sub">CEFA La Angostura</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Tasa Empleabilidad</span>
            <div class="stat-icon amber"><i class="fa-solid fa-briefcase"></i></div>
          </div>
          <div class="stat-value">{{ $tasaEmpleabilidad }}</div>
          <div class="stat-sub">Sector productivo</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Seguimientos del Mes</span>
            <div class="stat-icon purple"><i class="fa-solid fa-chart-line"></i></div>
          </div>
          <div class="stat-value">{{ $seguimientosMes }}</div>
          <div class="stat-sub">Registros validados</div>
        </div>
      </div>

      <!-- Reports Table Box -->
      <div class="card-box">
        <div class="card-box-header">
          <div>
            <h2 class="card-box-title"><i class="fa-solid fa-folder-open" style="color: var(--green);"></i> Informes de Seguimiento Disponibles</h2>
            <p class="card-box-desc">Exporta en formatos estándar para análisis en Excel o presentaciones de coordinación.</p>
          </div>
          <div>
            <a href="{{ route('egresados.instructor.reportes.export') }}" class="btn-primary" style="padding: 7px 14px; font-size: 12.5px;">
              <i class="fa-solid fa-file-excel"></i>
              <span>Exportar Todos (CSV)</span>
            </a>
          </div>
        </div>

        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>Código / Informe</th>
                <th>Tipo de Reporte</th>
                <th>Programa / Ficha</th>
                <th>Fecha Generado</th>
                <th>Formato</th>
                <th>Cobertura</th>
                <th style="text-align: right;">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reports as $rep)
              <tr>
                <td>
                  <div class="report-title">{{ $rep['title'] }}</div>
                  <div class="report-sub">{{ $rep['full_title'] }}</div>
                  <span style="font-family: monospace; font-size: 11px; color: var(--ink-soft);">{{ $rep['id'] }}</span>
                </td>
                <td>
                  <span style="font-weight: 600; color: var(--forest-deep);">{{ $rep['type'] }}</span>
                </td>
                <td>
                  <span style="font-size: 12.5px; color: var(--ink-soft);">{{ $rep['program'] ?? 'Fichas CEFA' }}</span>
                </td>
                <td>
                  <span style="font-size: 12.5px; color: var(--ink-soft);">{{ $rep['date'] }}</span>
                </td>
                <td>
                  @if(($rep['format'] ?? 'EXCEL') === 'EXCEL')
                    <span class="format-badge format-excel"><i class="fa-solid fa-file-excel"></i> EXCEL</span>
                  @elseif(($rep['format'] ?? 'PDF') === 'PDF')
                    <span class="format-badge format-pdf"><i class="fa-solid fa-file-pdf"></i> PDF</span>
                  @else
                    <span class="format-badge format-csv"><i class="fa-solid fa-file-csv"></i> CSV</span>
                  @endif
                </td>
                <td>
                  <span style="font-weight: 700; color: var(--forest-deep);">{{ $rep['total_egresados'] }}</span> egresados
                  <div style="font-size: 11px; color: var(--green); font-weight: 600;">{{ $rep['rate'] }} inserción</div>
                </td>
                <td style="text-align: right;">
                  <div class="action-btns" style="justify-content: flex-end;">
                    <a href="{{ route('egresados.instructor.reportes.export', $rep['id']) }}" class="btn-icon" title="Descargar Reporte">
                      <i class="fa-solid fa-download"></i>
                    </a>
                    <button type="button" class="btn-icon" title="Ver informe analítico" onclick='abrirDetalleReporte(@json($rep))'>
                      <i class="fa-solid fa-eye"></i>
                    </button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- ============================================== -->
<!-- MODAL: GENERAR NUEVO REPORTE                   -->
<!-- ============================================== -->
<div class="modal-overlay" id="modalReporte">
  <div class="modal-box">
    <div class="modal-head">
      <h3 class="modal-title"><i class="fa-solid fa-file-circle-plus" style="color: var(--green); margin-right: 8px;"></i> Generar Nuevo Reporte</h3>
      <button type="button" class="modal-close" onclick="closeModal()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form action="{{ route('egresados.instructor.reportes.store') }}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Título del Reporte *</label>
          <input type="text" name="titulo" class="form-control" placeholder="Ej. Seguimiento Egresados ADSO 2026 - Trimestre II" required>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Tipo de Reporte *</label>
            <select name="tipo" class="form-control" required>
              <option value="Seguimiento Fichas">Seguimiento Fichas</option>
              <option value="Empleabilidad">Empleabilidad y Salarios</option>
              <option value="Encuestas">Resultados de Encuestas</option>
              <option value="Actualización Datos">Actualización de Datos</option>
              <option value="Emprendimiento">Proyectos Productivos</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Formato de Salida *</label>
            <select name="formato" class="form-control" required>
              <option value="EXCEL">Excel (.xlsx)</option>
              <option value="CSV">CSV delimitado por comas (.csv)</option>
              <option value="PDF">Documento PDF (.pdf)</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Filtrar por Programa / Ficha</label>
          <select name="programa" class="form-control">
            <option value="Todas las Fichas del Instructor">Todas mis Fichas asignadas</option>
            @foreach($courses as $c)
            <option value="Ficha {{ $c->code }} - {{ $c->program->name ?? 'Programa' }}">
              Ficha {{ $c->code }} — {{ $c->program->name ?? 'SENA' }}
            </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="modal-foot">
        <button type="button" class="btn-cancel" onclick="closeModal()">Cancelar</button>
        <button type="submit" class="btn-submit">
          <i class="fa-solid fa-bolt mr-1"></i> Generar y Descargar
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById('modalReporte').style.display = 'flex';
  }
  function closeModal() {
    document.getElementById('modalReporte').style.display = 'none';
  }

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

  // Visualizador modal de Reporte Analítico
  let reporteActual = null;

  function abrirDetalleReporte(rep) {
    reporteActual = rep;
    document.getElementById('verRep_title').textContent = rep.full_title || rep.title || 'Informe de Seguimiento';
    document.getElementById('verRep_sub').textContent = 'Código: ' + (rep.id || 'REP-001') + ' · Fecha de generación: ' + (rep.date || 'Reciente');
    document.getElementById('verRep_total').textContent = rep.total_egresados ?? 145;
    document.getElementById('verRep_empleados').textContent = rep.empleados ?? 112;
    document.getElementById('verRep_pendientes').textContent = rep.pendientes ?? 33;
    document.getElementById('verRep_rate').textContent = rep.rate || '77%';
    document.getElementById('verRep_rateLabel').textContent = rep.rate || '77%';
    document.getElementById('verRep_progressFill').style.width = (rep.rate_num || 77) + '%';
    document.getElementById('verRep_programa').textContent = rep.program || 'Fichas Asignadas';
    document.getElementById('verRep_tipo').textContent = rep.type || 'Seguimiento Fichas';
    document.getElementById('verRep_formato').textContent = (rep.format || 'EXCEL') + ' / CSV';

    const downloadBtn = document.getElementById('verRep_btnDescargar');
    if (downloadBtn) {
      downloadBtn.href = '/egresados/instructor/reportes/exportar/' + (rep.id || 'Consolidado');
    }

    document.getElementById('modalVerReporte').style.display = 'flex';
  }

  function cerrarDetalleReporte() {
    document.getElementById('modalVerReporte').style.display = 'none';
  }
</script>

<!-- MODAL: VER DETALLE Y ESTADÍSTICAS DEL REPORTE -->
<div class="modal-overlay" id="modalVerReporte">
  <div class="modal-box" style="max-width: 780px;">
    <div class="modal-head">
      <div>
        <div class="format-badge"><i class="fa-solid fa-chart-pie"></i> INFORME ANALÍTICO DE SEGUIMIENTO · CEFA LA ANGOSTURA</div>
        <h3 class="modal-title" id="verRep_title">Consolidado Egresados Fichas Asignadas</h3>
        <div class="modal-sub" id="verRep_sub">Código: REP-INS-001 · Fecha: 24/10/2026</div>
      </div>
      <button type="button" class="modal-close" onclick="cerrarDetalleReporte()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="modal-body">
      <!-- Grid de Métricas de Empleabilidad -->
      <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 20px;">
        <div style="background: #FAFCFB; border: 1px solid var(--line); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: var(--ink-soft); text-transform: uppercase;">Egresados</div>
          <div style="font-size: 24px; font-weight: 800; color: var(--forest); margin-top: 4px;" id="verRep_total">0</div>
          <div style="font-size: 11px; color: var(--ink-soft);">Total muestra</div>
        </div>

        <div style="background: var(--green-soft); border: 1px solid rgba(57,169,0,0.25); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: var(--green-dark); text-transform: uppercase;">Vinculados</div>
          <div style="font-size: 24px; font-weight: 800; color: var(--green-dark); margin-top: 4px;" id="verRep_empleados">0</div>
          <div style="font-size: 11px; color: var(--green-dark);">En sector laboral</div>
        </div>

        <div style="background: #FEF7EA; border: 1px solid rgba(245,158,11,0.25); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: #9A3412; text-transform: uppercase;">Pendientes</div>
          <div style="font-size: 24px; font-weight: 800; color: #9A3412; margin-top: 4px;" id="verRep_pendientes">0</div>
          <div style="font-size: 11px; color: #9A3412;">En búsqueda activa</div>
        </div>

        <div style="background: #EBF3FF; border: 1px solid rgba(37,99,235,0.25); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: #1E40AF; text-transform: uppercase;">Inserción</div>
          <div style="font-size: 24px; font-weight: 800; color: #1E40AF; margin-top: 4px;" id="verRep_rate">0%</div>
          <div style="font-size: 11px; color: #1E40AF;">Tasa efectiva</div>
        </div>
      </div>

      <!-- Barra de progreso -->
      <div class="form-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
          <span style="font-weight: 700; font-size: 12.5px; color: var(--forest);">Porcentaje de Inserción Laboral Efectiva</span>
          <span id="verRep_rateLabel" style="font-weight: 800; font-size: 12px; color: var(--green-dark);">77%</span>
        </div>
        <div class="progress-bar" style="height: 10px;">
          <div id="verRep_progressFill" class="progress-fill" style="width: 77%;"></div>
        </div>
      </div>

      <!-- Parámetros del Reporte -->
      <div class="form-section">
        <div class="form-section-title">
          <i class="fa-solid fa-circle-info" style="color: var(--green);"></i>
          <span>Alcance y Parámetros del Informe</span>
        </div>
        <div class="form-row" style="margin-bottom: 12px;">
          <div>
            <span style="font-size: 11.5px; color: var(--ink-soft); display: block;">Ficha / Programa Incluido:</span>
            <strong style="font-size: 13px; color: var(--forest);" id="verRep_programa">ADSO / Multimedia</strong>
          </div>
          <div>
            <span style="font-size: 11.5px; color: var(--ink-soft); display: block;">Clasificación de Reporte:</span>
            <strong style="font-size: 13px; color: var(--forest);" id="verRep_tipo">Seguimiento Fichas</strong>
          </div>
        </div>
        <div class="form-row">
          <div>
            <span style="font-size: 11.5px; color: var(--ink-soft); display: block;">Formato de Salida:</span>
            <strong style="font-size: 13px; color: var(--forest);" id="verRep_formato">EXCEL / CSV</strong>
          </div>
          <div>
            <span style="font-size: 11.5px; color: var(--ink-soft); display: block;">Estado de los Datos:</span>
            <span style="display: inline-flex; align-items: center; gap: 4px; font-size: 12px; font-weight: 700; color: #065F46;">
              <i class="fa-solid fa-circle-check" style="color: var(--green);"></i> Auditado y Validado
            </span>
          </div>
        </div>
      </div>

      <!-- Nota Metodológica SENA -->
      <div style="background: #FAFCFB; border: 1px solid var(--line); border-radius: 12px; padding: 14px 16px; font-size: 12px; color: var(--ink-soft); line-height: 1.5;">
        <strong style="color: var(--forest); display: block; margin-bottom: 4px;"><i class="fa-solid fa-shield-halved" style="color: var(--green); margin-right: 4px;"></i> Cumplimiento Normativo SENA:</strong>
        Este informe contiene datos de contacto protegidos por la Ley de Protección de Datos Personales (Habeas Data) y está destinado exclusivamente al acompañamiento formativo y seguimiento de egresados de la sede CEFA La Angostura.
      </div>
    </div>

    <div class="modal-foot">
      <a href="#" id="verRep_btnDescargar" class="btn-submit" style="text-decoration: none;">
        <i class="fa-solid fa-download mr-1"></i> Descargar Datos (Excel / CSV)
      </a>
      <button type="button" class="btn-cancel" onclick="cerrarDetalleReporte()">
        <span>Cerrar Vista</span>
      </button>
    </div>
  </div>
</div>

</body>
</html>
