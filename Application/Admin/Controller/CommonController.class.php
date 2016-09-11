<?php
/**
 * Created by PhpStorm.
 * User: lhp
 * Date: 2016/9/11
 * Time: 19:40
 */
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    /**
     * 初始化
     */
    private function _init()
    {
        $isLogin = $this->isLogin();
        if (!$isLogin) {
            $this->redirect('/admin.php?c=login');
        }
    }

    /*
     * 获取登录的user信息
     */
    public function getLoginUser()
    {
        return session("adminUser");
    }

    /**
     * 判断是否登录
     * @return bool
     */
    public function isLogin()
    {
        $user = $this->getLoginUser();
        if ($user && is_array($user)) {
            return true;
        }
        return false;
    }
}