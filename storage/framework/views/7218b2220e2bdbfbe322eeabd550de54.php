<?php if(isset($element)): ?>
    <?php echo Form::hidden('id', $element->id); ?>

<?php endif; ?>
<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Detalles del Elemento</b>
        </h5>
    </div>
        <div class="modal-body px-4 pt-0">
            <h3><?php echo e($element->name); ?></h3>
                <ul class="mt-3">
                    <li>
                        <p><b>Unidad de Medida: </b><?php echo e($element->measurement_unit->name); ?></p>
                    </li>
                    <li>
                        <p><b>Descripción: </b><?php echo e($element->description); ?></p>
                    </li>
                    <li>
                        <p><b>Tipo de compra:</b><?php echo e($element->kind_of_purchase->name); ?></p>
                    </li>
                    <li>
                        <p><b>Categoria:</b><?php echo e($element->category->name); ?></p>
                    </li>
                    <li>
                        <p><b>Codigo:</b><?php echo e($element->UNSPSC_code); ?></p>
                    </li>
                </ul>
        </div>
</div>

<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\elements\show.blade.php ENDPATH**/ ?>