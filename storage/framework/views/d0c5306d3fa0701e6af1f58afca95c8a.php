<?php if(isset($eps)): ?>
    <?php echo Form::hidden('id', $eps->id); ?>

<?php endif; ?>
<?php echo Form::label('name', 'Nombre:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('name', isset($eps) ? $eps->name : null, ['class' => 'form-control', 'required', 'onkeyup'=>"mayus(this)"]); ?>

</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\people\config\eps\form.blade.php ENDPATH**/ ?>