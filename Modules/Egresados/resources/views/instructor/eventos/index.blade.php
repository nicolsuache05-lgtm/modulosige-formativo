<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Eventos y Encuentros — Instructor CEFA</title>

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
        border: 2px solid rgba(2, 136, 209, 0.6);
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
        background: #0288d1;
        color: #ffffff;
        padding: 2px 7px;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
        background: #ffffff;
        color: var(--forest-deep);
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
      }
      nav a.active i {
        color: #0288d1;
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
        font-size: 14px;
        color: var(--ink-soft);
        margin: 0;
      }

      .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--forest);
        color: #ffffff;
        padding: 10px 18px;
        border-radius: 12px;
        font-size: 13.5px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
      }
      .btn-primary:hover {
        background: var(--green);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(57, 169, 0, 0.25);
      }

      /* Stats Grid */
      .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 28px;
      }
      .stat-card {
        background: var(--card);
        border-radius: 16px;
        padding: 20px 22px;
        border: 1px solid var(--line);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        transition: all 0.25s ease;
      }
      .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        border-color: rgba(57, 169, 0, 0.3);
      }
      .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
      }
      .stat-label {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--ink-soft);
      }
      .stat-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
      }
      .stat-icon.blue { background: rgba(57, 169, 0, 0.12); color: var(--green); }
      .stat-icon.green { background: var(--green-soft); color: var(--green); }
      .stat-icon.amber { background: var(--amber-soft); color: #D97706; }
      .stat-icon.purple { background: rgba(0, 35, 54, 0.08); color: var(--forest); }

      .stat-value {
        font-family: 'Poppins', 'Jost', sans-serif;
        font-weight: 700;
        font-size: 26px;
        color: var(--forest-deep);
        margin-bottom: 4px;
      }
      .stat-sub {
        font-size: 11.5px;
        color: var(--ink-soft);
      }

      /* Flash alert */
      .flash-alert {
        background: #ECFDF5;
        border: 1px solid #A7F3D0;
        color: #065F46;
        padding: 12px 18px;
        border-radius: 12px;
        margin-bottom: 22px;
        font-size: 13.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      /* Events Grid */
      .events-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
      }

      .event-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 16px;
        transition: all 0.25s ease;
      }
      .event-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.06);
        border-color: rgba(57, 169, 0, 0.35);
      }

      .event-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
      }

      .date-badge {
        background: #F4F7F6;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 10px 14px;
        text-align: center;
        flex-shrink: 0;
      }
      .date-day {
        font-family: 'Poppins', 'Jost', sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: var(--green);
        line-height: 1;
      }
      .date-month {
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-top: 3px;
      }

      .event-info {
        flex: 1;
      }
      .event-type-badge {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 10.5px;
        font-weight: 700;
        background: var(--blue-soft);
        color: #1E40AF;
        margin-bottom: 6px;
      }
      .event-title {
        font-family: 'Poppins', 'Jost', sans-serif;
        font-weight: 700;
        font-size: 17px;
        color: var(--forest-deep);
        margin: 0 0 6px;
        line-height: 1.3;
      }
      .event-desc {
        font-size: 12.5px;
        color: var(--ink-soft);
        line-height: 1.45;
        margin: 0;
      }

      .event-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        background: #FAFCFB;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 12px;
      }
      .event-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--ink);
      }
      .event-meta-item i {
        color: var(--green);
        width: 14px;
      }

      .event-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 14px;
        border-top: 1px solid var(--line);
        flex-wrap: wrap;
        gap: 10px;
      }

      .progress-container {
        flex: 1;
        max-width: 180px;
      }
      .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        font-weight: 600;
        color: var(--ink-soft);
        margin-bottom: 4px;
      }
      .progress-bar {
        width: 100%;
        height: 6px;
        background: #E5E7EB;
        border-radius: 999px;
        overflow: hidden;
      }
      .progress-fill {
        height: 100%;
        background: var(--green);
        border-radius: 999px;
      }

      .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 8px;
        background: #ffffff;
        border: 1px solid var(--line);
        font-size: 12px;
        font-weight: 700;
        color: var(--forest-deep);
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
      }
      .btn-secondary:hover {
        background: var(--green-soft);
        border-color: var(--green);
        color: var(--green-dark);
      }

      /* Modal */
      .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 19, 30, 0.6);
        backdrop-filter: blur(4px);
        z-index: 100;
        align-items: center;
        justify-content: center;
        padding: 20px;
      }
      .modal-box {
        background: #ffffff;
        border-radius: 20px;
        width: 100%;
        max-width: 820px;
        box-shadow: 0 25px 50px rgba(0, 19, 30, 0.35);
        max-height: 92vh;
        overflow-y: auto;
      }
      .modal-head {
        padding: 22px 28px;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        background: #FAFCFB;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
      }
      .modal-title {
        font-family: 'Poppins', 'Jost', sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: var(--forest-deep);
        margin: 0;
      }
      .modal-sub {
        font-size: 12.5px;
        color: var(--ink-soft);
        margin-top: 4px;
      }
      .format-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 800;
        background: var(--green-soft);
        color: var(--green-dark);
        padding: 3px 10px;
        border-radius: 999px;
        margin-bottom: 8px;
        border: 1px solid rgba(57, 169, 0, 0.25);
        letter-spacing: 0.4px;
      }
      .modal-close {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #ffffff;
        border: 1px solid var(--line);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--ink-soft);
        transition: all 0.2s;
      }
      .modal-close:hover {
        background: #FEE2E2;
        color: #DC2626;
        border-color: #FCA5A5;
      }
      .modal-body {
        padding: 26px 28px;
      }
      .template-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
      }
      .template-pill {
        background: #F0F6F2;
        border: 1px solid #D1E5D7;
        color: #1A4723;
        font-size: 11.5px;
        font-weight: 600;
        padding: 6px 13px;
        border-radius: 999px;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
      }
      .template-pill:hover {
        background: var(--green);
        color: #ffffff;
        border-color: var(--green);
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(57, 169, 0, 0.25);
      }
      .form-section {
        background: #FAFCFB;
        border: 1px solid var(--line);
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 18px;
      }
      .form-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13.5px;
        font-weight: 700;
        color: var(--forest);
        margin-bottom: 14px;
        font-family: 'Poppins', 'Jost', sans-serif;
      }
      .step-number {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--green);
        color: #ffffff;
        font-size: 11.5px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }
      .form-group {
        margin-bottom: 16px;
      }
      .form-group:last-child {
        margin-bottom: 0;
      }
      .form-label {
        display: block;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 6px;
        color: var(--ink);
      }
      .form-control {
        width: 100%;
        padding: 10px 14px;
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Poppins', 'Open Sans', sans-serif;
        outline: none;
        transition: all 0.2s;
      }
      .form-control:focus {
        border-color: var(--green);
        box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.15);
      }
      .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
      }
      .modal-select-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
      }
      .modality-card {
        border: 1.5px solid var(--line);
        border-radius: 12px;
        padding: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #ffffff;
      }
      .modality-card.active, .modality-card:hover {
        border-color: var(--green);
        background: var(--green-soft);
      }
      .modality-card i {
        font-size: 18px;
        color: var(--green-dark);
        margin-bottom: 4px;
        display: block;
      }
      .modality-card span {
        font-size: 12px;
        font-weight: 700;
        color: var(--forest);
        display: block;
      }
      .checkbox-label {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 12.5px;
        color: var(--ink);
        margin-bottom: 8px;
        cursor: pointer;
        user-select: none;
      }
      .checkbox-label input {
        margin-top: 2px;
        accent-color: var(--green);
        width: 16px;
        height: 16px;
      }
      .modal-foot {
        padding: 20px 28px;
        border-top: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #FAFCFB;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
      }
      .btn-cancel {
        padding: 10px 20px;
        background: #F4F7F6;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        color: var(--ink-soft);
        cursor: pointer;
        transition: all 0.2s;
      }
      .btn-cancel:hover {
        background: #E5EBE7;
        color: var(--ink);
      }
      .btn-submit {
        padding: 10px 24px;
        background: linear-gradient(135deg, #39A900 0%, #2A7C00 100%);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(57, 169, 0, 0.35);
        transition: all 0.2s;
      }
      .btn-submit:hover {
        background: linear-gradient(135deg, #44C700 0%, #308F00 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(57, 169, 0, 0.45);
      }

      @media (max-width: 1100px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .events-grid { grid-template-columns: 1fr; }
      }
      @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
        .content { padding: 20px 16px; }
        .event-meta { grid-template-columns: 1fr; }
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
      <a href="{{ route('egresados.instructor.directorio') }}">
        <i class="fa-solid fa-user-graduate"></i>
        <span>Egresados Fichas</span>
      </a>
      <a href="{{ route('egresados.instructor.encuestas.index') }}">
        <i class="fa-solid fa-clipboard-question"></i>
        <span>Encuestas</span>
      </a>
      <a href="{{ route('egresados.instructor.reportes.index') }}">
        <i class="fa-solid fa-file-invoice"></i>
        <span>Reportes</span>
      </a>
      <a href="{{ route('egresados.instructor.eventos.index') }}" class="active">
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
          <i class="fa-solid fa-globe text-xs"></i>
          <span>Ver Portal Público</span>
        </a>
      </div>

      <div class="topbar-right">
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

      @if(session('success'))
      <div class="flash-alert">
        <div style="display: flex; align-items: center; gap: 10px;">
          <i class="fa-solid fa-circle-check" style="font-size: 18px; color: var(--green);"></i>
          <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: #065F46;">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      @endif

      <!-- Page Header -->
      <div class="page-head">
        <div>
          <h1 class="page-title">Eventos y <span>Encuentros</span></h1>
          <p class="page-desc">Organiza talleres, ferias y encuentros de egresados para fortalecer la vinculación laboral.</p>
        </div>
        <div>
          <button type="button" class="btn-primary" onclick="openModal()">
            <i class="fa-solid fa-calendar-plus"></i>
            <span>Programar Evento</span>
          </button>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Eventos Programados</span>
            <div class="stat-icon blue"><i class="fa-regular fa-calendar-check"></i></div>
          </div>
          <div class="stat-value">{{ count($eventos) }}</div>
          <div class="stat-sub">Actividades agendadas</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Egresados Inscritos</span>
            <div class="stat-icon green"><i class="fa-solid fa-users"></i></div>
          </div>
          <div class="stat-value">{{ $totalInscritos }}</div>
          <div class="stat-sub">Participantes confirmados</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Tasa de Asistencia</span>
            <div class="stat-icon amber"><i class="fa-solid fa-chart-line"></i></div>
          </div>
          <div class="stat-value">{{ $tasaAsistencia }}</div>
          <div class="stat-sub">Promedio histórico</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Próximo Encuentro</span>
            <div class="stat-icon purple"><i class="fa-regular fa-clock"></i></div>
          </div>
          <div class="stat-value">En {{ $proximoEventoDias }} días</div>
          <div class="stat-sub">Fichas ADSO</div>
        </div>
      </div>

      <!-- Events Grid -->
      <div class="events-grid">
        @foreach($eventos as $evt)
        <div class="event-card">
          <div class="event-top">
            <div class="date-badge">
              <div class="date-day">{{ substr($evt['date'], 0, 2) }}</div>
              <div class="date-month">{{ date('M', strtotime(str_replace('/', '-', $evt['date']))) }}</div>
            </div>
            <div class="event-info">
              <span class="event-type-badge">{{ $evt['type'] }}</span>
              <h3 class="event-title">{{ $evt['title'] }}</h3>
              <p class="event-desc">{{ $evt['description'] }}</p>
            </div>
          </div>

          <div class="event-meta">
            <div class="event-meta-item">
              <i class="fa-regular fa-clock"></i>
              <span>{{ $evt['time'] }}</span>
            </div>
            <div class="event-meta-item">
              <i class="fa-solid fa-location-dot"></i>
              <span>{{ $evt['location'] }}</span>
            </div>
            <div class="event-meta-item" style="grid-column: span 2;">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>{{ $evt['program'] }}</span>
            </div>
          </div>

          <div class="event-footer">
            <div class="progress-container">
              <div class="progress-label">
                <span>Cupo: {{ $evt['registrados'] }}/{{ $evt['cupo'] }}</span>
                <span>{{ $evt['rate'] }}</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $evt['rate_num'] }}%;"></div>
              </div>
            </div>

            <div style="display: flex; gap: 8px;">
              <button type="button" class="btn-secondary" onclick="invitarEgresadosEvento('{{ addslashes($evt['title']) }}', '{{ addslashes($evt['program']) }}')">
                <i class="fa-solid fa-paper-plane" style="color: var(--green);"></i>
                <span>Invitar</span>
              </button>
              <button type="button" class="btn-secondary" onclick='abrirDetalleEvento(@json($evt))'>
                <i class="fa-solid fa-circle-info"></i>
                <span>Ver Info</span>
              </button>
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </div>
</div>

<!-- ============================================== -->
<!-- MODAL: PROGRAMAR NUEVO EVENTO (FORMATO OFICIAL)-->
<!-- ============================================== -->
<div class="modal-overlay" id="modalEvento">
  <div class="modal-box">
    <div class="modal-head">
      <div>
        <div class="format-badge"><i class="fa-solid fa-calendar-days"></i> AGENDA INSTITUCIONAL SENA · CEFA LA ANGOSTURA</div>
        <h3 class="modal-title"><i class="fa-solid fa-calendar-plus" style="color: var(--green); margin-right: 8px;"></i> Programar y Convocar Evento</h3>
        <div class="modal-sub">Planificación de encuentros presenciales, talleres técnicos, ferias laborales y networking.</div>
      </div>
      <button type="button" class="modal-close" onclick="closeModal()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form id="formNuevoEvento" action="{{ route('egresados.instructor.eventos.store') }}" method="POST">
      @csrf

      <div class="modal-body">
        
        <!-- Plantillas Rápidas -->
        <div style="margin-bottom: 8px;">
          <label class="form-label" style="font-size: 11.5px; color: var(--ink-soft);"><i class="fa-solid fa-wand-magic-sparkles" style="color: var(--green); margin-right: 4px;"></i> Plantillas sugeridas de evento (clic para autocompletar):</label>
          <div class="template-pills">
            <button type="button" class="template-pill" onclick="aplicarPlantillaEvento('encuentro_adso')">
              <i class="fa-solid fa-laptop-code"></i> Encuentro Ficha ADSO
            </button>
            <button type="button" class="template-pill" onclick="aplicarPlantillaEvento('taller_cv')">
              <i class="fa-solid fa-file-lines"></i> Taller Hoja de Vida & LinkedIn
            </button>
            <button type="button" class="template-pill" onclick="aplicarPlantillaEvento('conferencia_agro')">
              <i class="fa-solid fa-seedling"></i> Conferencia Tecnologías Agro 4.0
            </button>
            <button type="button" class="template-pill" onclick="aplicarPlantillaEvento('feria_empleo')">
              <i class="fa-solid fa-handshake"></i> Feria de Oportunidades & Pasantías
            </button>
          </div>
        </div>

        <!-- SECCIÓN 1: Identificación y Modalidad -->
        <div class="form-section">
          <div class="form-section-title">
            <span class="step-number">1</span>
            <span>Datos Principales y Modalidad</span>
          </div>

          <div class="form-group">
            <label class="form-label">Nombre Oficial del Evento *</label>
            <input type="text" name="titulo" id="evt_titulo" class="form-control" placeholder="Ej. Encuentro de Egresados y Networking Tecnológico ADSO" required>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Tipo de Actividad *</label>
              <select name="tipo" id="evt_tipo" class="form-control" required>
                <option value="Encuentro de Ficha">Encuentro de Ficha</option>
                <option value="Taller de Empleabilidad">Taller de Empleabilidad</option>
                <option value="Conferencia Técnica">Conferencia Técnica</option>
                <option value="Feria de Empleo">Feria de Empleo / Pasantías</option>
                <option value="Mesa Redonda">Mesa Redonda con Egresados</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Modalidad de Asistencia *</label>
              <div class="modal-select-grid">
                <div class="modality-card active" onclick="seleccionarModalidad('Presencial', this)">
                  <i class="fa-solid fa-building-columns"></i>
                  <span>Presencial</span>
                </div>
                <div class="modality-card" onclick="seleccionarModalidad('Virtual', this)">
                  <i class="fa-solid fa-video"></i>
                  <span>Virtual</span>
                </div>
                <div class="modality-card" onclick="seleccionarModalidad('Híbrido', this)">
                  <i class="fa-solid fa-tower-broadcast"></i>
                  <span>Híbrido</span>
                </div>
              </div>
              <input type="hidden" name="modalidad" id="evt_modalidad" value="Presencial">
            </div>
          </div>
        </div>

        <!-- SECCIÓN 2: Fecha, Horario y Aforo -->
        <div class="form-section">
          <div class="form-section-title">
            <span class="step-number">2</span>
            <span>Fecha, Horario y Capacidad</span>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Fecha del Evento *</label>
              <input type="date" name="fecha" id="evt_fecha" class="form-control" value="{{ date('Y-m-d', strtotime('+14 days')) }}" required>
            </div>

            <div class="form-group">
              <label class="form-label">Horario (Inicio y Fin) *</label>
              <input type="text" name="hora" id="evt_hora" class="form-control" placeholder="Ej. 02:00 PM - 05:00 PM" value="02:00 PM - 05:00 PM" required>
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <label class="form-label" style="margin: 0;">Cupo Máximo de Asistentes *</label>
              <span id="cupoHelper" style="font-size: 11.5px; font-weight: 700; color: var(--green-dark);">50 cupos sugeridos</span>
            </div>
            <input type="number" name="cupo" id="evt_cupo" class="form-control" value="50" min="5" max="500" required oninput="document.getElementById('cupoHelper').textContent = this.value + ' cupos confirmados'">
          </div>
        </div>

        <!-- SECCIÓN 3: Ubicación y Conectividad -->
        <div class="form-section">
          <div class="form-section-title">
            <span class="step-number">3</span>
            <span>Ubicación y Conectividad</span>
          </div>

          <div class="form-group">
            <label class="form-label">Lugar / Sede Física *</label>
            <input type="text" name="lugar" id="evt_lugar" class="form-control" placeholder="Ej. Ambiente 102 - Auditorio Principal CEFA La Angostura" value="Ambiente 102 - CEFA La Angostura" required>
          </div>

          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Enlace Virtual (Teams / Meet / Zoom) <span style="font-weight: 400; color: var(--ink-soft);">(Opcional si es Virtual o Híbrido)</span></label>
            <input type="url" name="enlace_virtual" id="evt_enlace" class="form-control" placeholder="https://teams.microsoft.com/l/meetup-join/..." value="">
          </div>
        </div>

        <!-- SECCIÓN 4: Audiencia y Agenda -->
        <div class="form-section">
          <div class="form-section-title">
            <span class="step-number">4</span>
            <span>Audiencia Convocada y Agenda</span>
          </div>

          <div class="form-group">
            <label class="form-label">Ficha / Programa Convocado *</label>
            <select name="programa" id="evt_programa" class="form-control" required>
              <option value="Todas las Fichas del Instructor">Todas mis Fichas Asignadas</option>
              @foreach($courses as $c)
              <option value="Ficha {{ $c->code }} - {{ $c->program->name ?? 'Programa' }}">
                Ficha {{ $c->code }} — {{ $c->program->name ?? 'SENA' }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Descripción de la Agenda y Temas a Tratar</label>
            <textarea name="descripcion" id="evt_desc" class="form-control" rows="3" placeholder="Detalles de los ponentes invitados, actividades de networking o requerimientos para los egresados asistentes..."></textarea>
          </div>
        </div>

        <!-- SECCIÓN 5: Beneficios y Notificaciones -->
        <div class="form-section" style="margin-bottom: 0;">
          <div class="form-section-title">
            <span class="step-number">5</span>
            <span>Beneficios para el Egresado y Convocatoria</span>
          </div>

          <label class="checkbox-label">
            <input type="checkbox" name="constancia" checked>
            <span><strong>Otorga Constancia Institucional de Asistencia</strong> avalada por CEFA La Angostura.</span>
          </label>

          <label class="checkbox-label">
            <input type="checkbox" name="networking" checked>
            <span><strong>Espacio de Networking</strong> con empresas y empleadores de la región Huila.</span>
          </label>

          <label class="checkbox-label">
            <input type="checkbox" name="publicar_portal" checked>
            <span><strong>Publicar de inmediato en la Agenda del Portal Público</strong> de Egresados SIGE.</span>
          </label>

          <label class="checkbox-label">
            <input type="checkbox" name="notificar_correo" checked>
            <span><strong>Enviar invitación formal por correo electrónico</strong> a los aprendices egresados convocados.</span>
          </label>
        </div>

      </div>

      <div class="modal-foot">
        <button type="button" class="btn-cancel" onclick="closeModal()">Cancelar</button>
        <button type="submit" class="btn-submit">
          <i class="fa-solid fa-calendar-check mr-1"></i> Programar y Publicar Evento
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById('modalEvento').style.display = 'flex';
  }
  function closeModal() {
    document.getElementById('modalEvento').style.display = 'none';
  }

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

  // Gestor de modalidad y plantillas de evento
  function seleccionarModalidad(mod, el) {
    document.querySelectorAll('.modality-card').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('evt_modalidad').value = mod;

    const lugar = document.getElementById('evt_lugar');
    const enlace = document.getElementById('evt_enlace');

    if (mod === 'Virtual') {
      lugar.value = 'Microsoft Teams (Enlace Virtual)';
      enlace.placeholder = 'https://teams.microsoft.com/l/meetup-join/... (Requerido para virtual)';
      enlace.focus();
    } else if (mod === 'Presencial') {
      if (lugar.value.includes('Microsoft Teams')) {
        lugar.value = 'Ambiente 102 - CEFA La Angostura';
      }
    } else if (mod === 'Híbrido') {
      lugar.value = 'Auditorio Principal CEFA & Transmisión Teams';
    }
  }

  function aplicarPlantillaEvento(tipo) {
    const titulo = document.getElementById('evt_titulo');
    const tipoSel = document.getElementById('evt_tipo');
    const hora = document.getElementById('evt_hora');
    const cupo = document.getElementById('evt_cupo');
    const lugar = document.getElementById('evt_lugar');
    const desc = document.getElementById('evt_desc');
    const cupoHelper = document.getElementById('cupoHelper');

    if (tipo === 'encuentro_adso') {
      titulo.value = 'Encuentro Anual de Egresados ADSO & Networking Tecnológico 2026';
      tipoSel.value = 'Encuentro de Ficha';
      hora.value = '02:00 PM - 05:30 PM';
      cupo.value = '60';
      lugar.value = 'Ambiente 102 - CEFA La Angostura';
      desc.value = 'Socialización de experiencias laborales en desarrollo de software, presentación de portafolios de proyectos y retroalimentación curricular con empresas invitadas.';
    } else if (tipo === 'taller_cv') {
      titulo.value = 'Taller Práctico: Optimización de Hoja de Vida, LinkedIn & Simulacro de Entrevistas';
      tipoSel.value = 'Taller de Empleabilidad';
      hora.value = '08:30 AM - 12:00 PM';
      cupo.value = '45';
      lugar.value = 'Sala de Cómputo 2 / Híbrido Teams';
      desc.value = 'Revisión personalizada de perfiles profesionales con reclutadores de talento humano y simulacro de pruebas técnicas de contratación.';
    } else if (tipo === 'conferencia_agro') {
      titulo.value = 'Conferencia Magistral: Innovación, Agrotech & Transformación Digital en el Huila';
      tipoSel.value = 'Conferencia Técnica';
      hora.value = '09:00 AM - 01:00 PM';
      cupo.value = '120';
      lugar.value = 'Auditorio Principal CEFA La Angostura';
      desc.value = 'Ponencias con expertos del sector agroindustrial y de desarrollo de software sobre proyectos sostenibles e inteligencia artificial aplicada al campo.';
    } else if (tipo === 'feria_empleo') {
      titulo.value = 'Feria de Empleabilidad, Pasantías e Intermediación Laboral CEFA';
      tipoSel.value = 'Feria de Empleo';
      hora.value = '08:00 AM - 04:00 PM';
      cupo.value = '150';
      lugar.value = 'Plaza Central - Centro de Formación Agroindustrial';
      desc.value = 'Jornada presencial con empresas del Huila que ofrecen vacantes laborales exclusivas para egresados de las áreas TIC y Agroindustrial.';
    }

    if (cupoHelper) cupoHelper.textContent = cupo.value + ' cupos sugeridos';
  }

  // Visualizador modal de Detalle de Evento
  let eventoActual = null;

  function abrirDetalleEvento(evt) {
    eventoActual = evt;
    document.getElementById('verEvt_title').textContent = evt.title || 'Encuentro con Egresados';
    document.getElementById('verEvt_sub').textContent = 'Código: ' + (evt.id || 'EVT-001') + ' · Tipo: ' + (evt.type || 'Encuentro de Ficha');
    document.getElementById('verEvt_fecha').textContent = evt.date || 'Próximo';
    document.getElementById('verEvt_hora').textContent = evt.time || 'Horario a convenir';
    document.getElementById('verEvt_lugar').textContent = evt.location || 'CEFA La Angostura';
    document.getElementById('verEvt_programa').textContent = evt.program || 'Fichas Asignadas';
    document.getElementById('verEvt_registrados').textContent = evt.registrados ?? 0;
    document.getElementById('verEvt_cupo').textContent = evt.cupo ?? 50;
    document.getElementById('verEvt_pendientes').textContent = evt.pendientes ?? ((evt.cupo || 50) - (evt.registrados || 0));
    document.getElementById('verEvt_rate').textContent = evt.rate || '0%';
    document.getElementById('verEvt_rateLabel').textContent = evt.rate || '0%';
    document.getElementById('verEvt_progressFill').style.width = (evt.rate_num || 0) + '%';
    document.getElementById('verEvt_desc').textContent = evt.description || 'Sin descripción detallada de actividades.';

    document.getElementById('modalVerEvento').style.display = 'flex';
  }

  function cerrarDetalleEvento() {
    document.getElementById('modalVerEvento').style.display = 'none';
  }

  function invitarEgresadosEvento(titulo, programa) {
    mostrarToast('¡Invitación masiva enviada a los egresados de ' + programa + '!');
  }

  function invitarDesdeModal() {
    if (eventoActual) {
      invitarEgresadosEvento(eventoActual.title, eventoActual.program);
    }
  }

  function mostrarToast(mensaje) {
    let toast = document.getElementById('sigeToastNotification');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'sigeToastNotification';
      toast.style.cssText = 'position: fixed; bottom: 30px; right: 30px; background: #001A29; color: #ffffff; padding: 14px 22px; border-radius: 12px; font-size: 13px; font-weight: 600; box-shadow: 0 10px 25px rgba(0,0,0,0.3); border-left: 4px solid #39A900; z-index: 9999; display: flex; align-items: center; gap: 10px; opacity: 0; transform: translateY(20px); transition: all 0.3s ease;';
      document.body.appendChild(toast);
    }
    toast.innerHTML = '<i class="fa-solid fa-circle-check" style="color: #62E31D; font-size: 16px;"></i><span>' + mensaje + '</span>';
    toast.style.opacity = '1';
    toast.style.transform = 'translateY(0)';
    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(20px)';
    }, 3200);
  }
</script>

<!-- MODAL: VER DETALLE COMPLETO DE EVENTO -->
<div class="modal-overlay" id="modalVerEvento">
  <div class="modal-box" style="max-width: 780px;">
    <div class="modal-head">
      <div>
        <div class="format-badge"><i class="fa-solid fa-calendar-check"></i> AGENDA INSTITUCIONAL · ENCUENTRO DE EGRESADOS</div>
        <h3 class="modal-title" id="verEvt_title">Encuentro de Egresados Fichas ADSO</h3>
        <div class="modal-sub" id="verEvt_sub">Código: EVT-INS-001 · Tipo: Encuentro de Ficha</div>
      </div>
      <button type="button" class="modal-close" onclick="cerrarDetalleEvento()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="modal-body">
      <!-- Grid de Aforo y Registro -->
      <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 20px;">
        <div style="background: var(--green-soft); border: 1px solid rgba(57,169,0,0.25); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: var(--green-dark); text-transform: uppercase;">Inscritos</div>
          <div style="font-size: 24px; font-weight: 800; color: var(--green-dark); margin-top: 4px;" id="verEvt_registrados">0</div>
          <div style="font-size: 11px; color: var(--green-dark);">Confirmados</div>
        </div>

        <div style="background: #FAFCFB; border: 1px solid var(--line); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: var(--ink-soft); text-transform: uppercase;">Cupo Total</div>
          <div style="font-size: 24px; font-weight: 800; color: var(--forest); margin-top: 4px;" id="verEvt_cupo">0</div>
          <div style="font-size: 11px; color: var(--ink-soft);">Capacidad aforo</div>
        </div>

        <div style="background: #FEF7EA; border: 1px solid rgba(245,158,11,0.25); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: #9A3412; text-transform: uppercase;">Disponibles</div>
          <div style="font-size: 24px; font-weight: 800; color: #9A3412; margin-top: 4px;" id="verEvt_pendientes">0</div>
          <div style="font-size: 11px; color: #9A3412;">Cupos libres</div>
        </div>

        <div style="background: #EBF3FF; border: 1px solid rgba(37,99,235,0.25); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: #1E40AF; text-transform: uppercase;">Ocupación</div>
          <div style="font-size: 24px; font-weight: 800; color: #1E40AF; margin-top: 4px;" id="verEvt_rate">0%</div>
          <div style="font-size: 11px; color: #1E40AF;">Aforo completo</div>
        </div>
      </div>

      <!-- Barra de aforo ocupado -->
      <div class="form-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
          <span style="font-weight: 700; font-size: 12.5px; color: var(--forest);">Porcentaje de Aforo Confirmado</span>
          <span id="verEvt_rateLabel" style="font-weight: 800; font-size: 12px; color: var(--green-dark);">80%</span>
        </div>
        <div class="progress-bar" style="height: 10px;">
          <div id="verEvt_progressFill" class="progress-fill" style="width: 80%;"></div>
        </div>
      </div>

      <!-- Logística y Horarios -->
      <div class="form-section">
        <div class="form-section-title">
          <i class="fa-solid fa-clock" style="color: var(--green);"></i>
          <span>Coordenadas y Horarios</span>
        </div>
        <div class="form-row" style="margin-bottom: 12px;">
          <div>
            <span style="font-size: 11.5px; color: var(--ink-soft); display: block;">Fecha Programada:</span>
            <strong style="font-size: 13px; color: var(--forest);" id="verEvt_fecha">15/11/2026</strong>
          </div>
          <div>
            <span style="font-size: 11.5px; color: var(--ink-soft); display: block;">Franja Horaria:</span>
            <strong style="font-size: 13px; color: var(--forest);" id="verEvt_hora">02:00 PM - 05:00 PM</strong>
          </div>
        </div>
        <div class="form-row">
          <div>
            <span style="font-size: 11.5px; color: var(--ink-soft); display: block;">Ubicación / Plataforma:</span>
            <strong style="font-size: 13px; color: var(--forest);" id="verEvt_lugar">Ambiente 102 - CEFA La Angostura</strong>
          </div>
          <div>
            <span style="font-size: 11.5px; color: var(--ink-soft); display: block;">Programa Convocado:</span>
            <strong style="font-size: 13px; color: var(--forest);" id="verEvt_programa">ADSO Software</strong>
          </div>
        </div>
      </div>

      <!-- Agenda y Descripción -->
      <div class="form-section" style="margin-bottom: 0;">
        <div class="form-section-title">
          <i class="fa-solid fa-list-check" style="color: var(--green);"></i>
          <span>Agenda y Actividades del Encuentro</span>
        </div>
        <p id="verEvt_desc" style="font-size: 13px; color: var(--ink); line-height: 1.6; margin: 0; background: #ffffff; padding: 14px 16px; border: 1px solid var(--line); border-radius: 10px;">
          Socialización de proyectos productivos, experiencias laborales en empresas de desarrollo y retroalimentación curricular.
        </p>
      </div>
    </div>

    <div class="modal-foot">
      <button type="button" class="btn-cancel" onclick="invitarDesdeModal()">
        <i class="fa-solid fa-paper-plane mr-1" style="color: var(--green);"></i> Enviar Convocatoria
      </button>
      <button type="button" class="btn-submit" onclick="cerrarDetalleEvento()">
        <span>Cerrar Vista</span>
      </button>
    </div>
  </div>
</div>

</body>
</html>
