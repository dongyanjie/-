<?php

namespace app\admin\model;

use think\Model;
use app\admin\model\Category;
class Article extends Model
{
    //模型的插入自动完成
    protected $insert=[
        'look_size'=>0
    ];
    //创建获取器方法，用来实现时间的转换
    public function getLastTimeAttr($val){
        return date('Y-m-d H:i:s',$val);
    }

}
