<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <title>SIGE · Gestión de Egresados — Instructor CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Poppins & Nunito (Tipografía Institucional SENA Empresa ERP) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS & Alpine.js CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

      /* ---------------- SIDEBAR INSTITUCIONAL ---------------- */
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
        font-family: 'Poppins', 'Nunito', sans-serif !important;
        font-weight: 800;
        font-size: 16px;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 6px;
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

      nav {
        display: flex;
        flex-direction: column;
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
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
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
        background: linear-gradient(135deg, var(--sena-green, #39A900) 0%, #2e8b00 100%);
        color: #ffffff;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35);
      }
      nav a.active i, nav a.active svg {
        color: #ffffff;
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
        background: rgba(0, 0, 0, 0.25);
        color: #ffffff;
      }

      /* ---------------- MAIN VIEWPORT ---------------- */
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
        padding: 0 36px;
        height: 64px;
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

      /* Stat cards (Idéntico a Inicio en Dashboard) */
      .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
      }
      .stat-card {
        background: var(--card);
        border-radius: 16px;
        padding: 22px 22px 18px;
        border: 1px solid var(--line);
        display: flex;
        flex-direction: column;
        gap: 12px;
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
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-weight: 700;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(1, 56, 25, 0.15);
      }
      .detail-user-name {
        font-family: 'Poppins', 'Nunito', sans-serif;
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

      .btn-edit-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #ffffff;
        color: var(--forest);
        border: 1.5px solid var(--line);
        padding: 10px 18px;
        border-radius: 12px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .btn-edit-action:hover {
        background: #F8FAFC;
        border-color: var(--forest);
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
        background: rgba(57, 169, 0, 0.2);
        color: var(--green-dark);
      }

      /* Pagination wrapper */
      .pagination-wrap {
        padding: 16px 20px;
        border-top: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #FAFCF9;
      }

      @media (max-width: 768px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .content { padding: 20px 16px 36px; }
      }

      [x-cloak] { display: none !important; }
    </style>
</head>
<body x-data="{ 
    openModal: false, 
    openModalSeguimiento: false, 
    openModalImportar: false, 
    openModalEditar: false, 
    openModalPerfilEgresado: false,
    openModalToggleStatus: false,
    toggleModalTitle: '¿Desactivar Egresado?',
    toggleModalMessage: '',
    toggleModalConfirmText: 'Sí, Desactivar',
    toggleModalConfirmIcon: 'fa-solid fa-user-xmark',
    toggleModalIsActive: true,
    openSuccessModal: {{ session('success') ? 'true' : 'false' }},
    openErrorModal: {{ session('error') ? 'true' : 'false' }}
}" @open-toggle-modal.window="
    openModalToggleStatus = true;
    toggleModalTitle = $event.detail.title;
    toggleModalMessage = $event.detail.message;
    toggleModalConfirmText = $event.detail.confirmText;
    toggleModalConfirmIcon = $event.detail.confirmIcon;
    toggleModalIsActive = $event.detail.isActive;
">

<div class="app">

  <!-- ============================================== -->
  <!-- 1. SIDEBAR INSTITUCIONAL INSTRUCTOR -->
  <!-- ============================================== -->
  <aside class="sidebar">
    <a href="{{ route('egresados.welcome') }}" class="brand">
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
      <a href="{{ route('egresados.instructor.dashboard') }}">
        <i class="fa-solid fa-gauge-high"></i>
        <span>Inicio</span>
      </a>
      <a href="{{ route('egresados.instructor.directorio') }}" class="active">
        <i class="fa-solid fa-user-graduate"></i>
        <span>Egresados</span>
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
      <a href="{{ route('egresados.instructor.noticias.index') }}">
        <i class="fa-solid fa-newspaper"></i>
        <span>Noticias</span>
      </a>
    </nav>
  </aside>

  <!-- ============================================== -->
  <!-- 2. MAIN VIEWPORT -->
  <!-- ============================================== -->
  <div class="main">
    
    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-left"></div>

      @include('egresados::superadmin.partials._topbar_right')
    </div>

    <!-- Main Content -->
    <div class="content space-y-6">

      <!-- Header de la Página y Botón Nuevo Egresado -->
      <div class="page-head">
        <div>
          <h1 class="page-title">
            Gestión de <span>Egresados</span>
          </h1>
          <p class="page-desc">Consulta, seguimiento y actualización de información de egresados institucionales del CEFA.</p>
        </div>

        <div class="flex items-center gap-3">
          <button @click="openModal = true" 
                  type="button" 
                  class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs sm:text-sm font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 hover:shadow-lg hover:-translate-y-0.5 cursor-pointer">
            <i class="fa-solid fa-plus mr-2 text-xs"></i>
            <span>Nuevo Egresado</span>
          </button>
        </div>
      </div>

      <!-- 1. Estadísticas Superiores (4 Cards · Paleta SENA ERP) -->
      <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        
        <!-- Metric 1: Total Egresados -->
        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs sm:text-[13px] font-bold text-gray-500 uppercase tracking-wider">Total Egresados</span>
            <span class="w-10 h-10 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-sm shadow-xs">
              <i class="fa-solid fa-user-graduate"></i>
            </span>
          </div>
          <div class="text-3xl sm:text-4xl font-extrabold text-[#00131E] my-1">{{ number_format($totalEgresados ?? 0) }}</div>
          <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
              En base de datos
            </span>
          </div>
        </div>

        <!-- Metric 2: Egresados Activos -->
        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs sm:text-[13px] font-bold text-gray-500 uppercase tracking-wider">Egresados Activos</span>
            <span class="w-10 h-10 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-sm shadow-xs">
              <i class="fa-solid fa-user-check"></i>
            </span>
          </div>
          <div class="text-3xl sm:text-4xl font-extrabold text-[#00131E] my-1">{{ number_format($totalActivos ?? $totalEgresados) }}</div>
          <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
              <span class="w-1.5 h-1.5 rounded-full bg-[#39A900] mr-1.5 animate-pulse"></span>
              Habilitados en SIGE
            </span>
          </div>
        </div>

        <!-- Metric 3: Egresados Inactivos -->
        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs sm:text-[13px] font-bold text-gray-500 uppercase tracking-wider">Egresados Inactivos</span>
            <span class="w-10 h-10 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-sm shadow-xs">
              <i class="fa-solid fa-user-xmark"></i>
            </span>
          </div>
          <div class="text-3xl sm:text-4xl font-extrabold text-[#00131E] my-1">{{ number_format($totalInactivos ?? 0) }}</div>
          <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
              Desactivados
            </span>
          </div>
        </div>

        <!-- Metric 4: Programas SENA -->
        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs sm:text-[13px] font-bold text-gray-500 uppercase tracking-wider">Programas</span>
            <span class="w-10 h-10 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-sm shadow-xs">
              <i class="fa-solid fa-graduation-cap"></i>
            </span>
          </div>
          <div class="text-3xl sm:text-4xl font-extrabold text-[#00131E] my-1">{{ number_format($totalProgramas ?? 4216) }}</div>
          <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
              Programas CEFA
            </span>
          </div>
        </div>

      </div>

      <!-- Grilla Principal (Tabla 2/3 + Detalle Lateral 1/3) -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- Columna Izquierda: Filtros y Tabla de Egresados (2/3) -->
        <div class="lg:col-span-2 space-y-4">
          
          <!-- Card de Filtros Interactivos -->
          <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs space-y-3.5">
            <div class="flex items-center justify-between pb-2 border-b border-gray-50">
              <span class="text-xs font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-1.5">
                <i class="fa-solid fa-sliders text-[#39A900]"></i>
                Filtros de Búsqueda Rápida
              </span>
              <span class="text-[11px] text-gray-400">Filtrado en tiempo real</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
              <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">Programa</label>
                <select id="filterPrograma" onchange="filterDirectorioLive()" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-700 focus:bg-white focus:border-[#39A900] outline-none transition">
                  <option value="">Todos los programas</option>
                  @foreach($programs as $prog)
                    <option value="{{ mb_strtoupper($prog->name) }}" {{ request('programa') == $prog->name ? 'selected' : '' }}>{{ $prog->name }}</option>
                  @endforeach
                </select>
              </div>

              <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">Estado</label>
                <select id="filterEstado" onchange="filterDirectorioLive()" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-700 focus:bg-white focus:border-[#39A900] outline-none transition">
                  <option value="">Todos los estados</option>
                  <option value="ACTIVO">🟢 Activos en SIGE</option>
                  <option value="INACTIVO">🔴 Inactivos en SIGE</option>
                  <option value="CERTIFICADO">🎓 Certificados</option>
                  <option value="EN FORMACIÓN">En Formación</option>
                  <option value="CONDICIONADO">Condicionado</option>
                  <option value="INDUCCIÓN">Inducción</option>
                  <option value="CANCELADO">Cancelado</option>
                  <option value="RETIRO VOLUNTARIO">Retiro Voluntario</option>
                </select>
              </div>

              <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1.5">Buscar por Documento o Nombre</label>
                <div class="relative">
                  <input type="text" id="filterText" onkeyup="filterDirectorioLive()" value="{{ request('search') }}" placeholder="Buscar egresado..." 
                         class="w-full pl-9 pr-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] outline-none transition">
                  <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-xs sm:text-sm"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Card de Tabla Principal -->
          <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="p-4 sm:p-5 border-b border-gray-100 flex items-center justify-between">
              <div>
                <h3 class="text-xs sm:text-sm font-bold text-[#00131E] flex items-center gap-2">
                  <i class="fa-solid fa-users text-[#39A900]"></i>
                  Listado de Egresados Registrados
                </h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Haz clic en una fila para ver su desglose o gestionarla</p>
              </div>
              <div class="flex items-center gap-2.5">
                <a href="{{ route('egresados.instructor.directorio.exportar', request()->query()) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs font-bold rounded-xl transition shadow-xs">
                  <i class="fa-solid fa-file-excel"></i>
                  <span>Exportar Excel</span>
                </a>
                <span id="filteredCounter" class="text-xs font-semibold text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">
                  Mostrando {{ count($egresados) }} egresados
                </span>
              </div>
            </div>

            <!-- Tabla -->
            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse text-xs sm:text-sm">
                <thead>
                  <tr class="bg-[#FAFCF9] border-b border-gray-100 text-gray-500 font-bold uppercase tracking-wider text-xs">
                    <th class="py-3.5 px-4">Documento</th>
                    <th class="py-3.5 px-4">Egresado(a)</th>
                    <th class="py-3.5 px-4">Programa & Ficha</th>
                    <th class="py-3.5 px-4">Estado</th>
                  </tr>
                </thead>
                <tbody id="egresadosTableBody" class="divide-y divide-gray-100">
                  @forelse($egresados as $index => $item)
                    @php
                      $person = $item->person;
                      $course = $item->course;
                      $program = $course ? $course->program : null;
                      $fullName = $person ? ($person->first_name . ' ' . $person->first_last_name . ' ' . ($person->second_last_name ?? '')) : 'Aprendiz #' . $item->id;
                      
                      $words = explode(' ', trim($fullName));
                      $initials = '';
                      foreach(array_slice($words, 0, 2) as $w) {
                          if (!empty($w)) $initials .= mb_strtoupper(mb_substr($w, 0, 1));
                      }

                      $st = $item->apprentice_status ?? 'CERTIFICADO';
                      $pillClass = 'status-green';
                      if(in_array($st, ['EN FORMACIÓN', 'INDUCCIÓN'])) $pillClass = 'status-blue';
                      elseif(in_array($st, ['CANCELADO', 'RETIRO VOLUNTARIO'])) $pillClass = 'status-red';
                      elseif($st === 'CONDICIONADO') $pillClass = 'status-amber';

                      $docRaw = ($person && $person->document_number) ? (string)$person->document_number : '';
                      $emailRaw = ($person && ($person->personal_email || $person->misena_email)) ? ($person->personal_email ?: $person->misena_email) : '';
                      $phoneRaw = ($person && ($person->telephone1 || $person->telephone2)) ? (string)($person->telephone1 ?: $person->telephone2) : '';
                      $progRaw = ($program && $program->name) ? $program->name : '';
                      $codeRaw = ($course && $course->code) ? (string)$course->code : '';
                      $isApprenticeActive = !$item->trashed() && !in_array($st, ['CANCELADO', 'RETIRO VOLUNTARIO']);

                      $jsonData = json_encode([
                          'id' => $item->id,
                          'name' => $fullName,
                          'initials' => $initials ?: 'EG',
                          'document' => $docRaw ?: 'N/A',
                          'document_raw' => $docRaw,
                          'document_type' => $person->document_type ?? 'Cédula de ciudadanía',
                          'email' => $emailRaw ?: 'No registra correo',
                          'email_raw' => $emailRaw,
                          'phone' => $phoneRaw ?: 'No registra teléfono',
                          'phone_raw' => $phoneRaw,
                          'program' => $progRaw ?: 'Programa de Formación CEFA',
                          'program_raw' => $progRaw,
                          'code' => $codeRaw ?: 'N/A',
                          'code_raw' => $codeRaw,
                          'status' => $st,
                          'is_active' => $isApprenticeActive,
                          'pill_class' => $pillClass,
                          'show_url' => route('egresados.show', $item->id),
                      ]);
                    @endphp
                    <tr class="egresado-row cursor-pointer transition hover:bg-emerald-50/40 {{ $index === 0 ? 'bg-emerald-50/60 font-semibold' : '' }}" 
                        id="row-{{ $item->id }}"
                        data-json="{{ $jsonData }}"
                        data-program="{{ mb_strtoupper($progRaw) }}"
                        data-status="{{ mb_strtoupper($st) }}"
                        data-active="{{ $isApprenticeActive ? 'ACTIVO' : 'INACTIVO' }}"
                        data-search="{{ mb_strtolower($docRaw . ' ' . $fullName . ' ' . $emailRaw . ' ' . $progRaw) }}"
                        onclick="selectEgresadoFromElement(this)">
                        
                        <td class="py-3.5 px-4 font-bold text-sm text-[#00131E]">
                          {{ $person->document_number ?? 'N/A' }}
                        </td>

                        <td class="py-3.5 px-4">
                          <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-[#EAF7EE] text-[#00131E] font-bold text-xs flex items-center justify-center border border-[#BBF7D0] shrink-0">
                              {{ $initials ?: 'EG' }}
                            </div>
                            <div class="overflow-hidden">
                              <div class="font-bold text-gray-900 text-sm leading-tight truncate">{{ $fullName }}</div>
                              <div class="text-xs text-gray-400 truncate mt-0.5">{{ $person->misena_email ?? $person->personal_email ?? 'Sin correo' }}</div>
                            </div>
                          </div>
                        </td>

                        <td class="py-3.5 px-4">
                          <div class="font-semibold text-gray-800 text-sm leading-tight">{{ $program ? Str::limit($program->name, 28) : 'ADSO' }}</div>
                          <div class="text-xs text-gray-400 font-medium mt-0.5">Ficha: {{ $course->code ?? 'N/A' }}</div>
                        </td>

                        <td class="py-3.5 px-4">
                          <div class="flex flex-col gap-1 items-start">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold tracking-wide {{ $pillClass === 'status-green' ? 'bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]' : ($pillClass === 'status-blue' ? 'bg-blue-50 text-blue-700 border border-blue-200' : ($pillClass === 'status-red' ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-amber-50 text-amber-700 border border-amber-200')) }}">
                              {{ $st }}
                            </span>
                            @if($isApprenticeActive)
                              <span class="inline-flex items-center gap-1 text-xs font-bold text-[#166534]">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#39A900]"></span> Activo
                              </span>
                            @else
                              <span class="inline-flex items-center gap-1 text-xs font-bold text-red-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Inactivo
                              </span>
                            @endif
                          </div>
                        </td>

                    </tr>
                  @empty
                    <tr>
                      <td colspan="4" class="py-12 text-center text-gray-400">
                        <i class="fa-solid fa-user-slash text-3xl text-gray-300 mb-2 block"></i>
                        <p class="font-semibold text-gray-700 text-sm">No se encontraron egresados</p>
                        <p class="text-xs text-gray-400">Prueba cambiando los términos de búsqueda o filtros.</p>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <!-- Paginación -->
            @if($egresados->hasPages())
              <div class="p-4 border-t border-gray-100 bg-[#FAFCF9]">
                {{ $egresados->withQueryString()->links('egresados::partials.pagination') }}
              </div>
            @endif
          </div>

        </div>

        <!-- Columna Derecha: Panel de Detalle Rápido (1/3 - Sticky) -->
        <div class="lg:col-span-1 sticky top-20 space-y-4">
          <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
              <span class="text-xs font-bold uppercase tracking-wider text-gray-500 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#39A900] animate-pulse"></span>
                Detalle del Egresado
              </span>
              <div class="flex items-center gap-1.5">
                <span id="detailActivePill" class="px-2.5 py-1 rounded-full text-xs font-bold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">Activo</span>
                <span id="detailStatusPill" class="px-2.5 py-1 rounded-full text-xs font-bold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">CERTIFICADO</span>
              </div>
            </div>

            <!-- Hero del Usuario Seleccionado -->
            <div class="flex items-center gap-3.5">
              <div id="detailAvatarLarge" class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#001A29] to-[#39A900] text-white flex items-center justify-center font-bold text-xl shadow-sm shrink-0">
                EG
              </div>
              <div class="overflow-hidden">
                <div id="detailName" class="font-bold text-gray-900 text-base sm:text-lg leading-tight truncate">Selecciona un egresado</div>
                <div id="detailDoc" class="text-xs sm:text-sm text-gray-500 mt-0.5">Doc: ---</div>
                <div id="detailEmail" class="text-xs sm:text-sm font-semibold text-[#39A900] truncate mt-0.5">correo@sena.edu.co</div>
              </div>
            </div>

            <!-- Bloque Académico -->
            <div class="bg-gray-50/80 p-4 rounded-xl border border-gray-100 space-y-2.5">
              <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Información Académica</span>
              <div class="flex justify-between items-center text-xs sm:text-sm">
                <span class="text-gray-500 font-medium">Programa:</span>
                <span id="detailProgram" class="font-bold text-gray-800 text-right truncate max-w-[170px]">ADSO</span>
              </div>
              <div class="flex justify-between items-center text-xs sm:text-sm">
                <span class="text-gray-500 font-medium">Código Ficha:</span>
                <span id="detailCode" class="font-bold text-gray-800">3345643</span>
              </div>
              <div class="flex justify-between items-center text-xs sm:text-sm">
                <span class="text-gray-500 font-medium">Centro Formación:</span>
                <span class="font-bold text-gray-800">CEFA La Angostura</span>
              </div>
            </div>

            <!-- Bloque Contacto -->
            <div class="bg-gray-50/80 p-4 rounded-xl border border-gray-100 space-y-2.5">
              <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Información de Contacto</span>
              <div class="flex justify-between items-center text-xs sm:text-sm">
                <span class="text-gray-500 font-medium">Teléfono:</span>
                <span id="detailPhone" class="font-bold text-gray-800">300 000 0000</span>
              </div>
              <div class="flex justify-between items-center text-xs sm:text-sm">
                <span class="text-gray-500 font-medium">Tipo Documento:</span>
                <span id="detailDocType" class="font-bold text-gray-800">Cédula</span>
              </div>
              <div class="flex justify-between items-center text-xs sm:text-sm">
                <span class="text-gray-500 font-medium">Estado Ocupacional:</span>
                <span id="detailStatusText" class="font-bold text-[#39A900]">CERTIFICADO</span>
              </div>
            </div>

            <!-- Botones de Acción -->
            <div class="space-y-2.5 pt-1">
              <button type="button" 
                      id="detailFullBtn" 
                      @click="openModalPerfilEgresado = true; if(window.currentSelectedEgresado) populateModalPerfilEgresado(window.currentSelectedEgresado);" 
                      class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs sm:text-sm font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 cursor-pointer">
                <span>Ver Perfil Completo</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
              </button>

              <button type="button" 
                      @click="openEditarModal(); openModalEditar = true;" 
                      class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white hover:bg-gray-50 text-gray-700 text-xs sm:text-sm font-bold rounded-xl border border-gray-200 transition cursor-pointer">
                <i class="fa-solid fa-pen-to-square text-[#39A900]"></i>
                <span>Editar Datos</span>
              </button>

              <button type="button" 
                      @click="openModalSeguimiento = true" 
                      class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#EAF7EE] hover:bg-[#dcfce7] text-[#166534] text-xs sm:text-sm font-bold rounded-xl border border-[#BBF7D0] transition cursor-pointer">
                <i class="fa-solid fa-notes-medical"></i>
                <span>Registrar Seguimiento</span>
              </button>

              <form id="detailToggleForm" action="" method="POST" onsubmit="event.preventDefault(); openConfirmToggleModal();">
                @csrf
                <button type="submit" id="detailToggleBtn" class="cursor-pointer w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold border transition">
                  <i id="detailToggleIcon" class="fa-solid fa-toggle-on"></i>
                  <span id="detailToggleText">Desactivar Egresado</span>
                </button>
              </form>
            </div>

          </div>
        </div>

      </div>

    </div>
  </div>

</div>

<script>
    // Filtrado interactivo en tiempo real sin recargar página
    function filterDirectorioLive() {
        const textVal = (document.getElementById('filterText')?.value || '').trim().toLowerCase();
        const progVal = (document.getElementById('filterPrograma')?.value || '').trim().toUpperCase();
        const estVal = (document.getElementById('filterEstado')?.value || '').trim().toUpperCase();

        const rows = document.querySelectorAll('.egresado-row');
        let visibleCount = 0;
        let firstVisibleRow = null;

        rows.forEach(row => {
            const rowSearch = row.getAttribute('data-search') || '';
            const rowProg = row.getAttribute('data-program') || '';
            const rowStatus = row.getAttribute('data-status') || '';
            const rowActive = row.getAttribute('data-active') || '';

            let matchText = !textVal || rowSearch.includes(textVal);
            let matchProg = !progVal || rowProg.includes(progVal);
            let matchEst = true;

            if (estVal) {
                if (estVal === 'ACTIVO' || estVal === 'INACTIVO') {
                    matchEst = (rowActive === estVal);
                } else {
                    matchEst = (rowStatus === estVal);
                }
            }

            if (matchText && matchProg && matchEst) {
                row.style.display = '';
                visibleCount++;
                if (!firstVisibleRow) firstVisibleRow = row;
            } else {
                row.style.display = 'none';
            }
        });

        const counter = document.getElementById('filteredCounter');
        if (counter) {
            counter.innerText = 'Mostrando ' + visibleCount + ' egresados';
        }

        const currentActive = document.querySelector('.egresado-row.bg-emerald-50\\/60');
        if (!currentActive || currentActive.style.display === 'none') {
            if (firstVisibleRow) {
                selectEgresadoFromElement(firstVisibleRow);
            }
        }
    }

    // Actualizar el panel de detalles reactivo
    function selectEgresado(data, rowId) {
        if (!data) return;
        window.currentSelectedEgresado = data;

        // Actualizar fila activa
        document.querySelectorAll('.egresado-row').forEach(row => {
            row.classList.remove('bg-emerald-50/60', 'font-semibold', 'selected-row');
        });
        const activeRow = document.getElementById(rowId);
        if (activeRow) {
            activeRow.classList.add('bg-emerald-50/60', 'font-semibold');
        }

        // Actualizar datos del panel derecho
        const avatar = document.getElementById('detailAvatarLarge');
        if (avatar) avatar.innerText = data.initials || 'EG';

        const name = document.getElementById('detailName');
        if (name) name.innerText = data.name || 'Sin nombre';

        const doc = document.getElementById('detailDoc');
        if (doc) doc.innerText = 'Doc: ' + (data.document || 'N/A');

        const email = document.getElementById('detailEmail');
        if (email) email.innerText = data.email || 'Sin correo';
        
        const prog = document.getElementById('detailProgram');
        if (prog) prog.innerText = data.program || 'Sin programa';

        const code = document.getElementById('detailCode');
        if (code) code.innerText = data.code || 'N/A';
        
        const phone = document.getElementById('detailPhone');
        if (phone) phone.innerText = data.phone || 'Sin teléfono';

        const docType = document.getElementById('detailDocType');
        if (docType) docType.innerText = data.document_type || 'Cédula';

        const statusText = document.getElementById('detailStatusText');
        if (statusText) statusText.innerText = data.status || 'N/A';
        
        const pill = document.getElementById('detailStatusPill');
        if (pill) {
            pill.innerText = data.status || 'ESTADO';
            pill.className = 'px-2 py-0.5 rounded-full text-[10px] font-extrabold ' + (data.pill_class === 'status-green' ? 'bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]' : 'bg-gray-100 text-gray-700 border border-gray-200');
        }

        const activePill = document.getElementById('detailActivePill');
        if (activePill) {
            if (data.is_active) {
                activePill.innerText = '🟢 Activo';
                activePill.className = 'px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]';
            } else {
                activePill.innerText = '🔴 Inactivo';
                activePill.className = 'px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-red-50 text-red-700 border border-red-200';
            }
        }

        const toggleForm = document.getElementById('detailToggleForm');
        const toggleBtn = document.getElementById('detailToggleBtn');
        const toggleIcon = document.getElementById('detailToggleIcon');
        const toggleText = document.getElementById('detailToggleText');

        if (toggleForm && data.id) {
            toggleForm.action = '{{ url("egresados/instructor") }}/' + data.id + '/toggle-status';
            toggleForm.onsubmit = function(e) {
                if (e) e.preventDefault();
                openConfirmToggleModal(data);
                return false;
            };
            if (data.is_active) {
                toggleBtn.className = 'w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-xs font-bold border border-rose-200 text-rose-700 hover:bg-rose-50 transition cursor-pointer';
                toggleIcon.className = 'fa-solid fa-user-xmark';
                toggleText.innerText = 'Desactivar Egresado';
            } else {
                toggleBtn.className = 'w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-xs font-bold border border-emerald-300 bg-emerald-50 text-emerald-800 hover:bg-emerald-100 transition cursor-pointer';
                toggleIcon.className = 'fa-solid fa-user-check';
                toggleText.innerText = 'Activar Egresado';
            }
        }

        // Sincronizar ID y Nombre en el modal de seguimiento
        const segInput = document.getElementById('seguimiento_egresado_id');
        if (segInput && data.id) segInput.value = data.id;

        const segLabel = document.getElementById('seguimiento_egresado_name_label');
        if (segLabel && data.name) segLabel.innerText = data.name;

        const segDoc = document.getElementById('seguimiento_egresado_doc_label');
        if (segDoc && data.doc) segDoc.innerHTML = '<i class="fa-regular fa-id-card mr-1 text-[#39A900]"></i> ' + data.doc;

        const segFicha = document.getElementById('seguimiento_egresado_ficha_label');
        if (segFicha && data.ficha) segFicha.innerText = 'Ficha: ' + data.ficha;

        if (typeof populateModalPerfilEgresado === 'function') populateModalPerfilEgresado(data);
        if (typeof populateModalEditar === 'function') populateModalEditar(data);
    }

    // Decodificador seguro de JSON tolerante a entidades HTML
    function parseJsonSafe(raw) {
        if (!raw) return null;
        try {
            return JSON.parse(raw);
        } catch(e1) {
            try {
                const doc = new DOMParser().parseFromString(raw, 'text/html');
                const decoded = doc.body.textContent;
                return JSON.parse(decoded);
            } catch(e2) {
                console.error('Error parseando json de egresado:', e2, raw);
                return null;
            }
        }
    }

    // Selector a partir del elemento <tr> en el DOM
    function selectEgresadoFromElement(el) {
        if (!el) return;
        const raw = el.getAttribute('data-json');
        const data = parseJsonSafe(raw);
        if (data) {
            selectEgresado(data, el.id);
        }
    }

    // Apertura reactiva y garantizada del modal de edición
    function openEditarModal(data) {
        if (!data) data = window.currentSelectedEgresado;
        if (!data) {
            const row = document.querySelector('.egresado-row.bg-emerald-50\\/60') || document.querySelector('.egresado-row');
            if (row) {
                const raw = row.getAttribute('data-json');
                data = parseJsonSafe(raw);
            }
        }
        if (data) {
            window.currentSelectedEgresado = data;
            if (typeof populateModalEditar === 'function') {
                populateModalEditar(data);
            }
        }
    }

    // Seleccionar automáticamente el primer egresado al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.egresado-row');
        if (firstRow) {
            selectEgresadoFromElement(firstRow);
        }
    });
</script>

<!-- Modales y Drawer Lateral de Superadmin Compartidos con Instructor -->
@include('egresados::superadmin.partials._modal_crear')
@include('egresados::superadmin.partials._modal_seguimiento')
@include('egresados::superadmin.partials._modal_editar')
@include('egresados::superadmin.partials._modal_importar')
@include('egresados::superadmin.partials._modal_perfil_egresado')
@include('egresados::superadmin.partials._modal_confirmar_toggle')
@include('egresados::superadmin.partials._modal_alertas')

</body>
</html>
