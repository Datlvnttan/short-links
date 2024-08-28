<?php

namespace App\Http\Middleware;

use App\Repositories\Interface\PermissionRepositoryInterface;
use Closure;
use Tymon\JWTAuth\JWTAuth;

class AuthenticateWithCookie
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    } 

    public function handle($request, Closure $next)
    {
        if ($token = $request->cookie(config("app.TOKEN_AUTH","token"))) {
            try {
                $user = $this->auth->parseToken($token)->authenticate();
                if ($user) {
                    auth()->setUser($user);
                }
            } catch (\Exception $e) {
                // Xử lý khi token không hợp lệ hoặc đã hết hạn
            }
        }

        return $next($request);
    }
}

