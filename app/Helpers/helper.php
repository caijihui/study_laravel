<?php
/**
 * Created by PhpStorm.
 * User: cjh
 * Date: 2018/7/16
 * Time: 上午10:02
 */

function DB_array($obj)
{
    return json_decode(json_encode($obj), 1);
}