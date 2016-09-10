<?php
//声明命名空间
namespace Admin\Controller;
//引入父类元素
use Think\Controller;
//声明并继承父类
class UserController extends CommonController{
    //index方法
    public function showList(){
        //实例化模型
        $model = M('User');
        //查询数据
        $data = $model->select();
        //dump($data);
        //传递给模板
        $this -> assign('data',$data);
        //展示模板
        $this->display();
    } 
    //add方法
    public function add(){
        //展示模板
        $this->display();
    }
    //addOk方法
    public function addOk(){
        //接收数据
        $post = I('post.');
        //添加addtime字段的值
        //$post['addtime'] = time()
        $post['addtime']= date('Y-m-d H:i:s',time());
        //dump($post);die;
        $model = M('User');
        //数据对象的创建
        //$model -> create(); 
        //dump($data);die();
        //入库操作
        $rst = $model -> add($post);
        #针对写入返回结果
        if ($rst){
            //写入成功
            $this -> success('添加成功!!',U('showList'),3);
        }else{
            #写入失败
            $this -> error('添加失败!!',U('add'),3);
        }
    }
    //dele方法
   public function dele(){
       //接收参数
       $id = I('get.id');       
       //实例化模型
       $model = M('User');
       //删除操作
       $rst = $model -> delete($id);
       //dump($rst);die;
       //判断返回值
       if ($rst){
           //删除成功
           $this -> success('删除成功!',U('showList'),3);
       }else{
           //删除失败
           $this -> error('删除失败!',U('showList'),3);
       }
   }
    //edit方法
    public function edit(){
      //获取id
      $id = I('get.id');
      //查询原有数据,实例化
      $model = M('User');
      //查询
      $data = $model->find($id);
      //dump($data);die;
      //传递给模板
      $this -> assign('data',$data);
      //展示模板
      $this -> display();
    }
    //editOk方法
    public function editOk(){
      //接收数据
      $post = I('post.');
      //dump($post);die;
      //添加数据
      $post['addtime'] = time();
      $post['last_login_time'] = time();      
      //dump($post);
      //实例化
      $model = M('User');
      //写入      
      $rst = $model -> save($post);
      //dump($rst);die;
      //判断结果
      if ($rst) {
        # code...成功
        $this -> success('修改成功!',U('showList'),3);
      } else {
        # code...失败
        $this -> error('修改失败!',U('edit',array('id' => $post['id'])),3);
      }
      
    }
    
    
    
}