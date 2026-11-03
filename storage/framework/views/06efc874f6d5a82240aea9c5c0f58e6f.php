<?php $__env->startSection('stylesheet'); ?>
    @livewireStyles()
    <style>
        td, th {
            border-color: black !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md">
                                <h4>Responsabilidades</h4>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="<?php echo e(route('sica.admin.security.roles.index')); ?>" class="btn btn-info float-right ml-1">
                                    <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Roles
                                </a>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="<?php echo e(route('sica.admin.security.roles.permision_role.index')); ?>" class="btn btn-info float-right ml-1">
                                  <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Roles y permisos
                                </a>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="<?php echo e(route('sica.admin.security.roles.pu_roles.index')); ?>" class="btn btn-info float-right ml-1">
                                  <i class="fa-solid fa-angles-left fa-beat-fade mr-1"></i> Roles y unidades productivas
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        
                        @livewire('sica::admin.security.responsibilities.show-list')

                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>

    <!-- Modal para registro de responsabilidad -->
    <div class="modal fade" id="responsibility-registration-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                
                @livewire('sica::admin.security.responsibilities.registration-form')

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    @livewireScripts()
    <script>
        $(document).ready(function() {
            // Capturar el evento de cierre del modal de registro de responsabilidad
            $('#responsibility-registration-modal').on('hidden.bs.modal', function (e) {
                // Limpiar valores internos del formulario
                Livewire.emit('resetForm');
            });

            // Capturar evento para cerrar el modal cuando se realize un registro de responsabilidad
            Livewire.on('close-registration-modal', function() {
                $('#responsibility-registration-modal').modal('hide');
            });

            // Mostrar mensaje de registro exitoso
            Livewire.on('message-livewire', function(icon, message) {
                Toast.fire({
                    icon: icon,
                    title: ' '+message
                })
            });
        });

        function confirmDelete(responsibility_id, role, activity) {
            Swal.fire({
                title: '¿Estás seguro de que deseas eliminar la responsabilidad del '+role+' con la actividad '+activity+'?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('confirmDestroyResponsibility', responsibility_id); // Emitir evento para eliminar responsabilidad
                }
            });
        }
    </script>

    <?php $__env->startSection('sripts-register-responsibility'); ?> <?php echo $__env->yieldSection(); ?> <!-- Scripts necesarios para registrar una responsabilidad -->

<?php $__env->stopSection(); ?>


<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\security\responsibilities\index.blade.php ENDPATH**/ ?>