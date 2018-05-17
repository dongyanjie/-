<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use app\admin\model\Category as CategoryModel;
use think\Db;
class category extends Base
{
    /**
     * 分类管理 （分类列表）
     */
    public function index()
    {
//        $cate_list=Db::table('category')->order('id desc')->paginate(5);
//        dump(Db::table('x') ->getLastSql());
//        $test=$cate_list->render();

        $count=CategoryModel::Count(); //获取总记录数
        $cate_list=CategoryModel::order("id desc")->Paginate(5);//获取分页后数据
        $cate=CategoryModel::getCate();//获取分类信息

        //模版赋值
        $this->view->assign('count',$count);
        $this->view->assign('cate_list',$cate_list);
//        $this->view->assign('test',$test);
        $this->view->assign('cate',$cate);

        //模版渲染
        return $this->view->fetch('category_list');
    }

    /**
     * 添加数据
     */
    public function create(Request $request)
    {
        //设置默认返回的值
        $status=1;
        $message='添加成功';
      //添加数据到分类表中  数组
        $res=CategoryModel::create([
              'cate_name'=>$request->param('cate_name'),
              'pid'=>$request->param('pid')
          ]);
        //添加失败的处理
        if(is_null($res)){
            $status=0;
            $message='添加失败';
        }
        return ['status'=>$status,'message'=>$message,'res'=>$res->toJson()];
    }

    /**
     * @param Request $request
     * @return string  编辑
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function edit(Request $request)
    {
        //获取分类id
        $cate_id=$request->param('id');
        //查询要更新的数据
        $cate_now=CategoryModel::get($cate_id);
        //递归查询所有的分类信息
        $cate_level=CategoryModel::getCate();
        //模版赋值
        $this->view->assign('cate_now',$cate_now);
        $this->view->assign('cate_level',$cate_level);
        //模版渲染
        return $this->view->fetch('category_edit');
    }
    /**
     * @param Request $request
     * @return string  更新  Ajax方法
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function update(Request $request)
    {
        //获取提交的数据
        $data=$request->param();
        //更新操作
         $res=CategoryModel::update([
             'cate_name'=>$data['cate_name'],
             'cate_order'=>$data['cate_order'],
             'pid'=>$data['pid']
         ],['id'=>$data['id']]);
        //设置返回值
        $status=1;
        $message='更新成功！';
        //设置更新失败的返回值
        if(is_null($res)){
            $status=0;
            $message='更新失败！';
        }
        //返回结果
        return ['status'=>$status,'message'=>$message];
    }

    /**
     * @param $id
     * 删除操作
     */
    public function del($id)
    {
        //1.删除以当前id为父id的所有子分类
        CategoryModel::destroy(function ($query) use ($id){
            $query->where(['pid' => $id])->field('id');
        });
        //2.删除当前分类
        $result=CategoryModel::destroy($id);
        if ($result) {
            $status=1;
            $message='删除成功！';
        }else{
            $status=0;
            $message='删除失败！';

        }
        return ['status'=>$status,'message'=>$message];
    }
    /**
     * @param $id
     * 批量删除操作
     */
    public function delAll($arrId)
    {
        $arr=[];
        foreach ($arrId['id'] as $v) {
            $arr[] = [
                'id'    => $v,
            ];
        }
          //删除
       $this->del($arr);
    }
}
