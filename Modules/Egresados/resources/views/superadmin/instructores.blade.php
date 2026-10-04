<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gestión de Instructores — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Fraunces + Plus Jakarta Sans / Work Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS & Alpine.js CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
      :root {
        --forest: #001A29;
        --forest-deep: #00131E;
        --sena-dark: #00131E;
        --sena-navy: #001A29;
        --sena-navy-light: #002336;
        --sena-light-navy: #00324D;
        --green: #39A900;
        --green-dark: #2a7c00;
        --green-soft: #EAF7EE;
        --moss: #62E31D;
        --bg: #F4F7F6;
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

      /* Instructores Table */
      .instructores-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13px;
      }
      .instructores-table th {
        background: #FAFCF9;
        color: var(--ink-soft);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
      }
      .instructores-table td {
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
        vertical-align: middle;
      }
      .instructores-table tr.instructor-row {
        cursor: pointer;
        transition: background-color 0.15s ease;
      }
      .instructores-table tr.instructor-row:hover {
        background-color: #F4FAF5;
      }
      .instructores-table tr.instructor-row.selected-row {
        background-color: #EAF7EE;
        box-shadow: inset 4px 0 0 var(--green);
      }

      .avatar-cell {
        display: flex;
        align-items: center;
        gap: 12px;
      }
      .avatar-bubble {
        width: 36px;
        height: 36px;
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

      .competencias-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 6px;
      }
      .comp-tag {
        font-size: 11px;
        font-weight: 600;
        background: #ffffff;
        border: 1px solid var(--line);
        padding: 3px 8px;
        border-radius: 6px;
        color: var(--ink);
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

      .pagination-wrap {
        padding: 16px 20px;
        border-top: 1px solid var(--line);
        display: flex;
        justify-content: center;
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
<body x-data="{ openModalNuevoInstructor: false, openModalPerfilInstructor: false, openModalAsignarFicha: false }">

<div class="app">

  <!-- ============================================== -->
  <!-- 1. SIDEBAR INSTITUCIONAL -->
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
      <a href="{{ route('egresados.instructores') }}" class="active">
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
        <a href="{{ route('login', ['redirect' => route('egresados.instructores')]) }}" class="logout-btn">
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
          <h1 class="page-title">Gestión de <span>Instructores</span></h1>
          <p class="page-desc">Consulta, seguimiento y actualización de información de instructores del CEFA.</p>
        </div>

        <div style="display:flex; align-items:center; gap:12px;">
          <button type="button" @click="openModalNuevoInstructor = true" class="btn-primary-green" style="border:none; cursor:pointer;">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Nuevo Instructor</span>
          </button>
        </div>
      </div>

      <!-- ============================================== -->
      <!-- 5 MÉTRICAS SUPERIORES -->
      <!-- ============================================== -->
      <div class="metrics-5-grid">
        
        <div class="metric-mini-card">
          <span class="metric-mini-label">Total Instructores</span>
          <div class="metric-mini-num">{{ number_format($totalInstructores) }}</div>
          <span class="metric-mini-pill green">Registrados</span>
        </div>

        <div class="metric-mini-card">
          <span class="metric-mini-label">Activos</span>
          <div class="metric-mini-num">{{ number_format($activos) }}</div>
          <span class="metric-mini-pill green">En servicio</span>
        </div>

        <div class="metric-mini-card">
          <span class="metric-mini-label">Programas</span>
          <div class="metric-mini-num">{{ number_format($programas) }}</div>
          <span class="metric-mini-pill blue">Asignados</span>
        </div>

        <div class="metric-mini-card">
          <span class="metric-mini-label">Fichas Activas</span>
          <div class="metric-mini-num">{{ number_format($fichasActivas) }}</div>
          <span class="metric-mini-pill indigo">En desarrollo</span>
        </div>

        <div class="metric-mini-card">
          <span class="metric-mini-label">Evaluaciones</span>
          <div class="metric-mini-num">{{ number_format($evaluaciones) }}</div>
          <span class="metric-mini-pill amber">Pendientes</span>
        </div>

      </div>

      <!-- ============================================== -->
      <!-- GRILLA PRINCIPAL: TABLA (2/3) + PANEL DE DETALLE (1/3) -->
      <!-- ============================================== -->
      <div class="main-grid">
        
        <!-- Columna Izquierda: Tabla -->
        <div class="table-card">
          
          <!-- Toolbar -->
          <form action="{{ route('egresados.instructores') }}" method="GET" class="table-toolbar">
            <div class="search-box">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar instructor por documento o nombre...">
            </div>

            <button type="submit" class="btn-filter">
              Buscar
            </button>

            @if(request('search'))
              <a href="{{ route('egresados.instructores') }}" style="color:var(--ink-soft); text-decoration:none; font-size:12px; font-weight:600; padding:8px;" title="Limpiar búsqueda">
                <i class="fa-solid fa-xmark"></i>
              </a>
            @endif
          </form>

          <!-- Tabla de Instructores -->
          <div style="overflow-x: auto;">
            <table class="instructores-table">
              <thead>
                <tr>
                  <th>Documento</th>
                  <th>Instructor(a)</th>
                  <th>Programa / Rol</th>
                  <th>Estado</th>
                  <th style="text-align:center;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse($instructores as $index => $inst)
                  @php
                    $person = $inst->person;
                    $fullName = $person ? ($person->first_name . ' ' . $person->first_last_name . ' ' . ($person->second_last_name ?? '')) : ($inst->name ?? $inst->nickname ?? 'Instructor #' . $inst->id);
                    
                    // Iniciales
                    $words = explode(' ', trim($fullName));
                    $initials = '';
                    foreach(array_slice($words, 0, 2) as $w) {
                        if (!empty($w)) $initials .= mb_strtoupper(mb_substr($w, 0, 1));
                    }

                    // Rol principal
                    $roleName = $inst->roles->first() ? $inst->roles->first()->name : 'Instructor';

                    // Serializar datos para JavaScript
                    $jsonData = json_encode([
                        'id' => $inst->id,
                        'name' => $fullName,
                        'initials' => $initials ?: 'IN',
                        'document' => $person->document_number ?? '107584578',
                        'email' => $inst->email ?? ($person->misena_email ?? 'instructor@sena.edu.co'),
                        'phone' => $person->telephone1 ?? '316 000 0000',
                        'program' => 'ADSO (Desarrollo de Software)',
                        'especialidad' => 'Desarrollo de Software & TIC',
                        'fichas' => '6 Fichas activas',
                        'status' => 'ACTIVO',
                        'status_pill' => 'status-green',
                    ]);
                  @endphp
                  <tr class="instructor-row {{ $index === 0 ? 'selected-row' : '' }}" 
                      id="inst-row-{{ $inst->id }}"
                      onclick="selectInstructor({{ $jsonData }}, 'inst-row-{{ $inst->id }}')">
                    
                    <td style="font-weight:700; color:var(--forest-deep);">
                      {{ $person->document_number ?? '107584578' }}
                    </td>

                    <td>
                      <div class="avatar-cell">
                        <div class="avatar-bubble">{{ $initials ?: 'IN' }}</div>
                        <div>
                          <div class="name-main">{{ $fullName }}</div>
                          <div class="name-email">{{ $inst->email }}</div>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div style="font-weight:600; color:var(--ink);">ADSO</div>
                      <div style="font-size:11px; color:var(--ink-soft); font-weight:600;">{{ $roleName }}</div>
                    </td>

                    <td>
                      <span class="badge-pill status-green">ACTIVO</span>
                    </td>

                    <td style="text-align:center;">
                      <div style="display:flex; align-items:center; justify-content:center; gap:6px;" onclick="event.stopPropagation();">
                        <button type="button" 
                            onclick="selectInstructor({{ $jsonData }}, 'inst-row-{{ $inst->id }}')" 
                            class="btn-circle-action" 
                            title="Ver en Panel de Detalle">
                          <i class="fa-solid fa-eye"></i>
                        </button>
                        <button type="button" 
                            onclick="alert('Editar datos de {{ $fullName }}');" 
                            class="btn-circle-action" 
                            title="Editar">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                      </div>
                    </td>

                  </tr>
                @empty
                  <tr>
                    <td colspan="5" style="text-align:center; padding:40px 20px; color:var(--ink-soft);">
                      <i class="fa-solid fa-chalkboard-user" style="font-size:32px; color:#cbd5e1; margin-bottom:10px; display:block;"></i>
                      <div style="font-weight:700; font-size:15px; color:var(--ink);">No se encontraron instructores</div>
                      <p style="font-size:12px; margin-top:4px;">Prueba cambiando los términos de búsqueda.</p>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Paginación -->
          @if($instructores->hasPages())
            <div class="pagination-wrap">
              {{ $instructores->withQueryString()->links() }}
            </div>
          @endif

        </div>

        <!-- Columna Derecha: Panel de Detalle Rápido (Sticky) -->
        <div class="detail-card">
          
          <div class="detail-head">
            <span class="detail-head-title">
              <span class="pulse-dot"></span>
              Detalle del Instructor
            </span>
            <span id="detailStatusPill" class="badge-pill status-green">ACTIVO</span>
          </div>

          <!-- Hero del Instructor -->
          <div class="detail-user-hero">
            <div id="detailAvatarLarge" class="detail-avatar-large">CM</div>
            <div style="overflow:hidden;">
              <div id="detailName" class="detail-user-name">Carla Moreno</div>
              <div id="detailDoc" class="detail-user-doc">Doc: 107584578</div>
              <div id="detailEmail" class="detail-user-email">CMoreno@gmail.com</div>
            </div>
          </div>

          <!-- Bloque Académico -->
          <div class="info-box">
            <span class="info-box-label">Información Académica</span>
            <div class="info-row">
              <span class="info-key">Programa Asignado:</span>
              <span id="detailProgram" class="info-val">ADSO</span>
            </div>
            <div class="info-row">
              <span class="info-key">Especialidad:</span>
              <span id="detailEspecialidad" class="info-val">Desarrollo de Software</span>
            </div>
            <div class="info-row">
              <span class="info-key">Fichas Asignadas:</span>
              <span id="detailFichas" class="info-val">6 Fichas</span>
            </div>
          </div>

          <!-- Bloque Competencias -->
          <div class="info-box">
            <span class="info-box-label">Competencias</span>
            <div class="competencias-tags">
              <span class="comp-tag">Programación</span>
              <span class="comp-tag">Bases de datos</span>
              <span class="comp-tag">Desarrollo web</span>
              <span class="comp-tag">Seguimiento Egresados</span>
            </div>
          </div>

          <!-- Botones de Acción -->
          <button type="button" @click="openModalPerfilInstructor = true" class="btn-cta-detail" style="border:none; cursor:pointer; width:100%; text-align:center;">
            <span>Ver Perfil Completo</span>
            <i class="fa-solid fa-arrow-right text-xs"></i>
          </button>

          <button type="button" @click="openModalAsignarFicha = true" class="btn-secondary-action" style="border:none; cursor:pointer; width:100%;">
            <i class="fa-solid fa-link"></i>
            <span>Asignar Ficha / Seguimiento</span>
          </button>

        </div>

      </div>

    </div>
  </div>

</div>

<script>
    // Función interactiva para actualizar el panel lateral reactivo
    function selectInstructor(data, rowId) {
        if (!data) return;

        // Actualizar fila activa
        document.querySelectorAll('.instructor-row').forEach(row => {
            row.classList.remove('selected-row');
        });
        const activeRow = document.getElementById(rowId);
        if (activeRow) activeRow.classList.add('selected-row');

        // Actualizar datos del panel derecho
        document.getElementById('detailAvatarLarge').innerText = data.initials || 'IN';
        document.getElementById('detailName').innerText = data.name || 'Sin nombre';
        document.getElementById('detailDoc').innerText = 'Doc: ' + (data.document || 'N/A');
        document.getElementById('detailEmail').innerText = data.email || 'Sin correo';
        
        document.getElementById('detailProgram').innerText = data.program || 'ADSO';
        document.getElementById('detailEspecialidad').innerText = data.especialidad || 'Desarrollo de Software';
        document.getElementById('detailFichas').innerText = data.fichas || 'Asignadas';
        
        const pill = document.getElementById('detailStatusPill');
        if (pill) {
            pill.innerText = data.status || 'ACTIVO';
            pill.className = 'badge-pill ' + (data.status_pill || 'status-green');
        }

        // Sincronizar datos en Modal de Perfil de Instructor
        const mpName = document.getElementById('modalInstName');
        if (mpName) mpName.innerText = data.name || 'Instructor';
        const mpDoc = document.getElementById('modalInstDoc');
        if (mpDoc) mpDoc.innerText = data.document || 'N/A';
        const mpEmail = document.getElementById('modalInstEmail');
        if (mpEmail) mpEmail.innerText = data.email || 'N/A';
        const mpInit = document.getElementById('modalInstInitials');
        if (mpInit) mpInit.innerText = data.initials || 'IN';
        const mpProg = document.getElementById('modalInstProgram');
        if (mpProg) mpProg.innerText = data.program || 'ADSO';

        // Sincronizar datos en Modal de Asignar Ficha
        const asgId = document.getElementById('assignInstructorId');
        if (asgId && data.id) asgId.value = data.id;
        const asgName = document.getElementById('assignInstructorNameLabel');
        if (asgName) asgName.innerText = data.name || 'Instructor';
    }

    // Inicializar seleccionando el primer instructor disponible
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.instructor-row');
        if (firstRow) {
            firstRow.click();
        }
    });
</script>

<!-- ============================================== -->
<!-- MODAL 1: PERFIL COMPLETO DEL INSTRUCTOR -->
<!-- ============================================== -->
<div x-show="openModalPerfilInstructor" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openModalPerfilInstructor = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[92vh] overflow-hidden">
        
        <div class="flex items-center justify-between border-b border-gray-100 px-6 sm:px-8 py-5 bg-gradient-to-r from-[#001A29] to-[#00131E] text-white">
            <div class="flex items-center gap-4">
                <div id="modalInstInitials" class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-bold text-lg shadow-inner">
                    CM
                </div>
                <div>
                    <div class="text-[10.5px] font-extrabold text-emerald-300 uppercase tracking-wider">EXPEDIENTE DOCENTE · SIGE</div>
                    <h3 id="modalInstName" class="text-xl font-bold text-white tracking-tight">Carla Moreno</h3>
                    <p class="text-xs text-green-100/70 mt-0.5">Centro de Formación Agroindustrial La Angostura</p>
                </div>
            </div>
            <button @click="openModalPerfilInstructor = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-6">
            <!-- Datos de Contacto -->
            <div>
                <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-100">Información de Contacto</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-gray-400 font-bold uppercase block">Documento de Identidad</span>
                        <p id="modalInstDoc" class="text-sm font-bold text-gray-800 mt-0.5">107584578</p>
                    </div>
                    <div class="bg-gray-50 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-gray-400 font-bold uppercase block">Correo Institucional</span>
                        <p id="modalInstEmail" class="text-sm font-bold text-gray-800 mt-0.5">CMoreno@gmail.com</p>
                    </div>
                </div>
            </div>

            <!-- Asignación Académica -->
            <div>
                <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-100">Asignación Académica y Fichas</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-emerald-50/60 border border-emerald-100 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-emerald-700 font-bold uppercase block">Programa Principal</span>
                        <p id="modalInstProgram" class="text-sm font-bold text-emerald-900 mt-0.5">ADSO (Desarrollo de Software)</p>
                    </div>
                    <div class="bg-emerald-50/60 border border-emerald-100 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-emerald-700 font-bold uppercase block">Fichas Activas</span>
                        <p class="text-sm font-bold text-emerald-900 mt-0.5">6 Fichas en seguimiento</p>
                    </div>
                </div>
            </div>

            <!-- Competencias -->
            <div>
                <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2.5 pb-1 border-b border-gray-100">Competencias e Instrucción</h4>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1.5 bg-gray-50 border border-gray-200 text-gray-700 text-xs font-semibold rounded-xl">Desarrollo de Software Web</span>
                    <span class="px-3 py-1.5 bg-gray-50 border border-gray-200 text-gray-700 text-xs font-semibold rounded-xl">Bases de Datos Relacionales</span>
                    <span class="px-3 py-1.5 bg-gray-50 border border-gray-200 text-gray-700 text-xs font-semibold rounded-xl">Seguimiento Etapa Productiva</span>
                    <span class="px-3 py-1.5 bg-gray-50 border border-gray-200 text-gray-700 text-xs font-semibold rounded-xl">Tutoría de Proyectos SENA</span>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex items-center justify-end bg-gray-50/50">
            <button type="button" @click="openModalPerfilInstructor = false" class="px-6 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition cursor-pointer shadow-sm">
                Cerrar Expediente
            </button>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL 2: ASIGNAR FICHA / SEGUIMIENTO -->
<!-- ============================================== -->
<div x-show="openModalAsignarFicha" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openModalAsignarFicha = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         class="bg-white rounded-3xl max-w-lg w-full shadow-2xl border border-gray-100 flex flex-col">
        
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-5">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Asignar Ficha / Seguimiento</h3>
                <p class="text-xs text-gray-500 mt-1">Instructor: <span id="assignInstructorNameLabel" class="font-bold text-emerald-700">Carla Moreno</span></p>
            </div>
            <button @click="openModalAsignarFicha = false" type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-50 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="px-6 py-5">
            <form id="form-asignar-ficha" onsubmit="event.preventDefault(); alert('¡Ficha asignada exitosamente al instructor en el sistema!');" class="space-y-4">
                <input type="hidden" id="assignInstructorId" value="1">

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Ficha de Formación <span class="text-red-500">*</span></label>
                    <select required class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                        <option value="">Seleccione una ficha...</option>
                        <option value="3145614">3145614 - Análisis y Desarrollo de Software (ADSO)</option>
                        <option value="55555">55555 - Gestión de Empresas Agropecuarias</option>
                        <option value="3145615">3145615 - Procesamiento de Alimentos</option>
                        <option value="2981122">2981122 - Producción Ganadera</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Rol de Acompañamiento <span class="text-red-500">*</span></label>
                    <select required class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                        <option value="lider">Instructor Líder de Ficha</option>
                        <option value="etapa_productiva" selected>Seguimiento a Etapa Productiva / Egresados</option>
                        <option value="tecnico">Instructor Técnico de Especialidad</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Observaciones de la asignación</label>
                    <textarea rows="3" placeholder="Detalle acuerdos de acompañamiento a egresados o cronograma..." class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none resize-none"></textarea>
                </div>
            </form>
        </div>

        <div class="border-t border-gray-100 px-6 py-4 flex items-center justify-end gap-3 bg-gray-50/50 rounded-b-3xl">
            <button type="button" @click="openModalAsignarFicha = false" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-sm">
                Cancelar
            </button>
            <button type="submit" form="form-asignar-ficha" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer flex items-center gap-2">
                <i class="fa-solid fa-link text-xs"></i>
                <span>Guardar Asignación</span>
            </button>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL 3: REGISTRAR NUEVO INSTRUCTOR -->
<!-- ============================================== -->
<div x-show="openModalNuevoInstructor" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openModalNuevoInstructor = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         class="bg-white rounded-3xl max-w-xl w-full shadow-2xl border border-gray-100 flex flex-col">
        
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-5">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Registrar Nuevo Instructor</h3>
                <p class="text-xs text-gray-500 mt-1">Vincular nuevo docente a la plataforma SIGE CEFA La Angostura.</p>
            </div>
            <button @click="openModalNuevoInstructor = false" type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-50 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="px-6 py-5">
            <form id="form-crear-instructor" action="{{ route('egresados.superadmin.instructores.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Documento <span class="text-red-500">*</span></label>
                        <input type="text" name="documento" required placeholder="Ej. 107584578" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Nombre Completo <span class="text-red-500">*</span></label>
                        <input type="text" name="nombre" required placeholder="Nombres y Apellidos" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Correo Electrónico Institucional <span class="text-red-500">*</span></label>
                    <input type="email" name="correo" required placeholder="instructor@sena.edu.co" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Rol en el Sistema</label>
                        <select name="rol" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                            <option value="instructor_egresados">Instructor Egresados</option>
                            <option value="superadmin_egresados">Super Administrador</option>
                            <option value="coordinador">Coordinador Académico</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Programa Vinculado</label>
                        <select name="programa" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                            <option value="ADSO">ADSO</option>
                            <option value="GAE">Gestión Agropecuaria</option>
                            <option value="ALIMENTOS">Procesamiento de Alimentos</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <div class="border-t border-gray-100 px-6 py-4 flex items-center justify-end gap-3 bg-gray-50/50 rounded-b-3xl">
            <button type="button" @click="openModalNuevoInstructor = false" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-sm">
                Cancelar
            </button>
            <button type="submit" form="form-crear-instructor" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer">
                Guardar Instructor
            </button>
        </div>
    </div>
</div>

</body>
</html>
