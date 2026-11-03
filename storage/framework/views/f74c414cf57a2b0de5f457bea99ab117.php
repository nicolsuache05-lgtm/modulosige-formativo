<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>



<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-6">
                    <div class="card-header">
                        <h3 class="card-title">Consultar persona</h3>
                    </div>
                    <div class="card-body">
                        <div class="form_search" id="form_search">
                            <?php echo Form::open(['url' => route('sica.'.$role_name.'.people.personal_data.search'), 'method' => 'POST']); ?>

                                <div class="row">
                                    <div class="col-md">
                                        <?php echo Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Número de identificación']); ?>

                                    </div>
                                    <div class="col-md-auto">
                                        <?php if(Auth::user()->havePermission('sica.'.$role_name.'.people.personal_data.search')): ?>
                                            <?php echo Form::submit('Buscar', ['class' => 'btn btn-primary']); ?>

                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="col-md-auto">
                                        <?php if(Auth::user()->havePermission('sica.'.$role_name.'.people.personal_data.load.create')): ?>
                                            <a class="btn btn-outline-secondary" href="<?php echo e(route('sica.'.$role_name.'.people.personal_data.load.create')); ?>">Cargar Archivo</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\people\personal_data\index.blade.php ENDPATH**/ ?>