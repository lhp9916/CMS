<?php
/**
 * 公共方法
 * Created by PhpStorm.
 * User: lhp
 * Date: 2016/9/11
 * Time: 15:19
 */
//格式化输出
function p($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * 提示
 * @param $status
 * @param $message
 * @param array $data
 */
function show($status, $message, $data = array())
{
    $result = array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
    );
    exit(json_encode($result));
}

function getMd5Password($password)
{
    return md5($password . C('MD5_PRE'));//C读取配置文件
}