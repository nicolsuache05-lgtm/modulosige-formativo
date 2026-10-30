{{-- Modal: Ver Detalle Completo del Evento (Identidad SENA ERP) --}}
<div x-show="openDetalleModal" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openDetalleModal = false"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center pt-8 sm:pt-12 p-3 sm:p-4" x-cloak>
    
    <div @click.away="openDetalleModal = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
         class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[92vh] overflow-hidden transform">
        
        <!-- Encabezado del Modal con Identidad SENA ERP -->
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-lg shadow-md shadow-black/20 flex-shrink-0">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-[9.5px] font-extrabold text-[#62E31D] uppercase tracking-wider">GESTIÓN DE EVENTOS · SIGE ERP</span>
                        <span id="modalDetalleId" class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#39A900] text-white">EVT-012</span>
                        <span id="modalDetalleStatus" class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-white/20 text-white uppercase">PROGRAMADO</span>
                    </div>
                    <h3 id="modalDetalleTitulo" class="text-base sm:text-lg font-bold text-white tracking-tight mt-0.5">Feria laboral 2026</h3>
                    <p class="text-xs text-white/75 mt-0.5">Información integral, logística y aforo del evento institucional.</p>
                </div>
            </div>
            <button @click="openDetalleModal = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Modal con Scroll Suave -->
        <div class="px-6 sm:px-8 py-5 overflow-y-auto space-y-5 bg-[#f8fafc]/80">
            
            <!-- 1. Tarjetas de Estadísticas de Aforo y Participación -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <div class="bg-white p-3.5 rounded-2xl border border-gray-100 shadow-xs">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Cupo Total</span>
                    <span id="modalDetalleCupo" class="text-xl font-bold font-editorial text-[#00131E] block mt-0.5">200</span>
                    <span class="text-[10px] text-gray-400">Aforo máximo</span>
                </div>
                <div class="bg-white p-3.5 rounded-2xl border border-gray-100 shadow-xs">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Confirmados</span>
                    <span id="modalDetalleRegistrados" class="text-xl font-bold font-editorial text-[#39A900] block mt-0.5">156</span>
                    <span class="text-[10px] text-[#166534] font-semibold">Inscritos</span>
                </div>
                <div class="bg-white p-3.5 rounded-2xl border border-gray-100 shadow-xs">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Pendientes</span>
                    <span id="modalDetallePendientes" class="text-xl font-bold font-editorial text-amber-600 block mt-0.5">12</span>
                    <span class="text-[10px] text-amber-600 font-semibold">Por verificar</span>
                </div>
                <div class="bg-gradient-to-br from-[#00131E] to-[#002336] text-white p-3.5 rounded-2xl shadow-xs">
                    <span class="text-[10px] font-bold text-[#62E31D] uppercase tracking-wider block">Ocupación</span>
                    <span id="modalDetalleRate" class="text-xl font-bold font-editorial text-white block mt-0.5">78%</span>
                    <div class="w-full bg-white/20 h-1.5 rounded-full overflow-hidden mt-1.5">
                        <div id="modalDetalleProgressBar" class="bg-[#39A900] h-full rounded-full transition-all duration-300" style="width: 78%"></div>
                    </div>
                </div>
            </div>

            <!-- 2. Información del Evento y Logística -->
            <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#39A900] space-y-3.5">
                <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                    <h4 class="text-[11px] font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-circle-info text-[#39A900]"></i>
                        Ficha Técnica y Logística del Evento
                    </h4>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                    <div class="p-2.5 rounded-xl bg-gray-50/80 border border-gray-100">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Tipo de Evento</span>
                        <span id="modalDetalleTipo" class="font-bold text-[#00131E] text-xs block mt-0.5">Feria laboral</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-gray-50/80 border border-gray-100">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Fecha y Horario</span>
                        <span id="modalDetalleFecha" class="font-bold text-[#00131E] text-xs block mt-0.5">20/06/2026 | 09:00 AM - 04:00 PM</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-gray-50/80 border border-gray-100">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Lugar / Ubicación</span>
                        <span id="modalDetalleLugar" class="font-bold text-[#00131E] text-xs block mt-0.5">Auditorio Principal CEFA</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-gray-50/80 border border-gray-100">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Responsable Organizador</span>
                        <span id="modalDetalleResp" class="font-bold text-[#00131E] text-xs block mt-0.5">Coordinación Académica</span>
                    </div>

                    <div class="sm:col-span-2 p-2.5 rounded-xl bg-gray-50/80 border border-gray-100">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Programas Dirigidos</span>
                        <span id="modalDetalleProg" class="font-bold text-[#166534] text-xs block mt-0.5">ADSO - GAE</span>
                    </div>
                </div>
            </div>

            <!-- 3. Descripción del Evento -->
            <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#001A29] space-y-2">
                <h4 class="text-[11px] font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-2">
                    <i class="fa-solid fa-align-left text-[#001A29]"></i>
                    Descripción y Alcance Institucional
                </h4>
                <p id="modalDetalleDesc" class="text-xs text-gray-600 leading-relaxed bg-gray-50/80 p-3.5 rounded-xl border border-gray-100">
                    Feria laboral dirigida a Egresados para conectar con empresas aliadas y conocer oportunidades de empleo y prácticas profesionales.
                </p>
            </div>

        </div>

        <!-- Pie del Modal con Identidad SENA ERP -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex items-center justify-between bg-white">
            <span class="text-[11px] text-gray-400 hidden sm:inline flex items-center gap-1.5">
                <i class="fa-solid fa-shield-halved text-[#39A900]"></i>
                Módulo Institucional de Eventos · CEFA
            </span>
            <div class="flex items-center gap-2.5 w-full sm:w-auto justify-end">
                <button type="button" @click="openDetalleModal = false" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                    Cerrar
                </button>
                <button type="button" onclick="abrirModalEditarEvento()" class="px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-xl transition shadow-2xs flex items-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-pen-to-square text-xs text-gray-500"></i>
                    <span>Editar Evento</span>
                </button>
                <a id="modalDetalleBtnExport" href="#" class="px-4 py-2 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 flex items-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-file-excel text-xs"></i>
                    <span>Exportar Asistentes</span>
                </a>
            </div>
        </div>

    </div>
</div>

