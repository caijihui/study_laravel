<?php
/**
 * Created by PhpStorm.
 * User: cjh
 * Date: 2018/10/31
 * Time: 下午4:30
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends  Controller
{

    public function getList(Request $request)
    {
        $params = $request->all();
        $required = [
            'id'      =>'required',
            'name'      =>'required'
        ];
        if (Validator::make($params, $required)->fails()) {
            return response()->json(['code' => -1, 'msg' => '请求参数有误']);
        }
        $user = $request->attributes->get('user');
        $user_id = $user->id;
        echo $user_id;
        echo "<br>";
        $type = $params['type'] ?? '0';
        echo $type;
    }

}