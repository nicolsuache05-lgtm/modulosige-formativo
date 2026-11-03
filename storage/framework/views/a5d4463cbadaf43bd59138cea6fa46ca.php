<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(trans('sica::menu.Warehouses')); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="mtop16">
                            <table id="warehouses_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo e(trans('sica::menu.Name')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Description')); ?></th>
                                        <th><?php echo e(trans('sica::menu.Application')); ?> </th>
                                        <th class="col-2"><?php echo e(trans('sica::menu.Actions')); ?>

                                            <a class="mx-3" data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.warehouse.create')); ?>')">
                                                <b class="text-success" data-toggle="tooltip" data-placement="top" title="Registrar Bodega">
                                                    <i class="fas fa-plus-circle"></i>
                                                </b>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($w->name); ?></td>
                                            <td><?php echo e($w->description); ?></td>
                                            <td><?php echo e($w->app->name); ?></td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.warehouse.edit', $w->id)); ?>')">
                                                    <b class="text-info" data-toggle="tooltip" data-placement="top" title="Actualizar Bodega">
                                                        <i class="fas fa-edit"></i>
                                                    </b>
                                                  </a>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.warehouse.delete', $w->id)); ?>')">
                                                    <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Bodega">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </b>
                                                </a>
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
        $(function () {
            $("#warehouses_table").DataTable({
                "responsive": true
            });
        });
    </script>
    <script>
        <?php if(Session::get('message_warehouse')): ?>
            /* Show the message */
            <?php if(Session::get('icon') == 'success'): ?>
                toastr.success("<?php echo e(Session::get('message_warehouse')); ?>");
            <?php elseif(Session::get('icon') == 'error'): ?>
                toastr.error("<?php echo e(Session::get('message_warehouse')); ?>");
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

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\warehouses\index.blade.php ENDPATH**/ ?>