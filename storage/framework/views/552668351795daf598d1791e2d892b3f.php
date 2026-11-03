<?php if(isset($knowledgenetworks)): ?>
    <?php echo Form::hidden('id', $knowledgenetworks->id); ?>

<?php endif; ?>
<?php echo Form::label('name', trans('sica::menu.Name'), ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('name', isset($knowledgenetworks) ? $knowledgenetworks->name : null, ['class' => 'form-control', 'required']); ?>

</div>
<?php echo Form::label('network_id', trans('sica::menu.Network'), ['class' => 'mt-3']); ?>

<div class="form-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-list"></i>
        </span>
        <?php echo Form::select('network_id', $networks, isset($knowledgenetworks) ? $knowledgenetworks->line_id : null, ['class' => 'form-control', 'required']); ?>

    </div>
</div><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\academy\knowledge_networks\form.blade.php ENDPATH**/ ?>