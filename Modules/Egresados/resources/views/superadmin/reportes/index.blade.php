@php
    $senaLogoPath = base_path('Modules/Egresados/resources/assets/images/sena-logo.png');
    $senaLogoBase64 = file_exists($senaLogoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($senaLogoPath)) : '';
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <title>SIGE · Gestión de Reportes — CEFA La Angostura</title>

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

    <!-- Chart.js CDN para Gráficas e Indicadores Interactivos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        padding: 32px 36px 48px;
        flex: 1;
      }

      @media (max-width: 768px) {
        .app { grid-template-columns: 1fr; }
        .sidebar { display: none; }
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
    openGraficasModal: false,
    openSuccessModal: {{ session('success') ? 'true' : 'false' }},
    openErrorModal: {{ session('error') ? 'true' : 'false' }}
}" @abrir-modal-graficas.window="openGraficasModal = true">

<div class="app">

  <!-- ============================================== -->
  <!-- 1. SIDEBAR INSTITUCIONAL SUPERADMIN -->
  <!-- ============================================== -->
  <aside class="sidebar">
    <a href="{{ route('egresados.dashboard') }}" class="brand">
      @include('egresados::partials._sidebar_brand_logo')
      <div>
        <div class="brand-name">
          <span>SIGE</span>
        </div>
        <div class="brand-sub">GESTIÓN DE EGRESADOS</div>
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
      <a href="{{ route('egresados.noticias') }}">
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
                      class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs sm:text-sm font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 hover:shadow-lg hover:-translate-y-0.5 cursor-pointer">
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

      <!-- 5. Modal Interactivo de Análisis Gráfico e Indicadores -->
      @include('egresados::superadmin.reportes.partials._modal_graficas')
    </div>

  </div>

</div>

<!-- Modal de Alertas y Notificaciones Institucionales -->
@include('egresados::superadmin.partials._modal_alertas')

<!-- Scripts interactivos de Reportes -->
<script>
    // Variable global con los datos del reporte seleccionado actualmente
    let currentReportData = null;
    let currentReporteData = null;

    // Función interactiva para actualizar el panel de detalles reactivo
    function selectReporte(data, rowId) {
        if (!data) return;
        currentReportData = data;
        currentReporteData = data;

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
            btnExcel.href = baseUrl + "/exportar/excel?title=" + encodeURIComponent(fullTitle) + "&program=" + encodeURIComponent(data.program || '');
        }

        const formEnvio = document.getElementById('formEnviarCorreo');
        if (formEnvio) {
            formEnvio.action = baseUrl + "/enviar";
        }

        const btnGraficas = document.getElementById('btnActionGraficas');
        if (btnGraficas && btnGraficas.tagName === 'A') {
            btnGraficas.href = baseUrl + "/graficas";
        }

        const formEliminar = document.getElementById('formEliminarReporte');
        if (formEliminar) {
            formEliminar.action = baseUrl;
        }

        const deleteTitle = document.getElementById('modalEliminarTitulo');
        if (deleteTitle) deleteTitle.innerText = fullTitle;
        const deleteId = document.getElementById('modalEliminarId');
        if (deleteId) deleteId.innerText = currentId;
    }

    // Compatibilidad: abrir modal de gráficas
    function abrirGraficasReporteModal(customData) {
        abrirModalGraficas(customData);
    }

    // Filtrado interactivo en tabla
    function applyFilters() {
        const progFilter = (document.getElementById('filterPrograma')?.value || '').toLowerCase();
        const tipoFilter = (document.getElementById('filterTipo')?.value || '').toLowerCase();
        const formatFilter = (document.getElementById('filterFormato')?.value || '').toLowerCase();
        const textFilter = (document.getElementById('filterText')?.value || '').toLowerCase();

        const rows = document.querySelectorAll('#reportesTable tbody tr.report-row');
        let firstVisible = null;

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
                if (!firstVisible) firstVisible = row;
            } else {
                row.style.display = 'none';
            }
        });

        // Actualizar automáticamente el panel lateral seleccionando el primer reporte visible
        if (firstVisible) {
            firstVisible.click();
        }
    }

    // Exportación y descarga directa del Reporte en PDF (1 Página exacta, Formato Oficial ERP SENA)
    function descargarReportePDF(customData) {
        const data = customData || currentReportData || {};
        const reportId = (data.id || document.getElementById('detailReportMeta')?.innerText?.match(/REP[_\-0-9]+/)?.[0] || 'REP_002').trim();
        const reportTitle = (data.full_title || data.title || document.getElementById('detailReportTitle')?.innerText || 'Reporte Institucional de Egresados').trim();
        const program = (data.program || document.getElementById('detailReportProgram')?.innerText || 'ADSO').trim();
        const resp = (data.generated_by || document.getElementById('detailReportResp')?.innerText || 'Coordinación Académica').trim();
        const dateStr = (data.date || new Date().toLocaleDateString('es-CO')).trim();
        const status = (data.status || 'GENERADO').trim();

        const totalVal = (data.total_egresados || document.getElementById('detailTotalEgresados')?.innerText || '0').toString().trim();
        const empVal = (data.empleados || document.getElementById('detailEmpleados')?.innerText || '0').toString().trim();
        const desVal = (data.desempleados || document.getElementById('detailDesempleados')?.innerText || '0').toString().trim();
        const rateVal = (data.rate || document.getElementById('detailRate')?.innerText || '0%').toString().trim();

        const filtroFicha = (data.filters?.ficha || document.getElementById('detailFiltroFicha')?.innerText || 'Todas').trim();
        const filtroRegion = (data.filters?.region || document.getElementById('detailFiltroRegion')?.innerText || 'Regional Huila — CEFA').trim();
        const filtroPeriodo = (data.filters?.periodo || document.getElementById('detailFiltroPeriodo')?.innerText || 'Histórico Completo').trim();

        const btn = document.getElementById('btnActionPdf');
        const btnText = document.getElementById('btnPdfText');
        if (btnText) btnText.innerText = 'Generando PDF...';
        if (btn) btn.disabled = true;

        const senaLogo = "{{ $senaLogoBase64 ?: route('egresados.assets.image', 'sena-logo.png') }}";

        const numTotal = Math.max(1, parseInt(totalVal) || 1);
        const numEmp = parseInt(empVal) || 0;
        const numDes = Math.max(0, parseInt(desVal) || (numTotal - numEmp));
        const numRate = parseInt(rateVal) || (numTotal > 0 ? Math.round((numEmp / numTotal) * 100) : 100);

        // Generador garantizado de Gráfica Donut en Canvas 2D (100% libre de fallos o dependencias)
        function makeDonutPng(emp, des) {
            try {
                const cv = document.createElement('canvas');
                cv.width = 360; cv.height = 180;
                const ctx = cv.getContext('2d');
                ctx.fillStyle = '#ffffff'; ctx.fillRect(0, 0, 360, 180);
                const tot = Math.max(1, emp + des);
                const pct = Math.round((emp / tot) * 100);
                const ang = (emp / tot) * 2 * Math.PI;
                // Anillo ámbar
                ctx.beginPath(); ctx.arc(95, 90, 68, 0, 2 * Math.PI); ctx.fillStyle = '#F59E0B'; ctx.fill();
                // Segmento verde
                ctx.beginPath(); ctx.moveTo(95, 90); ctx.arc(95, 90, 68, -0.5 * Math.PI, -0.5 * Math.PI + ang); ctx.fillStyle = '#39A900'; ctx.fill();
                // Hueco central
                ctx.beginPath(); ctx.arc(95, 90, 42, 0, 2 * Math.PI); ctx.fillStyle = '#ffffff'; ctx.fill();
                ctx.fillStyle = '#001A29'; ctx.font = 'bold 20px Arial'; ctx.textAlign = 'center'; ctx.textBaseline = 'middle';
                ctx.fillText(pct + '%', 95, 90);
                // Leyendas
                ctx.fillStyle = '#39A900'; ctx.fillRect(195, 62, 14, 14);
                ctx.fillStyle = '#1e293b'; ctx.font = 'bold 12px Arial'; ctx.textAlign = 'left';
                ctx.fillText('Vinculados: ' + emp + ' (' + pct + '%)', 218, 74);
                ctx.fillStyle = '#F59E0B'; ctx.fillRect(195, 102, 14, 14);
                ctx.fillStyle = '#1e293b';
                ctx.fillText('En Búsqueda: ' + des + ' (' + (100 - pct) + '%)', 218, 114);
                return cv.toDataURL('image/png');
            } catch(e) { return ''; }
        }

        // Generador garantizado de Gráfica de Barras en Canvas 2D
        function makeBarPng(rate) {
            try {
                const cv = document.createElement('canvas');
                cv.width = 360; cv.height = 180;
                const ctx = cv.getContext('2d');
                ctx.fillStyle = '#ffffff'; ctx.fillRect(0, 0, 360, 180);
                ctx.strokeStyle = '#cbd5e1'; ctx.lineWidth = 1.5;
                ctx.beginPath(); ctx.moveTo(35, 145); ctx.lineTo(330, 145); ctx.stroke();
                const r = Math.min(100, Math.max(0, rate));
                const h1 = Math.round((r / 100) * 100);
                const h2 = Math.round((85 / 100) * 100);
                // Barra 1: Lograda
                ctx.fillStyle = '#39A900'; ctx.fillRect(75, 145 - h1, 65, h1);
                ctx.fillStyle = '#166534'; ctx.font = 'bold 14px Arial'; ctx.textAlign = 'center';
                ctx.fillText(r + '%', 107, Math.max(22, 138 - h1));
                ctx.fillStyle = '#334155'; ctx.font = 'bold 11px Arial'; ctx.fillText('Lograda', 107, 162);
                // Barra 2: Meta CEFA
                ctx.fillStyle = '#002336'; ctx.fillRect(205, 145 - h2, 65, h2);
                ctx.fillStyle = '#002336'; ctx.font = 'bold 14px Arial';
                ctx.fillText('85%', 237, 138 - h2);
                ctx.fillStyle = '#334155'; ctx.font = 'bold 11px Arial'; ctx.fillText('Meta CEFA', 237, 162);
                return cv.toDataURL('image/png');
            } catch(e) { return ''; }
        }

        // Obtener imágenes PNG de alta resolución
        const chart1Img = makeDonutPng(numEmp, numDes);
        const chart2Img = makeBarPng(numRate);

        // Estructura DOM temporal aislada para captura PDF (1 página A4 ejecutiva)
        const container = document.createElement('div');
        container.style.padding = '4px 14px';
        container.style.fontFamily = "'Segoe UI', Arial, Helvetica, sans-serif";
        container.style.color = '#1e293b';
        container.style.backgroundColor = '#ffffff';
        container.style.lineHeight = '1.35';

        container.innerHTML = `
            <!-- Encabezado Institucional SENA ERP -->
            <div style="background: #001A29; border-bottom: 3.5px solid #39A900; border-radius: 6px 6px 0 0; padding: 10px 14px; color: #ffffff;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 42px; vertical-align: middle;">
                            <img src="${senaLogo}" style="width: 36px; height: 36px; object-fit: contain; background: white; border-radius: 6px; padding: 2px;">
                        </td>
                        <td style="vertical-align: middle; padding-left: 10px;">
                            <div style="font-size: 7.5px; font-weight: bold; color: #62E31D; text-transform: uppercase; letter-spacing: 0.8px;">SERVICIO NACIONAL DE APRENDIZAJE · SENA EMPRESA</div>
                            <div style="font-size: 13px; font-weight: bold; color: #ffffff; margin-top: 1px;">Centro de Formación Agroindustrial La Angostura — CEFA</div>
                            <div style="font-size: 9px; color: #cbd5e1;">Sistema Institucional de Gestión y Seguimiento a Egresados (SIGE ERP)</div>
                        </td>
                        <td style="text-align: right; vertical-align: middle;">
                            <span style="background: #39A900; color: #ffffff; padding: 3px 8px; font-size: 8.5px; font-weight: bold; border-radius: 4px; text-transform: uppercase;">INFORME OFICIAL</span>
                            <div style="font-size: 8.5px; color: #94a3b8; margin-top: 2px;">Emisión: ${dateStr}</div>
                            <div style="font-size: 8.5px; color: #62E31D; font-weight: bold;">Cód: ${reportId}</div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Franja de Identificación -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-top: none; padding: 7px 14px; margin-bottom: 8px; border-radius: 0 0 6px 6px;">
                <table style="width: 100%; border-collapse: collapse; font-size: 10px;">
                    <tr>
                        <td style="color: #001A29; font-weight: bold;">
                            <span style="color: #39A900; margin-right: 4px;">●</span> Reporte: <span style="color: #0f172a;">${reportTitle}</span>
                        </td>
                        <td style="text-align: right; color: #64748b;">
                            Programa: <strong style="color: #001A29;">${program}</strong> &nbsp;|&nbsp; 
                            Estado: <strong style="color: #166534;">${status}</strong>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Ficha Técnica -->
            <div style="border: 1px solid #e2e8f0; border-radius: 6px; padding: 7px 10px; margin-bottom: 8px; background: #ffffff;">
                <div style="font-size: 9.5px; font-weight: bold; color: #001A29; text-transform: uppercase; border-bottom: 1px solid #edf2f7; padding-bottom: 3px; margin-bottom: 5px;">
                    Ficha Técnica y Datos de Emisión
                </div>
                <table style="width: 100%; border-collapse: collapse; font-size: 9px; background: #f8fafc; border-radius: 4px;">
                    <tr>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; width: 33%;"><strong>Código:</strong> ${reportId}</td>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; width: 33%;"><strong>Fecha Corte:</strong> ${dateStr}</td>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; width: 34%;"><strong>Programa:</strong> ${program}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 4px 8px; border: 1px solid #e2e8f0;"><strong>Responsable:</strong> ${resp}</td>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0;"><strong>Ámbito:</strong> Regional Huila — CEFA</td>
                    </tr>
                </table>
            </div>

            <!-- Objetivo y Alcance -->
            <div style="border: 1px solid #e2e8f0; border-left: 3.5px solid #39A900; border-radius: 5px; padding: 6px 10px; margin-bottom: 8px; background: #ffffff;">
                <div style="font-size: 9px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 2px;">
                    Objetivo y Alcance del Reporte
                </div>
                <p style="font-size: 8.5px; color: #334155; margin: 0; line-height: 1.35; text-align: justify;">
                    Consolida la trazabilidad de inserción laboral y desempeño de egresados certificados en el CEFA, suministrando evidencia cuantitativa para acreditar pertinencia ante el sector productivo regional.
                </p>
            </div>

            <!-- Consolidado Numérico -->
            <div style="font-size: 9.5px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 4px;">
                Consolidado Numérico y Desempeño Ocupacional
            </div>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 8px; font-size: 9.5px;">
                <thead>
                    <tr style="background: #001A29; color: #ffffff;">
                        <th style="padding: 5px 8px; text-align: left; border: 1px solid #001A29;">Indicador de Empleabilidad</th>
                        <th style="padding: 5px 8px; text-align: center; border: 1px solid #001A29; width: 80px;">Muestra</th>
                        <th style="padding: 5px 8px; text-align: left; border: 1px solid #001A29;">Detalle Operativo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; font-weight: bold;">Total Egresados Evaluados</td>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; text-align: center; font-weight: bold; font-size: 11px; color: #001A29;">${totalVal}</td>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; color: #64748b; font-size: 8.5px;">Aprendices con estado de formación CERTIFICADO en el software</td>
                    </tr>
                    <tr style="background: #f8fafc;">
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; font-weight: bold;">Egresados Vinculados Laboralmente</td>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; text-align: center; font-weight: bold; font-size: 11px; color: #39A900;">${empVal}</td>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; color: #64748b; font-size: 8.5px;">En contrato laboral formal, independiente o unidades productivas</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; font-weight: bold;">En Búsqueda Activa de Oportunidad</td>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; text-align: center; font-weight: bold; font-size: 11px; color: #d97706;">${desVal}</td>
                        <td style="padding: 4px 8px; border: 1px solid #e2e8f0; color: #64748b; font-size: 8.5px;">En proceso de postulación a través de la APE SENA u otros canales</td>
                    </tr>
                    <tr style="background: #f0fdf4;">
                        <td style="padding: 4px 8px; border: 1px solid #bbf7d0; font-weight: bold; color: #166534;">Tasa de Empleabilidad Efectiva</td>
                        <td style="padding: 4px 8px; border: 1px solid #bbf7d0; text-align: center; font-weight: 900; font-size: 12px; color: #15803d;">${rateVal}</td>
                        <td style="padding: 4px 8px; border: 1px solid #bbf7d0; color: #166534; font-size: 8.5px; font-weight: bold;">Porcentaje de absorción y ubicación productiva en el mercado laboral</td>
                    </tr>
                </tbody>
            </table>

            <!-- Visualización Gráfica -->
            <div style="border: 1px solid #e2e8f0; border-radius: 6px; padding: 6px 10px; margin-bottom: 8px; background: #ffffff;">
                <div style="font-size: 9px; font-weight: bold; color: #001A29; text-transform: uppercase; border-bottom: 1px solid #edf2f7; padding-bottom: 3px; margin-bottom: 5px; display: flex; justify-content: space-between;">
                    <span>Visualización Gráfica del Reporte (SIGE ERP)</span>
                    <span style="color: #39A900; font-size: 8.5px; font-weight: bold;">CEFA · Regional Huila</span>
                </div>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 50%; padding: 2px 6px; vertical-align: top; text-align: center; border-right: 1px dashed #e2e8f0;">
                            <div style="font-size: 8.5px; font-weight: bold; color: #334155; margin-bottom: 3px;">
                                Situación Ocupacional (Distribución %)
                            </div>
                            <img src="${chart1Img}" style="max-width: 90%; max-height: 95px; object-fit: contain; margin: 0 auto; display: block;">
                        </td>
                        <td style="width: 50%; padding: 2px 6px; vertical-align: top; text-align: center;">
                            <div style="font-size: 8.5px; font-weight: bold; color: #334155; margin-bottom: 3px;">
                                Cumplimiento vs Meta CEFA (85%)
                            </div>
                            <img src="${chart2Img}" style="max-width: 90%; max-height: 95px; object-fit: contain; margin: 0 auto; display: block;">
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Filtros y Conclusión en 2 columnas -->
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 8px;">
                <tr>
                    <td style="width: 50%; vertical-align: top; padding-right: 4px;">
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 5px; padding: 5px 8px; font-size: 8px; color: #334155;">
                            <div style="font-size: 8.5px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 2px;">Filtros Aplicados</div>
                            <div>• Programa: <strong>${program}</strong></div>
                            <div>• Ficha: <strong>${filtroFicha}</strong></div>
                            <div>• Región: <strong>${filtroRegion}</strong></div>
                        </div>
                    </td>
                    <td style="width: 50%; vertical-align: top; padding-left: 4px;">
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 5px; padding: 5px 8px; font-size: 8px; color: #334155;">
                            <div style="font-size: 8.5px; font-weight: bold; color: #001A29; text-transform: uppercase; margin-bottom: 2px;">Conclusión Institucional</div>
                            <p style="margin: 0; line-height: 1.3;">La tasa de inserción laboral registrada valida el alto impacto del programa en el entorno productivo regional.</p>
                        </div>
                    </td>
                </tr>
            </table>

            <!-- Habeas Data -->
            <div style="background: #f0faf3; border: 1px solid #bbf7d0; border-radius: 4px; padding: 4px 8px; font-size: 8px; color: #166534; margin-bottom: 10px; line-height: 1.3;">
                <strong>Tratamiento de Información (Ley 1581 de 2012):</strong> Datos de reserva estadística para mejoramiento continuo y acreditación institucional del SENA.
            </div>

            <!-- Firmas -->
            <table style="width: 100%; border-collapse: collapse; margin-top: 8px; margin-bottom: 6px;">
                <tr>
                    <td style="width: 46%; text-align: center; vertical-align: top;">
                        <div style="border-top: 1px solid #94a3b8; width: 80%; margin: 0 auto; padding-top: 3px;">
                            <div style="font-size: 9px; font-weight: bold; color: #001A29;">Coordinación Académica</div>
                            <div style="font-size: 7.5px; color: #64748b;">CEFA La Angostura — SENA</div>
                        </div>
                    </td>
                    <td style="width: 8%;"></td>
                    <td style="width: 46%; text-align: center; vertical-align: top;">
                        <div style="border-top: 1px solid #94a3b8; width: 80%; margin: 0 auto; padding-top: 3px;">
                            <div style="font-size: 9px; font-weight: bold; color: #001A29;">Líder de Seguimiento a Egresados</div>
                            <div style="font-size: 7.5px; color: #64748b;">Sistema Institucional SIGE ERP</div>
                        </div>
                    </td>
                </tr>
            </table>

            <!-- Footer -->
            <div style="border-top: 1px solid #cbd5e1; padding-top: 4px; text-align: center; font-size: 7.5px; color: #64748b; margin-top: 4px;">
                SISTEMA DE GESTIÓN DE EGRESADOS (SIGE) • SENA EMPRESA CEFA • LA ANGOSTURA — {{ date('Y') }}
            </div>
        `;

        const prevScrollX = window.scrollX || window.pageXOffset || 0;
        const prevScrollY = window.scrollY || window.pageYOffset || 0;

        // Desplazar instantáneamente arriba para que la captura se inicie en el borde superior de la hoja
        document.documentElement.style.scrollBehavior = 'auto';
        document.body.style.scrollBehavior = 'auto';
        window.scrollTo(0, 0);

        const opt = {
            margin:       [4, 6, 4, 6],
            filename:     'Reporte_Institucional_' + reportId.replace(/[^a-zA-Z0-9_-]/g, '_') + '.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  {
                scale: 2,
                scrollY: 0,
                scrollX: 0
            },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        setTimeout(() => {
            html2pdf().set(opt).from(container).save().then(() => {
                window.scrollTo(prevScrollX, prevScrollY);
                if (btnText) btnText.innerText = 'Descargar PDF';
                if (btn) btn.disabled = false;
            }).catch(err => {
                window.scrollTo(prevScrollX, prevScrollY);
                console.error('Error generando reporte PDF:', err);
                if (btnText) btnText.innerText = 'Descargar PDF';
                if (btn) btn.disabled = false;
                alert('Ocurrió un error al generar el archivo PDF.');
            });
        }, 50);
    }

    // =========================================================================
    // MODAL INTERACTIVO DE ANÁLISIS GRÁFICO E INDICADORES (SENA ERP)
    // =========================================================================
    let modalChartDoughnutInstance = null;
    let modalChartBarInstance = null;

    function abrirModalGraficas(customData) {
        const data = customData || currentReportData;
        if (!data) return;

        if (customData && customData.id) {
            selectReporte(customData, 'rep-row-' + customData.id);
        }

        const fullTitle = data.full_title || data.title || 'Reporte Institucional';
        const reportId = data.id || 'REP_001';
        const program = data.program || (data.filters ? data.filters.programa : 'General');
        const ficha = (data.filters ? data.filters.ficha : 'Todas') || 'Todas';
        const resp = data.generated_by || 'Super Administrador';

        const totalEgresados = parseInt(data.total_egresados) || 0;
        const empleados = parseInt(data.empleados) || 0;
        const desempleados = parseInt(data.desempleados) || 0;
        const rateStr = data.rate || '100%';
        const rateNum = data.rate_num || parseInt(rateStr) || 100;

        // Actualizar textos y métricas en el modal
        const idElem = document.getElementById('modalGraficaId');
        if (idElem) idElem.innerText = reportId;

        const tituloElem = document.getElementById('modalGraficaTitulo');
        if (tituloElem) tituloElem.innerText = fullTitle;

        const progElem = document.getElementById('modalGraficaProg');
        if (progElem) progElem.innerText = program;

        const fichaElem = document.getElementById('modalGraficaFicha');
        if (fichaElem) fichaElem.innerText = ficha;

        const respElem = document.getElementById('modalGraficaResp');
        if (respElem) respElem.innerText = resp;

        const totalElem = document.getElementById('modalStatTotal');
        if (totalElem) totalElem.innerText = totalEgresados;

        const empElem = document.getElementById('modalStatEmpleados');
        if (empElem) empElem.innerText = empleados;

        const desElem = document.getElementById('modalStatDesempleados');
        if (desElem) desElem.innerText = desempleados;

        const rateElem = document.getElementById('modalStatRate');
        if (rateElem) rateElem.innerText = rateStr;

        const progressBar = document.getElementById('modalStatProgressBar');
        if (progressBar) progressBar.style.width = Math.min(100, Math.max(0, rateNum)) + '%';

        // Renderizar / actualizar Gráficos Chart.js
        setTimeout(() => {
            renderModalCharts(empleados, desempleados, totalEgresados, rateNum);
        }, 60);

        // Abrir el modal en Alpine
        window.dispatchEvent(new CustomEvent('abrir-modal-graficas'));
    }

    function renderModalCharts(empleados, desempleados, total, rate) {
        if (modalChartDoughnutInstance) {
            modalChartDoughnutInstance.destroy();
            modalChartDoughnutInstance = null;
        }
        if (modalChartBarInstance) {
            modalChartBarInstance.destroy();
            modalChartBarInstance = null;
        }

        const ctxDoughnut = document.getElementById('modalChartDoughnut');
        if (ctxDoughnut) {
            const dataValues = [empleados, Math.max(0, desempleados)];
            if (empleados === 0 && desempleados === 0) {
                dataValues[0] = 1;
            }

            modalChartDoughnutInstance = new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: ['Empleados / Vinculados', 'En Búsqueda / Otros'],
                    datasets: [{
                        data: dataValues,
                        backgroundColor: ['#39A900', '#F59E0B'],
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 11, family: 'Poppins' },
                                boxWidth: 12,
                                padding: 14
                            }
                        }
                    },
                    cutout: '68%'
                }
            });
        }

        const ctxBar = document.getElementById('modalChartBar');
        if (ctxBar) {
            modalChartBarInstance = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Tasa Lograda', 'Meta CEFA'],
                    datasets: [{
                        label: 'Porcentaje (%)',
                        data: [rate, 85],
                        backgroundColor: ['#39A900', '#002336'],
                        borderRadius: 8,
                        maxBarThickness: 45
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(val) { return val + '%'; },
                                font: { size: 10, family: 'Poppins' }
                            },
                            grid: { color: '#f1f5f9' }
                        },
                        x: {
                            ticks: { font: { size: 11, family: 'Poppins' } },
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
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
