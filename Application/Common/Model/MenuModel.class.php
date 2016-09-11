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

    /**
     * 添加
     * @param array $data
     * @return int|mixed
     */
    public function insert($data = array())
    {
        if (!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }

    /**
     * 获取菜单
     * @param $data
     * @param $page
     * @param int $pageSize
     */
    public function getMenus($data, $page, $pageSize = 10)
    {
        $data['status'] = array('neq', -1);//不是删除的
        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($data)
            ->order('menu_id desc')
            ->limit($offset, $pageSize)
            ->select();
        return $list;
    }

    public function getMenusCount($data = array())
    {
        $data['status'] = array('neq', -1);
        return $this->_db->where($data)->count();
    }
}