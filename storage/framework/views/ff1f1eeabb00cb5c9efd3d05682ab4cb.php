<div>
    <div class="modal-header">
        <h5 class="modal-title">Registro de asociación de unidad productiva y rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form wire:submit.prevent="storePuRole" id="form-registration-pu_role">
        <div class="modal-body pb-1">
            <?php if($message_pu_role): ?>
                <div class="alert alert-<?php echo e($color_message_pu_role); ?> message_pu_role">
                    <?php echo e($message_pu_role); ?>

                </div>
            <?php endif; ?>
            <div class="form-group">
                <label>Aplicación:</label>
                <select name="app_id" class="form-control" wire:model="app_id" required>
                    <option value="">-- Seleccione --</option>
                    <?php $__currentLoopData = $apps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($app->id); ?>"><?php echo e($app->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['app_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label>Rol:</label>
                <select name="role_id" class="form-control" wire:model="role_id" <?php if(empty($roles)): ?> disabled <?php endif; ?> required>
                    <option value="">-- Seleccione --</option>
                    <?php if(!empty($roles)): ?>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
                <?php $__errorArgs = ['role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label>Finca:</label>
                <select name="farm_id" class="form-control" wire:model="farm_id" required>
                    <option value="">-- Seleccione --</option>
                    <?php $__currentLoopData = $farms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($farm->id); ?>"><?php echo e($farm->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['farm_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label>Unidad productiva:</label>
                <select name="productive_unit_id" class="form-control" wire:model="productive_unit_id" <?php if(empty($productive_units)): ?> disabled <?php endif; ?> required>
                    <option value="">-- Seleccione --</option>
                    <?php if(!empty($productive_units)): ?>
                        <?php $__currentLoopData = $productive_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($pu->id); ?>"><?php echo e($pu->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
                <?php $__errorArgs = ['productive_unit_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="modal-footer py-1">
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="storePuRole">Registrar</button>
        </div>
    </form>
</div>

<?php $__env->startSection('sripts-register-pu_role'); ?>
    <script>
        window.livewire.on('close_alert_message_pu_role', function () {
            var alertElement = document.querySelector('.message_pu_role');
            if (alertElement) {
                alertElement.style.display = 'block';
                setTimeout(function () {
                    alertElement.style.display = 'none';
                }, 5000); // Ocultar después de 5 segundos
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\livewire\admin\security\pu-roles\registration-form.blade.php ENDPATH**/ ?>