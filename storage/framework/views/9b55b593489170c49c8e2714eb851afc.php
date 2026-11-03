<?php if(isset($measurementUnit)): ?>
    <?php echo Form::hidden('id', $measurementUnit->id); ?>

<?php endif; ?>
<?php echo Form::label('name', 'Nombre:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('name', isset($measurementUnit) ? $measurementUnit->name : null, ['class' => 'form-control', 'required']); ?>

</div>

<?php echo Form::label('abbreviation', 'Abreviación:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('abbreviation', isset($measurementUnit) ? $measurementUnit->abbreviation : null, ['class' => 'form-control', 'required']); ?>

</div>

<?php echo Form::label('minimum_unit_measure', 'Medida unitaria minima:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('minimum_unit_measure', isset($measurementUnit) ? $measurementUnit->minimum_unit_measure : null, ['class' => 'form-control', 'required']); ?>

</div>

<?php echo Form::label('conversion_factor', 'Factor de converción:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('conversion_factor', isset($measurementUnit) ? $measurementUnit->conversion_factor : null, ['class' => 'form-control', 'required']); ?>

</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\inventory\parameters\measurementUnit\form.blade.php ENDPATH**/ ?>