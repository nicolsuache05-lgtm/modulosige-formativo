<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Paises, departamentos y municipios disponibles</h3>
                    </div>
                    <div class="card-body">
                        <div class="btns">
                            <a href="#" class="btn btn-primary" disabled>
                                <i class="fas fa-plus"></i> Nuevo registro
                            </a>
                        </div>
                        <div class="mtop16">
                            <table id="table_countries_yajra" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Pais</th>
                                        <th class="text-center">Departamento</th>
                                        <th class="text-center">Municipio</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        var table = $('#table_countries_yajra').DataTable({
            "processing": true,
            "serverSide": false,
            "ajax": "<?php echo e(route('sica.admin.location.countries.municipalities.consult')); ?>",
            "columns": [{
                    "data": 'DT_RowIndex',
                    "name": 'DT_RowIndex'
                },
                {
                    "data": 'department.country.name',
                    "name": 'country'
                },
                {
                    "data": 'department.name',
                    "name": 'department'
                },
                {
                    "data": 'name',
                    "name": 'name'
                },
                {
                    "data": 'action',
                    "name": 'action',
                    "orderable": true,
                    "searchable": true,
                    "fixedHeader": true
                }
            ],
            "columnDefs": [
                {
                    "targets": "_all", // Aplicar a todas las columnas
                    "className": "text-center", // Agregar la clase text-center
                }
            ]
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\location\countries\index.blade.php ENDPATH**/ ?>