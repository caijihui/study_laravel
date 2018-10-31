<?php

namespace App\Traits;

trait ResponseFormat
{

    public function success($data, $code = 1)
    {

        return response([
            'code' => $code,
            'msg' => 'success',
            'data' => $data
        ]);
    }

    /**
     * @param $status int 返回码
     * @param $msg
     * @param array $args 替换占位符的参数，如果消息固定默认为空
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function error($code, $msg = '', $args = [])
    {
        if (empty($msg)) {
            $msg = config("error.{$code}") ?: '';
            $msg = $args ? sprintf($msg, ...$args) : $msg;
        }
        return response([
            'code' => $code,
            'msg' => $msg
        ]);
    }

}
