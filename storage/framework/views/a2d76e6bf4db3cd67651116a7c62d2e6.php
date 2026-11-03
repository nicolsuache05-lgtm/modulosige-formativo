<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h4>Usuarios</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="btns">
                            <a href="<?php echo e(route('sica.admin.security.users.create')); ?>" class="btn btn-success ">
                                <i class="fas fa-user-plus"></i> Registrar Usuario
                            </a>
                        </div>
                        <div class="mtop16">
                            <table id="users_table" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nickname</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Roles</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                            <td class="text-center"><?php echo e($u->nickname); ?></td>
                                            <td><?php echo e($u->person->full_name); ?></td>
                                            <td><?php echo e($u->email); ?></td>
                                            <td>
                                                <?php $__currentLoopData = $u->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p class="mb-1" data-toggle='tooltip' data-placement="top" title="Aplicación: <?php echo e($rol->app->name); ?>">
                                                        <i class="fas <?php echo e($rol->app->icon); ?> mr-1" style="color: <?php echo e($rol->app->color); ?>"></i>
                                                        <?php echo e($rol->name); ?>

                                                    </p>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="opts">
                                                    <a href="<?php echo e(route('sica.admin.security.users.edit', $u)); ?>" class="mr-1" data-toggle='tooltip' data-placement="top" title="Actualizar usuario">
                                                        <i class="fas fa-edit text-primary"></i>
                                                    </a>
                                                    <a href="#" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar el usuario <?php echo e($u->nickname); ?> de <?php echo e($u->person->full_name); ?>?')) { document.getElementById('delete-form-user<?php echo e($u->id); ?>').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar usuario">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </a>
                                                    <form id="delete-form-user<?php echo e($u->id); ?>" action="<?php echo e(route('sica.admin.security.users.destroy', $u)); ?>" method="POST" style="display: none;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                    </form>
                                                </div>
                                            </td>
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
            $('#users_table').DataTable({});
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\security\users\index.blade.php ENDPATH**/ ?>