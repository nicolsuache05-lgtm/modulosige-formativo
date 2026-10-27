<!-- Modules/Egresados/Resources/views/superadmin/encuestas/partials/_modal_resultados.blade.php -->
<!-- MODAL DE RESULTADOS COMPLETOS Y ESTADÍSTICAS DE ENCUESTA -->

<div x-show="openModalResultados" 
     @open-modal-resultados.window="openModalResultados = true"
     @close-modal-resultados.window="openModalResultados = false"
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openModalResultados = false"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-3 sm:p-6" 
     x-cloak>
    
    <!-- Contenedor del Modal Estilo Card Premium Institucional -->
    <div @click.away="openModalResultados = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="bg-white rounded-3xl max-w-4xl w-full shadow-2xl border border-green-100 flex flex-col max-h-[92vh] overflow-hidden">
        
        <!-- Encabezado del Modal -->
        <div class="flex items-center justify-between border-b border-gray-100 px-6 sm:px-8 py-5 bg-[#ffffff]">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-2xl bg-[#008f39] text-white flex items-center justify-center text-lg shadow-md flex-shrink-0">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
                <div>
                    <div class="text-[10.5px] font-extrabold text-[#008f39] uppercase tracking-wider">ANÁLISIS ESTADÍSTICO · SIGE CEFA</div>
                    <h3 class="text-xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2">
                        <span>Resultados de Encuesta</span>
                        <span id="modalResId" class="text-xs bg-gray-100 text-gray-700 px-2.5 py-0.5 rounded-full font-bold">ENC-025</span>
                    </h3>
                    <p class="text-xs text-gray-500 mt-0.5">
                        <span id="modalResTitle" class="font-bold text-gray-700">Inserción Laboral 2026</span> • Dirigido a: 
                        <span id="modalResTarget" class="text-emerald-800 font-bold bg-emerald-50 px-2 py-0.5 rounded-md">Egresado ADSO</span> • 
                        <span id="modalResStatus" class="font-bold text-[11px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">ACTIVA</span>
                    </p>
                </div>
            </div>
            <button @click="openModalResultados = false" type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-100 transition cursor-pointer" title="Cerrar ventana">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Modal (Área imprimible en PDF con scroll) -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-6" id="modal-area-imprimir">
            
            <!-- Encabezado Institucional Exclusivo para PDF -->
            <div id="modalPrintHeader" class="hidden p-4 bg-white rounded-2xl border border-gray-200 text-center mb-2">
                <div class="flex items-center justify-center gap-3 mb-1">
                    <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA" style="width: 32px; height: 32px; object-fit: contain;">
                    <div class="text-left">
                        <h2 class="text-base font-bold text-[#001A29] leading-tight">SENA Empresa · CEFA La Angostura</h2>
                        <p class="text-[9px] text-gray-500 font-bold uppercase tracking-wider">Sistema de Gestión de Egresados (SIGE)</p>
                    </div>
                </div>
                <p id="modalPdfSub" class="text-xs text-gray-600 mt-1 font-semibold">Reporte Consolidado de Respuestas y Métricas</p>
            </div>

            <!-- 1. KPIs de la Encuesta -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                <div class="bg-[#F8FCF9] p-4 rounded-2xl border border-emerald-100 shadow-2xs">
                    <div class="flex items-center justify-between text-blue-600 mb-1">
                        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Enviadas</span>
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                    </div>
                    <div id="modalResEnviadas" class="text-2xl font-black text-gray-900">120</div>
                    <p class="text-[10px] text-gray-400 mt-0.5">Total de egresados citados</p>
                </div>

                <div class="bg-[#F8FCF9] p-4 rounded-2xl border border-emerald-100 shadow-2xs">
                    <div class="flex items-center justify-between text-emerald-600 mb-1">
                        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Respondidas</span>
                        <i class="fa-solid fa-circle-check text-xs"></i>
                    </div>
                    <div id="modalResRespondidas" class="text-2xl font-black text-emerald-700">90</div>
                    <p class="text-[10px] text-gray-400 mt-0.5">Respuestas verificadas</p>
                </div>

                <div class="bg-[#F8FCF9] p-4 rounded-2xl border border-emerald-100 shadow-2xs">
                    <div class="flex items-center justify-between text-amber-600 mb-1">
                        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Pendientes</span>
                        <i class="fa-solid fa-clock text-xs"></i>
                    </div>
                    <div id="modalResPendientes" class="text-2xl font-black text-amber-700">30</div>
                    <p class="text-[10px] text-gray-400 mt-0.5">En proceso de diligenciamiento</p>
                </div>

                <div class="bg-[#F8FCF9] p-4 rounded-2xl border border-emerald-100 shadow-2xs border-b-4 border-b-[#008f39]">
                    <div class="flex items-center justify-between text-[#008f39] mb-1">
                        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Tasa Respuesta</span>
                        <i class="fa-solid fa-chart-line text-xs"></i>
                    </div>
                    <div id="modalResRate" class="text-2xl font-black text-[#008f39]">75%</div>
                    <p class="text-[10px] text-gray-400 mt-0.5">Efectividad de recolección</p>
                </div>
            </div>

            <!-- 2. Malla de Gráficas Profesionales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <!-- Gráfica 1: Estado Laboral -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <h4 class="text-xs sm:text-sm font-extrabold text-gray-900">¿Cuál es su estado laboral actual?</h4>
                            <p class="text-[10.5px] text-gray-500">Distribución porcentual de los egresados encuestados.</p>
                        </div>
                        <span class="w-7 h-7 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>
                    </div>
                    <div id="modal-grafica-estado-laboral" class="w-full flex justify-center py-2 min-h-[220px]"></div>
                </div>

                <!-- Gráfica 2: Rango Salarial -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <h4 class="text-xs sm:text-sm font-extrabold text-gray-900">Rango Salarial Promedio (SMMLV)</h4>
                            <p class="text-[10.5px] text-gray-500">Ingresos devengados por los egresados vinculados.</p>
                        </div>
                        <span class="w-7 h-7 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </span>
                    </div>
                    <div id="modal-grafica-salarios" class="w-full py-2 min-h-[220px]"></div>
                </div>

                <!-- Gráfica 3: Relación Programa/Empleo -->
                <div class="md:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <h4 class="text-xs sm:text-sm font-extrabold text-gray-900">Afinidad formativa con el empleo actual</h4>
                            <p class="text-[10.5px] text-gray-500">Pertinencia de las competencias adquiridas en el CEFA La Angostura.</p>
                        </div>
                        <span class="w-7 h-7 rounded-full bg-purple-50 text-purple-700 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>
                    </div>
                    <div id="modal-grafica-pertinencia" class="w-full py-2 min-h-[190px]"></div>
                </div>
            </div>

            <!-- Banner Informativo -->
            <div class="bg-[#f0faf3] border border-[#d4eedd] rounded-2xl p-4 flex items-start gap-3.5">
                <div class="w-7 h-7 rounded-full bg-[#008f39] text-white flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <div class="text-xs font-extrabold text-[#008f39]">Protección de Datos y Confidencialidad</div>
                    <p class="text-[11.5px] text-[#2c5239] mt-0.5 leading-relaxed">
                        Los resultados consolidados corresponden exclusivamente a respuestas anónimas o parametrizadas bajo la Ley 1581 de Protección de Datos Personales para fines estadísticos del SENA CEFA La Angostura.
                    </p>
                </div>
            </div>

        </div>

        <!-- Pie del Modal (Botones de Acción) -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex flex-col sm:flex-row items-center justify-end gap-3 bg-[#fbfdfc]">
            <button type="button" 
                    id="btn-modal-pdf" 
                    onclick="descargarModalResultadosPDF()" 
                    class="w-full sm:w-auto px-5 py-2.5 bg-white hover:bg-emerald-50 text-gray-700 hover:text-emerald-800 border border-gray-200 hover:border-emerald-300 text-xs font-bold rounded-xl transition shadow-2xs cursor-pointer flex items-center justify-center gap-2">
                <i class="fa-solid fa-file-pdf text-red-600 text-xs"></i>
                <span id="btn-modal-pdf-text">Descargar Reporte (PDF)</span>
            </button>
            <button type="button" 
                    @click="openModalResultados = false" 
                    class="w-full sm:w-auto px-6 py-2.5 bg-[#008f39] hover:bg-[#007a30] text-white text-xs font-extrabold rounded-xl transition shadow-md hover:shadow-lg cursor-pointer text-center">
                Cerrar
            </button>
        </div>

    </div>
</div>
