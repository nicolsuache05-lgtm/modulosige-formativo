@extends('admin::layouts.master')

@section('title', 'Detalle de Auditoría #' . $auditoria->id . ' - Administración')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">

        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
            <div>
                <a href="{{ route('admin.auditoria.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill mb-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver a la bitácora
                </a>
                <h2 class="fw-bold text-dark mb-0">Inspección Forense de Evento #{{ $auditoria->id }}</h2>
                <p class="text-muted fs-6 mb-0">Detalles de la modificación registrada en la base de datos.</p>
            </div>
            <div>
                @if($auditoria->event == 'created')
                    <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25 rounded-pill px-3 py-2 fs-7">
                        <i class="fas fa-plus-circle me-1"></i> Evento de Creación
                    </span>
                @elseif($auditoria->event == 'updated')
                    <span class="badge bg-primary bg-opacity-15 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-2 fs-7">
                        <i class="fas fa-edit me-1"></i> Evento de Modificación
                    </span>
                @elseif($auditoria->event == 'deleted')
                    <span class="badge bg-danger bg-opacity-15 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2 fs-7">
                        <i class="fas fa-trash me-1"></i> Evento de Eliminación
                    </span>
                @endif
            </div>
        </div>

        <!-- Meta Information Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card card-custom p-3 h-100">
                    <span class="text-muted fs-8 fw-bold text-uppercase">Usuario Responsable</span>
                    @if($auditoria->user)
                        <div class="d-flex align-items-center gap-2 mt-2">
                            <div class="avatar-circle-sm">
                                {{ $auditoria->user->initials }}
                            </div>
                            <div>
                                <div class="fw-bold text-dark fs-7">{{ $auditoria->user->nickname }}</div>
                                <small class="text-muted">{{ $auditoria->user->email }}</small>
                            </div>
                        </div>
                    @else
                        <div class="fw-bold text-muted mt-2">Sistema / No identificado</div>
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom p-3 h-100">
                    <span class="text-muted fs-8 fw-bold text-uppercase">Entidad / Registro</span>
                    <div class="mt-2">
                        <div class="fw-bold text-dark">{{ class_basename($auditoria->auditable_type) }}</div>
                        <small class="text-muted">ID Registro: #{{ $auditoria->auditable_id }}</small>
                        <div class="text-muted fs-8">{{ $auditoria->auditable_type }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom p-3 h-100">
                    <span class="text-muted fs-8 fw-bold text-uppercase">Origen y Fecha</span>
                    <div class="mt-2">
                        <div><i class="fas fa-network-wired text-info me-1"></i> <span class="fw-semibold">{{ $auditoria->ip_address }}</span></div>
                        <small class="text-muted d-block"><i class="fas fa-calendar-alt me-1"></i> {{ $auditoria->created_at ? $auditoria->created_at->format('d/m/Y H:i:s') : 'N/A' }}</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- URL and User Agent -->
        <div class="card card-custom p-3 mb-4">
            <div class="row g-2 fs-7">
                <div class="col-md-12">
                    <strong class="text-muted">URL Invocada:</strong>
                    <code class="ms-1">{{ $auditoria->url }}</code>
                </div>
                <div class="col-md-12">
                    <strong class="text-muted">User Agent (Navegador/Cliente):</strong>
                    <span class="text-muted ms-1 fs-8">{{ $auditoria->user_agent }}</span>
                </div>
            </div>
        </div>

        <!-- Comparison Cards: Old vs New Values -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card card-custom p-4 h-100 border-start border-4 border-warning">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="fas fa-history text-warning me-2"></i> Valores Anteriores (Old Values)
                    </h5>
                    @if(!empty($auditoria->old_values))
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered fs-8 mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Campo</th>
                                        <th>Valor Previo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($auditoria->old_values as $key => $val)
                                        <tr>
                                            <td class="fw-bold">{{ $key }}</td>
                                            <td><code>{{ is_array($val) ? json_encode($val) : $val }}</code></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-light border rounded-3 text-muted fs-7 mb-0">
                            <i class="fas fa-info-circle me-1"></i> No existen valores previos (es una creación o no se registraron).
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-custom p-4 h-100 border-start border-4 border-success">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="fas fa-check-circle text-success me-2"></i> Valores Nuevos (New Values)
                    </h5>
                    @if(!empty($auditoria->new_values))
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered fs-8 mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Campo</th>
                                        <th>Valor Nuevo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($auditoria->new_values as $key => $val)
                                        <tr>
                                            <td class="fw-bold text-success">{{ $key }}</td>
                                            <td><code>{{ is_array($val) ? json_encode($val) : $val }}</code></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-light border rounded-3 text-muted fs-7 mb-0">
                            <i class="fas fa-info-circle me-1"></i> No se registraron nuevos valores (es una eliminación).
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
