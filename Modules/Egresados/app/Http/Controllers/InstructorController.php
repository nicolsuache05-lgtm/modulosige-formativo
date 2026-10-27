<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Program;

class InstructorController extends Controller
{
    /**
     * Muestra el panel principal / dashboard de seguimiento para el rol de Instructor.
     */
    public function dashboard(Request $request)
    {
        $courses = Course::with('program')->get();
        $totalEgresados = Apprentice::where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmpleados = Apprentice::where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmprendedores = Apprentice::where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = Apprentice::where('apprentice_status', 'EN FORMACIÓN')->count();

        $query = Apprentice::where('apprentice_status', 'CERTIFICADO')->with(['person', 'course.program']);

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->input('course_id'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('person', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('first_last_name', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%");
            });
        }

        $egresadosSeguimiento = $query->orderBy('id', 'desc')->paginate(8);

        return view('egresados::instructor.dashboard', compact(
            'courses',
            'totalEgresados',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'egresadosSeguimiento'
        ));
    }

    /**
     * Muestra el directorio exclusivo de egresados para el Instructor.
     */
    public function directorio(Request $request)
    {
        // Métricas de seguimiento para el instructor
        $totalEgresadosCount = Apprentice::where('apprentice_status', 'CERTIFICADO')->count();
        $totalEgresados = $totalEgresadosCount;
        $actualizacionPendiente = 0;
        $seguimientosRealizados = 300;

        // Cursos y programas para filtros
        $courses = Course::with('program')->orderBy('code')->get();
        $programs = Program::orderBy('name')->get();

        // Consulta de egresados con relaciones
        $query = Apprentice::where('apprentice_status', 'CERTIFICADO')->with(['person', 'course.program']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('person', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('first_last_name', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->input('course_id'));
        }

        if ($request->filled('status')) {
            $query->where('apprentice_status', $request->input('status'));
        }

        $apprentices = $query->orderBy('id', 'desc')->paginate(12);

        return view('egresados::instructor.directorio', compact(
            'apprentices',
            'courses',
            'programs',
            'totalEgresados',
            'actualizacionPendiente',
            'seguimientosRealizados'
        ));
    }
}
