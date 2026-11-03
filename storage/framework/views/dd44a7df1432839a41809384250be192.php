<?php if(isset($movement_type)): ?>
    <?php echo Form::hidden('id', $movement_type->id); ?>

<?php endif; ?>
<?php echo Form::label('name', 'Nombre:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('name', isset($movement_type) ? $movement_type->name : null, ['class' => 'form-control', 'required']); ?>

</div>

<?php echo Form::label('consecutive', 'Consecutive:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('consecutive', isset($movement_type) ? $movement_type->consecutive : null, ['class' => 'form-control', 'required']); ?>

</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\parameters\movement_type\form.blade.php ENDPATH**/ ?>