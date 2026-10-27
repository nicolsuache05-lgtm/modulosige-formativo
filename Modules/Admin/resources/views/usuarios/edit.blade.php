@extends('admin::layouts.master')

@section('title', 'Editar Usuario - Administración')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
            <div>
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill mb-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver al listado
                </a>
                <h2 class="fw-bold text-dark mb-0">Modificar Usuario: {{ $usuario->nickname }}</h2>
                <p class="text-muted fs-6 mb-0">Actualización de datos de la cuenta, roles asignados y credenciales.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card card-custom p-4 p-md-5">
            <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Nickname -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Nombre de Usuario / Nickname <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-user text-muted"></i></span>
                            <input type="text" name="nickname" value="{{ old('nickname', $usuario->nickname) }}" class="form-control @error('nickname') is-invalid @enderror" required>
                        </div>
                        @error('nickname')
                            <div class="text-danger fs-8 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Correo Electrónico Institucional <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                            <input type="email" name="email" value="{{ old('email', $usuario->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                        </div>
                        @error('email')
                            <div class="text-danger fs-8 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password (Opcional) -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Nueva Contraseña (Dejar vacío para no cambiar)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                        </div>
                        @error('password')
                            <div class="text-danger fs-8 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Confirmar Nueva Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-lock-open text-muted"></i></span>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Persona Vinculada -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark fs-7">Persona Vinculada en SICA</label>
                        <select name="person_id" class="form-select bg-light">
                            <option value="">-- Sin persona vinculada --</option>
                            @foreach($personas as $p)
                                <option value="{{ $p->id }}" {{ old('person_id', $usuario->person_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->first_name }} {{ $p->first_last_name }} {{ $p->second_last_name }} (Doc: {{ $p->document_number }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Asignación de Roles -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark fs-7">Roles Asignados en el ERP <span class="text-danger">*</span></label>
                        @php
                            $userRoleIds = $usuario->roles->pluck('id')->toArray();
                        @endphp
                        <div class="border rounded-4 p-3 bg-light" style="max-height: 220px; overflow-y: auto;">
                            <div class="row g-2">
                                @foreach($roles as $rol)
                                    <div class="col-md-6">
                                        <div class="form-check p-2 bg-white rounded-3 border">
                                            <input class="form-check-input ms-1" type="checkbox" name="roles[]" value="{{ $rol->id }}" id="role_{{ $rol->id }}" {{ in_array($rol->id, old('roles', $userRoleIds)) ? 'checked' : '' }}>
                                            <label class="form-check-label ms-2 fw-semibold fs-7 text-dark" for="role_{{ $rol->id }}">
                                                {{ $rol->name }}
                                                <small class="text-muted d-block fs-8">{{ $rol->slug }}</small>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('roles')
                            <div class="text-danger fs-8 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-12 d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-admin px-5">
                            <i class="fas fa-sync-alt me-1"></i> Actualizar Usuario
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
