<?php

namespace Modules\Egresados\Console\Commands;

use Illuminate\Console\Command;
use Modules\Egresados\Services\SigeSyncService;

class SyncSigeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sige:sync-all 
                            {--page=1 : Página de inicio para la consulta}
                            {--limit=500 : Tamaño del lote por página}
                            {--max-pages= : Límite máximo de páginas a consultar}
                            {--mock : Ejecuta una prueba local masiva de rendimiento con registros sintéticos}
                            {--count=5000 : Cantidad de registros para la prueba mock (ej. 5000 o 10000)}';

    /**
     * Alternative signatures / aliases for the command.
     *
     * @var string[]
     */
    protected $aliases = ['sige:sync'];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincronizar entre 5.000 y 10.000 registros desde SIGE sin duplicados (UPSERT masivo por lotes de 500)';

    /**
     * Execute the console command.
     */
    public function handle(SigeSyncService $service): int
    {
        $this->info('=====================================================================');
        $this->info('  SIGE · Sincronización Masiva de Egresados (Chunks de 500 + Upsert)  ');
        $this->info('=====================================================================');
        $this->newLine();

        $inicio = microtime(true);
        $memoriaInicio = memory_get_usage(true);

        $isMock = (bool) $this->option('mock');
        $limit = (int) $this->option('limit');
        $maxPages = $this->option('max-pages') ? (int) $this->option('max-pages') : null;

        if ($isMock) {
            $count = (int) $this->option('count');
            $this->comment("🧪 Modo Mock Benchmark activado: Generando y sincronizando {$count} registros sintéticos...");
            
            $bar = $this->output->createProgressBar($count);
            $bar->setFormat(" %current%/%max% [%bar%] %percent:3s%% -- %message%");
            $bar->setMessage("Iniciando lotes...");
            $bar->start();

            $resultado = $service->syncMockBenchmark($count, function ($pagina, $procesadosLote, $totalSoFar) use ($bar) {
                $bar->setMessage("Lote {$pagina} procesado (+{$procesadosLote})");
                $bar->advance($procesadosLote);
            });

            $bar->finish();
            $this->newLine(2);
        } else {
            $this->comment("📡 Consultando API de SIGE en lotes de {$limit} registros...");
            
            $bar = null;
            $resultado = $service->syncAll(function ($pagina, $procesadosLote, $totalSoFar) {
                $this->line("   📦 Página {$pagina}: {$procesadosLote} registros procesados con UPSERT SQL (Total acumulado: {$totalSoFar})");
            }, $limit, $maxPages);

            $this->newLine();
        }

        $duracion = round(microtime(true) - $inicio, 2);
        $memoriaPico = round(memory_get_peak_usage(true) / 1024 / 1024, 2);

        if (!empty($resultado['error'])) {
            $this->error('⚠️ Ocurrió una advertencia o error en la sincronización:');
            $this->line($resultado['error']);
            $this->newLine();
        }

        if ($resultado['total_procesados'] > 0 || empty($resultado['error'])) {
            $this->info('🎉 ¡Sincronización masiva completada con éxito!');
        } else {
            $this->warn('La sincronización finalizó sin registros procesados.');
        }

        $totalProcesados = $resultado['total_procesados'] ?? 0;
        $paginas = $resultado['paginas'] ?? 0;
        $consultasAproximadas = $paginas * 3; // 1 upsert people + 1 select IDs + 1 upsert apprentices
        $consultasTradicionales = $totalProcesados * 2; // select + insert/update individual

        $this->table(
            ['Métrica de Rendimiento', 'Valor Obtenido'],
            [
                ['Registros procesados', number_format($totalProcesados, 0, ',', '.')],
                ['Páginas / Lotes consultados', $paginas],
                ['Tiempo total de ejecución', "{$duracion} segundos"],
                ['Consumo de memoria RAM pico', "{$memoriaPico} MB"],
                ['Sentencias SQL ejecutadas (UPSERT masivo)', "~{$consultasAproximadas} consultas"],
                ['Sentencias SQL ahorradas vs bucle tradicional', "~" . number_format($consultasTradicionales - $consultasAproximadas, 0, ',', '.') . " consultas evitadas"],
            ]
        );

        $this->newLine();
        $this->comment('Consejo: Para programar este proceso automáticamente, regístralo en el Task Scheduler de Laravel.');

        return Command::SUCCESS;
    }
}
