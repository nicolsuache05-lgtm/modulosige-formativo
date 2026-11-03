<div>
    <div class="form-group">
        <label>Persona líder:</label>
        <div class="row">
            <div class="col-4">
                <?php echo Form::number('leader_document_number', null, [
                    'class'=>'form-control',
                    'placeholder'=>'# Identificación',
                    'wire:model.defer' => 'leader_document_number',
                    'wire:loading.attr' => 'disabled',
                    'wire:target' => 'consultLeader'
                ]); ?>

                <?php echo Form::hidden('leader_id', null, [
                    'wire:model' => 'leader_id'
                ]); ?>

            </div>
            <div class="col-auto p-0">
                <button type="button" class="btn btn-sm btn-success h-100" wire:click="consultLeader" wire:loading.attr="disabled" wire:target="consultLeader" data-toggle='tooltip' data-placement="top" title="Consultar persona">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <div class="col ml-2">
                <?php echo Form::text('leader_full_name', null, [
                    'class'=>'form-control',
                    'placeholder'=>'Nombre completo del líder',
                    'readonly',
                    'wire:model' => 'leader_full_name'
                ]); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\livewire\admin\units\productive-units\consult-leader.blade.php ENDPATH**/ ?>