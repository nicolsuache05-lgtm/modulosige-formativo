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

    .brand-box, .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 4px 8px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.14);
      margin-bottom: 16px;
      cursor: pointer;
      text-decoration: none;
      color: #fff;
    }
    .brand-badge, .brand-icon-wrap {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      padding: 4px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
      border: 2px solid var(--sena-neon, #62E31D);
    }
    .brand-badge img, .brand-icon-wrap img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      border-radius: 8px;
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
    .brand-title, .brand-name {
      font-family: 'Poppins', 'Nunito', sans-serif;
      font-size: 16px;
      font-weight: 800;
      letter-spacing: 0.5px;
      color: #FFFFFF;
      line-height: 1.1;
    }
    .brand-sub {
      font-size: 10.5px;
      color: var(--sena-neon, #62E31D);
      font-weight: 600;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      margin-top: 3px;
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
    /* ========================================================
       ANIMACIÓN Y ESTILO DEL LOGO EN LA ESQUINITA (HERO BANNER)
       ======================================================== */
    .hero-corner-decor-wrapper {
      position: absolute;
      right: 18px;
      bottom: -4px;
      z-index: 2;
      pointer-events: auto;
      display: flex;
      align-items: flex-end;
      justify-content: flex-end;
      animation: cornerEmergence 1.2s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    .hero-corner-glow {
      position: absolute;
      right: -20px;
      bottom: -20px;
      width: 260px;
      height: 260px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(98, 227, 29, 0.32) 0%, rgba(57, 169, 0, 0.16) 45%, transparent 70%);
      pointer-events: none;
      z-index: 1;
      animation: pulseCornerGlow 4s ease-in-out infinite alternate;
    }

    .hero-image-decor {
      position: relative;
      height: 215px;
      max-width: 330px;
      object-fit: contain;
      z-index: 2;
      filter: drop-shadow(0 14px 26px rgba(0, 19, 30, 0.6)) drop-shadow(0 0 18px rgba(57, 169, 0, 0.35));
      transform-origin: bottom right;
      animation: gentleCornerFloat 4.2s ease-in-out infinite 1.2s;
      transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), filter 0.4s ease;
      cursor: pointer;
      user-select: none;
    }

    .hero-banner-card:hover .hero-image-decor,
    .hero-image-decor:hover {
      transform: translateY(-10px) scale(1.05) rotate(-2.5deg);
      filter: drop-shadow(0 20px 36px rgba(0, 19, 30, 0.7)) drop-shadow(0 0 26px rgba(98, 227, 29, 0.55));
    }

    @keyframes cornerEmergence {
      0% {
        opacity: 0;
        transform: translate(80px, 80px) scale(0.6) rotate(10deg);
      }
      60% {
        opacity: 1;
        transform: translate(-8px, -10px) scale(1.06) rotate(-3deg);
      }
      82% {
        transform: translate(3px, 3px) scale(0.98) rotate(1deg);
      }
      100% {
        opacity: 1;
        transform: translate(0, 0) scale(1) rotate(0deg);
      }
    }

    @keyframes gentleCornerFloat {
      0% {
        transform: translateY(0px) rotate(0deg);
      }
      50% {
        transform: translateY(-8px) rotate(-1.5deg);
      }
      100% {
        transform: translateY(0px) rotate(0deg);
      }
    }

    @keyframes pulseCornerGlow {
      0% {
        transform: scale(0.85);
        opacity: 0.55;
      }
      100% {
        transform: scale(1.18);
        opacity: 1;
      }
    }

    /* ========================================================
       BANNER Y MODAL ACTUALIZACIÓN DE CONTRASEÑA INICIAL (ERP SENA)
       ======================================================== */
    .banner-password-erp-card {
      background: linear-gradient(135deg, #00131E 0%, #002336 100%);
      border-left: 5px solid #39A900;
      border: 1px solid rgba(98, 227, 29, 0.35);
      border-radius: 18px;
      padding: 20px 26px;
      margin-bottom: 24px;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      box-shadow: 0 8px 24px rgba(0, 19, 30, 0.22);
      position: relative;
      overflow: hidden;
      animation: fadeInDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .banner-password-erp-card::before {
      content: '';
      position: absolute;
      top: -40px;
      right: 40px;
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(98, 227, 29, 0.2) 0%, transparent 70%);
      pointer-events: none;
    }
    .banner-password-icon-box {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      background: linear-gradient(135deg, #39A900 0%, #2a7c00 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      color: #fff;
      flex-shrink: 0;
      position: relative;
      box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35);
    }
    .banner-password-icon-box .pulse-indicator-badge {
      position: absolute;
      top: -3px;
      right: -3px;
      width: 12px;
      height: 12px;
      background: #62E31D;
      border: 2px solid #00131E;
      border-radius: 50%;
      animation: pulseGlow 2s infinite;
    }
    .banner-password-content {
      flex: 1;
    }
    .banner-password-tags {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 6px;
      flex-wrap: wrap;
    }
    .tag-alerta-erp {
      font-size: 10.5px;
      font-weight: 800;
      color: #62E31D;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }
    .tag-alerta-sub {
      background: rgba(255, 255, 255, 0.12);
      color: #FFFFFF;
      font-size: 10px;
      font-weight: 700;
      padding: 2px 8px;
      border-radius: 12px;
    }
    .banner-password-title {
      font-family: 'Poppins', 'Nunito', sans-serif;
      font-size: 16px;
      font-weight: 700;
      margin: 0 0 4px 0;
      color: #FFFFFF;
    }
    .banner-password-desc {
      font-size: 12.5px;
      color: rgba(255, 255, 255, 0.82);
      margin: 0;
      line-height: 1.45;
    }
    .banner-password-action {
      flex-shrink: 0;
    }
    .btn-actualizar-pwd-erp {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: linear-gradient(135deg, #39A900 0%, #2d8500 100%);
      color: #FFFFFF;
      border: none;
      padding: 12px 22px;
      border-radius: 12px;
      font-size: 13px;
      font-weight: 700;
      font-family: inherit;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35);
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      white-space: nowrap;
    }
    .btn-actualizar-pwd-erp:hover {
      background: linear-gradient(135deg, #43be04 0%, #329600 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(57, 169, 0, 0.5);
    }
    .input-password-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }
    .input-password-wrapper input {
      padding-right: 42px !important;
    }
    .btn-toggle-eye {
      position: absolute;
      right: 12px;
      background: none;
      border: none;
      color: #8B9FA9;
      cursor: pointer;
      font-size: 15px;
      padding: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: color 0.2s ease;
    }
    .btn-toggle-eye:hover {
      color: #39A900;
    }
    .pwd-match-status {
      font-size: 11.5px;
      font-weight: 700;
      margin-top: 5px;
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .pwd-match-status.ok {
      color: #16a34a;
    }
    .pwd-match-status.err {
      color: #dc2626;
    }
    .erp-security-tips {
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 12px;
      padding: 12px 16px;
      margin-top: 14px;
      font-size: 12px;
      color: #475569;
    }
    .erp-security-tips ul {
      margin: 6px 0 0 18px;
      padding: 0;
    }
    .erp-security-tips li {
      margin-bottom: 3px;
    }
    @media (max-width: 768px) {
      .banner-password-erp-card {
        flex-direction: column;
        align-items: flex-start;
        padding: 18px 20px;
      }
      .banner-password-action {
        width: 100%;
      }
      .btn-actualizar-pwd-erp {
        width: 100%;
        justify-content: center;
      }
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
       TARJETAS Y ELEMENTOS DE NOTICIAS INSTITUCIONALES
       ======================================================== */
    .news-card {
      background: #ffffff;
      border: 1px solid var(--line);
      border-radius: 18px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: all 0.25s ease;
      position: relative;
      box-shadow: var(--shadow-sm);
    }
    .news-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 28px rgba(0, 19, 30, 0.09);
      border-color: rgba(57, 169, 0, 0.45);
    }
    .news-card-img-wrap {
      width: 100%;
      height: 170px;
      position: relative;
      overflow: hidden;
      background: #001A29;
    }
    .news-card-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }
    .news-card:hover .news-card-img-wrap img {
      transform: scale(1.05);
    }
    .news-card-img-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.70) 0%, transparent 60%);
    }
    .badge-pill-over-img {
      position: absolute;
      bottom: 10px;
      left: 12px;
      z-index: 2;
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    .news-card-no-img {
      padding: 16px 20px 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      background: #F8FAFC;
      border-bottom: 1px solid #EDF2F7;
    }
    .news-card-body {
      padding: 18px 20px 20px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }
    .news-card-meta-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      margin-bottom: 8px;
      font-size: 11.5px;
      color: #64748B;
    }
    .news-date-pill {
      font-size: 11.5px;
      color: #64748B;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-weight: 500;
    }
    .news-status-pill {
      font-size: 10.5px;
      font-weight: 700;
      padding: 2px 8px;
      border-radius: 999px;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }
    .news-status-pill.destacada {
      background: #EEF4FF;
      color: #1D4ED8;
      border: 1px solid rgba(29, 78, 216, 0.25);
    }
    .news-status-pill.publicada {
      background: #EAF7EE;
      color: #166534;
      border: 1px solid rgba(22, 101, 52, 0.25);
    }
    .news-card-title {
      font-size: 15.5px;
      font-weight: 700;
      color: #0F172A;
      line-height: 1.35;
      margin: 4px 0 8px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .news-target-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 3px 9px;
      background: #F1F5F9;
      color: #475569;
      font-size: 11px;
      font-weight: 600;
      border-radius: 6px;
      margin-bottom: 10px;
      align-self: flex-start;
    }
    .news-target-badge i {
      color: var(--sena-green);
      font-size: 10px;
    }
    .news-card-summary {
      font-size: 12.5px;
      color: #475569;
      line-height: 1.5;
      margin-bottom: 16px;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .news-card-footer {
      padding-top: 14px;
      border-top: 1px solid #F1F5F9;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: auto;
      gap: 10px;
    }
    .news-author-info {
      display: flex;
      align-items: center;
      gap: 8px;
      overflow: hidden;
    }
    .news-author-avatar {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: #EAF7EE;
      color: var(--sena-green);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      border: 1px solid #BBF7D0;
      flex-shrink: 0;
    }
    .news-author-texts {
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }
    .news-author-name {
      font-size: 11px;
      font-weight: 700;
      color: #1E293B;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 120px;
    }
    .news-author-views {
      font-size: 10px;
      color: #94A3B8;
    }
    .btn-leer-noticia {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      background: #EAF7EE;
      color: #166534;
      border: 1px solid #BBF7D0;
      border-radius: 9px;
      font-size: 11.5px;
      font-weight: 700;
      cursor: pointer;
      transition: var(--transition);
      flex-shrink: 0;
    }
    .btn-leer-noticia:hover {
      background: var(--sena-green);
      color: #ffffff;
      border-color: var(--sena-green);
    }
    .badge-pill {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 3px 10px;
      border-radius: 999px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.3px;
    }
    .badge-pill.status-green { background: #EAF7EE; color: #1E7E34; border: 1px solid rgba(40,167,69,0.25); }
    .badge-pill.status-blue { background: #EEF4FF; color: #1D4ED8; border: 1px solid rgba(29,78,216,0.25); }
    .badge-pill.status-amber { background: #FFF8E6; color: #B45309; border: 1px solid rgba(217,119,6,0.25); }

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
      max-width: 560px;
      width: 100%;
      position: relative;
      box-shadow: 0 20px 45px rgba(0, 19, 30, 0.22);
      border-top: 4px solid #39A900;
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

    /* Modal Encuesta Preguntas con Colores Oficiales ERP SENA Empresa */
    .modal-header-banner {
      background: linear-gradient(135deg, #00131E 0%, #002336 100%);
      border-left: 4px solid #39A900;
      border-radius: var(--radius-md);
      padding: 18px 20px;
      margin-bottom: 20px;
      box-shadow: 0 4px 14px rgba(0, 19, 30, 0.08);
    }
    .modal-header-banner h3 {
      font-family: 'Poppins', 'Nunito', sans-serif;
      font-size: 16.5px;
      font-weight: 700;
      color: #FFFFFF;
      margin: 0 0 4px;
    }
    .modal-header-banner p {
      font-size: 12.5px;
      color: rgba(255, 255, 255, 0.85);
      margin: 0;
      line-height: 1.4;
    }
    .question-block {
      background: #FAFDF7;
      border: 1px solid #E8F5E9;
      border-radius: var(--radius-md);
      padding: 14px 16px;
      margin-bottom: 14px;
    }
    .question-title {
      font-size: 13.5px;
      font-weight: 700;
      color: #001A29;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .question-title .q-num-badge {
      background: #39A900;
      color: #FFFFFF;
      width: 22px;
      height: 22px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 800;
      flex-shrink: 0;
    }
    .question-title span.required-star { color: #dc2626; }
    .option-radio-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 4px;
      padding: 6px 10px;
      border-radius: 8px;
      font-size: 13px;
      color: #001A29;
      cursor: pointer;
      border: 1px solid transparent;
      transition: all 0.2s ease;
    }
    .option-radio-row:hover {
      background: #F0FDF4;
      border-color: #BBF7D0;
    }
    .option-radio-row input[type="radio"] {
      accent-color: #39A900;
      width: 17px;
      height: 17px;
      cursor: pointer;
    }

    /* ========================================================
       MODALES DE CONFIRMACIÓN Y ALERTA (DISEÑO OFICIAL SUPERADMIN SENA ERP)
       ======================================================== */
    .success-modal-card {
      background: #FFFFFF;
      border-radius: 28px;
      padding: 36px 30px;
      max-width: 440px;
      width: 100%;
      text-align: center;
      box-shadow: 0 25px 60px -10px rgba(0, 19, 30, 0.45);
      border: 1.5px solid rgba(57, 169, 0, 0.25);
      position: relative;
      overflow: hidden;
      transform: scale(0.92);
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .modal-backdrop.active .success-modal-card {
      transform: scale(1);
    }

    /* Contenedor del Chulito Animado SENA ERP */
    .sena-chulito-container {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px auto;
      width: 86px;
      height: 86px;
    }

    /* Halo pulsante de fondo */
    .sena-chulito-glow {
      position: absolute;
      inset: -6px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(57, 169, 0, 0.28) 0%, rgba(57, 169, 0, 0) 70%);
      animation: sena-pulse-halo 2s ease-in-out infinite;
    }

    /* Círculo base con elevación */
    .sena-chulito-badge {
      width: 78px;
      height: 78px;
      border-radius: 50%;
      background: linear-gradient(135deg, #39A900 0%, #2e8b00 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 12px 28px -6px rgba(57, 169, 0, 0.45), 
                  inset 0 2px 4px rgba(255, 255, 255, 0.35);
      animation: sena-chulito-pop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
      z-index: 2;
    }

    /* SVG del Chulito SENA */
    .sena-chulito-svg {
      width: 44px;
      height: 44px;
      stroke: #ffffff;
      stroke-width: 4.5;
      stroke-linecap: round;
      stroke-linejoin: round;
      fill: none;
    }

    /* Trazo animado del chulito */
    .sena-chulito-path {
      stroke-dasharray: 60;
      stroke-dashoffset: 60;
      animation: sena-draw-check 0.45s cubic-bezier(0.65, 0, 0.45, 1) 0.35s forwards;
    }

    /* Barra de progreso de autocierre */
    .sena-alert-progress {
      height: 5px;
      background: linear-gradient(to right, #39A900, #62E31D);
      width: 100%;
      border-radius: 0 0 24px 24px;
      transform-origin: left;
      animation: sena-progress-drain 7.5s linear forwards;
    }

    .success-modal-card:hover .sena-alert-progress {
      animation-play-state: paused;
    }

    @keyframes sena-chulito-pop {
      0% { transform: scale(0.3); opacity: 0; }
      70% { transform: scale(1.1); }
      100% { transform: scale(1); opacity: 1; }
    }

    @keyframes sena-pulse-halo {
      0%, 100% { transform: scale(0.95); opacity: 0.6; }
      50% { transform: scale(1.2); opacity: 1; }
    }

    @keyframes sena-draw-check {
      from { stroke-dashoffset: 60; }
      to { stroke-dashoffset: 0; }
    }

    @keyframes sena-progress-drain {
      from { transform: scaleX(1); }
      to { transform: scaleX(0); }
    }

    .btn-modal-accept {
      background: linear-gradient(135deg, #001A29 0%, #39A900 100%);
      color: #FFFFFF !important;
      border: none;
      padding: 14px 24px;
      border-radius: 16px;
      font-size: 14px;
      font-weight: 800;
      cursor: pointer;
      font-family: inherit;
      width: 100%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.25s ease;
      box-shadow: 0 10px 24px -4px rgba(57, 169, 0, 0.45), 0 4px 10px rgba(0, 26, 41, 0.25);
    }
    .btn-modal-accept:hover {
      background: linear-gradient(135deg, #00131E 0%, #2e8b00 100%);
      transform: translateY(-2px);
      box-shadow: 0 12px 28px -4px rgba(57, 169, 0, 0.55), 0 6px 12px rgba(0, 26, 41, 0.3);
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
      .hero-corner-decor-wrapper { right: 10px; bottom: -6px; }
      .hero-image-decor { height: 160px; max-width: 240px; }
    }
    @media (max-width: 768px) {
      .hero-corner-decor-wrapper { opacity: 0.35; right: -15px; bottom: -15px; pointer-events: none; }
      .hero-image-decor { height: 130px; }
    }
    @media (max-width: 640px) {
      .topbar { padding: 12px 18px; }
      .content-container { padding: 20px 16px 40px; }
      .hero-banner-card { padding: 24px 20px; flex-direction: column; align-items: flex-start; gap: 18px; }
      .hero-action-box { margin-left: 0; }
      .hero-heading { font-size: 24px; }
      .kpi-row-grid { grid-template-columns: 1fr; }
    }
    /* ========================================================
       ESTILOS DEL INICIO ENRIQUECIDO (PORTAL EGRESADO)
       ======================================================== */
    .egresado-credential-card {
      background: #FFFFFF;
      border-radius: var(--radius-xl);
      box-shadow: var(--shadow-md);
      border: 1px solid var(--line);
      overflow: hidden;
      margin-top: 24px;
      margin-bottom: 24px;
      transition: var(--transition);
    }
    .credential-card-header {
      background: linear-gradient(135deg, var(--sena-dark) 0%, var(--sena-navy) 100%);
      padding: 22px 28px;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 3px solid var(--sena-green);
    }
    .credential-card-body {
      padding: 24px 28px;
    }
    .credential-info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
      gap: 16px;
      margin-top: 14px;
    }
    .credential-info-item {
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: var(--radius-md);
      padding: 12px 16px;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .credential-info-item .ci-label {
      font-size: 11px;
      font-weight: 700;
      color: #64748B;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .credential-info-item .ci-val {
      font-size: 13.5px;
      font-weight: 700;
      color: var(--sena-dark);
      word-break: break-word;
    }
    .credential-progress-wrap {
      margin-top: 20px;
      padding-top: 18px;
      border-top: 1px solid var(--line);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 14px;
    }
    .credential-progress-bar {
      flex: 1;
      min-width: 200px;
    }
    .credential-bar-track {
      height: 8px;
      background: #E2E8F0;
      border-radius: 999px;
      overflow: hidden;
      margin-top: 6px;
    }
    .credential-bar-fill {
      height: 100%;
      background: linear-gradient(90deg, var(--sena-green), var(--sena-neon));
      border-radius: 999px;
      width: 85%;
      transition: width 0.6s ease;
    }
    .quick-actions-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
      gap: 16px;
      margin-bottom: 26px;
    }
    .quick-action-card {
      background: #FFFFFF;
      border-radius: var(--radius-lg);
      border: 1px solid var(--line);
      padding: 18px;
      transition: var(--transition);
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 14px;
      box-shadow: var(--shadow-sm);
    }
    .quick-action-card:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow-md);
      border-color: var(--sena-green);
    }
    .qa-icon-wrap {
      width: 46px;
      height: 46px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 19px;
      flex-shrink: 0;
    }
    .qa-icon-wrap.green { background: #EAF7EE; color: var(--sena-green); }
    .qa-icon-wrap.blue { background: #EFF6FF; color: #2563EB; }
    .qa-icon-wrap.purple { background: #FAF5FF; color: #9333EA; }
    .qa-icon-wrap.orange { background: #FFF7ED; color: #EA580C; }
    .home-two-col-grid {
      display: grid;
      grid-template-columns: 1.35fr 1fr;
      gap: 22px;
      margin-bottom: 24px;
    }
    .home-box-panel {
      background: #FFFFFF;
      border-radius: var(--radius-xl);
      border: 1px solid var(--line);
      padding: 22px;
      box-shadow: var(--shadow-sm);
    }
    .home-box-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
      padding-bottom: 12px;
      border-bottom: 1px solid var(--line);
    }
    .home-box-title {
      font-size: 16px;
      font-weight: 700;
      color: var(--sena-dark);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .home-news-card {
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: var(--radius-md);
      padding: 14px;
      display: flex;
      gap: 14px;
      margin-bottom: 12px;
      transition: var(--transition);
      cursor: pointer;
      align-items: center;
    }
    .home-news-card:hover {
      border-color: var(--sena-green);
      background: #FFFFFF;
      box-shadow: var(--shadow-sm);
      transform: translateY(-2px);
    }
    .home-news-thumb {
      width: 82px;
      height: 68px;
      border-radius: 10px;
      object-fit: cover;
      background: var(--sena-navy);
      flex-shrink: 0;
    }
    .home-event-card {
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: var(--radius-md);
      padding: 12px 14px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 10px;
      transition: var(--transition);
    }
    .home-event-card:hover {
      border-color: var(--sena-green);
      background: #FFFFFF;
    }
    .home-event-datebox {
      width: 48px;
      height: 48px;
      border-radius: 10px;
      background: #EAF7EE;
      border: 1px solid #BBF7D0;
      color: var(--sena-green-hover);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      font-weight: 800;
      flex-shrink: 0;
      text-transform: uppercase;
      line-height: 1.1;
    }
    .home-event-datebox span {
      font-size: 16px;
      font-weight: 800;
      color: var(--sena-green);
    }
    .home-job-item {
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: var(--radius-md);
      padding: 12px 14px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 10px;
      transition: var(--transition);
    }
    .home-job-item:hover {
      border-color: #2563EB;
      background: #FFFFFF;
    }

    /* Estilos para el Perfil del Egresado y Modal de Actualización */
    .btn-actualizar-perfil-hero {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: linear-gradient(135deg, #62E31D 0%, #39A900 100%);
      color: #001A29 !important;
      font-size: 13px;
      font-weight: 800;
      padding: 10px 20px;
      border-radius: 12px;
      border: none;
      cursor: pointer;
      transition: all 0.25s ease;
      box-shadow: 0 4px 14px rgba(98, 227, 29, 0.35);
      font-family: inherit;
      text-decoration: none;
    }
    .btn-actualizar-perfil-hero:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(98, 227, 29, 0.5);
      background: linear-gradient(135deg, #74ea37 0%, #40ba02 100%);
    }

    .profile-form-section {
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 14px;
      padding: 16px 18px;
      margin-bottom: 16px;
    }
    .profile-form-section-title {
      font-size: 13px;
      font-weight: 800;
      color: #001A29;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 8px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .profile-form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 12px;
    }
    .profile-input-group {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .profile-input-group label {
      font-size: 11.5px;
      font-weight: 700;
      color: #475569;
    }
    .profile-input-group input,
    .profile-input-group select,
    .profile-input-group textarea {
      width: 100%;
      border: 1px solid #CBD5E1;
      border-radius: 10px;
      padding: 9px 12px;
      font-size: 13px;
      font-family: inherit;
      color: #0F172A;
      background: #FFFFFF;
      transition: all 0.2s ease;
      outline: none;
    }
    .profile-input-group input:focus,
    .profile-input-group select:focus,
    .profile-input-group textarea:focus {
      border-color: #39A900;
      box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.15);
      background: #FFFFFF;
    }
    .profile-input-readonly {
      background: #F1F5F9 !important;
      color: #64748B !important;
      cursor: not-allowed;
      border-color: #E2E8F0 !important;
    }

    @media (max-width: 900px) {
      .home-two-col-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<div class="app-layout">

  <!-- ========================================================
       BARRA LATERAL / SIDEBAR (Paleta y estructura admin/encuestas)
       ======================================================== -->
  <aside class="sidebar">

    <!-- Marca / Logo SENA SIGE Institucional -->
    <a href="{{ route('egresados.dashboard_egresado') }}" class="brand" onclick="showSection('inicio')">
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
      <a id="nav-noticias" class="nav-item" onclick="showSection('noticias')">
        <i class="fa-solid fa-newspaper"></i>
        <span>Noticias</span>
      </a>
      <a id="nav-eventos" class="nav-item" onclick="showSection('eventos')">
        <i class="fa-regular fa-calendar-check"></i>
        <span>Eventos</span>
        <span class="nav-badge" id="nav-badge-eventos" style="display:none;">0</span>
      </a>
    </nav>

  </aside>

  <!-- ========================================================
       CONTENIDO PRINCIPAL
       ======================================================== -->
  <div class="main-wrapper">

    <!-- BARRA SUPERIOR / TOPBAR INSTITUCIONAL SENA ERP -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="hamburger sm:hidden" style="display:none;" onclick="toggleMobileSidebar()"><i class="fa-solid fa-bars"></i></button>
      </div>

      @include('egresados::superadmin.partials._topbar_right')
    </header>

    <!-- ÁREA DE CONTENIDO -->
    <main class="content-container">

      <!-- ========================================================
           SECCIÓN 1: INICIO (SOLO BANNER HERO + 3 TARJETAS KPI)
           ======================================================== -->
      <section id="section-inicio" class="section-tab active">

        @if(!empty($debeActualizarPassword))
        <!-- Letrerito Bonito con Colores del ERP: Alerta de Actualización de Contraseña Inicial -->
        <div id="banner-alerta-password-inicial" class="banner-password-erp-card">
          <div class="banner-password-icon-box">
            <i class="fa-solid fa-shield-halved"></i>
            <span class="pulse-indicator-badge"></span>
          </div>
          <div class="banner-password-content">
            <div class="banner-password-tags">
              <span class="tag-alerta-erp"><i class="fa-solid fa-lock"></i> SEGURIDAD INSTITUCIONAL · CEFA SENA</span>
              <span class="tag-alerta-sub">Primer Ingreso al Sistema</span>
            </div>
            <h3 class="banner-password-title">¡Actualización de Contraseña Inicial Requerida!</h3>
            <p class="banner-password-desc">
              Detectamos que estás ingresando con tu contraseña inicial (tu documento de identidad). Para proteger tu privacidad y salvaguardar tus datos en el CEFA, debes asignar una nueva contraseña personal.
            </p>
          </div>
          <div class="banner-password-action">
            <button type="button" class="btn-actualizar-pwd-erp" onclick="openModalActualizarPasswordInicial()">
              <i class="fa-solid fa-key"></i>
              <span>Actualizar Contraseña Ahora</span>
            </button>
          </div>
        </div>
        @endif

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
            <div style="margin-top: 14px;">
              <button type="button" class="btn-actualizar-perfil-hero" onclick="openModalActualizarPerfilEgresado()">
                <i class="fa-solid fa-user-pen"></i>
                <span>Actualizar mi Información</span>
              </button>
            </div>
          </div>
          <div class="hero-corner-decor-wrapper">
            <div class="hero-corner-glow"></div>
            <img src="{{ route('egresados.assets.image', 'egresados-banner-transparent.png') }}" class="hero-image-decor" alt="Egresados SENA CEFA" title="¡Egresados CEFA SENA, Contigo Siempre!">
          </div>
        </div>

        @if(isset($invitacionesEventos) && count($invitacionesEventos) > 0)
          @php 
            $primeraInv = reset($invitacionesEventos);
            $invKeys = array_keys($invitacionesEventos);
            $primeraInvKey = reset($invKeys);
            $invEventId = 'event-inv-' . ($primeraInv['id'] ?? $primeraInvKey);
            $invEventTitle = $primeraInv['title'] ?? 'Evento Institucional CEFA';
          @endphp
          <div id="banner-invitacion-evento" data-event-id="{{ $invEventId }}" data-event-title="{{ $invEventTitle }}" style="background: linear-gradient(135deg, #00131E 0%, #002336 100%); border-left: 5px solid #39A900; border-radius: 16px; padding: 16px 20px; margin-bottom: 24px; color: #fff; display: flex; align-items: center; justify-content: space-between; gap: 16px; box-shadow: 0 4px 16px rgba(0,19,30,0.12); transition: all 0.3s ease;">
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
            <div style="display: flex; align-items: center; gap: 10px; flex-shrink: 0;">
              <button type="button" class="btn-green-submit" style="padding: 8px 18px; font-size: 12px; font-weight: 700; border-radius: 10px; white-space: nowrap; cursor: pointer;" onclick="openInscripcionModal('{{ addslashes($invEventTitle) }}', document.getElementById('btn-inscribir-{{ $invEventId }}'), '{{ $invEventId }}');">
                Ver e Inscribirme
              </button>
              <button type="button" onclick="descartarBannerInvitacion('{{ $invEventId }}', '{{ addslashes($invEventTitle) }}')" title="Ocultar invitación" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); color: #fff; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 14px; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                <i class="fa-solid fa-xmark"></i>
              </button>
            </div>
          </div>
          <script>
            (function(){
              try {
                var eid = '{{ $invEventId }}';
                var etitle = '{{ addslashes(mb_strtolower(trim($invEventTitle))) }}';
                var userKey = 'usr_{{ Auth::id() ?? 0 }}_{{ $person->document_number ?? (Auth::user()->nickname ?? "anon") }}';
                var backendEvents = @json($misEventosRespondidos ?? []);
                var storedEvents = JSON.parse(localStorage.getItem('sige_events_' + userKey) || '[]');
                var storedDismissed = JSON.parse(localStorage.getItem('sige_dismissed_inv_' + userKey) || '[]');
                var allCheck = [].concat(backendEvents, storedEvents, storedDismissed);
                var isDone = allCheck.some(function(item){
                  if (!item) return false;
                  var s = String(item).toLowerCase();
                  return s === eid.toLowerCase() || s === etitle || s.indexOf(etitle) !== -1 || etitle.indexOf(s.replace('title:', '')) !== -1;
                });
                if (isDone) {
                  var b = document.getElementById('banner-invitacion-evento');
                  if (b) b.style.display = 'none';
                }
              } catch(e){}
            })();
          </script>
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

          <!-- KPI 2: Noticias Institucionales -->
          <div class="kpi-metric-card" onclick="showSection('noticias')">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">NOTICIAS INSTITUCIONALES</span>
              <span class="kpi-big-number" id="kpi-inicio-noticias-count">{{ count($noticiasPublicadas ?? []) }}</span>
              <span class="kpi-sub-text">Comunicados y convocatorias</span>
            </div>
            <div class="kpi-icon-badge blue">
              <i class="fa-solid fa-newspaper"></i>
            </div>
          </div>

          <!-- KPI 3: Eventos Activos -->
          <div class="kpi-metric-card" onclick="showSection('eventos')">
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
            <button class="filter-pill-btn active" id="tab-filter-pendientes" onclick="filterSurveys('pendientes', this)">Pendientes (<span id="count-filter-pendientes">{{ $encuestasPendientes ?? 0 }}</span>)</button>
            <button class="filter-pill-btn" id="tab-filter-todas" onclick="filterSurveys('todas', this)">Todas (<span id="count-filter-todas">{{ isset($encuestasDisponibles) ? count($encuestasDisponibles) : 0 }}</span>)</button>
            <button class="filter-pill-btn" id="tab-filter-completadas" onclick="filterSurveys('completadas', this)">Respondidas (<span id="count-filter-completadas">0</span>)</button>
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

            @if(isset($encuestasDisponibles) && count($encuestasDisponibles) > 0)
              @foreach($encuestasDisponibles as $enc)
                @php
                  $encId = $enc['id'];
                  $isClosed = strtoupper($enc['status'] ?? 'ACTIVA') === 'CERRADA';
                  $cat = $enc['category'] ?? ((stripos($enc['title'] ?? '', 'laboral') !== false || stripos($enc['title'] ?? '', 'empleo') !== false) ? 'laboral' : 'institucional');
                  $creador = $enc['creado_por'] ?? 'Super Admin / Instructor';
                  $target = $enc['target'] ?? 'Comunidad de Egresados';
                  $fechaLimite = $enc['fecha_cierre'] ?? $enc['date'] ?? 'Próximamente';
                  $titulo = $enc['title'] ?? ($enc['full_title'] ?? 'Encuesta Institucional');
                @endphp
                <div class="portal-item-card survey-card-item" id="survey-card-{{ $encId }}" data-id="{{ $encId }}" data-type="{{ $isClosed ? 'completadas' : 'pendientes' }}" data-cat="{{ $cat }}">
                  <div class="card-icon-pill {{ $cat === 'laboral' ? 'purple' : 'green' }}" id="survey-icon-{{ $encId }}">
                    <i class="fa-solid {{ $cat === 'laboral' ? 'fa-briefcase' : 'fa-clipboard-list' }}"></i>
                  </div>
                  <div class="card-body-content">
                    <div class="card-top-header">
                      <div>
                        <h3 class="card-title-text">{{ $titulo }}</h3>
                        <span class="card-tag-badge {{ $cat === 'laboral' ? 'purple' : '' }}" id="survey-badge-{{ $encId }}">
                          {{ $target }} · <strong style="font-weight:700;">{{ $creador }}</strong>
                        </span>
                      </div>
                      <div id="survey-btn-wrap-{{ $encId }}">
                        @if($isClosed)
                          <button type="button" class="btn-card-outline" style="border-color:#94a3b8; color:#64748b; background:#f1f5f9; cursor:default;">
                            <i class="fa-solid fa-lock"></i>
                            <span>Cerrada</span>
                          </button>
                        @else
                          <button type="button" class="btn-green-submit" onclick="openSurveyModal('{{ addslashes($titulo) }}', '{{ $encId }}')">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>Responder</span>
                          </button>
                        @endif
                      </div>
                    </div>
                    <div class="card-meta-list" id="survey-meta-{{ $encId }}">
                      <span><i class="fa-regular fa-calendar"></i> Límite: {{ $fechaLimite }}</span>
                      <span><i class="fa-solid fa-user-tie"></i> Creado por: {{ $creador }}</span>
                      <span><i class="fa-solid fa-shield-halved"></i> 100% Confidencial</span>
                    </div>
                    <p class="card-desc-paragraph">
                      {{ $enc['description'] ?? 'Instrumento institucional para evaluación y seguimiento a egresados del CEFA.' }}
                    </p>
                    <div class="card-action-bar">
                      <div class="card-progress-col" id="survey-progress-{{ $encId }}">
                        <div class="progress-bar-track"><div class="progress-bar-fill" style="width: {{ $isClosed ? '100%' : '0%' }};"></div></div>
                        <span class="progress-label-text">{{ $isClosed ? 'Concluida' : '0% completado' }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif

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
           SECCIÓN: NOTICIAS & COMUNICADOS INSTITUCIONALES
           ======================================================== -->
      <section id="section-noticias" class="section-tab">

        <div class="hero-banner-card">
          <div class="hero-content">
            <h1 class="hero-heading">Noticias & Convocatorias</h1>
            <p class="hero-description">
              Mantente al día con las convocatorias, jornadas de empleo, alianzas de formación y comunicados oficiales publicados por el Centro Agroindustrial La Angostura.
            </p>
          </div>
        </div>

        <!-- KPIs Noticias -->
        <div class="kpi-row-grid">
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">NOTICIAS PUBLICADAS</span>
              <span class="kpi-big-number">{{ count($noticiasPublicadas ?? []) }}</span>
              <span class="kpi-sub-text">Comunicados vigentes</span>
            </div>
            <div class="kpi-icon-badge green"><i class="fa-solid fa-newspaper"></i></div>
          </div>
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">CONVOCATORIAS & EMPLEO</span>
              <span class="kpi-big-number">
                {{ count(array_filter($noticiasPublicadas ?? [], fn($n) => in_array($n['category'] ?? '', ['Convocatorias', 'Empleabilidad']))) }}
              </span>
              <span class="kpi-sub-text">Oportunidades activas</span>
            </div>
            <div class="kpi-icon-badge blue"><i class="fa-solid fa-bullhorn"></i></div>
          </div>
          <div class="kpi-metric-card">
            <div class="kpi-data-col">
              <span class="kpi-tag-label">DESTACADAS</span>
              <span class="kpi-big-number">
                {{ count(array_filter($noticiasPublicadas ?? [], fn($n) => ($n['status'] ?? '') === 'DESTACADA')) }}
              </span>
              <span class="kpi-sub-text">De alta prioridad</span>
            </div>
            <div class="kpi-icon-badge amber"><i class="fa-solid fa-star"></i></div>
          </div>
        </div>

        <!-- Filtros y Búsqueda de Noticias -->
        <div class="filter-toolbar-box">
          <div class="search-inputs-group" style="width:100%; justify-content:space-between; flex-wrap:wrap; gap:12px;">
            <div class="input-search-field" style="flex:1; max-width:380px;">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input type="text" id="input-buscar-noticias" placeholder="Buscar por título, contenido o autor..." style="width:100%;" oninput="filtrarNoticiasEgresado()">
            </div>
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
              <select class="select-filter-dropdown" id="select-filtro-categoria-noticia" onchange="filtrarNoticiasEgresado()">
                <option value="todas">🏷 Todas las categorías</option>
                <option value="convocatorias">Convocatorias</option>
                <option value="empleabilidad">Empleabilidad</option>
                <option value="capacitación">Capacitación</option>
                <option value="institucional">Institucional</option>
                <option value="comunidad">Comunidad</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Grilla de Noticias -->
        <div id="grid-noticias-egresados" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 22px; margin-top: 10px;">
          @forelse($noticiasPublicadas ?? [] as $n)
            @php
              $img = $n['image'] ?? null;
              if ($img && str_contains($img, '127.0.0.1:8000/storage/')) {
                  $img = asset(explode('127.0.0.1:8000/', $img)[1] ?? '');
              }
              $catPill = $n['category_pill'] ?? 'status-green';
              $cat = $n['category'] ?? 'Institucional';
            @endphp
            <div class="news-card noticia-card-item"
                 data-id="{{ $n['id'] }}"
                 data-category="{{ strtolower($cat) }}"
                 data-title="{{ strtolower($n['title'] ?? '') }}"
                 data-summary="{{ strtolower($n['summary'] ?? '') }}"
                 data-author="{{ strtolower($n['author'] ?? '') }}"
                 data-target="{{ strtolower($n['target'] ?? '') }}">
              
              @if(!empty($img))
                <div class="news-card-img-wrap">
                  <img src="{{ $img }}" alt="{{ $n['title'] ?? 'Noticia' }}" loading="lazy" onerror="this.onerror=null; this.parentElement.style.display='none';">
                  <div class="news-card-img-overlay"></div>
                  <span class="badge-pill {{ $catPill }} badge-pill-over-img">
                    <i class="{{ $n['icon'] ?? 'fa-solid fa-tag' }}"></i>
                    {{ $cat }}
                  </span>
                </div>
              @else
                <div class="news-card-no-img">
                  <span class="badge-pill {{ $catPill }}">
                    <i class="{{ $n['icon'] ?? 'fa-solid fa-tag' }}"></i>
                    {{ $cat }}
                  </span>
                  <span class="news-date-pill">
                    <i class="fa-regular fa-calendar"></i> {{ $n['date'] ?? 'Reciente' }}
                  </span>
                </div>
              @endif

              <div class="news-card-body">
                @if(!empty($img))
                  <div class="news-card-meta-top">
                    <span class="news-date-pill">
                      <i class="fa-regular fa-calendar"></i> {{ $n['date'] ?? 'Reciente' }}
                    </span>
                    <span class="news-status-pill {{ ($n['status'] ?? '') === 'DESTACADA' ? 'destacada' : 'publicada' }}">
                      {{ $n['status'] ?? 'PUBLICADA' }}
                    </span>
                  </div>
                @endif

                <h3 class="news-card-title">{{ $n['title'] ?? '' }}</h3>

                @if(!empty($n['target']))
                  <div class="news-target-badge">
                    <i class="fa-solid fa-bullseye"></i>
                    <span>{{ $n['target'] }}</span>
                  </div>
                @endif

                <p class="news-card-summary">{{ $n['summary'] ?? '' }}</p>

                <div class="news-card-footer">
                  <div class="news-author-info">
                    <div class="news-author-avatar">
                      <i class="fa-solid fa-user-pen"></i>
                    </div>
                    <div class="news-author-texts">
                      <span class="news-author-name">{{ $n['author'] ?? 'CEFA SENA' }}</span>
                      <span class="news-author-views"><i class="fa-regular fa-eye"></i> {{ $n['views_count'] ?? 1 }} lecturas</span>
                    </div>
                  </div>

                  <button type="button" class="btn-leer-noticia" onclick="openModalDetalleNoticia('{{ $n['id'] }}')">
                    <i class="fa-solid fa-book-open"></i>
                    <span>Leer</span>
                  </button>
                </div>
              </div>
            </div>
          @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 48px 20px; background: #fff; border-radius: 16px; border: 1px dashed #CBD5E1;">
              <i class="fa-solid fa-newspaper" style="font-size: 38px; color: #94A3B8; margin-bottom: 12px;"></i>
              <h3 style="font-size: 16px; font-weight: 700; color: #334155;">No hay noticias publicadas en este momento</h3>
              <p style="font-size: 13px; color: #64748B;">Próximamente se publicarán nuevas convocatorias y noticias institucionales.</p>
            </div>
          @endforelse
        </div>

        <div id="noticias-no-results" style="display:none; text-align:center; padding: 40px 20px; background: #fff; border-radius: 16px; border: 1px dashed #CBD5E1; margin-top: 20px;">
          <i class="fa-solid fa-magnifying-glass" style="font-size: 32px; color: #94A3B8; margin-bottom: 10px;"></i>
          <h3 style="font-size: 15px; font-weight: 700; color: #334155;">No se encontraron noticias</h3>
          <p style="font-size: 12.5px; color: #64748B;">No hay comunicados que coincidan con los criterios de búsqueda.</p>
        </div>

      </section>

      <!-- ========================================================
           SECCIÓN: EVENTOS INSTITUCIONALES
           ======================================================== -->
      <section id="section-eventos" class="section-tab">

        <div class="hero-banner-card">
          <div class="hero-content">
            <h1 class="hero-heading">Eventos Institucionales</h1>
            <p class="hero-description">
              Participa activamente en talleres, jornadas laborales, foros y actividades organizadas por el CEFA La Angostura para la comunidad de egresados.
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

          <!-- Eventos dinámicos registrados en el sistema por Admin/Superadmin -->
          @if(isset($eventosDisponibles) && count($eventosDisponibles) > 0)
            @foreach($eventosDisponibles as $ev)
              @php
                $evIdClean = 'event-' . preg_replace('/[^a-zA-Z0-9_\-]/', '', $ev['id'] ?? uniqid());
              @endphp
              <div class="portal-item-card event-card-item" data-event-id="{{ $evIdClean }}">
                <div class="card-icon-pill {{ ($ev['status'] ?? '') === 'PROGRAMADO' ? 'green' : 'blue' }}">
                  <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div class="card-body-content">
                  <div class="card-top-header">
                    <div>
                      <h3 class="card-title-text">{{ $ev['title'] ?? 'Evento Institucional' }}</h3>
                      <span class="card-tag-badge {{ ($ev['status'] ?? '') === 'PROGRAMADO' ? '' : 'blue' }}">
                        {{ $ev['type'] ?? 'Institucional' }} · {{ $ev['status'] ?? 'PROGRAMADO' }}
                      </span>
                    </div>
                    <button type="button" class="btn-green-submit" id="btn-inscribir-{{ $evIdClean }}" onclick="openInscripcionModal('{{ addslashes($ev['title'] ?? 'Evento') }}', this, '{{ $evIdClean }}')">
                      <i class="fa-solid fa-ticket"></i>
                      <span>Inscribirme</span>
                    </button>
                  </div>
                  <div class="card-meta-list">
                    <span><i class="fa-regular fa-calendar"></i> {{ $ev['date'] ?? 'Próximamente' }}</span>
                    @if(!empty($ev['time']))<span><i class="fa-regular fa-clock"></i> {{ $ev['time'] }}</span>@endif
                    <span><i class="fa-solid fa-location-dot"></i> {{ $ev['location'] ?? 'Auditorio Principal CEFA' }}</span>
                    @if(!empty($ev['program']))<span><i class="fa-solid fa-graduation-cap"></i> {{ $ev['program'] }}</span>@endif
                  </div>
                  <p class="card-desc-paragraph">
                    {{ $ev['description'] ?? 'Participa en esta actividad de seguimiento y fortalecimiento para egresados del CEFA.' }}
                  </p>
                  <div class="card-action-bar">
                    <span style="font-size:12px; color:var(--sena-green); font-weight:700;"><i class="fa-solid fa-circle-check"></i> Cupos Disponibles</span>
                    <button type="button" class="btn-card-outline" onclick="openInscripcionModal('{{ addslashes($ev['title'] ?? 'Evento') }}', document.getElementById('btn-inscribir-{{ $evIdClean }}'), '{{ $evIdClean }}')">Ver temario y detalles</button>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <!-- Evento de respaldo si no hay eventos registrados -->
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
          @endif

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
     MODAL DE PREGUNTAS DE ENCUESTA CON ESTILO OFICIAL SENA ERP
     ======================================================== -->
<div class="modal-backdrop" id="modalEncuesta" onclick="if(event.target===this)closeSurveyModal()">
  <div class="modal-box-card">
    <button type="button" class="modal-close-x" onclick="closeSurveyModal()" title="Cerrar ventana"><i class="fa-solid fa-xmark"></i></button>

    <div class="modal-header-banner">
      <div style="display:inline-flex; align-items:center; gap:6px; background:rgba(98, 227, 29, 0.15); border:1px solid #62E31D; color:#62E31D; font-size:10.5px; font-weight:700; padding:2px 9px; border-radius:20px; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:10px;">
        <i class="fa-solid fa-square-poll-vertical"></i> Instrumento Oficial SENA
      </div>
      <h3 id="modal-survey-title">Encuesta de Seguimiento e Inserción Laboral</h3>
      <p>Tus respuestas son confidenciales y permiten modernizar los procesos pedagógicos y de empleabilidad del SENA CEFA.</p>
    </div>

    <form id="form-responder-encuesta" onsubmit="event.preventDefault(); submitSurvey();">
      <div class="question-block">
        <h4 class="question-title">
          <span class="q-num-badge">1</span>
          <span>¿Qué tan satisfecho está con la formación técnica/tecnológica recibida en el CEFA?</span>
          <span class="required-star">*</span>
        </h4>
        <label class="option-radio-row"><input type="radio" name="q1" value="Excelente" checked required> Excelente</label>
        <label class="option-radio-row"><input type="radio" name="q1" value="Buena"> Buena</label>
        <label class="option-radio-row"><input type="radio" name="q1" value="Regular"> Regular</label>
        <label class="option-radio-row"><input type="radio" name="q1" value="Deficiente"> Deficiente</label>
      </div>

      <div class="question-block">
        <h4 class="question-title">
          <span class="q-num-badge">2</span>
          <span>¿Se encuentra vinculado laboralmente o desarrollando un emprendimiento actualmente?</span>
          <span class="required-star">*</span>
        </h4>
        <label class="option-radio-row"><input type="radio" name="q2" value="Si" checked required> Sí, con contrato laboral</label>
        <label class="option-radio-row"><input type="radio" name="q2" value="Independiente"> Sí, como independiente o emprendedor</label>
        <label class="option-radio-row"><input type="radio" name="q2" value="No"> No actualmente, en búsqueda activa</label>
      </div>

      <div class="question-block">
        <h4 class="question-title">
          <span class="q-num-badge">3</span>
          <span>¿Su empleo actual se relaciona con el programa cursado en el SENA?</span>
          <span class="required-star">*</span>
        </h4>
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
     MODAL DE CONFIRMACIÓN: ENVIADA CORRECTAMENTE (DISEÑO OFICIAL SUPERADMIN SENA ERP)
     ======================================================== -->
<div class="modal-backdrop" id="encuestaEnviadaModal" onclick="if(event.target===this)closeEncuestaEnviadaModal()">
  <div class="success-modal-card">
    <!-- Botón cerrar (X) en esquina superior derecha -->
    <button type="button" 
            onclick="closeEncuestaEnviadaModal()" 
            style="position: absolute; top: 16px; right: 16px; width: 34px; height: 34px; border-radius: 10px; background: #F1F5F9; border: 1px solid #E2E8F0; color: #64748B; font-size: 14px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;"
            onmouseover="this.style.background='#E2E8F0'; this.style.color='#00131E';"
            onmouseout="this.style.background='#F1F5F9'; this.style.color='#64748B';"
            title="Cerrar">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- CHULITO ANIMADO SENA (IDÉNTICO AL DASHBOARD DE SUPERADMIN) -->
    <div class="sena-chulito-container">
      <div class="sena-chulito-glow"></div>
      <div class="sena-chulito-badge">
        <svg class="sena-chulito-svg" viewBox="0 0 36 36">
          <path class="sena-chulito-path" d="M8 18.5L14.5 25L28 11.5"/>
        </svg>
      </div>
    </div>

    <!-- Encabezado / Tag Oficial -->
    <div style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 14px; border-radius: 999px; background: #EAF7EE; border: 1px solid #BBF7D0; color: #166534; font-size: 11px; font-weight: 800; letter-spacing: 0.6px; text-transform: uppercase; margin: 0 auto 12px auto;">
      <i class="fa-solid fa-clipboard-check" style="font-size: 11px; color: #39A900;"></i>
      <span>MÓDULO DE ENCUESTAS · SIGE ERP</span>
    </div>

    <!-- Título Principal -->
    <h3 style="font-family: 'Poppins', 'Nunito', sans-serif; font-size: 22px; font-weight: 800; color: #00131E; margin: 0 0 8px 0; letter-spacing: -0.3px; line-height: 1.25;">
      ¡Enviada correctamente!
    </h3>

    <!-- Mensaje Detallado -->
    <p style="font-size: 14px; font-weight: 500; color: #5A6E7D; line-height: 1.5; margin: 0 0 16px 0;">
      Tu encuesta ha sido registrada satisfactoriamente en el sistema. Tus respuestas han sido recibidas y procesadas de forma confidencial.
    </p>

    <!-- Badge de Confirmación y Verificación Institucional -->
    <div style="display: flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg, rgba(234, 247, 238, 0.95) 0%, rgba(220, 252, 231, 0.7) 100%); border: 1px solid #BBF7D0; border-radius: 14px; padding: 12px 16px; color: #166534; font-size: 12.5px; font-weight: 700; margin-bottom: 22px; line-height: 1.4;">
      <i class="fa-solid fa-circle-check" style="color: #39A900; font-size: 14px;"></i>
      <span>Instrumento guardado y verificado en la base de datos institucional</span>
    </div>

    <!-- Botón de Acción Principal SENA ERP -->
    <div style="margin-top: 6px;">
      <button type="button" 
              class="btn-modal-accept"
              onclick="closeEncuestaEnviadaModal()">
        <i class="fa-solid fa-check" style="font-size: 14px;"></i>
        <span>Aceptar y Continuar</span>
      </button>
    </div>

    <!-- Barra temporizada de autocierre con degradado SENA -->
    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 5px; overflow: hidden;">
      <div class="sena-alert-progress"></div>
    </div>
  </div>
</div>

<!-- ========================================================
     MODAL DE INSCRIPCIÓN A EVENTOS (COLORES INSTITUCIONALES SENA ERP & MÁS INFORMACIÓN)
     ======================================================== -->
<div class="modal-backdrop" id="inscripcionModal" onclick="if(event.target===this)closeInscripcionModal()">
  <div class="modal-box-card" style="max-width: 660px; max-height: 90vh; overflow-y: auto; border-top: 4px solid var(--sena-green); padding: 0; position: relative;">
    
    <!-- Botón de Cerrar (X) -->
    <button type="button" class="modal-close-x" onclick="closeInscripcionModal()" style="z-index: 10; background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.2);" title="Cerrar ventana">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Banner Encabezado Oficial SIGE (Colores ERP: Deep Forest & Sena Neon) -->
    <div style="background: linear-gradient(135deg, #00131E 0%, #002336 100%); padding: 24px 28px; color: #fff; position: relative;">
      <div style="display:inline-flex; align-items:center; gap:6px; background:rgba(98, 227, 29, 0.15); border:1px solid #62E31D; color:#62E31D; font-size:10.5px; font-weight:800; padding:2px 10px; border-radius:20px; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px;">
        <i class="fa-solid fa-calendar-check"></i> PORTAL EGRESADOS · CONFIRMACIÓN DE ASISTENCIA
      </div>
      <h2 style="font-size:22px; font-weight:800; color:#fff; margin:0 0 6px 0; letter-spacing:-0.4px;" id="modal-event-title">
        Inscripción al Evento
      </h2>
      <p style="font-size:13px; color:#A0AEC0; margin:0; line-height:1.5;">
        Aparta tu cupo y confirma tus datos para participar en las actividades y encuentros oficiales del CEFA La Angostura.
      </p>
    </div>

    <!-- Contenido Principal del Modal -->
    <div style="padding: 24px 28px;">

      <!-- FICHA TÉCNICA E INFORMACIÓN DETALLADA DEL EVENTO -->
      <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 16px; padding: 18px 20px; margin-bottom: 22px;">
        
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; flex-wrap: wrap; gap: 8px;">
          <div style="display: flex; align-items: center; gap: 8px;">
            <span class="badge-pill status-green" id="modal-event-type-badge">
              <i class="fa-solid fa-ticket"></i> <span id="modal-event-type-text">Convocatoria Oficial</span>
            </span>
            <span class="badge-pill status-blue" id="modal-event-status-badge">
              <i class="fa-solid fa-circle-check"></i> <span id="modal-event-status-text">Cupos Disponibles</span>
            </span>
          </div>
          <span style="font-size: 11.5px; font-weight: 700; color: #166534; background: #DCFCE7; padding: 3px 10px; border-radius: 20px;" id="modal-event-cupo-badge">
            <i class="fa-solid fa-users"></i> <span id="modal-event-cupo-text">Cupo: 200 asistentes</span>
          </span>
        </div>

        <!-- Grilla de Detalles Técnicos -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; margin-bottom: 14px;">
          
          <div style="display: flex; align-items: flex-start; gap: 10px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #EAF7EE; color: var(--sena-green); display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0; border: 1px solid #BBF7D0;">
              <i class="fa-regular fa-calendar"></i>
            </div>
            <div>
              <span style="display: block; font-size: 10.5px; font-weight: 700; color: #64748B; text-transform: uppercase;">Fecha del Evento</span>
              <span style="font-size: 13px; font-weight: 700; color: #0F172A;" id="modal-event-date-text">Próximamente</span>
            </div>
          </div>

          <div style="display: flex; align-items: flex-start; gap: 10px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #EEF4FF; color: #2563EB; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0; border: 1px solid #BFDBFE;">
              <i class="fa-regular fa-clock"></i>
            </div>
            <div>
              <span style="display: block; font-size: 10.5px; font-weight: 700; color: #64748B; text-transform: uppercase;">Horario</span>
              <span style="font-size: 13px; font-weight: 700; color: #0F172A;" id="modal-event-time-text">09:00 AM - 12:00 PM</span>
            </div>
          </div>

          <div style="display: flex; align-items: flex-start; gap: 10px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #FEF3C7; color: #D97706; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0; border: 1px solid #FDE68A;">
              <i class="fa-solid fa-location-dot"></i>
            </div>
            <div>
              <span style="display: block; font-size: 10.5px; font-weight: 700; color: #64748B; text-transform: uppercase;">Lugar / Ubicación</span>
              <span style="font-size: 13px; font-weight: 700; color: #0F172A;" id="modal-event-location-text">Centro CEFA La Angostura</span>
            </div>
          </div>

          <div style="display: flex; align-items: flex-start; gap: 10px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #F3E8FF; color: #9333EA; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0; border: 1px solid #E9D5FF;">
              <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div>
              <span style="display: block; font-size: 10.5px; font-weight: 700; color: #64748B; text-transform: uppercase;">Público / Programa</span>
              <span style="font-size: 13px; font-weight: 700; color: #0F172A;" id="modal-event-program-text">Todos los Egresados CEFA</span>
            </div>
          </div>

        </div>

        <!-- Descripción y Temario -->
        <div style="background: #FFFFFF; border-left: 4px solid var(--sena-green); border-radius: 0 10px 10px 0; padding: 12px 14px; border: 1px solid #E2E8F0; border-left-width: 4px; border-left-color: var(--sena-green);">
          <span style="display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: var(--sena-green); margin-bottom: 4px;">
            <i class="fa-solid fa-circle-info"></i> Temario & Descripción de la Actividad:
          </span>
          <p style="font-size: 12.5px; color: #334155; line-height: 1.55; margin: 0;" id="modal-event-desc-text">
            Invitación oficial dirigida a la comunidad de egresados SENA.
          </p>
        </div>

      </div>

      <!-- FORMULARIO DE CONFIRMACIÓN DE DATOS DEL EGRESADO (ERP SENA) -->
      <form id="formInscripcionEvento" onsubmit="event.preventDefault(); confirmInscripcion();">
        
        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 14px;">
          <div style="width: 24px; height: 24px; border-radius: 6px; background: #EAF7EE; color: var(--sena-green); display: flex; align-items: center; justify-content: center; font-size: 11px;">
            <i class="fa-solid fa-user-check"></i>
          </div>
          <span style="font-size: 12px; font-weight: 800; color: #00131E; text-transform: uppercase; letter-spacing: 0.4px;">
            Confirma tus datos personales para la reserva
          </span>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
          
          <!-- Documento de Identidad -->
          <div>
            <label style="display:block; font-size:11.5px; font-weight:700; color:#334155; margin-bottom:5px;">
              Documento (Cédula) <span style="color:#39A900; font-size:10px; font-weight:800;">✓ Verificado</span>
            </label>
            <input type="text" id="modal-event-input-doc" readonly
                   value="{{ $person->document_number ?? (Auth::user()->document_number ?? '1085244588') }}" 
                   style="width:100%; border:1px solid #E2E8F0; background:#F8FAFC; border-radius:10px; padding:10px 14px; font-size:13px; font-weight:600; color:#475569; font-family:inherit;">
          </div>

          <!-- Nombre Completo -->
          <div>
            <label style="display:block; font-size:11.5px; font-weight:700; color:#334155; margin-bottom:5px;">
              Nombre Completo <span style="color:#EF4444;">*</span>
            </label>
            <input type="text" id="modal-event-input-name" required
                   value="@auth {{ $person ? ($person->first_name . ' ' . $person->first_lastname . ' ' . ($person->second_lastname ?? '')) : (Auth::user()->full_name ?? Auth::user()->name) }} @else Emily Zaray Perdomo Izquierdo @endauth" 
                   style="width:100%; border:1px solid #CBD5E1; border-radius:10px; padding:10px 14px; font-size:13px; font-weight:600; color:#0F172A; font-family:inherit;">
          </div>

        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
          
          <!-- Correo Electrónico -->
          <div>
            <label style="display:block; font-size:11.5px; font-weight:700; color:#334155; margin-bottom:5px;">
              Correo Electrónico <span style="color:#EF4444;">*</span>
            </label>
            <input type="email" id="modal-event-input-email" required
                   value="@auth {{ $person->personal_email ?? ($person->misena_email ?? (Auth::user()->email ?? '')) }} @else egresada.cefa@sena.edu.co @endauth" 
                   style="width:100%; border:1px solid #CBD5E1; border-radius:10px; padding:10px 14px; font-size:13px; font-weight:600; color:#0F172A; font-family:inherit;">
          </div>

          <!-- Teléfono / WhatsApp -->
          <div>
            <label style="display:block; font-size:11.5px; font-weight:700; color:#334155; margin-bottom:5px;">
              Celular / WhatsApp <span style="color:#EF4444;">*</span>
            </label>
            <input type="tel" id="modal-event-input-phone" required
                   value="{{ $person->telephone1 ?? '310 123 4567' }}" 
                   style="width:100%; border:1px solid #CBD5E1; border-radius:10px; padding:10px 14px; font-size:13px; font-weight:600; color:#0F172A; font-family:inherit;">
          </div>

        </div>

        <!-- Modalidad de Asistencia -->
        <div style="margin-bottom: 22px;">
          <label style="display:block; font-size:11.5px; font-weight:700; color:#334155; margin-bottom:5px;">
            Modalidad de Participación
          </label>
          <select id="modal-event-select-modalidad" style="width:100%; border:1px solid #CBD5E1; border-radius:10px; padding:10px 14px; font-size:13px; font-weight:600; color:#0F172A; background:#fff; font-family:inherit;">
            <option value="Presencial">🏢 Asistencia Presencial (Auditorio Principal / Instalaciones CEFA)</option>
            <option value="Virtual">💻 Asistencia Virtual (Transmisión en Vivo / Enlace Meet)</option>
          </select>
        </div>

        <!-- Botones de Acción SENA ERP -->
        <div style="display:flex; justify-content:flex-end; align-items:center; gap:12px; padding-top:16px; border-top:1px solid #E2E8F0;">
          <button type="button" class="btn-card-outline" onclick="closeInscripcionModal()" style="padding:10px 20px; border-radius:11px; font-weight:700; cursor:pointer; font-size:13px;">
            Cancelar
          </button>
          <button type="submit" id="btn-submit-confirm-inscripcion" class="btn-green-submit" style="padding:11px 26px; border-radius:11px; font-weight:800; font-size:13.5px; background:linear-gradient(135deg, #39A900 0%, #2d8500 100%); cursor:pointer; display:inline-flex; align-items:center; gap:8px; box-shadow:0 4px 14px rgba(57,169,0,0.25);">
            <i class="fa-solid fa-calendar-check"></i>
            <span>Confirmar mi Cupo</span>
          </button>
        </div>

      </form>

    </div>

  </div>
</div>

<!-- ========================================================
     MODAL: DETALLE COMPLETO DE NOTICIA INSTITUCIONAL
     ======================================================== -->
<div class="modal-backdrop" id="modalDetalleNoticia" onclick="if(event.target===this)closeModalDetalleNoticia()">
  <div class="modal-box-card" style="max-width: 680px; max-height: 88vh; overflow-y: auto; padding: 0; border-top: 4px solid var(--sena-green); position: relative;">
    <!-- Botón Cerrar (X) -->
    <button type="button" class="modal-close-x" onclick="closeModalDetalleNoticia()" style="z-index: 10; background: rgba(255,255,255,0.95); box-shadow: 0 2px 8px rgba(0,0,0,0.15);" title="Cerrar ventana">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Header con Imagen (si tiene) -->
    <div id="modal-noticia-img-wrap" style="display:none; width:100%; height:230px; position:relative; overflow:hidden; background:#00131E;">
      <img id="modal-noticia-img" src="" alt="Portada Noticia" style="width:100%; height:100%; object-fit:cover;">
      <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.3) 60%, transparent 100%);"></div>
      <div style="position:absolute; bottom:16px; left:22px; right:22px;">
        <span id="modal-noticia-cat-badge" class="badge-pill status-green" style="margin-bottom:8px;"></span>
        <h2 id="modal-noticia-title-img" style="color:#fff; font-size:19px; font-weight:800; line-height:1.3; margin:0; text-shadow: 0 2px 4px rgba(0,0,0,0.6);"></h2>
      </div>
    </div>

    <!-- Header sin Imagen (si no tiene) -->
    <div id="modal-noticia-header-no-img" style="display:none; background:linear-gradient(135deg, #00131E 0%, #002336 100%); padding:24px 26px; color:#fff;">
      <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px;">
        <span id="modal-noticia-cat-badge-no-img" class="badge-pill status-green"></span>
        <span id="modal-noticia-date-header" style="font-size:12px; opacity:0.85;"></span>
      </div>
      <h2 id="modal-noticia-title-no-img" style="color:#fff; font-size:19px; font-weight:800; line-height:1.3; margin:0;"></h2>
    </div>

    <!-- Cuerpo del Modal -->
    <div style="padding: 24px 26px;">
      <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; background:#F8FAFC; border:1px solid #E2E8F0; padding:10px 14px; border-radius:12px; margin-bottom:16px;">
        <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:#0F766E; font-weight:700;">
          <i class="fa-solid fa-bullseye" style="color:#39A900;"></i>
          <span>Dirigido a: <strong id="modal-noticia-target" style="color:#001A29;"></strong></span>
        </div>
        <div style="font-size:11.5px; color:#64748B;">
          <i class="fa-regular fa-eye"></i> <span id="modal-noticia-views"></span> lecturas
        </div>
      </div>

      <!-- Resumen / Lead -->
      <div id="modal-noticia-summary-box" style="border-left:4px solid #39A900; background:#F0FDF4; padding:12px 16px; border-radius:0 10px 10px 0; margin-bottom:18px; font-size:13.5px; font-weight:600; color:#166534; line-height:1.5;">
      </div>

      <!-- Contenido Completo -->
      <div id="modal-noticia-content" style="font-size:13.5px; color:#334155; line-height:1.7; white-space:pre-line; max-height:42vh; overflow-y:auto; padding-right:8px; margin-bottom:20px;">
      </div>

      <!-- Pie del Modal -->
      <div style="padding-top:16px; border-top:1px solid #E2E8F0; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;">
        <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:#64748B;">
          <i class="fa-solid fa-shield-halved" style="color:#39A900;"></i>
          <span>Publicado por: <strong id="modal-noticia-author" style="color:#0F172A;"></strong></span>
        </div>
        <button type="button" class="btn-card-outline" onclick="closeModalDetalleNoticia()" style="padding:7px 18px; font-size:12px; font-weight:700; cursor:pointer;">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================
     MODAL ACTUALIZAR INFORMACIÓN DEL EGRESADO
     ======================================================== -->
<div class="modal-backdrop" id="modalActualizarPerfilEgresado" onclick="if(event.target===this)closeModalActualizarPerfilEgresado()">
  <div class="modal-box-card" style="max-width: 720px; max-height: 90vh; overflow-y: auto; border-top: 4px solid var(--sena-green); padding: 0;">
    <!-- Botón de Cerrar (X) -->
    <button type="button" class="modal-close-x" onclick="closeModalActualizarPerfilEgresado()" style="z-index: 10; background: rgba(255,255,255,0.95);" title="Cerrar ventana">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Banner Encabezado Oficial SIGE -->
    <div style="background: linear-gradient(135deg, #00131E 0%, #002336 100%); padding: 24px 28px; color: #fff; position: relative;">
      <div style="display:inline-flex; align-items:center; gap:6px; background:rgba(98, 227, 29, 0.15); border:1px solid #62E31D; color:#62E31D; font-size:10.5px; font-weight:800; padding:2px 10px; border-radius:20px; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px;">
        <i class="fa-solid fa-user-pen"></i> PORTAL EGRESADOS · ACTUALIZACIÓN DE DATOS
      </div>
      <h3 style="font-family:'Poppins','Nunito',sans-serif; font-size:19px; font-weight:800; color:#fff; margin:0 0 6px 0; line-height:1.3;">
        Actualizar mi Información de Perfil
      </h3>
      <p style="font-size:12px; color:rgba(255,255,255,0.85); margin:0; line-height:1.4;">
        Mantén tus datos de contacto y residencia al día para recibir invitaciones a eventos, ofertas laborales y encuestas institucionales del CEFA.
      </p>
    </div>

    <!-- Formulario de Actualización -->
    <form id="formActualizarPerfilEgresado" action="{{ route('egresados.perfil.actualizar') }}" method="POST" style="padding: 22px 26px;">
      @csrf

      <!-- Mensaje de Alerta en caso de errores de validación -->
      <div id="alert-profile-error" style="display:none; background:#FEF2F2; border:1px solid #FCA5A5; color:#991B1B; padding:12px 16px; border-radius:12px; font-size:12.5px; margin-bottom:16px;"></div>

      <!-- Sección 1: Identificación y Nombres -->
      <div class="profile-form-section">
        <div class="profile-form-section-title">
          <i class="fa-solid fa-id-card" style="color:var(--sena-green);"></i>
          <span>1. Datos de Identificación y Nombres</span>
        </div>
        <div class="profile-form-grid">
          <div class="profile-input-group">
            <label>Número de Documento (Cédula) <span style="font-size:10px; color:#16a34a; font-weight:700;">✓ Verificado</span></label>
            <div style="position:relative;">
              <input type="text" value="{{ $person->document_number ?? (Auth::user()->nickname ?? 'Cédula') }}" class="profile-input-readonly" readonly title="Documento registrado en el sistema ERP">
              <i class="fa-solid fa-lock" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:12px;"></i>
            </div>
          </div>
          <div class="profile-input-group">
            <label>Tipo de Documento</label>
            <input type="text" value="{{ $person->document_type ?? 'Cédula de ciudadanía' }}" class="profile-input-readonly" readonly>
          </div>
          <div class="profile-input-group">
            <label>Nombres <span style="color:#ef4444;">*</span></label>
            <input type="text" name="nombres" id="prof_nombres" required value="{{ old('nombres', $person->first_name ?? (Auth::user()->first_name ?? Auth::user()->name ?? '')) }}" placeholder="Ej. Valentina">
          </div>
          <div class="profile-input-group">
            <label>Apellidos <span style="color:#ef4444;">*</span></label>
            <input type="text" name="apellidos" id="prof_apellidos" required value="{{ old('apellidos', trim(($person->first_last_name ?? '') . ' ' . ($person->second_last_name ?? '')) ?: 'SENA') }}" placeholder="Ej. Ríos Gómez">
          </div>
        </div>
      </div>

      <!-- Sección 2: Contacto y Residencia -->
      <div class="profile-form-section">
        <div class="profile-form-section-title">
          <i class="fa-solid fa-address-book" style="color:var(--sena-green);"></i>
          <span>2. Información de Contacto y Ubicación</span>
        </div>
        <div class="profile-form-grid">
          <div class="profile-input-group">
            <label>Correo Electrónico Personal <span style="color:#ef4444;">*</span></label>
            <input type="email" name="personal_email" id="prof_personal_email" required value="{{ old('personal_email', $person->personal_email ?? (Auth::user()->email ?? '')) }}" placeholder="tucorreo@gmail.com">
          </div>
          <div class="profile-input-group">
            <label>Correo MiSENA / Institucional (Opcional)</label>
            <input type="email" name="misena_email" id="prof_misena_email" value="{{ old('misena_email', $person->misena_email ?? '') }}" placeholder="usuario@misena.edu.co">
          </div>
          <div class="profile-input-group">
            <label>Celular / WhatsApp Principal <span style="color:#ef4444;">*</span></label>
            <input type="tel" name="telefono" id="prof_telefono" required value="{{ old('telefono', $person->telephone1 ?? '') }}" placeholder="Ej. 3123456789">
          </div>
          <div class="profile-input-group">
            <label>Teléfono Alternativo / Fijo (Opcional)</label>
            <input type="tel" name="telefono2" id="prof_telefono2" value="{{ old('telefono2', $person->telephone2 ?? '') }}" placeholder="Ej. 3001234567">
          </div>
          <div class="profile-input-group" style="grid-column: 1 / -1;">
            <label>Dirección de Residencia Actual</label>
            <input type="text" name="direccion" id="prof_direccion" value="{{ old('direccion', $person->address ?? '') }}" placeholder="Ej. Calle 10 # 5-20, Neiva - Huila">
          </div>
        </div>
      </div>

      <!-- Sección 3: Situación Laboral y Formación -->
      <div class="profile-form-section">
        <div class="profile-form-section-title">
          <i class="fa-solid fa-briefcase" style="color:var(--sena-green);"></i>
          <span>3. Formación y Situación Laboral</span>
        </div>
        <div class="profile-form-grid">
          <div class="profile-input-group">
            <label>Programa Egresado / Formación</label>
            <input type="text" value="{{ $apprentice->course->program->name ?? 'Tecnología en Análisis y Desarrollo de Software (ADSO)' }}" class="profile-input-readonly" readonly>
          </div>
          <div class="profile-input-group">
            <label>Situación Laboral Actual <span style="color:#ef4444;">*</span></label>
            @php $currentStatus = strtoupper($apprentice->apprentice_status ?? 'CERTIFICADO'); @endphp
            <select name="situacion_laboral" id="prof_situacion_laboral">
              <option value="CERTIFICADO" {{ in_array($currentStatus, ['CERTIFICADO', 'GRADUADO']) ? 'selected' : '' }}>Certificado / Graduado</option>
              <option value="EMPLEADO" {{ str_contains($currentStatus, 'EMPLE') ? 'selected' : '' }}>Empleado(a) / Trabajando</option>
              <option value="EMPRENDEDOR" {{ str_contains($currentStatus, 'EMPREND') ? 'selected' : '' }}>Emprendedor(a) / Negocio Propio</option>
              <option value="EN FORMACIÓN" {{ str_contains($currentStatus, 'FORMAC') ? 'selected' : '' }}>Continuando Estudios Superiores</option>
              <option value="BUSCANDO EMPLEO">En Búsqueda Activa de Empleo</option>
            </select>
          </div>
          <div class="profile-input-group">
            <label>Empresa u Organización donde laboras (Opcional)</label>
            <input type="text" name="empresa_labora" id="prof_empresa_labora" placeholder="Ej. Empresa Privada, Entidad, Emprendimiento...">
          </div>
          <div class="profile-input-group">
            <label>Cargo o Actividad Principal (Opcional)</label>
            <input type="text" name="cargo_labora" id="prof_cargo_labora" placeholder="Ej. Desarrollador Junior, Asistente, etc.">
          </div>
        </div>
      </div>

      <!-- Sección 4: Seguridad y Contraseña (Opcional) -->
      <div class="profile-form-section" style="border-left: 3px solid #39A900;">
        <div class="profile-form-section-title">
          <i class="fa-solid fa-shield-halved" style="color:var(--sena-green);"></i>
          <span>4. Seguridad y Contraseña (Opcional)</span>
        </div>
        <p style="font-size:11.5px; color:#64748B; margin:0 0 10px 0;">
          Puedes cambiar tu contraseña si deseas personalizarla. Si la dejas vacía, se conservará tu contraseña actual.
        </p>
        <div class="profile-form-grid">
          <div class="profile-input-group">
            <label>Nueva Contraseña</label>
            <input type="password" name="password" id="prof_password" placeholder="Mínimo 6 caracteres" autocomplete="new-password">
          </div>
          <div class="profile-input-group">
            <label>Confirmar Nueva Contraseña</label>
            <input type="password" name="password_confirmation" id="prof_password_confirmation" placeholder="Repite la nueva contraseña" autocomplete="new-password">
          </div>
        </div>
      </div>

      <!-- Botones de Acción -->
      <div style="display:flex; justify-content:flex-end; gap:10px; align-items:center; margin-top:20px;">
        <button type="button" class="btn-card-outline" onclick="closeModalActualizarPerfilEgresado()" style="padding:10px 18px; border-radius:10px; font-weight:700; cursor:pointer;">
          Cancelar
        </button>
        <button type="submit" id="btn-submit-perfil" class="btn-green-submit" style="padding:11px 24px; border-radius:10px; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:8px;">
          <i class="fa-solid fa-floppy-disk"></i>
          <span>Guardar Cambios</span>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ========================================================
     MODAL ACTUALIZACIÓN DE CONTRASEÑA INICIAL (ERP SENA)
     ======================================================== -->
<div class="modal-backdrop" id="modalActualizarPasswordInicial" onclick="if(event.target===this)closeModalActualizarPasswordInicial()">
  <div class="modal-box-card" style="max-width: 540px; border-top: 4px solid #39A900; padding: 0; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 45px rgba(0, 19, 30, 0.35);">
    <!-- Botón de Cerrar (X) -->
    <button type="button" class="modal-close-x" onclick="closeModalActualizarPasswordInicial()" style="z-index: 10; background: rgba(255,255,255,0.95);" title="Cerrar ventana">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Banner Encabezado Oficial SIGE -->
    <div style="background: linear-gradient(135deg, #00131E 0%, #002336 100%); padding: 24px 28px; color: #fff; position: relative;">
      <div style="display:inline-flex; align-items:center; gap:6px; background:rgba(98, 227, 29, 0.15); border:1px solid #62E31D; color:#62E31D; font-size:10.5px; font-weight:800; padding:3px 10px; border-radius:20px; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px;">
        <i class="fa-solid fa-shield-halved"></i> SEGURIDAD DE ACCESO · CEFA SENA
      </div>
      <h3 style="font-family:'Poppins','Nunito',sans-serif; font-size:19px; font-weight:800; color:#fff; margin:0 0 6px 0; line-height:1.3;">
        Actualizar Contraseña Inicial
      </h3>
      <p style="font-size:12px; color:rgba(255,255,255,0.85); margin:0; line-height:1.45;">
        Por ser tu primer ingreso al sistema con tu número de documento, es necesario que configures tu nueva contraseña personal e intransferible.
      </p>
    </div>

    <!-- Formulario de Actualización de Contraseña -->
    <form id="formActualizarPasswordInicial" onsubmit="submitActualizarPasswordInicial(event)" style="padding: 22px 26px;">
      @csrf

      <!-- Mensaje de Alerta en caso de errores de validación -->
      <div id="alert-password-error" style="display:none; background:#FEF2F2; border:1px solid #FCA5A5; color:#991B1B; padding:12px 16px; border-radius:12px; font-size:12.5px; margin-bottom:16px;"></div>
      
      <!-- Mensaje de Éxito -->
      <div id="alert-password-success" style="display:none; background:#F0FDF4; border:1px solid #BBF7D0; color:#166534; padding:12px 16px; border-radius:12px; font-size:12.5px; margin-bottom:16px;"></div>

      <!-- Tarjeta informativa del documento registrado -->
      <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:12px; padding:12px 16px; margin-bottom:18px; display:flex; align-items:center; gap:12px;">
        <div style="width:38px; height:38px; border-radius:10px; background:rgba(57, 169, 0, 0.12); color:#39A900; display:flex; align-items:center; justify-content:center; font-size:17px; flex-shrink:0;">
          <i class="fa-solid fa-id-card"></i>
        </div>
        <div>
          <span style="font-size:11px; font-weight:700; color:#64748B; text-transform:uppercase; letter-spacing:0.4px;">Usuario Oficial y Clave Inicial:</span>
          <div style="font-size:13.5px; font-weight:700; color:#00131E;">
            Cédula / Documento: <span style="color:#39A900;">{{ isset($person) && $person->document_number ? $person->document_number : (preg_replace('/\D/', '', Auth::user()->nickname ?? '') ?: 'Documento Registrado') }}</span>
          </div>
        </div>
      </div>

      <!-- 1. Primera Contraseña (Documento) -->
      <div style="margin-bottom:16px;">
        <label for="pwd_current_password" style="display:block; font-size:12px; font-weight:700; color:#00131E; margin-bottom:6px;">
          <i class="fa-solid fa-lock" style="color:#39A900; margin-right:4px;"></i> 1. Primera Contraseña (Tu Cédula o Documento Actual) <span style="color:#EF4444;">*</span>
        </label>
        <div class="input-password-wrapper">
          <input type="password" id="pwd_current_password" name="current_password" class="input-modern"
                 value="{{ isset($person) && $person->document_number ? $person->document_number : (preg_replace('/\D/', '', Auth::user()->nickname ?? '') ?: '') }}"
                 placeholder="Ingresa tu documento (clave inicial)" required style="width:100%; border:1px solid #CBD5E1; border-radius:10px; padding:10px 42px 10px 14px; font-size:13px; font-family:inherit;">
          <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('pwd_current_password', this)" title="Ver u ocultar contraseña">
            <i class="fa-regular fa-eye"></i>
          </button>
        </div>
        <span style="display:block; font-size:11px; color:#64748B; margin-top:4px;">
          Corresponde a la contraseña con la que iniciaste sesión por primera vez.
        </span>
      </div>

      <!-- 2. Nueva Contraseña -->
      <div style="margin-bottom:16px;">
        <label for="pwd_new_password" style="display:block; font-size:12px; font-weight:700; color:#00131E; margin-bottom:6px;">
          <i class="fa-solid fa-key" style="color:#39A900; margin-right:4px;"></i> 2. Nueva Contraseña Privada <span style="color:#EF4444;">*</span>
        </label>
        <div class="input-password-wrapper">
          <input type="password" id="pwd_new_password" name="new_password" class="input-modern"
                 placeholder="Mínimo 6 caracteres (ej. MiClave2026*)" required minlength="6" oninput="checkPasswordMatch()"
                 style="width:100%; border:1px solid #CBD5E1; border-radius:10px; padding:10px 42px 10px 14px; font-size:13px; font-family:inherit;">
          <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('pwd_new_password', this)" title="Ver u ocultar contraseña">
            <i class="fa-regular fa-eye"></i>
          </button>
        </div>
      </div>

      <!-- 3. Confirmar Nueva Contraseña -->
      <div style="margin-bottom:18px;">
        <label for="pwd_new_password_confirmation" style="display:block; font-size:12px; font-weight:700; color:#00131E; margin-bottom:6px;">
          <i class="fa-solid fa-circle-check" style="color:#39A900; margin-right:4px;"></i> 3. Confirmar Nueva Contraseña <span style="color:#EF4444;">*</span>
        </label>
        <div class="input-password-wrapper">
          <input type="password" id="pwd_new_password_confirmation" name="new_password_confirmation" class="input-modern"
                 placeholder="Vuelve a escribir la nueva contraseña" required minlength="6" oninput="checkPasswordMatch()"
                 style="width:100%; border:1px solid #CBD5E1; border-radius:10px; padding:10px 42px 10px 14px; font-size:13px; font-family:inherit;">
          <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('pwd_new_password_confirmation', this)" title="Ver u ocultar contraseña">
            <i class="fa-regular fa-eye"></i>
          </button>
        </div>
        <div id="pwdMatchStatus" class="pwd-match-status" style="display:none;"></div>
      </div>

      <!-- Tips de Seguridad -->
      <div class="erp-security-tips">
        <strong style="color:#00131E; font-size:11.5px; display:inline-flex; align-items:center; gap:5px;">
          <i class="fa-solid fa-circle-info" style="color:#39A900;"></i> Recomendaciones de Seguridad CEFA:
        </strong>
        <ul style="margin:4px 0 0 16px; padding:0; font-size:11.5px; color:#64748B;">
          <li>Tu usuario seguirá siendo tu número de cédula.</li>
          <li>La nueva clave debe tener al menos 6 caracteres y ser distinta a tu documento.</li>
        </ul>
      </div>

      <!-- Botones de Acción -->
      <div style="display:flex; justify-content:flex-end; gap:10px; align-items:center; margin-top:20px;">
        <button type="button" class="btn-card-outline" onclick="closeModalActualizarPasswordInicial()" style="padding:10px 18px; border-radius:10px; font-weight:700; cursor:pointer; font-size:12.5px;">
          Recordármelo más tarde
        </button>
        <button type="submit" id="btn-submit-password-inicial" class="btn-green-submit" style="padding:11px 22px; border-radius:10px; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:8px; font-size:13px; background:linear-gradient(135deg, #39A900 0%, #2a7c00 100%); color:#fff; border:none; box-shadow:0 4px 14px rgba(57,169,0,0.35);">
          <i class="fa-solid fa-shield-check"></i>
          <span>Guardar Nueva Contraseña</span>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ========================================================
     MODAL DE CONFIRMACIÓN: INSCRIPCIÓN EXITOSA A EVENTO (DISEÑO OFICIAL SUPERADMIN SENA ERP)
     ======================================================== -->
<div class="modal-backdrop" id="modalInscripcionExitosa" onclick="if(event.target===this)closeInscripcionExitosaModal()">
  <div class="success-modal-card">
    <!-- Botón cerrar (X) en esquina superior derecha -->
    <button type="button" 
            onclick="closeInscripcionExitosaModal()" 
            style="position: absolute; top: 16px; right: 16px; width: 34px; height: 34px; border-radius: 10px; background: #F1F5F9; border: 1px solid #E2E8F0; color: #64748B; font-size: 14px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;"
            onmouseover="this.style.background='#E2E8F0'; this.style.color='#00131E';"
            onmouseout="this.style.background='#F1F5F9'; this.style.color='#64748B';"
            title="Cerrar">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- CHULITO ANIMADO SENA (IDÉNTICO AL DASHBOARD DE SUPERADMIN) -->
    <div class="sena-chulito-container">
      <div class="sena-chulito-glow"></div>
      <div class="sena-chulito-badge">
        <svg class="sena-chulito-svg" viewBox="0 0 36 36">
          <path class="sena-chulito-path" d="M8 18.5L14.5 25L28 11.5"/>
        </svg>
      </div>
    </div>

    <!-- Encabezado / Tag Oficial -->
    <div style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 14px; border-radius: 999px; background: #EAF7EE; border: 1px solid #BBF7D0; color: #166534; font-size: 11px; font-weight: 800; letter-spacing: 0.6px; text-transform: uppercase; margin: 0 auto 12px auto;">
      <i class="fa-solid fa-calendar-check" style="font-size: 11px; color: #39A900;"></i>
      <span>GESTIÓN DE EVENTOS · SIGE ERP</span>
    </div>

    <!-- Título Principal -->
    <h3 style="font-family:'Poppins', 'Nunito', sans-serif; font-size:22px; font-weight:800; color:#00131E; margin:0 0 8px 0; letter-spacing:-0.3px; line-height:1.25;">
      ¡Inscripción Confirmada con Éxito!
    </h3>

    <!-- Mensaje Detallado -->
    <p style="font-size:14px; font-weight:500; color:#5A6E7D; line-height:1.5; margin:0 0 16px 0;">
      Te has inscrito exitosamente a <strong id="modal-success-event-title" style="color:var(--sena-dark);">este evento</strong> en el CEFA La Angostura. Recibirás los recordatorios y detalles de acceso en tu correo electrónico.
    </p>

    <!-- Badge de Confirmación y Verificación Institucional -->
    <div style="display: flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg, rgba(234, 247, 238, 0.95) 0%, rgba(220, 252, 231, 0.7) 100%); border: 1px solid #BBF7D0; border-radius: 14px; padding: 12px 16px; color: #166534; font-size: 12.5px; font-weight: 700; margin-bottom: 22px; line-height: 1.4;">
      <i class="fa-solid fa-circle-check" style="color: #39A900; font-size: 14px;"></i>
      <span>Cupo reservado y verificado en la base de datos institucional</span>
    </div>

    <!-- Botón de Acción Principal SENA ERP -->
    <div style="margin-top: 6px;">
      <button type="button" class="btn-modal-accept" onclick="closeInscripcionExitosaModal()">
        <i class="fa-solid fa-check" style="font-size: 14px;"></i>
        <span>Aceptar y Continuar</span>
      </button>
    </div>

    <!-- Barra temporizada de autocierre con degradado SENA -->
    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 5px; overflow: hidden;">
      <div class="sena-alert-progress"></div>
    </div>
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
     MODAL DE CONFIRMACIÓN: POSTULACIÓN EXITOSA (DISEÑO OFICIAL SUPERADMIN SENA ERP)
     ======================================================== -->
<div class="modal-backdrop" id="modalPostulacionExitosa" onclick="if(event.target===this)cerrarModalPostulacionExitosa()">
  <div class="success-modal-card">
    <!-- Botón cerrar (X) en esquina superior derecha -->
    <button type="button" 
            onclick="cerrarModalPostulacionExitosa()" 
            style="position: absolute; top: 16px; right: 16px; width: 34px; height: 34px; border-radius: 10px; background: #F1F5F9; border: 1px solid #E2E8F0; color: #64748B; font-size: 14px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;"
            onmouseover="this.style.background='#E2E8F0'; this.style.color='#00131E';"
            onmouseout="this.style.background='#F1F5F9'; this.style.color='#64748B';"
            title="Cerrar">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- CHULITO ANIMADO SENA (IDÉNTICO AL DASHBOARD DE SUPERADMIN) -->
    <div class="sena-chulito-container">
      <div class="sena-chulito-glow"></div>
      <div class="sena-chulito-badge">
        <svg class="sena-chulito-svg" viewBox="0 0 36 36">
          <path class="sena-chulito-path" d="M8 18.5L14.5 25L28 11.5"/>
        </svg>
      </div>
    </div>

    <!-- Encabezado / Tag Oficial -->
    <div style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 14px; border-radius: 999px; background: #EAF7EE; border: 1px solid #BBF7D0; color: #166534; font-size: 11px; font-weight: 800; letter-spacing: 0.6px; text-transform: uppercase; margin: 0 auto 12px auto;">
      <i class="fa-solid fa-briefcase" style="font-size: 11px; color: #39A900;"></i>
      <span>BOLSA DE EMPLEO APE · SIGE ERP</span>
    </div>

    <!-- Título Principal -->
    <h3 style="font-family:'Poppins', 'Nunito', sans-serif; font-size:22px; font-weight:800; color:#00131E; margin:0 0 8px 0; letter-spacing:-0.3px; line-height:1.25;">
      ¡Postulación Enviada con Éxito!
    </h3>

    <!-- Mensaje Detallado -->
    <p style="font-size:14px; font-weight:500; color:#5A6E7D; line-height:1.5; margin:0 0 16px 0;">
      Tu perfil de egresado(a) y hoja de vida han sido remitidos formalmente para la vacante de <strong id="modal-success-cargo" style="color:var(--sena-dark);">este cargo</strong>. La empresa revisará tus competencias y te contactará a través de tus datos registrados.
    </p>

    <!-- Badge de Confirmación y Verificación Institucional -->
    <div style="display: flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg, rgba(234, 247, 238, 0.95) 0%, rgba(220, 252, 231, 0.7) 100%); border: 1px solid #BBF7D0; border-radius: 14px; padding: 12px 16px; color: #166534; font-size: 12.5px; font-weight: 700; margin-bottom: 22px; line-height: 1.4;">
      <i class="fa-solid fa-circle-check" style="color: #39A900; font-size: 14px;"></i>
      <span>Postulación remitida y registrada en la plataforma institucional</span>
    </div>

    <!-- Botón de Acción Principal SENA ERP -->
    <div style="margin-top: 6px;">
      <button type="button" class="btn-modal-accept" onclick="cerrarModalPostulacionExitosa()">
        <i class="fa-solid fa-check" style="font-size: 14px;"></i>
        <span>Aceptar y Continuar</span>
      </button>
    </div>

    <!-- Barra temporizada de autocierre con degradado SENA -->
    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 5px; overflow: hidden;">
      <div class="sena-alert-progress"></div>
    </div>
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
      title: 'Noticias & Comunicados · Comunidad CEFA',
      tag: 'Comunicados Oficiales',
      subtitle: 'Convocatorias, Fondo Emprender, empleo y novedades institucionales',
      icon: 'fa-newspaper'
    },
    'eventos': {
      title: 'Eventos Institucionales · CEFA La Angostura',
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

  const sectionsList = ['inicio', 'encuestas', 'noticias', 'eventos', 'oportunidades', 'notificaciones'];

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

  // Identificación única del usuario autenticado para aislamiento total de datos
  const CURRENT_USER_ID = '{{ Auth::id() ?? 0 }}';
  const CURRENT_USER_DOC = '{{ $person->document_number ?? (Auth::user()->nickname ?? 'anon') }}';
  const CURRENT_USER_KEY = 'usr_' + CURRENT_USER_ID + '_' + CURRENT_USER_DOC;
  const BACKEND_ANSWERED_SURVEYS = @json($misEncuestasRespondidas ?? []);
  const BACKEND_RESPONDED_EVENTS = @json($misEventosRespondidos ?? []);
  const NOTICIAS_DATA = @json($noticiasPublicadas ?? []);

  // Limpieza preventiva de claves globales residuales no aisladas
  try {
    localStorage.removeItem('sige_egresado_answered_surveys');
    localStorage.removeItem('SIGE_ANSWERED_SURVEYS');
    localStorage.removeItem('SIGE_EVENTOS_INSCRITOS_IDS');
    localStorage.removeItem('SIGE_INVITACIONES_DESCARTADAS');
    localStorage.removeItem('SIGE_NOTIF_LEIDAS_IDS');
    localStorage.removeItem('SIGE_NOTIF_IMPORTANTES_IDS');
    localStorage.removeItem('SIGE_POSTULACIONES_IDS');
    localStorage.removeItem('SIGE_GUARDADAS_IDS');
  } catch(e) {}

  const SURVEY_STORAGE_KEY = 'sige_surveys_' + CURRENT_USER_KEY;

  function getStoredSurveys() {
    const set = new Set();
    // 1. Cargar las encuestas registradas en backend para este usuario específico
    if (Array.isArray(BACKEND_ANSWERED_SURVEYS)) {
      BACKEND_ANSWERED_SURVEYS.forEach(id => set.add(String(id)));
    }
    // 2. Cargar las guardadas en localStorage exclusivamente para este usuario
    try {
      const data = localStorage.getItem(SURVEY_STORAGE_KEY);
      if (data) {
        const parsed = JSON.parse(data);
        if (Array.isArray(parsed)) {
          parsed.forEach(id => set.add(String(id)));
        }
      }
    } catch (e) {
      console.warn('Error leyendo localStorage', e);
    }
    return set;
  }

  function saveStoredSurveys(set) {
    try {
      localStorage.setItem(SURVEY_STORAGE_KEY, JSON.stringify(Array.from(set)));
    } catch (e) {
      console.warn('Error guardando en localStorage', e);
    }
  }

  let activeSurveyId = '';
  const answeredSurveys = getStoredSurveys();

  function openSurveyModal(title, id) {
    if (id !== undefined) {
      activeSurveyId = String(id);
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

    // Enviar al backend para persistencia exclusiva de este usuario
    try {
      const form = document.getElementById('form-responder-encuesta');
      const formData = form ? new FormData(form) : new FormData();
      formData.append('encuesta_id', activeSurveyId);
      formData.append('_token', '{{ csrf_token() }}');

      fetch('{{ route('egresados.encuestas.responder') }}', {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
      });
    } catch(e) {}

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
    const strId = String(id);
    answeredSurveys.add(strId);

    if (saveToStorage) {
      saveStoredSurveys(answeredSurveys);
    }

    // Actualizar la tarjeta visualmente a "Enviada"
    const card = document.getElementById('survey-card-' + strId);
    if (card) {
      card.setAttribute('data-type', 'completadas');

      // Cambiar ícono a check verde
      const icon = document.getElementById('survey-icon-' + strId);
      if (icon) {
        icon.className = 'card-icon-pill green';
        icon.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
      }

      // Cambiar etiqueta superior
      const badge = document.getElementById('survey-badge-' + strId);
      if (badge) {
        badge.className = 'card-tag-badge completed';
        badge.innerHTML = '<i class="fa-solid fa-check"></i> Completada · Registrada';
      }

      // Cambiar botón a "Enviada"
      const btnWrap = document.getElementById('survey-btn-wrap-' + strId);
      if (btnWrap) {
        btnWrap.innerHTML = `
          <button type="button" class="btn-card-outline" style="border-color:#16a34a; color:#16a34a; background:#f0fdf4; cursor:default;" title="Doble clic para reiniciar prueba" ondblclick="resetSurveyForTesting('${strId}')" onclick="showToast('Ya has respondido esta encuesta con éxito')">
            <i class="fa-solid fa-check"></i>
            <span>Enviada</span>
          </button>
        `;
      }

      // Actualizar detalles y fecha
      const meta = document.getElementById('survey-meta-' + strId);
      if (meta) {
        const today = new Date().toISOString().slice(0, 10);
        meta.innerHTML = `
          <span><i class="fa-regular fa-calendar-check"></i> Finalizada hoy (${today})</span>
          <span><i class="fa-solid fa-check-double"></i> Respuestas guardadas</span>
        `;
      }

      // Barra de progreso a 100%
      const prog = document.getElementById('survey-progress-' + strId);
      if (prog) {
        prog.innerHTML = `
          <div class="progress-bar-track"><div class="progress-bar-fill" style="width: 100%;"></div></div>
          <span class="progress-label-text" style="color:#16a34a; font-weight:700;"><i class="fa-solid fa-check"></i> 100% completada</span>
        `;
      }

      // Botón de detalles
      const detailBtn = document.getElementById('survey-detail-btn-' + strId);
      if (detailBtn) {
        detailBtn.innerHTML = `<span>Ver respuestas</span> <i class="fa-solid fa-arrow-right" style="font-size:11px; margin-left:4px;"></i>`;
        detailBtn.onclick = function() { showToast('Visualizando histórico de respuestas...'); };
      }
    }

    // Actualizar todos los cuadritos (KPIs) y contadores
    updateSurveyCounters();
  }

  function updateSurveyCounters() {
    const allCards = document.querySelectorAll('#survey-list-container .survey-card-item');
    const total = allCards.length;
    let completadas = 0;
    let pendientes = 0;

    allCards.forEach(card => {
      const type = card.getAttribute('data-type');
      if (type === 'completadas') {
        completadas++;
      } else {
        pendientes++;
      }
    });

    const tasa = total > 0 ? Math.round((completadas / total) * 100) : 100;

    // Cuadrito Inicio: Encuestas Pendientes
    const elInicioPend = document.getElementById('kpi-inicio-encuestas-pendientes');
    if (elInicioPend) elInicioPend.textContent = pendientes;
    const elInicioSub = document.getElementById('kpi-inicio-subtext-encuestas');
    if (elInicioSub) {
      elInicioSub.textContent = pendientes === 0 ? '¡Al día! Sin encuestas pendientes' : (pendientes === 1 ? '1 encuesta pendiente' : pendientes + ' encuestas pendientes');
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
    if (elFilterTodas) elFilterTodas.textContent = total;

    const elFilterPend = document.getElementById('count-filter-pendientes');
    if (elFilterPend) elFilterPend.textContent = pendientes;

    const elFilterComp = document.getElementById('count-filter-completadas');
    if (elFilterComp) elFilterComp.textContent = completadas;

    // Actualizar notificaciones del topbar al pie del nombre
    renderEgresadoTopbarNotifications();
  }

  function renderEgresadoTopbarNotifications() {
    const listEl = document.getElementById('notifItemsList');
    const badgeCount = document.getElementById('notifCountBadge');
    const badgeDot = document.getElementById('notifBadgeDot');
    if (!listEl) return;

    // 1. Obtener encuestas pendientes
    const pendingSurveyCards = document.querySelectorAll('#survey-list-container .survey-card-item[data-type="pendientes"]');
    
    // 2. Obtener banner institucional si está visible y pendiente
    const banner = document.getElementById('banner-invitacion-evento');
    const hasPendingBanner = banner && banner.style.display !== 'none' && !banner.hidden;

    const notifItems = [];

    // Agregar encuestas pendientes a las notificaciones de la campana
    pendingSurveyCards.forEach(card => {
      const id = card.getAttribute('data-id') || '';
      const titleEl = card.querySelector('.card-title-text');
      const title = titleEl ? titleEl.textContent.trim() : 'Encuesta Institucional';
      const metaDateEl = card.querySelector('.card-meta-list span');
      const dateText = metaDateEl ? metaDateEl.textContent.trim() : 'Pendiente';

      notifItems.push({
        type: 'encuesta',
        id: id,
        title: title,
        meta: dateText,
        icon: 'fa-clipboard-list',
        color: '#b45309',
        bg: '#FEF3C7',
        action: `showSection('encuestas'); openSurveyModal('${title.replace(/'/g, "\\'")}', '${id}');`
      });
    });

    // 2. Obtener eventos institucionales pendientes de inscripción
    const addedEventIds = new Set();
    let pendingEventsCount = 0;

    if (hasPendingBanner) {
      const invTitle = banner.getAttribute('data-event-title') || 'Invitación Institucional';
      const invId = banner.getAttribute('data-event-id') || '';
      addedEventIds.add(invId);
      addedEventIds.add(invTitle.trim().toLowerCase());
      pendingEventsCount++;

      notifItems.push({
        type: 'evento',
        id: invId,
        title: '¡Nueva Invitación Oficial: ' + invTitle + '!',
        meta: 'Requiere confirmar inscripción · Aparta tu cupo',
        icon: 'fa-calendar-check',
        color: '#0d6928',
        bg: '#DCFCE7',
        action: `showSection('inicio'); openInscripcionModal('${invTitle.replace(/'/g, "\\'")}', document.getElementById('btn-inscribir-${invId}'), '${invId}');`
      });
    }

    // Agregar todos los eventos disponibles a los que el egresado aún no se ha inscrito
    const eventCards = document.querySelectorAll('#section-eventos .event-card-item');
    eventCards.forEach(card => {
      const evId = card.getAttribute('data-event-id') || '';
      const titleEl = card.querySelector('.card-title-text');
      const title = titleEl ? titleEl.textContent.trim() : 'Evento Institucional';
      const cleanId = evId.replace(/^event-inv-/, '').replace(/^event-/, '');

      const isAlreadyInscribed = (
        (inscribedEvents && (
          inscribedEvents.has(evId) ||
          inscribedEvents.has(cleanId) ||
          inscribedEvents.has('event-' + cleanId) ||
          inscribedEvents.has('title:' + title.toLowerCase())
        ))
      );

      const isAlreadyAdded = addedEventIds.has(evId) || addedEventIds.has(title.toLowerCase());

      if (!isAlreadyInscribed && !isAlreadyAdded) {
        pendingEventsCount++;
        addedEventIds.add(evId);
        addedEventIds.add(title.toLowerCase());

        const metaDateEl = card.querySelector('.card-meta-list span');
        const dateText = metaDateEl ? metaDateEl.textContent.trim() : 'Próximamente';

        notifItems.push({
          type: 'evento',
          id: evId,
          title: 'Nuevo Evento: ' + title,
          meta: dateText + ' · Inscríbete aquí',
          icon: 'fa-calendar-days',
          color: '#15803d',
          bg: '#EAF7EE',
          action: `showSection('eventos'); openInscripcionModal('${title.replace(/'/g, "\\'")}', document.getElementById('btn-inscribir-${cleanId}') || document.getElementById('btn-inscribir-${evId}'), '${evId}');`
        });
      }
    });

    // Actualizar badge de eventos en el menú lateral si existe
    const navBadgeEventos = document.getElementById('nav-badge-eventos');
    if (navBadgeEventos) {
      if (pendingEventsCount > 0) {
        navBadgeEventos.textContent = pendingEventsCount;
        navBadgeEventos.style.display = 'inline-flex';
      } else {
        navBadgeEventos.style.display = 'none';
      }
    }

    // Agregar noticias publicadas recientemente por Admin / Superadmin
    if (typeof NOTICIAS_DATA !== 'undefined' && Array.isArray(NOTICIAS_DATA) && NOTICIAS_DATA.length > 0) {
      const topNews = NOTICIAS_DATA.slice(0, 2);
      topNews.forEach(news => {
        notifItems.push({
          type: 'noticia',
          id: news.id,
          title: news.title || 'Nueva Noticia Institucional',
          meta: news.date || 'Reciente',
          icon: 'fa-newspaper',
          color: '#1D4ED8',
          bg: '#EEF4FF',
          action: `showSection('noticias'); openModalDetalleNoticia('${news.id}');`
        });
      });
    }

    // Renderizar en el menú desplegable al pie del nombre
    if (notifItems.length > 0) {
      let html = '';
      notifItems.forEach(item => {
        html += `
          <div class="notif-item unread" style="cursor:pointer;" onclick="${item.action}">
            <div class="notif-icon" style="background:${item.bg};">
              <i class="fa-solid ${item.icon}" style="color:${item.color};"></i>
            </div>
            <div class="notif-content">
              <div class="notif-text">
                <strong>${item.type === 'encuesta' ? 'Encuesta Pendiente:' : (item.type === 'noticia' ? 'Noticia:' : 'Evento:')}</strong> ${item.title}
              </div>
              <div class="notif-meta">
                <span class="notif-time" style="color:${item.color}; font-weight:700;"><i class="fa-regular fa-clock"></i> ${item.meta}</span>
                <span class="unread-dot"></span>
              </div>
            </div>
          </div>
        `;
      });
      listEl.innerHTML = html;

      if (badgeDot) badgeDot.style.display = 'flex';
      if (badgeCount) {
        badgeCount.textContent = `${notifItems.length} pendientes`;
        badgeCount.style.background = '#FEF2F2';
        badgeCount.style.color = '#DC2626';
      }
    } else {
      listEl.innerHTML = `
        <div style="padding:28px 18px; text-align:center; color:#64748b;">
          <div style="width:42px; height:42px; border-radius:50%; background:#DCFCE7; color:#16a34a; display:inline-flex; align-items:center; justify-content:center; font-size:18px; margin-bottom:8px;">
            <i class="fa-solid fa-check"></i>
          </div>
          <p style="font-size:13.5px; font-weight:700; color:#0f172a; margin:0 0 4px;">¡Estás al día!</p>
          <p style="font-size:12px; margin:0; line-height:1.4;">No tienes encuestas ni actividades pendientes por completar.</p>
        </div>
      `;
      if (badgeDot) badgeDot.style.display = 'none';
      if (badgeCount) {
        badgeCount.textContent = 'Al día';
        badgeCount.style.background = '#DCFCE7';
        badgeCount.style.color = '#166534';
      }
    }
  }

  function resetSurveyForTesting(id) {
    answeredSurveys.delete(String(id));
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

  // Modales y Control de Inscripción a Eventos (Aislado por Usuario)
  const STORAGE_EVENTOS_KEY = 'sige_events_' + CURRENT_USER_KEY;

  function getStoredEventSet() {
    const set = new Set();
    // 1. Respuestas de eventos del backend para este usuario específico
    if (Array.isArray(BACKEND_RESPONDED_EVENTS)) {
      BACKEND_RESPONDED_EVENTS.forEach(id => set.add(String(id)));
    }
    // 2. Guardadas en localStorage exclusivamente para este usuario
    try {
      const data = localStorage.getItem(STORAGE_EVENTOS_KEY);
      if (data) {
        const parsed = JSON.parse(data);
        if (Array.isArray(parsed)) {
          parsed.forEach(id => set.add(String(id)));
        }
      }
    } catch(e) {}
    return set;
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

  const STORAGE_DISMISSED_INV_KEY = 'sige_dismissed_inv_' + CURRENT_USER_KEY;

  function getDismissedInvitations() {
    try {
      const data = localStorage.getItem(STORAGE_DISMISSED_INV_KEY);
      return data ? new Set(JSON.parse(data)) : new Set();
    } catch(e) {
      return new Set();
    }
  }

  function saveDismissedInvitations(set) {
    try {
      localStorage.setItem(STORAGE_DISMISSED_INV_KEY, JSON.stringify(Array.from(set)));
    } catch(e) {}
  }

  function checkHideBannerInvitacion() {
    const banner = document.getElementById('banner-invitacion-evento');
    if (!banner) return;

    const eventId = banner.getAttribute('data-event-id');
    const eventTitle = (banner.getAttribute('data-event-title') || '').trim().toLowerCase();
    const dismissed = getDismissedInvitations();

    let shouldHide = false;

    if (eventId && dismissed.has(eventId)) shouldHide = true;
    if (eventTitle && dismissed.has(eventTitle)) shouldHide = true;

    if (inscribedEvents && inscribedEvents.size > 0) {
      if (eventId && inscribedEvents.has(eventId)) shouldHide = true;
      if (eventTitle && inscribedEvents.has('title:' + eventTitle)) shouldHide = true;

      inscribedEvents.forEach(item => {
        if (typeof item === 'string') {
          const itemLower = item.toLowerCase();
          if (eventId && itemLower.includes(eventId.toLowerCase())) shouldHide = true;
          if (eventTitle && (itemLower.includes(eventTitle) || eventTitle.includes(itemLower.replace('title:', '')))) {
            shouldHide = true;
          }
        }
      });
    }

    if (shouldHide) {
      banner.style.display = 'none';
    }
    if (typeof renderEgresadoTopbarNotifications === 'function') {
      renderEgresadoTopbarNotifications();
    }
  }

  function descartarBannerInvitacion(eventId, eventTitle) {
    const banner = document.getElementById('banner-invitacion-evento');
    if (banner) {
      banner.style.opacity = '0';
      banner.style.transform = 'translateY(-10px)';
      setTimeout(() => {
        banner.style.display = 'none';
        if (typeof renderEgresadoTopbarNotifications === 'function') {
          renderEgresadoTopbarNotifications();
        }
      }, 250);
    }
    const dismissed = getDismissedInvitations();
    if (eventId) dismissed.add(eventId);
    if (eventTitle) dismissed.add(eventTitle.trim().toLowerCase());
    saveDismissedInvitations(dismissed);
  }

  function updateEventCounters() {
    const totalEvents = document.querySelectorAll('#section-eventos .event-card-item').length || 2;

    const kpiEventosActivos = document.getElementById('kpi-eventos-activos-count');
    if (kpiEventosActivos) kpiEventosActivos.textContent = totalEvents;

    const kpiInicioEventos = document.getElementById('kpi-inicio-eventos-count');
    if (kpiInicioEventos) kpiInicioEventos.textContent = totalEvents;

    const kpiInscripciones = document.getElementById('kpi-mis-inscripciones-count');
    if (kpiInscripciones) kpiInscripciones.textContent = inscribedEvents.size;
  }

  const EVENTOS_LIST_DATA = @json($eventosDisponibles ?? []);
  const INVITACIONES_LIST_DATA = @json($invitacionesEventos ?? []);

  function openInscripcionModal(title, btn, eventId) {
    activeEventTitle = title || 'Actividad Especial';
    activeEventBtn = btn || null;
    activeEventId = eventId || '';

    let card = null;
    if (btn) {
      card = btn.closest('.event-card-item') || btn.closest('#banner-invitacion-evento');
    }
    if (!card && eventId) {
      card = document.querySelector('[data-event-id="' + eventId + '"]');
    }

    let eventData = {
      title: activeEventTitle,
      type: 'Evento Institucional · CEFA',
      date: 'Fecha por confirmar',
      time: '09:00 AM - 12:00 PM',
      location: 'Auditorio Principal CEFA La Angostura',
      program: 'Comunidad de Egresados SENA',
      responsible: 'Coordinación Académica & Egresados',
      description: 'Participa en esta actividad oficial diseñada para el fortalecimiento profesional, inserción laboral y networking de la comunidad de egresados del CEFA.',
      cupo: 'Cupo: 200 asistentes'
    };

    // 1. Buscar en arreglo backend de eventos
    const cleanId = String(eventId || '').replace(/^event-inv-/, '').replace(/^event-/, '');
    const foundEvt = EVENTOS_LIST_DATA.find(e => String(e.id) === cleanId || String(e.title || '').trim().toLowerCase() === activeEventTitle.trim().toLowerCase());
    
    if (foundEvt) {
      if (foundEvt.title) eventData.title = foundEvt.title;
      if (foundEvt.type) eventData.type = foundEvt.type;
      if (foundEvt.date) eventData.date = foundEvt.date;
      if (foundEvt.time) eventData.time = foundEvt.time;
      if (foundEvt.location) eventData.location = foundEvt.location;
      if (foundEvt.program) eventData.program = foundEvt.program;
      if (foundEvt.responsible) eventData.responsible = foundEvt.responsible;
      if (foundEvt.description) eventData.description = foundEvt.description;
      if (foundEvt.cupo) eventData.cupo = 'Cupo Máximo: ' + foundEvt.cupo + ' asistentes';
    }

    // 2. Extraer del DOM de la tarjeta (si está en pantalla)
    if (card) {
      const titleEl = card.querySelector('.card-title-text');
      if (titleEl && titleEl.textContent.trim()) {
        eventData.title = titleEl.textContent.trim();
      }
      const tagEl = card.querySelector('.card-tag-badge');
      if (tagEl && tagEl.textContent.trim()) {
        eventData.type = tagEl.textContent.replace(/\s+/g, ' ').trim();
      }
      const metaSpans = card.querySelectorAll('.card-meta-list span');
      metaSpans.forEach(span => {
        const text = span.textContent.trim();
        if (span.querySelector('.fa-calendar')) {
          eventData.date = text;
        } else if (span.querySelector('.fa-clock')) {
          eventData.time = text;
        } else if (span.querySelector('.fa-location-dot')) {
          eventData.location = text;
        } else if (span.querySelector('.fa-graduation-cap')) {
          eventData.program = text;
        } else if (span.querySelector('.fa-chalkboard-user')) {
          eventData.responsible = text;
        }
      });
      const descEl = card.querySelector('.card-desc-paragraph');
      if (descEl && descEl.textContent.trim()) {
        eventData.description = descEl.textContent.trim();
      }
      const cupoEl = card.querySelector('.card-action-bar span');
      if (cupoEl && cupoEl.textContent.trim()) {
        eventData.cupo = cupoEl.textContent.trim();
      }
    }

    // 3. Poblar modal
    const titleEl = document.getElementById('modal-event-title');
    if (titleEl) titleEl.textContent = 'Inscripción: ' + eventData.title;

    const typeEl = document.getElementById('modal-event-type-text');
    if (typeEl) typeEl.textContent = eventData.type;

    const dateEl = document.getElementById('modal-event-date-text');
    if (dateEl) dateEl.textContent = eventData.date;

    const timeEl = document.getElementById('modal-event-time-text');
    if (timeEl) timeEl.textContent = eventData.time;

    const locEl = document.getElementById('modal-event-location-text');
    if (locEl) locEl.textContent = eventData.location;

    const progEl = document.getElementById('modal-event-program-text');
    if (progEl) progEl.textContent = eventData.program;

    const descEl = document.getElementById('modal-event-desc-text');
    if (descEl) descEl.textContent = eventData.description;

    const cupoEl = document.getElementById('modal-event-cupo-text');
    if (cupoEl) cupoEl.textContent = eventData.cupo;

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
    const btnSubmit = document.getElementById('btn-submit-confirm-inscripcion');
    if (btnSubmit) {
      btnSubmit.disabled = true;
      btnSubmit.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Confirmando...';
    }

    const modalidadVal = document.getElementById('modal-event-select-modalidad')?.value || 'Presencial';
    const emailVal = document.getElementById('modal-event-input-email')?.value || '';
    const phoneVal = document.getElementById('modal-event-input-phone')?.value || '';
    const nameVal = document.getElementById('modal-event-input-name')?.value || '';
    const docVal = document.getElementById('modal-event-input-doc')?.value || '';

    // Enviar RSVP al backend para persistencia completa
    try {
      fetch('{{ route("egresados.eventos.responder") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
          evento_id: activeEventId.replace('event-', '').replace('inv-', ''),
          title: activeEventTitle,
          asistencia: 'si',
          modalidad: modalidadVal,
          documento: docVal,
          nombre: nameVal,
          email: emailVal,
          telefono: phoneVal
        })
      }).catch(() => {});
    } catch(e) {}

    closeInscripcionModal();

    if (btnSubmit) {
      btnSubmit.disabled = false;
      btnSubmit.innerHTML = '<i class="fa-solid fa-calendar-check"></i> <span>Confirmar mi Cupo</span>';
    }

    if (activeEventId) {
      inscribedEvents.add(activeEventId);
    }
    if (activeEventTitle) {
      inscribedEvents.add('title:' + activeEventTitle.trim().toLowerCase());
    }
    saveStoredEventSet(inscribedEvents);

    // Ocultar banner si ya se inscribió en este evento
    checkHideBannerInvitacion();

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

    // Actualizar notificaciones en la campana arribita
    if (typeof renderEgresadoTopbarNotifications === 'function') {
      renderEgresadoTopbarNotifications();
    }

    // Mostrar ventana modal de confirmación con botón Aceptar
    const titleSuccess = document.getElementById('modal-success-event-title');
    if (titleSuccess) titleSuccess.textContent = activeEventTitle || 'el evento seleccionado';

    setTimeout(() => {
      const modalExitosa = document.getElementById('modalInscripcionExitosa');
      if (modalExitosa) modalExitosa.classList.add('active');
    }, 150);
  }

  // Control de Notificaciones (Importantes con Estrella y Leídas - Aislado por Usuario)
  const STORAGE_NOTIF_IMPORTANTES_KEY = 'sige_notif_star_' + CURRENT_USER_KEY;
  const STORAGE_NOTIF_LEIDAS_KEY = 'sige_notif_read_' + CURRENT_USER_KEY;

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

  // Modal y Control de Postulación y Guardadas de Ofertas Laborales (Aislado por Usuario)
  const STORAGE_POSTULACIONES_KEY = 'sige_postulaciones_' + CURRENT_USER_KEY;
  const STORAGE_GUARDADAS_KEY = 'sige_guardadas_' + CURRENT_USER_KEY;

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

  // Filtros de Encuestas (Pendientes por defecto, Todas para ver histórico completo, Respondidas para ver enviadas)
  let currentSurveyFilter = 'pendientes';

  function filterSurveys(filter, btn) {
    if (filter) currentSurveyFilter = filter;

    document.querySelectorAll('.filter-tabs-group .filter-pill-btn').forEach(b => b.classList.remove('active'));
    const targetBtn = btn || document.getElementById('tab-filter-' + currentSurveyFilter);
    if (targetBtn) targetBtn.classList.add('active');

    const items = document.querySelectorAll('.survey-card-item');
    let visibleCount = 0;

    items.forEach(card => {
      const type = card.getAttribute('data-type');
      let shouldShow = false;

      if (currentSurveyFilter === 'todas') {
        shouldShow = true;
      } else if (currentSurveyFilter === 'pendientes') {
        shouldShow = (type === 'pendientes');
      } else if (currentSurveyFilter === 'completadas') {
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
        } else if (currentSurveyFilter === 'pendientes') {
          if (titleEl) titleEl.textContent = '¡Estás al día con tus encuestas!';
          if (descEl) descEl.textContent = 'No tienes instrumentos pendientes por diligenciar. Puedes revisar tus respuestas guardadas en la pestaña Respondidas o Todas.';
        } else {
          if (titleEl) titleEl.textContent = 'No hay encuestas disponibles';
          if (descEl) descEl.textContent = 'Actualmente no se encuentran encuestas registradas en el sistema.';
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
        isCategoryAllowed = true;
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
        isCategoryAllowed = true;
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

  // ========================================================
  // CONTROL DEL MODAL DE ACTUALIZACIÓN DE PERFIL DEL EGRESADO
  // ========================================================
  function openModalActualizarPerfilEgresado() {
    const modal = document.getElementById('modalActualizarPerfilEgresado');
    if (modal) {
      modal.classList.add('active');
      // Cerrar dropdown del usuario si estuviera desplegado
      const userMenu = document.getElementById('userDropdownMenu');
      if (userMenu) userMenu.style.display = 'none';
      const chevron = document.getElementById('userChevronIcon');
      if (chevron) chevron.style.transform = 'rotate(0deg)';
    }
  }

  function closeModalActualizarPerfilEgresado() {
    const modal = document.getElementById('modalActualizarPerfilEgresado');
    if (modal) modal.classList.remove('active');
    const errBox = document.getElementById('alert-profile-error');
    if (errBox) errBox.style.display = 'none';
  }

  // ========================================================
  // CONTROL DE NOTICIAS & MODAL DE DETALLE
  // ========================================================

  function openModalDetalleNoticia(id) {
    const noticia = NOTICIAS_DATA.find(n => String(n.id) === String(id));
    if (!noticia) return;

    const modal = document.getElementById('modalDetalleNoticia');
    if (!modal) return;

    let imgUrl = noticia.image || '';
    if (imgUrl && imgUrl.includes('127.0.0.1:8000/storage/')) {
      imgUrl = '{{ asset("") }}' + imgUrl.split('127.0.0.1:8000/')[1];
    }

    const imgWrap = document.getElementById('modal-noticia-img-wrap');
    const imgEl = document.getElementById('modal-noticia-img');
    const headerNoImg = document.getElementById('modal-noticia-header-no-img');

    if (imgUrl) {
      if (imgWrap) imgWrap.style.display = 'block';
      if (headerNoImg) headerNoImg.style.display = 'none';
      if (imgEl) imgEl.src = imgUrl;
      const catBadge = document.getElementById('modal-noticia-cat-badge');
      if (catBadge) {
        catBadge.textContent = noticia.category || 'Institucional';
        catBadge.className = 'badge-pill ' + (noticia.category_pill || 'status-green');
      }
      const titleImg = document.getElementById('modal-noticia-title-img');
      if (titleImg) titleImg.textContent = noticia.title || '';
    } else {
      if (imgWrap) imgWrap.style.display = 'none';
      if (headerNoImg) headerNoImg.style.display = 'block';
      const catBadgeNoImg = document.getElementById('modal-noticia-cat-badge-no-img');
      if (catBadgeNoImg) {
        catBadgeNoImg.textContent = noticia.category || 'Institucional';
        catBadgeNoImg.className = 'badge-pill ' + (noticia.category_pill || 'status-green');
      }
      const dateHeader = document.getElementById('modal-noticia-date-header');
      if (dateHeader) dateHeader.textContent = noticia.date || 'Reciente';
      const titleNoImg = document.getElementById('modal-noticia-title-no-img');
      if (titleNoImg) titleNoImg.textContent = noticia.title || '';
    }

    const targetEl = document.getElementById('modal-noticia-target');
    if (targetEl) targetEl.textContent = noticia.target || 'Toda la comunidad de Egresados CEFA';

    const viewsEl = document.getElementById('modal-noticia-views');
    if (viewsEl) viewsEl.textContent = noticia.views_count || 1;

    const summaryEl = document.getElementById('modal-noticia-summary-box');
    if (summaryEl) summaryEl.textContent = noticia.summary || '';

    const contentEl = document.getElementById('modal-noticia-content');
    if (contentEl) contentEl.textContent = noticia.content || noticia.summary || '';

    const authorEl = document.getElementById('modal-noticia-author');
    if (authorEl) authorEl.textContent = noticia.author || 'Administración CEFA';

    modal.classList.add('active');
  }

  function closeModalDetalleNoticia() {
    const modal = document.getElementById('modalDetalleNoticia');
    if (modal) modal.classList.remove('active');
  }

  function filtrarNoticiasEgresado() {
    const query = (document.getElementById('input-buscar-noticias')?.value || '').toLowerCase().trim();
    const cat = (document.getElementById('select-filtro-categoria-noticia')?.value || 'todas').toLowerCase();

    const cards = document.querySelectorAll('.noticia-card-item');
    let visibleCount = 0;

    cards.forEach(card => {
      const cardCat = (card.getAttribute('data-category') || '').toLowerCase();
      const cardTitle = (card.getAttribute('data-title') || '').toLowerCase();
      const cardSummary = (card.getAttribute('data-summary') || '').toLowerCase();
      const cardAuthor = (card.getAttribute('data-author') || '').toLowerCase();
      const cardTarget = (card.getAttribute('data-target') || '').toLowerCase();

      const matchesQuery = !query || cardTitle.includes(query) || cardSummary.includes(query) || cardAuthor.includes(query) || cardTarget.includes(query);
      const matchesCat = (cat === 'todas') || (cardCat === cat) || cardCat.includes(cat);

      if (matchesQuery && matchesCat) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    const noRes = document.getElementById('noticias-no-results');
    if (noRes) {
      noRes.style.display = visibleCount === 0 ? 'block' : 'none';
    }
  }

  // Manejador de teclado Escape para cerrar modales y menús
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      toggleProfileDropdown(false);
      closeSurveyModal();
      closeEncuestaEnviadaModal();
      closeInscripcionModal();
      closeInscripcionExitosaModal();
      cerrarModalPostulacion();
      closeModalActualizarPerfilEgresado();
      cerrarModalPostulacionExitosa();
      closeModalDetalleNoticia();
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

    // Ocultar banner de invitación institucional si ya está inscrito o fue descartado
    checkHideBannerInvitacion();

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

    // Sincronizar notificaciones en la campana al pie del nombre
    if (typeof renderEgresadoTopbarNotifications === 'function') {
      renderEgresadoTopbarNotifications();
    }

    // Manejador del Formulario de Actualización de Perfil con AJAX
    const formPerfil = document.getElementById('formActualizarPerfilEgresado');
    if (formPerfil) {
      formPerfil.addEventListener('submit', function(e) {
        e.preventDefault();
        const btnSubmit = document.getElementById('btn-submit-perfil');
        const originalText = btnSubmit.innerHTML;
        btnSubmit.disabled = true;
        btnSubmit.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Guardando...';

        const errBox = document.getElementById('alert-profile-error');
        if (errBox) errBox.style.display = 'none';

        const formData = new FormData(formPerfil);

        fetch(formPerfil.action, {
          method: 'POST',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          },
          body: formData
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(({ status, body }) => {
          btnSubmit.disabled = false;
          btnSubmit.innerHTML = originalText;

          if (status === 200 && body.success) {
            closeModalActualizarPerfilEgresado();

            // Actualizar el nombre e información visible en topbar y hero banner
            if (body.data) {
              const heroName = document.querySelector('.hero-heading');
              if (heroName && body.data.first_name) {
                heroName.innerHTML = `¡Bienvenido(a), ${body.data.first_name}!`;
              }
              const userChipName = document.querySelector('#userChipBtn span');
              if (userChipName && body.data.full_name) {
                userChipName.textContent = body.data.full_name;
              }
              const menuName = document.querySelector('.user-menu-name');
              if (menuName && body.data.full_name) {
                menuName.textContent = body.data.full_name;
              }
              const menuEmail = document.querySelector('.user-menu-email');
              if (menuEmail && body.data.email) {
                menuEmail.textContent = body.data.email;
              }
            }

            // Mostrar el modal oficial SENA de confirmación
            const successModal = document.getElementById('modalInscripcionExitosa');
            if (successModal) {
              const successH3 = successModal.querySelector('h3');
              const successP = successModal.querySelector('p');
              const tagSpan = successModal.querySelector('div span');
              if (tagSpan) tagSpan.textContent = 'ACTUALIZACIÓN EXITOSA · SIGE ERP';
              if (successH3) successH3.textContent = '¡Información Actualizada!';
              if (successP) successP.textContent = 'Tus datos personales, de contacto y perfil han sido guardados satisfactoriamente en el sistema.';
              successModal.classList.add('active');
            } else if (typeof showToast === 'function') {
              showToast('¡Tus datos han sido actualizados con éxito!');
            } else {
              alert('¡Tus datos han sido actualizados exitosamente!');
            }
          } else {
            // Mostrar mensaje de error o validación
            let errorMsg = body.message || 'No se pudo actualizar la información. Por favor revisa los campos.';
            if (body.errors) {
              const errList = Object.values(body.errors).flat();
              errorMsg = errList.join('<br>• ');
            }
            if (errBox) {
              errBox.innerHTML = '<strong><i class="fa-solid fa-triangle-exclamation"></i> Por favor revisa los siguientes campos:</strong><br>• ' + errorMsg;
              errBox.style.display = 'block';
              errBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
              alert(errorMsg);
            }
          }
        })
        .catch(err => {
          btnSubmit.disabled = false;
          btnSubmit.innerHTML = originalText;
          formPerfil.submit();
        });
      });
    }

    const hash = window.location.hash.replace('#', '');
    if (hash && sectionsList.includes(hash)) {
      showSection(hash);
    } else {
      showSection('inicio');
    }

    @if(!empty($debeActualizarPassword))
      setTimeout(() => {
        openModalActualizarPasswordInicial();
      }, 600);
    @endif
  });

  /* ========================================================
     FUNCIONES PARA ACTUALIZACIÓN DE CONTRASEÑA INICIAL (ERP SENA)
     ======================================================== */
  function openModalActualizarPasswordInicial() {
    const modal = document.getElementById('modalActualizarPasswordInicial');
    if (modal) {
      modal.classList.add('active');
      const errBox = document.getElementById('alert-password-error');
      const sucBox = document.getElementById('alert-password-success');
      if (errBox) errBox.style.display = 'none';
      if (sucBox) sucBox.style.display = 'none';
      setTimeout(() => {
        const newPwdInput = document.getElementById('pwd_new_password');
        if (newPwdInput) newPwdInput.focus();
      }, 250);
    }
  }

  function closeModalActualizarPasswordInicial() {
    const modal = document.getElementById('modalActualizarPasswordInicial');
    if (modal) modal.classList.remove('active');
  }

  function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    if (!input) return;
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
      input.type = 'text';
      if (icon) {
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      }
    } else {
      input.type = 'password';
      if (icon) {
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  }

  function checkPasswordMatch() {
    const p1 = document.getElementById('pwd_new_password');
    const p2 = document.getElementById('pwd_new_password_confirmation');
    const status = document.getElementById('pwdMatchStatus');
    if (!p1 || !p2 || !status) return;

    if (!p2.value) {
      status.style.display = 'none';
      return;
    }

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
    const banner = document.getElementById('banner-alerta-password-inicial');

    const curVal = document.getElementById('pwd_current_password').value.trim();
    const newVal = document.getElementById('pwd_new_password').value.trim();
    const confVal = document.getElementById('pwd_new_password_confirmation').value.trim();

    if (!curVal) {
      errBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Por favor ingresa tu contraseña inicial (tu documento de identidad).';
      errBox.style.display = 'block';
      return;
    }
    if (newVal.length < 6) {
      errBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> La nueva contraseña debe tener al menos 6 caracteres.';
      errBox.style.display = 'block';
      return;
    }
    if (newVal !== confVal) {
      errBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> La confirmación de contraseña no coincide con la nueva contraseña.';
      errBox.style.display = 'block';
      return;
    }
    if (newVal === curVal) {
      errBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> La nueva contraseña no puede ser igual a tu documento o clave inicial.';
      errBox.style.display = 'block';
      return;
    }

    errBox.style.display = 'none';
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando...';

    const formData = new FormData(form);

    fetch("{{ route('egresados.cambiar_password') }}", {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    })
    .then(res => res.json().then(data => ({ status: res.status, ok: res.ok, data })))
    .then(({ status, ok, data }) => {
      btn.disabled = false;
      btn.innerHTML = originalText;

      if (ok && data.success) {
        sucBox.innerHTML = '<i class="fa-solid fa-circle-check"></i> ' + (data.message || '¡Contraseña actualizada con éxito!');
        sucBox.style.display = 'block';
        errBox.style.display = 'none';

        if (banner) {
          banner.style.transition = 'all 0.5s ease';
          banner.style.opacity = '0';
          banner.style.transform = 'translateY(-20px)';
          setTimeout(() => { banner.remove(); }, 500);
        }

        showToast('¡Tu contraseña ha sido actualizada con éxito!');

        setTimeout(() => {
          closeModalActualizarPasswordInicial();
        }, 1600);
      } else {
        errBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> ' + (data.message || 'Error al actualizar contraseña.');
        errBox.style.display = 'block';
      }
    })
    .catch(err => {
      btn.disabled = false;
      btn.innerHTML = originalText;
      errBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Ocurrió un error inesperado de conexión.';
      errBox.style.display = 'block';
    });
  }
</script>

</body>
</html>
