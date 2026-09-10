<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gestión de Eventos — CEFA La Angostura</title>

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
        margin-bottom: 24px;
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
        cursor: pointer;
      }
      .btn-primary-green:hover {
        background: var(--green);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(57, 169, 0, 0.25);
      }

      /* ---------------- 5 MÉTRICAS SUPERIORES ---------------- */
      .metrics-5-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 28px;
      }
      .metric-mini-card {
        background: var(--card);
        border-radius: 16px;
        padding: 16px 18px;
        border: 1px solid var(--line);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
      }
      .metric-mini-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(1, 56, 25, 0.06);
        border-color: rgba(57, 169, 0, 0.35);
      }
      .metric-mini-label {
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--ink-soft);
      }
      .metric-mini-num {
        font-family: 'Fraunces', serif;
        font-size: 24px;
        font-weight: 700;
        color: var(--forest-deep);
        line-height: 1.1;
        margin: 4px 0;
      }
      .metric-mini-num.highlight {
        color: var(--forest);
      }
      .metric-mini-pill {
        font-size: 10.5px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 999px;
        width: fit-content;
      }
      .metric-mini-pill.green { background: var(--green-soft); color: var(--green-dark); }
      .metric-mini-pill.blue { background: #EEF4FF; color: #1D4ED8; }
      .metric-mini-pill.amber { background: #FFF8E6; color: #B45309; }

      /* ---------------- MAIN 2-COLUMN + 1-COLUMN GRID ---------------- */
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
        padding: 16px 20px;
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
        min-width: 240px;
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
        padding: 9px 14px;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 12.5px;
        background: #ffffff;
        color: var(--ink);
        outline: none;
        font-weight: 500;
        cursor: pointer;
      }
      .filter-select:focus {
        border-color: var(--green);
      }

      /* Eventos Table */
      .eventos-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13px;
      }
      .eventos-table th {
        background: #FAFCF9;
        color: var(--ink-soft);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
      }
      .eventos-table td {
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
        vertical-align: middle;
      }
      .eventos-table tr.event-row {
        cursor: pointer;
        transition: background-color 0.15s ease;
      }
      .eventos-table tr.event-row:hover {
        background-color: #F4FAF5;
      }
      .eventos-table tr.event-row.selected-row {
        background-color: #EAF7EE;
        box-shadow: inset 4px 0 0 var(--green);
      }

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
      .badge-pill.status-amber { background: #FFF8E6; color: #B45309; border: 1px solid rgba(217,164,65,0.3); }

      .table-progress-wrap {
        display: flex;
        flex-direction: column;
        gap: 4px;
        min-width: 110px;
      }
      .table-progress-text {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--ink);
      }
      .table-progress-bar {
        width: 100%;
        height: 6px;
        background: #E2E8F0;
        border-radius: 999px;
        overflow: hidden;
      }
      .table-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--forest) 0%, var(--green) 100%);
        border-radius: 999px;
      }

      .btn-circle-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
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

      /* ---------------- RIGHT STICKY DETAIL PANEL ---------------- */
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

      .detail-event-hero {
        display: flex;
        flex-direction: column;
        gap: 4px;
      }
      .detail-event-title {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 17px;
        color: var(--forest-deep);
        line-height: 1.25;
      }
      .detail-event-meta {
        font-size: 12px;
        color: var(--ink-soft);
      }
      .detail-event-attr {
        font-size: 12.5px;
        color: var(--ink);
        margin-top: 2px;
      }

      .description-box {
        background: #F9FBF9;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 12px;
        color: var(--ink);
        line-height: 1.55;
      }
      .description-title {
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--ink-soft);
        margin-bottom: 4px;
        display: block;
      }

      .stats-panel-box {
        background: #F9FBF9;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 14px;
        display: flex;
        flex-direction: column;
        gap: 8px;
      }
      .stats-box-title {
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--ink-soft);
        margin-bottom: 2px;
      }
      .stats-row {
        display: flex;
        justify-content: space-between;
        font-size: 12.5px;
      }
      .stats-key {
        color: var(--ink-soft);
        font-weight: 500;
      }
      .stats-val {
        color: var(--ink);
        font-weight: 700;
      }
      .stats-val.green {
        color: var(--forest);
      }

      .stats-progress-track {
        width: 100%;
        height: 8px;
        background: #E2E8F0;
        border-radius: 999px;
        overflow: hidden;
        margin-top: 6px;
      }
      .stats-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--forest) 0%, var(--green) 100%);
        border-radius: 999px;
        transition: width 0.4s ease-in-out;
      }

      .detail-actions-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding-top: 4px;
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
        font-size: 12.5px;
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
        gap: 8px;
        background: #ffffff;
        color: var(--ink);
        border: 1px solid var(--line);
        padding: 10px 18px;
        border-radius: 12px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
      }
      .btn-secondary-action:hover {
        background: var(--green-soft);
        color: var(--forest);
        border-color: var(--green);
      }

      .btn-danger-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #FEF2F2;
        color: #DC2626;
        border: 1px solid rgba(220, 38, 38, 0.2);
        padding: 10px 18px;
        border-radius: 12px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .btn-danger-action:hover {
        background: #FEE2E2;
        color: #B91C1C;
      }

      @media (max-width: 1080px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .metrics-5-grid { grid-template-columns: repeat(2, 1fr); }
        .main-grid { grid-template-columns: 1fr; }
      }
      @media (max-width: 640px) {
        .metrics-5-grid { grid-template-columns: 1fr; }
        .content { padding: 24px 18px 36px; }
        .topbar { padding: 12px 18px; }
      }
    </style>
</head>
<body>

<div class="app">

  <!-- ============================================== -->
  <!-- 1. SIDEBAR INSTITUCIONAL (ESTILO INICIO) -->
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
      <a href="{{ route('egresados.index') }}">
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
      </a>
      <a href="{{ route('egresados.reportes') }}">
        <i class="fa-solid fa-file-invoice"></i>
        <span>Reportes</span>
      </a>
      <a href="{{ route('egresados.eventos') }}" class="active">
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
          <h1 class="page-title">Gestión de <span>Eventos</span></h1>
          <p class="page-desc">Gestión, seguimiento y control de eventos para egresados del CEFA.</p>
        </div>

        <div style="display:flex; align-items:center; gap:12px;">
          <button type="button" onclick="alert('Formulario de creación de nuevo evento institucional.');" class="btn-primary-green">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Crear Evento</span>
          </button>
        </div>
      </div>

      <!-- ============================================== -->
      <!-- MÉTRICAS SUPERIORES (GRID DE 5) -->
      <!-- ============================================== -->
      <div class="metrics-5-grid">
        
        <!-- Metric 1: Programados -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Programados</span>
          <div class="metric-mini-num">{{ $totalProgramados ?? 12 }}</div>
          <span class="metric-mini-pill green">Este año</span>
        </div>

        <!-- Metric 2: Participantes -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Participantes</span>
          <div class="metric-mini-num">{{ $totalParticipantes ?? 856 }}</div>
          <span class="metric-mini-pill blue">Registrados</span>
        </div>

        <!-- Metric 3: Realizados -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Realizados</span>
          <div class="metric-mini-num">{{ $totalRealizados ?? 8 }}</div>
          <span class="metric-mini-pill green">Este año</span>
        </div>

        <!-- Metric 4: Próximos -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Próximos</span>
          <div class="metric-mini-num">{{ $totalProximos ?? 4 }}</div>
          <span class="metric-mini-pill amber">Próximos 30 días</span>
        </div>

        <!-- Metric 5: Satisfacción -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Satisfacción</span>
          <div class="metric-mini-num highlight">{{ $promedioSatisfaccion ?? '4.6/5' }}</div>
          <span class="metric-mini-pill green">Promedio</span>
        </div>

      </div>

      <!-- ============================================== -->
      <!-- GRILLA PRINCIPAL: TABLA (2/3) + PANEL DE DETALLE (1/3) -->
      <!-- ============================================== -->
      <div class="main-grid">
        
        <!-- Columna Izquierda: Tabla de Eventos -->
        <div class="table-card">
          
          <!-- Toolbar -->
          <div class="table-toolbar">
            <div class="search-box">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input type="text" id="eventSearchInput" onkeyup="filterEventsTable()" placeholder="Buscar evento por ID, nombre o tipo...">
            </div>

            <select id="eventStatusFilter" onchange="filterEventsTable()" class="filter-select">
              <option value="">-- Todos los Estados --</option>
              <option value="PROGRAMADO">Programados</option>
              <option value="REALIZADO">Realizados</option>
              <option value="EN CURSO">En Curso</option>
              <option value="CANCELADO">Cancelados</option>
            </select>
          </div>

          <!-- Tabla -->
          <div style="overflow-x: auto;">
            <table class="eventos-table" id="eventosTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Evento</th>
                  <th>Tipo</th>
                  <th>Fecha</th>
                  <th>Estado</th>
                  <th>Registro</th>
                  <th style="text-align:center;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $eventosList = $eventos ?? [
                    [
                      'id' => 'EVT-012',
                      'title' => 'Feria laboral 2026',
                      'type' => 'Feria laboral',
                      'date' => '20/06/2026',
                      'time' => '09:00 AM - 04:00 PM',
                      'location' => 'Auditorio Principal',
                      'program' => 'ADSO-GAE',
                      'responsible' => 'Coordinación Académica',
                      'status' => 'PROGRAMADO',
                      'status_pill' => 'status-blue',
                      'description' => 'Feria laboral dirigida a Egresados para conectar con empresas aliadas y conocer oportunidades de empleo y prácticas profesionales.',
                      'cupo' => 200,
                      'registrados' => 156,
                      'pendientes' => 12,
                      'rate' => '78%',
                      'rate_num' => 78
                    ],
                    [
                      'id' => 'EVT-011',
                      'title' => 'Taller Hoja de Vida & LinkedIn',
                      'type' => 'Taller práctico',
                      'date' => '15/06/2026',
                      'time' => '02:00 PM - 06:00 PM',
                      'location' => 'Sala TIC 3',
                      'program' => 'Todos los programas',
                      'responsible' => 'Agencia Pública de Empleo (APE)',
                      'status' => 'PROGRAMADO',
                      'status_pill' => 'status-blue',
                      'description' => 'Taller intensivo sobre optimización de CV, perfil profesional en LinkedIn y preparación para entrevistas de trabajo en sector TIC y agropecuario.',
                      'cupo' => 50,
                      'registrados' => 45,
                      'pendientes' => 5,
                      'rate' => '90%',
                      'rate_num' => 90
                    ],
                    [
                      'id' => 'EVT-010',
                      'title' => 'Encuentro Egresados Agropecuarios',
                      'type' => 'Encuentro institucional',
                      'date' => '28/05/2026',
                      'time' => '08:30 AM - 01:00 PM',
                      'location' => 'Plaza Central CEFA',
                      'program' => 'Gestión Agroempresarial',
                      'responsible' => 'Coordinación Agropecuaria',
                      'status' => 'REALIZADO',
                      'status_pill' => 'status-green',
                      'description' => 'Espacio de integración y relacionamiento para egresados del área agropecuaria con socialización de proyectos de Fondo Emprender.',
                      'cupo' => 180,
                      'registrados' => 180,
                      'pendientes' => 0,
                      'rate' => '100%',
                      'rate_num' => 100
                    ],
                    [
                      'id' => 'EVT-009',
                      'title' => 'Hackathon TIC & Desarrollo Software',
                      'type' => 'Concurso / Reto',
                      'date' => '10/05/2026',
                      'time' => '08:00 AM - 08:00 PM',
                      'location' => 'Laboratorio TIC 1 & 2',
                      'program' => 'ADSO',
                      'responsible' => 'Instructores TIC',
                      'status' => 'REALIZADO',
                      'status_pill' => 'status-green',
                      'description' => 'Maratón de desarrollo de soluciones tecnológicas aplicadas al campo con premiación para los mejores prototipos funcionales.',
                      'cupo' => 100,
                      'registrados' => 85,
                      'pendientes' => 0,
                      'rate' => '85%',
                      'rate_num' => 85
                    ],
                    [
                      'id' => 'EVT-008',
                      'title' => 'Conferencia: Innovación y Sostenibilidad',
                      'type' => 'Conferencia',
                      'date' => '22/04/2026',
                      'time' => '10:00 AM - 12:30 PM',
                      'location' => 'Aula Magna CEFA',
                      'program' => 'Producción Agrícola',
                      'responsible' => 'Líder de Sennova',
                      'status' => 'REALIZADO',
                      'status_pill' => 'status-green',
                      'description' => 'Conferencia internacional sobre tecnologías de agricultura de precisión y sostenibilidad ambiental en la región del Huila.',
                      'cupo' => 150,
                      'registrados' => 120,
                      'pendientes' => 0,
                      'rate' => '80%',
                      'rate_num' => 80
                    ],
                  ];
                @endphp

                @foreach($eventosList as $index => $item)
                  @php
                    $jsonData = json_encode($item);
                  @endphp
                  <tr class="event-row {{ $index === 0 ? 'selected-row' : '' }}" 
                      id="evt-row-{{ $item['id'] }}"
                      data-id="{{ $item['id'] }}"
                      data-title="{{ $item['title'] }}"
                      data-type="{{ $item['type'] }}"
                      data-status="{{ $item['status'] }}"
                      onclick="selectEvento({{ $jsonData }}, 'evt-row-{{ $item['id'] }}')">
                    
                    <td style="font-weight:700; color:var(--forest-deep);">
                      {{ $item['id'] }}
                    </td>

                    <td>
                      <div style="font-weight:700; color:var(--ink);">{{ $item['title'] }}</div>
                      <div style="font-size:11.5px; color:var(--ink-soft);"><i class="fa-solid fa-location-dot text-[10px] me-1"></i>{{ $item['location'] }}</div>
                    </td>

                    <td style="font-size:12.5px; color:var(--ink-soft); font-weight:500;">
                      {{ $item['type'] }}
                    </td>

                    <td style="font-size:12.5px; color:var(--ink-soft);">
                      {{ $item['date'] }}
                    </td>

                    <td>
                      <span class="badge-pill {{ $item['status_pill'] }}">{{ $item['status'] }}</span>
                    </td>

                    <td>
                      <div class="table-progress-wrap">
                        <span class="table-progress-text">{{ $item['registrados'] }} / {{ $item['cupo'] }} ({{ $item['rate'] }})</span>
                        <div class="table-progress-bar">
                          <div class="table-progress-fill" style="width: {{ $item['rate_num'] }}%;"></div>
                        </div>
                      </div>
                    </td>

                    <td style="text-align:center;">
                      <div style="display:flex; align-items:center; justify-content:center; gap:6px;" onclick="event.stopPropagation();">
                        <button type="button" 
                            onclick="selectEvento({{ $jsonData }}, 'evt-row-{{ $item['id'] }}')" 
                            class="btn-circle-action" 
                            title="Ver en Panel">
                          <i class="fa-solid fa-eye"></i>
                        </button>
                        <button type="button" 
                            onclick="alert('Editar evento: {{ $item['title'] }}');" 
                            class="btn-circle-action" 
                            title="Editar">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                      </div>
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>

        <!-- Columna Derecha: Panel Lateral de Detalle del Evento (Sticky) -->
        <div class="detail-card">
          
          <div class="detail-head">
            <span class="detail-head-title">
              <span class="pulse-dot"></span>
              Detalle del evento
            </span>
            <span id="detailStatusBadge" class="badge-pill status-blue">PROGRAMADO</span>
          </div>

          <!-- Hero del Evento -->
          <div class="detail-event-hero">
            <div id="detailEventTitle" class="detail-event-title">Feria laboral 2026</div>
            <div id="detailEventMeta" class="detail-event-meta">ID: EVT-012 | Tipo: Feria laboral</div>
            <div class="detail-event-attr"><strong>Fecha:</strong> <span id="detailEventDateTime">20/06/2026 | 09:00 AM - 04:00 PM</span></div>
            <div class="detail-event-attr"><strong>Lugar:</strong> <span id="detailEventLocation">Auditorio Principal</span></div>
            <div class="detail-event-attr"><strong>Programa:</strong> <span id="detailEventProgram">ADSO-GAE</span></div>
            <div class="detail-event-attr" style="font-size:12px; color:var(--ink-soft);"><strong>Responsable:</strong> <span id="detailEventResp">Coordinación Académica</span></div>
          </div>

          <!-- Descripción -->
          <div class="description-box">
            <span class="description-title">Descripción</span>
            <p id="detailEventDesc" style="margin:0;">Feria laboral dirigida a Egresados para conectar con empresas aliadas y conocer oportunidades de empleo y prácticas profesionales.</p>
          </div>

          <!-- Estadísticas de Asistencia -->
          <div class="stats-panel-box">
            <span class="stats-box-title">Estadísticas</span>
            
            <div class="stats-row">
              <span class="stats-key">Cupo total:</span>
              <span id="detailCupo" class="stats-val">200</span>
            </div>
            <div class="stats-row">
              <span class="stats-key">Registros Confirmados:</span>
              <span id="detailRegistrados" class="stats-val">156</span>
            </div>
            <div class="stats-row">
              <span class="stats-key">Pendientes confirmación:</span>
              <span id="detailPendientes" class="stats-val">12</span>
            </div>
            <div class="stats-row">
              <span class="stats-key">Tasa confirmación:</span>
              <span id="detailRate" class="stats-val green">78%</span>
            </div>

            <!-- Barra de Progreso -->
            <div class="stats-progress-track">
              <div id="detailProgressBar" class="stats-progress-fill" style="width: 78%;"></div>
            </div>
          </div>

          <!-- Botones de Acción -->
          <div class="detail-actions-group">
            <button type="button" onclick="alert('Visualizando detalle completo de ' + document.getElementById('detailEventTitle').innerText);" class="btn-cta-detail">
              <i class="fa-solid fa-eye text-xs"></i>
              <span>Ver Detalle Completo</span>
            </button>

            <button type="button" onclick="alert('Abriendo edición de ' + document.getElementById('detailEventTitle').innerText);" class="btn-secondary-action">
              <i class="fa-solid fa-pen-to-square text-xs"></i>
              <span>Editar Evento</span>
            </button>

            <button type="button" onclick="alert('Enviando convocatoria por correo a los egresados para ' + document.getElementById('detailEventTitle').innerText);" class="btn-secondary-action">
              <i class="fa-solid fa-envelope text-xs"></i>
              <span>Enviar Invitación</span>
            </button>

            <button type="button" onclick="alert('Exportando listado de participantes inscritos (.xlsx)');" class="btn-secondary-action">
              <i class="fa-solid fa-file-excel text-xs"></i>
              <span>Exportar listado (Excel)</span>
            </button>

            <button type="button" onclick="if(confirm('¿Estás seguro de cancelar este evento institucional?')) alert('Evento cancelado exitosamente.');" class="btn-danger-action">
              <i class="fa-solid fa-trash-can text-xs"></i>
              <span>Cancelar Evento</span>
            </button>
          </div>

        </div>

      </div>

    </div>
  </div>

</div>

<script>
    // Función interactiva para actualizar el panel de detalles reactivo
    function selectEvento(data, rowId) {
        if (!data) return;

        // Actualizar fila activa
        document.querySelectorAll('.event-row').forEach(row => {
            row.classList.remove('selected-row');
        });
        const activeRow = document.getElementById(rowId);
        if (activeRow) activeRow.classList.add('selected-row');

        // Actualizar datos del panel lateral
        document.getElementById('detailEventTitle').innerText = data.title || 'Evento Institucional';
        document.getElementById('detailEventMeta').innerText = 'ID: ' + (data.id || 'EVT-000') + ' | Tipo: ' + (data.type || 'Evento');
        document.getElementById('detailEventDateTime').innerText = (data.date || 'N/A') + ' | ' + (data.time || '08:00 AM - 05:00 PM');
        document.getElementById('detailEventLocation').innerText = data.location || 'Centro de Formación CEFA';
        document.getElementById('detailEventProgram').innerText = data.program || 'General';
        document.getElementById('detailEventResp').innerText = data.responsible || 'Coordinación Académica';
        document.getElementById('detailEventDesc').innerText = data.description || 'Sin descripción detallada.';

        document.getElementById('detailCupo').innerText = data.cupo || 0;
        document.getElementById('detailRegistrados').innerText = data.registrados || 0;
        document.getElementById('detailPendientes').innerText = data.pendientes || 0;
        document.getElementById('detailRate').innerText = data.rate || '0%';

        const progressBar = document.getElementById('detailProgressBar');
        if (progressBar) {
            progressBar.style.width = (data.rate_num || parseInt(data.rate) || 0) + '%';
        }

        const badge = document.getElementById('detailStatusBadge');
        if (badge) {
            badge.innerText = data.status || 'PROGRAMADO';
            badge.className = 'badge-pill ' + (data.status_pill || 'status-blue');
        }
    }

    // Filtrado interactivo en tabla
    function filterEventsTable() {
        const query = document.getElementById('eventSearchInput').value.toLowerCase();
        const statusFilter = document.getElementById('eventStatusFilter').value;
        const rows = document.querySelectorAll('#eventosTable tbody tr');

        rows.forEach(row => {
            const id = (row.getAttribute('data-id') || '').toLowerCase();
            const title = (row.getAttribute('data-title') || '').toLowerCase();
            const type = (row.getAttribute('data-type') || '').toLowerCase();
            const status = row.getAttribute('data-status');

            const matchesQuery = id.includes(query) || title.includes(query) || type.includes(query);
            const matchesStatus = !statusFilter || status === statusFilter;

            if (matchesQuery && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Inicializar seleccionando el primer evento disponible al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.event-row');
        if (firstRow) {
            firstRow.click();
        }
    });
</script>

</body>
</html>
