<!-- ============================================== -->
<!-- 1. MÉTRICAS SUPERIORES CON IDENTIDAD SENA ERP (GRID DE 5) -->
<!-- ============================================== -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3.5 sm:gap-4 mb-6">
    
    <!-- Métrica 1: Creadas -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-[#39A900]/50 transition duration-200">
        <div class="flex items-center justify-between mb-1">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Creadas</span>
            <div class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs font-bold shadow-2xs">
                <i class="fa-solid fa-clipboard-list"></i>
            </div>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-extrabold text-[#00131E] my-1.5">
            {{ $totalCreadas ?? 25 }}
        </div>
        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold px-2 py-0.5 rounded-full bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0] w-fit">
            <span class="w-1.5 h-1.5 rounded-full bg-[#39A900] animate-pulse"></span> Total en sistema
        </span>
    </div>

    <!-- Métrica 2: Enviadas -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-[#39A900]/50 transition duration-200">
        <div class="flex items-center justify-between mb-1">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Enviadas</span>
            <div class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs font-bold shadow-2xs">
                <i class="fa-solid fa-paper-plane"></i>
            </div>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-extrabold text-[#00131E] my-1.5">
            {{ $totalEnviadas ?? 320 }}
        </div>
        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold px-2 py-0.5 rounded-full bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0] w-fit">
            <span class="w-1.5 h-1.5 rounded-full bg-[#39A900]"></span> Egresados citados
        </span>
    </div>

    <!-- Métrica 3: Pendientes -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-[#39A900]/50 transition duration-200">
        <div class="flex items-center justify-between mb-1">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Pendientes</span>
            <div class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs font-bold shadow-2xs">
                <i class="fa-solid fa-clock"></i>
            </div>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-extrabold text-[#00131E] my-1.5">
            {{ $totalPendientes ?? 78 }}
        </div>
        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold px-2 py-0.5 rounded-full bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0] w-fit">
            <span class="w-1.5 h-1.5 rounded-full bg-[#39A900]"></span> Por responder
        </span>
    </div>

    <!-- Métrica 4: Respondidas -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-[#39A900]/50 transition duration-200">
        <div class="flex items-center justify-between mb-1">
            <span class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">Respondidas</span>
            <div class="w-8 h-8 rounded-xl bg-[#EAF7EE] text-[#39A900] flex items-center justify-center text-xs font-bold shadow-2xs">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-extrabold text-[#00131E] my-1.5">
            {{ $totalRespondidas ?? 242 }}
        </div>
        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold px-2 py-0.5 rounded-full bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0] w-fit">
            <span class="w-1.5 h-1.5 rounded-full bg-[#39A900]"></span> Verificadas
        </span>
    </div>

    <!-- Métrica 5: Tasa de Respuesta -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-emerald-200/80 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-[#39A900] transition duration-200 col-span-2 sm:col-span-1 bg-gradient-to-br from-white via-white to-emerald-50/50">
        <div class="flex items-center justify-between mb-1">
            <span class="text-[11px] font-extrabold text-[#166534] uppercase tracking-wider">Tasa Respuesta</span>
            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-xs font-bold shadow-sm">
                <i class="fa-solid fa-chart-line"></i>
            </div>
        </div>
        <div class="font-editorial text-2xl sm:text-3xl font-extrabold text-[#39A900] my-1.5">
            {{ $tasaRespuestaGeneral ?? '75%' }}
        </div>
        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold px-2 py-0.5 rounded-full bg-[#39A900] text-white shadow-2xs w-fit">
            <span class="w-1.5 h-1.5 rounded-full bg-white"></span> Efectividad global
        </span>
    </div>

</div>
