<?php $__env->startSection('stylesheet'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                
                <div class="col-md-6" id="card-categories">
                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Categorías</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="tableCategory" class="display table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Tipo de propiedad</th>
                                            <th>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.category.create')); ?>')">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($c->name); ?></td>
                                                <td><?php echo e($c->kind_of_property); ?></td>
                                                <td>
                                                    <div class="opts">
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.category.update')); ?>/<?php echo e($c->id); ?>')">
                                                            <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.category.destroy')); ?>/<?php echo e($c->id); ?>')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
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
                    </div>
                </div>
                

                
                <div class="col-md-6" id="card-kind_of_purchases">
                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tipos de Compra</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="tableKindOfPurchase" class="display table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.kindOfPurchase.create')); ?>')">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $kindOfPurchase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($k->name); ?></td>
                                                <td><?php echo e($k->description); ?></td>
                                                <td>
                                                    <div class="opts">
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.kindOfPurchase.update')); ?>/<?php echo e($k->id); ?>')">
                                                            <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.kindOfPurchase.destroy')); ?>/<?php echo e($k->id); ?>')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
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
                    </div>
                </div>
                

                
                <div class="col-md-6"  id="card-measurement_units">
                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Unidades de Medida</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="tableMeasurementUnit" class="display table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Abreviación</th>
                                            <th>Medida mínima</th>
                                            <th>Factor de converción</th>
                                            <th>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.measurementUnit.create')); ?>')">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $measurementUnit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($m->name); ?></td>
                                                <td><?php echo e($m->abbreviation); ?></td>
                                                <td><?php echo e($m->minimum_unit_measure); ?></td>
                                                <td><?php echo e($m->conversion_factor); ?></td>
                                                <td>
                                                    <div class="opts">
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.measurementUnit.edit', $m->id)); ?>')">
                                                            <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.measurementUnit.delete', $m->id)); ?>')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
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
                    </div>
                </div>
                

                
                <div class="col-md-6"  id="card-movement_type">
                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tipos de movimiento</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="tableMovementType" class="display table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nombre</th>
                                            <th class="text-center">Consecutivo</th>
                                            <th>
                                                <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.movement_type.create')); ?>')">
                                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </b>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>    
                                    <tbody>
                                        <?php $__currentLoopData = $movement_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($mt->name); ?></td>
                                                <td class="text-center"><?php echo e($mt->consecutive); ?></td>
                                                <td>
                                                    <div class="opts">
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.movement_type.edit', $mt->id)); ?>')">
                                                            <b class="text-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                                <i class="fas fa-edit"></i>
                                                            </b>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.admin.inventory.parameters.movement_type.delete', $mt->id)); ?>')">
                                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
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
                    </div>
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
                <span class="sr-only">Loading...</span>
            </div><br>
            <b id="loader-message"></b>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        <?php if(Session::get('message_parameter')): ?>
            $('html, body').animate({
                /* Move the page to the previously selected configuration */
                scrollTop: $("#<?php echo e(Session::get('card')); ?>").offset().top
            }, 1000);
            /* Show the message */
            <?php if(Session::get('icon') == 'success'): ?>
                toastr.success("<?php echo e(Session::get('message_parameter')); ?>");
            <?php elseif(Session::get('icon') == 'error'): ?>
                toastr.error("<?php echo e(Session::get('message_parameter')); ?>");
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
    $(document).ready(function () { /* Initialización of Datatables ---Category */
        $('#tableCategory').DataTable({
            // opciones de configuración para la tabla 1
        });

        $('#tableMeasurementUnit').DataTable({
            // opciones de configuración para la tabla 2
        });

        $('#tableKindOfPurchase').DataTable({
            // opciones de configuración para la tabla 3
        });

        $('#tableMovementType').DataTable({
            // opciones de configuración para la tabla 4
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\parameters\index.blade.php ENDPATH**/ ?>