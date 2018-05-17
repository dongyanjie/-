<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use \app\admin\model\Admin as AdminModel;

class Admin extends Base
{

    public function index()
    {
//        1.读取admin管理员表的信息
        $admin=AdminModel::get(['username'=>'admin']);
//        2.将当前管理员的信息赋值给模版
        $this->view->assign('admin',$admin);  //assign方法 赋值
//        3.渲染模版
        return $this->view->fetch('admin_list');  //fetch渲染
    }

  public function edit(Request $request){

      $admin=AdminModel::get($request->param('id'));

      $this->view->assign('admin',$admin);  //assign方法 赋值
//      渲染
       return $this->view->fetch('admin_edit');
  }


    public function update(Request $request)
    {
        if ($request->isAjax(true)){
        //获取提交的数据，自动过滤空值
        $data = array_filter($request->param());
        //设置更新条件
        $map = ['is_update' => $data['is_update']];
        //更新用户表
        $res = AdminModel::update($data, $map);
        //更新成功的提示信息
        $status = 1;
        $message = '更新成功！';
        //如果更新失败
        if (is_null($res)) {
            $status = 0;
            $message = '更新失败！';
        }
    }
        return ['status'=>$status,'message'=>$message];
    }

}
