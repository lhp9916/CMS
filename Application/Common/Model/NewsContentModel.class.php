<?php
namespace Common\Model;

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

}
