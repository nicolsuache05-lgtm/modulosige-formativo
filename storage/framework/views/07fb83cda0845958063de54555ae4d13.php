<div>
    <div class="form-group">
        <label>Persona responsable:</label>
        <div class="row">
            <div class="col-4">
                <?php echo Form::number('responsible_document_number', null, [
                    'class'=>'form-control',
                    'placeholder'=>'# Identificación',
                    'wire:model.defer' => 'responsible_document_number',
                    'wire:loading.attr' => 'disabled',
                    'wire:target' => 'consultResponsible'
                ]); ?>

                <?php echo Form::hidden('responsible_id', null, [
                    'wire:model' => 'responsible_id'
                ]); ?>

            </div>
            <div class="col-auto p-0">
                <button type="button" class="btn btn-sm btn-success h-100" wire:click="consultResponsible" wire:loading.attr="disabled" wire:target="consultResponsible" data-toggle='tooltip' data-placement="top" title="Consultar persona">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <div class="col ml-2">
                <?php echo Form::text('responsible_full_name', null, [
                    'class'=>'form-control',
                    'placeholder'=>'Nombre completo del líder',
                    'readonly',
                    'wire:model' => 'responsible_full_name'
                ]); ?>

            </div>
        </div>
    </div>
    <div class="form-group">
        <label>País:</label>
        <select class="form-control" name="country_id" wire:model="country_id" required>
            <option value="">-- Seleccione</option>
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="form-group">
        <label>Departamento:</label>
        <select class="form-control" name="department_id" wire:model="department_id" <?php if(empty($departments)): ?> disabled <?php endif; ?> required>
            <option value="">-- Seleccione</option>
            <?php if(!empty($departments)): ?>
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Municipio:</label>
        <select class="form-control" name="municipality_id" wire:model="municipality_id" <?php if(empty($municipalities)): ?> disabled <?php endif; ?> required>
            <option value="">-- Seleccione</option>
            <?php if(!empty($municipalities)): ?>
                <?php $__currentLoopData = $municipalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $municipality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($municipality->id); ?>"><?php echo e($municipality->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    </div>
</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\livewire\admin\location\farms\consult-responsible.blade.php ENDPATH**/ ?>