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

    public function updateStatusById($id, $status)
    {
        if (!is_numeric($id)) {
            throw new Exception('id不为数字');
        }
        if (!is_numeric($status)) {
            throw new Exception('status不为数字');
        }
        $data['status'] = $status;
        return $this->_db->where('news_id=' . $id)->save($data);
    }

    public function updateNewsListorder($newsID, $listorder)
    {
        if (!is_numeric($newsID)) {
            throw new Exception('id不为数字');
        }
        $data = ['listorder' => intval($listorder)];
        return $this->_db->where('news_id=' . $newsID)->save($data);
    }

    /**
     * newsId数组 返回结果
     * @param $newsIds
     * @return mixed
     * @throws Exception
     */
    public function getNewsByNewsIdIn($newsIds)
    {
        if (!is_array($newsIds)) {
            throw new Exception('参数不合法');
        }
        $data = ['news_id' => array('in', implode(',', $newsIds))];
        return $this->_db->where($data)->select();
    }

    public function select($data, $limit)
    {
        $list = $this->_db->where($data)
            ->order('listorder desc,news_id desc')
            ->limit(0, $limit)
            ->select();
        return $list;
    }

    /**
     * 获取行的数据
     * @param array $data
     * @param int $limit
     * @return mixed
     */
    public function getRank($data = [], $limit = 100)
    {
        $list = $this->_db->where($data)
            ->order('count  desc,news_id desc')
            ->limit(0, $limit)
            ->select();
        return $list;
    }

    public function updateCount($id, $count)
    {
        if (!$id || !is_numeric($id)) {
            throw new Exception('ID不合法');
        }
        if (!is_numeric($count)) {
            throw new Exception('阅读数必须为整数');
        }
        $data['count'] = $count;
        return $this->_db->where('news_id=' . $id)->save($data);
    }
}
