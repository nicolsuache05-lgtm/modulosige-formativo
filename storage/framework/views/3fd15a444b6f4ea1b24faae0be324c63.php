<?php if(isset($line)): ?>
    <?php echo Form::hidden('id', $line->id); ?>

<?php endif; ?>
<?php echo Form::label('name', trans('sica::menu.Name'), ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('name', isset($line) ? $line->name : null, ['class' => 'form-control', 'required']); ?>

</div>

<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\academy\lines\form.blade.php ENDPATH**/ ?>