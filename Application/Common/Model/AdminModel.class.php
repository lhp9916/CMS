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
}