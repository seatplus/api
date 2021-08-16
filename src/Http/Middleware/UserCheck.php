<?php


namespace Seatplus\Api\Http\Middleware;


use Closure;
use Exception;
use Illuminate\Http\Request;

class UserCheck
{

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        dd($user);

        abort_unless($user, 403,'no valid token provided');



        return $next($request);

    }
}