<?php
namespace Home\Controller;

use Think\Controller;

class CatController extends CommonController
{
    public function index()
    {
        $id = intval($_GET['id']);//栏目id
        if (!$id) {
            return $this->error('ID不存在');
        }
        $nav = D('Menu')->find($id);
        if (!$nav || $nav['status'] != 1) {
            return $this->error('栏目id不存在或者状态不为正常');
        }
        $advNews = D('PositionContent')->select(array('status' => 1, 'position_id' => 5));
        $rankNews = $this->getRank();
        //分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 20;
        $condition = [
            'status' => 1,
            'thumb' => ['neq', ''],
            'catid' => $id,
        ];
        $news = D('News')->getNews($condition, $page, $pageSize);
        $conut = D('News')->getNewsCount($condition);
        $res = new \Think\Page($conut, $pageSize);
        $pageRes = $res->show();
        $this->assign('result', [
            'advNews' => $advNews,
            'rankNews' => $rankNews,
            'catId' => $id,
            'listNews' => $news,
            'pageRes' => $pageRes,
        ]);
        $this->display();
    }
}