<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Asociación de unidades productivas y bodegas</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form action="<?php echo e(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.pu_warehouses.store')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label>Unidad productiva:</label>
                                        <select name="productive_unit_id" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            <?php $__currentLoopData = $productive_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($pu->id); ?>"><?php echo e($pu->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Bodega:</label>
                                        <select name="warehouse_id" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($w->id); ?>"><?php echo e($w->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Sincronizar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Unidad productiva</th>
                                                <th>Bodega</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $previous_pu_id = null;
                                        ?>
                                        <?php $__currentLoopData = $productive_unit_warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $puw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($previous_pu_id !== $puw->productive_unit_id): ?>
                                                <tr>
                                                    <td  style="vertical-align: middle"  rowspan="<?php echo e($productive_unit_warehouses->where('productive_unit_id', $puw->productive_unit_id)->count()); ?>">
                                                        <?php echo e($puw->productive_unit->name ?? 'N/A'); ?>

                                                    </td>
                                                <?php
                                                    $rowspanCount = $productive_unit_warehouses->where('productive_unit_id', $puw->productive_unit_id)->count();
                                                ?>
                                            <?php else: ?>
                                                <tr>
                                            <?php endif; ?>
                                                <td><?php echo e($puw->warehouse->name ?? 'N/A'); ?></td>
                                                <td class="text-center">
                                                    <a data-toggle="modal" data-target="#generalModal" onclick="ajaxAction('<?php echo e(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.pu_warehouses.delete', $puw->id)); ?>')">
                                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar asociación">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </b>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                                $previous_pu_id = $puw->productive_unit_id;
                                            ?>
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
  <?php if(Session::get('message_puw')): ?>
      /* Show the message */
      <?php if(Session::get('icon') == 'success'): ?>
          toastr.success("<?php echo e(Session::get('message_puw')); ?>");
      <?php elseif(Session::get('icon') == 'error'): ?>
          toastr.error("<?php echo e(Session::get('message_puw')); ?>");
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


<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\units\pu_warehouses\index.blade.php ENDPATH**/ ?>