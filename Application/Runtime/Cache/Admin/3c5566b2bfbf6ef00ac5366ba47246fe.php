<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/self/Public/Admin/css/base.css" />
	<link rel="stylesheet" href="/self/Public/Admin/css/login.css" />
	<title>Douphp管理中心</title>
</head>
<body>
<form action="<?php echo U('check');?>" method="post">
	<div id="container">
		<div id="bd">
			<div class="login1">
            	<div class="login-top"><h1 class="logo"></h1></div>
                <div class="login-input">
                	<p class="user ue-clear">
                    	<label>用户名</label>
                        <input type="text" name="username" />
                    </p>
                    <p class="password ue-clear">
                    	<label>密&nbsp;&nbsp;&nbsp;码</label>
                        <input type="password" name="password" />
                    </p>
                    <p class="yzm ue-clear">
                    	<label>验证码</label>
                        <input type="text" name="captcha" maxlength="4" />
                        <cite><img src="/self/index.php/Admin/Public/captcha" onclick="this.src='/self/index.php/Admin/Public/captcha/t'+Math.random()"></cite>
                    </p>
                </div>
                <div class="login-btn ue-clear">
                	<a href="javascript:;" class="btn">登录</a>
                    <div class="remember ue-clear">
                    	<input type="checkbox" id="remember" />
                        <em></em>
                        <label for="remember">记住密码</label>
                    </div>
                </div>
                <a href="<?php echo U('public/register');?>" class="yzm ue-clear">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;没有账号？现在去注册！！</a>
            </div>
		</div>
	</div>
    <div id="ft">CopyRight&nbsp;2014&nbsp;&nbsp;版权所有&nbsp;&nbsp;uimaker.com专注php设计&nbsp;&nbsp;苏ICP备09003079号</div>
    </form>
</body>
<script type="text/javascript" src="/self/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/self/Public/Admin/js/common.js"></script>
<script type="text/javascript">
var height = $(window).height();
$("#container").height(height);
$("#bd").css("padding-top",height/2 - $("#bd").height()/2);

$(window).resize(function(){
	var height = $(window).height();
	$("#bd").css("padding-top",$(window).height()/2 - $("#bd").height()/2);
	$("#container").height(height);
	
});

$('#remember').focus(function(){
   $(this).blur();
});

$('#remember').click(function(e) {
	checkRemember($(this));
});

function checkRemember($this){
	if(!-[1,]){
		 if($this.prop("checked")){
			$this.parent().addClass('checked');
		}else{
			$this.parent().removeClass('checked');
		}
	}
}
$(function(){
    $('.btn').on('click',function(){
        $('form').submit();
    })
})
</script>
</html>