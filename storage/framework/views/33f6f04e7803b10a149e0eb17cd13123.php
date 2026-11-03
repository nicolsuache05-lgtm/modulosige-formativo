<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>

<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b><?php echo e(trans('sica::menu.Update Quarter')); ?></b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="<?php echo e(route('sica.admin.inventory.warehouse.update', $warehouse)); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="card-body pb-1">
            <div class="form-group">
                <label>Nombre:</label>
                <?php echo Form::text('name', $warehouse->name, ['class'=>'form-control', 'required']); ?>

            </div>
            <div class="form-group">
                <label>Descripción:</label>
                <?php echo Form::textarea('description', $warehouse->description, ['class'=>'form-control', 'rows'=>'3', 'required']); ?>

            </div>
            <div class="form-group">
                <label>Aplicación:</label>
                <select name="app_id" class="form-control" required>
                    <option value="">-- Seleccione --</option>
                    <?php $__currentLoopData = $apps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($app->id); ?>" <?php echo e($warehouse->app_id == $app->id ? 'selected' : ''); ?>><?php echo e($app->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="card-footer py-2 text-right">
            <a href="<?php echo e(route('sica.admin.inventory.warehouse.index')); ?>" class="btn btn-secondary btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
        </div>
    </form>
</div>

<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>

<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\warehouses\edit.blade.php ENDPATH**/ ?>