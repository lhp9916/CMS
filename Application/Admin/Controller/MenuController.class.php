<?php
/**
 * Created by PhpStorm.
 * User: lhp
 * Date: 2016/9/11
 * Time: 16:05
 */
namespace Admin\Controller;

use \Think\Controller;
use Think\Exception;
use Think\Page;

class MenuController extends CommonController
{
    public function index()
    {
        $data = array();//筛选条件
        if (isset($_REQUEST['type']) && in_array($_REQUEST['type'], [0, 1])) {
            $data['type'] = intval($_REQUEST['type']);
            $this->assign('type', $data['type']);
        } else {
            $this->assign('type', -1);
        }
        //分页操作逻辑
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3;
        $menus = D("Menu")->getMenus($data, $page, $pageSize);
        $menusCount = D("Menu")->getMenusCount($data);
        //使用think自带的分页工具
        $res = new Page($menusCount, $pageSize);
        $pageRes = $res->show();
        $this->assign("pageRes", $pageRes);//分配数据到模板
        $this->assign('menus', $menus);
        $this->display();
    }

    //添加菜单
    public function add()
    {
        if ($_POST) {
            //有post数据过来时，执行添加操作
            if (!isset($_POST['name']) || !$_POST['name']) {
                return show(0, '菜单名不能为空');
            }
            if (!isset($_POST['m']) || !$_POST['m']) {
                return show(0, '模块名不能为空');
            }
            if (!isset($_POST['c']) || !$_POST['c']) {
                return show(0, '控制器名不能为空');
            }
            if (!isset($_POST['f']) || !$_POST['f']) {
                return show(0, '方法名不能为空');
            }
            if ($_POST['menu_id']) {
                return $this->save($_POST);
            }
            $menuId = D("Menu")->insert($_POST);
            if ($menuId) {
                return show(1, "添加成功", $menuId);
            }
            return show(0, "添加失败");
        } else {
            $this->display();
        }
    }

    //编辑
    public function edit()
    {
        $menu_id = $_GET['id'];
        $menu = D("Menu")->find($menu_id);
        $this->assign('menu', $menu);
        $this->display();
    }

    public function save($data)
    {
        $menu_id = $data['menu_id'];
        unset($data['menu_id']);
        try {
            $id = D("Menu")->updateById($menu_id, $data);
            if ($id === false) {
                return show(0, "更新失败");
            }
            return show(1, '更新成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    //删除 改变状态
    public function setStatus()
    {
        if ($_POST) {
            $id = $_POST['id'];
            $status = $_POST['status'];
            try {
                $res = D('Menu')->updateStatusById($id, $status);
                if ($res) {
                    return show(1, '操作成功');
                } else {
                    return show(0, '更新失败');
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        }
        return show(0, '没有提交数据');
    }
}