<?php if(isset($contractor)): ?>
    <?php echo Form::hidden('id', $contractor->id); ?>

<?php endif; ?>
<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Detalles del Contratista</b>
        </h5>
    </div>
        <div class="modal-body px-4 pt-0">
            <h4>Contrato - <?php echo e($contractor->person->fullname); ?></h4>
                <ul class="mt-3">
                    <li>
                        <p><b>Numero de contrato: </b> <?php echo e($contractor->contract_number); ?></p>
                    </li>
                    <li>
                        <p><b>Supervisor: </b> <?php echo e($contractor->person->fullname); ?></p>
                    </li>
                    <li>
                        <p><b>Fecha de inicio: </b> <?php echo e($contractor->contract_start_date); ?></p>
                    </li>
                    <li>
                        <p><b>Fecha de finalización: </b> <?php echo e($contractor->contract_end_date); ?></p>
                    </li>
                    <li>
                        <p><b>Tipo de Contrato:</b> <?php echo e($contractor->contractor_type->name); ?></p>
                    </li>
                    <li>
                        <p><b>Horas:</b> <?php echo e($contractor->amount_hours); ?></p>
                    </li>
                    <li>
                        <p><b>Codigo SIIF:</b> <?php echo e($contractor->SIIF_code); ?></p>
                    </li>
                    <li>
                        <p><b>Tipo de Empleado:</b> <?php echo e($contractor->employee_type->name); ?></p>
                    </li>
                    <li>
                        <p><b>Entidad aseguradora:</b> <?php echo e($contractor->insurer_entity->name); ?></p>
                    </li>
                    <li>
                        <p><b>Valor:</b> <?php echo e($contractor->total_contract_value); ?></p>
                    </li>
                    <li>
                        <p><b>Tipo de riesgo:</b> <?php echo e($contractor->risk_type); ?></p>
                    </li>
                    <li>
                        <p><b>Numero de poliza:</b> <?php echo e($contractor->policy_number); ?></p>
                    </li>
                    <li>
                        <p><b>Fecha Emisión de Póliza:</b> <?php echo e($contractor->policy_issue_date); ?></p>
                    </li>
                    <li>
                        <p><b>Fecha Aprobación de Póliza:</b> <?php echo e($contractor->policy_approval_date); ?></p>
                    </li>
                    <li>
                        <p><b>Fecha Vigencia de Póliza:</b> <?php echo e($contractor->policy_effective_date); ?></p>
                    </li>
                    <li>
                        <p><b>Fecha Vencimiento de Póliza:</b> <?php echo e($contractor->policy_expiration_date); ?></p>
                    </li>
                    <li>
                        <p><b>Objeto:</b> <?php echo e($contractor->contract_object); ?></p>
                    </li>
                    <li>
                        <p><b>Obligaciones:</b> <?php echo e($contractor->contract_obligations); ?></p>
                    </li>
                    <li>
                        <p><b>Estado:</b> <?php echo e($contractor->state); ?></p>
                    </li>
                </ul>
        </div>
</div>

<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\SICA\Resources\views\admin\people\contractors\show.blade.php ENDPATH**/ ?>