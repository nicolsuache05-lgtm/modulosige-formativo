<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Resultados de Encuesta {{ $encuesta['id'] ?? 'ENC-025' }} — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Fraunces + Plus Jakarta Sans / Work Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- html2pdf.js CDN para generación de PDFs de alta fidelidad con gráficas vectoriales -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
      :root {
        --forest: #001A29;
        --forest-deep: #00131E;
        --sena-dark: #00131E;
        --sena-navy: #001A29;
        --sena-navy-light: #002336;
        --sena-light-navy: #00324D;
        --green: #39A900;
        --green-dark: #2a7c00;
        --green-soft: #EAF7EE;
        --moss: #62E31D;
        --bg: #F4F7F6;
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

      /* ---------------- SIDEBAR INSTITUCIONAL ---------------- */
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
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 18px;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .brand-tag {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 9px;
        font-weight: 800;
        background: var(--green);
        color: #ffffff;
        padding: 2px 6px;
        border-radius: 999px;
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
      nav a i, nav a svg {
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
      nav a.active i, nav a.active svg {
        color: var(--green);
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

      /* ---------------- MAIN VIEWPORT ---------------- */
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
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: sticky;
        top: 0;
        z-index: 20;
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

      .user-chip {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        padding: 4px 10px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
      }
      .user-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--green);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 12px;
      }

      .content {
        padding: 30px 36px 48px;
        flex: 1;
      }

      @media (max-width: 1080px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
      }
      @media (max-width: 640px) {
        .content { padding: 20px 16px 36px; }
        .topbar { padding: 12px 16px; }
      }
    </style>
</head>
<body>

<div class="app">

  <!-- ============================================== -->
  <!-- 1. SIDEBAR INSTITUCIONAL -->
  <!-- ============================================== -->
  <aside class="sidebar">
    <a href="{{ route('egresados.dashboard') }}" class="brand">
      <div class="brand-badge">
        <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA">
      </div>
      <div>
        <div class="brand-name">
          <span>SIGE</span>
          <span class="brand-tag">CEFA</span>
        </div>
        <div class="brand-sub">Gestión de Egresados</div>
      </div>
    </a>

    <div class="nav-label">General</div>
    <nav>
      <a href="{{ route('egresados.dashboard') }}">
        <i class="fa-solid fa-gauge-high"></i>
        <span>Inicio</span>
      </a>
      <a href="{{ route('egresados.index') }}">
        <i class="fa-solid fa-user-graduate"></i>
        <span>Egresados</span>
      </a>
      <a href="{{ route('egresados.instructores') }}">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Instructores</span>
      </a>
      <a href="{{ route('egresados.superadmin.encuestas.index') }}" class="active">
        <i class="fa-solid fa-clipboard-question"></i>
        <span>Encuestas</span>
      </a>
      <a href="{{ route('egresados.reportes') }}">
        <i class="fa-solid fa-file-invoice"></i>
        <span>Reportes</span>
      </a>
      <a href="{{ route('egresados.eventos') }}">
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
        <a href="{{ route('login', ['redirect' => route('egresados.encuestas')]) }}" class="logout-btn">
          <i class="fa-solid fa-arrow-right-to-bracket"></i>
          <span>Iniciar sesión</span>
        </a>
      @endauth
    </div>
  </aside>

  <!-- ============================================== -->
  <!-- 2. MAIN VIEWPORT -->
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
        <div class="user-chip" title="Usuario activo">
          <div class="user-avatar">
            @auth
              {{ Auth::user()->initials }}
            @else
              SA
            @endauth
          </div>
          <span>
            @auth
              {{ Auth::user()->full_name }}
            @else
              Super Administrador SIGE
            @endauth
          </span>
          <i class="fa-solid fa-chevron-down text-[10px] text-white/60 ms-1"></i>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="content space-y-6">

      <!-- Navegación y Acciones Superiores (ESTO NO SALE EN EL PDF) -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div class="flex items-center gap-3">
              <a href="{{ route('egresados.superadmin.encuestas.index') }}" class="p-2.5 text-gray-400 hover:text-emerald-700 hover:bg-emerald-50 rounded-xl transition cursor-pointer border border-gray-200 shadow-2xs" title="Volver a Encuestas">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
              </a>
              <div>
                  <h1 class="text-2xl sm:text-3xl font-bold font-editorial text-gray-900 tracking-tight">
                      Resultados de <span class="text-[#39A900]">Encuesta</span>
                  </h1>
                  <p class="text-xs sm:text-sm text-gray-500 mt-0.5 font-medium">
                      {{ $encuesta['full_title'] ?? $encuesta['title'] ?? 'Inserción Laboral 2026' }} (ID: <span class="font-bold text-gray-800">{{ $encuesta['id'] ?? 'ENC-025' }}</span>) • Dirigido a: <span class="text-emerald-800 font-bold bg-emerald-50 px-2 py-0.5 rounded-md">{{ $encuesta['target'] ?? 'Egresado ADSO' }}</span>
                  </p>
              </div>
          </div>
          <div class="flex items-center gap-2">
              <button onclick="alert('Exportando datos consolidados a Excel (.xlsx)...');" type="button" class="px-4 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition shadow-sm flex items-center gap-2 cursor-pointer">
                  <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                  Exportar Excel
              </button>
              
              <!-- BOTÓN QUE DISPARA EL PDF CON html2pdf -->
              <button id="btn-descargar-pdf" onclick="generarPDF()" type="button" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold rounded-xl transition shadow-sm flex items-center gap-2 cursor-pointer">
                  <svg id="pdf-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                  <span id="pdf-btn-text">Imprimir PDF</span>
              </button>
          </div>
      </div>

      <!-- =============== INICIO ÁREA DEL PDF =============== -->
      <!-- Todo lo que esté dentro de este div 'area-imprimir' es lo que saldrá en el reporte PDF -->
      <div id="area-imprimir" class="space-y-6 bg-gray-50/50 p-4 sm:p-6 rounded-2xl border border-gray-100">

          <!-- Encabezado Institucional Exclusivo para el PDF -->
          <div class="hidden print-header mb-4 p-5 bg-white rounded-2xl border border-gray-200 text-center shadow-xs">
              <div class="flex items-center justify-center gap-3 mb-2">
                  <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA" style="width: 36px; height: 36px; object-fit: contain;">
                  <div class="text-left">
                      <h2 class="text-lg font-bold text-[#001A29] font-editorial leading-tight">SENA Empresa · CEFA La Angostura</h2>
                      <p class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider">Sistema de Gestión de Egresados (SIGE)</p>
                  </div>
              </div>
              <div class="border-t border-gray-100 pt-2.5 mt-2">
                  <h3 class="text-base font-bold text-gray-900">
                      Reporte de Resultados: {{ $encuesta['full_title'] ?? $encuesta['title'] ?? 'Inserción Laboral 2026' }}
                  </h3>
                  <p class="text-xs text-gray-500 mt-0.5">
                      ID: <strong>{{ $encuesta['id'] ?? 'ENC-025' }}</strong> | Público: <strong>{{ $encuesta['target'] ?? 'Egresado ADSO' }}</strong> | Fecha Emisión: {{ date('d/m/Y H:i') }}
                  </p>
              </div>
          </div>

          <!-- KPIs Rápidos de la Encuesta -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                  <div class="p-3 bg-blue-50 text-blue-600 rounded-xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
                  <div><p class="text-xs font-bold text-gray-400 uppercase">Enviadas</p><h3 class="text-2xl font-black text-gray-800">{{ $encuesta['enviadas'] ?? 120 }}</h3></div>
              </div>
              <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                  <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                  <div><p class="text-xs font-bold text-gray-400 uppercase">Respondidas</p><h3 class="text-2xl font-black text-emerald-700">{{ $encuesta['respondidas'] ?? 90 }}</h3></div>
              </div>
              <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                  <div class="p-3 bg-amber-50 text-amber-600 rounded-xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                  <div><p class="text-xs font-bold text-gray-400 uppercase">Pendientes</p><h3 class="text-2xl font-black text-amber-700">{{ $encuesta['pendientes'] ?? 30 }}</h3></div>
              </div>
              <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 border-b-4 border-b-emerald-500 hover:shadow-md transition">
                  <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg></div>
                  <div><p class="text-xs font-bold text-gray-400 uppercase">Tasa Respuesta</p><h3 class="text-2xl font-black text-emerald-700">{{ $encuesta['rate'] ?? '75%' }}</h3></div>
              </div>
          </div>

          <!-- Malla de Gráficas Profesionales -->
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
              
              <!-- Gráfica 1: Estado Laboral (Gráfico de Dona) -->
              <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition">
                  <h3 class="text-sm font-bold text-gray-800 mb-1">¿Cuál es su estado laboral actual?</h3>
                  <p class="text-[11px] text-gray-400 mb-4">Distribución porcentual de los {{ $encuesta['respondidas'] ?? 90 }} egresados que respondieron.</p>
                  <div id="grafica-estado-laboral" class="w-full flex justify-center"></div>
              </div>

              <!-- Gráfica 2: Rango Salarial (Gráfico de Barras) -->
              <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition">
                  <h3 class="text-sm font-bold text-gray-800 mb-1">Rango Salarial Promedio (SMMLV)</h3>
                  <p class="text-[11px] text-gray-400 mb-4">Ingresos reportados por los egresados empleados.</p>
                  <div id="grafica-salarios" class="w-full"></div>
              </div>

              <!-- Gráfica 3: Relación Programa/Empleo (Gráfico de Barra Apilada) -->
              <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition">
                  <h3 class="text-sm font-bold text-gray-800 mb-1">¿Su empleo actual está relacionado con lo que estudió en el CEFA?</h3>
                  <p class="text-[11px] text-gray-400 mb-4">Análisis de pertinencia y afinidad formativa de los programas académicos.</p>
                  <div id="grafica-pertinencia" class="w-full"></div>
              </div>

          </div>

      </div>
      <!-- =============== FIN ÁREA DEL PDF =============== -->

    </div>
  </div>

</div>

<!-- LIBRERÍA APEXCHARTS Y CONFIGURACIÓN -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    
    // ---------------------------------------------------------
    // 1. GRÁFICA DE DONA (ESTADO LABORAL)
    // ---------------------------------------------------------
    var optionsDona = {
        series: [60, 20, 10], // 60 Empleados, 20 Desempleados, 10 Estudiando
        labels: ['Empleados', 'Desempleados', 'Estudiando'],
        chart: {
            type: 'donut',
            height: 320,
            fontFamily: 'inherit',
            animations: { enabled: true }
        },
        colors: ['#047857', '#f59e0b', '#3b82f6'], // Emerald, Amber, Blue de Tailwind
        plotOptions: {
            pie: {
                donut: { size: '65%' },
                expandOnClick: true
            }
        },
        dataLabels: { enabled: false },
        legend: {
            position: 'bottom',
            fontSize: '13px',
            fontWeight: 500,
            markers: { radius: 12 }
        },
        tooltip: {
            theme: 'light',
            y: { formatter: function (val) { return val + " Egresados" } }
        }
    };
    var chartDona = new ApexCharts(document.querySelector("#grafica-estado-laboral"), optionsDona);
    chartDona.render();

    // ---------------------------------------------------------
    // 2. GRÁFICA DE BARRAS (SALARIOS)
    // ---------------------------------------------------------
    var optionsBarras = {
        series: [{
            name: 'Cantidad',
            data: [15, 35, 25, 5] // Datos por rango
        }],
        chart: {
            type: 'bar',
            height: 320,
            toolbar: { show: false },
            fontFamily: 'inherit',
            animations: { enabled: true }
        },
        colors: ['#10b981'], // Emerald 500
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: '45%',
                distributed: true
            }
        },
        dataLabels: { enabled: false },
        legend: { show: false },
        xaxis: {
            categories: ['1 SMMLV', '1 a 2 SMMLV', '2 a 3 SMMLV', 'Más de 3'],
            labels: { style: { cssClass: 'text-xs font-semibold text-gray-500' } }
        },
        tooltip: {
            theme: 'light'
        }
    };
    var chartBarras = new ApexCharts(document.querySelector("#grafica-salarios"), optionsBarras);
    chartBarras.render();

    // ---------------------------------------------------------
    // 3. GRÁFICA DE BARRA APILADA (PERTINENCIA POR PROGRAMA)
    // ---------------------------------------------------------
    var optionsArea = {
        series: [{
            name: 'Sí, totalmente',
            data: [45, 30] // ADSO, GAE
        }, {
            name: 'No, nada relacionado',
            data: [5, 10]
        }],
        chart: {
            type: 'bar', // Barra apilada horizontal
            stacked: true,
            height: 250,
            toolbar: { show: false },
            fontFamily: 'inherit',
            animations: { enabled: true }
        },
        colors: ['#047857', '#ef4444'], // Emerald (Sí) y Red (No)
        plotOptions: {
            bar: {
                horizontal: true,
                borderRadius: 4,
            },
        },
        dataLabels: { enabled: true },
        xaxis: {
            categories: ['ADSO', 'Gestión Agroempresarial'],
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left'
        }
    };
    var chartArea = new ApexCharts(document.querySelector("#grafica-pertinencia"), optionsArea);
    chartArea.render();
});

// FUNCIÓN PARA DESCARGAR EL PDF CON CALIDAD VECTORIAL
function generarPDF() {
    const btn = document.getElementById('btn-descargar-pdf');
    const btnText = document.getElementById('pdf-btn-text');
    const header = document.querySelector('.print-header');
    
    // Cambiar estado visual del botón durante la exportación
    if (btnText) btnText.innerText = 'Generando PDF...';
    if (btn) btn.disabled = true;

    // Mostramos el encabezado institucional solo para el PDF
    if (header) header.classList.remove('hidden');

    // Seleccionamos el contenedor que tiene el ID "area-imprimir"
    const elemento = document.getElementById('area-imprimir');
    const surveyId = "{{ $encuesta['id'] ?? 'ENC-025' }}";

    // Configuraciones de altísima calidad para el PDF
    const opciones = {
        margin:       [8, 8, 8, 8], // Margen en milímetros
        filename:     'Reporte_Resultados_' + surveyId + '.pdf',
        image:        { type: 'jpeg', quality: 1.0 }, // Calidad al 100%
        html2canvas:  { scale: 2, useCORS: true, letterRendering: true }, // scale: 2 para que letras y gráficas se vean nítidas
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    // Generar y descargar automáticamente
    html2pdf().set(opciones).from(elemento).save().then(() => {
        if (header) header.classList.add('hidden');
        if (btnText) btnText.innerText = 'Imprimir PDF';
        if (btn) btn.disabled = false;
    }).catch(err => {
        console.error('Error generando PDF:', err);
        if (header) header.classList.add('hidden');
        if (btnText) btnText.innerText = 'Imprimir PDF';
        if (btn) btn.disabled = false;
        alert('Hubo un inconveniente al generar el PDF. Puedes usar Ctrl+P como alternativa.');
    });
}
</script>

</body>
</html>
