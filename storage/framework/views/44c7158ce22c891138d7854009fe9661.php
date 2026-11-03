<?php if(!empty($groupedData) && count($groupedData) > 0): ?>
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(trans('agrocefa::reports.1T_Element')); ?></th>
                    <th><?php echo e(trans('agrocefa::reports.1T_Amount')); ?></th>
                    <th><?php echo e(trans('agrocefa::reports.1T_Price')); ?></th>
                    <th>Fecha Vencimiento</th>
                    <th><?php echo e(trans('agrocefa::reports.1T_Subtotal')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $groupedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laborId => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td colspan="4">
                            <strong><?php echo e(trans('agrocefa::reports.Labor')); ?> <?php echo e($data['laborDescription']); ?></strong><br>
                            <em><?php echo e(trans('agrocefa::reports.Date_Labor')); ?> <?php echo e($data['laborDate']); ?></em>
                        </td>
                        <td><strong><?php echo e($data['laborSubtotal']); ?></strong></td>
                    </tr>
                    <?php $__currentLoopData = $data['elements']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td></td>
                            <td><?php echo e($element['elementName']); ?></td>
                            <td><?php echo e($element['consumableAmount']); ?></td>
                            <td><?php echo e(priceFormat($element['consumablePrice'])); ?></td>
                            <td><?php echo e($element['expiration_date']); ?></td>
                            <td></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td colspan="5"><strong><?php echo e(trans('agrocefa::reports.1T_Total')); ?></strong></td>
                    <td><strong><?php echo e($totalLaborSubtotal); ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
<br>
<?php if(isset($no_found)): ?>
<p><?php echo e($no_found); ?></p>
<?php endif; ?>  
<?php endif; ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\units\production\table.blade.php ENDPATH**/ ?>