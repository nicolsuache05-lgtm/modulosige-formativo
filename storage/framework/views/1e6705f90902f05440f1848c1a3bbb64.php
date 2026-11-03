<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <h3>Registro histórico total</h3>
            <div class="mtop16">
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info"><?php echo e(number_format($people, 0, ',', '.')); ?></span>
                    <i class="fas fa-users"></i> Personas
                </a>
                <a class="btn btn-app  btn-app-2">
                    <span class="badge bg-info"><?php echo e(number_format($apprentices, 0, ',', '.')); ?></span>
                    <i class="fas fa-user-graduate"></i> Aprendices
                </a>
                <a class="btn btn-app  btn-app-2">
                    <span class="badge bg-info"><?php echo e(number_format($event, 0, ',', '.')); ?></span>
                    <i class="fa-regular fa-calendar-check"></i> Eventos
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">0</span>
                    <i class="fas fa-user-tie"></i> Administrativos
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info"></span>
                    <i class="fas fa-graduation-cap"></i> Cursos
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">0</span>
                    <i class="fas fa-map-marked-alt"></i> Ambientes
                </a>
            </div>

            <h3>Asistencia a eventos</h3>
            <div class="mtop16">
                <div class="row">
                    <?php $__currentLoopData = $eas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12">
                            <div class="card card-orange card-outline shadow">
                                <div class="card-header h5">
                                    Centro de Formación Agroindustrial - Evento: <strong><?php echo e($a->name); ?></strong> (<?php echo e($a->start_date); ?> - <?php echo e($a->end_date); ?>)
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php $__currentLoopData = $a->attendance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $at): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-2">
                                                <div class="info-box mb-3 bg-info">
                                                    <span class="info-box-icon">
                                                      <i class="fa-solid fa-calendar-days"></i>
                                                    </span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text"><?php echo e($at->date); ?></span>
                                                        <span class="info-box-number">
                                                            <?php echo e($at->total); ?>

                                                            <i class="fa-regular fa-user"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-2">
                                            <div class="info-box mb-3 bg-success">
                                                <span class="info-box-icon">
                                                    <i class="fa-regular fa-calendar-check"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Evento</span>
                                                    <span class="info-box-number">
                                                        <?php echo e($a->total); ?>

                                                        <i class="fa-regular fa-user"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 p-0 m-0">
                                            <figure class="highcharts-figure">
                                                <div id="rage<?php echo e($loop->iteration); ?>"></div>
                                            </figure>
                                        </div>
                                        <div class="col-md-6 p-0 m-0">
                                            <figure class="highcharts-figure">
                                                <div id="pop<?php echo e($loop->iteration); ?>"></div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <span class="small ">
                                            Estadísticas de participación
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        <?php $__currentLoopData = $eas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            Highcharts.chart('rage<?php echo e($loop->iteration); ?>', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: 'Asistentes por tipo de documento'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> de {series.total}'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Cantidad',
                    data: [
                        <?php $__currentLoopData = $a->rage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            ['<?php echo e($r->document_type); ?>', <?php echo e($r->val); ?>],
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ]
                }]
            });
            Highcharts.chart('pop<?php echo e($loop->iteration); ?>', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: 'Asistentes por grupo poblacional'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Cantidad',
                    data: [
                        <?php $__currentLoopData = $a->pop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            ['<?php echo e($p->name); ?>', <?php echo e($p->val); ?>],
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ]
                }]
            });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\attendance_dashboard.blade.php ENDPATH**/ ?>