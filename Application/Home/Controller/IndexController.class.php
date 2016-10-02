<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController
{
    public function index($type = '')
    {
        //获取排行
        $rankNews = $this->getRank();
        //获取首页大图数据
        $topPicNews = D('PositionContent')->select(array('status' => 1, 'position_id' => 2));
        //首页3小图
        $topSmailNews = D('PositionContent')->select(array('status' => 1, 'position_id' => 3));
        //新闻列表
        $listNews = D('News')->select(['status' => 1, 'thumb' => ['neq', '']], 30);
        //2条广告
        $advNews = D('PositionContent')->select(array('status' => 1, 'position_id' => 5));
        $this->assign('result', [
            'topPicNews' => $topPicNews,
            'topSmailNews' => $topSmailNews,
            'listNews' => $listNews,
            'advNews' => $advNews,
            'rankNews' => $rankNews,
            'catId' => 0
        ]);
        if ($type == 'buildHtml') {
            $this->buildHtml('index', HTML_PATH, 'Index/index');
        } else {
            $this->display();
        }
    }

    //首页静态化处理
    public function build_html()
    {
        $this->index('buildHtml');
    }

    public function crontab_build_html()
    {
        if (APP_CRONTAB != 1) {
            die('the file must exec by crontab.php');
        }
        $this->index('buildHtml');
    }
}