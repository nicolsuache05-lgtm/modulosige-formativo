<!-- ============================================== -->
<!-- 3. DETALLE LATERAL REACTIVO (COLUMNA DERECHA 1/3) -->
<!-- ============================================== -->
<div id="panel-resumen-pdf" class="lg:col-span-1 bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sm:p-6 sticky top-20 flex flex-col gap-5">
    
    <!-- Encabezado del Detalle -->
    <div class="flex items-center justify-between pb-3.5 border-b border-gray-100">
        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            Detalle de la Encuesta
        </span>
        <span id="detailStatusBadge" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200 uppercase">
            ACTIVA
        </span>
    </div>

    <!-- Encabezado Institucional Exclusivo para PDF -->
    <div id="detalle-print-header" class="hidden pb-2 mb-1 border-b border-gray-200 text-center">
        <div class="flex items-center justify-center gap-2 mb-1">
            <img src="{{ route('egresados.assets.image', 'sena-logo.png') }}" alt="Logo SENA" style="width: 28px; height: 28px; object-fit: contain;">
            <div class="text-left">
                <span class="text-xs font-bold text-[#00131E] block font-editorial">SENA Empresa · CEFA La Angostura</span>
                <span class="text-[9px] text-gray-500 font-semibold uppercase tracking-wider block">SIGE · Resumen Ejecutivo de Encuesta</span>
            </div>
        </div>
    </div>

    <!-- Información General / Hero de la Encuesta -->
    <div class="space-y-2">
        <h3 id="detailSurveyTitle" class="font-editorial text-lg sm:text-xl font-bold text-[#00131E] leading-tight">
            Encuesta Inserción Laboral ADSO
        </h3>
        
        <p id="detailSurveyDesc" class="text-xs text-gray-500 leading-relaxed">
            Diagnóstico de inserción y estabilidad en el mercado de software para egresados ADSO.
        </p>

        <div class="pt-2 text-[11px] space-y-1 text-gray-600 border-t border-gray-50">
            <div><strong>ID:</strong> <span id="detailSurveyMeta" class="font-semibold text-gray-800">ENC-025</span></div>
            <div><strong>Fecha:</strong> <span id="detailSurveyDate" class="font-semibold text-gray-800">12/06/2026</span></div>
            <div><strong>Público:</strong> <span id="detailSurveyTarget" class="font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-md">Egresado ADSO</span></div>
        </div>
    </div>

    <!-- Caja de Estadísticas -->
    <div class="bg-[#F8FCF9] border border-emerald-100/60 rounded-xl p-4 space-y-2.5">
        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block mb-1">Indicadores de Respuesta</span>
        
        <div class="flex justify-between text-xs">
            <span class="text-gray-500 font-medium">Enviadas:</span>
            <span id="detailEnviadas" class="font-bold text-gray-900">120</span>
        </div>
        
        <div class="flex justify-between text-xs">
            <span class="text-gray-500 font-medium">Respondidas:</span>
            <span id="detailRespondidas" class="font-bold text-emerald-800">90</span>
        </div>
        
        <div class="flex justify-between text-xs">
            <span class="text-gray-500 font-medium">Pendientes:</span>
            <span id="detailPendientes" class="font-bold text-amber-700">30</span>
        </div>
        
        <div class="flex justify-between text-xs pt-1 border-t border-gray-200/50">
            <span class="text-gray-700 font-bold">Tasa de respuesta:</span>
            <span id="detailRate" class="font-extrabold text-[#0d6928] text-sm">75%</span>
        </div>

        <!-- Barra de Progreso Dinámica -->
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden mt-2">
            <div id="detailProgressBar" class="bg-gradient-to-r from-[#001A29] to-[#39A900] h-2 rounded-full transition-all duration-500" style="width: 75%;"></div>
        </div>
    </div>

    <!-- Botones de Acción -->
    <div id="detalleActionButtons" class="flex flex-col gap-2 pt-1" x-data="{ confirmarCierre: false }">
        <a id="detailResultsBtn" 
           href="{{ route('egresados.superadmin.encuestas.resultados', 'ENC-025') }}" 
           class="w-full py-2.5 px-4 bg-[#001A29] hover:bg-[#39A900] text-white text-xs font-bold rounded-xl transition duration-200 flex items-center justify-center gap-2 shadow-sm cursor-pointer text-center">
            <i class="fa-solid fa-chart-pie text-xs"></i>
            <span>Ver Resultados Completos</span>
        </a>

        <button type="button" 
                id="btnDescargarResumenPDF"
                onclick="descargarResumenPDF()" 
                class="w-full py-2.5 px-4 bg-white hover:bg-emerald-50 text-gray-700 hover:text-emerald-800 border border-gray-200 hover:border-emerald-300 text-xs font-bold rounded-xl transition duration-200 flex items-center justify-center gap-2 shadow-2xs cursor-pointer">
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

        <!-- Modal de Confirmación Flotante -->
        <div x-show="confirmarCierre" 
             style="display: none;"
             class="fixed inset-0 z-[60] flex items-center justify-center bg-gray-900/50 backdrop-blur-xs p-4" 
             x-cloak>
            
            <div @click.away="confirmarCierre = false" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="bg-white p-6 rounded-2xl shadow-2xl max-w-sm w-full border border-gray-100 text-center">
                
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-xs">
                    <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                </div>
                
                <h3 class="text-lg font-bold text-gray-900 font-editorial mb-1">¿Cerrar esta encuesta?</h3>
                <p class="text-xs text-gray-500 mb-5 leading-relaxed">
                    Al cerrar la encuesta <span id="modalSurveyId" class="font-bold text-gray-800">ENC-025</span>, los egresados ya no podrán enviar más respuestas. Esta acción finaliza la recolección.
                </p>
                
                <div class="flex items-center gap-3">
                    <button @click="confirmarCierre = false" 
                            type="button" 
                            class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                        Cancelar
                    </button>
                    
                    <!-- Formulario real hacia el backend con método PUT -->
                    <form id="formCerrarEncuesta" 
                          action="{{ route('egresados.superadmin.encuestas.cerrar', 'ENC-025') }}" 
                          method="POST" 
                          class="flex-1">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer">
                            Sí, cerrar ahora
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
