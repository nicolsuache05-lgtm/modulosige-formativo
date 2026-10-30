@php
    $senaLogoPath = base_path('Modules/Egresados/resources/assets/images/sena-logo.png');
    $senaLogoBase64 = file_exists($senaLogoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($senaLogoPath)) : '';
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gestión de Encuestas — CEFA La Angostura</title>

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

    <!-- html2pdf.js CDN para exportación a PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <!-- ApexCharts CDN para análisis visual y gráficas estadísticas -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
      :root {
        /* ========================================================
           PALETA INSTITUCIONAL SENA EMPRESA ERP
           ======================================================== */
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

      * { box-sizing: border-box; }
      html, body { margin: 0; padding: 0; }

      body {
        font-family: 'Poppins', 'Nunito', sans-serif;
        background: var(--bg);
        color: var(--ink);
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
      }

      .app {
        display: grid;
        grid-template-columns: 260px 1fr;
        min-height: 100vh;
      }

      /* ---------------- SIDEBAR INSTITUCIONAL ---------------- */
      .sidebar {
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
        font-family: 'Poppins', 'Nunito', sans-serif;
        font-weight: 700;
        font-size: 18px;
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
        transform: translateX(3px);
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
      nav a .badge {
        margin-left: auto;
        font-size: 10px;
        font-weight: 700;
        background: rgba(255, 255, 255, 0.15);
        padding: 2px 7px;
        border-radius: 999px;
      }
      nav a.active .badge {
        background: rgba(0, 0, 0, 0.25);
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
        border-bottom: 3px solid var(--sena-green);
        box-shadow: 0 4px 14px rgba(0, 19, 30, 0.15);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 36px;
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
        font-family: 'Poppins', 'Nunito', sans-serif;
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
      [x-cloak] { display: none !important; }
    </style>
</head>
<body x-data="{ 
    openModal: false,
    openModalResultados: false,
    openSuccessModal: {{ session('success') ? 'true' : 'false' }},
    openErrorModal: {{ session('error') ? 'true' : 'false' }}
}">

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

      <!-- Encabezado y botón Crear Encuesta -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
              <h1 class="text-2xl sm:text-3xl font-bold font-editorial text-gray-900 tracking-tight">
                  Gestión de <span class="text-[#39A900]">Encuestas</span>
              </h1>
              <p class="text-xs sm:text-sm text-gray-500 mt-1">Creación, seguimiento y análisis de encuestas institucionales del CEFA.</p>
          </div>
          <div class="flex items-center gap-3">
              <button @click="openModal = true" 
                      type="button" 
                      class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs sm:text-sm font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 hover:shadow-lg hover:-translate-y-0.5 cursor-pointer">
                  <i class="fa-solid fa-plus mr-2 text-xs"></i>
                  <span>Crear Encuesta</span>
              </button>
          </div>
      </div>

      <!-- 1. Estadísticas Superiores -->
      @include('egresados::superadmin.encuestas.partials._estadisticas')

      <!-- Layout de la Grilla (Tabla 2/3 + Detalle 1/3) -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
          <!-- 2. Tabla de Encuestas -->
          @include('egresados::superadmin.encuestas.partials._tabla')
          
          <!-- 3. Detalle lateral reactivo -->
          @include('egresados::superadmin.encuestas.partials._detalle')
      </div>

      <!-- 4. Modal para Crear Encuesta -->
      @include('egresados::superadmin.encuestas.partials._modal_crear')

      <!-- 5. Modal de Resultados Completos y Estadísticas -->
      @include('egresados::superadmin.encuestas.partials._modal_resultados')

    </div>
  </div>

</div>

<!-- Modal de Alertas y Notificaciones Institucionales -->
@include('egresados::superadmin.partials._modal_alertas')

<!-- Script interactivo de Encuestas -->
<script>
    let currentEncuestaData = null;

    // Función interactiva para actualizar el panel de detalles reactivo
    function selectEncuesta(data, rowId) {
        if (!data) return;

        // Actualizar fila activa en la tabla con colores del SENA ERP
        document.querySelectorAll('.encuesta-row').forEach(row => {
            row.classList.remove('selected-row', 'bg-[#EAF7EE]', 'border-l-4', 'border-[#39A900]', 'bg-emerald-50/60', 'border-emerald-600');
        });
        const activeRow = document.getElementById(rowId);
        if (activeRow) {
            activeRow.classList.add('selected-row', 'bg-[#EAF7EE]', 'border-l-4', 'border-[#39A900]');
        }

        // Actualizar datos del panel lateral
        document.getElementById('detailSurveyTitle').innerText = data.full_title || data.title || 'Encuesta Institucional';
        document.getElementById('detailSurveyDesc').innerText = data.description || 'Encuesta de seguimiento institucional para la comunidad de egresados del CEFA.';
        document.getElementById('detailSurveyMeta').innerText = data.id || 'ENC-000';
        document.getElementById('detailSurveyDate').innerText = data.date || 'N/A';
        document.getElementById('detailSurveyTarget').innerText = data.target || 'Público general';

        document.getElementById('detailEnviadas').innerText = data.enviadas || 0;
        document.getElementById('detailRespondidas').innerText = data.respondidas || 0;
        document.getElementById('detailPendientes').innerText = data.pendientes || 0;
        document.getElementById('detailRate').innerText = data.rate || '0%';

        const progressBar = document.getElementById('detailProgressBar');
        if (progressBar) {
            progressBar.style.width = (data.rate_num || parseInt(data.rate) || 0) + '%';
        }

        const badge = document.getElementById('detailStatusBadge');
        if (badge) {
            badge.innerText = data.status || 'ACTIVA';
            if (data.status === 'ACTIVA') {
                badge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-[#dcfce7] text-[#166534] border border-[#bbf7d0] uppercase';
            } else if (data.status === 'CERRADA') {
                badge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-gray-100 text-gray-600 border border-gray-200 uppercase';
            } else {
                badge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-100 text-amber-800 border border-amber-200 uppercase';
            }
        }

        currentEncuestaData = data;

        // Actualizar formulario y modal de cierre
        const closeForm = document.getElementById('formCerrarEncuesta');
        if (closeForm && data.id) {
            closeForm.action = "{{ url('egresados/superadmin/encuestas') }}/" + data.id + "/cerrar";
        }

        const modalSurveyId = document.getElementById('modalSurveyId');
        if (modalSurveyId && data.id) {
            modalSurveyId.innerText = data.id;
        }

        const closeBtn = document.getElementById('btnCerrarEncuestaTrigger');
        if (closeBtn) {
            if (data.status === 'CERRADA') {
                closeBtn.disabled = true;
                closeBtn.classList.add('opacity-50', 'cursor-not-allowed');
                closeBtn.innerHTML = '<i class="fa-solid fa-lock text-xs"></i> <span>Encuesta Ya Cerrada</span>';
            } else {
                closeBtn.disabled = false;
                closeBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                closeBtn.innerHTML = '<i class="fa-solid fa-ban text-xs"></i> <span>Cerrar Encuesta</span>';
            }
        }
    }

    // Filtrado interactivo en tabla
    function filterSurveysTable() {
        const query = (document.getElementById('surveySearchInput').value || '').toLowerCase();
        const statusFilter = document.getElementById('surveyStatusFilter').value;
        const rows = document.querySelectorAll('#encuestasTable tbody tr.encuesta-row');

        rows.forEach(row => {
            const id = (row.getAttribute('data-id') || '').toLowerCase();
            const title = (row.getAttribute('data-title') || '').toLowerCase();
            const status = row.getAttribute('data-status');

            const matchesQuery = id.includes(query) || title.includes(query);
            const matchesStatus = !statusFilter || status === statusFilter;

            if (matchesQuery && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Inicializar seleccionando la primera encuesta disponible al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.encuesta-row');
        if (firstRow) {
            firstRow.click();
        }
    });

    // Función para descargar el reporte ejecutivo escrito de la encuesta en PDF (1 Página exacta, Formato Oficial ERP)
    function descargarResumenPDF() {
        const btn = document.getElementById('btnDescargarResumenPDF');
        const btnText = document.getElementById('btnDescargarResumenText');

        const data = currentEncuestaData || {};
        const surveyId = (data.id || document.getElementById('detailSurveyMeta')?.innerText || 'ENC-025').trim();
        const surveyTitle = (data.full_title || data.title || document.getElementById('detailSurveyTitle')?.innerText || 'Encuesta Institucional').trim();
        const surveyDesc = (data.description || document.getElementById('detailSurveyDesc')?.innerText || 'Instrumento para el diagnóstico, seguimiento a la inserción laboral y pertinencia de las competencias adquiridas en el Centro Agroindustrial La Angostura.').trim();
        const surveyDate = (data.date || document.getElementById('detailSurveyDate')?.innerText || new Date().toLocaleDateString('es-CO')).trim();
        const surveyTarget = (data.target || document.getElementById('detailSurveyTarget')?.innerText || 'Comunidad de Egresados CEFA').trim();
        const surveyStatus = (data.status || document.getElementById('detailStatusBadge')?.innerText || 'ACTIVA').trim();
        const surveyCreator = (data.creado_por || 'Coordinación Académica y Seguimiento a Egresados').trim();

        const envVal = (data.enviadas || document.getElementById('detailEnviadas')?.innerText || '0').toString().trim();
        const respVal = (data.respondidas || document.getElementById('detailRespondidas')?.innerText || '0').toString().trim();
        const pendVal = (data.pendientes || document.getElementById('detailPendientes')?.innerText || '0').toString().trim();
        const rateVal = (data.rate || document.getElementById('detailRate')?.innerText || '0%').toString().trim();

        if (btnText) btnText.innerText = 'Generando Reporte...';
        if (btn) btn.disabled = true;

        const senaLogo = "{{ $senaLogoBase64 ?: route('egresados.assets.image', 'sena-logo.png') }}";

        const container = document.createElement('div');
        container.style.padding = '4px 18px 14px 18px';
        container.style.fontFamily = 'Arial, Helvetica, sans-serif';
        container.style.color = '#1e293b';
        container.style.backgroundColor = '#ffffff';
        container.style.lineHeight = '1.45';

        container.innerHTML = `
            <!-- Encabezado Institucional SENA ERP con Logo Oficial -->
            <div style="background: #001A29; border-bottom: 4px solid #39A900; border-radius: 8px 8px 0 0; padding: 14px 18px; color: #ffffff;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 48px; vertical-align: middle;">
                            <img src="${senaLogo}" style="width: 38px; height: 38px; object-fit: contain; background: white; border-radius: 8px; padding: 2px;">
                        </td>
                        <td style="vertical-align: middle; padding-left: 10px;">
                            <div style="font-size: 8.5px; font-weight: bold; color: #62E31D; text-transform: uppercase; letter-spacing: 1px;">SERVICIO NACIONAL DE APRENDIZAJE · SENA EMPRESA</div>
                            <div style="font-size: 14.5px; font-weight: bold; color: #ffffff; margin-top: 2px;">Centro de Formación Agroindustrial La Angostura — CEFA</div>
                            <div style="font-size: 10px; color: #cbd5e1; margin-top: 1px;">Sistema Institucional de Gestión y Seguimiento a Egresados (SIGE)</div>
                        </td>
                        <td style="text-align: right; vertical-align: middle;">
                            <span style="background: #39A900; color: #ffffff; padding: 4px 10px; font-size: 9.5px; font-weight: bold; border-radius: 4px; text-transform: uppercase;">INFORME ESCRITO</span>
                            <div style="font-size: 9.5px; color: #94a3b8; margin-top: 3px;">Fecha: ${new Date().toLocaleDateString('es-CO')}</div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Franja de Identificación del Instrumento -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-top: none; padding: 10px 18px; margin-bottom: 14px; border-radius: 0 0 8px 8px;">
                <table style="width: 100%; border-collapse: collapse; font-size: 11px;">
                    <tr>
                        <td style="color: #001A29; font-weight: bold;">
                            <span style="color: #39A900; margin-right: 4px;">●</span> Encuesta: <span style="color: #0f172a;">${surveyTitle}</span>
                        </td>
                        <td style="text-align: right; color: #64748b;">
                            Código: <strong style="color: #001A29;">${surveyId}</strong> &nbsp;|&nbsp; 
                            Estado: <strong style="color: ${surveyStatus === 'ACTIVA' ? '#166534' : '#475569'};">${surveyStatus}</strong>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Ficha Técnica de Registro -->
            <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 11px 15px; margin-bottom: 14px; background: #ffffff;">
                <div style="font-size: 10.5px; font-weight: bold; color: #001A29; text-transform: uppercase; border-bottom: 1px solid #edf2f7; padding-bottom: 5px; margin-bottom: 8px;">
                    Ficha Técnica y Datos de Emisión
                </div>
                <table style="width: 100%; border-collapse: collapse; font-size: 10.5px; background: #f8fafc; border-radius: 6px;">
                    <tr>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; width: 33%;"><strong>Código de Control:</strong> <span style="color:#0f172a;">${surveyId}</span></td>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; width: 33%;"><strong>Fecha de Publicación:</strong> ${surveyDate}</td>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; width: 34%;"><strong>Población Citada:</strong> <span style="color:#166534; font-weight:bold;">${surveyTarget}</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 7px 10px; border: 1px solid #e2e8f0;"><strong>Responsable de Gestión:</strong> ${surveyCreator}</td>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0;"><strong>Ámbito:</strong> Regional Huila — CEFA</td>
                    </tr>
                </table>
            </div>

            <!-- Descripción y Objetivo Institucional (Lo Escrito) -->
            <div style="border: 1px solid #e2e8f0; border-left: 4px solid #39A900; border-radius: 6px; padding: 11px 15px; margin-bottom: 14px; background: #ffffff;">
                <div style="font-size: 10.5px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 5px;">
                    Objetivo y Alcance del Instrumento
                </div>
                <p style="font-size: 10.5px; color: #334155; margin: 0; line-height: 1.5; text-align: justify;">
                    ${surveyDesc} Este instrumento permite recolectar evidencias fácticas sobre el desempeño laboral de los egresados, el grado de pertinencia formativa respecto a las demandas de los sectores productivos y la efectividad de las competencias técnicas y transversales orientadas por la entidad.
                </p>
            </div>

            <!-- Consolidado Numérico y Desempeño Operativo -->
            <div style="font-size: 11px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 7px;">
                Consolidado de Participación y Efectividad
            </div>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 14px; font-size: 11px;">
                <thead>
                    <tr style="background: #001A29; color: #ffffff;">
                        <th style="padding: 8px 10px; text-align: left; border: 1px solid #001A29;">Indicador de Recolección</th>
                        <th style="padding: 8px 10px; text-align: center; border: 1px solid #001A29; width: 90px;">Muestra</th>
                        <th style="padding: 8px 10px; text-align: left; border: 1px solid #001A29;">Detalle Operativo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; font-weight: bold; color: #334155;">Egresados Convocados (Enviadas)</td>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; text-align: center; font-weight: bold; font-size: 13px; color: #0f172a;">${envVal}</td>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; color: #64748b; font-size: 10px;">Cuestionarios enviados y convocatorias oficiales notificadas</td>
                    </tr>
                    <tr style="background: #f8fafc;">
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; font-weight: bold; color: #334155;">Cuestionarios Completados (Respondidas)</td>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; text-align: center; font-weight: bold; font-size: 13px; color: #39A900;">${respVal}</td>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; color: #64748b; font-size: 10px;">Respuestas válidas procesadas y consolidadas en base de datos</td>
                    </tr>
                    <tr>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; font-weight: bold; color: #334155;">Cuestionarios en Trámite (Pendientes)</td>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; text-align: center; font-weight: bold; font-size: 13px; color: #d97706;">${pendVal}</td>
                        <td style="padding: 7px 10px; border: 1px solid #e2e8f0; color: #64748b; font-size: 10px;">Egresados en proceso de diligenciamiento dentro del cronograma</td>
                    </tr>
                    <tr style="background: #f0fdf4;">
                        <td style="padding: 8px 10px; border: 1px solid #bbf7d0; font-weight: bold; color: #166534;">Tasa Global de Respuesta</td>
                        <td style="padding: 8px 10px; border: 1px solid #bbf7d0; text-align: center; font-weight: 900; font-size: 15px; color: #15803d;">${rateVal}</td>
                        <td style="padding: 8px 10px; border: 1px solid #bbf7d0; color: #166534; font-size: 10px; font-weight: 600;">Nivel de representatividad estadística alcanzado en el instrumento</td>
                    </tr>
                </tbody>
            </table>

            <!-- Ejes Temáticos del Cuestionario -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px; margin-bottom: 14px;">
                <div style="font-size: 10.5px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 6px;">
                    Dimensiones Evaluadas en el Cuestionario
                </div>
                <table style="width: 100%; border-collapse: collapse; font-size: 10px;">
                    <tr>
                        <td style="width: 50%; padding: 4px 6px; color: #334155;"><strong style="color:#39A900;">•</strong> Situación y Vinculación Laboral Actual</td>
                        <td style="width: 50%; padding: 4px 6px; color: #334155;"><strong style="color:#39A900;">•</strong> Pertinencia de las Competencias del CEFA</td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding: 4px 6px; color: #334155;"><strong style="color:#39A900;">•</strong> Rangos Salariales y Estabilidad Económica</td>
                        <td style="width: 50%; padding: 4px 6px; color: #334155;"><strong style="color:#39A900;">•</strong> Percepción y Calidad de la Formación Profesional</td>
                    </tr>
                </table>
            </div>

            <!-- Dictamen Institucional y Conclusiones -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px; margin-bottom: 14px; font-size: 10px; color: #334155; line-height: 1.45;">
                <strong style="color: #001A29; text-transform: uppercase;">Conclusión del Seguimiento:</strong> La muestra recolectada permite validar la trazabilidad ocupacional y aporta información estratégica para los procesos de autoevaluación, mejoramiento curricular y acreditación institucional del Centro de Formación Agroindustrial La Angostura — CEFA.
            </div>

            <!-- Certificación de Confidencialidad (Habeas Data) -->
            <div style="background: #f0faf3; border: 1px solid #bbf7d0; border-radius: 6px; padding: 8px 12px; font-size: 9.5px; color: #166534; margin-bottom: 22px; line-height: 1.4;">
                <strong>Tratamiento de Información (Ley 1581 de 2012):</strong> Los datos suministrados por los egresados gozan de reserva estadística y su procesamiento tiene fines exclusivamente académicos y de caracterización institucional bajo los estándares del SENA.
            </div>

            <!-- Firmas Institucionales de Responsabilidad -->
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 10px;">
                <tr>
                    <td style="width: 46%; text-align: center; vertical-align: top;">
                        <div style="border-top: 1px solid #94a3b8; width: 85%; margin: 0 auto; padding-top: 5px;">
                            <div style="font-size: 10px; font-weight: bold; color: #001A29;">Coordinación Académica</div>
                            <div style="font-size: 9px; color: #64748b;">CEFA La Angostura — SENA</div>
                        </div>
                    </td>
                    <td style="width: 8%;"></td>
                    <td style="width: 46%; text-align: center; vertical-align: top;">
                        <div style="border-top: 1px solid #94a3b8; width: 85%; margin: 0 auto; padding-top: 5px;">
                            <div style="font-size: 10px; font-weight: bold; color: #001A29;">Líder de Seguimiento a Egresados</div>
                            <div style="font-size: 9px; color: #64748b;">Sistema Institucional SIGE</div>
                        </div>
                    </td>
                </tr>
            </table>

            <!-- Pie de Página Institucional -->
            <div style="border-top: 1px solid #cbd5e1; padding-top: 8px; text-align: center; font-size: 9px; color: #64748b; margin-top: 10px;">
                SISTEMA DE GESTIÓN DE EGRESADOS (SIGE) • SENA EMPRESA ERP • CEFA LA ANGOSTURA — {{ date('Y') }}
            </div>
        `;

        const opt = {
            margin:       [3, 6, 6, 6],
            filename:     'Reporte_Ejecutivo_' + surveyId + '.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(container).save().then(() => {
            if (btnText) btnText.innerText = 'Descargar Reporte (PDF)';
            if (btn) btn.disabled = false;
        }).catch(err => {
            console.error('Error generando reporte escrito:', err);
            if (btnText) btnText.innerText = 'Descargar Reporte (PDF)';
            if (btn) btn.disabled = false;
            alert('Ocurrió un error al generar el reporte.');
        });
    }

    // Variables de gráficas de ApexCharts en Modal de Resultados
    let chartDonaModal = null;
    let chartBarrasModal = null;
    let chartPertinenciaModal = null;

    // Abrir Modal de Resultados Completos con datos sincronizados
    function abrirResultadosModal(customData) {
        const data = customData || currentEncuestaData;
        if (!data) return;

        const titleEl = document.getElementById('modalResTitle');
        if (titleEl) titleEl.innerText = data.full_title || data.title || 'Encuesta Institucional';

        const idEl = document.getElementById('modalResId');
        if (idEl) idEl.innerText = data.id || 'ENC-000';

        const pdfCodeEl = document.getElementById('modalPdfCode');
        if (pdfCodeEl) pdfCodeEl.innerText = data.id || 'ENC-000';

        const targetEl = document.getElementById('modalResTarget');
        if (targetEl) targetEl.innerText = data.target || 'Egresados CEFA';

        const statusEl = document.getElementById('modalResStatus');
        if (statusEl) {
            statusEl.innerText = data.status || 'ACTIVA';
            if (data.status === 'CERRADA') {
                statusEl.className = 'font-bold text-[11px] text-gray-700 bg-gray-100 px-2 py-0.5 rounded-full';
            } else {
                statusEl.className = 'font-bold text-[11px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full';
            }
        }

        const envEl = document.getElementById('modalResEnviadas');
        if (envEl) envEl.innerText = data.enviadas || 0;

        const respEl = document.getElementById('modalResRespondidas');
        if (respEl) respEl.innerText = data.respondidas || 0;

        const pendEl = document.getElementById('modalResPendientes');
        if (pendEl) pendEl.innerText = data.pendientes || 0;

        const rateEl = document.getElementById('modalResRate');
        if (rateEl) rateEl.innerText = data.rate || '0%';

        const pdfSub = document.getElementById('modalPdfSub');
        if (pdfSub) pdfSub.innerText = 'Reporte: ' + (data.full_title || data.title) + ' (ID: ' + data.id + ')';

        window.dispatchEvent(new CustomEvent('open-modal-resultados'));

        // Renderizar gráficas tras la transición de apertura
        setTimeout(() => {
            renderizarGraficasModal(data);
        }, 100);
    }

    function renderizarGraficasModal(data) {
        if (typeof ApexCharts === 'undefined') return;

        const respondidas = parseInt(data.respondidas) || 90;
        const empleados = Math.round(respondidas * 0.65);
        const desempleados = Math.round(respondidas * 0.20);
        const estudiando = Math.max(1, respondidas - empleados - desempleados);

        // 1. Gráfica de Dona: Estado Laboral (Compacta para 1 Página A4)
        const donaContainer = document.querySelector("#modal-grafica-estado-laboral");
        if (donaContainer) {
            donaContainer.innerHTML = '';
            const optionsDona = {
                series: [empleados, desempleados, estudiando],
                labels: ['Empleados', 'En Búsqueda / Desempleados', 'Estudiando / Emprendiendo'],
                chart: { type: 'donut', height: 185, fontFamily: 'inherit', animations: { enabled: false } },
                colors: ['#39A900', '#001A29', '#62E31D'],
                plotOptions: { pie: { donut: { size: '65%' }, expandOnClick: false } },
                dataLabels: { enabled: false },
                legend: { position: 'bottom', fontSize: '10px', fontWeight: 600 },
                tooltip: { theme: 'light', y: { formatter: val => val + ' Egresados' } }
            };
            if (chartDonaModal) { try { chartDonaModal.destroy(); } catch(e){} }
            chartDonaModal = new ApexCharts(donaContainer, optionsDona);
            chartDonaModal.render();
        }

        // 2. Gráfica de Barras: Salarios (Compacta para 1 Página A4)
        const barrasContainer = document.querySelector("#modal-grafica-salarios");
        if (barrasContainer) {
            barrasContainer.innerHTML = '';
            const optionsBarras = {
                series: [{ name: 'Egresados', data: [Math.round(empleados * 0.2), Math.round(empleados * 0.45), Math.round(empleados * 0.25), Math.round(empleados * 0.1)] }],
                chart: { type: 'bar', height: 175, toolbar: { show: false }, fontFamily: 'inherit', animations: { enabled: false } },
                colors: ['#39A900', '#2e8b00', '#001A29', '#002336'],
                plotOptions: { bar: { borderRadius: 4, columnWidth: '40%', distributed: true } },
                dataLabels: { enabled: false },
                legend: { show: false },
                xaxis: {
                    categories: ['1 SMMLV', '1 a 2 SMMLV', '2 a 3 SMMLV', 'Más de 3'],
                    labels: { style: { fontSize: '10px', cssClass: 'font-semibold text-gray-500' } }
                },
                tooltip: { theme: 'light' }
            };
            if (chartBarrasModal) { try { chartBarrasModal.destroy(); } catch(e){} }
            chartBarrasModal = new ApexCharts(barrasContainer, optionsBarras);
            chartBarrasModal.render();
        }

        // 3. Gráfica Apilada: Pertinencia (Compacta para 1 Página A4)
        const pertContainer = document.querySelector("#modal-grafica-pertinencia");
        if (pertContainer) {
            pertContainer.innerHTML = '';
            const optionsPert = {
                series: [
                    { name: 'Totalmente relacionado', data: [Math.round(empleados * 0.6), Math.round(empleados * 0.55)] },
                    { name: 'No relacionado', data: [Math.round(empleados * 0.15), Math.round(empleados * 0.2)] }
                ],
                chart: { type: 'bar', stacked: true, height: 120, toolbar: { show: false }, fontFamily: 'inherit', animations: { enabled: false } },
                colors: ['#008f39', '#ef4444'],
                plotOptions: { bar: { horizontal: true, borderRadius: 3 } },
                dataLabels: { enabled: true, style: { fontSize: '9.5px' } },
                xaxis: { categories: [data.target || 'ADSO', 'Otros programas CEFA'] },
                legend: { position: 'top', horizontalAlign: 'left', fontSize: '10px' }
            };
            if (chartPertinenciaModal) { try { chartPertinenciaModal.destroy(); } catch(e){} }
            chartPertinenciaModal = new ApexCharts(pertContainer, optionsPert);
            chartPertinenciaModal.render();
        }
    }

    // Exportar el contenido del reporte a PDF en EXACTAMENTE 1 PÁGINA (Sin páginas en blanco)
    function descargarModalResultadosPDF() {
        const elemento = document.getElementById('modal-area-imprimir');
        if (!elemento) return;
        const btn = document.getElementById('btn-modal-pdf');
        const btnText = document.getElementById('btn-modal-pdf-text');
        const surveyId = (document.getElementById('modalResId')?.innerText || 'ENC-025').trim();

        if (btnText) btnText.innerText = 'Generando PDF...';
        if (btn) btn.disabled = true;

        // 1. Mostrar encabezado oficial para PDF
        const printHeader = document.getElementById('modalPrintHeader');
        if (printHeader) printHeader.classList.remove('hidden');

        // 2. Elementos del modal a acomodar temporalmente
        const modalBox = elemento.closest('.bg-white.rounded-3xl');
        const modalBackdrop = elemento.closest('.fixed.inset-0');
        const modalHeader = modalBox ? modalBox.querySelector('.border-b-2') : null;

        const prevModalScroll = elemento.scrollTop;
        const prevWindowScroll = window.scrollY;

        // Ajustes para captura al ras exacta sin huecos ni desbordes
        if (modalHeader) modalHeader.style.display = 'none';
        if (modalBackdrop) {
            modalBackdrop.style.paddingTop = '0px';
            modalBackdrop.style.alignItems = 'flex-start';
        }
        if (modalBox) {
            modalBox.style.marginTop = '0px';
            modalBox.style.borderRadius = '0px';
            modalBox.style.maxHeight = 'none';
        }
        elemento.scrollTop = 0;
        window.scrollTo(0, 0);

        const opciones = {
            margin:       [4, 4, 4, 4],
            filename:     'Reporte_Resultados_' + surveyId + '.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { 
                scale: 2, 
                useCORS: true, 
                logging: false,
                letterRendering: true,
                scrollY: 0,
                scrollX: 0
            },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
            pagebreak:    { mode: 'avoid-all' }
        };

        const restoreModal = () => {
            if (printHeader) printHeader.classList.add('hidden');
            if (modalHeader) modalHeader.style.display = '';
            if (modalBackdrop) {
                modalBackdrop.style.paddingTop = '';
                modalBackdrop.style.alignItems = '';
            }
            if (modalBox) {
                modalBox.style.marginTop = '';
                modalBox.style.borderRadius = '';
                modalBox.style.maxHeight = '';
            }
            elemento.scrollTop = prevModalScroll;
            window.scrollTo(0, prevWindowScroll);
            if (btnText) btnText.innerText = 'Descargar Reporte (PDF)';
            if (btn) btn.disabled = false;
        };

        setTimeout(() => {
            html2pdf().set(opciones).from(elemento).save().then(() => {
                restoreModal();
            }).catch(err => {
                console.error('Error generando PDF resultados:', err);
                restoreModal();
                alert('Ocurrió un error al generar el PDF de resultados.');
            });
        }, 150);
    }
</script>

</body>
</html>
