<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
        <title>管理中心 - 新增权限 </title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/E-Cshop/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="/E-Cshop/Public/bootstrap/js/jquery.min.js">
	</script>
	<script type="text/javascript" src="/E-Cshop/Public/bootstrap/js/bootstrap.min.js">
	</script>
	<!--其它样式-->
	
    <script type="text/javascript">
        $(function(){
            $("input[type=submit]").click(function(){
                var p_level=$("#sl").find("option:selected").attr("level");
                var pid=$('#sl').val();
                var auth_level=(parseInt(p_level)==0&&parseInt(pid)==0)?0:parseInt(p_level)+1;
                var data={
                    'auth_name':$('#auth_name').val(),
                    'module_name':$('#module_name').val(),
                    'controller_name':$('#controller_name').val(),
                    'action_name':$('#action_name').val(),
                    'pid':pid,
                    'auth_level':auth_level
                };
                $.post("<?php echo U('Admin/Auth/add');?>",data,function(res){
                    if(res==1){
                        $("#info").text('新增成功').parent().show();
                    }else{
                        $("#info").text('新增失败').parent().show();
                    }
                    setTimeout(function(){
                       $("#info").parent().hide();
                    },3000);
                });
                return false;     
            });
        });
    </script>

</head>
<body>
<h1 style="font-size:14px">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf">管理中心</a></span>

    <!--具体操作-->
    
        <span class="action-span"><a href="<?php echo U('lst');?>">返回</a></span>
        <span id="search_id"> - 新增权限</span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

    <div class="main-div">
        <div class="alert alert-warning alert-dismissible hide" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
             <span id="info"></span>
        </div>
        <form style="margin:5px">
        <p>上级权限：
            <select name="pid" id="sl">
    			<option value="0" level="0">顶级权限</option>
    			<?php if(is_array($parentData)): $i = 0; $__LIST__ = $parentData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v['id']); ?>" level="<?php echo ($v['auth_level']); ?>">
                     <?php echo str_repeat('-', 8*$v['auth_level']).$v['auth_name'];?>
                     </option><?php endforeach; endif; else: echo "" ;endif; ?>			
            </select>
        </p>
    	<p>权限名称：<input  type="text" id="auth_name" 
        placeholder="如果没有则填null"/></p>
        <p>模块名称：<input  type="text" id="module_name" 
        placeholder="如果没有则填null"/></p>
        <p>控制器名称：<input  type="text" id="controller_name"
        placeholder="如果没有则填null"/></p>
        <p>方法名称：<input  type="text" id="action_name"
        placeholder="如果无方法则填null"/></p>
        <input type="submit" class="btn btn-primary" value="确定" />   
        </form>
    </div>


<div id="footer">版权所有,侵权必究@2016</div>
</body>
</html>