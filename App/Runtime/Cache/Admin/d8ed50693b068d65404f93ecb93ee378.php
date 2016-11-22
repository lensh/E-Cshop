<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
        <title>管理中心 - 编辑权限</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/E-Cshop/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="/E-Cshop/Public/bootstrap/js/jquery.min.js"></script>
	<!--其它样式-->
	
</head>
<body>
<h1 style="font-size:14px">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf">管理中心</a></span>

    <!--具体操作-->
    
        <span class="action-span"><a href="<?php echo U('lst');?>">返回</a></span>
        <span id="search_id"> - 编辑权限</span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

    <div class="main-div">
        <form style="margin:5px" method="POST"
         action="/E-Cshop/Auth/edit/id/1.html" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo ($data['id']); ?>" name="id"/>
        <p>上级权限：<select name="pid">
                         <?php if($data_p['id']){?>
                            <option value="<?php echo $data_p['id'];?>">
                            <?php echo $data_p['auth_name'];?>
                            </option>
                            <option value="0">顶级权限</option>
                         <?php } else{?>
                            <option value="0">顶级权限</option>
                         <?php }?>
                            <?php foreach ($parentData as $k => $v): ?>                     <option value="<?php echo $v['id']; ?>"><?php echo str_repeat('-', 8*$v['level']).$v['auth_name']; ?></option>
                            <?php endforeach; ?>                    
                    </select>
        </p>
        <p>权限名称：<input  type="text" name="auth_name" value="<?php echo ($data['auth_name']); ?>" /></p>
        <p>模块名称：<input  type="text" name="module_name" value="<?php echo ($data['module_name']); ?>"/>
        </p>
        <p>控制器名称：<input  type="text" name="controller_name" value="<?php echo ($data['controller_name']); ?>"/></p>
        <p>方法名称：<input  type="text" name="action_name" value="<?php echo ($data['action_name']); ?>"
        placeholder="如无方法名则填null"/>
        </p>
        <input type="submit" class="btn btn-primary" value="确定"/>   
        </form>
    </div>


<div id="footer">版权所有,侵权必究@2016</div>
</body>
</html>