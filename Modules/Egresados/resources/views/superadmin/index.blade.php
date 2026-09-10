<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gestión de Egresados — CEFA La Angostura</title>

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

      /* ---------------- SIDEBAR INSTITUCIONAL ---------------- */
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
        font-size: 10px;
        font-weight: 700;
        background: rgba(255, 255, 255, 0.15);
        padding: 2px 7px;
        border-radius: 999px;
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

      /* ---------------- MAIN VIEWPORT ---------------- */
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
        position: sticky;
        top: 0;
        z-index: 20;
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
        font-size: 14px;
        color: var(--ink-soft);
        margin: 0;
      }

      .btn-primary-green {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--forest);
        color: #ffffff;
        border: none;
        padding: 9px 18px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(1, 56, 25, 0.15);
      }
      .btn-primary-green:hover {
        background: var(--green);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(57, 169, 0, 0.25);
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
        gap: 12px;
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
        justify-content: space-between;
      }
      .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
      }
      .stat-icon.amber { background: #FFF8E6; color: #D97706; }
      .stat-icon.green { background: var(--green-soft); color: var(--green); }
      .stat-icon.blue { background: #EEF4FF; color: #2563EB; }

      .stat-label {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--ink-soft);
      }
      .stat-num {
        font-family: 'Fraunces', serif;
        font-size: 30px;
        font-weight: 700;
        color: var(--forest-deep);
        line-height: 1;
        margin: 2px 0 6px;
      }
      .stat-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11.5px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
        width: fit-content;
      }
      .stat-pill.amber { background: #FEF3C7; color: #92400E; }
      .stat-pill.green { background: var(--green-soft); color: var(--green-dark); }
      .stat-pill.blue { background: #DBEAFE; color: #1E40AF; }

      /* ---------------- LOWER 2-COLUMN + 1-COLUMN GRID ---------------- */
      .main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        align-items: start;
      }

      .table-card {
        background: var(--card);
        border-radius: 16px;
        border: 1px solid var(--line);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        overflow: hidden;
      }

      .table-toolbar {
        padding: 18px 20px;
        border-bottom: 1px solid var(--line);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: #FAFCF9;
      }

      .search-box {
        position: relative;
        flex: 1;
        min-width: 220px;
      }
      .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--ink-soft);
        font-size: 13px;
      }
      .search-box input {
        width: 100%;
        padding: 9px 14px 9px 36px;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 13px;
        background: #ffffff;
        color: var(--ink);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: inherit;
      }
      .search-box input:focus {
        border-color: var(--green);
        box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.12);
      }

      .filter-select {
        padding: 9px 12px;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 600;
        background: #ffffff;
        color: var(--ink);
        outline: none;
        font-family: inherit;
      }

      .btn-filter {
        padding: 9px 16px;
        background: var(--forest);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s ease;
      }
      .btn-filter:hover {
        background: var(--green);
      }

      /* Table rows */
      .egresados-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13px;
      }
      .egresados-table th {
        background: #FAFCF9;
        color: var(--ink-soft);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
      }
      .egresados-table td {
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
        vertical-align: middle;
      }
      .egresados-table tr.egresado-row {
        cursor: pointer;
        transition: background-color 0.15s ease, border-left 0.15s ease;
      }
      .egresados-table tr.egresado-row:hover {
        background-color: #F4FAF5;
      }
      .egresados-table tr.egresado-row.selected-row {
        background-color: #EAF7EE;
        box-shadow: inset 4px 0 0 var(--green);
      }

      .avatar-cell {
        display: flex;
        align-items: center;
        gap: 12px;
      }
      .avatar-bubble {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: var(--green-soft);
        color: var(--forest);
        font-weight: 700;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid rgba(57, 169, 0, 0.25);
        flex-shrink: 0;
      }
      .name-main {
        font-weight: 700;
        color: var(--ink);
        line-height: 1.25;
      }
      .name-email {
        font-size: 11.5px;
        color: var(--ink-soft);
        margin-top: 2px;
      }

      /* Status Badges */
      .badge-pill {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.3px;
      }
      .badge-pill.status-green { background: #EAF7EE; color: #1E7E34; border: 1px solid rgba(40,167,69,0.25); }
      .badge-pill.status-blue { background: #EEF4FF; color: #1D4ED8; border: 1px solid rgba(29,78,216,0.25); }
      .badge-pill.status-amber { background: #FFF8E6; color: #B45309; border: 1px solid rgba(217,119,6,0.25); }
      .badge-pill.status-red { background: #FEE2E2; color: #B91C1C; border: 1px solid rgba(239,68,68,0.25); }

      /* Action Icon Buttons */
      .action-btns {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
      }
      .btn-circle-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        color: var(--ink-soft);
        border: 1px solid var(--line);
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none;
        font-size: 12px;
      }
      .btn-circle-action:hover {
        background: var(--green-soft);
        color: var(--forest);
        border-color: var(--green);
      }

      /* ---------------- RIGHT DETAIL PANEL (STICKY) ---------------- */
      .detail-card {
        background: var(--card);
        border-radius: 16px;
        border: 1px solid var(--line);
        padding: 22px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        position: sticky;
        top: 80px;
        display: flex;
        flex-direction: column;
        gap: 16px;
      }

      .detail-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--line);
      }
      .detail-head-title {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--ink-soft);
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .pulse-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--green);
      }

      .detail-user-hero {
        display: flex;
        align-items: center;
        gap: 14px;
      }
      .detail-avatar-large {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--forest) 0%, var(--green) 100%);
        color: #ffffff;
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(1, 56, 25, 0.15);
      }
      .detail-user-name {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 16px;
        color: var(--forest-deep);
        line-height: 1.25;
      }
      .detail-user-doc {
        font-size: 12px;
        color: var(--ink-soft);
        margin-top: 2px;
      }
      .detail-user-email {
        font-size: 12px;
        color: var(--green-dark);
        font-weight: 600;
        word-break: break-all;
      }

      .info-box {
        background: #F9FBF9;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 14px;
      }
      .info-box-label {
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--ink-soft);
        margin-bottom: 8px;
        display: block;
      }
      .info-row {
        display: flex;
        justify-content: space-between;
        font-size: 12.5px;
        margin-bottom: 6px;
      }
      .info-row:last-child {
        margin-bottom: 0;
      }
      .info-key {
        color: var(--ink-soft);
        font-weight: 500;
      }
      .info-val {
        color: var(--ink);
        font-weight: 700;
        text-align: right;
      }

      .btn-cta-detail {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--forest);
        color: #ffffff;
        border: none;
        padding: 11px 18px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(1, 56, 25, 0.15);
        text-align: center;
      }
      .btn-cta-detail:hover {
        background: var(--green);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(57, 169, 0, 0.25);
      }

      .btn-secondary-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: var(--green-soft);
        color: var(--forest);
        border: 1px solid rgba(57, 169, 0, 0.25);
        padding: 10px 18px;
        border-radius: 12px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .btn-secondary-action:hover {
        background: #d8f3de;
      }

      /* Pagination */
      .pagination-wrap {
        padding: 16px 20px;
        border-top: 1px solid var(--line);
        display: flex;
        justify-content: center;
      }

      @media (max-width: 1080px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .main-grid { grid-template-columns: 1fr; }
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

  <!-- ============================================== -->
  <!-- 1. SIDEBAR INSTITUCIONAL (IDÉNTICA AL INICIO) -->
  <!-- ============================================== -->
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
      <a href="{{ route('egresados.dashboard') }}">
        <i class="fa-solid fa-gauge-high"></i>
        <span>Inicio</span>
      </a>
      <a href="{{ route('egresados.index') }}" class="active">
        <i class="fa-solid fa-user-graduate"></i>
        <span>Egresados</span>
      </a>
      <a href="{{ route('egresados.instructores') }}">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Instructores</span>
      </a>
      <a href="{{ route('egresados.encuestas_superadmin') }}">
        <i class="fa-solid fa-clipboard-question"></i>
        <span>Encuestas</span>
        <span class="badge">78</span>
      </a>
      <a href="{{ route('egresados.reportes') }}">
        <i class="fa-solid fa-file-invoice"></i>
        <span>Reportes</span>
      </a>
      <a href="{{ route('egresados.eventos') }}">
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
        <a href="{{ route('login') }}" class="logout-btn">
          <i class="fa-solid fa-arrow-right-to-bracket"></i>
          <span>Iniciar sesión</span>
        </a>
      @endauth
    </div>
  </aside>

  <!-- ============================================== -->
  <!-- 2. MAIN VIEWPORT -->
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
        <div class="user-chip" title="Usuario activo">
          <div class="user-avatar">
            @auth
              {{ Auth::user()->initials }}
            @else
              SA
            @endauth
          </div>
          <span>
            @auth
              {{ Auth::user()->full_name }}
            @else
              Super Administrador SIGE
            @endauth
          </span>
          <i class="fa-solid fa-chevron-down text-[10px] text-white/60 ms-1"></i>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="content">

      <!-- Header de la Página -->
      <div class="page-head">
        <div>
          <h1 class="page-title">Gestión de <span>Egresados</span></h1>
          <p class="page-desc">Consulta, seguimiento y actualización de información de egresados institucionales del CEFA.</p>
        </div>

        <div style="display:flex; align-items:center; gap:12px;">
          <a href="{{ route('egresados.create') }}" class="btn-primary-green">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Nuevo Egresado</span>
          </a>
        </div>
      </div>

      <!-- Tarjetas de Estadísticas Superiores (Estilo Inicio) -->
      <div class="stats-grid">
        
        <!-- Stat 1: Actualización Pendiente -->
        <div class="stat-card">
          <div class="stat-top">
            <span class="stat-label">Actualización Pendiente</span>
            <div class="stat-icon amber">
              <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
          </div>
          <div class="stat-num">{{ number_format($actualizacionPendiente) }}</div>
          <span class="stat-pill amber">
            <i class="fa-solid fa-clock-rotate-left"></i> Desactualizada
          </span>
        </div>

        <!-- Stat 2: Seguimientos Realizados -->
        <div class="stat-card">
          <div class="stat-top">
            <span class="stat-label">Seguimientos Realizados</span>
            <div class="stat-icon green">
              <i class="fa-solid fa-magnifying-glass-chart"></i>
            </div>
          </div>
          <div class="stat-num">{{ number_format($seguimientosRealizados) }}</div>
          <span class="stat-pill green">
            <i class="fa-solid fa-calendar-check"></i> Este mes
          </span>
        </div>

        <!-- Stat 3: Total Registrados -->
        <div class="stat-card">
          <div class="stat-top">
            <span class="stat-label">Egresados Registrados</span>
            <div class="stat-icon blue">
              <i class="fa-solid fa-user-graduate"></i>
            </div>
          </div>
          <div class="stat-num">{{ number_format($totalEgresados) }}</div>
          <span class="stat-pill blue">
            <i class="fa-solid fa-users"></i> Base general
          </span>
        </div>

      </div>

      <!-- Grilla Principal: Tabla (2) + Panel de Detalle Rápido (1) -->
      <div class="main-grid">
        
        <!-- Columna Izquierda: Tabla -->
        <div class="table-card">
          
          <!-- Barra de Búsqueda y Filtros -->
          <form action="{{ route('egresados.index') }}" method="GET" class="table-toolbar">
            <div class="search-box">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por documento o nombre...">
            </div>

            <select name="apprentice_status" onchange="this.form.submit()" class="filter-select">
              <option value="">-- Todos los Estados --</option>
              <option value="CERTIFICADO" {{ request('apprentice_status') == 'CERTIFICADO' ? 'selected' : '' }}>Certificado</option>
              <option value="EN FORMACIÓN" {{ request('apprentice_status') == 'EN FORMACIÓN' ? 'selected' : '' }}>En Formación</option>
              <option value="INDUCCIÓN" {{ request('apprentice_status') == 'INDUCCIÓN' ? 'selected' : '' }}>Inducción</option>
              <option value="CONDICIONADO" {{ request('apprentice_status') == 'CONDICIONADO' ? 'selected' : '' }}>Condicionado</option>
              <option value="CANCELADO" {{ request('apprentice_status') == 'CANCELADO' ? 'selected' : '' }}>Cancelado</option>
              <option value="RETIRO VOLUNTARIO" {{ request('apprentice_status') == 'RETIRO VOLUNTARIO' ? 'selected' : '' }}>Retiro Voluntario</option>
            </select>

            <button type="submit" class="btn-filter">
              Filtrar
            </button>

            @if(request('search') || request('apprentice_status'))
              <a href="{{ route('egresados.index') }}" style="color:var(--ink-soft); text-decoration:none; font-size:12px; font-weight:600; padding:8px;" title="Limpiar">
                <i class="fa-solid fa-xmark"></i>
              </a>
            @endif
          </form>

          <!-- Contenido de Tabla -->
          <div style="overflow-x: auto;">
            <table class="egresados-table">
              <thead>
                <tr>
                  <th>Documento</th>
                  <th>Egresado(a)</th>
                  <th>Programa & Ficha</th>
                  <th>Estado</th>
                  <th style="text-align:center;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse($egresados as $index => $item)
                  @php
                    $person = $item->person;
                    $course = $item->course;
                    $program = $course ? $course->program : null;
                    $fullName = $person ? ($person->first_name . ' ' . $person->first_last_name . ' ' . ($person->second_last_name ?? '')) : 'Aprendiz #' . $item->id;
                    
                    // Iniciales
                    $words = explode(' ', trim($fullName));
                    $initials = '';
                    foreach(array_slice($words, 0, 2) as $w) {
                        if (!empty($w)) $initials .= mb_strtoupper(mb_substr($w, 0, 1));
                    }

                    // Clases de píldora
                    $st = $item->apprentice_status ?? 'CERTIFICADO';
                    $pillClass = 'status-green';
                    if(in_array($st, ['EN FORMACIÓN', 'INDUCCIÓN'])) $pillClass = 'status-blue';
                    elseif(in_array($st, ['CANCELADO', 'RETIRO VOLUNTARIO'])) $pillClass = 'status-red';
                    elseif($st === 'CONDICIONADO') $pillClass = 'status-amber';

                    // Serializar datos para JavaScript
                    $jsonData = json_encode([
                        'id' => $item->id,
                        'name' => $fullName,
                        'initials' => $initials ?: 'EG',
                        'document' => $person->document_number ?? 'N/A',
                        'document_type' => $person->document_type ?? 'Cédula de ciudadanía',
                        'email' => $person->misena_email ?? $person->personal_email ?? 'No registra correo',
                        'phone' => $person->telephone1 ?? $person->telephone2 ?? 'No registra teléfono',
                        'program' => $program->name ?? 'Programa de Formación CEFA',
                        'code' => $course->code ?? 'N/A',
                        'status' => $st,
                        'pill_class' => $pillClass,
                        'show_url' => route('egresados.show', $item->id),
                    ]);
                  @endphp
                  <tr class="egresado-row {{ $index === 0 ? 'selected-row' : '' }}" 
                      id="row-{{ $item->id }}"
                      onclick="selectEgresado({{ $jsonData }}, 'row-{{ $item->id }}')">
                    
                    <td style="font-weight:700; color:var(--forest-deep);">
                      {{ $person->document_number ?? 'N/A' }}
                    </td>

                    <td>
                      <div class="avatar-cell">
                        <div class="avatar-bubble">{{ $initials ?: 'EG' }}</div>
                        <div>
                          <div class="name-main">{{ $fullName }}</div>
                          <div class="name-email">{{ $person->misena_email ?? $person->personal_email ?? 'Sin correo' }}</div>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div style="font-weight:600; color:var(--ink);">{{ $program ? Str::limit($program->name, 26) : 'ADSO' }}</div>
                      <div style="font-size:11px; color:var(--ink-soft); font-weight:600;">Ficha: {{ $course->code ?? 'N/A' }}</div>
                    </td>

                    <td>
                      <span class="badge-pill {{ $pillClass }}">{{ $st }}</span>
                    </td>

                    <td style="text-align:center;">
                      <div class="action-btns" onclick="event.stopPropagation();">
                        <button type="button" 
                            onclick="selectEgresado({{ $jsonData }}, 'row-{{ $item->id }}')" 
                            class="btn-circle-action" 
                            title="Ver en Panel de Detalle">
                          <i class="fa-solid fa-eye"></i>
                        </button>
                        <a href="{{ route('egresados.show', $item->id) }}" 
                            class="btn-circle-action" 
                            title="Ver Ficha Completa">
                          <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                      </div>
                    </td>

                  </tr>
                @empty
                  <tr>
                    <td colspan="5" style="text-align:center; padding:40px 20px; color:var(--ink-soft);">
                      <i class="fa-solid fa-user-slash" style="font-size:32px; color:#cbd5e1; margin-bottom:10px; display:block;"></i>
                      <div style="font-weight:700; font-size:15px; color:var(--ink);">No se encontraron egresados</div>
                      <p style="font-size:12px; margin-top:4px;">Prueba cambiando los términos de búsqueda o filtros.</p>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Paginación -->
          @if($egresados->hasPages())
            <div class="pagination-wrap">
              {{ $egresados->withQueryString()->links() }}
            </div>
          @endif

        </div>

        <!-- Columna Derecha: Panel de Detalle Rápido (Sticky) -->
        <div class="detail-card">
          
          <div class="detail-head">
            <span class="detail-head-title">
              <span class="pulse-dot"></span>
              Detalle del Egresado
            </span>
            <span id="detailStatusPill" class="badge-pill status-green">CERTIFICADO</span>
          </div>

          <!-- Hero del Usuario Seleccionado -->
          <div class="detail-user-hero">
            <div id="detailAvatarLarge" class="detail-avatar-large">EG</div>
            <div style="overflow:hidden;">
              <div id="detailName" class="detail-user-name">Selecciona un egresado</div>
              <div id="detailDoc" class="detail-user-doc">Doc: ---</div>
              <div id="detailEmail" class="detail-user-email">correo@sena.edu.co</div>
            </div>
          </div>

          <!-- Bloque Académico -->
          <div class="info-box">
            <span class="info-box-label">Información Académica</span>
            <div class="info-row">
              <span class="info-key">Programa:</span>
              <span id="detailProgram" class="info-val">ADSO</span>
            </div>
            <div class="info-row">
              <span class="info-key">Código Ficha:</span>
              <span id="detailCode" class="info-val">3345643</span>
            </div>
            <div class="info-row">
              <span class="info-key">Centro Formación:</span>
              <span class="info-val">CEFA La Angostura</span>
            </div>
          </div>

          <!-- Bloque Laboral & Contacto -->
          <div class="info-box">
            <span class="info-box-label">Información de Contacto</span>
            <div class="info-row">
              <span class="info-key">Teléfono:</span>
              <span id="detailPhone" class="info-val">300 000 0000</span>
            </div>
            <div class="info-row">
              <span class="info-key">Tipo Documento:</span>
              <span id="detailDocType" class="info-val">Cédula</span>
            </div>
            <div class="info-row">
              <span class="info-key">Estado Ocupacional:</span>
              <span id="detailStatusText" class="info-val" style="color:var(--green-dark);">CERTIFICADO</span>
            </div>
          </div>

          <!-- Botones de Acción -->
          <a id="detailFullBtn" href="#" class="btn-cta-detail">
            <span>Ver Perfil Completo</span>
            <i class="fa-solid fa-arrow-right text-xs"></i>
          </a>

          <button type="button" onclick="alert('Iniciando registro de seguimiento para ' + document.getElementById('detailName').innerText);" class="btn-secondary-action">
            <i class="fa-solid fa-notes-medical"></i>
            <span>Registrar Seguimiento</span>
          </button>

        </div>

      </div>

    </div>
  </div>

</div>

<script>
    // Función interactiva para actualizar el panel de detalles reactivo
    function selectEgresado(data, rowId) {
        if (!data) return;

        // Actualizar fila activa
        document.querySelectorAll('.egresado-row').forEach(row => {
            row.classList.remove('selected-row');
        });
        const activeRow = document.getElementById(rowId);
        if (activeRow) activeRow.classList.add('selected-row');

        // Actualizar datos del panel derecho
        document.getElementById('detailAvatarLarge').innerText = data.initials || 'EG';
        document.getElementById('detailName').innerText = data.name || 'Sin nombre';
        document.getElementById('detailDoc').innerText = 'Doc: ' + (data.document || 'N/A');
        document.getElementById('detailEmail').innerText = data.email || 'Sin correo';
        
        document.getElementById('detailProgram').innerText = data.program || 'Sin programa';
        document.getElementById('detailCode').innerText = data.code || 'N/A';
        
        document.getElementById('detailPhone').innerText = data.phone || 'Sin teléfono';
        document.getElementById('detailDocType').innerText = data.document_type || 'Cédula';
        document.getElementById('detailStatusText').innerText = data.status || 'N/A';
        
        const pill = document.getElementById('detailStatusPill');
        if (pill) {
            pill.innerText = data.status || 'ESTADO';
            pill.className = 'badge-pill ' + (data.pill_class || 'status-green');
        }

        const btn = document.getElementById('detailFullBtn');
        if (btn && data.show_url) {
            btn.href = data.show_url;
        }
    }

    // Seleccionar automáticamente el primer egresado al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.egresado-row');
        if (firstRow) {
            firstRow.click();
        }
    });
</script>

</body>
</html>
