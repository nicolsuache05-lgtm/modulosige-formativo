<!-- ============================================== -->
<!-- 5. MODAL DE ANÁLISIS GRÁFICO E INDICADORES (SENA ERP) -->
<!-- ============================================== -->
<div x-show="openGraficasModal" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openGraficasModal = false"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center pt-6 sm:pt-10 p-3 sm:p-5" x-cloak>
    
    <div @click.away="openGraficasModal = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
         class="bg-white rounded-3xl max-w-4xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[92vh] overflow-hidden transform">
        
        <!-- Encabezado del Modal con Identidad SENA ERP -->
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-4 sm:py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-lg shadow-md shadow-black/20 flex-shrink-0">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-[9.5px] font-extrabold text-[#62E31D] uppercase tracking-wider">INDICADORES Y ESTADÍSTICAS · SIGE ERP</span>
                        <span id="modalGraficaId" class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#39A900] text-white">REP_001</span>
                    </div>
                    <h3 id="modalGraficaTitulo" class="text-base sm:text-lg font-bold text-white tracking-tight mt-0.5">Consolidado General de Empleabilidad 2026</h3>
                    <div class="flex flex-wrap items-center gap-x-3 text-[11px] text-white/75 mt-0.5">
                        <span><strong class="text-white">Programa:</strong> <span id="modalGraficaProg">Todas</span></span>
                        <span>•</span>
                        <span><strong class="text-white">Ficha:</strong> <span id="modalGraficaFicha">Todas</span></span>
                        <span>•</span>
                        <span><strong class="text-white">Responsable:</strong> <span id="modalGraficaResp">Super Administrador</span></span>
                    </div>
                </div>
            </div>

            <!-- Botón Cerrar (X) -->
            <div class="flex items-center">
                <button @click="openGraficasModal = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Cuerpo del Modal (Scrollable) -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-6 bg-[#f8fafc]">
            
            <!-- 1. Tarjetas KPI Ejecutivas -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                
                <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-xs">
                    <div class="flex items-center justify-between text-gray-400 mb-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider">Total Egresados</span>
                        <i class="fa-solid fa-users text-xs text-gray-400"></i>
                    </div>
                    <div id="modalStatTotal" class="font-editorial text-2xl font-bold text-gray-900">4</div>
                    <span class="text-[10px] text-gray-400 block mt-0.5">Muestra institucional</span>
                </div>

                <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-xs">
                    <div class="flex items-center justify-between text-gray-400 mb-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider">Vinculados</span>
                        <i class="fa-solid fa-briefcase text-xs text-emerald-600"></i>
                    </div>
                    <div id="modalStatEmpleados" class="font-editorial text-2xl font-bold text-emerald-700">4</div>
                    <span class="text-[10px] text-emerald-700 font-semibold block mt-0.5">Empleo / Vinculación</span>
                </div>

                <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-xs">
                    <div class="flex items-center justify-between text-gray-400 mb-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider">En Búsqueda</span>
                        <i class="fa-solid fa-user-clock text-xs text-amber-500"></i>
                    </div>
                    <div id="modalStatDesempleados" class="font-editorial text-2xl font-bold text-amber-600">0</div>
                    <span class="text-[10px] text-amber-600 font-semibold block mt-0.5">Aspirantes activos</span>
                </div>

                <div class="bg-gradient-to-br from-emerald-500 to-[#2e8b00] text-white p-4 rounded-2xl shadow-xs">
                    <div class="flex items-center justify-between text-emerald-100 mb-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider">Empleabilidad</span>
                        <i class="fa-solid fa-award text-xs text-yellow-300"></i>
                    </div>
                    <div id="modalStatRate" class="font-editorial text-2xl font-bold text-white">100%</div>
                    <div class="w-full bg-white/20 h-1.5 rounded-full overflow-hidden mt-1.5">
                        <div id="modalStatProgressBar" class="bg-white h-full rounded-full transition-all duration-500" style="width: 100%"></div>
                    </div>
                </div>

            </div>

            <!-- 2. Gráficos Interactivos (Chart.js) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                <!-- Gráfico 1: Situación Ocupacional -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex flex-col">
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100 mb-3">
                        <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-chart-pie text-[#39A900]"></i>
                            Situación Ocupacional
                        </h4>
                        <span class="text-[10px] text-gray-400">Distribución %</span>
                    </div>
                    <div class="relative flex-1 flex items-center justify-center min-h-[220px]">
                        <canvas id="modalChartDoughnut" height="220"></canvas>
                    </div>
                </div>

                <!-- Gráfico 2: Desempeño y Cumplimiento -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs flex flex-col">
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100 mb-3">
                        <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-chart-column text-blue-600"></i>
                            Cumplimiento vs Meta CEFA
                        </h4>
                        <span class="text-[10px] text-gray-400">Meta: 85%</span>
                    </div>
                    <div class="relative flex-1 flex items-center justify-center min-h-[220px]">
                        <canvas id="modalChartBar" height="220"></canvas>
                    </div>
                </div>

            </div>

            <!-- 3. Banner Informativo Institucional -->
            <div class="p-4 rounded-2xl bg-emerald-50/70 border border-emerald-200/80 flex items-start gap-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-circle-check text-sm"></i>
                </div>
                <div class="text-xs text-emerald-950 flex-1">
                    <div class="font-bold">Datos Verificados en el Software SIGE</div>
                    <p class="text-emerald-800 text-[11px] mt-0.5">
                        Esta visualización gráfica refleja únicamente la información registrada en el sistema del Centro de Formación Agroindustrial La Angostura (CEFA). Puedes descargar el informe oficial en formato PDF institucional con los gráficos e indicadores integrados.
                    </p>
                </div>
            </div>

        </div>

        <!-- Pie del Modal con Acciones -->
        <div class="flex items-center justify-between px-6 sm:px-8 py-4 bg-white border-t border-gray-100">
            <span class="text-[11px] text-gray-400 hidden sm:inline flex items-center gap-1.5">
                <i class="fa-solid fa-shield-halved text-[#39A900]"></i>
                Sistema Integrado de Gestión de Egresados — CEFA
            </span>
            <div class="flex items-center gap-2.5 w-full sm:w-auto justify-end">
                <button @click="openGraficasModal = false" type="button" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                    Cerrar
                </button>
                <button type="button" onclick="descargarReportePDF(currentReportData)" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl transition flex items-center gap-1.5 shadow-sm shadow-red-600/25 cursor-pointer">
                    <i class="fa-solid fa-file-pdf"></i>
                    <span>Descargar PDF</span>
                </button>
            </div>
        </div>

    </div>

</div>

