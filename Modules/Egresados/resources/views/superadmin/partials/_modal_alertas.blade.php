<!-- Modules/Egresados/Resources/views/superadmin/partials/_modal_alertas.blade.php -->
<!-- VENTANA MODAL FLOTANTE DE RETROALIMENTACIÓN INSTITUCIONAL CON CHULITO ANIMADO -->

@php
    $hasSuccess = session()->has('success');
    $hasError = session()->has('error');
    $successMsg = session('success', '¡Egresado registrado correctamente!');
    $errorMsg = session('error', 'Ocurrió un error al procesar la solicitud.');
    
    // Título inteligente
    $successTitle = '¡Egresado Registrado Correctamente!';
    if (str_contains(strtolower($successMsg), 'actualizado')) {
        $successTitle = '¡Datos Actualizados Correctamente!';
    } elseif (str_contains(strtolower($successMsg), 'seguimiento')) {
        $successTitle = '¡Seguimiento Registrado con Éxito!';
    } elseif (str_contains(strtolower($successMsg), 'sincroniz')) {
        $successTitle = '¡Sincronización Completada!';
    } elseif (str_contains(strtolower($successMsg), 'importad')) {
        $successTitle = '¡Importación Exitosa!';
    }
@endphp

<!-- ESTILOS EXCLUSIVOS DEL CHULITO Y ANIMACIONES PREMIUM -->
<style>
    /* Contenedor del Chulito Animado */
    .sena-chulito-container {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px auto;
        width: 86px;
        height: 86px;
    }

    /* Halo pulsante de fondo */
    .sena-chulito-glow {
        position: absolute;
        inset: -6px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(57, 169, 0, 0.28) 0%, rgba(57, 169, 0, 0) 70%);
        animation: sena-pulse-halo 2s ease-in-out infinite;
    }

    /* Círculo base con elevación */
    .sena-chulito-badge {
        width: 78px;
        height: 78px;
        border-radius: 50%;
        background: linear-gradient(135deg, #39A900 0%, #008f39 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 12px 28px -6px rgba(57, 169, 0, 0.45), 
                    inset 0 2px 4px rgba(255, 255, 255, 0.35);
        animation: sena-chulito-pop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        z-index: 2;
    }

    /* SVG del Chulito SENA */
    .sena-chulito-svg {
        width: 44px;
        height: 44px;
        stroke: #ffffff;
        stroke-width: 4.5;
        stroke-linecap: round;
        stroke-linejoin: round;
        fill: none;
    }

    /* Trazo animado del chulito */
    .sena-chulito-path {
        stroke-dasharray: 60;
        stroke-dashoffset: 60;
        animation: sena-draw-check 0.45s cubic-bezier(0.65, 0, 0.45, 1) 0.35s forwards;
    }

    /* Animación del Chulito de Error */
    .sena-error-badge {
        width: 78px;
        height: 78px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 12px 28px -6px rgba(239, 68, 68, 0.45), 
                    inset 0 2px 4px rgba(255, 255, 255, 0.35);
        animation: sena-chulito-pop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        z-index: 2;
    }

    /* Barra de progreso de autocierre */
    .sena-alert-progress {
        height: 4px;
        background: linear-gradient(to right, #39A900, #62E31D);
        width: 100%;
        border-radius: 0 0 24px 24px;
        transform-origin: left;
        animation: sena-progress-drain 5.5s linear forwards;
    }

    @keyframes sena-chulito-pop {
        0% { transform: scale(0.3); opacity: 0; }
        70% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }

    @keyframes sena-pulse-halo {
        0%, 100% { transform: scale(0.95); opacity: 0.6; }
        50% { transform: scale(1.2); opacity: 1; }
    }

    @keyframes sena-draw-check {
        from { stroke-dashoffset: 60; }
        to { stroke-dashoffset: 0; }
    }

    @keyframes sena-progress-drain {
        from { transform: scaleX(1); }
        to { transform: scaleX(0); }
    }
</style>

<!-- ============================================== -->
<!-- 1. MODAL DE ÉXITO ("CHULITO BIEN BONITO") -->
<!-- ============================================== -->
<div x-show="openSuccessModal" 
     @open-success-modal.window="openSuccessModal = true; if($event.detail?.title) document.getElementById('modalSuccessTitle').innerText = $event.detail.title; if($event.detail?.message) document.getElementById('modalSuccessMessage').innerText = $event.detail.message;"
     @close-success-modal.window="openSuccessModal = false"
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openSuccessModal = false"
     class="fixed inset-0 z-[100] overflow-y-auto bg-gray-900/60 backdrop-blur-md flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openSuccessModal = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-90 translate-y-4"
         class="relative bg-white rounded-3xl max-w-md w-full shadow-2xl border border-emerald-100/80 overflow-hidden text-center p-7 sm:p-8">
        
        <!-- Botón cerrar (X) en esquina -->
        <button @click="openSuccessModal = false" type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-100 transition cursor-pointer" title="Cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- CHULITO ANIMADO SENA -->
        <div class="sena-chulito-container">
            <div class="sena-chulito-glow"></div>
            <div class="sena-chulito-badge">
                <svg class="sena-chulito-svg" viewBox="0 0 36 36">
                    <path class="sena-chulito-path" d="M8 18.5L14.5 25L28 11.5"/>
                </svg>
            </div>
        </div>

        <!-- Encabezado / Tag -->
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-[10.5px] font-extrabold text-[#008f39] uppercase tracking-wider mb-2">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>SISTEMA INSTITUCIONAL SIGE</span>
        </div>

        <!-- Título Principal -->
        <h3 id="modalSuccessTitle" class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight leading-snug">
            {{ $successTitle }}
        </h3>

        <!-- Mensaje Detallado -->
        <p id="modalSuccessMessage" class="text-sm text-gray-600 mt-2.5 leading-relaxed font-medium">
            {{ $successMsg }}
        </p>

        <!-- Badge de Confirmación y Verificación -->
        <div class="mt-4 p-3 bg-gradient-to-r from-emerald-50/70 to-green-50/50 rounded-2xl border border-emerald-100/70 flex items-center justify-center gap-2 text-xs text-emerald-800 font-semibold">
            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
            <span>Expediente guardado y verificado en la base de datos</span>
        </div>

        <!-- Botón de Acción Principal -->
        <div class="mt-6">
            <button type="button" 
                    @click="openSuccessModal = false" 
                    class="w-full py-3.5 px-6 bg-gradient-to-r from-[#001A29] to-[#008f39] hover:from-[#00131E] hover:to-[#00752e] text-white text-sm font-bold rounded-2xl shadow-lg shadow-emerald-950/20 transition-all duration-200 transform hover:-translate-y-0.5 cursor-pointer flex items-center justify-center gap-2">
                <i class="fa-solid fa-check"></i>
                <span>Aceptar y Continuar</span>
            </button>
        </div>

        <!-- Barra temporizada de autocierre opcional -->
        <div class="absolute bottom-0 left-0 right-0">
            <div class="sena-alert-progress"></div>
        </div>

    </div>
</div>

<!-- ============================================== -->
<!-- 2. MODAL DE ERROR O ADVERTENCIA INSTITUCIONAL -->
<!-- ============================================== -->
<div x-show="openErrorModal" 
     @open-error-modal.window="openErrorModal = true; if($event.detail?.title) document.getElementById('modalErrorTitle').innerText = $event.detail.title; if($event.detail?.message) document.getElementById('modalErrorMessage').innerText = $event.detail.message;"
     @close-error-modal.window="openErrorModal = false"
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openErrorModal = false"
     class="fixed inset-0 z-[100] overflow-y-auto bg-gray-900/60 backdrop-blur-md flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openErrorModal = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-90 translate-y-4"
         class="relative bg-white rounded-3xl max-w-md w-full shadow-2xl border border-red-100 overflow-hidden text-center p-7 sm:p-8">
        
        <button @click="openErrorModal = false" type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-100 transition cursor-pointer" title="Cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Icono de Error -->
        <div class="sena-chulito-container">
            <div class="sena-error-badge">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
        </div>

        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-[10.5px] font-extrabold text-red-600 uppercase tracking-wider mb-2">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>OBSERVACIÓN INSTITUCIONAL</span>
        </div>

        <h3 id="modalErrorTitle" class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight leading-snug">
            Atención: Ocurrió un problema
        </h3>

        <p id="modalErrorMessage" class="text-sm text-gray-600 mt-2.5 leading-relaxed font-medium">
            {{ $errorMsg }}
        </p>

        <div class="mt-6">
            <button type="button" 
                    @click="openErrorModal = false" 
                    class="w-full py-3.5 px-6 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-2xl shadow-lg shadow-red-900/20 transition-all duration-200 cursor-pointer flex items-center justify-center gap-2">
                <span>Entendido</span>
            </button>
        </div>

    </div>
</div>

<script>
    /**
     * Función global para abrir dinámicamente la ventana con el chulito desde JavaScript
     */
    window.showSuccessAlert = function(title, message) {
        window.dispatchEvent(new CustomEvent('open-success-modal', {
            detail: { title: title, message: message }
        }));
    };

    window.showErrorAlert = function(title, message) {
        window.dispatchEvent(new CustomEvent('open-error-modal', {
            detail: { title: title, message: message }
        }));
    };

    // Autocierre después de 5.5 segundos si está abierto por sesión
    @if($hasSuccess)
    setTimeout(function() {
        window.dispatchEvent(new CustomEvent('close-success-modal'));
    }, 5500);
    @endif
</script>
