<!-- ============================================== -->
<!-- 1. ESTADÍSTICAS / MÉTRICAS SUPERIORES (4 CARDS · PALETA SENA ERP) -->
<!-- ============================================== -->
<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
    
    <!-- Metric 1: Total Encuestas -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Total Encuestas</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-clipboard-list"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#00131E]"><?php echo e($totalCreadas ?? 25); ?></div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                <span class="w-1.5 h-1.5 rounded-full bg-[#39A900] mr-1 animate-pulse"></span>
                En sistema
            </span>
        </div>
    </div>

    <!-- Metric 2: Enviadas -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Enviadas</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-paper-plane"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#00131E]"><?php echo e($totalEnviadas ?? 320); ?></div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                Egresados citados
            </span>
        </div>
    </div>

    <!-- Metric 3: Respondidas -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Respondidas</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-circle-check"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#00131E]"><?php echo e($totalRespondidas ?? 242); ?></div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                Verificadas
            </span>
        </div>
    </div>

    <!-- Metric 4: Tasa Respuesta -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Tasa Respuesta</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-chart-line"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#39A900]"><?php echo e($tasaRespuestaGeneral ?? '75%'); ?></div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                Efectividad global
            </span>
        </div>
    </div>

</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\Egresados\resources\views\superadmin\encuestas\partials\_estadisticas.blade.php ENDPATH**/ ?>