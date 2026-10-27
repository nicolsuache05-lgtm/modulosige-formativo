@extends('admin::layouts.master')

@section('title', 'Nuevo Rol - Administración')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
            <div>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill mb-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver al listado
                </a>
                <h2 class="fw-bold text-dark mb-0">Crear Nuevo Perfil de Rol</h2>
                <p class="text-muted fs-6 mb-0">Definición de rol institucional, app de pertenencia y permisos concedidos.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card card-custom p-4 p-md-5">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <!-- Nombre del Rol -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Nombre del Rol <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-id-badge text-muted"></i></span>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Ej: Coordinador de Calidad" required>
                        </div>
                        @error('name')
                            <div class="text-danger fs-8 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug de Seguridad -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Slug de Seguridad <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-fingerprint text-muted"></i></span>
                            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control @error('slug') is-invalid @enderror" placeholder="Ej: coordinador.calidad" required>
                        </div>
                        <small class="text-muted fs-8">Identificador único en minúsculas y sin espacios.</small>
                        @error('slug')
                            <div class="text-danger fs-8 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Aplicación a la que pertenece -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Aplicación Vinculada <span class="text-danger">*</span></label>
                        <select name="app_id" class="form-select bg-light" required>
                            <option value="">-- Selecciona la aplicación --</option>
                            @foreach($apps as $app)
                                <option value="{{ $app->id }}" {{ old('app_id') == $app->id ? 'selected' : '' }}>
                                    {{ $app->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('app_id')
                            <div class="text-danger fs-8 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Acceso Total -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">¿Tiene Acceso Total (Superadmin)? <span class="text-danger">*</span></label>
                        <select name="full_access" class="form-select bg-light" required>
                            <option value="No" {{ old('full_access') == 'No' ? 'selected' : '' }}>No (Permisos granulares)</option>
                            <option value="Si" {{ old('full_access') == 'Si' ? 'selected' : '' }}>Si (Acceso irrestricto)</option>
                        </select>
                    </div>

                    <!-- Descripción -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark fs-7">Descripción del Rol</label>
                        <textarea name="description" rows="2" class="form-control bg-light" placeholder="Describe los alcances y responsabilidades de este rol...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Permisos -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark fs-7">Permisos Técnicos Asignados</label>
                        <div class="border rounded-4 p-3 bg-light" style="max-height: 240px; overflow-y: auto;">
                            <div class="row g-2">
                                @forelse($permisos as $p)
                                    <div class="col-md-6">
                                        <div class="form-check p-2 bg-white rounded-3 border">
                                            <input class="form-check-input ms-1" type="checkbox" name="permissions[]" value="{{ $p->id }}" id="perm_{{ $p->id }}" {{ is_array(old('permissions')) && in_array($p->id, old('permissions')) ? 'checked' : '' }}>
                                            <label class="form-check-label ms-2 fs-7 text-dark fw-semibold" for="perm_{{ $p->id }}">
                                                {{ $p->name }}
                                                <small class="text-muted d-block fs-8">{{ $p->slug }} @if($p->app) • {{ $p->app->name }} @endif</small>
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-muted text-center py-2">No hay permisos disponibles para asignar.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-12 d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-admin px-5">
                            <i class="fas fa-save me-1"></i> Guardar Rol
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
