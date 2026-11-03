<?php if(isset($category)): ?>
    <?php echo Form::hidden('id', $category->id); ?>

<?php endif; ?>
<?php echo Form::label('name', 'Nombre:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('name', isset($category) ? $category->name : null, ['class' => 'form-control', 'required']); ?>

</div>

<?php echo Form::label('kind_of_property', 'Tipo de Propiedad:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::select('kind_of_property', getEnumValues('categories','kind_of_property'), isset($category) ? $category->kind_of_property : 'Bodega',
        ['class' => 'form-control', 'required']); ?>

</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\parameters\category\form.blade.php ENDPATH**/ ?>