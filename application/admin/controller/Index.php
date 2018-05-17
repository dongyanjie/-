<?php
namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use app\admin\model\Article as AdminModel;
class Index extends Base
{
    public function index()
    {
        $this->isLogin(); //判断是否登录
        return $this->view->fetch('index');//方法渲染index.html模版
    }
    public function welcome(Request $request)
    {
        return $this->view->fetch('welcome');//方法渲染welcome.html模版
    }
}
