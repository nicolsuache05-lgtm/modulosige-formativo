<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>



<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(trans('sica::menu.Formation Programs')); ?></h3>
                        <div class="btns">
                            <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.lines.index')): ?>
                                <a href="<?php echo e(route('sica.'.$role_name.'.academy.lines.index')); ?>"class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-right fa-beat-fade"></i>
                                    <?php echo e(trans('sica::menu.Technological lines')); ?>

                                </a>
                            <?php endif; ?>
                            <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.networks.index')): ?>
                                <a href="<?php echo e(route('sica.'.$role_name.'.academy.networks.index')); ?>" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-right fa-beat-fade"></i>
                                    <?php echo e(trans('sica::menu.Networks')); ?>

                                </a>
                            <?php endif; ?>
                            <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.lines.index')): ?>
                                <a href="<?php echo e(route('sica.'.$role_name.'.academy.knowledge.networks.index')); ?>"class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-right fa-beat-fade"></i>
                                    <?php echo e(trans('sica::menu.Knowledge Networks')); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="">
                            <table id="tablePrograms" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo e(trans('sica::menu.Code')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Type')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Name')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Quarter')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Knowledge Network')); ?></th>
                                        <th class="text-center"><?php echo e(trans('sica::menu.Actions')); ?>

                                            <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.programs.create')): ?>
                                                <a class="mx-3" data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.'.$role_name.'.academy.programs.create')); ?>')">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Registrar programa de formación">
                                                        <i class="fas fa-plus-circle text-success"></i>
                                                    </b>
                                                </a>
                                            <?php endif; ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($p->sofia_code); ?></td>
                                            <td><?php echo e($p->program_type); ?></td>
                                            <td><?php echo e($p->name); ?></td>
                                            <td><?php echo e($p->quarter_number); ?></td>
                                            <td><?php echo e($p->knowledge_network->name); ?></td>
                                            <td class="text-center">
                                                <div class="opts">
                                                    <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.programs.edit')): ?>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.'.$role_name.'.academy.programs.edit', $p->id)); ?>')">
                                                            <b class="text-info" data-toggle="tooltip" data-placement="top" title="Actualizar programa de formación">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.programs.delete')): ?>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.'.$role_name.'.academy.programs.delete', $p->id)); ?>')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar programa de formación">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </b>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- General modal -->
    <div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content" id="modal-content"></div>
        </div>
    </div>
    <div id="loader" style="display: none;"> 
        <div class="modal-body text-center" id="modal-loader">
            <div class="spinner-border" role="status">
                <span class="sr-only"><?php echo e(trans('sica::menu.Loading Content')); ?></span>
            </div><br>
            <b id="loader-message"></b>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        <?php if(Session::get('message_program')): ?>
            /* Show the message */
            <?php if(Session::get('icon') == 'success'): ?>
                toastr.success("<?php echo e(Session::get('message_program')); ?>");
            <?php elseif(Session::get('icon') == 'error'): ?>
                toastr.error("<?php echo e(Session::get('message_program')); ?>");
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
    <script>
        $(document).ready(function() {
            /* Initialización of Datatables Lines */
            $('#tablePrograms').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: 5
                }]
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\academy\programs\index.blade.php ENDPATH**/ ?>