<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Directorio de Egresados — Instructor CEFA</title>

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

<div class="grid grid-cols-1 lg:grid-cols-[250px_1fr] min-h-screen">

    <!-- ============================================== -->
    <!-- 1. SIDEBAR EXCLUSIVO DEL INSTRUCTOR -->
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

                <a href="{{ route('egresados.instructor.directorio') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-[#39A900] text-white font-semibold text-xs shadow-md">
                    <i class="fa-solid fa-address-book w-4 text-center"></i>
                    <span>Directorio Completo</span>
                </a>

                <a href="{{ route('egresados.instructor.encuestas.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition">
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
                    <div class="text-xs font-bold text-white truncate">{{ Auth::check() ? Auth::user()->full_name : 'Instructor Egresados' }}</div>
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
    <div class="flex flex-col min-w-0" x-data="{ openModal: false, selectedEgresado: null }">
        
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
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <span class="hidden sm:inline text-white">{{ Auth::user()->name ?? 'Instructor Egresados' }}</span>
                </div>
            </div>
        </header>

        <!-- Main Body Content -->
        <main class="flex-1 p-6 sm:p-8 space-y-6 max-w-7xl mx-auto w-full">

            <!-- Encabezado de Página -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-xs font-extrabold px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800 uppercase tracking-wider">
                            Seguimiento
                        </span>
                        <span class="text-xs text-gray-400">• Actualización en Tiempo Real</span>
                    </div>
                    <h2 class="text-2xl font-bold font-editorial text-gray-900 leading-tight">
                        Directorio de Egresados Asignados
                    </h2>
                    <p class="text-sm text-gray-500 mt-0.5">
                        Gestiona, consulta los expedientes y realiza seguimiento a la vinculación laboral de los aprendices graduados.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="openModal = true" class="inline-flex items-center justify-center px-4 py-2 bg-[#001A29] hover:bg-[#39A900] text-white text-xs font-bold rounded-xl transition shadow-xs cursor-pointer">
                        <i class="fa-solid fa-plus mr-2 text-xs"></i>
                        <span>Nuevo Egresado</span>
                    </button>
                </div>
            </div>

            <!-- Tarjetas de Estadísticas del Instructor -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                
                <!-- Stat 1: Actualización Pendiente -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-xs flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Actualización Pendiente</p>
                        <h3 class="text-2xl font-bold font-editorial text-gray-800 mt-1">{{ number_format($actualizacionPendiente ?? 304) }}</h3>
                        <span class="text-[10.5px] text-amber-700 font-bold bg-amber-50 px-2 py-0.5 rounded-md mt-1 inline-flex items-center gap-1 border border-amber-200">
                            <i class="fa-solid fa-clock-rotate-left text-[9px]"></i> Desactualizada
                        </span>
                    </div>
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl shrink-0 border border-amber-100">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>

                <!-- Stat 2: Seguimientos Realizados -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-xs flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Seguimientos Realizados</p>
                        <h3 class="text-2xl font-bold font-editorial text-gray-800 mt-1">{{ number_format($seguimientosRealizados ?? 300) }}</h3>
                        <span class="text-[10.5px] text-emerald-700 font-bold bg-emerald-50 px-2 py-0.5 rounded-md mt-1 inline-flex items-center gap-1 border border-emerald-200">
                            <i class="fa-solid fa-calendar-check text-[9px]"></i> Este mes
                        </span>
                    </div>
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl shrink-0 border border-emerald-100">
                        <i class="fa-solid fa-magnifying-glass-chart"></i>
                    </div>
                </div>

                <!-- Stat 3: Egresados Registrados -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-xs flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Egresados Registrados</p>
                        <h3 class="text-2xl font-bold font-editorial text-gray-800 mt-1">{{ number_format($totalEgresados ?? 5634) }}</h3>
                        <span class="text-[10.5px] text-blue-700 font-bold bg-blue-50 px-2 py-0.5 rounded-md mt-1 inline-flex items-center gap-1 border border-blue-200">
                            <i class="fa-solid fa-users text-[9px]"></i> Base general
                        </span>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl shrink-0 border border-blue-100">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>

            </div>

            <!-- Grilla Principal: Tabla de Egresados (2 cols) + Panel Lateral de Detalle (1 col) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                
                <!-- Columna Izquierda: Tabla y Filtros -->
                <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
                    
                    <!-- Toolbar de Búsqueda -->
                    <div class="p-4 border-b border-gray-100 bg-[#FAFCF9] flex flex-wrap items-center justify-between gap-3">
                        <form action="{{ route('egresados.instructor.directorio') }}" method="GET" class="flex flex-wrap items-center gap-2.5 flex-1">
                            <div class="relative flex-1 min-w-[200px]">
                                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o cédula..." 
                                       class="w-full pl-8 pr-3 py-2 text-xs bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition">
                            </div>

                            <select name="course_id" onchange="this.form.submit()" class="px-3 py-2 text-xs bg-white border border-gray-200 rounded-xl text-gray-700 focus:border-emerald-600 outline-hidden font-medium cursor-pointer">
                                <option value="">-- Todos los Programas / Fichas --</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                        Ficha {{ $course->code }} {{ $course->program ? '· ' . Str::limit($course->program->name, 22) : '' }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit" class="px-3.5 py-2 bg-[#001A29] hover:bg-[#39A900] text-white text-xs font-bold rounded-xl transition cursor-pointer">
                                Filtrar
                            </button>

                            @if(request('search') || request('course_id'))
                                <a href="{{ route('egresados.instructor.directorio') }}" class="px-2.5 py-2 text-xs font-bold text-gray-500 hover:text-red-600 transition">
                                    <i class="fa-solid fa-xmark"></i> Limpiar
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Tabla de Egresados -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="bg-[#FAFCF9] border-b border-gray-100 text-[10.5px] font-bold text-gray-400 uppercase tracking-wider">
                                    <th class="py-3 px-4">Egresado</th>
                                    <th class="py-3 px-4">Documento</th>
                                    <th class="py-3 px-4">Programa / Ficha</th>
                                    <th class="py-3 px-4">Contacto</th>
                                    <th class="py-3 px-4">Estado</th>
                                    <th class="py-3 px-4 text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-700">
                                @forelse($apprentices as $index => $appr)
                                    @php
                                        $person = $appr->person;
                                        $fullName = $person ? ($person->first_name . ' ' . $person->first_last_name) : 'Egresado SENA ' . ($index + 1);
                                        $doc = $person ? ($person->document_type . ' ' . $person->document_number) : 'CC 1075' . (200000 + $index);
                                        $prog = $appr->course && $appr->course->program ? $appr->course->program->name : 'Gestión Agroempresarial';
                                        $ficha = $appr->course->code ?? '55555';
                                        $phone = $person ? ($person->telephone1 ?? 'No registra') : '315 456 7890';
                                        $email = $person ? ($person->misena_email ?? ($person->personal_email ?? 'egresado@sena.edu.co')) : 'egresado@sena.edu.co';
                                        $st = $appr->apprentice_status ?? 'CERTIFICADO';
                                        
                                        $badgeClass = match($st) {
                                            'EN FORMACIÓN' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'INDUCCIÓN' => 'bg-amber-50 text-amber-700 border-amber-200',
                                            'CONDICIONADO' => 'bg-purple-50 text-purple-700 border-purple-200',
                                            default => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        };
                                        $badgeLabel = match($st) {
                                            'EN FORMACIÓN' => 'EMPLEADO',
                                            'INDUCCIÓN' => 'EMPRENDEDOR',
                                            'CONDICIONADO' => 'ESTUDIANDO',
                                            default => 'GRADUADO',
                                        };

                                        $egresadoJson = json_encode([
                                            'id' => $appr->id,
                                            'name' => $fullName,
                                            'doc' => $doc,
                                            'program' => $prog,
                                            'ficha' => $ficha,
                                            'phone' => $phone,
                                            'email' => $email,
                                            'status' => $badgeLabel,
                                            'status_pill' => $badgeClass,
                                            'profile_url' => route('egresados.superadmin.perfil', ['id' => $appr->id])
                                        ]);
                                    @endphp
                                    <tr class="hover:bg-emerald-50/40 transition cursor-pointer egresado-row {{ $index === 0 ? 'bg-emerald-50/50 font-medium' : '' }}"
                                        id="appr-row-{{ $appr->id }}"
                                        onclick="selectInstructorEgresado({{ $egresadoJson }}, 'appr-row-{{ $appr->id }}')">
                                        
                                        <td class="py-3.5 px-4">
                                            <div class="font-bold text-gray-900">{{ $fullName }}</div>
                                            <div class="text-[11px] text-gray-400 truncate max-w-[150px]">{{ $email }}</div>
                                        </td>

                                        <td class="py-3.5 px-4 font-mono text-xs text-gray-600 font-semibold whitespace-nowrap">
                                            {{ $doc }}
                                        </td>

                                        <td class="py-3.5 px-4">
                                            <div class="font-semibold text-gray-800 leading-tight">{{ Str::limit($prog, 25) }}</div>
                                            <div class="text-[11px] text-emerald-700 font-bold">Ficha: {{ $ficha }}</div>
                                        </td>

                                        <td class="py-3.5 px-4 text-gray-600 whitespace-nowrap">
                                            <i class="fa-solid fa-phone text-[10px] text-gray-400 mr-1"></i>{{ $phone }}
                                        </td>

                                        <td class="py-3.5 px-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $badgeClass }}">
                                                {{ $badgeLabel }}
                                            </span>
                                        </td>

                                        <td class="py-3.5 px-4 text-center whitespace-nowrap" onclick="event.stopPropagation();">
                                            <a href="{{ route('egresados.superadmin.perfil', ['id' => $appr->id]) }}" 
                                               class="w-7 h-7 rounded-lg border border-gray-200 text-gray-600 hover:bg-[#39A900] hover:text-white hover:border-[#39A900] inline-flex items-center justify-center transition" title="Ver Perfil Completo">
                                                <i class="fa-solid fa-arrow-right text-xs"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-8 text-center text-gray-400 text-xs">
                                            No se encontraron egresados con los filtros aplicados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    @if(isset($apprentices) && $apprentices->hasPages())
                        <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                            {{ $apprentices->appends(request()->query())->links() }}
                        </div>
                    @endif

                </div>

                <!-- Columna Derecha: Panel Lateral de Detalle Fijo (Sticky) -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-xs p-5 space-y-4 sticky top-20">
                    
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Detalle del Egresado</h3>
                        <span id="detailStatusPill" class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">GRADUADO</span>
                    </div>

                    <!-- Hero del Egresado -->
                    <div class="text-center pb-2">
                        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-lg font-editorial mx-auto shadow-xs border-2 border-emerald-300" id="detailAvatar">
                            VR
                        </div>
                        <h4 id="detailName" class="font-bold text-gray-900 text-base mt-2 font-editorial">Valentina Ríos Egresada</h4>
                        <p id="detailDoc" class="text-xs font-mono text-gray-500">CC 10000003</p>
                    </div>

                    <!-- Datos de Formación y Contacto -->
                    <div class="bg-gray-50 p-3.5 rounded-xl space-y-2 text-xs">
                        <div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Programa de Formación</span>
                            <span id="detailProgram" class="font-bold text-gray-800">Gestión de Empresas Agropecuarias</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Ficha</span>
                            <span id="detailFicha" class="font-semibold text-emerald-700">Ficha: 55555</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Correo Electrónico</span>
                            <span id="detailEmail" class="text-gray-700">egresado@sena.edu.co</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Teléfono de Contacto</span>
                            <span id="detailPhone" class="text-gray-700">315 456 7890</span>
                        </div>
                    </div>

                    <!-- Botones de Acción para el Instructor -->
                    <div class="pt-2 space-y-2">
                        <a id="detailBtnProfile" href="#" class="w-full py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-user text-xs"></i>
                            <span>Ver Perfil Completo</span>
                        </a>

                        <button type="button" @click="alert('Registrar nuevo seguimiento para: ' + document.getElementById('detailName').innerText)" class="w-full py-2 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 text-xs font-bold rounded-xl transition flex items-center justify-center gap-2 cursor-pointer shadow-2xs">
                            <i class="fa-solid fa-pen-to-square text-xs text-emerald-600"></i>
                            <span>Registrar Seguimiento</span>
                        </button>
                    </div>

                </div>

            </div>

        </main>

    </div>

</div>

<!-- Modal Nuevo Egresado (opcional si el instructor registra) -->
<div x-show="openModal" style="display: none;" class="fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-xs flex items-center justify-center p-4" x-cloak>
    <div @click.away="openModal = false" class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-gray-100">
        <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
            <h3 class="text-base font-bold text-gray-900">Registrar Nuevo Egresado</h3>
            <button @click="openModal = false" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>
        <form action="{{ route('egresados.superadmin.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Nombres y Apellidos</label>
                <input type="text" name="nombres" required class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl focus:border-emerald-600 outline-hidden">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Documento</label>
                    <input type="text" name="documento" required class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl focus:border-emerald-600 outline-hidden">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Ficha</label>
                    <select name="course_id" required class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl focus:border-emerald-600 outline-hidden">
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}">Ficha {{ $c->code }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Correo Electrónico</label>
                <input type="email" name="email" required class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl focus:border-emerald-600 outline-hidden">
            </div>
            <div class="flex justify-end gap-2 pt-3 border-t border-gray-100">
                <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-xs cursor-pointer">Guardar Egresado</button>
            </div>
        </form>
    </div>
</div>

<script>
    function selectInstructorEgresado(data, rowId) {
        if (!data) return;

        document.querySelectorAll('.egresado-row').forEach(row => {
            row.classList.remove('bg-emerald-50/50', 'font-medium');
        });
        const activeRow = document.getElementById(rowId);
        if (activeRow) activeRow.classList.add('bg-emerald-50/50', 'font-medium');

        document.getElementById('detailName').innerText = data.name || 'Egresado SENA';
        document.getElementById('detailDoc').innerText = data.doc || '';
        document.getElementById('detailProgram').innerText = data.program || 'General';
        document.getElementById('detailFicha').innerText = 'Ficha: ' + (data.ficha || 'N/A');
        document.getElementById('detailEmail').innerText = data.email || 'No registra';
        document.getElementById('detailPhone').innerText = data.phone || 'No registra';

        const avatar = document.getElementById('detailAvatar');
        if (avatar && data.name) {
            const parts = data.name.trim().split(' ');
            avatar.innerText = (parts[0][0] + (parts[1] ? parts[1][0] : '')).toUpperCase();
        }

        const pill = document.getElementById('detailStatusPill');
        if (pill) {
            pill.innerText = data.status || 'GRADUADO';
            pill.className = 'px-2.5 py-0.5 text-[10px] font-bold rounded-full border ' + (data.status_pill || 'bg-emerald-50 text-emerald-700 border-emerald-200');
        }

        const btnProf = document.getElementById('detailBtnProfile');
        if (btnProf && data.profile_url) {
            btnProf.href = data.profile_url;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.egresado-row');
        if (firstRow) firstRow.click();
    });
</script>

</body>
</html>
