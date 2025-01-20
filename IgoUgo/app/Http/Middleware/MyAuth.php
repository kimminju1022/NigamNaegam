<?php

namespace App\Http\Middleware;

use App\Models\User;
use MyToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Log::debug('MyAuth : '.$request->bearerToken());

        MyToken::chkToken($request->bearerToken());

        // $user = MyToken::getUserFromToken($request->bearerToken());  // 예를 들어 MyToken::getUserFromToken()을 사용하여 사용자 가져오기

        // *************************************************
        $userEmail = MyToken::getValueInPayload($request->bearerToken(), 'acc');

        $user = User::where('user_email', $userEmail)->first();
        // *************************************************
        // Log::debug($user);

        // $request->attributes->add(['user' => $user]);
        // $request->user = $user;
        $request->merge(['user' => $user]);

        return $next($request);
    }
}
