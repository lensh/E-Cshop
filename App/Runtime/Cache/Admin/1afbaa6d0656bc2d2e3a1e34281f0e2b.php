<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
	<title>管理中心 - 库存量</title>

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
        //点击按钮
    	function addNew(a){
    		if($(a).val()=='+'){
    	 		var tr=$(a).parent().parent();
    			var newTr=tr.clone();
    			newTr.find(':button').val('-');
    			tr.after(newTr);		
    		}else{
    			$(a).parent().parent().remove();
    		}
    	}
    </script>

</head>
<body>
<h1 style="font-size:14px">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf">管理中心</a></span>

    <!--具体操作-->
    
		<span class="action-span"><a href="<?php echo U('lst');?>">商品列表</a></span>
		<span id="search_id"> - 库存设置</span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

<div class="list-div" id="listDiv">
 <form method="post" action="/E-Cshop/Goods/number/id/1.html">
	<table cellpadding="3" cellspacing="1">
    	<tr>
    		<?php if(is_array($attr)): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><th width="150"><?php echo ($v[0]['attr_name']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
            <th width="150">库存</th>
			<th width="150">操作</th>
        </tr>
        <tr>
        	<?php if(is_array($attr)): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td>
	    		  <select name="goods_attr_id[]">
	    		    <option value="">请选择</option>
	    		  	<?php if(is_array($v)): $i = 0; $__LIST__ = $v;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v1['id']); ?>"><?php echo ($v1['attr_value']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	    		  </select>
    			</td><?php endforeach; endif; else: echo "" ;endif; ?>
            <td><input type="text" name="goods_number[]"/></td>
			<td><input type="button" onclick="addNew(this)" class="btn btn-info" value="+"/>
			</td>
        </tr>
        <tr>	
        	<td colspan="<?= count($attr)+2;?>"><input type="submit" class="btn btn-primary" value="保存"/></td>
        </tr>
	</table>
  </form>
</div>


<div id="footer">版权所有,侵权必究@2016</div>
</body>
</html>