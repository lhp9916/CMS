<?php
/**
 * Created by PhpStorm.
 * User: lhp
 * Date: 2016/9/11
 * Time: 16:05
 */
namespace Admin\Controller;

use \Think\Controller;

class IndexController extends CommonController
{
    public function index()
    {
        $news = D('News')->maxcount();
        $newsCount = D('News')->getNewsCount(['status' => 1]);
        $positionCount = D('Position')->getCount(['status' => 1]);
        $adminCount = D('Admin')->getLastLoginUsers();
        $this->assign('news', $news);
        $this->assign('newsCount', $newsCount);
        $this->assign('positionCount', $positionCount);
        $this->assign('adminCount', $adminCount);
        $this->display();
    }

}