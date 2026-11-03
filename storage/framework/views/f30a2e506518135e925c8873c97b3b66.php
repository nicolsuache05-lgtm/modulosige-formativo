<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md">
                                <h4>Roles</h4>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="<?php echo e(route('sica.admin.security.roles.permision_role.index')); ?>" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-right fa-beat-fade mr-1"></i> Roles y permisos
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
                            <table id="roles_table" class="table table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Aplicación</th>
                                        <th>Rol</th>
                                        <th>Slug</th>
                                        <th class="text-center">Acceso total</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                            <td class="text-center">
                                                <i class="fas <?php echo e($r->app->icon); ?>" style="color: <?php echo e($r->app->color); ?>"></i>
                                                <?php echo e($r->app->name); ?>

                                            </td>
                                            <td>
                                                <strong><?php echo e($r->name); ?></strong>
                                            </td>
                                            <td><?php echo e($r->slug); ?></td>
                                            <td class="text-center">
                                                <?php if($r->full_access == 'Si'): ?>
                                                    <i class="fa-solid fa-check text-success"></i>
                                                <?php else: ?>
                                                    <i class="fas fa-times text-danger"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($r->description); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $('#roles_table').DataTable({});
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\security\roles\index.blade.php ENDPATH**/ ?>