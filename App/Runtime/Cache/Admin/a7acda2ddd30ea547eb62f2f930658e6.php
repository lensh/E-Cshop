<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
        <title>管理中心 - 编辑商品 </title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/E-Cshop/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="/E-Cshop/Public/bootstrap/js/jquery.min.js"></script>
	<!--其它样式-->
	
    <script type="text/javascript" charset="utf-8" src="/E-Cshop/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/E-Cshop/Public/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/E-Cshop/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        UE.getEditor('goods_desc',{
            'initialFrameWidth':'100%',
            'initialFrameHeight':200,
            'maximumWords':200
        });
    </script>

</head>
<body>
<h1 style="font-size:14px">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf">管理中心</a></span>

    <!--具体操作-->
    
        <span class="action-span"><a href="<?php echo U('lst');?>">返回</a></span>
        <span id="search_id"> - 编辑商品 </span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

    <div class="tab-div">
        <div id="tabbar-div">
            <p>
                <span class="tab-front" id="general-tab">通用信息</span>
            </p>
        </div>
        <div id="tabbody-div">
            <form method="POST" action="/E-Cshop/Goods/edit/id/1/p/1.html" enctype="multipart/form-data">
             <input type="hidden" name="id" value="<?php echo ($data['id']); ?>">
            商品名称:<input type="text" name="goods_name" value="<?php echo ($data["goods_name"]); ?>"/><br />
            商品价格:<input type="text" name="price" value="<?php echo ($data["price"]); ?>" /><br />
            <img src="/E-Cshop/PUBLIC/Uploads<?php echo substr($data['sm_logo'],16);?>"/>
            商品logo:<input type="file" name="logo"  /><br />
            商品描述:<textarea name="goods_desc" id="goods_desc"><?php echo ($data["goods_name"]); ?></textarea><br />
            是否上架:
            <input type="radio" name="is_on_sale" value="1" <?php if($data['is_on_sale']==1) echo 'checked="checked"'?> />上架
            <input type="radio" name="is_on_sale" value="0" <?php if($data['is_on_sale']==0) echo 'checked="checked"'?> />下架
            <br />
            <input type="submit" class="btn btn-primary" value="提交" />
            </form>
        </div>
    </div>


<div id="footer">版权所有,侵权必究@2016</div>
</body>
</html>