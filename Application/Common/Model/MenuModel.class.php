<?php
/**
 * Created by PhpStorm.
 * User: lhp
 * Date: 2016/9/11
 * Time: 15:36
 */
namespace Common\Model;

use Think\Exception;
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
            ->order('listorder desc,menu_id desc')
            ->limit($offset, $pageSize)
            ->select();
        return $list;
    }

    public function getMenusCount($data = array())
    {
        $data['status'] = array('neq', -1);
        return $this->_db->where($data)->count();
    }

    /**
     * 根据ID 查找
     * @param array|mixed $id
     * @return array|mixed
     */
    public function find($id)
    {
        if (!$id || !is_numeric($id)) {
            return array();
        }
        return $this->_db->where('menu_id=' . $id)->find();
    }

    public function updateById($id, $data)
    {
        if (!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if (!$data || !is_array($data)) {
            throw_exception("更新数据不合法");
        }
        return $this->_db->where('menu_id=' . $id)->save($data);
    }

    public function updateStatusById($id, $status)
    {
        if (!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if (!$status || !is_numeric($status)) {
            throw_exception("状态不合法");
        }
        $data['status'] = $status;
        return $this->_db->where('menu_id=' . $id)->save($data);
    }

    public function updateMenuListorderById($id, $listorder)
    {
        if (!$id || !is_numeric($id)) {
            throw new Exception("ID不合法");
        }
        $data = [
            'listorder' => intval($listorder),
        ];
        return $this->_db->where('menu_id=' . $id)->save($data);
    }

    public function getAdminMenus()
    {
        $condition = [
            'status' => ['neq', -1],
            'type' => 1,
        ];
        return $this->_db->where($condition)->order('listorder desc,menu_id desc')->select();
    }

    //前端导航
    public function getBarMenus()
    {
        $condition = [
            'status' => 1,
            'type' => 0,
        ];
        return $this->_db->where($condition)->order('listorder desc,menu_id desc')->select();
    }
}
