<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
        <title>管理中心 - 编辑管理员</title>

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
    
        <span class="action-span"><a href="<?php echo U('Admin/Admin/lst');?>">返回</a></span>
        <span id="search_id"> - 编辑管理员</span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

    <div class="main-div">
        <form method="POST" style="margin-left:5px" action="/E-Cshop/Admin/Admin/edit/id/1.html">
        <input type="hidden" name="id" value="<?php echo ($data['id']); ?>" />
        <p>账号：<input type="text" name="username" value="<?php echo ($data['username']); ?>"/></p>
        <p>密码：<input type="password" size="25" name="password"/></p>
        <p>确认密码：<input type="password" size="25" name="cpassword"/></p>
        <p>为该管理员重新分配角色：
            <div class="alert alert-info">
                <?php if(is_array($roleData)): $i = 0; $__LIST__ = $roleData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><input type="checkbox" name="role_id[]" style="margin:10px" 
                    value="<?php echo ($v["id"]); ?>"
                    <?php if(strpos(','.$data['role_id'].',',','.$v['id'].',')!==false) echo "checked" ?>
                    ><?php echo ($v["role_name"]); ?><br/><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </p>
        <p>是否启用(1启用,0禁用)：
        <input type="radio" name="is_use" value="1" <?php if($data['is_use'] == '1') echo 'checked="checked"'; ?> />启用 
        <input type="radio" name="is_use" value="0" <?php if($data['is_use'] == '0') echo 'checked="checked"'; ?> />禁用 
        </p>
        <p><input type="submit" class="btn btn-primary" value="确定"/></p>
        </form>
    </div>


<div id="footer">版权所有,侵权必究@2016</div>
</body>
</html>