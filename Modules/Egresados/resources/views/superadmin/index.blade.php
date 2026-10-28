<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gestión de Egresados — CEFA La Angostura</title>

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
        font-family: 'Poppins', 'Nunito', sans-serif;
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

      .btn-edit-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #fef3c7;
        color: #b45309;
        border: 1px solid rgba(245, 158, 11, 0.35);
        padding: 10px 18px;
        border-radius: 12px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .btn-edit-action:hover {
        background: #fde68a;
        color: #92400e;
      }

      /* Pagination */
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
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .main-grid { grid-template-columns: 1fr; }
      }
      @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
        .content { padding: 24px 18px 36px; }
        .topbar { padding: 12px 18px; }
      }
    </style>
<body x-data="{ 
    openModal: false, 
    openModalSeguimiento: false, 
    openModalImportar: false, 
    openModalEditar: false, 
    openModalPerfilEgresado: false,
    openSuccessModal: {{ session('success') ? 'true' : 'false' }},
    openErrorModal: {{ session('error') ? 'true' : 'false' }}
}">

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
          <h1 class="page-title">Gestión de <span>Egresados</span></h1>
          <p class="page-desc">Consulta, seguimiento y actualización de información de egresados institucionales del CEFA.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
          <!-- BOTÓN 1: Sincronizar API (Formulario directo con Azul Noche Institucional) -->
          <form action="{{ route('egresados.superadmin.sincronizar') }}" method="POST" class="m-0 p-0">
            @csrf
            <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-[#00131E] to-[#001A29] hover:from-[#001A29] hover:to-[#00283d] text-white text-xs font-bold rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 cursor-pointer border border-white/10">
              <svg class="w-4 h-4 mr-2 text-[#62E31D]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
              <span>Sincronizar SICEFA</span>
            </button>
          </form>

          <!-- BOTÓN 2: Importar Excel (Estilo Card Institucional con Verde SENA) -->
          <button @click="openModalImportar = true" type="button" class="inline-flex items-center justify-center px-4 py-2.5 bg-white hover:bg-emerald-50/50 border border-gray-200 hover:border-[#39A900]/50 text-gray-700 hover:text-[#00131E] text-xs font-bold rounded-xl transition-all duration-200 shadow-2xs hover:shadow-sm hover:-translate-y-0.5 cursor-pointer">
            <svg class="w-4 h-4 mr-2 text-[#39A900]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
            <span>Importar Excel</span>
          </button>

          <!-- BOTÓN 3: Nuevo Egresado (Verde Principal Institucional SENA) -->
          <button @click="openModal = true" type="button" class="inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs font-bold rounded-xl transition-all duration-200 shadow-md shadow-[#39A900]/25 hover:shadow-lg hover:-translate-y-0.5 cursor-pointer border-0">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Nuevo Egresado</span>
          </button>
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
              <option value="TODOS" {{ request('apprentice_status', 'TODOS') == 'TODOS' ? 'selected' : '' }}>Todos los Egresados (Módulo)</option>
              <option value="CERTIFICADO" {{ request('apprentice_status') == 'CERTIFICADO' ? 'selected' : '' }}>🎓 Certificados</option>
              <option value="EN FORMACIÓN" {{ request('apprentice_status') == 'EN FORMACIÓN' ? 'selected' : '' }}>En Formación</option>
              <option value="CONDICIONADO" {{ request('apprentice_status') == 'CONDICIONADO' ? 'selected' : '' }}>Condicionado</option>
              <option value="INDUCCIÓN" {{ request('apprentice_status') == 'INDUCCIÓN' ? 'selected' : '' }}>Inducción</option>
              <option value="CANCELADO" {{ request('apprentice_status') == 'CANCELADO' ? 'selected' : '' }}>Cancelado</option>
              <option value="RETIRO VOLUNTARIO" {{ request('apprentice_status') == 'RETIRO VOLUNTARIO' ? 'selected' : '' }}>Retiro Voluntario</option>
            </select>

            <button type="submit" class="btn-filter">
              Filtrar
            </button>

            @if(request('search') || (request('apprentice_status') && request('apprentice_status') !== 'TODOS'))
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

                    // Extraer valores limpios para campos de edición
                    $docRaw = ($person && $person->document_number) ? (string)$person->document_number : '';
                    $emailRaw = ($person && ($person->personal_email || $person->misena_email)) ? ($person->personal_email ?: $person->misena_email) : '';
                    $phoneRaw = ($person && ($person->telephone1 || $person->telephone2)) ? (string)($person->telephone1 ?: $person->telephone2) : '';
                    $progRaw = ($program && $program->name) ? $program->name : '';
                    $codeRaw = ($course && $course->code) ? (string)$course->code : '';

                    // Serializar datos para JavaScript
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
                        'pill_class' => $pillClass,
                        'show_url' => route('egresados.show', $item->id),
                    ]);
                  @endphp
                  <tr class="egresado-row {{ $index === 0 ? 'selected-row' : '' }}" 
                      id="row-{{ $item->id }}"
                      data-json="{{ htmlspecialchars($jsonData, ENT_QUOTES, 'UTF-8') }}"
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
                        <button type="button" 
                            @click.stop="openModalPerfilEgresado = true; selectEgresado({{ $jsonData }}, 'row-{{ $item->id }}'); populateModalPerfilEgresado({{ $jsonData }});" 
                            class="btn-circle-action" 
                            title="Ver Perfil Completo (Ventana Flotante)">
                          <i class="fa-solid fa-id-card text-emerald-700"></i>
                        </button>
                        <button type="button" 
                            @click.stop="selectEgresado({{ $jsonData }}, 'row-{{ $item->id }}'); populateModalEditar({{ $jsonData }}); openModalEditar = true;" 
                            class="btn-circle-action" 
                            style="color:#d97706;" 
                            title="Editar Datos del Egresado">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </button>
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
              {{ $egresados->withQueryString()->links('egresados::partials.pagination') }}
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
          <button type="button" 
              id="detailFullBtn" 
              @click="openModalPerfilEgresado = true; if(window.currentSelectedEgresado) populateModalPerfilEgresado(window.currentSelectedEgresado);" 
              class="btn-cta-detail cursor-pointer">
            <span>Ver Perfil Completo</span>
            <i class="fa-solid fa-arrow-right text-xs"></i>
          </button>

          <button type="button" 
              @click="if(window.currentSelectedEgresado) populateModalEditar(window.currentSelectedEgresado); openModalEditar = true;" 
              class="btn-edit-action cursor-pointer">
            <i class="fa-solid fa-pen-to-square"></i>
            <span>Editar Datos</span>
          </button>

          <button type="button" @click="openModalSeguimiento = true" class="btn-secondary-action cursor-pointer">
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
        window.currentSelectedEgresado = data;

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

        // Sincronizar ID y Nombre en el modal de seguimiento
        const segInput = document.getElementById('seguimiento_egresado_id');
        if (segInput && data.id) {
            segInput.value = data.id;
        }
        const segLabel = document.getElementById('seguimiento_egresado_name_label');
        if (segLabel && data.name) {
            segLabel.innerText = data.name;
        }

        // Sincronizar automáticamente la ventana flotante de perfil y el modal de edición
        if (typeof populateModalPerfilEgresado === 'function') {
            populateModalPerfilEgresado(data);
        }
        if (typeof populateModalEditar === 'function') {
            populateModalEditar(data);
        }
    }

    // Seleccionar automáticamente el primer egresado al cargar sin disparar click() sintético
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.egresado-row');
        if (firstRow) {
            const rawJson = firstRow.getAttribute('data-json');
            if (rawJson) {
                try {
                    selectEgresado(JSON.parse(rawJson), firstRow.id);
                } catch(e) {
                    firstRow.classList.add('selected-row');
                }
            } else {
                firstRow.classList.add('selected-row');
            }
        }
    });
</script>

<!-- Modales y Drawer Lateral de Superadmin -->
@include('egresados::superadmin.partials._modal_crear')
@include('egresados::superadmin.partials._modal_seguimiento')
@include('egresados::superadmin.partials._modal_editar')
@include('egresados::superadmin.partials._modal_importar')
@include('egresados::superadmin.partials._modal_perfil_egresado')
@include('egresados::superadmin.partials._modal_alertas')

</body>
</html>
