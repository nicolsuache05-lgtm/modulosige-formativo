<?php $__env->startSection('stylesheet'); ?>
    @livewireStyles()
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-8">
                    <div class="card-header">
                        <h4>Registro de finca</h4>
                    </div>
                    <form action="<?php echo e(route('sica.admin.location.farms.store')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="card-body pb-1">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <?php echo Form::text('name', null, [
                                    'class'=>'form-control',
                                    'required'
                                ]); ?>

                            </div>
                            <div class="form-group">
                                <label>Descripción:</label>
                                <?php echo Form::textarea('description', null, [
                                    'class'=>'form-control',
                                    'rows'=>'3',
                                    'required'
                                ]); ?>

                            </div>
                            <div class="form-group">
                                <label>Área (m<sup>2</sup>):</label>
                                <?php echo Form::number('area', null, [
                                    'class'=>'form-control',
                                    'required'
                                ]); ?>

                            </div>

                            
                            @livewire('sica::admin.location.farms.consult-responsible', ['farm'=>null])

                        </div>
                        <div class="card-footer py-2 text-right">
                            <a href="<?php echo e(route('sica.admin.location.farms.index')); ?>" class="btn btn-secondary btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
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

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\location\farms\create.blade.php ENDPATH**/ ?>