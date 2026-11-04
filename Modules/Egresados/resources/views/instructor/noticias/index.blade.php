<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <title>SIGE · Gestión de Noticias — Instructor CEFA</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Poppins & Nunito (Tipografía Institucional SENA Empresa ERP) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS & Alpine.js CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
      :root {
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

      /* ---------------- SIDEBAR INSTITUCIONAL ---------------- */
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
        background: linear-gradient(135deg, var(--sena-green) 0%, #2e8b00 100%);
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

      .topbar {
        background: linear-gradient(135deg, var(--sena-dark) 0%, var(--sena-navy) 100%);
        border-bottom: 2px solid var(--sena-green);
        box-shadow: 0 4px 14px rgba(0, 19, 30, 0.15);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 64px;
        padding: 0 36px;
        position: sticky;
        top: 0;
        z-index: 50;
      }

      .topbar-left {
        display: flex;
        align-items: center;
        gap: 14px;
      }

      .content {
        padding: 32px 36px 48px;
        flex: 1;
      }

      /* Stat cards */
      .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 24px;
      }
      .stat-card {
        background: var(--card);
        border-radius: 16px;
        padding: 20px 22px;
        border: 1px solid var(--line);
        display: flex;
        flex-direction: column;
        gap: 10px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
      }
      .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(1, 56, 25, 0.06);
        border-color: rgba(57, 169, 0, 0.35);
      }
      .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
      }
      .stat-icon.green { background: var(--green-soft); color: var(--green); }
      .stat-icon.blue { background: #EEF4FF; color: #2563EB; }
      .stat-icon.amber { background: #FFF8E6; color: #D97706; }
      .stat-icon.purple { background: #F3E8FF; color: #9333EA; }

      .stat-label {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--ink-soft);
      }
      .stat-num {
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-size: 28px;
        font-weight: 800;
        color: var(--forest-deep);
        line-height: 1;
        margin: 2px 0 4px;
      }
      .stat-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
        width: fit-content;
      }
      .stat-pill.green { background: var(--green-soft); color: var(--green-dark); }
      .stat-pill.blue { background: #DBEAFE; color: #1E40AF; }
      .stat-pill.amber { background: #FEF3C7; color: #92400E; }
      .stat-pill.purple { background: #EDE9FE; color: #6D28D9; }

      /* News Card */
      .news-card {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.25s ease;
        position: relative;
      }
      .news-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0, 19, 30, 0.08);
        border-color: rgba(57, 169, 0, 0.4);
      }
      .news-card-img-wrap {
        width: 100%;
        height: 160px;
        position: relative;
        overflow: hidden;
        background: #001A29;
      }
      .news-card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
      }
      .news-card:hover .news-card-img-wrap img {
        transform: scale(1.05);
      }
      .news-card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
      }

      /* Status Pill */
      .badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.3px;
      }
      .badge-pill.status-green { background: #EAF7EE; color: #1E7E34; border: 1px solid rgba(40,167,69,0.25); }
      .badge-pill.status-blue { background: #EEF4FF; color: #1D4ED8; border: 1px solid rgba(29,78,216,0.25); }
      .badge-pill.status-amber { background: #FFF8E6; color: #B45309; border: 1px solid rgba(217,119,6,0.25); }

      @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
      }
      @media (max-width: 768px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .stats-grid { grid-template-columns: 1fr; }
      }
      @media (max-width: 640px) {
        .content { padding: 20px 16px 36px; }
        .topbar { padding: 0 16px; }
      }

      [x-cloak] { display: none !important; }
    </style>
</head>
<body x-data="{ 
    openModal: false,
    openDetalleModal: false,
    openEditModal: false,
    openDeleteModal: false,
    imageMode: 'file',
    imagePreview: null,
    imageUrlInput: '',
    noticiaAEliminar: { id: '', title: '' },
    noticiaActiva: {
        id: '',
        title: '',
        category: '',
        category_pill: 'status-green',
        summary: '',
        content: '',
        author: '',
        author_role: '',
        date: '',
        status: 'PUBLICADA',
        status_pill: 'status-green',
        target: '',
        views_count: 0,
        image: ''
    },
    openSuccessModal: {{ session('success') ? 'true' : 'false' }},
    openErrorModal: {{ session('error') ? 'true' : 'false' }}
}">

<div class="app">

  <!-- ============================================== -->
  <!-- 1. SIDEBAR INSTITUCIONAL SUPERADMIN -->
  <!-- ============================================== -->
  <aside class="sidebar">
    <a href="{{ route('egresados.dashboard') }}" class="brand">
      <div class="brand-badge">
        <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA">
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
      <a href="{{ route('egresados.instructor.dashboard') }}">
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
      <a href="{{ route('egresados.instructor.noticias.index') }}" class="active">
        <i class="fa-solid fa-newspaper"></i>
        <span>Noticias</span>
      </a>
    </nav>
  </aside>

  <!-- ============================================== -->
  <!-- 2. MAIN VIEWPORT -->
  <!-- ============================================== -->
  <div class="main">
    
    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-left"></div>

      @include('egresados::superadmin.partials._topbar_right')
    </div>

    <!-- Main Content -->
    <div class="content space-y-6">

      @if(isset($errors) && $errors->any())
        <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-xs sm:text-sm font-semibold flex items-start gap-2 shadow-xs">
            <i class="fa-solid fa-triangle-exclamation text-red-600 text-base mt-0.5"></i>
            <div>
                <strong>Por favor corrige los siguientes errores:</strong>
                <ul class="list-disc list-inside mt-1 font-normal">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
      @endif

      <!-- Encabezado y botón Crear Noticia -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
              <h1 class="text-2xl sm:text-3xl font-bold font-editorial text-gray-900 tracking-tight">
                  Gestión de <span class="text-[#39A900]">Noticias</span> y Comunicados
              </h1>
              <p class="text-xs sm:text-sm text-gray-500 mt-1">Novedades, convocatorias y publicaciones institucionales para egresados e instructores del CEFA.</p>
          </div>
          <div class="flex items-center gap-3">
              <button @click="openModal = true; imagePreview = null" 
                      type="button" 
                      class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs sm:text-sm font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 hover:shadow-lg hover:-translate-y-0.5 cursor-pointer">
                  <i class="fa-solid fa-plus mr-2 text-xs"></i>
                  <span>Publicar Noticia</span>
              </button>
          </div>
      </div>

      <!-- 1. Estadísticas Superiores -->
      <div class="stats-grid">
          <!-- Total Noticias -->
          <div class="stat-card">
              <div class="stat-top">
                  <span class="stat-label">Total Noticias</span>
                  <div class="stat-icon green">
                      <i class="fa-solid fa-newspaper"></i>
                  </div>
              </div>
              <div class="stat-num">{{ number_format($totalNoticias) }}</div>
              <span class="stat-pill green">
                  <i class="fa-solid fa-database"></i> Registradas en módulo
              </span>
          </div>

          <!-- Publicadas -->
          <div class="stat-card">
              <div class="stat-top">
                  <span class="stat-label">Publicadas</span>
                  <div class="stat-icon blue">
                      <i class="fa-solid fa-circle-check"></i>
                  </div>
              </div>
              <div class="stat-num">{{ number_format($totalPublicadas) }}</div>
              <span class="stat-pill blue">
                  <i class="fa-solid fa-eye"></i> Visibles a comunidad
              </span>
          </div>

          <!-- Destacadas -->
          <div class="stat-card">
              <div class="stat-top">
                  <span class="stat-label">Destacadas</span>
                  <div class="stat-icon amber">
                      <i class="fa-solid fa-star"></i>
                  </div>
              </div>
              <div class="stat-num">{{ number_format($totalDestacadas) }}</div>
              <span class="stat-pill amber">
                  <i class="fa-solid fa-bullhorn"></i> Prioridad alta
              </span>
          </div>

          <!-- Impacto / Lecturas -->
          <div class="stat-card">
              <div class="stat-top">
                  <span class="stat-label">Impacto y Lecturas</span>
                  <div class="stat-icon purple">
                      <i class="fa-solid fa-chart-line"></i>
                  </div>
              </div>
              <div class="stat-num">{{ number_format($totalLecturas) }}</div>
              <span class="stat-pill purple">
                  <i class="fa-solid fa-users"></i> Visualizaciones totales
              </span>
          </div>
      </div>

      <!-- 2. Filtros y Búsqueda -->
      <div class="bg-white rounded-2xl border border-gray-200 p-4 shadow-2xs">
          <form action="{{ route('egresados.instructor.noticias.index') }}" method="GET" class="flex flex-col md:flex-row items-center justify-between gap-3">
              <div class="relative flex-1 w-full">
                  <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                  <input type="text" 
                         name="search" 
                         value="{{ $filterSearch ?? '' }}" 
                         placeholder="Buscar por título, contenido, autor o categoría..." 
                         class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-xl text-xs sm:text-sm focus:outline-none focus:border-[#39A900] bg-gray-50/50">
              </div>

              <div class="flex items-center gap-2 w-full md:w-auto">
                  <select name="category" class="px-3 py-2 border border-gray-200 rounded-xl text-xs sm:text-sm focus:outline-none focus:border-[#39A900] bg-white text-gray-700 font-medium">
                      <option value="Todas" {{ ($filterCategory ?? '') == 'Todas' ? 'selected' : '' }}>Todas las categorías</option>
                      @foreach($categories as $cat)
                          <option value="{{ $cat }}" {{ ($filterCategory ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                      @endforeach
                  </select>

                  <select name="status" class="px-3 py-2 border border-gray-200 rounded-xl text-xs sm:text-sm focus:outline-none focus:border-[#39A900] bg-white text-gray-700 font-medium">
                      <option value="Todos" {{ ($filterStatus ?? '') == 'Todos' ? 'selected' : '' }}>Todos los estados</option>
                      <option value="PUBLICADA" {{ ($filterStatus ?? '') == 'PUBLICADA' ? 'selected' : '' }}>Publicadas</option>
                      <option value="DESTACADA" {{ ($filterStatus ?? '') == 'DESTACADA' ? 'selected' : '' }}>Destacadas</option>
                      <option value="BORRADOR" {{ ($filterStatus ?? '') == 'BORRADOR' ? 'selected' : '' }}>Borrador</option>
                  </select>

                  <button type="submit" class="px-4 py-2 bg-gray-800 hover:bg-black text-white text-xs sm:text-sm font-semibold rounded-xl transition cursor-pointer">
                      <i class="fa-solid fa-filter mr-1"></i> Filtrar
                  </button>

                  @if(!empty($filterSearch) || (!empty($filterCategory) && $filterCategory !== 'Todas') || (!empty($filterStatus) && $filterStatus !== 'Todos'))
                      <a href="{{ route('egresados.instructor.noticias.index') }}" class="p-2 text-gray-400 hover:text-red-600 rounded-xl transition text-xs" title="Limpiar filtros">
                          <i class="fa-solid fa-xmark text-sm"></i>
                      </a>
                  @endif
              </div>
          </form>
      </div>

      <!-- 3. Listado de Noticias en Grilla Elegante con Imagen -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse($noticias as $item)
              <div class="news-card">
                  <!-- Portada de la Noticia -->
                  @if(!empty($item['image']))
                      <div class="news-card-img-wrap">
                          <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy">
                          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                          <span class="absolute bottom-3 left-3 badge-pill {{ $item['category_pill'] ?? 'status-green' }} shadow-md">
                              <i class="{{ $item['icon'] ?? 'fa-solid fa-tag' }} text-[10px]"></i>
                              {{ $item['category'] }}
                          </span>
                      </div>
                  @endif

                  <div class="news-card-body">
                      @if(empty($item['image']))
                          <!-- Card Header si no tiene imagen -->
                          <div class="flex items-center justify-between gap-2 mb-3">
                              <span class="badge-pill {{ $item['category_pill'] ?? 'status-green' }}">
                                  <i class="{{ $item['icon'] ?? 'fa-solid fa-tag' }} text-[10px]"></i>
                                  {{ $item['category'] }}
                              </span>
                              <div class="flex items-center gap-1.5 text-xs text-gray-400">
                                  <i class="fa-regular fa-calendar text-[11px]"></i>
                                  <span>{{ $item['date'] }}</span>
                              </div>
                          </div>
                      @else
                          <div class="flex items-center justify-between gap-2 mb-2 text-xs text-gray-400">
                              <div class="flex items-center gap-1.5">
                                  <i class="fa-regular fa-calendar text-[11px]"></i>
                                  <span>{{ $item['date'] }}</span>
                              </div>
                              <span class="text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">
                                  {{ $item['status'] ?? 'PUBLICADA' }}
                              </span>
                          </div>
                      @endif

                      <!-- Título -->
                      <h3 class="text-base font-bold text-gray-900 group-hover:text-[#39A900] transition line-clamp-2 leading-snug mb-2">
                          {{ $item['title'] }}
                      </h3>

                      <!-- Target Audience Pill -->
                      <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-gray-100 text-gray-600 text-[11px] font-semibold mb-3 self-start">
                          <i class="fa-solid fa-bullseye text-[10px] text-[#39A900]"></i>
                          <span>{{ $item['target'] ?? 'Comunidad CEFA' }}</span>
                      </div>

                      <!-- Resumen / Excerpt -->
                      <p class="text-xs text-gray-600 leading-relaxed line-clamp-3 mb-4">
                          {{ $item['summary'] }}
                      </p>

                      <!-- Footer de la Noticia con Autor y Acciones -->
                      <div class="pt-3 border-t border-gray-100 flex items-center justify-between mt-auto">
                          <div class="flex items-center gap-2">
                              <div class="w-7 h-7 rounded-full bg-emerald-100 text-[#39A900] flex items-center justify-center font-bold text-[10px] border border-emerald-200 flex-shrink-0">
                                  <i class="fa-solid fa-user-pen text-[10px]"></i>
                              </div>
                              <div class="overflow-hidden">
                                  <div class="text-[11px] font-bold text-gray-800 truncate max-w-[110px]">{{ $item['author'] }}</div>
                                  <div class="text-[9.5px] text-gray-400 flex items-center gap-1">
                                      <i class="fa-regular fa-eye"></i> {{ $item['views_count'] ?? 0 }} lecturas
                                  </div>
                              </div>
                          </div>

                          <!-- Botones de Acción -->
                          <div class="flex items-center gap-1.5">
                              <button type="button" 
                                      @click='noticiaActiva = @json($item); openDetalleModal = true'
                                      class="p-2 rounded-lg text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition cursor-pointer text-xs" 
                                      title="Leer artículo completo">
                                  <i class="fa-solid fa-book-open"></i>
                              </button>

                              <button type="button" 
                                      @click='noticiaActiva = @json($item); imagePreview = noticiaActiva.image || null; openEditModal = true'
                                      class="p-2 rounded-lg text-amber-700 bg-amber-50 hover:bg-amber-100 transition cursor-pointer text-xs" 
                                      title="Editar comunicado">
                                  <i class="fa-solid fa-pen-to-square"></i>
                              </button>

                              <button type="button" 
                                      @click="noticiaAEliminar = { id: '{{ $item['id'] }}', title: '{{ addslashes($item['title']) }}' }; openDeleteModal = true" 
                                      class="p-2 rounded-lg text-red-600 bg-red-50 hover:bg-red-100 transition cursor-pointer text-xs" 
                                      title="Eliminar noticia">
                                  <i class="fa-solid fa-trash-can"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          @empty
              <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-gray-200">
                  <div class="w-14 h-14 bg-gray-100 text-gray-400 rounded-2xl flex items-center justify-center mx-auto mb-3 text-xl">
                      <i class="fa-solid fa-newspaper"></i>
                  </div>
                  <h3 class="font-bold text-gray-700 text-base">No se encontraron noticias</h3>
                  <p class="text-xs text-gray-400 mt-1">Intenta con otros filtros o publica un nuevo comunicado institucional.</p>
              </div>
          @endforelse
      </div>

    </div>

  </div>

</div>

<!-- ========================================================================= -->
<!-- MODAL 1: PUBLICAR NOTICIA (CON COLORES INSTITUCIONALES SENA ERP & IMAGEN) -->
<!-- ========================================================================= -->
<div x-cloak x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/65 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6">
    <div @click.away="openModal = false" 
         class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[92vh] overflow-hidden">
        
        <!-- Encabezado Oficial SENA Empresa ERP -->
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-lg shadow-md shadow-black/20 flex-shrink-0">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <div>
                    <div class="text-[10.5px] font-extrabold text-[#62E31D] uppercase tracking-wider">GESTIÓN DE EGRESADOS · SIGE</div>
                    <h3 class="text-xl font-bold text-white tracking-tight">Publicar Nueva Noticia</h3>
                    <p class="text-xs text-white/70 mt-0.5">Difusión oficial de información para la comunidad de egresados.</p>
                </div>
            </div>
            <button @click="openModal = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Formulario con scroll suave -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-5">
            <form action="{{ route('egresados.instructor.noticias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Título -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Título de la Noticia <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" required placeholder="Ej: Apertura de Convocatoria Especial de Empleo..." 
                           class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                </div>

                <!-- Categoría y Estado -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Categoría <span class="text-red-500">*</span>
                        </label>
                        <select name="category" required class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Estado de Publicación <span class="text-red-500">*</span>
                        </label>
                        <select name="status" required class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                            <option value="PUBLICADA">Publicada Inmediata</option>
                            <option value="DESTACADA">Destacada (Prioridad)</option>
                            <option value="BORRADOR">Guardar como Borrador</option>
                        </select>
                    </div>
                </div>

                <!-- Subir o Enlazar Imagen (Doble Opción: Archivo o URL) -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Imagen / Portada de la Noticia
                        </label>
                        <!-- Selector de Modo: Archivo o URL -->
                        <div class="inline-flex rounded-lg bg-gray-100 p-0.5 border border-gray-200">
                            <button type="button" 
                                    @click="imageMode = 'file'" 
                                    :class="imageMode === 'file' ? 'bg-white text-gray-900 shadow-xs font-bold' : 'text-gray-500 hover:text-gray-700 font-medium'"
                                    class="px-2.5 py-1 text-[11px] rounded-md transition flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-cloud-arrow-up text-[10px] text-[#39A900]"></i>
                                <span>Subir Archivo</span>
                            </button>
                            <button type="button" 
                                    @click="imageMode = 'url'" 
                                    :class="imageMode === 'url' ? 'bg-white text-gray-900 shadow-xs font-bold' : 'text-gray-500 hover:text-gray-700 font-medium'"
                                    class="px-2.5 py-1 text-[11px] rounded-md transition flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-link text-[10px] text-blue-600"></i>
                                <span>Pegar URL</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Opción A: Subir Archivo Local -->
                    <div x-show="imageMode === 'file'" x-transition>
                        <div class="border-2 border-dashed border-gray-200 hover:border-[#39A900] rounded-2xl p-4 transition bg-gray-50/50 hover:bg-emerald-50/20 text-center relative cursor-pointer"
                             @click="$refs.superImageInput.click()">
                            
                            <input type="file" 
                                   name="image" 
                                   x-ref="superImageInput" 
                                   accept="image/png, image/jpeg, image/jpg, image/webp" 
                                   class="hidden" 
                                   @change="
                                       const file = $event.target.files[0];
                                       if (file) {
                                           const reader = new FileReader();
                                           reader.onload = (e) => { imagePreview = e.target.result; imageUrlInput = ''; };
                                           reader.readAsDataURL(file);
                                       }
                                   ">

                            <div class="py-3 flex flex-col items-center justify-center">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-[#39A900] flex items-center justify-center text-xl mb-2 shadow-xs">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>
                                <div class="text-xs font-bold text-gray-700">Haz clic aquí para seleccionar una imagen de portada</div>
                                <p class="text-[11px] text-gray-400 mt-0.5">JPG, PNG o WebP (máx 5MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Opción B: Pegar URL de Imagen -->
                    <div x-show="imageMode === 'url'" x-transition class="space-y-2">
                        <div class="relative">
                            <i class="fa-solid fa-link absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                            <input type="url" 
                                   name="image_url" 
                                   x-model="imageUrlInput" 
                                   @input="if(imageUrlInput.trim().length > 5) { imagePreview = imageUrlInput.trim(); } else { imagePreview = null; }"
                                   placeholder="https://images.unsplash.com/... o cualquier URL de imagen" 
                                   class="w-full pl-9 pr-4 py-2.5 text-xs sm:text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                        <p class="text-[11px] text-gray-400">Pega el enlace web directo (HTTP/HTTPS) de cualquier imagen para usarla de portada.</p>
                    </div>

                    <!-- Vista Previa Unificada (Tanto para archivo como para URL) -->
                    <template x-if="imagePreview">
                        <div class="mt-3 relative group">
                            <img :src="imagePreview" alt="Vista previa" class="w-full h-44 object-cover rounded-xl shadow-sm border border-gray-200">
                            <button type="button" 
                                    @click.stop="imagePreview = null; imageUrlInput = ''; if($refs.superImageInput) $refs.superImageInput.value = ''" 
                                    class="absolute top-2 right-2 px-3 py-1 bg-red-600/90 hover:bg-red-700 text-white rounded-lg text-xs font-bold shadow-md transition flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-trash-can text-[11px]"></i> Quitar imagen
                            </button>
                        </div>
                    </template>
                </div>

                <!-- Destinatarios -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Público Objetivo / Destinatarios
                    </label>
                    <input type="text" name="target" placeholder="Ej: Todos los Egresados CEFA, Tecnólogos ADSO, Sector Pecuario..." 
                           class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                </div>

                <!-- Resumen -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Resumen Corto (Lead) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="summary" rows="2" required placeholder="Breve introducción que se muestra en las tarjetas principales..." 
                              class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium"></textarea>
                </div>

                <!-- Contenido -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Contenido Completo de la Noticia <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" rows="4" required placeholder="Escribe el cuerpo completo del comunicado, fechas clave, requisitos, pasos a seguir..." 
                              class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium"></textarea>
                </div>

                <!-- Botones SENA ERP -->
                <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                    <button @click="openModal = false" type="button" class="px-5 py-2.5 border border-gray-200 text-gray-700 hover:bg-gray-100 rounded-xl text-xs sm:text-sm font-semibold transition cursor-pointer">
                        Cancelar
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white rounded-xl text-xs sm:text-sm font-bold shadow-md shadow-[#39A900]/25 hover:shadow-lg hover:-translate-y-0.5 transition cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                        <span>Publicar Noticia</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL 2: VER DETALLE COMPLETO DE LA NOTICIA -->
<!-- ============================================== -->
<div x-cloak x-show="openDetalleModal" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/70 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6">
    <div @click.away="openDetalleModal = false" class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full border border-gray-100 overflow-hidden relative">
        
        <!-- Imagen Hero si tiene imagen -->
        <template x-if="noticiaActiva.image">
            <div class="w-full h-52 relative overflow-hidden bg-[#00131E]">
                <img :src="noticiaActiva.image" alt="Portada Noticia" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                <div class="absolute bottom-4 left-6 right-6">
                    <span class="badge-pill mb-2" :class="noticiaActiva.category_pill" x-text="noticiaActiva.category"></span>
                    <h2 class="text-xl sm:text-2xl font-bold text-white drop-shadow-sm leading-tight" x-text="noticiaActiva.title"></h2>
                </div>
                <button @click="openDetalleModal = false" class="absolute top-4 right-4 text-white/80 hover:text-white p-2 rounded-xl bg-black/40 hover:bg-black/60 transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
        </template>

        <!-- Encabezado simple si no tiene imagen -->
        <template x-if="!noticiaActiva.image">
            <div class="flex items-start justify-between p-6 sm:p-8 border-b border-gray-100">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="badge-pill" :class="noticiaActiva.category_pill" x-text="noticiaActiva.category"></span>
                        <span class="badge-pill" :class="noticiaActiva.status_pill" x-text="noticiaActiva.status"></span>
                        <span class="text-xs text-gray-400" x-text="noticiaActiva.date"></span>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900" x-text="noticiaActiva.title"></h2>
                </div>
                <button @click="openDetalleModal = false" class="text-gray-400 hover:text-gray-600 p-1.5 rounded-lg transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
        </template>

        <div class="p-6 sm:p-8 space-y-4">
            <div class="p-3.5 bg-emerald-50/70 border border-emerald-100 rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-2 text-xs text-emerald-900 font-semibold">
                    <i class="fa-solid fa-bullseye text-[#39A900]"></i>
                    <span>Dirigido a: <strong x-text="noticiaActiva.target || 'Toda la comunidad'"></strong></span>
                </div>
                <div class="text-xs text-gray-500 font-medium">
                    <i class="fa-regular fa-eye mr-1"></i> <span x-text="noticiaActiva.views_count"></span> vistas
                </div>
            </div>

            <div class="space-y-4 text-xs sm:text-sm text-gray-700 leading-relaxed max-h-[40vh] overflow-y-auto pr-2">
                <div class="font-semibold text-gray-900 text-sm sm:text-base border-l-3 border-[#39A900] pl-3 py-1 bg-gray-50 rounded-r-lg" x-text="noticiaActiva.summary"></div>
                <div class="whitespace-pre-line text-gray-600 leading-relaxed" x-text="noticiaActiva.content"></div>
            </div>

            <div class="pt-5 border-t border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-2 text-xs text-gray-500">
                    <i class="fa-solid fa-shield-halved text-[#39A900]"></i>
                    <span>Publicado por: <strong class="text-gray-800" x-text="noticiaActiva.author"></strong></span>
                </div>
                <button @click="openDetalleModal = false" class="px-5 py-2 bg-gray-800 hover:bg-black text-white rounded-xl text-xs font-bold transition">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL 3: EDITAR NOTICIA INSTITUCIONAL -->
<!-- ============================================== -->
<div x-cloak x-show="openEditModal" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/65 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6">
    <div @click.away="openEditModal = false" class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[92vh] overflow-hidden">
        
        <div class="flex items-center justify-between border-b-2 border-amber-500 px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 text-white flex items-center justify-center text-lg shadow-md shadow-black/20 flex-shrink-0">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <div class="text-[10.5px] font-extrabold text-amber-400 uppercase tracking-wider">GESTIÓN DE EGRESADOS · SIGE</div>
                    <h3 class="text-xl font-bold text-white tracking-tight">Editar Noticia / Comunicado</h3>
                    <p class="text-xs text-white/70 mt-0.5">Código de noticia: <span class="font-mono font-bold text-white" x-text="noticiaActiva.id"></span></p>
                </div>
            </div>
            <button @click="openEditModal = false" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-5">
            <form :action="'{{ url('egresados/instructor/noticias') }}/' + encodeURIComponent(noticiaActiva.id)" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Título de la Noticia *</label>
                    <input type="text" name="title" required x-model="noticiaActiva.title" 
                           class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Categoría *</label>
                        <select name="category" required x-model="noticiaActiva.category" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Estado de Publicación *</label>
                        <select name="status" required x-model="noticiaActiva.status" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                            <option value="PUBLICADA">Publicada</option>
                            <option value="DESTACADA">Destacada</option>
                            <option value="BORRADOR">Borrador</option>
                        </select>
                    </div>
                </div>

                <!-- Cambiar o Enlazar Imagen -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Actualizar Imagen de Portada
                        </label>
                        <!-- Selector de Modo: Archivo o URL -->
                        <div class="inline-flex rounded-lg bg-gray-100 p-0.5 border border-gray-200">
                            <button type="button" 
                                    @click="imageMode = 'file'" 
                                    :class="imageMode === 'file' ? 'bg-white text-gray-900 shadow-xs font-bold' : 'text-gray-500 hover:text-gray-700 font-medium'"
                                    class="px-2.5 py-1 text-[11px] rounded-md transition flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-cloud-arrow-up text-[10px] text-amber-600"></i>
                                <span>Subir Archivo</span>
                            </button>
                            <button type="button" 
                                    @click="imageMode = 'url'" 
                                    :class="imageMode === 'url' ? 'bg-white text-gray-900 shadow-xs font-bold' : 'text-gray-500 hover:text-gray-700 font-medium'"
                                    class="px-2.5 py-1 text-[11px] rounded-md transition flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-link text-[10px] text-blue-600"></i>
                                <span>Pegar URL</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Opción A: Archivo Local -->
                    <div x-show="imageMode === 'file'" x-transition>
                        <div class="border-2 border-dashed border-gray-200 hover:border-amber-500 rounded-2xl p-4 transition bg-gray-50/50 hover:bg-amber-50/20 text-center relative cursor-pointer"
                             @click="$refs.editImageInput.click()">
                            
                            <input type="file" 
                                   name="image" 
                                   x-ref="editImageInput" 
                                   accept="image/png, image/jpeg, image/jpg, image/webp" 
                                   class="hidden" 
                                   @change="
                                       const file = $event.target.files[0];
                                       if (file) {
                                           const reader = new FileReader();
                                           reader.onload = (e) => { imagePreview = e.target.result; imageUrlInput = ''; };
                                           reader.readAsDataURL(file);
                                       }
                                   ">

                            <div class="py-3 flex flex-col items-center justify-center">
                                <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl mb-2">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>
                                <div class="text-xs font-bold text-gray-700">Haz clic aquí para seleccionar o cambiar la imagen</div>
                                <p class="text-[11px] text-gray-400 mt-0.5">JPG, PNG o WebP (máx 5MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Opción B: Pegar URL -->
                    <div x-show="imageMode === 'url'" x-transition class="space-y-2">
                        <div class="relative">
                            <i class="fa-solid fa-link absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                            <input type="url" 
                                   name="image_url" 
                                   x-model="imageUrlInput" 
                                   @input="if(imageUrlInput.trim().length > 5) { imagePreview = imageUrlInput.trim(); } else { imagePreview = noticiaActiva.image || null; }"
                                   placeholder="https://images.unsplash.com/... o pega cualquier URL de imagen" 
                                   class="w-full pl-9 pr-4 py-2.5 text-xs sm:text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none transition font-medium">
                        </div>
                        <p class="text-[11px] text-gray-400">Pega el nuevo enlace web de la imagen para actualizar la portada.</p>
                    </div>

                    <!-- Vista Previa -->
                    <template x-if="imagePreview">
                        <div class="mt-3 relative group">
                            <img :src="imagePreview" alt="Vista previa" class="w-full h-44 object-cover rounded-xl shadow-sm border border-gray-200">
                            <button type="button" 
                                    @click.stop="imagePreview = null; imageUrlInput = ''; if($refs.editImageInput) $refs.editImageInput.value = ''" 
                                    class="absolute top-2 right-2 px-3 py-1 bg-red-600/90 hover:bg-red-700 text-white rounded-lg text-xs font-bold shadow-md transition flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-trash-can text-[11px]"></i> Quitar imagen
                            </button>
                        </div>
                    </template>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Público Objetivo</label>
                    <input type="text" name="target" x-model="noticiaActiva.target" 
                           class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Resumen Corto *</label>
                    <textarea name="summary" rows="2" required x-model="noticiaActiva.summary" 
                              class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Contenido Completo *</label>
                    <textarea name="content" rows="4" required x-model="noticiaActiva.content" 
                              class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium"></textarea>
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                    <button @click="openEditModal = false" type="button" class="px-5 py-2.5 border border-gray-200 text-gray-700 hover:bg-gray-100 rounded-xl text-xs sm:text-sm font-semibold transition cursor-pointer">
                        Cancelar
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white rounded-xl text-xs sm:text-sm font-bold shadow-md shadow-amber-600/25 transition cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Guardar Cambios</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL 4: CONFIRMAR ELIMINACIÓN DE NOTICIA -->
<!-- ============================================== -->
<div x-cloak x-show="openDeleteModal" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/65 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6">
    <div @click.away="openDeleteModal = false" class="bg-white rounded-3xl max-w-md w-full shadow-2xl border border-gray-100 flex flex-col overflow-hidden animate-in fade-in zoom-in-95 duration-200">
        
        <!-- Encabezado Modal con Gradiente SENA ERP -->
        <div class="flex items-center justify-between border-b-2 border-red-500 px-6 py-4 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-500/20 border border-red-500/40 text-red-400 flex items-center justify-center text-base shadow-sm flex-shrink-0">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
                <div>
                    <div class="text-[10px] font-extrabold text-red-400 uppercase tracking-wider">CONFIRMACIÓN REQUERIDA</div>
                    <h3 class="text-base font-bold text-white tracking-tight">Eliminar Noticia</h3>
                </div>
            </div>
            <button @click="openDeleteModal = false" type="button" class="text-white/70 hover:text-white p-1.5 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>

        <!-- Cuerpo del Modal -->
        <div class="p-6 space-y-4 bg-white">
            <div class="p-4 rounded-2xl bg-red-50/80 border border-red-200/80 flex items-start gap-3">
                <div class="w-8 h-8 rounded-xl bg-red-600 text-white flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                </div>
                <div class="text-xs text-red-950 flex-1">
                    <div class="font-bold text-red-900 text-sm">¿Desea eliminar esta noticia?</div>
                    <p class="text-red-700 text-xs mt-1 leading-relaxed">
                        Esta acción retirará la noticia del portal institucional y del carrusel de inicio. No se podrá recuperar.
                    </p>
                </div>
            </div>

            <!-- Previsualización de la Noticia Seleccionada -->
            <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-200/80 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-gray-200 text-gray-600 flex items-center justify-center text-xs flex-shrink-0 font-mono font-bold">
                    <i class="fa-regular fa-newspaper"></i>
                </div>
                <div class="overflow-hidden flex-1">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block font-mono" x-text="noticiaAEliminar.id"></span>
                    <span class="text-xs font-bold text-gray-800 truncate block mt-0.5" x-text="noticiaAEliminar.title"></span>
                </div>
            </div>
        </div>

        <!-- Footer con Acciones -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3">
            <button @click="openDeleteModal = false" type="button" class="px-4 py-2 border border-gray-200 text-gray-700 hover:bg-gray-100 rounded-xl text-xs font-semibold transition cursor-pointer">
                Cancelar
            </button>
            <form :action="'{{ url('egresados/instructor/noticias') }}/' + encodeURIComponent(noticiaAEliminar.id)" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-5 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-xl text-xs font-bold shadow-md shadow-red-600/25 transition cursor-pointer flex items-center gap-2">
                    <i class="fa-solid fa-trash-can text-xs"></i>
                    <span>Sí, Eliminar</span>
                </button>
            </form>
        </div>

    </div>
</div>

<!-- Modal de Alertas y Notificaciones Institucionales -->
@include('egresados::superadmin.partials._modal_alertas')

</body>
</html>
