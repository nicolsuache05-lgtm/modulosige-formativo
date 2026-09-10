<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Encuestas — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Fraunces + Plus Jakarta Sans / Work Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
      :root {
        --forest: #013819;
        --forest-deep: #012410;
        --green: #39A900;
        --green-dark: #2a7c00;
        --green-soft: #EAF7EE;
        --moss: #62E31D;
        --bg: #FCFCFA;
        --card: #FFFFFF;
        --ink: #16261C;
        --ink-soft: #6B7A70;
        --line: #E8EFE9;
        --gold: #D9A441;
      }

      * { box-sizing: border-box; }
      html, body { margin: 0; padding: 0; }

      body {
        font-family: 'Plus Jakarta Sans', 'Work Sans', sans-serif;
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
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        padding: 2px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      }
      .brand-badge img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
      }

      .brand-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 18px;
        letter-spacing: 0px;
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .brand-sub {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 2px;
        line-height: 1.2;
      }

      nav {
        margin-top: 20px;
      }
      nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 10px;
        color: rgba(255, 255, 255, 0.82);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
        transition: all 0.15s ease;
      }
      nav a i, nav a svg {
        width: 18px;
        font-size: 16px;
        text-align: center;
        flex-shrink: 0;
      }
      nav a:hover {
        background: rgba(255, 255, 255, 0.09);
        color: #ffffff;
      }
      nav a.active {
        background: var(--green-dark);
        color: #ffffff;
        font-weight: 600;
      }
      nav a.active i, nav a.active svg {
        color: #ffffff;
      }

      .sidebar-foot {
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.14);
      }
      .logout-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        border-radius: 10px;
        background: transparent;
        border: none;
        width: 100%;
        text-align: left;
        transition: all 0.15s ease;
        text-decoration: none;
      }
      .logout-btn:hover {
        background: rgba(239, 68, 68, 0.15);
        color: #fca5a5;
      }

      /* ---------------- MAIN ---------------- */
      .main {
        display: flex;
        flex-direction: column;
        min-width: 0;
      }

      .topbar {
        background: var(--card);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 36px;
        border-bottom: 1px solid var(--line);
      }

      .topbar-left {
        display: flex;
        align-items: center;
        gap: 14px;
      }

      .hamburger {
        background: none;
        border: none;
        font-size: 20px;
        color: var(--ink);
        cursor: pointer;
      }

      .topbar-right {
        display: flex;
        align-items: center;
        gap: 18px;
      }

      .icon-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        color: var(--ink);
        transition: all 0.2s ease;
        border: none;
      }
      .icon-btn:hover {
        background: rgba(0, 0, 0, 0.05);
      }
      .icon-btn .badge {
        position: absolute;
        top: 2px;
        right: 4px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #dc2626;
        color: white;
        font-size: 10px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .user-profile {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--forest);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
      }
      .user-info {
        display: flex;
        flex-direction: column;
      }
      .user-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .user-role {
        font-size: 11px;
        color: var(--ink-soft);
      }

      /* ---------------- CONTENT ---------------- */
      .content {
        padding: 34px 40px 48px;
        flex: 1;
      }

      .page-head {
        margin-bottom: 24px;
      }
      .page-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 24px;
        margin: 0 0 6px;
        color: var(--forest);
      }
      .page-desc {
        font-size: 13.5px;
        color: var(--ink-soft);
        margin: 0;
      }

      /* Stats Grid (3 Cards) */
      .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
      }
      .stat-card {
        background: var(--card);
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--line);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        display: flex;
        flex-direction: column;
      }

      .stat-content {
        display: flex;
        gap: 20px;
        align-items: flex-start;
      }

      .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--forest);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
      }

      .stat-details {
        display: flex;
        flex-direction: column;
      }

      .stat-title {
        font-size: 13.5px;
        color: var(--ink);
        font-weight: 600;
        margin-bottom: 4px;
      }

      .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: var(--ink);
        line-height: 1;
        margin-bottom: 4px;
      }

      .stat-subtitle {
        font-size: 12.5px;
        color: var(--ink-soft);
      }

      .stat-footer {
        margin-top: 16px;
        text-align: left;
      }

      .stat-link {
        font-size: 12.5px;
        color: var(--forest);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: color 0.15s ease;
      }
      .stat-link:hover {
        color: var(--green);
        text-decoration: underline;
      }

      /* ---------------- MAIN GRID ---------------- */
      .main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
      }

      /* LEFT COLUMN: LIST */
      .tabs-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        border-bottom: 1px solid var(--line);
        padding-bottom: 10px;
      }
      .tabs {
        display: flex;
        gap: 24px;
      }
      .tab {
        font-size: 14px;
        font-weight: 600;
        color: var(--ink-soft);
        text-decoration: none;
        position: relative;
        padding-bottom: 10px;
      }
      .tab.active {
        color: var(--forest);
      }
      .tab.active::after {
        content: '';
        position: absolute;
        bottom: -11px;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--forest);
      }
      .tab-badge {
        font-size: 12px;
        color: var(--ink-soft);
      }
      
      .filters {
        display: flex;
        gap: 12px;
        align-items: center;
      }
      .search-box {
        position: relative;
        display: flex;
        align-items: center;
      }
      .search-box input {
        border: 1px solid var(--line);
        border-radius: 8px;
        padding: 8px 12px 8px 32px;
        font-size: 13px;
        outline: none;
        width: 200px;
      }
      .search-box i {
        position: absolute;
        left: 10px;
        color: var(--ink-soft);
        font-size: 13px;
      }
      .filter-select {
        border: 1px solid var(--line);
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 13px;
        outline: none;
        background: #fff;
        color: var(--ink);
      }

      .survey-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
        display: flex;
        gap: 20px;
      }
      .survey-icon {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background: var(--green-soft);
        color: var(--forest);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
      }
      .survey-icon.purple {
        background: #F3E8FF;
        color: #7E22CE;
      }
      .survey-body {
        flex: 1;
      }
      .survey-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 8px;
      }
      .survey-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--ink);
        margin: 0 0 6px 0;
      }
      .survey-tag {
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 6px;
        background: var(--green-soft);
        color: var(--forest);
        margin-bottom: 10px;
      }
      .survey-tag.purple {
        background: #F3E8FF;
        color: #7E22CE;
      }
      .survey-meta {
        display: flex;
        gap: 16px;
        font-size: 12px;
        color: var(--ink-soft);
        margin-bottom: 12px;
      }
      .survey-meta i {
        margin-right: 4px;
      }
      .survey-desc {
        font-size: 13px;
        color: var(--ink-soft);
        line-height: 1.5;
        margin-bottom: 16px;
      }
      .survey-progress-bar {
        width: 100%;
        height: 6px;
        background: var(--line);
        border-radius: 4px;
        margin-bottom: 6px;
        overflow: hidden;
      }
      .survey-progress-fill {
        height: 100%;
        background: var(--forest);
        border-radius: 4px;
        width: 0%;
      }
      .survey-progress-text {
        font-size: 11px;
        color: var(--ink-soft);
        display: block;
        text-align: right;
      }
      
      .btn-responder {
        background: var(--forest);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
      }
      .btn-responder:hover {
        background: var(--forest-deep);
      }
      .survey-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 16px;
      }
      .link-detalles {
        font-size: 12.5px;
        color: var(--forest);
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
      }
      .link-detalles:hover {
        text-decoration: underline;
      }

      /* RIGHT COLUMN: INFO */
      .info-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
      }
      .info-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--forest);
        margin: 0 0 16px 0;
      }
      .info-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
      }
      .info-item {
        display: flex;
        gap: 12px;
      }
      .info-item-icon {
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
      .info-item-text h4 {
        font-size: 13px;
        font-weight: 700;
        color: var(--ink);
        margin: 0 0 4px 0;
      }
      .info-item-text p {
        font-size: 12px;
        color: var(--ink-soft);
        margin: 0;
        line-height: 1.4;
      }

      .alert-box {
        background: #F0F9FF;
        border-radius: 8px;
        padding: 16px;
        display: flex;
        gap: 12px;
      }
      .alert-box i {
        color: #0284C7;
        font-size: 16px;
        margin-top: 2px;
      }
      .alert-box-text h4 {
        font-size: 13px;
        font-weight: 700;
        color: #0369A1;
        margin: 0 0 4px 0;
      }
      .alert-box-text p {
        font-size: 12px;
        color: #0C4A6E;
        margin: 0;
        line-height: 1.4;
      }

      /* MODAL CSS */
      .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
      }
      .modal-overlay.active {
        opacity: 1;
        visibility: visible;
      }
      .modal-content {
        background: #fff;
        width: 100%;
        max-width: 500px;
        border-radius: 12px;
        padding: 30px;
        position: relative;
        transform: translateY(-20px);
        transition: all 0.3s ease;
        max-height: 90vh;
        overflow-y: auto;
      }
      .modal-overlay.active .modal-content {
        transform: translateY(0);
      }
      .modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        background: transparent;
        border: none;
        font-size: 20px;
        color: var(--ink-soft);
        cursor: pointer;
      }
      .modal-header {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--forest);
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
      }
      .modal-header i {
        font-size: 20px;
      }
      .survey-info-box {
        background: var(--green-soft);
        border: 1px solid #c8e6c9;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 16px;
      }
      .survey-info-title {
        color: var(--forest);
        font-weight: 700;
        font-size: 15px;
        margin: 0 0 8px 0;
      }
      .survey-info-desc {
        color: var(--ink);
        font-size: 13px;
        margin: 0;
        line-height: 1.4;
      }
      .required-text {
        color: #dc2626;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 20px;
      }
      .survey-question {
        border-bottom: 1px solid var(--line);
        padding-bottom: 20px;
        margin-bottom: 20px;
      }
      .survey-question:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
      }
      .question-title {
        font-weight: 700;
        font-size: 14px;
        color: var(--ink);
        margin: 0 0 12px 0;
      }
      .question-title span {
        color: #dc2626;
      }
      .radio-option {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        font-size: 13.5px;
        color: var(--ink);
        cursor: pointer;
      }
      .radio-option input[type="radio"] {
        accent-color: var(--forest);
        width: 16px;
        height: 16px;
      }
      .specify-input {
        margin-top: 8px;
        width: 100%;
        max-width: 300px;
        border: 1px solid var(--line);
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 13px;
        outline: none;
        margin-left: 24px;
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
        .tabs-bar { flex-direction: column; align-items: flex-start; gap: 16px; }
        .filters { width: 100%; flex-wrap: wrap; }
      }
    </style>
</head>
<body>

<div class="app">

  <!-- SIDEBAR INSTITUCIONAL -->
  <aside class="sidebar">
    <a href="{{ route('egresados.dashboard_egresado') }}" class="brand">
      <div class="brand-badge">
        <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA">
      </div>
      <div>
        <div class="brand-name">
          <span>SIGE</span>
        </div>
        <div class="brand-sub">Sistema de Gestión<br>de Egresados</div>
      </div>
    </a>

    <nav>
      <a href="{{ route('egresados.dashboard_egresado') }}">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
      </a>
      <a href="{{ route('egresados.encuestas_egresado') }}" class="active">
        <i class="fa-solid fa-clipboard-list"></i>
        <span>Encuestas</span>
      </a>
      <a href="#">
        <i class="fa-solid fa-briefcase"></i>
        <span>Oportunidades Laborales</span>
      </a>
      <a href="#">
        <i class="fa-regular fa-calendar-days"></i>
        <span>Noticias y Eventos</span>
      </a>
      <a href="#">
        <i class="fa-regular fa-bell"></i>
        <span>Notificaciones</span>
      </a>
    </nav>

    <div class="sidebar-foot">
      @auth
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
          <button type="submit" class="logout-btn">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Cerrar sesión</span>
          </button>
        </form>
      @else
        <a href="{{ route('login', ['redirect' => route('egresados.dashboard_egresado')]) }}" class="logout-btn">
          <i class="fa-solid fa-arrow-right-to-bracket"></i>
          <span>Cerrar Sesión</span>
        </a>
      @endauth
    </div>
  </aside>

  <!-- MAIN VIEWPORT -->
  <div class="main">
    
    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-left">
        <button class="hamburger">
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>

      <div class="topbar-right">
        <button class="icon-btn" title="Notificaciones">
          <i class="fa-regular fa-bell"></i>
          <span class="badge">3</span>
        </button>

        <div class="user-profile">
          <div class="user-avatar">
            @auth
              {{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->name ?? 'AM', 0, 2)) }}
            @else
              AM
            @endauth
          </div>
          <div class="user-info">
            <div class="user-name">
              @auth
                {{ Auth::user()->first_name ?? Auth::user()->name ?? 'Ana María López' }}
              @else
                Ana María López
              @endauth
              <i class="fa-solid fa-chevron-down text-[10px] text-ink/60"></i>
            </div>
            <div class="user-role">Egresada</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="content">
      
      <!-- Page Head -->
      <div class="page-head">
        <h1 class="page-title">Encuestas</h1>
        <p class="page-desc">Participa en las encuestas disponibles y ayúdanos a mejorar nuestra gestión y servicios.</p>
      </div>

      <!-- Stats Grid (3 Cards) -->
      <div class="stats-grid">
        
        <!-- Card 1: Encuestas Pendientes -->
        <div class="stat-card">
          <div class="stat-content">
            <div class="stat-icon">
              <i class="fa-regular fa-clipboard"></i>
            </div>
            <div class="stat-details">
              <div class="stat-title">Encuestas Pendientes</div>
              <div class="stat-value">2</div>
              <div class="stat-subtitle">Encuestas por responder</div>
            </div>
          </div>
          <div class="stat-footer">
            <a href="#" class="stat-link">
              <span>Ver encuestas pendientes</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 2: Encuestas Respondidas -->
        <div class="stat-card">
          <div class="stat-content">
            <div class="stat-icon">
              <i class="fa-regular fa-circle-check"></i>
            </div>
            <div class="stat-details">
              <div class="stat-title">Encuestas Respondidas</div>
              <div class="stat-value">5</div>
              <div class="stat-subtitle">Encuestas completadas</div>
            </div>
          </div>
          <div class="stat-footer">
            <a href="#" class="stat-link">
              <span>Ver encuestas respondidas</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Card 3: Participación -->
        <div class="stat-card">
          <div class="stat-content">
            <div class="stat-icon">
              <i class="fa-solid fa-chart-pie"></i>
            </div>
            <div class="stat-details">
              <div class="stat-title">Participación</div>
              <div class="stat-value">85%</div>
              <div class="stat-subtitle">Nivel de participación</div>
            </div>
          </div>
          <div class="stat-footer">
            <a href="#" class="stat-link">
              <span>Ver historial</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- MAIN GRID -->
      <div class="main-grid">
        
        <!-- LEFT COLUMN -->
        <div class="left-col">
          
          <div class="tabs-bar">
            <div class="tabs">
              <a href="#" class="tab active">Pendientes (2)</a>
              <a href="#" class="tab">Respondidas <span class="tab-badge">(5)</span></a>
              <a href="#" class="tab">Todas <span class="tab-badge">(7)</span></a>
            </div>
            <div class="filters">
              <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar encuesta...">
              </div>
              <select class="filter-select">
                <option>Todas las categorías</option>
              </select>
            </div>
          </div>

          <!-- Encuesta 1 -->
          <div class="survey-card">
            <div class="survey-icon">
              <i class="fa-regular fa-clipboard"></i>
            </div>
            <div class="survey-body">
              <div class="survey-header">
                <div>
                  <h3 class="survey-title">Satisfacción con los servicios institucionales 2024</h3>
                  <span class="survey-tag">Institucional</span>
                </div>
                <div class="survey-actions">
                  <button class="btn-responder" onclick="openSurveyModal()">Responder encuesta</button>
                  <a href="#" class="link-detalles">Ver detalles <i class="fa-solid fa-arrow-right"></i></a>
                </div>
              </div>
              
              <div class="survey-meta">
                <span><i class="fa-regular fa-calendar"></i> Fecha límite: 31 de mayo, 2024</span>
                <span><i class="fa-regular fa-clock"></i> Tiempo estimado: 10 min</span>
              </div>
              <p class="survey-desc">Ayúdanos a conocer tu nivel de satisfacción con los servicios que ofrece nuestra institución.</p>
              
              <div>
                <div class="survey-progress-bar">
                  <div class="survey-progress-fill" style="width: 5%;"></div>
                </div>
                <span class="survey-progress-text">0% completado</span>
              </div>
            </div>
          </div>

          <!-- Encuesta 2 -->
          <div class="survey-card">
            <div class="survey-icon purple">
              <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="survey-body">
              <div class="survey-header">
                <div>
                  <h3 class="survey-title">Seguimiento laboral a egresados 2024</h3>
                  <span class="survey-tag purple">Laboral</span>
                </div>
                <div class="survey-actions">
                  <button class="btn-responder" onclick="openSurveyModal()">Responder encuesta</button>
                  <a href="#" class="link-detalles">Ver detalles <i class="fa-solid fa-arrow-right"></i></a>
                </div>
              </div>
              
              <div class="survey-meta">
                <span><i class="fa-regular fa-calendar"></i> Fecha límite: 15 de junio, 2024</span>
                <span><i class="fa-regular fa-clock"></i> Tiempo estimado: 15 min</span>
              </div>
              <p class="survey-desc">Información importante para conocer tu situación laboral actual y mejorar nuestras oportunidades.</p>
              
              <div>
                <div class="survey-progress-bar">
                  <div class="survey-progress-fill" style="width: 5%;"></div>
                </div>
                <span class="survey-progress-text">0% completado</span>
              </div>
            </div>
          </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-col">
          
          <div class="info-card">
            <h3 class="info-title">¿Por qué participar?</h3>
            <div class="info-list">
              <div class="info-item">
                <div class="info-item-icon"><i class="fa-solid fa-users"></i></div>
                <div class="info-item-text">
                  <h4>Tu opinión nos ayuda a mejorar</h4>
                  <p>Con tus respuestas podemos ofrecer mejores servicios y oportunidades.</p>
                </div>
              </div>
              <div class="info-item">
                <div class="info-item-icon"><i class="fa-solid fa-chart-column"></i></div>
                <div class="info-item-text">
                  <h4>Impacta en decisiones importantes</h4>
                  <p>Tus respuestas contribuyen a la toma de decisiones institucionales.</p>
                </div>
              </div>
              <div class="info-item">
                <div class="info-item-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="info-item-text">
                  <h4>Información confidencial</h4>
                  <p>Tus respuestas son anónimas y serán tratadas con total confidencialidad.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="alert-box">
            <i class="fa-solid fa-circle-info"></i>
            <div class="alert-box-text">
              <h4>Información importante</h4>
              <p>Las encuestas tienen fechas límite establecidas. Asegúrate de completarlas antes de que expiren para que tu opinión sea tomada en cuenta.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<!-- MODAL ENCUESTA -->
<div class="modal-overlay" id="surveyModal">
  <div class="modal-content">
    <button class="modal-close" onclick="closeSurveyModal()"><i class="fa-solid fa-xmark"></i></button>
    
    <div class="modal-header">
      <i class="fa-regular fa-eye"></i>
      Vista previa de la encuesta
    </div>

    <div class="survey-info-box">
      <h3 class="survey-info-title">Encuesta Insercion Laboral</h3>
      <p class="survey-info-desc">Encuesta para conocer la situación laboral y experiencias de los egresados del programa ADSO.</p>
    </div>

    <div class="required-text">* Campos obligatorios</div>

    <form onsubmit="event.preventDefault(); closeSurveyModal();">
      <!-- Pregunta 1 -->
      <div class="survey-question">
        <h4 class="question-title">1. ¿Qué tan satisfecho está con su formación académica? <span>*</span></h4>
        <label class="radio-option">
          <input type="radio" name="q1" required> Excelente
        </label>
        <label class="radio-option">
          <input type="radio" name="q1"> Buena
        </label>
        <label class="radio-option">
          <input type="radio" name="q1"> Regular
        </label>
        <label class="radio-option">
          <input type="radio" name="q1"> Mala
        </label>
      </div>

      <!-- Pregunta 2 -->
      <div class="survey-question">
        <h4 class="question-title">2. ¿Actualmente se encuentra trabajando? <span>*</span></h4>
        <label class="radio-option">
          <input type="radio" name="q2" required> Si
        </label>
        <label class="radio-option">
          <input type="radio" name="q2"> No
        </label>
      </div>

      <!-- Pregunta 3 -->
      <div class="survey-question">
        <h4 class="question-title">3. ¿En qué área se desempeña actualmente? <span>*</span></h4>
        <label class="radio-option">
          <input type="radio" name="q3" required> Administrativa
        </label>
        <label class="radio-option">
          <input type="radio" name="q3"> Financiera
        </label>
        <label class="radio-option">
          <input type="radio" name="q3"> Comercial
        </label>
        <label class="radio-option">
          <input type="radio" name="q3"> Otra
        </label>
        <input type="text" class="specify-input" placeholder="Especifique">
      </div>

      <div style="margin-top: 24px; text-align: right;">
        <button type="submit" class="btn-responder">Enviar Respuestas</button>
      </div>
    </form>
  </div>
</div>

<script>
  function openSurveyModal() {
    document.getElementById('surveyModal').classList.add('active');
  }
  function closeSurveyModal() {
    document.getElementById('surveyModal').classList.remove('active');
  }
</script>

</body>
</html>
