<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <title>SIGE · Panel de Instructor — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(route('egresados.assets.image', 'sena-logo.png')); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(route('egresados.assets.image', 'sena-logo.png')); ?>">

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
        grid-template-columns: 1.55fr 1fr;
        gap: 24px;
      }

      .panel {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 24px 26px;
        box-shadow: 0 4px 14px rgba(0, 19, 30, 0.03);
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
    </style>
</head>
<body>

<div class="app">

  <!-- SIDEBAR DEL INSTRUCTOR -->
  <aside class="sidebar">
    <a href="<?php echo e(route('egresados.welcome')); ?>" class="brand">
      <div class="brand-badge">
        <img src="<?php echo e(route('egresados.assets.image', 'sena-logo.png')); ?>" alt="Logo SENA">
      </div>
      <div>
        <div class="brand-name">
          <span>SIGE</span>
        </div>
        <div class="brand-sub">GESTIÓN DE EGRESADOS</div>
      </div>
    </a>

    <div class="nav-label">General</div>
    <nav>
      <a href="<?php echo e(route('egresados.instructor.dashboard')); ?>" class="active">
        <i class="fa-solid fa-gauge-high"></i>
        <span>Inicio</span>
      </a>
      <a href="<?php echo e(route('egresados.instructor.directorio')); ?>">
        <i class="fa-solid fa-user-graduate"></i>
        <span>Egresados</span>
      </a>
      <a href="<?php echo e(route('egresados.instructor.encuestas.index')); ?>">
        <i class="fa-solid fa-clipboard-question"></i>
        <span>Encuestas</span>
      </a>
      <a href="<?php echo e(route('egresados.instructor.reportes.index')); ?>">
        <i class="fa-solid fa-file-invoice"></i>
        <span>Reportes</span>
      </a>
      <a href="<?php echo e(route('egresados.instructor.eventos.index')); ?>">
        <i class="fa-regular fa-calendar-check"></i>
        <span>Eventos</span>
      </a>
      <a href="<?php echo e(route('egresados.instructor.noticias.index')); ?>">
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

      <?php echo $__env->make('egresados::superadmin.partials._topbar_right', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Main Content -->
    <div class="content">
      
      <!-- Page Head -->
      <div class="page-head">
        <div>
          <h1 class="page-title">
            ¡Bienvenido(a), <span><?php echo e(Auth::check() ? (Auth::user()->first_name ?? Auth::user()->name ?? 'Instructor(a)') : 'Instructor(a)'); ?></span>!
          </h1>
          <p class="page-desc">Monitoreo, consulta y seguimiento de egresados de tus fichas de formación.</p>
        </div>

        <div class="period-pill">
          <i class="fa-regular fa-calendar-days"></i>
          <span><?php echo e(ucfirst(\Carbon\Carbon::now()->locale('es')->translatedFormat('F Y'))); ?></span>
        </div>
      </div>

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
            <?php echo e(number_format($totalEgresados ?? 0)); ?>

          </div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-arrow-trend-up"></i>
              <span>↑ Registros en sistema</span>
            </div>
            <a href="<?php echo e(route('egresados.instructor.directorio')); ?>" class="stat-link">
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
            <?php echo e(number_format($totalFichas ?? 6)); ?>

          </div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-circle-check"></i>
              <span>En seguimiento activo</span>
            </div>
            <a href="<?php echo e(route('egresados.instructor.directorio')); ?>" class="stat-link">
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
          <div class="stat-value"><?php echo e(number_format($totalEncuestas ?? 5)); ?></div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-circle-check"></i>
              <span>Creadas en sistema</span>
            </div>
            <a href="<?php echo e(route('egresados.instructor.encuestas.index')); ?>" class="stat-link">
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
          <div class="stat-value"><?php echo e(number_format($totalEventos ?? 5)); ?></div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-bullhorn"></i>
              <span>Próximos eventos</span>
            </div>
            <a href="<?php echo e(route('egresados.instructor.eventos.index')); ?>" class="stat-link">
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
          <div class="stat-value"><?php echo e(number_format($totalReportes ?? 5)); ?></div>
          <div class="stat-meta">
            <div class="stat-trend">
              <i class="fa-solid fa-file-circle-check"></i>
              <span>Generados en módulo</span>
            </div>
            <a href="<?php echo e(route('egresados.instructor.reportes.index')); ?>" class="stat-link">
              <span>Ver detalle</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- Lower Grid: Actividad Reciente + Avance por Programa -->
      <div class="lower-grid">
        
        <!-- Panel Izquierdo: Actividad Reciente de Egresados en Fichas -->
        <div class="panel">
          <div class="panel-head">
            <h3 class="panel-title">
              <i class="fa-solid fa-bolt text-[#39A900]"></i>
              <span>Actividad reciente</span>
            </h3>
            <a href="<?php echo e(route('egresados.instructor.directorio')); ?>" class="panel-action">Ver todo</a>
          </div>

          <?php $__empty_1 = true; $__currentLoopData = $recentEgresados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
              $p = $item->person;
              $fullName = $p ? trim($p->first_name . ' ' . $p->first_last_name) : 'Aprendiz SENA';
              $progName = $item->course && $item->course->program ? $item->course->program->name : 'Formación SENA';
              $isUpdated = $item->updated_at && $item->created_at && ($item->updated_at->timestamp > $item->created_at->timestamp + 60);
              $timeDiff = $item->updated_at ? $item->updated_at->diffForHumans() : ($item->created_at ? $item->created_at->diffForHumans() : 'Recientemente');
            ?>
            <div class="activity-row">
              <div class="activity-dot" style="<?php echo e($isUpdated ? 'background:#e0f2fe; color:#0284c7;' : 'background:#dcfce7; color:#166534;'); ?>">
                <i class="fa-solid <?php echo e($isUpdated ? 'fa-user-pen' : 'fa-user-plus'); ?>"></i>
              </div>
              <div style="flex:1;">
                <div class="activity-text">
                  <?php if($isUpdated): ?>
                    Se actualizaron los datos de <b><?php echo e($fullName); ?></b> (<?php echo e($progName); ?>)
                  <?php else: ?>
                    Nuevo egresado registrado: <b><?php echo e($fullName); ?></b> (<?php echo e($progName); ?>)
                  <?php endif; ?>
                </div>
                <div class="activity-time" style="display:flex; align-items:center; gap:8px;">
                  <span><?php echo e($timeDiff); ?></span>
                  <span style="font-size:10px; padding:1px 6px; border-radius:999px; background:rgba(0,19,30,0.06); font-weight:600;"><?php echo e($item->apprentice_status); ?></span>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="text-align:center; padding: 28px 16px; color: var(--ink-soft); font-size:13px;">
              <i class="fa-regular fa-clock" style="font-size:24px; margin-bottom:8px; display:block; opacity:0.4;"></i>
              No hay actividades registradas recientemente en tus fichas.
            </div>
          <?php endif; ?>
        </div>

        <!-- Panel Derecho: Avance por Programa -->
        <div class="panel">
          <div class="panel-head">
            <h3 class="panel-title">
              <i class="fa-solid fa-chart-simple text-[#39A900]"></i>
              <span>Avance por programa</span>
            </h3>
          </div>

          <?php if(isset($programStats) && count($programStats) > 0): ?>
            <?php
              $maxTotal = $programStats->max('total') ?: 1;
            ?>
            <?php $__currentLoopData = $programStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $pct = round(($prog->total / $maxTotal) * 100);
              ?>
              <div class="progress-item">
                <div class="progress-label">
                  <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 70%;" title="<?php echo e($prog->name); ?>">
                    <?php echo e($prog->name); ?>

                  </span>
                  <span><?php echo e($prog->total); ?> egresados (<?php echo e($pct); ?>%)</span>
                </div>
                <div class="progress-track">
                  <div class="progress-fill" style="width: <?php echo e($pct); ?>%"></div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <div class="progress-item">
              <div class="progress-label">
                <span>Gestión de Empresas Agropecuarias</span>
                <span>3 egresados (100%)</span>
              </div>
              <div class="progress-track">
                <div class="progress-fill" style="width: 100%"></div>
              </div>
            </div>
            <div class="progress-item">
              <div class="progress-label">
                <span>Análisis y Desarrollo de Software (ADSO)</span>
                <span>2 egresados (66%)</span>
              </div>
              <div class="progress-track">
                <div class="progress-fill" style="width: 66%"></div>
              </div>
            </div>
            <div class="progress-item">
              <div class="progress-label">
                <span>Producción Acuícola</span>
                <span>1 egresado (33%)</span>
              </div>
              <div class="progress-track">
                <div class="progress-fill" style="width: 33%"></div>
              </div>
            </div>
          <?php endif; ?>
        </div>

      </div>

    </div>
  </div>

</div>


</body>
</html>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\Egresados\resources\views\instructor\dashboard.blade.php ENDPATH**/ ?>