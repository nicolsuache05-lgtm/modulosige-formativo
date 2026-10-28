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
         class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[92vh] overflow-hidden">
        
        <!-- Encabezado del Modal con Identidad SENA ERP -->
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-lg shadow-md shadow-black/20 flex-shrink-0">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div>
                    <div class="text-[10.5px] font-extrabold text-[#62E31D] uppercase tracking-wider">GESTIÓN DE EGRESADOS · SIGE</div>
                    <h3 class="text-xl font-bold text-white tracking-tight">Registrar egresado</h3>
                    <p class="text-xs text-white/70 mt-0.5">Crea un registro para un egresado sin salir del panel administrativo.</p>
                </div>
            </div>
            <button @click="openModal = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar">
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
                        <span class="w-7 h-7 rounded-full bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-xs font-bold shadow-xs">1</span>
                        <h4 class="text-sm font-bold text-[#00131E]">Datos personales</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Nombres <span class="text-red-500">*</span></label>
                            <input type="text" name="nombres" required placeholder="Ej. Juan Carlos" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Apellidos <span class="text-red-500">*</span></label>
                            <input type="text" name="apellidos" required placeholder="Ej. Pérez Rodríguez" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                        <div class="sm:col-span-1">
                            <label class="block text-xs font-bold text-gray-700 mb-1">Tipo Doc. <span class="text-red-500">*</span></label>
                            <select name="tipo_documento" required class="w-full px-3 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                                <option value="CC">Cédula de Ciudadanía (CC)</option>
                                <option value="TI">Tarjeta de Identidad (TI)</option>
                                <option value="CE">Cédula de Extranjería (CE)</option>
                                <option value="PEP">PEP</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-gray-700 mb-1">DNI / Cédula <span class="text-red-500">*</span></label>
                            <input type="text" name="documento" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Ej. 1060123456" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                    </div>
                </div>

                <!-- 2. Información de contacto -->
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="w-7 h-7 rounded-full bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-xs font-bold shadow-xs">2</span>
                        <h4 class="text-sm font-bold text-[#00131E]">Información de contacto</h4>
                    </div>
                    <p class="text-[11px] text-gray-500 mb-3.5">Datos únicos de contacto: el correo institucional/personal y teléfono deben pertenecer exclusivamente al egresado.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Correo electrónico <span class="text-red-500">*</span></label>
                            <input type="email" name="correo" required placeholder="egresado@correo.com" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Teléfono / Celular</label>
                            <input type="tel" name="telefono" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Ej. 3001234567" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                    </div>
                </div>

                <!-- 3. Información académica (SENA) -->
                <div>
                    <div class="flex items-center gap-2.5 mb-4">
                        <span class="w-7 h-7 rounded-full bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-xs font-bold shadow-xs">3</span>
                        <h4 class="text-sm font-bold text-[#00131E]">Información académica</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Programa de Formación <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   name="programa" 
                                   id="crear_programa" 
                                   list="lista_programas_formacion" 
                                   required 
                                   placeholder="Escribe el programa de formación (ej. ADSO, Agropecuaria...)" 
                                   class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium text-gray-800">
                            <datalist id="lista_programas_formacion">
                                <option value="Análisis y Desarrollo de Software (ADSO)">
                                <option value="Gestión de Empresas Agropecuarias">
                                <option value="Procesamiento de Alimentos">
                                <option value="Producción Ganadera">
                                <option value="Gestión Administrativa">
                                <option value="Gestión del Talento Humano">
                                <option value="Contabilización de Operaciones Comerciales y Financieras">
                                <option value="Producción Agropecuaria Ecológica">
                                <option value="Riego, Drenaje y Manejo de Suelos Agrícolas">
                                <option value="Mantenimiento Mecatrónico de Automotores">
                                <option value="Sistemas">
                                <option value="Construcción de Edificaciones">
                                <option value="Cocina">
                                <option value="Agroindustria">
                                <option value="Mecanización Agrícola">
                                <option value="Acuicultura">
                                <option value="Recursos Humanos">
                                <option value="Salud Ocupacional">
                            </datalist>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Código de Ficha <span class="text-red-500">*</span></label>
                            <input type="number" name="ficha" required placeholder="Ej. 3145614" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Centro de Formación</label>
                            <input type="text" name="centro_formacion" value="CEFA La Angostura" readonly class="w-full px-3.5 py-2.5 text-sm bg-gray-50 text-gray-500 border border-gray-200 rounded-xl cursor-not-allowed font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Estado Ocupacional <span class="text-red-500">*</span></label>
                            <select name="estado" required class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition font-medium">
                                <option value="CERTIFICADO" selected>Certificado (Egresado)</option>
                                <option value="EN FORMACIÓN">En Formación</option>
                                <option value="INDUCCIÓN">Inducción</option>
                                <option value="CONDICIONADO">Condicionado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Banner Informativo Institucional -->
                <div class="bg-emerald-50/70 border border-emerald-200/80 rounded-2xl p-4 flex items-start gap-3.5">
                    <div class="w-7 h-7 rounded-full bg-[#39A900] text-white flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5 shadow-xs">
                        <i class="fa-solid fa-info"></i>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-[#00131E]">Rol y vinculación institucional</div>
                        <p class="text-[11.5px] text-gray-600 mt-0.5 leading-relaxed">
                            Este formulario registra únicamente usuarios con rol <strong>egresado / aprendiz</strong> del centro de formación. Podrá acceder y consultar información con su número de documento.
                        </p>
                    </div>
                </div>

            </form>
        </div>

        <!-- Pie del Modal con Botones Institucionales ERP -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex flex-col sm:flex-row items-center justify-end gap-3 bg-[#f8faf9]">
            <button type="button" @click="openModal = false" class="w-full sm:w-auto px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer text-center">
                Cancelar
            </button>
            <button type="submit" form="form-crear-egresado-modal" class="w-full sm:w-auto px-7 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs font-bold rounded-xl transition shadow-md hover:shadow-lg shadow-[#39A900]/25 cursor-pointer flex items-center justify-center gap-2">
                <i class="fa-solid fa-id-card"></i>
                <span>Registrar egresado</span>
            </button>
        </div>

    </div>
</div>
