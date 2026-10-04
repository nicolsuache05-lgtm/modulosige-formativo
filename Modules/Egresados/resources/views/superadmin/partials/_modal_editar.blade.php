<!-- Modules/Egresados/Resources/views/superadmin/partials/_modal_editar.blade.php -->

<div x-show="openModalEditar" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openModalEditar = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[90vh]">
        
        <!-- Encabezado del Modal -->
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Editar Perfil de Egresado</h3>
                <p class="text-xs text-gray-500 mt-1">Modifique los datos personales o de contacto del egresado.</p>
            </div>
            <button @click="openModalEditar = false" type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-50 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario con Scroll -->
        <div class="px-6 py-4 overflow-y-auto">
            <form id="form-editar-perfil" action="{{ route('egresados.superadmin.update', $apprentice->id ?? 1) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT') <!-- Directiva de Laravel para actualizaciones -->
                
                <!-- Sección: Información Personal & Contacto -->
                <div>
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-50">Información Personal y Contacto</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="sm:col-span-1">
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Tipo Doc.</label>
                            <select name="tipo_documento" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                                <option value="CC" {{ ($docType ?? 'CC') == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                                <option value="TI" {{ ($docType ?? '') == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                                <option value="CE" {{ ($docType ?? '') == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
                                <option value="PEP" {{ ($docType ?? '') == 'PEP' ? 'selected' : '' }}>PEP</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Número de Documento</label>
                            <input type="text" name="documento" value="{{ $docNum ?? '10000003' }}" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Nombre Completo</label>
                        <input type="text" name="nombre" value="{{ $nombreCompleto ?? 'Valentina Ríos Egresada' }}" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Correo Electrónico</label>
                            <input type="email" name="correo" value="{{ $correo ?? 'egresado.siga@sena.edu.co' }}" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Teléfono Móvil</label>
                            <input type="text" name="telefono" value="{{ isset($telefono) && $telefono !== 'No registra' ? $telefono : '' }}" placeholder="Ej. 3201234567" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                        </div>
                    </div>
                </div>

                <!-- Sección: Información Académica (Modificable solo por Super Admin) -->
                <div class="pt-2">
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-50">Información Académica</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Programa de Formación</label>
                            <select name="programa" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                                <option value="GESTION_AGROPECUARIA" selected>Gestión de Empresas Agropecuarias</option>
                                <option value="ADSO">Análisis y Desarrollo de Software</option>
                                <option value="PROCESAMIENTO_ALIMENTOS">Procesamiento de Alimentos</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Código de Ficha</label>
                            <input type="number" name="ficha" value="{{ $fichaCodigo ?? '55555' }}" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Pie del Modal (Botones) -->
        <div class="border-t border-gray-100 px-6 py-4 flex items-center justify-end gap-3 bg-gray-50/50 rounded-b-2xl">
            <button type="button" @click="openModalEditar = false" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-sm">
                Cancelar
            </button>
            <button type="submit" form="form-editar-perfil" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Actualizar Cambios
            </button>
        </div>

    </div>
</div>
