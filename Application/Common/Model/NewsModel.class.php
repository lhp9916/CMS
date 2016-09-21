<?php
namespace Common\Model;

use Think\Exception;
use Think\Model;

class NewsModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('news');
    }

    public function insert($data = [])
    {
        if (!is_array($data) || !$data) {
            return 0;
        }
        $data['create_time'] = time();
        $data['username'] = getLoginUsername();
        return $this->_db->add($data);
    }

    public function getNews($data, $page, $pageSize = 10)
    {
        $condition = $data;
        if (isset($data['title']) && $data['title']) {
            $condition['title'] = array('like', '%' . $data['title'] . '%');
        }
        if (isset($data['catid']) && $data['catid']) {
            $condition['catid'] = intval($data['catid']);
        }
        $condition['status'] = ['neq', -1];
        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($condition)
            ->order('listorder desc,news_id desc')
            ->limit($offset, $pageSize)
            ->select();
        return $list;
    }

    public function getNewsCount($data = [])
    {
        $condition = $data;
        if (isset($data['title']) && $data['title']) {
            $condition['title'] = array('like', '%' . $data['title'] . '%');
        }
        if (isset($data['catid']) && $data['catid']) {
            $condition['catid'] = intval($data['catid']);
        }
        return $this->_db->where($condition)->count();
    }

    public function find($id)
    {
        $data = $this->_db->where('news_id=' . $id)->find();
        return $data;
    }

    public function updateById($id, $data)
    {
        if (!$id || !is_numeric($id)) {
            throw new Exception('ID不合法');
        }
        if (!$data || !is_array($data)) {
            throw new Exception('更新数据不合法');
        }
        return $this->_db->where('news_id=' . $id)->save($data);
    }

}
