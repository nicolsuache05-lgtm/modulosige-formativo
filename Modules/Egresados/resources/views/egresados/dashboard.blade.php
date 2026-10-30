<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIGE · Portal del Egresado · SENA CEFA</title>
  <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

  <!-- Google Fonts: Poppins & Nunito (Tipografía Institucional SENA Empresa ERP) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
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

      /* Mapeo del sistema a las variables oficiales del ERP */
      --forest-deep: #00131E;
      --forest: #001A29;
      --forest-dark: #000F17;
      --forest-card: #002336;
      --green: #39A900;
      --green-active: #39A900;
      --green-light: #62E31D;
      --green-soft: #EAF7EE;
      --green-soft-border: #BBF7D0;
      --green-badge: #dcfce7;
      --green-badge-text: #166534;
      --bg: #F4F7F6;
      --card: #FFFFFF;
      --ink: #00131E;
      --ink-soft: #5A6E7D;
      --ink-muted: #8B9FA9;
      --line: #E2E8F0;
      --line-subtle: #EEF2F6;
      --radius-sm: 8px;
      --radius-md: 12px;
      --radius-lg: 18px;
      --radius-xl: 24px;
      --shadow-sm: 0 1px 3px rgba(0, 19, 30, 0.05);
      --shadow-md: 0 4px 14px rgba(0, 19, 30, 0.07);
      --shadow-lg: 0 10px 28px rgba(0, 19, 30, 0.12);
      --transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { min-height: 100vh; }
    body {
      font-family: 'Poppins', 'Nunito', sans-serif;
      background: var(--bg);
      color: var(--ink);
      -webkit-font-smoothing: antialiased;
    }

    .app-layout {
      display: grid;
      grid-template-columns: 260px 1fr;
      min-height: 100vh;
    }

    /* ========================================================
       SIDEBAR (Diseño Oficial SENA Empresa ERP)
       ======================================================== */
    .sidebar {
      background: linear-gradient(180deg, var(--sena-navy) 0%, var(--sena-dark) 100%);
      color: #fff;
      display: flex;
      flex-direction: column;
      padding: 24px 16px;
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
      z-index: 100;
      border-right: 1px solid rgba(255, 255, 255, 0.08);
    }
    .sidebar::-webkit-scrollbar { width: 5px; }
    .sidebar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.15); border-radius: 4px; }

    .brand-box {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 0 8px 24px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.09);
      cursor: pointer;
      text-decoration: none;
      color: #fff;
    }
    .brand-icon-wrap {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      padding: 5px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
      border: 2px solid var(--sena-neon);
    }
    .brand-icon-wrap img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
    .brand-titles {
      display: flex;
      flex-direction: column;
    }
    .brand-row {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .brand-title {
      font-size: 19px;
      font-weight: 800;
      letter-spacing: -0.02em;
      color: #FFFFFF;
      line-height: 1.1;
    }
    .badge-role-tag {
      font-size: 10px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      background: var(--sena-green);
      color: #FFFFFF;
      padding: 2px 7px;
      border-radius: 20px;
      line-height: 1.2;
    }
    .brand-sub {
      font-size: 11.5px;
      color: rgba(255, 255, 255, 0.65);
      margin-top: 3px;
      font-weight: 500;
    }

    .nav-label {
      font-size: 10.5px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.07em;
      color: rgba(255, 255, 255, 0.42);
      margin: 24px 8px 10px;
    }

    .nav-list {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    .nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 14px;
      border-radius: 12px;
      color: rgba(255, 255, 255, 0.78);
      font-size: 13.5px;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      position: relative;
      transition: var(--transition);
      user-select: none;
    }
    .nav-item i {
      font-size: 15px;
      width: 20px;
      text-align: center;
      flex-shrink: 0;
      color: rgba(255, 255, 255, 0.75);
      transition: var(--transition);
    }
    .nav-item:hover {
      background: rgba(255, 255, 255, 0.07);
      color: #FFFFFF;
    }
    .nav-item:hover i {
      color: #FFFFFF;
    }
    /* Estilo del botón activo con Verde Oficial SENA */
    .nav-item.active {
      background: var(--sena-green);
      color: #FFFFFF;
      font-weight: 700;
      box-shadow: 0 4px 14px rgba(57, 169, 0, 0.4);
    }
    .nav-item.active i {
      color: #FFFFFF;
    }
    .nav-item.active::after {
      content: '';
      position: absolute;
      right: 14px;
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: #FFFFFF;
      box-shadow: 0 0 6px rgba(255, 255, 255, 0.8);
    }

    .nav-badge {
      margin-left: auto;
      margin-right: 12px;
      font-size: 10px;
      font-weight: 800;
      background: rgba(255, 255, 255, 0.18);
      color: #fff;
      padding: 2px 7px;
      border-radius: 10px;
    }
    .nav-item.active .nav-badge {
      background: rgba(0, 0, 0, 0.25);
    }

    /* Sidebar Footer con Perfil y Botón Cerrar Sesión */
    .sidebar-footer {
      margin-top: auto;
      padding-top: 18px;
      border-top: 1px solid rgba(255, 255, 255, 0.09);
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    .user-pill-badge {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.07);
    }
    .user-avatar-circle {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: #16a34a;
      color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 13.5px;
      flex-shrink: 0;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }
    .user-info-text {
      display: flex;
      flex-direction: column;
      min-width: 0;
      overflow: hidden;
    }
    .user-name-label {
      font-size: 12.5px;
      font-weight: 700;
      color: #FFFFFF;
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
    }
    .user-email-label {
      font-size: 10.5px;
      color: rgba(255, 255, 255, 0.55);
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
    }

    .logout-btn-action {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      padding: 10px 14px;
      border-radius: 10px;
      background: rgba(239, 68, 68, 0.1);
      border: 1px solid rgba(239, 68, 68, 0.25);
      color: #fca5a5;
      font-size: 12.5px;
      font-weight: 700;
      cursor: pointer;
      text-decoration: none;
      transition: var(--transition);
      font-family: inherit;
    }
    .logout-btn-action:hover {
      background: rgba(239, 68, 68, 0.2);
      color: #fecaca;
      border-color: rgba(239, 68, 68, 0.4);
    }

    /* ========================================================
       MAIN WRAPPER & TOPBAR
       ======================================================== */
    .main-wrapper {
      display: flex;
      flex-direction: column;
      min-width: 0;
      background: var(--bg);
    }

    .topbar {
      background: var(--card);
      border-bottom: 2px solid var(--sena-green);
      padding: 14px 36px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 90;
      gap: 16px;
      box-shadow: 0 2px 10px rgba(0, 19, 30, 0.04);
    }
    .topbar-left {
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .topbar-icon-badge {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: var(--green-soft);
      border: 1px solid var(--green-soft-border);
      color: var(--forest);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      flex-shrink: 0;
    }
    .topbar-title-block {
      display: flex;
      flex-direction: column;
    }
    .topbar-title-row {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .topbar-title-text {
      font-size: 14.5px;
      font-weight: 800;
      color: var(--ink);
    }
    .topbar-pill {
      font-size: 10px;
      font-weight: 700;
      padding: 2px 8px;
      border-radius: 20px;
      background: var(--green-soft);
      color: var(--forest);
      border: 1px solid var(--green-soft-border);
    }
    .topbar-subtitle {
      font-size: 12px;
      color: var(--ink-soft);
      margin-top: 1px;
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .btn-return-home {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: transparent;
      border: 1px solid var(--line);
      border-radius: 8px;
      padding: 7px 14px;
      font-size: 12.5px;
      font-weight: 700;
      color: var(--ink-soft);
      cursor: pointer;
      font-family: inherit;
      transition: var(--transition);
      text-decoration: none;
    }
    .btn-return-home:hover {
      background: #F8FAFC;
      border-color: #CBD5E1;
      color: var(--ink);
    }

    .btn-notif-bell {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      border: 1px solid var(--line);
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--ink-soft);
      cursor: pointer;
      position: relative;
      transition: var(--transition);
      font-size: 15px;
    }
    .btn-notif-bell:hover {
      background: #F8FAFC;
      color: var(--ink);
      border-color: #CBD5E1;
    }
    .notif-bubble {
      position: absolute;
      top: 6px;
      right: 6px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #ef4444;
      border: 2px solid #fff;
    }

    /* Profile Dropdown Header & Menu */
    .topbar-profile-wrapper {
      position: relative;
    }
    .topbar-profile-btn {
      display: flex;
      align-items: center;
      gap: 10px;
      background: #fff;
      border: 1px solid var(--line);
      padding: 4px 12px 4px 4px;
      border-radius: 24px;
      cursor: pointer;
      transition: var(--transition);
      font-family: inherit;
    }
    .topbar-profile-btn:hover,
    .topbar-profile-btn.active {
      border-color: #94A3B8;
      background: #F8FAFC;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }
    .topbar-avatar-small {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: var(--sena-green);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11.5px;
      font-weight: 800;
      letter-spacing: 0.5px;
    }
    .topbar-profile-name {
      font-size: 13px;
      font-weight: 700;
      color: var(--ink);
      white-space: nowrap;
    }
    .topbar-chevron-icon {
      font-size: 10px;
      color: #94a3b8;
      transition: transform 0.2s ease, color 0.2s ease;
      margin-left: 2px;
    }
    .topbar-profile-btn.active .topbar-chevron-icon {
      transform: rotate(180deg);
      color: var(--sena-green);
    }

    /* Menu flotante del perfil */
    .topbar-dropdown-menu {
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      width: 270px;
      background: #ffffff;
      border: 1px solid #E2E8F0;
      border-radius: 16px;
      box-shadow: 0 12px 28px -4px rgba(11, 59, 36, 0.12), 0 8px 12px -6px rgba(0, 0, 0, 0.06);
      padding: 10px;
      z-index: 1000;
      display: none;
      animation: dropdownFadeIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .topbar-dropdown-menu.show {
      display: block;
    }
    @keyframes dropdownFadeIn {
      from { opacity: 0; transform: translateY(-8px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .dropdown-user-header {
      padding: 10px 12px 12px;
      background: #F8FAFC;
      border-radius: 12px;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .dropdown-user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--sena-green);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      font-weight: 800;
      flex-shrink: 0;
      letter-spacing: 0.5px;
    }
    .dropdown-user-meta {
      flex: 1;
      min-width: 0;
    }
    .dropdown-user-name {
      font-size: 13px;
      font-weight: 700;
      color: var(--ink);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      display: block;
    }
    .dropdown-user-email {
      font-size: 11px;
      color: var(--ink-soft);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      display: block;
      margin-top: 1px;
    }
    .dropdown-role-badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 10px;
      font-weight: 700;
      color: var(--sena-green);
      background: #EAF7EE;
      border: 1px solid #BBF7D0;
      padding: 2px 8px;
      border-radius: 12px;
      margin-top: 4px;
    }

    .dropdown-divider {
      height: 1px;
      background: #F1F5F9;
      margin: 8px 0;
    }

    .dropdown-nav-items {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }
    .dropdown-link-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 12px;
      font-size: 12.5px;
      font-weight: 600;
      color: var(--ink-soft);
      border-radius: 8px;
      text-decoration: none;
      transition: var(--transition);
      cursor: pointer;
    }
    .dropdown-link-item:hover {
      background: #F1F5F9;
      color: var(--forest);
    }
    .dropdown-link-item i {
      font-size: 13px;
      width: 16px;
      text-align: center;
      color: #94A3B8;
      transition: var(--transition);
    }
    .dropdown-link-item:hover i {
      color: var(--forest);
    }

    .dropdown-footer {
      padding-top: 2px;
    }
    .dropdown-logout-btn {
      width: 100%;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 12px;
      font-size: 12.5px;
      font-weight: 700;
      color: #EF4444;
      background: transparent;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: var(--transition);
      font-family: inherit;
      text-align: left;
    }
    .dropdown-logout-btn:hover {
      background: #FEF2F2;
      color: #DC2626;
    }
    .dropdown-logout-btn i {
      font-size: 13px;
      width: 16px;
      text-align: center;
      color: #EF4444;
    }

    /* ========================================================
       PAGE CONTENT & SECTIONS
       ======================================================== */
    .content-container {
      padding: 32px 36px 60px;
      flex: 1;
    }

    .section-tab {
      display: none;
      animation: fadeIn 0.25s ease-in-out;
    }
    .section-tab.active {
      display: block;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* ========================================================
       HERO BANNER (Diseño Institucional SENA Empresa ERP)
       ======================================================== */
    .hero-banner-card {
      background: linear-gradient(135deg, var(--sena-navy) 0%, var(--sena-dark) 100%);
      border-radius: var(--radius-xl);
      padding: 36px 40px;
      color: #FFFFFF;
      position: relative;
      overflow: hidden;
      margin-bottom: 26px;
      box-shadow: 0 10px 26px rgba(0, 19, 30, 0.18);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-left: 5px solid var(--sena-green);
      display: flex;
      align-items: center;
      justify-content: space-between;
      min-height: 180px;
    }
    .hero-banner-card::before {
      content: '';
      position: absolute;
      top: -60px;
      right: 180px;
      width: 220px;
      height: 220px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(57, 169, 0, 0.28) 0%, transparent 70%);
      pointer-events: none;
    }
    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 680px;
    }
    .hero-pill-badge {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: rgba(57, 169, 0, 0.18);
      border: 1px solid rgba(98, 227, 29, 0.45);
      backdrop-filter: blur(4px);
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 11.5px;
      font-weight: 700;
      color: var(--sena-neon);
      margin-bottom: 14px;
      letter-spacing: 0.02em;
    }
    .hero-heading {
      font-family: 'Poppins', 'Nunito', sans-serif;
      font-size: 32px;
      font-weight: 700;
      line-height: 1.15;
      color: #FFFFFF;
      margin-bottom: 10px;
      letter-spacing: -0.01em;
    }
    .hero-description {
      font-size: 13.5px;
      color: rgba(255, 255, 255, 0.82);
      line-height: 1.55;
      margin-bottom: 0;
    }
    .hero-action-box {
      position: relative;
      z-index: 2;
      flex-shrink: 0;
      margin-left: 24px;
    }
    .btn-hero-action {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--sena-green);
      color: #FFFFFF;
      border: none;
      padding: 12px 22px;
      border-radius: 12px;
      font-size: 13.5px;
      font-weight: 700;
      cursor: pointer;
      font-family: inherit;
      box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35);
      transition: var(--transition);
    }
    .btn-hero-action:hover {
      background: var(--sena-green-hover);
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(57, 169, 0, 0.45);
    }
    .hero-image-decor {
      position: absolute;
      right: 20px;
      bottom: -15px;
      height: 190px;
      opacity: 0.85;
      pointer-events: none;
      z-index: 1;
      object-fit: contain;
    }

  
    .kpi-row-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 22px;
      margin-bottom: 32px;
    }
    .kpi-metric-card {
      background: var(--card);
      border-radius: 18px;
      padding: 26px 28px;
      border: 1px solid var(--line);
      box-shadow: 0 4px 14px rgba(11, 59, 36, 0.04), 0 1px 3px rgba(0, 0, 0, 0.02);
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      cursor: pointer;
      position: relative;
      overflow: hidden;
      min-height: 125px;
    }
    .kpi-metric-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 24px rgba(11, 59, 36, 0.09), 0 3px 6px rgba(0, 0, 0, 0.04);
      border-color: #CBD5E1;
    }
    .kpi-data-col {
      display: flex;
      flex-direction: column;
    }
    .kpi-tag-label {
      font-size: 12px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: var(--ink-soft);
      margin-bottom: 8px;
    }
    .kpi-big-number {
      font-family: 'Poppins', 'Nunito', sans-serif;
      font-size: 42px;
      font-weight: 700;
      color: var(--ink);
      line-height: 1;
      margin-bottom: 8px;
    }
    .kpi-sub-text {
      font-size: 13.5px;
      color: var(--ink-soft);
      font-weight: 500;
    }
    .kpi-icon-badge {
      width: 56px;
      height: 56px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      flex-shrink: 0;
      transition: transform 0.25s ease;
    }
    .kpi-metric-card:hover .kpi-icon-badge {
      transform: scale(1.06);
    }
    .kpi-icon-badge.green { background: #EAF7EE; color: var(--sena-green); }
    .kpi-icon-badge.blue { background: #E0F2FE; color: #0284c7; }
    .kpi-icon-badge.orange { background: #FEF3C7; color: #d97706; }
    .kpi-icon-badge.purple { background: #F3E8FF; color: #9333ea; }
    .kpi-icon-badge.slate { background: #F1F5F9; color: #475569; }

    /* ========================================================
       SECTION HEADERS, FILTERS & CARDS (Encuestas, Oportunidades, etc.)
       ======================================================== */
    .section-header-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 14px;
    }
    .section-title-wrap h2 {
      font-family: 'Poppins', 'Nunito', sans-serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 4px;
    }
    .section-title-wrap p {
      font-size: 12.5px;
      color: var(--ink-soft);
    }

    .filter-toolbar-box {
      background: var(--card);
      border: 1px solid var(--line);
      border-radius: var(--radius-md);
      padding: 12px 18px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
      gap: 14px;
      flex-wrap: wrap;
    }
    .filter-tabs-group {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .filter-pill-btn {
      background: transparent;
      border: none;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 12.5px;
      font-weight: 600;
      color: var(--ink-soft);
      cursor: pointer;
      font-family: inherit;
      transition: var(--transition);
    }
    .filter-pill-btn:hover {
      background: #F1F5F9;
      color: var(--ink);
    }
    .filter-pill-btn.active {
      background: var(--forest);
      color: #FFFFFF;
      font-weight: 700;
    }
    .search-inputs-group {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .input-search-field {
      position: relative;
    }
    .input-search-field input {
      border: 1px solid var(--line);
      border-radius: 8px;
      padding: 8px 12px 8px 34px;
      font-size: 13px;
      outline: none;
      width: 220px;
      font-family: inherit;
      background: #fff;
      color: var(--ink);
      transition: var(--transition);
    }
    .input-search-field input:focus {
      border-color: var(--sena-green);
      box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.15);
    }
    .input-search-field i {
      position: absolute;
      left: 11px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--ink-muted);
      font-size: 13px;
    }
    .select-filter-dropdown {
      border: 1px solid var(--line);
      border-radius: 8px;
      padding: 8px 14px;
      font-size: 13px;
      font-weight: 500;
      color: var(--ink);
      background: #fff;
      outline: none;
      cursor: pointer;
      font-family: inherit;
    }

    /* Content Two-Column Layout */
    .two-column-layout {
      display: grid;
      grid-template-columns: 1fr 310px;
      gap: 24px;
    }

    /* Card Item (Encuesta / Empleo / Evento) */
    .portal-item-card {
      background: var(--card);
      border: 1px solid var(--line);
      border-radius: var(--radius-lg);
      padding: 22px;
      margin-bottom: 16px;
      box-shadow: var(--shadow-sm);
      display: flex;
      gap: 18px;
      transition: var(--transition);
    }
    .portal-item-card:hover {
      box-shadow: var(--shadow-md);
      border-color: #CBD5E1;
      transform: translateY(-1px);
    }
    .card-icon-pill {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }
    .card-icon-pill.green { background: #EAF7EE; color: var(--sena-green); }
    .card-icon-pill.blue { background: #E0F2FE; color: #0284c7; }
    .card-icon-pill.purple { background: #F3E8FF; color: #9333ea; }
    .card-icon-pill.amber { background: #FEF3C7; color: #d97706; }

    .card-body-content {
      flex: 1;
      min-width: 0;
    }
    .card-top-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 8px;
    }
    .card-title-text {
      font-size: 15px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 4px;
    }
    .card-tag-badge {
      display: inline-block;
      font-size: 11px;
      font-weight: 700;
      padding: 3px 9px;
      border-radius: 20px;
      background: #EAF7EE;
      color: #166534;
    }
    .card-tag-badge.blue { background: #E0F2FE; color: #0369a1; }
    .card-tag-badge.purple { background: #F3E8FF; color: #7e22ce; }
    .card-tag-badge.completed { background: #DCFCE7; color: #15803d; }

    .card-meta-list {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      font-size: 12px;
      color: var(--ink-soft);
      margin: 8px 0 10px;
    }
    .card-meta-list span {
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .card-desc-paragraph {
      font-size: 13px;
      color: var(--ink-soft);
      line-height: 1.5;
      margin-bottom: 14px;
    }

    .card-action-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-top: 10px;
      border-top: 1px solid var(--line-subtle);
    }
    .card-progress-col {
      width: 200px;
    }
    .progress-bar-track {
      height: 6px;
      background: #E2E8F0;
      border-radius: 4px;
      overflow: hidden;
      margin-bottom: 4px;
    }
    .progress-bar-fill {
      height: 100%;
      background: var(--green-active);
      border-radius: 4px;
      transition: width 0.3s;
    }
    .progress-label-text {
      font-size: 11px;
      color: var(--ink-soft);
      font-weight: 600;
    }

    .btn-green-submit {
      background: var(--sena-green);
      color: #FFFFFF;
      border: none;
      padding: 9px 18px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      font-family: inherit;
      transition: var(--transition);
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .btn-green-submit:hover {
      background: var(--sena-green-hover);
      transform: translateY(-1px);
    }
    .btn-card-outline {
      background: transparent;
      border: 1px solid var(--line);
      color: var(--ink-soft);
      padding: 8px 14px;
      border-radius: 8px;
      font-size: 12.5px;
      font-weight: 700;
      cursor: pointer;
      font-family: inherit;
      transition: var(--transition);
    }
    .btn-card-outline:hover {
      background: #F8FAFC;
      color: var(--ink);
      border-color: #CBD5E1;
    }

    /* Side Info Panel */
    .side-widget-card {
      background: var(--card);
      border: 1px solid var(--line);
      border-radius: var(--radius-lg);
      padding: 22px;
      margin-bottom: 18px;
      box-shadow: var(--shadow-sm);
    }
    .side-widget-title {
      font-family: 'Poppins', 'Nunito', sans-serif;
      font-size: 16.5px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 14px;
    }
    .side-reasons-list {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }
    .side-reason-item {
      display: flex;
      gap: 12px;
      align-items: flex-start;
    }
    .side-reason-icon {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      background: var(--green-soft);
      color: var(--forest);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      flex-shrink: 0;
    }
    .side-reason-text h4 {
      font-size: 13px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 2px;
    }
    .side-reason-text p {
      font-size: 12px;
      color: var(--ink-soft);
      line-height: 1.4;
    }

    /* ========================================================
       MODALES Y CONFIRMACIÓN CENTRADA (Requerimiento especial)
       ======================================================== */
    .modal-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(0, 19, 30, 0.75);
      backdrop-filter: blur(5px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      opacity: 0;
      visibility: hidden;
      transition: all 0.25s ease;
      padding: 20px;
    }
    .modal-backdrop.active {
      opacity: 1;
      visibility: visible;
    }

    .modal-box-card {
      background: #FFFFFF;
      border-radius: var(--radius-xl);
      padding: 30px;
      max-width: 540px;
      width: 100%;
      position: relative;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
      transform: scale(0.95) translateY(10px);
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      max-height: 90vh;
      overflow-y: auto;
    }
    .modal-backdrop.active .modal-box-card {
      transform: scale(1) translateY(0);
    }
    .modal-close-x {
      position: absolute;
      top: 18px;
      right: 18px;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: #F1F5F9;
      border: none;
      color: var(--ink-soft);
      font-size: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: var(--transition);
    }
    .modal-close-x:hover {
      background: #E2E8F0;
      color: var(--ink);
    }

    /* Modal Encuesta Preguntas */
    .modal-header-banner {
      background: var(--green-soft);
      border: 1px solid var(--green-soft-border);
      border-radius: var(--radius-md);
      padding: 16px;
      margin-bottom: 20px;
    }
    .modal-header-banner h3 {
      font-family: 'Poppins', 'Nunito', sans-serif;
      font-size: 17px;
      font-weight: 700;
      color: var(--forest);
      margin-bottom: 4px;
    }
    .modal-header-banner p {
      font-size: 12.5px;
      color: var(--forest);
      margin: 0;
    }
    .question-block {
      border-bottom: 1px solid var(--line);
      padding-bottom: 18px;
      margin-bottom: 18px;
    }
    .question-block:last-of-type {
      border-bottom: none;
      padding-bottom: 0;
    }
    .question-title {
      font-size: 13.5px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 10px;
    }
    .question-title span { color: #dc2626; }
    .option-radio-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 8px;
      font-size: 13px;
      color: var(--ink);
      cursor: pointer;
    }
    .option-radio-row input[type="radio"] {
      accent-color: var(--forest);
      width: 16px;
      height: 16px;
    }

    /* MODAL DE CONFIRMACIÓN CENTRADA CON EL "CHULO" (Requerimiento exacto del usuario) */
    .success-modal-card {
      background: #FFFFFF;
      border-radius: var(--radius-xl);
      padding: 40px 32px 36px;
      max-width: 420px;
      width: 100%;
      text-align: center;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      position: relative;
      transform: scale(0.92);
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .modal-backdrop.active .success-modal-card {
      transform: scale(1);
    }
    .chulo-circle-badge {
      width: 76px;
      height: 76px;
      border-radius: 50%;
      background: #EAF7EE;
      color: var(--sena-green);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 36px;
      margin: 0 auto 20px;
      box-shadow: 0 8px 24px rgba(57, 169, 0, 0.25);
      border: 3px solid #BBF7D0;
    }
    .success-modal-card h3 {
      font-family: 'Poppins', 'Nunito', sans-serif;
      font-size: 24px;
      font-weight: 700;
      color: var(--sena-dark);
      margin-bottom: 10px;
      letter-spacing: -0.01em;
    }
    .success-modal-card p {
      font-size: 13.5px;
      color: var(--ink-soft);
      line-height: 1.5;
      margin-bottom: 26px;
    }
    .btn-modal-accept {
      background: var(--sena-green);
      color: #FFFFFF;
      border: none;
      padding: 13px 36px;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 800;
      cursor: pointer;
      font-family: inherit;
      width: 100%;
      max-width: 240px;
      transition: var(--transition);
      box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35);
    }
    .btn-modal-accept:hover {
      background: var(--sena-green-hover);
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(57, 169, 0, 0.45);
    }

    /* Centered Toast Alert */
    .toast-alert {
      position: fixed;
      bottom: 30px;
      left: 50%;
      transform: translateX(-50%) translateY(30px);
      background: var(--forest-deep);
      color: #FFFFFF;
      padding: 12px 24px;
      border-radius: 30px;
      font-size: 13.5px;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.15);
      z-index: 1100;
      opacity: 0;
      pointer-events: none;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .toast-alert.show {
      opacity: 1;
      transform: translateX(-50%) translateY(0);
      pointer-events: auto;
    }
    .toast-alert i {
      color: #22c55e;
      font-size: 16px;
    }

    /* Responsive Queries */
    @media (max-width: 1050px) {
      .app-layout { grid-template-columns: 1fr; }
      .sidebar { display: none; }
      .two-column-layout { grid-template-columns: 1fr; }
      .hero-image-decor { display: none; }
    }
    @media (max-width: 640px) {
      .topbar { padding: 12px 18px; }
      .content-container { padding: 20px 16px 40px; }
      .hero-banner-card { padding: 24px 20px; flex-direction: column; align-items: flex-start; gap: 18px; }
      .hero-action-box { margin-left: 0; }
      .hero-heading { font-size: 24px; }
      .kpi-row-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<div class="app-layout">

  <!-- ========================================================
       BARRA LATERAL / SIDEBAR (Paleta y estructura admin/encuestas)
       ======================================================== -->
  <aside class="sidebar">

    <!-- Marca / Logo SENA SIGE -->
    <div class="brand-box" onclick="showSection('inicio')">
      <div class="brand-icon-wrap">
        <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="SENA">
      </div>
      <div class="brand-titles">
        <div class="brand-row">
          <span class="brand-title">SIGE</span>
        </div>
        <span class="brand-sub"> Sistema de Gestión de Egresados</span>
      </div>
    </div>

    <!-- Navegación Principal -->
    <div class="nav-label">Portal Egresados</div>
    <nav class="nav-list">
      <a id="nav-inicio" class="nav-item active" onclick="showSection('inicio')">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
      </a>
      <a id="nav-encuestas" class="nav-item" onclick="showSection('encuestas')">
        <i class="fa-solid fa-clipboard-question"></i>
        <span>Encuestas</span>
        <span class="nav-badge" id="nav-badge-encuestas">{{ $encuestasPendientes ?? 2 }}</span>
      </a>
      <a id="nav-oportunidades" class="nav-item" onclick="showSection('oportunidades')">
        <i class="fa-solid fa-briefcase"></i>
        <span>Oportunidades Laborales</span>
      </a>
      <a id="nav-noticias" class="nav-item" onclick="showSection('noticias')">
        <i class="fa-regular fa-calendar-days"></i>
        <span>Eventos</span>
      </a>
      <a id="nav-notificaciones" class="nav-item" onclick="showSection('notificaciones')">
        <i class="fa-regular fa-bell"></i>
        <span>Notificaciones</span>
      </a>
    </nav>

  </aside>

  <!-- ========================================================
       CONTENIDO PRINCIPAL
       ======================================================== -->
  <div class="main-wrapper">

    <!-- BARRA SUPERIOR / TOPBAR -->
    <header class="topbar">
      <div></div>

      <div class="topbar-right">
        <button type="button" class="btn-notif-bell" onclick="showSection('notificaciones')" title="Ver notificaciones">
          <i class="fa-regular fa-bell"></i>
          <span class="notif-bubble"></span>
        </button>

        <!-- Dropdown Perfil de Egresada -->
        <div class="topbar-profile-wrapper" id="profileDropdownWrapper">
          <button type="button" class="topbar-profile-btn" id="profileDropdownBtn" onclick="toggleProfileDropdown()" aria-expanded="false" title="Menú de perfil">
            <div class="topbar-avatar-small">
              @auth {{ Auth::user()->initials ?? 'VR' }} @else VR @endauth
            </div>
            <span class="topbar-profile-name">
              @auth {{ Auth::user()->short_name ?? Auth::user()->first_name ?? Auth::user()->name }} @else Valentina Ríos @endauth
            </span>
            <i class="fa-solid fa-chevron-down topbar-chevron-icon" id="profileChevronIcon"></i>
          </button>

          <!-- Menú Desplegable -->
          <div class="topbar-dropdown-menu" id="profileDropdownMenu">
            <div class="dropdown-user-header">
              <div class="dropdown-user-avatar">
                @auth {{ Auth::user()->initials ?? 'VR' }} @else VR @endauth
              </div>
              <div class="dropdown-user-meta">
                <span class="dropdown-user-name">
                  @auth {{ Auth::user()->full_name }} @else Valentina Ríos Egresada @endauth
                </span>
                <span class="dropdown-user-email">
                  @auth {{ Auth::user()->email }} @else egresado.sige@sena.edu.co @endauth
                </span>
                <span class="dropdown-role-badge">
                  <i class="fa-solid fa-graduation-cap"></i> Egresada SENA
                </span>
              </div>
            </div>

            <div class="dropdown-divider"></div>

            <div class="dropdown-nav-items">
              <a href="{{ route('egresados.welcome') }}" class="dropdown-link-item">
                <i class="fa-solid fa-globe"></i>
                <span>Portal Público</span>
              </a>
            </div>

            <div class="dropdown-divider"></div>

            <div class="dropdown-footer">
              @auth
                <form action="{{ route('logout') }}" method="POST" id="topbar-logout-form" style="margin:0;">
                  @csrf
                  <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
                  <button type="submit" class="dropdown-logout-btn">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Cerrar Sesión</span>
                  </button>
                </form>
              @else
                <a href="{{ route('login', ['redirect' => route('egresados.dashboard_egresado')]) }}" class="dropdown-logout-btn">
                  <i class="fa-solid fa-arrow-right-to-bracket"></i>
                  <span>Cerrar Sesión</span>
                </a>
              @endauth
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- ÁREA DE CONTENIDO -->
    <main class="content-container">

      <!-- ========================================================
           SECCIÓN 1: INICIO (SOLO BANNER HERO + 3 TARJETAS KPI)
           ======================================================== -->
      <section id="section-inicio" class="section-tab active">

        <!-- Banner Hero con estética Forest Green -->
        <div class="hero-banner-card">
          <div class="hero-content">
            <div class="hero-pill-badge">
              <i class="fa-solid fa-check-circle"></i>
              <span>Comunidad de Egresados · CEFA La Angostura</span>
            </div>
            <h1 class="hero-heading">
              ¡Bienvenido(a), @auth {{ Auth::user()->first_name ?? Auth::user()->name }} @else Nicol @endauth!
            </h1>
            <p class="hero-description">
              Mantén actualizado tu perfil, participa activamente en los sondeos de seguimiento y aprovecha las oportunidades laborales y convocatorias vigentes.
            </p>
          </div>
          <img src="{{ route('egresados.assets.image', 'egresados-banner-transparent.png') }}" class="hero-image-decor" alt="Egresados SENA">
        </div>

        @if(isset($invitacionesEventos) && count($invitacionesEventos) > 0)
          @php $primeraInv = reset($invitacionesEventos); @endphp
          <div style="background: linear-gradient(135deg, #00131E 0%, #002336 100%); border-left: 5px solid #39A900; border-radius: 16px; padding: 16px 20px; margin-bottom: 24px; color: #fff; display: flex; align-items: center; justify-content: space-between; gap: 16px; box-shadow: 0 4px 16px rgba(0,19,30,0.12);">
            <div style="display: flex; align-items: center; gap: 14px;">
              <div style="width: 42px; height: 42px; border-radius: 12px; background: #39A900; display: flex; align-items: center; justify-content: center; font-size: 18px; color: #fff; flex-shrink: 0;">
                <i class="fa-solid fa-paper-plane"></i>
              </div>
              <div>
                <span style="font-size: 10px; font-weight: 800; color: #62E31D; text-transform: uppercase; letter-spacing: 0.5px;">¡Nueva Invitación Institucional!</span>
                <h4 style="font-size: 14px; font-weight: 700; margin: 2px 0 0; color: #fff;">{{ $primeraInv['title'] ?? 'Evento Institucional CEFA' }}</h4>
                <p style="font-size: 12px; color: rgba(255,255,255,0.8); margin: 2px 0 0;">{{ $primeraInv['date'] ?? 'Próximamente' }} | {{ $primeraInv['location'] ?? 'CEFA' }} · Dirigido a: {{ $primeraInv['program'] ?? 'Egresados' }}</p>
              </div>
            </div>
            <button type="button" class="btn-green-submit" style="padding: 8px 16px; font-size: 12px; font-weight: 700; border-radius: 10px; white-space: nowrap; cursor: pointer;" onclick="showSection('noticias');">
              Ver e Inscribirme
            </button>
          </div>
        @endif

        <!-- Solo las 3 Tarjetas KPI solicitadas explícitamente -->
        <div class="kpi-row-grid">
          <!-- KPI 1: Encuestas Pendientes -->
          <div class="kpi-metric-card" onclick="showSection('encuestas')">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">ENCUESTAS PENDIENTES</span>
              <span class="kpi-big-number" id="kpi-inicio-encuestas-pendientes">{{ $encuestasPendientes ?? 2 }}</span>
              <span class="kpi-sub-text" id="kpi-inicio-subtext-encuestas">Por responder actualmente</span>
            </div>
            <div class="kpi-icon-badge green">
              <i class="fa-solid fa-clipboard-list"></i>
            </div>
          </div>

          <!-- KPI 2: Oportunidades Laborales -->
          <div class="kpi-metric-card" onclick="showSection('oportunidades')">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">OFERTAS LABORALES</span>
              <span class="kpi-big-number" id="kpi-inicio-ofertas-count">3</span>
              <span class="kpi-sub-text">Vacantes disponibles hoy</span>
            </div>
            <div class="kpi-icon-badge blue">
              <i class="fa-solid fa-briefcase"></i>
            </div>
          </div>

          <!-- KPI 3: Eventos Activos -->
          <div class="kpi-metric-card" onclick="showSection('noticias')">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">EVENTOS ACTIVOS</span>
              <span class="kpi-big-number" id="kpi-inicio-eventos-count">{{ $totalEventosActivos ?? 2 }}</span>
              <span class="kpi-sub-text">Talleres y encuentros</span>
            </div>
            <div class="kpi-icon-badge purple">
              <i class="fa-regular fa-calendar-days"></i>
            </div>
          </div>
        </div>

      </section>

      <!-- ========================================================
           SECCIÓN 2: ENCUESTAS
           ======================================================== -->
      <section id="section-encuestas" class="section-tab">

        <!-- Banner Encuestas estilo Admin -->
        <div class="hero-banner-card">
          <div class="hero-content">
            <h1 class="hero-heading">Control de Encuestas a Egresados</h1>
            <p class="hero-description">
              Participa en los instrumentos para medir empleabilidad, evaluar la calidad formativa y registrar proyectos de emprendimiento de los graduados del CEFA.
            </p>
          </div>
        </div>

        <!-- Métricas KPI Encuestas (estilo imagen admin) -->
        <div class="kpi-row-grid">
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">TOTAL ENCUESTAS</span>
              <span class="kpi-big-number" id="kpi-total-encuestas">7</span>
              <span class="kpi-sub-text">Instrumentos</span>
            </div>
            <div class="kpi-icon-badge slate">
              <i class="fa-solid fa-list-check"></i>
            </div>
          </div>

          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">PENDIENTES</span>
              <span class="kpi-big-number" id="kpi-encuestas-pendientes">{{ $encuestasPendientes ?? 2 }}</span>
              <span class="kpi-sub-text">Por completar</span>
            </div>
            <div class="kpi-icon-badge orange">
              <i class="fa-regular fa-clock"></i>
            </div>
          </div>

          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">COMPLETADAS</span>
              <span class="kpi-big-number" id="kpi-encuestas-completadas">5</span>
              <span class="kpi-sub-text">Finalizadas</span>
            </div>
            <div class="kpi-icon-badge green">
              <i class="fa-solid fa-circle-check"></i>
            </div>
          </div>

          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">TASA RESPUESTA</span>
              <span class="kpi-big-number" id="kpi-tasa-respuesta">71%</span>
              <span class="kpi-sub-text">Efectividad global</span>
            </div>
            <div class="kpi-icon-badge purple">
              <i class="fa-solid fa-chart-pie"></i>
            </div>
          </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="filter-toolbar-box">
          <div class="filter-tabs-group">
            <button class="filter-pill-btn active" id="tab-filter-todas" onclick="filterSurveys('todas', this)">Todas (<span id="count-filter-todas">{{ $encuestasPendientes ?? 2 }}</span>)</button>
            <button class="filter-pill-btn" id="tab-filter-pendientes" onclick="filterSurveys('pendientes', this)">Pendientes (<span id="count-filter-pendientes">{{ $encuestasPendientes ?? 2 }}</span>)</button>
            <button class="filter-pill-btn" id="tab-filter-completadas" onclick="filterSurveys('completadas', this)">Respondidas (<span id="count-filter-completadas">5</span>)</button>
          </div>
          <div class="search-inputs-group">
            <div class="input-search-field">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input type="text" id="search-survey" placeholder="Buscar por título o target..." onkeyup="searchSurveys(this.value)">
            </div>
            <select class="select-filter-dropdown" onchange="filterSurveyCategory(this.value)">
              <option value="todas">-- Todos los estados --</option>
              <option value="institucional">Institucional</option>
              <option value="laboral">Seguimiento Laboral</option>
            </select>
          </div>
        </div>

        <!-- Listado de Encuestas + Panel Lateral -->
        <div class="two-column-layout">
          <div id="survey-list-container">

            <!-- Encuesta 1 -->
            <div class="portal-item-card survey-card-item" id="survey-card-1" data-id="1" data-type="pendientes" data-cat="institucional">
              <div class="card-icon-pill green" id="survey-icon-1">
                <i class="fa-regular fa-clipboard"></i>
              </div>
              <div class="card-body-content">
                <div class="card-top-header">
                  <div>
                    <h3 class="card-title-text">Satisfacción con los servicios institucionales 2026</h3>
                    <span class="card-tag-badge" id="survey-badge-1">Institucional · CEFA</span>
                  </div>
                  <div id="survey-btn-wrap-1">
                    <button type="button" class="btn-green-submit" onclick="openSurveyModal('Satisfacción con los servicios institucionales 2026', 1)">
                      <i class="fa-solid fa-pen-to-square"></i>
                      <span>Responder</span>
                    </button>
                  </div>
                </div>
                <div class="card-meta-list" id="survey-meta-1">
                  <span><i class="fa-regular fa-calendar"></i> Límite: 31 de mayo, 2026</span>
                  <span><i class="fa-regular fa-clock"></i> Tiempo estimado: 10 min</span>
                  <span><i class="fa-solid fa-shield-halved"></i> 100% Confidencial</span>
                </div>
                <p class="card-desc-paragraph">
                  Ayúdanos a evaluar los procesos de formación, laboratorios agroindustriales y acompañamiento recibido durante tu permanencia en el centro formativo.
                </p>
                <div class="card-action-bar">
                  <div class="card-progress-col" id="survey-progress-1">
                    <div class="progress-bar-track"><div class="progress-bar-fill" style="width: 0%;"></div></div>
                    <span class="progress-label-text">0% completado</span>
                  </div>
                  <button type="button" class="btn-card-outline" id="survey-detail-btn-1" onclick="openSurveyModal('Satisfacción con los servicios institucionales 2026', 1)">
                    <span>Ver detalles</span>
                    <i class="fa-solid fa-arrow-right" style="font-size:11px; margin-left:4px;"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Encuesta 2 -->
            <div class="portal-item-card survey-card-item" id="survey-card-2" data-id="2" data-type="pendientes" data-cat="laboral">
              <div class="card-icon-pill purple" id="survey-icon-2">
                <i class="fa-solid fa-briefcase"></i>
              </div>
              <div class="card-body-content">
                <div class="card-top-header">
                  <div>
                    <h3 class="card-title-text">Seguimiento e Inserción Laboral ADSO / TIC 2026</h3>
                    <span class="card-tag-badge purple" id="survey-badge-2">Empleabilidad</span>
                  </div>
                  <div id="survey-btn-wrap-2">
                    <button type="button" class="btn-green-submit" onclick="openSurveyModal('Seguimiento e Inserción Laboral ADSO / TIC 2026', 2)">
                      <i class="fa-solid fa-pen-to-square"></i>
                      <span>Responder</span>
                    </button>
                  </div>
                </div>
                <div class="card-meta-list" id="survey-meta-2">
                  <span><i class="fa-regular fa-calendar"></i> Límite: 15 de junio, 2026</span>
                  <span><i class="fa-regular fa-clock"></i> Tiempo estimado: 15 min</span>
                  <span><i class="fa-solid fa-users"></i> Egresados Tecnólogos</span>
                </div>
                <p class="card-desc-paragraph">
                  Información clave para monitorear tu estatus de vinculación en empresas de desarrollo tecnológico, rango salarial y pertinencia de las competencias adquiridas.
                </p>
                <div class="card-action-bar">
                  <div class="card-progress-col" id="survey-progress-2">
                    <div class="progress-bar-track"><div class="progress-bar-fill" style="width: 0%;"></div></div>
                    <span class="progress-label-text">0% completado</span>
                  </div>
                  <button type="button" class="btn-card-outline" id="survey-detail-btn-2" onclick="openSurveyModal('Seguimiento e Inserción Laboral ADSO / TIC 2026', 2)">
                    <span>Ver detalles</span>
                    <i class="fa-solid fa-arrow-right" style="font-size:11px; margin-left:4px;"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Encuesta 3: Completada -->
            <div class="portal-item-card survey-card-item" id="survey-card-3" data-id="3" data-type="completadas" data-cat="institucional">
              <div class="card-icon-pill green" id="survey-icon-3">
                <i class="fa-solid fa-circle-check"></i>
              </div>
              <div class="card-body-content">
                <div class="card-top-header">
                  <div>
                    <h3 class="card-title-text">Impacto y Empleabilidad 2025</h3>
                    <span class="card-tag-badge completed" id="survey-badge-3">Completada · Registrada</span>
                  </div>
                  <div id="survey-btn-wrap-3">
                    <button type="button" class="btn-card-outline" style="border-color:#16a34a; color:#16a34a; background:#f0fdf4; cursor:default;" onclick="showToast('Ya has respondido esta encuesta con éxito')">
                      <i class="fa-solid fa-check"></i>
                      <span>Enviada</span>
                    </button>
                  </div>
                </div>
                <div class="card-meta-list" id="survey-meta-3">
                  <span><i class="fa-regular fa-calendar-check"></i> Finalizada el 2025-11-20</span>
                  <span><i class="fa-solid fa-check-double"></i> Respuestas guardadas</span>
                </div>
                <p class="card-desc-paragraph">
                  Encuesta anual finalizada con éxito. Agradecemos tus aportes que permitieron la renovación del plan curricular de tecnologías informáticas.
                </p>
                <div class="card-action-bar">
                  <div class="card-progress-col" id="survey-progress-3">
                    <div class="progress-bar-track"><div class="progress-bar-fill" style="width: 100%;"></div></div>
                    <span class="progress-label-text" style="color:#16a34a; font-weight:700;"><i class="fa-solid fa-check"></i> 100% completada</span>
                  </div>
                  <button type="button" class="btn-card-outline" id="survey-detail-btn-3" onclick="showToast('Visualizando histórico de respuestas...')">
                    <span>Ver respuestas</span>
                    <i class="fa-solid fa-arrow-right" style="font-size:11px; margin-left:4px;"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Estado vacío cuando no hay encuestas en el filtro actual -->
            <div id="survey-empty-state" class="portal-item-card" style="display:none; text-align:center; padding:36px 20px; align-items:center; justify-content:center; flex-direction:column; background:#F8FAFC; border:1px dashed #CBD5E1; border-radius:var(--radius-lg); width:100%;">
              <div style="width:52px; height:52px; border-radius:50%; background:#DCFCE7; color:#16a34a; display:flex; align-items:center; justify-content:center; font-size:22px; margin-bottom:12px;">
                <i class="fa-solid fa-check-double"></i>
              </div>
              <h4 id="empty-state-title" style="font-size:15px; font-weight:700; color:var(--ink); margin-bottom:4px;">¡Estás al día con tus encuestas!</h4>
              <p id="empty-state-desc" style="font-size:13px; color:var(--ink-soft); margin:0 0 16px; max-width:420px; text-align:center;">
                No tienes instrumentos pendientes por diligenciar. Puedes revisar tus respuestas guardadas en la pestaña <strong>Respondidas</strong>.
              </p>
              <button type="button" class="btn-card-outline" onclick="filterSurveys('completadas', document.getElementById('tab-filter-completadas'))" style="border-color:#16a34a; color:#16a34a;">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Ver encuestas respondidas</span>
              </button>
            </div>

          </div>

          <!-- Panel Lateral: Beneficios de responder -->
          <aside>
            <div class="side-widget-card">
              <h3 class="side-widget-title">¿Por qué participar?</h3>
              <div class="side-reasons-list">
                <div class="side-reason-item">
                  <div class="side-reason-icon"><i class="fa-solid fa-bullseye"></i></div>
                  <div class="side-reason-text">
                    <h4>Impacto Directo</h4>
                    <p>Tus respuestas guían la modernización de los programas técnicos y tecnólogos del SENA.</p>
                  </div>
                </div>
                <div class="side-reason-item">
                  <div class="side-reason-icon"><i class="fa-solid fa-user-shield"></i></div>
                  <div class="side-reason-text">
                    <h4>100% Confidencial</h4>
                    <p>Los datos son manejados bajo estricta reserva estadística institucional.</p>
                  </div>
                </div>
                <div class="side-reason-item">
                  <div class="side-reason-icon"><i class="fa-solid fa-handshake"></i></div>
                  <div class="side-reason-text">
                    <h4>Oportunidades Futuras</h4>
                    <p>Permite priorizar convenios de vinculación y bolsas de empleo para tu área.</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="side-widget-card" style="background:#F0FDF4; border-color:#BBF7D0;">
              <div style="display:flex; gap:10px; align-items:flex-start;">
                <i class="fa-solid fa-circle-info" style="color:#16a34a; font-size:18px; margin-top:2px;"></i>
                <div>
                  <h4 style="font-size:13.5px; font-weight:700; color:#166534; margin-bottom:4px;">Recordatorio Importante</h4>
                  <p style="font-size:12px; color:#14532d; line-height:1.45; margin:0;">
                    Recibirás una notificación y correo de confirmación tan pronto envíes tus respuestas.
                  </p>
                </div>
              </div>
            </div>
          </aside>
        </div>

      </section>

      <!-- ========================================================
           SECCIÓN 3: OPORTUNIDADES LABORALES
           ======================================================== -->
      <section id="section-oportunidades" class="section-tab">

        <div class="hero-banner-card">
          <div class="hero-content">
            <h1 class="hero-heading">Oportunidades Laborales</h1>
            <p class="hero-description">
              Encuentra vacantes de empleo, proyectos de desarrollo y ofertas dirigidas exclusivamente a la comunidad de egresados del CEFA La Angostura.
            </p>
          </div>
        </div>

        <!-- KPIs Oportunidades -->
        <div class="kpi-row-grid">
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">OFERTAS ACTIVAS</span>
              <span class="kpi-big-number" id="kpi-ofertas-activas-count">3</span>
              <span class="kpi-sub-text">Vacantes abiertas</span>
            </div>
            <div class="kpi-icon-badge blue"><i class="fa-solid fa-briefcase"></i></div>
          </div>
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">GUARDADAS</span>
              <span class="kpi-big-number" id="kpi-guardadas-count">0</span>
              <span class="kpi-sub-text">Favoritas</span>
            </div>
            <div class="kpi-icon-badge orange"><i class="fa-regular fa-bookmark"></i></div>
          </div>
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">POSTULACIONES</span>
              <span class="kpi-big-number" id="kpi-postulaciones-count">0</span>
              <span class="kpi-sub-text">Enviadas</span>
            </div>
            <div class="kpi-icon-badge green"><i class="fa-solid fa-paper-plane"></i></div>
          </div>
        </div>

        <!-- Filtros -->
        <div class="filter-toolbar-box">
          <div class="search-inputs-group" style="width:100%; justify-content:space-between; flex-wrap:wrap;">
            <div class="input-search-field" style="flex:1; max-width:340px;">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input type="text" id="input-buscar-ofertas" placeholder="Buscar por cargo, empresa o tecnología..." style="width:100%;" oninput="filtrarOfertasLaborales()">
            </div>
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
              <select class="select-filter-dropdown" id="select-filtro-ubicacion" onchange="filtrarOfertasLaborales()">
                <option value="todas">📍 Todas las ubicaciones</option>
                <option value="neiva">Neiva (Híbrido)</option>
                <option value="campoalegre">Campoalegre, Huila</option>
                <option value="remoto">Remoto (Colombia)</option>
              </select>
              <select class="select-filter-dropdown" id="select-filtro-area" onchange="filtrarOfertasLaborales()">
                <option value="todas">🏷 Todas las áreas</option>
                <option value="tecnologia">Tecnología & Software</option>
                <option value="agroindustria">Agroindustria & Alimentos</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Listado de Ofertas -->
        <div style="display: flex; flex-direction: column;">

          <!-- Oferta 1 -->
          <div class="portal-item-card job-card-item" data-job-id="job-1" data-location="neiva" data-area="tecnologia" data-type="completo">
            <div class="card-icon-pill blue">
              <i class="fa-solid fa-code"></i>
            </div>
            <div class="card-body-content">
              <div class="card-top-header">
                <div>
                  <h3 class="card-title-text">Desarrollador Junior Full Stack (PHP / Laravel)</h3>
                  <span class="card-tag-badge blue">Tecnología &bull; TrabSistema S.A.S.</span>
                </div>
                <button type="button" class="btn-green-submit" id="btn-postular-job-1" onclick="postularOferta('Desarrollador Junior Full Stack (PHP / Laravel)', 'TrabSistema S.A.S.', 'Neiva (Híbrido)', '$2.500.000 - $3.200.000', this, 'job-1')">
                  <i class="fa-solid fa-paper-plane"></i>
                  <span>Postularme</span>
                </button>
              </div>
              <div class="card-meta-list">
                <span><i class="fa-solid fa-location-dot"></i> Neiva (Híbrido)</span>
                <span><i class="fa-regular fa-clock"></i> Tiempo Completo</span>
                <span><i class="fa-solid fa-money-bill-wave"></i> $2.500.000 - $3.200.000</span>
              </div>
              <p class="card-desc-paragraph">
                Empresa de software regional busca tecnólogo en ADSO egresado del SENA para soporte y desarrollo de módulos en Laravel y Vue.js.
              </p>
              <div class="card-action-bar">
                <span style="font-size:12px; color:var(--ink-soft);"><i class="fa-regular fa-calendar"></i> Publicada hace 1 día</span>
                <button type="button" class="btn-card-outline" id="btn-guardar-job-1" onclick="toggleBookmark(this, 'job-1')">
                  <i class="fa-regular fa-bookmark"></i>
                  <span>Guardar</span>
                </button>
              </div>
            </div>
          </div>

          <!-- Oferta 2 -->
          <div class="portal-item-card job-card-item" data-job-id="job-2" data-location="campoalegre" data-area="agroindustria" data-type="completo">
            <div class="card-icon-pill green">
              <i class="fa-solid fa-seedling"></i>
            </div>
            <div class="card-body-content">
              <div class="card-top-header">
                <div>
                  <h3 class="card-title-text">Coordinador de Calidad y Procesamiento Agroindustrial</h3>
                  <span class="card-tag-badge">Agroindustria &bull; Agrosur Huila</span>
                </div>
                <button type="button" class="btn-green-submit" id="btn-postular-job-2" onclick="postularOferta('Coordinador de Calidad y Procesamiento Agroindustrial', 'Agrosur Huila', 'Campoalegre, Huila', '$2.200.000 + Prestaciones', this, 'job-2')">
                  <i class="fa-solid fa-paper-plane"></i>
                  <span>Postularme</span>
                </button>
              </div>
              <div class="card-meta-list">
                <span><i class="fa-solid fa-location-dot"></i> Campoalegre, Huila</span>
                <span><i class="fa-regular fa-clock"></i> Tiempo Completo</span>
                <span><i class="fa-solid fa-money-bill-wave"></i> $2.200.000 + Prestaciones</span>
              </div>
              <p class="card-desc-paragraph">
                Control de inocuidad y buenas prácticas agrícolas en planta procesadora. Dirigido a egresados de Gestión de la Producción Agrícola y Agroindustria.
              </p>
              <div class="card-action-bar">
                <span style="font-size:12px; color:var(--ink-soft);"><i class="fa-regular fa-calendar"></i> Publicada hace 3 días</span>
                <button type="button" class="btn-card-outline" id="btn-guardar-job-2" onclick="toggleBookmark(this, 'job-2')">
                  <i class="fa-regular fa-bookmark"></i>
                  <span>Guardar</span>
                </button>
              </div>
            </div>
          </div>

          <!-- Oferta 3 -->
          <div class="portal-item-card job-card-item" data-job-id="job-3" data-location="remoto" data-area="tecnologia" data-type="completo">
            <div class="card-icon-pill purple">
              <i class="fa-solid fa-laptop-code"></i>
            </div>
            <div class="card-body-content">
              <div class="card-top-header">
                <div>
                  <h3 class="card-title-text">Analista de Datos y Automatización</h3>
                  <span class="card-tag-badge purple">Tecnología &bull; InnovaTech BPO</span>
                </div>
                <button type="button" class="btn-green-submit" id="btn-postular-job-3" onclick="postularOferta('Analista de Datos y Automatización', 'InnovaTech BPO', 'Remoto (Colombia)', '$3.000.000', this, 'job-3')">
                  <i class="fa-solid fa-paper-plane"></i>
                  <span>Postularme</span>
                </button>
              </div>
              <div class="card-meta-list">
                <span><i class="fa-solid fa-location-dot"></i> Remoto (Colombia)</span>
                <span><i class="fa-regular fa-clock"></i> Tiempo Completo</span>
                <span><i class="fa-solid fa-money-bill-wave"></i> $3.000.000</span>
              </div>
              <p class="card-desc-paragraph">
                Construcción de dashboards de visualización y reporting en PowerBI y Python. Excelente ambiente laboral y plan de beneficios formativos.
              </p>
              <div class="card-action-bar">
                <span style="font-size:12px; color:var(--ink-soft);"><i class="fa-regular fa-calendar"></i> Publicada hace 5 días</span>
                <button type="button" class="btn-card-outline" id="btn-guardar-job-3" onclick="toggleBookmark(this, 'job-3')">
                  <i class="fa-regular fa-bookmark"></i>
                  <span>Guardar</span>
                </button>
              </div>
            </div>
          </div>

          <!-- Estado Vacío cuando no hay resultados de búsqueda -->
          <div id="jobs-empty-state" style="display:none; text-align:center; padding:48px 24px; background:#fff; border-radius:var(--radius-xl); border:1px dashed var(--line); margin-top:12px;">
            <i class="fa-solid fa-magnifying-glass" style="font-size:32px; color:var(--ink-soft); margin-bottom:12px;"></i>
            <h4 style="font-size:16px; font-weight:700; color:var(--sena-dark); margin-bottom:6px;">No se encontraron vacantes</h4>
            <p style="font-size:13px; color:var(--ink-soft); margin:0;">Intenta ajustando los términos de búsqueda o los filtros seleccionados.</p>
          </div>

        </div>

      </section>

      <!-- ========================================================
           SECCIÓN 4: NOTICIAS Y EVENTOS
           ======================================================== -->
      <section id="section-noticias" class="section-tab">

        <div class="hero-banner-card">
          <div class="hero-content">
            <h1 class="hero-heading">Eventos</h1>
            <p class="hero-description">
              Participa en los eventos de CEFA La Angostura.
            </p>
          </div>
        </div>

        <div class="kpi-row-grid">
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">EVENTOS ACTIVOS</span>
              <span class="kpi-big-number" id="kpi-eventos-activos-count">{{ $totalEventosActivos ?? 2 }}</span>
              <span class="kpi-sub-text">Disponibles</span>
            </div>
            <div class="kpi-icon-badge purple"><i class="fa-regular fa-calendar-days"></i></div>
          </div>
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">MIS INSCRIPCIONES</span>
              <span class="kpi-big-number" id="kpi-mis-inscripciones-count">0</span>
              <span class="kpi-sub-text">Confirmadas</span>
            </div>
            <div class="kpi-icon-badge green"><i class="fa-solid fa-user-check"></i></div>
          </div>
        </div>

        <div style="display: flex; flex-direction: column;">

          @if(isset($invitacionesEventos) && count($invitacionesEventos) > 0)
            @foreach($invitacionesEventos as $invKey => $invItem)
              <!-- Evento Invitado Dinámico por la Coordinación -->
              <div class="portal-item-card event-card-item" data-event-id="event-inv-{{ $invItem['id'] ?? $invKey }}" style="border-left: 4px solid var(--sena-green);">
                <div class="card-icon-pill green">
                  <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div class="card-body-content">
                  <div class="card-top-header">
                    <div>
                      <h3 class="card-title-text">{{ $invItem['title'] ?? 'Evento Institucional' }}</h3>
                      <span class="card-tag-badge" style="background:#DCFCE7; color:#166534; font-weight:700;">
                        <i class="fa-solid fa-envelope-open" style="font-size:10px;"></i> Convocatoria Oficial · {{ $invItem['type'] ?? 'Institucional' }}
                      </span>
                    </div>
                    <button type="button" class="btn-green-submit" id="btn-inscribir-event-inv-{{ $invItem['id'] ?? $invKey }}" onclick="openInscripcionModal('{{ addslashes($invItem['title'] ?? 'Evento') }}', this, 'event-inv-{{ $invItem['id'] ?? $invKey }}')">
                      <i class="fa-solid fa-ticket"></i>
                      <span>Inscribirme</span>
                    </button>
                  </div>
                  <div class="card-meta-list">
                    <span><i class="fa-regular fa-calendar"></i> {{ $invItem['date'] ?? 'Próximamente' }}</span>
                    <span><i class="fa-regular fa-clock"></i> {{ $invItem['time'] ?? '09:00 AM' }}</span>
                    <span><i class="fa-solid fa-location-dot"></i> {{ $invItem['location'] ?? 'Centro de Formación CEFA' }}</span>
                    <span><i class="fa-solid fa-graduation-cap"></i> {{ $invItem['program'] ?? 'Todos los Programas' }}</span>
                  </div>
                  <p class="card-desc-paragraph">
                    {{ $invItem['description'] ?? 'Invitación oficial dirigida a la comunidad de egresados SENA.' }}
                  </p>
                  <div class="card-action-bar">
                    <span style="font-size:12px; color:var(--sena-green); font-weight:700;"><i class="fa-solid fa-circle-check"></i> Cupo Máximo: {{ $invItem['cupo'] ?? 200 }} asistentes</span>
                    <button type="button" class="btn-card-outline" onclick="openInscripcionModal('{{ addslashes($invItem['title'] ?? 'Evento') }}', document.getElementById('btn-inscribir-event-inv-{{ $invItem['id'] ?? $invKey }}'), 'event-inv-{{ $invItem['id'] ?? $invKey }}')">Ver temario y apartar cupo</button>
                  </div>
                </div>
              </div>
            @endforeach
          @endif

          <!-- Evento 1 -->
          <div class="portal-item-card event-card-item" data-event-id="event-1">
            <div class="card-icon-pill green">
              <i class="fa-solid fa-microphone"></i>
            </div>
            <div class="card-body-content">
              <div class="card-top-header">
                <div>
                  <h3 class="card-title-text">Taller: Habilidades Blandas y Liderazgo para el Éxito Laboral</h3>
                  <span class="card-tag-badge">Académico · Virtual</span>
                </div>
                <button type="button" class="btn-green-submit" id="btn-inscribir-event-1" onclick="openInscripcionModal('Taller: Habilidades Blandas y Liderazgo para el Éxito Laboral', this, 'event-1')">
                  <i class="fa-solid fa-ticket"></i>
                  <span>Inscribirme</span>
                </button>
              </div>
              <div class="card-meta-list">
                <span><i class="fa-regular fa-calendar"></i> 10 de junio, 2026</span>
                <span><i class="fa-regular fa-clock"></i> 9:00 a.m. – 12:00 m.</span>
                <span><i class="fa-solid fa-chalkboard-user"></i> Facilitador: Lic. Andrés Palacios</span>
              </div>
              <p class="card-desc-paragraph">
                Sesión práctica sobre comunicación asertiva, resolución de conflictos y preparación para entrevistas en paneles corporativos.
              </p>
              <div class="card-action-bar">
                <span style="font-size:12px; color:var(--sena-green); font-weight:700;"><i class="fa-solid fa-circle-check"></i> Cupos Disponibles</span>
                <button type="button" class="btn-card-outline" onclick="openInscripcionModal('Taller: Habilidades Blandas y Liderazgo para el Éxito Laboral', document.getElementById('btn-inscribir-event-1'), 'event-1')">Ver temario</button>
              </div>
            </div>
          </div>

          <!-- Evento 2 -->
          <div class="portal-item-card event-card-item" data-event-id="event-2">
            <div class="card-icon-pill blue">
              <i class="fa-solid fa-handshake-angle"></i>
            </div>
            <div class="card-body-content">
              <div class="card-top-header">
                <div>
                  <h3 class="card-title-text">Feria Regional de Empleo y Emprendimiento CEFA 2026</h3>
                  <span class="card-tag-badge blue">Empleabilidad &bull; Presencial</span>
                </div>
                <button type="button" class="btn-green-submit" id="btn-inscribir-event-2" onclick="openInscripcionModal('Feria Regional de Empleo y Emprendimiento CEFA 2026', this, 'event-2')">
                  <i class="fa-solid fa-ticket"></i>
                  <span>Inscribirme</span>
                </button>
              </div>
              <div class="card-meta-list">
                <span><i class="fa-regular fa-calendar"></i> 20 de junio, 2026</span>
                <span><i class="fa-solid fa-location-dot"></i> Auditorio Principal La Angostura</span>
              </div>
              <p class="card-desc-paragraph">
                Espacio de articulación con más de 25 empresas de la región interesadas en perfiles de egresados SENA.
              </p>
              <div class="card-action-bar">
                <span style="font-size:12px; color:var(--sena-green); font-weight:700;"><i class="fa-solid fa-circle-check"></i> Entrada Libre para Egresados</span>
                <button type="button" class="btn-card-outline" onclick="openInscripcionModal('Feria Regional de Empleo y Emprendimiento CEFA 2026', document.getElementById('btn-inscribir-event-2'), 'event-2')">Ver empresas</button>
              </div>
            </div>
          </div>

        </div>

      </section>

      <!-- ========================================================
           SECCIÓN 5: NOTIFICACIONES
           ======================================================== -->
      <section id="section-notificaciones" class="section-tab">

        <div class="hero-banner-card">
          <div class="hero-content">
            <h1 class="hero-heading">Avisos y Alertas Recientes</h1>
            <p class="hero-description">
              Revisa comunicados institucionales, recordatorios de encuestas asignadas y convocatorias especiales.
            </p>
          </div>
        </div>

        <div class="kpi-row-grid">
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">NO LEÍDAS</span>
              <span class="kpi-big-number" id="kpi-notif-noleidas-count">{{ $notificaciones ?? 3 }}</span>
              <span class="kpi-sub-text">Mensajes nuevos</span>
            </div>
            <div class="kpi-icon-badge green"><i class="fa-regular fa-envelope"></i></div>
          </div>
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">LEÍDAS</span>
              <span class="kpi-big-number" id="kpi-notif-leidas-count">0</span>
              <span class="kpi-sub-text">Revisadas</span>
            </div>
            <div class="kpi-icon-badge blue"><i class="fa-solid fa-inbox"></i></div>
          </div>
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">IMPORTANTES</span>
              <span class="kpi-big-number" id="kpi-notif-importantes-count">0</span>
              <span class="kpi-sub-text">Marcadas con estrella</span>
            </div>
            <div class="kpi-icon-badge orange"><i class="fa-solid fa-star"></i></div>
          </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 12px;">

          @if(isset($invitacionesEventos) && count($invitacionesEventos) > 0)
            @foreach($invitacionesEventos as $invKey => $invItem)
              <!-- Notificación Dinámica de Invitación a Evento -->
              <div class="portal-item-card notif-card-item" id="notif-card-inv-{{ $invItem['id'] ?? $invKey }}" data-notif-id="notif-inv-{{ $invItem['id'] ?? $invKey }}" style="padding:16px 20px; transition:var(--transition); margin-bottom:0; border-left: 4px solid var(--sena-green); background: #FAFDF7;">
                <div class="card-icon-pill green" style="width:40px; height:40px; font-size:16px; background:#EAF7EE; color:#166534;">
                  <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <div class="card-body-content" style="flex:1;">
                  <div class="card-top-header" style="margin-bottom:4px; display:flex; justify-content:space-between; align-items:center;">
                    <h4 style="font-size:14px; font-weight:700; color:var(--sena-dark); margin:0;">
                      ¡Invitación Oficial: {{ $invItem['title'] ?? 'Evento Institucional' }}!
                    </h4>
                    <div style="display:flex; align-items:center; gap:8px;">
                      <button type="button" class="btn-star-notif" id="btn-star-notif-inv-{{ $invItem['id'] ?? $invKey }}" onclick="toggleNotifImportante('notif-inv-{{ $invItem['id'] ?? $invKey }}', this)" title="Marcar como importante" style="background:transparent; border:none; cursor:pointer; font-size:18px; color:#cbd5e1; padding:3px 6px; border-radius:6px; transition:var(--transition);">
                        <i class="fa-regular fa-star"></i>
                      </button>
                      <span class="card-tag-badge" style="background:#DCFCE7; color:#166534; font-weight:700;">Invitación a Evento</span>
                    </div>
                  </div>
                  <p style="font-size:12.5px; color:var(--ink-soft); margin-bottom:6px;">
                    Has sido invitado por la Coordinación Académica al evento <strong>{{ $invItem['title'] ?? '' }}</strong> para el programa <em>{{ $invItem['program'] ?? 'General' }}</em>. Fecha: {{ $invItem['date'] ?? 'Próximamente' }} ({{ $invItem['time'] ?? '09:00 AM' }}) | Lugar: {{ $invItem['location'] ?? 'CEFA' }}.
                  </p>
                  <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:11px; color:var(--ink-muted);"><i class="fa-regular fa-clock"></i> {{ $invItem['tiempo_relativo'] ?? 'Reciente' }}</span>
                    <button type="button" class="btn-green-submit" style="padding:6px 14px; font-size:11.5px; border-radius:10px; cursor:pointer;" onclick="showSection('noticias');">
                      <i class="fa-solid fa-calendar-check" style="margin-right:4px;"></i> Ver evento e inscribirme
                    </button>
                  </div>
                </div>
              </div>
            @endforeach
          @endif

          <!-- Notificación 1 -->
          <div class="portal-item-card notif-card-item" id="notif-card-1" data-notif-id="notif-1" style="padding:16px 20px; transition:var(--transition); margin-bottom:0;">
            <div class="card-icon-pill green" style="width:40px; height:40px; font-size:16px;">
              <i class="fa-regular fa-clipboard"></i>
            </div>
            <div class="card-body-content" style="flex:1;">
              <div class="card-top-header" style="margin-bottom:4px; display:flex; justify-content:space-between; align-items:center;">
                <h4 style="font-size:14px; font-weight:700; color:var(--ink); margin:0;">Nueva Encuesta Disponible: Inserción Laboral 2026</h4>
                <div style="display:flex; align-items:center; gap:8px;">
                  <button type="button" class="btn-star-notif" id="btn-star-notif-1" onclick="toggleNotifImportante('notif-1', this)" title="Marcar como importante" style="background:transparent; border:none; cursor:pointer; font-size:18px; color:#cbd5e1; padding:3px 6px; border-radius:6px; transition:var(--transition);">
                    <i class="fa-regular fa-star"></i>
                  </button>
                  <span class="card-tag-badge" id="badge-notif-1" style="background:#FEF3C7; color:#92400e;">Pendiente</span>
                </div>
              </div>
              <p style="font-size:12.5px; color:var(--ink-soft); margin-bottom:6px;">
                Se ha asignado a tu perfil la encuesta de satisfacción y desempeño profesional. Tu participación es fundamental.
              </p>
              <div style="display:flex; justify-content:space-between; align-items:center;">
                <span style="font-size:11px; color:var(--ink-muted);"><i class="fa-regular fa-clock"></i> Hace 2 horas</span>
                <button type="button" class="btn-card-outline" style="padding:5px 12px; font-size:11.5px;" onclick="marcarNotifLeida('notif-1'); showSection('encuestas');">
                  Ir a responder
                </button>
              </div>
            </div>
          </div>

          <!-- Notificación 2 -->
          <div class="portal-item-card notif-card-item" id="notif-card-2" data-notif-id="notif-2" style="padding:16px 20px; transition:var(--transition); margin-bottom:0;">
            <div class="card-icon-pill blue" style="width:40px; height:40px; font-size:16px;">
              <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="card-body-content" style="flex:1;">
              <div class="card-top-header" style="margin-bottom:4px; display:flex; justify-content:space-between; align-items:center;">
                <h4 style="font-size:14px; font-weight:700; color:var(--ink); margin:0;">Nueva vacante que coincide con tu perfil</h4>
                <div style="display:flex; align-items:center; gap:8px;">
                  <button type="button" class="btn-star-notif" id="btn-star-notif-2" onclick="toggleNotifImportante('notif-2', this)" title="Marcar como importante" style="background:transparent; border:none; cursor:pointer; font-size:18px; color:#cbd5e1; padding:3px 6px; border-radius:6px; transition:var(--transition);">
                    <i class="fa-regular fa-star"></i>
                  </button>
                  <span class="card-tag-badge blue" id="badge-notif-2">Empleo</span>
                </div>
              </div>
              <p style="font-size:12.5px; color:var(--ink-soft); margin-bottom:6px;">
                TrabSistema S.A.S. ha publicado una vacante de Desarrollador Junior Full Stack dirigida a graduados ADSO.
              </p>
              <div style="display:flex; justify-content:space-between; align-items:center;">
                <span style="font-size:11px; color:var(--ink-muted);"><i class="fa-regular fa-clock"></i> Ayer a las 4:30 p.m.</span>
                <button type="button" class="btn-card-outline" style="padding:5px 12px; font-size:11.5px;" onclick="marcarNotifLeida('notif-2'); showSection('oportunidades');">
                  Ver oferta
                </button>
              </div>
            </div>
          </div>

          <!-- Notificación 3 -->
          <div class="portal-item-card notif-card-item" id="notif-card-3" data-notif-id="notif-3" style="padding:16px 20px; transition:var(--transition); margin-bottom:0;">
            <div class="card-icon-pill purple" style="width:40px; height:40px; font-size:16px;">
              <i class="fa-regular fa-calendar-check"></i>
            </div>
            <div class="card-body-content" style="flex:1;">
              <div class="card-top-header" style="margin-bottom:4px; display:flex; justify-content:space-between; align-items:center;">
                <h4 style="font-size:14px; font-weight:700; color:var(--ink); margin:0;">Nuevo Evento: Taller de Habilidades Blandas y Liderazgo</h4>
                <div style="display:flex; align-items:center; gap:8px;">
                  <button type="button" class="btn-star-notif" id="btn-star-notif-3" onclick="toggleNotifImportante('notif-3', this)" title="Marcar como importante" style="background:transparent; border:none; cursor:pointer; font-size:18px; color:#cbd5e1; padding:3px 6px; border-radius:6px; transition:var(--transition);">
                    <i class="fa-regular fa-star"></i>
                  </button>
                  <span class="card-tag-badge purple" id="badge-notif-3">Evento</span>
                </div>
              </div>
              <p style="font-size:12.5px; color:var(--ink-soft); margin-bottom:6px;">
                Se han abierto cupos para el próximo taller de actualización laboral del CEFA La Angostura.
              </p>
              <div style="display:flex; justify-content:space-between; align-items:center;">
                <span style="font-size:11px; color:var(--ink-muted);"><i class="fa-regular fa-clock"></i> Hace 1 día</span>
                <button type="button" class="btn-card-outline" style="padding:5px 12px; font-size:11.5px;" onclick="marcarNotifLeida('notif-3'); showSection('noticias');">
                  Ver evento
                </button>
              </div>
            </div>
          </div>

        </div>

      </section>

    </main>
  </div>
</div>

<!-- ========================================================
     MODAL DE PREGUNTAS DE ENCUESTA
     ======================================================== -->
<div class="modal-backdrop" id="modalEncuesta" onclick="if(event.target===this)closeSurveyModal()">
  <div class="modal-box-card">
    <button type="button" class="modal-close-x" onclick="closeSurveyModal()"><i class="fa-solid fa-xmark"></i></button>

    <div class="modal-header-banner">
      <h3 id="modal-survey-title">Encuesta de Seguimiento e Inserción Laboral</h3>
      <p>Tus respuestas permiten mejorar los procesos pedagógicos y de empleabilidad del SENA CEFA.</p>
    </div>

    <form id="form-responder-encuesta" onsubmit="event.preventDefault(); submitSurvey();">
      <div class="question-block">
        <h4 class="question-title">1. ¿Qué tan satisfecho está con la formación técnica/tecnológica recibida en el CEFA? <span>*</span></h4>
        <label class="option-radio-row"><input type="radio" name="q1" value="Excelente" checked required> Excelente</label>
        <label class="option-radio-row"><input type="radio" name="q1" value="Buena"> Buena</label>
        <label class="option-radio-row"><input type="radio" name="q1" value="Regular"> Regular</label>
        <label class="option-radio-row"><input type="radio" name="q1" value="Deficiente"> Deficiente</label>
      </div>

      <div class="question-block">
        <h4 class="question-title">2. ¿Se encuentra vinculado laboralmente o desarrollando un emprendimiento actualmente? <span>*</span></h4>
        <label class="option-radio-row"><input type="radio" name="q2" value="Si" checked required> Sí, con contrato laboral</label>
        <label class="option-radio-row"><input type="radio" name="q2" value="Independiente"> Sí, como independiente o emprendedor</label>
        <label class="option-radio-row"><input type="radio" name="q2" value="No"> No actualmente, en búsqueda activa</label>
      </div>

      <div class="question-block">
        <h4 class="question-title">3. ¿Su empleo actual se relaciona con el programa cursado en el SENA? <span>*</span></h4>
        <label class="option-radio-row"><input type="radio" name="q3" value="Totalmente" checked required> Totalmente relacionado</label>
        <label class="option-radio-row"><input type="radio" name="q3" value="Parcialmente"> Parcialmente relacionado</label>
        <label class="option-radio-row"><input type="radio" name="q3" value="No"> No relacionado</label>
      </div>

      <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:24px;">
        <button type="button" class="btn-card-outline" onclick="closeSurveyModal()">Cancelar</button>
        <button type="submit" class="btn-green-submit" style="padding:10px 24px;">
          <i class="fa-solid fa-paper-plane"></i>
          <span>Enviar Encuesta</span>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ========================================================
     MODAL DE CONFIRMACIÓN: ENVIADA CORRECTAMENTE CON CHULO EN LA MITAD
     (Requerimiento explícito: "esto pongamelo el aceptar como asi en la mitad q salga envaida correctamente y un chulo")
     ======================================================== -->
<div class="modal-backdrop" id="encuestaEnviadaModal" onclick="if(event.target===this)closeEncuestaEnviadaModal()">
  <div class="success-modal-card">
    <div class="chulo-circle-badge">
      <i class="fa-solid fa-check"></i>
    </div>
    <h3>¡Enviada correctamente!</h3>
    <p>
      Tu encuesta ha sido registrada satisfactoriamente en el sistema. Tus respuestas han sido recibidas y procesadas de forma confidencial.
    </p>
    <button type="button" class="btn-modal-accept" onclick="closeEncuestaEnviadaModal()">
      Aceptar
    </button>
  </div>
</div>

<!-- ========================================================
     MODAL DE INSCRIPCIÓN A EVENTOS
     ======================================================== -->
<div class="modal-backdrop" id="inscripcionModal" onclick="if(event.target===this)closeInscripcionModal()">
  <div class="modal-box-card" style="max-width:480px; border-top: 4px solid var(--sena-green); padding: 32px 28px;">
    <button type="button" class="modal-close-x" onclick="closeInscripcionModal()"><i class="fa-solid fa-xmark"></i></button>

    <div style="text-align: center; margin-bottom: 20px;">
      <div style="width: 60px; height: 60px; border-radius: 50%; background: #EAF7EE; color: var(--sena-green); display: inline-flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 12px; border: 2px solid #BBF7D0;">
        <i class="fa-regular fa-calendar-check"></i>
      </div>
      <h3 style="font-family: 'Poppins', 'Nunito', sans-serif; font-size: 20px; font-weight: 700; color: var(--sena-dark); margin-bottom: 4px;" id="modal-event-title">
        Inscripción a Actividad
      </h3>
      <p style="font-size: 13px; color: var(--ink-soft); margin: 0;">
        Confirma tus datos para apartar tu cupo en este evento del CEFA.
      </p>
    </div>

    <form onsubmit="event.preventDefault(); confirmInscripcion();">
      <div style="margin-bottom:14px;">
        <label style="display:block; font-size:12.5px; font-weight:700; color:var(--ink); margin-bottom:5px;">Nombre Completo</label>
        <input type="text" value="@auth {{ Auth::user()->full_name }} @else Nicol Suache @endauth" style="width:100%; border:1px solid var(--line); border-radius:8px; padding:9px 12px; font-size:13px; font-family:inherit;" required>
      </div>
      <div style="margin-bottom:14px;">
        <label style="display:block; font-size:12.5px; font-weight:700; color:var(--ink); margin-bottom:5px;">Correo Electrónico</label>
        <input type="email" value="@auth {{ Auth::user()->email }} @else egresada.cefa@sena.edu.co @endauth" style="width:100%; border:1px solid var(--line); border-radius:8px; padding:9px 12px; font-size:13px; font-family:inherit;" required>
      </div>
      <div style="margin-bottom:20px;">
        <label style="display:block; font-size:12.5px; font-weight:700; color:var(--ink); margin-bottom:5px;">Teléfono de Contacto</label>
        <input type="tel" value="310 123 4567" style="width:100%; border:1px solid var(--line); border-radius:8px; padding:9px 12px; font-size:13px; font-family:inherit;" required>
      </div>

      <div style="display:flex; justify-content:flex-end; gap:10px;">
        <button type="button" class="btn-card-outline" onclick="closeInscripcionModal()" style="padding:10px 18px; border-radius:10px; font-weight:700; cursor:pointer;">Cancelar</button>
        <button type="submit" class="btn-green-submit" style="padding:10px 22px; border-radius:10px; font-weight:700; background:var(--sena-green); cursor:pointer;">
          <i class="fa-solid fa-check"></i>
          <span>Confirmar Registro</span>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ========================================================
     MODAL DE CONFIRMACIÓN: INSCRIPCIÓN EXITOSA A EVENTO
     ======================================================== -->
<div class="modal-backdrop" id="modalInscripcionExitosa" onclick="if(event.target===this)closeInscripcionExitosaModal()">
  <div class="success-modal-card" style="border-top: 4px solid var(--sena-green);">
    <div class="chulo-circle-badge">
      <i class="fa-solid fa-check"></i>
    </div>
    <h3 style="font-family:'Poppins', 'Nunito', sans-serif; font-size:24px; font-weight:700; color:var(--sena-dark); margin-bottom:10px;">¡Inscripción Confirmada con Éxito!</h3>
    <p style="font-size:13.5px; color:var(--ink-soft); line-height:1.5; margin-bottom:26px;">
      Te has inscrito exitosamente a <strong id="modal-success-event-title" style="color:var(--sena-dark);">este evento</strong> en el CEFA La Angostura. Recibirás los recordatorios y detalles de acceso en tu correo electrónico.
    </p>
    <button type="button" class="btn-modal-accept" onclick="closeInscripcionExitosaModal()">
      Aceptar
    </button>
  </div>
</div>

<!-- ========================================================
     MODAL DE CONFIRMACIÓN DE POSTULACIÓN A VACANTE
     ======================================================== -->
<div class="modal-backdrop" id="modalPostulacion" onclick="if(event.target===this)cerrarModalPostulacion()">
  <div class="modal-box-card" style="max-width: 500px; border-top: 4px solid var(--sena-green); padding: 32px 28px;">
    <button type="button" class="modal-close-x" onclick="cerrarModalPostulacion()" title="Cerrar ventana">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <div style="text-align: center; margin-bottom: 22px;">
      <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(57, 169, 0, 0.12); color: var(--sena-green); display: inline-flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 14px; border: 2px solid rgba(98, 227, 29, 0.4); box-shadow: 0 4px 14px rgba(57, 169, 0, 0.2);">
        <i class="fa-solid fa-briefcase"></i>
      </div>
      <h3 style="font-family: 'Poppins', 'Nunito', sans-serif; font-size: 22px; font-weight: 700; color: var(--sena-dark); margin-bottom: 6px; letter-spacing: -0.01em;">
        ¿Deseas postularte a esta vacante?
      </h3>
      <p style="font-size: 13px; color: var(--ink-soft); max-width: 380px; margin: 0 auto; line-height: 1.5;">
        Estás a punto de postularte a esta oportunidad laboral a través de la Bolsa de Empleo APE SENA.
      </p>
    </div>

    <!-- Resumen detallado de la vacante -->
    <div style="background: #F8FAFC; border: 1px solid var(--line); border-radius: 14px; padding: 18px; margin-bottom: 24px;">
      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
        <span style="font-size: 10.5px; font-weight: 800; text-transform: uppercase; color: var(--sena-green); letter-spacing: 0.05em; background: rgba(57, 169, 0, 0.1); padding: 3px 10px; border-radius: 20px;">
          Vacante APE SENA
        </span>
        <span id="modal-post-salario" style="font-size: 12.5px; font-weight: 800; color: var(--sena-dark);">
          $2.500.000 - $3.200.000
        </span>
      </div>
      <h4 id="modal-post-cargo" style="font-size: 15px; font-weight: 800; color: var(--sena-dark); margin-bottom: 8px; line-height: 1.35;">
        Desarrollador Junior Full Stack (PHP / Laravel)
      </h4>
      <div style="display: flex; flex-wrap: wrap; gap: 14px; font-size: 12.5px; color: var(--ink-soft);">
        <span><i class="fa-solid fa-building" style="color: var(--sena-green); margin-right: 5px;"></i><strong id="modal-post-empresa" style="color: var(--ink);">TrabSistema S.A.S.</strong></span>
        <span><i class="fa-solid fa-location-dot" style="color: var(--sena-green); margin-right: 5px;"></i><span id="modal-post-ubicacion">Neiva (Híbrido)</span></span>
      </div>
    </div>

    <!-- Botones de Acción -->
    <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px;">
      <button type="button" class="btn-card-outline" onclick="cerrarModalPostulacion()" style="padding: 10px 18px; border-radius: 10px; font-weight: 700; cursor: pointer;">
        Cancelar
      </button>
      <button type="button" class="btn-green-submit" id="btnConfirmarPostulacion" onclick="confirmarPostulacion()" style="padding: 10px 22px; border-radius: 10px; font-weight: 700; background: var(--sena-green); box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35); cursor: pointer;">
        <i class="fa-solid fa-check"></i>
        <span>Aceptar y Postularme</span>
      </button>
    </div>
  </div>
</div>

<!-- ========================================================
     MODAL DE CONFIRMACIÓN: POSTULACIÓN EXITOSA CON BOTÓN ACEPTAR
     ======================================================== -->
<div class="modal-backdrop" id="modalPostulacionExitosa" onclick="if(event.target===this)cerrarModalPostulacionExitosa()">
  <div class="success-modal-card" style="border-top: 4px solid var(--sena-green);">
    <div class="chulo-circle-badge">
      <i class="fa-solid fa-check"></i>
    </div>
    <h3>¡Postulación Enviada con Éxito!</h3>
    <p>
      Tu perfil de egresado(a) y hoja de vida han sido remitidos formalmente para la vacante de <strong id="modal-success-cargo" style="color:var(--sena-dark);">este cargo</strong>. La empresa revisará tus competencias y te contactará a través de tus datos registrados.
    </p>
    <button type="button" class="btn-modal-accept" onclick="cerrarModalPostulacionExitosa()">
      Aceptar
    </button>
  </div>
</div>

<!-- ========================================================
     ALERTA TOAST FLOTANTE HORIZONTAL EN EL CENTRO
     ======================================================== -->
<div class="toast-alert" id="toastAlert">
  <i class="fa-solid fa-circle-check"></i>
  <span id="toastMessage">Operación realizada con éxito</span>
</div>

<!-- ========================================================
     SCRIPTS DE CONTROL Y NAVEGACIÓN
     ======================================================== -->
<script>
  const sectionMeta = {
    'inicio': {
      title: 'Portal del Egresado · Panel Personal',
      tag: 'Egresado Activo',
      subtitle: 'Consulta tus encuestas, ofertas laborales y eventos del centro CEFA',
      icon: 'fa-graduation-cap'
    },
    'encuestas': {
      title: 'Gestión de Encuestas · Portal Egresado',
      tag: 'Instrumentos Activos',
      subtitle: 'Seguimiento ocupacional, satisfacción formativa e inserción laboral',
      icon: 'fa-clipboard-question'
    },
    'oportunidades': {
      title: 'Bolsa de Empleo · Oportunidades Laborales',
      tag: 'Vacantes Abiertas',
      subtitle: 'Ofertas y convocatorias laborales dirigidas a graduados del CEFA',
      icon: 'fa-briefcase'
    },
    'noticias': {
      title: 'Noticias & Eventos · Comunidad CEFA',
      tag: 'Agenda Activa',
      subtitle: 'Talleres, ferias de empleo, cursos y actividades institucionales',
      icon: 'fa-calendar-days'
    },
    'notificaciones': {
      title: 'Centro de Notificaciones · Avisos Importantes',
      tag: 'Alertas',
      subtitle: 'Recordatorios de encuestas, ofertas laborales y novedades',
      icon: 'fa-bell'
    }
  };

  const sectionsList = ['inicio', 'encuestas', 'oportunidades', 'noticias', 'notificaciones'];

  function showSection(name) {
    if (!sectionsList.includes(name)) name = 'inicio';

    // Desactivar todas las secciones y navs
    sectionsList.forEach(s => {
      const elSec = document.getElementById('section-' + s);
      const elNav = document.getElementById('nav-' + s);
      if (elSec) elSec.classList.remove('active');
      if (elNav) elNav.classList.remove('active');
    });

    // Activar la seleccionada
    const currentSec = document.getElementById('section-' + name);
    const currentNav = document.getElementById('nav-' + name);
    if (currentSec) currentSec.classList.add('active');
    if (currentNav) currentNav.classList.add('active');



    window.location.hash = '#' + name;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  const SURVEY_STORAGE_KEY = 'sige_egresado_answered_surveys';

  function getStoredSurveys() {
    try {
      const data = localStorage.getItem(SURVEY_STORAGE_KEY);
      if (data) {
        const parsed = JSON.parse(data);
        return new Set(Array.isArray(parsed) ? parsed.map(Number) : []);
      }
    } catch (e) {
      console.warn('Error leyendo localStorage', e);
    }
    return new Set();
  }

  function saveStoredSurveys(set) {
    try {
      localStorage.setItem(SURVEY_STORAGE_KEY, JSON.stringify(Array.from(set)));
    } catch (e) {
      console.warn('Error guardando en localStorage', e);
    }
  }

  let activeSurveyId = 1;
  const answeredSurveys = getStoredSurveys();

  function openSurveyModal(title, id) {
    if (id !== undefined) {
      activeSurveyId = Number(id);
    }
    if (answeredSurveys.has(activeSurveyId)) {
      showToast('Esta encuesta ya fue respondida y registrada con éxito.');
      return;
    }
    if (title) {
      const titleEl = document.getElementById('modal-survey-title');
      if (titleEl) titleEl.textContent = title;
    }

    // Resetear formulario para nueva respuesta dejando la primera opción preseleccionada
    const form = document.getElementById('form-responder-encuesta');
    if (form) form.reset();

    const modal = document.getElementById('modalEncuesta');
    if (modal) modal.classList.add('active');
  }

  function closeSurveyModal() {
    const modal = document.getElementById('modalEncuesta');
    if (modal) modal.classList.remove('active');
  }

  function submitSurvey() {
    closeSurveyModal();

    // Restaurar textos originales de confirmación de encuesta
    const sentModal = document.getElementById('encuestaEnviadaModal');
    if (sentModal) {
      const h3 = sentModal.querySelector('h3');
      const p = sentModal.querySelector('p');
      if (h3) h3.textContent = '¡Enviada correctamente!';
      if (p) p.textContent = 'Tu encuesta ha sido registrada satisfactoriamente en el sistema. Tus respuestas han sido recibidas y procesadas de forma confidencial.';
    }

    // 1. Marcar la encuesta como completada, persistir en localStorage y sincronizar los cuadritos
    markSurveyAsCompleted(activeSurveyId, true);

    // 2. Mostrar modal de confirmación con el chulo en el centro
    setTimeout(() => {
      if (sentModal) sentModal.classList.add('active');
    }, 200);

    // 3. Mostrar toast de refuerzo
    showToast('¡Encuesta enviada y procesada correctamente!');
  }

  function markSurveyAsCompleted(id, saveToStorage = true) {
    if (!id) return;
    const numId = Number(id);
    answeredSurveys.add(numId);

    if (saveToStorage) {
      saveStoredSurveys(answeredSurveys);
    }

    // Actualizar la tarjeta visualmente a "Enviada"
    const card = document.getElementById('survey-card-' + numId);
    if (card) {
      card.setAttribute('data-type', 'completadas');

      // Cambiar ícono a check verde
      const icon = document.getElementById('survey-icon-' + numId);
      if (icon) {
        icon.className = 'card-icon-pill green';
        icon.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
      }

      // Cambiar etiqueta superior
      const badge = document.getElementById('survey-badge-' + numId);
      if (badge) {
        badge.className = 'card-tag-badge completed';
        badge.innerHTML = '<i class="fa-solid fa-check"></i> Completada · Registrada';
      }

      // Cambiar botón a "Enviada"
      const btnWrap = document.getElementById('survey-btn-wrap-' + numId);
      if (btnWrap) {
        btnWrap.innerHTML = `
          <button type="button" class="btn-card-outline" style="border-color:#16a34a; color:#16a34a; background:#f0fdf4; cursor:default;" title="Doble clic para reiniciar prueba" ondblclick="resetSurveyForTesting(${numId})" onclick="showToast('Ya has respondido esta encuesta con éxito')">
            <i class="fa-solid fa-check"></i>
            <span>Enviada</span>
          </button>
        `;
      }

      // Actualizar detalles y fecha
      const meta = document.getElementById('survey-meta-' + numId);
      if (meta) {
        const today = new Date().toISOString().slice(0, 10);
        meta.innerHTML = `
          <span><i class="fa-regular fa-calendar-check"></i> Finalizada hoy (${today})</span>
          <span><i class="fa-solid fa-check-double"></i> Respuestas guardadas</span>
        `;
      }

      // Barra de progreso a 100%
      const prog = document.getElementById('survey-progress-' + numId);
      if (prog) {
        prog.innerHTML = `
          <div class="progress-bar-track"><div class="progress-bar-fill" style="width: 100%;"></div></div>
          <span class="progress-label-text" style="color:#16a34a; font-weight:700;"><i class="fa-solid fa-check"></i> 100% completada</span>
        `;
      }

      // Botón de detalles
      const detailBtn = document.getElementById('survey-detail-btn-' + numId);
      if (detailBtn) {
        detailBtn.innerHTML = `<span>Ver respuestas</span> <i class="fa-solid fa-arrow-right" style="font-size:11px; margin-left:4px;"></i>`;
        detailBtn.onclick = function() { showToast('Visualizando histórico de respuestas...'); };
      }
    }

    // Actualizar todos los cuadritos (KPIs) y contadores
    updateSurveyCounters();
  }

  function updateSurveyCounters() {
    const total = 7;
    const answeredCount = answeredSurveys.size;
    const pendientes = Math.max(0, 2 - answeredCount);
    const completadas = 5 + answeredCount;
    const tasa = Math.round((completadas / total) * 100);

    // Cuadrito Inicio: Encuestas Pendientes
    const elInicioPend = document.getElementById('kpi-inicio-encuestas-pendientes');
    if (elInicioPend) elInicioPend.textContent = pendientes;
    const elInicioSub = document.getElementById('kpi-inicio-subtext-encuestas');
    if (elInicioSub) {
      elInicioSub.textContent = pendientes === 0 ? '¡Al día! Sin encuestas pendientes' : 'Por responder actualmente';
    }

    // Badge lateral del menú
    const elNavBadge = document.getElementById('nav-badge-encuestas');
    if (elNavBadge) {
      if (pendientes === 0) {
        elNavBadge.style.display = 'none';
      } else {
        elNavBadge.style.display = 'inline-block';
        elNavBadge.textContent = pendientes;
      }
    }

    // Cuadritos Sección Encuestas:
    const elKpiTotal = document.getElementById('kpi-total-encuestas');
    if (elKpiTotal) elKpiTotal.textContent = total;

    const elKpiPend = document.getElementById('kpi-encuestas-pendientes');
    if (elKpiPend) elKpiPend.textContent = pendientes;

    const elKpiComp = document.getElementById('kpi-encuestas-completadas');
    if (elKpiComp) elKpiComp.textContent = completadas;

    const elKpiTasa = document.getElementById('kpi-tasa-respuesta');
    if (elKpiTasa) elKpiTasa.textContent = tasa + '%';

    // Pestañas / Filtros superiores
    const elFilterTodas = document.getElementById('count-filter-todas');
    if (elFilterTodas) elFilterTodas.textContent = pendientes;

    const elFilterPend = document.getElementById('count-filter-pendientes');
    if (elFilterPend) elFilterPend.textContent = pendientes;

    const elFilterComp = document.getElementById('count-filter-completadas');
    if (elFilterComp) elFilterComp.textContent = completadas;
  }

  function resetSurveyForTesting(id) {
    answeredSurveys.delete(Number(id));
    saveStoredSurveys(answeredSurveys);
    showToast('Encuesta reiniciada para realizar pruebas.');
    setTimeout(() => location.reload(), 400);
  }

  window.resetEncuestasPrueba = function() {
    localStorage.removeItem(SURVEY_STORAGE_KEY);
    showToast('Todas las encuestas han sido reiniciadas para pruebas.');
    setTimeout(() => location.reload(), 400);
  };

  function closeEncuestaEnviadaModal() {
    const modal = document.getElementById('encuestaEnviadaModal');
    if (modal) modal.classList.remove('active');

    // Al cerrar el modal de confirmación, la encuesta completada se elimina de 'Todas' y 'Pendientes'
    filterSurveys(currentSurveyFilter);
  }

  // Modales y Control de Inscripción a Eventos
  const STORAGE_EVENTOS_KEY = 'SIGE_EVENTOS_INSCRITOS_IDS';

  function getStoredEventSet() {
    try {
      const data = localStorage.getItem(STORAGE_EVENTOS_KEY);
      return data ? new Set(JSON.parse(data)) : new Set();
    } catch(e) {
      return new Set();
    }
  }

  function saveStoredEventSet(set) {
    try {
      localStorage.setItem(STORAGE_EVENTOS_KEY, JSON.stringify(Array.from(set)));
    } catch(e) {}
  }

  let inscribedEvents = getStoredEventSet();
  let activeEventBtn = null;
  let activeEventTitle = '';
  let activeEventId = '';

  function updateEventCounters() {
    const totalEvents = document.querySelectorAll('#section-noticias .event-card-item').length || 2;

    const kpiEventosActivos = document.getElementById('kpi-eventos-activos-count');
    if (kpiEventosActivos) kpiEventosActivos.textContent = totalEvents;

    const kpiInicioEventos = document.getElementById('kpi-inicio-eventos-count');
    if (kpiInicioEventos) kpiInicioEventos.textContent = totalEvents;

    const kpiInscripciones = document.getElementById('kpi-mis-inscripciones-count');
    if (kpiInscripciones) kpiInscripciones.textContent = inscribedEvents.size;
  }

  function openInscripcionModal(title, btn, eventId) {
    activeEventTitle = title || 'Actividad Especial';
    activeEventBtn = btn || null;
    activeEventId = eventId || '';

    const titleEl = document.getElementById('modal-event-title');
    if (titleEl) titleEl.textContent = 'Inscripción: ' + activeEventTitle;

    const modal = document.getElementById('inscripcionModal');
    if (modal) modal.classList.add('active');
  }

  function closeInscripcionModal() {
    const modal = document.getElementById('inscripcionModal');
    if (modal) modal.classList.remove('active');
  }

  function closeInscripcionExitosaModal() {
    const modal = document.getElementById('modalInscripcionExitosa');
    if (modal) modal.classList.remove('active');
  }

  function confirmInscripcion() {
    closeInscripcionModal();

    if (activeEventId) {
      inscribedEvents.add(activeEventId);
      saveStoredEventSet(inscribedEvents);
    }

    // Actualizar visualmente el botón sobre el que se hizo clic
    if (activeEventBtn) {
      activeEventBtn.innerHTML = '<i class="fa-solid fa-circle-check"></i> <span>¡Inscrito!</span>';
      activeEventBtn.style.background = '#EAF7EE';
      activeEventBtn.style.color = 'var(--sena-green)';
      activeEventBtn.style.border = '1px solid #BBF7D0';
      activeEventBtn.style.cursor = 'default';
      activeEventBtn.style.boxShadow = 'none';
      activeEventBtn.disabled = true;
    }

    // Actualizar los cuadritos vinculados
    updateEventCounters();

    // Mostrar ventana modal de confirmación con botón Aceptar
    const titleSuccess = document.getElementById('modal-success-event-title');
    if (titleSuccess) titleSuccess.textContent = activeEventTitle || 'el evento seleccionado';

    setTimeout(() => {
      const modalExitosa = document.getElementById('modalInscripcionExitosa');
      if (modalExitosa) modalExitosa.classList.add('active');
    }, 150);
  }

  // Control de Notificaciones (Importantes con Estrella y Leídas)
  const STORAGE_NOTIF_IMPORTANTES_KEY = 'SIGE_NOTIF_IMPORTANTES_IDS';
  const STORAGE_NOTIF_LEIDAS_KEY = 'SIGE_NOTIF_LEIDAS_IDS';

  function getStoredNotifSet(key) {
    try {
      const data = localStorage.getItem(key);
      return data ? new Set(JSON.parse(data)) : new Set();
    } catch(e) {
      return new Set();
    }
  }

  function saveStoredNotifSet(key, set) {
    try {
      localStorage.setItem(key, JSON.stringify(Array.from(set)));
    } catch(e) {}
  }

  let notifImportantes = getStoredNotifSet(STORAGE_NOTIF_IMPORTANTES_KEY);
  let notifLeidas = getStoredNotifSet(STORAGE_NOTIF_LEIDAS_KEY);

  function updateNotifCounters() {
    const allNotifs = document.querySelectorAll('.notif-card-item');
    const totalNotifs = allNotifs.length || 3;
    const leidasCount = notifLeidas.size;
    const noLeidasCount = Math.max(0, totalNotifs - leidasCount);

    const kpiNoLeidas = document.getElementById('kpi-notif-noleidas-count');
    if (kpiNoLeidas) kpiNoLeidas.textContent = noLeidasCount;

    const kpiLeidas = document.getElementById('kpi-notif-leidas-count');
    if (kpiLeidas) kpiLeidas.textContent = leidasCount;

    const kpiImportantes = document.getElementById('kpi-notif-importantes-count');
    if (kpiImportantes) kpiImportantes.textContent = notifImportantes.size;

    const badgeNav = document.getElementById('nav-badge-notificaciones');
    if (badgeNav) {
      badgeNav.textContent = noLeidasCount;
      badgeNav.style.display = noLeidasCount === 0 ? 'none' : 'inline-block';
    }

    const bellBubble = document.querySelector('.notif-bubble');
    if (bellBubble) {
      bellBubble.style.display = noLeidasCount === 0 ? 'none' : 'block';
    }
  }

  function toggleNotifImportante(id, btn) {
    if (!btn) btn = document.getElementById('btn-star-' + id);
    const isImportante = notifImportantes.has(id);
    const icon = btn ? btn.querySelector('i') : null;

    if (!isImportante) {
      notifImportantes.add(id);
      if (icon) {
        icon.classList.remove('fa-regular');
        icon.classList.add('fa-solid');
      }
      if (btn) btn.style.color = '#F59E0B';
      showToast('Notificación marcada como importante');
    } else {
      notifImportantes.delete(id);
      if (icon) {
        icon.classList.remove('fa-solid');
        icon.classList.add('fa-regular');
      }
      if (btn) btn.style.color = '#cbd5e1';
      showToast('Notificación desmarcada de importantes');
    }

    saveStoredNotifSet(STORAGE_NOTIF_IMPORTANTES_KEY, notifImportantes);
    updateNotifCounters();
  }

  function marcarNotifLeida(id) {
    if (!notifLeidas.has(id)) {
      notifLeidas.add(id);
      saveStoredNotifSet(STORAGE_NOTIF_LEIDAS_KEY, notifLeidas);

      const card = document.getElementById('notif-card-' + id.replace('notif-', ''));
      if (card) {
        card.style.opacity = '0.70';
      }
      updateNotifCounters();
    }
  }

  // Toast flotante
  let toastTimer = null;
  function showToast(msg) {
    const toast = document.getElementById('toastAlert');
    document.getElementById('toastMessage').textContent = msg;
    toast.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => {
      toast.classList.remove('show');
    }, 3500);
  }

  // Modal y Control de Postulación y Guardadas de Ofertas Laborales
  const STORAGE_POSTULACIONES_KEY = 'SIGE_POSTULACIONES_IDS';
  const STORAGE_GUARDADAS_KEY = 'SIGE_GUARDADAS_IDS';

  function getStoredJobSet(key) {
    try {
      const data = localStorage.getItem(key);
      return data ? new Set(JSON.parse(data)) : new Set();
    } catch(e) {
      return new Set();
    }
  }

  function saveStoredJobSet(key, set) {
    try {
      localStorage.setItem(key, JSON.stringify(Array.from(set)));
    } catch(e) {}
  }

  let appliedJobs = getStoredJobSet(STORAGE_POSTULACIONES_KEY);
  let savedJobs = getStoredJobSet(STORAGE_GUARDADAS_KEY);
  let activePostulacionBtn = null;
  let activePostulacionCargo = '';
  let activePostulacionJobId = '';

  function updateJobCounters() {
    const allJobCards = document.querySelectorAll('#section-oportunidades .job-card-item');
    const totalJobs = allJobCards.length || 3;

    // Actualizar Cuadrito: OFERTAS ACTIVAS
    const elKpiOfertas = document.getElementById('kpi-ofertas-activas-count');
    if (elKpiOfertas) elKpiOfertas.textContent = totalJobs;

    const elKpiInicioOfertas = document.getElementById('kpi-inicio-ofertas-count');
    if (elKpiInicioOfertas) elKpiInicioOfertas.textContent = totalJobs;

    // Actualizar Cuadrito: GUARDADAS
    const elKpiGuardadas = document.getElementById('kpi-guardadas-count');
    if (elKpiGuardadas) elKpiGuardadas.textContent = savedJobs.size;

    // Actualizar Cuadrito: POSTULACIONES
    const elKpiPostulaciones = document.getElementById('kpi-postulaciones-count');
    if (elKpiPostulaciones) elKpiPostulaciones.textContent = appliedJobs.size;
  }

  function postularOferta(cargo, empresa, ubicacion, salario, btn, jobId) {
    activePostulacionCargo = cargo || 'esta vacante';
    activePostulacionBtn = btn || null;
    activePostulacionJobId = jobId || '';

    const cargoEl = document.getElementById('modal-post-cargo');
    const empresaEl = document.getElementById('modal-post-empresa');
    const ubicacionEl = document.getElementById('modal-post-ubicacion');
    const salarioEl = document.getElementById('modal-post-salario');

    if (cargoEl) cargoEl.textContent = cargo || 'Vacante Disponible';
    if (empresaEl) empresaEl.textContent = empresa || 'Empresa Aliada';
    if (ubicacionEl) ubicacionEl.textContent = ubicacion || 'Presencial / Híbrido';
    if (salarioEl) salarioEl.textContent = salario || 'A convenir';

    const modal = document.getElementById('modalPostulacion');
    if (modal) modal.classList.add('active');
  }

  function cerrarModalPostulacion() {
    const modal = document.getElementById('modalPostulacion');
    if (modal) modal.classList.remove('active');
  }

  function cerrarModalPostulacionExitosa() {
    const modal = document.getElementById('modalPostulacionExitosa');
    if (modal) modal.classList.remove('active');
  }

  function confirmarPostulacion() {
    cerrarModalPostulacion();

    if (activePostulacionJobId) {
      appliedJobs.add(activePostulacionJobId);
      saveStoredJobSet(STORAGE_POSTULACIONES_KEY, appliedJobs);
    }

    // Actualizar visualmente el botón sobre el que se dio clic
    if (activePostulacionBtn) {
      activePostulacionBtn.innerHTML = '<i class="fa-solid fa-circle-check"></i> <span>¡Postulado!</span>';
      activePostulacionBtn.style.background = '#EAF7EE';
      activePostulacionBtn.style.color = 'var(--sena-green)';
      activePostulacionBtn.style.border = '1px solid #BBF7D0';
      activePostulacionBtn.style.cursor = 'default';
      activePostulacionBtn.style.boxShadow = 'none';
      activePostulacionBtn.disabled = true;
    }

    // Actualizar todos los cuadritos vinculados
    updateJobCounters();

    // Mostrar ventana modal de confirmación con botón Aceptar
    const successCargo = document.getElementById('modal-success-cargo');
    if (successCargo) successCargo.textContent = activePostulacionCargo || 'la vacante seleccionada';

    setTimeout(() => {
      const modalExitosa = document.getElementById('modalPostulacionExitosa');
      if (modalExitosa) modalExitosa.classList.add('active');
    }, 150);
  }

  function toggleBookmark(btn, jobId) {
    if (!jobId && btn.id) {
      jobId = btn.id.replace('btn-guardar-', '');
    }
    const isSaved = savedJobs.has(jobId);
    const icon = btn.querySelector('i');
    const label = btn.querySelector('span');

    if (!isSaved) {
      savedJobs.add(jobId);
      if (icon) {
        icon.classList.remove('fa-regular');
        icon.classList.add('fa-solid');
      }
      btn.style.color = '#d97706';
      btn.style.borderColor = '#fbbf24';
      btn.style.background = '#fffbeb';
      if (label) label.textContent = 'Guardada';
      showToast('Oferta guardada en tus favoritas');
    } else {
      savedJobs.delete(jobId);
      if (icon) {
        icon.classList.remove('fa-solid');
        icon.classList.add('fa-regular');
      }
      btn.style.color = '';
      btn.style.borderColor = '';
      btn.style.background = '';
      if (label) label.textContent = 'Guardar';
      showToast('Oferta eliminada de tus favoritas');
    }

    saveStoredJobSet(STORAGE_GUARDADAS_KEY, savedJobs);
    updateJobCounters();
  }

  // Filtrado dinámico de ofertas laborales
  function filtrarOfertasLaborales() {
    const q = (document.getElementById('input-buscar-ofertas')?.value || '').toLowerCase().trim();
    const loc = document.getElementById('select-filtro-ubicacion')?.value || 'todas';
    const area = document.getElementById('select-filtro-area')?.value || 'todas';

    const cards = document.querySelectorAll('#section-oportunidades .job-card-item');
    let visibleCount = 0;

    cards.forEach(card => {
      const cardLoc = card.getAttribute('data-location') || '';
      const cardArea = card.getAttribute('data-area') || '';
      const text = card.textContent.toLowerCase();

      let matchSearch = !q || text.includes(q);
      let matchLoc = (loc === 'todas' || cardLoc === loc);
      let matchArea = (area === 'todas' || cardArea === area);

      if (matchSearch && matchLoc && matchArea) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    const empty = document.getElementById('jobs-empty-state');
    if (empty) empty.style.display = visibleCount === 0 ? 'block' : 'none';
  }

  function resetFiltrosOfertas() {
    const input = document.getElementById('input-buscar-ofertas');
    if (input) input.value = '';
    const loc = document.getElementById('select-filtro-ubicacion');
    if (loc) loc.value = 'todas';
    const area = document.getElementById('select-filtro-area');
    if (area) area.value = 'todas';

    filtrarOfertasLaborales();
    showToast('Filtros restablecidos');
  }

  // Filtros de Encuestas (En 'Todas' se eliminan las enviadas, que solo aparecen en 'Respondidas')
  let currentSurveyFilter = 'todas';

  function filterSurveys(filter, btn) {
    if (filter) currentSurveyFilter = filter;

    document.querySelectorAll('.filter-pill-btn').forEach(b => b.classList.remove('active'));
    const targetBtn = btn || document.getElementById('tab-filter-' + currentSurveyFilter);
    if (targetBtn) targetBtn.classList.add('active');

    const items = document.querySelectorAll('.survey-card-item');
    let visibleCount = 0;

    items.forEach(card => {
      const type = card.getAttribute('data-type');
      let shouldShow = false;

      if (currentSurveyFilter === 'todas') {
        // En 'Todas', se eliminan/ocultan las que ya han sido enviadas; solo aparecen las pendientes
        shouldShow = (type !== 'completadas');
      } else if (currentSurveyFilter === 'pendientes') {
        // En 'Pendientes', solo las no respondidas
        shouldShow = (type === 'pendientes');
      } else if (currentSurveyFilter === 'completadas') {
        // En 'Respondidas', solo las enviadas / completadas
        shouldShow = (type === 'completadas');
      }

      if (shouldShow) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    // Control de mensaje de estado vacío
    const emptyState = document.getElementById('survey-empty-state');
    if (emptyState) {
      if (visibleCount === 0) {
        emptyState.style.display = 'flex';
        const titleEl = document.getElementById('empty-state-title');
        const descEl = document.getElementById('empty-state-desc');
        if (currentSurveyFilter === 'completadas') {
          if (titleEl) titleEl.textContent = 'Aún no tienes encuestas respondidas';
          if (descEl) descEl.textContent = 'Cuando diligencies y envíes una encuesta, la encontrarás registrada en este apartado.';
        } else {
          if (titleEl) titleEl.textContent = '¡Estás al día con tus encuestas!';
          if (descEl) descEl.textContent = 'No tienes instrumentos pendientes por diligenciar. Puedes revisar tus respuestas guardadas en la pestaña Respondidas.';
        }
      } else {
        emptyState.style.display = 'none';
      }
    }
  }

  function searchSurveys(query) {
    const q = (query || '').toLowerCase().trim();
    const items = document.querySelectorAll('.survey-card-item');
    let visibleCount = 0;

    items.forEach(card => {
      const type = card.getAttribute('data-type');
      let isCategoryAllowed = false;

      if (currentSurveyFilter === 'todas') {
        isCategoryAllowed = (type !== 'completadas');
      } else if (currentSurveyFilter === 'pendientes') {
        isCategoryAllowed = (type === 'pendientes');
      } else if (currentSurveyFilter === 'completadas') {
        isCategoryAllowed = (type === 'completadas');
      }

      if (!isCategoryAllowed) {
        card.style.display = 'none';
        return;
      }

      const title = card.querySelector('.card-title-text').textContent.toLowerCase();
      const desc = card.querySelector('.card-desc-paragraph').textContent.toLowerCase();
      if (!q || title.includes(q) || desc.includes(q)) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    const emptyState = document.getElementById('survey-empty-state');
    if (emptyState) {
      emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
    }
  }

  function filterSurveyCategory(cat) {
    const items = document.querySelectorAll('.survey-card-item');
    let visibleCount = 0;

    items.forEach(card => {
      const type = card.getAttribute('data-type');
      let isCategoryAllowed = false;

      if (currentSurveyFilter === 'todas') {
        isCategoryAllowed = (type !== 'completadas');
      } else if (currentSurveyFilter === 'pendientes') {
        isCategoryAllowed = (type === 'pendientes');
      } else if (currentSurveyFilter === 'completadas') {
        isCategoryAllowed = (type === 'completadas');
      }

      if (!isCategoryAllowed) {
        card.style.display = 'none';
        return;
      }

      const cardCat = card.getAttribute('data-cat');
      if (cat === 'todas' || cardCat === cat) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    const emptyState = document.getElementById('survey-empty-state');
    if (emptyState) {
      emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
    }
  }

  // Control del Menú Desplegable de Perfil
  function toggleProfileDropdown(forceState) {
    const menu = document.getElementById('profileDropdownMenu');
    const btn = document.getElementById('profileDropdownBtn');
    if (!menu || !btn) return;
    
    const isOpen = forceState !== undefined ? forceState : !menu.classList.contains('show');
    if (isOpen) {
      menu.classList.add('show');
      btn.classList.add('active');
      btn.setAttribute('aria-expanded', 'true');
    } else {
      menu.classList.remove('show');
      btn.classList.remove('active');
      btn.setAttribute('aria-expanded', 'false');
    }
  }

  // Cerrar menú desplegable al hacer clic por fuera
  document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('profileDropdownWrapper');
    if (wrapper && !wrapper.contains(e.target)) {
      toggleProfileDropdown(false);
    }
  });

  // Manejador de teclado Escape para cerrar modales y menús
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      toggleProfileDropdown(false);
      closeSurveyModal();
      closeEncuestaEnviadaModal();
      closeInscripcionModal();
      closeInscripcionExitosaModal();
      cerrarModalPostulacion();
      cerrarModalPostulacionExitosa();
    }
  });

  // Carga inicial según el hash en la URL y restauración de estado persistido
  window.addEventListener('DOMContentLoaded', () => {
    // Restaurar encuestas respondidas previamente desde localStorage
    if (answeredSurveys && answeredSurveys.size > 0) {
      answeredSurveys.forEach(id => {
        markSurveyAsCompleted(id, false);
      });
    }
    updateSurveyCounters();

    // Restaurar estado persistido de ofertas postuladas y guardadas
    if (appliedJobs && appliedJobs.size > 0) {
      appliedJobs.forEach(id => {
        const btn = document.getElementById('btn-postular-' + id);
        if (btn) {
          btn.innerHTML = '<i class="fa-solid fa-circle-check"></i> <span>¡Postulado!</span>';
          btn.style.background = '#EAF7EE';
          btn.style.color = 'var(--sena-green)';
          btn.style.border = '1px solid #BBF7D0';
          btn.style.cursor = 'default';
          btn.style.boxShadow = 'none';
          btn.disabled = true;
        }
      });
    }

    if (savedJobs && savedJobs.size > 0) {
      savedJobs.forEach(id => {
        const btn = document.getElementById('btn-guardar-' + id);
        if (btn) {
          const icon = btn.querySelector('i');
          const label = btn.querySelector('span');
          if (icon) {
            icon.classList.remove('fa-regular');
            icon.classList.add('fa-solid');
          }
          btn.style.color = '#d97706';
          btn.style.borderColor = '#fbbf24';
          btn.style.background = '#fffbeb';
          if (label) label.textContent = 'Guardada';
        }
      });
    }

    // Actualizar todos los cuadritos/KPIs vinculados con lo que hay
    updateJobCounters();

    // Restaurar eventos inscritos
    if (inscribedEvents && inscribedEvents.size > 0) {
      inscribedEvents.forEach(id => {
        const btn = document.getElementById('btn-inscribir-' + id);
        if (btn) {
          btn.innerHTML = '<i class="fa-solid fa-circle-check"></i> <span>¡Inscrito!</span>';
          btn.style.background = '#EAF7EE';
          btn.style.color = 'var(--sena-green)';
          btn.style.border = '1px solid #BBF7D0';
          btn.style.cursor = 'default';
          btn.style.boxShadow = 'none';
          btn.disabled = true;
        }
      });
    }

    // Actualizar cuadritos de eventos vinculados
    updateEventCounters();

    // Restaurar notificaciones importantes y leídas
    if (notifImportantes && notifImportantes.size > 0) {
      notifImportantes.forEach(id => {
        const btn = document.getElementById('btn-star-' + id);
        if (btn) {
          const icon = btn.querySelector('i');
          if (icon) {
            icon.classList.remove('fa-regular');
            icon.classList.add('fa-solid');
          }
          btn.style.color = '#F59E0B';
        }
      });
    }

    if (notifLeidas && notifLeidas.size > 0) {
      notifLeidas.forEach(id => {
        const card = document.getElementById('notif-card-' + id.replace('notif-', ''));
        if (card) {
          card.style.opacity = '0.70';
        }
      });
    }

    // Actualizar cuadritos de notificaciones vinculados
    updateNotifCounters();

    // Aplicar filtrado para que en 'Todas' se eliminen las enviadas y solo aparezcan en 'Respondidas'
    filterSurveys(currentSurveyFilter);

    const hash = window.location.hash.replace('#', '');
    if (hash && sectionsList.includes(hash)) {
      showSection(hash);
    } else {
      showSection('inicio');
    }
  });
</script>

</body>
</html>
