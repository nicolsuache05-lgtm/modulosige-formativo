<nav style="height: 60px" class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item mr-1">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- Mostrar elementos en el navbar en pantallas grandes -->
        <li class="nav-item d-lg-inline-block">
            <a href="<?php echo e(route('cefa.sica.home.index')); ?>" class="nav-link"><?php echo e(trans('sica::menu.Home')); ?></a>
        </li>
        <?php if(auth()->guard()->check()): ?>
        <?php if(checkRol('superadmin')): ?>
        <?php if(auth()->guard()->guest()): ?>
        <?php else: ?>
            <?php if(checkRol('sica.admin')): ?>
                <li class="nav-item d-none d-lg-inline-block mr-1 <?php echo e(!Route::is('*.admin.*') ?: 'active'); ?>">
                    <a href="<?php echo e(route('sica.admin.dashboard')); ?>" class="nav-link">
                        <?php echo e(trans('sica::menu.Administrator')); ?>

                    </a>
                </li>
            <?php endif; ?>
            <?php if(checkRol('sica.attendance')): ?>
                <li class="nav-item d-none d-lg-inline-block mr-1 <?php echo e(!Route::is('*.attendance.*') ?: 'active'); ?>">
                    <a href="<?php echo e(route('sica.attendance.dashboard')); ?>" class="nav-link">
                        <?php echo e(trans('sica::menu.Attendance')); ?>

                    </a>
                </li>
            <?php endif; ?>
            <?php if(checkRol('sica.academic_coordinator')): ?>
                <li class="nav-item d-none d-lg-inline-block mr-1 <?php echo e(!Route::is('*.academic_coordinator.*') ?: 'active'); ?>">
                    <a href="<?php echo e(route('sica.academic_coordinator.dashboard')); ?>" class="nav-link">
                        <?php echo e(trans('sica::menu.academic_coordinator')); ?>

                    </a>
                </li>
            <?php endif; ?>
            <?php if(checkRol('sica.unitmanager')): ?>
            <li class="nav-item d-none d-lg-inline-block mr-1 <?php echo e(!Route::is('*.unitmanager.*') ?: 'active'); ?>">
                <a href="<?php echo e(route('sica.unitmanager.dashboard')); ?>" class="nav-link">
                    <?php echo e(trans('sica::menu.Unitmanager')); ?>

                </a>
            </li>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if(auth()->guard()->guest()): ?>
        <?php else: ?>
        <!-- Mostrar lista desplegable en pantallas pequeñas -->
        <li class="nav-item dropdown d-lg-none">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Roles
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                
                    <?php if(checkRol('sica.admin')): ?>
                        <a class="dropdown-item" href="<?php echo e(route('sica.admin.dashboard')); ?>"><?php echo e(trans('sica::menu.Administrator')); ?></a>
                    <?php endif; ?>
                    <?php if(checkRol('sica.attendance')): ?>
                        <a class="dropdown-item" href="<?php echo e(route('sica.attendance.dashboard')); ?>"><?php echo e(trans('sica::menu.Attendance')); ?></a>
                    <?php endif; ?>
                    <?php if(checkRol('sica.academic_coordinator')): ?>
                        <a class="dropdown-item" href="<?php echo e(route('sica.academic_coordinator.dashboard')); ?>"><?php echo e(trans('sica::menu.academic_coordinator')); ?></a>
                    <?php endif; ?>
                    <?php if(checkRol('sica.unitmanager')): ?>
                        <a class="dropdown-item" href="<?php echo e(route('sica.unitmanager.dashboard')); ?>"><?php echo e(trans('sica::menu.Unitmanager')); ?></a>
                    <?php endif; ?>
               
            </div>
        </li>
        <?php endif; ?>
        <?php else: ?>
        <?php if(auth()->guard()->guest()): ?>
        <?php else: ?>
            <?php if(checkRol('sica.admin')): ?>
                <li class="nav-item d-none d-lg-inline-block mr-1 <?php echo e(!Route::is('*.admin.*') ?: 'active'); ?>">
                    <a href="<?php echo e(route('sica.admin.dashboard')); ?>" class="nav-link">
                        <?php echo e(trans('sica::menu.Administrator')); ?>

                    </a>
                </li>
            <?php endif; ?>
            <?php if(checkRol('sica.attendance')): ?>
                <li class="nav-item d-none d-lg-inline-block mr-1 <?php echo e(!Route::is('*.attendance.*') ?: 'active'); ?>">
                    <a href="<?php echo e(route('sica.attendance.dashboard')); ?>" class="nav-link">
                        <?php echo e(trans('sica::menu.Attendance')); ?>

                    </a>
                </li>
            <?php endif; ?>
            <?php if(checkRol('sica.academic_coordinator')): ?>
                <li class="nav-item d-none d-lg-inline-block mr-1 <?php echo e(!Route::is('*.academic_coordinator.*') ?: 'active'); ?>">
                    <a href="<?php echo e(route('sica.academic_coordinator.dashboard')); ?>" class="nav-link">
                        <?php echo e(trans('sica::menu.academic_coordinator')); ?>

                    </a>
                </li>
            <?php endif; ?>
            <?php if(checkRol('sica.unitmanager')): ?>
            <li class="nav-item d-none d-lg-inline-block mr-1 <?php echo e(!Route::is('*.unitmanager.*') ?: 'active'); ?>">
                <a href="<?php echo e(route('sica.unitmanager.dashboard')); ?>" class="nav-link">
                    <?php echo e(trans('sica::menu.Unitmanager')); ?>

                </a>
            </li>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if(auth()->guard()->guest()): ?>  
        <?php else: ?>
        <!-- Mostrar lista desplegable en pantallas pequeñas -->
        <li class="nav-item d-lg-none">
            <?php if(checkRol('sica.admin')): ?>
            <a class="nav-link" href="<?php echo e(route('sica.admin.dashboard')); ?>"><?php echo e(trans('sica::menu.Administrator')); ?></a>
            <?php endif; ?>
            <?php if(checkRol('sica.attendance')): ?>
            <a class="nav-link" href="<?php echo e(route('sica.attendance.dashboard')); ?>"><?php echo e(trans('sica::menu.Attendance')); ?></a>
            <?php endif; ?>
            <?php if(checkRol('sica.academic_coordinator')): ?>
            <a class="nav-link" style="height: 60px;" href="<?php echo e(route('sica.academic_coordinator.dashboard')); ?>"><?php echo e(trans('sica::menu.academic_coordinator')); ?></a>
            <?php endif; ?>
            <?php if(checkRol('sica.academic_coordinator')): ?>
            <a class="nav-link" style="height: 60px;" href="<?php echo e(route('sica.unitmanager.dashboard')); ?>"><?php echo e(trans('sica::menu.Unitmanager')); ?></a>
            <?php endif; ?>
        </li>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"> 
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 <?php echo e(trans('modulo1::menu.Notifications')); ?></span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 <?php echo e(trans('modulo1::menu.new messages')); ?>

                    <span class="float-right text-muted text-sm">3 <?php echo e(trans('modulo1::menu.mins')); ?></span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 <?php echo e(trans('modulo1::menu.new reports')); ?>

                    <span class="float-right text-muted text-sm">2 <?php echo e(trans('modulo1::menu.days')); ?></span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">
                    <?php echo e(trans('modulo1::menu.See All Notifications')); ?>

                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <!-- languaje Dropdown Menu-->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <?php echo e(session('lang')); ?> <i class="fas fa-globe"></i>
            </a>
            <div class="dropdown-menu p-0">
                <a href="<?php echo e(url('lang', ['es'])); ?>" class="dropdown-item">
                    Español
                </a>
                <a href="<?php echo e(url('lang', ['en'])); ?>" class="dropdown-item">
                    English
                </a>
            </div>
        </li>
    </ul>
</nav>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\layouts\partials\navbar.blade.php ENDPATH**/ ?>