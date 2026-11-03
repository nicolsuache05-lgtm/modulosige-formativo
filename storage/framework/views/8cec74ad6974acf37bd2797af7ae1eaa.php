<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>



<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Agregar Datos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body box-profile">
                        <form action="<?php echo e(route('sica.'.$role_name.'.people.basic_data.store')); ?>" method="post" id="submit">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="event_id" value="<?php echo e($event); ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Nombres</label>
                                        <?php echo Form::text('first_name', null, [
                                            'class' => 'form-control',
                                            'required'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Primer Apellido </label>
                                        <?php echo Form::text('first_last_name', null, [
                                            'class' => 'form-control',
                                            'required'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Segundo Apellido</label>
                                        <?php echo Form::text('second_last_name', null, [
                                            'class' => 'form-control',
                                            'required'
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Tipo Documento</label>
                                        <?php echo Form::select('document_type', getEnumValues('people', 'document_type'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Número Documento </label>
                                        <?php echo Form::number('document_number', $doc, [
                                            'class' => 'form-control',
                                            'required',
                                            'readonly'
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Eps</label>
                                        <select class="form-control" name="eps_id" id="" required>
                                            <?php $__currentLoopData = $eps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($e->id); ?>" <?php echo e(old('eps_id') == $e->id ? 'selected' : ''); ?>><?php echo e($e->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Grupo poblacional</label>
                                        <select class="form-control" name="population_group_id" required>
                                            <?php $__currentLoopData = $population_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groups): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($groups->id); ?>" <?php echo e(old('population_group_id') == $groups->id ? 'selected' : ''); ?>><?php echo e($groups->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Entidad de pensiones</label>
                                        <select class="form-control" name="pension_entity_id" required>
                                            <?php $__currentLoopData = $pension_entities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($pension->id); ?>" <?php echo e(old('pension_entity_id') == $pension->id ? 'selected' : ''); ?>><?php echo e($pension->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <?php if(Auth::user()->havePermission('sica.'.$role_name.'.people.basic_data.store')): ?>
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\people\attendance\create.blade.php ENDPATH**/ ?>