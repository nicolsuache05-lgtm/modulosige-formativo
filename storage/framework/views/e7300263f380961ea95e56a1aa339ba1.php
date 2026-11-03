<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Fincas</h3>
                    </div>
                    <div class="card-body">
                        <div class="btns">
                            <a href="<?php echo e(route('sica.admin.location.farms.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Registrar finca
                            </a>
                        </div>
                        <div class="mtop16">
                            <table id="table_farms" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Responsable</th>
                                        <th class="text-center">Localización</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $farms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($f->name); ?></td>
                                            <td><?php echo e($f->description); ?></td>
                                            <td><?php echo e($f->person->full_name); ?></td>
                                            <td class="text-center"><?php echo e($f->municipality->cou_dep_mun); ?></td>
                                            <td class="text-center">
                                                <div class="text-center">
                                                    <a href="<?php echo e(route('sica.admin.location.farms.edit', $f)); ?>" data-toggle='tooltip' data-placement="top" title="Actualizar finca">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo e(route('sica.admin.location.farms.destroy', $f)); ?>" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar la finca <?php echo e($f->name); ?>?')) { document.getElementById('delete-form-farm<?php echo e($f->id); ?>').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar finca">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </a>
                                                    <form id="delete-form-farm<?php echo e($f->id); ?>" action="<?php echo e(route('sica.admin.location.farms.destroy', $f)); ?>" method="POST" style="display: none;">
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
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(function() {
            $('#table_farms').DataTable({});
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\location\farms\index.blade.php ENDPATH**/ ?>