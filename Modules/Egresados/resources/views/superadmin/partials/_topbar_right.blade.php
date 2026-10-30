<!-- Modules/Egresados/resources/views/superadmin/partials/_topbar_right.blade.php -->
<div class="topbar-right-wrapper" style="display:flex; align-items:center; gap:16px; position:relative;">
  
  <!-- ================= NOTIFICACIONES ================= -->
  <div class="notif-dropdown-container" style="position:relative;">
    <button type="button" class="icon-btn notif-toggle-btn" id="notifBtn" title="Notificaciones" aria-label="Notificaciones" onclick="toggleNotificationDropdown(event)">
      <i class="fa-regular fa-bell"></i>
      <span class="dot notif-badge-dot" id="notifBadgeDot" style="display:flex;"></span>
    </button>

    <!-- Menú Desplegable de Notificaciones -->
    <div id="notifDropdownMenu" class="dropdown-panel notif-dropdown-menu" style="display:none;">
      <div class="dropdown-header">
        <div class="dropdown-header-title">
          <i class="fa-solid fa-bell" style="color:var(--green, #39A900);"></i>
          <span style="font-weight:700; font-size:14px; color:#001A29;">Notificaciones</span>
          <span class="badge-count" id="notifCountBadge">4 nuevas</span>
        </div>
        <button type="button" class="btn-mark-all-read" onclick="markAllNotificationsAsRead(event)">
          Marcar como leídas
        </button>
      </div>

      <div class="notif-list" id="notifItemsList">
        
        <!-- Notificación 1 -->
        <div class="notif-item unread" onclick="markNotificationRead(this)">
          <div class="notif-icon bg-green-light">
            <i class="fa-solid fa-briefcase" style="color:#0d6928;"></i>
          </div>
          <div class="notif-content">
            <div class="notif-text">
              <strong>Juan Pérez</strong> (ADSO) actualizó su información laboral a <em>Empleado</em>.
            </div>
            <div class="notif-meta">
              <span class="notif-time"><i class="fa-regular fa-clock"></i> Hace 20 min</span>
              <span class="unread-dot"></span>
            </div>
          </div>
        </div>

        <!-- Notificación 2 -->
        <div class="notif-item unread" onclick="markNotificationRead(this)">
          <div class="notif-icon bg-blue-light">
            <i class="fa-solid fa-clipboard-check" style="color:#1e40af;"></i>
          </div>
          <div class="notif-content">
            <div class="notif-text">
              Se cerró la encuesta <strong>"Seguimiento laboral 2026-1"</strong> con 85% de participación.
            </div>
            <div class="notif-meta">
              <span class="notif-time"><i class="fa-regular fa-clock"></i> Hace 3 horas</span>
              <span class="unread-dot"></span>
            </div>
          </div>
        </div>

        <!-- Notificación 3 -->
        <div class="notif-item unread" onclick="markNotificationRead(this)">
          <div class="notif-icon bg-amber-light">
            <i class="fa-solid fa-calendar-check" style="color:#b45309;"></i>
          </div>
          <div class="notif-content">
            <div class="notif-text">
              Próximo evento institucional: <strong>Feria Laboral 2026</strong> en Auditorio Principal.
            </div>
            <div class="notif-meta">
              <span class="notif-time"><i class="fa-regular fa-clock"></i> Ayer</span>
              <span class="unread-dot"></span>
            </div>
          </div>
        </div>

        <!-- Notificación 4 -->
        <div class="notif-item unread" onclick="markNotificationRead(this)">
          <div class="notif-icon bg-purple-light">
            <i class="fa-solid fa-user-plus" style="color:#6b21a8;"></i>
          </div>
          <div class="notif-content">
            <div class="notif-text">
              <strong>15 egresados</strong> completaron su registro en el portal este mes.
            </div>
            <div class="notif-meta">
              <span class="notif-time"><i class="fa-regular fa-clock"></i> Hace 2 días</span>
              <span class="unread-dot"></span>
            </div>
          </div>
        </div>

      </div>

      <div class="dropdown-footer">
        <a href="{{ route('egresados.index') }}" class="dropdown-footer-link">
          <span>Ver todos los egresados y seguimientos</span>
          <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
        </a>
      </div>
    </div>
  </div>


  <!-- ================= MENÚ DESPLEGABLE USUARIO ================= -->
  <div class="user-dropdown-container" style="position:relative;">
    <div class="user-chip" id="userChipBtn" title="Menú de usuario" onclick="toggleUserDropdown(event)">
      <div class="user-avatar">
        @auth
          {{ Auth::user()->initials }}
        @else
          SA
        @endauth
      </div>
      <span>
        @auth
          {{ Auth::user()->full_name }}
        @else
          Super Administrador SIGE
        @endauth
      </span>
      <i class="fa-solid fa-chevron-down user-chevron-icon ms-1" id="userChevronIcon"></i>
    </div>

    <!-- Menú Desplegable del Usuario -->
    <div id="userDropdownMenu" class="dropdown-panel user-dropdown-menu" style="display:none;">
      
      <!-- Encabezado del perfil -->
      <div class="user-menu-header">
        <div class="user-menu-avatar">
          @auth
            {{ Auth::user()->initials }}
          @else
            SA
          @endauth
        </div>
        <div class="user-menu-info">
          <div class="user-menu-name">
            @auth
              {{ Auth::user()->full_name }}
            @else
              Super Administrador SIGE
            @endauth
          </div>
          <div class="user-menu-email">
            @auth
              {{ Auth::user()->email }}
            @else
              superadmin.egresados@sena.edu.co
            @endauth
          </div>
          <div class="user-menu-role">
            <i class="fa-solid fa-shield-halved"></i>
            <span>{{ Auth::check() ? (Auth::user()->primary_role ?? 'Super Administrador') : 'Super Administrador' }}</span>
          </div>
        </div>
      </div>

      <!-- Opciones del Menú -->
      <div class="user-menu-body">
        
        <a href="{{ route('home') }}" class="user-menu-item">
          <div class="menu-item-icon bg-blue-icon">
            <i class="fa-solid fa-layer-group"></i>
          </div>
          <div class="menu-item-content">
            <div class="menu-item-title">Panel ERP Principal</div>
            <div class="menu-item-desc">Menú general de SENA Empresa</div>
          </div>
        </a>

      </div>

      <!-- Footer con Botón Cerrar Sesión -->
      <div class="user-menu-footer">
        <form id="form-logout-topbar" action="{{ route('logout') }}" method="POST">
          @csrf
          <input type="hidden" name="redirect" value="{{ route('egresados.welcome') }}">
          <button type="submit" class="btn-logout-dropdown">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Cerrar Sesión</span>
          </button>
        </form>
      </div>

    </div>
  </div>

</div>

<style>
  /* ================= VIEW TRANSITIONS & TRANSICIONES SUAVES ================= */
  @view-transition {
    navigation: auto;
  }

  ::view-transition-old(root) {
    animation: 160ms cubic-bezier(0.16, 1, 0.3, 1) both sigeFadeOut;
  }
  ::view-transition-new(root) {
    animation: 220ms cubic-bezier(0.16, 1, 0.3, 1) both sigeFadeIn;
  }

  @keyframes sigeFadeOut {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(-4px); }
  }

  @keyframes sigeFadeIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Mantener el sidebar y topbar firmes durante la navegación sin saltos */
  .sidebar {
    view-transition-name: sige-sidebar;
  }
  .topbar {
    view-transition-name: sige-topbar;
  }

  /* Animación de entrada suave del contenido principal */
  .content, .content-area {
    animation: sigePageEnter 0.28s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }

  @keyframes sigePageEnter {
    from {
      opacity: 0;
      transform: translateY(6px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Estilo durante la salida suave al hacer clic en un módulo */
  .sige-page-exit {
    opacity: 0 !important;
    transform: translateY(-4px) !important;
    transition: opacity 0.16s cubic-bezier(0.16, 1, 0.3, 1), transform 0.16s cubic-bezier(0.16, 1, 0.3, 1) !important;
  }

  /* ================= ESTILOS DE TOPBAR RIGHT & MENÚS PLEGABLES ================= */
  .topbar-right-wrapper {
    display: flex;
    align-items: center;
    gap: 16px;
    position: relative;
  }

  .dropdown-panel {
    position: absolute;
    top: calc(100% + 12px);
    right: 0;
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid rgba(0, 0, 0, 0.08);
    box-shadow: 0 18px 45px rgba(0, 26, 41, 0.25);
    z-index: 1000;
    animation: dropdownPopIn 0.22s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    overflow: hidden;
  }

  @keyframes dropdownPopIn {
    from {
      opacity: 0;
      transform: translateY(-8px) scale(0.97);
    }
    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }

  /* User Dropdown */
  .user-dropdown-menu {
    width: 295px;
  }

  .user-menu-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 18px;
    background: linear-gradient(135deg, #001A29 0%, #002b44 100%);
    color: #ffffff;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  .user-menu-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #39A900;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Poppins', 'Nunito', sans-serif;
    font-weight: 700;
    font-size: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
    flex-shrink: 0;
  }

  .user-menu-info {
    overflow: hidden;
    min-width: 0;
  }

  .user-menu-name {
    font-size: 13.5px;
    font-weight: 700;
    color: #ffffff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .user-menu-email {
    font-size: 11px;
    color: rgba(255, 255, 255, 0.75);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-top: 1px;
  }

  .user-menu-role {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-top: 4px;
    font-size: 10px;
    font-weight: 700;
    color: #62E31D;
    background: rgba(98, 227, 29, 0.15);
    padding: 2px 8px;
    border-radius: 999px;
  }

  .user-menu-body {
    padding: 8px 6px;
  }

  .user-menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 9px 12px;
    border-radius: 12px;
    text-decoration: none;
    color: #16261C;
    transition: all 0.15s ease;
  }

  .user-menu-item:hover {
    background: #f4f7f6;
  }

  .user-menu-item.active {
    background: #eaf7ee;
  }

  .menu-item-icon {
    width: 32px;
    height: 32px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
  }

  .bg-emerald-icon { background: #eaf7ee; color: #39A900; }
  .bg-blue-icon { background: #eff6ff; color: #2563eb; }
  .bg-amber-icon { background: #fef3c7; color: #d97706; }
  .bg-purple-icon { background: #f3e8ff; color: #9333ea; }

  .menu-item-content {
    min-width: 0;
  }

  .menu-item-title {
    font-size: 12.5px;
    font-weight: 700;
    color: #16261C;
    line-height: 1.2;
  }

  .menu-item-desc {
    font-size: 10.5px;
    color: #6B7A70;
    margin-top: 2px;
  }

  .user-menu-footer {
    padding: 8px 10px 10px;
    border-top: 1px solid #f0f3f1;
    background: #fafcfb;
  }

  .btn-logout-dropdown {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 14px;
    background: #fee2e2;
    color: #dc2626;
    border: 1px solid #fecaca;
    border-radius: 12px;
    font-size: 12.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.15s ease;
  }

  .btn-logout-dropdown:hover {
    background: #fca5a5;
    color: #991b1b;
    border-color: #f87171;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(220, 38, 38, 0.15);
  }

  /* Notifications Dropdown */
  .notif-dropdown-menu {
    width: 350px;
    max-width: 90vw;
  }

  .dropdown-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 18px;
    border-bottom: 1px solid #edf2ef;
    background: #fafcfb;
  }

  .dropdown-header-title {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #001A29;
  }

  .badge-count {
    background: #eaf7ee;
    color: #39A900;
    font-size: 11px;
    font-weight: 800;
    padding: 2px 8px;
    border-radius: 999px;
  }

  .btn-mark-all-read {
    background: transparent;
    border: none;
    font-size: 11px;
    font-weight: 600;
    color: #059669;
    cursor: pointer;
    padding: 2px 6px;
    border-radius: 6px;
    transition: all 0.15s ease;
  }

  .btn-mark-all-read:hover {
    background: #eaf7ee;
    text-decoration: underline;
  }

  .notif-list {
    max-height: 320px;
    overflow-y: auto;
  }

  .notif-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 18px;
    border-bottom: 1px solid #f2f5f3;
    cursor: pointer;
    transition: background 0.15s ease;
    text-decoration: none;
  }

  .notif-item:hover {
    background: #f7faf8;
  }

  .notif-item.unread {
    background: #fbfdfc;
  }

  .notif-icon {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
  }

  .bg-green-light { background: #eaf7ee; }
  .bg-blue-light { background: #eff6ff; }
  .bg-amber-light { background: #fef3c7; }
  .bg-purple-light { background: #f3e8ff; }

  .notif-content {
    flex: 1;
    min-width: 0;
  }

  .notif-text {
    font-size: 12px;
    color: #16261C;
    line-height: 1.4;
  }

  .notif-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 4px;
  }

  .notif-time {
    font-size: 10.5px;
    color: #8b9990;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .unread-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #39A900;
  }

  .notif-item.read .unread-dot {
    display: none;
  }

  .dropdown-footer {
    padding: 10px 18px;
    background: #fafcfb;
    border-top: 1px solid #edf2ef;
    text-align: center;
  }

  .dropdown-footer-link {
    font-size: 11.5px;
    font-weight: 700;
    color: #001A29;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: color 0.15s ease;
  }

  .dropdown-footer-link:hover {
    color: #39A900;
  }

  .user-chevron-icon {
    transition: transform 0.2s ease;
  }

  .user-chevron-icon.rotate {
    transform: rotate(180deg);
  }

  /* ================= ESTILOS MODAL DETALLE NOTIFICACIÓN (SENA ERP) ================= */
  .notif-item {
    position: relative;
    transition: all 0.18s ease;
  }
  .notif-item:hover {
    background: #f0fdf4 !important;
    transform: translateX(3px);
  }
  .notif-item:hover .notif-text {
    color: #00131E;
  }

  .sige-notif-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0, 19, 30, 0.72);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    z-index: 999999;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 50px 16px 30px 16px;
    overflow-y: auto;
    animation: sigeNotifFadeIn 0.22s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }

  @keyframes sigeNotifFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  .sige-notif-modal-card {
    background: #ffffff;
    border-radius: 20px;
    max-width: 580px;
    width: 100%;
    box-shadow: 0 25px 65px rgba(0, 19, 30, 0.45);
    border: 1px solid rgba(255, 255, 255, 0.3);
    overflow: hidden;
    animation: sigeNotifScaleUp 0.25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    margin-bottom: 24px;
  }

  @keyframes sigeNotifScaleUp {
    from {
      opacity: 0;
      transform: translateY(-16px) scale(0.96);
    }
    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }

  .sige-notif-modal-header {
    background: linear-gradient(135deg, #00131E 0%, #002235 100%);
    border-bottom: 3px solid #39A900;
    padding: 18px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #ffffff;
  }

  .sige-notif-modal-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: rgba(57, 169, 0, 0.2);
    border: 1px solid rgba(98, 227, 29, 0.4);
    color: #62E31D;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    flex-shrink: 0;
  }

  .sige-notif-pill {
    display: inline-block;
    font-size: 10.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 2px 9px;
    border-radius: 999px;
    background: rgba(98, 227, 29, 0.2);
    color: #62E31D;
    border: 1px solid rgba(98, 227, 29, 0.35);
    margin-bottom: 3px;
  }

  .sige-notif-modal-title {
    font-size: 15.5px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
    line-height: 1.25;
    font-family: 'Poppins', 'Nunito', sans-serif;
  }

  .sige-notif-close-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: #ffffff;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.18s ease;
    font-size: 14px;
  }
  .sige-notif-close-btn:hover {
    background: rgba(239, 68, 68, 0.85);
    color: #fff;
    transform: rotate(90deg);
  }

  .sige-notif-modal-body {
    padding: 20px 22px;
    max-height: 65vh;
    overflow-y: auto;
  }

  .sige-notif-summary-box {
    background: #f8faf9;
    border: 1px solid #e2e8e4;
    border-left: 4px solid #39A900;
    border-radius: 12px;
    padding: 14px 16px;
  }

  .sige-notif-grid-fields {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
  }
  @media (max-width: 580px) {
    .sige-notif-grid-fields {
      grid-template-columns: 1fr;
    }
    .sige-notif-modal-backdrop {
      padding-top: 20px;
    }
  }

  .sige-notif-field-card {
    background: #ffffff;
    border: 1px solid #e6ece8;
    border-radius: 10px;
    padding: 9px 12px;
    transition: all 0.15s ease;
  }
  .sige-notif-field-card:hover {
    border-color: #39A900;
    box-shadow: 0 2px 8px rgba(57, 169, 0, 0.1);
  }
  .sige-notif-field-label {
    font-size: 10px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    margin-bottom: 2px;
  }
  .sige-notif-field-value {
    font-size: 12.5px;
    font-weight: 700;
    color: #00131E;
    word-break: break-word;
  }

  .sige-notif-modal-footer {
    background: #f8faf9;
    border-top: 1px solid #e6ece8;
    padding: 14px 22px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
  }

  .sige-notif-btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 16px;
    border-radius: 10px;
    background: #ffffff;
    border: 1.5px solid #cbd5e1;
    color: #334155;
    font-size: 12.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .sige-notif-btn-secondary:hover {
    background: #f1f5f9;
    color: #0f172a;
  }

  .sige-notif-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 18px;
    border-radius: 10px;
    background: linear-gradient(135deg, #39A900 0%, #2e8b00 100%);
    border: 1px solid #39A900;
    color: #ffffff;
    font-size: 12.5px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(57, 169, 0, 0.3);
    transition: all 0.15s ease;
  }
  .sige-notif-btn-primary:hover {
    background: linear-gradient(135deg, #2e8b00 0%, #226700 100%);
    box-shadow: 0 6px 16px rgba(57, 169, 0, 0.4);
    color: #ffffff;
  }
</style>

<script>
  // Control interactivo de menús desplegables
  function toggleUserDropdown(event) {
    if (event) event.stopPropagation();
    const userMenu = document.getElementById('userDropdownMenu');
    const notifMenu = document.getElementById('notifDropdownMenu');
    const chevron = document.getElementById('userChevronIcon');

    // Cerrar notificaciones si están abiertas
    if (notifMenu) notifMenu.style.display = 'none';

    if (userMenu) {
      const isOpen = userMenu.style.display === 'block';
      userMenu.style.display = isOpen ? 'none' : 'block';
      if (chevron) {
        if (!isOpen) {
          chevron.classList.add('rotate');
        } else {
          chevron.classList.remove('rotate');
        }
      }
    }
  }

  function toggleNotificationDropdown(event) {
    if (event) event.stopPropagation();
    const notifMenu = document.getElementById('notifDropdownMenu');
    const userMenu = document.getElementById('userDropdownMenu');
    const chevron = document.getElementById('userChevronIcon');

    // Cerrar menú de usuario si está abierto
    if (userMenu) userMenu.style.display = 'none';
    if (chevron) chevron.classList.remove('rotate');

    if (notifMenu) {
      const isOpen = notifMenu.style.display === 'block';
      notifMenu.style.display = isOpen ? 'none' : 'block';
    }
  }

  function markNotificationRead(element) {
    if (element) {
      element.classList.remove('unread');
      element.classList.add('read');
      updateUnreadNotificationCount();
    }
  }

  function markAllNotificationsAsRead(event) {
    if (event) event.stopPropagation();
    const items = document.querySelectorAll('#notifItemsList .notif-item');
    items.forEach(item => {
      item.classList.remove('unread');
      item.classList.add('read');
    });
    updateUnreadNotificationCount();
  }

  function updateUnreadNotificationCount() {
    const unreadItems = document.querySelectorAll('#notifItemsList .notif-item.unread');
    const badge = document.getElementById('notifCountBadge');
    const badgeDot = document.getElementById('notifBadgeDot');

    if (badge) {
      if (unreadItems.length > 0) {
        badge.textContent = `${unreadItems.length} nuevas`;
        badge.style.display = 'inline-block';
      } else {
        badge.textContent = 'Al día';
        badge.style.display = 'inline-block';
      }
    }

    if (badgeDot) {
      badgeDot.style.display = unreadItems.length > 0 ? 'flex' : 'none';
    }
  }

  // ================= DICCIONARIO DE DETALLES DE NOTIFICACIONES =================
  const sigeNotificacionesData = {
    'notif-1': {
      categoria: 'Actualización Laboral',
      icon: 'fa-solid fa-briefcase',
      iconColor: '#0d6928',
      iconBg: '#eaf7ee',
      tiempo: 'Hace 20 min',
      titulo: 'Actualización de Situación Laboral',
      resumen: 'El egresado Juan Pérez ha registrado oportunamente su nuevo estado ocupacional dentro de la plataforma.',
      campos: [
        { etiqueta: 'Egresado', valor: 'Juan Pérez' },
        { etiqueta: 'Documento', valor: 'CC 1.098.765.432' },
        { etiqueta: 'Programa Formativo', valor: 'Análisis y Desarrollo de Software (ADSO)' },
        { etiqueta: 'Ficha SOFIA Plus', valor: 'Ficha 2670142 - SENA CEFA' },
        { etiqueta: 'Nuevo Estado', valor: 'Empleado (Término Indefinido)' },
        { etiqueta: 'Empresa / Entidad', valor: 'Tech Solutions Colombia S.A.S.' },
        { etiqueta: 'Cargo Desempeñado', valor: 'Desarrollador Full Stack Junior' },
        { etiqueta: 'Rango Salarial', valor: '$2.800.000 COP' },
        { etiqueta: 'Fecha de Reporte', valor: 'Hoy, hace 20 minutos' },
        { etiqueta: 'Validación', valor: 'Información registrada y verificada' }
      ],
      accionTexto: 'Ver Directorio de Egresados',
      accionUrl: '{{ route("egresados.index") }}',
      accionIcon: 'fa-solid fa-user-graduate'
    },
    'notif-2': {
      categoria: 'Encuesta Institucional',
      icon: 'fa-solid fa-clipboard-check',
      iconColor: '#1e40af',
      iconBg: '#eff6ff',
      tiempo: 'Hace 3 horas',
      titulo: 'Cierre de Encuesta "Seguimiento laboral 2026-1"',
      resumen: 'La encuesta de seguimiento ocupacional 2026-1 culminó con una destacada participación del 85% de la muestra convocada.',
      campos: [
        { etiqueta: 'Encuesta', valor: 'Seguimiento laboral 2026-1' },
        { etiqueta: 'Población Destinataria', valor: 'Egresados titulados 2024 - 2025' },
        { etiqueta: 'Participación Lograda', valor: '85.2% (426 / 500 respuestas válidas)' },
        { etiqueta: 'Tasa de Vinculación', valor: '78% de egresados activos laboralmente' },
        { etiqueta: 'Estado de Encuesta', valor: 'Cerrada oficialmente' },
        { etiqueta: 'Hora de Cierre', valor: 'Hoy, 10:30 AM' },
        { etiqueta: 'Responsable', valor: 'Coordinación Académica & Sistema SIGE' }
      ],
      accionTexto: 'Ver Reporte de Encuestas',
      accionUrl: '{{ route("egresados.encuestas") }}',
      accionIcon: 'fa-solid fa-chart-pie'
    },
    'notif-3': {
      categoria: 'Evento Institucional',
      icon: 'fa-solid fa-calendar-check',
      iconColor: '#b45309',
      iconBg: '#fef3c7',
      tiempo: 'Ayer',
      titulo: 'Feria Laboral Institucional 2026',
      resumen: 'Convocatoria oficial para egresados SENA orientada a vinculación directa y ruedas de empleo con empresas aliadas.',
      campos: [
        { etiqueta: 'Nombre del Evento', valor: 'Feria Laboral 2026' },
        { etiqueta: 'Código', valor: 'EVT-012' },
        { etiqueta: 'Tipo de Evento', valor: 'Feria laboral y rueda de empleo' },
        { etiqueta: 'Fecha y Horario', valor: '20 de Octubre de 2026 | 08:00 AM' },
        { etiqueta: 'Lugar / Sede', valor: 'Auditorio Principal - SENA CEFA' },
        { etiqueta: 'Aforo / Confirmados', valor: '156 de 200 cupos reservados (78%)' },
        { etiqueta: 'Empresas Vinculadas', valor: '18 organizaciones aliadas confirmadas' },
        { etiqueta: 'Coordinador del Evento', valor: 'Coordinación Académica & Egresados' }
      ],
      accionTexto: 'Ver Gestión de Eventos',
      accionUrl: '{{ route("egresados.eventos") }}',
      accionIcon: 'fa-solid fa-calendar-days'
    },
    'notif-4': {
      categoria: 'Registro de Egresados',
      icon: 'fa-solid fa-user-plus',
      iconColor: '#6b21a8',
      iconBg: '#f3e8ff',
      tiempo: 'Hace 2 días',
      titulo: '15 Nuevos Egresados Registrados en el Portal',
      resumen: 'Quince egresados completaron su vinculación autónoma y actualización de perfil curricular en la plataforma.',
      campos: [
        { etiqueta: 'Periodo de Registro', valor: 'Mes en curso (Octubre 2026)' },
        { etiqueta: 'Nuevos Registrados', valor: '15 egresados activos' },
        { etiqueta: 'Programas Académicos', valor: 'ADSO (8), Gestión Empresarial (4), Contabilidad (3)' },
        { etiqueta: 'Hojas de Vida', valor: '12 cargadas y estructuradas al 100%' },
        { etiqueta: 'Verificación Documental', valor: 'Certificación SOFIA Plus confirmada' },
        { etiqueta: 'Próximo Paso', valor: 'Asignación a bolsa de empleo e instructores' }
      ],
      accionTexto: 'Ver Directorio de Egresados',
      accionUrl: '{{ route("egresados.index") }}',
      accionIcon: 'fa-solid fa-users'
    }
  };

  @if(!empty($cacheInvitaciones))
    @foreach($cacheInvitaciones as $invId => $inv)
      sigeNotificacionesData['inv-{{ $invId }}'] = {
        categoria: 'Invitación a Evento Institucional',
        icon: 'fa-solid fa-envelope-circle-check',
        iconColor: '#059669',
        iconBg: '#eaf7ee',
        tiempo: '{{ $inv["fecha_envio"] ?? "Hoy" }}',
        titulo: 'Invitación Enviada: {{ addslashes($inv["title"] ?? "Evento") }}',
        resumen: 'Se ha emitido y enviado satisfactoriamente la invitación masiva y enlace de registro para el evento institucional.',
        campos: [
          { etiqueta: 'Evento Institucional', valor: '{{ addslashes($inv["title"] ?? "Evento Institucional") }}' },
          { etiqueta: 'Código Identificador', valor: '{{ $invId }}' },
          { etiqueta: 'Programa Dirigido', valor: '{{ addslashes($inv["program"] ?? "Egresados CEFA") }}' },
          { etiqueta: 'Fecha Programada', valor: '{{ addslashes($inv["date"] ?? "14/10/2026") }} | {{ addslashes($inv["time"] ?? "01:22 PM") }}' },
          { etiqueta: 'Lugar / Instalación', valor: '{{ addslashes($inv["location"] ?? "CEFA") }}' },
          { etiqueta: 'Canal de Envío', valor: 'Correo electrónico y Dashboard de Egresados' },
          { etiqueta: 'Estado de Envío', valor: 'Completado con éxito' }
        ],
        accionTexto: 'Ir al Módulo de Eventos',
        accionUrl: '{{ route("egresados.eventos") }}',
        accionIcon: 'fa-solid fa-calendar-check'
      };
    @endforeach
  @endif

  // Abrir Modal de Detalle de Notificación
  function abrirDetalleNotificacion(notifKey, element) {
    if (element) {
      element.classList.remove('unread');
      element.classList.add('read');
      updateUnreadNotificationCount();
    }

    const notifMenu = document.getElementById('notifDropdownMenu');
    if (notifMenu) {
      notifMenu.style.display = 'none';
    }

    const notif = sigeNotificacionesData[notifKey];
    if (!notif) return;

    const modalHeaderIcon = document.getElementById('modalNotifHeaderIcon');
    if (modalHeaderIcon) {
      modalHeaderIcon.innerHTML = `<i class="${notif.icon}"></i>`;
      modalHeaderIcon.style.background = notif.iconBg;
      modalHeaderIcon.style.color = notif.iconColor;
      modalHeaderIcon.style.borderColor = notif.iconColor + '40';
    }

    const badgeElem = document.getElementById('modalNotifBadge');
    if (badgeElem) {
      badgeElem.textContent = notif.categoria;
    }

    const tituloElem = document.getElementById('modalNotifTitulo');
    if (tituloElem) {
      tituloElem.textContent = notif.titulo;
    }

    const tiempoElem = document.getElementById('modalNotifTiempo');
    if (tiempoElem) {
      tiempoElem.innerHTML = `<i class="fa-regular fa-clock"></i> <span>${notif.tiempo}</span>`;
    }

    const resumenElem = document.getElementById('modalNotifResumen');
    if (resumenElem) {
      resumenElem.textContent = notif.resumen;
    }

    const gridElem = document.getElementById('modalNotifGridCampos');
    if (gridElem) {
      gridElem.innerHTML = '';
      if (notif.campos && notif.campos.length > 0) {
        notif.campos.forEach(c => {
          const card = document.createElement('div');
          card.className = 'sige-notif-field-card';
          card.innerHTML = `
            <div class="sige-notif-field-label">${c.etiqueta}</div>
            <div class="sige-notif-field-value">${c.valor}</div>
          `;
          gridElem.appendChild(card);
        });
      }
    }

    const btnAccion = document.getElementById('modalNotifBtnAccion');
    const btnIcon = document.getElementById('modalNotifBtnIcon');
    const btnTexto = document.getElementById('modalNotifBtnTexto');
    if (btnAccion && notif.accionUrl) {
      btnAccion.href = notif.accionUrl;
      btnAccion.style.display = 'inline-flex';
      if (btnTexto) btnTexto.textContent = notif.accionTexto || 'Ver en el Módulo';
      if (btnIcon && notif.accionIcon) {
        btnIcon.className = notif.accionIcon;
      }
    } else if (btnAccion) {
      btnAccion.style.display = 'none';
    }

    const modal = document.getElementById('modalDetalleNotificacion');
    if (modal) {
      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    }
  }

  function cerrarDetalleNotificacion(event) {
    if (event && event.target && event.target.id !== 'modalDetalleNotificacion' && !event.target.closest('.sige-notif-close-btn') && !event.target.closest('.sige-notif-btn-secondary')) {
      return;
    }
    const modal = document.getElementById('modalDetalleNotificacion');
    if (modal) {
      modal.style.display = 'none';
      document.body.style.overflow = '';
    }
  }

  // Cerrar menús al hacer click fuera o presionar Escape
  document.addEventListener('click', function(e) {
    const userMenu = document.getElementById('userDropdownMenu');
    const notifMenu = document.getElementById('notifDropdownMenu');
    const chevron = document.getElementById('userChevronIcon');
    const userChip = document.getElementById('userChipBtn');
    const notifBtn = document.getElementById('notifBtn');

    if (userMenu && !userMenu.contains(e.target) && (!userChip || !userChip.contains(e.target))) {
      userMenu.style.display = 'none';
      if (chevron) chevron.classList.remove('rotate');
    }

    if (notifMenu && !notifMenu.contains(e.target) && (!notifBtn || !notifBtn.contains(e.target))) {
      notifMenu.style.display = 'none';
    }
  });

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      const modal = document.getElementById('modalDetalleNotificacion');
      if (modal && modal.style.display === 'flex') {
        cerrarDetalleNotificacion();
        return;
      }
      const userMenu = document.getElementById('userDropdownMenu');
      const notifMenu = document.getElementById('notifDropdownMenu');
      const chevron = document.getElementById('userChevronIcon');
      if (userMenu) userMenu.style.display = 'none';
      if (notifMenu) notifMenu.style.display = 'none';
      if (chevron) chevron.classList.remove('rotate');
    }
  });
  // ================= TRANSICIÓN FLUIDA ENTRE MÓDULOS =================
  document.addEventListener('DOMContentLoaded', function() {
    // 0. Sincronizar contador inicial de notificaciones
    updateUnreadNotificationCount();

    // 1. Recordar y mantener la posición de scroll del sidebar para evitar saltos
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
      const savedScroll = sessionStorage.getItem('sige_superadmin_sidebar_scroll');
      if (savedScroll !== null) {
        sidebar.scrollTop = parseInt(savedScroll, 10);
      }
      sidebar.addEventListener('scroll', function() {
        sessionStorage.setItem('sige_superadmin_sidebar_scroll', sidebar.scrollTop);
      }, { passive: true });
    }

    // 2. Interceptar clics en los enlaces del menú para salida suave
    const moduleLinks = document.querySelectorAll('.sidebar nav a, .user-menu-item, .portal-link-btn');
    moduleLinks.forEach(function(link) {
      link.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        // Ignorar enlaces vacíos, anclas, javascript o enlaces que se abran en nueva pestaña
        if (!href || href.startsWith('#') || href.startsWith('javascript') || this.target === '_blank') return;
        // Si ya está activo en esta página, no hacer nada
        if (this.classList.contains('active')) return;
        // Respetar combinaciones de teclas para abrir en pestaña nueva
        if (e.ctrlKey || e.metaKey || e.shiftKey) return;

        const mainContent = document.querySelector('.content') || document.querySelector('.content-area') || document.querySelector('.main');
        if (mainContent) {
          e.preventDefault();
          mainContent.classList.add('sige-page-exit');
          setTimeout(function() {
            window.location.href = href;
          }, 140);
        }
      });
    });
  });
</script>
