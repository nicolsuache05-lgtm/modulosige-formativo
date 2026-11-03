<!-- ============================================== -->
<!-- 3. DETALLE LATERAL DE LA ENCUESTA (1/3 DEL GRID - STICKY) -->
<!-- ============================================== -->
<div class="lg:col-span-1">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-4 sticky top-20" 
         x-data="{ confirmarCierre: false }">
        
        <!-- Encabezado con estado -->
        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Detalle de la Encuesta</h3>
            <span id="detailStatusBadge" class="px-2.5 py-0.5 text-[10px] font-semibold rounded-md bg-emerald-50 text-emerald-700 uppercase">
                ACTIVA
            </span>
        </div>
        
        <!-- Título y metadatos principales -->
        <div>
            <h4 id="detailSurveyTitle" class="font-bold text-gray-900 text-sm">Inserción Laboral ADSO</h4>
            <p id="detailSurveyMeta" class="text-xs text-gray-500 mt-0.5">ID: ENC-025 | Fecha: 12/06/2026</p>
            <p class="text-xs text-gray-600 mt-1"><strong>Público:</strong> <span id="detailSurveyTarget" class="text-[#166534] font-semibold">Egresado ADSO</span></p>
            <p class="text-xs text-gray-600"><strong>Fecha emisión:</strong> <span id="detailSurveyDate">12/06/2026</span></p>
        </div>

        <!-- Estadísticas de respuesta con barra ERP -->
        <div class="bg-gray-50 p-3.5 rounded-xl space-y-2">
            <span class="text-[11px] font-bold text-gray-400 block uppercase tracking-wider">Estadísticas</span>
            <div class="flex justify-between text-xs text-gray-600"><span>Egresados Convocados:</span> <span id="detailEnviadas" class="font-bold text-gray-900">120</span></div>
            <div class="flex justify-between text-xs text-gray-600"><span>Cuestionarios Respondidos:</span> <span id="detailRespondidas" class="font-bold text-[#39A900]">90</span></div>
            <div class="flex justify-between text-xs text-gray-600"><span>En Trámite (Pendientes):</span> <span id="detailPendientes" class="font-bold text-gray-900">30</span></div>
            <div class="flex justify-between text-xs text-gray-600"><span>Tasa de Respuesta:</span> <span id="detailRate" class="font-bold text-emerald-700">75%</span></div>
            <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden mt-1">
                <div id="detailProgressBar" class="bg-emerald-600 h-full rounded-full transition-all duration-500" style="width: 75%"></div>
            </div>
        </div>

        <!-- Descripción y Alcance Institucional -->
        <div class="bg-gray-50 p-3.5 rounded-xl space-y-1 text-xs text-gray-600">
            <span class="text-[11px] font-bold text-gray-400 block uppercase tracking-wider mb-1">Descripción y Propósito</span>
            <p id="detailSurveyDesc" class="leading-relaxed">Diagnóstico de inserción y estabilidad en el mercado de software para egresados ADSO.</p>
        </div>

        <!-- =============== BOTONES FUNCIONALES ERP =============== -->
        <div class="space-y-2 pt-2">
            
            <!-- 1. Ver Resultados y Gráficas (Estilo SENA ERP) -->
            <button type="button" 
                    id="detailResultsBtn" 
                    @click="openModalResultados = true; abrirResultadosModal();"
                    class="w-full py-2.5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] hover:from-[#001A29] hover:to-[#00283d] text-white border border-white/10 text-xs font-bold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-solid fa-chart-pie text-[#62E31D] text-xs"></i>
                <span>Ver Resultados y Gráficas</span>
            </button>

            <!-- 2. Descargar Reporte Escrito (PDF) -->
            <button type="button" 
                    id="btnDescargarResumenPDF" 
                    onclick="descargarResumenPDF()" 
                    class="w-full py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition shadow-xs flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-solid fa-file-pdf text-red-500 text-xs"></i>
                <span id="btnDescargarResumenText">Descargar Reporte (PDF)</span>
            </button>

            <!-- 3. Cerrar Encuesta -->
            <button @click="confirmarCierre = true" 
                    type="button" 
                    id="btnCerrarEncuestaTrigger"
                    class="w-full py-2.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-xl transition flex items-center justify-center gap-2 cursor-pointer shadow-sm">
                <i class="fa-solid fa-ban text-xs"></i>
                <span>Cerrar Encuesta</span>
            </button>
        </div>

        <!-- =============== MODAL FLOTANTE DE CIERRE =============== -->
        <div x-show="confirmarCierre" 
             style="display: none;" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.window.escape="confirmarCierre = false"
             class="fixed inset-0 z-[60] overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center pt-14 sm:pt-20 p-4" 
             x-cloak>
            
            <div @click.away="confirmarCierre = false" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
                 class="relative bg-white rounded-3xl max-w-md w-full shadow-2xl border border-gray-100 overflow-hidden transform">
                
                <!-- Encabezado con Identidad SENA ERP -->
                <div class="bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] p-5 text-white border-b-2 border-[#39A900] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-red-600 text-white flex items-center justify-center font-bold text-base shadow-md shadow-black/20 flex-shrink-0">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div>
                            <div class="text-[9.5px] font-extrabold text-[#62E31D] uppercase tracking-wider">CIERRE DE INSTRUMENTO · SIGE ERP</div>
                            <h3 class="text-base font-bold text-white tracking-tight">¿Cerrar esta encuesta?</h3>
                        </div>
                    </div>
                    <button @click="confirmarCierre = false" type="button" class="text-white/70 hover:text-white p-1.5 rounded-lg hover:bg-white/10 transition cursor-pointer" title="Cerrar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Cuerpo del Modal -->
                <div class="p-6 space-y-4 text-left">
                    <div class="bg-amber-50/80 border border-amber-200/90 rounded-2xl p-4 flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0 mt-0.5 text-sm font-bold shadow-2xs">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div class="text-xs text-gray-700 leading-relaxed">
                            <span class="block font-bold text-[#00131E] text-xs mb-1">
                                Finalización de recolección de respuestas
                            </span>
                            Al cerrar la encuesta <span id="modalSurveyId" class="inline-block font-extrabold text-[#00131E] bg-white px-2 py-0.5 rounded-md border border-amber-300 shadow-2xs">ENC-025</span>, los egresados citados <strong>ya no podrán diligenciar el cuestionario</strong> ni enviar más respuestas.
                        </div>
                    </div>

                    <div class="bg-[#F8FCF9] border border-emerald-100 rounded-xl p-3 flex items-center gap-2.5 text-[11.5px] text-gray-600">
                        <i class="fa-solid fa-circle-check text-[#39A900] text-sm"></i>
                        <span>Las métricas y estadísticas actuales quedarán consolidadas y listas para reporte.</span>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="bg-gray-50/80 px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3 rounded-b-3xl">
                    <button @click="confirmarCierre = false" 
                            type="button" 
                            class="px-5 py-2.5 bg-white hover:bg-gray-100 text-gray-700 text-xs font-bold rounded-xl border border-gray-200 transition shadow-2xs cursor-pointer">
                        Cancelar
                    </button>
                    
                    <!-- Formulario real hacia el backend con método PUT -->
                    <form id="formCerrarEncuesta" 
                          action="{{ route('egresados.instructor.encuestas.cerrar', 'ENC-025') }}" 
                          method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" 
                                class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 text-white text-xs font-bold rounded-xl shadow-md shadow-red-600/20 transition cursor-pointer flex items-center gap-2 transform hover:-translate-y-0.5">
                            <i class="fa-solid fa-lock text-xs"></i>
                            <span>Sí, cerrar ahora</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
