<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>



<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(trans('sica::menu.Courses')); ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="btns">
                            <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.courses.create')): ?>
                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.'.$role_name.'.academy.courses.create')); ?>')" class="btn btn-success">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <?php echo e(trans('sica::menu.Add Course')); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="mtop16">
                            <table id="tableCourses" class="display table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th><?php echo e(trans('sica::menu.Fiche')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Name')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Leading Instructor')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Start Date')); ?></th>
                                        <th><?php echo e(trans('sica::menu.End Of School Year')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Start Productive')); ?></th>
                                        <th><?php echo e(trans('sica::menu.End Date')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Status')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Modality')); ?></th>
                                        <th class="text-center"><?php echo e(trans('sica::menu.Actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($c->code); ?></td>
                                            <td><?php echo e($c->program->name); ?></td>
                                            <td><?php echo e($c->person->full_name); ?></td>
                                            <td><?php echo e($c->start_date); ?></td>
                                            <td><?php echo e($c->school_end_date); ?></td>
                                            <td><?php echo e($c->start_production_date); ?></td>
                                            <td><?php echo e($c->end_date); ?></td>
                                            <td><?php echo e($c->status); ?></td>
                                            <td><?php echo e($c->deschooling); ?></td>
                                            <td class="text-center">
                                                <div class="opts">
                                                    <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.courses.edit')): ?>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.'.$role_name.'.academy.courses.edit', $c->id)); ?>')">
                                                            <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar titulada">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if(Auth::user()->havePermission('sica.'.$role_name.'.academy.courses.delete')): ?>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.'.$role_name.'.academy.courses.delete', $c->id)); ?>')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar titulada">
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
        <?php if(Session::get('message_course')): ?>
            /* Show the message */
            <?php if(Session::get('icon') == 'success'): ?>
                toastr.success("<?php echo e(Session::get('message_course')); ?>");
            <?php elseif(Session::get('icon') == 'error'): ?>
                toastr.error("<?php echo e(Session::get('message_course')); ?>");
            <?php endif; ?>
        <?php endif; ?>

        function ajaxAction(route) {
            /* Ajax to show content modal to add line */
            $('#loader-message').text('Cargando contenido...'); /* Add content to loader */
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
            $('#tableCourses').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: 7
                }]
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\academy\courses\index.blade.php ENDPATH**/ ?>