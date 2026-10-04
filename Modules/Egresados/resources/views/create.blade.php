<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Registrar Egresado — CEFA La Angostura</title>

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
        --sena-primary: #39A900;
        --sena-hover: #2a7c00;
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
        background: #f4faf6;
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
        max-width: 920px;
        width: 100%;
        margin: 0 auto;
      }

      .back-btn-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 700;
        color: #008f39;
        text-decoration: none;
        margin-bottom: 16px;
        transition: color 0.15s;
      }
      .back-btn-link:hover {
        color: #006829;
        text-decoration: underline;
      }

      .header-card {
        background: #ffffff;
        border: 1px solid #eaf3ed;
        border-radius: 24px;
        padding: 24px 28px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 20px rgba(0, 56, 25, 0.04);
      }

      .form-card {
        background: #ffffff;
        border: 1px solid #eaf3ed;
        border-radius: 28px;
        padding: 36px 36px 40px;
        box-shadow: 0 6px 24px rgba(0, 56, 25, 0.05);
      }

      .step-badge {
        width: 28px;
        height: 28px;
        border-radius: 999px;
        background: #008f39;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 800;
        flex-shrink: 0;
      }

      .step-title {
        font-size: 16px;
        font-weight: 800;
        color: #0f361d;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
      }

      .custom-input {
        width: 100%;
        padding: 12px 16px;
        font-size: 14px;
        border: 1.5px solid #d8e5dd;
        border-radius: 14px;
        background: #ffffff;
        color: #1a2e22;
        outline: none;
        transition: all 0.2s ease;
      }
      .custom-input:focus {
        border-color: #008f39;
        box-shadow: 0 0 0 3px rgba(0, 143, 57, 0.12);
      }
      .custom-input::placeholder {
        color: #9cb1a4;
      }

      .custom-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #1a2e22;
        margin-bottom: 6px;
      }
      .custom-label .req {
        color: #ef4444;
      }

      .info-box-green {
        background: #f0faf3;
        border: 1.5px solid #d4eedd;
        border-radius: 18px;
        padding: 16px 20px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-top: 28px;
      }
      .info-box-icon {
        width: 32px;
        height: 32px;
        border-radius: 999px;
        background: #008f39;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
        margin-top: 2px;
      }

      .btn-submit-green {
        background: #008f39;
        color: #ffffff;
        font-weight: 800;
        font-size: 15px;
        padding: 14px 28px;
        border-radius: 14px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(0, 143, 57, 0.3);
        transition: all 0.2s ease;
      }
      .btn-submit-green:hover {
        background: #007a30;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(0, 143, 57, 0.4);
      }

      .btn-cancel-gray {
        background: #f1f5f3;
        color: #4b6354;
        font-weight: 700;
        font-size: 14px;
        padding: 14px 24px;
        border-radius: 14px;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
      }
      .btn-cancel-gray:hover {
        background: #e2ece6;
        color: #1a2e22;
      }

      @media (max-width: 1080px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .content-area { padding: 20px 18px 40px; }
      }
    </style>
</head>
<body>

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
        <a href="{{ route('login', ['redirect' => route('egresados.create')]) }}" class="logout-btn">
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

    <!-- Content Area: EXACT DESIGN AS REQUESTED -->
    <div class="content-area">

      <!-- Botón Volver -->
      <a href="{{ route('egresados.index') }}" class="back-btn-link">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Volver a la gestión de egresados</span>
      </a>

      <!-- Header Banner Exacto -->
      <div class="header-card">
        <div>
          <div class="text-[11px] font-extrabold text-[#008f39] uppercase tracking-wider mb-1">GESTIÓN DE EGRESADOS</div>
          <h1 class="text-2xl sm:text-3xl font-extrabold text-[#11291b] tracking-tight">Registrar egresado</h1>
          <p class="text-xs sm:text-sm text-gray-500 mt-1">Crea un registro para un egresado sin salir del panel administrativo.</p>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-[#008f39] text-white flex items-center justify-center text-xl shadow-md flex-shrink-0">
          <i class="fa-solid fa-user-plus"></i>
        </div>
      </div>

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

      <!-- Card Principal del Formulario -->
      <div class="form-card">
        <form action="{{ route('egresados.superadmin.store') }}" method="POST" class="space-y-8">
          @csrf

          <!-- 1. Datos personales -->
          <div>
            <div class="step-title">
              <span class="step-badge">1</span>
              <span>Datos personales</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="custom-label">Nombres <span class="req">*</span></label>
                <input type="text" name="nombres" value="{{ old('nombres') }}" required placeholder="Ej. Juan Carlos" class="custom-input">
              </div>
              <div>
                <label class="custom-label">Apellidos <span class="req">*</span></label>
                <input type="text" name="apellidos" value="{{ old('apellidos') }}" required placeholder="Ej. Pérez Rodríguez" class="custom-input">
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
              <div>
                <label class="custom-label">Tipo de documento <span class="req">*</span></label>
                <select name="tipo_documento" required class="custom-input">
                  <option value="CC" {{ old('tipo_documento') == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía (CC)</option>
                  <option value="TI" {{ old('tipo_documento') == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad (TI)</option>
                  <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>Cédula de Extranjería (CE)</option>
                  <option value="PEP" {{ old('tipo_documento') == 'PEP' ? 'selected' : '' }}>PEP</option>
                </select>
              </div>
              <div class="sm:col-span-2">
                <label class="custom-label">DNI / Cédula <span class="req">*</span></label>
                <input type="text" name="documento" value="{{ old('documento') }}" required placeholder="Ej. 1060123456" class="custom-input">
              </div>
            </div>
          </div>

          <!-- 2. Información de contacto -->
          <div>
            <div class="step-title">
              <span class="step-badge">2</span>
              <span>Información de contacto</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="custom-label">Correo electrónico <span class="req">*</span></label>
                <input type="email" name="correo" value="{{ old('correo') }}" required placeholder="egresado@correo.com" class="custom-input">
              </div>
              <div>
                <label class="custom-label">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" placeholder="Ej. 3001234567" class="custom-input">
              </div>
            </div>
          </div>

          <!-- 3. Información académica (SENA) -->
          <div>
            <div class="step-title">
              <span class="step-badge">3</span>
              <span>Información académica</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="custom-label">Programa de Formación <span class="req">*</span></label>
                <select name="programa" required class="custom-input">
                  <option value="">Seleccione un programa...</option>
                  <option value="ADSO" {{ old('programa') == 'ADSO' ? 'selected' : '' }}>Análisis y Desarrollo de Software (ADSO)</option>
                  <option value="GESTION_AGROPECUARIA" {{ old('programa') == 'GESTION_AGROPECUARIA' ? 'selected' : '' }}>Gestión de Empresas Agropecuarias</option>
                  <option value="PROCESAMIENTO_ALIMENTOS" {{ old('programa') == 'PROCESAMIENTO_ALIMENTOS' ? 'selected' : '' }}>Procesamiento de Alimentos</option>
                  <option value="PRODUCCION_GANADERA" {{ old('programa') == 'PRODUCCION_GANADERA' ? 'selected' : '' }}>Producción Ganadera</option>
                </select>
              </div>
              <div>
                <label class="custom-label">Código de Ficha <span class="req">*</span></label>
                <input type="number" name="ficha" value="{{ old('ficha') }}" required placeholder="Ej. 3145614" class="custom-input">
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
              <div>
                <label class="custom-label">Centro de Formación</label>
                <input type="text" name="centro_formacion" value="CEFA La Angostura" readonly class="custom-input bg-gray-50 text-gray-500 cursor-not-allowed">
              </div>
              <div>
                <label class="custom-label">Estado Ocupacional <span class="req">*</span></label>
                <select name="estado" required class="custom-input">
                  <option value="CERTIFICADO" {{ old('estado') == 'CERTIFICADO' ? 'selected' : '' }}>Certificado</option>
                  <option value="EN_FORMACION" {{ old('estado') == 'EN_FORMACION' ? 'selected' : '' }}>En Formación</option>
                  <option value="EMPLEADO" {{ old('estado') == 'EMPLEADO' ? 'selected' : '' }}>Empleado</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Banner Informativo -->
          <div class="info-box-green">
            <div class="info-box-icon">
              <i class="fa-solid fa-info"></i>
            </div>
            <div>
              <div class="text-sm font-bold text-[#008f39]">Rol y vinculación institucional</div>
              <p class="text-xs text-[#2c5239] mt-0.5 leading-relaxed">
                Este formulario registra únicamente usuarios con rol <strong>egresado / aprendiz</strong> del CEFA La Angostura. El egresado podrá acceder al portal con su número de documento asignado.
              </p>
            </div>
          </div>

          <!-- Botones de Acción Exactos -->
          <div class="flex flex-col sm:flex-row items-center gap-3 pt-4">
            <button type="submit" class="btn-submit-green w-full sm:w-auto">
              <i class="fa-solid fa-id-card"></i>
              <span>Registrar egresado</span>
            </button>
            <a href="{{ route('egresados.index') }}" class="btn-cancel-gray w-full sm:w-auto">
              Cancelar
            </a>
          </div>

        </form>
      </div>

    </div>

  </div>

</div>

</body>
</html>
