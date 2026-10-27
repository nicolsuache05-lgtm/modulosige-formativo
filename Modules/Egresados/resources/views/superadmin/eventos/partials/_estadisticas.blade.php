{{-- Grid de 5 Métricas Superiores de Eventos --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
    <!-- Métrica 1: Programados -->
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-xs flex flex-col justify-between hover:shadow-md hover:border-emerald-200 transition duration-200">
        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Programados</span>
        <div class="text-2xl font-bold font-editorial text-[#00131E] my-1">
            {{ $totalProgramados ?? 12 }}
        </div>
        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-[#EAF7EE] text-[#2a7c00] w-fit">
            Este año
        </span>
    </div>

    <!-- Métrica 2: Participantes -->
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-xs flex flex-col justify-between hover:shadow-md hover:border-emerald-200 transition duration-200">
        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Participantes</span>
        <div class="text-2xl font-bold font-editorial text-[#00131E] my-1">
            {{ $totalParticipantes ?? 856 }}
        </div>
        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 w-fit">
            Registrados
        </span>
    </div>

    <!-- Métrica 3: Realizados -->
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-xs flex flex-col justify-between hover:shadow-md hover:border-emerald-200 transition duration-200">
        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Realizados</span>
        <div class="text-2xl font-bold font-editorial text-[#00131E] my-1">
            {{ $totalRealizados ?? 8 }}
        </div>
        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-[#EAF7EE] text-[#2a7c00] w-fit">
            Este año
        </span>
    </div>

    <!-- Métrica 4: Próximos -->
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-xs flex flex-col justify-between hover:shadow-md hover:border-emerald-200 transition duration-200">
        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Próximos</span>
        <div class="text-2xl font-bold font-editorial text-[#00131E] my-1">
            {{ $totalProximos ?? 4 }}
        </div>
        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 w-fit">
            Próximos 30 días
        </span>
    </div>

    <!-- Métrica 5: Satisfacción -->
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-xs flex flex-col justify-between hover:shadow-md hover:border-emerald-200 transition duration-200">
        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-gray-500">Satisfacción</span>
        <div class="text-2xl font-bold font-editorial text-[#39A900] my-1">
            {{ $promedioSatisfaccion ?? '4.6/5' }}
        </div>
        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-[#EAF7EE] text-[#2a7c00] w-fit">
            Promedio
        </span>
    </div>
</div>
