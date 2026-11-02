<!DOCTYPE html>
<html lang="es" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Directorio de Egresados — Instructor</title>

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

      * { box-sizing: border-box; }
      html { scroll-behavior: smooth; }
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

      /* ---------------- SIDEBAR ---------------- */
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
      nav a i {
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
        background: var(--green);
        color: #ffffff;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(57, 169, 0, 0.4);
      }
      nav a.active i {
        color: #ffffff;
      }

      /* ---------------- MAIN ---------------- */
      .main {
        display: flex;
        flex-direction: column;
        min-width: 0;
        animation: sigeFadeIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
      }
      @keyframes sigeFadeIn {
        from { opacity: 0; transform: translateY(4px); }
        to { opacity: 1; transform: translateY(0); }
      }

      .topbar {
        background: linear-gradient(90deg, #00131E 0%, #001A29 60%, #002336 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 36px;
        border-bottom: 3px solid #39A900;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
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
        background: rgba(57, 169, 0, 0.2);
        border: 1px solid #39A900;
        color: #ffffff;
        font-size: 12px;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 999px;
        text-decoration: none;
        transition: all 0.2s ease;
      }
      .portal-link-btn:hover {
        background: var(--green);
        border-color: #62E31D;
        box-shadow: 0 2px 10px rgba(57, 169, 0, 0.4);
        color: #ffffff;
      }

      .topbar-right {
        display: flex;
        align-items: center;
        gap: 16px;
      }

      .btn-new {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #39A900 0%, #2d8500 100%);
        color: #ffffff;
        font-size: 12px;
        font-weight: 700;
        padding: 7px 16px;
        border-radius: 999px;
        text-decoration: none;
        border: 1px solid rgba(98, 227, 29, 0.4);
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(57, 169, 0, 0.35);
      }
      .btn-new:hover {
        background: #2a7c00;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(57, 169, 0, 0.45);
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
        background: rgba(57, 169, 0, 0.25);
        color: #62E31D;
        transform: translateY(-1px);
      }
      .icon-btn .dot {
        position: absolute;
        top: 6px;
        right: 7px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #62E31D;
        border: 1.5px solid var(--forest);
      }

      .user-chip {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        padding: 4px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        transition: all 0.2s ease;
        color: #ffffff;
        user-select: none;
      }
      .user-chip:hover {
        background: rgba(57, 169, 0, 0.2);
        border-color: rgba(98, 227, 29, 0.4);
      }
      .user-dropdown-wrapper {
        position: relative;
      }
      .user-dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        min-width: 230px;
        background: #001A29;
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-top: 2px solid var(--green);
        border-radius: 14px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.45);
        padding: 6px 0;
        z-index: 1000;
        backdrop-filter: blur(10px);
      }
      .user-dropdown-menu.show {
        display: block;
        animation: dropFade 0.15s ease-out;
      }
      @keyframes dropFade {
        from { opacity: 0; transform: translateY(-6px); }
        to { opacity: 1; transform: translateY(0); }
      }
      .user-dropdown-header {
        padding: 10px 16px 8px;
      }
      .user-dropdown-name {
        font-weight: 700;
        font-size: 13.5px;
        color: #ffffff;
      }
      .user-dropdown-role {
        font-size: 10.5px;
        font-weight: 700;
        color: var(--moss);
        text-transform: uppercase;
        margin-top: 2px;
        letter-spacing: 0.4px;
      }
      .user-dropdown-email {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.6);
        margin-top: 2px;
      }
      .user-dropdown-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.08);
        margin: 5px 0;
      }
      .user-dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 16px;
        font-size: 12.5px;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        font-family: inherit;
        font-weight: 600;
        transition: all 0.15s;
      }
      .user-dropdown-item i {
        width: 16px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.6);
      }
      .user-dropdown-item:hover {
        background: rgba(57, 169, 0, 0.18);
        color: #62E31D;
      }
      .user-dropdown-item:hover i {
        color: #62E31D;
      }
      .user-dropdown-item.logout-item {
        color: #FCA5A5;
      }
      .user-dropdown-item.logout-item i {
        color: #F87171;
      }
      .user-dropdown-item.logout-item:hover {
        background: rgba(220, 38, 38, 0.2);
        color: #ffffff;
      }
      .user-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #39A900 0%, #002336 100%);
        border: 1.5px solid #62E31D;
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
        font-weight: 800;
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
        gap: 12px;
      }
      .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--green-soft);
        color: var(--green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
        border: 1px solid var(--green-soft-border);
      }
      .stat-icon.muted-icon {
        background: #F8FAFC;
        color: #64748B;
        border-color: #E2E8F0;
      }

      .stat-title {
        font-size: 13.5px;
        color: var(--ink-soft);
        font-weight: 600;
      }
      .stat-value {
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-weight: 800;
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
        display: flex;
        align-items: center;
        gap: 5px;
      }
      .stat-trend.green { color: var(--green); }
      .stat-trend.muted { color: #64748B; }
      .stat-link {
        font-size: 12.5px;
        color: var(--forest);
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: color 0.15s ease;
      }
      .stat-link:hover {
        color: var(--green);
        text-decoration: underline;
      }

      /* Directorio grid layout */
      .dir-grid {
        display: grid;
        grid-template-columns: 1.7fr 1fr;
        gap: 24px;
        align-items: start;
      }

      .panel {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        overflow: hidden;
      }
      .panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 22px 14px;
        border-bottom: 1px solid var(--line);
        flex-wrap: wrap;
        gap: 10px;
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
        font-size: 12px;
        background: var(--green-soft);
        color: var(--green-badge-text);
        border: 1px solid var(--green-soft-border);
        padding: 3px 10px;
        border-radius: 999px;
        font-weight: 700;
      }

      /* Filter bar */
      .filter-bar {
        padding: 14px 22px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        background: #FAFCFB;
        border-bottom: 1px solid var(--line);
      }
      .filter-input {
        flex: 1;
        min-width: 180px;
        padding: 8px 12px 8px 34px;
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 12.5px;
        font-family: 'Poppins', 'Nunito', sans-serif;
        color: var(--ink);
        outline: none;
        transition: border-color 0.2s;
      }
      .filter-input:focus {
        border-color: var(--green);
      }
      .filter-input-wrap {
        position: relative;
        flex: 1;
        min-width: 180px;
      }
      .filter-input-wrap i {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--ink-soft);
        font-size: 12px;
      }
      .filter-select {
        padding: 8px 12px;
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 12.5px;
        font-family: 'Poppins', 'Nunito', sans-serif;
        color: var(--ink);
        outline: none;
        cursor: pointer;
        min-width: 200px;
      }
      .filter-select:focus {
        border-color: var(--green);
      }
      .btn-filter {
        background: linear-gradient(135deg, #39A900 0%, #2d8500 100%);
        color: #ffffff;
        border: none;
        padding: 8px 18px;
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 700;
        font-family: 'Poppins', 'Nunito', sans-serif;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 6px rgba(57, 169, 0, 0.25);
      }
      .btn-filter:hover {
        background: #2a7c00;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(57, 169, 0, 0.35);
      }
      .btn-clear {
        background: none;
        border: none;
        padding: 8px 12px;
        color: var(--ink-soft);
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        font-family: 'Poppins', 'Nunito', sans-serif;
        transition: color 0.2s;
        text-decoration: none;
      }
      .btn-clear:hover {
        color: #DC2626;
      }

      /* Table custom */
      .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 13px;
      }
      .table-custom th {
        background: #F9FBFA;
        color: var(--ink-soft);
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 12px 14px;
        border-bottom: 1px solid var(--line);
        text-align: left;
      }
      .table-custom td {
        padding: 13px 14px;
        border-bottom: 1px solid var(--line);
        color: var(--ink);
        vertical-align: middle;
      }
      .table-custom tr:last-child td {
        border-bottom: none;
      }
      .table-custom tbody tr {
        cursor: pointer;
        transition: background 0.15s ease;
      }
      .table-custom tbody tr:hover td {
        background: rgba(57, 169, 0, 0.04);
      }
      .table-custom tbody tr.row-active td {
        background: rgba(57, 169, 0, 0.08);
      }

      .badge-status {
        display: inline-flex;
        align-items: center;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
      }
      .badge-green { background: #EAF7EE; color: #166534; border: 1px solid #BBF7D0; }
      .badge-blue { background: #EBF3FF; color: #1E40AF; border: 1px solid #BFDBFE; }
      .badge-amber { background: #FEF7EA; color: #B45309; border: 1px solid #FDE68A; }
      .badge-purple { background: #F5EFFF; color: #6D28D9; border: 1px solid #DDD6FE; }

      .action-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--forest);
        color: #ffffff;
        text-decoration: none;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        font-size: 13px;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0, 26, 41, 0.2);
      }
      .action-icon:hover {
        background: var(--green);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(57, 169, 0, 0.3);
      }

      /* Detail panel (sticky sidebar) */
      .detail-panel {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        position: sticky;
        top: 24px;
      }
      .detail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--line);
        margin-bottom: 18px;
      }
      .detail-header-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--ink-soft);
      }
      .detail-status-pill {
        padding: 3px 10px;
        font-size: 10px;
        font-weight: 800;
        border-radius: 999px;
        text-transform: uppercase;
      }
      .detail-avatar-section {
        text-align: center;
        padding-bottom: 16px;
      }
      .detail-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: var(--green-soft);
        color: var(--green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-weight: 800;
        font-size: 20px;
        margin: 0 auto 10px;
        border: 2px solid rgba(57, 169, 0, 0.3);
      }
      .detail-name {
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-weight: 700;
        font-size: 17px;
        color: var(--forest-deep);
        margin: 0 0 4px;
      }
      .detail-doc {
        font-size: 12px;
        font-family: monospace;
        color: var(--ink-soft);
      }

      .detail-info {
        background: #FAFCFB;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 16px;
        border: 1px solid var(--line);
      }
      .detail-info-row {
        margin-bottom: 12px;
      }
      .detail-info-row:last-child {
        margin-bottom: 0;
      }
      .detail-info-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--ink-soft);
        margin-bottom: 3px;
      }
      .detail-info-value {
        font-size: 13px;
        font-weight: 600;
        color: var(--ink);
      }
      .detail-info-value.green {
        color: var(--green);
        font-weight: 700;
      }

      .detail-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
      }
      .btn-detail-primary {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 18px;
        background: var(--forest);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        font-family: 'Poppins', 'Nunito', sans-serif;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(0, 26, 41, 0.2);
        text-align: center;
      }
      .btn-detail-primary:hover {
        background: var(--green);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(57, 169, 0, 0.3);
      }
      .btn-detail-secondary {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 9px;
        background: #ffffff;
        color: var(--ink);
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 700;
        font-family: 'Poppins', 'Nunito', sans-serif;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
      }
      .btn-detail-secondary:hover {
        background: #F9FBFA;
        border-color: var(--green);
        color: var(--green);
      }
      .btn-detail-secondary i {
        color: var(--green);
      }

      /* Pagination */
      .pagination-bar {
        padding: 14px 22px;
        border-top: 1px solid var(--line);
        background: #FAFCFB;
      }

      /* Modal overlay */
      .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 100;
        background: rgba(0, 19, 30, 0.6);
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
        padding: 20px;
      }
      .modal-overlay.open {
        display: flex;
      }
      .modal-box {
        background: var(--card);
        border-radius: 16px;
        max-width: 480px;
        width: 100%;
        padding: 28px;
        box-shadow: 0 24px 48px rgba(0, 0, 0, 0.2);
        border: 1px solid var(--line);
      }
      .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--line);
        margin-bottom: 20px;
      }
      .modal-title {
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: var(--forest-deep);
        margin: 0;
      }
      .modal-close {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: none;
        border: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--ink-soft);
        transition: all 0.15s;
      }
      .modal-close:hover {
        background: #FEE2E2;
        border-color: #FECACA;
        color: #DC2626;
      }
      .form-group {
        margin-bottom: 16px;
      }
      .form-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 6px;
      }
      .form-control {
        width: 100%;
        padding: 8px 12px;
        background: #FAFCFB;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 12.5px;
        font-family: 'Poppins', 'Nunito', sans-serif;
        color: var(--ink);
        outline: none;
        transition: border-color 0.2s;
      }
      .form-control:focus {
        border-color: var(--green);
        background: #ffffff;
      }
      .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
      }
      .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 16px;
        border-top: 1px solid var(--line);
      }
      .btn-cancel {
        padding: 8px 16px;
        background: #F4F7F6;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 700;
        font-family: 'Poppins', 'Nunito', sans-serif;
        color: var(--ink-soft);
        cursor: pointer;
        transition: all 0.15s;
      }
      .btn-cancel:hover {
        background: var(--line);
      }
      .btn-submit {
        padding: 8px 18px;
        background: var(--green);
        border: none;
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 700;
        font-family: 'Poppins', 'Nunito', sans-serif;
        color: #ffffff;
        cursor: pointer;
        transition: all 0.2s;
      }
      .btn-submit:hover {
        background: var(--green-dark);
      }

      /* Cuestionario Modal ERP Styling */
      .modal-box-cuestionario {
        background: var(--card);
        border-radius: 20px;
        max-width: 740px;
        width: 100%;
        max-height: 92vh;
        overflow: hidden;
        padding: 0;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45);
        border: 1px solid var(--line);
        display: flex;
        flex-direction: column;
      }
      .cuestionario-header {
        background: linear-gradient(135deg, #00131E 0%, #001A29 60%, #002336 100%);
        color: #ffffff;
        padding: 16px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 4px solid var(--green);
      }
      .cuestionario-badge {
        background: var(--green);
        color: #ffffff;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }
      .cuestionario-egresado-banner {
        background: #EAF7EE;
        border-bottom: 1px solid #BBF7D0;
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
      }
      .cuestionario-body {
        padding: 20px 24px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 16px;
      }
      .q-card {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 16px 18px;
      }
      .q-card-head {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 12px;
        font-weight: 800;
        color: var(--forest-deep);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
      }
      .q-card-num {
        width: 22px;
        height: 22px;
        border-radius: 6px;
        background: var(--green);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
      }
      .cuestionario-footer {
        padding: 14px 24px;
        border-top: 1px solid var(--line);
        background: #FAFCFB;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      /* Alert Toast ERP */
      .alert-toast-erp {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 9999;
        background: #00131E;
        color: #ffffff;
        border-left: 4px solid var(--green);
        padding: 14px 20px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        display: flex;
        align-items: center;
        gap: 12px;
        animation: toastIn 0.3s ease-out;
      }
      @keyframes toastIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
      }

      @media (max-width: 1100px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .dir-grid { grid-template-columns: 1fr; }
      }
      @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
        .content { padding: 20px 16px 36px; }
        .topbar { padding: 12px 18px; }
      }
    </style>
</head>
<body>

<div class="app">

  <!-- ============================================== -->
  <!-- 1. SIDEBAR INSTRUCTOR SIGE                     -->
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
        <div class="brand-sub">Gestión de Egresados</div>
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
    </nav>

    <!-- Perfil del Instructor en la parte inferior del sidebar -->
    <div style="margin-top:auto; padding-top:20px; border-top:1px solid rgba(255,255,255,0.08);">
      <div style="display:flex; align-items:center; gap:10px; padding:10px 12px; background:rgba(255,255,255,0.04); border-radius:12px; margin-bottom:12px;">
        <div style="width:36px; height:36px; border-radius:50%; background:#39A900; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:13px; border:2px solid #62E31D;">
          IN
        </div>
        <div style="overflow:hidden;">
          <div style="font-weight:700; font-size:13px; color:#fff; white-space:nowrap; text-overflow:ellipsis; overflow:hidden;">
            {{ Auth::check() ? (Auth::user()->first_name ?? Auth::user()->name ?? 'Instructor Egresados') : 'Instructor Egresados' }}
          </div>
          <div style="font-size:11px; color:#62E31D; font-weight:600;">Instructor Egresados</div>
        </div>
      </div>
      <form action="{{ route('logout') }}" method="POST" style="margin:0;">
        @csrf
        <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
        <button type="submit" style="width:100%; display:flex; align-items:center; justify-content:center; gap:8px; padding:10px; border-radius:10px; background:rgba(239,68,68,0.12); color:#FCA5A5; border:1px solid rgba(239,68,68,0.25); font-weight:700; font-size:12.5px; cursor:pointer; transition:all 0.2s;" onmouseover="this.style.background='rgba(239,68,68,0.25)'; this.style.color='#fff';" onmouseout="this.style.background='rgba(239,68,68,0.12)'; this.style.color='#FCA5A5';">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          <span>Cerrar Sesión</span>
        </button>
      </form>
    </div>
  </aside>

  <!-- ============================================== -->
  <!-- 2. MAIN VIEWPORT                               -->
  <!-- ============================================== -->
  <div class="main">

    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-left">
        <a href="{{ route('egresados.welcome') }}" class="portal-link-btn">
          <i class="fa-solid fa-globe" style="font-size: 11px;"></i>
          <span>Ver Portal Público</span>
        </a>
      </div>

      <div class="topbar-right">
        <button class="icon-btn" title="Notificaciones">
          <i class="fa-regular fa-bell"></i>
          <span class="dot"></span>
        </button>

        <div class="user-dropdown-wrapper">
          <div class="user-chip" id="userMenuBtn" onclick="toggleUserMenu(event)" title="Opciones de Cuenta">
            <div class="user-avatar">
              {{ Auth::check() ? (Auth::user()->initials ?? 'IN') : 'IN' }}
            </div>
            <span>{{ Auth::check() ? (Auth::user()->first_name ?? Auth::user()->name ?? 'Instructor Egresados') : 'Instructor Egresados' }}</span>
            <i class="fa-solid fa-chevron-down" id="userMenuChevron" style="font-size: 10px; opacity: 0.7; transition: transform 0.2s;"></i>
          </div>

          <div class="user-dropdown-menu" id="userDropdownMenu">
            <div class="user-dropdown-header">
              <div class="user-dropdown-name">{{ Auth::check() ? (Auth::user()->first_name ?? Auth::user()->name ?? 'Instructor Egresados') : 'Instructor Egresados' }}</div>
              <div class="user-dropdown-role"><i class="fa-solid fa-circle" style="font-size: 6px; color: var(--moss); margin-right: 4px;"></i> Instructor Egresados</div>
              <div class="user-dropdown-email">{{ Auth::check() ? (Auth::user()->email ?? 'instructor@sena.edu.co') : 'instructor@sena.edu.co' }}</div>
            </div>
            
            <div class="user-dropdown-divider"></div>

            <a href="{{ route('egresados.welcome') }}" class="user-dropdown-item">
              <i class="fa-solid fa-globe"></i>
              <span>Portal Público SIGE</span>
            </a>

            <div class="user-dropdown-divider"></div>

            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
              @csrf
              <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
              <button type="submit" class="user-dropdown-item logout-item">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Cerrar Sesión</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="content">

      <!-- Page Head -->
      <div class="page-head">
        <div>
          <h1 class="page-title">
            Directorio de <span>Egresados</span>
          </h1>
          <p class="page-desc">Gestiona, consulta expedientes y realiza seguimiento a los egresados de formación.</p>
        </div>

        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
          <div class="period-pill">
            <i class="fa-regular fa-calendar-days"></i>
            <span>{{ ucfirst(\Carbon\Carbon::now()->locale('es')->translatedFormat('F Y')) }}</span>
          </div>

          <button class="btn-new" onclick="document.getElementById('modalNuevo').classList.add('open')">
            <i class="fa-solid fa-plus" style="font-size: 11px;"></i>
            <span>Nuevo Egresado</span>
          </button>
        </div>
      </div>



      <!-- Stats Grid -->
      <div class="stats-grid">

        <!-- Card 1: Egresados Inactivos -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon muted-icon">
              <i class="fa-solid fa-user-xmark"></i>
            </div>
            <div class="stat-title">Egresados Inactivos</div>
          </div>
          <div class="stat-value">{{ number_format($totalInactivos ?? 0) }}</div>
          <div class="stat-meta">
            <div class="stat-trend muted">
              <i class="fa-solid fa-circle-pause"></i>
              <span>Desactivados en SIGE</span>
            </div>
            <a href="{{ route('egresados.instructor.directorio') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 2: Egresados Activos -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-user-check"></i>
            </div>
            <div class="stat-title">Egresados Activos</div>
          </div>
          <div class="stat-value">{{ number_format($totalActivos ?? 6) }}</div>
          <div class="stat-meta">
            <div class="stat-trend green">
              <i class="fa-solid fa-shield-check"></i>
              <span>Habilitados en SIGE</span>
            </div>
            <a href="{{ route('egresados.instructor.directorio') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 3: Egresados Registrados -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div class="stat-title">Egresados Registrados</div>
          </div>
          <div class="stat-value">{{ number_format($totalEgresados ?? 6) }}</div>
          <div class="stat-meta">
            <div class="stat-trend green">
              <i class="fa-solid fa-users"></i>
              <span>Registros en sistema</span>
            </div>
            <a href="{{ route('egresados.instructor.directorio') }}" class="stat-link">
              <span>Ver todos</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- Directorio Grid: Table + Detail Panel -->
      <div class="dir-grid">

        <!-- Left: Table Panel -->
        <div class="panel">
          <div class="panel-head">
            <h2 class="panel-title">
              <i class="fa-solid fa-address-book"></i>
              <span>Listado de Egresados Asignados</span>
            </h2>
            <span class="panel-action">{{ $apprentices->total() ?? 0 }} registros</span>
          </div>

          <!-- Filter Bar -->
          <form action="{{ route('egresados.instructor.directorio') }}" method="GET" class="filter-bar">
            <div class="filter-input-wrap">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o cédula..." class="filter-input">
            </div>

            <select name="course_id" class="filter-select" onchange="this.form.submit()">
              <option value="">-- Todos los Programas / Fichas --</option>
              @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                  Ficha {{ $course->code }} {{ $course->program ? '· ' . Str::limit($course->program->name, 22) : '' }}
                </option>
              @endforeach
            </select>

            <button type="submit" class="btn-filter">Filtrar</button>

            @if(request('search') || request('course_id'))
              <a href="{{ route('egresados.instructor.directorio') }}" class="btn-clear">
                <i class="fa-solid fa-xmark"></i> Limpiar
              </a>
            @endif
          </form>

          <!-- Table -->
          <div style="overflow-x: auto;">
            <table class="table-custom">
              <thead>
                <tr>
                  <th>Egresado</th>
                  <th>Documento</th>
                  <th>Programa / Ficha</th>
                  <th>Contacto</th>
                  <th>Estado</th>
                  <th style="text-align: center;">Acción</th>
                </tr>
              </thead>
              <tbody>
                @forelse($apprentices as $index => $appr)
                  @php
                    $person = $appr->person;
                    $fullName = $person ? ($person->first_name . ' ' . $person->first_last_name) : 'Egresado SENA ' . ($index + 1);
                    $doc = $person ? ($person->document_type . ' ' . $person->document_number) : 'CC 1075' . (200000 + $index);
                    $prog = $appr->course && $appr->course->program ? $appr->course->program->name : 'Gestión Agroempresarial';
                    $ficha = $appr->course->code ?? '55555';
                    $phone = $person ? ($person->telephone1 ?? 'No registra') : '315 456 7890';
                    $email = $person ? ($person->misena_email ?? ($person->personal_email ?? 'egresado@sena.edu.co')) : 'egresado@sena.edu.co';
                    $st = $appr->apprentice_status ?? 'CERTIFICADO';

                    $badgeClass = match($st) {
                      'EN FORMACIÓN' => 'badge-blue',
                      'INDUCCIÓN' => 'badge-amber',
                      'CONDICIONADO' => 'badge-purple',
                      default => 'badge-green',
                    };
                    $badgeLabel = match($st) {
                      'EN FORMACIÓN' => 'EMPLEADO',
                      'INDUCCIÓN' => 'EMPRENDEDOR',
                      'CONDICIONADO' => 'ESTUDIANDO',
                      default => 'GRADUADO',
                    };

                    $personObj = $appr->person;
                    $egresadoJson = json_encode([
                      'id' => $appr->id,
                      'name' => $fullName,
                      'doc' => $doc,
                      'doc_type' => $personObj ? ($personObj->document_type ?? 'CC') : 'CC',
                      'doc_number' => $personObj ? ($personObj->document_number ?? '') : '',
                      'program' => $prog,
                      'ficha' => $ficha,
                      'phone' => $phone,
                      'email' => $email,
                      'status' => $badgeLabel,
                      'raw_status' => $st,
                      'badge' => $badgeClass,
                    ]);
                  @endphp
                  <tr id="appr-row-{{ $appr->id }}"
                      class="{{ $index === 0 ? 'row-active' : '' }}"
                      onclick="selectEgresado({{ $egresadoJson }}, 'appr-row-{{ $appr->id }}')">
                    <td>
                      <div style="font-weight: 700; color: var(--forest-deep);">{{ $fullName }}</div>
                      <div style="font-size: 11px; color: var(--ink-soft); max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $email }}</div>
                    </td>
                    <td>
                      <code style="font-size: 11.5px; font-weight: 600; color: var(--ink-soft);">{{ $doc }}</code>
                    </td>
                    <td>
                      <div style="font-weight: 600; color: var(--ink);">{{ Str::limit($prog, 25) }}</div>
                      <div style="font-size: 11px; color: var(--green); font-weight: 700;">Ficha: {{ $ficha }}</div>
                    </td>
                    <td style="white-space: nowrap;">
                      <i class="fa-solid fa-phone" style="font-size: 10px; color: var(--ink-soft); margin-right: 4px;"></i>{{ $phone }}
                    </td>
                    <td>
                      <span class="badge-status {{ $badgeClass }}">{{ $badgeLabel }}</span>
                    </td>
                    <td style="text-align: center;" onclick="event.stopPropagation();">
                      <button type="button" class="action-icon" title="Ver detalle del egresado" onclick="openModalPerfilEgresadoDirectorio({{ $egresadoJson }})" style="cursor: pointer;">
                        <i class="fa-solid fa-eye"></i>
                      </button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: var(--ink-soft);">
                      <i class="fa-regular fa-folder-open" style="font-size: 24px; display: block; margin-bottom: 8px; color: var(--green);"></i>
                      No se encontraron egresados con los filtros aplicados.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          @if(isset($apprentices) && $apprentices->hasPages())
            <div class="pagination-bar">
              {{ $apprentices->appends(request()->query())->links() }}
            </div>
          @endif
        </div>

        <!-- Right: Detail Panel -->
        @php
          $first = $apprentices->first();
          $firstPerson = $first ? $first->person : null;
          $firstFullName = $firstPerson ? ($firstPerson->first_name . ' ' . $firstPerson->first_last_name) : 'Selecciona un Egresado';
          $firstDoc = $firstPerson ? ($firstPerson->document_type . ' ' . $firstPerson->document_number) : 'Cédula de ciudadanía';
          $firstProg = $first && $first->course && $first->course->program ? $first->course->program->name : 'Programa de formación';
          $firstFicha = $first && $first->course ? $first->course->code : 'N/A';
          $firstEmail = $firstPerson ? ($firstPerson->misena_email ?? ($firstPerson->personal_email ?? 'No registra')) : 'No registra';
          $firstPhone = $firstPerson ? ($firstPerson->telephone1 ?? 'No registra') : 'No registra';
          $firstInitials = 'EG';
          if ($firstPerson && $firstPerson->first_name) {
              $firstInitials = strtoupper(substr($firstPerson->first_name, 0, 1) . ($firstPerson->first_last_name ? substr($firstPerson->first_last_name, 0, 1) : ''));
          }
          $firstSt = $first ? ($first->apprentice_status ?? 'CERTIFICADO') : 'CERTIFICADO';
          $firstBadgeLabel = match($firstSt) {
              'EN FORMACIÓN' => 'EMPLEADO',
              'INDUCCIÓN' => 'EMPRENDEDOR',
              'CONDICIONADO' => 'ESTUDIANDO',
              default => 'GRADUADO',
          };
          $firstProfileUrl = $first ? route('egresados.superadmin.perfil', ['id' => $first->id]) : '#';
        @endphp
        <div class="detail-panel">
          <div class="detail-header">
            <span class="detail-header-label">Detalle del Egresado</span>
            <span id="detailStatusPill" class="detail-status-pill badge-green">{{ $firstBadgeLabel }}</span>
          </div>

          <div class="detail-avatar-section">
            <div class="detail-avatar" id="detailAvatar">{{ $firstInitials }}</div>
            <h4 class="detail-name" id="detailName">{{ $firstFullName }}</h4>
            <p class="detail-doc" id="detailDoc">{{ $firstDoc }}</p>
          </div>

          <div class="detail-info">
            <div class="detail-info-row">
              <div class="detail-info-label">Programa de Formación</div>
              <div class="detail-info-value" id="detailProgram">{{ $firstProg }}</div>
            </div>
            <div class="detail-info-row">
              <div class="detail-info-label">Ficha</div>
              <div class="detail-info-value green" id="detailFicha">Ficha: {{ $firstFicha }}</div>
            </div>
            <div class="detail-info-row">
              <div class="detail-info-label">Correo Electrónico</div>
              <div class="detail-info-value" id="detailEmail">{{ $firstEmail }}</div>
            </div>
            <div class="detail-info-row">
              <div class="detail-info-label">Teléfono de Contacto</div>
              <div class="detail-info-value" id="detailPhone">{{ $firstPhone }}</div>
            </div>
          </div>

          <div class="detail-actions">
            <button type="button" id="detailBtnProfile" class="btn-detail-primary" onclick="openModalPerfilEgresadoDirectorio()" style="cursor: pointer; border: none; font-family: inherit;">
              <i class="fa-solid fa-user"></i>
              <span>Ver Perfil Completo</span>
              <i class="fa-solid fa-arrow-right text-xs" style="font-size: 11px; margin-left: 4px;"></i>
            </button>
            <button type="button" class="btn-detail-secondary" onclick="openModalSeguimientoDirectorio()">
              <i class="fa-solid fa-clipboard-question" style="color: var(--green);"></i>
              <span>Registrar Seguimiento</span>
            </button>
          </div>
        </div>

      </div>

    </div>

  </div>

</div>



<!-- ============================================== -->
<!-- MODAL: REGISTRAR SEGUIMIENTO (ERP SENA BÁSICO) -->
<!-- ============================================== -->
<div class="modal-overlay" id="modalSeguimientoDirectorio">
  <div class="modal-box-cuestionario" style="max-width: 540px;">
    
    <!-- Encabezado con Identidad Oficial SENA ERP -->
    <div class="cuestionario-header">
      <div style="display: flex; align-items: center; gap: 12px;">
        <div style="width: 38px; height: 38px; border-radius: 12px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: var(--moss); font-size: 16px;">
          <i class="fa-solid fa-clipboard-check"></i>
        </div>
        <div>
          <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: #ffffff;">Registrar Seguimiento</h3>
          <div style="font-size: 11px; color: rgba(255,255,255,0.65); margin-top: 2px;">Trazabilidad y contacto básico con el egresado</div>
        </div>
      </div>
      <button class="modal-close" style="color: #ffffff; border-color: rgba(255,255,255,0.2);" onclick="closeModalSeguimientoDirectorio()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <!-- Banner del Egresado -->
    <div class="cuestionario-egresado-banner">
      <div style="display: flex; align-items: center; gap: 10px;">
        <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--green); color: #ffffff; font-weight: 800; font-size: 12px; display: flex; align-items: center; justify-content: center;">
          <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
          <div style="font-size: 9.5px; font-weight: 700; color: #166534; text-transform: uppercase;">Egresado</div>
          <div id="modal_seg_name" style="font-size: 13.5px; font-weight: 800; color: var(--forest-deep);">{{ $firstFullName }}</div>
        </div>
      </div>
      <span id="modal_seg_doc" style="font-size: 11px; font-weight: 600; padding: 4px 10px; background: #ffffff; border: 1px solid #BBF7D0; border-radius: 8px; color: #166534;">
        <i class="fa-regular fa-id-card" style="color: var(--green); margin-right: 4px;"></i> {{ $firstDoc }}
      </span>
    </div>

    <!-- Formulario Básico -->
    <div style="padding: 20px 24px;">
      <form id="form-seguimiento-instructor" action="{{ route('egresados.instructor.seguimiento.store') }}" method="POST">
        @csrf
        <input type="hidden" name="egresado_id" id="modal_seg_egresado_id" value="{{ $first ? $first->id : 1 }}">

        <!-- Fila 1: Canal y Fecha -->
        <div class="form-row" style="margin-bottom: 14px;">
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Canal de Contacto *</label>
            <select name="tipo_contacto" required class="form-control">
              <option value="TELEFONICO">📞 Llamada Telefónica</option>
              <option value="WHATSAPP">💬 Mensaje WhatsApp</option>
              <option value="CORREO">✉️ Correo Electrónico</option>
              <option value="PRESENCIAL">👥 Visita Presencial</option>
            </select>
          </div>
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Fecha del Contacto *</label>
            <input type="date" name="fecha" required value="{{ date('Y-m-d') }}" class="form-control">
          </div>
        </div>

        <!-- Fila 2: Estado Laboral y Empresa -->
        <div class="form-row" style="margin-bottom: 14px;">
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Estado Laboral Actual *</label>
            <select name="nuevo_estado_laboral" required class="form-control">
              <option value="EMPLEADO">💼 Vinculado / Empleado</option>
              <option value="INDEPENDIENTE">🚀 Emprendedor / Propio</option>
              <option value="EN FORMACION">⏳ En Etapa Productiva</option>
              <option value="DESEMPLEADO">🔍 En Búsqueda de Empleo</option>
              <option value="ESTUDIANDO">🎓 Continuando Estudios</option>
            </select>
          </div>
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Empresa / Ocupación</label>
            <input type="text" name="empresa_actual" placeholder="Ej: Agropecuaria / Freelance" class="form-control">
          </div>
        </div>

        <!-- Fila 3: Observaciones -->
        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Observaciones / Resultado del Contacto *</label>
          <textarea name="observaciones" rows="3" required placeholder="Escriba brevemente el resultado del contacto, acuerdos o novedades del egresado..." class="form-control" style="resize:none;"></textarea>
        </div>
      </form>
    </div>

    <!-- Pie del Modal -->
    <div class="cuestionario-footer">
      <button type="button" class="btn-cancel" onclick="closeModalSeguimientoDirectorio()">Cancelar</button>
      <button type="submit" form="form-seguimiento-instructor" class="btn-submit" style="display:flex; align-items:center; gap:6px;">
        <i class="fa-solid fa-floppy-disk"></i>
        <span>Guardar Seguimiento</span>
      </button>
    </div>

  </div>
</div>

<!-- ============================================== -->
<!-- MODAL: REGISTRAR NUEVO EGRESADO (ERP SENA)    -->
<!-- ============================================== -->
<div class="modal-overlay" id="modalNuevo">
  <div class="modal-box-cuestionario" style="max-width: 640px;">
    
    <!-- Encabezado Oficial SENA ERP -->
    <div class="cuestionario-header">
      <div style="display: flex; align-items: center; gap: 14px;">
        <div style="width: 42px; height: 42px; border-radius: 12px; background: linear-gradient(135deg, #39A900 0%, #2e8b00 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 4px 10px rgba(0,0,0,0.25); flex-shrink: 0;">
          <i class="fa-solid fa-user-plus"></i>
        </div>
        <div>
          <div style="font-size: 10px; font-weight: 800; color: var(--moss); text-transform: uppercase; letter-spacing: 0.8px;">GESTIÓN DE EGRESADOS · SIGE</div>
          <h3 style="margin: 2px 0 0; font-size: 16px; font-weight: 700; color: #ffffff;">Registrar Nuevo Egresado</h3>
          <div style="font-size: 11.5px; color: rgba(255,255,255,0.7); margin-top: 2px;">Crea un registro de egresado con validación institucional y rol en el sistema.</div>
        </div>
      </div>
      <button class="modal-close" style="color: #ffffff; border-color: rgba(255,255,255,0.2);" onclick="document.getElementById('modalNuevo').classList.remove('open')">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <!-- Cuerpo del Formulario -->
    <div class="cuestionario-body" style="padding: 22px 24px;">
      <form id="form-nuevo-egresado" action="{{ route('egresados.instructor.store') }}" method="POST">
        @csrf

        <!-- 1. DATOS PERSONALES -->
        <div class="q-card">
          <div class="q-card-head">
            <span class="q-card-num">1</span>
            <span>Datos Personales</span>
          </div>

          <div class="form-row" style="margin-bottom: 12px;">
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Nombres <span style="color:#DC2626;">*</span></label>
              <input type="text" name="nombres" required placeholder="Ej. Juan David" class="form-control">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Apellidos <span style="color:#DC2626;">*</span></label>
              <input type="text" name="apellidos" required placeholder="Ej. Lizcano Pérez" class="form-control">
            </div>
          </div>

          <div class="form-row" style="margin-bottom: 12px;">
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Tipo de Documento <span style="color:#DC2626;">*</span></label>
              <select name="tipo_documento" required class="form-control">
                <option value="CC" selected>Cédula de Ciudadanía (CC)</option>
                <option value="TI">Tarjeta de Identidad (TI)</option>
                <option value="CE">Cédula de Extranjería (CE)</option>
                <option value="PEP">Permiso Especial (PEP)</option>
                <option value="PPT">Permiso por Protección Temporal (PPT)</option>
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Número de Documento <span style="color:#DC2626;">*</span></label>
              <input type="number" name="documento" required placeholder="Ej. 107521454" class="form-control">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Correo Electrónico <span style="color:#DC2626;">*</span></label>
              <input type="email" name="correo" required placeholder="ejemplo@sena.edu.co" class="form-control">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Teléfono / Celular</label>
              <input type="text" name="telefono" placeholder="Ej. 315 456 7890" class="form-control">
            </div>
          </div>
        </div>

        <!-- 2. INFORMACIÓN ACADÉMICA -->
        <div class="q-card" style="margin-top: 14px;">
          <div class="q-card-head">
            <span class="q-card-num">2</span>
            <span>Programa y Ficha de Formación</span>
          </div>

          <div class="form-row">
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Ficha de Formación <span style="color:#DC2626;">*</span></label>
              <select name="ficha" required class="form-control">
                <option value="">-- Seleccionar Ficha --</option>
                @foreach($courses as $c)
                  <option value="{{ $c->code }}">
                    Ficha {{ $c->code }} {{ $c->program ? '· ' . Str::limit($c->program->name, 26) : '' }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Estado Ocupacional <span style="color:#DC2626;">*</span></label>
              <select name="estado" required class="form-control">
                <option value="CERTIFICADO" selected>Certificado (Egresado)</option>
                <option value="EN FORMACIÓN">En Formación</option>
                <option value="INDUCCIÓN">Inducción</option>
                <option value="CONDICIONADO">Condicionado</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Banner Informativo Institucional -->
        <div style="background: #EAF7EE; border: 1px solid #BBF7D0; border-radius: 12px; padding: 12px 16px; margin-top: 14px; display: flex; align-items: flex-start; gap: 12px;">
          <div style="width: 24px; height: 24px; border-radius: 50%; background: var(--green); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 11px; flex-shrink: 0; margin-top: 2px;">
            <i class="fa-solid fa-info"></i>
          </div>
          <div>
            <div style="font-size: 11.5px; font-weight: 700; color: #00131E;">Vinculación Oficial al SIGE</div>
            <p style="font-size: 11px; color: #166534; margin: 2px 0 0; line-height: 1.4;">
              El egresado quedará registrado en el directorio oficial con su rol asignado. Podrá consultar su perfil y ser caracterizado mediante su número de documento.
            </p>
          </div>
        </div>

      </form>
    </div>

    <!-- Pie del Modal -->
    <div class="cuestionario-footer">
      <button type="button" class="btn-cancel" onclick="document.getElementById('modalNuevo').classList.remove('open')">Cancelar</button>
      <button type="submit" form="form-nuevo-egresado" class="btn-submit" style="display:flex; align-items:center; gap:8px;">
        <i class="fa-solid fa-id-card"></i>
        <span>Registrar Egresado</span>
      </button>
    </div>

  </div>
</div>


<!-- ============================================== -->
<!-- MODAL 1: VER EXPEDIENTE COMPLETO (ERP SENA)    -->
<!-- ============================================== -->
<div class="modal-overlay" id="modalVerPerfilEgresado">
  <div class="modal-box-cuestionario" style="max-width: 620px;">
    
    <!-- Encabezado Oficial SENA ERP -->
    <div class="cuestionario-header" style="justify-content: space-between;">
      <div style="display: flex; align-items: center; gap: 14px;">
        <div id="modalVerAvatar" style="width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #39A900 0%, #2e8b00 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 800; box-shadow: 0 4px 10px rgba(0,0,0,0.25); flex-shrink: 0;">
          {{ $firstInitials }}
        </div>
        <div>
          <div style="display: flex; align-items: center; gap: 6px;">
            <span style="font-size: 10px; font-weight: 800; color: var(--moss); text-transform: uppercase; letter-spacing: 0.8px;">EXPEDIENTE DEL EGRESADO · SIGE</span>
            <span id="modalVerStatusPill" class="badge-status badge-green" style="padding: 2px 8px; border-radius: 999px; font-size: 9.5px; font-weight: 800; text-transform: uppercase;">
              {{ $firstBadgeLabel }}
            </span>
          </div>
          <h3 id="modalVerName" style="margin: 3px 0 0; font-size: 17px; font-weight: 700; color: #ffffff;">{{ $firstFullName }}</h3>
          <div style="font-size: 11px; color: rgba(255,255,255,0.7); margin-top: 1px;">Centro de Formación Agroindustrial La Angostura — CEFA</div>
        </div>
      </div>
      <div style="display: flex; align-items: center; gap: 8px;">
        <button type="button" onclick="openModalEditarEgresadoDirectorio()" style="padding: 6px 12px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.25); color: #ffffff; border-radius: 8px; font-size: 11.5px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 6px; transition: all 0.2s;" onmouseover="this.style.background='var(--green)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
          <i class="fa-solid fa-pen-to-square" style="color: var(--moss);"></i>
          <span>Editar</span>
        </button>
        <button class="modal-close" style="color: #ffffff; border-color: rgba(255,255,255,0.2);" onclick="closeModalPerfilEgresadoDirectorio()">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
    </div>

    <!-- Cuerpo del Perfil -->
    <div class="cuestionario-body" style="padding: 22px 24px; max-height: 70vh; overflow-y: auto;">
      
      <!-- 1. Datos Personales y de Contacto -->
      <div class="q-card">
        <div class="q-card-head">
          <span class="q-card-num"><i class="fa-solid fa-id-card"></i></span>
          <span>Información Personal y Contacto</span>
        </div>
        <div class="form-row" style="margin-bottom: 10px;">
          <div style="flex:1; background: #F8FAFC; border: 1px solid #E2E8F0; padding: 10px 14px; border-radius: 10px;">
            <div style="font-size: 10px; font-weight: 700; color: #64748B; text-transform: uppercase;">Documento de Identidad</div>
            <div id="modalVerDoc" style="font-size: 13px; font-weight: 700; color: #00131E; margin-top: 3px;">{{ $firstDoc }}</div>
          </div>
          <div style="flex:1; background: #F8FAFC; border: 1px solid #E2E8F0; padding: 10px 14px; border-radius: 10px;">
            <div style="font-size: 10px; font-weight: 700; color: #64748B; text-transform: uppercase;">Teléfono / Celular</div>
            <div id="modalVerPhone" style="font-size: 13px; font-weight: 700; color: #00131E; margin-top: 3px;">{{ $firstPhone }}</div>
          </div>
        </div>
        <div class="form-row">
          <div style="flex:1; background: #F8FAFC; border: 1px solid #E2E8F0; padding: 10px 14px; border-radius: 10px;">
            <div style="font-size: 10px; font-weight: 700; color: #64748B; text-transform: uppercase;">Correo Electrónico</div>
            <div id="modalVerEmail" style="font-size: 13px; font-weight: 700; color: #00131E; margin-top: 3px; word-break: break-all;">{{ $firstEmail }}</div>
          </div>
          <div style="flex:1; background: #F8FAFC; border: 1px solid #E2E8F0; padding: 10px 14px; border-radius: 10px;">
            <div style="font-size: 10px; font-weight: 700; color: #64748B; text-transform: uppercase;">Protección de Datos</div>
            <div style="font-size: 12px; font-weight: 700; color: #166534; margin-top: 3px; display: flex; align-items: center; gap: 4px;">
              <i class="fa-solid fa-shield-halved" style="color: var(--green);"></i> Habeas Data Autorizado
            </div>
          </div>
        </div>
      </div>

      <!-- 2. Información Académica SENA -->
      <div class="q-card" style="margin-top: 14px;">
        <div class="q-card-head">
          <span class="q-card-num"><i class="fa-solid fa-graduation-cap"></i></span>
          <span>Formación Académica SENA</span>
        </div>
        <div style="background: #EAF7EE; border: 1px solid #BBF7D0; padding: 12px 14px; border-radius: 10px; margin-bottom: 10px;">
          <div style="font-size: 10px; font-weight: 800; color: #166534; text-transform: uppercase;">Programa de Formación</div>
          <div id="modalVerProgram" style="font-size: 13.5px; font-weight: 700; color: #00131E; margin-top: 2px;">{{ $firstProg }}</div>
        </div>
        <div class="form-row">
          <div style="flex:1; background: #EAF7EE; border: 1px solid #BBF7D0; padding: 10px 14px; border-radius: 10px;">
            <div style="font-size: 10px; font-weight: 800; color: #166534; text-transform: uppercase;">Ficha</div>
            <div id="modalVerFicha" style="font-size: 13px; font-weight: 700; color: #00131E; margin-top: 2px;">Ficha: {{ $firstFicha }}</div>
          </div>
          <div style="flex:1; background: #EAF7EE; border: 1px solid #BBF7D0; padding: 10px 14px; border-radius: 10px;">
            <div style="font-size: 10px; font-weight: 800; color: #166534; text-transform: uppercase;">Centro de Formación</div>
            <div style="font-size: 13px; font-weight: 700; color: #00131E; margin-top: 2px;">CEFA La Angostura</div>
          </div>
        </div>
      </div>

    </div>

    <!-- Pie del Modal con Acciones -->
    <div class="cuestionario-footer" style="justify-content: space-between;">
      <button type="button" class="btn-cancel" onclick="closeModalPerfilEgresadoDirectorio()">Cerrar</button>
      <div style="display: flex; gap: 8px;">
        <button type="button" onclick="openModalSeguimientoDesdePerfil()" class="btn-cancel" style="background:#EAF7EE; border-color:#BBF7D0; color:#166534; font-weight:700; display:flex; align-items:center; gap:6px;">
          <i class="fa-solid fa-clipboard-question"></i>
          <span>Seguimiento</span>
        </button>
        <button type="button" onclick="openModalEditarEgresadoDirectorio()" class="btn-submit" style="display:flex; align-items:center; gap:6px;">
          <i class="fa-solid fa-pen-to-square"></i>
          <span>Editar Expediente</span>
        </button>
      </div>
    </div>

  </div>
</div>

<!-- ============================================== -->
<!-- MODAL 2: EDITAR DATOS DEL EGRESADO (ERP SENA)  -->
<!-- ============================================== -->
<div class="modal-overlay" id="modalEditarEgresado">
  <div class="modal-box-cuestionario" style="max-width: 620px;">
    
    <!-- Encabezado Oficial SENA ERP -->
    <div class="cuestionario-header">
      <div style="display: flex; align-items: center; gap: 14px;">
        <div style="width: 42px; height: 42px; border-radius: 12px; background: linear-gradient(135deg, #001A29 0%, #39A900 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 16px; box-shadow: 0 4px 10px rgba(0,0,0,0.25); flex-shrink: 0;">
          <i class="fa-solid fa-pen-to-square"></i>
        </div>
        <div>
          <div style="font-size: 10px; font-weight: 800; color: var(--moss); text-transform: uppercase; letter-spacing: 0.8px;">EDICIÓN DE EXPEDIENTE · SIGE</div>
          <h3 style="margin: 2px 0 0; font-size: 16px; font-weight: 700; color: #ffffff;">Editar Datos del Egresado</h3>
          <div style="font-size: 11.5px; color: rgba(255,255,255,0.7); margin-top: 2px;">Modificando información de: <strong id="modalEditNameLabel" style="color:var(--moss);">Egresado</strong></div>
        </div>
      </div>
      <button class="modal-close" style="color: #ffffff; border-color: rgba(255,255,255,0.2);" onclick="closeModalEditarEgresadoDirectorio()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <!-- Cuerpo del Formulario de Edición -->
    <div class="cuestionario-body" style="padding: 22px 24px; max-height: 70vh; overflow-y: auto;">
      <form id="form-editar-egresado-directorio" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="egresado_id" id="modal_edit_egresado_id">

        <!-- 1. DATOS PERSONALES -->
        <div class="q-card">
          <div class="q-card-head">
            <span class="q-card-num">1</span>
            <span>Datos Personales e Identificación</span>
          </div>

          <div class="form-row" style="margin-bottom: 12px;">
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Tipo de Documento <span style="color:#DC2626;">*</span></label>
              <select name="tipo_documento" id="modal_edit_tipo_documento" required class="form-control">
                <option value="CC">Cédula de Ciudadanía (CC)</option>
                <option value="TI">Tarjeta de Identidad (TI)</option>
                <option value="CE">Cédula de Extranjería (CE)</option>
                <option value="PEP">Permiso Especial (PEP)</option>
                <option value="PPT">Permiso de Protección Temporal (PPT)</option>
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Número de Documento <span style="color:#DC2626;">*</span></label>
              <input type="number" name="documento" id="modal_edit_documento" required class="form-control">
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 12px;">
            <label class="form-label">Nombre Completo <span style="color:#DC2626;">*</span></label>
            <input type="text" name="nombre" id="modal_edit_nombre" required class="form-control">
          </div>

          <div class="form-row">
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Correo Electrónico <span style="color:#DC2626;">*</span></label>
              <input type="email" name="correo" id="modal_edit_correo" required class="form-control">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Teléfono / Celular</label>
              <input type="text" name="telefono" id="modal_edit_telefono" class="form-control">
            </div>
          </div>
        </div>

        <!-- 2. INFORMACIÓN ACADÉMICA Y ESTADO -->
        <div class="q-card" style="margin-top: 14px;">
          <div class="q-card-head">
            <span class="q-card-num">2</span>
            <span>Formación y Estado Ocupacional</span>
          </div>

          <div class="form-row">
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Ficha de Formación <span style="color:#DC2626;">*</span></label>
              <select name="ficha" id="modal_edit_ficha" required class="form-control">
                @foreach($courses as $c)
                  <option value="{{ $c->code }}">
                    Ficha {{ $c->code }} {{ $c->program ? '· ' . Str::limit($c->program->name, 26) : '' }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Estado Ocupacional <span style="color:#DC2626;">*</span></label>
              <select name="estado" id="modal_edit_estado" required class="form-control">
                <option value="CERTIFICADO">Certificado (Egresado)</option>
                <option value="EN FORMACIÓN">En Formación</option>
                <option value="INDUCCIÓN">Inducción</option>
                <option value="CONDICIONADO">Condicionado</option>
              </select>
            </div>
          </div>
        </div>

      </form>
    </div>

    <!-- Pie del Modal -->
    <div class="cuestionario-footer">
      <button type="button" class="btn-cancel" onclick="closeModalEditarEgresadoDirectorio()">Cancelar</button>
      <button type="submit" form="form-editar-egresado-directorio" class="btn-submit" style="display:flex; align-items:center; gap:8px;">
        <i class="fa-solid fa-floppy-disk"></i>
        <span>Guardar Cambios</span>
      </button>
    </div>

  </div>
</div>

<script>
  let currentSelectedEgresado = {
    id: '{{ $first ? $first->id : 1 }}',
    name: '{{ $firstFullName }}',
    doc: '{{ $firstDoc }}',
    doc_type: '{{ $firstPerson ? ($firstPerson->document_type ?? "CC") : "CC" }}',
    doc_number: '{{ $firstPerson ? ($firstPerson->document_number ?? "") : "" }}',
    program: '{{ $firstProg }}',
    ficha: '{{ $firstFicha }}',
    email: '{{ $firstEmail }}',
    phone: '{{ $firstPhone }}',
    status: '{{ $firstBadgeLabel }}',
    raw_status: '{{ $firstSt }}',
    badge: 'badge-green',
    initials: '{{ $firstInitials }}'
  };

  function selectEgresado(data, rowId) {
    if (!data) return;
    currentSelectedEgresado = Object.assign({}, currentSelectedEgresado, data);

    // Highlight active row smoothly without viewport jumping
    document.querySelectorAll('.table-custom tbody tr').forEach(row => {
      row.classList.remove('row-active');
    });
    const activeRow = document.getElementById(rowId);
    if (activeRow) activeRow.classList.add('row-active');

    // Update detail panel
    document.getElementById('detailName').innerText = data.name || 'Egresado SENA';
    document.getElementById('detailDoc').innerText = data.doc || '';
    document.getElementById('detailProgram').innerText = data.program || 'General';
    document.getElementById('detailFicha').innerText = 'Ficha: ' + (data.ficha || 'N/A');
    document.getElementById('detailEmail').innerText = data.email || 'No registra';
    document.getElementById('detailPhone').innerText = data.phone || 'No registra';

    // Update avatar initials
    const avatar = document.getElementById('detailAvatar');
    if (avatar && data.name) {
      const parts = data.name.trim().split(' ');
      avatar.innerText = (parts[0][0] + (parts[1] ? parts[1][0] : '')).toUpperCase();
    }

    // Update status pill
    const pill = document.getElementById('detailStatusPill');
    if (pill) {
      pill.innerText = data.status || 'GRADUADO';
      pill.className = 'detail-status-pill ' + (data.badge || 'badge-green');
    }

    // Update profile button
    const btnProf = document.getElementById('detailBtnProfile');
    if (btnProf && data.profile_url) {
      btnProf.href = data.profile_url;
    }
  }

  
  // Funciones para Modal Ver Perfil Egresado y Modal Editar
  function openModalPerfilEgresadoDirectorio(data) {
    if (data) {
      currentSelectedEgresado = Object.assign({}, currentSelectedEgresado, data);
    }
    const d = currentSelectedEgresado;
    if (!d) return;

    const avatar = document.getElementById('modalVerAvatar');
    if (avatar && d.name) {
      const parts = d.name.trim().split(' ');
      avatar.innerText = (parts[0][0] + (parts[1] ? parts[1][0] : '')).toUpperCase();
    }

    const nameEl = document.getElementById('modalVerName');
    if (nameEl) nameEl.innerText = d.name || 'Egresado SENA';

    const docEl = document.getElementById('modalVerDoc');
    if (docEl) docEl.innerText = d.doc || 'Cédula';

    const emailEl = document.getElementById('modalVerEmail');
    if (emailEl) emailEl.innerText = d.email || 'No registra';

    const phoneEl = document.getElementById('modalVerPhone');
    if (phoneEl) phoneEl.innerText = d.phone || 'No registra';

    const progEl = document.getElementById('modalVerProgram');
    if (progEl) progEl.innerText = d.program || 'General';

    const fichaEl = document.getElementById('modalVerFicha');
    if (fichaEl) fichaEl.innerText = 'Ficha: ' + (d.ficha || 'N/A');

    const pillEl = document.getElementById('modalVerStatusPill');
    if (pillEl) {
      pillEl.innerText = d.status || 'GRADUADO';
      pillEl.className = 'badge-status ' + (d.badge || 'badge-green');
    }

    const modal = document.getElementById('modalVerPerfilEgresado');
    if (modal) modal.classList.add('open');
  }

  function closeModalPerfilEgresadoDirectorio() {
    const modal = document.getElementById('modalVerPerfilEgresado');
    if (modal) modal.classList.remove('open');
  }

  function openModalEditarEgresadoDirectorio() {
    closeModalPerfilEgresadoDirectorio();
    const d = currentSelectedEgresado;
    if (!d) return;

    const form = document.getElementById('form-editar-egresado-directorio');
    if (form && d.id) {
      form.action = '{{ url("egresados/instructor") }}/' + d.id + '/update';
    }

    const idInput = document.getElementById('modal_edit_egresado_id');
    if (idInput && d.id) idInput.value = d.id;

    const labelEl = document.getElementById('modalEditNameLabel');
    if (labelEl) labelEl.innerText = d.name || 'Egresado';

    const nameInput = document.getElementById('modal_edit_nombre');
    if (nameInput) nameInput.value = (d.name && d.name !== 'Sin nombre') ? d.name : '';

    const docInput = document.getElementById('modal_edit_documento');
    if (docInput) {
      const rawDigits = String(d.doc_number || d.doc || '').replace(/\D/g, '');
      docInput.value = rawDigits;
    }

    const typeSelect = document.getElementById('modal_edit_tipo_documento');
    if (typeSelect && d.doc_type) {
      typeSelect.value = d.doc_type;
    }

    const emailInput = document.getElementById('modal_edit_correo');
    if (emailInput) {
      emailInput.value = (d.email && !d.email.includes('No registra')) ? d.email : '';
    }

    const phoneInput = document.getElementById('modal_edit_telefono');
    if (phoneInput) {
      const rawPhone = String(d.phone || '').replace(/\D/g, '');
      phoneInput.value = (rawPhone && rawPhone.length >= 7) ? rawPhone : '';
    }

    const fichaSelect = document.getElementById('modal_edit_ficha');
    if (fichaSelect && d.ficha) {
      fichaSelect.value = d.ficha;
    }

    const estadoSelect = document.getElementById('modal_edit_estado');
    if (estadoSelect && d.raw_status) {
      estadoSelect.value = d.raw_status;
    }

    const modal = document.getElementById('modalEditarEgresado');
    if (modal) modal.classList.add('open');
  }

  function closeModalEditarEgresadoDirectorio() {
    const modal = document.getElementById('modalEditarEgresado');
    if (modal) modal.classList.remove('open');
  }

  function openModalSeguimientoDesdePerfil() {
    closeModalPerfilEgresadoDirectorio();
    openModalSeguimientoDirectorio();
  }

  function openModalSeguimientoDirectorio() {
    const modal = document.getElementById('modalSeguimientoDirectorio');
    if (!modal) return;

    const egId = document.getElementById('modal_seg_egresado_id');
    const egName = document.getElementById('modal_seg_name');
    const egDoc = document.getElementById('modal_seg_doc');
    const egFicha = document.getElementById('modal_seg_ficha');

    if (egId && currentSelectedEgresado.id) egId.value = currentSelectedEgresado.id;
    if (egName && currentSelectedEgresado.name) egName.innerText = currentSelectedEgresado.name;
    if (egDoc && currentSelectedEgresado.doc) {
      egDoc.innerHTML = '<i class="fa-regular fa-id-card" style="color: var(--green); margin-right: 4px;"></i> ' + currentSelectedEgresado.doc;
    }
    if (egFicha && currentSelectedEgresado.ficha) egFicha.innerText = 'Ficha: ' + currentSelectedEgresado.ficha;

    modal.classList.add('open');
  }

  function closeModalSeguimientoDirectorio() {
    const modal = document.getElementById('modalSeguimientoDirectorio');
    if (modal) modal.classList.remove('open');
  }

  // Close modal when clicking outside
  window.addEventListener('click', function(e) {
    const modalSeg = document.getElementById('modalSeguimientoDirectorio');
    if (modalSeg && e.target === modalSeg) {
      closeModalSeguimientoDirectorio();
    }
    const modalNew = document.getElementById('modalNuevo');
    if (modalNew && e.target === modalNew) {
      modalNew.classList.remove('open');
    }
    const modalVer = document.getElementById('modalVerPerfilEgresado');
    if (modalVer && e.target === modalVer) {
      closeModalPerfilEgresadoDirectorio();
    }
    const modalEdit = document.getElementById('modalEditarEgresado');
    if (modalEdit && e.target === modalEdit) {
      closeModalEditarEgresadoDirectorio();
    }
  });

  function toggleUserMenu(e) {
    e.stopPropagation();
    const menu = document.getElementById('userDropdownMenu');
    const chevron = document.getElementById('userMenuChevron');
    const isOpen = menu.classList.contains('show');
    if (isOpen) {
      menu.classList.remove('show');
      if (chevron) chevron.style.transform = 'rotate(0deg)';
    } else {
      menu.classList.add('show');
      if (chevron) chevron.style.transform = 'rotate(180deg)';
    }
  }

  document.addEventListener('click', function(e) {
    const menu = document.getElementById('userDropdownMenu');
    const chevron = document.getElementById('userMenuChevron');
    const btn = document.getElementById('userMenuBtn');
    if (menu && menu.classList.contains('show')) {
      if (!menu.contains(e.target) && !btn.contains(e.target)) {
        menu.classList.remove('show');
        if (chevron) chevron.style.transform = 'rotate(0deg)';
      }
    }
  });

  // AJAX Form Handler for Registrar Nuevo Egresado
  const formNuevoEgresado = document.getElementById('form-nuevo-egresado');
  if (formNuevoEgresado) {
    formNuevoEgresado.addEventListener('submit', function(e) {
      e.preventDefault();
      const submitBtn = document.querySelector('button[form="form-nuevo-egresado"]');
      const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Registrando...</span>';
      }

      const formData = new FormData(formNuevoEgresado);

      fetch(formNuevoEgresado.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnHtml;
        }

        if (data.success) {
          // 1. Cerrar modal de nuevo egresado
          document.getElementById('modalNuevo').classList.remove('open');
          formNuevoEgresado.reset();

          // 2. Mostrar la ventanita registrado exitosamente
          if (window.showSuccessAlert) {
            window.showSuccessAlert(
              '¡Egresado Registrado Correctamente!',
              data.message || 'Expediente guardado y verificado en la base de datos'
            );
          }

          // 3. Recargar suavemente para reflejar el nuevo egresado en el directorio
          setTimeout(() => {
            window.location.reload();
          }, 2400);
        } else {
          if (window.showErrorAlert) {
            window.showErrorAlert('Atención: Error al registrar', data.message || 'No fue posible completar el registro.');
          } else {
            alert(data.message || 'Error al registrar');
          }
        }
      })
      .catch(err => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnHtml;
        }
        console.error('Fetch error:', err);
        formNuevoEgresado.submit();
      });
    });
  }

  
  // AJAX Form Handler for Editar Egresado
  const formEditEgresado = document.getElementById('form-editar-egresado-directorio');
  if (formEditEgresado) {
    formEditEgresado.addEventListener('submit', function(e) {
      e.preventDefault();
      const submitBtn = document.querySelector('button[form="form-editar-egresado-directorio"]');
      const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Guardando Cambios...</span>';
      }

      const formData = new FormData(formEditEgresado);

      fetch(formEditEgresado.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnHtml;
        }

        if (data.success) {
          closeModalEditarEgresadoDirectorio();
          if (window.showSuccessAlert) {
            window.showSuccessAlert(
              '¡Datos Actualizados Correctamente!',
              data.message || 'Expediente actualizado y verificado en la base de datos'
            );
          }
          setTimeout(() => {
            window.location.reload();
          }, 2200);
        } else {
          if (window.showErrorAlert) {
            window.showErrorAlert('Atención al Editar', data.message || 'No fue posible guardar los cambios.');
          } else {
            alert(data.message || 'Error al actualizar');
          }
        }
      })
      .catch(err => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnHtml;
        }
        console.error('Fetch error:', err);
        formEditEgresado.submit();
      });
    });
  }

  // AJAX Form Handler for Registrar Seguimiento
  const formSeguimiento = document.getElementById('form-seguimiento-instructor');
  if (formSeguimiento) {
    formSeguimiento.addEventListener('submit', function(e) {
      e.preventDefault();
      const submitBtn = document.querySelector('button[form="form-seguimiento-instructor"]');
      const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Guardando...</span>';
      }

      const formData = new FormData(formSeguimiento);

      fetch(formSeguimiento.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnHtml;
        }

        if (data.success) {
          closeModalSeguimientoDirectorio();
          formSeguimiento.reset();

          if (window.showSuccessAlert) {
            window.showSuccessAlert(
              '¡Seguimiento Registrado con Éxito!',
              data.message || 'Bitácora de seguimiento registrada en el expediente'
            );
          }

          setTimeout(() => {
            window.location.reload();
          }, 2400);
        } else {
          if (window.showErrorAlert) {
            window.showErrorAlert('Error al registrar seguimiento', data.message || 'Ocurrió un error.');
          } else {
            alert(data.message || 'Error al registrar');
          }
        }
      })
      .catch(err => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnHtml;
        }
        console.error('Fetch error:', err);
        formSeguimiento.submit();
      });
    });
  }
</script>


@include('egresados::superadmin.partials._modal_alertas')
</body>
</html>
