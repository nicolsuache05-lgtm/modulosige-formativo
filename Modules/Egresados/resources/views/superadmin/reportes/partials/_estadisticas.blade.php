<!-- ============================================== -->
<!-- 1. ESTADÍSTICAS / MÉTRICAS SUPERIORES (5 CARDS · PALETA SENA ERP) -->
<!-- ============================================== -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3.5 sm:gap-4">
    
    <!-- Metric 1: Generados -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Generados</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-file-invoice"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#00131E]">{{ $totalGenerados ?? 245 }}</div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                <span class="w-1.5 h-1.5 rounded-full bg-[#39A900] mr-1 animate-pulse"></span>
                Este mes
            </span>
        </div>
    </div>

    <!-- Metric 2: Total Egresados -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Total Egresados</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-user-graduate"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#00131E]">{{ $totalEgresados ?? '1.250' }}</div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                En base de datos
            </span>
        </div>
    </div>

    <!-- Metric 3: Empleabilidad (Destacada SENA ERP) -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-emerald-200/80 shadow-xs hover:shadow-md hover:border-[#39A900] transition-all flex flex-col justify-between relative overflow-hidden bg-gradient-to-br from-white via-white to-emerald-50/50">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-[#166534] uppercase tracking-wider">Empleabilidad</span>
            <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-xs shadow-sm">
                <i class="fa-solid fa-briefcase"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#39A900]">{{ $tasaEmpleabilidad ?? '78%' }}</div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#39A900] text-white shadow-2xs">
                Tasa consolidada
            </span>
        </div>
    </div>

    <!-- Metric 4: Encuestas -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Encuestas</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-clipboard-check"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#00131E]">{{ $totalEncuestas ?? 890 }}</div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                Respondidas
            </span>
        </div>
    </div>

    <!-- Metric 5: Visitas / Trazabilidad -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between col-span-2 sm:col-span-1">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Trazabilidad</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-phone-volume"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#00131E]">{{ $totalVisitas ?? '3.420' }}</div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                Seguimientos CEFA
            </span>
        </div>
    </div>

</div>
