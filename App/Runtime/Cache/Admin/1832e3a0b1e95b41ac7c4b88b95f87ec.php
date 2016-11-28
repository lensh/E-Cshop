<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
        <title>管理中心 - 编辑品牌</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/E-Cshop/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="/E-Cshop/Public/bootstrap/js/jquery.min.js">
	</script>
	<script type="text/javascript" src="/E-Cshop/Public/bootstrap/js/bootstrap.min.js">
	</script>
	<!--其它样式-->
	
</head>
<body>
<h1 style="font-size:14px">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf">管理中心</a></span>

    <!--具体操作-->
    
        <span class="action-span"><a href="<?php echo U('lst');?>">返回</a></span>
        <span id="search_id"> - 编辑品牌</span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

    <div class="main-div">
        <form method="POST" style="margin:5px" action="/E-Cshop/Brand/edit/id/1.html" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo ($data['id']); ?>" />
        <input type="hidden" name="old_logo" value="<?php echo ($data['logo']); ?>"/>
        <p>品牌名称:<input type="text" name="brand_name" value="<?php echo ($data['brand_name']); ?>"/></p>
        <p>品牌网站地址:<input type="text" name="site_url" value="<?php echo ($data['site_url']); ?>"/></p>
        <p>品牌logo:<input type="file" name="logo"/><br/> 
        <?php showImage($data['logo'], 100);?></p>
        <p><input type="submit" class="btn btn-primary" value="确定"/></p>
        </form>
    </div>


<div id="footer">版权所有,侵权必究@2016</div>
</body>
</html>