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
