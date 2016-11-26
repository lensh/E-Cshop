<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
	<title>管理中心 - 属性列表 </title>

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
    <script type="text/javascript">
    $(function(){

    });
    </script>

</head>
<body>
<h1 style="font-size:14px">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf">管理中心</a></span>

    <!--具体操作-->
    
		<span class="action-span"><a href="<?php echo U('add',array('type_id'=>$type_id));?>">
		添加属性</a></span>
		<span id="search_id"> - 属性列表 </span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

<p>按商品类型显示：
<select name="type_id" onchange="location.href='/E-Cshop/Admin/Attr/lst/type_id/'+this.value">
	<?php if(is_array($typeData)): $i = 0; $__LIST__ = $typeData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v['id']); ?>" <?php if($type_id==$v['id']) echo 'selected="selected"'?>>
		<?php echo ($v['type_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
</p>
<div class="list-div" id="listDiv">
	<table cellpadding="3" cellspacing="1">
    	<tr>
    	    <th>id</th>
            <th>所在的类型的id</th>
            <th>属性名</th>
            <th>属性的类型(0唯一 ,1可选)</th>
            <th>属性的可选值，多个可选值用，隔开</th>
			<th width="120">操作</th>
        </tr>
		<?php foreach ($data as $k => $v): ?>            
			<tr class="tron">
			    <td><?php echo $v['id']; ?></td>
				<td><?php echo $v['type_id']; ?></td>
				<td><?php echo $v['attr_name']; ?></td>
				<td><?php echo $v['attr_type']; ?></td>
				<td><?php echo $v['attr_option_values']; ?></td>
		        <td align="center">
		        	<a href="<?php echo U('edit?id='.$v['id'].'&p='.I('get.p').'&type_id='.$type_id); ?>" title="编辑">编辑</a> |
	                <a href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p').'&type_id='.$type_id); ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
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