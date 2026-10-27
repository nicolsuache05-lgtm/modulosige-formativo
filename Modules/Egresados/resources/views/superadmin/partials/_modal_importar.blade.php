<div x-show="openModalImportar" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openModalImportar = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         class="bg-white rounded-2xl max-w-lg w-full shadow-2xl border border-gray-100 flex flex-col"
         x-data="{ fileName: '', tipoCarga: 'egresados' }">
        
        <!-- Encabezado -->
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Importación Masiva (Excel)</h3>
                <p class="text-xs text-gray-500 mt-1">Cargue un archivo .xlsx o .csv para registrar usuarios rápidamente.</p>
            </div>
            <button @click="openModalImportar = false" type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-50 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="px-6 py-5">
            <form id="form-importar-excel" action="{{ route('egresados.superadmin.importar') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                
                <!-- Selector de Tipo de Carga -->
                <div>
                    <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">¿Qué datos va a subir?</label>
                    <select name="tipo_importacion" x-model="tipoCarga" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                        <option value="egresados">Aprendices / Egresados</option>
                        <option value="instructores">Instructores</option>
                    </select>
                </div>

                <!-- Recordatorio de Columnas Requeridas -->
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-3">
                    <h5 class="text-xs font-bold text-blue-800 mb-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Columnas requeridas en el archivo:
                    </h5>
                    <!-- Si selecciona Egresados -->
                    <ul x-show="tipoCarga === 'egresados'" class="text-[11px] text-blue-700 list-disc list-inside space-y-0.5 ml-1">
                        <li>Tipo de Documento (CC, CE, TI, PEP)</li>
                        <li>Número de Documento</li>
                        <li>Nombre Completo</li>
                        <li>Correo Electrónico <span class="text-blue-400">(Puede ir vacío)</span></li>
                        <li>Teléfono <span class="text-blue-400">(Puede ir vacío)</span></li>
                        <li>Programa de Formación</li>
                        <li>Código de Ficha</li>
                        <li>Estado <span class="text-blue-400">(Ej. EN FORMACIÓN, CERTIFICADO)</span></li>
                    </ul>
                    <!-- Si selecciona Instructores -->
                    <ul x-show="tipoCarga === 'instructores'" style="display: none;" class="text-[11px] text-blue-700 list-disc list-inside space-y-0.5 ml-1">
                        <li>Identificación (Documento)</li>
                        <li>Nombre del Instructor</li>
                        <li>Correo</li>
                    </ul>
                </div>

                <!-- Zona Drag & Drop -->
                <label for="archivo_excel" class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed rounded-2xl cursor-pointer transition-colors"
                       :class="fileName ? 'border-emerald-500 bg-emerald-50' : 'border-gray-300 bg-gray-50 hover:bg-gray-100'">
                    
                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center" x-show="!fileName">
                        <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        <p class="mb-1 text-sm text-gray-600"><span class="font-bold text-emerald-700">Explore</span> o arrastre el archivo aquí</p>
                        <p class="text-xs text-gray-500">Admite Excel (.xlsx, .csv)</p>
                    </div>

                    <!-- Vista cuando se selecciona un archivo -->
                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center" x-show="fileName" style="display: none;">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mb-2 shadow-sm border border-emerald-100 text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-sm font-bold text-gray-800 truncate px-4 w-full text-center" x-text="fileName"></p>
                    </div>

                    <input id="archivo_excel" name="archivo_excel" type="file" class="hidden" accept=".xlsx, .xls, .csv" @change="fileName = $event.target.files[0].name" required />
                </label>
            </form>
        </div>

        <!-- Pie del Modal -->
        <div class="border-t border-gray-100 px-6 py-4 flex items-center justify-end gap-3 bg-gray-50/50 rounded-b-2xl">
            <button type="button" @click="openModalImportar = false" class="px-5 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-sm">
                Cancelar
            </button>
            <button type="submit" form="form-importar-excel" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Procesar Archivo
            </button>
        </div>
    </div>
</div>
