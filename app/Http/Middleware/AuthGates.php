<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Role_permission;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        if (isset(Auth::user()->role_id)) {
            $permissions = Role_permission::where('role_id', Auth::user()->role_id)
                                    ->get()->all();

            foreach ($permissions as $permission) {

                Gate::define($permission->permission, function ($user) {
                        return true;
                });
            }
        }

        return $next($request);
    }
}
