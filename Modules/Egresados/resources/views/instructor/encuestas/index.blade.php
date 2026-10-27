<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Mis Encuestas — Instructor CEFA</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS & Alpine.js CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
      }
      body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
        color: var(--ink);
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
      }
      .font-editorial { font-family: 'Fraunces', serif; }
      [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F4F7F6] text-gray-900 min-h-screen">

<div class="grid grid-cols-1 lg:grid-cols-[250px_1fr] min-h-screen" x-data="{ openModal: false }">

    <!-- ============================================== -->
    <!-- 1. SIDEBAR INSTRUCTOR -->
    <!-- ============================================== -->
    <aside class="bg-gradient-to-b from-[#001A29] to-[#00131E] text-white flex flex-col justify-between p-5 border-r border-white/10 sticky top-0 h-screen z-30">
        <div>
            <!-- Brand -->
            <a href="{{ route('egresados.welcome') }}" class="flex items-center gap-3 pb-5 border-b border-white/15 no-underline text-white group">
                <div class="w-10 h-10 rounded-full bg-white p-1 flex items-center justify-center shadow-md shrink-0 border-2 border-[#62E31D]">
                    <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="SENA" class="w-full h-full object-cover rounded-full">
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-editorial text-xl font-bold tracking-wide leading-none">SIGE</span>
                        <span class="bg-blue-600 text-white text-[9px] font-extrabold px-1.5 py-0.5 rounded-full uppercase">Instructor</span>
                    </div>
                    <div class="text-[10px] text-green-200/80 font-medium">CEFA La Angostura</div>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="mt-6 space-y-1.5">
                <a href="{{ route('egresados.instructor.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition">
                    <i class="fa-solid fa-chalkboard-user w-4 text-center"></i>
                    <span>Panel de Seguimiento</span>
                </a>

                <a href="{{ route('egresados.instructor.directorio') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition">
                    <i class="fa-solid fa-address-book w-4 text-center"></i>
                    <span>Directorio Completo</span>
                </a>

                <a href="{{ route('egresados.instructor.encuestas.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-[#39A900] text-white font-semibold text-xs shadow-md">
                    <i class="fa-solid fa-clipboard-question w-4 text-center"></i>
                    <span>Mis Encuestas</span>
                </a>

                <a href="{{ route('egresados.welcome') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition">
                    <i class="fa-solid fa-globe w-4 text-center"></i>
                    <span>Portal Público SIGE</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Bottom User & Logout -->
        <div class="pt-4 border-t border-white/15">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-full bg-blue-600/60 text-white flex items-center justify-center font-bold text-xs border border-blue-400/40">
                    {{ Auth::check() ? Auth::user()->initials : 'IN' }}
                </div>
                <div class="overflow-hidden">
                    <div class="text-xs font-bold text-white truncate">{{ Auth::check() ? Auth::user()->full_name : 'Carlos Mendoza · Instructor' }}</div>
                    <div class="text-[10px] text-green-200/70 truncate">{{ Auth::check() ? Auth::user()->email : 'instructor@sena.edu.co' }}</div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-red-500/20 hover:bg-red-500/30 text-red-200 hover:text-white text-xs font-bold transition cursor-pointer">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ============================================== -->
    <!-- 2. MAIN VIEWPORT -->
    <!-- ============================================== -->
    <div class="flex flex-col min-w-0">
        
        <!-- Topbar -->
        <header class="bg-[#001A29] text-white px-6 py-3.5 flex items-center justify-between sticky top-0 z-20 shadow-sm border-b border-[#39A900]/30">
            <div class="flex items-center gap-3">
                <a href="{{ route('egresados.welcome') }}" class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-[#39A900] text-white text-xs font-semibold px-3 py-1.5 rounded-full border border-white/20 transition">
                    <i class="fa-solid fa-globe text-xs"></i>
                    <span>Ver Portal Público</span>
                </a>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2.5 px-3 py-1 bg-white/10 rounded-full border border-white/15 text-xs font-semibold">
                    <div class="w-6 h-6 rounded-full bg-[#39A900] text-white flex items-center justify-center text-[10px] font-bold">
                        {{ Auth::check() ? Auth::user()->initials : 'IN' }}
                    </div>
                    <span>{{ Auth::check() ? Auth::user()->full_name : 'Carlos Mendoza · Instructor' }}</span>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-6 space-y-6 flex-1 max-w-7xl w-full mx-auto">
            
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

            <!-- Encabezado -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold font-editorial text-[#00131E] tracking-tight">
                        Mis <span class="text-[#39A900]">Encuestas</span>
                    </h1>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">Crea, diseña y gestiona encuestas personalizadas para los egresados de tus fichas.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="openModal = true" class="inline-flex items-center justify-center px-4 py-2 bg-[#001A29] hover:bg-[#39A900] text-white text-xs font-bold rounded-xl transition shadow-xs cursor-pointer">
                        <i class="fa-solid fa-plus mr-2 text-xs"></i>
                        <span>Crear Encuesta</span>
                    </button>
                </div>
            </div>

            <!-- Métricas Superiores de Encuestas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-xs flex flex-col justify-between">
                    <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Total Creadas</span>
                    <div class="text-2xl font-bold font-editorial text-[#00131E] my-1">{{ $totalCreadas ?? 25 }}</div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-[#EAF7EE] text-[#2a7c00] w-fit">En sistema</span>
                </div>

                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-xs flex flex-col justify-between">
                    <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Enviadas</span>
                    <div class="text-2xl font-bold font-editorial text-[#00131E] my-1">{{ $totalEnviadas ?? 320 }}</div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 w-fit">A egresados</span>
                </div>

                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-xs flex flex-col justify-between">
                    <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Pendientes</span>
                    <div class="text-2xl font-bold font-editorial text-amber-700 my-1">{{ $totalPendientes ?? 78 }}</div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 w-fit">Por responder</span>
                </div>

                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-xs flex flex-col justify-between">
                    <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Respondidas</span>
                    <div class="text-2xl font-bold font-editorial text-[#00131E] my-1">{{ $totalRespondidas ?? 242 }}</div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-[#EAF7EE] text-[#2a7c00] w-fit">Completadas</span>
                </div>

                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-xs flex flex-col justify-between">
                    <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Tasa Respuesta</span>
                    <div class="text-2xl font-bold font-editorial text-[#39A900] my-1">{{ $tasaRespuestaGeneral ?? '75%' }}</div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-[#EAF7EE] text-[#2a7c00] w-fit">Promedio</span>
                </div>
            </div>

            <!-- Tabla de Encuestas -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
                
                <!-- Toolbar -->
                <div class="p-4 sm:p-5 border-b border-gray-100 bg-[#FAFCF9] flex flex-wrap items-center justify-between gap-3">
                    <div class="relative flex-1 min-w-[220px]">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                        <input type="text" 
                               id="instructorSurveySearch" 
                               onkeyup="filterInstructorSurveys()" 
                               placeholder="Buscar encuesta por ID, título o público..." 
                               class="w-full pl-9 pr-4 py-2 text-xs sm:text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition">
                    </div>

                    <select id="instructorSurveyStatusFilter" 
                            onchange="filterInstructorSurveys()" 
                            class="px-3.5 py-2 text-xs sm:text-sm font-semibold bg-white border border-gray-200 rounded-xl text-gray-700 outline-hidden focus:border-emerald-600 cursor-pointer">
                        <option value="">-- Todos los Estados --</option>
                        <option value="ACTIVA">Activas</option>
                        <option value="CERRADA">Cerradas</option>
                    </select>
                </div>

                <!-- Tabla -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse" id="instructorSurveysTable">
                        <thead>
                            <tr class="bg-[#F8FCF9] text-gray-500 text-[11px] font-bold uppercase tracking-wider border-b border-gray-100">
                                <th class="py-3.5 px-4 sm:px-5">ID</th>
                                <th class="py-3.5 px-4 sm:px-5">Nombre Encuesta</th>
                                <th class="py-3.5 px-4 sm:px-5">Estado</th>
                                <th class="py-3.5 px-4 sm:px-5">Dirigido a</th>
                                <th class="py-3.5 px-4 sm:px-5">Progreso</th>
                                <th class="py-3.5 px-4 sm:px-5 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($encuestas as $index => $item)
                                <tr class="hover:bg-emerald-50/40 transition instructor-survey-row"
                                    data-id="{{ $item['id'] }}"
                                    data-title="{{ $item['title'] }}"
                                    data-status="{{ $item['status'] }}"
                                    data-target="{{ $item['target'] }}">
                                    
                                    <td class="py-3.5 px-4 sm:px-5 font-bold text-[#00131E] whitespace-nowrap">
                                        {{ $item['id'] }}
                                    </td>

                                    <td class="py-3.5 px-4 sm:px-5">
                                        <div class="font-bold text-gray-900 leading-snug">{{ $item['title'] }}</div>
                                        <div class="flex items-center gap-1.5 mt-1">
                                            <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            <p class="text-[11px] text-gray-500">
                                                Creado por: <span class="font-semibold text-blue-600">{{ $item['creado_por'] ?? 'Carlos Mendoza (Instructor)' }}</span>
                                            </p>
                                        </div>
                                        <div class="text-[10.5px] text-gray-400 mt-0.5">Creada: {{ $item['date'] }}</div>
                                    </td>

                                    <td class="py-3.5 px-4 sm:px-5 whitespace-nowrap">
                                        @if($item['status'] === 'ACTIVA')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                ACTIVA
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                                CERRADA
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-3.5 px-4 sm:px-5 text-gray-600 font-medium whitespace-nowrap">
                                        {{ $item['target'] }}
                                    </td>

                                    <td class="py-3.5 px-4 sm:px-5 whitespace-nowrap min-w-[130px]">
                                        <div class="space-y-1">
                                            <div class="flex justify-between text-[11px] font-bold text-gray-700">
                                                <span>{{ $item['respondidas'] }}/{{ $item['enviadas'] }}</span>
                                                <span class="text-emerald-700 font-extrabold">{{ $item['rate'] }}</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                                <div class="bg-gradient-to-r from-emerald-600 to-emerald-400 h-1.5 rounded-full transition-all duration-500" 
                                                     style="width: {{ $item['rate_num'] }}%;"></div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-3.5 px-4 sm:px-5 text-center whitespace-nowrap">
                                        <div class="inline-flex items-center gap-1.5">
                                            <a href="{{ route('egresados.superadmin.encuestas.resultados', ['id' => $item['id']]) }}" 
                                               class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:text-emerald-700 hover:bg-emerald-50 border border-gray-200 hover:border-emerald-300 transition shadow-2xs" 
                                               title="Ver Resultados">
                                                <i class="fa-solid fa-chart-pie text-xs"></i>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-10 px-4 text-gray-500">
                                        <i class="fa-regular fa-folder-open text-3xl text-gray-300 mb-2 block"></i>
                                        <span class="font-bold text-gray-700 block">No se encontraron encuestas registradas</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </main>

    </div>

    <!-- Modal Constructor para el Instructor -->
    @include('egresados::instructor.encuestas.partials._modal_crear')

</div>

<script>
    function filterInstructorSurveys() {
        const query = (document.getElementById('instructorSurveySearch')?.value || '').toLowerCase();
        const statusFilter = document.getElementById('instructorSurveyStatusFilter')?.value || '';
        const rows = document.querySelectorAll('#instructorSurveysTable tbody tr.instructor-survey-row');

        rows.forEach(row => {
            const id = (row.getAttribute('data-id') || '').toLowerCase();
            const title = (row.getAttribute('data-title') || '').toLowerCase();
            const target = (row.getAttribute('data-target') || '').toLowerCase();
            const status = row.getAttribute('data-status') || '';

            const matchesQuery = !query || id.includes(query) || title.includes(query) || target.includes(query);
            const matchesStatus = !statusFilter || status === statusFilter;

            if (matchesQuery && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

</body>
</html>
