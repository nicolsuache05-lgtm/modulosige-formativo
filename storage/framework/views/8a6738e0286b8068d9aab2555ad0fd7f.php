<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>



<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Persona</h3>
                    </div>
                    <div class="card-body">
                        <div class="form_search" id="form_search">
                            <?php echo Form::open([
                                'url' => route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.people.basic_data.search'),
                                'method' => 'get',
                                'class' => 'submit',
                            ]); ?>

                            <div class="row">
                                <div class="col-md-3">
                                    <?php echo Form::select('event_id', $events, null, ['class' => 'form-control', 'required']); ?>

                                </div>
                                <div class="col-md-6">
                                    <?php echo Form::number('document', null, ['class' => 'form-control', 'placeholder' => 'Documento', 'required']); ?>

                                </div>
                                <div class="col-md-3">
                                    <?php echo Form::submit('Buscar', ['class' => 'btn btn-primary submit']); ?>

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

<?php $__env->startSection('script'); ?>
    <script>
        <?php if($messages = Session::get('message_result')): ?>
            Swal.fire({
                position: 'center', //'top-start','top-end','top-center', 'center-start','center','center-end','bottom','bottom-start','bottom-start'
                icon: 'success',
                title: '<?php echo e($messages); ?>',
                showConfirmButton: false,
                timer: 2400
            });
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\people\attendance\index.blade.php ENDPATH**/ ?>