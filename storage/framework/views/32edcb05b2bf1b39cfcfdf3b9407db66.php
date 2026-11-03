<?php if($user): ?>
    <form method="POST" action="<?php echo e(route('sica.admin.security.users.update', $user)); ?>">
<?php else: ?>
    <form method="POST" action="<?php echo e(route('sica.admin.security.users.store')); ?>">
<?php endif; ?>
    <?php echo csrf_field(); ?>
    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-right">Nombre de la persona:</label>
        <div class="col-md-6 col-form-label">
            <?php echo e($person->full_name); ?>

            <input type="hidden" class="form-control" name="person_id" value="<?php echo e($person->id); ?>" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nickname" class="col-md-4 col-form-label text-md-right">Nombre de usuario:</label>
        <div class="col-md-6">
            <input id="nickname" type="text" class="form-control" name="nickname" value="<?php echo e($user ? $user->nickname : ''); ?>" <?php echo e($user ? 'disabled' : 'required'); ?>>
        </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico personal:</label>
        <div class="col-md-6">
            <input id="personal_email" type="email" class="form-control" name="personal_email" value="<?php echo e($user ? $user->email : $person->personal_email); ?>" <?php echo e($user ? 'disabled' : 'required'); ?>>
        </div>
    </div>

    <div class="text-center">
        <strong>Roles disponibles:</strong>
    </div>
    <div class="row justify-content-md-center mb-3">
        <?php $__currentLoopData = $apps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 border border-1 p-3 bg-light">
                <h5><i class="fas <?php echo e($app->icon); ?> mr-2" style="color: <?php echo e($app->color); ?>"></i><?php echo e($app->name); ?></h5>
                <?php $__currentLoopData = $app->roles->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-check">
                        <input class="form-check-input" name="roles_id[]" type="checkbox" value="<?php echo e($role->id); ?>" <?php echo e($user ? ($user->roles->contains($role->id) ? 'checked' : '') : ''); ?>>
                        <label class="form-check-label"><?php echo e($role->name); ?></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row mb-0 text-center">
        <div class="col-md">
            <?php if($user): ?>
            <button type="submit" class="ml-2 btn btn-success">
                Actualizar usuario
            </button>
            <?php else: ?>
                <a href="#" style="font-size: 12px" onclick="password_specifications()">¿Cómo se genera la contraseña?</a>
                <button type="submit" class="ml-2 btn btn-primary">
                    Registrar usuario
                </button>
            <?php endif; ?>
        </div>
    </div>
</form>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\security\users\search_person.blade.php ENDPATH**/ ?>