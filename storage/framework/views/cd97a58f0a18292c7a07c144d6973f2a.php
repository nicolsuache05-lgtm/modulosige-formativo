<?php $__env->startSection('stylesheet'); ?>
    @livewireStyles()
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-8">
                    <div class="card-header">
                        <h4><?php echo e(trans('sica::menu.Productive Unit Registration')); ?></h4>
                    </div>
                    <form action="<?php echo e(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_unit.store')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="card-body pb-1">
                            <div class="form-group">
                                <label>Área productiva:</label>
                                <select name="sector_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    <?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($s->id); ?>" <?php echo e(old('sector_id') == $s->id ? 'selected' : ''); ?>><?php echo e($s->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('sica::menu.Name')); ?>:</label>
                                <?php echo Form::text('name', null, [
                                    'class'=>'form-control',
                                    'required'
                                ]); ?>

                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('sica::menu.Description')); ?>:</label>
                                <?php echo Form::textarea('description', null, [
                                    'class'=>'form-control',
                                    'rows'=>'3',
                                    'required'
                                ]); ?>

                            </div>
                            <div class="form-group">
                                <label>Icono:</label>
                                <?php echo Form::text('icon', null, ['class'=>'form-control']); ?>

                            </div>

                            
                            @livewire('sica::admin.units.productive-units.consult-leader', ['productive_unit'=>null])

                            <div class="form-group">
                                <label>Finca:</label>
                                <select name="farm_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    <?php $__currentLoopData = $farms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($f->id); ?>" <?php echo e(old('farm_id') == $f->id ? 'selected' : ''); ?>><?php echo e($f->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                        </div>
                        <div class="card-footer py-2 text-right">
                            <a href="<?php echo e(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_unit.index')); ?>" class="btn btn-secondary btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-sm"><?php echo e(trans('sica::menu.Register')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    @livewireScripts()
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\units\productive_units\create.blade.php ENDPATH**/ ?>