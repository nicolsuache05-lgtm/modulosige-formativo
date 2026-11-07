<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <title>SIGE · Panel de Control — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Poppins & Nunito (Tipografía Institucional SENA Empresa ERP) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
      :root {
        /* ========================================================
           PALETA INSTITUCIONAL SENA EMPRESA ERP
           ======================================================== */
        --sena-green: #39A900;
        --sena-green-hover: #2d8500;
        --sena-neon: #62E31D;
        --sena-dark: #00131E;
        --sena-navy: #001A29;
        --sena-navy-light: #002336;
        --sena-light-navy: #00324D;

        --forest-deep: #00131E;
        --forest: #001A29;
        --forest-dark: #000F17;
        --forest-card: #002336;
        --green: #39A900;
        --green-dark: #2a7c00;
        --green-active: #39A900;
        --green-light: #62E31D;
        --green-soft: #EAF7EE;
        --green-soft-border: #BBF7D0;
        --green-badge: #dcfce7;
        --green-badge-text: #166534;
        --moss: #62E31D;
        --bg: #F4F7F6;
        --card: #FFFFFF;
        --ink: #00131E;
        --ink-soft: #5A6E7D;
        --ink-muted: #8B9FA9;
        --line: #E2E8F0;
        --line-subtle: #EEF2F6;
        --gold: #D9A441;
        --shadow-sm: 0 1px 3px rgba(0, 19, 30, 0.05);
        --shadow-md: 0 4px 14px rgba(0, 19, 30, 0.07);
        --shadow-lg: 0 10px 28px rgba(0, 19, 30, 0.12);
        --transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
      }

      @view-transition {
        navigation: auto;
      }

      * { box-sizing: border-box; }
      html, body { margin: 0; padding: 0; }

      body {
        font-family: 'Poppins', 'Nunito', sans-serif !important;
        background: var(--bg);
        color: var(--ink);
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
      }

      body, button, input, select, textarea, .sidebar, .topbar, .font-editorial, h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', 'Nunito', sans-serif !important;
      }

      .app {
        display: grid;
        grid-template-columns: 260px 1fr;
        min-height: 100vh;
      }

      /* ---------------- SIDEBAR ---------------- */
      .sidebar {
        view-transition-name: sige-sidebar;
        background: linear-gradient(180deg, var(--sena-navy) 0%, var(--sena-dark) 100%);
        color: #ffffff;
        display: flex;
        flex-direction: column;
        padding: 22px 16px;
        border-right: 1px solid rgba(255, 255, 255, 0.08);
        position: sticky;
        top: 0;
        height: 100vh;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
      }
      .sidebar::-webkit-scrollbar {
        display: none;
      }

      .brand {
        view-transition-name: sige-brand;
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
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-weight: 800;
        font-size: 16px;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .brand-tag {
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-size: 9px;
        font-weight: 800;
        background: var(--green);
        color: #ffffff;
        padding: 2px 7px;
        border-radius: 999px;
      }
      .brand-sub {
        font-size: 10.5px;
        color: #62E31D;
        font-weight: 600;
        letter-spacing: 0.3px;
        text-transform: uppercase;
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
        padding: 11px 14px;
        border-radius: 12px;
        color: rgba(255, 255, 255, 0.82);
        text-decoration: none;
        font-size: 13.5px;
        font-weight: 600;
        margin-bottom: 4px;
        transition: all 0.15s ease;
      }
      nav a i, nav a svg {
        width: 18px;
        font-size: 15px;
        text-align: center;
        flex-shrink: 0;
      }
      nav a:hover {
        background: rgba(255, 255, 255, 0.08);
        color: #ffffff;
      }
      nav a.active {
        background: linear-gradient(135deg, var(--sena-green) 0%, #2e8b00 100%);
        color: #ffffff;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35);
      }
      nav a.active i, nav a.active svg {
        color: #ffffff;
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
        background: rgba(0, 0, 0, 0.25);
        color: #ffffff;
      }

      /* ---------------- MAIN ---------------- */
      .main {
        display: flex;
        flex-direction: column;
        min-width: 0;
      }

      .topbar {
        background: linear-gradient(135deg, var(--sena-dark) 0%, var(--sena-navy) 100%);
        border-bottom: 2px solid var(--sena-green);
        box-shadow: 0 4px 14px rgba(0, 19, 30, 0.15);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 64px;
        padding: 0 36px;
        position: sticky;
        top: 0;
        z-index: 50;
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
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-weight: 700;
        font-size: 12px;
      }

      /* ---------------- CONTENT ---------------- */
      .content {
        padding: 32px 36px 48px;
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
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-weight: 700;
        font-size: 26px;
        margin: 0 0 6px;
        color: var(--forest-deep);
        letter-spacing: -0.3px;
      }
      .page-title span {
        color: var(--sena-green);
      }
      .page-desc {
        font-size: 14px;
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
        color: var(--sena-green);
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
        box-shadow: 0 4px 14px rgba(0, 19, 30, 0.03);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
      }
      .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(0, 19, 30, 0.08);
        border-color: rgba(57, 169, 0, 0.4);
      }

      .stat-top {
        display: flex;
        align-items: center;
        gap: 12px;
      }
      .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--green-soft);
        color: var(--sena-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
        transition: transform 0.2s ease;
      }
      .stat-card:hover .stat-icon {
        transform: scale(1.08);
      }
      .stat-icon.green   { background: #EAF7EE; color: var(--sena-green); }
      .stat-icon.blue    { background: #E0F2FE; color: #0284c7; }
      .stat-icon.emerald { background: #DCFCE7; color: #166534; }
      .stat-icon.amber   { background: #FEF3C7; color: #d97706; }
      .stat-icon.purple  { background: #F3E8FF; color: #9333ea; }
      .stat-icon.cyan    { background: #E0F7FA; color: #00838f; }

      .stat-title {
        font-size: 13.5px;
        color: var(--ink-soft);
        font-weight: 600;
      }
      .stat-value {
        font-family: 'Poppins', 'Nunito', sans-serif;
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
        color: var(--sena-green);
        display: flex;
        align-items: center;
        gap: 5px;
      }
      .stat-trend.down {
        color: #dc2626;
      }
      .stat-link {
        font-size: 12.5px;
        color: var(--sena-dark);
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: color 0.15s ease;
      }
      .stat-link:hover {
        color: var(--sena-green);
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
        box-shadow: 0 4px 14px rgba(0, 19, 30, 0.03);
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
        font-family: 'Poppins', 'Nunito', sans-serif;
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
        background: var(--line);
        border-radius: 20px;
        overflow: hidden;
      }
      .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--sena-green) 0%, var(--sena-neon) 100%);
        border-radius: 20px;
        transition: width 1s ease-in-out;
      }

      @media (max-width: 768px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .lower-grid { grid-template-columns: 1fr; }
      }
      @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
        .content { padding: 24px 18px 36px; }
        .topbar { padding: 0 18px; }
      }
    
      /* Modal Bloqueante SOFIA PLUS Institucional SENA ERP */
      .modal-sofia-blocking {
        position: fixed !important;
        inset: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: radial-gradient(circle at center, rgba(0, 35, 54, 0.96) 0%, rgba(0, 19, 30, 0.98) 100%) !important;
        backdrop-filter: blur(14px) !important;
        -webkit-backdrop-filter: blur(14px) !important;
        z-index: 999999 !important;
        display: none;
        align-items: flex-start !important;
        justify-content: center !important;
        padding: 20px 14px !important;
        overflow-y: auto !important;
        -webkit-overflow-scrolling: touch !important;
      }
      .modal-sofia-blocking.active {
        display: flex !important;
        opacity: 1 !important;
        pointer-events: auto !important;
      }
      .sofia-card-container {
        max-width: 580px !important;
        width: 100% !important;
        background: #FFFFFF !important;
        border-radius: 18px !important;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(98, 227, 29, 0.35) !important;
        border-top: 5px solid #39A900 !important;
        display: flex !important;
        flex-direction: column !important;
        max-height: calc(100vh - 40px) !important;
        overflow: hidden !important;
        transform: scale(1) !important;
        transition: transform 0.2s ease !important;
        margin: auto 0 !important;
      }
      .sofia-card-scrollable {
        overflow-y: auto !important;
        max-height: calc(100vh - 140px) !important;
        padding: 18px 24px 20px 24px !important;
      }
      .sofia-card-scrollable::-webkit-scrollbar {
        width: 6px;
      }
      .sofia-card-scrollable::-webkit-scrollbar-thumb {
        background: #CBD5E1;
        border-radius: 4px;
      }
      .sofia-shake {
        animation: shakeCard 0.4s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
      }
      @keyframes shakeCard {
        10%, 90% { transform: translate3d(-2px, 0, 0); }
        20%, 80% { transform: translate3d(3px, 0, 0); }
        30%, 50%, 70% { transform: translate3d(-5px, 0, 0); }
        40%, 60% { transform: translate3d(5px, 0, 0); }
      }
      .sofia-user-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 10px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        margin-bottom: 14px;
      }
      .sofia-user-item {
        display: flex;
        flex-direction: column;
      }
      .sofia-user-item .label {
        font-size: 10.5px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 2px;
      }
      .sofia-user-item .val {
        font-size: 13px;
        font-weight: 800;
        color: #00131E;
        word-break: break-all;
      }
      .input-password-wrapper {
        position: relative;
        display: flex;
        align-items: center;
      }
      .btn-toggle-eye {
        position: absolute;
        right: 12px;
        background: transparent;
        border: none;
        color: #94A3B8;
        cursor: pointer;
        font-size: 14px;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .btn-toggle-eye:hover { color: #39A900; }
      .btn-sofia-submit {
        width: 100%;
        background: linear-gradient(135deg, #39A900 0%, #206600 100%);
        color: #FFFFFF;
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-size: 13px;
        font-weight: 800;
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.5px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(57, 169, 0, 0.4);
        transition: all 0.2s ease;
      }
      .btn-sofia-submit:hover {
        background: linear-gradient(135deg, #43be04 0%, #298500 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(57, 169, 0, 0.5);
      }
      .pwd-match-status.ok { color: #166534; font-weight: 700; }
      .pwd-match-status.err { color: #DC2626; font-weight: 700; }
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
        </div>
        <div class="brand-sub">GESTIÓN DE EGRESADOS</div>
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
      <a href="{{ route('egresados.instructores') }}">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Instructores</span>
      </a>
      <a href="{{ route('egresados.superadmin.encuestas.index') }}">
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
      <a href="{{ route('egresados.noticias') }}">
        <i class="fa-solid fa-newspaper"></i>
        <span>Noticias</span>
      </a>
    </nav>
  </aside>

  <!-- MAIN VIEWPORT -->
  <div class="main">
    
    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-left"></div>

      @include('egresados::superadmin.partials._topbar_right')
    </div>

    <!-- Main Content -->
    <div class="content">
      
      <!-- Page Head -->
      <div class="page-head">
        <div>
          <h1 class="page-title">
            ¡Bienvenido(a), <span>Super Admin</span>!
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
            <div class="stat-icon green">
              <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div class="stat-title">Total egresados</div>
          </div>
          <div class="stat-value">
            {{ number_format($totalEgresados ?? 0) }}
          </div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-arrow-trend-up"></i>
              <span>↑ Registros en sistema</span>
            </div>
            <a href="{{ route('egresados.index') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 2: Instructores -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon blue">
              <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div class="stat-title">Instructores</div>
          </div>
          <div class="stat-value">
            {{ number_format($totalInstructores ?? 0) }}
          </div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-circle-check"></i>
              <span>Registrados en sistema</span>
            </div>
            <a href="{{ route('egresados.instructores') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 3: Encuestas -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon amber">
              <i class="fa-solid fa-clipboard-question"></i>
            </div>
            <div class="stat-title">Encuestas</div>
          </div>
          <div class="stat-value">{{ number_format($totalEncuestas ?? 5) }}</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-circle-check"></i>
              <span>Creadas en sistema</span>
            </div>
            <a href="{{ route('egresados.encuestas_superadmin') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 5: Eventos Programados -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon purple">
              <i class="fa-regular fa-calendar-check"></i>
            </div>
            <div class="stat-title">Eventos programados</div>
          </div>
          <div class="stat-value">{{ number_format($totalEventos ?? 5) }}</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-bullhorn"></i>
              <span>Próximos eventos</span>
            </div>
            <a href="{{ route('egresados.eventos') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 6: Reportes Generados -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon cyan">
              <i class="fa-solid fa-file-invoice"></i>
            </div>
            <div class="stat-title">Reportes generados</div>
          </div>
          <div class="stat-value">{{ number_format($totalReportes ?? 5) }}</div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-file-circle-check"></i>
              <span>Generados en módulo</span>
            </div>
            <a href="{{ route('egresados.reportes') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- Lower Grid: Actividad Reciente + Avance por Programa -->
      <div class="lower-grid">
        
        <!-- Panel Izquierdo: Actividad Reciente Dinámica -->
        <div class="panel">
          <div class="panel-head">
            <h3 class="panel-title">
              <i class="fa-solid fa-bolt text-[#39A900]"></i>
              <span>Actividad reciente</span>
            </h3>
            <a href="{{ route('egresados.index') }}" class="panel-action">Ver todo</a>
          </div>

          @forelse($recentEgresados as $item)
            @php
              $p = $item->person;
              $fullName = $p ? trim($p->first_name . ' ' . $p->first_last_name) : 'Aprendiz SENA';
              $progName = $item->course && $item->course->program ? $item->course->program->name : 'Formación SENA';
              $isUpdated = $item->updated_at && $item->created_at && ($item->updated_at->timestamp > $item->created_at->timestamp + 60);
              $timeDiff = $item->updated_at ? $item->updated_at->diffForHumans() : ($item->created_at ? $item->created_at->diffForHumans() : 'Recientemente');
            @endphp
            <div class="activity-row">
              <div class="activity-dot" style="{{ $isUpdated ? 'background:#e0f2fe; color:#0284c7;' : 'background:#dcfce7; color:#166534;' }}">
                <i class="fa-solid {{ $isUpdated ? 'fa-user-pen' : 'fa-user-plus' }}"></i>
              </div>
              <div style="flex:1;">
                <div class="activity-text">
                  @if($isUpdated)
                    Se actualizaron los datos de <b>{{ $fullName }}</b> ({{ $progName }})
                  @else
                    Nuevo egresado registrado: <b>{{ $fullName }}</b> ({{ $progName }})
                  @endif
                </div>
                <div class="activity-time flex items-center gap-2">
                  <span>{{ $timeDiff }}</span>
                  <span style="font-size:10px; padding:1px 6px; border-radius:999px; background:rgba(0,19,30,0.06); font-weight:600;">{{ $item->apprentice_status }}</span>
                </div>
              </div>
            </div>
          @empty
            <div style="text-align:center; padding: 28px 16px; color: var(--ink-soft); font-size:13px;">
              <i class="fa-regular fa-clock" style="font-size:24px; margin-bottom:8px; display:block; opacity:0.4;"></i>
              No hay actividades registradas recientemente.
            </div>
          @endforelse
        </div>

        <!-- Panel Derecho: Avance por Programa -->
        <div class="panel">
          <div class="panel-head">
            <h3 class="panel-title">
              <i class="fa-solid fa-chart-simple text-[#39A900]"></i>
              <span>Avance por programa</span>
            </h3>
          </div>

          @php
            $maxCount = (isset($programStats) && $programStats->count() > 0) ? $programStats->max('total') : 1;
            if ($maxCount <= 0) $maxCount = 1;
          @endphp

          @if(isset($programStats) && $programStats->count() > 0)
            @foreach($programStats as $prog)
              @php
                $pct = round(($prog->total / $maxCount) * 100);
              @endphp
              <div class="progress-item">
                <div class="progress-label">
                  <span>{{ $prog->name }}</span>
                  <span>{{ $prog->total }} egresado{{ $prog->total != 1 ? 's' : '' }} ({{ $pct }}%)</span>
                </div>
                <div class="progress-track">
                  <div class="progress-fill" style="width: {{ $pct }}%"></div>
                </div>
              </div>
            @endforeach
          @else
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
          @endif
        </div>

      </div>

    </div>
  </div>

</div>


<!-- ========================================================
     MODAL BLOQUEANTE TIPO SOFIA PLUS: CAMBIO OBLIGATORIO DE CONTRASEÑA (COLORES ERP)
     ======================================================== -->
<div class="modal-backdrop @if(!empty($debeActualizarPassword)) active @endif modal-sofia-blocking" id="modalActualizarPasswordInicial" onclick="shakeSofiaModal(event)">
  <div class="modal-box-card sofia-card-container" id="sofiaPasswordCard" onclick="event.stopPropagation()">
    
    <!-- Encabezado Institucional estilo SOFIA PLUS con Colores ERP -->
    <div style="background: linear-gradient(135deg, #00131E 0%, #002336 100%); padding: 18px 24px; color: #fff; position: relative; border-bottom: 3px solid #39A900; flex-shrink: 0;">
      <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 6px;">
        <div style="display: inline-flex; align-items: center; gap: 8px;">
          <div style="width: 28px; height: 28px; border-radius: 8px; background: rgba(57,169,0,0.2); border: 1px solid #62E31D; display: flex; align-items: center; justify-content: center; color: #62E31D; font-size: 13px;">
            <i class="fa-solid fa-shield-halved"></i>
          </div>
          <span style="font-size: 10.5px; font-weight: 800; color: #62E31D; letter-spacing: 0.6px; text-transform: uppercase;">
            SISTEMA SIGE ERP · CEFA LA ANGOSTURA
          </span>
        </div>
        <span style="background: rgba(220, 38, 38, 0.25); border: 1px solid #EF4444; color: #FCA5A5; font-size: 9.5px; font-weight: 800; padding: 2.5px 9px; border-radius: 999px; text-transform: uppercase; letter-spacing: 0.5px;">
          <i class="fa-solid fa-lock"></i> OBLIGATORIO
        </span>
      </div>

      <h2 style="font-family: 'Poppins', 'Nunito', sans-serif; font-size: 18px; font-weight: 800; color: #FFFFFF; margin: 0 0 2px 0; letter-spacing: -0.3px;">
        CAMBIO OBLIGATORIO DE CONTRASEÑA
      </h2>
      <p style="font-size: 11.5px; color: rgba(255, 255, 255, 0.85); margin: 0; line-height: 1.35;">
        Requerimiento de seguridad institucional de primer ingreso al sistema (estilo SOFIA Plus).
      </p>
    </div>

    <!-- Formulario de Actualización de Contraseña -->
    <form id="formActualizarPasswordInicial" action="{{ route('egresados.cambiar_password') }}" method="POST" onsubmit="submitActualizarPasswordInicial(event)" style="display:flex; flex-direction:column; overflow:hidden; margin:0;">
      @csrf

      <div class="sofia-card-scrollable">
        <!-- Banner de Advertencia Sofia Plus -->
        <div style="background: linear-gradient(135deg, #F0FDF4 0%, #EAF7EE 100%); border: 1px solid #BBF7D0; border-left: 4px solid #39A900; border-radius: 10px; padding: 10px 14px; margin-bottom: 12px; color: #166534; font-size: 11.5px; line-height: 1.4; display: flex; gap: 10px; align-items: flex-start;">
          <i class="fa-solid fa-circle-exclamation" style="font-size: 15px; color: #39A900; margin-top: 2px; flex-shrink: 0;"></i>
          <div>
            <strong style="color: #00131E; font-size: 12px; display: block; margin-bottom: 2px;">
              Aviso de Seguridad de Primer Ingreso:
            </strong>
            Por políticas institucionales del SENA, al ingresar con tu documento como clave inicial, debes actualizar tu contraseña personal. <strong>No podrás avanzar hasta completar este paso.</strong>
          </div>
        </div>

        <!-- Ficha de Identificación del Usuario -->
        <div class="sofia-user-grid">
          <div class="sofia-user-item">
            <span class="label"><i class="fa-solid fa-hashtag" style="color: #39A900;"></i> Documento de Identificación:</span>
            <span class="val" style="color: #39A900; font-size: 13px;">
              {{ Auth::check() && Auth::user()->person ? Auth::user()->person->document_number : (preg_replace('/\D/', '', Auth::user()->nickname ?? '') ?: 'Documento Registrado') }}
            </span>
          </div>
          <div class="sofia-user-item">
            <span class="label"><i class="fa-solid fa-user-check" style="color: #39A900;"></i> Titular de la Cuenta:</span>
            <span class="val" style="font-size: 12px;">
              {{ Auth::check() && Auth::user()->person ? (Auth::user()->person->first_name . ' ' . Auth::user()->person->first_last_name) : (Auth::user()->name ?? 'Usuario(a) CEFA') }}
            </span>
          </div>
        </div>

        <!-- Mensajes de Alerta -->
        <div id="alert-password-error" style="display:none; background:#FEF2F2; border:1px solid #FCA5A5; color:#991B1B; padding:10px 14px; border-radius:10px; font-size:12px; margin-bottom:12px; font-weight:600;"></div>
        <div id="alert-password-success" style="display:none; background:#F0FDF4; border:1px solid #BBF7D0; color:#166534; padding:10px 14px; border-radius:10px; font-size:12px; margin-bottom:12px; font-weight:700;"></div>

        <!-- 1. Contraseña Anterior -->
        <div style="margin-bottom:12px;">
          <label for="pwd_current_password" style="display:block; font-size:11.5px; font-weight:700; color:#00131E; margin-bottom:5px;">
            <i class="fa-solid fa-lock" style="color:#39A900; margin-right:4px;"></i> Contraseña Anterior / Inicial (Tu Documento Actual) <span style="color:#EF4444;">*</span>
          </label>
          <div class="input-password-wrapper">
            <input type="password" id="pwd_current_password" name="current_password" 
                   value="{{ Auth::check() && Auth::user()->person ? Auth::user()->person->document_number : (preg_replace('/\D/', '', Auth::user()->nickname ?? '') ?: '') }}"
                   placeholder="Ingresa tu documento (clave inicial)" required style="width:100%; border:1px solid #CBD5E1; border-radius:9px; padding:9px 40px 9px 12px; font-size:13px; font-family:inherit;">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('pwd_current_password', this)" title="Ver u ocultar contraseña">
              <i class="fa-regular fa-eye"></i>
            </button>
          </div>
        </div>

        <!-- 2. Nueva Contraseña -->
        <div style="margin-bottom:12px;">
          <label for="pwd_new_password" style="display:block; font-size:11.5px; font-weight:700; color:#00131E; margin-bottom:5px;">
            <i class="fa-solid fa-key" style="color:#39A900; margin-right:4px;"></i> Nueva Contraseña Personal <span style="color:#EF4444;">*</span>
          </label>
          <div class="input-password-wrapper">
            <input type="password" id="pwd_new_password" name="new_password" 
                   placeholder="Escribe tu nueva contraseña (mínimo 6 caracteres)" required minlength="6" oninput="checkPasswordMatch()"
                   style="width:100%; border:1px solid #CBD5E1; border-radius:9px; padding:9px 40px 9px 12px; font-size:13px; font-family:inherit;">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('pwd_new_password', this)" title="Ver u ocultar contraseña">
              <i class="fa-regular fa-eye"></i>
            </button>
          </div>
        </div>

        <!-- 3. Confirmar Nueva Contraseña -->
        <div style="margin-bottom:12px;">
          <label for="pwd_new_password_confirmation" style="display:block; font-size:11.5px; font-weight:700; color:#00131E; margin-bottom:5px;">
            <i class="fa-solid fa-circle-check" style="color:#39A900; margin-right:4px;"></i> Confirmar Nueva Contraseña <span style="color:#EF4444;">*</span>
          </label>
          <div class="input-password-wrapper">
            <input type="password" id="pwd_new_password_confirmation" name="new_password_confirmation" 
                   placeholder="Vuelve a escribir exactamente tu nueva contraseña" required minlength="6" oninput="checkPasswordMatch()"
                   style="width:100%; border:1px solid #CBD5E1; border-radius:9px; padding:9px 40px 9px 12px; font-size:13px; font-family:inherit;">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('pwd_new_password_confirmation', this)" title="Ver u ocultar contraseña">
              <i class="fa-regular fa-eye"></i>
            </button>
          </div>
          <div id="pwdMatchStatus" class="pwd-match-status" style="display:none; font-size:11px; margin-top:4px;"></div>
        </div>

        <!-- Requisitos mínimos -->
        <div style="margin-bottom: 16px; background:#F8FAFC; border:1px solid #E2E8F0; border-radius:8px; padding:8px 12px;">
          <strong style="color:#00131E; font-size:11px; display:inline-flex; align-items:center; gap:5px;">
            <i class="fa-solid fa-list-check" style="color:#39A900;"></i> Requisitos mínimos:
          </strong>
          <span style="font-size:11px; color:#475569; margin-left:6px;">
            Mínimo 6 caracteres · Distinta a tu documento · Deben coincidir.
          </span>
        </div>

        <!-- Botón Principal Sofia Plus -->
        <div style="margin-bottom: 12px;">
          <button type="submit" id="btn-submit-password-inicial" class="btn-sofia-submit">
            <i class="fa-solid fa-key"></i>
            <span>CAMBIAR CONTRASEÑA Y CONTINUAR</span>
          </button>
        </div>

        <!-- Enlace para salir -->
        <div style="text-align: center; margin-top: 4px;">
          <span style="font-size: 11px; color: #64748B;">¿No deseas cambiar tu clave ahora?</span>
          <a href="{{ route('egresados.logout') }}" style="font-size: 11px; color: #DC2626; font-weight: 700; text-decoration: none; margin-left: 6px;">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión
          </a>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  function shakeSofiaModal(e) {
    if (e) {
      e.preventDefault();
      e.stopPropagation();
    }
    const card = document.getElementById('sofiaPasswordCard');
    if (card) {
      card.classList.remove('sofia-shake');
      void card.offsetWidth;
      card.classList.add('sofia-shake');
    }
    const errBox = document.getElementById('alert-password-error');
    if (errBox) {
      errBox.innerHTML = '<i class="fa-solid fa-lock"></i> Por seguridad institucional (tipo SOFIA Plus), el cambio de contraseña es obligatorio para continuar.';
      errBox.style.display = 'block';
    }
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      const modal = document.getElementById('modalActualizarPasswordInicial');
      if (modal && modal.classList.contains('active')) {
        e.preventDefault();
        shakeSofiaModal();
      }
    }
  });

  function openModalActualizarPasswordInicial() {
    const modal = document.getElementById('modalActualizarPasswordInicial');
    if (modal) {
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
      const errBox = document.getElementById('alert-password-error');
      const sucBox = document.getElementById('alert-password-success');
      if (errBox) errBox.style.display = 'none';
      if (sucBox) sucBox.style.display = 'none';
      setTimeout(() => {
        const newPwdInput = document.getElementById('pwd_new_password');
        if (newPwdInput) newPwdInput.focus();
      }, 200);
    }
  }

  function closeModalActualizarPasswordInicial() {
    const modal = document.getElementById('modalActualizarPasswordInicial');
    if (modal) modal.classList.remove('active');
    document.body.style.overflow = '';
  }

  function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    if (!input) return;
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
      input.type = 'text';
      if (icon) { icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
    } else {
      input.type = 'password';
      if (icon) { icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
    }
  }

  function checkPasswordMatch() {
    const p1 = document.getElementById('pwd_new_password');
    const p2 = document.getElementById('pwd_new_password_confirmation');
    const status = document.getElementById('pwdMatchStatus');
    if (!p1 || !p2 || !status) return;
    if (!p2.value) { status.style.display = 'none'; return; }
    status.style.display = 'flex';
    if (p1.value === p2.value) {
      status.className = 'pwd-match-status ok';
      status.innerHTML = '<i class="fa-solid fa-check-circle"></i> Las contraseñas coinciden';
    } else {
      status.className = 'pwd-match-status err';
      status.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> Las contraseñas no coinciden aún';
    }
  }

  function submitActualizarPasswordInicial(e) {
    e.preventDefault();
    const form = document.getElementById('formActualizarPasswordInicial');
    const btn = document.getElementById('btn-submit-password-inicial');
    const errBox = document.getElementById('alert-password-error');
    const sucBox = document.getElementById('alert-password-success');

    const curVal = document.getElementById('pwd_current_password').value.trim();
    const newVal = document.getElementById('pwd_new_password').value.trim();
    const confVal = document.getElementById('pwd_new_password_confirmation').value.trim();

    if (!curVal || newVal.length < 6 || newVal !== confVal || newVal === curVal) {
      errBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Verifica que la clave actual sea tu documento, que la nueva tenga mínimo 6 caracteres y que coincidan.';
      errBox.style.display = 'block';
      errBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      return;
    }

    errBox.style.display = 'none';
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Actualizando y continuando...';

    fetch("{{ route('egresados.cambiar_password') }}", {
      method: 'POST',
      body: new FormData(form),
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    })
    .then(res => res.json().then(data => ({ status: res.status, ok: res.ok, data })))
    .then(({ status, ok, data }) => {
      btn.disabled = false;
      btn.innerHTML = originalText;

      if (!ok || !data.success) {
        errBox.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> ' + (data.message || 'Error al actualizar contraseña.');
        errBox.style.display = 'block';
        return;
      }

      sucBox.innerHTML = '<i class="fa-solid fa-circle-check"></i> ' + data.message + ' Redirigiendo...';
      sucBox.style.display = 'block';

      setTimeout(() => {
        closeModalActualizarPasswordInicial();
        window.location.reload();
      }, 1200);
    })
    .catch(err => {
      btn.disabled = false;
      btn.innerHTML = originalText;
      errBox.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Ocurrió un error inesperado al procesar la solicitud.';
      errBox.style.display = 'block';
    });
  }

  @if(!empty($debeActualizarPassword))
  document.addEventListener('DOMContentLoaded', function() {
    document.body.style.overflow = 'hidden';
  });
  @endif
</script>
</body>
</html>
