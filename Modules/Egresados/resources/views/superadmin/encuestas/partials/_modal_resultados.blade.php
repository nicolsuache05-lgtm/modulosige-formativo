@php
    $senaLogoPath = base_path('Modules/Egresados/resources/assets/images/sena-logo.png');
    $senaLogoBase64 = file_exists($senaLogoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($senaLogoPath)) : '';
@endphp

<!-- Modules/Egresados/Resources/views/superadmin/encuestas/partials/_modal_resultados.blade.php -->
<!-- MODAL DE RESULTADOS COMPLETOS Y ESTADÍSTICAS DE ENCUESTA CON COLORES SENA ERP -->

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
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center p-3 sm:p-4 pt-3 sm:pt-5" 
     x-cloak>
    
    <!-- Contenedor del Modal Estilo Card Premium Institucional -->
    <div @click.away="openModalResultados = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="bg-white rounded-3xl max-w-4xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[96vh] overflow-hidden">
        
        <!-- Encabezado del Modal con Identidad SENA ERP -->
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center font-bold text-lg shadow-md shadow-black/20 flex-shrink-0">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
                <div>
                    <div class="text-[10px] font-extrabold text-[#62E31D] uppercase tracking-wider">ANÁLISIS ESTADÍSTICO · SIGE ERP</div>
                    <h3 class="text-lg sm:text-xl font-bold text-white tracking-tight flex items-center gap-2">
                        <span>Resultados de Encuesta</span>
                        <span id="modalResId" class="text-xs bg-white/10 text-[#62E31D] border border-white/15 px-2.5 py-0.5 rounded-full font-bold">ENC-025</span>
                    </h3>
                    <p class="text-xs text-white/70 mt-0.5 flex items-center flex-wrap gap-1.5">
                        <span id="modalResTitle" class="font-bold text-white">Inserción Laboral 2026</span>
                        <span class="text-white/40">•</span> Dirigido a: 
                        <span id="modalResTarget" class="text-[#62E31D] font-bold bg-white/10 px-2 py-0.5 rounded-md text-[11px]">Egresado ADSO</span>
                        <span class="text-white/40">•</span> 
                        <span id="modalResStatus" class="font-bold text-[10.5px] text-[#62E31D] bg-[#39A900]/25 border border-[#39A900]/40 px-2.5 py-0.5 rounded-full">ACTIVA</span>
                    </p>
                </div>
            </div>
            <button @click="openModalResultados = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Modal (Área imprimible en PDF con scroll) -->
        <div class="px-5 sm:px-6 py-3.5 overflow-y-auto space-y-3 bg-[#f8fafc]/80" id="modal-area-imprimir">
            
            <!-- Encabezado Institucional Exclusivo para PDF (Elegante y Oficial SENA) -->
            <div id="modalPrintHeader" class="hidden bg-white rounded-2xl border-2 border-gray-200 overflow-hidden mb-2 shadow-xs" style="page-break-inside: avoid; break-inside: avoid;">
                <div class="bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] p-3.5 text-white flex items-center justify-between border-b-2 border-[#39A900]">
                    <div class="flex items-center gap-3">
                        <img src="{{ $senaLogoBase64 ?: route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA" style="width: 38px; height: 38px; object-fit: contain; background: white; border-radius: 10px; padding: 3px;">
                        <div>
                            <div class="text-[8.5px] font-extrabold text-[#62E31D] uppercase tracking-wider">SERVICIO NACIONAL DE APRENDIZAJE · SENA EMPRESA</div>
                            <h2 class="text-sm font-black text-white leading-tight">Centro de Formación Agroindustrial La Angostura — CEFA</h2>
                            <p class="text-[9.5px] text-white/80 font-medium">Sistema Institucional de Gestión y Seguimiento a Egresados (SIGE)</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-2.5 py-0.5 bg-[#39A900] text-white text-[9px] font-black rounded uppercase tracking-wider">REPORTE OFICIAL</span>
                        <div class="text-[9px] text-white/70 mt-0.5 font-semibold">Generado: {{ date('d/m/Y') }}</div>
                    </div>
                </div>

                <div class="p-2.5 bg-gray-50/90 border-t border-gray-100 flex items-center justify-between text-xs text-gray-700">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-clipboard-check text-[#39A900]"></i>
                        <span class="font-bold text-gray-900 text-[11px]" id="modalPdfSub">Reporte de Resultados de Encuesta</span>
                    </div>
                    <div class="flex items-center gap-2.5 font-semibold text-[10.5px] text-gray-600">
                        <span>Código: <strong id="modalPdfCode" class="text-gray-900 font-bold">ENC-041</strong></span>
                        <span>•</span>
                        <span>Estado: <strong class="text-[#39A900] font-bold">Consolidado Activo</strong></span>
                    </div>
                </div>
            </div>

            <!-- 1. KPIs de la Encuesta con Acentos Institucionales -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-3" style="page-break-inside: avoid; break-inside: avoid;">
                <div class="bg-white p-3 rounded-xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#001A29]">
                    <div class="flex items-center justify-between text-[#001A29] mb-0.5">
                        <span class="text-[9.5px] font-extrabold uppercase tracking-wider text-gray-500">Enviadas</span>
                        <i class="fa-solid fa-paper-plane text-[11px] text-[#001A29]"></i>
                    </div>
                    <div id="modalResEnviadas" class="text-xl font-black text-gray-900">120</div>
                    <p class="text-[9px] text-gray-400">Total egresados citados</p>
                </div>

                <div class="bg-white p-3 rounded-xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#39A900]">
                    <div class="flex items-center justify-between text-[#39A900] mb-0.5">
                        <span class="text-[9.5px] font-extrabold uppercase tracking-wider text-gray-500">Respondidas</span>
                        <i class="fa-solid fa-circle-check text-[11px] text-[#39A900]"></i>
                    </div>
                    <div id="modalResRespondidas" class="text-xl font-black text-[#39A900]">90</div>
                    <p class="text-[9px] text-gray-400">Respuestas verificadas</p>
                </div>

                <div class="bg-white p-3 rounded-xl border border-gray-200/80 shadow-xs border-l-4 border-l-amber-500">
                    <div class="flex items-center justify-between text-amber-600 mb-0.5">
                        <span class="text-[9.5px] font-extrabold uppercase tracking-wider text-gray-500">Pendientes</span>
                        <i class="fa-solid fa-clock text-[11px] text-amber-500"></i>
                    </div>
                    <div id="modalResPendientes" class="text-xl font-black text-amber-600">30</div>
                    <p class="text-[9px] text-gray-400">En proceso de respuesta</p>
                </div>

                <div class="bg-white p-3 rounded-xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#39A900]">
                    <div class="flex items-center justify-between text-[#39A900] mb-0.5">
                        <span class="text-[9.5px] font-extrabold uppercase tracking-wider text-gray-500">Tasa Respuesta</span>
                        <i class="fa-solid fa-chart-line text-[11px] text-[#39A900]"></i>
                    </div>
                    <div id="modalResRate" class="text-xl font-black text-[#39A900]">75%</div>
                    <p class="text-[9px] text-gray-400">Efectividad recolección</p>
                </div>
            </div>

            <!-- 2. Malla de Gráficas Profesionales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3" style="page-break-inside: avoid; break-inside: avoid;">
                <!-- Gráfica 1: Estado Laboral -->
                <div class="bg-white rounded-xl border border-gray-200/80 shadow-xs p-3" style="page-break-inside: avoid; break-inside: avoid;">
                    <div class="flex items-center justify-between mb-1">
                        <div>
                            <h4 class="text-xs font-bold text-[#00131E]">¿Cuál es su estado laboral actual?</h4>
                            <p class="text-[10px] text-gray-500">Distribución porcentual de los encuestados.</p>
                        </div>
                        <span class="w-7 h-7 rounded-lg bg-emerald-50 text-[#39A900] border border-emerald-100 flex items-center justify-center text-xs shadow-2xs">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>
                    </div>
                    <div id="modal-grafica-estado-laboral" class="w-full flex justify-center py-1 min-h-[160px]"></div>
                </div>

                <!-- Gráfica 2: Rango Salarial -->
                <div class="bg-white rounded-xl border border-gray-200/80 shadow-xs p-3" style="page-break-inside: avoid; break-inside: avoid;">
                    <div class="flex items-center justify-between mb-1">
                        <div>
                            <h4 class="text-xs font-bold text-[#00131E]">Rango Salarial Promedio (SMMLV)</h4>
                            <p class="text-[10px] text-gray-500">Ingresos devengados por egresados vinculados.</p>
                        </div>
                        <span class="w-7 h-7 rounded-lg bg-emerald-50 text-[#39A900] border border-emerald-100 flex items-center justify-center text-xs shadow-2xs">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </span>
                    </div>
                    <div id="modal-grafica-salarios" class="w-full py-1 min-h-[160px]"></div>
                </div>

                <!-- Gráfica 3: Relación Programa/Empleo -->
                <div class="md:col-span-2 bg-white rounded-xl border border-gray-200/80 shadow-xs p-3" style="page-break-inside: avoid; break-inside: avoid;">
                    <div class="flex items-center justify-between mb-1">
                        <div>
                            <h4 class="text-xs font-bold text-[#00131E]">Afinidad formativa con el empleo actual</h4>
                            <p class="text-[10px] text-gray-500">Pertinencia de las competencias adquiridas en el CEFA La Angostura.</p>
                        </div>
                        <span class="w-7 h-7 rounded-lg bg-emerald-50 text-[#39A900] border border-emerald-100 flex items-center justify-center text-xs shadow-2xs">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>
                    </div>
                    <div id="modal-grafica-pertinencia" class="w-full py-1 min-h-[110px]"></div>
                </div>
            </div>

            <!-- Banner Informativo Institucional -->
            <div class="bg-emerald-50/70 border border-emerald-200/80 rounded-xl p-2.5 flex items-start gap-2.5" style="page-break-inside: avoid; break-inside: avoid;">
                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-[10px] font-bold flex-shrink-0 mt-0.5 shadow-xs">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <div class="text-[11px] font-bold text-[#00131E]">Protección de Datos y Confidencialidad</div>
                    <p class="text-[10px] text-gray-600 mt-0.5 leading-tight">
                        Los resultados consolidados corresponden exclusivamente a respuestas anónimas o parametrizadas bajo la Ley 1581 de Protección de Datos Personales para fines estadísticos del SENA CEFA La Angostura.
                    </p>
                </div>
            </div>

        </div>

        <!-- Pie del Modal (Botones Institucionales ERP) -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex flex-col sm:flex-row items-center justify-end gap-3 bg-gray-50/70 rounded-b-3xl">
            <button type="button" 
                    id="btn-modal-pdf" 
                    onclick="descargarModalResultadosPDF()" 
                    class="w-full sm:w-auto px-5 py-2.5 bg-white hover:bg-gray-100 text-gray-700 border border-gray-200 text-xs font-bold rounded-xl transition shadow-sm cursor-pointer flex items-center justify-center gap-2">
                <i class="fa-solid fa-file-pdf text-red-600 text-xs"></i>
                <span id="btn-modal-pdf-text">Descargar Reporte (PDF)</span>
            </button>
            <button type="button" 
                    @click="openModalResultados = false" 
                    class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-[#001A29] to-[#39A900] hover:from-[#00131E] hover:to-[#2e8b00] text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-950/20 transition cursor-pointer text-center transform hover:-translate-y-0.5">
                Cerrar
            </button>
        </div>

    </div>
</div>
