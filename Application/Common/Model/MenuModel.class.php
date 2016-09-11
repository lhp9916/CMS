<?php
/**
 * Created by PhpStorm.
 * User: lhp
 * Date: 2016/9/11
 * Time: 15:36
 */
namespace Common\Model;

use Think\Model;

class MenuModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('menu');//实例化menu这个表
    }

    public function insert($data = array())
    {
        if (!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }

}