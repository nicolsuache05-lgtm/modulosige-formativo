<?php $__env->startSection('stylesheet'); ?>
<?php $__env->stopSection(); ?>

    <div id="content-config" style="width: 600px; height: 400px">
        <div class="modal-header py-2">
            <h5 class="modal-title" id="exampleModalLabel">
                <b><?php echo e(trans('sica::menu.Update Quarter')); ?></b>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="card-body pb-1">
                <?php echo $__env->make('sica::admin.inventory.elements.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="card-footer py-2 text-right">
                <?php echo Form::submit( trans('sica::menu.Register'), ['class'=>'btn btn-primary btn-md py-0 float-right']); ?>

                <a href="<?php echo e(route('sica.admin.inventory.elements')); ?>" class="btn btn-sm btn-light btn-md py-0 float-right">
                    <b>Cancelar</b>
                </a>
           </div>
    </div>


<?php $__env->startSection('script'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function (e) {
            $('#image').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
<?php $__env->stopSection(); ?>   
<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\elements\edit.blade.php ENDPATH**/ ?>