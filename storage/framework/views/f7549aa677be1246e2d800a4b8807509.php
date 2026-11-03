<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-10">
                    <div class="card-header">
                        <h4>Formulario de registro de usuario</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('sica.admin.security.users.update', $user)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Nombre de la persona:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="full_name" value="<?php echo e($user->person->full_name); ?>" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nickname" class="col-md-4 col-form-label text-md-right">Nombre de usuario:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nickname" value="<?php echo e($user->nickname); ?>" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico personal:</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="personal_email" value="<?php echo e($user->email); ?>" disabled>
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
                                                <input class="form-check-input" name="roles_id[]" type="checkbox" value="<?php echo e($role->id); ?>" <?php echo e($user->roles->contains($role->id) ? 'checked' : ''); ?>>
                                                <label class="form-check-label"><?php echo e($role->name); ?></label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="row mb-0 text-center">
                                <div class="col-md">
                                    <button type="submit" class="ml-2 btn btn-success">
                                        Actualizar usuario
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\security\users\edit.blade.php ENDPATH**/ ?>