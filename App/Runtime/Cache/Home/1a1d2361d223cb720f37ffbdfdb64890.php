<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo ($page_title); ?></title>
	<meta name="keywords" content="<?php echo ($page_keywords); ?>">
	<meta name="description" content="<?php echo ($page_description); ?>">
	<!--公共css和js-->
	<link rel="stylesheet" href="/E-Cshop/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/E-Cshop/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/E-Cshop/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/E-Cshop/Public/Home/style/bottomnav.css" type="text/css">
	<link rel="stylesheet" href="/E-Cshop/Public/Home/style/footer.css" type="text/css">
	<script type="text/javascript" src="/E-Cshop/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/E-Cshop/Public/Home/js/header.js"></script>

    <!--单独的css和js-->
	<?php if(is_array($page_css)): $i = 0; $__LIST__ = $page_css;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><link rel="stylesheet" href="/E-Cshop/Public/Home/style/<?php echo ($v); ?>.css" type="text/css"><?php endforeach; endif; else: echo "" ;endif; ?>

	<?php if(is_array($page_js)): $i = 0; $__LIST__ = $page_js;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><script type="text/javascript" src="/E-Cshop/Public/Home/js/<?php echo ($v1); ?>.js"></script><?php endforeach; endif; else: echo "" ;endif; ?>
	
</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w1210 bc">
			<div class="topnav_left">			
			</div>
			<div class="topnav_right fr">
				<ul>
			        <li id="logInfo"></li>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->
	
<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="<?php echo U('Index/index');?>"><img src="/E-Cshop/Public/Home/images/logo.png" alt="京西商城"></a></h2>
			<div class="flow fr flow3">
				<ul>
					<li>1.我的购物车</li>
					<li>2.填写核对订单信息</li>
					<li class="cur">3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="success w990 bc mt15">
		<div class="success_hd">
			<h2>订单提交成功</h2>
		</div>
		<div class="success_bd">
			<p><span></span>订单提交成功，我们将及时为您处理</p>
			<p class="message"><?php echo ($btn); ?></p>
			<p class="message">完成支付后，你可以  <a href="">查看订单状态</a>  <a href="">继续购物</a> <a href="">问题反馈</a></p>
		</div>
	</div>
	<!-- 主体部分 end -->
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt10">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="/E-Cshop/Public/Home/images/xin.png" alt="" /></a>
			<a href=""><img src="/E-Cshop/Public/Home/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="/E-Cshop/Public/Home/images/police.jpg" alt="" /></a>
			<a href=""><img src="/E-Cshop/Public/Home/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->
</body>
<script type="text/javascript">
	$.get('<?php echo U("Member/ajaxChkLogin");?>','',function(res){
		var data=JSON.parse(res);
		if(data.ok == 1)
			var html = "您好，"+data.email+" <a href='<?php echo U('Home/Member/logout'); ?>'>[退出]</a>";
		else
			var html = "您好，欢迎来到京西！[<a href='<?php echo U('Home/Member/login'); ?>'>登录</a>] [<a href='<?php echo U('Home/Member/regist'); ?>'>免费注册</a>] ";
		$("#logInfo").html(html);
	})
</script>
</html>