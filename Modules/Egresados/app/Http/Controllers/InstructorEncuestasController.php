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
        // Métricas
        $totalCreadas = session('encuestas_creadas_count', 25);
        $totalEnviadas = 320;
        $totalPendientes = 78;
        $totalRespondidas = 242;
        $tasaRespuestaGeneral = '75%';

        // Encuestas base
        $defaultEncuestas = [
            [
                'id' => 'ENC-025',
                'title' => 'Inserción Laboral ADSO',
                'full_title' => 'Encuesta Inserción Laboral 2026',
                'description' => 'Diagnóstico de inserción y estabilidad en el mercado de software para egresados ADSO.',
                'date' => '12/06/2026',
                'status' => 'ACTIVA',
                'status_pill' => 'status-green',
                'target' => 'Egresado ADSO',
                'creado_por' => 'Carlos Mendoza (Instructor)',
                'enviadas' => 120,
                'respondidas' => 90,
                'pendientes' => 30,
                'rate' => '75%',
                'rate_num' => 75,
                'url' => 'https://forms.office.com/r/sample1'
            ],
            [
                'id' => 'ENC-024',
                'title' => 'Impacto y Empleabilidad 2025',
                'full_title' => 'Seguimiento Impacto Productivo 2025',
                'description' => 'Evaluación de competencias técnicas y salariales en el sector agroindustrial.',
                'date' => '05/05/2026',
                'status' => 'ACTIVA',
                'status_pill' => 'status-green',
                'target' => 'Egresados Tecnólogos',
                'creado_por' => 'Carlos Mendoza (Instructor)',
                'enviadas' => 80,
                'respondidas' => 68,
                'pendientes' => 12,
                'rate' => '85%',
                'rate_num' => 85,
                'url' => 'https://forms.office.com/r/sample2'
            ],
            [
                'id' => 'ENC-023',
                'title' => 'Satisfacción Formativa CEFA',
                'full_title' => 'Evaluación de Calidad Formativa CEFA',
                'description' => 'Percepción de egresados sobre la pertinencia de las instalaciones y docentes del CEFA.',
                'date' => '20/04/2026',
                'status' => 'ACTIVA',
                'status_pill' => 'status-green',
                'target' => 'Todas las Especialidades',
                'creado_por' => 'Coordinación Académica',
                'enviadas' => 150,
                'respondidas' => 105,
                'pendientes' => 45,
                'rate' => '70%',
                'rate_num' => 70,
                'url' => 'https://forms.office.com/r/sample3'
            ],
            [
                'id' => 'ENC-022',
                'title' => 'Competencias Blandas e Idiomas',
                'full_title' => 'Diagnóstico de Habilidades y Bilingüismo',
                'description' => 'Nivel de dominio de inglés y habilidades de trabajo en equipo en el puesto de trabajo.',
                'date' => '10/03/2026',
                'status' => 'CERRADA',
                'status_pill' => 'status-gray',
                'target' => 'Egresados ADSO / Multimedia',
                'creado_por' => 'Carlos Mendoza (Instructor)',
                'enviadas' => 95,
                'respondidas' => 88,
                'pendientes' => 7,
                'rate' => '92%',
                'rate_num' => 92,
                'url' => ''
            ],
            [
                'id' => 'ENC-021',
                'title' => 'Emprendimiento Fondo Emprender',
                'full_title' => 'Sondeo de Proyectos Productivos',
                'description' => 'Monitoreo de unidades productivas y emprendimientos rurales creados por egresados.',
                'date' => '15/02/2026',
                'status' => 'CERRADA',
                'status_pill' => 'status-gray',
                'target' => 'Egresados Emprendedores',
                'creado_por' => 'Coordinación de Emprendimiento',
                'enviadas' => 60,
                'respondidas' => 42,
                'pendientes' => 18,
                'rate' => '70%',
                'rate_num' => 70,
                'url' => ''
            ],
        ];

        // Manejo de estado cerrado en sesión
        $cerradas = session('encuestas_cerradas', []);
        foreach ($defaultEncuestas as &$enc) {
            if (in_array($enc['id'], $cerradas)) {
                $enc['status'] = 'CERRADA';
                $enc['status_pill'] = 'status-gray';
            }
        }
        unset($enc);

        // Obtener encuestas creadas en sesión
        $customEncuestas = session('custom_encuestas', []);
        $nuevasSession = session('nuevas_encuestas', []);
        $sessionEncuestas = array_merge($customEncuestas, $nuevasSession);

        foreach ($sessionEncuestas as &$sEnc) {
            if (in_array($sEnc['id'], $cerradas)) {
                $sEnc['status'] = 'CERRADA';
                $sEnc['status_pill'] = 'status-gray';
            }
        }
        unset($sEnc);

        $encuestas = array_merge($sessionEncuestas, $defaultEncuestas);

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
            $creadorNombre = ($user->full_name ?? ($user->nickname ?? 'Instructor SENA')) . ' (Instructor)';
        }

        $customEncuestas = session('custom_encuestas', []);
        $currentCount = session('encuestas_creadas_count', 25) + 1;
        session(['encuestas_creadas_count' => $currentCount]);

        $newId = 'ENC-' . str_pad($currentCount, 3, '0', STR_PAD_LEFT);

        $nuevaEncuesta = [
            'id' => $newId,
            'title' => $request->titulo,
            'full_title' => $request->titulo,
            'description' => $request->descripcion ?? 'Encuesta creada por el instructor.',
            'date' => date('d/m/Y'),
            'status' => 'ACTIVA',
            'status_pill' => 'status-green',
            'target' => $request->publico_objetivo,
            'creado_por' => $creadorNombre,
            'enviadas' => 0,
            'respondidas' => 0,
            'pendientes' => 0,
            'rate' => '0%',
            'rate_num' => 0,
            'url' => '',
            'preguntas' => json_decode($request->estructura_preguntas, true) ?? [],
        ];

        array_unshift($customEncuestas, $nuevaEncuesta);
        session(['custom_encuestas' => $customEncuestas]);

        return redirect()->route('egresados.instructor.encuestas.index')
            ->with('success', '¡Encuesta "' . $request->titulo . '" registrada exitosamente por ' . $creadorNombre . '!');
    }

    /**
     * Muestra la vista de análisis y resultados gráficos para una encuesta en el panel de Instructor.
     */
    public function resultados($id)
    {
        $sessionEncuestas = array_merge(session('custom_encuestas', []), session('nuevas_encuestas', []));
        $encuesta = collect($sessionEncuestas)->firstWhere('id', $id);

        if (!$encuesta) {
            $defaultEncuestas = [
                'ENC-025' => [
                    'id'          => 'ENC-025',
                    'title'       => 'Inserción Laboral ADSO',
                    'full_title'  => 'Encuesta Inserción Laboral 2026',
                    'description' => 'Diagnóstico de inserción y estabilidad en el mercado de software para egresados ADSO.',
                    'date'        => '12/06/2026',
                    'status'      => 'ACTIVA',
                    'target'      => 'Egresado ADSO',
                    'enviadas'    => 120,
                    'respondidas' => 90,
                    'pendientes'  => 30,
                    'rate'        => '75%',
                ],
                'ENC-024' => [
                    'id'          => 'ENC-024',
                    'title'       => 'Impacto y Empleabilidad 2025',
                    'full_title'  => 'Seguimiento Impacto Productivo 2025',
                    'description' => 'Evaluación de competencias técnicas y salariales en el sector agroindustrial.',
                    'date'        => '05/05/2026',
                    'status'      => 'ACTIVA',
                    'target'      => 'Egresados Tecnólogos',
                    'enviadas'    => 80,
                    'respondidas' => 68,
                    'pendientes'  => 12,
                    'rate'        => '85%',
                ],
                'ENC-023' => [
                    'id'          => 'ENC-023',
                    'title'       => 'Satisfacción Formativa CEFA',
                    'full_title'  => 'Evaluación de Calidad Formativa CEFA',
                    'description' => 'Percepción de egresados sobre la pertinencia de las instalaciones y docentes del CEFA.',
                    'date'        => '20/04/2026',
                    'status'      => 'ACTIVA',
                    'target'      => 'Todas las Especialidades',
                    'enviadas'    => 150,
                    'respondidas' => 105,
                    'pendientes'  => 45,
                    'rate'        => '70%',
                ],
            ];

            $encuesta = $defaultEncuestas[$id] ?? [
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
        $cerradas = session('encuestas_cerradas', []);
        if (!in_array($id, $cerradas)) {
            $cerradas[] = $id;
            session(['encuestas_cerradas' => $cerradas]);
        }

        $sessionEncuestas = session('nuevas_encuestas', []);
        foreach ($sessionEncuestas as &$item) {
            if ($item['id'] === $id) {
                $item['status'] = 'CERRADA';
                $item['status_pill'] = 'status-gray';
            }
        }
        unset($item);
        session(['nuevas_encuestas' => $sessionEncuestas]);

        $customEncuestas = session('custom_encuestas', []);
        foreach ($customEncuestas as &$item) {
            if ($item['id'] === $id) {
                $item['status'] = 'CERRADA';
                $item['status_pill'] = 'status-gray';
            }
        }
        unset($item);
        session(['custom_encuestas' => $customEncuestas]);

        return redirect()->back()
            ->with('success', "La encuesta {$id} ha sido cerrada exitosamente. Ya no se recibirán más respuestas.");
    }
}
