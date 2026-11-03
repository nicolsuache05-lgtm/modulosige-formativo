<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Instructores</h3>
                    </div>
                    <div class="card-body">
                        <div class="mtop16">
                            <table id="table_instructors" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Documento</th>
                                        <th class="text-center">Correo</th>
                                        <th class="text-center">Telefono</th>
                                        <th class="text-center">Vinculacion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $instructors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instructor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                        <td class="text-center"><?php echo e($instructor->first_name); ?> <?php echo e($instructor->first_last_name); ?></td>
                                        <td class="text-center"><?php echo e($instructor->document_number); ?></td>
                                        <td class="text-center"><?php echo e($instructor->misena_email); ?></td>
                                        <td class="text-center"><?php echo e($instructor->telephone1); ?></td>
                                        <td class="text-center"><?php echo e($instructor->vinculacion); ?></td>
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
            $("#table_instructors").DataTable({});
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\people\instructors\index.blade.php ENDPATH**/ ?>