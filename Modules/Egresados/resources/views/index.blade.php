@extends('egresados::layouts.master')

@section('title', 'Listado de Egresados')

@push('styles')
<style>
    .stat-card {
        border-radius: 16px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .stat-icon {
        position: absolute;
        right: -10px;
        bottom: -15px;
        font-size: 72px;
        opacity: 0.25;
    }
    .badge-status {
        font-size: 11.5px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 50px;
    }
    .badge-employed { background-color: rgba(57, 169, 0, 0.15); color: #2b8000; border: 1px solid rgba(57, 169, 0, 0.3); }
    .badge-unemployed { background-color: rgba(244, 67, 54, 0.15); color: #c62828; border: 1px solid rgba(244, 67, 54, 0.3); }
    .badge-student { background-color: rgba(33, 150, 243, 0.15); color: #1565c0; border: 1px solid rgba(33, 150, 243, 0.3); }
    .badge-entrepreneur { background-color: rgba(255, 152, 0, 0.15); color: #ef6c00; border: 1px solid rgba(255, 152, 0, 0.3); }
    .badge-other { background-color: rgba(158, 158, 158, 0.15); color: #616161; border: 1px solid rgba(158, 158, 158, 0.3); }

    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f7f5 !important;
    }
    .avatar-placeholder {
        width: 38px;
        height: 38px;
        background-color: #e0f2f1;
        color: #00796b;
        font-weight: 700;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        border: 2px solid #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="row g-4 mb-4">
    <!-- Card Total Egresados -->
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card p-4 bg-gradient shadow-sm" style="background: linear-gradient(135deg, #00324D 0%, #001A29 100%);">
            <h6 class="text-white-50 text-uppercase fw-bold mb-1 fs-8">Total Egresados</h6>
            <h3 class="fw-bold mb-0 text-white">{{ $totalEgresados }}</h3>
            <i class="fas fa-user-graduate stat-icon"></i>
        </div>
    </div>
    <!-- Card Empleados -->
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card p-4 bg-gradient shadow-sm" style="background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);">
            <h6 class="text-white-50 text-uppercase fw-bold mb-1 fs-8">Empleados</h6>
            <h3 class="fw-bold mb-0 text-white">{{ $totalEmpleados }}</h3>
            <i class="fas fa-briefcase stat-icon"></i>
        </div>
    </div>
    <!-- Card Emprendedores -->
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card p-4 bg-gradient shadow-sm" style="background: linear-gradient(135deg, #ef6c00 0%, #e65100 100%);">
            <h6 class="text-white-50 text-uppercase fw-bold mb-1 fs-8">Emprendedores</h6>
            <h3 class="fw-bold mb-0 text-white">{{ $totalEmprendedores }}</h3>
            <i class="fas fa-lightbulb stat-icon"></i>
        </div>
    </div>
    <!-- Card Estudiantes -->
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card p-4 bg-gradient shadow-sm" style="background: linear-gradient(135deg, #1565c0 0%, #0d47a1 100%);">
            <h6 class="text-white-50 text-uppercase fw-bold mb-1 fs-8">Estudiantes (Ed. Sup)</h6>
            <h3 class="fw-bold mb-0 text-white">{{ $totalEstudiantes }}</h3>
            <i class="fas fa-book-reader stat-icon"></i>
        </div>
    </div>
</div>

<div class="card card-custom p-4 glass-card shadow-sm border-0 mb-4">
    <!-- Header Controls -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">Directorio de Graduados (SIGE)</h4>
            <p class="text-muted fs-7 mb-0">Gestione y realice seguimiento al estado laboral e información de contacto de los egresados.</p>
        </div>
        <a href="{{ route('egresados.create') }}" class="btn btn-sena-orange rounded-pill px-4">
            <i class="fas fa-user-plus me-1"></i> Registrar Egresado
        </a>
    </div>

    <!-- Search and Filters Form -->
    <form action="{{ route('egresados.index') }}" method="GET" class="row g-3 pb-3 mb-2 border-bottom">
        <div class="col-md-5 col-sm-12">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Buscar por Nombre, Apellido o Documento..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <select name="employment_status" class="form-select">
                <option value="">-- Todos los Estados Laborales --</option>
                <option value="Empleado" {{ request('employment_status') == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                <option value="Desempleado" {{ request('employment_status') == 'Desempleado' ? 'selected' : '' }}>Desempleado</option>
                <option value="Estudiante" {{ request('employment_status') == 'Estudiante' ? 'selected' : '' }}>Estudiante</option>
                <option value="Emprendedor" {{ request('employment_status') == 'Emprendedor' ? 'selected' : '' }}>Emprendedor</option>
                <option value="Otro" {{ request('employment_status') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-6 d-flex gap-2">
            <button type="submit" class="btn btn-dark rounded-pill w-100 fw-semibold"><i class="fas fa-filter me-1"></i> Filtrar</button>
            <a href="{{ route('egresados.index') }}" class="btn btn-outline-secondary rounded-pill w-100 fw-semibold"><i class="fas fa-redo me-1"></i> Limpiar</a>
        </div>
    </form>

    <!-- Table content -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted uppercase font-semibold text-xs border-bottom">
                <tr>
                    <th scope="col">Egresado</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Programa & Ficha</th>
                    <th scope="col">Fecha Grado</th>
                    <th scope="col">Estado Laboral</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col" class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($egresados as $item)
                    @php
                        $person = $item->apprentice->person;
                        $course = $item->apprentice->course;
                        $fullName = $person->first_name . ' ' . $person->first_last_name . ' ' . $person->second_last_name;
                        // Obtener iniciales para avatar
                        $words = explode(' ', trim($fullName));
                        $initials = '';
                        foreach(array_slice($words, 0, 2) as $w) {
                            if (!empty($w)) $initials .= mb_strtoupper(mb_substr($w, 0, 1));
                        }
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-placeholder">
                                    {{ $initials }}
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0 fs-7">{{ $fullName }}</h6>
                                    <small class="text-muted fs-8">{{ $item->contact_email ?? $person->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-dark-emphasis fw-semibold fs-7">{{ $person->document_number }}</span>
                            <small class="text-muted d-block fs-8">{{ $person->document_type }}</small>
                        </td>
                        <td>
                            <span class="d-block fw-semibold text-dark fs-7" title="{{ $course->Program->name }}">{{ Str::limit($course->Program->name, 35) }}</span>
                            <small class="badge bg-light text-dark border fs-8">Ficha: {{ $course->code }}</small>
                        </td>
                        <td>
                            <span class="fs-7 text-dark-emphasis fw-semibold"><i class="far fa-calendar-alt text-muted me-1"></i> {{ \Carbon\Carbon::parse($item->graduation_date)->format('d/m/Y') }}</span>
                        </td>
                        <td>
                            @if($item->employment_status == 'Empleado')
                                <span class="badge badge-status badge-employed"><i class="fas fa-briefcase me-1"></i> Empleado</span>
                            @elseif($item->employment_status == 'Desempleado')
                                <span class="badge badge-status badge-unemployed"><i class="fas fa-times-circle me-1"></i> Desempleado</span>
                            @elseif($item->employment_status == 'Estudiante')
                                <span class="badge badge-status badge-student"><i class="fas fa-book-reader me-1"></i> Estudiante</span>
                            @elseif($item->employment_status == 'Emprendedor')
                                <span class="badge badge-status badge-entrepreneur"><i class="fas fa-lightbulb me-1"></i> Emprendedor</span>
                            @else
                                <span class="badge badge-status badge-other"><i class="fas fa-user-circle me-1"></i> Otro</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-dark fs-7 fw-semibold">{{ $item->contact_phone ?? $person->telephone ?? 'N/A' }}</span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('egresados.show', $item->id) }}" class="btn btn-sm btn-outline-info rounded-circle p-2" title="Ver Perfil" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('egresados.edit', $item->id) }}" class="btn btn-sm btn-outline-primary rounded-circle p-2" title="Editar" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('egresados.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de que desea eliminar el registro de este egresado?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle p-2" title="Eliminar" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-user-slash display-4 mb-3 text-secondary opacity-50"></i>
                            <h5 class="fw-bold">No se encontraron egresados</h5>
                            <p class="fs-7 text-muted">Asegúrate de registrar egresados o cambiar los criterios de búsqueda.</p>
                            <a href="{{ route('egresados.create') }}" class="btn btn-sm btn-sena-orange rounded-pill px-4 mt-2">
                                <i class="fas fa-plus me-1"></i> Registrar Primer Egresado
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    @if($egresados->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {!! $egresados->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    @endif
</div>
@endsection
