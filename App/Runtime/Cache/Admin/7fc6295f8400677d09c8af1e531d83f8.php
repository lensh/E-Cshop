<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
        <title>管理中心 - 商品列表</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/E-Cshop/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
	<link href="/E-Cshop/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="/E-Cshop/Public/bootstrap/js/jquery.min.js">
	</script>
	<script type="text/javascript" src="/E-Cshop/Public/bootstrap/js/bootstrap.min.js">
	</script>
	<!--其它样式-->
	
    <link rel="stylesheet" type="text/css" href="/E-Cshop/Public/datepicker/jquery-ui-1.9.2.custom.min.css">
    <script type="text/javascript" language="javascript" src="/E-Cshop/Public/datepicker/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" language="javascript" src="/E-Cshop/Public/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
    <style type="text/css">
    input{margin: 5px !important}
    td{text-align: center;}
    a.action{color:#9cf !important}
    a.num,span.current{margin: 5px;border: 1px solid #ccc;padding:0 5px;color: white;
        width: 20px !important;height: 20px !important;text-decoration: none !important;}
    span.current{background: #9cf;border: 1px solid #9cf;}
    a.prev,a.next{text-decoration: none !important;color:#9cf !important}
    </style>
    <script type="text/javascript">
      $(function(){
        $('#start_addtime').datepicker({dateFormat:"yy-mm-dd"});
        $('#end_addtime').datepicker({dateFormat:"yy-mm-dd"});
      });
    </script>

</head>
<body>
<h1 style="font-size:14px">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf">管理中心</a></span>

    <!--具体操作-->
    
        <span class="action-span"><a href="<?php echo U('add');?>">添加商品</a></span>
        <span id="search_id"> - 商品列表</span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

    <div class="form-div">
      <form>
        <input type="hidden" name="p" value="1" />
         商品名称：<input type="text" name="goods_name" value="<?php echo I('get.goods_name');?>"/><br/>
         价　　格：<input type="text" name="start_price" value="<?php echo I('get.start_price');?>"/>~
         <input type="text" name="end_price" value="<?php echo I('get.end_price');?>"/><br/>
         上否上架：<input type="radio" name="is_on_sale" value="-1" <?php if(I('get.is_on_sale', -1) == -1) echo 'checked="checked"'; ?> />全部
            <input type="radio" name="is_on_sale" value="1" <?php if(I('get.is_on_sale', -1) == 1) echo 'checked="checked"'; ?> />是
            <input type="radio" name="is_on_sale" value="0" <?php if(I('get.is_on_sale', -1) == 0) echo 'checked="checked"'; ?> />否<br />     
         是否删除：<input type="radio" name="is_delete" value="-1" <?php if(I('get.is_delete', -1) == -1) echo 'checked="checked"'; ?> />全部
            <input type="radio" name="is_delete" value="1" <?php if(I('get.is_delete', -1) == 1) echo 'checked="checked"'; ?> />是
            <input type="radio" name="is_delete" value="0" <?php if(I('get.is_delete', -1) == 0) echo 'checked="checked"'; ?> />否<br />
         添加时间：
            <input type="text" size="10" id="start_addtime" name="start_addtime" value="<?php echo I('get.start_addtime');?>"/>~<input type="text" size="10" id="end_addtime" name="end_addtime" value="<?php echo I('get.end_addtime');?>"/><br/>
            <input type="submit" class="btn btn-primary" value="搜索"/><br /><br />     
         排序方式：
            <input onclick="parentNode.submit();" type="radio" name="odby" value="id_asc" <?php if(I('get.odby', 'id_asc') == 'id_asc') echo 'checked="checked"'; ?> />根据添加时间升序
            <input onclick="parentNode.submit();" type="radio" name="odby" value="id_desc" <?php if(I('get.odby') == 'id_desc') echo 'checked="checked"'; ?> />根据添加时间降序
            <input onclick="parentNode.submit();" type="radio" name="odby" value="price_asc" <?php if(I('get.odby') == 'price_asc') echo 'checked="checked"'; ?> />根据价格升序
            <input onclick="parentNode.submit();" type="radio" name="odby" value="price_desc" <?php if(I('get.odby') == 'price_desc') echo 'checked="checked"'; ?> />根据价格降序<br />
      </form>
    </div>

    <!-- 商品列表 -->
    <div class="list-div" id="listDiv">
            <table cellpadding="3" cellspacing="1">
                <tr>
                    <th>id</th>
                    <th>添加时间</th>
                    <th>商品名称</th>
                    <th>LOGO</th>
                    <th>价格</th>
                    <th>描述</th>
                    <th>是否上架</th>
                    <th>是否删除</th>
                    <th>操作</th>
                </tr>
                <?php foreach ($data as $k => $v): ?>
                <tr>
                    <td><?php echo ($v["id"]); ?></td>
                    <td><?php echo date('Y-m-d H:i:s', $v['addtime']); ?></td>
                    <td><?php echo ($v["goods_name"]); ?></td>
                    <td><img src="/E-Cshop/PUBLIC/Uploads<?php echo substr($v['sm_logo'],16);?>"></td>
                    <td><?php echo ($v["price"]); ?></td>
                    <td><?php echo ($v["goods_desc"]); ?></td>
                    <td><?php echo $v['is_on_sale'] == 1 ? '上架' : '下架'; ?></td>
                    <td><?php echo $v['is_delete'] == 1 ? '已删除' : '未删除'; ?></td>
                    <td>
                    <a href="<?php echo U('edit',array('id'=>$v['id'],'p'=>I('get.p',1)));?>" class="action">修改</a>
                    <a onclick="return confirm('确定要删除吗?')" href="<?php echo U('delete',array('id'=>$v['id'],'p'=>I('get.p',1)));?>" class="action">删除</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr><td colspan="9"><?php echo ($page); ?></td></tr>
            </table>
    </div>


<div id="footer">版权所有,侵权必究@2016</div>
</body>
</html>