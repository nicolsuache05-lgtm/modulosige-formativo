<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Ambientes de formación</h3>
                    </div>
                    <br>
                    <label for="productive_unit">Unidad Productiva</label>
                    <div class="input-select">
                        <select class="form-select" name="productive_unit" id="productive_unit">
                            <option value="">Seleccione la unidad productiva</option>
                            <?php $__currentLoopData = $productive_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productive_unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($productive_unit->id); ?>">
                                    <?php echo e($productive_unit->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="card-body">
                        <div class="mtop16">
                            <div id="filteredResults">
                                <?php echo $__env->make('sica::admin.location.environments.table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(function() {
            $("#table_environments").DataTable({});
        });
    </script>
    <script>
        // Cuando cambia la selección de categoría
        $('#productive_unit').change(function() {
            var productive_unit = $(this).val();

            // Realizar una solicitud AJAX para obtener los resultados filtrados
            $.ajax({
                type: 'POST',
                url: "<?php echo e(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.location.environments.filter')); ?>",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    productive_unit: productive_unit
                },
                success: function(data) {
                    // Actualizar el contenedor con los resultados filtrados
                    $('#filteredResults').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\location\environments\index.blade.php ENDPATH**/ ?>