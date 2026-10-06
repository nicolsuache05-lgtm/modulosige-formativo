<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Editar {{ $evento['title'] ?? 'Evento' }} — CEFA</title>

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
    
    <!-- Topbar -->
    <header class="bg-[#001A29] text-white px-6 py-3.5 flex items-center justify-between border-b border-[#39A900]/30 sticky top-0 z-30 shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ route('egresados.superadmin.eventos.index') }}" class="w-9 h-9 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition cursor-pointer" title="Volver">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <span class="text-xs text-emerald-300 font-semibold tracking-wide uppercase">Edición de Evento</span>
                <h1 class="text-base sm:text-lg font-bold font-editorial text-white flex items-center gap-2">
                    <span>{{ $evento['title'] ?? 'Evento' }}</span>
                    <span class="text-xs px-2.5 py-0.5 rounded-full bg-[#39A900] text-white font-sans font-bold">{{ $evento['id'] ?? 'EVT' }}</span>
                </h1>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto w-full p-4 sm:p-6 lg:p-8 flex-1">
        
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8">
            
            <div class="border-b border-gray-100 pb-4 mb-6">
                <h2 class="text-xl font-bold font-editorial text-[#00131E]">Modificar Datos del Evento</h2>
                <p class="text-xs text-gray-500 mt-1">Actualice los detalles logísticos, capacidad y alcance del evento institucional.</p>
            </div>

            @if(isset($errors) && $errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-xs font-semibold">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('egresados.superadmin.eventos.update', ['id' => $evento['id'] ?? 'EVT-012']) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Sección 1: Información General -->
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-50">1. Datos Principales</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Nombre del Evento</label>
                            <input type="text" name="title" value="{{ old('title', $evento['title'] ?? '') }}" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Tipo de Evento</label>
                            <input type="text" name="type" value="{{ old('type', $evento['type'] ?? '') }}" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition" placeholder="Ej. Feria laboral, Taller práctico">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Estado</label>
                            <select name="status" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition">
                                <option value="PROGRAMADO" {{ (strtoupper($evento['status'] ?? '') === 'PROGRAMADO') ? 'selected' : '' }}>PROGRAMADO</option>
                                <option value="REALIZADO" {{ (strtoupper($evento['status'] ?? '') === 'REALIZADO') ? 'selected' : '' }}>REALIZADO</option>
                                <option value="EN CURSO" {{ (strtoupper($evento['status'] ?? '') === 'EN CURSO') ? 'selected' : '' }}>EN CURSO</option>
                                <option value="CANCELADO" {{ (strtoupper($evento['status'] ?? '') === 'CANCELADO') ? 'selected' : '' }}>CANCELADO</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Sección 2: Logística y Ubicación -->
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-50">2. Logística y Capacidad</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Fecha</label>
                            <input type="text" name="date" value="{{ old('date', $evento['date'] ?? '') }}" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition" placeholder="DD/MM/AAAA">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Horario</label>
                            <input type="text" name="time" value="{{ old('time', $evento['time'] ?? '') }}" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition" placeholder="08:00 AM - 04:00 PM">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Lugar / Ubicación</label>
                            <input type="text" name="location" value="{{ old('location', $evento['location'] ?? '') }}" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Cupo Máximo</label>
                            <input type="number" name="cupo" value="{{ old('cupo', $evento['cupo'] ?? 200) }}" min="1" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Programas Dirigidos</label>
                            <input type="text" name="program" value="{{ old('program', $evento['program'] ?? 'Todos los Programas') }}" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Responsable / Área</label>
                            <input type="text" name="responsible" value="{{ old('responsible', $evento['responsible'] ?? 'Coordinación Académica') }}" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition">
                        </div>
                    </div>
                </div>

                <!-- Sección 3: Descripción -->
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-50">3. Descripción del Evento</h3>
                    <textarea name="description" rows="4" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition resize-none">{{ old('description', $evento['description'] ?? '') }}</textarea>
                </div>

                <!-- Botones de Acción -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('egresados.superadmin.eventos.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                        Cancelar
                    </a>
                    <button type="submit" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Guardar Cambios</span>
                    </button>
                </div>
            </form>

        </div>

    </main>
</div>

</body>
</html>
