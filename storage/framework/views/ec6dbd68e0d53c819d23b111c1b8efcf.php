<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <h3>Solicitudes</h3>
            <div class="mtop16">
                <p>No hay solucitudes pendientes</p>
            </div>
            <h3>Registros</h3>
            <div class="mtop16">
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info"><?php echo e(number_format($environments, 0, ',', '.')); ?></span>
                    <i class="fas fa-map-marked-alt"></i> Ambientes
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info"><?php echo e(number_format($productive_units, 0, ',', '.')); ?></span>
                    <i class="fas fa-warehouse"></i> U. Productivas
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\unitmanager_dashboard.blade.php ENDPATH**/ ?>