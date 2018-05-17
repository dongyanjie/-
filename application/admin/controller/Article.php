<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use think\Session;
use app\admin\model\Article as ArticleModel;
use app\admin\model\Category as CategoryModel;

class article extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //获取所有数据  获取总记录数
        $article=ArticleModel::all();
        $count=ArticleModel::count();

        $cate_name=CategoryModel::all();  //分类
        $name=Session::get('user_id'); //发布人
        //赋值
        $this->assign('article',$article);
        $this->assign('count',$count);
        $this->view->assign('name',$name);
        $this->view->assign('cate_name',$cate_name);
        //渲染
       return $this->view->fetch('article_list');
    }
    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function add()
    {
        $name=Session::get('user_id'); //发布人
        $cate_name=CategoryModel::all();  //分类
        //$cate_name=Db::table('category ')->column('cate_name');
        $this->view->assign('name',$name);
        $this->view->assign('cate_name',$cate_name);

        return $this->view->fetch('article_add');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(Request $request)
    {
        $status=1;
        $message='添加成功';
        $res=ArticleModel::create([
            'title'=>$request->param('title'),
            'content'=>$request->param('content'),
            'fuser'=>$request->param('fuser'),
            'last_time'=>time(),
            'pid'=>$request->param('pid'),
        ]);
        //添加失败的处理
        if(is_null($res)){
            $status=0;
            $message='添加失败';
        }
        return ['status'=>$status,'message'=>$message,'res'=>$res->toJson()];

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $data=ArticleModel::get($id);  //获取
        $cate_name=CategoryModel::all();  //分类

        $this->view->assign('data',$data);//赋值
        $this->view->assign('cate_name',$cate_name);//赋值

        return $this->view->fetch('article_edit');//渲染
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
        $status=1;
        $message='修改成功';

         $data=$request->param();//获取提交的数据
        $res=ArticleModel::update([
           'title'=>$data['title'],
           'content'=>$data['content'],
           'last_time'=>time(),
            'pid'=>$data['pid']
        ],['id'=>$data['id']]);

        if (is_null($res)){
            $status=0;
            $message='添加失败';
        }
        return ['status'=>$status,'message'=>$message];
    }
    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function del($id)
    {
        ArticleModel::destroy($id);
    }



}
