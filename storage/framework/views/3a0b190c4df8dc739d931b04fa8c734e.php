<?php $__env->startSection('title', 'Editar Usuario - Administración'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-9">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
            <div>
                <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="btn btn-sm btn-outline-secondary rounded-pill mb-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver al listado
                </a>
                <h2 class="fw-bold text-dark mb-0">Modificar Usuario: <?php echo e($usuario->nickname); ?></h2>
                <p class="text-muted fs-6 mb-0">Actualización de datos de la cuenta, roles asignados y credenciales.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card card-custom p-4 p-md-5">
            <form action="<?php echo e(route('admin.usuarios.update', $usuario->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row g-4">
                    <!-- Nickname -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Nombre de Usuario / Nickname <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-user text-muted"></i></span>
                            <input type="text" name="nickname" value="<?php echo e(old('nickname', $usuario->nickname)); ?>" class="form-control <?php $__errorArgs = ['nickname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        </div>
                        <?php $__errorArgs = ['nickname'];
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

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Correo Electrónico Institucional <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                            <input type="email" name="email" value="<?php echo e(old('email', $usuario->email)); ?>" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        </div>
                        <?php $__errorArgs = ['email'];
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

                    <!-- Password (Opcional) -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark fs-7">Nueva Contraseña (Dejar vacío para no cambiar)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                            <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="••••••••">
                        </div>
                        <?php $__errorArgs = ['password'];
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
                            <?php $__currentLoopData = $personas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($p->id); ?>" <?php echo e(old('person_id', $usuario->person_id) == $p->id ? 'selected' : ''); ?>>
                                    <?php echo e($p->first_name); ?> <?php echo e($p->first_last_name); ?> <?php echo e($p->second_last_name); ?> (Doc: <?php echo e($p->document_number); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Asignación de Roles -->
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark fs-7">Roles Asignados en el ERP <span class="text-danger">*</span></label>
                        <?php
                            $userRoleIds = $usuario->roles->pluck('id')->toArray();
                        ?>
                        <div class="border rounded-4 p-3 bg-light" style="max-height: 220px; overflow-y: auto;">
                            <div class="row g-2">
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <div class="form-check p-2 bg-white rounded-3 border">
                                            <input class="form-check-input ms-1" type="checkbox" name="roles[]" value="<?php echo e($rol->id); ?>" id="role_<?php echo e($rol->id); ?>" <?php echo e(in_array($rol->id, old('roles', $userRoleIds)) ? 'checked' : ''); ?>>
                                            <label class="form-check-label ms-2 fw-semibold fs-7 text-dark" for="role_<?php echo e($rol->id); ?>">
                                                <?php echo e($rol->name); ?>

                                                <small class="text-muted d-block fs-8"><?php echo e($rol->slug); ?></small>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php $__errorArgs = ['roles'];
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

                    <!-- Botones de Acción -->
                    <div class="col-12 d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="btn btn-outline-secondary rounded-pill px-4">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\Admin\resources\views\usuarios\edit.blade.php ENDPATH**/ ?>