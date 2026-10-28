<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gestión de Instructores — CEFA La Angostura</title>

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

      * { box-sizing: border-box; }
      html, body { margin: 0; padding: 0; }

      body {
        font-family: 'Poppins', 'Nunito', sans-serif;
        background: var(--bg);
        color: var(--ink);
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
      }

      .app {
        display: grid;
        grid-template-columns: 260px 1fr;
        min-height: 100vh;
      }

      /* ---------------- SIDEBAR INSTITUCIONAL ---------------- */
      .sidebar {
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
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-weight: 700;
        font-size: 18px;
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
        transform: translateX(3px);
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
        border-bottom: 3px solid var(--sena-green);
        box-shadow: 0 4px 14px rgba(0, 19, 30, 0.15);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 36px;
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
        font-family: 'Poppins', 'Nunito', sans-serif;
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
        font-family: 'Poppins', 'Nunito', sans-serif;
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
        padding: 14px 20px;
        border-top: 1px solid var(--line);
        background: #ffffff;
        display: block;
        width: 100%;
        box-sizing: border-box;
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
<body x-data="{ 
    openModalNuevoInstructor: false, 
    openModalPerfilInstructor: false, 
    openModalAsignarFicha: false, 
    openModalEditarInstructor: false,
    openSuccessModal: {{ session('success') ? 'true' : 'false' }},
    openErrorModal: {{ session('error') ? 'true' : 'false' }}
}" @open-modal-editar-instructor.window="openModalEditarInstructor = true">

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
      <a href="{{ route('egresados.dashboard_instructor') }}">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Panel Instructores</span>
      </a>
    </nav>

    <!-- Sidebar Footer: Usuario y Cerrar Sesión -->
    <div style="margin-top: auto; padding-top: 18px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
      <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px; padding: 6px 8px;">
        <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--sena-green); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; border: 2px solid var(--sena-neon); flex-shrink: 0;">
          {{ Auth::check() ? (Auth::user()->initials ?? 'SA') : 'SA' }}
        </div>
        <div style="overflow: hidden;">
          <div style="font-size: 12px; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ Auth::check() ? Auth::user()->full_name : 'Super Admin Sige' }}</div>
          <div style="font-size: 10.5px; color: var(--sena-neon); font-weight: 600;">Coordinación Académica</div>
        </div>
      </div>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
        <button type="submit" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 8px 12px; border-radius: 10px; background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.25); color: #fca5a5; font-size: 12px; font-weight: 700; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(239, 68, 68, 0.3)'; this.style.color='#fff';" onmouseout="this.style.background='rgba(239, 68, 68, 0.15)'; this.style.color='#fca5a5';">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          <span>Cerrar Sesión</span>
        </button>
      </form>
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

      @include('egresados::superadmin.partials._topbar_right')
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

                    // Programa asociado al instructor a través de los cursos del CEFA
                    $instCourse = \Modules\SICA\Entities\Course::with('program')->where('person_id', $person?->id)->first();
                    $instProgramName = $instCourse?->program?->name ?? 'Análisis y Desarrollo de Software (ADSO)';

                    // Serializar datos para JavaScript
                    $jsonData = json_encode([
                        'id' => $inst->id,
                        'name' => $fullName,
                        'initials' => $initials ?: 'IN',
                        'document' => $person->document_number ?? '107584578',
                        'document_type' => $person->document_type ?? 'Cédula de ciudadanía',
                        'email' => $inst->email ?? ($person->misena_email ?? 'instructor@sena.edu.co'),
                        'phone' => $person->telephone1 ?? '316 000 0000',
                        'role_slug' => 'egresados.instructor',
                        'program' => $instProgramName,
                        'especialidad' => 'Formación Profesional Integral',
                        'fichas' => 'Fichas activas CEFA',
                        'status' => 'ACTIVO',
                        'status_pill' => 'status-green',
                    ]);
                  @endphp
                  <tr class="instructor-row {{ $index === 0 ? 'selected-row' : '' }}" 
                      id="inst-row-{{ $inst->id }}"
                      data-json="{{ htmlspecialchars($jsonData, ENT_QUOTES, 'UTF-8') }}"
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
                      <div style="font-weight:600; color:var(--ink);">{{ $instProgramName }}</div>
                      <div style="font-size:11px; color:var(--ink-soft); font-weight:600;">Instructor de Formación</div>
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
                            onclick="openEditarInstructorModal({{ $jsonData }})" 
                            class="btn-circle-action" 
                            title="Editar Instructor">
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
              {{ $instructores->withQueryString()->links('egresados::partials.pagination') }}
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
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Asignar Seguimiento a Egresados</span>
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

    // Función interactiva para abrir el modal de edición de instructor
    function openEditarInstructorModal(data) {
        if (!data) return;
        const form = document.getElementById('form-editar-instructor');
        if (form && data.id) {
            form.action = '/egresados/superadmin/instructores/' + data.id;
        }
        const nameLabel = document.getElementById('edit_inst_name_label');
        if (nameLabel) nameLabel.innerText = data.name || 'Docente';

        const docInput = document.getElementById('edit_inst_doc');
        if (docInput) docInput.value = data.document || '';

        const nameInput = document.getElementById('edit_inst_nombre');
        if (nameInput) nameInput.value = data.name || '';

        const emailInput = document.getElementById('edit_inst_correo');
        if (emailInput) emailInput.value = data.email || '';

        const phoneInput = document.getElementById('edit_inst_telefono');
        if (phoneInput) phoneInput.value = (data.phone && data.phone !== '316 000 0000') ? data.phone : '';

        const progInput = document.getElementById('edit_inst_programa');
        if (progInput) progInput.value = data.program || '';

        const docTypeSelect = document.getElementById('edit_inst_tipo_doc');
        if (docTypeSelect && data.document_type) {
            const dt = String(data.document_type).toUpperCase();
            if (dt.includes('TARJETA') || dt === 'TI') docTypeSelect.value = 'Tarjeta de identidad';
            else if (dt.includes('EXTRANJER') || dt === 'CE') docTypeSelect.value = 'Cédula de extranjería';
            else if (dt.includes('PROTECCIÓN') || dt.includes('PROTECCION') || dt.includes('PEP') || dt.includes('PPT')) docTypeSelect.value = 'Permiso de Protección Temporal';
            else docTypeSelect.value = 'Cédula de ciudadanía';
        }

        window.dispatchEvent(new CustomEvent('open-modal-editar-instructor'));
    }

    // Inicializar seleccionando el primer instructor disponible sin evento click() sintético
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.instructor-row');
        if (firstRow) {
            const rawJson = firstRow.getAttribute('data-json');
            if (rawJson) {
                try {
                    selectInstructor(JSON.parse(rawJson), firstRow.id);
                } catch(e) {
                    firstRow.classList.add('selected-row');
                }
            } else {
                firstRow.classList.add('selected-row');
            }
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
        
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-4">
                <div id="modalInstInitials" class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center font-bold text-lg shadow-md shadow-black/20">
                    CM
                </div>
                <div>
                    <div class="text-[10px] font-extrabold text-[#62E31D] uppercase tracking-wider">EXPEDIENTE DOCENTE · SIGE</div>
                    <h3 id="modalInstName" class="text-xl font-bold text-white tracking-tight">Carla Moreno</h3>
                    <p class="text-xs text-white/70 mt-0.5">Centro de Formación Agroindustrial La Angostura — CEFA</p>
                </div>
            </div>
            <button @click="openModalPerfilInstructor = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar">
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
                    <span class="px-3 py-1.5 bg-gray-50 border border-gray-200 text-gray-700 text-xs font-semibold rounded-xl">Seguimiento a Egresados</span>
                    <span class="px-3 py-1.5 bg-gray-50 border border-gray-200 text-gray-700 text-xs font-semibold rounded-xl">Tutoría de Proyectos SENA</span>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex items-center justify-end bg-gray-50/70">
            <button type="button" @click="openModalPerfilInstructor = false" class="px-6 py-2.5 bg-gradient-to-r from-[#001A29] to-[#39A900] hover:from-[#00131E] hover:to-[#2e8b00] text-white text-xs font-bold rounded-xl shadow-md transition cursor-pointer">
                Cerrar Expediente
            </button>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL 2: ASIGNAR SEGUIMIENTO A EGRESADOS -->
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
         class="bg-white rounded-3xl max-w-lg w-full shadow-2xl border border-gray-100 flex flex-col overflow-hidden">
        
        <!-- Encabezado del Modal con Identidad SENA ERP -->
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center font-bold text-lg shadow-md shadow-black/20 flex-shrink-0">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="text-[10px] font-extrabold text-[#62E31D] uppercase tracking-wider">GESTIÓN DE INSTRUCTORES · SIGE</div>
                    <h3 class="text-lg sm:text-xl font-bold text-white tracking-tight">Asignar Seguimiento a Egresados</h3>
                    <p class="text-xs text-white/70 mt-0.5">Instructor asignado: <strong id="assignInstructorNameLabel" class="text-[#62E31D] font-bold">Carla Moreno</strong></p>
                </div>
            </div>
            <button @click="openModalAsignarFicha = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario con Estilos ERP -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-5">
            <form id="form-asignar-ficha" 
                  @submit.prevent="
                    openModalAsignarFicha = false; 
                    window.dispatchEvent(new CustomEvent('open-success-modal', { 
                        detail: { 
                            title: '¡Seguimiento a Egresados Asignado!', 
                            message: 'Se ha asignado exitosamente la ficha al docente para el seguimiento y monitoreo exclusivo de egresados.' 
                        } 
                    }));
                  " 
                  class="space-y-4">
                <input type="hidden" id="assignInstructorId" value="1">

                <div>
                    <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-layer-group text-[#39A900]"></i>
                        <span>Ficha de Formación (Egresados)</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <select required class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition">
                        <option value="">Seleccione una ficha de egresados...</option>
                        @if(isset($availableCourses) && $availableCourses->count() > 0)
                            @foreach($availableCourses as $c)
                                <option value="{{ $c->code }}">{{ $c->code }} - {{ $c->program?->name ?? 'Programa SENA' }}</option>
                            @endforeach
                        @else
                            <option value="3145614">3145614 - Análisis y Desarrollo de Software (ADSO)</option>
                            <option value="55555">55555 - Gestión de Empresas Agropecuarias</option>
                            <option value="3145615">3145615 - Procesamiento de Alimentos</option>
                            <option value="2981122">2981122 - Producción Ganadera</option>
                        @endif
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-list-check text-[#39A900]"></i>
                        <span>Tipo de Seguimiento al Egresado</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <select required class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition">
                        <option value="seguimiento_integral" selected>Seguimiento Integral al Egresado</option>
                        <option value="contacto_permanente">Contacto y Comunicación Permanente con el Egresado</option>
                        <option value="actualizacion_datos">Actualización y Verificación de Datos del Egresado</option>
                        <option value="encuestas_caracterizacion">Encuestas y Caracterización del Egresado</option>
                        <option value="red_encuentros">Red de Egresados y Encuentros Institucionales</option>
                        <option value="acompanamiento_academico">Acompañamiento y Formación Continua del Egresado</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-comment-dots text-[#39A900]"></i>
                        <span>Observaciones del Seguimiento al Egresado</span>
                    </label>
                    <textarea rows="3" placeholder="Detalle los objetivos del acompañamiento al egresado, canales de contacto o acuerdos de seguimiento..." class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none resize-none font-medium text-gray-800 transition"></textarea>
                </div>
            </form>
        </div>

        <!-- Pie del Modal con Botones Institucionales ERP -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex items-center justify-end gap-3 bg-gray-50/70 rounded-b-3xl">
            <button type="button" @click="openModalAsignarFicha = false" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-100 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-sm">
                Cancelar
            </button>
            <button type="submit" form="form-asignar-ficha" class="px-6 py-2.5 bg-gradient-to-r from-[#001A29] to-[#39A900] hover:from-[#00131E] hover:to-[#2e8b00] text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-950/20 transition cursor-pointer flex items-center gap-2">
                <i class="fa-solid fa-graduation-cap text-xs"></i>
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
    
    <!-- Contenedor del Formulario Estilo Card Premium -->
    <div @click.away="openModalNuevoInstructor = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[92vh] overflow-hidden">
        
        <!-- Encabezado del Modal con Identidad SENA ERP -->
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-lg shadow-md shadow-black/20 flex-shrink-0">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div>
                    <div class="text-[10.5px] font-extrabold text-[#62E31D] uppercase tracking-wider">GESTIÓN DE INSTRUCTORES · SIGE</div>
                    <h3 class="text-xl font-bold text-white tracking-tight">Registrar instructor</h3>
                    <p class="text-xs text-white/70 mt-0.5">Vincular nuevo docente a la plataforma de egresados CEFA La Angostura.</p>
                </div>
            </div>
            <button @click="openModalNuevoInstructor = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario (Con scroll suave) -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-6">
            <form id="form-crear-instructor" action="{{ route('egresados.superadmin.instructores.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="rol" value="instructor_egresados">
                
                <!-- 1. Datos personales -->
                <div>
                    <div class="flex items-center gap-2.5 mb-4">
                        <span class="w-7 h-7 rounded-full bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-xs font-bold shadow-xs">1</span>
                        <h4 class="text-sm font-bold text-[#00131E]">Datos personales</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Nombres <span class="text-red-500">*</span></label>
                            <input type="text" name="nombres" required placeholder="Ej. Carlos Alberto" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Apellidos <span class="text-red-500">*</span></label>
                            <input type="text" name="apellidos" required placeholder="Ej. Mendoza Castro" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                        <div class="sm:col-span-1">
                            <label class="block text-xs font-bold text-gray-700 mb-1">Tipo Doc. <span class="text-red-500">*</span></label>
                            <select name="tipo_documento" required class="w-full px-3 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                                <option value="Cédula de ciudadanía">Cédula de Ciudadanía (CC)</option>
                                <option value="Tarjeta de identidad">Tarjeta de Identidad (TI)</option>
                                <option value="Cédula de extranjería">Cédula de Extranjería (CE)</option>
                                <option value="Permiso de Protección Temporal">Permiso Protección Temporal (PPT/PEP)</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-gray-700 mb-1">DNI / Cédula <span class="text-red-500">*</span></label>
                            <input type="text" name="documento" required pattern="[0-9]{5,15}" inputmode="numeric" title="Ingrese entre 5 y 15 dígitos numéricos sin puntos ni espacios" placeholder="Ej. 107584578" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                    </div>
                </div>

                <!-- 2. Información de contacto -->
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="w-7 h-7 rounded-full bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-xs font-bold shadow-xs">2</span>
                        <h4 class="text-sm font-bold text-[#00131E]">Información de contacto</h4>
                    </div>
                    <p class="text-[11px] text-gray-500 mb-3.5">Datos únicos de contacto: el correo institucional y teléfono deben pertenecer exclusivamente al instructor.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Correo Electrónico Institucional <span class="text-red-500">*</span></label>
                            <input type="email" name="correo" required placeholder="instructor@sena.edu.co" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Teléfono / Celular</label>
                            <input type="tel" name="telefono" pattern="[0-9]{7,15}" inputmode="numeric" title="Ingrese entre 7 y 15 dígitos numéricos sin caracteres especiales" placeholder="Ej. 3161234567" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                    </div>
                </div>

                <!-- 3. Información académica y vinculación -->
                <div>
                    <div class="flex items-center gap-2.5 mb-4">
                        <span class="w-7 h-7 rounded-full bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-xs font-bold shadow-xs">3</span>
                        <h4 class="text-sm font-bold text-[#00131E]">Información académica y vinculación</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Programa de Formación <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   name="programa" 
                                   id="crear_inst_programa" 
                                   list="lista_programas_instructor_crear" 
                                   required 
                                   placeholder="Escribe el programa de formación (ej. ADSO, Agropecuaria...)" 
                                   class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium text-gray-800">
                            <datalist id="lista_programas_instructor_crear">
                                <option value="Análisis y Desarrollo de Software (ADSO)">
                                <option value="Gestión de Empresas Agropecuarias">
                                <option value="Procesamiento de Alimentos">
                                <option value="Producción Ganadera">
                                <option value="Gestión Administrativa">
                                <option value="Gestión del Talento Humano">
                                <option value="Contabilización de Operaciones Comerciales y Financieras">
                                <option value="Producción Agropecuaria Ecológica">
                                <option value="Riego, Drenaje y Manejo de Suelos Agrícolas">
                                <option value="Mantenimiento Mecatrónico de Automotores">
                                <option value="Sistemas">
                                <option value="Construcción de Edificaciones">
                                <option value="Cocina">
                                <option value="Agroindustria">
                                <option value="Mecanización Agrícola">
                                <option value="Acuicultura">
                                <option value="Recursos Humanos">
                                <option value="Salud Ocupacional">
                            </datalist>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Centro de Formación</label>
                            <input type="text" name="centro_formacion" value="CEFA La Angostura" readonly class="w-full px-3.5 py-2.5 text-sm bg-gray-50 text-gray-500 border border-gray-200 rounded-xl cursor-not-allowed font-medium">
                        </div>
                    </div>
                </div>



            </form>
        </div>

        <!-- Pie del Modal con Botones Institucionales ERP -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex flex-col sm:flex-row items-center justify-end gap-3 bg-[#f8faf9]">
            <button type="button" @click="openModalNuevoInstructor = false" class="w-full sm:w-auto px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer text-center">
                Cancelar
            </button>
            <button type="submit" form="form-crear-instructor" class="w-full sm:w-auto px-7 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs font-bold rounded-xl transition shadow-md hover:shadow-lg shadow-[#39A900]/25 cursor-pointer flex items-center justify-center gap-2">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span>Registrar instructor</span>
            </button>
        </div>

    </div>
</div>

<!-- ============================================== -->
<!-- MODAL 4: EDITAR INSTRUCTOR (ESTILO INSTITUCIONAL ERP) -->
<!-- ============================================== -->
<div x-show="openModalEditarInstructor" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center p-3 sm:p-4 pt-4 sm:pt-6" x-cloak>
    
    <div @click.away="openModalEditarInstructor = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         class="bg-white rounded-3xl max-w-xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[94vh] overflow-hidden">
        
        <!-- Encabezado del Modal con Identidad SENA ERP -->
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center font-bold text-lg shadow-md shadow-black/20 flex-shrink-0">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
                <div>
                    <div class="text-[10px] font-extrabold text-[#62E31D] uppercase tracking-wider">GESTIÓN DE INSTRUCTORES · SIGE ERP</div>
                    <h3 class="text-lg sm:text-xl font-bold text-white tracking-tight">Editar Datos del Instructor</h3>
                    <p class="text-xs text-white/70 mt-0.5">Modificando expediente de: <strong id="edit_inst_name_label" class="text-[#62E31D] font-bold">Docente</strong></p>
                </div>
            </div>
            <button @click="openModalEditarInstructor = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario con Estilos ERP -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-4">
            <form id="form-editar-instructor" action="/egresados/superadmin/instructores/1" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-id-card text-[#39A900]"></i>
                            <span>Tipo Doc.</span>
                        </label>
                        <select name="tipo_documento" id="edit_inst_tipo_doc" class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition">
                            <option value="Cédula de ciudadanía">CC - Cédula</option>
                            <option value="Tarjeta de identidad">TI - Tarjeta</option>
                            <option value="Cédula de extranjería">CE - Extranjería</option>
                            <option value="Permiso de Protección Temporal">PPT / PEP</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-fingerprint text-[#39A900]"></i>
                            <span>Número de Documento</span>
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="documento" id="edit_inst_doc" required pattern="[0-9]{5,15}" inputmode="numeric" title="Ingrese entre 5 y 15 dígitos numéricos sin puntos ni espacios" placeholder="Ej. 107584578" class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-semibold text-gray-800 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-user text-[#39A900]"></i>
                        <span>Nombre Completo</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" id="edit_inst_nombre" required placeholder="Nombres y Apellidos" class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-semibold text-gray-800 transition">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-envelope text-[#39A900]"></i>
                            <span>Correo Electrónico</span>
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="correo" id="edit_inst_correo" required placeholder="instructor@sena.edu.co" class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-phone text-[#39A900]"></i>
                            <span>Teléfono / Celular</span>
                        </label>
                        <input type="tel" name="telefono" id="edit_inst_telefono" pattern="[0-9]{7,15}" inputmode="numeric" title="Ingrese entre 7 y 15 dígitos numéricos sin caracteres especiales" placeholder="Ej. 3161234567" class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition">
                    </div>
                </div>

                <input type="hidden" name="rol" value="instructor_egresados">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-graduation-cap text-[#39A900]"></i>
                            <span>Programa Vinculado</span>
                        </label>
                        <input type="text" 
                               name="programa" 
                               id="edit_inst_programa" 
                               list="lista_programas_instructor_edit" 
                               placeholder="Escribe el programa (ej. ADSO, Agropecuaria...)" 
                               class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition">
                        <datalist id="lista_programas_instructor_edit">
                            <option value="Análisis y Desarrollo de Software (ADSO)">
                            <option value="Gestión de Empresas Agropecuarias">
                            <option value="Procesamiento de Alimentos">
                            <option value="Producción Ganadera">
                            <option value="Gestión Administrativa">
                            <option value="Gestión del Talento Humano">
                            <option value="Contabilización de Operaciones Comerciales y Financieras">
                            <option value="Producción Agropecuaria Ecológica">
                            <option value="Riego, Drenaje y Manejo de Suelos Agrícolas">
                            <option value="Mantenimiento Mecatrónico de Automotores">
                            <option value="Sistemas">
                            <option value="Construcción de Edificaciones">
                            <option value="Cocina">
                            <option value="Agroindustria">
                            <option value="Mecanización Agrícola">
                            <option value="Acuicultura">
                            <option value="Recursos Humanos">
                            <option value="Salud Ocupacional">
                        </datalist>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-building-columns text-[#39A900]"></i>
                            <span>Centro de Formación</span>
                        </label>
                        <input type="text" value="CEFA La Angostura" readonly class="w-full px-3.5 py-2.5 text-sm bg-gray-100 text-gray-500 border border-gray-200 rounded-xl cursor-not-allowed font-medium">
                    </div>
                </div>
            </form>
        </div>

        <!-- Pie del Modal con Botones Institucionales ERP -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex items-center justify-end gap-3 bg-gray-50/70 rounded-b-3xl">
            <button type="button" @click="openModalEditarInstructor = false" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-100 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-sm">
                Cancelar
            </button>
            <button type="submit" form="form-editar-instructor" class="px-6 py-2.5 bg-gradient-to-r from-[#001A29] to-[#39A900] hover:from-[#00131E] hover:to-[#2e8b00] text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-950/20 transition cursor-pointer flex items-center gap-2 transform hover:-translate-y-0.5">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Guardar Cambios</span>
            </button>
        </div>
    </div>
</div>
    </div>
</div>

<!-- Modal de Alertas y Notificaciones -->
@include('egresados::superadmin.partials._modal_alertas')

</body>
</html>
