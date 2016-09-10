<?php

namespace Admin\Controller;
use Think\Controller;

class DocController extends CommonController{

	public function show(){
     
     $model = M('Doc');
     //查询总记录数
     $count = $model -> count();
     //实例化分页类，传递总的记录数，每页显示记录个数
     $page = new \Think\Page($count,1);
     $page -> rollPage = 3;
     //让最后一页不显示数字
       $page -> lastSuffix = false;
       $page -> setConfig('prev','上一页');
       $page -> setConfig('next','下一页');
       $page -> setConfig('first','首页');
       $page -> setConfig('last','末页');
    #3、组装页码的地址
      $show = $page -> show();
      $data = $model -> limit($page -> firstRow,$page -> listRows) -> select();
     //dump($data);
     $this -> assign('show',$show);
     $this -> assign('count',$count);
     $this -> assign('data',$data);
     $this -> display();
	}
	public function addok(){
	$post = I('post.');
	 $file = $_FILES['file'];
     //配置上传信息
     $cfg = array(
        //保存根路径
        'rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH,
     	);
     //实例化上传类
     $upload = new \Think\Upload($cfg);
     if($file['size']>0){
     	//上传操作
     	 $info = $upload -> uploadOne($file);
     	 if($info){
     	 	$post['filename'] = $info['savename'];
     	 	$post['filepath'] = "<html><img width=300 height=200 src=".UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename']."></html>";
     	 }
     }
	$post['addtime']  = date('Y-m-d H:i:s',time());
    //dump($post);
    $model = M('Doc');
    $src = $model -> add($post);
    if ($src) {
    	$this -> success('添加成功',U('Doc/show'),3);
    }else{
    	$this -> error('添加失败',U('Doc/show
        '),3);
    }
  }
  public function editshow(){
  	$id = I('get.id');
  	$model = M('Doc');
  	//查询总记录数
     $count = $model -> count();
     //实例化分页类，传递总的记录数，每页显示记录个数
     $page = new \Think\Page($count,1);
     $page -> rollPage = 3;
     //让最后一页不显示数字
       $page -> lastSuffix = false;
       $page -> setConfig('prev','上一页');
       $page -> setConfig('next','下一页');
       $page -> setConfig('first','首页');
       $page -> setConfig('last','末页');
    #3、组装页码的地址
      $show = $page -> show();
      $data = $model -> limit($page -> firstRow,$page -> listRows) -> select();
  	$onedata = $model -> find($id);
  	$this -> assign('show',$show);
  	$this -> assign('data',$data);
  	$this -> assign('onedata',$onedata);
  	$this -> display();
  }
  public function editok(){
  	$post = I('post.');

  	$file = $_FILES['file'];
     //配置上传信息
     $cfg = array(
        //保存根路径
        'rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH,
     	);
     //实例化上传类
     $upload = new \Think\Upload($cfg);
     if($file['size']>0){
     	//上传操作
     	 $info = $upload -> uploadOne($file);
     	 if($info){
     	 	$post['filename'] = $info['savename'];
     	 	$post['filepath'] = "<html><img width=300 height=200 src=".UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename']."></html>";
     	 }
     }
	$post['addtime']  = date('Y-m-d H:i:s',time());
    //dump($post);die;
    $model = M('Doc');
    $src = $model -> save($post);
    if ($src) {
    	$this -> success('修改成功',U('Doc/show'),3);
    }else{
    	$this -> error('修改失败',U('Doc/show'),3);
    }
  }
  public function delshow(){
  	$id = I('get.id');
  	$model = M('Doc');
  	$rec = $model -> delete($id);
  	 if ($rec) {
    	$this -> success('删除成功',U('Doc/show'),3);
    }else{
    	$this -> error('删除失败',U('Doc/show'),3);
    }
  }
  public function getContent(){
  	$id = I('get.id');                   
   	$model = M('Doc');
   	$data = $model -> find($id);
   	//echo "<html><img src=".$data['filepath']."></html>"
   	echo htmlspecialchars_decode($data['filepath']);
  }
}