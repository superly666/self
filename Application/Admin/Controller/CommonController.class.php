<?php
//声明命名空间
namespace Admin\Controller;
//引入父类元素
use Think\Controller;
//声明并且继承父类
class CommonController extends Controller{
	//构造方法判断用户是否登录
	public function __construct(){
		parent::__construct();//实例化父类中的构造方法
		//判断用户的session信息 , 可以直接判断用户的uid信息
		$uid = session('uid');
		if (empty($uid)) {	//empty方法的参数不能是函数的返回值
			#判断代码,如果用户没有登录 ,则回到登录页面
			$this -> error('您没有登录,请先登录',U('Public/login'),3);exit;
			//下面是写有画中画格式的那种处理
			// $url = U('Public/login');
			// $script = "<script>top.location.href='$url';</script>";
			// echo $script;exit;
		}
		#获取当前访问的控制器名和方法名
		$controller = strtolower(CONTROLLER_NAME);
		$action = strtolower(ACTION_NAME);
		//echo $controller . '/' . $action;
		#获取权限的数组
		$auths = C('RBAC_ROLES_AUTHS'); 
		//dump($auths);
		#获取当前用户的权限信息
		$auth = $auths[session('role_id')];
		//dump($auth);
		//判断是否有权限
		if(session('role_id') != 1){
			if(!in_array($controller . '/' . $action,$auth) && !in_array($controller . '/*',$auth)){
				$this -> error('您没有操作权限!',U('Index/index'),3);exit;
			}
		}
	}
	// //在ThinkPHP中还支持另外一种构造方法
	// public function _initialize(){

	// }
}
