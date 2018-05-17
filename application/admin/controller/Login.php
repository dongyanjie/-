<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use \app\admin\model\Admin;
use think\Session;

class Login extends Base

{
    /**
     *渲染登录界面
     */
    public function login()
    {
        $this->alreadyLogin(); //如果以用户已经登录，将不允许登录
    return $this->view->fetch('login');
    }

    /**
     * 验证用户身份
     */
    public function check(Request $request)
    {
        $status=0;
        //获取表单提交的数据，并保存在变量中
          $data=$request->param();
           $userName=$data['username'];
           $passWord=md5($data['password']);
        //在admin表中查询：以用户为条件
           $map=['username'=>$userName];
         $admin= Admin::get($map);
        //将用户名与密码分开验证
        //如果没有查询到该用户
         if(is_null($admin)){
             $message='用户名不正确';
         }elseif ($admin->password!=$passWord){
             $message='密码不正确';
         }else{
             //如果登录成功，表明是合法用户
             $status=1;
             $message='验证通过，请点击确定进入后台';
             //更新表中登录次数和最后登录时间
             $admin->setInc('login_count'); //setInc方法 自增某一个字段
             $admin->save(['last_time'=>time()]);//保存时间戳
             //将用户登录的信息保存到session中，供其他控制器进行登录判断
             Session::set('user_id',$userName);
             Session::set('user_info',$data);
         }
        return ['status'=>$status,'message'=>$message];
    }

    /**
     *退出登录
     */
    public function logout()
    {
        //删除当前用户信息
        Session::delete('user_id');
        Session::delete('user_info');

        $this->success('注销成功，正在返回……','Login/login');
    }



}
