<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorEncuestasController extends Controller
{
    /**
     * Muestra la vista principal de Encuestas del Instructor.
     */
    public function index(Request $request)
    {
        $encuestas = \Modules\Egresados\Http\Controllers\EncuestasController::getAllEncuestas();
        $totalCreadas = count($encuestas);
        $totalEnviadas = 0;
        $totalPendientes = 0;
        $totalRespondidas = 0;

        foreach ($encuestas as $e) {
            $totalEnviadas += (int)($e['enviadas'] ?? 0);
            $totalPendientes += (int)($e['pendientes'] ?? 0);
            $totalRespondidas += (int)($e['respondidas'] ?? 0);
        }
        if ($totalEnviadas === 0) {
            $totalEnviadas = 320;
            $totalPendientes = 78;
            $totalRespondidas = 242;
        }

        $tasaRespuestaGeneral = $totalEnviadas > 0 ? round(($totalRespondidas / $totalEnviadas) * 100) . '%' : '75%';

        return view('egresados::instructor.encuestas.index', compact(
            'encuestas',
            'totalCreadas',
            'totalEnviadas',
            'totalPendientes',
            'totalRespondidas',
            'tasaRespuestaGeneral'
        ));
    }

    /**
     * Guarda una nueva encuesta creada por el Instructor.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'publico_objetivo' => 'required|string',
            'fecha_cierre' => 'required|date',
            'estructura_preguntas' => 'nullable|string',
        ]);

        // Determinar autor autenticado
        $creadorNombre = 'Carlos Mendoza (Instructor)';
        if (Auth::check()) {
            $user = Auth::user();
            $creadorNombre = ($user->full_name ?? ($user->name ?? ($user->nickname ?? 'Instructor SENA'))) . ' (Instructor)';
        }

        $allCurrent = \Modules\Egresados\Http\Controllers\EncuestasController::getAllEncuestas();
        $newId = 'ENC-' . str_pad(count($allCurrent) + 26, 3, '0', STR_PAD_LEFT);

        $preguntas = [];
        if ($request->filled('estructura_preguntas')) {
            $preguntas = json_decode($request->estructura_preguntas, true) ?: [];
        }

        $nuevaEncuesta = [
            'id' => $newId,
            'title' => $request->titulo,
            'full_title' => $request->titulo,
            'description' => $request->descripcion ?? 'Encuesta creada por el instructor.',
            'date' => date('d/m/Y'),
            'fecha_cierre' => $request->fecha_cierre,
            'status' => 'ACTIVA',
            'status_pill' => 'status-green',
            'target' => $request->publico_objetivo,
            'creado_por' => $creadorNombre,
            'enviadas' => rand(30, 100),
            'respondidas' => 0,
            'pendientes' => rand(30, 100),
            'rate' => '0%',
            'rate_num' => 0,
            'url' => '',
            'category' => (stripos($request->titulo, 'empleo') !== false || stripos($request->titulo, 'laboral') !== false) ? 'laboral' : 'institucional',
            'preguntas' => $preguntas,
        ];

        // Guardar en almacenamiento unificado
        \Modules\Egresados\Http\Controllers\EncuestasController::saveCustomEncuesta($nuevaEncuesta);

        return redirect()->route('egresados.instructor.encuestas.index')
            ->with('success', '¡Encuesta "' . $request->titulo . '" registrada exitosamente por ' . $creadorNombre . '!');
    }

    /**
     * Muestra la vista de análisis y resultados gráficos para una encuesta en el panel de Instructor.
     */
    public function resultados($id)
    {
        $all = \Modules\Egresados\Http\Controllers\EncuestasController::getAllEncuestas();
        $encuesta = collect($all)->firstWhere('id', $id);

        if (!$encuesta) {
            $encuesta = [
                'id'          => $id,
                'title'       => 'Encuesta ' . $id,
                'full_title'  => 'Resultados de Encuesta ' . $id,
                'description' => 'Análisis de respuestas e indicadores del instrumento institucional.',
                'date'        => date('d/m/Y'),
                'status'      => 'ACTIVA',
                'target'      => 'Comunidad de Egresados',
                'enviadas'    => 100,
                'respondidas' => 75,
                'pendientes'  => 25,
                'rate'        => '75%',
            ];
        }

        return view('egresados::superadmin.encuestas.resultados', compact('encuesta'));
    }

    /**
     * Cierra una encuesta activa desde el panel de Instructor.
     */
    public function cerrar($id)
    {
        $custom = \Modules\Egresados\Http\Controllers\EncuestasController::getCustomEncuestas();
        $found = false;
        foreach ($custom as &$item) {
            if ($item['id'] === $id) {
                $item['status'] = 'CERRADA';
                $item['status_pill'] = 'status-gray';
                $found = true;
                break;
            }
        }
        unset($item);

        if ($found) {
            $file = \Modules\Egresados\Http\Controllers\EncuestasController::getCustomEncuestasFile();
            @file_put_contents($file, json_encode($custom, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            \Illuminate\Support\Facades\Cache::forever('sige_custom_encuestas', $custom);
        }

        $cerradasCache = \Illuminate\Support\Facades\Cache::get('sige_encuestas_cerradas', []);
        if (!in_array($id, $cerradasCache)) {
            $cerradasCache[] = $id;
            \Illuminate\Support\Facades\Cache::forever('sige_encuestas_cerradas', $cerradasCache);
        }

        $cerradas = session('encuestas_cerradas', []);
        if (!in_array($id, $cerradas)) {
            $cerradas[] = $id;
            session(['encuestas_cerradas' => $cerradas]);
        }

        return redirect()->back()
            ->with('success', "La encuesta {$id} ha sido cerrada exitosamente. Ya no se recibirán más respuestas.");
    }
}
