<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-auto">
                                <h4>Asociación de ambientes y unidades productivas</h4>
                            </div>
                            <div class="col-md">
                                <a href="<?php echo e(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_unit.index')); ?>" class="btn btn-info float-right ml-1">
                                  <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Unidades productivas
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form action="<?php echo e(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_units.environment_pus.store')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label>Unidad productiva:</label>
                                        <select name="productive_unit_id" class="form-control">
                                            <option value="">-- Seleccione --</option>
                                            <?php $__currentLoopData = $productive_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($pu->id); ?>"><?php echo e($pu->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ambiente:</label>
                                        <select name="environment_id" class="form-control">
                                            <option value="">-- Seleccione --</option>
                                            <?php $__currentLoopData = $environments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($e->id); ?>"><?php echo e($e->name); ?></option>
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
                                                <th class="text-center">Unidad productiva</th>
                                                <th class="text-center">Ambiente</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $previous_productive_unit_id = null;
                                            ?>
                                            <?php $__currentLoopData = $environment_pus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $epu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($previous_productive_unit_id !== $epu->productive_unit_id): ?>
                                                    <tr>
                                                        <td style="vertical-align: middle" class="text-center" rowspan="<?php echo e($environment_pus->where('productive_unit_id', $epu->productive_unit_id)->count()); ?>">
                                                        <?php echo e($epu->productive_unit->name ?? 'N/A'); ?>

                                                    </td>
                                                <?php else: ?>
                                                    <tr>
                                                <?php endif; ?>
                                                    <td class="text-center"><?php echo e($epu->environment->name ?? 'N/A'); ?></td>
                                                    <td class="text-center">
                                                        <a href="#" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar la asociación de la unidad productiva <?php echo e($epu->productive_unit->name ?? 'N/A'); ?> y el ambiente <?php echo e($epu->environment->name ?? 'N/A'); ?>?')) { document.getElementById('delete-form-epu<?php echo e($epu->id); ?>').submit(); }" data-toggle='tooltip' data-placement="top" title="Eliminar asociación">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
                                                        <form id="delete-form-epu<?php echo e($epu->id); ?>" action="<?php echo e(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_units.environment_pus.destroy', $epu)); ?>" method="POST" style="display: none;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $previous_productive_unit_id = $epu->productive_unit_id;
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

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\units\environment_pus\index.blade.php ENDPATH**/ ?>