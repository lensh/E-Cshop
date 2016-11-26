<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
        <title>管理中心 - 新增属性</title>

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
        <span id="search_id"> - 新增属性</span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

    <div class="main-div">
        <form mesthod="POST" action="/E-Cshop/Attr/add/type_id/2.html?type_id=2&attr_name=34344&attr_type=0&attr_option_values=34" style="margin:5px">
              <p>商品类型:
                <select name="type_id">
                  <?php if(is_array($typeData)): $i = 0; $__LIST__ = $typeData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v['id']); ?>" <?php if($type_id==$v['id']) echo 'selected="selected"'?>>
                    <?php echo ($v['type_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </p>
              <p>属性名：<input  type="text" name="attr_name" value=""/></p>
              <p>属性的类型0：唯一 1：可选：
                  <input type="radio" name="attr_type" value="0" checked="checked" />唯一
                  <input type="radio" name="attr_type" value="1"/>可选  
              </p>
              <p>属性的可选值，多个可选值用，隔开：
                  <input  type="text" name="attr_option_values" value=""/>
              </p>
              <p> <input type="submit" class="btn btn-primary" value="确定"/> </p>
        </form>
    </div>


<div id="footer">版权所有,侵权必究@2016</div>
</body>
</html>