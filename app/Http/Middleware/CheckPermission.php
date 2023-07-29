<?php
namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    public function handle($request, Closure $next, $permissions)
    {
        $permissions = explode('|', $permissions);
        foreach($permissions as $permission)
        {
            if (!auth()->user()->can($permission)) {
                return response()->json(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'No tienes permisos para realizar esta acción'], 403);
            }
        }

        return $next($request);
    }
}