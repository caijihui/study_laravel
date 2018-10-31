<?php
/**
 * Created by PhpStorm.
 * User: cjh
 * Date: 2018/10/31
 * Time: 下午3:16
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['logout','me']]);
    }

    public function login(Request $request)
    {

        if ($request->input('username', '') == '') {
            return $this->error(40001,'为空');
        }

        if ($request->input('password', '') == '') {
            return $this->error(40002,'为空');
        }

        $credentials = ['username' => $request->input('username'), 'password' => $request->input('password')];

        if (!$token = auth('api')->attempt($credentials)) {
            return $this->error(40003,'用户名或密码不正确');
        }
        $user = auth('api')->user();
        $data = $this->DB_array($user);
        $data['token'] = $token;
        $data['expires_in'] = JWTAuth::factory()->getTTL() * 60;
        //   return $this->respondWithToken($token);
        return $this->success(1,$data);
    }
    /**
     * 退出登录
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function logout()
    {
        auth('api')->logout();

        return $this->success([]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }


    /**
     * Refresh a token.
     * 刷新token，如果开启黑名单，以前的token便会失效。
     * 值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}