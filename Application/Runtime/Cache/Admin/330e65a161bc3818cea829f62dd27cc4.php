<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DouPHP 管理中心</title>
<meta name="Copyright" content="Douco Design." />
<link href="/self/Public/Admin/css/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/self/Public/Admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/self/Public/Admin/js/global.js"></script>
</head>
<body>
<div id="dcWrap"> <div id="dcHead">
 <div id="head">
  <div class="logo"><a href="index.html"><img src="/self/Public/Admin/images/dclogo.gif" alt="logo"></a></div>
  <div class="nav">
   <ul>
    <li class="M"><a href="JavaScript:void(0);" class="topAdd">新建</a>
     <div class="drop mTopad"><a href="<?php echo U('Product/product');?>">商品</a> <a href="<?php echo U('Article/article');?>">文章</a> <a href="nav.php?rec=add">自定义导航</a> <a href="<?php echo U('Doc/show');?>">首页幻灯</a> <a href="page.php?rec=add">单页面</a> <a href="<?php echo U('User/showList');?>">管理员</a> <a href="link.html"></a> </div>
    </li>
    <li><a href="../index.php" target="_blank">查看站点</a></li>
    <li><a href="index.php?rec=clear_cache">清除缓存</a></li>
    <li><a href="http://www.mycodes.net" target="_blank">帮助</a></li>
    <li class="noRight"><a href="module.html">DouPHP+</a></li>
   </ul>
   <ul class="navRight">
    <li class="M noLeft"><a href="JavaScript:void(0);">您好，<?php echo (session('uname')); ?></a>
     <div class="drop mUser">
      <a href="http://localhost/CMS/index.php/Admin/User/edit/id/<?php echo (session('uid')); ?>">编辑我的个人资料</a>
      <a href="manager.php?rec=cloud_account">设置云账户</a>
     </div>
    </li>
    <li class="noRight"><a href="<?php echo U('Public/logout');?>">退出</a></li>
   </ul>
  </div>
 </div>
</div>
<!-- dcHead 结束 --> <div id="dcLeft"><div id="menu">
 <ul class="top">
  <li><a href="<?php echo U('Index/index');?>"><i class="home"></i><em>管理首页</em></a></li>
 </ul>
 <ul>
  <li><a href="system.html"><i class="system"></i><em>系统设置</em></a></li>
  <li><a href="nav.html"><i class="nav"></i><em>自定义导航栏</em></a></li>
  <li><a href="<?php echo U('Doc/show');?>"><i class="show"></i><em>首页幻灯广告</em></a></li>
  <li><a href="page.html"><i class="page"></i><em>单页面管理</em></a></li>
 </ul>
   <ul>
  <li><a href="<?php echo U('Product/product_category');?>"><i class="productCat"></i><em>商品分类</em></a></li>
  <li><a href="<?php echo U('Product/product');?>"><i class="product"></i><em>商品列表</em></a></li>
 </ul>
  <ul>
  <li><a href="<?php echo U('Article/article_category');?>"><i class="articleCat"></i><em>文章分类</em></a></li>
  <li><a href="<?php echo U('Article/article');?>"><i class="article"></i><em>文章列表</em></a></li>
 </ul>
   <ul class="bot">
  <li><a href="backup.html"><i class="backup"></i><em>数据备份</em></a></li>
  <li><a href="mobile.html"><i class="mobile"></i><em>手机版</em></a></li>
  <li><a href="theme.html"><i class="theme"></i><em>设置模板</em></a></li>
  <li><a href="<?php echo U('User/showList');?>"><i class="manager"></i><em>网站管理员</em></a></li>
  <li><a href="manager.php?rec=manager_log"><i class="managerLog"></i><em>操作记录</em></a></li>
 </ul>
</div></div>
 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">DouPHP 管理中心<b>></b><strong>商品分类</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
        <h3><a href="add_product_category.html" class="actionBtn add">添加分类</a>商品分类</h3>
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
        <th width="120" align="left">分类名称</th>
        <th align="left">别名</th>
        <th align="left">简单描述</th>
       <th width="60" align="center">排序</th>
        <th width="80" align="center">操作</th>
     </tr>
       <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td align="left"> <a href="product.php?cat_id=2"> <?php echo ($vol["category_name"]); ?></a></td>
        <td><?php echo ($vol["nickname"]); ?></td>
        <td><?php echo ($vol["category_describe"]); ?></td>
        <td align="center"><?php echo ($vol["category_order"]); ?></td>
        <td align="center"><a href="product_category.php?rec=edit&cat_id=2">编辑</a> | <a href="product_category.php?rec=del&cat_id=2">删除</a></td>
           </tr><?php endforeach; endif; else: echo "" ;endif; ?>  
          </table>
           </div>
 </div>
 <div class="clear"></div>
<div id="dcFooter">
 <div id="footer">
  <div class="line"></div>
  <ul>
   版权所有 © 2013-2015 漳州豆壳网络科技有限公司，并保留所有权利。
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
</body>
</html>