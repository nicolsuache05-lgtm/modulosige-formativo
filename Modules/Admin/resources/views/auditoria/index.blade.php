@extends('admin::layouts.master')

@section('title', 'Auditoría y Trazabilidad - Administración')

@section('content')
    <!-- Page Header Title -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <div>
            <span class="badge badge-admin-apoyo px-3 py-1 rounded-pill mb-2">
                <i class="fas fa-history me-1"></i> Seguridad Forense
            </span>
            <h2 class="fw-bold text-dark mb-0">Bitácora de Auditoría y Trazabilidad</h2>
            <p class="text-muted fs-6 mb-0">Historial inmutable de operaciones, cambios de datos y accesos en SENA Empresa ERP.</p>
        </div>
    </div>

    <!-- Summary Metrics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="card card-custom p-3 border-start border-4 border-primary">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Total Eventos</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalAuditorias }}</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-history fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card card-custom p-3 border-start border-4 border-success">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Creaciones</span>
                        <h3 class="fw-bold text-success mb-0 mt-1">{{ $eventos['created'] ?? 0 }}</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success">
                        <i class="fas fa-plus-circle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card card-custom p-3 border-start border-4 border-info">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Modificaciones</span>
                        <h3 class="fw-bold text-info mb-0 mt-1">{{ $eventos['updated'] ?? 0 }}</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-info bg-opacity-10 text-info">
                        <i class="fas fa-edit fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card card-custom p-3 border-start border-4 border-danger">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Eliminaciones</span>
                        <h3 class="fw-bold text-danger mb-0 mt-1">{{ $eventos['deleted'] ?? 0 }}</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-danger bg-opacity-10 text-danger">
                        <i class="fas fa-trash-alt fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search Bar -->
    <div class="card card-custom p-4 mb-4">
        <form method="GET" action="{{ route('admin.auditoria.index') }}" class="row g-3 align-items-end">
            <div class="col-lg-6 col-md-12">
                <label class="form-label fs-7 fw-bold text-muted">Buscador</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control border-start-0 bg-light" placeholder="Buscar por modelo, IP, URL o correo de usuario...">
                </div>
            </div>

            <div class="col-lg-4 col-md-8">
                <label class="form-label fs-7 fw-bold text-muted">Tipo de Evento</label>
                <select name="evento" class="form-select bg-light">
                    <option value="">Todos los eventos</option>
                    <option value="created" {{ request('evento') == 'created' ? 'selected' : '' }}>Creación (created)</option>
                    <option value="updated" {{ request('evento') == 'updated' ? 'selected' : '' }}>Modificación (updated)</option>
                    <option value="deleted" {{ request('evento') == 'deleted' ? 'selected' : '' }}>Eliminación (deleted)</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-admin w-100">
                    <i class="fas fa-filter me-1"></i> Filtrar
                </button>
                @if(request()->hasAny(['buscar', 'evento']))
                    <a href="{{ route('admin.auditoria.index') }}" class="btn btn-outline-secondary rounded-pill" title="Limpiar filtros">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table of Audits -->
    <div class="card card-custom overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Tipo Evento</th>
                        <th>Usuario</th>
                        <th>Entidad Auditada</th>
                        <th>Dirección IP</th>
                        <th>Fecha / Hora</th>
                        <th class="text-end pe-4">Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($auditorias as $aud)
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold text-muted">#{{ $aud->id }}</span>
                            </td>
                            <td>
                                @if($aud->event == 'created')
                                    <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25 rounded-pill px-3 py-1">
                                        <i class="fas fa-plus-circle me-1"></i> Creación
                                    </span>
                                @elseif($aud->event == 'updated')
                                    <span class="badge bg-primary bg-opacity-15 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1">
                                        <i class="fas fa-edit me-1"></i> Modificación
                                    </span>
                                @elseif($aud->event == 'deleted')
                                    <span class="badge bg-danger bg-opacity-15 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-1">
                                        <i class="fas fa-trash me-1"></i> Eliminación
                                    </span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-2 py-1">{{ $aud->event }}</span>
                                @endif
                            </td>
                            <td>
                                @if($aud->user)
                                    <div class="fw-semibold text-dark">{{ $aud->user->nickname }}</div>
                                    <small class="text-muted">{{ $aud->user->email }}</small>
                                @else
                                    <span class="text-muted fs-8">Sistema / Desconocido</span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ class_basename($aud->auditable_type) }}</div>
                                <small class="text-muted">Registro #{{ $aud->auditable_id }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $aud->ip_address }}</span>
                            </td>
                            <td>
                                <small class="text-dark">{{ $aud->created_at ? $aud->created_at->format('d/m/Y H:i:s') : 'N/A' }}</small>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.auditoria.show', $aud->id) }}" class="btn btn-sm btn-outline-info rounded-pill px-3" title="Ver valores modificados">
                                    <i class="fas fa-eye me-1"></i> Inspeccionar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-history fs-1 d-block mb-3 text-secondary opacity-50"></i>
                                <h5>No hay registros de auditoría</h5>
                                <p class="fs-7 mb-0">No se encontraron eventos que coincidan con la búsqueda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($auditorias->hasPages())
            <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                {{ $auditorias->links() }}
            </div>
        @endif
    </div>
@endsection
