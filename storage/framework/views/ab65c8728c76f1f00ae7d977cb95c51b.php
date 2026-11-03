<?php $__env->startSection('title', 'Control de Usuarios - Administración'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header Title -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <div>
            <span class="badge badge-admin-apoyo px-3 py-1 rounded-pill mb-2">
                <i class="fas fa-users-cog me-1"></i> Control de Accesos
            </span>
            <h2 class="fw-bold text-dark mb-0">Gestión General de Usuarios</h2>
            <p class="text-muted fs-6 mb-0">Administración de cuentas, credenciales, asociación con personas y roles en SENA Empresa ERP.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?php echo e(route('admin.usuarios.create')); ?>" class="btn btn-admin shadow-sm">
                <i class="fas fa-user-plus me-1"></i> Nuevo Usuario
            </a>
        </div>
    </div>

    <!-- Summary Metrics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-sm-6">
            <div class="card card-custom p-3 border-start border-4 border-info">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Total Usuarios</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1"><?php echo e($totalUsuarios); ?></h3>
                    </div>
                    <div class="rounded-circle p-3 bg-info bg-opacity-10 text-info">
                        <i class="fas fa-users fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="card card-custom p-3 border-start border-4 border-warning">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Roles Activos</span>
                        <h3 class="fw-bold text-warning mb-0 mt-1"><?php echo e($totalRoles); ?></h3>
                    </div>
                    <div class="rounded-circle p-3 bg-warning bg-opacity-10 text-warning">
                        <i class="fas fa-user-shield fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-12">
            <div class="card card-custom p-3 border-start border-4 border-success">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fs-7 fw-semibold text-uppercase">Filtrados en Vista</span>
                        <h3 class="fw-bold text-success mb-0 mt-1"><?php echo e($usuarios->total()); ?></h3>
                    </div>
                    <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success">
                        <i class="fas fa-filter fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search Bar -->
    <div class="card card-custom p-4 mb-4">
        <form method="GET" action="<?php echo e(route('admin.usuarios.index')); ?>" class="row g-3 align-items-end">
            <div class="col-lg-6 col-md-12">
                <label class="form-label fs-7 fw-bold text-muted">Buscador</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="buscar" value="<?php echo e(request('buscar')); ?>" class="form-control border-start-0 bg-light" placeholder="Buscar por usuario, correo, documento o nombre...">
                </div>
            </div>

            <div class="col-lg-4 col-md-8">
                <label class="form-label fs-7 fw-bold text-muted">Filtrar por Rol</label>
                <select name="role_id" class="form-select bg-light">
                    <option value="">Todos los roles</option>
                    <?php $__currentLoopData = $rolesDisponibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($rol->id); ?>" <?php echo e(request('role_id') == $rol->id ? 'selected' : ''); ?>>
                            <?php echo e($rol->name); ?> (<?php echo e($rol->slug); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-lg-2 col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-admin w-100">
                    <i class="fas fa-filter me-1"></i> Filtrar
                </button>
                <?php if(request()->hasAny(['buscar', 'role_id'])): ?>
                    <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="btn btn-outline-secondary rounded-pill" title="Limpiar filtros">
                        <i class="fas fa-times"></i>
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Table of Users -->
    <div class="card card-custom overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Usuario</th>
                        <th>Persona Vinculada</th>
                        <th>Correo Electrónico</th>
                        <th>Roles Asignados</th>
                        <th>Registro</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle-sm">
                                        <?php echo e($u->initials); ?>

                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark"><?php echo e($u->nickname); ?></div>
                                        <small class="text-muted">ID: #<?php echo e($u->id); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if($u->person): ?>
                                    <div class="fw-semibold text-dark"><?php echo e($u->person->first_name); ?> <?php echo e($u->person->first_last_name); ?></div>
                                    <small class="text-muted">Doc: <?php echo e($u->person->document_number); ?></small>
                                <?php else: ?>
                                    <span class="badge bg-secondary bg-opacity-15 text-secondary border border-secondary border-opacity-25 rounded-pill px-2 py-1">
                                        Sin persona vinculada
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="text-dark"><?php echo e($u->email); ?></span>
                            </td>
                            <td>
                                <?php $__empty_2 = true; $__currentLoopData = $u->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                    <span class="badge bg-primary bg-opacity-15 text-primary border border-primary border-opacity-25 rounded-pill px-2 py-1 fs-8 me-1">
                                        <?php echo e($rol->name); ?>

                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                    <span class="badge bg-warning bg-opacity-15 text-warning border border-warning border-opacity-25 rounded-pill px-2 py-1 fs-8">
                                        Sin rol
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <small class="text-muted"><?php echo e($u->created_at ? $u->created_at->format('d/m/Y') : 'N/A'); ?></small>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-1">
                                    <a href="<?php echo e(route('admin.usuarios.edit', $u->id)); ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3" title="Editar usuario">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.usuarios.destroy', $u->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este usuario del sistema?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Eliminar usuario">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-users-slash fs-1 d-block mb-3 text-secondary opacity-50"></i>
                                <h5>No se encontraron usuarios</h5>
                                <p class="fs-7 mb-3">Intenta cambiar los términos de búsqueda o filtros aplicados.</p>
                                <a href="<?php echo e(route('admin.usuarios.create')); ?>" class="btn btn-admin btn-sm">
                                    <i class="fas fa-plus me-1"></i> Registrar Primer Usuario
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <?php if($usuarios->hasPages()): ?>
            <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                <?php echo e($usuarios->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\Admin\resources\views\usuarios\index.blade.php ENDPATH**/ ?>