<!-- ============================================== -->
<!-- 1. MÉTRICAS SUPERIORES (GRID DE 5) -->
<!-- ============================================== -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3.5 sm:gap-4 mb-6">
    
    <!-- Métrica 1: Creadas -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-emerald-500/30 transition duration-200">
        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Creadas</span>
        <div class="font-editorial text-2xl sm:text-3xl font-extrabold text-[#00131E] my-1">
            {{ $totalCreadas ?? 25 }}
        </div>
        <span class="inline-flex items-center text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 w-fit">
            Total histórico
        </span>
    </div>

    <!-- Métrica 2: Enviadas -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-emerald-500/30 transition duration-200">
        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Enviadas</span>
        <div class="font-editorial text-2xl sm:text-3xl font-extrabold text-[#00131E] my-1">
            {{ $totalEnviadas ?? 320 }}
        </div>
        <span class="inline-flex items-center text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 w-fit">
            Este mes
        </span>
    </div>

    <!-- Métrica 3: Pendientes -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-emerald-500/30 transition duration-200">
        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Pendientes</span>
        <div class="font-editorial text-2xl sm:text-3xl font-extrabold text-amber-700 my-1">
            {{ $totalPendientes ?? 78 }}
        </div>
        <span class="inline-flex items-center text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 w-fit">
            Por responder
        </span>
    </div>

    <!-- Métrica 4: Respondidas -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-emerald-500/30 transition duration-200">
        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Respondidas</span>
        <div class="font-editorial text-2xl sm:text-3xl font-extrabold text-[#00131E] my-1">
            {{ $totalRespondidas ?? 242 }}
        </div>
        <span class="inline-flex items-center text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 w-fit">
            Este mes
        </span>
    </div>

    <!-- Métrica 5: Tasa de Respuesta -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-emerald-500/30 transition duration-200 col-span-2 sm:col-span-1">
        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tasa Respuesta</span>
        <div class="font-editorial text-2xl sm:text-3xl font-extrabold text-[#0d6928] my-1">
            {{ $tasaRespuestaGeneral ?? '75%' }}
        </div>
        <span class="inline-flex items-center text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 w-fit">
            Promedio general
        </span>
    </div>

</div>
