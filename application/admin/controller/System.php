<?php

namespace app\admin\controller;

use app\admin\model\System as SystemModel;
use app\admin\common\Base;
use think\Request;

class System extends Base
{
    /*
    * 渲染模版
     */
    public function sys_set()
    {
        //2.模版赋值  ，配置信息--$this->getSystem()
         $this->view->assign('system',$this->getSystem());
        //3.渲染模版
        return $this->view->fetch('sys_set');
    }
    public function sys_link()
    {
        return $this->view->fetch('sys_link');
    }
    public function sys_qq()
     {
    return $this->view->fetch('sys_qq');
     }



    public function update(Request $request)
    {
      if($request->isAjax(true)){
           //获取提交的数据
          $date=$request->param();
          //设置更新条件
          $map=['is_update'=>$date['is_update']];
          //执行更新
         $res= SystemModel::update($date,$map);
         $status=1;
         $message='更新成功';

         if (is_null($res)){
             $status=0;
             $message='更新失败';
         }
      }
      return ['status'=>$status,'message'=>$message];
    }



}
