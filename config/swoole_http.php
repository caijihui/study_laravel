<?php
/**
 * Created by PhpStorm.
 * User: zz-med
 * Date: 2019/4/10
 * Time: 下午4:15
 */
return [
    'server' => [
        'host' => env('SWOOLE_HTTP_HOST', '0.0.0.0'),//监听任意ip
        'port' => env('SWOOLE_HTTP_PORT', '1215'),
        'options' => [
            'pid_file' => env('SWOOLE_HTTP_PID_FILE', base_path('storage/logs/swoole_http.pid')),
            'log_file' => env('SWOOLE_HTTP_LOG_FILE', base_path('storage/logs/swoole_http.log')),
            'daemonize' => env('SWOOLE_HTTP_DAEMONIZE', 1),//1-程序将转入后台作为守护进程运行
        ],
    ]
];


