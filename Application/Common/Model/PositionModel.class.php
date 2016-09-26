<?php
namespace Common\Model;

use Think\Model;

class PositionModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('position');
    }

    //获取正常的推荐位内容
    public function getNormalPositions()
    {
        $condition = array('status' => 1);
        $list = $this->_db->where($condition)->order('id')->select();
        return $list;
    }
}