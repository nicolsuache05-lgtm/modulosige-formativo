<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <title>SIGE · Panel de Instructor — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sige-egresado-favicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sige-egresado-favicon.png') }}">

    <!-- Google Fonts: Poppins & Nunito (Tipografía Institucional SENA Empresa ERP) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Highcharts + 3D -->
    <script src="https://cdn.jsdelivr.net/npm/highcharts@11.4.8/highcharts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/highcharts@11.4.8/highcharts-3d.js"></script>

    <style>
      :root {
        /* PALETA INSTITUCIONAL SENA EMPRESA ERP */
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

      /* ---------------- MAIN VIEWPORT ---------------- */
      .main {
        display: flex;
        flex-direction: column;
        min-width: 0;
      }

      /* ---------------- TOPBAR ---------------- */
      .topbar {
        background: linear-gradient(135deg, var(--sena-dark) 0%, var(--sena-navy) 100%);
        color: #ffffff;
        padding: 0 36px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid var(--sena-green, #39A900);
        box-shadow: 0 4px 14px rgba(0, 19, 30, 0.15);
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

      .icon-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        color: #ffffff;
        transition: all 0.2s ease;
      }
      .icon-btn:hover {
        background: rgba(57, 169, 0, 0.25);
        color: var(--moss);
        border-color: var(--moss);
      }
      .icon-btn .dot {
        position: absolute;
        top: 7px;
        right: 8px;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--moss);
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
        color: var(--green);
      }

      /* Stat cards (Grid de 6 tarjetas igual al Super Admin) */
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
        grid-template-columns: 1.05fr 1.15fr;
        gap: 20px;
      }

      .panel {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 20px 22px;
        box-shadow: 0 4px 14px rgba(0, 19, 30, 0.03);
      }
      .chart-wrap-compact {
        position: relative;
        height: 225px;
        width: 100%;
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

      @media (max-width: 1080px) {
        .stats-grid {
          grid-template-columns: repeat(2, 1fr);
        }
        .lower-grid {
          grid-template-columns: 1fr;
        }
      }

      @media (max-width: 768px) {
        .app {
          grid-template-columns: 1fr;
        }
        .sidebar {
          display: none;
        }
        .stats-grid {
          grid-template-columns: 1fr;
        }
        .content {
          padding: 20px 16px 36px;
        }
      }

      /* Modal Backdrop y Estilos para Modal de Contraseña ERP Tipo SOFIA PLUS */
      .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: radial-gradient(circle at center, rgba(0, 35, 54, 0.96) 0%, rgba(0, 19, 30, 0.98) 100%);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        z-index: 999999;
        display: none;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        padding: 16px;
        overflow-y: auto;
      }
      .modal-backdrop.active {
        display: flex;
        opacity: 1;
        pointer-events: auto;
      }
      .modal-box-card {
        background: #FFFFFF;
        border-radius: 22px;
        width: 100%;
        max-width: 620px;
        position: relative;
        transform: scale(1);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(98, 227, 29, 0.35);
        border-top: 5px solid #39A900;
        overflow: hidden;
        margin: auto;
      }
      @keyframes sofiaShake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-10px); }
        40%, 80% { transform: translateX(10px); }
      }
      .sofia-shake {
        animation: sofiaShake 0.45s ease-in-out !important;
      }
      .sofia-user-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 18px;
      }
      @media (max-width: 600px) {
        .sofia-user-grid {
          grid-template-columns: 1fr;
        }
      }
      .sofia-user-item {
        font-size: 12px;
      }
      .sofia-user-item .label {
        color: #64748B;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 10px;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 2px;
      }
      .sofia-user-item .val {
        color: #00131E;
        font-weight: 800;
        font-size: 13.5px;
      }
      .btn-sofia-submit {
        width: 100%;
        background: linear-gradient(135deg, #39A900 0%, #2a7c00 100%);
        color: #FFFFFF;
        border: none;
        padding: 14px 24px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 800;
        font-family: inherit;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 18px rgba(57, 169, 0, 0.4);
        transition: all 0.25s ease;
      }
      .btn-sofia-submit:hover {
        background: linear-gradient(135deg, #43be04 0%, #319400 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(57, 169, 0, 0.55);
      }
      .modal-close-x {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .modal-close-x:hover {
        background: rgba(255, 255, 255, 0.95);
        color: #00131E;
      }
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
        box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35);
      }
      .btn-actualizar-pwd-erp {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #39A900 0%, #2d8500 100%);
        color: #FFFFFF;
        border: none;
        padding: 11px 20px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35);
        transition: all 0.25s ease;
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
      }
      .pwd-match-status {
        font-size: 11.5px;
        font-weight: 700;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
      }
      .pwd-match-status.ok { color: #16a34a; }
      .pwd-match-status.err { color: #dc2626; }
      .erp-security-tips {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 12px 16px;
        margin-top: 14px;
        font-size: 12px;
        color: #475569;
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
        padding: 18px 24px 22px !important;
      }
      .sofia-card-scrollable::-webkit-scrollbar {
        width: 6px;
      }
      .sofia-card-scrollable::-webkit-scrollbar-thumb {
        background: #CBD5E1;
        border-radius: 4px;
      }
      @keyframes sofiaShake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-10px); }
        40%, 80% { transform: translateX(10px); }
      }
      .sofia-shake {
        animation: sofiaShake 0.45s ease-in-out !important;
      }
      .sofia-user-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        margin-bottom: 14px;
      }
      @media (max-width: 600px) {
        .sofia-user-grid {
          grid-template-columns: 1fr;
        }
      }
      .sofia-user-item {
        font-size: 11.5px;
      }
      .sofia-user-item .label {
        color: #64748B;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 9.5px;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 2px;
      }
      .sofia-user-item .val {
        color: #00131E;
        font-weight: 800;
        font-size: 12.5px;
      }
      .btn-sofia-submit {
        width: 100%;
        background: linear-gradient(135deg, #39A900 0%, #2a7c00 100%);
        color: #FFFFFF;
        border: none;
        padding: 13px 20px;
        border-radius: 12px;
        font-size: 13.5px;
        font-weight: 800;
        font-family: inherit;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 18px rgba(57, 169, 0, 0.4);
        transition: all 0.25s ease;
      }
      .btn-sofia-submit:hover {
        background: linear-gradient(135deg, #43be04 0%, #319400 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(57, 169, 0, 0.55);
      }

      /* ========================================================
         MODAL ACTUALIZACIÓN DE INFORMACIÓN DEL INSTRUCTOR (ESTILO ERP BONITO)
         ======================================================== */
      .modal-backdrop-custom {
        position: fixed;
        inset: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 19, 30, 0.75);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 99999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px 14px;
        overflow-y: auto;
      }
      .modal-backdrop-custom.active {
        display: flex;
        opacity: 1;
        pointer-events: auto;
      }
      .modal-profile-card {
        background: #FFFFFF;
        border-radius: 20px;
        width: 100%;
        max-width: 680px;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(98, 227, 29, 0.25);
        border-top: 5px solid #39A900;
        padding: 0;
        display: flex;
        flex-direction: column;
        animation: profileModalZoom 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      }
      @keyframes profileModalZoom {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
      }
      .modal-profile-card::-webkit-scrollbar {
        width: 6px;
      }
      .modal-profile-card::-webkit-scrollbar-thumb {
        background: #CBD5E1;
        border-radius: 4px;
      }
      .profile-form-section {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 16px 18px;
        margin-bottom: 16px;
      }
      .profile-form-section-title {
        font-size: 12.5px;
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
        gap: 5px;
      }
      .profile-input-group label {
        font-size: 11.5px;
        font-weight: 700;
        color: #334155;
      }
      .profile-input-group input,
      .profile-input-group select {
        width: 100%;
        border: 1px solid #CBD5E1;
        border-radius: 10px;
        padding: 10px 13px;
        font-size: 13px;
        font-family: inherit;
        color: #00131E;
        background: #FFFFFF;
        transition: all 0.2s ease;
      }
      .profile-input-group input:focus,
      .profile-input-group select:focus {
        outline: none;
        border-color: #39A900;
        box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.15);
      }
      .profile-input-readonly {
        background: #F1F5F9 !important;
        color: #64748B !important;
        cursor: not-allowed;
        border-color: #E2E8F0 !important;
      }
      .btn-actualizar-perfil-bonito {
        background: linear-gradient(135deg, #39A900 0%, #2a7c00 100%);
        color: #FFFFFF;
        border: none;
        padding: 13px 26px;
        border-radius: 12px;
        font-size: 13.5px;
        font-weight: 800;
        font-family: inherit;
        letter-spacing: 0.3px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 16px rgba(57, 169, 0, 0.4);
        transition: all 0.25s ease;
      }
      .btn-actualizar-perfil-bonito:hover {
        background: linear-gradient(135deg, #43be04 0%, #319400 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(57, 169, 0, 0.55);
      }
      .btn-actualizar-perfil-bonito:active {
        transform: translateY(0);
      }
      .modal-close-btn-custom {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        z-index: 10;
      }
      .modal-close-btn-custom:hover {
        background: #EF4444;
        border-color: #EF4444;
        color: #fff;
        transform: rotate(90deg);
      }
    </style>
</head>
<body>

<div class="app">

  <!-- SIDEBAR DEL INSTRUCTOR -->
  <aside class="sidebar">
    <a href="{{ route('egresados.welcome') }}" class="brand">
      @include('egresados::partials._sidebar_brand_logo')
      <div>
        <div class="brand-name">
          <span>SIGE</span>
        </div>
        <div class="brand-sub">GESTIÓN DE EGRESADOS</div>
      </div>
    </a>

    <div class="nav-label">General</div>
    <nav>
      <a href="{{ route('egresados.instructor.dashboard') }}" class="active">
        <i class="fa-solid fa-gauge-high"></i>
        <span>Inicio</span>
      </a>
      <a href="{{ route('egresados.instructor.directorio') }}">
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

  <!-- MAIN VIEWPORT -->
  <div class="main">
    
    <!-- Topbar con Notificaciones y Menú de Usuario Unificado -->
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
            ¡Bienvenido(a), <span>{{ Auth::check() ? (Auth::user()->first_name ?? Auth::user()->name ?? 'Instructor(a)') : 'Instructor(a)' }}</span>!
          </h1>
          <p class="page-desc">Monitoreo, consulta y seguimiento de egresados de tus fichas de formación.</p>
        </div>

        <div class="period-pill">
          <i class="fa-regular fa-calendar-days"></i>
          <span>{{ ucfirst(\Carbon\Carbon::now()->locale('es')->translatedFormat('F Y')) }}</span>
        </div>
      </div>

      @if(!empty($debeActualizarPassword))
      <!-- Letrerito Bonito con Colores del ERP: Alerta de Actualización de Contraseña Inicial -->
      <div id="banner-alerta-password-inicial" class="banner-password-erp-card">
        <div class="banner-password-icon-box">
          <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div style="flex:1;">
          <div style="display:flex; align-items:center; gap:8px; margin-bottom:5px;">
            <span style="font-size:10.5px; font-weight:800; color:#62E31D; text-transform:uppercase; letter-spacing:0.5px;">
              <i class="fa-solid fa-lock"></i> SEGURIDAD INSTITUCIONAL · CEFA SENA
            </span>
            <span style="background:rgba(255,255,255,0.12); color:#fff; font-size:10px; font-weight:700; padding:2px 8px; border-radius:12px;">Primer Ingreso</span>
          </div>
          <h3 style="font-family:'Poppins','Nunito',sans-serif; font-size:16px; font-weight:700; margin:0 0 4px 0; color:#fff;">
            ¡Actualización de Contraseña Inicial Requerida!
          </h3>
          <p style="font-size:12.5px; color:rgba(255,255,255,0.82); margin:0;">
            Has iniciado sesión con tu clave temporal (documento de identidad). Para salvaguardar la información institucional, debes asignar una nueva contraseña personal.
          </p>
        </div>
        <div>
          <button type="button" class="btn-actualizar-pwd-erp" onclick="openModalActualizarPasswordInicial()">
            <i class="fa-solid fa-key"></i>
            <span>Actualizar Contraseña Ahora</span>
          </button>
        </div>
      </div>
      @endif

      <!-- ================= SOLICITUDES DE REGISTRO PENDIENTES ================= -->
      @if(!empty($solicitudesPendientes) && count($solicitudesPendientes) > 0)
        <div id="solicitudes-pendientes" class="solicitudes-pendientes-banner" style="background:#fff; border:1.5px solid #f59e0b; border-radius:20px; padding:22px 26px; margin-bottom:28px; box-shadow:0 10px 30px rgba(217, 119, 6, 0.12); position:relative; overflow:hidden;">
          <div style="position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg, #d97706, #f59e0b, #39a900);"></div>
          
          <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:12px;">
            <div style="display:flex; align-items:center; gap:12px;">
              <div style="width:42px; height:42px; border-radius:12px; background:#fef3c7; color:#d97706; display:flex; align-items:center; justify-content:center; font-size:19px; box-shadow:0 4px 10px rgba(217, 119, 6, 0.15);">
                <i class="fa-solid fa-user-clock"></i>
              </div>
              <div>
                <div style="display:flex; align-items:center; gap:8px;">
                  <h3 style="margin:0; font-size:16px; font-weight:800; color:#00131E; font-family:'Poppins',sans-serif;">
                    Solicitudes de Registro Pendientes de Aprobación
                  </h3>
                  <span style="background:#fef3c7; color:#92400e; border:1px solid #fde68a; padding:2px 10px; border-radius:999px; font-size:11px; font-weight:800; display:inline-flex; align-items:center; gap:4px;">
                    <span style="width:6px; height:6px; border-radius:50%; background:#d97706; display:inline-block;"></span>
                    {{ count($solicitudesPendientes) }} pendiente{{ count($solicitudesPendientes) != 1 ? 's' : '' }}
                  </span>
                </div>
                <p style="margin:2px 0 0 0; font-size:12px; color:#64748b;">
                  Egresados que completaron el formulario público y requieren validación institucional antes de poder acceder al portal.
                </p>
              </div>
            </div>
          </div>

          <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(320px, 1fr)); gap:14px;">
            @foreach($solicitudesPendientes as $sol)
              <div id="sol-card-inst-{{ $sol['id'] }}" data-sol-nombre="{{ $sol['nombre'] ?? 'Egresado' }}" data-sol-documento="{{ $sol['documento'] ?? '' }}" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:14px; padding:16px; display:flex; flex-direction:column; justify-content:space-between; gap:12px; transition:all 0.2s ease;">
                <div>
                  <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:10px; margin-bottom:8px;">
                    <div style="display:flex; align-items:center; gap:10px;">
                      <div style="width:36px; height:36px; border-radius:10px; background:#eaf7ee; color:#39A900; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:13px;">
                        {{ strtoupper(substr($sol['nombre'] ?? 'EG', 0, 2)) }}
                      </div>
                      <div>
                        <div style="font-weight:800; font-size:13.5px; color:#00131E; line-height:1.2;">
                          {{ $sol['nombre'] ?? 'Egresado' }}
                        </div>
                        <div style="font-size:11.5px; color:#64748b; font-family:monospace;">
                          CC/TI: {{ $sol['documento'] ?? 'N/D' }}
                        </div>
                      </div>
                    </div>
                    <span style="background:#fef3c7; color:#92400e; font-size:10px; font-weight:700; padding:2px 7px; border-radius:6px; border:1px solid #fde68a;">
                      En Revisión
                    </span>
                  </div>

                  <div style="font-size:11.5px; color:#475569; display:flex; flex-direction:column; gap:4px; margin-top:8px; padding-top:8px; border-top:1px dashed #e2e8f0;">
                    <div><strong style="color:#00131E;">Programa:</strong> {{ $sol['programa'] ?? 'CEFA La Angostura' }}</div>
                    <div><strong style="color:#00131E;">Correo:</strong> {{ $sol['email'] ?? 'N/D' }}</div>
                    @if(!empty($sol['telefono']))
                      <div><strong style="color:#00131E;">Teléfono:</strong> {{ $sol['telefono'] }}</div>
                    @endif
                    <div style="font-size:10.5px; color:#94a3b8; margin-top:2px;">
                      <i class="fa-regular fa-clock"></i> Solicitado: {{ $sol['fecha'] ?? 'Recientemente' }}
                    </div>
                  </div>
                </div>

                <div style="display:flex; gap:8px; margin-top:4px; padding-top:10px; border-top:1px solid #e2e8f0;">
                  <button type="button" onclick="aprobarSolicitudInstructor('{{ $sol['id'] }}', this)" style="flex:1; background:linear-gradient(135deg, #16a34a, #15803d); color:#ffffff; border:none; padding:8px 12px; border-radius:9px; font-size:12px; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; justify-content:center; gap:6px; box-shadow:0 3px 8px rgba(22,163,74,0.25); transition:all 0.15s ease;">
                    <i class="fa-solid fa-check"></i>
                    <span>Aprobar Registro</span>
                  </button>
                  <button type="button" onclick="rechazarSolicitudInstructor('{{ $sol['id'] }}', this)" title="Rechazar solicitud" style="background:#fee2e2; color:#991b1b; border:1px solid #fca5a5; padding:8px 12px; border-radius:9px; font-size:12px; font-weight:600; cursor:pointer; transition:all 0.15s ease;">
                    <i class="fa-solid fa-xmark"></i>
                  </button>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <!-- Stats Grid (5 Cards sincronizadas con los módulos del ERP) -->
      <div class="stats-grid">
        
        <!-- Card 1: Total Egresados de Fichas -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon green">
              <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div class="stat-title">Total egresados fichas</div>
          </div>
          <div class="stat-value">
            {{ number_format($totalEgresados ?? 0) }}
          </div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-arrow-trend-up"></i>
              <span>↑ Registros en sistema</span>
            </div>
            <a href="{{ route('egresados.instructor.directorio') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 2: Fichas Asignadas -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon blue">
              <i class="fa-solid fa-layer-group"></i>
            </div>
            <div class="stat-title">Fichas asignadas</div>
          </div>
          <div class="stat-value">
            {{ number_format($totalFichas ?? 6) }}
          </div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-circle-check"></i>
              <span>En seguimiento activo</span>
            </div>
            <a href="{{ route('egresados.instructor.directorio') }}" class="stat-link">
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
            <a href="{{ route('egresados.instructor.encuestas.index') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 4: Eventos Programados -->
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
            <a href="{{ route('egresados.instructor.eventos.index') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 5: Reportes Generados -->
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
            <a href="{{ route('egresados.instructor.reportes.index') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- Lower Grid: Gráficas Resumidas 3D del Software (Colores ERP) -->
      @php
        $progLabels = [];
        $progValues = [];
        if (isset($programStats) && count($programStats) > 0) {
            foreach ($programStats as $prog) {
                $progLabels[] = \Illuminate\Support\Str::limit($prog->name, 26);
                $progValues[] = (int) $prog->total;
            }
        } else {
            $progLabels = ['Gestión Agroempresarial', 'ADSO', 'Producción Acuícola'];
            $progValues = [3, 2, 1];
        }
      @endphp
      <div class="lower-grid">

        <!-- Gráfica 1: Estadísticas de SIGE -->
        <div class="panel">
          <div class="panel-head" style="margin-bottom:10px; padding-bottom:10px;">
            <h3 class="panel-title" style="font-size:16px;">
              <i class="fa-solid fa-chart-column text-[#39A900]"></i>
              <span>Estadísticas de SIGE</span>
            </h3>
            <a href="{{ route('egresados.instructor.reportes.index') }}" class="panel-action">Ver reportes</a>
          </div>
          <div id="instResumenBarChart" class="chart-wrap-compact"></div>
        </div>

        <!-- Gráfica 2: Estadísticas por Programa -->
        <div class="panel">
          <div class="panel-head" style="margin-bottom:10px; padding-bottom:10px;">
            <h3 class="panel-title" style="font-size:16px;">
              <i class="fa-solid fa-chart-pie text-[#39A900]"></i>
              <span>Estadísticas por Programa</span>
            </h3>
            <a href="{{ route('egresados.instructor.directorio') }}" class="panel-action">Ver todo</a>
          </div>
          <div id="instProgramasDonutChart" class="chart-wrap-compact"></div>
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
    
    <!-- Encabezado Institucional estilo SOFIA PLUS con Colores ERP (Fijo) -->
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

    <!-- Formulario de Actualización de Contraseña con Scroll Ergonómico -->
    <form id="formActualizarPasswordInicial" action="{{ route('egresados.cambiar_password') }}" method="POST" enctype="multipart/form-data" onsubmit="submitActualizarPasswordInicial(event)" style="display:flex; flex-direction:column; overflow:hidden; margin:0;">
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

        <!-- Ficha de Identificación del Usuario (Tipo SOFIA Plus) -->
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
              {{ Auth::check() && Auth::user()->person ? (Auth::user()->person->first_name . ' ' . Auth::user()->person->first_last_name) : (Auth::user()->name ?? 'Instructor(a) CEFA') }}
            </span>
          </div>
        </div>

        <!-- Mensajes de Alerta -->
        <div id="alert-password-error" style="display:none; background:#FEF2F2; border:1px solid #FCA5A5; color:#991B1B; padding:10px 14px; border-radius:10px; font-size:12px; margin-bottom:12px; font-weight:600;"></div>
        <div id="alert-password-success" style="display:none; background:#F0FDF4; border:1px solid #BBF7D0; color:#166534; padding:10px 14px; border-radius:10px; font-size:12px; margin-bottom:12px; font-weight:700;"></div>

        <!-- 1. Primera Contraseña (Documento) -->
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

        <!-- 4. Foto Institucional del Instructor -->
        @include('egresados::partials._onboarding_photo_field', [
            'fieldId' => 'pwd_foto_perfil',
            'previewId' => 'pwd_foto_preview',
            'person' => $person ?? (Auth::check() ? Auth::user()->person : null),
            'roleLabel' => 'Instructor(a)'
        ])

        <!-- Reglas estilo SOFIA PLUS -->
        <div class="erp-security-tips" style="margin-bottom: 16px; background:#F8FAFC; border:1px solid #E2E8F0; border-radius:8px; padding:8px 12px;">
          <strong style="color:#00131E; font-size:11px; display:inline-flex; align-items:center; gap:5px;">
            <i class="fa-solid fa-list-check" style="color:#39A900;"></i> Requisitos mínimos:
          </strong>
          <span style="font-size:11px; color:#475569; margin-left:6px;">
            Mínimo 6 caracteres · Distinta a tu documento · Deben coincidir.
          </span>
        </div>

        <!-- Botón Principal Sofia Plus (Ancho Completo, SIEMPRE VISIBLE) -->
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

<!-- ========================================================
     MODAL ACTUALIZACIÓN DE INFORMACIÓN DEL INSTRUCTOR (ESTILO ERP BONITO)
     ======================================================== -->
<div class="modal-backdrop-custom" id="modalActualizarPerfilInstructor" onclick="if(event.target===this)closeModalActualizarPerfilInstructor()">
  <div class="modal-profile-card" onclick="event.stopPropagation()">
    
    <!-- Botón de Cerrar (X) -->
    <button type="button" class="modal-close-btn-custom" onclick="closeModalActualizarPerfilInstructor()" title="Cerrar ventana">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Banner Encabezado Oficial SIGE ERP -->
    <div style="background: linear-gradient(135deg, #00131E 0%, #002336 100%); padding: 22px 26px; color: #fff; position: relative; border-bottom: 3px solid #39A900;">
      <div style="display:inline-flex; align-items:center; gap:6px; background:rgba(98, 227, 29, 0.15); border:1px solid #62E31D; color:#62E31D; font-size:10.5px; font-weight:800; padding:2.5px 10px; border-radius:20px; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px;">
        <i class="fa-solid fa-user-pen"></i> PANEL DE ADMINISTRACIÓN · INSTRUCTOR CEFA
      </div>
      <h3 style="font-family:'Poppins','Nunito',sans-serif; font-size:19px; font-weight:800; color:#fff; margin:0 0 5px 0; line-height:1.3;">
        Actualizar mi Información de Instructor
      </h3>
      <p style="font-size:12px; color:rgba(255,255,255,0.85); margin:0; line-height:1.4;">
        Mantén tus datos personales, de contacto y credenciales de acceso al día en el sistema SIGE ERP.
      </p>
    </div>

    <!-- Formulario de Actualización -->
    <form id="formActualizarPerfilInstructor" action="{{ route('egresados.perfil.actualizar') }}" method="POST" enctype="multipart/form-data" onsubmit="submitActualizarPerfilInstructor(event)" style="padding: 22px 26px; display:flex; flex-direction:column; gap:0; margin:0;">
      @csrf

      <!-- Mensajes de Alerta -->
      <div id="alert-instructor-profile-error" style="display:none; background:#FEF2F2; border:1px solid #FCA5A5; color:#991B1B; padding:12px 16px; border-radius:12px; font-size:12.5px; margin-bottom:16px; font-weight:600;"></div>
      <div id="alert-instructor-profile-success" style="display:none; background:#F0FDF4; border:1px solid #BBF7D0; color:#166534; padding:12px 16px; border-radius:12px; font-size:12.5px; margin-bottom:16px; font-weight:700;"></div>

      @include('egresados::partials._onboarding_photo_field', [
          'fieldId' => 'inst_foto_perfil',
          'previewId' => 'inst_foto_preview',
          'person' => $person ?? (Auth::check() ? Auth::user()->person : null),
          'roleLabel' => 'Instructor(a)'
      ])

      <!-- Sección 1: Identificación y Rol Institucional -->
      <div class="profile-form-section">
        <div class="profile-form-section-title">
          <i class="fa-solid fa-id-card" style="color:var(--sena-green);"></i>
          <span>1. Datos de Identificación y Rol Institucional</span>
        </div>
        <div class="profile-form-grid">
          <div class="profile-input-group">
            <label>Número de Documento (Cédula) <span style="font-size:10px; color:#16a34a; font-weight:700;">✓ Verificado</span></label>
            <div style="position:relative;">
              <input type="text" value="{{ $person->document_number ?? (Auth::check() && Auth::user()->person ? Auth::user()->person->document_number : (preg_replace('/\D/', '', Auth::user()->nickname ?? '') ?: '10000002')) }}" class="profile-input-readonly" readonly title="Documento registrado en el sistema ERP">
              <i class="fa-solid fa-lock" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:12px;"></i>
            </div>
          </div>
          <div class="profile-input-group">
            <label>Tipo de Documento</label>
            <input type="text" value="{{ $person->document_type ?? (Auth::check() && Auth::user()->person ? Auth::user()->person->document_type : 'Cédula de Ciudadanía (CC)') }}" class="profile-input-readonly" readonly>
          </div>
          <div class="profile-input-group">
            <label>Nombres <span style="color:#ef4444;">*</span></label>
            <input type="text" name="nombres" id="inst_nombres" required value="{{ old('nombres', $person->first_name ?? (Auth::check() && Auth::user()->person ? Auth::user()->person->first_name : (Auth::user()->name ?? 'Carlos'))) }}" placeholder="Ej. Carlos">
          </div>
          <div class="profile-input-group">
            <label>Apellidos <span style="color:#ef4444;">*</span></label>
            <input type="text" name="apellidos" id="inst_apellidos" required value="{{ old('apellidos', trim(($person->first_last_name ?? '') . ' ' . ($person->second_last_name ?? '')) ?: (Auth::check() && Auth::user()->person ? trim(Auth::user()->person->first_last_name . ' ' . (Auth::user()->person->second_last_name ?? '')) : 'Mendoza')) }}" placeholder="Ej. Mendoza">
          </div>
          <div class="profile-input-group" style="grid-column: 1 / -1;">
            <label>Rol / Asignación en el Sistema</label>
            <div style="background:#EAF7EE; border:1px solid #BBF7D0; color:#166534; padding:9px 14px; border-radius:10px; font-size:12.5px; font-weight:700; display:flex; align-items:center; gap:8px;">
              <i class="fa-solid fa-shield-halved" style="color:#39A900;"></i>
              <span>Instructor de Seguimiento a Egresados · Centro de Formación Agroindustrial "La Angostura"</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Sección 2: Información de Contacto -->
      <div class="profile-form-section">
        <div class="profile-form-section-title">
          <i class="fa-solid fa-address-book" style="color:var(--sena-green);"></i>
          <span>2. Canales de Contacto y Ubicación</span>
        </div>
        <div class="profile-form-grid">
          <div class="profile-input-group">
            <label>Correo Electrónico Institucional / Principal <span style="color:#ef4444;">*</span></label>
            <input type="email" name="personal_email" id="inst_personal_email" required value="{{ old('personal_email', $person->personal_email ?? (Auth::user()->email ?? 'instructor.egresados@sena.edu.co')) }}" placeholder="instructor.egresados@sena.edu.co">
          </div>
          <div class="profile-input-group">
            <label>Correo MiSENA / Alternativo (Opcional)</label>
            <input type="email" name="misena_email" id="inst_misena_email" value="{{ old('misena_email', $person->misena_email ?? '') }}" placeholder="cmendoza@misena.edu.co">
          </div>
          <div class="profile-input-group">
            <label>Celular / WhatsApp de Contacto <span style="color:#ef4444;">*</span></label>
            <input type="tel" name="telefono" id="inst_telefono" required value="{{ old('telefono', $person->telephone1 ?? '3124567890') }}" placeholder="Ej. 3124567890">
          </div>
          <div class="profile-input-group">
            <label>Teléfono Fijo / Extensión SENA (Opcional)</label>
            <input type="tel" name="telefono2" id="inst_telefono2" value="{{ old('telefono2', $person->telephone2 ?? '') }}" placeholder="Ej. Ext 82345">
          </div>
          <div class="profile-input-group" style="grid-column: 1 / -1;">
            <label>Sede o Dirección de Residencia Actual</label>
            <input type="text" name="direccion" id="inst_direccion" value="{{ old('direccion', $person->address ?? 'CEFA La Angostura, Km 38 Vía Neiva - Campoalegre') }}" placeholder="Ej. CEFA La Angostura, Campoalegre - Huila">
          </div>
        </div>
      </div>

      <!-- Sección 3: Seguridad y Contraseña (Opcional) -->
      <div class="profile-form-section" style="border-left: 3px solid #39A900;">
        <div class="profile-form-section-title">
          <i class="fa-solid fa-key" style="color:var(--sena-green);"></i>
          <span>3. Seguridad y Cambio de Contraseña (Opcional)</span>
        </div>
        <p style="font-size:11.5px; color:#64748B; margin:0 0 10px 0;">
          Si deseas cambiar tu contraseña personal, digítala aquí. Si la dejas vacía, se mantendrá tu contraseña actual sin cambios.
        </p>
        <div class="profile-form-grid">
          <div class="profile-input-group">
            <label>Nueva Contraseña</label>
            <div class="input-password-wrapper">
              <input type="password" name="password" id="inst_password" placeholder="Mínimo 6 caracteres" autocomplete="new-password" oninput="checkInstructorPasswordMatch()">
              <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('inst_password', this)" title="Ver u ocultar contraseña">
                <i class="fa-regular fa-eye"></i>
              </button>
            </div>
          </div>
          <div class="profile-input-group">
            <label>Confirmar Nueva Contraseña</label>
            <div class="input-password-wrapper">
              <input type="password" name="password_confirmation" id="inst_password_confirmation" placeholder="Repite la nueva contraseña" autocomplete="new-password" oninput="checkInstructorPasswordMatch()">
              <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('inst_password_confirmation', this)" title="Ver u ocultar contraseña">
                <i class="fa-regular fa-eye"></i>
              </button>
            </div>
          </div>
        </div>
        <div id="inst-password-match-status" class="pwd-match-status" style="display:none;"></div>
      </div>

      <!-- Botones de Acción con el Botón Bonito -->
      <div style="display:flex; justify-content:flex-end; gap:12px; align-items:center; margin-top:10px; padding-top:14px; border-top:1px solid #E2E8F0;">
        <button type="button" onclick="closeModalActualizarPerfilInstructor()" style="background:#F1F5F9; border:1px solid #CBD5E1; color:#475569; padding:12px 20px; border-radius:12px; font-weight:700; font-size:13px; cursor:pointer; font-family:inherit; transition:all 0.2s ease;">
          Cancelar
        </button>
        <button type="submit" id="btn-submit-instructor-profile" class="btn-actualizar-perfil-bonito">
          <i class="fa-solid fa-floppy-disk"></i>
          <span>Guardar y Actualizar Información</span>
        </button>
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
      const modalProfile = document.getElementById('modalActualizarPerfilInstructor');
      if (modalProfile && modalProfile.classList.contains('active')) {
        closeModalActualizarPerfilInstructor();
        return;
      }
      const modal = document.getElementById('modalActualizarPasswordInicial');
      if (modal && modal.classList.contains('active')) {
        e.preventDefault();
        shakeSofiaModal();
      }
    }
  });

  // Control de Modal de Actualización de Información del Instructor
  function openModalActualizarPerfilInstructor() {
    const modal = document.getElementById('modalActualizarPerfilInstructor');
    if (modal) {
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
      const errBox = document.getElementById('alert-instructor-profile-error');
      const sucBox = document.getElementById('alert-instructor-profile-success');
      if (errBox) errBox.style.display = 'none';
      if (sucBox) sucBox.style.display = 'none';
    }
  }

  function closeModalActualizarPerfilInstructor() {
    const modal = document.getElementById('modalActualizarPerfilInstructor');
    if (modal) {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }
  }

  function checkInstructorPasswordMatch() {
    const p1 = document.getElementById('inst_password');
    const p2 = document.getElementById('inst_password_confirmation');
    const status = document.getElementById('inst-password-match-status');
    if (!p1 || !p2 || !status) return;

    if (!p1.value && !p2.value) {
      status.style.display = 'none';
      return;
    }

    status.style.display = 'flex';
    if (p1.value && p2.value && p1.value === p2.value) {
      status.className = 'pwd-match-status ok';
      status.innerHTML = '<i class="fa-solid fa-check-circle"></i> Las contraseñas coinciden';
    } else {
      status.className = 'pwd-match-status err';
      status.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> Las contraseñas no coinciden aún';
    }
  }

  function submitActualizarPerfilInstructor(e) {
    e.preventDefault();
    const form = document.getElementById('formActualizarPerfilInstructor');
    const btn = document.getElementById('btn-submit-instructor-profile');
    const errBox = document.getElementById('alert-instructor-profile-error');
    const sucBox = document.getElementById('alert-instructor-profile-success');

    const nombres = document.getElementById('inst_nombres').value.trim();
    const apellidos = document.getElementById('inst_apellidos').value.trim();
    const email = document.getElementById('inst_personal_email').value.trim();
    const tel = document.getElementById('inst_telefono').value.trim();
    const pwd = document.getElementById('inst_password').value.trim();
    const pwdConf = document.getElementById('inst_password_confirmation').value.trim();

    if (!nombres || !apellidos || !email || !tel) {
      errBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Por favor completa los campos obligatorios marcados con asterisco (*).';
      errBox.style.display = 'block';
      errBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      return;
    }

    if (pwd && (pwd.length < 6 || pwd !== pwdConf)) {
      errBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Si deseas cambiar la contraseña, debe tener al menos 6 caracteres y coincidir exactamente.';
      errBox.style.display = 'block';
      errBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      return;
    }

    errBox.style.display = 'none';
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando cambios...';

    fetch(form.action, {
      method: 'POST',
      body: new FormData(form),
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    })
    .then(res => res.json().then(data => ({ status: res.status, ok: res.ok, data })))
    .then(({ status, ok, data }) => {
      if (ok && data.success) {
        sucBox.innerHTML = '<i class="fa-solid fa-circle-check"></i> ' + (data.message || '¡Información actualizada con éxito!');
        sucBox.style.display = 'block';
        btn.innerHTML = '<i class="fa-solid fa-check"></i> ¡Información Actualizada con Éxito!';
        btn.style.background = 'linear-gradient(135deg, #16a34a 0%, #15803d 100%)';

        // Actualizar visualmente el chip de usuario si cambió el nombre
        const userChipSpan = document.querySelector('#userChipBtn span');
        if (userChipSpan) {
          userChipSpan.textContent = nombres + ' ' + apellidos;
        }
        const userMenuName = document.querySelector('.user-menu-name');
        if (userMenuName) {
          userMenuName.textContent = nombres + ' ' + apellidos;
        }
        if (data.data && data.data.avatar_url && typeof window.updateTopbarAvatar === 'function') {
          window.updateTopbarAvatar(data.data.avatar_url);
        }

        setTimeout(() => {
          closeModalActualizarPerfilInstructor();
          btn.disabled = false;
          btn.innerHTML = originalText;
          btn.style.background = '';
        }, 1200);
      } else {
        btn.disabled = false;
        btn.innerHTML = originalText;
        errBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> ' + (data.message || 'Error al guardar los datos.');
        errBox.style.display = 'block';
        errBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    })
    .catch(err => {
      form.submit();
    });
  }

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
    const banner = document.getElementById('banner-alerta-password-inicial');

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
      if (ok && data.success) {
        sucBox.innerHTML = '<i class="fa-solid fa-circle-check"></i> ' + (data.message || '¡Contraseña actualizada con éxito! Entrando al sistema...');
        sucBox.style.display = 'block';
        btn.innerHTML = '<i class="fa-solid fa-check"></i> ¡Listo! Entrando al sistema...';
        btn.style.background = '#16a34a';

        if (banner) {
          banner.style.transition = 'all 0.5s ease';
          banner.style.opacity = '0';
          setTimeout(() => { banner.remove(); }, 500);
        }
        setTimeout(() => { 
          window.location.href = "{{ route('egresados.dashboard_instructor') }}";
        }, 700);
      } else {
        btn.disabled = false;
        btn.innerHTML = originalText;
        errBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> ' + (data.message || 'Error al actualizar contraseña.');
        errBox.style.display = 'block';
        errBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    })
    .catch(err => {
      form.submit();
    });
  }

  function aprobarSolicitudInstructor(solId, btn) {
    if (typeof window.handleSolicitudRegistro === 'function') {
      window.handleSolicitudRegistro('aprobar', solId, btn);
    }
  }

  function rechazarSolicitudInstructor(solId, btn) {
    if (typeof window.handleSolicitudRegistro === 'function') {
      window.handleSolicitudRegistro('rechazar', solId, btn);
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    @if(!empty($debeActualizarPassword))
      document.body.style.overflow = 'hidden';
      openModalActualizarPasswordInicial();
    @endif

    if (typeof Highcharts !== 'undefined') {
      const erpPalette = ['#39A900', '#001A29', '#2d8500', '#00324D', '#62E31D'];

      const barEl = document.getElementById('instResumenBarChart');
      if (barEl) {
        Highcharts.chart(barEl, {
          chart: {
            type: 'column',
            backgroundColor: 'transparent',
            height: 225,
            margin: [22, 16, 36, 34],
            style: { fontFamily: 'Poppins, Nunito, sans-serif' },
            options3d: {
              enabled: true,
              alpha: 10,
              beta: 14,
              depth: 45,
              viewDistance: 25
            }
          },
          title: { text: null },
          credits: { enabled: false },
          legend: { enabled: false },
          xAxis: {
            categories: ['Egresados', 'Fichas', 'Encuestas', 'Eventos', 'Reportes'],
            labels: {
              style: { color: '#00131E', fontSize: '10px', fontWeight: '600' }
            },
            gridLineColor: 'rgba(0, 19, 30, 0.05)'
          },
          yAxis: {
            allowDecimals: false,
            title: { text: null },
            labels: {
              style: { color: '#5A6E7D', fontSize: '9.5px', fontWeight: '600' }
            },
            gridLineColor: 'rgba(0, 19, 30, 0.06)'
          },
          tooltip: {
            backgroundColor: '#00131E',
            borderColor: '#39A900',
            borderRadius: 8,
            style: { color: '#ffffff', fontSize: '11px' },
            headerFormat: '<span style="color:#62E31D; font-weight:700; font-size:10.5px;">{point.key}</span><br/>',
            pointFormat: 'Total: <b>{point.y}</b>'
          },
          plotOptions: {
            column: {
              depth: 32,
              colorByPoint: true,
              colors: erpPalette,
              borderWidth: 0,
              dataLabels: {
                enabled: true,
                y: -4,
                style: {
                  fontSize: '10px',
                  fontWeight: '700',
                  color: '#00131E',
                  textOutline: 'none'
                }
              }
            }
          },
          series: [{
            name: 'Registros',
            data: [
              {{ (int) ($totalEgresados ?? 0) }},
              {{ (int) ($totalFichas ?? 0) }},
              {{ (int) ($totalEncuestas ?? 0) }},
              {{ (int) ($totalEventos ?? 0) }},
              {{ (int) ($totalReportes ?? 0) }}
            ]
          }]
        });
      }

      const donutEl = document.getElementById('instProgramasDonutChart');
      if (donutEl) {
        const progLabels = @json($progLabels);
        const progValues = @json($progValues);
        const pieData = progLabels.map((lbl, idx) => ({
          name: lbl,
          y: progValues[idx] || 0
        }));

        Highcharts.chart(donutEl, {
          chart: {
            type: 'pie',
            backgroundColor: 'transparent',
            height: 225,
            spacing: [8, 8, 8, 8],
            style: { fontFamily: 'Poppins, Nunito, sans-serif' },
            options3d: {
              enabled: true,
              alpha: 42,
              beta: 0
            }
          },
          title: { text: null },
          credits: { enabled: false },
          tooltip: {
            backgroundColor: '#00131E',
            borderColor: '#39A900',
            borderRadius: 8,
            style: { color: '#ffffff', fontSize: '11px' },
            pointFormat: '<b>{point.y}</b> egresado(s) ({point.percentage:.0f}%)'
          },
          legend: {
            align: 'right',
            verticalAlign: 'middle',
            layout: 'vertical',
            margin: 24,
            padding: 6,
            symbolRadius: 4,
            symbolHeight: 8,
            symbolWidth: 8,
            symbolPadding: 8,
            itemMarginTop: 4,
            itemMarginBottom: 8,
            itemStyle: {
              color: '#00131E',
              fontSize: '10px',
              fontWeight: '600'
            }
          },
          plotOptions: {
            pie: {
              center: ['50%', '50%'],
              size: '86%',
              innerSize: '50%',
              depth: 26,
              colors: ['#39A900', '#001A29', '#62E31D', '#00324D'],
              showInLegend: true,
              dataLabels: {
                enabled: true,
                distance: -16,
                format: '{point.y}',
                style: {
                  fontSize: '9.5px',
                  fontWeight: '800',
                  color: '#ffffff',
                  textOutline: '1px rgba(0, 19, 30, 0.7)'
                }
              }
            }
          },
          series: [{
            name: 'Egresados',
            data: pieData
          }]
        });
      }
    }
  });
</script>
@include('egresados::superadmin.partials._modal_alertas')
</body>
</html>
