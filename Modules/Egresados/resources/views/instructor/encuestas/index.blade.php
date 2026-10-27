<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Encuestas — Instructor CEFA</title>

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

      /* Card Container */
      .card-box {
        background: var(--card);
        border-radius: 16px;
        border: 1px solid var(--line);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        overflow: hidden;
      }
      .card-box-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
      }
      .card-box-title {
        font-family: 'Poppins', 'Jost', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: var(--forest-deep);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .card-box-desc {
        font-size: 12.5px;
        color: var(--ink-soft);
        margin: 2px 0 0;
      }

      /* Surveys Table */
      .table-wrapper {
        overflow-x: auto;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
      }
      th {
        background: #F9FBFA;
        padding: 12px 20px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--ink-soft);
        border-bottom: 1px solid var(--line);
      }
      td {
        padding: 16px 20px;
        border-bottom: 1px solid var(--line);
        vertical-align: middle;
      }
      tr:last-child td {
        border-bottom: none;
      }
      tr:hover td {
        background: #FAFCFB;
      }

      .survey-title {
        font-weight: 700;
        color: var(--forest-deep);
        font-size: 14px;
        margin-bottom: 2px;
      }
      .survey-desc {
        font-size: 12px;
        color: var(--ink-soft);
        max-width: 360px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }

      .badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
      }
      .badge-green { background: #DCFCE7; color: #15803D; }
      .badge-gray { background: #F3F4F6; color: #6B7280; }
      .badge-blue { background: #DBEAFE; color: #1E40AF; }

      .progress-bar {
        width: 100px;
        height: 6px;
        background: #E5E7EB;
        border-radius: 999px;
        overflow: hidden;
        display: inline-block;
        vertical-align: middle;
        margin-right: 8px;
      }
      .progress-fill {
        height: 100%;
        background: var(--green);
        border-radius: 999px;
      }

      .action-btns {
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--green-soft);
        color: var(--green);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
        text-decoration: none;
        font-size: 13px;
      }
      .btn-icon:hover {
        background: var(--green);
        color: #ffffff;
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
      .question-card {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 10px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        transition: all 0.2s;
      }
      .question-card:hover {
        border-color: #A3D4AF;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
      }
      .question-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .question-type-badge {
        font-size: 10.5px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 6px;
        letter-spacing: 0.3px;
      }
      .type-mc { background: #EBF3FF; color: #1E40AF; }
      .type-scale { background: #FEF7EA; color: #9A3412; }
      .type-text { background: #F5EFFF; color: #6B21A8; }
      .type-bool { background: #EAF7EE; color: #065F46; }
      .btn-delete-q {
        background: none;
        border: none;
        color: #EF4444;
        cursor: pointer;
        font-size: 13px;
        padding: 4px 6px;
        border-radius: 6px;
        transition: background 0.15s;
      }
      .btn-delete-q:hover {
        background: #FEE2E2;
      }
      .btn-add-q {
        background: #ffffff;
        border: 1.5px dashed var(--green);
        color: var(--green-dark);
        font-size: 12.5px;
        font-weight: 700;
        padding: 10px 18px;
        border-radius: 10px;
        width: 100%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
      }
      .btn-add-q:hover {
        background: var(--green-soft);
        border-color: var(--green);
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
      }
      @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
        .content { padding: 20px 16px; }
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
      <a href="{{ route('egresados.instructor.encuestas.index') }}" class="active">
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
          <h1 class="page-title">Gestión de <span>Encuestas</span></h1>
          <p class="page-desc">Diseña, aplica y evalúa encuestas de inserción y satisfacción para egresados de tus fichas.</p>
        </div>
        <div>
          <button type="button" class="btn-primary" onclick="openModal()">
            <i class="fa-solid fa-plus"></i>
            <span>Nueva Encuesta</span>
          </button>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Total Encuestas</span>
            <div class="stat-icon blue"><i class="fa-solid fa-clipboard-list"></i></div>
          </div>
          <div class="stat-value">{{ count($encuestas) }}</div>
          <div class="stat-sub">Instrumentos creados</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Enviadas a Egresados</span>
            <div class="stat-icon green"><i class="fa-solid fa-paper-plane"></i></div>
          </div>
          <div class="stat-value">{{ $totalEnviadas }}</div>
          <div class="stat-sub">Destinatarios totales</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Respondidas</span>
            <div class="stat-icon amber"><i class="fa-solid fa-circle-check"></i></div>
          </div>
          <div class="stat-value">{{ $totalRespondidas }}</div>
          <div class="stat-sub">{{ $totalPendientes }} pendientes</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <span class="stat-label">Tasa de Respuesta</span>
            <div class="stat-icon purple"><i class="fa-solid fa-chart-pie"></i></div>
          </div>
          <div class="stat-value">{{ $tasaRespuestaGeneral }}</div>
          <div class="stat-sub">Participación promedio</div>
        </div>
      </div>

      <!-- Surveys Table Box -->
      <div class="card-box">
        <div class="card-box-header">
          <div>
            <h2 class="card-box-title"><i class="fa-solid fa-list-check" style="color: var(--green);"></i> Encuestas Activas y Realizadas</h2>
            <p class="card-box-desc">Monitorea el avance de recolección de información por instrumento.</p>
          </div>
        </div>

        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>Código / Instrumento</th>
                <th>Público Objetivo</th>
                <th>Fecha Creación</th>
                <th>Estado</th>
                <th>Participación</th>
                <th style="text-align: right;">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($encuestas as $enc)
              <tr>
                <td>
                  <div class="survey-title">{{ $enc['title'] }}</div>
                  <div class="survey-desc">{{ $enc['description'] }}</div>
                  <span style="font-family: monospace; font-size: 11px; color: var(--ink-soft);">ID: {{ $enc['id'] }}</span>
                </td>
                <td>
                  <span style="font-weight: 600; color: var(--forest-deep);">{{ $enc['target'] }}</span>
                  <div style="font-size: 11px; color: var(--ink-soft);">{{ $enc['creado_por'] ?? 'Instructor CEFA' }}</div>
                </td>
                <td>
                  <span style="color: var(--ink-soft); font-size: 12.5px;">{{ $enc['date'] }}</span>
                </td>
                <td>
                  @if(($enc['status'] ?? 'ACTIVA') === 'ACTIVA')
                    <span class="badge badge-green"><i class="fa-solid fa-circle" style="font-size: 7px; margin-right: 4px;"></i> Activa</span>
                  @else
                    <span class="badge badge-gray">Cerrada</span>
                  @endif
                </td>
                <td>
                  <div>
                    <div class="progress-bar">
                      <div class="progress-fill" style="width: {{ $enc['rate_num'] ?? 75 }}%;"></div>
                    </div>
                    <span style="font-weight: 700; font-size: 12px; color: var(--forest-deep);">{{ $enc['rate'] ?? '75%' }}</span>
                  </div>
                  <div style="font-size: 11px; color: var(--ink-soft); margin-top: 2px;">
                    {{ $enc['respondidas'] ?? 0 }} de {{ $enc['enviadas'] ?? 0 }} respuestas
                  </div>
                </td>
                <td style="text-align: right;">
                  <div class="action-btns" style="justify-content: flex-end;">
                    <button type="button" class="btn-icon" title="Copiar enlace público" onclick="copiarEnlaceEncuesta('{{ $enc['id'] }}')">
                      <i class="fa-solid fa-link"></i>
                    </button>
                    <button type="button" class="btn-icon" title="Ver detalles y resultados" onclick='abrirDetalleEncuesta(@json($enc))'>
                      <i class="fa-solid fa-chart-simple"></i>
                    </button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- ============================================== -->
<!-- MODAL: CREAR NUEVA ENCUESTA (FORMATO OFICIAL)  -->
<!-- ============================================== -->
<div class="modal-overlay" id="modalEncuesta">
  <div class="modal-box">
    <div class="modal-head">
      <div>
        <div class="format-badge"><i class="fa-solid fa-certificate"></i> FORMATO OFICIAL SENA SIGE-ENC-04 · CEFA LA ANGOSTURA</div>
        <h3 class="modal-title"><i class="fa-solid fa-clipboard-question" style="color: var(--green); margin-right: 8px;"></i> Diseñar y Publicar Encuesta</h3>
        <div class="modal-sub">Configuración integral del instrumento de seguimiento laboral y satisfacción para egresados.</div>
      </div>
      <button type="button" class="modal-close" onclick="closeModal()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form id="formNuevaEncuesta" action="{{ route('egresados.instructor.encuestas.store') }}" method="POST">
      @csrf
      <input type="hidden" name="estructura_preguntas" id="estructura_preguntas" value="">

      <div class="modal-body">
        
        <!-- Plantillas Rápidas -->
        <div style="margin-bottom: 8px;">
          <label class="form-label" style="font-size: 11.5px; color: var(--ink-soft);"><i class="fa-solid fa-wand-magic-sparkles" style="color: var(--green); margin-right: 4px;"></i> Plantillas sugeridas de formulario (clic para autocompletar):</label>
          <div class="template-pills">
            <button type="button" class="template-pill" onclick="aplicarPlantilla('insercion')">
              <i class="fa-solid fa-briefcase"></i> Inserción Laboral ADSO
            </button>
            <button type="button" class="template-pill" onclick="aplicarPlantilla('satisfaccion')">
              <i class="fa-solid fa-star"></i> Satisfacción y Pertinencia CEFA
            </button>
            <button type="button" class="template-pill" onclick="aplicarPlantilla('emprendimiento')">
              <i class="fa-solid fa-rocket"></i> Fondo Emprender & Proyectos
            </button>
            <button type="button" class="template-pill" onclick="aplicarPlantilla('bilinguismo')">
              <i class="fa-solid fa-language"></i> Diagnóstico de Bilingüismo & TIC
            </button>
          </div>
        </div>

        <!-- SECCIÓN 1: Identificación del Instrumento -->
        <div class="form-section">
          <div class="form-section-title">
            <span class="step-number">1</span>
            <span>Identificación y Objetivo de la Encuesta</span>
          </div>

          <div class="form-group">
            <label class="form-label">Título Oficial del Instrumento *</label>
            <input type="text" name="titulo" id="enc_titulo" class="form-control" placeholder="Ej. Encuesta de Inserción Laboral y Salarios ADSO 2026" required>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Objetivo Formativo / Área *</label>
              <select name="area_enfoque" class="form-control" required>
                <option value="Empleabilidad">Seguimiento de Empleabilidad</option>
                <option value="Pertinencia Curricular">Pertinencia y Calidad Curricular</option>
                <option value="Emprendimiento">Emprendimiento y Unidades Productivas</option>
                <option value="Formación Continua">Demanda de Cursos Complementarios</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Canal Prioritario de Envío</label>
              <select name="canal_envio" class="form-control">
                <option value="Portal y Correo">Portal SIGE + Correo Electrónico</option>
                <option value="Solo Portal">Solo Cartelera de Egresados</option>
                <option value="Enlace Directo">Enlace Compartible (WhatsApp / Redes)</option>
              </select>
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Descripción orientadora para el egresado</label>
            <textarea name="descripcion" id="enc_desc" class="form-control" rows="2" placeholder="Explica a los egresados para qué se usarán sus respuestas y el beneficio para el centro de formación..."></textarea>
          </div>
        </div>

        <!-- SECCIÓN 2: Convocatoria y Población Objetivo -->
        <div class="form-section">
          <div class="form-section-title">
            <span class="step-number">2</span>
            <span>Convocatoria y Población Egresada Destino</span>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Población Objetivo / Programa *</label>
              <select name="publico_objetivo" id="enc_target" class="form-control" required>
                <option value="Egresados ADSO">Egresados ADSO (Software)</option>
                <option value="Egresados Multimedia">Egresados Producción Multimedia</option>
                <option value="Egresados Agroindustria">Egresados Agroindustria & Pecuaria</option>
                <option value="Todas las Fichas del Instructor">Todas mis Fichas Asignadas</option>
                <option value="Todos los Egresados CEFA">Todos los Egresados del Centro</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Fecha Límite de Recepción *</label>
              <input type="date" name="fecha_cierre" class="form-control" value="{{ date('Y-m-d', strtotime('+30 days')) }}" required>
            </div>
          </div>
        </div>

        <!-- SECCIÓN 3: Banco y Preguntas del Instrumento -->
        <div class="form-section">
          <div class="form-section-title" style="justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 10px;">
              <span class="step-number">3</span>
              <span>Cuestionario del Formato</span>
            </div>
            <span id="qCountBadge" style="font-size: 11px; font-weight: 700; color: var(--green-dark); background: var(--green-soft); padding: 2px 10px; border-radius: 999px;">
              4 preguntas configuradas
            </span>
          </div>

          <div id="questionListContainer">
            <!-- Pregunta 1 -->
            <div class="question-card">
              <div class="question-head">
                <span class="question-type-badge type-mc"><i class="fa-solid fa-list-ul mr-1"></i> Selección Múltiple</span>
                <button type="button" class="btn-delete-q" onclick="eliminarPregunta(this)" title="Eliminar pregunta"><i class="fa-solid fa-trash-can"></i></button>
              </div>
              <input type="text" class="form-control q-input" value="¿Cuál es tu situación laboral o contractual actual en el sector?" placeholder="Texto de la pregunta..." required>
            </div>

            <!-- Pregunta 2 -->
            <div class="question-card">
              <div class="question-head">
                <span class="question-type-badge type-mc"><i class="fa-solid fa-list-ul mr-1"></i> Selección Múltiple</span>
                <button type="button" class="btn-delete-q" onclick="eliminarPregunta(this)" title="Eliminar pregunta"><i class="fa-solid fa-trash-can"></i></button>
              </div>
              <input type="text" class="form-control q-input" value="¿En cuánto tiempo lograste tu primera vinculación tras finalizar la etapa práctica?" placeholder="Texto de la pregunta..." required>
            </div>

            <!-- Pregunta 3 -->
            <div class="question-card">
              <div class="question-head">
                <span class="question-type-badge type-scale"><i class="fa-solid fa-star mr-1"></i> Escala de Calificación (1 a 5)</span>
                <button type="button" class="btn-delete-q" onclick="eliminarPregunta(this)" title="Eliminar pregunta"><i class="fa-solid fa-trash-can"></i></button>
              </div>
              <input type="text" class="form-control q-input" value="¿Cómo calificarías la pertinencia técnica de las herramientas aprendidas en CEFA frente a tu empleo?" placeholder="Texto de la pregunta..." required>
            </div>

            <!-- Pregunta 4 -->
            <div class="question-card">
              <div class="question-head">
                <span class="question-type-badge type-text"><i class="fa-solid fa-align-left mr-1"></i> Respuesta Libre</span>
                <button type="button" class="btn-delete-q" onclick="eliminarPregunta(this)" title="Eliminar pregunta"><i class="fa-solid fa-trash-can"></i></button>
              </div>
              <input type="text" class="form-control q-input" value="¿Qué tecnologías o habilidades complementarias consideras indispensables incluir hoy en el programa?" placeholder="Texto de la pregunta..." required>
            </div>
          </div>

          <div style="margin-top: 12px;">
            <button type="button" class="btn-add-q" onclick="agregarPregunta()">
              <i class="fa-solid fa-plus-circle"></i> Añadir Otra Pregunta al Cuestionario
            </button>
          </div>
        </div>

        <!-- SECCIÓN 4: Opciones de Difusión y Privacidad -->
        <div class="form-section" style="margin-bottom: 0;">
          <div class="form-section-title">
            <span class="step-number">4</span>
            <span>Parámetros de Privacidad y Entrega</span>
          </div>

          <label class="checkbox-label">
            <input type="checkbox" name="notificar_correo" checked>
            <span><strong>Enviar notificación automática por correo</strong> a los egresados de las fichas correspondientes.</span>
          </label>

          <label class="checkbox-label">
            <input type="checkbox" name="publicar_portal" checked>
            <span><strong>Publicar de inmediato en el Portal de Egresados</strong> con acceso público y botón de respuesta.</span>
          </label>

          <label class="checkbox-label">
            <input type="checkbox" name="anonima" value="1">
            <span><strong>Permitir respuestas anónimas</strong> (fomenta mayor franqueza en valoraciones de satisfacción).</span>
          </label>
        </div>

      </div>

      <div class="modal-foot">
        <button type="button" class="btn-cancel" onclick="closeModal()">Cancelar</button>
        <button type="submit" class="btn-submit" onclick="prepararEnvio()">
          <i class="fa-solid fa-paper-plane mr-1"></i> Publicar y Convocar Encuesta
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById('modalEncuesta').style.display = 'flex';
  }
  function closeModal() {
    document.getElementById('modalEncuesta').style.display = 'none';
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

  // Gestor interactivo de preguntas y plantillas
  function actualizarContador() {
    const items = document.querySelectorAll('#questionListContainer .question-card');
    const badge = document.getElementById('qCountBadge');
    if (badge) {
      badge.textContent = items.length + (items.length === 1 ? ' pregunta configurada' : ' preguntas configuradas');
    }
  }

  function eliminarPregunta(btn) {
    const card = btn.closest('.question-card');
    const container = document.getElementById('questionListContainer');
    if (container.querySelectorAll('.question-card').length <= 1) {
      alert('El formato debe contener al menos una pregunta para poder publicarse.');
      return;
    }
    card.remove();
    actualizarContador();
  }

  function agregarPregunta(texto = '', tipo = 'mc', label = 'Selección Múltiple') {
    const container = document.getElementById('questionListContainer');
    const card = document.createElement('div');
    card.className = 'question-card';
    card.innerHTML = `
      <div class="question-head">
        <span class="question-type-badge type-${tipo}"><i class="fa-solid fa-pen mr-1"></i> ${label}</span>
        <button type="button" class="btn-delete-q" onclick="eliminarPregunta(this)" title="Eliminar pregunta"><i class="fa-solid fa-trash-can"></i></button>
      </div>
      <input type="text" class="form-control q-input" value="${texto}" placeholder="Escribe aquí el texto de la nueva pregunta..." required>
    `;
    container.appendChild(card);
    actualizarContador();
    card.querySelector('input').focus();
  }

  function aplicarPlantilla(tipo) {
    const titulo = document.getElementById('enc_titulo');
    const desc = document.getElementById('enc_desc');
    const target = document.getElementById('enc_target');
    const container = document.getElementById('questionListContainer');
    container.innerHTML = '';

    if (tipo === 'insercion') {
      titulo.value = 'Encuesta de Inserción Laboral y Estabilidad 2026';
      desc.value = 'Conoce el estado contractual, rango salarial y formalidad laboral de los egresados formados en CEFA La Angostura.';
      target.value = 'Egresados ADSO';
      agregarPregunta('¿Actualmente te encuentras vinculado formalmente en tu área de formación?', 'bool', 'Sí / No');
      agregarPregunta('¿Cuál es tu tipo de vinculación laboral actual (Término indefinido, Obra labor, Prestación de servicios, Emprendimiento)?', 'mc', 'Selección Múltiple');
      agregarPregunta('¿Cuál es tu rango salarial mensual aproximado?', 'mc', 'Selección Múltiple');
      agregarPregunta('¿Qué competencias técnicas del programa consideras que marcaron la diferencia en tu contratación?', 'text', 'Respuesta Libre');
    } else if (tipo === 'satisfaccion') {
      titulo.value = 'Evaluación de Satisfacción Formativa y Calidad Institucional CEFA';
      desc.value = 'Monitoreo de la percepción del egresado sobre la calidad académica, infraestructura y acompañamiento del Centro.';
      target.value = 'Todas las Fichas del Instructor';
      agregarPregunta('¿Cómo calificas la preparación técnica recibida por tus instructores?', 'scale', 'Escala 1 a 5');
      agregarPregunta('¿Los ambientes y laboratorios de formación contaban con las herramientas necesarias?', 'scale', 'Escala 1 a 5');
      agregarPregunta('¿Recomendarías a otras personas formarse en el Centro de Formación Agroindustrial La Angostura?', 'bool', 'Sí / No');
      agregarPregunta('¿Qué aspectos consideras que deben mejorar en la formación técnica del centro?', 'text', 'Respuesta Libre');
    } else if (tipo === 'emprendimiento') {
      titulo.value = 'Sondeo de Unidades Productivas y Emprendimiento Rural';
      desc.value = 'Identificación de egresados que han constituido empresas o proyectos agropecuarios/tecnológicos en el Huila.';
      target.value = 'Egresados Agroindustria';
      agregarPregunta('¿Has iniciado alguna empresa o negocio propio a partir de lo aprendido en el SENA?', 'bool', 'Sí / No');
      agregarPregunta('¿En qué sector económico se encuentra clasificado tu emprendimiento?', 'mc', 'Selección Múltiple');
      agregarPregunta('¿Has recibido o tienes interés en acompañamiento de Fondo Emprender?', 'bool', 'Sí / No');
      agregarPregunta('Describe brevemente el producto o servicio principal que ofrece tu iniciativa:', 'text', 'Respuesta Libre');
    } else if (tipo === 'bilinguismo') {
      titulo.value = 'Diagnóstico de Competencias en Bilingüismo & Tecnologías Emergentes';
      desc.value = 'Evaluación de habilidades en idioma inglés y tecnologías de inteligencia artificial requeridas por las empresas.';
      target.value = 'Todos los Egresados CEFA';
      agregarPregunta('¿En tu puesto de trabajo utilizas el idioma inglés para comunicarte o redactar documentación?', 'mc', 'Selección Múltiple');
      agregarPregunta('¿Tu empresa exige conocimientos en herramientas de Inteligencia Artificial o Cloud?', 'bool', 'Sí / No');
      agregarPregunta('¿Qué temas te gustaría recibir en cursos complementarios de actualización profesional?', 'text', 'Respuesta Libre');
    }
  }

  function prepararEnvio() {
    const inputs = document.querySelectorAll('#questionListContainer .q-input');
    const preguntas = [];
    inputs.forEach((inp, idx) => {
      if (inp.value.trim() !== '') {
        preguntas.push({ id: idx + 1, texto: inp.value.trim() });
      }
    });
    document.getElementById('estructura_preguntas').value = JSON.stringify(preguntas);
  }

  // Visualizador modal de Detalle y Resultados de Encuesta
  let encuestaActual = null;

  function abrirDetalleEncuesta(enc) {
    encuestaActual = enc;
    document.getElementById('verEnc_title').textContent = enc.title || 'Detalle de la Encuesta';
    document.getElementById('verEnc_sub').textContent = 'Código: ' + (enc.id || 'ENC') + ' · Autor: ' + (enc.creado_por || 'Instructor CEFA');
    document.getElementById('verEnc_enviadas').textContent = enc.enviadas ?? 120;
    document.getElementById('verEnc_respondidas').textContent = enc.respondidas ?? 90;
    document.getElementById('verEnc_pendientes').textContent = enc.pendientes ?? 30;
    document.getElementById('verEnc_rate').textContent = enc.rate || '75%';
    document.getElementById('verEnc_rateLabel').textContent = enc.rate || '75%';
    document.getElementById('verEnc_progressFill').style.width = (enc.rate_num || 75) + '%';
    document.getElementById('verEnc_target').textContent = enc.target || 'Egresados CEFA';
    document.getElementById('verEnc_fecha').textContent = enc.date || 'Reciente';
    document.getElementById('verEnc_desc').textContent = enc.description || 'Sin descripción detallada.';

    // Renderizar preguntas
    const list = document.getElementById('verEnc_preguntasList');
    list.innerHTML = '';
    const preguntas = enc.preguntas && enc.preguntas.length > 0 ? enc.preguntas : [
      { id: 1, texto: '¿Actualmente te encuentras laborando en tu área de formación técnica?', tipo: 'mc', label: 'Selección Múltiple' },
      { id: 2, texto: '¿En cuánto tiempo lograste tu vinculación laboral tras egresar?', tipo: 'mc', label: 'Selección Múltiple' },
      { id: 3, texto: '¿Calificación de satisfacción con las competencias adquiridas en CEFA?', tipo: 'scale', label: 'Escala 1 a 5' },
      { id: 4, texto: '¿Qué herramientas tecnológicas recomiendas profundizar en el plan de estudios?', tipo: 'text', label: 'Respuesta Libre' }
    ];

    preguntas.forEach((q, idx) => {
      const item = document.createElement('div');
      item.style.cssText = 'background: #ffffff; border: 1px solid var(--line); border-radius: 10px; padding: 10px 14px; font-size: 12.5px; color: var(--ink); display: flex; align-items: center; justify-content: space-between;';
      item.innerHTML = `
        <div style="display: flex; align-items: center; gap: 8px;">
          <span style="font-weight: 700; color: var(--green-dark);">P${idx + 1}.</span>
          <span>${q.texto || q}</span>
        </div>
        <span class="question-type-badge type-${q.tipo || 'mc'}">${q.label || 'Múltiple'}</span>
      `;
      list.appendChild(item);
    });

    document.getElementById('modalVerEncuesta').style.display = 'flex';
  }

  function cerrarDetalleEncuesta() {
    document.getElementById('modalVerEncuesta').style.display = 'none';
  }

  function copiarEnlaceEncuesta(id) {
    const url = window.location.origin + '/egresados/encuestas/' + id;
    navigator.clipboard.writeText(url).then(() => {
      mostrarToast('¡Enlace de encuesta copiado al portapapeles!');
    }).catch(() => {
      mostrarToast('Enlace: ' + url);
    });
  }

  function copiarEnlaceDesdeModal() {
    if (encuestaActual && encuestaActual.id) {
      copiarEnlaceEncuesta(encuestaActual.id);
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

<!-- MODAL: VER DETALLE Y RESULTADOS DE ENCUESTA -->
<div class="modal-overlay" id="modalVerEncuesta">
  <div class="modal-box" style="max-width: 780px;">
    <div class="modal-head">
      <div>
        <div class="format-badge"><i class="fa-solid fa-square-poll-vertical"></i> RESULTADOS Y DETALLE · INSTRUMENTO DE SEGUIMIENTO</div>
        <h3 class="modal-title" id="verEnc_title">Título de la Encuesta</h3>
        <div class="modal-sub" id="verEnc_sub">ID: ENC-000 · Creado por: Instructor CEFA</div>
      </div>
      <button type="button" class="modal-close" onclick="cerrarDetalleEncuesta()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="modal-body">
      <!-- Grid de Métricas de la Encuesta -->
      <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 20px;">
        <div style="background: #FAFCFB; border: 1px solid var(--line); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: var(--ink-soft); text-transform: uppercase;">Enviadas</div>
          <div style="font-size: 24px; font-weight: 800; color: var(--forest); margin-top: 4px;" id="verEnc_enviadas">0</div>
          <div style="font-size: 11px; color: var(--ink-soft);">Egresados convocados</div>
        </div>

        <div style="background: var(--green-soft); border: 1px solid rgba(57,169,0,0.25); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: var(--green-dark); text-transform: uppercase;">Respondidas</div>
          <div style="font-size: 24px; font-weight: 800; color: var(--green-dark); margin-top: 4px;" id="verEnc_respondidas">0</div>
          <div style="font-size: 11px; color: var(--green-dark);">Completadas</div>
        </div>

        <div style="background: #FEF7EA; border: 1px solid rgba(245,158,11,0.25); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: #9A3412; text-transform: uppercase;">Pendientes</div>
          <div style="font-size: 24px; font-weight: 800; color: #9A3412; margin-top: 4px;" id="verEnc_pendientes">0</div>
          <div style="font-size: 11px; color: #9A3412;">Sin responder</div>
        </div>

        <div style="background: #EBF3FF; border: 1px solid rgba(37,99,235,0.25); border-radius: 12px; padding: 14px; text-align: center;">
          <div style="font-size: 11px; font-weight: 700; color: #1E40AF; text-transform: uppercase;">Tasa Respuesta</div>
          <div style="font-size: 24px; font-weight: 800; color: #1E40AF; margin-top: 4px;" id="verEnc_rate">0%</div>
          <div style="font-size: 11px; color: #1E40AF;">Participación</div>
        </div>
      </div>

      <!-- Barra de progreso visual -->
      <div class="form-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
          <span style="font-weight: 700; font-size: 12.5px; color: var(--forest);">Avance de Recolección de Información</span>
          <span id="verEnc_rateLabel" style="font-weight: 800; font-size: 12px; color: var(--green-dark);">75%</span>
        </div>
        <div class="progress-bar" style="height: 10px;">
          <div id="verEnc_progressFill" class="progress-fill" style="width: 75%;"></div>
        </div>
      </div>

      <!-- Datos del Instrumento -->
      <div class="form-section">
        <div class="form-section-title">
          <i class="fa-solid fa-circle-info" style="color: var(--green);"></i>
          <span>Información de la Convocatoria</span>
        </div>
        <div class="form-row" style="margin-bottom: 12px;">
          <div>
            <span style="font-size: 11.5px; color: var(--ink-soft); display: block;">Público Objetivo:</span>
            <strong style="font-size: 13px; color: var(--forest);" id="verEnc_target">Egresados ADSO</strong>
          </div>
          <div>
            <span style="font-size: 11.5px; color: var(--ink-soft); display: block;">Fecha de Emisión:</span>
            <strong style="font-size: 13px; color: var(--forest);" id="verEnc_fecha">12/06/2026</strong>
          </div>
        </div>
        <div>
          <span style="font-size: 11.5px; color: var(--ink-soft); display: block; margin-bottom: 4px;">Propósito / Descripción:</span>
          <p id="verEnc_desc" style="font-size: 13px; color: var(--ink); line-height: 1.5; margin: 0; background: #ffffff; padding: 12px 14px; border: 1px solid var(--line); border-radius: 10px;">
            Diagnóstico de inserción y estabilidad en el mercado de software para egresados ADSO.
          </p>
        </div>
      </div>

      <!-- Preguntas y Estructura del Cuestionario -->
      <div class="form-section" style="margin-bottom: 0;">
        <div class="form-section-title" style="justify-content: space-between;">
          <div style="display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-clipboard-list" style="color: var(--green);"></i>
            <span>Preguntas del Instrumento Evaluado</span>
          </div>
          <span style="font-size: 11px; font-weight: 700; color: var(--green-dark); background: var(--green-soft); padding: 2px 8px; border-radius: 999px;">
            Preguntas Activas
          </span>
        </div>
        <div id="verEnc_preguntasList" style="display: flex; flex-direction: column; gap: 8px;">
          <!-- Items dinámicos o preguntas base -->
        </div>
      </div>
    </div>

    <div class="modal-foot">
      <button type="button" class="btn-cancel" onclick="copiarEnlaceDesdeModal()">
        <i class="fa-solid fa-copy mr-1"></i> Copiar Enlace
      </button>
      <button type="button" class="btn-submit" onclick="cerrarDetalleEncuesta()">
        <span>Cerrar Vista</span>
      </button>
    </div>
  </div>
</div>

</body>
</html>
