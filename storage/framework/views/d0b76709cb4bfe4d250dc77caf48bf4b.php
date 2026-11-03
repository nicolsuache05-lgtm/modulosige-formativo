<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>
<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b><?php echo e(trans('sica::menu.Do you want to delete the following Warehouse?')); ?></b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php echo Form::open(['route'=>'sica.'.$role_name.'.inventory.warehouse.destroy', 'method'=>'POST', 'id'=>'form-config']); ?>

        <div class="modal-body px-4 pt-3" style="font-size: 20px;">
            <?php echo Form::hidden('id', $warehouse->id); ?>

            <div class="row">
                <div class="col-4 text-right"><b><?php echo e(trans('sica::menu.Name')); ?></b></div>
                <div class="col-8"><?php echo e($warehouse->name); ?></div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b><?php echo e(trans('sica::menu.Application')); ?></b></div>
                <div class="col-8"><?php echo e($warehouse->app->name); ?></div>
            </div>
        <div class="modal-footer py-1">
            <button type="button" class="btn btn-secondary btn-md py-0" data-dismiss="modal"><?php echo e(trans('sica::menu.Cancel')); ?></button>
            <?php if(Auth::user()->havePermission('sica.'.$role_name.'.inventory.warehouse.destroy')): ?>
                <?php echo Form::submit(trans('sica::menu.Delete'), ['class'=>'btn btn-danger btn-md py-0']); ?>

            <?php endif; ?>
        </div>
    <?php echo Form::close(); ?>

</div>

<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\warehouses\delete.blade.php ENDPATH**/ ?>