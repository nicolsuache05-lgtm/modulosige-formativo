<!-- ============================================== -->
<!-- 4. MODAL PARA CREAR / CONFIGURAR REPORTE -->
<!-- ============================================== -->
<div x-show="openModal" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openModal = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[90vh]">
        
        <!-- Encabezado del Modal -->
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-file-circle-plus"></i>
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 leading-tight">Configurar Nuevo Reporte</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Defina los parámetros y la información que desea exportar.</p>
                </div>
            </div>
            <button @click="openModal = false" type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-50 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario con Scroll -->
        <div class="px-6 py-5 overflow-y-auto">
            <form id="form-crear-reporte" action="{{ route('egresados.superadmin.reportes.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Sección 1: Información Base -->
                <div>
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-100 flex items-center gap-2">
                        <i class="fa-solid fa-circle-info text-emerald-600"></i>
                        Configuración Base
                    </h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Nombre del Reporte <span class="text-red-500">*</span></label>
                            <input type="text" name="nombre_reporte" required 
                                   class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition" 
                                   placeholder="Ej. Consolidado Empleabilidad ADSO 2026">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Tipo de Reporte (Origen de Datos) <span class="text-red-500">*</span></label>
                            <select name="tipo_reporte" required 
                                    class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition">
                                <option value="EMPLEABILIDAD">Empleabilidad y Estado Laboral</option>
                                <option value="SEGUIMIENTO">Seguimientos Realizados (Llamadas, Visitas, Trazabilidad)</option>
                                <option value="ENCUESTAS">Resultados de Encuestas</option>
                                <option value="DIRECTORIO">Directorio General de Egresados</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Sección 2: Filtros Aplicables -->
                <div class="pt-2">
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-100 flex items-center gap-2">
                        <i class="fa-solid fa-filter text-emerald-600"></i>
                        Filtros (Opcional)
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Programa</label>
                            <select name="filtro_programa" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition">
                                <option value="TODOS">Todos los programas</option>
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
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Número de Ficha</label>
                            <input type="text" name="filtro_ficha" 
                                   class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition" 
                                   placeholder="Opcional. Ej. 2694551">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Rango de Fechas (Desde - Hasta)</label>
                            <div class="flex items-center gap-2">
                                <input type="date" name="fecha_inicio" class="w-full px-2.5 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition">
                                <span class="text-xs text-gray-400 font-bold">-</span>
                                <input type="date" name="fecha_fin" class="w-full px-2.5 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Formato de Exportación Recomendado <span class="text-red-500">*</span></label>
                            <select name="formato_exportacion" required class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition">
                                <option value="EXCEL">Hoja de Cálculo (Excel / CSV)</option>
                                <option value="PDF">Documento PDF (Tablas y Resumen)</option>
                                <option value="CSV">Texto Separado por Comas (.CSV)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Sección 3: Datos a incluir -->
                <div class="pt-2">
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-100 flex items-center gap-2">
                        <i class="fa-solid fa-table-columns text-emerald-600"></i>
                        Columnas a incluir en el Reporte
                    </h4>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <label class="flex items-center gap-2.5 p-2 rounded-xl bg-gray-50 hover:bg-emerald-50/50 border border-gray-100 cursor-pointer transition">
                            <input type="checkbox" name="columnas[]" value="datos_personales" checked class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 w-4 h-4">
                            <span class="text-xs font-medium text-gray-700">Datos Personales</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-2 rounded-xl bg-gray-50 hover:bg-emerald-50/50 border border-gray-100 cursor-pointer transition">
                            <input type="checkbox" name="columnas[]" value="contacto" checked class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 w-4 h-4">
                            <span class="text-xs font-medium text-gray-700">Correo y Teléfono</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-2 rounded-xl bg-gray-50 hover:bg-emerald-50/50 border border-gray-100 cursor-pointer transition">
                            <input type="checkbox" name="columnas[]" value="academico" checked class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 w-4 h-4">
                            <span class="text-xs font-medium text-gray-700">Info. Académica</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-2 rounded-xl bg-gray-50 hover:bg-emerald-50/50 border border-gray-100 cursor-pointer transition">
                            <input type="checkbox" name="columnas[]" value="laboral" checked class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 w-4 h-4">
                            <span class="text-xs font-medium text-gray-700">Estado Laboral</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-2 rounded-xl bg-gray-50 hover:bg-emerald-50/50 border border-gray-100 cursor-pointer transition">
                            <input type="checkbox" name="columnas[]" value="seguimientos" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 w-4 h-4">
                            <span class="text-xs font-medium text-gray-700">Trazabilidad</span>
                        </label>
                    </div>
                </div>
            </form>
        </div>

        <!-- Pie del Modal -->
        <div class="border-t border-gray-100 px-6 py-4 flex items-center justify-end gap-3 bg-gray-50/70 rounded-b-2xl">
            <button type="button" @click="openModal = false" 
                    class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-100 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-xs">
                Cancelar
            </button>
            <button type="submit" form="form-crear-reporte" 
                    class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-sm hover:shadow-md cursor-pointer flex items-center gap-2">
                <i class="fa-solid fa-file-export text-xs"></i>
                <span>Generar Reporte</span>
            </button>
        </div>

    </div>
</div>
