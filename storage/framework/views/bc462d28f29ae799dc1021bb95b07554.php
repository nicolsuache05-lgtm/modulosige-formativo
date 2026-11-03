<?php if(isset($event)): ?>
    <?php echo Form::hidden('id', $event->id); ?>

<?php endif; ?>
<?php echo Form::label('name', 'Nombre:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::text('name', isset($event) ? $event->name : null, ['class' => 'form-control', 'required']); ?>

</div>

<?php echo Form::label('description', 'Descripción:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    <?php echo Form::textarea('description', isset($event) ? $event->description : null, ['class' => 'form-control', 'rows' => 2, 'required']); ?>

</div>

<?php echo Form::label('start_date', 'Fecha de inicio:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="fa-solid fa-clock"></i>
        </span>
    </div>
    <?php echo Form::datetimeLocal('start_date', isset($event) ? $event->start_date : null, ['class' => 'form-control', 'required']); ?>

</div>

<?php echo Form::label('end_date', 'Fecha de cierre:', ['class' => 'mt-3']); ?>

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="fa-solid fa-clock"></i>
        </span>
    </div>
    <?php echo Form::datetimeLocal('end_date', isset($event) ? $event->end_date : null, ['class' => 'form-control', 'required']); ?>

</div>

<div class="form-group row mt-3">
    <?php echo Form::label('state', 'Estado :', ['class' => 'col-sm-auto col-form-label']); ?>

    <div class="col-sm-auto">
        <?php echo Form::select('state', getEnumValues('events', 'state'), isset($event) ? $event->state : null, ['class'=>'form-control', 'required']); ?>

    </div>
</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\people\config\events\form.blade.php ENDPATH**/ ?>