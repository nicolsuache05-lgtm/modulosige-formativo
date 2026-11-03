<?php if(isset($kindOfPurchase)): ?>
    <?php echo Form::hidden('id', $kindOfPurchase->id); ?>

<?php endif; ?>
<?php echo Form::label('name', 'Nombre:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('name', isset($kindOfPurchase) ? $kindOfPurchase->name : null, ['class' => 'form-control', 'required']); ?>

</div>

<?php echo Form::label('description', 'Descripción:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('description', isset($kindOfPurchase) ? $kindOfPurchase->description : null, ['class' => 'form-control', 'required']); ?>

</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\parameters\kindOfPurchase\form.blade.php ENDPATH**/ ?>