<?php
/**
 * Created by PhpStorm.
 * User: lhp
 * Date: 2016/9/11
 * Time: 16:05
 */
namespace Admin\Controller;

use \Think\Controller;

class MenuController extends CommonController
{
    public function index()
    {
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
            $menuId = D("Menu")->insert($_POST);
            if ($menuId) {
                return show(1, "添加成功", $menuId);
            }
            return show(0, "添加失败");
        } else {
            $this->display();
        }
    }

}