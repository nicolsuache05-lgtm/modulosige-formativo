@extends('admin::layouts.master')

@section('title', 'Catálogo de Permisos - Administración')

@section('content')
    <!-- Page Header Title -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <div>
            <span class="badge badge-admin-apoyo px-3 py-1 rounded-pill mb-2">
                <i class="fas fa-key me-1"></i> Capacidades Técnicas
            </span>
            <h2 class="fw-bold text-dark mb-0">Catálogo de Permisos del ERP</h2>
            <p class="text-muted fs-6 mb-0">Inventario de permisos de acceso registrados por aplicativo en SENA Empresa.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary rounded-pill px-4 fw-semibold">
                <i class="fas fa-user-shield me-1"></i> Ir a Roles
            </a>
        </div>
    </div>

    <!-- Summary Metrics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card card-custom p-3 border-start border-4 border-success">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Total Permisos</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalPermisos }}</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success">
                        <i class="fas fa-key fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-custom p-3 border-start border-4 border-info">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Permisos en Vista</span>
                        <h3 class="fw-bold text-info mb-0 mt-1">{{ $permisos->total() }}</h3>
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
        <form method="GET" action="{{ route('admin.permisos.index') }}" class="row g-3 align-items-end">
            <div class="col-lg-6 col-md-12">
                <label class="form-label fs-7 fw-bold text-muted">Buscador</label>
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
                    <a href="{{ route('admin.permisos.index') }}" class="btn btn-outline-secondary rounded-pill" title="Limpiar filtros">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table of Permissions -->
    <div class="card card-custom overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Permiso</th>
                        <th>Slug de Código</th>
                        <th>Aplicación</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permisos as $p)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $p->name }}</div>
                            </td>
                            <td>
                                <code>{{ $p->slug }}</code>
                            </td>
                            <td>
                                @if($p->app)
                                    <span class="badge bg-secondary bg-opacity-15 text-dark border border-secondary border-opacity-25 rounded-pill px-2 py-1">
                                        <i class="fas fa-cube me-1"></i> {{ $p->app->name }}
                                    </span>
                                @else
                                    <span class="text-muted fs-8">General</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-muted fs-7">{{ $p->description ?: 'Sin descripción detallada' }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-key fs-1 d-block mb-3 text-secondary opacity-50"></i>
                                <h5>No se encontraron permisos</h5>
                                <p class="fs-7 mb-0">Intenta cambiar los términos de búsqueda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($permisos->hasPages())
            <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                {{ $permisos->links() }}
            </div>
        @endif
    </div>
@endsection
