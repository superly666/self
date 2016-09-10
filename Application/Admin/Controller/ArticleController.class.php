<?php
//声明命名空间
namespace Admin\Controller;
//引入父类元素
use Think\Controller;
//声明并继承父类
class ArticleController extends CommonController{
	//article列表方法
	public function article(){
			$keyword=$_POST['keyword'];
			if($keyword){
			//实例化模型				
		    $model = M('article');
			//执行模糊查询方法
			mysql_connect('localhost','root','root');
			mysql_select_db('db_dou');
			//$data['keydord'] = array('like',"%$keyword%");
			//$sql = "select * from tp_article where article_name like '%$keyword%'";
			//$info = $model->query($sql,true);
			$info = $model 
				-> field('t1.* , t2.category_name as category_name') 
				-> alias('t1') 
				-> join('left join tp_article_category as t2 on t1.category_id = t2.id') 
				-> where("t1.article_name like '%$keyword%'")
				-> select();
			//dump($info);
			$count = $model -> count();
	        //传给模板
			$this -> assign('info',$info);
			$this -> assign('count',$count);
			#展示模版
	 	    $this -> display();
		}else{
		//实例化模型
		$model = M('article');
		//dump($data);die();
        $count = $model -> count();
		#2、实例化分页类,传递总的记录数，每页显示1个记录
		$page = new \Think\Page($count,4);
		#可选步骤：定义按钮提示文字
		//每页显示的页码数，如果需要显示出首页/末页，则要求这个页码数必须要小于分页的总的页码数
		$page -> rollPage = 3;
		#让最后一页不显示数字
		$page -> lastSuffix = false;
		$page -> setConfig('prev','上一页');
		$page -> setConfig('next','下一页');
		$page -> setConfig('first','首页');
		$page -> setConfig('last','末页');
		#3、组装页码的地址
		$show = $page -> show();
		//dump($show);die;
		#4、通过limit方法限制输出的记录数
		//查询
		//SQL语句:select t1.* , t2.category_name as category_name from tp_article as t1 left join tp_article_category as t2 on t1.category_id = t2.id;
		$info = $model 
		-> field('t1.* , t2.category_name as category_name') 
		-> alias('t1') 
		-> join('left join tp_article_category as t2 on t1.category_id = t2.id') 
		-> limit($page -> firstRow,$page -> listRows)
		-> select();
		//dump($info);
		#5、数据变量的分配
		//传递给模板
		$this -> assign('info',$info);
		$this -> assign('show',$show);
		$this -> assign('count',$count);		
		//展示模板
		$this -> display();
		}
	}
	//分类列表
    public function Article_category(){
		$model = M('article_category');
		#查询
		$data = $model -> select();
		//dump($data);
		#传递变量给模版
		$this -> assign('data',$data);
		#展示模版
 		$this -> display();
    }
	public function del(){
			#接收参数
			$ids = I('get.ids');
			#实例化模型
			$model = M('article');
			#删除操作
			$rst = $model -> delete($ids);
			#判断返回值
			if($rst){
				#删除成功
				$this -> success('删除成功',U('article'),3);
			}else{
				#删除失败
				$this -> error('删除失败',U('article'),3);
			}
		}	
	//add添加
    public function addarticle(){
    	//实例化模型
    	$model = M('article_category');
    	//查询部门信息
    	$data = $model->select();
    	//dump($data);
    	//传递给模板
    	$this->assign('data',$data);
    	$this->display();
    }
    public function addarticleOk(){
		#接收数据
		$post = I('post.');
		$post['article_name'];
		$post['content'];
		$post['artice_id'];
		$post['addtime'] = date('Y-m-d H:i:s',time());
		#写入数据表
		//dump ($post);die;
		$model = M('article');
		$rst = $model -> add($post);
		#判断返回值
		if($rst){
			#成功
			$this -> success('添加文章成功',U('article'),3);
		}else{
			#失败
			$this -> error('添加文章失败',U('addarticle'),3);
		}
	}	
	//edit编辑方法
	public function edit(){
		//获取id
		$id = I('get.id');
		//实例化模型
		$model = M('article');
		//查询
		//sql语句 : select t1.* ,t2.category_name as category_name , t2.category_describe as category_describe from tp_article as t1 left join tp_article_category as t2 on t1.category_id = t2.id;
		$data = $model 
			-> field(' t1.* ,t2.category_name as category_name , t2.category_describe as category_describe') 
			->alias('t1') 
			->join('left join tp_article_category as t2 on t1.category_id = t2.id') 
			-> where('t1.id='.$id)
			-> select();
		$info = $model 
			-> field(' t1.* ,t2.category_name as category_name , t2.category_describe as category_describe') 
			->alias('t1') 
			->join('left join tp_article_category as t2 on t1.category_id = t2.id') 
			-> select();
		//遍历data
		foreach ($data as $key => $value) {
			
		}
		// dump($value);
		// echo "<hr />";
		// dump($info);
		//传递给模板
		$this -> assign('info',$info);
		$this -> assign('value',$value);
		//展示模板
		$this -> display();
	}
	//editOk方法
	public function editOk(){
		//接收数据
		$post = I('post.');
		//添加数据
		$post['addtime'] = time();
		//dump($post);
		//实例化
		$model = M('Article');
		//写入
		$rs = $model -> save($post);
		//dump($rs);
		//判断
		if ($rs) {
			# code...成功
			$this -> success('修改成功!',U('article'),3);
		} else {
			# code...失败
			$this -> error('修改失败!',U('edit',array('id' => $post['id'])),3);
		}
		
	}

}
