<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
	<title>管理中心 - 权限列表 </title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/E-Cshop/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="/E-Cshop/Public/bootstrap/js/jquery.min.js"></script>
	<!--其它样式-->
	
    <style type="text/css">
      td{text-align: center;}
    </style>

</head>
<body>
<h1 style="font-size:14px">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf">管理中心</a></span>

    <!--具体操作-->
    
		<span class="action-span"><a href="<?php echo U('add');?>">添加权限</a></span>
		<span id="search_id"> - 权限列表 </span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

	<div class="list-div" id="listDiv">
		<table cellpadding="3" cellspacing="1">
	    	<tr>
	    		<th>ID</th>
	            <th>权限名称</th>
	            <th>模块名称</th>
	            <th>控制器名称</th>
	            <th>方法名称</th>
	            <th>上级权限的ID，0：代表顶级权限</th>
				<th width="60">操作</th>
	        </tr>
			<?php foreach ($data as $k => $v): ?>            
				<tr class="tron">
				    <td><?php echo ($v['id']); ?></td>
					<td style="text-align:left;text-indent:4px">
					<?php echo str_repeat('-', 8*$v['level']); echo $v['auth_name'];?></td>
					<td><?php echo ($v['module_name']); ?></td>
					<td><?php echo ($v['controller_name']); ?></td>
					<td><?php echo ($v['action_name']); ?></td>
					<td><?php echo ($v['pid']); ?></td>
			        <td align="center">
			        	<a href="<?php echo U('edit?id='.$v['id'].'&p='.I('get.p')); ?>" title="编辑" style="color:#9cf">编辑</a> |
		                <a href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p')); ?>" onclick="return confirm('确定要删除吗？');" title="移除" 
		                style="color:#9cf">移除</a> 
			        </td>
		        </tr>
	        <?php endforeach; ?> 
		</table>
	</div>


<div id="footer">版权所有,侵权必究@2016</div>
</body>
</html>