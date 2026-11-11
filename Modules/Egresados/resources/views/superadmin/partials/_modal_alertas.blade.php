
@php
    $hasSuccess = session()->has('success');
    $hasError = session()->has('error');
    $successMsg = session('success', '¡Egresado registrado correctamente!');
    $errorMsg = session('error', 'Ocurrió un error al procesar la solicitud.');
    
    // Detección contextual por tipo de entidad y acción
    $lowerMsg = strtolower($successMsg);

    // Si es un saludo de bienvenida o inicio de sesion, no debe disparar modal de alerta
    if (str_contains($lowerMsg, 'bienvenid') || str_contains($lowerMsg, 'sesion') || str_contains($lowerMsg, 'sesión') || str_contains($lowerMsg, 'iniciado')) {
        $hasSuccess = false;
    }
    $isInvitacion = str_contains($lowerMsg, 'invitaci');
    $isNoticia = str_contains($lowerMsg, 'noticia') || str_contains($lowerMsg, 'comunicado');
    $isInstructor = str_contains($lowerMsg, 'instructor') && !$isNoticia;
    $isEncuesta = str_contains($lowerMsg, 'encuesta');
    $isReporte = str_contains($lowerMsg, 'reporte');
    $isEvento = str_contains($lowerMsg, 'evento');
    $isSeguimiento = str_contains($lowerMsg, 'seguimiento');
    $isImport = str_contains($lowerMsg, 'importad');
    $isSync = str_contains($lowerMsg, 'sincroniz');
    $isUpdated = str_contains($lowerMsg, 'actualiz');
    $isDeleted = str_contains($lowerMsg, 'elimin');
    $isCancelado = str_contains($lowerMsg, 'cancelad');
    $isCerrada = str_contains($lowerMsg, 'cerrad') || str_contains($lowerMsg, 'cierre');
    $isDesactivado = str_contains($lowerMsg, 'desactivad');
    $isActivado = str_contains($lowerMsg, 'activad') && !$isDesactivado;
    $isSolicitudAprobada = str_contains($lowerMsg, 'solicitud') && str_contains($lowerMsg, 'aprobad');
    $isSolicitudRechazada = str_contains($lowerMsg, 'solicitud') && str_contains($lowerMsg, 'rechazad');

    // Título dinámico inteligente
    if ($isInvitacion) {
        $successTitle = '¡Invitación Enviada Correctamente!';
        $badgeText = 'Invitación y enlace de registro enviados a los egresados';
        $tagIcon = 'fa-paper-plane';
        $tagLabel = 'CONVOCATORIA Y EVENTOS · SIGE ERP';
    } elseif ($isNoticia) {
        if ($isDeleted) {
            $successTitle = '¡Noticia Eliminada Exitosamente!';
            $badgeText = 'La noticia ha sido retirada del portal institucional';
            $tagIcon = 'fa-trash-can';
            $tagLabel = 'MÓDULO DE NOTICIAS · SIGE ERP';
        } elseif ($isUpdated) {
            $successTitle = '¡Noticia Actualizada!';
            $badgeText = 'Información y contenido de la noticia guardados con éxito';
            $tagIcon = 'fa-newspaper';
            $tagLabel = 'MÓDULO DE NOTICIAS · SIGE ERP';
        } else {
            $successTitle = '¡Noticia Publicada!';
            $badgeText = 'Noticia publicada y disponible en el portal institucional';
            $tagIcon = 'fa-newspaper';
            $tagLabel = 'MÓDULO DE NOTICIAS · SIGE ERP';
        }
    } elseif ($isEncuesta) {
        if ($isCerrada) {
            $successTitle = '¡Encuesta Cerrada Exitosamente!';
            $badgeText = 'Instrumento cerrado y recolección de respuestas finalizada';
            $tagIcon = 'fa-lock';
            $tagLabel = 'CIERRE DE ENCUESTA · SIGE ERP';
        } elseif ($isDesactivado) {
        $successTitle = '¡Egresado Desactivado Correctamente!';
        $badgeText = 'El egresado ha pasado a estado inactivo en el sistema';
        $tagIcon = 'fa-user-slash';
        $tagLabel = 'GESTIÓN DE ESTADO · SIGE ERP';
    } elseif ($isActivado) {
        $successTitle = '¡Egresado Activado Correctamente!';
        $badgeText = 'El egresado ha sido habilitado nuevamente en el sistema';
        $tagIcon = 'fa-user-check';
        $tagLabel = 'GESTIÓN DE ESTADO · SIGE ERP';
    } elseif ($isUpdated) {
            $successTitle = '¡Encuesta Actualizada Correctamente!';
            $badgeText = 'Información de la encuesta actualizada en el sistema';
            $tagIcon = 'fa-clipboard-question';
            $tagLabel = 'MÓDULO DE ENCUESTAS · SIGE ERP';
        } else {
            $successTitle = '¡Encuesta Registrada Correctamente!';
            $badgeText = 'Encuesta institucional guardada y disponible para egresados';
            $tagIcon = 'fa-clipboard-question';
            $tagLabel = 'MÓDULO DE ENCUESTAS · SIGE ERP';
        }
    } elseif ($isReporte) {
        if ($isDeleted) {
            $successTitle = '¡Reporte Eliminado Correctamente!';
            $badgeText = 'El reporte ha sido retirado del sistema';
            $tagIcon = 'fa-trash-can';
            $tagLabel = 'MÓDULO DE REPORTES · SIGE ERP';
        } else {
            $successTitle = '¡Reporte Generado Exitosamente!';
            $badgeText = 'Parámetros configurados y reporte institucional generado';
            $tagIcon = 'fa-file-circle-check';
            $tagLabel = 'GENERADOR DE REPORTES · SIGE ERP';
        }
    } elseif ($isEvento) {
        if ($isCancelado) {
            $successTitle = '¡Evento Cancelado Correctamente!';
            $badgeText = 'El evento ha sido cancelado en el sistema';
            $tagIcon = 'fa-calendar-xmark';
            $tagLabel = 'GESTIÓN DE EVENTOS SIGE';
        } else {
            $successTitle = $isUpdated ? '¡Evento Actualizado Correctamente!' : '¡Evento Creado Exitosamente!';
            $badgeText = 'Evento institucional programado en el sistema';
            $tagIcon = 'fa-calendar-check';
            $tagLabel = 'GESTIÓN DE EVENTOS SIGE';
        }
    } elseif ($isSeguimiento) {
        $successTitle = '¡Seguimiento Registrado con Éxito!';
        $badgeText = 'Bitácora de seguimiento registrada en el expediente';
        $tagIcon = 'fa-chart-line';
        $tagLabel = 'SEGUIMIENTO A EGRESADOS';
    } elseif ($isInstructor) {
        if ($isUpdated) {
            $successTitle = '¡Instructor Actualizado Correctamente!';
            $badgeText = 'Información del instructor actualizada en la base de datos';
        } elseif ($isDeleted) {
            $successTitle = '¡Instructor Retirado Correctamente!';
            $badgeText = 'Registro de instructor modificado en la base de datos';
        } else {
            $successTitle = '¡Instructor Registrado Correctamente!';
            $badgeText = 'Instructor guardado y verificado en la base de datos';
        }
        $tagIcon = 'fa-chalkboard-user';
        $tagLabel = 'GESTIÓN DE INSTRUCTORES SIGE';
    } elseif ($isSync) {
        $successTitle = '¡Sincronización Completada!';
        $badgeText = 'Datos sincronizados exitosamente con SICA';
        $tagIcon = 'fa-rotate';
        $tagLabel = 'SINCRONIZACIÓN SICA - ERP';
    } elseif ($isImport) {
        $successTitle = '¡Importación Exitosa!';
        $badgeText = 'Egresados cargados y registrados en la base de datos';
        $tagIcon = 'fa-file-excel';
        $tagLabel = 'IMPORTACIÓN MASIVA SIGE';
    } elseif ($isDesactivado) {
        $successTitle = '¡Egresado Desactivado Correctamente!';
        $badgeText = 'El egresado ha pasado a estado inactivo en el sistema';
        $tagIcon = 'fa-user-slash';
        $tagLabel = 'GESTIÓN DE ESTADO · SIGE ERP';
    } elseif ($isSolicitudAprobada) {
        $successTitle = '¡Registro Aprobado Correctamente!';
        $badgeText = 'Egresado validado y habilitado en el portal SIGE';
        $tagIcon = 'fa-user-check';
        $tagLabel = 'APROBACIÓN DE REGISTRO · SIGE ERP';
    } elseif ($isSolicitudRechazada) {
        $successTitle = '¡Solicitud Rechazada Correctamente!';
        $badgeText = 'Solicitud marcada como rechazada en el sistema';
        $tagIcon = 'fa-user-xmark';
        $tagLabel = 'GESTIÓN DE SOLICITUDES · SIGE ERP';
    } elseif ($isActivado) {
        $successTitle = '¡Egresado Activado Correctamente!';
        $badgeText = 'El egresado ha sido habilitado nuevamente en el sistema';
        $tagIcon = 'fa-user-check';
        $tagLabel = 'GESTIÓN DE ESTADO · SIGE ERP';
    } elseif ($isUpdated) {
        $successTitle = '¡Datos Actualizados Correctamente!';
        $badgeText = 'Expediente actualizado y verificado en la base de datos';
        $tagIcon = 'fa-graduation-cap';
        $tagLabel = 'SISTEMA INSTITUCIONAL SIGE';
    } else {
        $successTitle = '¡Egresado Registrado Correctamente!';
        $badgeText = 'Expediente guardado y verificado en la base de datos';
        $tagIcon = 'fa-graduation-cap';
        $tagLabel = 'SISTEMA INSTITUCIONAL SIGE';
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
        background: linear-gradient(135deg, #39A900 0%, #2e8b00 100%);
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
        animation: sena-progress-drain 7.5s linear forwards;
    }

    /* Pausar progreso al interactuar o pasar el mouse para permitir lectura tranquila */
    .sena-modal-card:hover .sena-alert-progress {
        animation-play-state: paused;
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

    .sena-modal-alert-backdrop {
        position: fixed;
        inset: 0;
        z-index: 99999;
        overflow-y: auto;
        background: rgba(0, 19, 30, 0.65);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    
    .sena-modal-card, .sena-modal-card-error {
        position: relative;
        background: #ffffff;
        border-radius: 24px;
        max-width: 440px;
        width: 100%;
        box-shadow: 0 25px 50px -12px rgba(0, 19, 30, 0.35);
        border: 1px solid rgba(57, 169, 0, 0.2);
        overflow: hidden;
        text-align: center;
        padding: 32px 28px;
        font-family: inherit;
        margin: auto;
    }
    .sena-modal-card-error {
        border-color: rgba(239, 68, 68, 0.25);
    }

    .sena-modal-alert-backdrop.show-alert {
        display: flex !important;
    }

    .sena-confirm-glow {
        position: absolute;
        inset: -6px;
        border-radius: 50%;
        animation: sena-pulse-halo 2s ease-in-out infinite;
    }
    .sena-confirm-glow.is-approve {
        background: radial-gradient(circle, rgba(57, 169, 0, 0.28) 0%, rgba(57, 169, 0, 0) 70%);
    }
    .sena-confirm-glow.is-reject {
        background: radial-gradient(circle, rgba(239, 68, 68, 0.28) 0%, rgba(239, 68, 68, 0) 70%);
    }

    .sena-confirm-badge {
        width: 78px;
        height: 78px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: sena-chulito-pop 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        z-index: 2;
    }
    .sena-confirm-badge.is-approve {
        background: linear-gradient(135deg, #39A900 0%, #2e8b00 100%);
        box-shadow: 0 12px 28px -6px rgba(57, 169, 0, 0.45), inset 0 2px 4px rgba(255, 255, 255, 0.35);
    }
    .sena-confirm-badge.is-reject {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        box-shadow: 0 12px 28px -6px rgba(239, 68, 68, 0.45), inset 0 2px 4px rgba(255, 255, 255, 0.35);
    }
</style>

<!-- ============================================== -->
<!-- 1. MODAL DE ÉXITO (DISEÑO OFICIAL SENA ERP) -->
<!-- ============================================== -->
<div id="senaModalSuccessAlert" 
     class="sena-modal-alert-backdrop fixed inset-0 z-[100] overflow-y-auto bg-gray-900/60 backdrop-blur-md flex items-center justify-center p-4 sm:p-6" 
     x-show="openSuccessModal" 
     @open-success-modal.window="openSuccessModal = true; $el.classList.add('show-alert'); $el.style.display = 'flex'; if($event.detail?.title) document.getElementById('modalSuccessTitle').innerText = $event.detail.title; if($event.detail?.message) document.getElementById('modalSuccessMessage').innerText = $event.detail.message; if($event.detail?.badge && document.getElementById('modalSuccessBadgeText')) document.getElementById('modalSuccessBadgeText').innerText = $event.detail.badge;"
     @close-success-modal.window="openSuccessModal = false; $el.classList.remove('show-alert'); $el.style.display = 'none';"
     style="position: fixed; inset: 0; z-index: 99999; background: rgba(0, 19, 30, 0.72); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; padding: 20px;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="window.closeSuccessModal ? window.closeSuccessModal() : (openSuccessModal = false)"
     @click.self="window.closeSuccessModal ? window.closeSuccessModal() : (openSuccessModal = false)"
     x-cloak>
    
    <div class="sena-modal-card"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-90 translate-y-4"
         style="position: relative; background: #ffffff; border-radius: 28px; max-width: 440px; width: 100%; box-shadow: 0 25px 60px -10px rgba(0, 19, 30, 0.45); border: 1.5px solid rgba(57, 169, 0, 0.25); overflow: hidden; text-align: center; padding: 36px 30px; font-family: 'Poppins', 'Nunito', -apple-system, sans-serif; margin: auto;">
        
        <!-- Botón cerrar (X) en esquina superior derecha -->
        <button type="button" 
                onclick="window.closeSuccessModal ? window.closeSuccessModal() : null" 
                @click="openSuccessModal = false"
                style="position: absolute; top: 16px; right: 16px; width: 34px; height: 34px; border-radius: 10px; background: #F1F5F9; border: 1px solid #E2E8F0; color: #64748B; font-size: 14px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;"
                onmouseover="this.style.background='#E2E8F0'; this.style.color='#00131E';"
                onmouseout="this.style.background='#F1F5F9'; this.style.color='#64748B';"
                title="Cerrar">
            <i class="fa-solid fa-xmark"></i>
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

        <!-- Encabezado / Tag Oficial -->
        <div style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 14px; border-radius: 999px; background: #EAF7EE; border: 1px solid #BBF7D0; color: #166534; font-size: 11px; font-weight: 800; letter-spacing: 0.6px; text-transform: uppercase; margin: 0 auto 12px auto;">
            <i id="modalSuccessTagIcon" class="fa-solid {{ $tagIcon }}" style="font-size: 11px; color: #39A900;"></i>
            <span id="modalSuccessTagLabel">{{ $tagLabel }}</span>
        </div>

        <!-- Título Principal -->
        <h3 id="modalSuccessTitle" style="font-size: 22px; font-weight: 800; color: #00131E; margin: 0 0 8px 0; letter-spacing: -0.3px; line-height: 1.25;">
            {{ $successTitle }}
        </h3>

        <!-- Mensaje Detallado -->
        <p id="modalSuccessMessage" style="font-size: 14px; font-weight: 500; color: #5A6E7D; line-height: 1.5; margin: 0 0 16px 0;">
            {{ $successMsg }}
        </p>

        <!-- Badge de Confirmación y Verificación Institucional -->
        <div style="display: flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg, rgba(234, 247, 238, 0.95) 0%, rgba(220, 252, 231, 0.7) 100%); border: 1px solid #BBF7D0; border-radius: 14px; padding: 12px 16px; color: #166534; font-size: 12.5px; font-weight: 700; margin-bottom: 22px; line-height: 1.4;">
            <i class="fa-solid fa-circle-check" style="color: #39A900; font-size: 14px;"></i>
            <span id="modalSuccessBadgeText">{{ $badgeText }}</span>
        </div>

        <!-- Botón de Acción Principal SENA ERP -->
        <div style="margin-top: 6px;">
            <button type="button" 
                    onclick="window.closeSuccessModal ? window.closeSuccessModal() : null" 
                    @click="openSuccessModal = false"
                    style="width: 100%; padding: 14px 24px; background: linear-gradient(135deg, #001A29 0%, #39A900 100%); color: #ffffff !important; font-size: 14px; font-weight: 800; border: none; border-radius: 16px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 10px 24px -4px rgba(57, 169, 0, 0.45), 0 4px 10px rgba(0, 26, 41, 0.25); transition: all 0.25s ease;"
                    onmouseover="this.style.background='linear-gradient(135deg, #00131E 0%, #2e8b00 100%)'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.background='linear-gradient(135deg, #001A29 0%, #39A900 100%)'; this.style.transform='translateY(0)';">
                <i class="fa-solid fa-check" style="font-size: 14px;"></i>
                <span>Aceptar y Continuar</span>
            </button>
        </div>

        <!-- Barra temporizada de autocierre con degradado SENA -->
        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 5px; overflow: hidden;">
            <div class="sena-alert-progress"></div>
        </div>

    </div>
</div>

<!-- ============================================== -->
<!-- 2. MODAL DE ERROR O ADVERTENCIA INSTITUCIONAL  -->
<!-- ============================================== -->
<div id="senaModalErrorAlert" 
     class="sena-modal-alert-backdrop fixed inset-0 z-[100] overflow-y-auto bg-gray-900/60 backdrop-blur-md flex items-center justify-center p-4 sm:p-6" 
     x-show="openErrorModal" 
     @open-error-modal.window="openErrorModal = true; $el.classList.add('show-alert'); $el.style.display = 'flex'; if($event.detail?.title) document.getElementById('modalErrorTitle').innerText = $event.detail.title; if($event.detail?.message) document.getElementById('modalErrorMessage').innerText = $event.detail.message;"
     @close-error-modal.window="openErrorModal = false; $el.classList.remove('show-alert'); $el.style.display = 'none';"
     style="position: fixed; inset: 0; z-index: 99999; background: rgba(0, 19, 30, 0.72); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; padding: 20px;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="window.closeErrorModal ? window.closeErrorModal() : (openErrorModal = false)"
     @click.self="window.closeErrorModal ? window.closeErrorModal() : (openErrorModal = false)"
     x-cloak>
    
    <div class="sena-modal-card-error"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-90 translate-y-4"
         style="position: relative; background: #ffffff; border-radius: 28px; max-width: 440px; width: 100%; box-shadow: 0 25px 60px -10px rgba(0, 19, 30, 0.45); border: 1.5px solid rgba(239, 68, 68, 0.25); overflow: hidden; text-align: center; padding: 36px 30px; font-family: 'Poppins', 'Nunito', -apple-system, sans-serif; margin: auto;">
        
        <!-- Botón cerrar (X) en esquina -->
        <button type="button" 
                onclick="window.closeErrorModal ? window.closeErrorModal() : null" 
                @click="openErrorModal = false"
                style="position: absolute; top: 16px; right: 16px; width: 34px; height: 34px; border-radius: 10px; background: #F1F5F9; border: 1px solid #E2E8F0; color: #64748B; font-size: 14px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;"
                onmouseover="this.style.background='#E2E8F0'; this.style.color='#00131E';"
                onmouseout="this.style.background='#F1F5F9'; this.style.color='#64748B';"
                title="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <!-- Icono de Error / Advertencia Animado -->
        <div class="sena-chulito-container">
            <div class="sena-error-badge">
                <i class="fa-solid fa-triangle-exclamation" style="font-size: 34px; color: #ffffff;"></i>
            </div>
        </div>

        <!-- Tag Institucional -->
        <div style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 14px; border-radius: 999px; background: #FEF2F2; border: 1px solid #FECACA; color: #DC2626; font-size: 11px; font-weight: 800; letter-spacing: 0.6px; text-transform: uppercase; margin: 0 auto 12px auto;">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 11px; color: #DC2626;"></i>
            <span>OBSERVACIÓN INSTITUCIONAL</span>
        </div>

        <h3 id="modalErrorTitle" style="font-size: 22px; font-weight: 800; color: #00131E; margin: 0 0 8px 0; letter-spacing: -0.3px; line-height: 1.25;">
            Atención: Ocurrió un problema
        </h3>

        <p id="modalErrorMessage" style="font-size: 14px; font-weight: 500; color: #5A6E7D; line-height: 1.5; margin: 0 0 22px 0;">
            {{ $errorMsg }}
        </p>

        <!-- Botón Entendido -->
        <div style="margin-top: 6px;">
            <button type="button" 
                    onclick="window.closeErrorModal ? window.closeErrorModal() : null" 
                    @click="openErrorModal = false"
                    style="width: 100%; padding: 14px 24px; background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%); color: #ffffff !important; font-size: 14px; font-weight: 800; border: none; border-radius: 16px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 10px 24px -4px rgba(220, 38, 38, 0.4); transition: all 0.25s ease;"
                    onmouseover="this.style.background='linear-gradient(135deg, #B91C1C 0%, #991B1B 100%)'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.background='linear-gradient(135deg, #DC2626 0%, #B91C1C 100%)'; this.style.transform='translateY(0)';">
                <i class="fa-solid fa-check" style="font-size: 14px;"></i>
                <span>Entendido</span>
            </button>
        </div>

    </div>
</div>

<!-- ============================================== -->
<!-- 3. MODAL DE CONFIRMACIÓN DE ACCIÓN SENA ERP     -->
<!-- ============================================== -->
<div id="senaModalConfirmAction"
     class="sena-modal-alert-backdrop"
     style="position: fixed; inset: 0; z-index: 99999; background: rgba(0, 19, 30, 0.72); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; padding: 20px;">
    <div id="senaModalConfirmCard"
         style="position: relative; background: #ffffff; border-radius: 28px; max-width: 440px; width: 100%; box-shadow: 0 25px 60px -10px rgba(0, 19, 30, 0.45); border: 1.5px solid rgba(57, 169, 0, 0.25); overflow: hidden; text-align: center; padding: 34px 28px; font-family: 'Poppins', 'Nunito', -apple-system, sans-serif; margin: auto;">

        <button type="button"
                onclick="window.closeConfirmModal()"
                style="position: absolute; top: 16px; right: 16px; width: 34px; height: 34px; border-radius: 10px; background: #F1F5F9; border: 1px solid #E2E8F0; color: #64748B; font-size: 14px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;"
                onmouseover="this.style.background='#E2E8F0'; this.style.color='#00131E';"
                onmouseout="this.style.background='#F1F5F9'; this.style.color='#64748B';"
                title="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="sena-chulito-container">
            <div id="confirmModalGlow" class="sena-confirm-glow is-approve"></div>
            <div id="confirmModalBadge" class="sena-confirm-badge is-approve">
                <i id="confirmModalIcon" class="fa-solid fa-user-check" style="font-size: 32px; color: #ffffff;"></i>
            </div>
        </div>

        <div id="confirmModalTagWrap" style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 14px; border-radius: 999px; background: #EAF7EE; border: 1px solid #BBF7D0; color: #166534; font-size: 11px; font-weight: 800; letter-spacing: 0.6px; text-transform: uppercase; margin: 0 auto 12px auto;">
            <i id="confirmModalTagIcon" class="fa-solid fa-shield-check" style="font-size: 11px; color: #39A900;"></i>
            <span id="confirmModalTagLabel">CONFIRMACIÓN INSTITUCIONAL · SIGE ERP</span>
        </div>

        <h3 id="confirmModalTitle" style="font-size: 21px; font-weight: 800; color: #00131E; margin: 0 0 8px 0; letter-spacing: -0.3px; line-height: 1.25;">
            ¿Confirmar acción?
        </h3>

        <p id="confirmModalMessage" style="font-size: 14px; font-weight: 500; color: #5A6E7D; line-height: 1.5; margin: 0 0 16px 0;">
            Por favor confirma esta operación en el sistema.
        </p>

        <div id="confirmModalInfoBox" style="display: flex; align-items: center; justify-content: center; gap: 8px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 11px 15px; color: #334155; font-size: 12.5px; font-weight: 700; margin-bottom: 22px; line-height: 1.4;">
            <i id="confirmModalInfoIcon" class="fa-solid fa-circle-info" style="color: #39A900; font-size: 14px;"></i>
            <span id="confirmModalInfoText">Validación del proceso institucional</span>
        </div>

        <div style="display: flex; gap: 10px; align-items: center;">
            <button type="button"
                    id="confirmModalCancelBtn"
                    onclick="window.closeConfirmModal()"
                    style="flex: 1; padding: 13px 16px; background: #F1F5F9; color: #475569; font-size: 13.5px; font-weight: 700; border: 1px solid #E2E8F0; border-radius: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.2s ease;"
                    onmouseover="this.style.background='#E2E8F0'; this.style.color='#00131E';"
                    onmouseout="this.style.background='#F1F5F9'; this.style.color='#475569';">
                <span>Cancelar</span>
            </button>
            <button type="button"
                    id="confirmModalAcceptBtn"
                    style="flex: 1.4; padding: 13px 18px; background: linear-gradient(135deg, #001A29 0%, #39A900 100%); color: #ffffff; font-size: 13.5px; font-weight: 800; border: none; border-radius: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 10px 22px -4px rgba(57, 169, 0, 0.4); transition: all 0.2s ease;">
                <i class="fa-solid fa-check"></i>
                <span id="confirmModalAcceptText">Confirmar</span>
            </button>
        </div>
    </div>
</div>

<script>
    /**
     * Función global para abrir dinámicamente la ventana con el chulito desde JavaScript
     */
    let successAlertTimer = null;
    let successStartTime = 0;
    const SUCCESS_DURATION = 7500; // 7.5 segundos (3 segundos adicionales para permitir una lectura tranquila)
    let successRemaining = SUCCESS_DURATION;
    let pendingSuccessOnClose = null;

    function clearSuccessTimer() {
        if (successAlertTimer) {
            clearTimeout(successAlertTimer);
            successAlertTimer = null;
        }
    }

    function startSuccessTimer(duration) {
        clearSuccessTimer();
        successStartTime = Date.now();
        successRemaining = duration;
        successAlertTimer = setTimeout(function() {
            window.closeSuccessModal();
        }, successRemaining);
    }

    function pauseSuccessTimer() {
        if (successAlertTimer) {
            clearSuccessTimer();
            successRemaining -= (Date.now() - successStartTime);
            if (successRemaining < 1000) successRemaining = 1000;
        }
    }

    window.showSuccessAlert = function(title, message, badge, optionsOrOnClose) {
        const modal = document.getElementById('senaModalSuccessAlert');
        const opts = (typeof optionsOrOnClose === 'function')
            ? { onClose: optionsOrOnClose }
            : (optionsOrOnClose || {});
        pendingSuccessOnClose = typeof opts.onClose === 'function' ? opts.onClose : null;

        if (modal) {
            modal.classList.add('show-alert');
            modal.style.display = 'flex';
        }
        if (title && document.getElementById('modalSuccessTitle')) {
            document.getElementById('modalSuccessTitle').innerText = title;
        }
        if (message && document.getElementById('modalSuccessMessage')) {
            document.getElementById('modalSuccessMessage').innerText = message;
        }
        if (badge && document.getElementById('modalSuccessBadgeText')) {
            document.getElementById('modalSuccessBadgeText').innerText = badge;
        }
        if (opts.tag && document.getElementById('modalSuccessTagLabel')) {
            document.getElementById('modalSuccessTagLabel').innerText = opts.tag;
        }
        if (opts.icon && document.getElementById('modalSuccessTagIcon')) {
            document.getElementById('modalSuccessTagIcon').className = 'fa-solid ' + opts.icon;
        }
        window.dispatchEvent(new CustomEvent('open-success-modal', {
            detail: { title: title, message: message, badge: badge }
        }));

        const checkBadge = modal ? modal.querySelector('.sena-chulito-badge') : null;
        const checkPath = modal ? modal.querySelector('.sena-chulito-path') : null;
        if (checkBadge) {
            checkBadge.style.animation = 'none';
            void checkBadge.offsetWidth;
            checkBadge.style.animation = '';
        }
        if (checkPath) {
            checkPath.style.animation = 'none';
            void checkPath.offsetWidth;
            checkPath.style.animation = '';
        }

        const progressBar = document.querySelector('.sena-alert-progress');
        if (progressBar) {
            progressBar.style.animation = 'none';
            void progressBar.offsetWidth;
            progressBar.style.animation = 'sena-progress-drain ' + (SUCCESS_DURATION / 1000) + 's linear forwards';
        }
        startSuccessTimer(SUCCESS_DURATION);
    };

    window.closeSuccessModal = function() {
        const modal = document.getElementById('senaModalSuccessAlert');
        if (modal) {
            modal.classList.remove('show-alert');
            modal.style.display = 'none';
        }
        window.dispatchEvent(new CustomEvent('close-success-modal'));
        clearSuccessTimer();
        if (typeof pendingSuccessOnClose === 'function') {
            const cb = pendingSuccessOnClose;
            pendingSuccessOnClose = null;
            cb();
        }
    };

    window.showErrorAlert = function(title, message) {
        const modal = document.getElementById('senaModalErrorAlert');
        if (modal) {
            modal.classList.add('show-alert');
            modal.style.display = 'flex';
        }
        if (title && document.getElementById('modalErrorTitle')) {
            document.getElementById('modalErrorTitle').innerText = title;
        }
        if (message && document.getElementById('modalErrorMessage')) {
            document.getElementById('modalErrorMessage').innerText = message;
        }
        window.dispatchEvent(new CustomEvent('open-error-modal', {
            detail: { title: title, message: message }
        }));
    };

    window.closeErrorModal = function() {
        const modal = document.getElementById('senaModalErrorAlert');
        if (modal) {
            modal.classList.remove('show-alert');
            modal.style.display = 'none';
        }
        window.dispatchEvent(new CustomEvent('close-error-modal'));
    };

    let confirmActionCallback = null;

    window.closeConfirmModal = function() {
        const modal = document.getElementById('senaModalConfirmAction');
        if (modal) {
            modal.classList.remove('show-alert');
            modal.style.display = 'none';
        }
        const acceptBtn = document.getElementById('confirmModalAcceptBtn');
        const cancelBtn = document.getElementById('confirmModalCancelBtn');
        if (acceptBtn) acceptBtn.disabled = false;
        if (cancelBtn) cancelBtn.disabled = false;
        confirmActionCallback = null;
    };

    window.showConfirmModal = function(config) {
        const modal = document.getElementById('senaModalConfirmAction');
        if (!modal) return;
        const isReject = config?.variant === 'reject';

        const card = document.getElementById('senaModalConfirmCard');
        const glow = document.getElementById('confirmModalGlow');
        const badge = document.getElementById('confirmModalBadge');
        const icon = document.getElementById('confirmModalIcon');
        const tagWrap = document.getElementById('confirmModalTagWrap');
        const tagIcon = document.getElementById('confirmModalTagIcon');
        const tagLabel = document.getElementById('confirmModalTagLabel');
        const infoBox = document.getElementById('confirmModalInfoBox');
        const infoIcon = document.getElementById('confirmModalInfoIcon');
        const acceptBtn = document.getElementById('confirmModalAcceptBtn');

        if (card) {
            card.style.borderColor = isReject ? 'rgba(239, 68, 68, 0.25)' : 'rgba(57, 169, 0, 0.25)';
        }
        if (glow) {
            glow.className = 'sena-confirm-glow ' + (isReject ? 'is-reject' : 'is-approve');
        }
        if (badge) {
            badge.className = 'sena-confirm-badge ' + (isReject ? 'is-reject' : 'is-approve');
            badge.style.animation = 'none';
            void badge.offsetWidth;
            badge.style.animation = '';
        }
        if (icon) {
            icon.className = 'fa-solid ' + (config?.icon || (isReject ? 'fa-user-xmark' : 'fa-user-check'));
        }
        if (tagWrap) {
            tagWrap.style.background = isReject ? '#FEF2F2' : '#EAF7EE';
            tagWrap.style.borderColor = isReject ? '#FECACA' : '#BBF7D0';
            tagWrap.style.color = isReject ? '#DC2626' : '#166534';
        }
        if (tagIcon) {
            tagIcon.className = 'fa-solid ' + (config?.tagIcon || (isReject ? 'fa-triangle-exclamation' : 'fa-user-check'));
            tagIcon.style.color = isReject ? '#DC2626' : '#39A900';
        }
        if (tagLabel) {
            tagLabel.innerText = config?.tag || 'CONFIRMACIÓN INSTITUCIONAL · SIGE ERP';
        }
        if (infoBox) {
            infoBox.style.background = isReject ? '#FEF2F2' : 'linear-gradient(135deg, rgba(234, 247, 238, 0.95) 0%, rgba(220, 252, 231, 0.7) 100%)';
            infoBox.style.borderColor = isReject ? '#FECACA' : '#BBF7D0';
            infoBox.style.color = isReject ? '#991B1B' : '#166534';
        }
        if (infoIcon) {
            infoIcon.className = 'fa-solid ' + (isReject ? 'fa-circle-exclamation' : 'fa-circle-check');
            infoIcon.style.color = isReject ? '#DC2626' : '#39A900';
        }
        if (document.getElementById('confirmModalTitle')) {
            document.getElementById('confirmModalTitle').innerText = config?.title || '¿Confirmar acción?';
        }
        if (document.getElementById('confirmModalMessage')) {
            document.getElementById('confirmModalMessage').innerText = config?.message || '';
        }
        if (document.getElementById('confirmModalInfoText')) {
            document.getElementById('confirmModalInfoText').innerText = config?.badge || '';
        }
        if (acceptBtn) {
            acceptBtn.disabled = false;
            acceptBtn.style.background = isReject
                ? 'linear-gradient(135deg, #EF4444 0%, #DC2626 100%)'
                : 'linear-gradient(135deg, #001A29 0%, #39A900 100%)';
            acceptBtn.style.boxShadow = isReject
                ? '0 10px 22px -4px rgba(220, 38, 38, 0.4)'
                : '0 10px 22px -4px rgba(57, 169, 0, 0.45)';
            acceptBtn.innerHTML = '<i class="fa-solid ' + (isReject ? 'fa-xmark' : 'fa-check') + '"></i><span>' + (config?.confirmText || 'Confirmar') + '</span>';
        }
        const cancelBtn = document.getElementById('confirmModalCancelBtn');
        if (cancelBtn) cancelBtn.disabled = false;

        confirmActionCallback = typeof config?.onConfirm === 'function' ? config.onConfirm : null;
        if (acceptBtn) {
            acceptBtn.onclick = function() {
                if (!confirmActionCallback) {
                    window.closeConfirmModal();
                    return;
                }
                acceptBtn.disabled = true;
                if (cancelBtn) cancelBtn.disabled = true;
                acceptBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i><span>Procesando...</span>';
                confirmActionCallback();
            };
        }

        modal.classList.add('show-alert');
        modal.style.display = 'flex';
    };

    window.handleSolicitudRegistro = function(action, solId, btn) {
        if (!solId) return;
        const card = btn && btn.closest ? btn.closest('[id^="sol-card-"]') : null;
        const nombre = card?.dataset?.solNombre || 'el egresado';
        const documento = card?.dataset?.solDocumento || '';
        const docTxt = documento ? ' (Doc. ' + documento + ')' : '';
        const isReject = action === 'rechazar';

        window.showConfirmModal({
            variant: isReject ? 'reject' : 'approve',
            tag: isReject ? 'RECHAZO DE SOLICITUD · SIGE ERP' : 'APROBACIÓN DE REGISTRO · SIGE ERP',
            title: isReject ? '¿Rechazar solicitud de registro?' : '¿Aprobar solicitud de registro?',
            message: isReject
                ? 'La solicitud de registro de ' + nombre + docTxt + ' será marcada como rechazada en el sistema.'
                : 'Se validará el registro de ' + nombre + docTxt + ' y se habilitará su acceso al portal SIGE.',
            badge: isReject
                ? 'El solicitante no podrá acceder al portal con esta solicitud'
                : 'El egresado quedará certificado y autorizado para ingresar',
            confirmText: isReject ? 'Sí, Rechazar Solicitud' : 'Sí, Aprobar Registro',
            onConfirm: function() {
                fetch('{{ url("egresados/solicitudes") }}/' + encodeURIComponent(solId) + '/' + action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(async function(r) {
                    const data = await r.json().catch(function() { return {}; });
                    if (!r.ok || !data.success) {
                        throw new Error(data.message || 'No se pudo procesar la solicitud.');
                    }
                    return data;
                })
                .then(function(data) {
                    window.closeConfirmModal();
                    if (card) {
                        card.style.transition = 'all 0.25s ease';
                        card.style.opacity = '0.45';
                    }
                    window.showSuccessAlert(
                        isReject ? '¡Solicitud Rechazada Correctamente!' : '¡Registro Aprobado Correctamente!',
                        data.message || (isReject
                            ? 'La solicitud de ' + nombre + ' fue rechazada correctamente.'
                            : 'El registro de ' + nombre + ' fue aprobado y ya puede ingresar al portal SIGE.'),
                        isReject
                            ? 'Solicitud marcada como rechazada en el sistema'
                            : 'Egresado validado y habilitado en el portal SIGE',
                        {
                            tag: isReject ? 'GESTIÓN DE SOLICITUDES · SIGE ERP' : 'APROBACIÓN DE REGISTRO · SIGE ERP',
                            icon: isReject ? 'fa-user-xmark' : 'fa-user-check',
                            onClose: function() { window.location.reload(); }
                        }
                    );
                })
                .catch(function(err) {
                    window.closeConfirmModal();
                    window.showErrorAlert(
                        'Atención al Procesar Solicitud',
                        err?.message || 'Ocurrió un error inesperado al procesar la solicitud.'
                    );
                });
            }
        });
    };

    document.addEventListener('DOMContentLoaded', function() {
        const successModal = document.getElementById('senaModalSuccessAlert');
        const errorModal = document.getElementById('senaModalErrorAlert');
        const confirmModal = document.getElementById('senaModalConfirmAction');

        if (successModal) {
            successModal.addEventListener('click', function(e) {
                if (e.target === successModal) window.closeSuccessModal();
            });
        }
        if (errorModal) {
            errorModal.addEventListener('click', function(e) {
                if (e.target === errorModal) window.closeErrorModal();
            });
        }
        if (confirmModal) {
            confirmModal.addEventListener('click', function(e) {
                if (e.target === confirmModal) window.closeConfirmModal();
            });
        }
        document.addEventListener('keydown', function(e) {
            if (e.key !== 'Escape') return;
            if (confirmModal && confirmModal.classList.contains('show-alert')) window.closeConfirmModal();
            if (errorModal && errorModal.classList.contains('show-alert')) window.closeErrorModal();
            if (successModal && successModal.classList.contains('show-alert')) window.closeSuccessModal();
        });
    });

    // Autocierre después de 7.5 segundos si está abierto por sesión, con pausa interactiva al pasar el mouse
    @if($hasSuccess)
    document.addEventListener('DOMContentLoaded', function() {
        window.showSuccessAlert(@json($successTitle), @json($successMsg));
    });
    startSuccessTimer(SUCCESS_DURATION);

    document.addEventListener('DOMContentLoaded', function() {
        const successCard = document.querySelector('.sena-modal-card');
        if (successCard) {
            successCard.addEventListener('mouseenter', pauseSuccessTimer);
            successCard.addEventListener('mouseleave', function() {
                if (successRemaining > 0) {
                    startSuccessTimer(successRemaining);
                }
            });
        }
    });
    @endif

    @if($hasError)
    document.addEventListener('DOMContentLoaded', function() {
        window.showErrorAlert("Atención en el Registro", @json($errorMsg));
    });
    @endif
    
</script>
