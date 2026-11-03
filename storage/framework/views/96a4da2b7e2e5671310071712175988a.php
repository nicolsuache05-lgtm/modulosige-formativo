<?php if(!empty($inventory) && count($inventory) > 0): ?>
<div class="table-responsive">
    <table id="table_inventory" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo e(trans('agrocefa::inventory.Element')); ?></th>
                <th><?php echo e(trans('agrocefa::inventory.Category')); ?></th>
                <th ><?php echo e(trans('agrocefa::inventory.Price')); ?></th>
                <th ><?php echo e(trans('agrocefa::inventory.Amount')); ?></th>
                <th><?php echo e(trans('agrocefa::inventory.Destination')); ?></th>
                <th>Stock M</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $shownWarehouses = [];
            ?>

            <?php $__currentLoopData = $inventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $measurement_unit = $item->element->measurement_unit->conversion_factor;
                    $currentWarehouse = $item->productive_unit_warehouse->warehouse->name;
                ?>
                <tr>
                    <td ><?php echo e($loop->iteration); ?></td>
                    <td ><?php echo e($item->element->name); ?></td>
                    <td ><?php echo e($item->element->category->name); ?></td>
                    <td class="text-center"><?php echo e(priceFormat($item->price)); ?></td>
                    <td class="text-center"><?php echo e($item->amount / $measurement_unit); ?></td>
                    <td ><?php echo e($item->destination); ?></td>
                    <td class="text-center"><?php echo e($item->stock); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php else: ?>
<br>
<?php if(isset($no_found)): ?>
<p><?php echo e($no_found); ?></p>
<?php endif; ?>  
<?php endif; ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\inventory\table.blade.php ENDPATH**/ ?>