
<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>

<div id="content-config" style="width: 700px; height: 400px">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b><?php echo e(trans('sica::menu.Add Element')); ?></b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php echo Form::open(['route'=>'sica.admin.inventory.elements.store', 'method'=>'POST', 'id'=>'form-config']); ?>

            <div class="card-body">
                <?php echo $__env->make('sica::admin.inventory.elements.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="card-footer bg-white ">
                <?php echo Form::submit( trans('sica::menu.Register'),['class'=>'btn btn-primary btn-md py-0 float-right']); ?>

                <a href="<?php echo e(route('sica.admin.inventory.elements')); ?>" class="btn btn-sm btn-light btn-md py-0 float-right">
                    <b><?php echo e(trans('sica::menu.Cancel')); ?></b>
                </a>
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

<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\elements\create.blade.php ENDPATH**/ ?>