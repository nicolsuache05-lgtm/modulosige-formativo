@extends('admin::layouts.master')

@section('title', 'Control de Roles - Administración')

@section('content')
    <!-- Page Header Title -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <div>
            <span class="badge badge-admin-apoyo px-3 py-1 rounded-pill mb-2">
                <i class="fas fa-user-shield me-1"></i> Perfiles de Acceso
            </span>
            <h2 class="fw-bold text-dark mb-0">Gestión de Roles Institucionales</h2>
            <p class="text-muted fs-6 mb-0">Administración de perfiles, permisos asociados y asignación por aplicación de SENA Empresa.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('admin.roles.create') }}" class="btn btn-admin shadow-sm">
                <i class="fas fa-plus-circle me-1"></i> Nuevo Rol
            </a>
        </div>
    </div>

    <!-- Summary Metrics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-sm-6">
            <div class="card card-custom p-3 border-start border-4 border-warning">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Total Roles</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalRoles }}</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-warning bg-opacity-10 text-warning">
                        <i class="fas fa-user-shield fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="card card-custom p-3 border-start border-4 border-success">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Total Permisos</span>
                        <h3 class="fw-bold text-success mb-0 mt-1">{{ $totalPermisos }}</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success">
                        <i class="fas fa-key fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-12">
            <div class="card card-custom p-3 border-start border-4 border-info">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Roles en Vista</span>
                        <h3 class="fw-bold text-info mb-0 mt-1">{{ $roles->total() }}</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-info bg-opacity-10 text-info">
                        <i class="fas fa-filter fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search Bar -->
    <div class="card card-custom p-4 mb-4">
        <form method="GET" action="{{ route('admin.roles.index') }}" class="row g-3 align-items-end">
            <div class="col-lg-6 col-md-12">
                <label class="form-label fs-7 fw-bold text-muted">Buscador de Roles</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control border-start-0 bg-light" placeholder="Buscar por nombre, slug o descripción...">
                </div>
            </div>

            <div class="col-lg-4 col-md-8">
                <label class="form-label fs-7 fw-bold text-muted">Filtrar por Aplicación</label>
                <select name="app_id" class="form-select bg-light">
                    <option value="">Todas las aplicaciones</option>
                    @foreach($apps as $app)
                        <option value="{{ $app->id }}" {{ request('app_id') == $app->id ? 'selected' : '' }}>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-2 col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-admin w-100">
                    <i class="fas fa-filter me-1"></i> Filtrar
                </button>
                @if(request()->hasAny(['buscar', 'app_id']))
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary rounded-pill" title="Limpiar filtros">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table of Roles -->
    <div class="card card-custom overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Nombre del Rol</th>
                        <th>Slug de Seguridad</th>
                        <th>Aplicación</th>
                        <th>Acceso Total</th>
                        <th class="text-center">Usuarios</th>
                        <th class="text-center">Permisos</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $r)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $r->name }}</div>
                                <small class="text-muted text-truncate d-inline-block" style="max-width: 220px;">
                                    {{ $r->description ?: 'Sin descripción' }}
                                </small>
                            </td>
                            <td>
                                <code>{{ $r->slug }}</code>
                            </td>
                            <td>
                                @if($r->app)
                                    <span class="badge bg-secondary bg-opacity-15 text-dark border border-secondary border-opacity-25 rounded-pill px-2 py-1">
                                        <i class="fas fa-cube me-1"></i> {{ $r->app->name }}
                                    </span>
                                @else
                                    <span class="text-muted fs-8">General</span>
                                @endif
                            </td>
                            <td>
                                @if($r->full_access == 'Si')
                                    <span class="badge bg-danger bg-opacity-15 text-danger border border-danger border-opacity-25 rounded-pill px-2 py-1 fs-8">
                                        <i class="fas fa-shield-alt me-1"></i> Total
                                    </span>
                                @else
                                    <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25 rounded-pill px-2 py-1 fs-8">
                                        Limitado
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary bg-opacity-15 text-primary rounded-pill px-3 py-1">
                                    {{ $r->users_count }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info bg-opacity-15 text-info rounded-pill px-3 py-1">
                                    {{ $r->permissions->count() }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.roles.edit', $r->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3" title="Editar rol">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($r->users_count == 0)
                                        <form action="{{ route('admin.roles.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este rol?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Eliminar rol">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-user-shield fs-1 d-block mb-3 text-secondary opacity-50"></i>
                                <h5>No se encontraron roles</h5>
                                <p class="fs-7 mb-3">Intenta cambiar los términos de búsqueda.</p>
                                <a href="{{ route('admin.roles.create') }}" class="btn btn-admin btn-sm">
                                    <i class="fas fa-plus me-1"></i> Registrar Primer Rol
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($roles->hasPages())
            <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                {{ $roles->links() }}
            </div>
        @endif
    </div>
@endsection
