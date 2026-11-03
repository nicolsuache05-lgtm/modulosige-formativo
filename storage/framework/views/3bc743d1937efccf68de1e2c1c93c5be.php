<?php if(isset($population)): ?>
    <?php echo Form::hidden('id', $population->id); ?>

<?php endif; ?>
<?php echo Form::label('name', 'Nombre:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('name', isset($population) ? $population->name : null, ['class' => 'form-control', 'required', 'onkeyup'=>"mayus(this)"]); ?>

</div>
<?php echo Form::label('description', 'Descripción:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::textarea('description', isset($population) ? $population->description : null, ['class' => 'form-control', 'rows' => 2]); ?>

</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\people\config\population\form.blade.php ENDPATH**/ ?>