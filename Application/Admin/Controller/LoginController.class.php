<?php
/**
 * Created by PhpStorm.
 * User: lhp
 * Date: 2016/9/11
 * Time: 12:10
 */
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function index()
    {
        if(session('adminUser')){
            $this->redirect('/admin.php?c=index');
        }
        return $this->display();
    }

    public function check()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (!trim($username)) {
            show(0, '用户名不能为空');
        }
        if (!trim($password)) {
            show(0, '密码不能为空');
        }
        $rs = D('Admin')->getAdminByUsername($username);
        if (!$rs) {
            show(0, '该用户不存在');
        }
        if ($rs['password'] != getMd5Password($password)) {
            show(0, '密码不正确');
        }
        session('adminUser', $rs);
        return show(1, '登录成功');
    }

    public function loginout()
    {
        session('adminUser', null);
        $this->redirect('/admin.php?c=login');
    }
}