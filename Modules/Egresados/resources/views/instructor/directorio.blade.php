<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Directorio de Egresados — Instructor CEFA</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Fraunces + Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Jost:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
      :root {
        --forest: #001A29;
        --forest-deep: #00131E;
        --sena-dark: #00131E;
        --sena-navy: #001A29;
        --sena-navy-light: #002336;
        --green: #39A900;
        --green-dark: #2a7c00;
        --green-soft: #EAF7EE;
        --blue-soft: #EBF3FF;
        --amber-soft: #FEF7EA;
        --purple-soft: #F5EFFF;
        --moss: #62E31D;
        --bg: #F4F7F6;
        --card: #FFFFFF;
        --ink: #16261C;
        --ink-soft: #6B7A70;
        --line: #E8EFE9;
      }

      * { box-sizing: border-box; }
      html, body { margin: 0; padding: 0; }

      body {
        font-family: 'Poppins', 'Open Sans', sans-serif;
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

      /* ---------------- SIDEBAR ---------------- */
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
        font-family: 'Poppins', 'Jost', sans-serif;
        font-weight: 700;
        font-size: 18px;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .brand-tag {
        font-family: 'Poppins', 'Open Sans', sans-serif;
        font-size: 9px;
        font-weight: 800;
        background: linear-gradient(135deg, #39A900 0%, #2a7c00 100%);
        color: #ffffff;
        padding: 2px 8px;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1px solid rgba(98, 227, 29, 0.5);
        box-shadow: 0 2px 8px rgba(57, 169, 0, 0.35);
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
        background: rgba(57, 169, 0, 0.16);
        color: #62E31D;
        transform: translateX(3px);
      }
      nav a:hover i {
        color: #62E31D;
      }
      nav a.active {
        background: linear-gradient(90deg, #39A900 0%, #2a7c00 100%);
        color: #ffffff;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35);
        border: 1px solid rgba(98, 227, 29, 0.4);
      }
      nav a.active i {
        color: #ffffff;
      }

      /* ---------------- MAIN ---------------- */
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
        background: var(--green);
        color: #ffffff;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 999px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .btn-new:hover {
        background: var(--green-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(57, 169, 0, 0.3);
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
      .user-dropdown-item.logout-item:hover i {
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
        font-family: 'Poppins', 'Jost', sans-serif;
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
        font-family: 'Poppins', 'Jost', sans-serif;
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
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--green-soft);
        color: var(--green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
      }
      .stat-icon.blue { background: rgba(57, 169, 0, 0.12); color: var(--green); }
      .stat-icon.amber { background: var(--amber-soft); color: #D97706; }

      .stat-title {
        font-size: 13.5px;
        color: var(--ink-soft);
        font-weight: 600;
      }
      .stat-value {
        font-family: 'Poppins', 'Jost', sans-serif;
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
        display: flex;
        align-items: center;
        gap: 5px;
      }
      .stat-trend.amber { color: #D97706; }
      .stat-trend.green { color: var(--green); }
      .stat-trend.blue { color: var(--green); }
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
        font-family: 'Poppins', 'Jost', sans-serif;
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
        font-family: 'Poppins', 'Open Sans', sans-serif;
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
        font-family: 'Poppins', 'Open Sans', sans-serif;
        color: var(--ink);
        outline: none;
        cursor: pointer;
        min-width: 200px;
      }
      .filter-select:focus {
        border-color: var(--green);
      }
      .btn-filter {
        background: var(--forest);
        color: #ffffff;
        border: none;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 700;
        font-family: 'Poppins', 'Open Sans', sans-serif;
        cursor: pointer;
        transition: background 0.2s;
      }
      .btn-filter:hover {
        background: var(--green);
      }
      .btn-clear {
        background: none;
        border: none;
        padding: 8px 12px;
        color: var(--ink-soft);
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        font-family: 'Poppins', 'Open Sans', sans-serif;
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
        background: rgba(57, 169, 0, 0.03);
      }
      .table-custom tbody tr.row-active td {
        background: rgba(57, 169, 0, 0.06);
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
      .badge-green { background: #EAF7EE; color: #236B00; border: 1px solid #C4ECCB; }
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
        background: var(--green-soft);
        color: var(--green);
        text-decoration: none;
        transition: all 0.2s;
        font-size: 13px;
      }
      .action-icon:hover {
        background: var(--green);
        color: #ffffff;
      }

      /* Detail panel (sticky sidebar) */
      .detail-panel {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        position: sticky;
        top: 80px;
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
        font-family: 'Poppins', 'Jost', sans-serif;
        font-weight: 700;
        font-size: 20px;
        margin: 0 auto 10px;
        border: 2px solid rgba(57, 169, 0, 0.3);
      }
      .detail-name {
        font-family: 'Poppins', 'Jost', sans-serif;
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
        padding: 10px;
        background: var(--green);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 700;
        font-family: 'Poppins', 'Open Sans', sans-serif;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
      }
      .btn-detail-primary:hover {
        background: var(--green-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(57, 169, 0, 0.25);
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
        font-family: 'Poppins', 'Open Sans', sans-serif;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
      }
      .btn-detail-secondary:hover {
        background: #F9FBFA;
        border-color: var(--green);
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
        background: rgba(0, 20, 30, 0.5);
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
        box-shadow: 0 24px 48px rgba(0, 0, 0, 0.15);
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
        font-family: 'Poppins', 'Jost', sans-serif;
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
        font-family: 'Poppins', 'Open Sans', sans-serif;
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
        font-family: 'Poppins', 'Open Sans', sans-serif;
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
        font-family: 'Poppins', 'Open Sans', sans-serif;
        color: #ffffff;
        cursor: pointer;
        transition: all 0.2s;
      }
      .btn-submit:hover {
        background: var(--green-dark);
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
    <a href="{{ route('egresados.instructor.dashboard') }}" class="brand">
      <div class="brand-badge">
        <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA">
      </div>
      <div>
        <div class="brand-name">
          <span>SIGE</span>
          <span class="brand-tag">Instructor</span>
        </div>
        <div class="brand-sub">CEFA La Angostura</div>
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
        <span>Directorio Completo</span>
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

    <div class="nav-label">Portal Público</div>
    <nav>
      <a href="{{ route('egresados.welcome') }}">
        <i class="fa-solid fa-house"></i>
        <span>Portal Egresados</span>
      </a>
    </nav>
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
        <button class="btn-new" onclick="document.getElementById('modalNuevo').classList.add('open')">
          <i class="fa-solid fa-plus" style="font-size: 10px;"></i>
          <span>Nuevo Egresado</span>
        </button>

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
              <div class="user-dropdown-role"><i class="fa-solid fa-circle" style="font-size: 6px; color: var(--moss); margin-right: 4px;"></i> Rol: Instructor CEFA</div>
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
          <p class="page-desc">Gestiona, consulta expedientes y realiza seguimiento a la vinculación laboral de los aprendices graduados.</p>
        </div>

        <div class="period-pill">
          <i class="fa-regular fa-calendar-days"></i>
          <span>{{ ucfirst(\Carbon\Carbon::now()->locale('es')->translatedFormat('F Y')) }}</span>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="stats-grid">

        <!-- Card 1: Actualización Pendiente -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon amber">
              <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="stat-title">Actualización Pendiente</div>
          </div>
          <div class="stat-value">{{ number_format($actualizacionPendiente ?? 304) }}</div>
          <div class="stat-meta">
            <div class="stat-trend amber">
              <i class="fa-solid fa-clock-rotate-left"></i>
              <span>Desactualizada</span>
            </div>
            <a href="{{ route('egresados.instructor.directorio') }}" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Card 2: Seguimientos Realizados -->
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon">
              <i class="fa-solid fa-magnifying-glass-chart"></i>
            </div>
            <div class="stat-title">Seguimientos Realizados</div>
          </div>
          <div class="stat-value">{{ number_format($seguimientosRealizados ?? 300) }}</div>
          <div class="stat-meta">
            <div class="stat-trend green">
              <i class="fa-solid fa-calendar-check"></i>
              <span>Este mes</span>
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
            <div class="stat-icon blue">
              <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div class="stat-title">Egresados Registrados</div>
          </div>
          <div class="stat-value">{{ number_format($totalEgresados ?? 5634) }}</div>
          <div class="stat-meta">
            <div class="stat-trend blue">
              <i class="fa-solid fa-users"></i>
              <span>Base general</span>
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

                    $egresadoJson = json_encode([
                      'id' => $appr->id,
                      'name' => $fullName,
                      'doc' => $doc,
                      'program' => $prog,
                      'ficha' => $ficha,
                      'phone' => $phone,
                      'email' => $email,
                      'status' => $badgeLabel,
                      'badge' => $badgeClass,
                      'profile_url' => route('egresados.superadmin.perfil', ['id' => $appr->id])
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
                      <a href="{{ route('egresados.superadmin.perfil', ['id' => $appr->id]) }}" class="action-icon" title="Ver Perfil Completo">
                        <i class="fa-solid fa-arrow-right"></i>
                      </a>
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
        <div class="detail-panel">
          <div class="detail-header">
            <span class="detail-header-label">Detalle del Egresado</span>
            <span id="detailStatusPill" class="detail-status-pill badge-green">GRADUADO</span>
          </div>

          <div class="detail-avatar-section">
            <div class="detail-avatar" id="detailAvatar">VR</div>
            <h4 class="detail-name" id="detailName">Selecciona un Egresado</h4>
            <p class="detail-doc" id="detailDoc">Cédula de ciudadanía</p>
          </div>

          <div class="detail-info">
            <div class="detail-info-row">
              <div class="detail-info-label">Programa de Formación</div>
              <div class="detail-info-value" id="detailProgram">Gestión de Empresas Agropecuarias</div>
            </div>
            <div class="detail-info-row">
              <div class="detail-info-label">Ficha</div>
              <div class="detail-info-value green" id="detailFicha">Ficha: 55555</div>
            </div>
            <div class="detail-info-row">
              <div class="detail-info-label">Correo Electrónico</div>
              <div class="detail-info-value" id="detailEmail">egresado@sena.edu.co</div>
            </div>
            <div class="detail-info-row">
              <div class="detail-info-label">Teléfono de Contacto</div>
              <div class="detail-info-value" id="detailPhone">No registra</div>
            </div>
          </div>

          <div class="detail-actions">
            <a id="detailBtnProfile" href="#" class="btn-detail-primary">
              <i class="fa-solid fa-user"></i>
              <span>Ver Perfil Completo</span>
            </a>
            <button type="button" class="btn-detail-secondary" onclick="alert('Registrar nuevo seguimiento para: ' + document.getElementById('detailName').innerText)">
              <i class="fa-solid fa-pen-to-square"></i>
              <span>Registrar Seguimiento</span>
            </button>
          </div>
        </div>

      </div>

    </div>

  </div>

</div>

<!-- Modal Nuevo Egresado -->
<div class="modal-overlay" id="modalNuevo">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title">Registrar Nuevo Egresado</h3>
      <button class="modal-close" onclick="document.getElementById('modalNuevo').classList.remove('open')">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
    <form action="{{ route('egresados.superadmin.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label class="form-label">Nombres y Apellidos</label>
        <input type="text" name="nombres" required class="form-control">
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Documento</label>
          <input type="text" name="documento" required class="form-control">
        </div>
        <div class="form-group">
          <label class="form-label">Ficha</label>
          <select name="course_id" required class="form-control">
            @foreach($courses as $c)
              <option value="{{ $c->id }}">Ficha {{ $c->code }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Correo Electrónico</label>
        <input type="email" name="email" required class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="document.getElementById('modalNuevo').classList.remove('open')">Cancelar</button>
        <button type="submit" class="btn-submit">Guardar Egresado</button>
      </div>
    </form>
  </div>
</div>

<script>
  function selectEgresado(data, rowId) {
    if (!data) return;

    // Highlight active row
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

  // Auto-select first row on page load
  document.addEventListener('DOMContentLoaded', function() {
    const firstRow = document.querySelector('.table-custom tbody tr[id]');
    if (firstRow) firstRow.click();
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
</script>

</body>
</html>
