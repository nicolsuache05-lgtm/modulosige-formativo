<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGE · Gráficas e Indicadores del Reporte — CEFA La Angostura</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ route('egresados.assets.image', 'sena-logo.png') }}">

    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS & Chart.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
      :root {
        --forest: #001A29;
        --forest-deep: #00131E;
        --sena-dark: #00131E;
        --sena-navy: #001A29;
        --sena-navy-light: #002336;
        --sena-light-navy: #00324D;
        --green: #39A900;
        --bg: #F4F7F6;
      }
      body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
        color: #16261C;
      }
    </style>
</head>
<body class="min-h-screen bg-[#F4F7F6]">

    <!-- Header / Navbar Minimal -->
    <header class="bg-[#001A29] text-white py-4 px-6 sm:px-10 shadow-md border-b border-[#39A900]/30 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('egresados.superadmin.reportes.index') }}" class="w-9 h-9 rounded-xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition" title="Volver a Reportes">
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                </a>
                <div>
                    <h1 class="font-editorial text-lg sm:text-xl font-bold text-white flex items-center gap-2">
                        <span>Análisis Gráfico</span>
                        <span class="text-xs bg-[#39A900] text-white px-2 py-0.5 rounded-full font-sans font-bold uppercase">{{ $id }}</span>
                    </h1>
                    <p class="text-[11px] text-green-200/80">Visualización de métricas e indicadores estadísticos del reporte</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('egresados.superadmin.reportes.exportar', ['id' => $id, 'formato' => 'excel']) }}" class="px-3.5 py-1.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition flex items-center gap-1.5 shadow-sm">
                    <i class="fa-solid fa-file-excel text-xs"></i>
                    <span class="hidden sm:inline">Exportar Excel</span>
                </a>
                <a href="{{ route('egresados.superadmin.reportes.index') }}" class="px-3.5 py-1.5 bg-white/10 hover:bg-white/20 text-white text-xs font-semibold rounded-xl transition flex items-center gap-1.5">
                    <i class="fa-solid fa-table-list text-xs"></i>
                    <span class="hidden sm:inline">Volver a Tabla</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-7xl mx-auto p-6 sm:p-10 space-y-8">
        
        <!-- Summary Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-xs">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Muestra Evaluada</span>
                <div class="font-editorial text-3xl font-bold text-gray-900">{{ number_format($totalEgresadosCount) }}</div>
                <span class="text-[11px] text-emerald-700 font-semibold mt-1 block">100% de la base</span>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-xs">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Egresados Vinculados</span>
                <div class="font-editorial text-3xl font-bold text-emerald-700">{{ number_format($totalEmpleadosCount) }}</div>
                <span class="text-[11px] text-emerald-700 font-semibold mt-1 block">Empleo formal</span>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-xs">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Emprendedores</span>
                <div class="font-editorial text-3xl font-bold text-amber-600">{{ number_format($totalEmprendedoresCount) }}</div>
                <span class="text-[11px] text-amber-600 font-semibold mt-1 block">Negocios propios</span>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-emerald-200 shadow-xs bg-gradient-to-br from-white to-emerald-50/50">
                <span class="text-xs font-bold text-emerald-800 uppercase tracking-wider block mb-1">Tasa de Empleabilidad</span>
                <div class="font-editorial text-3xl font-bold text-emerald-700">{{ $tasaEmpleabilidad }}</div>
                <span class="text-[11px] text-emerald-700 font-semibold mt-1 block">Meta institucional cumplida</span>
            </div>
        </div>

        <!-- Charts Grid (2 Columns) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Chart 1: Donut Distribution -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-xs">
                <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-50">
                    <h3 class="font-editorial text-base font-bold text-gray-900">Distribución por Situación Ocupacional</h3>
                    <span class="text-xs text-gray-400">Gráfico circular</span>
                </div>
                <div class="h-64 flex items-center justify-center">
                    <canvas id="chartOcupacion"></canvas>
                </div>
            </div>

            <!-- Chart 2: Bar Comparison by Program -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-xs">
                <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-50">
                    <h3 class="font-editorial text-base font-bold text-gray-900">Egresados por Programa de Formación</h3>
                    <span class="text-xs text-gray-400">Comparativa</span>
                </div>
                <div class="h-64 flex items-center justify-center">
                    <canvas id="chartProgramas"></canvas>
                </div>
            </div>

        </div>

    </main>

    <!-- Chart.js Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart 1: Ocupación
            new Chart(document.getElementById('chartOcupacion'), {
                type: 'doughnut',
                data: {
                    labels: ['Empleados / Vinculados', 'Emprendedores', 'Buscando Empleo', 'Estudio Continuo'],
                    datasets: [{
                        data: [{{ $totalEmpleadosCount }}, {{ $totalEmprendedoresCount }}, {{ $totalDesempleadosCount }}, 95],
                        backgroundColor: ['#39A900', '#F59E0B', '#EF4444', '#3B82F6'],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { font: { size: 11, family: 'Plus Jakarta Sans' } } }
                    }
                }
            });

            // Chart 2: Programas
            new Chart(document.getElementById('chartProgramas'), {
                type: 'bar',
                data: {
                    labels: ['ADSO', 'Gestión Agroemp.', 'Producción Agrícola', 'Contabilización', 'Mecánica'],
                    datasets: [{
                        label: 'Egresados Vinculados',
                        data: [280, 196, 126, 165, 88],
                        backgroundColor: '#001A29',
                        borderRadius: 8
                    }, {
                        label: 'Total Egresados',
                        data: [350, 240, 180, 195, 110],
                        backgroundColor: '#A7F3D0',
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { font: { size: 11, family: 'Plus Jakarta Sans' } } }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
</body>
</html>
