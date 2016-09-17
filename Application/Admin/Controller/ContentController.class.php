<?php
namespace Admin\Controller;

use \Think\Controller;
use Think\Think;

class ContentController extends CommonController
{
    public function index()
    {
        $condition = [];
        $title = $_GET['title'];
        if ($title) {
            $condition['title'] = $title;
        }
        if ($_GET['catid']) {
            $condition['catid'] = intval($_GET['catid']);
        }

        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 5;

        $news = D('News')->getNews($condition, $page, $pageSize);
        $conut = D('News')->getNewsCount($condition);
        $res = new \Think\Page($conut, $pageSize);
        $pagetRes = $res->show();
        $this->assign('pageRes', $pagetRes);
        $this->assign('news', $news);
        $this->assign('webSiteMenu', D('Menu')->getBarMenus());
        $this->display();
    }

    public function add()
    {
        if ($_POST) {
            if (!isset($_POST['title']) || !$_POST['title']) {
                return show(0, '标题不存在');
            }
            if (!isset($_POST['small_title']) || !$_POST['small_title']) {
                return show(0, '短标题不存在');
            }
            if (!isset($_POST['catid']) || !$_POST['catid']) {
                return show(0, '文章栏目不存在');
            }
            if (!isset($_POST['keywords']) || !$_POST['keywords']) {
                return show(0, '关键字不存在');
            }
            if (!isset($_POST['content']) || !$_POST['content']) {
                return show(0, '内容不存在');
            }
            $newsId = D("News")->insert($_POST);
            if ($newsId) {
                $newsContent['news_id'] = $newsId;
                $newsContent['content'] = $_POST['content'];
                $rs = D('NewsContent')->insert($newsContent);
                if ($rs) {
                    return show(1, '新增成功');
                } else {
                    return show(0, '内容插入失败');
                }
            } else {
                return show(0, '新增失败');
            }

        } else {
            $webSiteMenu = D('Menu')->getBarMenus();
            $titleFontColor = C('TITLE_FONT_COLOR');
            $copyFrom = C('COPY_FROM');//C 读取配置文件
            $this->assign('websiteMenu', $webSiteMenu);
            $this->assign('titleFontColor', $titleFontColor);
            $this->assign('copyFrom', $copyFrom);
            $this->display();
        }
    }
}