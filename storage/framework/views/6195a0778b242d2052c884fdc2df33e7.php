
<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b><?php echo e(trans('sica::menu.Add Quarter')); ?></b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="<?php echo e(route('sica.admin.units.activities.store')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="card-body pb-1">
            <div class="form-group">
                <label>Nombre:</label>
                <?php echo Form::text('name', null, ['class'=>'form-control', 'required']); ?>

            </div>
            <div class="form-group">
                <label>Unidad productiva:</label>
                <select name="productive_unit_id" class="form-control" required>
                    <option value="">-- Seleccione --</option>
                    <?php $__currentLoopData = $productive_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($pu->id); ?>" <?php echo e(old('productive_unit_id') == $pu->id ? 'selected' : ''); ?>><?php echo e($pu->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tipo de actividad:</label>
                <select name="activity_type_id" class="form-control" required>
                    <option value="">-- Seleccione --</option>
                    <?php $__currentLoopData = $activity_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $at): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($at->id); ?>" <?php echo e(old('activity_type_id') == $at->id ? 'selected' : ''); ?>><?php echo e($at->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Descripción:</label>
                <?php echo Form::textarea('description', null, ['class'=>'form-control', 'rows'=>'3', 'required']); ?>

            </div>
            <div class="form-group">
                <label>Periodo:</label>
                <?php echo Form::text('period', null, ['class'=>'form-control', 'required']); ?>

            </div>
            <div class="form-group">
                <label>Estado:</label>
                <?php echo Form::select('status', getEnumValues('activities','status'), null, ['class'=>'form-control', 'placeholder'=>'-- Seleccione --', 'required']); ?>

            </div>
        </div>
        <div class="card-footer py-2 text-right">
            <a href="<?php echo e(route('sica.admin.units.activities.index')); ?>" class="btn btn-secondary btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
        </div>
    </form>
</div>

<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\units\activities\create.blade.php ENDPATH**/ ?>