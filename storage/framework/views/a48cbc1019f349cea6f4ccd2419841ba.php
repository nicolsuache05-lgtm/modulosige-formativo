<!-- ============================================== -->
<!-- 2. TABLA DE ENCUESTAS (COLUMNA IZQUIERDA 2/3) -->
<!-- ============================================== -->
<div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
    
    <!-- Toolbar de Búsqueda y Filtros con Colores SENA ERP -->
    <div class="p-4 sm:p-5 border-b border-gray-100 bg-[#FAFCF9] flex flex-wrap items-center justify-between gap-3">
        
        <!-- Buscador -->
        <div class="relative flex-1 min-w-[220px]">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
            <input type="text" 
                   id="surveySearchInput" 
                   onkeyup="filterSurveysTable()" 
                   placeholder="Buscar encuesta por ID, título o público..." 
                   class="w-full pl-9 pr-4 py-2.5 text-xs sm:text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
        </div>

        <!-- Filtro por Estado -->
        <select id="surveyStatusFilter" 
                onchange="filterSurveysTable()" 
                class="px-3.5 py-2.5 text-xs sm:text-sm font-semibold bg-white border border-gray-200 rounded-xl text-gray-700 outline-none focus:border-[#39A900] cursor-pointer">
            <option value="">-- Todos los Estados --</option>
            <option value="ACTIVA">Activas</option>
            <option value="CERRADA">Cerradas</option>
            <option value="BORRADOR">Borrador</option>
        </select>

    </div>

    <!-- Contenedor con Scroll Horizontal -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs sm:text-sm border-collapse" id="encuestasTable">
            <thead>
                <tr class="bg-[#FAFCF9] text-[#00131E] text-[11px] font-extrabold uppercase tracking-wider border-b-2 border-gray-200">
                    <th class="py-3.5 px-4 sm:px-5">Código ID</th>
                    <th class="py-3.5 px-4 sm:px-5">Instrumento / Título</th>
                    <th class="py-3.5 px-4 sm:px-5">Estado</th>
                    <th class="py-3.5 px-4 sm:px-5">Dirigido a</th>
                    <th class="py-3.5 px-4 sm:px-5">Progreso</th>
                    <th class="py-3.5 px-4 sm:px-5 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $encuestas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $jsonData = json_encode($item);
                        $isFirst = ($index === 0);
                    ?>
                    <tr class="encuesta-row hover:bg-[#F4FAF5] transition cursor-pointer <?php echo e($isFirst ? 'selected-row bg-[#EAF7EE] border-l-4 border-[#39A900]' : ''); ?>"
                        id="survey-row-<?php echo e($item['id']); ?>"
                        data-id="<?php echo e($item['id']); ?>"
                        data-title="<?php echo e($item['title']); ?>"
                        data-status="<?php echo e($item['status']); ?>"
                        onclick="selectEncuesta(<?php echo e($jsonData); ?>, 'survey-row-<?php echo e($item['id']); ?>')">
                        
                        <!-- ID con Insignia Institucional -->
                        <td class="py-3.5 px-4 sm:px-5 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-black bg-[#EAF7EE] text-[#00131E] border border-[#39A900]/30 shadow-2xs font-mono">
                                <?php echo e($item['id']); ?>

                            </span>
                        </td>

                        <!-- Título y Autor -->
                        <td class="py-3.5 px-4 sm:px-5">
                            <div class="font-bold text-gray-900 leading-snug"><?php echo e($item['title']); ?></div>
                            <div class="flex items-center gap-1.5 mt-1">
                                <i class="fa-solid fa-user-pen text-gray-400 text-[10px]"></i>
                                <p class="text-[11px] text-gray-500">
                                    Creado por: <span class="font-semibold text-[#001A29]"><?php echo e($item['creado_por'] ?? 'Coordinación Académica'); ?></span>
                                </p>
                            </div>
                            <div class="text-[10.5px] text-gray-400 mt-0.5">Fecha: <?php echo e($item['date']); ?></div>
                        </td>

                        <!-- Estado -->
                        <td class="py-3.5 px-4 sm:px-5 whitespace-nowrap">
                            <?php if($item['status'] === 'ACTIVA'): ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#39A900]"></span>
                                    ACTIVA
                                </span>
                            <?php elseif($item['status'] === 'CERRADA'): ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-extrabold bg-gray-100 text-gray-600 border border-gray-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    CERRADA
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-extrabold bg-[#FEF3C7] text-[#92400E] border border-[#FDE68A]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    <?php echo e($item['status']); ?>

                                </span>
                            <?php endif; ?>
                        </td>

                        <!-- Dirigido a -->
                        <td class="py-3.5 px-4 sm:px-5 whitespace-nowrap">
                            <span class="inline-block px-2.5 py-0.5 rounded-lg bg-[#EAF7EE] text-[#166534] font-bold text-xs border border-[#BBF7D0]">
                                <?php echo e($item['target']); ?>

                            </span>
                        </td>

                        <!-- Barra de Progreso con Colores del ERP -->
                        <td class="py-3.5 px-4 sm:px-5 whitespace-nowrap min-w-[130px]">
                            <div class="space-y-1">
                                <div class="flex justify-between text-[11px] font-bold text-gray-700">
                                    <span><?php echo e($item['respondidas']); ?>/<?php echo e($item['enviadas']); ?></span>
                                    <span class="text-[#39A900] font-extrabold"><?php echo e($item['rate']); ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-gradient-to-r from-[#001A29] to-[#39A900] h-1.5 rounded-full transition-all duration-500" 
                                         style="width: <?php echo e($item['rate_num']); ?>%;"></div>
                                </div>
                            </div>
                        </td>

                        <!-- Acciones -->
                        <td class="py-3.5 px-4 sm:px-5 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5" onclick="event.stopPropagation();">
                                <button type="button" 
                                        onclick="selectEncuesta(<?php echo e($jsonData); ?>, 'survey-row-<?php echo e($item['id']); ?>')" 
                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:text-[#39A900] hover:bg-[#EAF7EE] border border-gray-200 hover:border-[#39A900]/40 transition shadow-2xs" 
                                        title="Ver detalles en panel lateral">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </button>
                                <button type="button" 
                                        onclick="selectEncuesta(<?php echo e($jsonData); ?>, 'survey-row-<?php echo e($item['id']); ?>'); abrirResultadosModal(<?php echo e($jsonData); ?>);" 
                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:text-white hover:bg-[#001A29] border border-gray-200 hover:border-[#001A29] transition shadow-2xs" 
                                        title="Ver Estadísticas y Resultados">
                                    <i class="fa-solid fa-chart-pie text-xs"></i>
                                </button>
                                <?php if(!empty($item['url'])): ?>
                                    <a href="<?php echo e($item['url']); ?>" 
                                       target="_blank" 
                                       class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:text-[#39A900] hover:bg-[#EAF7EE] border border-gray-200 hover:border-[#39A900]/40 transition shadow-2xs" 
                                       title="Abrir formulario externo">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-10 px-4 text-gray-500">
                            <i class="fa-regular fa-folder-open text-3xl text-gray-300 mb-2 block"></i>
                            <span class="font-bold text-gray-700 block">No se encontraron encuestas registradas</span>
                            <span class="text-xs text-gray-400">Haga clic en "+ Crear Encuesta" para registrar una nueva.</span>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules/Egresados\resources/views/superadmin/encuestas/partials/_tabla.blade.php ENDPATH**/ ?>