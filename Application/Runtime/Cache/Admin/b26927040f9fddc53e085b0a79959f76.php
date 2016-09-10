<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DouPHP 管理中心</title>
<meta name="Copyright" content="Douco Design." />
<link href="/self/Public/Admin/css/public.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/self/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/self/Public/Admin/css/info-mgt.css" />
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
<div id="urHere">DouPHP 管理中心<b>></b><strong>首页幻灯广告</strong> </div>   <div class="mainBox imgModule">
    <h3>首页幻灯广告</h3>
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
    <tr>
       <th>编辑幻灯</th>
       <th>幻灯列表</th>
     </tr>
     <tr>
      <td width="350" valign="top">
       <form action="<?php echo U('Doc/editok');?>" class="formEdit" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableOnebor">
         <tr>
          <td><b>幻灯名称</b>
<input type="text" name="name" value="<?php echo ($onedata["name"]); ?>" size="20" class="inpMain" />
          </td>
         </tr>
         <tr>
          <td><b>幻灯图片</b>
          <font color="red">注：如果不修改则不需要选择文件！！</font>
           <input type="file" name="file" class="inpFlie" /><?php echo ($onedata["filepath"]); ?></td>
         </tr>
         <tr>
          <td><b>图片描述</b>
           <input type="text" name="content" value="<?php echo ($onedata["content"]); ?>" size="40" class="inpMain" />
          </td>
         </tr>
         <tr>
          <td><b>排序</b>
<input type="text" name="sort" value="<?php echo ($onedata["sort"]); ?>" size="20" class="inpMain" />
          </td>
         </tr>
         <tr>
          <td>
                      <a href="<?php echo U('Doc/show');?>" class="btnGray">取消</a>
           <input type="hidden" name="id" value="<?php echo ($onedata["id"]); ?>">
           <input type="hidden"  value="http://www.weiqing.com/data/slide/20130514acunau.jpg">
                      <input type="hidden"  value="d80a288d" />
           <input  class="btn" type="submit" value="提交" />
          </td>
         </tr>
        </table>
       </form>
      </td>
      <td valign="top">
       <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableOnebor">
        <tr>
         <td width="100">幻灯名称</td>
         <td></td>
         <td width="80" align="center">描述</td>
         <td width="80" align="center">操作</td>
        </tr>
                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
         <td><a href="javascript:;" data="<?php echo ($vol["id"]); ?>" data-name="<?php echo ($vol["name"]); ?>"class="show"><?php echo ($vol["filepath"]); ?></a></td>
         <td><?php echo ($vol["name"]); ?></td>
         <td align="center"><?php echo ($vol["content"]); ?></td>
         <td align="center"><a href="/self/index.php/Admin/Doc/editshow/id/<?php echo ($vol["id"]); ?>">编辑</a> | <a href="javascript:;" ids="<?php echo ($vol["id"]); ?>" class="del">删除</a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
        <td colspan="4"><div class="pagination ue-clear">
  <div class="pagin-list">
     <?php echo ($show); ?>
  </div>
  <div class="pxofy">共 <?php echo ($count); ?> 条记录</div>
</div>
       </td> </tr>
               </table>
      </td>
     </tr>
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
<script type="text/javascript" src="/self/Public/Admin/js/layer/layer.js"></script>
<script type="text/javascript">
  $(function(){
    $('.show').on('click',function(){
      var id = $(this).attr('data');
        var docname = $(this).attr('data-name');
        layer.open({
            type: 2,
            title: docname,
            shadeClose: true,
            shade: 0.8,
            area: ['560px','90%'],
            content: '/self/index.php/Admin/Doc/getContent/id/'+id
    })
  })
    $('.del').on('click',function(){
      var id = $(this).attr('ids');
      alert('您确定要删除吗？？？');
      window.location.href='/self/index.php/Admin/Doc/delshow/id/'+id;
    })
})
</script>
</html>