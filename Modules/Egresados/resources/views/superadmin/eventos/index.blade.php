<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gestión de Eventos — CEFA La Angostura</title>

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
<body x-data="{ 
    openModal: false,
    openDetalleModal: false,
    openEditModal: false,
    openSuccessModal: {{ session('success') ? 'true' : 'false' }},
    openErrorModal: {{ session('error') ? 'true' : 'false' }}
}" @abrir-modal-detalle-evento.window="openDetalleModal = true" @abrir-modal-editar-evento.window="openDetalleModal = false; openEditModal = true">

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
      <a href="{{ route('egresados.superadmin.encuestas.index') }}">
        <i class="fa-solid fa-clipboard-question"></i>
        <span>Encuestas</span>
      </a>
      <a href="{{ route('egresados.reportes') }}">
        <i class="fa-solid fa-file-invoice"></i>
        <span>Reportes</span>
      </a>
      <a href="{{ route('egresados.eventos') }}" class="active">
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

    <!-- Main Content con Alpine.js -->
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

      <!-- Encabezado y botón Crear Evento -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
              <h1 class="text-2xl sm:text-3xl font-bold font-editorial text-gray-900 tracking-tight">
                  Gestión de <span class="text-[#39A900]">Eventos</span>
              </h1>
              <p class="text-xs sm:text-sm text-gray-500 mt-1">Gestión, seguimiento y control de eventos para egresados del CEFA.</p>
          </div>
          <div class="flex items-center gap-3">
              <button @click="openModal = true" 
                      type="button" 
                      class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs sm:text-sm font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 hover:shadow-lg hover:-translate-y-0.5 cursor-pointer">
                  <i class="fa-solid fa-plus mr-2 text-xs"></i>
                  <span>Crear Evento</span>
              </button>
          </div>
      </div>

      <!-- 1. Estadísticas Superiores -->
      @include('egresados::superadmin.eventos.partials._estadisticas')

      <!-- Layout de la Grilla (Tabla 2/3 + Detalle 1/3) -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
          <!-- 2. Filtros y Tabla de Eventos -->
          @include('egresados::superadmin.eventos.partials._tabla')
          
          <!-- 3. Detalle lateral reactivo -->
          @include('egresados::superadmin.eventos.partials._detalle')
      </div>

      <!-- 4. Modal para Crear Evento -->
      @include('egresados::superadmin.eventos.partials._modal_crear')

      <!-- 5. Modal para Ver Detalle Completo (Identidad SENA ERP) -->
      @include('egresados::superadmin.eventos.partials._modal_detalle')

      <!-- 6. Modal para Editar Evento Institucional (Identidad SENA ERP) -->
      @include('egresados::superadmin.eventos.partials._modal_editar')

    </div>

  </div>

</div>

<!-- Modal de Alertas y Notificaciones Institucionales (Ventanita de Éxito SENA ERP) -->
@include('egresados::superadmin.partials._modal_alertas')

<!-- Scripts interactivos de Eventos -->
<script>
    // Variable global con el evento activo seleccionado
    let currentEventoData = null;

    // Función interactiva para abrir el modal con el detalle completo del evento (SENA ERP)
    function abrirModalDetalleEvento(customData) {
        const data = customData || currentEventoData;
        if (!data) return;

        const idElem = document.getElementById('modalDetalleId');
        if (idElem) idElem.innerText = data.id || 'EVT-000';

        const statusElem = document.getElementById('modalDetalleStatus');
        if (statusElem) statusElem.innerText = data.status || 'PROGRAMADO';

        const tituloElem = document.getElementById('modalDetalleTitulo');
        if (tituloElem) tituloElem.innerText = data.title || 'Evento Institucional';

        const cupoElem = document.getElementById('modalDetalleCupo');
        if (cupoElem) cupoElem.innerText = data.cupo || 0;

        const regElem = document.getElementById('modalDetalleRegistrados');
        if (regElem) regElem.innerText = data.registrados || 0;

        const pendElem = document.getElementById('modalDetallePendientes');
        if (pendElem) pendElem.innerText = data.pendientes || 0;

        const rateElem = document.getElementById('modalDetalleRate');
        if (rateElem) rateElem.innerText = data.rate || '0%';

        const progBar = document.getElementById('modalDetalleProgressBar');
        if (progBar) progBar.style.width = (data.rate_num || parseInt(data.rate) || 0) + '%';

        const tipoElem = document.getElementById('modalDetalleTipo');
        if (tipoElem) tipoElem.innerText = data.type || 'Evento';

        const fechaElem = document.getElementById('modalDetalleFecha');
        if (fechaElem) fechaElem.innerText = (data.date || 'N/A') + ' | ' + (data.time || '08:00 AM - 05:00 PM');

        const lugarElem = document.getElementById('modalDetalleLugar');
        if (lugarElem) lugarElem.innerText = data.location || 'Centro de Formación CEFA';

        const respElem = document.getElementById('modalDetalleResp');
        if (respElem) respElem.innerText = data.responsible || 'Coordinación Académica';

        const progsElem = document.getElementById('modalDetalleProg');
        if (progsElem) progsElem.innerText = data.program || 'Todos los Programas';

        const descElem = document.getElementById('modalDetalleDesc');
        if (descElem) descElem.innerText = data.description || 'Sin descripción detallada.';

        const currentId = encodeURIComponent(data.id || 'EVT-012');
        const baseUrl = "{{ url('egresados/superadmin/eventos') }}/" + currentId;

        const btnEdit = document.getElementById('modalDetalleBtnEdit');
        if (btnEdit) btnEdit.href = baseUrl + "/editar";

        const btnExport = document.getElementById('modalDetalleBtnExport');
        if (btnExport) btnExport.href = baseUrl + "/exportar";

        window.dispatchEvent(new CustomEvent('abrir-modal-detalle-evento'));
    }

    // Función interactiva para abrir el modal con el formulario de edición (SENA ERP)
    function abrirModalEditarEvento(customData) {
        const data = customData || currentEventoData;
        if (!data) return;

        // Código en el badge
        const codElem = document.getElementById('modalEditCodigo');
        if (codElem) codElem.innerText = data.id || 'EVT-000';

        // URL del formulario de edición (PUT)
        const currentId = encodeURIComponent(data.id || 'EVT-012');
        const formEdit = document.getElementById('form-editar-evento');
        if (formEdit) {
            formEdit.action = "{{ url('egresados/superadmin/eventos') }}/" + currentId;
        }

        // Asignación de campos con los valores del evento
        const titleInput = document.getElementById('edit_title');
        if (titleInput) titleInput.value = data.title || '';

        const typeInput = document.getElementById('edit_type');
        if (typeInput) typeInput.value = data.type || '';

        const statusSelect = document.getElementById('edit_status');
        if (statusSelect) {
            statusSelect.value = (data.status || 'PROGRAMADO').toUpperCase();
        }

        const dateInput = document.getElementById('edit_date');
        if (dateInput) dateInput.value = data.date || '';

        const timeInput = document.getElementById('edit_time');
        if (timeInput) timeInput.value = data.time || '08:00 AM - 04:00 PM';

        const locInput = document.getElementById('edit_location');
        if (locInput) locInput.value = data.location || '';

        const cupoInput = document.getElementById('edit_cupo');
        if (cupoInput) cupoInput.value = data.cupo || 200;

        const progInput = document.getElementById('edit_program');
        if (progInput) progInput.value = data.program || 'Todos los Programas';

        const descInput = document.getElementById('edit_description');
        if (descInput) descInput.value = data.description || '';

        window.dispatchEvent(new CustomEvent('abrir-modal-editar-evento'));
    }

    // Función interactiva para actualizar el panel de detalles reactivo
    function selectEvento(data, rowId) {
        if (!data) return;
        currentEventoData = data;

        // Actualizar fila activa
        document.querySelectorAll('.event-row').forEach(row => {
            row.classList.remove('bg-emerald-50/50', 'font-medium');
        });
        const activeRow = document.getElementById(rowId);
        if (activeRow) {
            activeRow.classList.add('bg-emerald-50/50', 'font-medium');
        }

        // Actualizar datos del panel lateral
        document.getElementById('detailEventTitle').innerText = data.title || 'Evento Institucional';
        document.getElementById('detailEventMeta').innerText = 'ID: ' + (data.id || 'EVT-000') + ' | Tipo: ' + (data.type || 'Evento');
        document.getElementById('detailEventDateTime').innerText = (data.date || 'N/A') + ' | ' + (data.time || '08:00 AM - 05:00 PM');
        document.getElementById('detailEventLocation').innerText = data.location || 'Centro de Formación CEFA';
        document.getElementById('detailEventProgram').innerText = data.program || 'General';
        document.getElementById('detailEventResp').innerText = data.responsible || 'Coordinación Académica';
        document.getElementById('detailEventDesc').innerText = data.description || 'Sin descripción detallada.';

        document.getElementById('detailCupo').innerText = data.cupo || 0;
        document.getElementById('detailRegistrados').innerText = data.registrados || 0;
        document.getElementById('detailPendientes').innerText = data.pendientes || 0;
        document.getElementById('detailRate').innerText = data.rate || '0%';

        const progressBar = document.getElementById('detailProgressBar');
        if (progressBar) {
            progressBar.style.width = (data.rate_num || parseInt(data.rate) || 0) + '%';
        }

        const badge = document.getElementById('detailStatusBadge');
        if (badge) {
            badge.innerText = data.status || 'PROGRAMADO';
            const statusUpper = (data.status || 'PROGRAMADO').toUpperCase();
            if (statusUpper === 'REALIZADO') {
                badge.className = 'px-2.5 py-1 rounded-full text-[10.5px] font-extrabold bg-[#001A29] text-[#62E31D]';
            } else if (statusUpper === 'PROGRAMADO') {
                badge.className = 'px-2.5 py-1 rounded-full text-[10.5px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]';
            } else if (statusUpper === 'EN CURSO') {
                badge.className = 'px-2.5 py-1 rounded-full text-[10.5px] font-extrabold bg-emerald-100/70 text-emerald-900 border border-emerald-300';
            } else if (statusUpper === 'CANCELADO') {
                badge.className = 'px-2.5 py-1 rounded-full text-[10.5px] font-extrabold bg-red-50 text-red-700 border border-red-200';
            } else {
                badge.className = 'px-2.5 py-1 rounded-full text-[10.5px] font-extrabold bg-gray-50 text-gray-700 border border-gray-200';
            }
        }

        // Actualizar enlaces y formularios de acción rápida
        const currentId = encodeURIComponent(data.id || 'EVT-012');
        const baseUrl = "{{ url('egresados/superadmin/eventos') }}/" + currentId;

        const btnShow = document.getElementById('btnActionShow');
        if (btnShow) btnShow.href = baseUrl;

        const btnEdit = document.getElementById('btnActionEdit');
        if (btnEdit) btnEdit.href = baseUrl + "/editar";

        const btnExport = document.getElementById('btnActionExportar');
        if (btnExport) btnExport.href = baseUrl + "/exportar";

        const formInvitar = document.getElementById('formEnviarInvitacion');
        if (formInvitar) formInvitar.action = baseUrl + "/invitar";

        const formCancelar = document.getElementById('formCancelarEvento');
        if (formCancelar) formCancelar.action = baseUrl + "/cancelar";

        const modalProg = document.getElementById('modalInvitarProgramas');
        if (modalProg) modalProg.innerText = data.program || 'ADSO - GAE';

        const modalAsist = document.getElementById('modalCancelarAsistentes');
        if (modalAsist) modalAsist.innerText = data.registrados || 0;

        const modalCancelTitle = document.getElementById('modalCancelarTitulo');
        if (modalCancelTitle) modalCancelTitle.innerText = data.title || 'Evento Institucional';
    }

    // Filtrado interactivo en tabla
    function filterEventsTable() {
        const query = (document.getElementById('eventSearchInput')?.value || '').toLowerCase();
        const statusFilter = document.getElementById('eventStatusFilter')?.value || '';
        const typeFilter = (document.getElementById('eventTypeFilter')?.value || '').toLowerCase();
        const rows = document.querySelectorAll('#eventosTable tbody tr.event-row');

        rows.forEach(row => {
            const id = (row.getAttribute('data-id') || '').toLowerCase();
            const title = (row.getAttribute('data-title') || '').toLowerCase();
            const type = (row.getAttribute('data-type') || '').toLowerCase();
            const status = row.getAttribute('data-status') || '';

            const matchesQuery = !query || id.includes(query) || title.includes(query) || type.includes(query);
            const matchesStatus = !statusFilter || status === statusFilter;
            const matchesType = !typeFilter || type.includes(typeFilter);

            if (matchesQuery && matchesStatus && matchesType) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Inicializar seleccionando el primer evento disponible al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.event-row');
        if (firstRow) {
            firstRow.click();
        }
    });
</script>

</body>
</html>
