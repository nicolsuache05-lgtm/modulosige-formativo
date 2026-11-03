<!-- Modules/Egresados/Resources/views/superadmin/reportes/partials/_modal_graficas.blade.php -->
<!-- VENTANA MODAL DE ANÁLISIS GRÁFICO E INDICADORES DE REPORTES -->

<div x-show="openModalGraficas" 
     @open-modal-graficas.window="openModalGraficas = true"
     @close-modal-graficas.window="openModalGraficas = false"
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openModalGraficas = false"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-3 sm:p-6" 
     x-cloak>
    
    <!-- Contenedor del Modal Estilo Card Premium Institucional -->
    <div @click.away="openModalGraficas = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="bg-white rounded-3xl max-w-4xl w-full shadow-2xl border border-green-100 flex flex-col max-h-[92vh] overflow-hidden">
        
        <!-- Encabezado del Modal con Ícono Verde -->
        <div class="flex items-center justify-between border-b border-gray-100 px-6 sm:px-8 py-5 bg-[#ffffff]">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-2xl bg-[#008f39] text-white flex items-center justify-center text-lg shadow-md flex-shrink-0">
                    <i class="fa-solid fa-chart-column"></i>
                </div>
                <div>
                    <div class="text-[10.5px] font-extrabold text-[#008f39] uppercase tracking-wider">MÉTRICAS & INDICADORES · SIGE CEFA</div>
                    <h3 class="text-xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2">
                        <span>Análisis Gráfico del Reporte</span>
                        <span id="modalReportIdBadge" class="text-xs bg-gray-100 text-gray-700 px-2.5 py-0.5 rounded-full font-bold">REP_002</span>
                    </h3>
                    <p class="text-xs text-gray-500 mt-0.5">
                        <span id="modalReportTitle" class="font-bold text-gray-700">Reporte de Empleabilidad ADSO</span> • Programa: 
                        <span id="modalReportProgram" class="text-emerald-800 font-bold bg-emerald-50 px-2 py-0.5 rounded-md">ADSO</span> • Fecha: 
                        <span id="modalReportDate" class="text-gray-600 font-medium">12/06/2026</span>
                    </p>
                </div>
            </div>
            <button @click="openModalGraficas = false" type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-100 transition cursor-pointer" title="Cerrar ventana">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Modal (Con scroll suave) -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-6">
            
            <!-- 1. KPIs Rápidos del Reporte -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                <div class="bg-[#F8FCF9] p-4 rounded-2xl border border-emerald-100 shadow-2xs">
                    <div class="flex items-center justify-between text-blue-600 mb-1">
                        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Muestra Base</span>
                        <i class="fa-solid fa-users text-xs"></i>
                    </div>
                    <div id="modalReportTotal" class="text-2xl font-black text-gray-900">350</div>
                    <p class="text-[10px] text-gray-400 mt-0.5">Egresados en el reporte</p>
                </div>

                <div class="bg-[#F8FCF9] p-4 rounded-2xl border border-emerald-100 shadow-2xs">
                    <div class="flex items-center justify-between text-emerald-600 mb-1">
                        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Vinculados</span>
                        <i class="fa-solid fa-briefcase text-xs"></i>
                    </div>
                    <div id="modalReportEmpleados" class="text-2xl font-black text-emerald-700">280</div>
                    <p class="text-[10px] text-gray-400 mt-0.5">Empleo activo formal</p>
                </div>

                <div class="bg-[#F8FCF9] p-4 rounded-2xl border border-emerald-100 shadow-2xs">
                    <div class="flex items-center justify-between text-amber-600 mb-1">
                        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">En Búsqueda</span>
                        <i class="fa-solid fa-hourglass-half text-xs"></i>
                    </div>
                    <div id="modalReportDesempleados" class="text-2xl font-black text-amber-700">70</div>
                    <p class="text-[10px] text-gray-400 mt-0.5">En proceso de inserción</p>
                </div>

                <div class="bg-[#F8FCF9] p-4 rounded-2xl border border-emerald-100 shadow-2xs border-b-4 border-b-[#008f39]">
                    <div class="flex items-center justify-between text-[#008f39] mb-1">
                        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Empleabilidad</span>
                        <i class="fa-solid fa-chart-line text-xs"></i>
                    </div>
                    <div id="modalReportRate" class="text-2xl font-black text-[#008f39]">80%</div>
                    <p class="text-[10px] text-gray-400 mt-0.5">Meta institucional cumplida</p>
                </div>
            </div>

            <!-- 2. Gráficas Profesionales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <!-- Gráfica 1: Situación Ocupacional -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <h4 class="text-xs sm:text-sm font-extrabold text-gray-900">Situación Ocupacional de Egresados</h4>
                            <p class="text-[10.5px] text-gray-500">Distribución porcentual de los egresados evaluados.</p>
                        </div>
                        <span class="w-7 h-7 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-chart-pie"></i>
                        </span>
                    </div>
                    <div id="modal-report-chart-ocupacion" class="w-full flex justify-center py-2 min-h-[240px]"></div>
                </div>

                <!-- Gráfica 2: Egresados por Programa -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <h4 class="text-xs sm:text-sm font-extrabold text-gray-900">Comparativa por Programa Formativo</h4>
                            <p class="text-[10.5px] text-gray-500">Densidad de egresados vinculados al CEFA La Angostura.</p>
                        </div>
                        <span class="w-7 h-7 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>
                    </div>
                    <div id="modal-report-chart-programas" class="w-full py-2 min-h-[240px]"></div>
                </div>
            </div>

            <!-- 3. Ficha Técnica y Filtros Aplicados -->
            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-4 sm:p-5">
                <div class="flex items-center justify-between mb-3 border-b border-gray-200/60 pb-2">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-sliders text-emerald-600 text-xs"></i>
                        <span class="text-xs font-bold text-gray-800">Parámetros del Reporte</span>
                    </div>
                    <span id="modalReportGeneratedBy" class="text-[11px] text-gray-500 font-semibold">Generado por: Coordinación Académica</span>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                    <div>
                        <span class="text-gray-400 font-medium block text-[10.5px]">Programa:</span>
                        <span id="modalReportParamProgram" class="font-bold text-gray-800">ADSO</span>
                    </div>
                    <div>
                        <span class="text-gray-400 font-medium block text-[10.5px]">Ficha:</span>
                        <span id="modalReportParamFicha" class="font-bold text-gray-800">Todas las activas</span>
                    </div>
                    <div>
                        <span class="text-gray-400 font-medium block text-[10.5px]">Regional / Centro:</span>
                        <span class="font-bold text-gray-800">CEFA La Angostura</span>
                    </div>
                    <div>
                        <span class="text-gray-400 font-medium block text-[10.5px]">Formato Base:</span>
                        <span id="modalReportParamFormat" class="font-bold text-emerald-700">EXCEL (.XLSX)</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pie del Modal con Botones -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex flex-col sm:flex-row items-center justify-end gap-3 bg-[#fbfdfc]">
            <a id="modalReportBtnExcel" 
               href="#" 
               class="w-full sm:w-auto px-5 py-2.5 bg-white hover:bg-emerald-50 text-gray-700 hover:text-emerald-800 border border-gray-200 hover:border-emerald-300 text-xs font-bold rounded-xl transition shadow-2xs flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-solid fa-file-excel text-emerald-600 text-xs"></i>
                <span>Descargar Excel</span>
            </a>

            <a id="modalReportBtnPdf" 
               href="#" 
               class="w-full sm:w-auto px-5 py-2.5 bg-white hover:bg-red-50 text-gray-700 hover:text-red-800 border border-gray-200 hover:border-red-300 text-xs font-bold rounded-xl transition shadow-2xs flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-solid fa-file-pdf text-red-600 text-xs"></i>
                <span>Descargar PDF</span>
            </a>

            <button type="button" 
                    @click="openModalGraficas = false" 
                    class="w-full sm:w-auto px-6 py-2.5 bg-[#008f39] hover:bg-[#007a30] text-white text-xs font-extrabold rounded-xl transition shadow-md hover:shadow-lg cursor-pointer text-center">
                Cerrar
            </button>
        </div>

    </div>
</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules/Egresados\resources/views/superadmin/reportes/partials/_modal_graficas.blade.php ENDPATH**/ ?>