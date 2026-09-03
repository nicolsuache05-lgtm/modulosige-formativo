<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Egresados\Models\Egresado;
use Modules\SICA\Entities\Apprentice;

class EgresadosController extends Controller
{
    /**
     * Muestra la página de bienvenida / portal público de SIGE.
     */
    public function welcome()
    {
        $totalEgresados = Egresado::count();
        $totalEmpleados = Egresado::where('employment_status', 'Empleado')->count();
        $totalEmprendedores = Egresado::where('employment_status', 'Emprendedor')->count();
        $totalEstudiantes = Egresado::where('employment_status', 'Estudiante')->count();

        return view('egresados::welcome', compact(
            'totalEgresados',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes'
        ));
    }

    /**
     * Muestra el panel / dashboard principal de superadmin de SIGE.
     */
    public function dashboard()
    {
        $totalEgresados = Egresado::count();
        $totalEmpleados = Egresado::where('employment_status', 'Empleado')->count();
        $totalEmprendedores = Egresado::where('employment_status', 'Emprendedor')->count();
        $totalEstudiantes = Egresado::where('employment_status', 'Estudiante')->count();
        
        $totalActivos = Egresado::whereNotNull('contact_email')
            ->orWhereNotNull('contact_phone')
            ->count();
        if ($totalActivos === 0) {
            $totalActivos = $totalEgresados;
        }

        $tasaEmpleo = $totalEgresados > 0 ? round(($totalEmpleados / $totalEgresados) * 100) : 45;

        $recentEgresados = Egresado::with(['apprentice.person', 'apprentice.course.program'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('egresados::dashboard', compact(
            'totalEgresados',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'totalActivos',
            'tasaEmpleo',
            'recentEgresados'
        ));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Egresado::with(['apprentice.person', 'apprentice.course.program']);

        // Búsqueda por nombre, apellido o número de documento
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('apprentice.person', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('first_last_name', 'like', "%{$search}%")
                  ->orWhere('second_last_name', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%");
            });
        }

        // Filtro por estado laboral
        if ($request->filled('employment_status')) {
            $query->where('employment_status', $request->input('employment_status'));
        }

        $egresados = $query->orderBy('graduation_date', 'desc')->paginate(10);

        // Estadísticas rápidas para las tarjetas superiores
        $totalEgresados = Egresado::count();
        $totalEmpleados = Egresado::where('employment_status', 'Empleado')->count();
        $totalEmprendedores = Egresado::where('employment_status', 'Emprendedor')->count();
        $totalEstudiantes = Egresado::where('employment_status', 'Estudiante')->count();

        return view('egresados::index', compact('egresados', 'totalEgresados', 'totalEmpleados', 'totalEmprendedores', 'totalEstudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener aprendices que no estén ya registrados como egresados
        $existingEgresadoApprenticeIds = Egresado::pluck('apprentice_id')->toArray();
        $apprentices = Apprentice::with(['person', 'course.program'])
            ->whereNotIn('id', $existingEgresadoApprenticeIds)
            ->get();

        return view('egresados::create', compact('apprentices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'apprentice_id' => 'required|exists:apprentices,id|unique:egresados,apprentice_id',
            'graduation_date' => 'required|date',
            'employment_status' => 'required|in:Empleado,Desempleado,Estudiante,Emprendedor,Otro',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'linkedin' => 'nullable|url|max:255',
            'observations' => 'nullable|string',
        ]);

        Egresado::create($validated);

        return redirect()->route('egresados.index')->with('success', '¡Egresado registrado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $egresado = Egresado::with(['apprentice.person', 'apprentice.course.program'])->findOrFail($id);

        return view('egresados::show', compact('egresado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $egresado = Egresado::findOrFail($id);

        // Obtener aprendices que no estén ya registrados como egresados (excepto el actual)
        $existingEgresadoApprenticeIds = Egresado::where('id', '!=', $id)->pluck('apprentice_id')->toArray();
        $apprentices = Apprentice::with(['person', 'course.program'])
            ->whereNotIn('id', $existingEgresadoApprenticeIds)
            ->get();

        return view('egresados::edit', compact('egresado', 'apprentices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $egresado = Egresado::findOrFail($id);

        $validated = $request->validate([
            'apprentice_id' => 'required|exists:apprentices,id|unique:egresados,apprentice_id,' . $id,
            'graduation_date' => 'required|date',
            'employment_status' => 'required|in:Empleado,Desempleado,Estudiante,Emprendedor,Otro',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'linkedin' => 'nullable|url|max:255',
            'observations' => 'nullable|string',
        ]);

        $egresado->update($validated);

        return redirect()->route('egresados.index')->with('success', '¡Registro de egresado actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $egresado = Egresado::findOrFail($id);
        $egresado->delete();

        return redirect()->route('egresados.index')->with('success', '¡Registro de egresado eliminado con éxito!');
    }
}
