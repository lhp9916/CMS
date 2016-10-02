<?php
namespace Home\Controller;

use Think\Controller;

class DetailController extends CommonController
{
    public function index()
    {
        $id = intval($_GET['id']);//文章id
        if (!$id || $id < 0) {
            return $this->error('ID不合法');
        }
        $news = D('News')->find($id);
        if (!$news || $news['status'] != 1) {
            return $this->error('ID不存在或者咨询被关闭');
        }
        //增加阅读数
        $count = intval($news['count']) + 1;
        D('News')->updateCount($id, $count);
        $content = D('NewsContent')->find($id);
        $news['content'] = htmlspecialchars_decode($content['content']);
        $advNews = D('PositionContent')->select(array('status' => 1, 'position_id' => 5));
        $rankNews = $this->getRank();

        $this->assign('result', [
            'rankNews' => $rankNews,
            'advNews' => $advNews,
            'catId' => $news['catid'],
            'news' => $news,
        ]);
        $this->display("Detail/index");
    }

    //文章预览
    public function view()
    {
        if (!getLoginUsername()) {
            $this->error('请先登录');
        }
        $this->index();
    }
}