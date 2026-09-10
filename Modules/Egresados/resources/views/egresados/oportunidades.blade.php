<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Oportunidades Laborales — CEFA La Angostura</title>

    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
      :root {
        --forest: #013819;
        --forest-deep: #012410;
        --green: #39A900;
        --green-dark: #2a7c00;
        --green-soft: #EAF7EE;
        --bg: #FCFCFA;
        --card: #FFFFFF;
        --ink: #16261C;
        --ink-soft: #6B7A70;
        --line: #E8EFE9;
      }
      * { box-sizing: border-box; }
      html, body { margin: 0; padding: 0; }
      body {
        font-family: 'Plus Jakarta Sans', sans-serif;
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

      /* ---- SIDEBAR ---- */
      .sidebar {
        background: linear-gradient(180deg, var(--forest) 0%, var(--forest-deep) 100%);
        color: #fff;
        display: flex;
        flex-direction: column;
        padding: 22px 16px;
      }
      .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 4px 8px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.14);
        margin-bottom: 16px;
        text-decoration: none;
        color: #fff;
      }
      .brand-badge {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: #fff;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      }
      .brand-badge img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
      .brand-name { font-weight: 700; font-size: 18px; }
      .brand-sub { font-size: 11px; color: rgba(255,255,255,0.7); margin-top: 2px; line-height: 1.2; }
      nav { margin-top: 20px; }
      nav a {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 14px; border-radius: 10px;
        color: rgba(255,255,255,0.82); text-decoration: none;
        font-size: 14px; font-weight: 500; margin-bottom: 8px;
        transition: all 0.15s ease;
      }
      nav a i { width: 18px; font-size: 16px; text-align: center; flex-shrink: 0; }
      nav a:hover { background: rgba(255,255,255,0.09); color: #fff; }
      nav a.active { background: var(--green-dark); color: #fff; font-weight: 600; }
      .sidebar-foot {
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid rgba(255,255,255,0.14);
      }
      .logout-btn {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px; color: rgba(255,255,255,0.8);
        font-size: 13.5px; font-weight: 600;
        border-radius: 10px; background: transparent; border: none;
        width: 100%; text-align: left; transition: all 0.15s ease; text-decoration: none; cursor: pointer;
      }
      .logout-btn:hover { background: rgba(239,68,68,0.15); color: #fca5a5; }

      /* ---- TOPBAR ---- */
      .main { display: flex; flex-direction: column; min-width: 0; }
      .topbar {
        background: var(--card);
        display: flex; align-items: center; justify-content: space-between;
        padding: 12px 36px;
        border-bottom: 1px solid var(--line);
      }
      .hamburger { background: none; border: none; font-size: 20px; color: var(--ink); cursor: pointer; }
      .topbar-right { display: flex; align-items: center; gap: 18px; }
      .icon-btn {
        width: 36px; height: 36px; border-radius: 50%;
        background: transparent; display: flex; align-items: center; justify-content: center;
        cursor: pointer; position: relative; color: var(--ink); border: none; transition: all 0.2s;
      }
      .icon-btn:hover { background: rgba(0,0,0,0.05); }
      .icon-btn .badge {
        position: absolute; top: 2px; right: 4px;
        width: 16px; height: 16px; border-radius: 50%;
        background: #dc2626; color: white;
        font-size: 10px; font-weight: bold;
        display: flex; align-items: center; justify-content: center;
      }
      .user-profile { display: flex; align-items: center; gap: 10px; }
      .user-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        background: var(--forest); color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 14px;
      }
      .user-info { display: flex; flex-direction: column; }
      .user-name { font-size: 14px; font-weight: 700; color: var(--ink); }
      .user-role { font-size: 11px; color: var(--ink-soft); }

      /* ---- CONTENT ---- */
      .content { padding: 34px 40px 48px; flex: 1; }
      .page-head { margin-bottom: 24px; }
      .page-title { font-weight: 700; font-size: 24px; margin: 0 0 6px; color: var(--forest); }
      .page-desc { font-size: 13.5px; color: var(--ink-soft); margin: 0; }

      /* Stats */
      .stats-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 20px; margin-bottom: 30px;
      }
      .stat-card {
        background: var(--card); border-radius: 12px; padding: 24px;
        border: 1px solid var(--line); box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        display: flex; flex-direction: column;
      }
      .stat-content { display: flex; gap: 20px; align-items: flex-start; }
      .stat-icon {
        width: 50px; height: 50px; border-radius: 50%;
        background: var(--forest); color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; flex-shrink: 0;
      }
      .stat-title { font-size: 13.5px; color: var(--ink); font-weight: 600; margin-bottom: 4px; }
      .stat-value { font-size: 28px; font-weight: 700; color: var(--ink); line-height: 1; margin-bottom: 4px; }
      .stat-subtitle { font-size: 12.5px; color: var(--ink-soft); }
      .stat-footer { margin-top: 16px; }
      .stat-link {
        font-size: 12.5px; color: var(--forest); font-weight: 600;
        text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
      }
      .stat-link:hover { color: var(--green); text-decoration: underline; }

      /* ---- MAIN GRID ---- */
      .main-grid { display: grid; grid-template-columns: 1fr 260px; gap: 24px; }

      /* LEFT - Job list */
      .section-title { font-size: 18px; font-weight: 700; color: var(--ink); margin: 0 0 16px; }
      .search-bar {
        display: flex; gap: 10px; margin-bottom: 16px; flex-wrap: wrap;
      }
      .search-box {
        position: relative; flex: 1; min-width: 180px;
      }
      .search-box input {
        width: 100%; border: 1px solid var(--line); border-radius: 8px;
        padding: 9px 12px 9px 36px; font-size: 13px; outline: none;
        font-family: inherit;
      }
      .search-box i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--ink-soft); font-size: 13px; }
      .filter-select {
        border: 1px solid var(--line); border-radius: 8px;
        padding: 9px 12px; font-size: 13px; outline: none;
        background: #fff; color: var(--ink); font-family: inherit; cursor: pointer;
      }

      .job-card {
        background: var(--card); border: 1px solid var(--line);
        border-radius: 12px; padding: 20px;
        margin-bottom: 14px; display: flex; gap: 16px;
        transition: box-shadow 0.2s, border-color 0.2s;
      }
      .job-card:hover { box-shadow: 0 6px 20px rgba(1,56,25,0.07); border-color: rgba(57,169,0,0.3); }
      .job-logo {
        width: 48px; height: 48px; border-radius: 10px;
        background: var(--green-soft); border: 1px solid var(--line);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; color: var(--forest); flex-shrink: 0;
        font-weight: 700; font-size: 15px;
        overflow: hidden;
      }
      .job-logo img { width: 100%; height: 100%; object-fit: cover; }
      .job-body { flex: 1; min-width: 0; }
      .job-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 6px; }
      .job-title { font-size: 14.5px; font-weight: 700; color: var(--ink); margin: 0 0 3px; }
      .job-company { font-size: 13px; color: var(--ink-soft); }
      .job-badges { display: flex; gap: 6px; align-items: center; }
      .badge-new {
        background: #D1FAE5; color: #065F46;
        font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px;
      }
      .job-meta {
        display: flex; flex-wrap: wrap; gap: 12px;
        font-size: 12px; color: var(--ink-soft); margin: 8px 0;
      }
      .job-meta span { display: flex; align-items: center; gap: 5px; }
      .job-desc { font-size: 12.5px; color: var(--ink-soft); line-height: 1.5; margin: 0; }
      .job-footer { display: flex; justify-content: flex-end; margin-top: 12px; gap: 8px; }
      .btn-ver {
        background: var(--forest); color: #fff; border: none;
        border-radius: 7px; padding: 8px 18px; font-size: 13px; font-weight: 600;
        cursor: pointer; text-decoration: none; transition: background 0.2s;
        font-family: inherit;
      }
      .btn-ver:hover { background: var(--green-dark); }
      .btn-guardar {
        width: 34px; height: 34px; border-radius: 7px;
        border: 1px solid var(--line); background: #fff;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: var(--ink-soft); transition: all 0.2s;
      }
      .btn-guardar:hover { border-color: var(--forest); color: var(--forest); }

      .ver-todas-link {
        display: inline-flex; align-items: center; gap: 6px;
        color: var(--forest); font-weight: 600; font-size: 13.5px;
        text-decoration: none; margin-top: 4px;
      }
      .ver-todas-link:hover { color: var(--green); }

      /* RIGHT - Filters panel */
      .filter-panel {
        background: var(--card); border: 1px solid var(--line);
        border-radius: 12px; padding: 22px;
      }
      .filter-panel-title { font-size: 15px; font-weight: 700; color: var(--ink); margin: 0 0 18px; }
      .filter-group { margin-bottom: 22px; }
      .filter-group-title { font-size: 13px; font-weight: 700; color: var(--ink); margin: 0 0 10px; }
      .filter-checkbox {
        display: flex; align-items: center; gap: 8px;
        font-size: 13px; color: var(--ink); margin-bottom: 8px; cursor: pointer;
      }
      .filter-checkbox input[type="checkbox"] { accent-color: var(--forest); width: 15px; height: 15px; }
      .filter-select-full {
        width: 100%; border: 1px solid var(--line); border-radius: 8px;
        padding: 9px 12px; font-size: 13px; outline: none;
        background: #fff; color: var(--ink); font-family: inherit;
      }
      .btn-apply {
        width: 100%; background: var(--forest); color: #fff; border: none;
        border-radius: 8px; padding: 11px; font-size: 13.5px; font-weight: 700;
        cursor: pointer; font-family: inherit; margin-bottom: 10px; transition: background 0.2s;
      }
      .btn-apply:hover { background: var(--green-dark); }
      .btn-clear {
        width: 100%; background: transparent; color: var(--ink-soft); border: none;
        font-size: 13px; font-weight: 600; cursor: pointer; font-family: inherit;
        text-decoration: underline; text-align: center;
      }
      .btn-clear:hover { color: #dc2626; }

      @media (max-width: 1100px) {
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
</head>
<body>
<div class="app">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <a href="{{ route('egresados.dashboard_egresado') }}" class="brand">
      <div class="brand-badge">
        <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA">
      </div>
      <div>
        <div class="brand-name">SIGE</div>
        <div class="brand-sub">Sistema de Gestión<br>de Egresados</div>
      </div>
    </a>
    <nav>
      <a href="{{ route('egresados.dashboard_egresado') }}">
        <i class="fa-solid fa-house"></i><span>Inicio</span>
      </a>
      <a href="{{ route('egresados.encuestas_egresado') }}">
        <i class="fa-solid fa-clipboard-list"></i><span>Encuestas</span>
      </a>
      <a href="{{ route('egresados.oportunidades_egresado') }}" class="active">
        <i class="fa-solid fa-briefcase"></i><span>Oportunidades Laborales</span>
      </a>
      <a href="#">
        <i class="fa-regular fa-calendar-days"></i><span>Noticias y Eventos</span>
      </a>
      <a href="#">
        <i class="fa-regular fa-bell"></i><span>Notificaciones</span>
      </a>
    </nav>
    <div class="sidebar-foot">
      @auth
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
          <button type="submit" class="logout-btn">
            <i class="fa-solid fa-arrow-right-from-bracket"></i><span>Cerrar Sesión</span>
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="logout-btn">
          <i class="fa-solid fa-arrow-right-from-bracket"></i><span>Cerrar Sesión</span>
        </a>
      @endauth
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <div class="topbar">
      <div>
        <button class="hamburger"><i class="fa-solid fa-bars"></i></button>
      </div>
      <div class="topbar-right">
        <button class="icon-btn">
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
              @auth {{ Auth::user()->first_name ?? Auth::user()->name ?? 'Ana María López' }}
              @else Ana María López @endauth
              <i class="fa-solid fa-chevron-down" style="font-size:10px; color:#6B7A70; margin-left:4px;"></i>
            </div>
            <div class="user-role">Egresada</div>
          </div>
        </div>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

      <div class="page-head">
        <h1 class="page-title">Oportunidades Laborales</h1>
        <p class="page-desc">Encuentra ofertas de empleo, prácticas y oportunidades laborales disponibles para egresados.</p>
      </div>

      <!-- STAT CARDS -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-content">
            <div class="stat-icon"><i class="fa-solid fa-briefcase"></i></div>
            <div>
              <div class="stat-title">Ofertas Disponibles</div>
              <div class="stat-value">8</div>
              <div class="stat-subtitle">Ofertas activas</div>
            </div>
          </div>
          <div class="stat-footer">
            <a href="#" class="stat-link">Ver todas las ofertas <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></a>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-content">
            <div class="stat-icon"><i class="fa-regular fa-bookmark"></i></div>
            <div>
              <div class="stat-title">Guardadas</div>
              <div class="stat-value">3</div>
              <div class="stat-subtitle">Ofertas guardadas</div>
            </div>
          </div>
          <div class="stat-footer">
            <a href="#" class="stat-link">Ver guardadas <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></a>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-content">
            <div class="stat-icon"><i class="fa-solid fa-paper-plane"></i></div>
            <div>
              <div class="stat-title">Postulaciones</div>
              <div class="stat-value">2</div>
              <div class="stat-subtitle">Postulaciones enviadas</div>
            </div>
          </div>
          <div class="stat-footer">
            <a href="#" class="stat-link">Ver mis postulaciones <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></a>
          </div>
        </div>
      </div>

      <!-- MAIN GRID -->
      <div class="main-grid">

        <!-- LEFT: Job listings -->
        <div>
          <h2 class="section-title">Ofertas Laborales</h2>
          <div class="search-bar">
            <div class="search-box">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input type="text" placeholder="Buscar por cargo, empresa o palabra clave...">
            </div>
            <select class="filter-select">
              <option>📍 Todas las ubicaciones</option>
              <option>Bogotá, D.C.</option>
              <option>Cali, Valle del Cauca</option>
              <option>Medellín, Antioquia</option>
            </select>
            <select class="filter-select">
              <option>🏷 Todas las categorías</option>
              <option>Tecnología</option>
              <option>Marketing Digital</option>
              <option>Talento Humano</option>
              <option>Biomédica</option>
            </select>
          </div>

          <!-- Job Card 1 -->
          <div class="job-card">
            <div class="job-logo" style="background:#E0F0FF; color:#1D4ED8; font-size:13px; font-weight:700;">TS</div>
            <div class="job-body">
              <div class="job-header">
                <div>
                  <p class="job-title">Análisis de Sistemas</p>
                  <p class="job-company">TrabSistema S.A.S.</p>
                </div>
                <div class="job-badges">
                  <span class="badge-new">Nuevo</span>
                </div>
              </div>
              <div class="job-meta">
                <span><i class="fa-solid fa-location-dot"></i> Bogotá, D.C.</span>
                <span><i class="fa-regular fa-clock"></i> Tiempo completo</span>
                <span><i class="fa-regular fa-calendar"></i> Publicado hace 1 días</span>
              </div>
              <p class="job-desc">Buscamos profesionales o técnicos en sistemas para análisis, diseño y desarrollo de soluciones.</p>
              <div class="job-footer">
                <button class="btn-guardar"><i class="fa-regular fa-bookmark"></i></button>
                <a href="#" class="btn-ver">Ver oferta</a>
              </div>
            </div>
          </div>

          <!-- Job Card 2 -->
          <div class="job-card">
            <div class="job-logo" style="background:#F0FFF4; color:#166534; font-weight:800; font-size:13px;">IN</div>
            <div class="job-body">
              <div class="job-header">
                <div>
                  <p class="job-title">Desarrollador Full Stack</p>
                  <p class="job-company">InnovaB</p>
                </div>
                <div class="job-badges">
                  <span class="badge-new">Nuevo</span>
                </div>
              </div>
              <div class="job-meta">
                <span><i class="fa-solid fa-location-dot"></i> Medellín, Antioquia</span>
                <span><i class="fa-regular fa-clock"></i> Tiempo completo</span>
                <span><i class="fa-regular fa-calendar"></i> Publicado hace 3 días</span>
              </div>
              <p class="job-desc">Únete a nuestro equipo de desarrollo dinámico para construir soluciones innovadoras.</p>
              <div class="job-footer">
                <button class="btn-guardar"><i class="fa-regular fa-bookmark"></i></button>
                <a href="#" class="btn-ver">Ver oferta</a>
              </div>
            </div>
          </div>

          <!-- Job Card 3 -->
          <div class="job-card">
            <div class="job-logo" style="background:#F5F3FF; color:#7C3AED; font-weight:800; font-size:13px;">GA</div>
            <div class="job-body">
              <div class="job-header">
                <div>
                  <p class="job-title">Analista de Talento Humano</p>
                  <p class="job-company">Grupo Andino</p>
                </div>
                <div class="job-badges"></div>
              </div>
              <div class="job-meta">
                <span><i class="fa-solid fa-location-dot"></i> Cali, Valle del Cauca</span>
                <span><i class="fa-regular fa-clock"></i> Tiempo completo</span>
                <span><i class="fa-regular fa-calendar"></i> Publicado hace 5 días</span>
              </div>
              <p class="job-desc">Apoyar procesos de selección, capacitación y desarrollo del talento humano.</p>
              <div class="job-footer">
                <button class="btn-guardar"><i class="fa-regular fa-bookmark"></i></button>
                <a href="#" class="btn-ver">Ver oferta</a>
              </div>
            </div>
          </div>

          <!-- Job Card 4 -->
          <div class="job-card">
            <div class="job-logo" style="background:#FFF7ED; color:#C2410C; font-weight:800; font-size:12px;">CN</div>
            <div class="job-body">
              <div class="job-header">
                <div>
                  <p class="job-title">Practicante de Marketing Digital</p>
                  <p class="job-company">Conector</p>
                </div>
                <div class="job-badges"></div>
              </div>
              <div class="job-meta">
                <span><i class="fa-solid fa-location-dot"></i> Bogotá, D.C.</span>
                <span><i class="fa-regular fa-clock"></i> Práctica</span>
                <span><i class="fa-regular fa-calendar"></i> Publicado hace 1 semana</span>
              </div>
              <p class="job-desc">Apoyo en gestión de redes sociales, campañas y análisis de métricas.</p>
              <div class="job-footer">
                <button class="btn-guardar"><i class="fa-regular fa-bookmark"></i></button>
                <a href="#" class="btn-ver">Ver oferta</a>
              </div>
            </div>
          </div>

          <!-- Job Card 5 -->
          <div class="job-card">
            <div class="job-logo" style="background:#FFF0F0; color:#B91C1C; font-weight:800; font-size:11px;">SAF</div>
            <div class="job-body">
              <div class="job-header">
                <div>
                  <p class="job-title">Profesional en Ingeniería Biomédica</p>
                  <p class="job-company">SaluFacil IPS</p>
                </div>
                <div class="job-badges"></div>
              </div>
              <div class="job-meta">
                <span><i class="fa-solid fa-location-dot"></i> Neiva, Huila</span>
                <span><i class="fa-regular fa-clock"></i> Tiempo completo</span>
                <span><i class="fa-regular fa-calendar"></i> Publicado hace 1 semana</span>
              </div>
              <p class="job-desc">Profesional en ingeniería biomédica para gestión y mantenimiento de equipos.</p>
              <div class="job-footer">
                <button class="btn-guardar"><i class="fa-regular fa-bookmark"></i></button>
                <a href="#" class="btn-ver">Ver oferta</a>
              </div>
            </div>
          </div>

          <a href="#" class="ver-todas-link">Ver todas las ofertas <i class="fa-solid fa-arrow-right" style="font-size:11px;"></i></a>
        </div>

        <!-- RIGHT: Filters -->
        <div>
          <div class="filter-panel">
            <h3 class="filter-panel-title">Filtros</h3>

            <div class="filter-group">
              <h4 class="filter-group-title">Tipo de oferta</h4>
              <label class="filter-checkbox"><input type="checkbox" checked> Todos</label>
              <label class="filter-checkbox"><input type="checkbox"> Tiempo completo</label>
              <label class="filter-checkbox"><input type="checkbox"> Medio tiempo</label>
              <label class="filter-checkbox"><input type="checkbox"> Práctica</label>
              <label class="filter-checkbox"><input type="checkbox"> Freelance</label>
            </div>

            <div class="filter-group">
              <h4 class="filter-group-title">Ubicación</h4>
              <select class="filter-select-full">
                <option>Todas las ubicaciones</option>
                <option>Bogotá, D.C.</option>
                <option>Cali, Valle del Cauca</option>
                <option>Medellín, Antioquia</option>
              </select>
            </div>

            <div class="filter-group">
              <h4 class="filter-group-title">Categoría</h4>
              <select class="filter-select-full">
                <option>Todas las categorías</option>
                <option>Tecnología</option>
                <option>Marketing Digital</option>
                <option>Talento Humano</option>
              </select>
            </div>

            <div class="filter-group">
              <h4 class="filter-group-title">Fecha de publicación</h4>
              <select class="filter-select-full">
                <option>Cualquier momento</option>
                <option>Hoy</option>
                <option>Esta semana</option>
                <option>Este mes</option>
              </select>
            </div>

            <button class="btn-apply">Aplicar filtros</button>
            <button class="btn-clear">Limpiar filtros</button>
          </div>
        </div>

      </div>

    </div>
    <!-- Footer -->
    <div style="text-align:center; padding: 18px; font-size:12px; color: var(--ink-soft); border-top: 1px solid var(--line);">
      © 2024 SIGE — Sistema de Gestión de Egresados
    </div>
  </div>
</div>
</body>
</html>
