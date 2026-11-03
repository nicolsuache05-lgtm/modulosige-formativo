<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Actualizar Tipo de Movimiento</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php echo Form::open(['route'=>'sica.admin.inventory.parameters.movement_type.update', 'method'=>'POST', 'id'=>'form-config']); ?>

        <div class="modal-body px-4 pt-0">
            <?php echo $__env->make('sica::admin.inventory.parameters.movement_type.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary btn-md py-0" data-dismiss="modal">Cancelar</button>
                <?php echo Form::submit('Actualizar', ['class'=>'btn btn-success btn-md py-0']); ?>

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
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\parameters\movement_type\edit.blade.php ENDPATH**/ ?>