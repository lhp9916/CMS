<?php
namespace Common\Model;

use Think\Exception;
use Think\Model;

class NewsContentModel extends Model
{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('news_content');
    }

    /**
     * @param array $data
     * @return int|mixed 返回插入的id
     */
    public function insert($data = [])
    {
        if (!is_array($data) || !$data) {
            return 0;
        }
        if (isset($data['content']) && $data['content']) {
            $data['content'] = htmlspecialchars($data['content']);//转换为html实体
        }
        $data['create_time'] = time();
        return $this->_db->add($data);
    }

    public function find($id)
    {
        $data = $this->_db->where('news_id=' . $id)->find();
        return $data;
    }

    public function updateNewsById($id, $data)
    {
        if (!$id || !is_numeric($id)) {
            throw new Exception('ID不合法');
        }
        if (!$data || !is_array($data)) {
            throw new Exception('更新数据不合法');
        }
        if (isset($data['content']) && $data['content']) {
            $data['content'] = htmlspecialchars($data['content']);
        }
        return $this->_db->where('news_id=' . $id)->save($data);
    }

}
