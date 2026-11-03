<!-- Modules/Egresados/resources/views/superadmin/partials/_modal_confirmar_toggle.blade.php -->
<!-- VENTANA MODAL DE CONFIRMACIÓN: ACTIVAR / DESACTIVAR EGRESADO (ESTILO ROJO/ROSE DE ALERTA) -->

<div x-show="openModalToggleStatus" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openModalToggleStatus = false"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openModalToggleStatus = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         class="bg-white rounded-3xl max-w-md w-full shadow-2xl border border-gray-100 overflow-hidden text-center p-6 sm:p-8">
        
        <!-- Icono animado en rojo suave -->
        <div class="mx-auto mb-4 w-16 h-16 rounded-2xl flex items-center justify-center text-2xl shadow-lg transition-transform duration-300"
             :class="toggleModalIsActive ? 'bg-rose-100 text-rose-600 shadow-rose-200' : 'bg-emerald-100 text-emerald-600 shadow-emerald-200'">
            <i :class="toggleModalIsActive ? 'fa-solid fa-user-xmark' : 'fa-solid fa-user-check'"></i>
        </div>

        <!-- Tag Institucional -->
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider mb-2.5"
             :class="toggleModalIsActive ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200'">
            <i class="fa-solid fa-shield-halved text-xs"></i>
            <span x-text="toggleModalIsActive ? 'GESTIÓN DE ESTADO · SIGE ERP' : 'HABILITACIÓN EN SISTEMA · SIGE ERP'"></span>
        </div>

        <!-- Título -->
        <h3 class="text-xl font-bold text-[#00131E] tracking-tight mb-2" x-text="toggleModalTitle">
            ¿Deseas cambiar el estado?
        </h3>

        <!-- Mensaje / Egresado -->
        <p class="text-sm text-gray-600 leading-relaxed mb-6" x-html="toggleModalMessage">
        </p>

        <!-- Botones de Acción -->
        <div class="flex items-center justify-center gap-3">
            <button type="button" 
                    @click="openModalToggleStatus = false" 
                    class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                Cancelar
            </button>
            <button type="button" 
                    @click="confirmToggleSubmit()" 
                    class="px-6 py-2.5 text-white text-xs font-bold rounded-xl transition shadow-md cursor-pointer flex items-center gap-2 border-0"
                    :class="toggleModalIsActive ? 'bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-700 hover:to-rose-800 shadow-rose-500/30' : 'bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] shadow-[#39A900]/30'">
                <i :class="toggleModalConfirmIcon"></i>
                <span x-text="toggleModalConfirmText">Confirmar</span>
            </button>
        </div>

    </div>
</div>

<script>
    /**
     * Función global para abrir el modal institucional de activación / desactivación
     */
    function openConfirmToggleModal(data) {
        if (!data) {
            data = window.currentSelectedEgresado;
        }
        if (!data) {
            const row = document.querySelector('.egresado-row.selected-row') || document.querySelector('.egresado-row');
            if (row && typeof parseJsonSafe === 'function') {
                data = parseJsonSafe(row.getAttribute('data-json'));
            }
        }
        if (!data) return;

        const name = data.name || 'este egresado';
        const isActive = !!data.is_active;

        window.__toggleTargetAction = (window.location.pathname.includes('/instructor') ? '<?php echo e(url("egresados/instructor")); ?>' : '<?php echo e(url("egresados")); ?>') + '/' + data.id + '/toggle-status';

        // Disparar evento para que Alpine actualice sus variables de estado
        window.dispatchEvent(new CustomEvent('open-toggle-modal', {
            detail: {
                isActive: isActive,
                title: isActive ? '¿Desactivar Egresado?' : '¿Activar Egresado?',
                message: isActive ? 
                    '¿Estás seguro de que deseas desactivar a <strong class="text-rose-600">' + name + '</strong>? Pasará a estado inactivo en SIGE.' : 
                    '¿Estás seguro de que deseas activar a <strong class="text-emerald-600">' + name + '</strong>? Volverá a estar habilitado en SIGE.',
                confirmText: isActive ? 'Sí, Desactivar Egresado' : 'Sí, Activar Egresado',
                confirmIcon: isActive ? 'fa-solid fa-user-xmark' : 'fa-solid fa-user-check'
            }
        }));
    }

    function confirmToggleSubmit() {
        const toggleForm = document.getElementById('detailToggleForm');
        if (toggleForm && window.__toggleTargetAction) {
            toggleForm.action = window.__toggleTargetAction;
            // Remover onsubmit para evitar confirm() nativo
            toggleForm.onsubmit = null;
            toggleForm.submit();
        }
    }
</script>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules/Egresados\resources/views/superadmin/partials/_modal_confirmar_toggle.blade.php ENDPATH**/ ?>