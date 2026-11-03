<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <!-- /.col-md-6 -->
                <div class="col-lg-8 ">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0"><?php echo e($title); ?></h5>
                        </div>
                        <div class="card-body row">
                            <div class="col-5 text-center d-flex align-items-center justify-content-center">
                                <div class="">
                                    <h2><strong><?php echo e(env('APP_NAME')); ?></strong></h2>
                                    <p class="lead mb-5">
                                        Km 38 via al sur de Neiva, Centro de Formación Agroindustrial<br>
                                        Campoalegre - Huila
                                    </p>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="inputName"><?php echo e(trans('sica::forms.Name')); ?></label>
                                    <input type="text" id="inputName" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail"><?php echo e(trans('sica::forms.E-Mail')); ?></label>
                                    <input type="email" id="inputEmail" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="inputSubject"><?php echo e(trans('sica::forms.Subject')); ?></label>
                                    <input type="text" id="inputSubject" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage"><?php echo e(trans('sica::forms.Message')); ?></label>
                                    <textarea id="inputMessage" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="<?php echo e(trans('sica::forms.Send message')); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\form_contact.blade.php ENDPATH**/ ?>