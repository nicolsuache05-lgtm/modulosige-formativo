<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · {{ $evento['title'] ?? 'Detalle del Evento' }} — CEFA</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS & Alpine.js -->
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
      }
      .font-editorial { font-family: 'Fraunces', serif; }
      [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F4F7F6] text-gray-800">

<div class="min-h-screen flex flex-col">
    
    <!-- Topbar Institucional -->
    <header class="bg-[#001A29] text-white px-6 py-3.5 flex items-center justify-between border-b border-[#39A900]/30 sticky top-0 z-30 shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ route('egresados.superadmin.eventos.index') }}" class="w-9 h-9 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition cursor-pointer" title="Volver">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <span class="text-xs text-emerald-300 font-semibold tracking-wide uppercase">Detalle del Evento Institucional</span>
                <h1 class="text-base sm:text-lg font-bold font-editorial text-white flex items-center gap-2">
                    <span>{{ $evento['title'] ?? 'Evento' }}</span>
                    <span class="text-xs px-2.5 py-0.5 rounded-full bg-[#39A900] text-white font-sans font-bold">{{ $evento['id'] ?? 'EVT' }}</span>
                </h1>
            </div>
        </div>

        <div class="flex items-center gap-2.5">
            <a href="{{ route('egresados.superadmin.eventos.edit', ['id' => $evento['id'] ?? 'EVT-012']) }}" class="px-3.5 py-1.5 bg-white/10 hover:bg-white/20 text-white text-xs font-semibold rounded-xl transition inline-flex items-center gap-1.5 cursor-pointer">
                <i class="fa-solid fa-pen-to-square text-xs"></i>
                <span>Editar</span>
            </a>
            <a href="{{ route('egresados.superadmin.eventos.exportar', ['id' => $evento['id'] ?? 'EVT-012']) }}" class="px-3.5 py-1.5 bg-[#39A900] hover:bg-[#2a7c00] text-white text-xs font-semibold rounded-xl transition inline-flex items-center gap-1.5 cursor-pointer shadow-xs">
                <i class="fa-solid fa-file-excel text-xs"></i>
                <span>Exportar Asistentes</span>
            </a>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="max-w-7xl mx-auto w-full p-4 sm:p-6 lg:p-8 space-y-6 flex-1">
        
        <!-- Tarjeta Hero de Información Principal -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-xs relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-50/50 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6 relative z-10">
                <div class="space-y-3 max-w-3xl">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                            {{ $evento['type'] ?? 'Evento General' }}
                        </span>
                        @php
                            $status = strtoupper($evento['status'] ?? 'PROGRAMADO');
                            $statusColor = match($status) {
                                'REALIZADO' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'PROGRAMADO' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'EN CURSO' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'CANCELADO' => 'bg-red-50 text-red-700 border-red-200',
                                default => 'bg-gray-50 text-gray-700 border-gray-200',
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColor }}">
                            {{ $status }}
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-bold font-editorial text-[#00131E] leading-tight">
                        {{ $evento['title'] ?? 'Evento Institucional' }}
                    </h2>

                    <p class="text-sm text-gray-600 leading-relaxed">
                        {{ $evento['description'] ?? 'Sin descripción disponible para este evento.' }}
                    </p>
                </div>

                <!-- Resumen de Métricas de Asistencia -->
                <div class="bg-[#FAFCF9] border border-gray-100 rounded-2xl p-5 min-w-[260px] space-y-3">
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-gray-400 block">Capacidad y Registro</span>
                    
                    <div class="flex items-baseline justify-between">
                        <span class="text-3xl font-bold font-editorial text-[#00131E]">{{ $evento['registrados'] ?? 0 }}</span>
                        <span class="text-xs text-gray-500">de {{ $evento['cupo'] ?? 200 }} cupos</span>
                    </div>

                    <div class="w-full bg-gray-200 h-2.5 rounded-full overflow-hidden">
                        <div class="bg-gradient-to-r from-[#001A29] to-[#39A900] h-full rounded-full" style="width: {{ $evento['rate_num'] ?? 0 }}%"></div>
                    </div>

                    <div class="flex justify-between text-xs text-gray-500 pt-1">
                        <span>Tasa de ocupación: <strong class="text-emerald-700">{{ $evento['rate'] ?? '0%' }}</strong></span>
                        <span>Pendientes: <strong>{{ $evento['pendientes'] ?? 0 }}</strong></span>
                    </div>
                </div>
            </div>

            <!-- Grilla de Atributos Logísticos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-8 pt-6 border-t border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                        <i class="fa-regular fa-calendar-check"></i>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wide block">Fecha & Hora</span>
                        <span class="text-xs font-semibold text-gray-800">{{ $evento['date'] ?? 'N/A' }} | {{ $evento['time'] ?? '08:00 AM' }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wide block">Lugar / Ubicación</span>
                        <span class="text-xs font-semibold text-gray-800">{{ $evento['location'] ?? 'Auditorio Principal CEFA' }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wide block">Programas Dirigidos</span>
                        <span class="text-xs font-semibold text-gray-800">{{ $evento['program'] ?? 'Todos los Programas' }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wide block">Responsable</span>
                        <span class="text-xs font-semibold text-gray-800">{{ $evento['responsible'] ?? 'Coordinación Académica' }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Listado de Egresados Registrados / Asistentes -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-[#FAFCF9]">
                <div>
                    <h3 class="text-base font-bold font-editorial text-gray-900">Listado de Asistentes Inscritos</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Egresados vinculados y registrados a la fecha.</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('egresados.superadmin.eventos.exportar', ['id' => $evento['id'] ?? 'EVT-012']) }}" class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold rounded-xl transition shadow-xs inline-flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-download text-xs"></i>
                        <span>Descargar Excel (.csv)</span>
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm border-collapse">
                    <thead>
                        <tr class="bg-[#FAFCF9] border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            <th class="py-3 px-4">#</th>
                            <th class="py-3 px-4">Egresado</th>
                            <th class="py-3 px-4">Documento</th>
                            <th class="py-3 px-4">Programa</th>
                            <th class="py-3 px-4">Contacto</th>
                            <th class="py-3 px-4">Estado</th>
                            <th class="py-3 px-4 text-center">Asistencia</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @if(isset($asistentes) && $asistentes->isNotEmpty())
                            @foreach($asistentes as $idx => $asistente)
                                @php $person = $asistente->person; @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-3 px-4 font-bold text-gray-400 text-xs">{{ $idx + 1 }}</td>
                                    <td class="py-3 px-4">
                                        <div class="font-bold text-gray-900">{{ $person ? ($person->first_name . ' ' . $person->first_last_name) : 'Egresado SENA ' . ($idx + 1) }}</div>
                                        <div class="text-[11px] text-gray-400">{{ $person ? ($person->misena_email ?? $person->personal_email) : 'egresado@sena.edu.co' }}</div>
                                    </td>
                                    <td class="py-3 px-4 font-mono text-xs text-gray-600">
                                        {{ $person ? ($person->document_type . ' ' . $person->document_number) : 'CC 1075' . (300000 + $idx) }}
                                    </td>
                                    <td class="py-3 px-4 text-xs text-gray-700">
                                        {{ $evento['program'] ?? 'ADSO' }}
                                    </td>
                                    <td class="py-3 px-4 text-xs text-gray-600">
                                        {{ $person ? ($person->telephone1 ?? '315' . rand(1000000, 9999999)) : '315' . (4000000 + $idx) }}
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Confirmado
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <input type="checkbox" checked class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @for($i = 1; $i <= 6; $i++)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-3 px-4 font-bold text-gray-400 text-xs">{{ $i }}</td>
                                    <td class="py-3 px-4">
                                        <div class="font-bold text-gray-900">Egresado Registrado {{ $i }}</div>
                                        <div class="text-[11px] text-gray-400">asistente.{{ $i }}@soy.sena.edu.co</div>
                                    </td>
                                    <td class="py-3 px-4 font-mono text-xs text-gray-600">CC 1075{{ 200000 + $i }}</td>
                                    <td class="py-3 px-4 text-xs text-gray-700">{{ $evento['program'] ?? 'Tecnología en ADSO' }}</td>
                                    <td class="py-3 px-4 text-xs text-gray-600">31{{ $i }} 456 7890</td>
                                    <td class="py-3 px-4">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Confirmado
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <input type="checkbox" checked class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                                    </td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

</body>
</html>
