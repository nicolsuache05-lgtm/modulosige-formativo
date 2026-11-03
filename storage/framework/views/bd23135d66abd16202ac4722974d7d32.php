    <div class="content-header">
        <div class="container-fluid">
            <div id="divbreadcrumb" class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">SICA</li>
                        <li class="breadcrumb-item active"><?php echo e($title); ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <?php if(Session::has('message')): ?>
        <div class="container">
            <div class="alert alert-<?php echo e(Session::get('typealert')); ?> py-1" style="display:block; margin-bottom: 16px;">
                <?php echo Session::get('message'); ?>

                <?php if($errors->any()): ?>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\layouts\partials\breadcrumb.blade.php ENDPATH**/ ?>