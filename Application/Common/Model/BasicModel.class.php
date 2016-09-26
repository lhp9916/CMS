<?php
namespace Common\Model;

use Think\Exception;
use Think\Model;

class BasicModel extends Model
{
    public function __construct()
    {

    }

    public function save($data = [])
    {
        if (!$data) {
            throw new Exception('没有提交数据');
        }
        //写入静态缓存 Runtime/Data/basic_web_config.php
        $id = F('basic_web_config', $data);
        return $id;
    }

    public function select()
    {
        return F('basic_web_config');
    }
}