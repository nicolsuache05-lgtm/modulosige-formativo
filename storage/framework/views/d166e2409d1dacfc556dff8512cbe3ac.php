<?php if(!empty($environments) && count($environments) > 0): ?>
<div class="table-responsive">
    <table id="table_environments" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Imágen</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Clase</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Finca</th>
                <th class="text-center">Coordenadas</th>
                <th class="text-center">Pagina</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $environments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="text-center"><?php echo e($e->name); ?></td>
                    <td><img src="<?php echo e(asset('modules/cefamaps/images/uploads/' . $e->picture)); ?>" width="100" height="100"></td>
                    <td class="text-center"><?php echo e($e->description); ?></td>
                    <td class="text-center"><?php echo e($e->class_environment->name); ?></td>
                    <td class="text-center"><?php echo e($e->type_environment); ?></td>
                    <td class="text-center"><?php echo e($e->farm->name); ?></td>
                    <td class="col-1">
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#modal-info-<?php echo e($e->id); ?>">Coordenadas
                        </button>
                        <div class="modal fade" id="modal-info-<?php echo e($e->id); ?>">
                            <div class="modal-dialog modal-l">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4><?php echo e($e->name); ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5><?php echo e(trans('cefamaps::environment.1M_Label_Length_Environment')); ?></h5>
                                                <p><?php echo e($e->length); ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><?php echo e(trans('cefamaps::environment.1M_Label_Latitude_Environment')); ?></h5>
                                                <p><?php echo e($e->latitude); ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4 class="modal-title"><?php echo e(trans('cefamaps::environment.1M_Environment_Polygon')); ?> : <em><?php echo e($e->name); ?></em></h4>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5><?php echo e(trans('cefamaps::environment.1M_Label_Length_Environment')); ?></h5>
                                                <?php $__currentLoopData = $e->coordinates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p><?php echo e($c->length); ?></p>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><?php echo e(trans('cefamaps::environment.1M_Label_Latitude_Environment')); ?></h5>
                                                <?php $__currentLoopData = $e->coordinates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p><?php echo e($c->latitude); ?></p>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                            data-target="#modal-pag-<?php echo e($e->id); ?>">Pagina
                        </button>
                        <div class="modal fade" id="modal-pag-<?php echo e($e->id); ?>">
                            <div class="modal-dialog modal-l">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4><?php echo e($e->name); ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if(isset($e->page)): ?>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5>Pagina</h5>
                                                    <?php $__currentLoopData = $e->pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <p><?php echo e($c->name); ?></p>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <div class="col-md-8">
                                                    <h5>Contenido</h5>
                                                    <?php $__currentLoopData = $e->pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <p><?php echo $c->content; ?></p>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <h5>No contiene pagina</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php else: ?>
<?php if(isset($environments)): ?>
No se encontraron ambientes
<?php endif; ?>
    
<?php endif; ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\location\environments\table.blade.php ENDPATH**/ ?>