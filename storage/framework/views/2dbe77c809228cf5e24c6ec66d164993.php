<?php $__env->startSection('title', 'Detalle de Auditoría #' . $auditoria->id . ' - Administración'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-10">

        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
            <div>
                <a href="<?php echo e(route('admin.auditoria.index')); ?>" class="btn btn-sm btn-outline-secondary rounded-pill mb-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver a la bitácora
                </a>
                <h2 class="fw-bold text-dark mb-0">Inspección Forense de Evento #<?php echo e($auditoria->id); ?></h2>
                <p class="text-muted fs-6 mb-0">Detalles de la modificación registrada en la base de datos.</p>
            </div>
            <div>
                <?php if($auditoria->event == 'created'): ?>
                    <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25 rounded-pill px-3 py-2 fs-7">
                        <i class="fas fa-plus-circle me-1"></i> Evento de Creación
                    </span>
                <?php elseif($auditoria->event == 'updated'): ?>
                    <span class="badge bg-primary bg-opacity-15 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-2 fs-7">
                        <i class="fas fa-edit me-1"></i> Evento de Modificación
                    </span>
                <?php elseif($auditoria->event == 'deleted'): ?>
                    <span class="badge bg-danger bg-opacity-15 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2 fs-7">
                        <i class="fas fa-trash me-1"></i> Evento de Eliminación
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Meta Information Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card card-custom p-3 h-100">
                    <span class="text-muted fs-8 fw-bold text-uppercase">Usuario Responsable</span>
                    <?php if($auditoria->user): ?>
                        <div class="d-flex align-items-center gap-2 mt-2">
                            <div class="avatar-circle-sm">
                                <?php echo e($auditoria->user->initials); ?>

                            </div>
                            <div>
                                <div class="fw-bold text-dark fs-7"><?php echo e($auditoria->user->nickname); ?></div>
                                <small class="text-muted"><?php echo e($auditoria->user->email); ?></small>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="fw-bold text-muted mt-2">Sistema / No identificado</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom p-3 h-100">
                    <span class="text-muted fs-8 fw-bold text-uppercase">Entidad / Registro</span>
                    <div class="mt-2">
                        <div class="fw-bold text-dark"><?php echo e(class_basename($auditoria->auditable_type)); ?></div>
                        <small class="text-muted">ID Registro: #<?php echo e($auditoria->auditable_id); ?></small>
                        <div class="text-muted fs-8"><?php echo e($auditoria->auditable_type); ?></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom p-3 h-100">
                    <span class="text-muted fs-8 fw-bold text-uppercase">Origen y Fecha</span>
                    <div class="mt-2">
                        <div><i class="fas fa-network-wired text-info me-1"></i> <span class="fw-semibold"><?php echo e($auditoria->ip_address); ?></span></div>
                        <small class="text-muted d-block"><i class="fas fa-calendar-alt me-1"></i> <?php echo e($auditoria->created_at ? $auditoria->created_at->format('d/m/Y H:i:s') : 'N/A'); ?></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- URL and User Agent -->
        <div class="card card-custom p-3 mb-4">
            <div class="row g-2 fs-7">
                <div class="col-md-12">
                    <strong class="text-muted">URL Invocada:</strong>
                    <code class="ms-1"><?php echo e($auditoria->url); ?></code>
                </div>
                <div class="col-md-12">
                    <strong class="text-muted">User Agent (Navegador/Cliente):</strong>
                    <span class="text-muted ms-1 fs-8"><?php echo e($auditoria->user_agent); ?></span>
                </div>
            </div>
        </div>

        <!-- Comparison Cards: Old vs New Values -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card card-custom p-4 h-100 border-start border-4 border-warning">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="fas fa-history text-warning me-2"></i> Valores Anteriores (Old Values)
                    </h5>
                    <?php if(!empty($auditoria->old_values)): ?>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered fs-8 mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Campo</th>
                                        <th>Valor Previo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $auditoria->old_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="fw-bold"><?php echo e($key); ?></td>
                                            <td><code><?php echo e(is_array($val) ? json_encode($val) : $val); ?></code></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-light border rounded-3 text-muted fs-7 mb-0">
                            <i class="fas fa-info-circle me-1"></i> No existen valores previos (es una creación o no se registraron).
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-custom p-4 h-100 border-start border-4 border-success">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="fas fa-check-circle text-success me-2"></i> Valores Nuevos (New Values)
                    </h5>
                    <?php if(!empty($auditoria->new_values)): ?>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered fs-8 mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Campo</th>
                                        <th>Valor Nuevo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $auditoria->new_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="fw-bold text-success"><?php echo e($key); ?></td>
                                            <td><code><?php echo e(is_array($val) ? json_encode($val) : $val); ?></code></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-light border rounded-3 text-muted fs-7 mb-0">
                            <i class="fas fa-info-circle me-1"></i> No se registraron nuevos valores (es una eliminación).
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\Admin\resources\views\auditoria\show.blade.php ENDPATH**/ ?>