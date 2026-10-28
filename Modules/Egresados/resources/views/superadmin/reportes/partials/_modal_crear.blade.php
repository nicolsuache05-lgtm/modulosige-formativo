<!-- ============================================== -->
<!-- 4. MODAL PARA CREAR / CONFIGURAR REPORTE (SENA ERP) -->
<!-- ============================================== -->
<div x-show="openModal" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openModal = false"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center pt-8 sm:pt-12 p-3 sm:p-4" x-cloak>
    
    <div @click.away="openModal = false" 
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
                    <i class="fa-solid fa-file-circle-plus"></i>
                </div>
                <div>
                    <div class="text-[9.5px] font-extrabold text-[#62E31D] uppercase tracking-wider">GENERADOR DE REPORTES · SIGE ERP</div>
                    <h3 class="text-base sm:text-lg font-bold text-white tracking-tight">Configurar Nuevo Reporte</h3>
                    <p class="text-xs text-white/75 mt-0.5">Defina los parámetros, filtros y formato institucional de exportación.</p>
                </div>
            </div>
            <button @click="openModal = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario con Scroll Suave -->
        <div class="px-6 sm:px-8 py-5 overflow-y-auto space-y-6 bg-[#f8fafc]/80">
            <form id="form-crear-reporte" action="{{ route('egresados.superadmin.reportes.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Sección 1: Información Base -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#39A900] space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                        <h4 class="text-[11px] font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-circle-info text-[#39A900]"></i>
                            Configuración Base del Documento
                        </h4>
                        <span class="text-[10.5px] text-gray-400 font-medium">* Campos obligatorios</span>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-file-signature text-[#39A900]"></i>
                                <span>Nombre del Reporte</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nombre_reporte" required 
                                   class="w-full px-4 py-2.5 text-sm bg-gray-50/60 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-semibold text-gray-800" 
                                   placeholder="Ej. Consolidado Empleabilidad ADSO 2026">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-database text-[#39A900]"></i>
                                <span>Tipo de Reporte (Origen de Datos)</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="tipo_reporte" required 
                                    class="w-full px-4 py-2.5 text-sm bg-gray-50/60 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition">
                                <option value="EMPLEABILIDAD">Empleabilidad y Estado Laboral</option>
                                <option value="SEGUIMIENTO">Seguimientos Realizados (Llamadas, Visitas, Trazabilidad)</option>
                                <option value="ENCUESTAS">Resultados de Encuestas</option>
                                <option value="DIRECTORIO">Directorio General de Egresados</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Sección 2: Filtros Aplicables -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#001A29] space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                        <h4 class="text-[11px] font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-filter text-[#39A900]"></i>
                            Criterios y Filtros de Búsqueda
                        </h4>
                        <span class="text-[10.5px] text-gray-400 font-medium">Opcional</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5">Programa de Formación</label>
                            <select name="filtro_programa" class="w-full px-3.5 py-2.5 text-sm bg-gray-50/60 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition">
                                <option value="TODOS">Todos los programas (CEFA)</option>
                                @if(isset($programs) && count($programs) > 0)
                                    @foreach($programs as $prog)
                                        <option value="{{ $prog->name }}">{{ $prog->name }}</option>
                                    @endforeach
                                @else
                                    <option value="ADSO">Análisis y Desarrollo de Software (ADSO)</option>
                                    <option value="GAE">Gestión Agroempresarial</option>
                                    <option value="Producción Agrícola">Producción Agrícola</option>
                                    <option value="Contabilización">Contabilización de Operaciones</option>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5">Número de Ficha</label>
                            <input type="text" name="filtro_ficha" 
                                   class="w-full px-3.5 py-2.5 text-sm bg-gray-50/60 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition" 
                                   placeholder="Opcional. Ej. 2694551">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5">Rango de Fechas (Desde - Hasta)</label>
                            <div class="flex items-center gap-2">
                                <input type="date" name="fecha_inicio" class="w-full px-2.5 py-2 text-xs bg-gray-50/60 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                                <span class="text-xs text-gray-400 font-bold">-</span>
                                <input type="date" name="fecha_fin" class="w-full px-2.5 py-2 text-xs bg-gray-50/60 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5">
                                <span>Formato Recomendado</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="formato_exportacion" required class="w-full px-3.5 py-2.5 text-sm bg-gray-50/60 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-semibold text-gray-800 transition">
                                <option value="EXCEL">📊 Hoja de Cálculo (Excel / CSV)</option>
                                <option value="PDF">📄 Documento PDF Oficial (Resumen y Tablas)</option>
                                <option value="CSV">📝 Texto Delimitado por Comas (.CSV)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Sección 3: Datos a incluir -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs space-y-3">
                    <h4 class="text-[11px] font-bold text-[#00131E] uppercase tracking-wider pb-2 border-b border-gray-100 flex items-center gap-2">
                        <i class="fa-solid fa-table-columns text-[#39A900]"></i>
                        Columnas y Dimensiones a Exportar
                    </h4>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <label class="flex items-center gap-2.5 p-2.5 rounded-xl bg-gray-50/70 hover:bg-[#EAF7EE] border border-gray-200/70 cursor-pointer transition">
                            <input type="checkbox" name="columnas[]" value="datos_personales" checked class="rounded border-gray-300 text-[#39A900] focus:ring-[#39A900] w-4 h-4 accent-[#39A900]">
                            <span class="text-xs font-semibold text-gray-700">Datos Personales</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-2.5 rounded-xl bg-gray-50/70 hover:bg-[#EAF7EE] border border-gray-200/70 cursor-pointer transition">
                            <input type="checkbox" name="columnas[]" value="contacto" checked class="rounded border-gray-300 text-[#39A900] focus:ring-[#39A900] w-4 h-4 accent-[#39A900]">
                            <span class="text-xs font-semibold text-gray-700">Correo y Teléfono</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-2.5 rounded-xl bg-gray-50/70 hover:bg-[#EAF7EE] border border-gray-200/70 cursor-pointer transition">
                            <input type="checkbox" name="columnas[]" value="academico" checked class="rounded border-gray-300 text-[#39A900] focus:ring-[#39A900] w-4 h-4 accent-[#39A900]">
                            <span class="text-xs font-semibold text-gray-700">Info. Académica</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-2.5 rounded-xl bg-gray-50/70 hover:bg-[#EAF7EE] border border-gray-200/70 cursor-pointer transition">
                            <input type="checkbox" name="columnas[]" value="laboral" checked class="rounded border-gray-300 text-[#39A900] focus:ring-[#39A900] w-4 h-4 accent-[#39A900]">
                            <span class="text-xs font-semibold text-gray-700">Estado Laboral</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-2.5 rounded-xl bg-gray-50/70 hover:bg-[#EAF7EE] border border-gray-200/70 cursor-pointer transition">
                            <input type="checkbox" name="columnas[]" value="seguimientos" class="rounded border-gray-300 text-[#39A900] focus:ring-[#39A900] w-4 h-4 accent-[#39A900]">
                            <span class="text-xs font-semibold text-gray-700">Trazabilidad</span>
                        </label>
                    </div>
                </div>
            </form>
        </div>

        <!-- Pie del Modal con Botones Institucionales ERP -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex items-center justify-end gap-3 bg-gray-50/80 rounded-b-3xl">
            <button type="button" @click="openModal = false" 
                    class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-100 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-xs">
                Cancelar
            </button>
            <button type="submit" form="form-crear-reporte" 
                    class="px-6 py-2.5 bg-gradient-to-r from-[#001A29] to-[#39A900] hover:from-[#00131E] hover:to-[#2e8b00] text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-950/20 transition cursor-pointer flex items-center gap-2 transform hover:-translate-y-0.5">
                <i class="fa-solid fa-file-export text-xs"></i>
                <span>Generar Reporte</span>
            </button>
        </div>
    </div>
</div>

    </div>
</div>
