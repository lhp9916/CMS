<?php
/**
 * Created by PhpStorm.
 * User: lhp
 * Date: 2016/9/11
 * Time: 15:36
 */
namespace Common\Model;

use Think\Model;

class AdminModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('admin');//实例化admin这个表
    }

    public function getAdminByUsername($username)
    {
        $rs = $this->_db->where('username="' . $username . '"')->find();
        return $rs;
    }

    public function getLastLoginUsers()
    {
        $time=mktime(0,0,0,date('m',date('d'),date('Y')));
        $data = [
            'status'=>1,
            'lastlogintime'=>array("gt",$time),
        ];
        $res = $this->_db->where($data)->count();
        return $res['tp_count'];
    }
}