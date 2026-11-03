<?php if(isset($area)): ?>
    <?php echo Form::hidden('id', $area->id); ?>

<?php endif; ?>

<?php echo Form::label('name', trans('sica::menu.Name'), ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('name', isset($area) ? $area->name : null, ['class' => 'form-control', 'required']); ?>

</div>

<?php echo Form::label('description', trans('sica::menu.Description'), ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::textarea('description', isset($area) ? $area->description : null, ['class' => 'form-control', 'required']); ?>

</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\units\areas\form.blade.php ENDPATH**/ ?>