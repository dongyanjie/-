<?php

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    //获取器格式  get（字段名）Attr（）
    //创建修改器方法md5 密码
    public function setPasswordAttr($val){
        return md5($val);
    }
    //创建获取器方法，用来实现时间的转换
    public function getLastTimeAttr($val){
        return date('Y-m-d H:i:s',$val);
    }

}
