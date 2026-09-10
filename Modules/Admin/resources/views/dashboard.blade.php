@extends('admin::layouts.master')

@section('title', 'Dashboard - Administración y Seguridad')

@section('content')
<div class="row g-4">

    <!-- Welcome Hero Alert -->
    <div class="col-12">
        <div class="card border-0 rounded-4 shadow-sm overflow-hidden text-white" style="background: linear-gradient(135deg, var(--sena-dark) 0%, var(--sena-light-navy) 60%, var(--admin-blue) 100%);">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-15 border border-white border-opacity-25 mb-3">
                            <i class="fas fa-shield-alt text-warning"></i>
                            <span class="fs-7 fw-semibold">Centro de Control de Seguridad y Accesos</span>
                        </div>
                        @auth
                            <h2 class="fw-bold text-white mb-2 fs-3">
                                ¡Bienvenido(a), {{ Auth::user()->full_name }}!
                            </h2>
                            <p class="text-white-50 fs-6 mb-3">
                                Conectado como <strong class="text-white">{{ Auth::user()->primary_role }}</strong>. Tienes facultades para supervisar usuarios, políticas de acceso y registros de auditoría de SENA Empresa ERP.
                            </p>
                        @else
                            <h2 class="fw-bold text-white mb-2 fs-3">
                                Tablero de Gestión y Gobierno del ERP
                            </h2>
                            <p class="text-white-50 fs-6 mb-3">
                                Supervisión general de seguridad, cuentas de usuario, roles de aplicación y bitácora forense de auditoría.
                            </p>
                        @endauth
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.usuarios.create') }}" class="btn btn-admin">
                                <i class="fas fa-user-plus me-1"></i> Registrar Nuevo Usuario
                            </a>
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-outline-light rounded-pill px-3 fw-semibold">
                                <i class="fas fa-user-shield me-1"></i> Crear Rol
                            </a>
                            <a href="{{ route('admin.auditoria.index') }}" class="btn btn-outline-light rounded-pill px-3 fw-semibold">
                                <i class="fas fa-history me-1"></i> Ver Auditoría
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                        @auth
                            <div class="avatar-circle mx-auto mx-lg-end shadow-lg" style="width: 80px; height: 80px; font-size: 28px;">
                                {{ Auth::user()->initials }}
                            </div>
                            <div class="mt-2 text-white fw-bold">{{ Auth::user()->email }}</div>
                            <span class="badge bg-info text-dark px-3 py-1 rounded-pill mt-1">
                                {{ Auth::user()->primary_role }}
                            </span>
                        @else
                            <div class="avatar-circle mx-auto mx-lg-end shadow-lg" style="width: 80px; height: 80px; font-size: 28px;">
                                AD
                            </div>
                            <div class="mt-2 text-white fw-bold">Modo Consulta</div>
                            <a href="{{ route('login', ['redirect' => route('admin.dashboard')]) }}" class="btn btn-sm btn-admin mt-2">
                                Iniciar Sesión
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Cards KPI -->
    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4 text-center border-start border-4 border-info">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fs-7 text-uppercase fw-semibold">Total Usuarios</span>
                    <h3 class="fw-bold text-dark mb-0 fs-2 mt-1">{{ $totalUsuarios }}</h3>
                </div>
                <div class="rounded-circle p-3 bg-info bg-opacity-10 text-info fs-3">
                    <i class="fas fa-users-cog"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                <a href="{{ route('admin.usuarios.index') }}" class="text-info text-decoration-none fw-semibold">
                    <i class="fas fa-arrow-right me-1"></i> Gestionar usuarios
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4 text-center border-start border-4 border-warning">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fs-7 text-uppercase fw-semibold">Roles del ERP</span>
                    <h3 class="fw-bold text-dark mb-0 fs-2 mt-1">{{ $totalRoles }}</h3>
                </div>
                <div class="rounded-circle p-3 bg-warning bg-opacity-10 text-warning fs-3">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                <a href="{{ route('admin.roles.index') }}" class="text-warning text-decoration-none fw-semibold">
                    <i class="fas fa-arrow-right me-1"></i> Configurar roles
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4 text-center border-start border-4 border-success">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fs-7 text-uppercase fw-semibold">Permisos Técnicos</span>
                    <h3 class="fw-bold text-dark mb-0 fs-2 mt-1">{{ $totalPermisos }}</h3>
                </div>
                <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success fs-3">
                    <i class="fas fa-key"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                <a href="{{ route('admin.permisos.index') }}" class="text-success text-decoration-none fw-semibold">
                    <i class="fas fa-arrow-right me-1"></i> Explorar permisos
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4 text-center border-start border-4 border-danger">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fs-7 text-uppercase fw-semibold">Auditorías</span>
                    <h3 class="fw-bold text-dark mb-0 fs-2 mt-1">{{ $totalAuditorias }}</h3>
                </div>
                <div class="rounded-circle p-3 bg-danger bg-opacity-10 text-danger fs-3">
                    <i class="fas fa-history"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                <a href="{{ route('admin.auditoria.index') }}" class="text-danger text-decoration-none fw-semibold">
                    <i class="fas fa-arrow-right me-1"></i> Ver bitácora
                </a>
            </div>
        </div>
    </div>

    <!-- Sección de Gráficos y Desgloses -->
    <div class="col-lg-6">
        <div class="card card-custom p-4 h-100">
            <h5 class="fw-bold text-dark mb-3">
                <i class="fas fa-chart-bar text-primary me-2"></i> Eventos de Auditoría Registrados
            </h5>
            <div class="row g-3 text-center my-auto">
                <div class="col-4">
                    <div class="p-3 rounded-4 bg-success bg-opacity-10 border border-success border-opacity-25">
                        <span class="fs-8 fw-bold text-success text-uppercase">Creados</span>
                        <h3 class="fw-bold text-success mb-0 mt-1">{{ $auditoriasPorEvento['created'] ?? 0 }}</h3>
                        <small class="text-muted fs-8">Nuevos registros</small>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-3 rounded-4 bg-primary bg-opacity-10 border border-primary border-opacity-25">
                        <span class="fs-8 fw-bold text-primary text-uppercase">Actualizados</span>
                        <h3 class="fw-bold text-primary mb-0 mt-1">{{ $auditoriasPorEvento['updated'] ?? 0 }}</h3>
                        <small class="text-muted fs-8">Modificaciones</small>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-3 rounded-4 bg-danger bg-opacity-10 border border-danger border-opacity-25">
                        <span class="fs-8 fw-bold text-danger text-uppercase">Eliminados</span>
                        <h3 class="fw-bold text-danger mb-0 mt-1">{{ $auditoriasPorEvento['deleted'] ?? 0 }}</h3>
                        <small class="text-muted fs-8">Bajas lógicas</small>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-3 border-top text-end">
                <a href="{{ route('admin.auditoria.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    <i class="fas fa-search me-1"></i> Consultar registros completos
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-custom p-4 h-100">
            <h5 class="fw-bold text-dark mb-3">
                <i class="fas fa-user-tag text-warning me-2"></i> Cobertura de Roles Principales
            </h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 fs-7">
                    <thead class="table-light">
                        <tr>
                            <th>Rol</th>
                            <th>Slug</th>
                            <th class="text-center">Usuarios Asignados</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rolesPopulares as $rol)
                            <tr>
                                <td><strong>{{ $rol->name }}</strong></td>
                                <td><code>{{ $rol->slug }}</code></td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-15 text-primary rounded-pill px-3 py-1">
                                        {{ $rol->users_count }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">No hay roles registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tablas de Últimos Usuarios y Últimas Auditorías -->
    <div class="col-lg-6">
        <div class="card card-custom p-4">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="fas fa-user-plus text-info me-2"></i> Usuarios Recientes
                </h5>
                <a href="{{ route('admin.usuarios.index') }}" class="fs-8 text-primary fw-semibold text-decoration-none">Ver todos</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 fs-7">
                    <thead class="table-light">
                        <tr>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosUsuarios as $u)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-circle-sm" style="width: 30px; height: 30px; font-size: 11px;">
                                            {{ $u->initials }}
                                        </div>
                                        <div>
                                            <strong>{{ $u->nickname }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $u->email }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.usuarios.edit', $u->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-2 py-0">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Sin usuarios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-custom p-4">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="fas fa-history text-danger me-2"></i> Eventos Recientes de Auditoría
                </h5>
                <a href="{{ route('admin.auditoria.index') }}" class="fs-8 text-danger fw-semibold text-decoration-none">Ver todos</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 fs-7">
                    <thead class="table-light">
                        <tr>
                            <th>Evento</th>
                            <th>Modelo Auditado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasAuditorias as $aud)
                            <tr>
                                <td>
                                    @if($aud->event == 'created')
                                        <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25 rounded-pill px-2 py-1">Creación</span>
                                    @elseif($aud->event == 'updated')
                                        <span class="badge bg-primary bg-opacity-15 text-primary border border-primary border-opacity-25 rounded-pill px-2 py-1">Modificación</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-15 text-danger border border-danger border-opacity-25 rounded-pill px-2 py-1">Eliminación</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 180px;">
                                        {{ class_basename($aud->auditable_type) }} #{{ $aud->auditable_id }}
                                    </span>
                                </td>
                                <td><small class="text-muted">{{ $aud->created_at ? $aud->created_at->format('d/m/Y H:i') : 'N/A' }}</small></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Sin registros de auditoría recientes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
