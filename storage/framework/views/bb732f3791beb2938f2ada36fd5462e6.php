<?php $__env->startSection('title', 'Editar Política - ' . $politica->codigo); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- Header -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <a href="<?php echo e(route('direccion.index')); ?>" class="text-decoration-none text-muted fs-7 fw-semibold">
                        <i class="fas fa-arrow-left me-1"></i> Volver al listado
                    </a>
                    <h3 class="fw-bold text-dark mb-0 mt-1">Editar Política Directiva: <span class="text-success"><?php echo e($politica->codigo); ?></span></h3>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card card-custom p-4 p-md-5">
                <form action="<?php echo e(route('direccion.update', $politica->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row g-4">
                        <!-- Código y Tipo -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark fs-7">Código Identificador <span class="text-danger">*</span></label>
                            <input type="text" name="codigo" value="<?php echo e(old('codigo', $politica->codigo)); ?>" class="form-control <?php $__errorArgs = ['codigo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <?php $__errorArgs = ['codigo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark fs-7">Tipo de Proceso / Política <span class="text-danger">*</span></label>
                            <select name="tipo" class="form-select <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="Estratégica" <?php echo e(old('tipo', $politica->tipo) == 'Estratégica' ? 'selected' : ''); ?>>🟢 Estratégica (Direccionamiento Global)</option>
                                <option value="Calidad" <?php echo e(old('tipo', $politica->tipo) == 'Calidad' ? 'selected' : ''); ?>>🔵 Calidad (Procesos e Inocuidad)</option>
                                <option value="Seguridad" <?php echo e(old('tipo', $politica->tipo) == 'Seguridad' ? 'selected' : ''); ?>>🔴 Seguridad (SST y Bioseguridad)</option>
                                <option value="Operativa" <?php echo e(old('tipo', $politica->tipo) == 'Operativa' ? 'selected' : ''); ?>>⚪ Operativa (Funcionamiento Diario)</option>
                            </select>
                            <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Título -->
                        <div class="col-12">
                            <label class="form-label fw-bold text-dark fs-7">Título de la Política o Directiva <span class="text-danger">*</span></label>
                            <input type="text" name="titulo" value="<?php echo e(old('titulo', $politica->titulo)); ?>" class="form-control <?php $__errorArgs = ['titulo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <?php $__errorArgs = ['titulo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Descripción -->
                        <div class="col-12">
                            <label class="form-label fw-bold text-dark fs-7">Descripción y Lineamientos <span class="text-danger">*</span></label>
                            <textarea name="descripcion" rows="4" class="form-control <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required><?php echo e(old('descripcion', $politica->descripcion)); ?></textarea>
                            <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Vigencia, Responsable y Estado -->
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark fs-7">Vigencia (Año) <span class="text-danger">*</span></label>
                            <input type="number" name="vigencia" value="<?php echo e(old('vigencia', $politica->vigencia)); ?>" class="form-control <?php $__errorArgs = ['vigencia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" min="2020" max="2050" required>
                            <?php $__errorArgs = ['vigencia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark fs-7">Responsable / Área <span class="text-danger">*</span></label>
                            <input type="text" name="responsable" value="<?php echo e(old('responsable', $politica->responsable)); ?>" class="form-control <?php $__errorArgs = ['responsable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <?php $__errorArgs = ['responsable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark fs-7">Estado <span class="text-danger">*</span></label>
                            <select name="estado" class="form-select <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="Activa" <?php echo e(old('estado', $politica->estado) == 'Activa' ? 'selected' : ''); ?>>Activa</option>
                                <option value="En Revisión" <?php echo e(old('estado', $politica->estado) == 'En Revisión' ? 'selected' : ''); ?>>En Revisión</option>
                                <option value="Inactiva" <?php echo e(old('estado', $politica->estado) == 'Inactiva' ? 'selected' : ''); ?>>Inactiva</option>
                            </select>
                            <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex align-items-center justify-content-end gap-2 mt-5 pt-4 border-top">
                        <a href="<?php echo e(route('direccion.index')); ?>" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-sena px-5 py-2 shadow-sm">
                            <i class="fas fa-sync-alt me-1"></i> Actualizar Política
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('direccion::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\Direccion\resources\views\edit.blade.php ENDPATH**/ ?>