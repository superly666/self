<?php
#声明命名空间
namespace Admin\Controller;
#引入父类元素
use Think\Controller;
#声明并继承父类
class ProductController extends CommonController{

	#product列表方法
	/*public function product(){
		$model = M('Product');
		#查询
		#sql语句 : select t1.*,t2.category_name as category_name from tp_product as t1,tp_product_category as t2 where t1.category_id=t2.id;
		#连贯操作写法
		$data = $model -> field('t1.* , t2.category_name as category_name') 
						-> table('tp_product as t1 , tp_product_category as t2') 
						-> where('t1.category_id = t2.id') 
						-> select();
		//$data = $model -> select();
		//dump($data);
		//查询分类信息
		//$info = $model -> select();
		#传递变量给模版
		//$this -> assign('info',$info);
		$this -> assign('data',$data);
		#展示模版
 		$this -> display();
	}*/
public function product(){
		$keyword=$_POST['keyword'];
		if($keyword){
		//实例化模型				
	    $model = M('product');
		//执行模糊查询方法
		mysql_connect('localhost','root','root');
		mysql_select_db('db_dou');
		$data = $model 
				-> field('t1.* , t2.category_name as category_name') 
				-> alias('t1') 
				-> join('left join tp_product_category as t2 on t1.category_id = t2.id') 
				-> where("t1.product_name like '%$keyword%'")
				-> select();
		$count = $model -> count();
		//dump($data);die;
        //传给模板
        $this -> assign('count',$count);
		$this -> assign('data',$data);
		#展示模版
 	    $this -> display();
	}else{
		$model = M('product');
		#查询
		$data = $model -> select();
		#传递变量给模版
		//$this -> assign('data',$data);
		#展示模版
 		//$this -> display();
        $count = $model -> count();
		#2、实例化分页类,传递总的记录数，每页显示2个记录
		$page = new \Think\Page($count,2);
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
		#查询
		#sql语句 : select t1.*,t2.category_name as category_name from tp_product as t1,tp_product_category as t2 where t1.category_id=t2.id;
		#连贯操作写法
		$data = $model -> field('t1.* , t2.category_name as category_name') 
						-> table('tp_product as t1 , tp_product_category as t2') 
						-> where('t1.category_id = t2.id') 
						-> limit($page -> firstRow,$page -> listRows)
						-> select();
		//dump($data);die;
		#5、数据变量的分配
		#传递给模版
		//$this -> assign('data',$data);
		$this -> assign('show',$show);
		$this -> assign('data',$data);
		$this -> assign('count',$count);
		#6、展示模版
		$this -> display();
	}
}
	//商品分类列表
	public function Product_category(){
		$model = M('product_category');
		#查询
		$data = $model -> select();
		//dump($data);
		#传递变量给模版
		$this -> assign('data',$data);
		#展示模版
 		$this -> display();
	}	
	//addproduct添加方法
	public function addproduct(){
		//实例化模型
		$model = M('product_category');
		//查询部门信息
		$data = $model-> select();
		//传递给模板
		$this -> assign('data',$data);
		//dump($data);
		#展示模版
		$this -> display();
	}
	public function addOk(){
		#接收数据
		$post = I('post.');
		$post['product_name'];
		$post['content'];
		$post['category_id'];
		$post['addtime'] = date('Y-m-d H:i:s',time());
		#写入数据表
		//dump ($post);die;
		$model = M('product');
		$rst = $model -> add($post);
		#判断返回值
		if($rst){
			#成功
			$this -> success('添加商品成功',U('product'),3);
		}else{
			#失败
			$this -> error('添加商品失败',U('addproduct'),3);
		}
	}
	//del删除方法
	public function del(){
		#接收参数
		$ids = I('get.ids');
		#实例化模型
		$model = M('product');
		#删除操作
		$rst = $model -> delete($ids); 
		#判断返回值
		if($rst){
			#删除成功
			$this -> success('删除成功',U('product'),3);
		}else{
			#删除失败
			$this -> error('删除失败',U('product'),3);
		}
	}
	//edit编辑方法
	public function edit(){
		//获取id
		$id = I('get.id');
		//查询原有的数据
		$model = M('product');
		//查询
		//sql : select t1.*,t2.category_name as category_name,t2.category_describe as category_describe from tp_product as t1 LEFT JOIN tp_product_category as t2 on t1.category_id=t2.id;
		$data = $model 
					-> field('t1.* , t2.category_name as category_name,t2.category_describe as category_describe')
					-> alias('t1') 
					-> join('LEFT JOIN tp_product_category as t2 on t1.category_id=t2.id') 
					->where("t1.id=".$id)
					-> find();
		//dump($data);
		$info = $model
					-> field('t1.* , t2.category_name as category_name,t2.category_describe as category_describe')
					-> alias('t1') 
					-> join('LEFT JOIN tp_product_category as t2 on t1.category_id=t2.id') 
					->select();
		//dump($info);
		//传递给模板
		$this -> assign('data',$data);
		$this -> assign('info',$info);
		//展示模板
		$this -> display();
	}
	//editOk保存数据方法
	public function editOk(){
		//接收数据
		$post = I('post.');  
		//添加数据
      	$post['addtime'] = time();
		//dump($post);
		//实例化
		$model = M('Product');
		//dump($model);
		//写入
        $rst = $model->save($post);
		//dump($rst);die;
		//判断结果
		if ($rst) {
			# code...修改成功
			$this -> success('修改成功!',U('product'),3);
		} else {
			# code...修改失败
			$this -> error('修改失败!',U('edit',array('id' => $post['id'])),3);
		}		
	}

}


