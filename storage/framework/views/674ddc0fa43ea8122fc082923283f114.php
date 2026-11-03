<!DOCTYPE html>
<html lang="en">
<?php echo $__env->make('sica::layouts.partials.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('stylesheet'); ?>
<?php echo $__env->yieldSection(); ?>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
  <!-- Navbar -->
    <?php echo $__env->make('sica::layouts.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
    <?php echo $__env->make('sica::layouts.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php echo $__env->make('sica::layouts.partials.breadcrumb', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- /.content-header -->
    <!-- Main content -->
    <?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldSection(); ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
    <?php echo $__env->make('sica::layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<?php echo $__env->make('sica::layouts.partials.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('script'); ?>
<?php echo $__env->yieldSection(); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\layouts\master.blade.php ENDPATH**/ ?>