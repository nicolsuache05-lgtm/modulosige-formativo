<!-- ============================================== -->
<!-- 1. ESTADÍSTICAS / MÉTRICAS SUPERIORES (5 CARDS · PALETA SENA ERP) -->
<!-- ============================================== -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3.5 sm:gap-4">
    
    <!-- Métrica 1: Programados -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Programados</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-calendar-plus"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#00131E]">
            {{ $totalProgramados ?? 3 }}
        </div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                <span class="w-1.5 h-1.5 rounded-full bg-[#39A900] mr-1 animate-pulse"></span>
                Este año
            </span>
        </div>
    </div>

    <!-- Métrica 2: Participantes -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Participantes</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-users"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#00131E]">
            {{ $totalParticipantes ?? 586 }}
        </div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                Registrados
            </span>
        </div>
    </div>

    <!-- Métrica 3: Realizados -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Realizados</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-circle-check"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#00131E]">
            {{ $totalRealizados ?? 3 }}
        </div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                Completados
            </span>
        </div>
    </div>

    <!-- Métrica 4: Próximos -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md hover:border-[#39A900]/40 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Próximos</span>
            <span class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs shadow-2xs">
                <i class="fa-solid fa-clock"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#00131E]">
            {{ $totalProximos ?? 3 }}
        </div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                Próximos 30 días
            </span>
        </div>
    </div>

    <!-- Métrica 5: Satisfacción (Destacada SENA ERP) -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-emerald-200/80 shadow-xs hover:shadow-md hover:border-[#39A900] transition-all flex flex-col justify-between relative overflow-hidden bg-gradient-to-br from-white via-white to-emerald-50/50 col-span-2 sm:col-span-1">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[11px] font-extrabold text-[#166534] uppercase tracking-wider">Satisfacción</span>
            <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-xs shadow-sm">
                <i class="fa-solid fa-star"></i>
            </span>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-bold text-[#39A900]">
            {{ $promedioSatisfaccion ?? '4.6/5' }}
        </div>
        <div class="mt-2 flex items-center gap-1.5">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#39A900] text-white shadow-2xs">
                Promedio institucional
            </span>
        </div>
    </div>

</div>
