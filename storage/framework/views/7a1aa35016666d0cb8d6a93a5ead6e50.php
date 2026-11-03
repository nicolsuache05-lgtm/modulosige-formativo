<?php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
?>



<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Datos Personales</h3>
                    </div>
                    <div class="card-body box-profile">
                        <?php echo Form::open(['url' => route('sica.'.$role_name.'.people.personal_data.store')]); ?>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="text-left">
                                            <img class="profile-user-img img-fluid img-circle" src="<?php echo e(asset('modules/sica/images/blanco.png')); ?>" alt="User profile picture">
                                            <br />
                                            <?php echo Form::file('avatar', ['class' => 'form-control-file', 'aria-label' => 'fileexample']); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Nombre</label>
                                        <?php echo Form::text('first_name', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese su primer nombre',
                                            'required',
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Primer Apellido</label>
                                        <?php echo Form::text('first_last_name', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese su primer apellido',
                                            'required',
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Segundo Apellido</label>
                                        <?php echo Form::text('second_last_name', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese su segundo apellido',
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Tipo documento</label>
                                        <?php echo Form::select('document_type', getEnumValues('people', 'document_type'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Número de documento</label>
                                        <?php echo Form::number('document_number', $doc, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Documento',
                                            'required'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Fecha de expedición</label>
                                        <?php echo Form::date('date_of_issue', null, ['class' => 'form-control']); ?>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Fecha de nacimiento</label>
                                        <?php echo Form::date('date_of_birth', null, ['class' => 'form-control']); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Tipo de sangre</label>
                                        <?php echo Form::select('blood_type', getEnumValues('people', 'blood_type'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Género</label>
                                        <?php echo Form::select('gender', getEnumValues('people', 'gender'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Eps</label>
                                        <?php echo Form::select('eps_id', $eps, null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Estado civil</label>
                                        <?php echo Form::select('marital_status', getEnumValues('people', 'marital_status'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Tarjeta militar</label>
                                        <?php echo Form::text('military_card', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Número'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Nivel de sisbén</label>
                                        <?php echo Form::select('sisben_level', getEnumValues('people', 'sisben_level'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Estrato social</label>
                                        <?php echo Form::select('socioeconomical_status', getEnumValues('people', 'socioeconomical_status'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <?php echo Form::text('address', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Dirección'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Celular #1</label>
                                        <?php echo Form::number('telephone1', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Número',
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Celular #2</label>
                                        <?php echo Form::number('telephone2', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Número',
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Celular #3</label>
                                        <?php echo Form::number('telephone3', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Número',
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Correo personal</label>
                                        <?php echo Form::email('personal_email', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Correo electrónico'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Correo misena</label>
                                        <?php echo Form::email('misena_email', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Correo electrónico .misena'
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Correo sena</label>
                                        <?php echo Form::email('sena_email', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Correo electrónico .sena'
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Grupo poblacional</label>
                                        <?php echo Form::select('population_group_id', $population_groups, null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required',
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Entidad de pensiones</label>
                                        <?php echo Form::select('pension_entity_id', $pension_entities, null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required'
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <?php if(Auth::user()->havePermission('sica.'.$role_name.'.people.personal_data.store')): ?>
                                    <?php echo Form::submit('Registrar', ['class' => 'btn btn-primary']); ?>

                                <?php endif; ?>
                            </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sica::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\people\personal_data\create.blade.php ENDPATH**/ ?>