<!-- ============================================== -->
<!-- 1. ESTADÍSTICAS / MÉTRICAS SUPERIORES (4 CARDS · PALETA SENA ERP) -->
<!-- ============================================== -->
<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
    
    <!-- Metric 1: Generados -->
    <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs sm:text-[13px] font-bold text-gray-500 uppercase tracking-wider">Generados</span>
            <span class="w-10 h-10 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-sm shadow-xs">
                <i class="fa-solid fa-file-invoice"></i>
            </span>
        </div>
        <div class="font-editorial text-3xl sm:text-4xl font-extrabold text-[#00131E] my-1">{{ $totalGenerados ?? 5 }}</div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                <span class="w-1.5 h-1.5 rounded-full bg-[#39A900] mr-1.5 animate-pulse"></span>
                Este mes
            </span>
        </div>
    </div>

    <!-- Metric 2: Total Egresados -->
    <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs sm:text-[13px] font-bold text-gray-500 uppercase tracking-wider">Total Egresados</span>
            <span class="w-10 h-10 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-sm shadow-xs">
                <i class="fa-solid fa-user-graduate"></i>
            </span>
        </div>
        <div class="font-editorial text-3xl sm:text-4xl font-extrabold text-[#00131E] my-1">{{ $totalEgresados ?? 6 }}</div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                En base de datos
            </span>
        </div>
    </div>

    <!-- Metric 3: Programas Cubiertos -->
    <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs sm:text-[13px] font-bold text-gray-500 uppercase tracking-wider">Programas</span>
            <span class="w-10 h-10 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-sm shadow-xs">
                <i class="fa-solid fa-graduation-cap"></i>
            </span>
        </div>
        <div class="font-editorial text-3xl sm:text-4xl font-extrabold text-[#00131E] my-1">{{ $totalProgramas ?? 12 }}</div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                Programas CEFA
            </span>
        </div>
    </div>

    <!-- Metric 4: Formatos de Exportación -->
    <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs sm:text-[13px] font-bold text-gray-500 uppercase tracking-wider">Formatos</span>
            <span class="w-10 h-10 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-sm shadow-xs">
                <i class="fa-solid fa-file-export"></i>
            </span>
        </div>
        <div class="font-editorial text-3xl sm:text-4xl font-extrabold text-[#00131E] my-1">{{ $totalFormatos ?? 2 }}</div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                PDF · Excel
            </span>
        </div>
    </div>

</div>
