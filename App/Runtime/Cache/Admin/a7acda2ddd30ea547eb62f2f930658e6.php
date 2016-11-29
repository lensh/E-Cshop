<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--标题-->
	
        <title>管理中心 - 编辑商品</title>

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
        <span id="search_id"> - 编辑商品</span>


    <div style="clear:both"></div>
</h1>

<!--内容主题-->

    <div class="main-div">
        <form method="POST" style="margin:5px" action="/E-Cshop/Goods/edit/id/1.html">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        		<input type="hidden" name="old_logo" value="<?php echo $data['logo']; ?>" />
        		<input type="hidden" name="old_sm_logo" value="<?php echo $data['sm_logo']; ?>" />
                             商品名称：
                    <p><input  type="text" name="goods_name" value="<?php echo $data['goods_name']; ?>" />
                 </p>
                     主分类的id：
                    <p><input  type="text" name="cat_id" value="<?php echo $data['cat_id']; ?>" />
                 </p>
                     品牌的id：
                    <p><input  type="text" name="brand_id" value="<?php echo $data['brand_id']; ?>" />
                 </p>
                     市场价：
                    <p><input  type="text" name="market_price" value="<?php echo $data['market_price']; ?>" />
                 </p>
                     本店价：
                    <p><input  type="text" name="shop_price" value="<?php echo $data['shop_price']; ?>" />
                 </p>
                     赠送积分：
                    <p><input  type="text" name="jifen" value="<?php echo $data['jifen']; ?>" />
                 </p>
                     赠送经验值：
                    <p><input  type="text" name="jyz" value="<?php echo $data['jyz']; ?>" />
                 </p>
                     如果要用积分兑换，需要的积分数：
                    <p><input  type="text" name="jifen_price" value="<?php echo $data['jifen_price']; ?>" />
                 </p>
                     是否促销：
                    <p><input  type="text" name="is_promote" value="<?php echo $data['is_promote']; ?>" />
                 </p>
                     促销价：
                    <p><input  type="text" name="promote_price" value="<?php echo $data['promote_price']; ?>" />
                 </p>
                     促销开始时间：
                    <p><input id="promote_start_time" type="text" name="promote_start_time" value="<?php echo $data['promote_start_time']; ?>" />
                 </p>
                     促销结束时间：
                    <p><input id="promote_end_time" type="text" name="promote_end_time" value="<?php echo $data['promote_end_time']; ?>" />
                 </p>
                     logo原图：
                     <p><input type="file" name="logo" /><br /> 
                    	<?php showImage($data['logo'], 100); ?>                 </p>
                     是否热卖：
                     <p><input type="radio" name="is_hot" value="1" <?php if($data['is_hot'] == '1') echo 'checked="checked"'; ?> />是 
                  </p>
                     <p><input type="radio" name="is_hot" value="0" <?php if($data['is_hot'] == '0') echo 'checked="checked"'; ?> />否 
                  </p>
                     是否新品：
                     <p><input type="radio" name="is_new" value="1" <?php if($data['is_new'] == '1') echo 'checked="checked"'; ?> />是 
                  </p>
                     <p><input type="radio" name="is_new" value="0" <?php if($data['is_new'] == '0') echo 'checked="checked"'; ?> />否 
                  </p>
                     是否精品：
                     <p><input type="radio" name="is_best" value="1" <?php if($data['is_best'] == '1') echo 'checked="checked"'; ?> />是 
                  </p>
                     <p><input type="radio" name="is_best" value="0" <?php if($data['is_best'] == '0') echo 'checked="checked"'; ?> />否 
                  </p>
                     是否上架：1：上架，0：下架：
                     <p><input type="radio" name="is_on_sale" value="1" <?php if($data['is_on_sale'] == '1') echo 'checked="checked"'; ?> />上架 
                  </p>
                     <p><input type="radio" name="is_on_sale" value="0" <?php if($data['is_on_sale'] == '0') echo 'checked="checked"'; ?> />下架 
                  </p>
                     seo优化[搜索引擎【百度、谷歌等】优化]_关键字：
                    <p><input  type="text" name="seo_keyword" value="<?php echo $data['seo_keyword']; ?>" />
                 </p>
                     seo优化[搜索引擎【百度、谷歌等】优化]_描述：
                    <p><input  type="text" name="seo_description" value="<?php echo $data['seo_description']; ?>" />
                 </p>
                     商品类型id：
                    <p><input  type="text" name="type_id" value="<?php echo $data['type_id']; ?>" />
                 </p>
                     排序数字：
                    <p><input  type="text" name="sort_num" value="<?php echo $data['sort_num']; ?>" />
                 </p>
                     商品描述：
                    <p><textarea id="goods_desc" name="goods_desc"><?php echo $data['goods_desc']; ?></textarea>
                </p>
                       <p><input type="submit" class="btn btn-primary" value="确定"/> </p>
        </form>
    </div>


<div id="footer">版权所有,侵权必究@2016</div>
</body>
</html>