<div>
    <div class="row mb-0">
        <div class="col-md">
            <div class="form-group row my-0">
                <label class="col-sm-auto col-form-label">Aplicación:</label>
                <div class="col-sm-auto">
                    <select name="app_id" class="form-control" wire:model="app_id" required>
                        <option value="">-- Seleccione --</option>
                        <?php $__currentLoopData = $apps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($app->id); ?>"><i class="fas fa-car"></i><?php echo e($app->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm"></div>
            </div>
        </div>
        <div class="col-md-auto">
            <!-- Botón para lanzar el modal de registro de asociación de rol y unidad productiva -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pu_role-registration-modal">
                <i class="fas fa-plus"></i> Registrar asociación de rol y unidad productiva
            </button>
        </div>
    </div>
    <div class="text-center">
        <div wire:loading>
            <div class="spinner-border text-success text-center" role="status">
            </div><br>
            <strong>Cargando...</strong>
        </div>
    </div>
    <div wire:loading.remove>
        <?php if(empty($app_id)): ?>
            <div class="text-center text-danger m-3">
                <strong>Selecciona una aplicación para consultar asociación de roles y unidades productivas.</strong>
            </div>
        <?php else: ?>
            <div class="text-center">
                <h1 style="color: <?php echo e($app_selected->color); ?>"><i class="fas <?php echo e($app_selected->icon); ?> mr-2"></i><?php echo e($app_selected->name); ?></h1>
            </div>
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Rol</th>
                        <th class="text-center">Unidad productiva</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($app_selected->roles) == 0): ?>
                        <tr>
                            <td colspan="3" class="text-center text-danger">
                                <strong>No se encontraron roles registradas para la aplicación.</strong>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php
                            $previous_role_id = null;
                            $records_found = false;
                        ?>
                        <?php $__currentLoopData = $app_selected->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!$r->productive_units->count() == 0): ?>
                                <?php
                                    $records_found = true;
                                ?>
                                <?php $__currentLoopData = $r->productive_units->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($previous_role_id !== $r->id): ?>
                                        <?php
                                            $previous_role_id = $r->id;
                                        ?>
                                        <tr>
                                            <th class="text-center" style="vertical-align: middle" rowspan="<?php echo e($r->productive_units->count()); ?>">
                                                <?php echo e($r->name); ?>

                                            </th>
                                    <?php endif; ?>
                                            <td class="text-center"><?php echo e($pu->name); ?></td>
                                            <td class="text-center">
                                                <a href="#" onclick="confirmDelete(<?php echo e($r->id); ?>, <?php echo e($pu->id); ?>, '<?php echo e($r->name); ?>', '<?php echo e($pu->name); ?>')" data-toggle='tooltip' data-placement="top" title="Eliminar asociación">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <?php if(!$records_found): ?>
                            <tr>
                                <td colspan="3" class="text-center text-danger">
                                    <strong>No se encontró ninguna asociación de unidad productiva y rol registrada.</strong>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\livewire\admin\security\pu-roles\show-list.blade.php ENDPATH**/ ?>