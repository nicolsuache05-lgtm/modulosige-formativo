<!-- ============================================== -->
<!-- 3. DETALLE LATERAL REACTIVO (COLUMNA DERECHA 1/3) -->
<!-- ============================================== -->
<div id="panel-resumen-pdf" class="lg:col-span-1 bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sm:p-6 sticky top-20 flex flex-col gap-5">
    
    <!-- Encabezado del Detalle -->
    <div class="flex items-center justify-between pb-3.5 border-b border-gray-100">
        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-[#39A900] animate-pulse"></span>
            Detalle de la Encuesta
        </span>
        <span id="detailStatusBadge" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10.5px] font-extrabold bg-[#dcfce7] text-[#166534] border border-[#bbf7d0] uppercase">
            ACTIVA
        </span>
    </div>

    <!-- Información General / Hero de la Encuesta -->
    <div class="space-y-2">
        <h3 id="detailSurveyTitle" class="font-editorial text-lg sm:text-xl font-bold text-[#00131E] leading-tight">
            Encuesta Inserción Laboral ADSO
        </h3>
        
        <p id="detailSurveyDesc" class="text-xs text-gray-500 leading-relaxed font-medium">
            Diagnóstico de inserción y estabilidad en el mercado de software para egresados ADSO.
        </p>

        <div class="pt-2 text-[11px] space-y-1.5 text-gray-600 border-t border-gray-50">
            <div><strong class="text-gray-400 uppercase text-[9.5px]">Código ID:</strong> <span id="detailSurveyMeta" class="font-bold text-[#00131E] font-mono ml-1">ENC-025</span></div>
            <div><strong class="text-gray-400 uppercase text-[9.5px]">Lanzamiento:</strong> <span id="detailSurveyDate" class="font-semibold text-gray-800 ml-1">12/06/2026</span></div>
            <div class="flex items-center gap-1.5 pt-0.5"><strong class="text-gray-400 uppercase text-[9.5px]">Público:</strong> <span id="detailSurveyTarget" class="font-bold text-[#166534] bg-[#EAF7EE] px-2 py-0.5 rounded-md border border-[#bbf7d0]">Egresado ADSO</span></div>
        </div>
    </div>

    <!-- Caja de Estadísticas con Identidad SENA ERP -->
    <div class="bg-[#F8FCF9] border border-emerald-100/70 rounded-xl p-4 space-y-2.5">
        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block mb-1">Indicadores de Respuesta</span>
        
        <div class="flex justify-between text-xs">
            <span class="text-gray-500 font-medium">Enviadas:</span>
            <span id="detailEnviadas" class="font-bold text-[#00131E]">120</span>
        </div>
        
        <div class="flex justify-between text-xs">
            <span class="text-gray-500 font-medium">Respondidas:</span>
            <span id="detailRespondidas" class="font-bold text-[#39A900]">90</span>
        </div>
        
        <div class="flex justify-between text-xs">
            <span class="text-gray-500 font-medium">Pendientes:</span>
            <span id="detailPendientes" class="font-bold text-amber-600">30</span>
        </div>
        
        <div class="flex justify-between text-xs pt-1.5 border-t border-gray-200/50">
            <span class="text-gray-700 font-bold">Tasa de respuesta:</span>
            <span id="detailRate" class="font-extrabold text-[#39A900] text-sm">75%</span>
        </div>

        <!-- Barra de Progreso Dinámica ERP -->
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden mt-2">
            <div id="detailProgressBar" class="bg-gradient-to-r from-[#001A29] to-[#39A900] h-2 rounded-full transition-all duration-500" style="width: 75%;"></div>
        </div>
    </div>

    <!-- Botones de Acción con Paleta SENA ERP -->
    <div id="detalleActionButtons" class="flex flex-col gap-2 pt-1" x-data="{ confirmarCierre: false }">
        <button type="button" 
                id="detailResultsBtn" 
                @click="openModalResultados = true; abrirResultadosModal();"
                class="w-full py-2.5 px-4 bg-gradient-to-r from-[#001A29] to-[#002336] hover:from-[#00131E] hover:to-[#39A900] text-white text-xs font-bold rounded-xl transition-all duration-200 flex items-center justify-center gap-2 shadow-sm cursor-pointer text-center">
            <i class="fa-solid fa-chart-pie text-xs"></i>
            <span>Ver Resultados Completos</span>
        </button>

        <button type="button" 
                id="btnDescargarResumenPDF"
                onclick="descargarResumenPDF()" 
                class="w-full py-2.5 px-4 bg-white hover:bg-[#EAF7EE] text-gray-700 hover:text-[#166534] border border-gray-200 hover:border-[#39A900]/50 text-xs font-bold rounded-xl transition duration-200 flex items-center justify-center gap-2 shadow-2xs cursor-pointer">
            <i class="fa-solid fa-file-pdf text-xs text-red-600"></i>
            <span id="btnDescargarResumenText">Descargar Reporte (PDF)</span>
        </button>

        <!-- Botón que abre la confirmación de cierre -->
        <button @click="confirmarCierre = true" 
                type="button" 
                id="btnCerrarEncuestaTrigger"
                class="w-full py-2.5 px-4 bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 text-xs font-bold rounded-xl transition duration-200 flex items-center justify-center gap-2 cursor-pointer shadow-2xs">
            <i class="fa-solid fa-ban text-xs"></i>
            <span>Cerrar Encuesta</span>
        </button>

        <!-- Modal de Confirmación Flotante con Identidad SENA ERP (Posicionado en la parte superior) -->
        <div x-show="confirmarCierre" 
             style="display: none;"
             class="fixed inset-0 z-[70] overflow-y-auto bg-gray-900/60 backdrop-blur-md flex items-start justify-center pt-16 sm:pt-20 p-4 sm:p-6" 
             x-cloak
             @keydown.window.escape="confirmarCierre = false">
            
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
                          action="{{ route('egresados.superadmin.encuestas.cerrar', 'ENC-025') }}" 
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
