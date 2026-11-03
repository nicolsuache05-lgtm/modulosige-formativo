<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>



<?php $__env->startSection('stylesheet'); ?>
    <style type="text/css">
        .select2-selection--single {
            height: 38px !important;
        }
        .select2-selection__arrow {
            top: 8px !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-10">
                    <div class="card-header">
                        <h3 class="card-title">Consultar aprendices</h3>
                    </div>
                    <div class="card-body">
                        <div class="form_search" id="form_search">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <?php echo Form::select('course_id', $courses, null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'id' => 'course_id',
                                            'height' => '38px',
                                        ]); ?>

                                    </div>
                                </div>
                                
                                <div class="col-md-2">
                                    <?php if(Auth::user()->havePermission('sica.'.$role_name.'.people.apprentices.load.create')): ?>
                                        <a class="btn btn-outline-secondary" href="<?php echo e(route('sica.'.$role_name.'.people.apprentices.load.create')); ?>">Cargar Archivo</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="divApprentices">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(function() {
            $('#course_id').select2();
        })

        $(document).on("change", "#course_id", function() {
            var miObjeto = new Object();
            miObjeto.course_id = $('#course_id').val();
            var myString = JSON.stringify(miObjeto);
            ajaxReplace('divApprentices', '/sica/<?php echo e($role_name); ?>/people/apprentices/search', myString);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\people\apprentices\index.blade.php ENDPATH**/ ?>