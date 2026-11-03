<?php $__env->startSection('stylesheet'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(trans('sica::menu.Elements')); ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="btns">
                            <a href="" class="btn btn-info float-right ml-1"> <?php echo e(trans('sica::menu.Categories')); ?></a>
                            <a href="" class="btn btn-info float-right ml-1"> <?php echo e(trans('sica::menu.Lines')); ?></a>

                        </div>
                        <div class="mtop16">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo e(trans('sica::menu.Name')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Unit')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Description')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Line')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Category')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Actions')); ?>

                                            <a class="mx-3" data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.elements.create')); ?>')">
                                                <b class="text-success" data-toggle="tooltip" data-placement="top" title="Registrar Elementos">
                                                    <i class="fas fa-plus-circle"></i>
                                                </b>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($e->name); ?></td>
                                            <td><?php echo e($e->measurement_unit->name); ?></td>
                                            <td><?php echo e($e->description); ?></td>
                                            <td><?php echo e($e->kind_of_purchase->name); ?></td>
                                            <td><?php echo e($e->category->name); ?></td>
                                            <td>
                                                <div class="opts">
                                                  <a id="actions" data-path="admin/role" data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.elements.show', $e)); ?>')">
                                                    <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Ver">
                                                        <i class="fas fa-eye text-warning"></i>
                                                    </b>
                                                  </a>                                                    
                                                  <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.elements.edit', $e)); ?>')">
                                                    <b class="text-info" data-toggle="tooltip" data-placement="top" title="Actualizar Elementos">
                                                        <i class="fas fa-edit"></i>
                                                    </b>
                                                </a>
                                                  <a id="actions" data-path="admin/role" data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.elements.delete', $e->id)); ?>')">
                                                    <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Elementos">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </b>
                                                  </a>
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
            <div class="modal-content" style="width: 850px; height: 680px" id="modal-content"></div>
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
       <?php if(Session::get('message_config')): ?>
            $('html, body').animate({
                /* Move the page to the previously selected configuration */
                scrollTop: $("#<?php echo e(Session::get('card')); ?>").offset().top
            }, 1000);
            /* Show the message */
            <?php if(Session::get('icon') == 'success'): ?>
                toastr.success("<?php echo e(Session::get('message_config')); ?>");
            <?php elseif(Session::get('icon') == 'error'): ?>
                toastr.error("<?php echo e(Session::get('message_config')); ?>");
            <?php endif; ?>
        <?php endif; ?>
        function ajaxAction(route) {
            /* Ajax to show content modal to add event */
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
        $(function() {
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\elements\home.blade.php ENDPATH**/ ?>