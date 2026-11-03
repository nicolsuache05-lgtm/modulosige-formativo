
<!-- jQuery -->
<script src="<?php echo e(asset('AdminLTE/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('AdminLTE/dist/js/adminlte.min.js')); ?>"></script>
<!-- DataTables -->
<script src="<?php echo e(asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/jszip/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/pdfmake/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/pdfmake/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>



<script src="<?php echo e(asset('AdminLTE/plugins/sweetalert2/sweetalert2.js')); ?>"></script>
<script src="<?php echo e(asset('js/generalscripts.js')); ?>"></script>
<script src="<?php echo e(asset('modules/sica/js/scripts.js')); ?>"></script>

<script src="<?php echo e(asset('AdminLTE/plugins/fullcalendar/lib/main.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/fullcalendar/lib/locales-all.js')); ?>"></script>
<!-- Select2 -->
<script src="<?php echo e(asset('AdminLTE/plugins/select2/js/select2.full.min.js')); ?>"></script>


<script src="<?php echo e(asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE/plugins/toastr/toastr.min.js')); ?>"></script>


<!-- Highcharts -->
<script src="<?php echo e(asset('Highcharts/code/highcharts.js')); ?>"></script>
<script src="<?php echo e(asset('Highcharts/code/highcharts-3d.js')); ?>"></script>
<script src="<?php echo e(asset('Highcharts/code/modules/data.js')); ?>"></script>
<script src="<?php echo e(asset('Highcharts/code/modules/exporting.js')); ?>"></script>
<script src="<?php echo e(asset('Highcharts/code/modules/export-data.js')); ?>"></script>
<script src="<?php echo e(asset('Highcharts/code/modules/accessibility.js')); ?>"></script>

<script type="text/javascript">
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})

    // Configuración mostrar un alert sencillo en la esquina superior derecha
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    <?php if(Session::get('message')): ?>
          /* Show the message */
          <?php if(Session::get('icon') == 'success'): ?>
              toastr.success("<?php echo e(Session::get('message')); ?>");
          <?php elseif(Session::get('icon') == 'error'): ?>
              toastr.error("<?php echo e(Session::get('message')); ?>");
          <?php endif; ?>
      <?php endif; ?>
</script>

<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\layouts\partials\scripts.blade.php ENDPATH**/ ?>