<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EncuestasController extends Controller
{
    /**
     * Muestra la vista principal de Gestión de Encuestas para el Superadmin.
     */
    public function index(Request $request)
    {
        // 5 Métricas Superiores
        $totalCreadas = session('encuestas_creadas_count', 25);
        $totalEnviadas = 320;
        $totalPendientes = 78;
        $totalRespondidas = 242;
        $tasaRespuestaGeneral = '75%';

        // Encuestas base por defecto
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

        $customSession = session('custom_encuestas', []);
        $nuevasSession = session('nuevas_encuestas', []);
        $sessionEncuestas = array_merge($customSession, $nuevasSession);

        foreach ($sessionEncuestas as &$sEnc) {
            if (in_array($sEnc['id'], $cerradas)) {
                $sEnc['status'] = 'CERRADA';
                $sEnc['status_pill'] = 'status-gray';
            }
        }
        unset($sEnc);

        $encuestas = array_merge($sessionEncuestas, $defaultEncuestas);

        return view('egresados::superadmin.encuestas.index', compact(
            'encuestas',
            'totalCreadas',
            'totalEnviadas',
            'totalPendientes',
            'totalRespondidas',
            'tasaRespuestaGeneral'
        ));
    }

    /**
     * Guarda una nueva encuesta institucional creada por el superadministrador con su estructura nativa de preguntas.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'               => 'required|string|max:255',
            'descripcion'          => 'nullable|string',
            'publico_objetivo'     => 'required|string',
            'fecha_cierre'         => 'required|date',
            'url_formulario'       => 'nullable|url|max:500',
            'estructura_preguntas' => 'nullable|string',
        ], [
            'titulo.required'           => 'El título de la encuesta es obligatorio.',
            'publico_objetivo.required' => 'Debe seleccionar el público objetivo.',
            'fecha_cierre.required'     => 'Debe definir la fecha de cierre.',
            'url_formulario.url'        => 'El enlace del formulario debe ser una URL válida.',
        ]);

        $publicoLabels = [
            'TODOS'         => 'Todos los Egresados',
            'ADSO'          => 'Egresados ADSO',
            'GAE'           => 'Egresados Gestión Agroempresarial',
            'EMPRENDEDORES' => 'Egresados Emprendedores',
            'INSTRUCTORES'  => 'Instructores / Seguimiento',
        ];

        $targetLabel = $publicoLabels[$request->publico_objetivo] ?? $request->publico_objetivo;
        $newId = 'ENC-' . str_pad(rand(26, 99), 3, '0', STR_PAD_LEFT);

        // Decodificar la estructura dinámica de preguntas creada con Alpine.js
        $preguntas = [];
        if ($request->filled('estructura_preguntas')) {
            $preguntas = json_decode($request->input('estructura_preguntas'), true) ?: [];
        }

        $totalPreguntas = count($preguntas);

        $nuevaEncuesta = [
            'id'          => $newId,
            'title'       => $request->titulo,
            'full_title'  => $request->titulo,
            'description' => $request->descripcion ?? 'Encuesta enviada a ' . $targetLabel . ($totalPreguntas > 0 ? " ({$totalPreguntas} preguntas nativas)" : ''),
            'date'        => date('d/m/Y'),
            'status'      => 'ACTIVA',
            'status_pill' => 'status-green',
            'target'      => $targetLabel,
            'enviadas'    => rand(40, 150),
            'respondidas' => 0,
            'pendientes'  => rand(40, 150),
            'rate'        => '0%',
            'rate_num'    => 0,
            'url'         => $request->url_formulario ?? '',
            'preguntas'   => $preguntas,
        ];

        // Guardar en sesión de forma desacoplada
        $sessionEncuestas = session('nuevas_encuestas', []);
        array_unshift($sessionEncuestas, $nuevaEncuesta);
        session(['nuevas_encuestas' => $sessionEncuestas]);
        session(['encuestas_creadas_count' => count($sessionEncuestas) + 25]);

        $msg = '¡Encuesta "' . $request->titulo . '" creada exitosamente' . ($totalPreguntas > 0 ? " con {$totalPreguntas} preguntas nativas." : '!');

        return redirect()->route('egresados.superadmin.encuestas.index')
            ->with('success', $msg);
    }

    /**
     * Muestra la vista de análisis y resultados gráficos con ApexCharts para una encuesta específica.
     */
    public function resultados($id)
    {
        // Buscar la encuesta por ID en sesión o en las encuestas por defecto
        $sessionEncuestas = session('nuevas_encuestas', []);
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
     * Cierra una encuesta activa para finalizar el periodo de recolección de respuestas.
     */
    public function cerrar($id)
    {
        // 1. Integración con base de datos (descomentar al conectar el modelo Eloquent):
        // $encuesta = Encuesta::findOrFail($id);
        // $encuesta->estado = 'CERRADA';
        // $encuesta->save();

        // 2. Persistir el estado cerrado en sesión
        $cerradas = session('encuestas_cerradas', []);
        if (!in_array($id, $cerradas)) {
            $cerradas[] = $id;
            session(['encuestas_cerradas' => $cerradas]);
        }

        // Si la encuesta proviene de las creadas en sesión, actualizar su estado
        $sessionEncuestas = session('nuevas_encuestas', []);
        foreach ($sessionEncuestas as &$item) {
            if ($item['id'] === $id) {
                $item['status'] = 'CERRADA';
                $item['status_pill'] = 'status-gray';
            }
        }
        unset($item);
        session(['nuevas_encuestas' => $sessionEncuestas]);

        return redirect()->back()
            ->with('success', "La encuesta {$id} ha sido cerrada exitosamente. Ya no se recibirán más respuestas.");
    }
}
