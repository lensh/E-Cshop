<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
	<title>管理中心 - 品牌列表 </title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/E-Cshop/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="/E-Cshop/Public/bootstrap/js/jquery.min.js">
	</script>
	<script type="text/javascript" src="/E-Cshop/Public/bootstrap/js/bootstrap.min.js">
	</script>
	<!--其它样式-->
	
    <style type="text/css">
      td{text-align: center;}
      a{color:#9cf !important}
    </style>

</head>
<body>
<h1 style="font-size:14px">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf">管理中心</a></span>

    <!--具体操作-->
    
		<span class="action-span"><a href="<?php echo U('add');?>">添加品牌		</a></span>
		<span id="search_id"> - 品牌列表 </span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

<!-- 搜索 -->
<div class="form-div search_form_div">
    <form method="GET" name="search_form">
		<p>
			品牌名称：
	   		<input type="text" name="brand_name" size="30" value="<?php echo I('get.brand_name'); ?>" />
		</p>
		<p><input type="submit" value=" 搜索 " class="button" /></p>
    </form>
</div>
<!-- 列表 -->
<div class="list-div" id="listDiv">
	<table cellpadding="3" cellspacing="1">
    	<tr>
            <th >品牌名称</th>
            <th >品牌网站地址</th>
            <th >品牌logo</th>
			<th width="60">操作</th>
        </tr>
		<?php foreach ($data as $k => $v): ?>            
			<tr class="tron">
				<td><?php echo $v['brand_name']; ?></td>
				<td><?php echo $v['site_url']; ?></td>
				<td><?php echo $v['logo']; ?></td>
		        <td align="center">
		        	<a href="<?php echo U('edit?id='.$v['id'].'&p='.I('get.p')); ?>" title="编辑">编辑</a> |
	                <a href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p')); ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
		        </td>
	        </tr>
        <?php endforeach; ?> 
		<?php if(preg_match('/\d/', $page)): ?>  
        <tr><td align="right" nowrap="true" colspan="99" height="30"><?php echo $page; ?></td></tr> 
        <?php endif; ?> 
	</table>
</div>


<div id="footer">版权所有,侵权必究@2016</div>
</body>
</html>