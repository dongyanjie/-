<?php
/**
 * Created by PhpStorm.
 * User: 董先生
 * Date: 2018/5/9
 * Time: 13:50
 */

namespace app\admin\common;
use app\admin\model\System;
use think\Controller;
use think\Request;
use think\Session;

class Base extends Controller
{
  //公共类可以定义一些常量 和常用方法
    protected function _initialize()
    {
        parent::_initialize();
        //在公共控制器的初始化方法中，创建一个常量用来判断用户是否登录或已登录
        define('USER_ID',Session::get('user_id'));

        $config=$this->getSystem();//获取网站配置信息
        $request=Request::instance();//获取当前请求对象
        $this->getStatus($request,$config);//查询当前网站开关状态

    }
   //判断是否登录
     protected function isLogin(){
        if(is_null(USER_ID)){
            $this->error('未登录，无权访问……','login/login');
        }
     }
    //如果以用户已经登录，将不允许登录
    protected function alreadyLogin(){
        if (!is_null(USER_ID)){
            $this->error('请不要重复登录……','index/index');
        }
    }

    //获取配置信息
     public function getSystem(){
        return System::get(1);
     }
    //判断当前网站前台的开启状态
//    $request请求对象 ，$config配置信息
    public function getStatus($request,$config){
        //判断是否是admin模块
       if($request->module()!=='admin'){
             //is_close判断是否关闭 0关闭 1开启
           if($config->is_close== 0){
               $this->error('网站已关闭！');
               exit();
           }
       }
    }
}