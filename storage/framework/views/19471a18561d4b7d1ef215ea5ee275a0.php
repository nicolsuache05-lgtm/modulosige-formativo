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
                                <h4>Relación de roles y permisos</h4>
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
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">Aplicación</th>
                                        <th class="text-center">Rol</th>
                                        <th>Permiso</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                    <?php $__currentLoopData = $apps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $app->roles->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $permissionsSorted = $role->permissions->sortBy('slug') ?>
                                            <?php $permissionCount = count($permissionsSorted) ?>
                                            <tr>
                                                <?php if($permissionCount > 0): ?>
                                                    <td class="text-center" rowspan="<?php echo e($permissionCount); ?>">
                                                        <h1 style="color: <?php echo e($app->color); ?>"><i class="fas <?php echo e($app->icon); ?>"></i></h1>
                                                        <?php echo e($app->name); ?>

                                                    </td>
                                                    <td class="text-center" rowspan="<?php echo e($permissionCount); ?>">
                                                        <strong><?php echo e($role->name); ?></strong>
                                                        <br>
                                                        <a href="<?php echo e(route('sica.admin.security.roles.permision_role.create', ['role_id' => $role->id])); ?>">
                                                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="Registrar EPS">
                                                                <i class="fas fa-plus-circle"></i>
                                                            </b>
                                                        </a>
                                                    </td>
                                                    <td><?php echo e($permissionsSorted[0]->name); ?></td>
                                                    <td><?php echo e($permissionsSorted[0]->description); ?></td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php $__currentLoopData = $permissionsSorted->splice(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($permission->name); ?></td>
                                                    <td><?php echo e($permission->description); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\security\permission_role\index.blade.php ENDPATH**/ ?>