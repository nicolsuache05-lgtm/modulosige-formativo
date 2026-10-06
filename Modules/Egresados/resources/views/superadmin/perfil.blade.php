<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Perfil del Egresado — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Fraunces + Plus Jakarta Sans / Work Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS & Alpine.js CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
      [x-cloak] { display: none !important; }
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
        background: #f8faf9;
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
        color: #ff8888;
      }

      /* ---------------- MAIN VIEWPORT ---------------- */
      .main {
        display: flex;
        flex-direction: column;
        min-width: 0;
      }

      .topbar {
        background: #ffffff;
        border-bottom: 1px solid var(--line);
        padding: 12px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 20;
      }

      .portal-link-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 14px;
        border-radius: 999px;
        background: var(--green-soft);
        color: var(--forest);
        font-size: 12.5px;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid rgba(57, 169, 0, 0.3);
        transition: all 0.15s ease;
      }
      .portal-link-btn:hover {
        background: #d8f3de;
        transform: translateY(-1px);
      }

      .user-chip {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 4px 10px 4px 4px;
        border-radius: 999px;
        background: #f7faf8;
        border: 1px solid var(--line);
      }
      .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 999px;
        background: var(--forest);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 12px;
      }

      .content-area {
        padding: 28px 36px 60px;
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
      }

      @media (max-width: 1080px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .content-area { padding: 20px 18px 40px; }
      }
    </style>
</head>
<body x-data="{ openModalSeguimiento: false, openModalEditar: false }">

@php
    $person = $apprentice->person ?? null;
    $course = $apprentice->course ?? null;
    $program = $course->program ?? null;

    $nombreCompleto = $person ? trim($person->first_name . ' ' . $person->first_last_name . ' ' . ($person->second_last_name ?? '')) : 'Valentina Ríos Egresada';
    $iniciales = $person ? (strtoupper(substr($person->first_name, 0, 1)) . strtoupper(substr($person->first_last_name ?? 'R', 0, 1))) : 'VR';
    $docType = $person->document_type ?? 'CC';
    $docNum = $person->document_number ?? '10000003';
    $correo = $person->personal_email ?? ($person->misena_email ?? 'egresado.siga@sena.edu.co');
    $telefono = $person->telephone1 ?? 'No registra';
    $estado = $apprentice->apprentice_status ?? 'CERTIFICADO';
    $programaNombre = $program->name ?? 'Gestión de Empresas Agropecuarias';
    $fichaCodigo = $course->code ?? '55555';
@endphp

<div class="app">

  <!-- ============================================== -->
  <!-- 1. SIDEBAR INSTITUCIONAL SENA -->
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
        <div class="brand-sub">Panel de Administración</div>
      </div>
    </a>

    <div class="nav-label">Módulos Principales</div>
    <nav>
      <a href="{{ route('egresados.dashboard') }}">
        <i class="fa-solid fa-chart-pie"></i>
        <span>Inicio</span>
      </a>
      <a href="{{ route('egresados.index') }}" class="active">
        <i class="fa-solid fa-user-graduate"></i>
        <span>Gestión de Egresados</span>
      </a>
      <a href="{{ route('egresados.instructores') }}">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Instructores</span>
      </a>
      <a href="{{ route('egresados.encuestas_superadmin') }}">
        <i class="fa-solid fa-square-poll-vertical"></i>
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
        <a href="{{ route('login', ['redirect' => route('egresados.index')]) }}" class="logout-btn">
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
          <span style="font-size:12.5px; font-weight:700; color:var(--ink);">
            @auth
              {{ Auth::user()->nickname ?? 'Superadmin' }}
            @else
              Superadmin
            @endauth
          </span>
        </div>
      </div>
    </div>

    <!-- Content Area: EXACT PERFIL DESIGN -->
    <div class="content-area">

      <!-- Alertas -->
      @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm">
          <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
          <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
      @endif

      @if(session('error'))
        <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 flex items-center gap-3 shadow-sm">
          <i class="fa-solid fa-triangle-exclamation text-red-600 text-lg"></i>
          <span class="text-sm font-semibold">{{ session('error') }}</span>
        </div>
      @endif

      <div class="space-y-6">
          
          <!-- Navegación y Título -->
          <div class="flex items-center justify-between gap-4">
              <div class="flex items-center gap-3">
                  <a href="{{ route('egresados.index') }}" class="p-2.5 text-gray-500 hover:text-emerald-700 hover:bg-emerald-50 rounded-xl transition cursor-pointer border border-gray-200 bg-white">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                  </a>
                  <div>
                      <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Perfil del Egresado</h1>
                      <p class="text-sm text-gray-500 mt-1">Trazabilidad académica, laboral y de seguimiento.</p>
                  </div>
              </div>
          </div>

          <!-- Encabezado del Perfil (Tarjeta Principal) -->
          <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 relative overflow-hidden">
              <div class="absolute top-0 right-0 p-6">
                  <span class="px-3.5 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-sm uppercase">
                      {{ $estado }}
                  </span>
              </div>
              
              <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                  <div class="w-24 h-24 rounded-full bg-emerald-700 text-white font-bold flex items-center justify-center text-3xl shadow-inner flex-shrink-0">
                      {{ $iniciales }}
                  </div>
                  <div>
                      <h2 class="text-2xl font-bold text-gray-900">{{ $nombreCompleto }}</h2>
                      <div class="flex flex-wrap items-center gap-4 mt-2 text-sm text-gray-600">
                          <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg> {{ $docType }}: {{ $docNum }}</span>
                          <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> {{ $correo }}</span>
                          <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg> {{ $telefono }}</span>
                      </div>
                      <div class="mt-4 flex gap-3">
                          <button @click="openModalEditar = true" type="button" class="px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition cursor-pointer shadow-sm flex items-center gap-2">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                              Editar Perfil
                          </button>
                          <!-- BOTÓN QUE ABRE EL MODAL DE SEGUIMIENTO -->
                          <button @click="openModalSeguimiento = true" type="button" class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold rounded-xl transition shadow-sm cursor-pointer flex items-center gap-2">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                              Registrar Seguimiento
                          </button>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Grid Inferior (Izquierda: Datos / Derecha: Línea de tiempo) -->
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
              
              <!-- Columna Izquierda: Académico y Laboral -->
              <div class="lg:col-span-1 space-y-6">
                  <!-- Bloque Académico -->
                  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-4">
                      <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
                          <div class="p-1.5 bg-emerald-50 text-emerald-700 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg></div>
                          <h3 class="text-sm font-bold text-gray-900">Historial Académico</h3>
                      </div>
                      <div class="space-y-3 text-sm">
                          <div>
                              <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Programa Principal</p>
                              <p class="font-medium text-gray-800 mt-0.5">{{ $programaNombre }}</p>
                          </div>
                          <div class="grid grid-cols-2 gap-3">
                              <div>
                                  <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Ficha</p>
                                  <p class="font-medium text-gray-800 mt-0.5">{{ $fichaCodigo }}</p>
                              </div>
                              <div>
                                  <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Año Egreso</p>
                                  <p class="font-medium text-gray-800 mt-0.5">2026</p>
                              </div>
                          </div>
                          <div>
                              <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Centro de Formación</p>
                              <p class="font-medium text-gray-800 mt-0.5">CEFA La Angostura</p>
                          </div>
                      </div>
                  </div>

                  <!-- Bloque Laboral -->
                  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-4">
                      <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
                          <div class="p-1.5 bg-blue-50 text-blue-700 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
                          <h3 class="text-sm font-bold text-gray-900">Situación Laboral</h3>
                      </div>
                      <div class="space-y-3 text-sm">
                          <div>
                              <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Estado Actual</p>
                              <span class="inline-block px-2.5 py-0.5 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-md mt-1 uppercase">{{ $estado }}</span>
                          </div>
                          <div>
                              <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Empresa actual</p>
                              <p class="font-medium text-gray-800 mt-0.5">Agroindustrias del Huila S.A.S</p>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Columna Derecha: Trazabilidad y Seguimientos -->
              <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                  <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-6">
                      <div class="flex items-center gap-2">
                          <div class="p-1.5 bg-amber-50 text-amber-600 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                          <h3 class="text-base font-bold text-gray-900">Trazabilidad de Seguimiento</h3>
                      </div>
                  </div>

                  <!-- Línea de tiempo (Timeline) -->
                  <div class="relative border-l-2 border-gray-100 ml-3 space-y-8 pb-4">
                      
                      <!-- Registro de ejemplo 1 -->
                      <div class="relative pl-6">
                          <div class="absolute -left-[9px] top-1 w-4 h-4 bg-white border-2 border-emerald-500 rounded-full"></div>
                          <div>
                              <span class="text-xs font-bold text-emerald-600">12 Agosto 2026</span>
                              <h4 class="font-bold text-gray-800 mt-0.5">Contacto Telefónico</h4>
                              <p class="text-sm text-gray-600 mt-1">La egresada confirma que sigue laborando en su empresa actual y solicita información sobre especializaciones.</p>
                              <span class="text-[10px] text-gray-400 mt-2 block">Registrado por: Super Admin</span>
                          </div>
                      </div>

                      <!-- Registro de ejemplo 2 -->
                      <div class="relative pl-6">
                          <div class="absolute -left-[9px] top-1 w-4 h-4 bg-white border-2 border-blue-500 rounded-full"></div>
                          <div>
                              <span class="text-xs font-bold text-blue-600">15 Mayo 2026</span>
                              <h4 class="font-bold text-gray-800 mt-0.5">Encuesta de Graduación</h4>
                              <p class="text-sm text-gray-600 mt-1">Diligenció encuesta de satisfacción de egresados, calificando con 5/5 la formación recibida en el CEFA.</p>
                              <span class="text-[10px] text-gray-400 mt-2 block">Registrado por: Sistema Automático</span>
                          </div>
                      </div>

                  </div>
              </div>
          </div>

      </div>

    </div>

  </div>

</div>

<!-- INCLUSIÓN DE MODALES -->
@include('egresados::superadmin.partials._modal_seguimiento')
@include('egresados::superadmin.partials._modal_editar')

</body>
</html>
