<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE Â· Generador de Reportes â€” Panel Administrador</title>

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
                    <div class="text-[11px] text-green-200/80 font-medium mt-1">GestiÃ³n de Egresados</div>
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

                <!-- Instructores -->
                <a href="{{ route('egresados.admin.instructores') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition duration-200">
                    <i class="fa-solid fa-chalkboard-user w-4 text-center text-sm text-green-300/80"></i>
                    <span>Instructores</span>
                </a>

                <!-- Encuestas (Exclusivo Administrador) -->
                <a href="{{ route('egresados.admin.encuestas') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition duration-200 group">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-clipboard-question w-4 text-center text-sm text-green-300/80 group-hover:text-[#62E31D] transition"></i>
                        <span>Encuestas</span>
                    </div>
                    <span class="text-[9px] bg-white/10 group-hover:bg-[#62E31D] group-hover:text-[#012410] font-bold px-1.5 py-0.5 rounded-md transition">Admin</span>
                </a>

                <!-- Reportes & MÃ©tricas (ACTIVO EN ESTA VISTA) -->
                <a href="{{ route('egresados.admin.reportes') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gradient-to-r from-[#39A900] to-[#2e8800] text-white font-semibold text-xs shadow-md shadow-green-950/40 border border-white/20 transition-all">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-file-invoice w-4 text-center text-sm text-[#62E31D]"></i>
                        <span>Reportes & MÃ©tricas</span>
                    </div>
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
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
                    <span>Portal PÃºblico SIGE</span>
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
                    <span>Cerrar SesiÃ³n</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ============================================== -->
    <!-- 2. MAIN CONTENT AREA                           -->
    <!-- ============================================== -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Topbar Modernizada HomogÃ©nea -->
        <header class="glass-header border-b border-gray-200/80 px-7 py-3.5 flex items-center justify-between sticky top-0 z-20 shadow-xs">
            <div class="flex items-center gap-3.5">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#0d6928] border border-emerald-100 flex items-center justify-center font-bold text-base shadow-xs">
                    <i class="fa-solid fa-file-invoice"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-sm font-extrabold text-gray-900 leading-none tracking-tight">Reportes & MÃ©tricas Â· Panel Administrador</h1>
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-800 bg-emerald-100/70 px-2 py-0.5 rounded-full border border-emerald-200">
                            MÃ³dulo Exclusivo
                        </span>
                    </div>
                    <span class="text-[11px] text-gray-500 font-medium">Consolidado institucional, auditorÃ­a y mÃ©tricas de empleabilidad</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('egresados.dashboard_admin') }}" class="text-xs font-semibold text-gray-600 hover:text-[#39A900] bg-gray-50 hover:bg-gray-100 border border-gray-200 px-3 py-1.5 rounded-xl flex items-center gap-1.5 transition">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Volver a Panel Principal</span>
                </a>
            </div>
        </header>

        <!-- Main Body HomogÃ©neo -->
        <main class="flex-1 p-6 sm:p-8 space-y-7 overflow-y-auto custom-scrollbar">

            <!-- Mensajes Flash de SesiÃ³n -->
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

            <!-- 1. Hero Banner Reportes con BotÃ³n de AcciÃ³n HomogÃ©neo -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#012410] via-[#013819] to-[#084b23] text-white p-7 sm:p-9 shadow-xl border border-white/10">
                <div class="absolute -right-8 -bottom-8 w-72 h-72 bg-[#62E31D]/15 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md text-[#62E31D] text-xs font-bold mb-3 border border-white/15 shadow-xs">
                            <i class="fa-solid fa-file-invoice text-[11px]"></i>
                            <span>AuditorÃ­a, EstadÃ­sticas & Empleabilidad Â· CEFA La Angostura</span>
                        </div>
                        <h2 class="font-editorial text-2xl sm:text-3xl lg:text-4xl font-bold leading-tight tracking-tight">
                            Consolidado de Reportes Institucionales
                        </h2>
                        <p class="text-xs sm:text-sm text-green-100/80 mt-2 max-w-2xl font-normal leading-relaxed">
                            Genera, consulta y exporta informes ejecutivos de inserciÃ³n laboral, auditorÃ­a y efectividad ocupacional de los egresados del centro.
                        </p>
                    </div>

                    <div class="shrink-0 flex items-center gap-3">
                        <button type="button" onclick="abrirModalGenerarReporte()" class="bg-[#39A900] hover:bg-[#2e8800] text-white px-5 py-3 rounded-2xl text-xs font-bold shadow-lg shadow-black/20 transition flex items-center gap-2.5 border border-white/15">
                            <i class="fa-solid fa-plus text-sm"></i>
                            <span>Generar Reporte</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 2. Tarjetas MÃ©tricas Superiores con Estilo HomogÃ©neo -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- MÃ©trica 1: Total Reportes -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Reportes</div>
                        <div class="font-editorial text-2xl font-extrabold text-[#012410] mt-1">{{ $totalGenerados }}</div>
                        <div class="text-[11px] text-emerald-600 font-semibold mt-0.5">Informes generados</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                </div>

                <!-- MÃ©trica 2: Egresados -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Egresados</div>
                        <div class="font-editorial text-2xl font-extrabold text-blue-700 mt-1">{{ number_format($totalEgresadosEvaluados, 0, ',', '.') }}</div>
                        <div class="text-[11px] text-blue-600 font-semibold mt-0.5">Muestra analizada</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>

                <!-- MÃ©trica 3: Tasa Promedio -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Tasa Promedio</div>
                        <div class="font-editorial text-2xl font-extrabold text-green-700 mt-1">{{ $tasaPromedio }}</div>
                        <div class="text-[11px] text-green-600 font-semibold mt-0.5">InserciÃ³n laboral media</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>

                <!-- MÃ©trica 4: Documentos PDF -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Documentos PDF</div>
                        <div class="font-editorial text-2xl font-extrabold text-rose-700 mt-1">{{ ($reportesPDF ?? 0) }}</div>
                        <div class="text-[11px] text-rose-600 font-semibold mt-0.5">Con membrete SENA</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                </div>

                <!-- MÃ©trica 5: Hojas Excel -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Hojas Excel</div>
                        <div class="font-editorial text-2xl font-extrabold text-emerald-700 mt-1">{{ $reportesExcel }}</div>
                        <div class="text-[11px] text-emerald-600 font-semibold mt-0.5">Listados tabulares</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-file-excel"></i>
                    </div>
                </div>
            </div>

            <!-- 3. Tabla Principal de Reportes con Cabecera y Filtro Integrado HomogÃ©neo -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs overflow-hidden flex flex-col">
                <div class="p-5 border-b border-gray-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="font-editorial text-lg font-bold text-gray-900 leading-tight">Listado de Reportes Institucionales</h2>
                            <span class="text-[11px] font-semibold px-2.5 py-0.5 bg-gray-100 text-gray-700 rounded-lg">
                                {{ count($reportes) }} reportes
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">Documentos generados para seguimiento, toma de decisiones y auditorÃ­as</p>
                    </div>

                    <!-- Buscador y Filtros Integrados -->
                    <form method="GET" action="{{ route('egresados.admin.reportes') }}" class="flex flex-wrap items-center gap-2">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por tÃ­tulo, programa..."
                                class="pl-8 pr-3 py-2 bg-white border border-gray-200 rounded-xl text-xs text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-[#39A900]/30 focus:border-[#39A900] outline-none font-medium shadow-xs w-48 sm:w-56">
                            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                        </div>

                        <select name="type" class="px-3 py-2 bg-white border border-gray-200 rounded-xl text-xs text-gray-700 font-semibold focus:ring-2 focus:ring-[#39A900]/30 focus:border-[#39A900] outline-none shadow-xs" onchange="this.form.submit()">
                            <option value="">Todos los Tipos</option>
                            <option value="Consolidado de Empleabilidad" {{ request('type') == 'Consolidado de Empleabilidad' ? 'selected' : '' }}>Empleabilidad General</option>
                            <option value="Egresados por Programa" {{ request('type') == 'Egresados por Programa' ? 'selected' : '' }}>Por Programa</option>
                            <option value="ParticipaciÃ³n en Eventos" {{ request('type') == 'ParticipaciÃ³n en Eventos' ? 'selected' : '' }}>ParticipaciÃ³n en Eventos</option>
                            <option value="Emprendimiento Egresados" {{ request('type') == 'Emprendimiento Egresados' ? 'selected' : '' }}>Emprendimiento</option>
                        </select>

                        <select name="format" class="px-3 py-2 bg-white border border-gray-200 rounded-xl text-xs text-gray-700 font-semibold focus:ring-2 focus:ring-[#39A900]/30 focus:border-[#39A900] outline-none shadow-xs" onchange="this.form.submit()">
                            <option value="">Todos los Formatos</option>
                            <option value="PDF" {{ request('format') == 'PDF' ? 'selected' : '' }}>ðŸ“„ Solo PDF</option>
                            <option value="EXCEL" {{ request('format') == 'EXCEL' ? 'selected' : '' }}>ðŸ“Š Solo Excel</option>
                        </select>

                        <button type="submit" class="px-3.5 py-2 bg-[#39A900] hover:bg-[#2a7c00] text-white rounded-xl text-xs font-bold transition shadow-xs flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-filter text-[10px]"></i>
                            <span>Filtrar</span>
                        </button>

                        @if(request()->anyFilled(['search', 'type', 'format']))
                            <a href="{{ route('egresados.admin.reportes') }}" class="text-xs text-gray-500 hover:text-red-500 font-semibold px-2 py-2 flex items-center gap-1" title="Limpiar filtros">
                                <i class="fa-solid fa-xmark"></i> Limpiar
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-gray-50/80 border-b border-gray-100 text-[10px] font-extrabold text-gray-500 uppercase tracking-wider">
                                <th class="py-3.5 px-5">Reporte & Tipo</th>
                                <th class="py-3.5 px-4">Programa / Cobertura</th>
                                <th class="py-3.5 px-4">Periodo Evaluado</th>
                                <th class="py-3.5 px-4">Formato</th>
                                <th class="py-3.5 px-4">MÃ©tricas Clave</th>
                                <th class="py-3.5 px-4 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                            @forelse($reportes as $item)
                                @php
                                    $itemData = array_merge($item, [
                                        'delete_url' => route('egresados.admin.reportes.destroy', $item['id']),
                                    ]);
                                    $fmt = strtoupper($item['format'] ?? 'PDF');
                                    $formatBadge = match($fmt) {
                                        'EXCEL', 'XLSX', 'CSV' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                        default => 'bg-rose-100 text-rose-800 border-rose-200'
                                    };
                                    $formatIcon = match($fmt) {
                                        'EXCEL', 'XLSX', 'CSV' => 'fa-file-excel',
                                        default => 'fa-file-pdf'
                                    };
                                @endphp
                                <tr class="hover:bg-emerald-50/30 transition duration-150">
                                    <!-- Reporte & Tipo -->
                                    <td class="py-3.5 px-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-xl {{ $fmt === 'EXCEL' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-rose-50 text-rose-600 border-rose-100' }} border flex items-center justify-center text-sm shrink-0">
                                                <i class="fa-solid {{ $formatIcon }}"></i>
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900 text-xs hover:text-[#39A900] transition cursor-pointer" onclick="abrirModalVerReporte({{ json_encode($itemData) }})">
                                                    {{ $item['title'] }}
                                                </div>
                                                <div class="text-[10px] text-gray-500 font-medium mt-0.5">
                                                    {{ $item['type'] }} Â· CÃ³digo: <span class="font-mono text-gray-700 font-bold">{{ $item['id'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Programa / Cobertura -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-gray-800 text-xs truncate max-w-xs">{{ $item['program'] }}</div>
                                        <div class="text-[10px] text-gray-400 mt-0.5">Por: {{ $item['author'] ?? 'Administrador SIGE' }}</div>
                                    </td>

                                    <!-- Periodo Evaluado -->
                                    <td class="py-3.5 px-4 font-mono text-[11px] text-gray-600 whitespace-nowrap">
                                        <div>{{ $item['period'] ?? $item['date'] }}</div>
                                        <div class="text-[10px] text-gray-400 mt-0.5">Emitido el {{ $item['date'] }}</div>
                                    </td>

                                    <!-- Formato -->
                                    <td class="py-3.5 px-4">
                                        <span class="inline-flex items-center gap-1 text-[10px] font-extrabold px-2 py-0.5 rounded-md border {{ $formatBadge }}">
                                            <i class="fa-solid {{ $formatIcon }} text-[9px]"></i>
                                            {{ $fmt }}
                                        </span>
                                    </td>

                                    <!-- MÃ©tricas Clave -->
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center justify-between text-[11px] font-medium text-gray-700 mb-1">
                                            <span>{{ $item['total_egresados'] }} egresados</span>
                                            <span class="font-extrabold text-[#39A900]">{{ $item['rate'] }}</span>
                                        </div>
                                        @php
                                            $cleanRate = (int) filter_var($item['rate'], FILTER_SANITIZE_NUMBER_INT);
                                            $barColor = $cleanRate >= 70 ? 'bg-[#39A900]' : ($cleanRate >= 50 ? 'bg-amber-500' : 'bg-rose-500');
                                        @endphp
                                        <div class="w-24 bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                            <div class="{{ $barColor }} h-1.5 rounded-full" style="width: {{ min(100, max(10, $cleanRate)) }}%"></div>
                                        </div>
                                    </td>

                                    <!-- Acciones HomogÃ©neas -->
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button type="button" 
                                                onclick="abrirModalVerReporte({{ json_encode($itemData) }})"
                                                class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-[#39A900] text-[#013819] hover:text-white border border-emerald-100 flex items-center justify-center transition shadow-xs" 
                                                title="Ver Detalle y GrÃ¡ficos">
                                                <i class="fa-solid fa-eye text-xs"></i>
                                            </button>

                                            <button type="button" 
                                                onclick="descargarReporteSimulado({{ json_encode($itemData) }})"
                                                class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-[#39A900] text-[#013819] hover:text-white border border-emerald-100 flex items-center justify-center transition shadow-xs" 
                                                title="Descargar Documento">
                                                <i class="fa-solid fa-download text-xs"></i>
                                            </button>

                                            <button type="button" 
                                                onclick="abrirModalEliminarReporte({{ json_encode($itemData) }})"
                                                class="w-7 h-7 rounded-lg bg-rose-50 hover:bg-rose-600 text-rose-700 hover:text-white border border-rose-100 flex items-center justify-center transition shadow-xs" 
                                                title="Eliminar Reporte">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center">
                                        <div class="max-w-xs mx-auto text-center space-y-2">
                                            <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center mx-auto text-lg">
                                                <i class="fa-solid fa-file-circle-xmark"></i>
                                            </div>
                                            <p class="text-xs font-bold text-gray-700">No se encontraron reportes</p>
                                            <p class="text-[11px] text-gray-500">Intenta con otros filtros o genera un nuevo reporte.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>

        <!-- Footer HomogÃ©neo -->
        <footer class="bg-white border-t border-gray-200/80 py-3.5 px-7 text-center text-xs text-gray-500 font-medium">
            Â© {{ date('Y') }} <strong>SIGE â€” Sistema de GestiÃ³n de Egresados</strong> â€¢ CEFA La Angostura â€¢ SENA Empresa ERP
        </footer>

    </div>

    <!-- ============================================== -->
    <!-- MODAL: GENERAR REPORTE                         -->
    <!-- ============================================== -->
    <div id="modalGenerarReporte" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl border border-gray-100 animate-scaleIn">
            <div class="bg-gradient-to-r from-[#012410] via-[#013819] to-[#084b23] text-white p-5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#62E31D]/20 text-[#62E31D] flex items-center justify-center font-bold text-sm border border-[#62E31D]/30">
                        <i class="fa-solid fa-file-circle-plus text-base"></i>
                    </div>
                    <div>
                        <h3 class="font-editorial text-base font-bold text-white">Generar Reporte Institucional</h3>
                        <p class="text-[11px] text-green-200/70">Consolidado y anÃ¡lisis estadÃ­stico CEFA</p>
                    </div>
                </div>
                <button type="button" onclick="cerrarModalGenerarReporte()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form action="{{ route('egresados.admin.reportes.store') }}" method="POST" class="p-6 space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Tipo de Instrumento / Reporte *</label>
                    <select name="type" id="rep_type_select" required onchange="autoSugerirTitulo(this.value)" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                        <option value="Consolidado de Empleabilidad">Consolidado General de Empleabilidad</option>
                        <option value="Egresados por Programa">Egresados por Programa de FormaciÃ³n</option>
                        <option value="ParticipaciÃ³n en Eventos">ParticipaciÃ³n en Ferias y Ruedas de Empleo</option>
                        <option value="Emprendimiento Egresados">Sondeo de Emprendimiento y Fondo Emprender</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">TÃ­tulo del Reporte *</label>
                    <input type="text" name="title" id="rep_title_input" required placeholder="Ej: Consolidado de Empleabilidad 2026-I" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Programa / Cobertura</label>
                        <select name="program" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                            <option value="Todos los Programas">Todos los Programas</option>
                            <option value="ADSO (AnÃ¡lisis y Desarrollo de Software)">ADSO</option>
                            <option value="Agropecuario & Pecuario">Agropecuario & Pecuario</option>
                            <option value="GestiÃ³n Empresarial">GestiÃ³n Empresarial</option>
                            <option value="Mantenimiento Industrial">Mantenimiento Industrial</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Formato de Salida *</label>
                        <div class="flex items-center gap-3 pt-1.5">
                            <label class="flex items-center gap-1.5 cursor-pointer font-bold text-gray-700">
                                <input type="radio" name="format" value="PDF" checked class="text-[#39A900] focus:ring-[#39A900]">
                                <span>ðŸ“„ PDF</span>
                            </label>
                            <label class="flex items-center gap-1.5 cursor-pointer font-bold text-gray-700">
                                <input type="radio" name="format" value="EXCEL" class="text-[#39A900] focus:ring-[#39A900]">
                                <span>ðŸ“Š Excel</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Fecha Inicio</label>
                        <input type="date" name="period_start" value="{{ date('Y-01-01') }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Fecha Fin</label>
                        <input type="date" name="period_end" value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900]">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase tracking-wider text-[10px] mb-1">Objetivo / Observaciones</label>
                    <textarea name="description" rows="2" placeholder="Resumen o justificaciÃ³n del informe para archivo institucional..." class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-[#39A900] resize-none"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-gray-100">
                    <button type="button" onclick="cerrarModalGenerarReporte()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition text-xs">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 bg-[#39A900] hover:bg-[#2e8800] text-white font-bold rounded-xl transition text-xs shadow-md shadow-green-900/20 flex items-center gap-1.5">
                        <i class="fa-solid fa-bolt text-xs"></i>
                        <span>Generar Ahora</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL: VER DETALLE REPORTE                     -->
    <!-- ============================================== -->
    <div id="modalVerReporte" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl border border-gray-100 animate-scaleIn">
            <div class="bg-gradient-to-r from-[#012410] via-[#013819] to-[#084b23] text-white p-5 flex items-center justify-between">
                <div>
                    <span id="ver_rep_id" class="text-[10px] font-mono bg-white/10 px-2 py-0.5 rounded font-bold text-[#62E31D]">REP-000</span>
                    <h3 id="ver_rep_title" class="font-editorial text-base font-bold text-white mt-1">TÃ­tulo del Reporte</h3>
                    <p id="ver_rep_type" class="text-[11px] text-green-200/70">Tipo de Reporte</p>
                </div>
                <button type="button" onclick="cerrarModalVerReporte()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <div class="p-6 space-y-4 text-xs">
                <div class="grid grid-cols-2 gap-3 p-3.5 bg-gray-50 rounded-2xl border border-gray-100">
                    <div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Formato</div>
                        <div id="ver_rep_format" class="font-bold text-gray-800 text-xs mt-0.5">PDF</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Cobertura</div>
                        <div id="ver_rep_program" class="font-bold text-gray-800 text-xs mt-0.5">Todos los Programas</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Periodo</div>
                        <div id="ver_rep_period" class="font-bold text-gray-800 text-xs mt-0.5">01/01/2026 - 31/12/2026</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Muestra</div>
                        <div id="ver_rep_total" class="font-bold text-emerald-700 text-xs mt-0.5">0 egresados</div>
                    </div>
                </div>

                <!-- DistribuciÃ³n Visual -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-700 uppercase tracking-wider text-[10px]">Tasa Global de InserciÃ³n</span>
                        <span id="ver_rep_rate" class="font-extrabold text-[#39A900] text-sm">0%</span>
                    </div>

                    <div class="space-y-2">
                        <div>
                            <div class="flex justify-between text-[11px] text-gray-600 mb-0.5">
                                <span>Vinculados laboralmente</span>
                                <span id="ver_rep_emp_pct" class="font-bold">0%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div id="ver_rep_bar_emp" class="bg-[#39A900] h-2 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[11px] text-gray-600 mb-0.5">
                                <span>Independientes / Emprendedores</span>
                                <span id="ver_rep_ind_pct" class="font-bold">0%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div id="ver_rep_bar_ind" class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[11px] text-gray-600 mb-0.5">
                                <span>En bÃºsqueda de empleo</span>
                                <span id="ver_rep_desemp_pct" class="font-bold">0%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div id="ver_rep_bar_desemp" class="bg-rose-500 h-2 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resumen / Notas -->
                <div class="p-3 bg-emerald-50/50 rounded-xl border border-emerald-100">
                    <div class="font-bold text-emerald-950 text-[10px] uppercase tracking-wider mb-1">Notas y Conclusiones:</div>
                    <p id="ver_rep_desc" class="text-emerald-900/80 leading-relaxed text-[11px]">Sin notas adicionales registradas.</p>
                </div>

                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                    <button type="button" id="btn_descargar_modal" class="px-4 py-2 bg-[#39A900] hover:bg-[#2e8800] text-white font-bold rounded-xl transition text-xs flex items-center gap-1.5 shadow-xs">
                        <i class="fa-solid fa-download text-xs"></i>
                        <span>Imprimir / Exportar</span>
                    </button>
                    <button type="button" onclick="cerrarModalVerReporte()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition text-xs">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL: ELIMINAR REPORTE                        -->
    <!-- ============================================== -->
    <div id="modalEliminarReporte" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-sm w-full overflow-hidden shadow-2xl border border-gray-100 animate-scaleIn text-center p-6 space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 border border-rose-100 flex items-center justify-center mx-auto text-xl shadow-xs">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h3 class="font-editorial text-base font-bold text-gray-900">Â¿Eliminar este Reporte?</h3>
                <p class="text-xs text-gray-500 mt-1">Esta acciÃ³n retirarÃ¡ el registro <span id="delete_rep_id" class="font-mono font-bold text-gray-800"></span> del histÃ³rico de auditorÃ­as.</p>
                <div id="delete_rep_title" class="font-bold text-gray-800 text-xs mt-2 bg-gray-50 p-2 rounded-xl border border-gray-100 truncate">TÃ­tulo</div>
            </div>

            <form id="formEliminarReporte" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex items-center justify-center gap-2.5 pt-2">
                    <button type="button" onclick="cerrarModalEliminarReporte()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition text-xs">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl transition text-xs shadow-md shadow-rose-900/20">
                        SÃ­, Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts Interactivos -->
    <script>
        function autoSugerirTitulo(type) {
            const input = document.getElementById('rep_title_input');
            const ano = new Date().getFullYear();
            if (type === 'Consolidado de Empleabilidad') input.value = `Consolidado General de Empleabilidad ${ano}`;
            else if (type === 'Egresados por Programa') input.value = `Seguimiento Laboral Egresados ADSO ${ano}`;
            else if (type === 'ParticipaciÃ³n en Eventos') input.value = `ParticipaciÃ³n en Ferias y Ruedas de Empleo ${ano}`;
            else if (type === 'Emprendimiento Egresados') input.value = `Sondeo de Emprendimiento & Fondo Emprender ${ano}`;
        }

        function abrirModalGenerarReporte() {
            const modal = document.getElementById('modalGenerarReporte');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            autoSugerirTitulo(document.getElementById('rep_type_select').value);
        }

        function cerrarModalGenerarReporte() {
            const modal = document.getElementById('modalGenerarReporte');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        let reporteActual = null;
        function abrirModalVerReporte(data) {
            reporteActual = data;
            document.getElementById('ver_rep_id').innerText = data.id;
            document.getElementById('ver_rep_title').innerText = data.title;
            document.getElementById('ver_rep_type').innerText = data.type;
            document.getElementById('ver_rep_format').innerText = data.format;
            document.getElementById('ver_rep_program').innerText = data.program;
            document.getElementById('ver_rep_period').innerText = data.period || data.date;
            document.getElementById('ver_rep_rate').innerText = data.rate || '0%';
            document.getElementById('ver_rep_total').innerText = `${data.total_egresados} egresados`;
            document.getElementById('ver_rep_desc').innerText = data.description || 'Sin notas adicionales registradas.';

            const total = data.total_egresados || 1;
            const emp = data.empleados || 0;
            const ind = data.independientes || 0;
            const des = data.desempleados || 0;

            const pEmp = Math.round((emp / total) * 100);
            const pInd = Math.round((ind / total) * 100);
            const pDes = Math.round((des / total) * 100);

            document.getElementById('ver_rep_emp_pct').innerText = `${pEmp}%`;
            document.getElementById('ver_rep_bar_emp').style.width = `${pEmp}%`;

            document.getElementById('ver_rep_ind_pct').innerText = `${pInd}%`;
            document.getElementById('ver_rep_bar_ind').style.width = `${pInd}%`;

            document.getElementById('ver_rep_desemp_pct').innerText = `${pDes}%`;
            document.getElementById('ver_rep_bar_desemp').style.width = `${pDes}%`;

            const btnDesc = document.getElementById('btn_descargar_modal');
            btnDesc.onclick = function() {
                descargarReporteSimulado(data);
            };

            const modal = document.getElementById('modalVerReporte');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function cerrarModalVerReporte() {
            const modal = document.getElementById('modalVerReporte');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function abrirModalEliminarReporte(data) {
            const form = document.getElementById('formEliminarReporte');
            form.action = data.delete_url;

            document.getElementById('delete_rep_id').innerText = data.id;
            document.getElementById('delete_rep_title').innerText = data.title;

            const modal = document.getElementById('modalEliminarReporte');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function cerrarModalEliminarReporte() {
            const modal = document.getElementById('modalEliminarReporte');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function descargarReporteSimulado(data) {
            const fmt = data.format || 'PDF';
            const win = window.open('', '_blank');
            win.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>${data.title} â€” SENA SIGE</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 40px; color: #333; line-height: 1.6; }
                        .header { border-bottom: 2px solid #39A900; padding-bottom: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
                        .sena-badge { background: #39A900; color: white; padding: 6px 14px; border-radius: 6px; font-weight: bold; }
                        .meta-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
                        .meta-table td { padding: 8px 12px; border: 1px solid #ddd; }
                        .metric-card { background: #f4fbf4; border-left: 4px solid #39A900; padding: 15px; margin-bottom: 20px; }
                        .footer { margin-top: 50px; font-size: 11px; color: #888; text-align: center; border-top: 1px solid #eee; padding-top: 15px; }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <div>
                            <h2 style="margin:0; color:#013819;">SENA Â· CENTRO CEFA LA ANGOSTURA</h2>
                            <p style="margin:4px 0 0; color:#666;">Sistema de InformaciÃ³n y GestiÃ³n de Egresados (SIGE ERP)</p>
                        </div>
                        <div class="sena-badge">REPORTE OFICIAL ${fmt}</div>
                    </div>
                    <h1>${data.title}</h1>
                    <table class="meta-table">
                        <tr><td><strong>CÃ³digo de Registro:</strong></td><td>${data.id}</td><td><strong>Fecha EmisiÃ³n:</strong></td><td>${data.date}</td></tr>
                        <tr><td><strong>Tipo de Instrumento:</strong></td><td>${data.type}</td><td><strong>Formato Generado:</strong></td><td>${data.format}</td></tr>
                        <tr><td><strong>Programa:</strong></td><td>${data.program}</td><td><strong>Periodo:</strong></td><td>${data.period}</td></tr>
                        <tr><td><strong>Generado por:</strong></td><td colspan="3">${data.author || 'Administrador SIGE'}</td></tr>
                    </table>
                    <div class="metric-card">
                        <h3 style="margin:0 0 10px 0; color:#013819;">Resumen Ejecutivo de Indicadores:</h3>
                        <p><strong>Total Egresados Analizados:</strong> ${data.total_egresados} egresados</p>
                        <p><strong>Tasa Global de InserciÃ³n:</strong> ${data.rate}</p>
                        <p><strong>Empleados:</strong> ${data.empleados} (${Math.round((data.empleados/data.total_egresados)*100)}%) | <strong>Independientes/Emprendedores:</strong> ${data.independientes} | <strong>En BÃºsqueda:</strong> ${data.desempleados}</p>
                    </div>
                    <p><strong>Conclusiones del Informe:</strong> ${data.description}</p>
                    <div class="footer">
                        Documento oficial generado desde el Panel Administrador SIGE el ${new Date().toLocaleString()} Â· CEFA La Angostura, Campoalegre - Huila.
                    </div>
                    <script>window.print();<\/script>
                </body>
                </html>
            `);
            win.document.close();
        }

        // Escape y backdrop
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModalGenerarReporte();
                cerrarModalVerReporte();
                cerrarModalEliminarReporte();
            }
        });

        ['modalGenerarReporte', 'modalVerReporte', 'modalEliminarReporte'].forEach(id => {
            const m = document.getElementById(id);
            if (m) m.addEventListener('click', function(e) {
                if (e.target === m) {
                    m.classList.add('hidden');
                    m.classList.remove('flex');
                }
            });
        });
    </script>
</body>
</html>
