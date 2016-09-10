<?php 
namespace Admin\Controller;
use Think\Controller; 

class PublicController extends Controller{
	public function login(){
  //判断邮箱是否激活
		$this -> display();
	}
	//验证码
	public function captcha(){
		$cfg = array(
        'fontSize'  =>  10,              // 验证码字体大小(px)
        'useCurve'  =>  true,            // 是否画混淆曲线
        'useNoise'  =>  true,            // 是否添加杂点  
        'imageH'    =>  40,               // 验证码图片高度
        'imageW'    =>  75,               // 验证码图片宽度
        'length'    =>  4,               // 验证码位数
        'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
      );
		$verify = new \Think\Verify($cfg);
		$verify ->entry();
	}
	//登录验证码验证
	public function check(){
		$post = I('post.');   
		$verify = new \Think\Verify();
		$rst = $verify ->check($post['captcha']);   
    //判断验证码     
        if($rst){
           $model = M('User');
           unset($post['captcha']);
           $data = $model ->where($post) -> find();
           $active = $data['active'];
           //dump($active);
           //dump($data);
           //判断用户名密码是否正确
           if ($data) {
              //判断是否激活
               if ($active == 1) {
                # code...判断已经激活
                session('role_id',$data['role_id']);
                session('uid',$data['id']);
                session('uname',$data['username']);
                $this -> success('登陆成功',U('Index/index'),3);
                $data['last_login_time']= date('Y-m-d H:i:s',time());
                $model -> save($data);                
              } else {
                # code...没有激活
                $this -> error("用户邮箱没有激活!请点击下方按钮进行邮箱登录!激活!!<br /><a href='http://mail.163.com/'>【邮箱链接】</a>",U('Public/login'),10);
              }
           }else{
           	$this -> error('用户名或密码错误！',U('login'),3);
           }
        }else{
        	$this -> error('验证码错误！',U('login'),3);
        }
	}
	//退出
	public function logout(){
		session(null);
		if (!session('?uname')) {			
			$this -> success('退出成功',U('login'),3);
		}
	}
  //注册,短信,激活邮箱验证
    public function register(){
		if(IS_POST) {
		  //接收输入的手机验证码
		  $checkcode = $_POST['checkcode'];
		  session_start();
		  $code = $_SESSION['code'];
		  //判断验证码
		  if($code==$checkcode){
		      $post = I('post.');
		  	  $post['salt'] = md5(time());   
		      $post['addtime'] = date('Y-m-d H:i:s',time());
          $mail = $post['email'];
          $salt = $post['salt'];
          //dump($post);die;
		      $model = M('User');
		      $rs = $model -> add($post);
          //dump($rs);die;
		      //注册用户,给数据表添加数据
		      if ($rs) {
				    # code...注册成功,发送激活邮件
            $sendRs = sendMail("php49开发产品激活邮件","<a href='http://localhost/CMS/index.php/Admin/Public/active/id/$rs/salt/$salt'>您好$username,请点击链接进行用户的激活操作</a>",$mail);
            //dump($sendRs);
  				  //判断是否激活
  				  if ($sendRs === true) {
  						# code...注册成功发送并邮件成功
  						$this -> success('注册成功,请到邮箱激活用户!!',U('Public/login'),3);
  					} else {
  						# code...注册成功,发送不成功
  						$this -> error('注册成功,发送邮件不成功!!',U('Public/register'),3);
  					}
		      }else{
		        $this -> error('注册失败',U('Public/register'),3);
		      }
		  }else{
		  		//验证码不正确
		        $this -> error('验证码错误！',U('Public/register'),3);
		  }
		}else{  
		    $this -> display();
		}
  }
/**
  * 发送模板短信
  * @param to 手机号码集合,用英文逗号分开
  * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
  * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
  */
function sendTemplateSMS($to,$datas,$tempId,$accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion)
{
     // 初始化REST SDK
     //global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
     $rest = new \REST($serverIP,$serverPort,$softVersion);
     $rest->setAccount($accountSid,$accountToken);
     $rest->setAppId($appId);

     // 发送模板短信
    // echo "Sending TemplateSMS to $to <br/>";
     $result = $rest->sendTemplateSMS($to,$datas,$tempId);
     if($result == NULL ) {
        return false;
     }
     if($result->statusCode!=0) {
         return false;
         //TODO 添加错误处理逻辑
     }else{
         return true;
         //TODO 添加成功处理逻辑
     }
}
  public function send(){
    //要生成手机验证码，并且存储到session里面
  session_start();
  //随机验证码
  $code = rand(100000,999999);
  $_SESSION['code']=$code;
  //include_once("./CCPRestSmsSDK.php");
  import('Vendor.sms.REST');
  //主帐号,对应开官网发者主账号下的 ACCOUNT SID
  $accountSid= '8a216da856c131340156d62a1b871318';
  //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
  $accountToken= '249ba9da81ab4858b7412de010030d9a';
  //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
  //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
  $appId='8a216da856c131340156d62a1c15131f';  //请求地址
  //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
  //生产环境（用户应用上线使用）：app.cloopen.com
  $serverIP='sandboxapp.cloopen.com';
  //请求端口，生产环境和沙盒环境一致
  $serverPort='8883';
  //REST版本号，在官网文档REST介绍中获得。
  $softVersion='2013-12-26';
  //Demo调用
    //**************************************举例说明***********************************************************************
    //*假设您用测试Demo的APP ID，则需使用默认模板ID 1，发送手机号是13800000000，传入参数为6532和5，则调用方式为           *
    //*result = sendTemplateSMS("13800000000" ,array('6532','5'),"1");                                      *
    //*则13800000000手机号收到的短信内容是：【云通讯】您使用的是云通讯短信模板，您的验证码是6532，请于5分钟内正确输入     *
    //*********************************************************************************************************************
  //获取传递手机号码
  $telphone = $_GET['telphone'];
  $res = $this -> sendTemplateSMS($telphone,array($code,1),"1",$accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion);//手机号码，替换内容数组，模板ID
  // var_dump($res);
    if($res){
        echo 1;
    }else{
        echo 0;
    }
  }
	//激活用户方法
	public function active(){
		$id = I('get.id');
		$salt = I('get.salt');
		//修改激活用户操作,修改active字段为1
		$rs = M('User')->where("id = $id AND salt='$salt'")->setField('active',1);
		//判断是否修改成功
		if ($rs) {
			# code...
			$this -> success('激活用户成功,请您登陆~~~O(∩_∩)O~',U('Public/login'),3);
		} else {
			# code...
			$this -> error('激活失败,非法激活,不然报警!',U('Public/register'),3);
		}
		
	}






}