<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Panel del Instructor — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
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
                        senaGreen: '#39A900',
                        senaGreenDark: '#2a7c00',
                        senaNeon: '#62E31D',
                        senaLight: '#F8FCF9',
                        ink: '#16261C',
                        inkSoft: '#6B7A70',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                        editorial: ['Fraunces', 'serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#F4F7F5] font-sans antialiased text-[#16261C] min-h-screen flex selection:bg-senaGreen selection:text-white">

    <!-- ============================================== -->
    <!-- 1. SIDEBAR INSTRUCTOR -->
    <!-- ============================================== -->
    <aside class="w-64 bg-gradient-to-b from-[#013819] to-[#012410] text-white flex flex-col justify-between p-5 border-r border-white/10 shrink-0 sticky top-0 h-screen z-30">
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
                <a href="{{ route('egresados.dashboard_instructor') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-[#39A900] text-white font-semibold text-xs shadow-md">
                    <i class="fa-solid fa-chalkboard-user w-4 text-center"></i>
                    <span>Panel de Seguimiento</span>
                </a>

                <a href="{{ route('egresados.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition">
                    <i class="fa-solid fa-address-book w-4 text-center"></i>
                    <span>Directorio Completo</span>
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

            <form action="{{ route('egresados.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-red-500/20 hover:bg-red-500/30 text-red-200 hover:text-white text-xs font-bold transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ============================================== -->
    <!-- 2. MAIN CONTENT AREA -->
    <!-- ============================================== -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- Topbar -->
        <header class="bg-white border-b border-gray-200/80 px-6 py-3.5 flex items-center justify-between sticky top-0 z-20 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div>
                    <h1 class="text-sm font-bold text-gray-800 leading-none">Módulo de Seguimiento para Instructores</h1>
                    <span class="text-[11px] text-gray-500">Gestión de aprendices egresados, estados laborales y encuestas</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    Rol: Instructor Egresados
                </span>
                <a href="{{ route('home') }}" class="text-xs font-semibold text-gray-600 hover:text-[#39A900] flex items-center gap-1.5 transition">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Portal Principal ERP</span>
                </a>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 p-6 space-y-6 overflow-y-auto">
            
            <!-- Feedback Notification Messages -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 text-xs font-semibold px-4 py-3 rounded-2xl flex items-center gap-2.5 shadow-sm">
                    <i class="fa-solid fa-circle-check text-green-600 text-base"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Top Metric Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <div class="bg-white p-5 rounded-2xl border border-gray-200/70 shadow-sm flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Egresados Fichas</div>
                        <div class="font-editorial text-2xl font-bold text-[#012410] mt-1">{{ number_format($totalEgresados) }}</div>
                        <div class="text-[11px] text-green-700 font-semibold mt-0.5">Bajo seguimiento</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-green-50 text-[#0d6928] flex items-center justify-center text-xl">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200/70 shadow-sm flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Vinculados (Empleo)</div>
                        <div class="font-editorial text-2xl font-bold text-[#012410] mt-1">{{ number_format($totalEmpleados) }}</div>
                        <div class="text-[11px] text-blue-700 font-semibold mt-0.5">Empresas del sector</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200/70 shadow-sm flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Emprendedores</div>
                        <div class="font-editorial text-2xl font-bold text-[#012410] mt-1">{{ number_format($totalEmprendedores) }}</div>
                        <div class="text-[11px] text-amber-700 font-semibold mt-0.5">Fondo Emprender / Negocios</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-rocket"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200/70 shadow-sm flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Formación Continua</div>
                        <div class="font-editorial text-2xl font-bold text-[#012410] mt-1">{{ number_format($totalEstudiantes) }}</div>
                        <div class="text-[11px] text-purple-700 font-semibold mt-0.5">Cursos complementarios</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-award"></i>
                    </div>
                </div>

            </div>

            <!-- Main Panel: Filtros & Tabla de Egresados Asignados -->
            <div class="bg-white rounded-2xl border border-gray-200/70 shadow-sm overflow-hidden">
                
                <!-- Card Header with Search & Filter by Course -->
                <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="font-editorial text-lg font-bold text-[#012410]">Seguimiento de Egresados por Ficha</h2>
                        <p class="text-xs text-gray-500">Visualiza la información de contacto y situación ocupacional de los egresados.</p>
                    </div>

                    <form action="{{ route('egresados.dashboard_instructor') }}" method="GET" class="flex flex-wrap items-center gap-2">
                        <select name="course_id" onchange="this.form.submit()" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 focus:bg-white focus:border-[#39A900] outline-none">
                            <option value="">-- Todos los cursos / fichas --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    Ficha {{ $course->code }} {{ $course->program ? '· ' . Str::limit($course->program->name, 25) : '' }}
                                </option>
                            @endforeach
                        </select>

                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar egresado..." 
                                class="pl-8 pr-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 font-medium focus:bg-white focus:border-[#39A900] outline-none">
                            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                        </div>

                        <button type="submit" class="bg-[#39A900] hover:bg-[#2a7c00] text-white px-3.5 py-2 rounded-xl text-xs font-bold transition">
                            Filtrar
                        </button>

                        @if(request('course_id') || request('search'))
                            <a href="{{ route('egresados.dashboard_instructor') }}" class="text-xs text-gray-500 hover:text-red-500 font-semibold px-2 py-2">
                                <i class="fa-solid fa-xmark"></i> Limpiar
                            </a>
                        @endif
                    </form>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50/80 text-gray-600 font-bold uppercase tracking-wider text-[10px] border-b border-gray-100">
                            <tr>
                                <th class="py-3.5 px-5">Egresado(a)</th>
                                <th class="py-3.5 px-4">Documento</th>
                                <th class="py-3.5 px-4">Programa / Ficha</th>
                                <th class="py-3.5 px-4">Contacto</th>
                                <th class="py-3.5 px-4">Estado Ocupacional</th>
                                <th class="py-3.5 px-4 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                            @forelse($egresadosSeguimiento as $egresado)
                                <tr class="hover:bg-green-50/30 transition">
                                    <td class="py-3.5 px-5 font-bold text-gray-900">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-8 h-8 rounded-full bg-green-100 text-[#0d6928] flex items-center justify-center font-bold text-xs shrink-0">
                                                {{ $egresado->person ? strtoupper(substr($egresado->person->first_name, 0, 1) . substr($egresado->person->first_last_name, 0, 1)) : 'EG' }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-800">
                                                    {{ $egresado->person ? $egresado->person->first_name . ' ' . $egresado->person->first_last_name . ' ' . ($egresado->person->second_last_name ?? '') : 'Aprendiz Egresado #' . $egresado->id }}
                                                </div>
                                                <span class="text-[10px] text-gray-400">ID Aprendiz: #{{ $egresado->id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4 font-semibold text-gray-600">
                                        {{ $egresado->person->document_number ?? 'No registra' }}
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="font-bold text-gray-800 d-block">
                                            {{ $egresado->course && $egresado->course->program ? Str::limit($egresado->course->program->name, 28) : 'Programa CEFA' }}
                                        </span>
                                        <span class="text-[10px] text-gray-500">Ficha: {{ $egresado->course->code ?? 'N/A' }}</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="text-[11px] text-gray-700">{{ $egresado->person->misena_email ?? $egresado->person->personal_email ?? 'Sin correo' }}</div>
                                        <div class="text-[10px] text-gray-400"><i class="fa-solid fa-phone text-[9px] me-1"></i>{{ $egresado->person->telephone1 ?? 'Sin teléfono' }}</div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @php
                                            $st = $egresado->apprentice_status ?? 'CERTIFICADO';
                                            $badgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                            if($st === 'EN FORMACIÓN') $badgeClass = 'bg-blue-50 text-blue-700 border-blue-200';
                                            elseif($st === 'INDUCCIÓN') $badgeClass = 'bg-amber-50 text-amber-700 border-amber-200';
                                            elseif($st === 'CONDICIONADO') $badgeClass = 'bg-purple-50 text-purple-700 border-purple-200';
                                        @endphp
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-extrabold border {{ $badgeClass }}">
                                            {{ $st }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <button type="button" onclick="alert('Registrando seguimiento para {{ $egresado->person ? $egresado->person->first_name : 'Egresado' }}');" 
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 text-[11px] font-bold transition">
                                            <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                            <span>Seguimiento</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-gray-400">
                                        <i class="fa-solid fa-folder-open text-2xl mb-2 text-gray-300"></i>
                                        <div>No se encontraron registros de egresados para los criterios seleccionados.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($egresadosSeguimiento->hasPages())
                    <div class="p-4 border-t border-gray-100">
                        {{ $egresadosSeguimiento->links() }}
                    </div>
                @endif

            </div>

        </main>
    </div>

</body>
</html>
