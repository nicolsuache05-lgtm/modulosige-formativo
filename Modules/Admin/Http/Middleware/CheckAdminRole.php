<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login', ['redirect' => $request->fullUrl()]);
        }

        if (!Auth::user()->hasAnyRole(['superadmin', 'sica.admin'])) {
            abort(403);
        }

        return $next($request);
    }
}