<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gestión de Reportes — CEFA La Angostura</title>

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

    <!-- html2pdf.js CDN para exportación a PDF -->
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

      .topbar-right {
        display: flex;
        align-items: center;
        gap: 18px;
      }

      .user-chip {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
      }
      .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--green);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 800;
      }

      .content {
        padding: 28px 36px;
        flex: 1;
      }

      [x-cloak] { display: none !important; }
    </style>
</head>
<body>

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
          SIGE <span class="brand-tag">SuperAdmin</span>
        </div>
        <div class="brand-sub">CEFA La Angostura</div>
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
      <a href="{{ route('egresados.superadmin.encuestas.index') }}">
        <i class="fa-solid fa-clipboard-question"></i>
        <span>Encuestas</span>
      </a>
      <a href="{{ route('egresados.reportes') }}" class="active">
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
        <a href="{{ route('login', ['redirect' => route('egresados.reportes')]) }}" class="logout-btn">
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

    <!-- Main Content con Alpine.js -->
    <div class="content space-y-6" x-data="{ openModal: false }">

      <!-- Alertas Flash -->
      @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs sm:text-sm font-semibold flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
      @endif

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

      <!-- Encabezado y botón Crear Reporte -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
              <h1 class="text-2xl sm:text-3xl font-bold font-editorial text-gray-900 tracking-tight">
                  Gestión de <span class="text-[#39A900]">Reportes</span>
              </h1>
              <p class="text-xs sm:text-sm text-gray-500 mt-1">Generación y consulta de reportes institucionales del CEFA.</p>
          </div>
          <div class="flex items-center gap-3">
              <button @click="openModal = true" 
                      type="button" 
                      class="inline-flex items-center justify-center px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs sm:text-sm font-bold rounded-xl transition shadow-sm hover:shadow-md hover:-translate-y-0.5 cursor-pointer">
                  <i class="fa-solid fa-plus mr-2 text-xs"></i>
                  <span>Crear Reporte</span>
              </button>
          </div>
      </div>

      <!-- 1. Estadísticas Superiores -->
      @include('egresados::superadmin.reportes.partials._estadisticas')

      <!-- Layout de la Grilla (Tabla 2/3 + Detalle 1/3) -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
          <!-- 2. Filtros y Tabla de Reportes -->
          @include('egresados::superadmin.reportes.partials._tabla')
          
          <!-- 3. Detalle lateral reactivo -->
          @include('egresados::superadmin.reportes.partials._detalle')
      </div>

      <!-- 4. Modal para Crear Reporte -->
      @include('egresados::superadmin.reportes.partials._modal_crear')

    </div>

  </div>

</div>

<!-- Scripts interactivos de Reportes -->
<script>
    // Función interactiva para actualizar el panel de detalles reactivo
    function selectReporte(data, rowId) {
        if (!data) return;

        // Actualizar fila activa
        document.querySelectorAll('.report-row').forEach(row => {
            row.classList.remove('bg-emerald-50/60', 'font-semibold');
        });
        const activeRow = document.getElementById(rowId);
        if (activeRow) {
            activeRow.classList.add('bg-emerald-50/60', 'font-semibold');
        }

        // Actualizar datos del panel lateral
        const fullTitle = data.full_title || data.title || 'Reporte Institucional';
        document.getElementById('detailReportTitle').innerText = fullTitle;
        document.getElementById('detailReportMeta').innerText = 'ID: ' + (data.id || 'REP-000') + ' | Fecha: ' + (data.date || 'N/A');
        document.getElementById('detailReportProgram').innerText = data.program || 'General';
        document.getElementById('detailReportResp').innerText = data.generated_by || 'Coordinación Académica';

        document.getElementById('detailTotalEgresados').innerText = data.total_egresados || 0;
        document.getElementById('detailEmpleados').innerText = data.empleados || 0;
        document.getElementById('detailDesempleados').innerText = data.desempleados || 0;
        document.getElementById('detailRate').innerText = data.rate || '0%';

        const progressBar = document.getElementById('detailProgressBar');
        if (progressBar) {
            progressBar.style.width = (data.rate_num || parseInt(data.rate) || 0) + '%';
        }

        // Filtros aplicados
        if (data.filters) {
            document.getElementById('detailFiltroProg').innerText = data.filters.programa || 'Todos';
            document.getElementById('detailFiltroFicha').innerText = data.filters.ficha || 'Todas';
            document.getElementById('detailFiltroRegion').innerText = data.filters.region || 'Huila';
            document.getElementById('detailFiltroPeriodo').innerText = data.filters.periodo || 'Histórico Completo';
        }

        const badge = document.getElementById('detailStatusBadge');
        if (badge) {
            badge.innerText = data.status || 'GENERADO';
        }

        // Actualizar enlaces de acciones directas
        const currentId = data.id || 'REP_002';
        const baseUrl = "{{ url('egresados/superadmin/reportes') }}/" + encodeURIComponent(currentId);

        const btnExcel = document.getElementById('btnActionExcel');
        if (btnExcel) {
            btnExcel.href = baseUrl + "/exportar/excel?title=" + encodeURIComponent(fullTitle);
        }

        const btnPdf = document.getElementById('btnActionPdf');
        if (btnPdf) {
            btnPdf.href = baseUrl + "/exportar/pdf?title=" + encodeURIComponent(fullTitle);
        }

        const btnGraficas = document.getElementById('btnActionGraficas');
        if (btnGraficas) {
            btnGraficas.href = baseUrl + "/graficas";
        }

        const formEnvio = document.getElementById('formEnviarCorreo');
        if (formEnvio) {
            formEnvio.action = baseUrl + "/enviar";
        }

        const formEliminar = document.getElementById('formEliminarReporte');
        if (formEliminar) {
            formEliminar.action = baseUrl;
        }
    }

    // Filtrado interactivo en tabla
    function applyFilters() {
        const progFilter = (document.getElementById('filterPrograma')?.value || '').toLowerCase();
        const tipoFilter = (document.getElementById('filterTipo')?.value || '').toLowerCase();
        const formatFilter = (document.getElementById('filterFormato')?.value || '').toLowerCase();
        const textFilter = (document.getElementById('filterText')?.value || '').toLowerCase();

        const rows = document.querySelectorAll('#reportesTable tbody tr.report-row');

        rows.forEach(row => {
            const rowProg = (row.getAttribute('data-program') || '').toLowerCase();
            const rowTitle = (row.getAttribute('data-title') || '').toLowerCase();
            const rowType = (row.getAttribute('data-type') || '').toLowerCase();
            const rowFormat = (row.getAttribute('data-format') || '').toLowerCase();

            const matchProg = !progFilter || rowProg.includes(progFilter) || rowTitle.includes(progFilter);
            const matchTipo = !tipoFilter || rowType.includes(tipoFilter);
            const matchFormat = !formatFilter || rowFormat.includes(formatFilter);
            const matchText = !textFilter || rowTitle.includes(textFilter) || rowProg.includes(textFilter);

            if (matchProg && matchTipo && matchFormat && matchText) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Exportación a PDF con html2pdf
    function descargarReportePDF() {
        const title = document.getElementById('detailReportTitle').innerText;
        const total = document.getElementById('detailTotalEgresados').innerText;
        const emp = document.getElementById('detailEmpleados').innerText;
        const des = document.getElementById('detailDesempleados').innerText;
        const rate = document.getElementById('detailRate').innerText;
        const prog = document.getElementById('detailReportProgram').innerText;
        const resp = document.getElementById('detailReportResp').innerText;

        const container = document.createElement('div');
        container.style.padding = '30px';
        container.style.fontFamily = 'Arial, sans-serif';
        container.innerHTML = `
            <div style="border-bottom: 2px solid #39A900; padding-bottom: 15px; margin-bottom: 20px;">
                <h1 style="color: #001A29; margin: 0; font-size: 20px;">SENA EMPRESA — Centro Agroindustrial La Angostura</h1>
                <h2 style="color: #39A900; margin: 5px 0 0; font-size: 16px;">${title}</h2>
                <p style="color: #666; font-size: 11px; margin: 4px 0 0;">Generado: ${new Date().toLocaleDateString('es-CO')} | Responsable: ${resp}</p>
            </div>
            <div style="margin-bottom: 20px;">
                <h3 style="font-size: 14px; color: #001A29;">Resumen Ejecutivo de Indicadores</h3>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px;">
                    <tr style="background: #f4f4f4;"><th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Métrica</th><th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Valor</th></tr>
                    <tr><td style="border: 1px solid #ddd; padding: 8px;">Programa Académico</td><td style="border: 1px solid #ddd; padding: 8px; text-align: right; font-weight: bold;">${prog}</td></tr>
                    <tr><td style="border: 1px solid #ddd; padding: 8px;">Total Egresados Evaluados</td><td style="border: 1px solid #ddd; padding: 8px; text-align: right; font-weight: bold;">${total}</td></tr>
                    <tr><td style="border: 1px solid #ddd; padding: 8px;">Egresados Vinculados (Empleo / Emprendimiento)</td><td style="border: 1px solid #ddd; padding: 8px; text-align: right; font-weight: bold; color: #2e7d32;">${emp}</td></tr>
                    <tr><td style="border: 1px solid #ddd; padding: 8px;">Buscando Empleo / Otros</td><td style="border: 1px solid #ddd; padding: 8px; text-align: right; font-weight: bold;">${des}</td></tr>
                    <tr style="background: #e8f5e9;"><td style="border: 1px solid #ddd; padding: 8px; font-weight: bold;">Tasa de Empleabilidad</td><td style="border: 1px solid #ddd; padding: 8px; text-align: right; font-weight: bold; color: #1b5e20; font-size: 14px;">${rate}</td></tr>
                </table>
            </div>
            <div style="margin-top: 40px; padding-top: 10px; border-top: 1px solid #ccc; font-size: 10px; color: #777; text-align: center;">
                Sistema de Gestión de Egresados (SIGE) • SENA Empresa ERP • CEFA La Angostura
            </div>
        `;

        const opt = {
            margin:       10,
            filename:     title.replace(/[^a-zA-Z0-9_-]/g, '_') + '.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(container).save();
    }

    // Inicializar seleccionando el primer reporte disponible al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.report-row');
        if (firstRow) {
            firstRow.click();
        }
    });
</script>

</body>
</html>
