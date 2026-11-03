<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gestión de Instructores — Panel Administrador</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts: Outfit + Plus Jakarta Sans + Fraunces -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: '#013819',
                        forestDeep: '#012410',
                        forestCard: '#094723',
                        senaGreen: '#39A900',
                        senaGreenDark: '#2a7c00',
                        senaNeon: '#62E31D',
                        senaLight: '#F4F7F5',
                        ink: '#142319',
                        inkSoft: '#5A6E61',
                    },
                    fontFamily: {
                        sans: ['Outfit', 'Plus Jakarta Sans', 'Inter', 'sans-serif'],
                        editorial: ['Fraunces', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.01em;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.04);
            border-radius: 999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(1, 56, 25, 0.25);
            border-radius: 999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(1, 56, 25, 0.45);
        }
        .glass-header {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(12px);
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.96); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-scaleIn {
            animation: scaleIn 0.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>
<body class="bg-[#F3F6F4] font-sans antialiased text-[#142319] min-h-screen flex selection:bg-senaGreen selection:text-white">

    <!-- ============================================== -->
    <!-- 1. SIDEBAR ADMINISTRADOR SIGE                  -->
    <!-- ============================================== -->
    <aside class="w-64 bg-gradient-to-b from-[#013819] via-[#012f15] to-[#01200e] text-white flex flex-col justify-between p-5 border-r border-white/10 shrink-0 sticky top-0 h-screen z-30 shadow-2xl">
        <div class="overflow-y-auto custom-scrollbar pr-1 -mr-1">
            <!-- Brand -->
            <a href="{{ route('egresados.welcome') }}" class="flex items-center gap-3 pb-5 border-b border-white/15 no-underline text-white group">
                <div class="w-11 h-11 rounded-2xl bg-white p-1.5 flex items-center justify-center shadow-lg shrink-0 border-2 border-[#62E31D] transform transition duration-300 group-hover:scale-105">
                    <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="SENA" class="w-full h-full object-contain">
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-editorial text-2xl font-bold tracking-tight text-white leading-none">SIGE</span>
                        <span class="bg-[#62E31D] text-[#012410] text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider shadow-sm">Admin</span>
                    </div>
                    <div class="text-[11px] text-green-200/80 font-medium mt-1">Gestión de Egresados</div>
                </div>
            </a>

            <!-- Navigation Links -->
            <div class="text-[10px] font-extrabold text-white/40 uppercase tracking-widest px-2.5 mt-6 mb-2.5">
                Panel Administrativo
            </div>
            
            <nav class="space-y-1.5">
                <!-- Panel de Control -->
                <a href="{{ route('egresados.dashboard_admin') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition duration-200">
                    <i class="fa-solid fa-gauge-high w-4 text-center text-sm text-green-300/80"></i>
                    <span>Panel de Control</span>
                </a>

                <!-- Directorio Egresados -->
                <a href="{{ route('egresados.dashboard_admin') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition duration-200">
                    <i class="fa-solid fa-user-graduate w-4 text-center text-sm text-green-300/80"></i>
                    <span>Directorio Egresados</span>
                </a>

                <!-- Instructores (ACTIVO EN ESTA VISTA) -->
                <a href="{{ route('egresados.admin.instructores') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gradient-to-r from-[#39A900] to-[#2e8800] text-white font-semibold text-xs shadow-md shadow-green-950/40 border border-white/20 transition-all">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-chalkboard-user w-4 text-center text-sm text-[#62E31D]"></i>
                        <span>Instructores</span>
                    </div>
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                </a>

                <!-- Encuestas (Exclusivo Administrador) -->
                <a href="{{ route('egresados.admin.encuestas') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition duration-200 group">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-clipboard-question w-4 text-center text-sm text-green-300/80 group-hover:text-[#62E31D] transition"></i>
                        <span>Encuestas</span>
                    </div>
                    <span class="text-[9px] bg-white/10 group-hover:bg-[#62E31D] group-hover:text-[#012410] font-bold px-1.5 py-0.5 rounded-md transition">Admin</span>
                </a>

                <!-- Reportes & Métricas -->
                <a href="{{ route('egresados.admin.reportes') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition duration-200">
                    <i class="fa-solid fa-file-invoice w-4 text-center text-sm text-green-300/80"></i>
                    <span>Reportes & Métricas</span>
                </a>

                <!-- Eventos & Ferias (Exclusivo Administrador) -->
                <a href="{{ route('egresados.admin.eventos') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition duration-200 group">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-calendar-check w-4 text-center text-sm text-green-300/80 group-hover:text-[#62E31D] transition"></i>
                        <span>Eventos & Ferias</span>
                    </div>
                    <span class="text-[9px] bg-white/10 group-hover:bg-[#62E31D] group-hover:text-[#012410] font-bold px-1.5 py-0.5 rounded-md transition">Admin</span>
                </a>
            </nav>

            <div class="text-[10px] font-extrabold text-white/40 uppercase tracking-widest px-2.5 mt-7 mb-2.5">Accesos Externos</div>
            <nav class="space-y-1">
                <a href="{{ route('egresados.welcome') }}" class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-green-100/70 hover:text-white hover:bg-white/10 font-medium text-xs transition duration-200">
                    <i class="fa-solid fa-globe w-4 text-center text-green-300/60"></i>
                    <span>Portal Público SIGE</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Bottom User & Logout -->
        <div class="pt-4 border-t border-white/15 shrink-0">
            <div class="flex items-center gap-3 mb-3 bg-white/5 p-2 rounded-xl border border-white/5">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#62E31D] to-[#39A900] text-[#012410] flex items-center justify-center font-extrabold text-xs shadow-md">
                    {{ Auth::check() ? Auth::user()->initials : 'AD' }}
                </div>
                <div class="overflow-hidden">
                    <div class="text-xs font-bold text-white truncate">{{ Auth::check() ? Auth::user()->full_name : 'Administrador SIGE' }}</div>
                    <div class="text-[10px] text-green-200/70 truncate">{{ Auth::check() ? Auth::user()->email : 'admin.egresados@sena.edu.co' }}</div>
                </div>
            </div>

            <form action="{{ route('egresados.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-red-500/15 hover:bg-red-500/25 border border-red-500/20 text-red-200 hover:text-white text-xs font-bold transition duration-200">
                    <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ============================================== -->
    <!-- 2. MAIN CONTENT AREA                           -->
    <!-- ============================================== -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Topbar Modernizada Homogénea -->
        <header class="glass-header border-b border-gray-200/80 px-7 py-3.5 flex items-center justify-between sticky top-0 z-20 shadow-xs">
            <div class="flex items-center gap-3.5">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#0d6928] border border-emerald-100 flex items-center justify-center font-bold text-base shadow-xs">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-sm font-extrabold text-gray-900 leading-none tracking-tight">Gestión de Instructores · Panel Administrador</h1>
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-800 bg-emerald-100/70 px-2 py-0.5 rounded-full border border-emerald-200">
                            Módulo Exclusivo
                        </span>
                    </div>
                    <span class="text-[11px] text-gray-500 font-medium">Consulta, seguimiento y asignaciones de instructores del CEFA</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('egresados.dashboard_admin') }}" class="text-xs font-semibold text-gray-600 hover:text-[#39A900] bg-gray-50 hover:bg-gray-100 border border-gray-200 px-3 py-1.5 rounded-xl flex items-center gap-1.5 transition">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Volver a Panel Principal</span>
                </a>
            </div>
        </header>

        <!-- Main Body Homogéneo -->
        <main class="flex-1 p-6 sm:p-8 space-y-7 overflow-y-auto custom-scrollbar">

            <!-- Mensajes Flash de Sesión -->
            @if(session('success'))
                <div id="flash-success" class="bg-gradient-to-r from-emerald-500 to-green-600 text-white text-xs font-bold px-4 py-3.5 rounded-2xl flex items-center justify-between shadow-lg shadow-green-900/10 border border-green-400/30 animate-fadeIn">
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-check text-sm"></i>
                        </div>
                        <span class="text-xs font-semibold">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="document.getElementById('flash-success').remove()" class="text-white/80 hover:text-white text-sm px-2">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            <!-- 1. Hero Banner Instructores con Botón de Acción Homogéneo -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#012410] via-[#013819] to-[#084b23] text-white p-7 sm:p-9 shadow-xl border border-white/10">
                <div class="absolute -right-8 -bottom-8 w-72 h-72 bg-[#62E31D]/15 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md text-[#62E31D] text-xs font-bold mb-3 border border-white/15 shadow-xs">
                            <i class="fa-solid fa-chalkboard-user text-[11px]"></i>
                            <span>Gestión de Formadores · CEFA La Angostura</span>
                        </div>
                        <h2 class="font-editorial text-2xl sm:text-3xl lg:text-4xl font-bold leading-tight tracking-tight">
                            Control y Asignación de Instructores
                        </h2>
                        <p class="text-xs sm:text-sm text-green-100/80 mt-2 max-w-2xl font-normal leading-relaxed">
                            Supervisa el equipo docente, consulta documentos de identidad, estado de vinculación y áreas técnicas de los instructores líderes del centro.
                        </p>
                    </div>

                    <div class="shrink-0 flex items-center gap-3">
                        <button type="button" onclick="abrirModalCrearInstructor()" class="bg-[#39A900] hover:bg-[#2e8800] text-white px-5 py-3 rounded-2xl text-xs font-bold shadow-lg shadow-black/20 transition flex items-center gap-2.5 border border-white/15">
                            <i class="fa-solid fa-user-plus text-sm"></i>
                            <span>Vincular Instructor</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 2. Tarjetas Métricas Superiores con Estilo Homogéneo -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Métrica 1: Total Instructores -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Instructores</div>
                        <div class="font-editorial text-2xl font-extrabold text-[#012410] mt-1">{{ number_format($totalInstructores) }}</div>
                        <div class="text-[11px] text-emerald-600 font-semibold mt-0.5">Registrados en CEFA</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                </div>

                <!-- Métrica 2: Activos -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Activos</div>
                        <div class="font-editorial text-2xl font-extrabold text-green-700 mt-1">{{ number_format($activos) }}</div>
                        <div class="text-[11px] text-green-600 font-semibold mt-0.5">En servicio lectivo</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                </div>

                <!-- Métrica 3: Programas -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Programas</div>
                        <div class="font-editorial text-2xl font-extrabold text-blue-700 mt-1">{{ number_format($programas) }}</div>
                        <div class="text-[11px] text-blue-600 font-semibold mt-0.5">Asignados</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                </div>

                <!-- Métrica 4: Fichas Activas -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Fichas Activas</div>
                        <div class="font-editorial text-2xl font-extrabold text-indigo-700 mt-1">{{ number_format($fichasActivas) }}</div>
                        <div class="text-[11px] text-indigo-600 font-semibold mt-0.5">En formación</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                </div>

                <!-- Métrica 5: Evaluaciones -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Evaluaciones</div>
                        <div class="font-editorial text-2xl font-extrabold text-amber-600 mt-1">{{ number_format($evaluaciones) }}</div>
                        <div class="text-[11px] text-amber-600 font-semibold mt-0.5">Pendientes de cierre</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                </div>
            </div>

            <!-- 3. Tabla Principal de Instructores con Cabecera y Filtro Integrado Homogéneo -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs overflow-hidden flex flex-col">
                <div class="p-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="font-editorial text-lg font-bold text-gray-900 leading-tight">Listado de Instructores Registrados</h2>
                            <span class="text-[11px] font-semibold px-2.5 py-0.5 bg-gray-100 text-gray-700 rounded-lg">
                                {{ $instructores->total() }} instructores
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">Visualización institucional y asignaciones del CEFA La Angostura</p>
                    </div>

                    <!-- Buscador y Filtros Integrados -->
                    <form action="{{ route('egresados.admin.instructores') }}" method="GET" class="flex flex-wrap items-center gap-2">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="Buscar por documento, nombre o correo..."
                                class="pl-8 pr-3 py-2 bg-white border border-gray-200 rounded-xl text-xs text-gray-800 font-medium focus:ring-2 focus:ring-[#39A900]/30 focus:border-[#39A900] outline-none shadow-xs w-60 sm:w-72">
                            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                        </div>

                        <button type="submit" class="bg-[#39A900] hover:bg-[#2a7c00] text-white px-3.5 py-2 rounded-xl text-xs font-bold transition shadow-xs flex items-center gap-1.5">
                            <i class="fa-solid fa-filter text-[10px]"></i>
                            <span>Filtrar</span>
                        </button>

                        @if(request('search'))
                            <a href="{{ route('egresados.admin.instructores') }}" class="text-xs text-gray-500 hover:text-red-500 font-semibold px-2 py-2 flex items-center gap-1" title="Limpiar filtros">
                                <i class="fa-solid fa-xmark"></i> Limpiar
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/80 border-b border-gray-100 text-[10px] font-extrabold uppercase tracking-wider text-gray-500">
                                <th class="py-3.5 px-6">Documento</th>
                                <th class="py-3.5 px-6">Instructor(a)</th>
                                <th class="py-3.5 px-6">Rol / Asignación</th>
                                <th class="py-3.5 px-6">Estado</th>
                                <th class="py-3.5 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-xs text-gray-700">
                            @forelse($instructores as $inst)
                                @php
                                    $person = $inst->person;
                                    $fullName = $person ? ($person->first_name . ' ' . $person->first_last_name . ' ' . ($person->second_last_name ?? '')) : ($inst->name ?? $inst->nickname ?? 'Instructor #' . $inst->id);
                                    
                                    $words = explode(' ', trim($fullName));
                                    $initials = '';
                                    foreach (array_slice($words, 0, 2) as $w) {
                                        $initials .= strtoupper(substr($w, 0, 1));
                                    }
                                    $initials = $initials ?: 'IN';

                                    $docNumber = $person ? ($person->document_number ?? '—') : '—';
                                    $docType = 'CC';
                                    if ($person && !empty($person->document_type)) {
                                        $docType = is_object($person->document_type) ? ($person->document_type->name ?? 'CC') : $person->document_type;
                                    }
                                    $email = $inst->email ?: ($person ? ($person->email ?? 'Sin correo') : 'Sin correo');
                                    $phone = $person ? ($person->telephone1 ?: $person->telephone2 ?: 'Sin teléfono') : '—';
                                @endphp
                                <tr class="hover:bg-emerald-50/30 transition duration-150">
                                    <!-- Documento -->
                                    <td class="py-3.5 px-6 font-mono text-gray-600 font-semibold whitespace-nowrap">
                                        <span class="text-[10px] bg-gray-100 text-gray-500 px-1.5 py-0.5 rounded font-bold mr-1">{{ $docType }}</span>
                                        {{ $docNumber }}
                                    </td>

                                    <!-- Instructor -->
                                    <td class="py-3.5 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#013819] to-[#39A900] text-white flex items-center justify-center font-bold text-xs shadow-xs shrink-0">
                                                {{ $initials }}
                                            </div>
                                            <div class="truncate max-w-xs">
                                                <div class="font-bold text-gray-900 truncate">{{ $fullName }}</div>
                                                <div class="text-[11px] text-gray-500 truncate">{{ $email }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Rol / Asignación -->
                                    <td class="py-3.5 px-6 text-gray-600">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                                Instructor CEFA
                                            </span>
                                        </div>
                                        <div class="text-[11px] text-gray-400 mt-0.5">Área Técnica / Agroindustrial</div>
                                    </td>

                                    <!-- Estado -->
                                    <td class="py-3.5 px-6">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-green-50 text-green-700 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Activo
                                        </span>
                                    </td>

                                    <!-- Acciones Homogéneas con tooltips -->
                                    <td class="py-3.5 px-6 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button type="button" 
                                                onclick="verDetalleInstructor('{{ addslashes($fullName) }}', '{{ $docType }} {{ $docNumber }}', '{{ $email }}', '{{ $phone }}', '{{ $initials }}')"
                                                class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-[#39A900] text-[#013819] hover:text-white border border-emerald-100 flex items-center justify-center transition shadow-xs" 
                                                title="Ver Ficha del Instructor">
                                                <i class="fa-solid fa-eye text-xs"></i>
                                            </button>
                                            <button type="button" 
                                                onclick="abrirModalAsignar('{{ addslashes($fullName) }}', '{{ $docType }} {{ $docNumber }}')"
                                                class="w-7 h-7 rounded-lg bg-blue-50 hover:bg-blue-600 text-blue-800 hover:text-white border border-blue-100 flex items-center justify-center transition shadow-xs" 
                                                title="Asignar Ficha / Programa">
                                                <i class="fa-solid fa-user-pen text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center">
                                        <div class="max-w-xs mx-auto text-center space-y-2">
                                            <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center mx-auto text-lg">
                                                <i class="fa-solid fa-user-slash"></i>
                                            </div>
                                            <p class="text-xs font-bold text-gray-700">No se encontraron instructores</p>
                                            <p class="text-[11px] text-gray-500">Intenta con otro término de búsqueda o limpia los filtros.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($instructores->hasPages())
                    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                        {{ $instructores->links() }}
                    </div>
                @endif
            </div>

        </main>

        <!-- Footer Homogéneo -->
        <footer class="bg-white border-t border-gray-200/80 py-3.5 px-7 text-center text-xs text-gray-500 font-medium">
            © {{ date('Y') }} <strong>SIGE — Sistema de Gestión de Egresados</strong> • CEFA La Angostura • SENA Empresa ERP
        </footer>

    </div>

    <!-- ============================================== -->
    <!-- MODAL 1: DETALLE INSTRUCTOR                    -->
    <!-- ============================================== -->
    <div id="modalInstructor" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl border border-gray-100 animate-scaleIn">
            <div class="bg-gradient-to-r from-[#012410] via-[#013819] to-[#084b23] text-white p-5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div id="mAvatar" class="w-11 h-11 rounded-2xl bg-[#62E31D]/20 text-[#62E31D] flex items-center justify-center font-bold text-sm border border-[#62E31D]/30 shadow-inner">
                        IN
                    </div>
                    <div>
                        <h3 id="mName" class="font-editorial text-base font-bold text-white">Nombre Instructor</h3>
                        <p class="text-[11px] text-green-200/70">Ficha Institucional CEFA La Angostura</p>
                    </div>
                </div>
                <button type="button" onclick="cerrarModalInstructor()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <div class="p-6 space-y-4 text-xs">
                <div class="p-4 rounded-2xl bg-gray-50/80 border border-gray-100 space-y-2.5">
                    <div class="flex justify-between items-center py-1 border-b border-gray-100">
                        <span class="text-gray-400 font-bold uppercase tracking-wider text-[10px]">Documento</span>
                        <span id="mDoc" class="font-mono font-bold text-gray-800">CC 12345678</span>
                    </div>
                    <div class="flex justify-between items-center py-1 border-b border-gray-100">
                        <span class="text-gray-400 font-bold uppercase tracking-wider text-[10px]">Correo Institucional</span>
                        <span id="mEmail" class="font-medium text-gray-800">instructor@sena.edu.co</span>
                    </div>
                    <div class="flex justify-between items-center py-1 border-b border-gray-100">
                        <span class="text-gray-400 font-bold uppercase tracking-wider text-[10px]">Teléfono de Contacto</span>
                        <span id="mPhone" class="font-medium text-gray-800">+57 300 000 0000</span>
                    </div>
                    <div class="flex justify-between items-center py-1 border-b border-gray-100">
                        <span class="text-gray-400 font-bold uppercase tracking-wider text-[10px]">Rol Principal</span>
                        <span class="font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">Instructor CEFA</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-gray-400 font-bold uppercase tracking-wider text-[10px]">Estado de Vinculación</span>
                        <span class="font-bold text-green-700 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Activo
                        </span>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2">
                    <button type="button" onclick="cerrarModalInstructor()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition text-xs">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL 2: VINCULAR INSTRUCTOR                   -->
    <!-- ============================================== -->
    <div id="modalVincular" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl border border-gray-100 animate-scaleIn">
            <div class="bg-gradient-to-r from-[#012410] via-[#013819] to-[#084b23] text-white p-5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#62E31D]/20 text-[#62E31D] flex items-center justify-center font-bold text-sm border border-[#62E31D]/30">
                        <i class="fa-solid fa-user-plus text-base"></i>
                    </div>
                    <div>
                        <h3 class="font-editorial text-base font-bold text-white">Vincular Nuevo Instructor</h3>
                        <p class="text-[11px] text-green-200/70">Asignar formador a la sede CEFA La Angostura</p>
                    </div>
                </div>
                <button type="button" onclick="cerrarModalCrearInstructor()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form onsubmit="event.preventDefault(); guardarNuevoInstructor();" class="p-6 space-y-4 text-xs">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Tipo Documento</label>
                        <select id="newDocType" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                            <option value="CC">Cédula de Ciudadanía (CC)</option>
                            <option value="CE">Cédula de Extranjería (CE)</option>
                            <option value="PEP">PEP</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Número Documento *</label>
                        <input type="text" id="newDocNumber" required placeholder="Ej: 1075283940" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Nombres y Apellidos *</label>
                    <input type="text" id="newName" required placeholder="Ej: Carlos Eduardo Morales Peña" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Correo Institucional *</label>
                        <input type="email" id="newEmail" required placeholder="cmorales@sena.edu.co" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Teléfono</label>
                        <input type="text" id="newPhone" placeholder="+57 312 456 7890" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Área Técnica / Especialidad</label>
                        <input type="text" id="newArea" placeholder="Ej: Agroindustria / Sistemas" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Ficha Asignada</label>
                        <input type="text" id="newFicha" placeholder="Ej: 2694120" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-gray-100">
                    <button type="button" onclick="cerrarModalCrearInstructor()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition text-xs">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 bg-[#39A900] hover:bg-[#2e8800] text-white font-bold rounded-xl transition text-xs shadow-md shadow-green-900/20 flex items-center gap-1.5">
                        <i class="fa-solid fa-check text-xs"></i>
                        <span>Guardar Vinculación</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL 3: ASIGNAR FICHA / PROGRAMA              -->
    <!-- ============================================== -->
    <div id="modalAsignar" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl border border-gray-100 animate-scaleIn">
            <div class="bg-gradient-to-r from-[#012410] via-[#013819] to-[#084b23] text-white p-5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#62E31D]/20 text-[#62E31D] flex items-center justify-center font-bold text-sm border border-[#62E31D]/30">
                        <i class="fa-solid fa-user-pen text-base"></i>
                    </div>
                    <div>
                        <h3 class="font-editorial text-base font-bold text-white">Asignación de Formación</h3>
                        <p id="asigInstructorName" class="text-[11px] text-green-200/80 font-medium">Instructor</p>
                    </div>
                </div>
                <button type="button" onclick="cerrarModalAsignar()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form onsubmit="event.preventDefault(); guardarAsignacion();" class="p-6 space-y-4 text-xs">
                <div>
                    <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Programa de Formación</label>
                    <select class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                        <option>ADSO - Análisis y Desarrollo de Software</option>
                        <option>Gestión de Empresas Agropecuarias</option>
                        <option>Producción Agropecuaria Ecológica</option>
                        <option>Mantenimiento de Equipos de Cómputo</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Número de Ficha</label>
                    <input type="text" placeholder="Ej: 2694120" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Jornada / Modalidad</label>
                    <select class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                        <option>Diurna - Presencial (CEFA)</option>
                        <option>Mixta / Desescolarizada</option>
                        <option>Virtual</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-gray-100">
                    <button type="button" onclick="cerrarModalAsignar()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition text-xs">
                        Cerrar
                    </button>
                    <button type="submit" class="px-5 py-2 bg-[#39A900] hover:bg-[#2e8800] text-white font-bold rounded-xl transition text-xs shadow-md shadow-green-900/20 flex items-center gap-1.5">
                        <i class="fa-solid fa-check text-xs"></i>
                        <span>Confirmar Asignación</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts Interactivos -->
    <script>
        function verDetalleInstructor(name, doc, email, phone, initials) {
            document.getElementById('mName').textContent = name;
            document.getElementById('mDoc').textContent = doc;
            document.getElementById('mEmail').textContent = email;
            document.getElementById('mPhone').textContent = phone;
            document.getElementById('mAvatar').textContent = initials;
            const modal = document.getElementById('modalInstructor');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function cerrarModalInstructor() {
            const modal = document.getElementById('modalInstructor');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function abrirModalCrearInstructor() {
            const modal = document.getElementById('modalVincular');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function cerrarModalCrearInstructor() {
            const modal = document.getElementById('modalVincular');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function abrirModalAsignar(name, doc) {
            document.getElementById('asigInstructorName').textContent = name + ' (' + doc + ')';
            const modal = document.getElementById('modalAsignar');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function cerrarModalAsignar() {
            const modal = document.getElementById('modalAsignar');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function guardarNuevoInstructor() {
            cerrarModalCrearInstructor();
            alert('¡Instructor vinculado exitosamente al equipo docente del CEFA La Angostura!');
        }

        function guardarAsignacion() {
            cerrarModalAsignar();
            alert('¡Asignación de formación actualizada correctamente!');
        }

        // Cerrar con Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModalInstructor();
                cerrarModalCrearInstructor();
                cerrarModalAsignar();
            }
        });
    </script>
</body>
</html>
