<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use app\admin\model\Banner as BannerModel;
use think\Session;

class banner extends Base
{

    public function index()
    {
       $banner= BannerModel::all(); //获取所有数据
        $count=BannerModel::count();  //获取记录数
        //赋值
        $this->view->assign('banner',$banner);
        $this->view->assign('count',$count);

       return $this->view->fetch('banner_list');  //渲染banner_list模版
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        return $this->view->fetch('banner_add');  //渲染模版
    }

    /**
     * 保存新增加的资源
     *  banner添加为   -- 原生提交
     * @return \think\Response
     */
    public function save()
    {
//判断提交类型
        if($this->request->isPost()){
// 1.获取提交的数据，参数为true意思是包括上传文件
      $data=$this->request->param(true);
//2.获取上传的文件对象
      $file=$this->request->file('image');
//3.判断是否取到了文件
      if(empty($file)){
          $this->error($file->getError());
      }
//4.上传文件
      $map=[
          'ext'=>'jpg,png,jpeg',
          'size'=>3000000
      ];
      $info=$file->validate($map)->move(ROOT_PATH.'public/uploads');
//5.向表中新增数据
      $data['image']=$info->getSaveName();
      $res=BannerModel::create($data);
//6.判断新增是否成功
    if(is_null($res)){
        $this->error('新增失败');
    }
        $this->success('新增成功！');

        }else{
            $this->error('请求类型错误~~~');
        }
    }

    /**
     * 显示编辑资源表单页.
     * @return \think\Response
     */
    public function edit($id)
    {
//        1.获取数据
        $data=BannerModel::get($id);
//       2.赋值
        $this->assign('data',$data);
//        渲染模版
        return $this->view->fetch('banner_edit');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        if($this->request->isPost()){
           $data= $this->request->param(true);  //设置为true 获取全部信息 包括文件
           $file=$this->request->file('image');   //获取上传的文件对象
           if(empty($file)){
               $this->error($file->getError());
           }
           //验证文件上传
          $map=[
          'ext'=>'img,png,jpeg',
          'size'=>3000000
               ];
           $info=$file->validate($map)->move(ROOT_PATH.'public/uploads');
          if(is_null($info)){
              $this->error($info->getError());
          }
          //上传文件
              $data['image']=$info->getSaveName();
  //                  第一个参数更新字段，第二个参数更新条件
           $res= BannerModel::update([
                  'image'=>$data['image'],
                   'link'=>$data['link'],
                   'desc'=>$data['desc']
              ],['id'=>$data['id']]);
  //       检测更新
            if(is_null($res)){
                $this->error('更新失败！');
            }
            $this->success('更新成功~~');
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function del($id)
    {
          BannerModel::destroy($id);

    }
}
