<!-- Fondo oscuro y modal -->
<div x-show="openModal" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6">
    
    <!-- Contenedor del Formulario Estilo Card Premium -->
    <div @click.away="openModal = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-green-100 flex flex-col max-h-[92vh] overflow-hidden">
        
        <!-- Encabezado del Modal con Icono Verde -->
        <div class="flex items-center justify-between border-b border-gray-100 px-6 sm:px-8 py-5 bg-[#ffffff]">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-2xl bg-[#008f39] text-white flex items-center justify-center text-lg shadow-md flex-shrink-0">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div>
                    <div class="text-[10.5px] font-extrabold text-[#008f39] uppercase tracking-wider">GESTIÓN DE EGRESADOS</div>
                    <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">Registrar egresado</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Crea un registro para un egresado sin salir del panel administrativo.</p>
                </div>
            </div>
            <button @click="openModal = false" type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-100 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario (Con scroll suave) -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-6">
            <form id="form-crear-egresado-modal" action="{{ route('egresados.superadmin.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- 1. Datos personales -->
                <div>
                    <div class="flex items-center gap-2.5 mb-4">
                        <span class="w-7 h-7 rounded-full bg-[#008f39] text-white flex items-center justify-center text-xs font-extrabold">1</span>
                        <h4 class="text-sm font-extrabold text-gray-900">Datos personales</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Nombres <span class="text-red-500">*</span></label>
                            <input type="text" name="nombres" required placeholder="Ej. Juan Carlos" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-[#008f39] outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Apellidos <span class="text-red-500">*</span></label>
                            <input type="text" name="apellidos" required placeholder="Ej. Pérez Rodríguez" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-[#008f39] outline-none transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                        <div class="sm:col-span-1">
                            <label class="block text-xs font-bold text-gray-700 mb-1">Tipo Doc. <span class="text-red-500">*</span></label>
                            <select name="tipo_documento" required class="w-full px-3 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-[#008f39] outline-none transition">
                                <option value="CC">Cédula de Ciudadanía (CC)</option>
                                <option value="TI">Tarjeta de Identidad (TI)</option>
                                <option value="CE">Cédula de Extranjería (CE)</option>
                                <option value="PEP">PEP</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-gray-700 mb-1">DNI / Cédula <span class="text-red-500">*</span></label>
                            <input type="text" name="documento" required placeholder="Ej. 1060123456" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-[#008f39] outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- 2. Información de contacto -->
                <div>
                    <div class="flex items-center gap-2.5 mb-4">
                        <span class="w-7 h-7 rounded-full bg-[#008f39] text-white flex items-center justify-center text-xs font-extrabold">2</span>
                        <h4 class="text-sm font-extrabold text-gray-900">Información de contacto</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Correo electrónico <span class="text-red-500">*</span></label>
                            <input type="email" name="correo" required placeholder="egresado@correo.com" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-[#008f39] outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Teléfono</label>
                            <input type="text" name="telefono" placeholder="Ej. 3001234567" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-[#008f39] outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- 3. Información académica (SENA) -->
                <div>
                    <div class="flex items-center gap-2.5 mb-4">
                        <span class="w-7 h-7 rounded-full bg-[#008f39] text-white flex items-center justify-center text-xs font-extrabold">3</span>
                        <h4 class="text-sm font-extrabold text-gray-900">Información académica</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Programa de Formación <span class="text-red-500">*</span></label>
                            <select name="programa" required class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-[#008f39] outline-none transition">
                                <option value="">Seleccione un programa...</option>
                                <option value="ADSO">Análisis y Desarrollo de Software (ADSO)</option>
                                <option value="GESTION_AGROPECUARIA">Gestión de Empresas Agropecuarias</option>
                                <option value="PROCESAMIENTO_ALIMENTOS">Procesamiento de Alimentos</option>
                                <option value="PRODUCCION_GANADERA">Producción Ganadera</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Código de Ficha <span class="text-red-500">*</span></label>
                            <input type="number" name="ficha" required placeholder="Ej. 3145614" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-[#008f39] outline-none transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Centro de Formación</label>
                            <input type="text" name="centro_formacion" value="CEFA La Angostura" readonly class="w-full px-3.5 py-2.5 text-sm bg-gray-50 text-gray-500 border border-gray-200 rounded-xl cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Estado Ocupacional <span class="text-red-500">*</span></label>
                            <select name="estado" required class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-[#008f39] outline-none transition">
                                <option value="CERTIFICADO">Certificado</option>
                                <option value="EN_FORMACION">En Formación</option>
                                <option value="EMPLEADO">Empleado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Banner Informativo -->
                <div class="bg-[#f0faf3] border border-[#d4eedd] rounded-2xl p-4 flex items-start gap-3.5">
                    <div class="w-7 h-7 rounded-full bg-[#008f39] text-white flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                        <i class="fa-solid fa-info"></i>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold text-[#008f39]">Rol y vinculación institucional</div>
                        <p class="text-[11.5px] text-[#2c5239] mt-0.5 leading-relaxed">
                            Este formulario registra únicamente usuarios con rol <strong>egresado / aprendiz</strong> del CEFA La Angostura. Podrá acceder y consultar información con su número de documento.
                        </p>
                    </div>
                </div>

            </form>
        </div>

        <!-- Pie del Modal (Botones Exactos) -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex flex-col sm:flex-row items-center justify-end gap-3 bg-[#fbfdfc]">
            <button type="button" @click="openModal = false" class="w-full sm:w-auto px-6 py-3 bg-[#f1f5f3] hover:bg-[#e2ece6] text-[#4b6354] text-xs font-bold rounded-xl transition cursor-pointer text-center">
                Cancelar
            </button>
            <button type="submit" form="form-crear-egresado-modal" class="w-full sm:w-auto px-7 py-3 bg-[#008f39] hover:bg-[#007a30] text-white text-xs font-extrabold rounded-xl transition shadow-md hover:shadow-lg cursor-pointer flex items-center justify-center gap-2">
                <i class="fa-solid fa-id-card"></i>
                <span>Registrar egresado</span>
            </button>
        </div>

    </div>
</div>
