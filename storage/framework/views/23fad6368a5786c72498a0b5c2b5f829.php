<?php $__env->startSection('stylesheet'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md">
                                <h4>Asociación de permisos al rol <?php echo e($role->name); ?></h4>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="<?php echo e(route('sica.admin.security.roles.index')); ?>" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Roles
                                </a>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="<?php echo e(route('sica.admin.security.roles.pu_roles.index')); ?>" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-right fa-beat-fade mr-1"></i> Roles y unidades productivas
                                </a>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="<?php echo e(route('sica.admin.security.roles.responsibilities.index')); ?>" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-right fa-beat-fade mr-1"></i> Responsabilidades
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mtop16">
                            <h2><?php echo e($role->name); ?></h2>
                            <br>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label for="Aspecto<?php echo e($permission->id); ?>">
                                <input class="association-checkbox" type="checkbox" name="perissions[]"
                                    data-permission-id="<?php echo e($permission->id); ?>" id="Aspecto<?php echo e($permission->id); ?>" value="<?php echo e($permission->id); ?>"
                                    <?php echo e(in_array($permission->id, $permisisonsasociate) ? 'checked' : ''); ?>>
                                <?php echo e($permission->name); ?> - <?php echo e($permission->slug); ?>

                            </label>
                            <input type="hidden" id="role_id" value="<?php echo e($role->id); ?>">
                            <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.association-checkbox').change(function() {
            var role_id = $('#role_id').val();
            var permissionId = $(this).data('permission-id');
            var isChecked = $(this).prop('checked');

            $.ajax({
                url: '<?php echo e(route('sica.admin.security.roles.permision_role.store')); ?>',
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    role_id: role_id,
                    permissionId: permissionId,
                    checked: isChecked
                },
                success: function(data) {
                    // Muestra una alerta al usuario
                    Swal.fire({
                        icon: 'success',
                        title: '<?php echo e(trans('senaempresa::menu.Success')); ?>',
                        text: data.success,
                    });
                },
                error: function(error) {
                    // Muestra una alerta de error al usuario
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '<?php echo e(trans('senaempresa::menu.An error occurred while processing the request.')); ?>',
                    });
                    $(this).prop('checked', !isChecked);
                }
            });
        });
    });
</script>
<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\security\pu_roles\create.blade.php ENDPATH**/ ?>