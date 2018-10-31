<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\Traits\ResponseFormat;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware as Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;


class RefreshToken extends Middleware
{
    use ResponseFormat;
    protected  $response;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (!$this->auth->parser()->setRequest($request)->hasToken()) {
            return $this->error(40004,'access token 不能为空 或 access token 无效');
        }

        $token = null;

        try {
            $user = $this->auth->parseToken()->authenticate();
            if (!$user) {
                return $this->error(40005,'无效的 access token');
            }
            $request->attributes->add(['user' => $user]);
        } catch (JWTException $e) {
            if ($e instanceof TokenExpiredException) {
                try {
                    $token = $this->auth->refresh();
                    // 使用一次性登录以保证此次请求的成功
                    Auth::guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()
                        ->toPlainArray()['sub']);
                } catch (TokenBlacklistedException $e) {
                    return $this->error(40006,'请求参数无效，access token 已过期，不能刷新');
                } catch (TokenExpiredException $e) {
                    return $this->error(40006,'请求参数无效，access token 已过期，不能刷新');
                }
            } elseif ($e instanceof TokenBlacklistedException) {
                return $this->error(40006,'请求参数无效，access token 已过期，不能刷新');
            } else {
                return $this->error(40005,'无效的 access token');
            }
        }


        $response = $next($request);

        if ($token) {
            $response->headers->set('Authorization', 'Bearer ' . $token);
            $response->headers->set('expires-in', JWTAuth::factory()->getTTL() * 60);
        }

        return $response;
    }
}
