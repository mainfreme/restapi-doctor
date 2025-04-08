<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class BasicAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $email = $request->getUser();
        $password = $request->getPassword();

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response('Unauthorized', 401)->header('WWW-Authenticate', 'Basic');
        }

        // Jeśli chcesz mieć dostęp do zalogowanego użytkownika:
        auth()->login($user);

        return $next($request);
    }
}
