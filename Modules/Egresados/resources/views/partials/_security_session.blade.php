<!-- ========================================================================= -->
<!-- MÓDULO SIGE - SISTEMA INTEGRADO DE SEGURIDAD Y CONTROL DE SESIÓN           -->
<!-- Cierre automático a los 5 minutos exactos de inactividad humana real        -->
<!-- Advertencia visual con cuenta regresiva de 60 segundos                     -->
<!-- Protección estricta contra navegación mediante flechas del navegador       -->
<!-- ========================================================================= -->

@auth
<!-- Modal Accesible de Advertencia de Inactividad de Sesión -->
<div id="sigeInactivityModal" class="sige-security-modal-overlay" style="display: none;" role="dialog" aria-modal="true" aria-labelledby="sigeModalTitle">
    <div class="sige-security-modal-card">
        <div class="sige-modal-header-icon">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </div>

        <h3 id="sigeModalTitle" class="sige-modal-title">Tu sesión está a punto de expirar</h3>
        
        <p class="sige-modal-desc">
            Por motivos de seguridad institucional y protección de datos confidenciales, tu sesión se cerrará automáticamente por inactividad.
        </p>

        <!-- Contador regresivo circular / barra de progreso -->
        <div class="sige-countdown-container">
            <div class="sige-countdown-badge">
                <i class="fa-solid fa-hourglass-half me-1"></i>
                <span>Tiempo restante:</span>
                <strong id="sigeTimerSeconds" class="sige-timer-number">60</strong>
                <span>segundos</span>
            </div>
            <div class="sige-progress-track">
                <div id="sigeProgressBar" class="sige-progress-fill" style="width: 100%;"></div>
            </div>
        </div>

        <div class="sige-modal-actions">
            <button type="button" id="btnKeepSessionAlive" class="sige-btn-keep-alive" onclick="sigeSecurityEngine.keepAliveManual()">
                <i class="fa-solid fa-circle-check me-1"></i>
                <span>Mantener mi sesión activa</span>
            </button>
            <button type="button" class="sige-btn-close-now" onclick="sigeSecurityEngine.cerrarSesionAhora()">
                <i class="fa-solid fa-arrow-right-from-bracket me-1"></i>
                <span>Cerrar sesión ahora</span>
            </button>
        </div>
    </div>
</div>

<style>
.sige-security-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 19, 30, 0.78);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    animation: sigeFadeIn 0.25s ease-out;
}

.sige-security-modal-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(0, 0, 0, 0.08);
    width: 100%;
    max-width: 480px;
    padding: 32px 28px;
    text-align: center;
    position: relative;
    overflow: hidden;
    animation: sigeSlideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    font-family: 'Poppins', 'Nunito', system-ui, -apple-system, sans-serif;
}

.sige-modal-header-icon {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #fef3c7;
    color: #d97706;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin: 0 auto 18px auto;
    border: 3px solid #fde68a;
    animation: sigePulse 2s infinite;
}

.sige-modal-title {
    font-size: 20px;
    font-weight: 700;
    color: #001A29;
    margin: 0 0 10px 0;
    line-height: 1.3;
}

.sige-modal-desc {
    font-size: 13.5px;
    color: #4b5563;
    line-height: 1.5;
    margin: 0 0 22px 0;
}

.sige-countdown-container {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px 18px;
    margin-bottom: 24px;
}

.sige-countdown-badge {
    font-size: 14px;
    font-weight: 600;
    color: #1e293b;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-bottom: 10px;
}

.sige-timer-number {
    font-size: 22px;
    font-weight: 800;
    color: #dc2626;
    min-width: 32px;
    display: inline-block;
}

.sige-progress-track {
    width: 100%;
    height: 8px;
    background: #e2e8f0;
    border-radius: 999px;
    overflow: hidden;
}

.sige-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #39A900, #d97706, #dc2626);
    border-radius: 999px;
    transition: width 1s linear;
}

.sige-modal-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.sige-btn-keep-alive {
    background: #39A900;
    color: #ffffff;
    border: none;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 700;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 4px 12px rgba(57, 169, 0, 0.3);
}

.sige-btn-keep-alive:hover {
    background: #2d8500;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(57, 169, 0, 0.4);
}

.sige-btn-close-now {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #cbd5e1;
    padding: 10px 18px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.sige-btn-close-now:hover {
    background: #fee2e2;
    color: #991b1b;
    border-color: #fca5a5;
}

@keyframes sigeFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes sigeSlideUp {
    from { transform: translateY(16px) scale(0.97); opacity: 0; }
    to { transform: translateY(0) scale(1); opacity: 1; }
}

@keyframes sigePulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.06); }
}
</style>

<script>
/**
 * Motor de Seguridad Institucional SIGE:
 * - Detección de actividad humana genuina (teclado, mouse, scroll, tacto)
 * - Expiración a los 5 minutos exactos (300 segundos)
 * - Advertencia visual y cuenta regresiva a los 60 segundos restantes
 * - Sincronización multi-pestaña mediante localStorage
 * - Protección contra restauración de páginas desde bfcache (Atrás/Adelante/Recargar)
 */
window.sigeSecurityEngine = (function() {
    'use strict';

    const TIMEOUT_SECONDS = {{ (int) config('egresados.security.session_timeout_seconds', 300) }};
    const WARNING_SECONDS = {{ (int) config('egresados.security.session_warning_seconds', 60) }};
    const CHECK_URL = "{{ route('egresados.session.check') }}";
    const KEEP_ALIVE_URL = "{{ route('egresados.session.keep_alive') }}";
    const LOGIN_URL = "{{ route('egresados.login', ['inactivity' => 1]) }}";
    const LOGOUT_URL = "{{ route('egresados.logout') }}";
    const CSRF_TOKEN = "{{ csrf_token() }}";

    const STORAGE_KEY_LAST_ACTIVITY = 'sige_last_human_interaction';
    const STORAGE_KEY_LOGOUT = 'sige_session_logout_event';

    let lastHumanActivityTime = Date.now();
    let isWarningModalOpen = false;
    let tickerInterval = null;
    let lastKeepAliveSentTime = Date.now();
    let isTerminating = false;

    // Inicializar timestamp compartido en localStorage
    try {
        localStorage.setItem(STORAGE_KEY_LAST_ACTIVITY, Date.now().toString());
    } catch (e) {}

    /**
     * Registra una interacción humana genuina.
     */
    function recordHumanActivity() {
        if (isTerminating) return;
        
        const now = Date.now();
        lastHumanActivityTime = now;

        try {
            localStorage.setItem(STORAGE_KEY_LAST_ACTIVITY, now.toString());
        } catch (e) {}

        // Si el modal de advertencia estaba abierto y el usuario interactúa activamente, se mantiene activa
        if (isWarningModalOpen) {
            hideWarningModal();
            sendKeepAlivePing();
        } else {
            // Renovar en el servidor con throttle (máximo una vez cada 60 segundos de actividad continua)
            if (now - lastKeepAliveSentTime > 60000) {
                sendKeepAlivePing();
            }
        }
    }

    /**
     * Envía ping de actividad humana confirmada al backend.
     */
    function sendKeepAlivePing() {
        if (isTerminating) return;
        lastKeepAliveSentTime = Date.now();

        fetch(KEEP_ALIVE_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ human: true })
        }).then(function(res) {
            if (res.status === 401) {
                triggerSessionTermination();
            }
        }).catch(function() {});
    }

    /**
     * Muestra el modal de advertencia de 60 segundos restantes.
     */
    function showWarningModal(remainingSecs) {
        if (isWarningModalOpen || isTerminating) return;
        isWarningModalOpen = true;

        const modal = document.getElementById('sigeInactivityModal');
        if (modal) {
            modal.style.display = 'flex';
            updateModalUI(remainingSecs);
        }
    }

    /**
     * Oculta el modal de advertencia.
     */
    function hideWarningModal() {
        isWarningModalOpen = false;
        const modal = document.getElementById('sigeInactivityModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    /**
     * Actualiza los elementos numéricos y la barra de progreso del modal.
     */
    function updateModalUI(remainingSecs) {
        const timerElem = document.getElementById('sigeTimerSeconds');
        const progressBar = document.getElementById('sigeProgressBar');

        if (timerElem) {
            timerElem.textContent = Math.max(0, remainingSecs);
        }
        if (progressBar) {
            const pct = Math.max(0, Math.min(100, (remainingSecs / WARNING_SECONDS) * 100));
            progressBar.style.width = pct + '%';
        }
    }

    /**
     * Ejecuta el cierre de sesión y redirección por expiración de inactividad.
     */
    function triggerSessionTermination() {
        if (isTerminating) return;
        isTerminating = true;

        if (tickerInterval) clearInterval(tickerInterval);
        hideWarningModal();

        try {
            localStorage.setItem(STORAGE_KEY_LOGOUT, Date.now().toString());
        } catch (e) {}

        // Redirigir al login mostrando el mensaje exacto
        window.location.replace(LOGIN_URL);
    }

    /**
     * Función ejecutada periódicamente cada segundo para evaluar el tiempo restante.
     */
    function tick() {
        if (isTerminating) return;

        // Leer timestamp de última interacción (permite sincronización entre pestañas)
        let lastSharedTime = lastHumanActivityTime;
        try {
            const stored = localStorage.getItem(STORAGE_KEY_LAST_ACTIVITY);
            if (stored) {
                const parsed = parseInt(stored, 10);
                if (!isNaN(parsed) && parsed > lastHumanActivityTime) {
                    lastHumanActivityTime = parsed;
                    lastSharedTime = parsed;
                }
            }
        } catch (e) {}

        const now = Date.now();
        const elapsedSeconds = Math.floor((now - lastSharedTime) / 1000);
        const remainingSeconds = Math.max(0, TIMEOUT_SECONDS - elapsedSeconds);

        if (remainingSeconds <= 0) {
            triggerSessionTermination();
            return;
        }

        if (remainingSeconds <= WARNING_SECONDS) {
            showWarningModal(remainingSeconds);
            updateModalUI(remainingSeconds);
        } else if (isWarningModalOpen) {
            hideWarningModal();
        }
    }

    /**
     * Verificación pasiva contra el servidor (cada 15 segundos).
     * No renueva la sesión del servidor: las solicitudes automáticas no son actividad humana.
     */
    function passiveServerCheck() {
        if (isTerminating) return;

        fetch(CHECK_URL, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-Background-Ping': 'true',
                'Accept': 'application/json'
            }
        }).then(function(res) {
            if (res.status === 401) {
                triggerSessionTermination();
                return null;
            }
            return res.json();
        }).then(function(data) {
            if (!data) return;
            if (data.expired || data.remaining_seconds <= 0) {
                triggerSessionTermination();
            }
        }).catch(function() {});
    }

    /**
     * Configurar escuchas de eventos de actividad humana real.
     */
    function initEventListeners() {
        const humanEvents = ['mousemove', 'mousedown', 'keydown', 'scroll', 'touchstart', 'click'];
        let throttleTimer = null;

        humanEvents.forEach(function(evtName) {
            window.addEventListener(evtName, function() {
                if (!throttleTimer) {
                    throttleTimer = setTimeout(function() {
                        throttleTimer = null;
                        recordHumanActivity();
                    }, 500);
                }
            }, { passive: true });
        });

        // Escuchar cambios en localStorage para sincronizar con otras pestañas
        window.addEventListener('storage', function(e) {
            if (e.key === STORAGE_KEY_LAST_ACTIVITY) {
                const newTime = parseInt(e.newValue, 10);
                if (!isNaN(newTime) && newTime > lastHumanActivityTime) {
                    lastHumanActivityTime = newTime;
                    if (isWarningModalOpen) {
                        hideWarningModal();
                    }
                }
            } else if (e.key === STORAGE_KEY_LOGOUT) {
                triggerSessionTermination();
            }
        });

        // =====================================================================
        // PROTECCIÓN CONTRA FLECHAS ATRÁS / ADELANTE / RECARGAR (bfcache)
        // =====================================================================
        window.addEventListener('pageshow', function(event) {
            // Si la página se recuperó desde la caché Back-Forward (bfcache), forzar recarga del servidor
            if (event.persisted || (window.performance && window.performance.navigation && window.performance.navigation.type === 2)) {
                window.location.reload();
            } else {
                passiveServerCheck();
            }
        });
    }

    // Inicialización del motor
    initEventListeners();
    tickerInterval = setInterval(tick, 1000);
    setInterval(passiveServerCheck, 15000);

    return {
        keepAliveManual: function() {
            recordHumanActivity();
            sendKeepAlivePing();
            hideWarningModal();
        },
        cerrarSesionAhora: function() {
            isTerminating = true;
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = LOGOUT_URL;

            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = CSRF_TOKEN;
            form.appendChild(tokenInput);

            document.body.appendChild(form);
            form.submit();
        }
    };
})();
</script>
@endauth

