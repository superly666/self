<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">

<head>
    <title>注册操作</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    <script>
    var itime = 59; //定义一个变量，倒计时初始化，从59秒开始
    function getTime() {
        if (itime >= 0) {
            if (itime == 0) {
                //倒计时变成0时，
                //要清除计时器
                clearTimeout(act);
                //设置按钮为初始状态
                $("#getCodeBtn").val('免费获取手机验证码').attr('disabled', false);
                itime = 59;
            } else {
                //延迟一秒中执行该函数。
                var act = setTimeout('getTime()', 1000);
                //把倒计时的秒显示到按钮中
                $("#getCodeBtn").val('还剩' + itime + '秒');
                itime = itime - 1;
            }
        }
    }
    $(function() {
        //定义一个函数,用于完成倒计时效果
        $("#getCodeBtn").click(function() {
            //获取输入的手机号码
            var telphone = $("#telphone").val();
            //ajax请求文件，调用短信发送的接口
            $.ajax({
                type: 'get',
                url: 'http://www.self.com/index.php/admin/public/send/telphone/' + telphone,
                success: function(msg) {
                    //判断调用短信发送接口是否成功，
                    if (msg == 1) {
                        //调用接口已经成功
                        alert('短信验证码已经发送成功');
                        $("#getCodeBtn").attr('disabled', true); //要禁用该按钮
                        //调用一个函数，完成倒计时效果。
                        getTime();
                    }
                }
            });
        });
    });
    </script>
    <style type="text/css">
    body{ font-family:'微软雅黑';background: #2074bb;}
   .re{margin-top:180px; padding-left:470px;}
    </style>
</head>
<body>
    <div>
        <form action="http://www.self.com/index.php/admin/public/register" method="post">
            <table class="re">
                <tr>
                    <td>用户名:</td>
                    <td>
                        <input type="text" name="username" />
                    </td>
                </tr>
                <tr>
                    <td>密码:</td>
                    <td>
                        <input type="password" name="password" />
                    </td>
                </tr>
                <tr>
                    <td>确认密码:</td>
                    <td>
                        <input type="password" name="password" />
                    </td>
                </tr>
                <tr>
                    <td>邮箱:</td>
                    <td>
                        <input type="text" name="email" />
                    </td>
                </tr>
                <tr>
                    <td>手机号:</td>
                    <td>
                        <input type="text" name="telphone" id="telphone" />
                </tr>
                <tr>
                    <td>验证码:</td>
                    <td>
                        <input type="text" name="checkcode" />
                        <input type="button" value="免费获取手机验证码" id="getCodeBtn" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="reset" value="重填" />&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" value="注册" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>