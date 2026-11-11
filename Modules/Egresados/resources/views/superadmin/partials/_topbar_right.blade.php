@php
    $notificaciones = \Modules\Egresados\Http\Controllers\NotificationController::getAllNotificaciones();
    $unreadCount = count(array_filter($notificaciones, fn($n) => !empty($n['unread'])));
@endphp
<!-- Modules/Egresados/resources/views/superadmin/partials/_topbar_right.blade.php -->
<div class="topbar-right-wrapper" style="display:flex; align-items:center; gap:16px; position:relative;">
  
  <!-- ================= NOTIFICACIONES ================= -->
  <div class="notif-dropdown-container" style="position:relative;">
    <button type="button" class="icon-btn notif-toggle-btn" id="notifBtn" title="Notificaciones" aria-label="Notificaciones" onclick="toggleNotificationDropdown(event)">
      <i class="fa-regular fa-bell"></i>
      <span class="dot notif-badge-dot" id="notifBadgeDot" style="display:{{ $unreadCount > 0 ? 'flex' : 'none' }};"></span>
    </button>

    <!-- Menú Desplegable de Notificaciones -->
    <div id="notifDropdownMenu" class="dropdown-panel notif-dropdown-menu" style="display:none;">
      <div class="dropdown-header">
        <div class="dropdown-header-title">
          <i class="fa-solid fa-bell" style="color:var(--green, #39A900);"></i>
          <span style="font-weight:700; font-size:14px; color:#001A29;">Notificaciones</span>
          <span class="badge-count" id="notifCountBadge">{{ $unreadCount > 0 ? $unreadCount . ' nuevas' : 'Al día' }}</span>
        </div>
        <button type="button" class="btn-mark-all-read" onclick="markAllNotificationsAsRead(event)">
          Marcar como leídas
        </button>
      </div>

      <div class="notif-list" id="notifItemsList">
        @forelse($notificaciones as $notif)
          <div class="notif-item {{ !empty($notif['unread']) ? 'unread' : 'read' }}" onclick="abrirDetalleNotificacion('{{ $notif['id'] }}', this)">
            <div class="notif-icon" style="background: {{ $notif['iconBg'] ?? '#eaf7ee' }};">
              <i class="{{ $notif['icon'] ?? 'fa-solid fa-bell' }}" style="color: {{ $notif['iconColor'] ?? '#39A900' }};"></i>
            </div>
            <div class="notif-content">
              <div class="notif-text">
                {!! $notif['texto'] !!}
              </div>
              <div class="notif-meta">
                <span class="notif-time"><i class="fa-regular fa-clock"></i> {{ $notif['tiempo'] ?? 'Reciente' }}</span>
                <span class="unread-dot"></span>
              </div>
            </div>
          </div>
        @empty
          <div style="padding: 28px 16px; text-align: center; color: #64748b; font-size: 12px; font-weight: 600;">
            <i class="fa-solid fa-bell-slash" style="font-size: 24px; color: #94a3b8; display: block; margin-bottom: 8px;"></i>
            No hay respuestas ni notificaciones registradas.
          </div>
        @endforelse
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
        
        @php
          $currentUser = Auth::user();
          $isSuperAdmin = $currentUser && ($currentUser->hasSuperAdmin() || $currentUser->nickname === 'superadmin' || $currentUser->email === 'superadmin.egresados@sena.edu.co' || ($currentUser->roles && $currentUser->roles->contains('slug', 'superadmin')));
        @endphp

        @if(!$isSuperAdmin)
        <button type="button" class="user-menu-item" onclick="if(typeof openModalActualizarPerfilInstructor === 'function'){ openModalActualizarPerfilInstructor(); } else if(typeof openModalActualizarPerfilEgresado === 'function'){ openModalActualizarPerfilEgresado(); } else if(typeof openModalActualizarPasswordInicial === 'function'){ openModalActualizarPasswordInicial(); } else { window.location.href='{{ route('egresados.dashboard_instructor') }}'; }" style="width:100%; text-align:left; background:none; border:none; cursor:pointer; font-family:inherit;">
          <div class="menu-item-icon bg-green-icon">
            <i class="fa-solid fa-user-pen"></i>
          </div>
          <div class="menu-item-content">
            <div class="menu-item-title">Actualizar mi Información</div>
            <div class="menu-item-desc">Contacto, residencia y contraseña</div>
          </div>
        </button>
        @endif

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
        <form id="form-logout-topbar" action="{{ route('egresados.logout') }}" method="POST">
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
  /* ================= ESTILOS GLOBALES DE TOPBAR INSTITUCIONAL SENA ERP ================= */
  .topbar {
    background: linear-gradient(135deg, var(--sena-dark, #00131E) 0%, var(--sena-navy, #001A29) 100%) !important;
    border-bottom: 2px solid var(--sena-green, #39A900) !important;
    box-shadow: 0 4px 14px rgba(0, 19, 30, 0.15) !important;
    color: #ffffff !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    height: 64px !important;
    padding: 0 36px !important;
    position: sticky !important;
    top: 0 !important;
    z-index: 50 !important;
    box-sizing: border-box !important;
  }
  .topbar-left {
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .topbar-right-wrapper {
    display: flex;
    align-items: center;
    gap: 16px;
    position: relative;
  }

  /* Chip de Usuario y Botones de Barra Superior */
  .user-chip {
    display: inline-flex !important;
    align-items: center !important;
    gap: 10px !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    padding: 4px 12px 4px 5px !important;
    border-radius: 999px !important;
    background: rgba(255, 255, 255, 0.08) !important;
    border: 1px solid rgba(255, 255, 255, 0.14) !important;
    color: #ffffff !important;
    transition: all 0.2s ease !important;
    user-select: none !important;
  }
  .user-chip:hover {
    background: rgba(255, 255, 255, 0.16) !important;
    border-color: rgba(255, 255, 255, 0.25) !important;
  }
  .user-avatar {
    width: 32px !important;
    height: 32px !important;
    border-radius: 999px !important;
    background: var(--sena-green, #39A900) !important;
    color: #ffffff !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-weight: 800 !important;
    font-size: 12px !important;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25) !important;
    flex-shrink: 0 !important;
  }
  .user-chevron-icon {
    font-size: 10.5px !important;
    color: rgba(255, 255, 255, 0.7) !important;
    transition: transform 0.2s ease !important;
  }
  .user-chevron-icon.rotate {
    transform: rotate(180deg) !important;
    color: #62E31D !important;
  }
  .icon-btn, .notif-toggle-btn {
    width: 38px !important;
    height: 38px !important;
    border-radius: 12px !important;
    border: 1px solid rgba(255, 255, 255, 0.14) !important;
    background: rgba(255, 255, 255, 0.08) !important;
    color: #ffffff !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    cursor: pointer !important;
    position: relative !important;
    transition: all 0.2s ease !important;
  }
  .icon-btn:hover, .notif-toggle-btn:hover {
    background: rgba(255, 255, 255, 0.16) !important;
    border-color: rgba(255, 255, 255, 0.25) !important;
    color: #62E31D !important;
  }
  .dot, .notif-badge-dot {
    position: absolute !important;
    top: 8px !important;
    right: 8px !important;
    width: 7px !important;
    height: 7px !important;
    border-radius: 50% !important;
    background: var(--moss, #62E31D) !important;
    box-shadow: 0 0 6px rgba(98, 227, 29, 0.8) !important;
  }

  /* ================= VIEW TRANSITIONS & TRANSICIONES SUAVES ================= */
  @view-transition {
    navigation: auto;
  }

  ::view-transition-old(root) {
    animation: 90ms ease-out both sigeFadeOut;
  }
  ::view-transition-new(root) {
    animation: 140ms ease-in both sigeFadeIn;
  }

  @keyframes sigeFadeOut {
    from { opacity: 1; }
    to { opacity: 0; }
  }

  @keyframes sigeFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  /* Mantener el sidebar, logo de arribita y topbar firmes durante la navegación sin saltos */
  .brand {
    view-transition-name: sige-brand;
  }
  .sidebar, aside {
    view-transition-name: sige-sidebar;
  }
  .topbar {
    view-transition-name: sige-topbar;
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

  /* ================= ESTILO OFICIAL SENA ERP: PUNTO BLANCO ACTIVO Y AL PASAR EL CURSOR (SIDEBAR) ================= */
  aside.sidebar nav a,
  .sidebar nav a {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    padding: 11px 14px !important;
    border-radius: 12px !important;
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
    user-select: none !important;
  }

  /* Punto blanco cuando el módulo está activo */
  aside.sidebar nav a.active,
  .sidebar nav a.active {
    background: linear-gradient(135deg, var(--sena-green, #39A900) 0%, #2e8b00 100%) !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    box-shadow: 0 4px 14px rgba(57, 169, 0, 0.38) !important;
    position: relative !important;
  }

  aside.sidebar nav a.active::after,
  .sidebar nav a.active::after {
    content: '' !important;
    position: absolute !important;
    right: 14px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    width: 6.5px !important;
    height: 6.5px !important;
    border-radius: 50% !important;
    background: #FFFFFF !important;
    box-shadow: 0 0 7px rgba(255, 255, 255, 0.95), 0 0 2px #ffffff !important;
    z-index: 5 !important;
    display: block !important;
    opacity: 1 !important;
  }

  /* Punto blanco al pasar el cursor (hover) por los diferentes módulos */
  aside.sidebar nav a:not(.active):hover,
  .sidebar nav a:not(.active):hover {
    background: rgba(255, 255, 255, 0.08) !important;
    color: #ffffff !important;
  }

  aside.sidebar nav a:not(.active):hover::after,
  .sidebar nav a:not(.active):hover::after {
    content: '' !important;
    position: absolute !important;
    right: 14px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    width: 6px !important;
    height: 6px !important;
    border-radius: 50% !important;
    background: #FFFFFF !important;
    box-shadow: 0 0 6px rgba(255, 255, 255, 0.85) !important;
    z-index: 5 !important;
    display: block !important;
    opacity: 1 !important;
    transition: opacity 0.15s ease, transform 0.15s ease !important;
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
    try {
      fetch('{{ route("egresados.notificaciones.marcar_leidas") }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json'
        }
      });
    } catch (e) {}

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
  const sigeNotificacionesData = @json(collect($notificaciones)->keyBy('id'));

  // Procesar clic en notificación
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

    if (notif.accionUrl) {
      if (notif.accionUrl.startsWith('#') || notif.accionUrl.includes('#solicitudes-pendientes')) {
        const target = document.getElementById('solicitudes-pendientes');
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'center' });
          target.style.transition = 'all 0.3s ease';
          target.style.transform = 'scale(1.015)';
          setTimeout(() => { target.style.transform = ''; }, 600);
          return;
        }
      }
      window.location.href = notif.accionUrl;
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
  });
</script>

@include('egresados::partials._security_session')
