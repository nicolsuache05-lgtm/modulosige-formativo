<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Panel del Instructor — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(route('egresados.assets.image', 'sena-logo.png')); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(route('egresados.assets.image', 'sena-logo.png')); ?>">

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
                        forest: '#001A29',
                        forestDeep: '#00131E',
                        senaNavy: '#001A29',
                        senaNavyLight: '#002336',
                        senaDark: '#00131E',
                        senaGreen: '#39A900',
                        senaGreenDark: '#2a7c00',
                        senaNeon: '#62E31D',
                        senaLight: '#F4F7F6',
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
<body class="bg-[#F4F7F6] font-sans antialiased text-[#16261C] min-h-screen flex selection:bg-senaGreen selection:text-white">

    <!-- ============================================== -->
    <!-- 1. SIDEBAR INSTRUCTOR -->
    <!-- ============================================== -->
    <aside class="w-64 bg-gradient-to-b from-[#001A29] to-[#00131E] text-white flex flex-col justify-between p-5 border-r border-white/10 shrink-0 sticky top-0 h-screen z-30">
        <div>
            <!-- Brand Institucional -->
            <a href="<?php echo e(route('egresados.welcome')); ?>" class="flex items-center gap-3 pb-5 border-b border-white/15 no-underline text-white group">
                <div class="w-10 h-10 rounded-xl bg-white p-1 flex items-center justify-center shadow-md shrink-0 border-2 border-[#62E31D]">
                    <img src="<?php echo e(route('egresados.assets.image', 'sena-logo.png')); ?>" alt="SENA" class="w-full h-full object-cover rounded-lg">
                </div>
                <div>
                    <div class="font-editorial text-lg font-extrabold tracking-wide text-white leading-none">SIGE</div>
                    <div class="text-[10.5px] text-[#62E31D] font-bold tracking-wider uppercase mt-1">GESTIÓN DE EGRESADOS</div>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="mt-6 space-y-1.5">
                <a href="<?php echo e(route('egresados.dashboard_instructor')); ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-[#39A900] text-white font-semibold text-xs shadow-md">
                    <i class="fa-solid fa-chalkboard-user w-4 text-center"></i>
                    <span>Panel de Seguimiento</span>
                </a>

                <a href="<?php echo e(route('egresados.instructor.directorio')); ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition">
                    <i class="fa-solid fa-address-book w-4 text-center"></i>
                    <span>Directorio Completo</span>
                </a>

                <a href="<?php echo e(route('egresados.welcome')); ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100/80 hover:text-white hover:bg-white/10 font-medium text-xs transition">
                    <i class="fa-solid fa-globe w-4 text-center"></i>
                    <span>Portal Público SIGE</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- ============================================== -->
    <!-- 2. MAIN CONTENT AREA -->
    <!-- ============================================== -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-left">
                <div class="w-8 h-8 rounded-lg bg-white/10 text-white flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div>
                    <h1 class="text-sm font-bold text-white leading-none">Módulo de Seguimiento para Instructores</h1>
                    <span class="text-[11px] text-green-200/80">Gestión de aprendices egresados, estados laborales y encuestas</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 bg-white/10 text-emerald-300 text-xs font-bold px-3 py-1 rounded-full border border-white/15">
                    <span class="w-2 h-2 rounded-full bg-[#62E31D] animate-pulse"></span>
                    Rol: Instructor Egresados
                </span>
                <?php echo $__env->make('egresados::superadmin.partials._topbar_right', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 p-6 space-y-6 overflow-y-auto">
            
            <!-- Feedback Notification Messages -->
            <?php if(session('success')): ?>
                <div class="bg-green-50 border border-green-200 text-green-800 text-xs font-semibold px-4 py-3 rounded-2xl flex items-center gap-2.5 shadow-sm">
                    <i class="fa-solid fa-circle-check text-green-600 text-base"></i>
                    <span><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <!-- Top Metric Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <div class="bg-white p-5 rounded-2xl border border-gray-200/70 shadow-sm flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Egresados Fichas</div>
                        <div class="font-editorial text-2xl font-bold text-[#00131E] mt-1"><?php echo e(number_format($totalEgresados)); ?></div>
                        <div class="text-[11px] text-green-700 font-semibold mt-0.5">Bajo seguimiento</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-green-50 text-[#0d6928] flex items-center justify-center text-xl">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200/70 shadow-sm flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Vinculados (Empleo)</div>
                        <div class="font-editorial text-2xl font-bold text-[#00131E] mt-1"><?php echo e(number_format($totalEmpleados)); ?></div>
                        <div class="text-[11px] text-blue-700 font-semibold mt-0.5">Empresas del sector</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200/70 shadow-sm flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Emprendedores</div>
                        <div class="font-editorial text-2xl font-bold text-[#00131E] mt-1"><?php echo e(number_format($totalEmprendedores)); ?></div>
                        <div class="text-[11px] text-amber-700 font-semibold mt-0.5">Fondo Emprender / Negocios</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-rocket"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200/70 shadow-sm flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Formación Continua</div>
                        <div class="font-editorial text-2xl font-bold text-[#00131E] mt-1"><?php echo e(number_format($totalEstudiantes)); ?></div>
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
                        <h2 class="font-editorial text-lg font-bold text-[#00131E]">Seguimiento de Egresados por Ficha</h2>
                        <p class="text-xs text-gray-500">Visualiza la información de contacto y situación ocupacional de los egresados.</p>
                    </div>

                    <form action="<?php echo e(route('egresados.dashboard_instructor')); ?>" method="GET" class="flex flex-wrap items-center gap-2">
                        <select name="course_id" onchange="this.form.submit()" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 focus:bg-white focus:border-[#39A900] outline-none">
                            <option value="">-- Todos los cursos / fichas --</option>
                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($course->id); ?>" <?php echo e(request('course_id') == $course->id ? 'selected' : ''); ?>>
                                    Ficha <?php echo e($course->code); ?> <?php echo e($course->program ? '· ' . Str::limit($course->program->name, 25) : ''); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <div class="relative">
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar egresado..." 
                                class="pl-8 pr-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 font-medium focus:bg-white focus:border-[#39A900] outline-none">
                            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                        </div>

                        <button type="submit" class="bg-[#39A900] hover:bg-[#2a7c00] text-white px-3.5 py-2 rounded-xl text-xs font-bold transition">
                            Filtrar
                        </button>

                        <?php if(request('course_id') || request('search')): ?>
                            <a href="<?php echo e(route('egresados.dashboard_instructor')); ?>" class="text-xs text-gray-500 hover:text-red-500 font-semibold px-2 py-2">
                                <i class="fa-solid fa-xmark"></i> Limpiar
                            </a>
                        <?php endif; ?>
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
                            <?php $__empty_1 = true; $__currentLoopData = $egresadosSeguimiento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $egresado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-green-50/30 transition">
                                    <td class="py-3.5 px-5 font-bold text-gray-900">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-8 h-8 rounded-full bg-green-100 text-[#0d6928] flex items-center justify-center font-bold text-xs shrink-0">
                                                <?php echo e($egresado->person ? strtoupper(substr($egresado->person->first_name, 0, 1) . substr($egresado->person->first_last_name, 0, 1)) : 'EG'); ?>

                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-800">
                                                    <?php echo e($egresado->person ? $egresado->person->first_name . ' ' . $egresado->person->first_last_name . ' ' . ($egresado->person->second_last_name ?? '') : 'Aprendiz Egresado #' . $egresado->id); ?>

                                                </div>
                                                <span class="text-[10px] text-gray-400">ID Aprendiz: #<?php echo e($egresado->id); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4 font-semibold text-gray-600">
                                        <?php echo e($egresado->person->document_number ?? 'No registra'); ?>

                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="font-bold text-gray-800 d-block">
                                            <?php echo e($egresado->course && $egresado->course->program ? Str::limit($egresado->course->program->name, 28) : 'Programa CEFA'); ?>

                                        </span>
                                        <span class="text-[10px] text-gray-500">Ficha: <?php echo e($egresado->course->code ?? 'N/A'); ?></span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="text-[11px] text-gray-700"><?php echo e($egresado->person->misena_email ?? $egresado->person->personal_email ?? 'Sin correo'); ?></div>
                                        <div class="text-[10px] text-gray-400"><i class="fa-solid fa-phone text-[9px] me-1"></i><?php echo e($egresado->person->telephone1 ?? 'Sin teléfono'); ?></div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <?php
                                            $st = $egresado->apprentice_status ?? 'CERTIFICADO';
                                            $badgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                            if($st === 'EN FORMACIÓN') $badgeClass = 'bg-blue-50 text-blue-700 border-blue-200';
                                            elseif($st === 'INDUCCIÓN') $badgeClass = 'bg-amber-50 text-amber-700 border-amber-200';
                                            elseif($st === 'CONDICIONADO') $badgeClass = 'bg-purple-50 text-purple-700 border-purple-200';
                                        ?>
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-extrabold border <?php echo e($badgeClass); ?>">
                                            <?php echo e($st); ?>

                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <button type="button" onclick="alert('Registrando seguimiento para <?php echo e($egresado->person ? $egresado->person->first_name : 'Egresado'); ?>');" 
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 text-[11px] font-bold transition">
                                            <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                            <span>Seguimiento</span>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-gray-400">
                                        <i class="fa-solid fa-folder-open text-2xl mb-2 text-gray-300"></i>
                                        <div>No se encontraron registros de egresados para los criterios seleccionados.</div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if($egresadosSeguimiento->hasPages()): ?>
                    <div class="p-4 border-t border-gray-100">
                        <?php echo e($egresadosSeguimiento->links()); ?>

                    </div>
                <?php endif; ?>

            </div>

        </main>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\Egresados\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>