<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gestión de Encuestas — CEFA La Angostura</title>

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
      [x-cloak] { display: none !important; }
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

      @if($errors->any())
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
                      class="inline-flex items-center justify-center px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs sm:text-sm font-bold rounded-xl transition shadow-sm hover:shadow-md hover:-translate-y-0.5 cursor-pointer">
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

    </div>
  </div>

</div>

<!-- Script interactivo de Encuestas -->
<script>
    // Función interactiva para actualizar el panel de detalles reactivo
    function selectEncuesta(data, rowId) {
        if (!data) return;

        // Actualizar fila activa en la tabla
        document.querySelectorAll('.encuesta-row').forEach(row => {
            row.classList.remove('selected-row', 'bg-emerald-50/60', 'border-l-4', 'border-emerald-600');
        });
        const activeRow = document.getElementById(rowId);
        if (activeRow) {
            activeRow.classList.add('selected-row', 'bg-emerald-50/60', 'border-l-4', 'border-emerald-600');
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
                badge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200 uppercase';
            } else if (data.status === 'CERRADA') {
                badge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-gray-100 text-gray-600 border border-gray-200 uppercase';
            } else {
                badge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-100 text-amber-800 border border-amber-200 uppercase';
            }
        }

        const resultsBtn = document.getElementById('detailResultsBtn');
        if (resultsBtn && data.id) {
            resultsBtn.href = "{{ url('egresados/superadmin/encuestas') }}/" + data.id + "/resultados";
        }

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

    // Función para descargar el resumen ejecutivo del panel lateral en PDF
    function descargarResumenPDF() {
        const elemento = document.getElementById('panel-resumen-pdf');
        if (!elemento) return;

        const actionButtons = document.getElementById('detalleActionButtons');
        const printHeader = document.getElementById('detalle-print-header');
        const btn = document.getElementById('btnDescargarResumenPDF');
        const btnText = document.getElementById('btnDescargarResumenText');

        // Extraer datos de la encuesta para el nombre del archivo
        const surveyId = (document.getElementById('detailSurveyMeta')?.innerText || 'ENC-025').trim();

        // Ocultar botones de acción y mostrar encabezado para impresión
        if (actionButtons) actionButtons.style.display = 'none';
        if (printHeader) printHeader.classList.remove('hidden');

        // Estado visual del botón
        if (btnText) btnText.innerText = 'Generando PDF...';
        if (btn) btn.disabled = true;

        const opciones = {
            margin:       [8, 8, 8, 8],
            filename:     'Resumen_Encuesta_' + surveyId + '.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, useCORS: true, letterRendering: true },
            jsPDF:        { unit: 'mm', format: 'a5', orientation: 'portrait' }
        };

        html2pdf().set(opciones).from(elemento).save().then(() => {
            if (actionButtons) actionButtons.style.display = 'flex';
            if (printHeader) printHeader.classList.add('hidden');
            if (btnText) btnText.innerText = 'Descargar Reporte (PDF)';
            if (btn) btn.disabled = false;
        }).catch(err => {
            console.error('Error generando PDF:', err);
            if (actionButtons) actionButtons.style.display = 'flex';
            if (printHeader) printHeader.classList.add('hidden');
            if (btnText) btnText.innerText = 'Descargar Reporte (PDF)';
            if (btn) btn.disabled = false;
            alert('Hubo un inconveniente al generar el PDF del resumen.');
        });
    }
</script>

</body>
</html>
