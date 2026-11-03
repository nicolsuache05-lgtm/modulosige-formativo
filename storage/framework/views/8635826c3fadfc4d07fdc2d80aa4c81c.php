<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>



<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-6">
                    <div class="card-header">
                        <h3 class="card-title">Cargar aprendices</h3>
                    </div>
                    <div class="card-body">
                        <?php echo Form::open([ 'url' => route('sica.'.$role_name.'.people.apprentices.load.store'), 'files' => 'true', 'enctype' => 'multipart/form-data']); ?>

                            <div class="form_load" id="form_load">
                                <div class="form-group">
                                    <div class="input-group">
                                        <?php echo e(Form::input('file', 'archivo', @$_REQUEST['archivo'], [
                                            'id' => 'archivo',
                                            'class' => 'form-control',
                                            'required',
                                            'aria-describedby' => 'inputGroupFile',
                                            'aria-label' => 'Upload'
                                        ])); ?>

                                        <?php if(Auth::user()->havePermission('sica.'.$role_name.'.people.apprentices.load.store')): ?>
                                            <?php echo Form::submit('Cargar', ['id' => 'inputGroupFile', 'class' => 'btn btn-outline-secondary']); ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
        <div id="divResultado"></div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\people\apprentices\load.blade.php ENDPATH**/ ?>