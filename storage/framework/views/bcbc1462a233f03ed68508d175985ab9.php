<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-auto">
                                <h4>Asociación de aplicaciones y unidades productivas</h4>
                            </div>
                            <div class="col-md">
                                <a href="<?php echo e(route('sica.admin.security.apps.index')); ?>" class="btn btn-info float-right ml-1">
                                  <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Aplicaciones
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form action="<?php echo e(route('sica.admin.security.apps.app_pus.store')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label>Aplicación:</label>
                                        <select name="app_id" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            <?php $__currentLoopData = $apps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($a->id); ?>"><?php echo e($a->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Unidad productiva:</label>
                                        <select name="productive_unit_id" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            <?php $__currentLoopData = $productive_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($pu->id); ?>"><?php echo e($pu->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Sincronizar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="text-center">Aplicación</th>
                                                <th>Bodega</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $previous_app_id = null;
                                            ?>
                                            <?php $__currentLoopData = $app_pus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($previous_app_id !== $apu->app_id): ?>
                                                    <tr>
                                                        <td class="text-center" rowspan="<?php echo e($app_pus->where('app_id', $apu->app_id)->count()); ?>">
                                                            <h3 style="color: <?php echo e($apu->app->color); ?>"><i class="fas <?php echo e($apu->app->icon); ?>"></i></h3>
                                                            <?php echo e($apu->app->name); ?>

                                                        </td>
                                                <?php else: ?>
                                                    <tr>
                                                <?php endif; ?>
                                                    <td style="vertical-align: middle"><?php echo e($apu->productive_unit->name); ?></td>
                                                    <td class="text-center"  style="vertical-align: middle">
                                                        <a href="#" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar la asociación de la aplicación <?php echo e($apu->app->name); ?> y la unidad productiva <?php echo e($apu->productive_unit->name); ?>?')) { document.getElementById('delete-form-apu<?php echo e($apu->id); ?>').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar asociación">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
                                                        <form id="delete-form-apu<?php echo e($apu->id); ?>" action="<?php echo e(route('sica.admin.security.apps.app_pus.destroy', $apu)); ?>" method="POST" style="display: none;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $previous_app_id = $apu->app_id;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\security\app_pus\index.blade.php ENDPATH**/ ?>