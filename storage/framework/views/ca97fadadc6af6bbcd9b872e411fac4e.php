<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>



<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(trans('sica::menu.Holidays')); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <?php if(isset($holiday)): ?>
                                    <form action="<?php echo e(route('sica.'.$role_name.'.academy.holidays.update', $holiday)); ?>" method="post">
                                <?php else: ?>
                                    <form action="<?php echo e(route('sica.'.$role_name.'.academy.holidays.store')); ?>" method="post">
                                <?php endif; ?>
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label><?php echo e(trans('sica::menu.Date')); ?>:</label>
                                        <?php echo Form::date('date', old('date') ? old('date') : (isset($holiday) ? $holiday->date : ''), ['class'=>'form-control', 'required']); ?>

                                    </div>
                                    <div class="form-group">
                                        <label><?php echo e(trans('sica::menu.Issue')); ?>:</label>
                                        <?php echo Form::text('issue', old('issue') ? old('issue') : (isset($holiday) ? $holiday->issue : ''), ['class'=>'form-control', 'required']); ?>

                                    </div>
                                    <div class="text-center">
                                        <?php if(isset($holiday)): ?>
                                            <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.holidays.index')): ?>
                                                <a href="<?php echo e(route('sica.'.$role_name.'.academy.holidays.index')); ?>" class="btn btn-secondary">Cancelar</a>
                                            <?php endif; ?>
                                            <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.holidays.update')): ?>
                                                <button type="submit" class="btn btn-success"><?php echo e(trans('sica::menu.Update')); ?></button>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <button type="reset" class="btn btn-secondary"><?php echo e(trans('sica::menu.Cancel')); ?></button>
                                            <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.holidays.store')): ?>
                                                <button type="submit" class="btn btn-success"><?php echo e(trans('sica::menu.Register')); ?></button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center"><?php echo e(trans('sica::menu.Date')); ?></th>
                                                <th><?php echo e(trans('sica::menu.Issue')); ?></th>
                                                <th class="text-center"><?php echo e(trans('sica::menu.Actions')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td class="text-center"><?php echo e($h->date); ?></td>
                                                    <td><?php echo e($h->issue); ?></td>
                                                    <td class="text-center">
                                                        <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.holidays.edit')): ?>
                                                            <a href="<?php echo e(route('sica.'.$role_name.'.academy.holidays.edit', $h)); ?>" class="mr-1" data-toggle='tooltip' data-placement="top" title="Actualizar día festivo">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.holidays.destroy')): ?>
                                                            <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.academic_coordinator.academy.holidays.delete', $h->id)); ?>')">
                                                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar dia festivo">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </b>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- General modal -->
<div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content" id="modal-content"></div>
</div>
</div>
<div id="loader" style="display: none;"> 
<div class="modal-body text-center" id="modal-loader">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div><br>
    <b id="loader-message"></b>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        });
    </script>
    <script>
        <?php if(Session::get('message_holiday')): ?>
            /* Show the message */
            <?php if(Session::get('icon') == 'success'): ?>
                toastr.success("<?php echo e(Session::get('message_holiday')); ?>");
            <?php elseif(Session::get('icon') == 'error'): ?>
                toastr.error("<?php echo e(Session::get('message_holiday')); ?>");
            <?php endif; ?>
        <?php endif; ?>
      
        function ajaxAction(route) {
            /* Ajax to show content modal to add line */
            $('#loader-message').text("<?php echo e(trans('sica::menu.Loading Content')); ?>"); /* Add content to loader */
            $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKE': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    method: "get",
                    url: route,
                    data: {}
                })
                .done(function(html) {
                    $("#modal-content").html(html);
                });
        }
      
        // Vaciar el contenido del modal cuando sea cerrado
        $("#generalModal").on("hidden.bs.modal", function() {
            $("#modal-content").empty();
        });
      </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\academy\holidays\index.blade.php ENDPATH**/ ?>