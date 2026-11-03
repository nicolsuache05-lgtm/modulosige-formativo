<?php $__env->startSection('title', 'Dashboard Ejecutivo - Dirección'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4">

    <!-- Welcome Hero Alert -->
    <div class="col-12">
        <div class="card border-0 rounded-4 shadow-sm overflow-hidden text-white" style="background: linear-gradient(135deg, var(--sena-dark) 0%, var(--sena-light-navy) 60%, var(--sena-green) 100%);">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-15 border border-white border-opacity-25 mb-3">
                            <i class="fas fa-shield-alt text-warning"></i>
                            <span class="fs-7 fw-semibold">Panel de Control Estratégico</span>
                        </div>
                        <?php if(auth()->guard()->check()): ?>
                            <h2 class="fw-bold text-white mb-2 fs-3">
                                ¡Bienvenido(a), <?php echo e(Auth::user()->full_name); ?>!
                            </h2>
                            <p class="text-white-50 fs-6 mb-3">
                                Estás conectado con el rol <strong class="text-white"><?php echo e(Auth::user()->primary_role); ?></strong>. Desde aquí puedes supervisar la formulación de directrices corporativas y alineación de las unidades de SENA Empresa.
                            </p>
                        <?php else: ?>
                            <h2 class="fw-bold text-white mb-2 fs-3">
                                Tablero de Control y Gestión Estratégica
                            </h2>
                            <p class="text-white-50 fs-6 mb-3">
                                Supervisión general de directrices corporativas y alineación de las unidades de SENA Empresa.
                            </p>
                        <?php endif; ?>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="<?php echo e(route('direccion.politicas.create')); ?>" class="btn btn-sena">
                                <i class="fas fa-plus-circle me-1"></i> Formular Nueva Política
                            </a>
                            <a href="<?php echo e(route('direccion.politicas.index')); ?>" class="btn btn-outline-light rounded-pill px-3 fw-semibold">
                                <i class="fas fa-list-check me-1"></i> Ver Catálogo Completo
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                        <?php if(auth()->guard()->check()): ?>
                            <div class="avatar-circle mx-auto mx-lg-end shadow-lg" style="width: 80px; height: 80px; font-size: 28px;">
                                <?php echo e(Auth::user()->initials); ?>

                            </div>
                            <div class="mt-2 text-white fw-bold"><?php echo e(Auth::user()->email); ?></div>
                            <span class="badge bg-success bg-opacity-50 border border-light text-white px-3 py-1 rounded-pill mt-1">
                                <?php echo e(Auth::user()->primary_role); ?>

                            </span>
                        <?php else: ?>
                            <div class="avatar-circle mx-auto mx-lg-end shadow-lg" style="width: 80px; height: 80px; font-size: 28px;">
                                SE
                            </div>
                            <div class="mt-2 text-white fw-bold">Modo Consulta</div>
                            <a href="<?php echo e(route('login', ['redirect' => route('direccion.dashboard')])); ?>" class="btn btn-sm btn-sena mt-2">
                                Iniciar Sesión
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Cards KPI -->
    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4 text-center border-start border-4 border-primary">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fs-7 text-uppercase fw-semibold">Total Políticas</span>
                    <h3 class="fw-bold text-dark mb-0 fs-2 mt-1"><?php echo e($totalPoliticas); ?></h3>
                </div>
                <div class="rounded-circle p-3 bg-primary bg-opacity-10 text-primary fs-3">
                    <i class="fas fa-file-signature"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                <i class="fas fa-database me-1 text-primary"></i> Decisiones corporativas registradas
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4 text-center border-start border-4 border-success">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fs-7 text-uppercase fw-semibold">Políticas Activas</span>
                    <h3 class="fw-bold text-success mb-0 fs-2 mt-1"><?php echo e($activas); ?></h3>
                </div>
                <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success fs-3">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                <i class="fas fa-bolt me-1 text-success"></i> En plena vigencia operativa
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4 text-center border-start border-4 border-warning">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fs-7 text-uppercase fw-semibold">En Revisión</span>
                    <h3 class="fw-bold text-warning mb-0 fs-2 mt-1"><?php echo e($enRevision); ?></h3>
                </div>
                <div class="rounded-circle p-3 bg-warning bg-opacity-10 text-warning fs-3">
                    <i class="fas fa-clock-rotate-left"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                <i class="fas fa-sync-alt me-1 text-warning"></i> Pendientes de aprobación final
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4 text-center border-start border-4 border-secondary">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fs-7 text-uppercase fw-semibold">Inactivas / Históricas</span>
                    <h3 class="fw-bold text-secondary mb-0 fs-2 mt-1"><?php echo e($inactivas); ?></h3>
                </div>
                <div class="rounded-circle p-3 bg-secondary bg-opacity-10 text-secondary fs-3">
                    <i class="fas fa-archive"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top text-start fs-8 text-muted">
                <i class="fas fa-history me-1 text-secondary"></i> Directrices archivadas
            </div>
        </div>
    </div>

    <!-- Breakdown By Type -->
    <div class="col-lg-5">
        <div class="card-custom p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="fw-bold text-dark mb-0 fs-5">
                    <i class="fas fa-chart-pie text-success me-2"></i> Distribución por Tipología
                </h5>
                <span class="badge bg-light text-muted border fs-8">Total: <?php echo e($totalPoliticas); ?></span>
            </div>

            <?php $__currentLoopData = $porTipo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo => $cantidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $porcentaje = $totalPoliticas > 0 ? round(($cantidad / $totalPoliticas) * 100) : 0;
                    $color = match($tipo) {
                        'Estratégica' => 'success',
                        'Calidad' => 'primary',
                        'Seguridad' => 'danger',
                        'Operativa' => 'warning',
                        default => 'secondary'
                    };
                ?>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-semibold fs-7 text-dark">
                            <i class="fas fa-folder-open text-<?php echo e($color); ?> me-1"></i> <?php echo e($tipo); ?>

                        </span>
                        <span class="fs-7 text-muted fw-bold"><?php echo e($cantidad); ?> (<?php echo e($porcentaje); ?>%)</span>
                    </div>
                    <div class="progress rounded-pill" style="height: 8px;">
                        <div class="progress-bar bg-<?php echo e($color); ?>" role="progressbar" style="width: <?php echo e($porcentaje); ?>%;" aria-valuenow="<?php echo e($porcentaje); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="alert alert-light border rounded-3 p-3 mt-4 mb-0">
                <div class="d-flex gap-2 align-items-start">
                    <i class="fas fa-info-circle text-success fs-5 mt-1"></i>
                    <div class="fs-8 text-muted">
                        Las políticas de <strong>Calidad</strong> y <strong>Estratégicas</strong> impactan directamente los turnos y la certificación de aprendices en las plantas agroindustriales.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Policies List -->
    <div class="col-lg-7">
        <div class="card-custom p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold text-dark mb-0 fs-5">
                    <i class="fas fa-clock text-primary me-2"></i> Últimas Políticas Registradas
                </h5>
                <a href="<?php echo e(route('direccion.politicas.index')); ?>" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-semibold fs-8">
                    Ver todas <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 fs-7">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $ultimasPoliticas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><code><?php echo e($pol->codigo); ?></code></td>
                                <td class="fw-semibold text-dark"><?php echo e(Str::limit($pol->titulo, 32)); ?></td>
                                <td>
                                    <span class="badge bg-light text-dark border fs-8"><?php echo e($pol->tipo); ?></span>
                                </td>
                                <td>
                                    <span class="badge <?php echo e($pol->estado == 'Activa' ? 'bg-success' : ($pol->estado == 'En Revisión' ? 'bg-warning text-dark' : 'bg-secondary')); ?> rounded-pill px-2 py-1 fs-8">
                                        <?php echo e($pol->estado); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('direccion.politicas.edit', $pol->id)); ?>" class="btn btn-sm btn-outline-primary rounded-circle p-1" style="width: 28px; height: 28px;" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    No hay políticas registradas recientemente.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('direccion::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\Direccion\resources\views\dashboard.blade.php ENDPATH**/ ?>