<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Entities\Audit;

class AuditoriaController extends Controller
{
    /**
     * Explorador de bitácoras y registros de auditoría del sistema.
     */
    public function index(Request $request)
    {
        $query = Audit::with('user.person');

        if ($request->filled('evento')) {
            $query->where('event', $request->input('evento'));
        }

        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar');
            $query->where(function ($q) use ($buscar) {
                $q->where('auditable_type', 'like', "%{$buscar}%")
                  ->orWhere('ip_address', 'like', "%{$buscar}%")
                  ->orWhere('url', 'like', "%{$buscar}%")
                  ->orWhereHas('user', function ($uQuery) use ($buscar) {
                      $uQuery->where('email', 'like', "%{$buscar}%")
                             ->orWhere('nickname', 'like', "%{$buscar}%");
                  });
            });
        }

        $auditorias = $query->orderBy('created_at', 'desc')->paginate(15);
        $totalAuditorias = Audit::count();

        $eventos = [
            'created' => Audit::where('event', 'created')->count(),
            'updated' => Audit::where('event', 'updated')->count(),
            'deleted' => Audit::where('event', 'deleted')->count(),
        ];

        return view('admin::auditoria.index', compact('auditorias', 'totalAuditorias', 'eventos'));
    }

    /**
     * Detalle específico de un registro de auditoría.
     */
    public function show($id)
    {
        $auditoria = Audit::with('user.person')->findOrFail($id);
        return view('admin::auditoria.show', compact('auditoria'));
    }
}
