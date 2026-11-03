<?php $__env->startSection('title', 'Editar Rol - Administración'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-9">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
            <div>
                <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-sm btn-outline-secondary rounded-pill mb-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver al listado
                </a>
                <h2 class="fw-bold text-dark mb-0">Modificar Rol: <?php echo e($role->name); ?></h2>
                <p class="text-muted fs-6 mb-0">Actualización de datos del perfil institucional y matriz de permisos.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card card-custom p-4 p-md-5">
            <form action="<?php echo e(route('admin.roles.update', $role->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row g-4">
                    <!-- Nombre del Rol -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Nombre del Rol <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-id-badge text-muted"></i></span>
                            <input type="text" name="name" value="<?php echo e(old('name', $role->name)); ?>" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        </div>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger fs-8 mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Slug de Seguridad -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Slug de Seguridad <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-fingerprint text-muted"></i></span>
                            <input type="text" name="slug" value="<?php echo e(old('slug', $role->slug)); ?>" class="form-control <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        </div>
                        <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger fs-8 mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Aplicación a la que pertenece -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Aplicación Vinculada <span class="text-danger">*</span></label>
                        <select name="app_id" class="form-select bg-light" required>
                            <option value="">-- Selecciona la aplicación --</option>
                            <?php $__currentLoopData = $apps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($app->id); ?>" <?php echo e(old('app_id', $role->app_id) == $app->id ? 'selected' : ''); ?>>
                                    <?php echo e($app->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['app_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger fs-8 mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Acceso Total -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">¿Tiene Acceso Total (Superadmin)? <span class="text-danger">*</span></label>
                        <select name="full_access" class="form-select bg-light" required>
                            <option value="No" <?php echo e(old('full_access', $role->full_access) == 'No' ? 'selected' : ''); ?>>No (Permisos granulares)</option>
                            <option value="Si" <?php echo e(old('full_access', $role->full_access) == 'Si' ? 'selected' : ''); ?>>Si (Acceso irrestricto)</option>
                        </select>
                    </div>

                    <!-- Descripción -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark fs-7">Descripción del Rol</label>
                        <textarea name="description" rows="2" class="form-control bg-light"><?php echo e(old('description', $role->description)); ?></textarea>
                    </div>

                    <!-- Permisos -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark fs-7">Permisos Técnicos Asignados</label>
                        <?php
                            $rolePermIds = $role->permissions->pluck('id')->toArray();
                        ?>
                        <div class="border rounded-4 p-3 bg-light" style="max-height: 240px; overflow-y: auto;">
                            <div class="row g-2">
                                <?php $__empty_1 = true; $__currentLoopData = $permisos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="col-md-6">
                                        <div class="form-check p-2 bg-white rounded-3 border">
                                            <input class="form-check-input ms-1" type="checkbox" name="permissions[]" value="<?php echo e($p->id); ?>" id="perm_<?php echo e($p->id); ?>" <?php echo e(in_array($p->id, old('permissions', $rolePermIds)) ? 'checked' : ''); ?>>
                                            <label class="form-check-label ms-2 fs-7 text-dark fw-semibold" for="perm_<?php echo e($p->id); ?>">
                                                <?php echo e($p->name); ?>

                                                <small class="text-muted d-block fs-8"><?php echo e($p->slug); ?> <?php if($p->app): ?> • <?php echo e($p->app->name); ?> <?php endif; ?></small>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="col-12 text-muted text-center py-2">No hay permisos disponibles para asignar.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-12 d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-admin px-5">
                            <i class="fas fa-sync-alt me-1"></i> Actualizar Rol
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\Admin\resources\views\roles\edit.blade.php ENDPATH**/ ?>