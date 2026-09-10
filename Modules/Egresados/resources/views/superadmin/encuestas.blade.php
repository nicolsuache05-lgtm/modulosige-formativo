<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gestión de Encuestas — CEFA La Angostura</title>

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

      /* Encuestas Table */
      .encuestas-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13px;
      }
      .encuestas-table th {
        background: #FAFCF9;
        color: var(--ink-soft);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
      }
      .encuestas-table td {
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
        vertical-align: middle;
      }
      .encuestas-table tr.encuesta-row {
        cursor: pointer;
        transition: background-color 0.15s ease;
      }
      .encuestas-table tr.encuesta-row:hover {
        background-color: #F4FAF5;
      }
      .encuestas-table tr.encuesta-row.selected-row {
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
      .badge-pill.status-amber { background: #FFF8E6; color: #B45309; border: 1px solid rgba(217,164,65,0.3); }
      .badge-pill.status-gray { background: #F1F5F9; color: #64748B; border: 1px solid #CBD5E1; }

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

      .detail-survey-hero {
        display: flex;
        flex-direction: column;
        gap: 4px;
      }
      .detail-survey-title {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 17px;
        color: var(--forest-deep);
        line-height: 1.25;
      }
      .detail-survey-meta {
        font-size: 12px;
        color: var(--ink-soft);
      }
      .detail-survey-status {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 4px;
        font-size: 12px;
        font-weight: 700;
        color: var(--green-dark);
      }
      .detail-survey-target {
        font-size: 12.5px;
        color: var(--ink);
        margin-top: 2px;
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
      <a href="{{ route('egresados.encuestas_superadmin') }}" class="active">
        <i class="fa-solid fa-clipboard-question"></i>
        <span>Encuestas</span>
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
          <h1 class="page-title">Gestión de <span>Encuestas</span></h1>
          <p class="page-desc">Creación, seguimiento y análisis de encuestas institucionales del CEFA.</p>
        </div>

        <div style="display:flex; align-items:center; gap:12px;">
          <button type="button" onclick="alert('Formulario de creación de nueva encuesta institucional.');" class="btn-primary-green">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Crear Encuesta</span>
          </button>
        </div>
      </div>

      <!-- ============================================== -->
      <!-- MÉTRICAS SUPERIORES (GRID DE 5) -->
      <!-- ============================================== -->
      <div class="metrics-5-grid">
        
        <!-- Metric 1: Creadas -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Creadas</span>
          <div class="metric-mini-num">{{ $totalCreadas ?? 25 }}</div>
          <span class="metric-mini-pill green">Total histórico</span>
        </div>

        <!-- Metric 2: Enviadas -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Enviadas</span>
          <div class="metric-mini-num">{{ $totalEnviadas ?? 320 }}</div>
          <span class="metric-mini-pill blue">Este mes</span>
        </div>

        <!-- Metric 3: Pendientes -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Pendientes</span>
          <div class="metric-mini-num">{{ $totalPendientes ?? 78 }}</div>
          <span class="metric-mini-pill amber">Por responder</span>
        </div>

        <!-- Metric 4: Respondidas -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Respondidas</span>
          <div class="metric-mini-num">{{ $totalRespondidas ?? 242 }}</div>
          <span class="metric-mini-pill green">Este mes</span>
        </div>

        <!-- Metric 5: Tasa de Respuesta -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Tasa de Respuesta</span>
          <div class="metric-mini-num highlight">{{ $tasaRespuestaGeneral ?? '75%' }}</div>
          <span class="metric-mini-pill green">Promedio general</span>
        </div>

      </div>

      <!-- ============================================== -->
      <!-- GRILLA PRINCIPAL: TABLA (2/3) + PANEL DE DETALLE (1/3) -->
      <!-- ============================================== -->
      <div class="main-grid">
        
        <!-- Columna Izquierda: Tabla de Encuestas -->
        <div class="table-card">
          
          <!-- Toolbar -->
          <div class="table-toolbar">
            <div class="search-box">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input type="text" id="surveySearchInput" onkeyup="filterSurveysTable()" placeholder="Buscar encuesta por ID o nombre...">
            </div>

            <select id="surveyStatusFilter" onchange="filterSurveysTable()" class="filter-select">
              <option value="">-- Todos los Estados --</option>
              <option value="ACTIVA">Activas</option>
              <option value="CERRADA">Cerradas</option>
              <option value="BORRADOR">Borrador</option>
            </select>
          </div>

          <!-- Tabla -->
          <div style="overflow-x: auto;">
            <table class="encuestas-table" id="encuestasTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre Encuesta</th>
                  <th>Estado</th>
                  <th>Dirigido a</th>
                  <th>Progreso</th>
                  <th style="text-align:center;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $encuestasList = $encuestas ?? [
                    [
                      'id' => 'ENC-025',
                      'title' => 'Inserción Laboral ADSO',
                      'full_title' => 'Encuesta Inserción Laboral',
                      'date' => '12/06/2026',
                      'status' => 'ACTIVA',
                      'status_pill' => 'status-green',
                      'target' => 'Egresado ADSO',
                      'enviadas' => 120,
                      'respondidas' => 90,
                      'pendientes' => 30,
                      'rate' => '75%',
                      'rate_num' => 75
                    ],
                    [
                      'id' => 'ENC-024',
                      'title' => 'Impacto y Empleabilidad 2025',
                      'full_title' => 'Seguimiento Impacto Productivo 2025',
                      'date' => '05/05/2026',
                      'status' => 'ACTIVA',
                      'status_pill' => 'status-green',
                      'target' => 'Egresados Tecnólogos',
                      'enviadas' => 80,
                      'respondidas' => 68,
                      'pendientes' => 12,
                      'rate' => '85%',
                      'rate_num' => 85
                    ],
                    [
                      'id' => 'ENC-023',
                      'title' => 'Satisfacción Formativa CEFA',
                      'full_title' => 'Evaluación de Calidad Formativa CEFA',
                      'date' => '20/04/2026',
                      'status' => 'ACTIVA',
                      'status_pill' => 'status-green',
                      'target' => 'Todas las Especialidades',
                      'enviadas' => 150,
                      'respondidas' => 105,
                      'pendientes' => 45,
                      'rate' => '70%',
                      'rate_num' => 70
                    ],
                    [
                      'id' => 'ENC-022',
                      'title' => 'Competencias Blandas e Idiomas',
                      'full_title' => 'Diagnóstico de Habilidades y Bilingüismo',
                      'date' => '10/03/2026',
                      'status' => 'CERRADA',
                      'status_pill' => 'status-gray',
                      'target' => 'Egresados ADSO / Multimedia',
                      'enviadas' => 95,
                      'respondidas' => 88,
                      'pendientes' => 7,
                      'rate' => '92%',
                      'rate_num' => 92
                    ],
                    [
                      'id' => 'ENC-021',
                      'title' => 'Emprendimiento Fondo Emprender',
                      'full_title' => 'Sondeo de Proyectos Productivos',
                      'date' => '15/02/2026',
                      'status' => 'CERRADA',
                      'status_pill' => 'status-gray',
                      'target' => 'Egresados Emprendedores',
                      'enviadas' => 60,
                      'respondidas' => 42,
                      'pendientes' => 18,
                      'rate' => '70%',
                      'rate_num' => 70
                    ],
                  ];
                @endphp

                @foreach($encuestasList as $index => $item)
                  @php
                    $jsonData = json_encode($item);
                  @endphp
                  <tr class="encuesta-row {{ $index === 0 ? 'selected-row' : '' }}" 
                      id="survey-row-{{ $item['id'] }}"
                      data-id="{{ $item['id'] }}"
                      data-title="{{ $item['title'] }}"
                      data-status="{{ $item['status'] }}"
                      onclick="selectEncuesta({{ $jsonData }}, 'survey-row-{{ $item['id'] }}')">
                    
                    <td style="font-weight:700; color:var(--forest-deep);">
                      {{ $item['id'] }}
                    </td>

                    <td>
                      <div style="font-weight:700; color:var(--ink);">{{ $item['title'] }}</div>
                      <div style="font-size:11.5px; color:var(--ink-soft);">Creada: {{ $item['date'] }}</div>
                    </td>

                    <td>
                      <span class="badge-pill {{ $item['status_pill'] }}">{{ $item['status'] }}</span>
                    </td>

                    <td style="font-size:12.5px; color:var(--ink-soft); font-weight:500;">
                      {{ $item['target'] }}
                    </td>

                    <td>
                      <div class="table-progress-wrap">
                        <span class="table-progress-text">{{ $item['respondidas'] }}/{{ $item['enviadas'] }} ({{ $item['rate'] }})</span>
                        <div class="table-progress-bar">
                          <div class="table-progress-fill" style="width: {{ $item['rate_num'] }}%;"></div>
                        </div>
                      </div>
                    </td>

                    <td style="text-align:center;">
                      <div style="display:flex; align-items:center; justify-content:center; gap:6px;" onclick="event.stopPropagation();">
                        <button type="button" 
                            onclick="selectEncuesta({{ $jsonData }}, 'survey-row-{{ $item['id'] }}')" 
                            class="btn-circle-action" 
                            title="Ver en Panel">
                          <i class="fa-solid fa-eye"></i>
                        </button>
                        <button type="button" 
                            onclick="alert('Editar encuesta: {{ $item['title'] }}');" 
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

        <!-- Columna Derecha: Panel Lateral de Detalles y Estadísticas (Sticky) -->
        <div class="detail-card">
          
          <div class="detail-head">
            <span class="detail-head-title">
              <span class="pulse-dot"></span>
              Detalle de la Encuesta
            </span>
            <span id="detailStatusBadge" class="badge-pill status-green">ACTIVA</span>
          </div>

          <!-- Hero de la Encuesta -->
          <div class="detail-survey-hero">
            <div id="detailSurveyTitle" class="detail-survey-title">Encuesta Inserción Laboral</div>
            <div id="detailSurveyMeta" class="detail-survey-meta">ID: ENC-025 | Creada: 12/06/2026</div>
            <div class="detail-survey-status">
              <span class="pulse-dot" style="width:6px; height:6px;"></span>
              <span id="detailSurveyStatusText">Estado: Activa</span>
            </div>
            <div class="detail-survey-target">
              <strong>Dirigido a:</strong> <span id="detailSurveyTarget">Egresado ADSO</span>
            </div>
          </div>

          <!-- Bloque Estadísticas -->
          <div class="stats-panel-box">
            <span class="stats-box-title">Estadísticas</span>
            
            <div class="stats-row">
              <span class="stats-key">Enviadas:</span>
              <span id="detailEnviadas" class="stats-val">120</span>
            </div>
            <div class="stats-row">
              <span class="stats-key">Respondidas:</span>
              <span id="detailRespondidas" class="stats-val">90</span>
            </div>
            <div class="stats-row">
              <span class="stats-key">Pendientes:</span>
              <span id="detailPendientes" class="stats-val">30</span>
            </div>
            <div class="stats-row">
              <span class="stats-key">Tasa de respuestas:</span>
              <span id="detailRate" class="stats-val green">75%</span>
            </div>

            <!-- Barra de Progreso -->
            <div class="stats-progress-track">
              <div id="detailProgressBar" class="stats-progress-fill" style="width: 75%;"></div>
            </div>
          </div>

          <!-- Botones de Acción Clave -->
          <div class="detail-actions-group">
            <button type="button" onclick="alert('Visualizando resultados estadísticos detallados de ' + document.getElementById('detailSurveyTitle').innerText);" class="btn-cta-detail">
              <i class="fa-solid fa-chart-pie text-xs"></i>
              <span>Ver Resultados Completos</span>
            </button>

            <button type="button" onclick="alert('Generando y descargando reporte PDF para ' + document.getElementById('detailSurveyTitle').innerText);" class="btn-secondary-action">
              <i class="fa-solid fa-file-arrow-down text-xs"></i>
              <span>Descargar Reporte (PDF)</span>
            </button>

            <button type="button" onclick="if(confirm('¿Estás seguro de cerrar la encuesta seleccionada?')) alert('Encuesta cerrada exitosamente.');" class="btn-danger-action">
              <i class="fa-solid fa-ban text-xs"></i>
              <span>Cerrar encuesta</span>
            </button>
          </div>

        </div>

      </div>

    </div>
  </div>

</div>

<script>
    // Función interactiva para actualizar el panel de detalles reactivo
    function selectEncuesta(data, rowId) {
        if (!data) return;

        // Actualizar fila activa
        document.querySelectorAll('.encuesta-row').forEach(row => {
            row.classList.remove('selected-row');
        });
        const activeRow = document.getElementById(rowId);
        if (activeRow) activeRow.classList.add('selected-row');

        // Actualizar datos del panel lateral
        document.getElementById('detailSurveyTitle').innerText = data.full_title || data.title || 'Encuesta Institucional';
        document.getElementById('detailSurveyMeta').innerText = 'ID: ' + (data.id || 'ENC-000') + ' | Creada: ' + (data.date || 'N/A');
        document.getElementById('detailSurveyStatusText').innerText = 'Estado: ' + (data.status === 'ACTIVA' ? 'Activa' : (data.status === 'CERRADA' ? 'Cerrada' : 'Borrador'));
        document.getElementById('detailSurveyTarget').innerText = data.target || 'Público general';

        document.getElementById('detailEnviadas').innerText = data.enviadas || 0;
        document.getElementById('detailRespondidas').innerText = data.respondidas || 0;
        document.getElementById('detailPendientes').innerText = data.pendientes || 0;
        document.getElementById('detailRate').innerText = data.rate || '0%';

        const progressBar = document.getElementById('detailProgressBar');
        if (progressBar) {
            progressBar.style.width = (data.rate_num || parseInt(data.rate) || 0) + '%';
        }

        const badge = document.getElementById('detailStatusBadge');
        if (badge) {
            badge.innerText = data.status || 'ACTIVA';
            badge.className = 'badge-pill ' + (data.status_pill || 'status-green');
        }
    }

    // Filtrado interactivo en tabla
    function filterSurveysTable() {
        const query = document.getElementById('surveySearchInput').value.toLowerCase();
        const statusFilter = document.getElementById('surveyStatusFilter').value;
        const rows = document.querySelectorAll('#encuestasTable tbody tr');

        rows.forEach(row => {
            const id = row.getAttribute('data-id').toLowerCase();
            const title = row.getAttribute('data-title').toLowerCase();
            const status = row.getAttribute('data-status');

            const matchesQuery = id.includes(query) || title.includes(query);
            const matchesStatus = !statusFilter || status === statusFilter;

            if (matchesQuery && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Inicializar seleccionando la primera encuesta disponible al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.encuesta-row');
        if (firstRow) {
            firstRow.click();
        }
    });
</script>

</body>
</html>
