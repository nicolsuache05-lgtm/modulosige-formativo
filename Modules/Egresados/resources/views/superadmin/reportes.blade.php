<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Reportes Institucionales — CEFA La Angostura</title>

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
      .metric-mini-pill.indigo { background: #EEF2FF; color: #4338CA; }
      .metric-mini-pill.amber { background: #FFF8E6; color: #B45309; }

      /* ---------------- MAIN 2-COLUMN + 1-COLUMN GRID ---------------- */
      .main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        align-items: start;
      }

      /* Filter Box */
      .filter-card {
        background: var(--card);
        border-radius: 16px;
        border: 1px solid var(--line);
        padding: 20px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        gap: 16px;
      }

      .filter-grid-4 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
      }

      .filter-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
      }
      .filter-label {
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--ink-soft);
      }
      .filter-input-select {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 12.5px;
        background: #FAFCF9;
        color: var(--ink);
        outline: none;
        font-family: inherit;
        transition: border-color 0.2s, box-shadow 0.2s;
      }
      .filter-input-select:focus {
        border-color: var(--green);
        box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.12);
        background: #ffffff;
      }

      .filter-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 14px;
        border-top: 1px solid var(--line);
        flex-wrap: wrap;
        gap: 12px;
      }
      .date-range-box {
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .date-range-box input[type="date"] {
        padding: 7px 12px;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 12px;
        background: #FAFCF9;
        color: var(--ink);
        outline: none;
        font-family: inherit;
      }
      .date-range-box input[type="date"]:focus {
        border-color: var(--green);
        background: #ffffff;
      }
      .date-sep {
        font-size: 12px;
        color: var(--ink-soft);
        font-weight: 500;
      }

      .btn-filter-submit {
        padding: 8px 22px;
        background: var(--forest);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.15s ease;
      }
      .btn-filter-submit:hover {
        background: var(--green);
        transform: translateY(-1px);
      }

      /* Reportes Table */
      .table-card {
        background: var(--card);
        border-radius: 16px;
        border: 1px solid var(--line);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        overflow: hidden;
      }

      .reportes-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13px;
      }
      .reportes-table th {
        background: #FAFCF9;
        color: var(--ink-soft);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
      }
      .reportes-table td {
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
        vertical-align: middle;
      }
      .reportes-table tr.report-row {
        cursor: pointer;
        transition: background-color 0.15s ease;
      }
      .reportes-table tr.report-row:hover {
        background-color: #F4FAF5;
      }
      .reportes-table tr.report-row.selected-row {
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
      .badge-pill.status-blue { background: #EEF4FF; color: #1D4ED8; border: 1px solid rgba(29,78,216,0.25); }

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

      .detail-report-hero {
        display: flex;
        flex-direction: column;
        gap: 4px;
      }
      .detail-report-title {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 17px;
        color: var(--forest-deep);
        line-height: 1.25;
      }
      .detail-report-meta {
        font-size: 12px;
        color: var(--ink-soft);
      }
      .detail-report-attr {
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

      .applied-filters-box {
        background: #FAFCF9;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 12px;
        color: var(--ink);
        line-height: 1.6;
      }
      .applied-filters-title {
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--ink-soft);
        margin-bottom: 6px;
        display: block;
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
        .filter-grid-4 { grid-template-columns: repeat(2, 1fr); }
        .main-grid { grid-template-columns: 1fr; }
      }
      @media (max-width: 640px) {
        .metrics-5-grid { grid-template-columns: 1fr; }
        .filter-grid-4 { grid-template-columns: 1fr; }
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
      <a href="{{ route('egresados.reportes') }}" class="active">
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
          <h1 class="page-title">Gestión de <span>Reportes</span></h1>
          <p class="page-desc">Generación y consulta de reportes institucionales del CEFA.</p>
        </div>

        <div style="display:flex; align-items:center; gap:12px;">
          <button type="button" onclick="alert('Formulario de generación de nuevo reporte institucional.');" class="btn-primary-green">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Crear Reporte</span>
          </button>
        </div>
      </div>

      <!-- ============================================== -->
      <!-- MÉTRICAS SUPERIORES (GRID DE 5) -->
      <!-- ============================================== -->
      <div class="metrics-5-grid">
        
        <!-- Metric 1: Generados -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Generados</span>
          <div class="metric-mini-num">{{ $totalGenerados ?? 245 }}</div>
          <span class="metric-mini-pill green">Este mes</span>
        </div>

        <!-- Metric 2: Total Egresados -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Total Egresados</span>
          <div class="metric-mini-num">{{ $totalEgresados ?? '1.250' }}</div>
          <span class="metric-mini-pill blue">Este año</span>
        </div>

        <!-- Metric 3: Empleabilidad -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Empleabilidad</span>
          <div class="metric-mini-num highlight">{{ $tasaEmpleabilidad ?? '78%' }}</div>
          <span class="metric-mini-pill green">Tasa actual</span>
        </div>

        <!-- Metric 4: Encuestas -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Encuestas</span>
          <div class="metric-mini-num">{{ $totalEncuestas ?? 890 }}</div>
          <span class="metric-mini-pill indigo">Respondidas</span>
        </div>

        <!-- Metric 5: Visitas -->
        <div class="metric-mini-card">
          <span class="metric-mini-label">Visitas</span>
          <div class="metric-mini-num">{{ $totalVisitas ?? '3.420' }}</div>
          <span class="metric-mini-pill green">Registradas</span>
        </div>

      </div>

      <!-- ============================================== -->
      <!-- GRILLA PRINCIPAL: FILTROS + TABLA (2/3) + PANEL DE DETALLE (1/3) -->
      <!-- ============================================== -->
      <div class="main-grid">
        
        <!-- Columna Izquierda: Filtros y Tabla -->
        <div>
          
          <!-- Panel de Filtros Avanzados -->
          <div class="filter-card">
            <div class="filter-grid-4">
              <div class="filter-group">
                <label class="filter-label">Programa</label>
                <select id="filterPrograma" onchange="applyFilters()" class="filter-input-select">
                  <option value="">Todos</option>
                  <option value="ADSO">ADSO (Software)</option>
                  <option value="Gestión Agroempresarial">Gestión Agroempresarial</option>
                  <option value="Producción Agrícola">Producción Agrícola</option>
                  <option value="Contabilización">Contabilización</option>
                </select>
              </div>

              <div class="filter-group">
                <label class="filter-label">Ficha</label>
                <select id="filterFicha" onchange="applyFilters()" class="filter-input-select">
                  <option value="">Todas</option>
                  <option value="2694551">2694551</option>
                  <option value="2694552">2694552</option>
                  <option value="2712345">2712345</option>
                  <option value="2754321">2754321</option>
                </select>
              </div>

              <div class="filter-group">
                <label class="filter-label">Estado Laboral</label>
                <select id="filterEstado" onchange="applyFilters()" class="filter-input-select">
                  <option value="">Todos</option>
                  <option value="Empleado">Empleado</option>
                  <option value="Emprendedor">Emprendedor</option>
                  <option value="Buscando Empleo">Buscando Empleo</option>
                  <option value="Certificado">Certificado</option>
                </select>
              </div>

              <div class="filter-group">
                <label class="filter-label">Región</label>
                <select id="filterRegion" onchange="applyFilters()" class="filter-input-select">
                  <option value="">Todas</option>
                  <option value="Huila">Huila</option>
                  <option value="Tolima">Tolima</option>
                  <option value="Cundinamarca">Cundinamarca</option>
                  <option value="Antioquia">Antioquia</option>
                </select>
              </div>
            </div>

            <div class="filter-footer">
              <div class="date-range-box">
                <input type="date" id="filterDateFrom" value="2026-01-01">
                <span class="date-sep">hasta</span>
                <input type="date" id="filterDateTo" value="2026-06-12">
              </div>

              <button type="button" onclick="applyFilters()" class="btn-filter-submit">
                Filtrar
              </button>
            </div>
          </div>

          <!-- Tabla de Reportes -->
          <div class="table-card">
            <div style="overflow-x: auto;">
              <table class="reportes-table" id="reportesTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Reporte</th>
                    <th>Fecha</th>
                    <th>Generado por</th>
                    <th>Estado</th>
                    <th style="text-align:center;">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $reportesList = $reportes ?? [
                      [
                        'id' => 'REP_002',
                        'title' => 'Reporte Egresados ADSO',
                        'full_title' => 'Reporte de empleabilidad ADSO',
                        'date' => '12/06/2026',
                        'generated_by' => 'Coordinación Académica',
                        'program' => 'ADSO',
                        'status' => 'GENERADO',
                        'status_pill' => 'status-green',
                        'total_egresados' => 350,
                        'empleados' => 280,
                        'desempleados' => 70,
                        'rate' => '80%',
                        'rate_num' => 80,
                        'filters' => [
                          'programa' => 'ADSO',
                          'ficha' => 'Todas',
                          'estado' => 'Todos',
                          'region' => 'Huila',
                          'periodo' => '01/01/2026 - 12/06/2026'
                        ]
                      ],
                      [
                        'id' => 'REP_001',
                        'title' => 'Consolidado Empleabilidad CEFA',
                        'full_title' => 'Consolidado General de Empleabilidad 2026',
                        'date' => '08/06/2026',
                        'generated_by' => 'Super Administrador',
                        'program' => 'Todas las Especialidades',
                        'status' => 'GENERADO',
                        'status_pill' => 'status-green',
                        'total_egresados' => 1250,
                        'empleados' => 975,
                        'desempleados' => 275,
                        'rate' => '78%',
                        'rate_num' => 78,
                        'filters' => [
                          'programa' => 'Todos',
                          'ficha' => 'Todas',
                          'estado' => 'Todos',
                          'region' => 'Huila & Regional',
                          'periodo' => '01/01/2026 - 08/06/2026'
                        ]
                      ],
                      [
                        'id' => 'REP_003',
                        'title' => 'Seguimiento Fichas Agroempresariales',
                        'full_title' => 'Seguimiento Fichas de Gestión Agroempresarial',
                        'date' => '01/06/2026',
                        'generated_by' => 'Instructor Líder',
                        'program' => 'Gestión Agroempresarial',
                        'status' => 'GENERADO',
                        'status_pill' => 'status-green',
                        'total_egresados' => 240,
                        'empleados' => 196,
                        'desempleados' => 44,
                        'rate' => '82%',
                        'rate_num' => 82,
                        'filters' => [
                          'programa' => 'Gestión Agroempresarial',
                          'ficha' => '2694551, 2694552',
                          'estado' => 'Certificado / Empleado',
                          'region' => 'Huila',
                          'periodo' => '01/01/2026 - 01/06/2026'
                        ]
                      ],
                      [
                        'id' => 'REP_004',
                        'title' => 'Diagnóstico Producción Agrícola',
                        'full_title' => 'Diagnóstico Laboral Producción Agrícola',
                        'date' => '25/05/2026',
                        'generated_by' => 'Coordinación Académica',
                        'program' => 'Producción Agrícola',
                        'status' => 'GENERADO',
                        'status_pill' => 'status-green',
                        'total_egresados' => 180,
                        'empleados' => 126,
                        'desempleados' => 54,
                        'rate' => '70%',
                        'rate_num' => 70,
                        'filters' => [
                          'programa' => 'Producción Agrícola',
                          'ficha' => 'Todas',
                          'estado' => 'Todos',
                          'region' => 'Huila / Campoalegre',
                          'periodo' => '01/01/2026 - 25/05/2026'
                        ]
                      ],
                      [
                        'id' => 'REP_005',
                        'title' => 'Evaluación de Bilingüismo & TIC',
                        'full_title' => 'Informe de Competencias en Lenguas y TIC',
                        'date' => '15/05/2026',
                        'generated_by' => 'Super Administrador',
                        'program' => 'ADSO / Multimedia',
                        'status' => 'GENERADO',
                        'status_pill' => 'status-green',
                        'total_egresados' => 195,
                        'empleados' => 165,
                        'desempleados' => 30,
                        'rate' => '85%',
                        'rate_num' => 85,
                        'filters' => [
                          'programa' => 'ADSO / Tecnologías',
                          'ficha' => '2712345',
                          'estado' => 'Empleado / Certificado',
                          'region' => 'Huila',
                          'periodo' => '01/01/2026 - 15/05/2026'
                        ]
                      ],
                    ];
                  @endphp

                  @foreach($reportesList as $index => $item)
                    @php
                      $jsonData = json_encode($item);
                    @endphp
                    <tr class="report-row {{ $index === 0 ? 'selected-row' : '' }}" 
                        id="rep-row-{{ $item['id'] }}"
                        data-id="{{ $item['id'] }}"
                        data-program="{{ $item['program'] }}"
                        data-title="{{ $item['title'] }}"
                        onclick="selectReporte({{ $jsonData }}, 'rep-row-{{ $item['id'] }}')">
                      
                      <td style="font-weight:700; color:var(--forest-deep);">
                        {{ $item['id'] }}
                      </td>

                      <td>
                        <div style="font-weight:700; color:var(--ink);">{{ $item['title'] }}</div>
                      </td>

                      <td style="font-size:12.5px; color:var(--ink-soft);">
                        {{ $item['date'] }}
                      </td>

                      <td style="font-size:12.5px; color:var(--ink-soft); font-weight:500;">
                        {{ $item['generated_by'] }}
                      </td>

                      <td>
                        <span class="badge-pill {{ $item['status_pill'] }}">{{ $item['status'] }}</span>
                      </td>

                      <td style="text-align:center;">
                        <div style="display:flex; align-items:center; justify-content:center; gap:6px;" onclick="event.stopPropagation();">
                          <button type="button" 
                              onclick="selectReporte({{ $jsonData }}, 'rep-row-{{ $item['id'] }}')" 
                              class="btn-circle-action" 
                              title="Ver en Panel">
                            <i class="fa-solid fa-eye"></i>
                          </button>
                          <button type="button" 
                              onclick="alert('Editar parámetros de reporte: {{ $item['title'] }}');" 
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

        </div>

        <!-- Columna Derecha: Panel Lateral de Detalle del Reporte (Sticky) -->
        <div class="detail-card">
          
          <div class="detail-head">
            <span class="detail-head-title">
              <span class="pulse-dot"></span>
              Detalle del Reporte
            </span>
            <span id="detailStatusBadge" class="badge-pill status-green">GENERADO</span>
          </div>

          <!-- Hero del Reporte -->
          <div class="detail-report-hero">
            <div id="detailReportTitle" class="detail-report-title">Reporte de empleabilidad ADSO</div>
            <div id="detailReportMeta" class="detail-report-meta">ID: REP-002 | Fecha: 11/06/2026</div>
            <div class="detail-report-attr"><strong>Programa:</strong> <span id="detailReportProgram">ADSO</span></div>
            <div class="detail-report-attr" style="font-size:12px; color:var(--ink-soft);"><strong>Responsable:</strong> <span id="detailReportResp">Coordinación Académica</span></div>
          </div>

          <!-- Bloque Estadísticas del Reporte -->
          <div class="stats-panel-box">
            <span class="stats-box-title">Estadísticas</span>
            
            <div class="stats-row">
              <span class="stats-key">Total de Egresados:</span>
              <span id="detailTotalEgresados" class="stats-val">350</span>
            </div>
            <div class="stats-row">
              <span class="stats-key">Empleados:</span>
              <span id="detailEmpleados" class="stats-val">280</span>
            </div>
            <div class="stats-row">
              <span class="stats-key">Desempleados:</span>
              <span id="detailDesempleados" class="stats-val">70</span>
            </div>
            <div class="stats-row">
              <span class="stats-key">Tasa Empleabilidad:</span>
              <span id="detailRate" class="stats-val green">80%</span>
            </div>

            <!-- Barra de Progreso -->
            <div class="stats-progress-track">
              <div id="detailProgressBar" class="stats-progress-fill" style="width: 80%;"></div>
            </div>
          </div>

          <!-- Filtros Aplicados -->
          <div class="applied-filters-box">
            <span class="applied-filters-title">Filtros Aplicados</span>
            <div>• <strong>Programa:</strong> <span id="detailFiltroProg">ADSO</span></div>
            <div>• <strong>Ficha:</strong> <span id="detailFiltroFicha">Todas</span></div>
            <div>• <strong>Estado Laboral:</strong> <span id="detailFiltroEstado">Todos</span></div>
            <div>• <strong>Región:</strong> <span id="detailFiltroRegion">Huila</span></div>
            <div>• <strong>Período:</strong> <span id="detailFiltroPeriodo">01/01/2026 - 12/06/2026</span></div>
          </div>

          <!-- Botones de Acción -->
          <div class="detail-actions-group">
            <button type="button" onclick="alert('Descargando archivo Excel (.xlsx) de ' + document.getElementById('detailReportTitle').innerText);" class="btn-cta-detail">
              <i class="fa-solid fa-file-excel text-xs"></i>
              <span>Descargar Excel</span>
            </button>

            <button type="button" onclick="alert('Descargando documento PDF (.pdf) de ' + document.getElementById('detailReportTitle').innerText);" class="btn-secondary-action">
              <i class="fa-solid fa-file-pdf text-xs"></i>
              <span>Descargar PDF</span>
            </button>

            <button type="button" onclick="alert('Abriendo módulo de visualización gráfica de indicadores.');" class="btn-secondary-action">
              <i class="fa-solid fa-chart-simple text-xs"></i>
              <span>Ver Gráficas</span>
            </button>

            <button type="button" onclick="alert('Enviando reporte por correo institucional a coordinación.');" class="btn-secondary-action">
              <i class="fa-solid fa-envelope text-xs"></i>
              <span>Enviar por Correo</span>
            </button>

            <button type="button" onclick="if(confirm('¿Estás seguro de eliminar el reporte seleccionado?')) alert('Reporte eliminado.');" class="btn-danger-action">
              <i class="fa-solid fa-trash-can text-xs"></i>
              <span>Eliminar Reporte</span>
            </button>
          </div>

        </div>

      </div>

    </div>
  </div>

</div>

<script>
    // Función interactiva para actualizar el panel de detalles reactivo
    function selectReporte(data, rowId) {
        if (!data) return;

        // Actualizar fila activa
        document.querySelectorAll('.report-row').forEach(row => {
            row.classList.remove('selected-row');
        });
        const activeRow = document.getElementById(rowId);
        if (activeRow) activeRow.classList.add('selected-row');

        // Actualizar datos del panel lateral
        document.getElementById('detailReportTitle').innerText = data.full_title || data.title || 'Reporte Institucional';
        document.getElementById('detailReportMeta').innerText = 'ID: ' + (data.id || 'REP-000') + ' | Fecha: ' + (data.date || 'N/A');
        document.getElementById('detailReportProgram').innerText = data.program || 'General';
        document.getElementById('detailReportResp').innerText = data.generated_by || 'Coordinación Académica';

        document.getElementById('detailTotalEgresados').innerText = data.total_egresados || 0;
        document.getElementById('detailEmpleados').innerText = data.empleados || 0;
        document.getElementById('detailDesempleados').innerText = data.desempleados || 0;
        document.getElementById('detailRate').innerText = data.rate || '0%';

        const progressBar = document.getElementById('detailProgressBar');
        if (progressBar) {
            progressBar.style.width = (data.rate_num || parseInt(data.rate) || 0) + '%';
        }

        // Filtros aplicados
        if (data.filters) {
            document.getElementById('detailFiltroProg').innerText = data.filters.programa || 'Todos';
            document.getElementById('detailFiltroFicha').innerText = data.filters.ficha || 'Todas';
            document.getElementById('detailFiltroEstado').innerText = data.filters.estado || 'Todos';
            document.getElementById('detailFiltroRegion').innerText = data.filters.region || 'Todas';
            document.getElementById('detailFiltroPeriodo').innerText = data.filters.periodo || '01/01/2026 - 12/06/2026';
        }

        const badge = document.getElementById('detailStatusBadge');
        if (badge) {
            badge.innerText = data.status || 'GENERADO';
            badge.className = 'badge-pill ' + (data.status_pill || 'status-green');
        }
    }

    // Filtrado interactivo en tabla
    function applyFilters() {
        const progFilter = document.getElementById('filterPrograma').value.toLowerCase();
        const rows = document.querySelectorAll('#reportesTable tbody tr');

        rows.forEach(row => {
            const rowProg = (row.getAttribute('data-program') || '').toLowerCase();
            const rowTitle = (row.getAttribute('data-title') || '').toLowerCase();

            const matchProg = !progFilter || rowProg.includes(progFilter) || rowTitle.includes(progFilter);

            if (matchProg) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Inicializar seleccionando el primer reporte disponible al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.report-row');
        if (firstRow) {
            firstRow.click();
        }
    });
</script>

</body>
</html>
