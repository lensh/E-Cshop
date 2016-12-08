<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo ($page_title); ?></title>
	<meta name="keywords" content="<?php echo ($page_keywords); ?>">
	<meta name="description" content="<?php echo ($page_description); ?>">
	<!--公共css和js-->
	<link rel="stylesheet" href="/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/bottomnav.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/footer.css" type="text/css">
	<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/Public/Home/js/header.js"></script>

    <!--单独的css和js-->
	<?php if(is_array($page_css)): $i = 0; $__LIST__ = $page_css;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><link rel="stylesheet" href="/Public/Home/style/<?php echo ($v); ?>.css" type="text/css"><?php endforeach; endif; else: echo "" ;endif; ?>

	<?php if(is_array($page_js)): $i = 0; $__LIST__ = $page_js;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><script type="text/javascript" src="/Public/Home/js/<?php echo ($v1); ?>.js"></script><?php endforeach; endif; else: echo "" ;endif; ?>
	
</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w1210 bc">
			<div class="topnav_left">			
			</div>
			<div class="topnav_right fr">
				<ul>
			        <li id="logInfo"></li>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->
	
	<?php  $catData=D('Admin/Category')->getNavCat(); ?>
	<div style="clear:both;"></div>
	<!-- 头部 start -->
	<div class="header w1210 bc mt15">
		<!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
		<div class="logo w1210">
			<h1 class="fl"><a href="index.html"><img src="/Public/Home/images/logo.png" alt="京西商城"></a></h1>
			<!-- 头部搜索 start -->
			<div class="search fl">
				<div class="search_form">
					<div class="form_left fl"></div>
					<form action="" name="serarch" method="get" class="fl">
						<input type="text" class="txt" value="请输入商品关键字" /><input type="submit" class="btn" value="搜索" />
					</form>
					<div class="form_right fl"></div>
				</div>
				
				<div style="clear:both;"></div>

				<div class="hot_search">
					<strong>热门搜索:</strong>
					<a href="">D-Link无线路由</a>
					<a href="">休闲男鞋</a>
					<a href="">TCL空调</a>
					<a href="">耐克篮球鞋</a>
				</div>
			</div>
			<!-- 头部搜索 end -->

			<!-- 用户中心 start-->
			<div class="user fl">
				<dl>
					<dt>
						<em></em>
						<a href="">用户中心</a>
						<b></b>
					</dt>
					<dd>
						<div class="prompt" id="prompt">
						</div>
						<div class="uclist mt10">
							<ul class="list1 fl">
								<li><a href="">用户信息></a></li>
								<li><a href="">我的订单></a></li>
								<li><a href="">收货地址></a></li>
								<li><a href="">我的收藏></a></li>
							</ul>

							<ul class="fl">
								<li><a href="">我的留言></a></li>
								<li><a href="">我的红包></a></li>
								<li><a href="">我的评论></a></li>
								<li><a href="">资金管理></a></li>
							</ul>

						</div>
						<div style="clear:both;"></div>
						<div class="viewlist mt10">
							<h3>最近浏览的商品：</h3>
							<ul id="recentView">
							</ul>
						</div>
					</dd>
				</dl>
			</div>
			<!-- 用户中心 end-->

			<!-- 购物车 start -->
			<div class="cart fl">
				<dl>
					<dt>
						<a href="<?php echo U('Cart/lst');?>">去购物车结算</a>
						<b></b>
					</dt>
				</dl>
			</div>
			<!-- 购物车 end -->
		</div>
		<!-- 头部上半部分 end -->
		
		<div style="clear:both;"></div>

		<!-- 导航条部分 start -->
		<div class="nav w1210 bc mt10">
			<!--  商品分类部分 start-->
			<div class="category fl <?php echo ($nav==0?'cat1':''); ?>"> <!-- 非首页，需要添加cat1类 -->
				<div class="cat_hd <?php echo ($nav==0?'off':''); ?>">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
					<h2>全部商品分类</h2>
					<em></em>
				</div>
				
				<div class="cat_bd <?php if($nav==0) echo 'none'; ?>">
				<!-- 循环顶级分类 -->
					<?php foreach ($catData as $k => $v): ?>
					<div class="cat <?php if($k==0) echo 'item1'; ?>">
						<h3><a href=""><?php echo ($v["cat_name"]); ?></a> <b></b></h3>
						<div class="cat_detail">
							<!-- 循环二级分类 -->
							<?php foreach ($v['children'] as $k1 => $v1): ?>
							<dl <?php if($k1==0) echo 'class="dl_1st"'; ?>>
								<dt><a href=""><?php echo ($v1["cat_name"]); ?></a></dt>
								<dd>
									<!-- 循环三级分类 -->
									<?php foreach ($v1['children'] as $k2 => $v2): ?>
									<a href=""><?php echo ($v2["cat_name"]); ?></a>
									<?php endforeach; ?>			
								</dd>
							</dl>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<!--  商品分类部分 end--> 

			<div class="navitems fl">
				<ul class="fl">
					<li class="current"><a href="">首页</a></li>
					<li><a href="">电脑频道</a></li>
					<li><a href="">家用电器</a></li>
					<li><a href="">品牌大全</a></li>
					<li><a href="">团购</a></li>
					<li><a href="">积分商城</a></li>
					<li><a href="">夺宝奇兵</a></li>
				</ul>
				<div class="right_corner fl"></div>
			</div>
		</div>
		<!-- 导航条部分 end -->
	</div>
	<!-- 头部 end-->
	<div style="clear:both;"></div>


<!--ajax获取最近浏览量-->
<script type="text/javascript">
    var imgURL="<?php echo C('IMG_URL');?>";
	$.get('<?php echo U("Index/ajaxGetRecent");?>','',function(data){
		var json=JSON.parse(data);
		var html='';
		for(var i=0;i<json.length;i++){
			html+='<li><a href="<?php echo U('goods','',false);?>/id/'+json[i].id+'"><img src="'+imgURL+json[i].sm_logo+'" alt="" /></a></li>';
		}
		$('#recentView').html(html);
	});
	$.get('<?php echo U("Member/ajaxChkLogin");?>','',function(res){
		var data=JSON.parse(res);
		if(data.ok == 1)
			var html = "您好,<a href='<?php echo U('Home/Member/index'); ?>'>"+data['email']+"</a>";
		else
			var html="您好，请<a href='<?php echo U('Home/Member/login'); ?>'>登录</a>";
		$("#prompt").html(html);
	})
</script>

<!--内容主体start-->
	<div style="clear:both;"></div>
	
	<!-- 综合区域 start 包括幻灯展示，商城快报 -->
	<div class="colligate w1210 bc mt10">
		<!-- 幻灯区域 start -->
		<div class="slide fl">
			<div class="area">
				<div class="slide_items">
					<ul>
						<li><a href=""><img src="/Public/Home/images/index_slide1.jpg" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/index_slide2.jpg" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/index_slide3.jpg" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/index_slide4.jpg" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/index_slide5.jpg" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/index_slide6.jpg" alt="" /></a></li>
					</ul>
				</div>
				<div class="slide_controls">
					<ul>
						<li class="on">1</li>
						<li>2</li>
						<li>3</li>
						<li>4</li>
						<li>5</li>
						<li>6</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- 幻灯区域 end-->
	
		<!-- 快报区域 start-->
		<div class="coll_right fl ml10">
			<div class="ad"><a href=""><img src="/Public/Home/images/ad.jpg" alt="" /></a></div>
			
			<div class="news mt10">
				<h2><a href="">更多快报&nbsp;></a><strong>网站快报</strong></h2>
				<ul>
					<li class="odd"><a href="">电脑数码双11爆品抢不停</a></li>
					<li><a href="">买茶叶送武夷山旅游大奖</a></li>
					<li class="odd"><a href="">爆款手机最高直降1000</a></li>
					<li><a href="">新鲜褚橙全面包邮开售！</a></li>
					<li class="odd"><a href="">家具家装全场低至3折</a></li>
					<li><a href="">买韩束，志玲邀您看电影</a></li> 
					<li class="odd"><a href="">美的先行惠双11快抢悦</a></li>
					<li><a href="">享生活 疯狂周期购！</a></li>
				</ul>

			</div>
			
			<div class="service mt10">
				<h2>
					<span class="title1 on"><a href="">话费</a></span>
					<span><a href="">旅行</a></span>
					<span><a href="">彩票</a></span>
					<span class="title4"><a href="">游戏</a></span>
				</h2>
				<div class="service_wrap">
					<!-- 话费 start -->
					<div class="fare">
						<form action="">
							<ul>
								<li>
									<label for="">手机号：</label>
									<input type="text" name="phone" value="请输入手机号" class="phone" />
									<p class="msg">支持移动、联通、电信</p>
								</li>
								<li>
									<label for="">面值：</label>
									<select name="" id="">
										<option value="">10元</option>
										<option value="">20元</option>
										<option value="">30元</option>
										<option value="">50元</option>
										<option value="" selected>100元</option> 
										<option value="">200元</option>
										<option value="">300元</option>
										<option value="">400元</option>
										<option value="">500元</option>
									</select>
									<strong>98.60-99.60</strong>
								</li>
								<li>
									<label for="">&nbsp;</label>
									<input type="submit" value="点击充值" class="fare_btn" /> <span><a href="">北京青春怒放独家套票</a></span>
								</li>
							</ul>
						</form>
					</div>
					<!-- 话费 start -->
	
					<!-- 旅行 start -->
					<div class="travel none">
						<ul>
							<li>
								<a href=""><img src="/Public/Home/images/holiday.jpg" alt="" /></a>
								<a href="" class="button">度假查询</a>
							</li>
							<li>
								<a href=""><img src="/Public/Home/images/scenic.jpg" alt="" /></a>
								<a href="" class="button">景点查询</a>
							</li>
						</ul>
					</div>
					<!-- 旅行 end -->
						
					<!-- 彩票 start -->
					<div class="lottery none">
						<p><img src="/Public/Home/images/lottery.jpg" alt="" /></p>
					</div>
					<!-- 彩票 end -->

					<!-- 游戏 start -->
					<div class="game none">
						<ul>
							<li><a href=""><img src="/Public/Home/images/sanguo.jpg" alt="" /></a></li>
							<li><a href=""><img src="/Public/Home/images/taohua.jpg" alt="" /></a></li>
							<li><a href=""><img src="/Public/Home/images/wulin.jpg" alt="" /></a></li>
						</ul>
					</div>
					<!-- 游戏 end -->
				</div>
			</div>

		</div>
		<!-- 快报区域 end-->
	</div>
	<!-- -综合区域 end -->
	
	<div style="clear:both;"></div>

	<!-- 导购区域 start -->
	<div class="guide w1210 bc mt15">
		<!-- 导购左边区域 start -->
		<div class="guide_content fl">
			<h2>
				<span class="on">疯狂抢购</span>
				<span>热卖商品</span>
				<span>推荐商品</span>
				<span>新品上架</span>
				<span class="last">猜您喜欢</span>
			</h2>
			
			<div class="guide_wrap">
				<!-- 疯狂抢购 start-->
				<div class="crazy">
					<ul>
					<?php if(is_array($promote_goods)): $i = 0; $__LIST__ = $promote_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
							<dl>
								<dt><a href="<?php echo U('goods?id='.$v['id']);?>"><img src="/Public/Uploads/<?php echo ($v["sm_logo"]); ?>" alt="" /></a></dt>
								<dd><a href="<?php echo U('goods?id='.$v['id']);?>"><?php echo ($v["goods_name"]); ?></a></dd>
								<dd><span>售价：</span><strong> ￥<?php echo ($v["promote_price"]); ?></strong></dd>
							</dl>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>	
				</div>
				<!-- 疯狂抢购 end-->

				<!-- 热卖商品 start -->
				<div class="hot none">
					<ul>
					<?php if(is_array($hot_goods)): $i = 0; $__LIST__ = $hot_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><li>
							<dl>
								<dt><a href="<?php echo U('goods?id='.$v1['id']);?>"><img src="/Public/Uploads/<?php echo ($v1["sm_logo"]); ?>" alt="" /></a></dt>
								<dd><a href="<?php echo U('goods?id='.$v1['id']);?>"><?php echo ($v1["goods_name"]); ?></a></dd>
								<dd><span>售价：</span><strong> ￥<?php echo ($v1["shop_price"]); ?></strong></dd>
							</dl>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<!-- 热卖商品 end -->

				<!-- 推荐商品 atart -->
				<div class="recommend none">
					<ul>
					<?php if(is_array($best_goods)): $i = 0; $__LIST__ = $best_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><li>
							<dl>
								<dt><a href="<?php echo U('goods?id='.$v2['id']);?>"><img src="/Public/Uploads/<?php echo ($v2["sm_logo"]); ?>" alt="" /></a></dt>
								<dd><a href="<?php echo U('goods?id='.$v2['id']);?>"><?php echo ($v2["goods_name"]); ?></a></dd>
								<dd><span>售价：</span><strong> ￥<?php echo ($v2["shop_price"]); ?></strong></dd>
							</dl>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<!-- 推荐商品 end -->
			
				<!-- 新品上架 start-->
				<div class="new none">
					<ul>
					<?php if(is_array($new_goods)): $i = 0; $__LIST__ = $new_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v3): $mod = ($i % 2 );++$i;?><li>
							<dl>
								<dt><a href="<?php echo U('goods?id='.$v3['id']);?>"><img src="/Public/Uploads/<?php echo ($v3["sm_logo"]); ?>" alt="" /></a></dt>
								<dd><a href="<?php echo U('goods?id='.$v3['id']);?>"><?php echo ($v3["goods_name"]); ?></a></dd>
								<dd><span>售价：</span><strong> ￥<?php echo ($v3["shop_price"]); ?></strong></dd>
							</dl>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<!-- 新品上架 end-->

				<!-- 猜您喜欢 start -->
				<div class="guess none">
					<ul>
						<li>
							<dl>
								<dt><a href=""><img src="/Public/Home/images/guess1.jpg" alt="" /></a></dt>
								<dd><a href="">Thinkpad USB光电鼠标</a></dd>
								<dd><span>售价：</span><strong> ￥39.00</strong></dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt><a href=""><img src="/Public/Home/images/guess2.jpg" alt="" /></a></dt>
								<dd><a href="">宜客莱（ECOLA）电脑散热器</a></dd>
								<dd><span>售价：</span><strong> ￥89.00</strong></dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt><a href=""><img src="/Public/Home/images/guess3.jpg" alt="" /></a></dt>
								<dd><a href="">巴黎欧莱雅男士洁面膏 100ml</a></dd>
								<dd><span>售价：</span><strong> ￥30.00</strong></dd>
							</dl>
						</li>
					</ul>
				</div>
				<!-- 猜您喜欢 end -->

			</div>

		</div>
		<!-- 导购左边区域 end -->
		
		<!-- 侧栏 网站首发 start-->
		<div class="sidebar fl ml10">
			<h2><strong>网站首发</strong></h2>
			<div class="sidebar_wrap">
				<dl class="first">
					<dt class="fl"><a href=""><img src="/Public/Home/images/viewsonic.jpg" alt="" /></a></dt>
					<dd><strong><a href="">ViewSonic优派N710 </a></strong> <em>首发</em></dd>
					<dd>苹果iphone 5免费送！攀高作为全球智能语音血压计领导品牌，新推出的黑金刚高端智能电子血压计，改变传统测量方式让血压测量迈入一体化时代。</dd>
				</dl>

				<dl>
					<dt class="fr"><a href=""><img src="/Public/Home/images/samsung.jpg" alt="" /></a></dt>
					<dd><strong><a href="">Samsung三星Galaxy</a></strong> <em>首发</em></dd>
					<dd>电视百科全书，360°无死角操控，感受智能新体验！双核CPU+双核GPU+MEMC运动防抖，58寸大屏打造全新视听盛宴！</dd>
				</dl>
			</div>
			

		</div>
		<!-- 侧栏 网站首发 end -->
		
	</div>
	<!-- 导购区域 end -->
	
	<div style="clear:both;"></div>

	<!--1F 电脑办公 start -->
	<div class="floor1 floor w1210 bc mt10">
		<!-- 1F 左侧 start -->
		<div class="floor_left fl">
			<!-- 商品分类信息 start-->
			<div class="cate fl">
				<h2>电脑、办公</h2>
				<div class="cate_wrap">
					<ul>
						<li><a href=""><b>.</b>外设产品</a></li>
						<li><a href=""><b>.</b>鼠标</a></li>
						<li><a href=""><b>.</b>笔记本</a></li>
						<li><a href=""><b>.</b>超极本</a></li>
						<li><a href=""><b>.</b>平板电脑</a></li>
						<li><a href=""><b>.</b>主板</a></li>
						<li><a href=""><b>.</b>显卡</a></li>
						<li><a href=""><b>.</b>打印机</a></li>
						<li><a href=""><b>.</b>一体机</a></li>
						<li><a href=""><b>.</b>投影机</a></li>
						<li><a href=""><b>.</b>路由器</a></li>
						<li><a href=""><b>.</b>网卡</a></li>
						<li><a href=""><b>.</b>交换机</a></li>
					</ul>
					<p><a href=""><img src="/Public/Home/images/notebook.jpg" alt="" /></a></p>
				</div>
				

			</div>
			<!-- 商品分类信息 end-->

			<!-- 商品列表信息 start-->
			<div class="goodslist fl">
				<h2>
					<span class="on">推荐商品</span>
					<span>电脑整机</span>
					<span>电脑配件</span>
					<span>办公打印</span>
					<span>网络产品</span>
				</h2>
				<div class="goodslist_wrap">
					<div>
						<ul>
							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/hpG4.jpg" alt="" /></a></dt>
									<dd><a href="">惠普G4-1332TX 14英寸笔</a></dd>
									<dd><span>售价：</span> <strong>￥2999.00</strong></dd>
								</dl>
							</li>

							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/thinkpad e420.jpg" alt="" /></a></dt>
									<dd><a href="">ThinkPad E42014英寸笔..</a></dd>
									<dd><span>售价：</span> <strong>￥4199.00</strong></dd>
								</dl>
							</li>

							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/acer4739.jpg" alt="" /></a></dt>
									<dd><a href="">宏碁AS4739-382G32Mnk</a></dd>
									<dd><span>售价：</span> <strong>￥2799.00</strong></dd>
								</dl>
							</li>

							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/samsung6800.jpg" alt="" /></a></dt>
									<dd><a href="">三星Galaxy Tab P6800.</a></dd>
									<dd><span>售价：</span> <strong>￥4699.00</strong></dd>
								</dl>
							</li>

							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/lh531.jpg" alt="" /></a></dt>
									<dd><a href="">富士通LH531 14.1英寸笔记</a></dd>
									<dd><span>售价：</span> <strong>￥2189.00</strong></dd>
								</dl>
							</li>

							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/qinghuax2.jpg" alt="" /></a></dt>
									<dd><a href="">清华同方精锐X2笔记本 </a></dd>
									<dd><span>售价：</span> <strong>￥2499.00</strong></dd>
								</dl>
							</li>
						</ul>
					</div>
					
					<div class="none">
						<ul>
							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/hpG4.jpg" alt="" /></a></dt>
									<dd><a href="">惠普G4-1332TX 14英寸笔</a></dd>
									<dd><span>售价：</span> <strong>￥2999.00</strong></dd>
								</dl>
							</li>

							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/qinghuax2.jpg" alt="" /></a></dt>
									<dd><a href="">清华同方精锐X2笔记本 </a></dd>
									<dd><span>售价：</span> <strong>￥2499.00</strong></dd>
								</dl>
							</li>
							
						</ul>
					</div>

					<div class="none">
						<ul>
							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/thinkpad e420.jpg" alt="" /></a></dt>
									<dd><a href="">ThinkPad E42014英寸笔..</a></dd>
									<dd><span>售价：</span> <strong>￥4199.00</strong></dd>
								</dl>
							</li>

							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/acer4739.jpg" alt="" /></a></dt>
									<dd><a href="">宏碁AS4739-382G32Mnk</a></dd>
									<dd><span>售价：</span> <strong>￥2799.00</strong></dd>
								</dl>
							</li>
						</ul>
					</div>

					<div class="none">
						<ul>
							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/acer4739.jpg" alt="" /></a></dt>
									<dd><a href="">宏碁AS4739-382G32Mnk</a></dd>
									<dd><span>售价：</span> <strong>￥2799.00</strong></dd>
								</dl>
							</li>

							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/samsung6800.jpg" alt="" /></a></dt>
									<dd><a href="">三星Galaxy Tab P6800.</a></dd>
									<dd><span>售价：</span> <strong>￥4699.00</strong></dd>
								</dl>
							</li>
						</ul>
					</div>

					<div class="none">
						<ul>
							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/samsung6800.jpg" alt="" /></a></dt>
									<dd><a href="">三星Galaxy Tab P6800.</a></dd>
									<dd><span>售价：</span> <strong>￥4699.00</strong></dd>
								</dl>
							</li>

							<li>
								<dl>
									<dt><a href=""><img src="/Public/Home/images/lh531.jpg" alt="" /></a></dt>
									<dd><a href="">富士通LH531 14.1英寸笔记</a></dd>
									<dd><span>售价：</span> <strong>￥2189.00</strong></dd>
								</dl>
							</li>
						</ul>
					</div>

				</div>
			</div>
			<!-- 商品列表信息 end-->
		</div>
		<!-- 1F 左侧 end -->
		
		<!-- 右侧 start -->
		<div class="sidebar fl ml10">
			<!-- 品牌旗舰店 start -->
			<div class="brand">
				<h2><a href="">更多品牌&nbsp;></a><strong>品牌旗舰店</strong></h2>
				<div class="sidebar_wrap">
					<ul>
						<li><a href=""><img src="/Public/Home/images/dell.gif" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/acer.gif" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/fujitsu.jpg" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/hp.jpg" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/lenove.jpg" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/samsung.gif" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/dlink.gif" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/seagate.jpg" alt="" /></a></li>
						<li><a href=""><img src="/Public/Home/images/intel.jpg" alt="" /></a></li>
					</ul>
				</div>
			</div>
			<!-- 品牌旗舰店 end -->
			
			<!-- 分类资讯 start -->
			<div class="info mt10">
				<h2><strong>分类资讯</strong></h2>
				<div class="sidebar_wrap">
					<ul>
						<li><a href=""><b>.</b>iphone 5s土豪金大量到货</a></li>
						<li><a href=""><b>.</b>三星note 3低价促销</a></li>
						<li><a href=""><b>.</b>thinkpad x240即将上市</a></li>
						<li><a href=""><b>.</b>双十一来临，众商家血拼</a></li>
					</ul>
				</div>
				
			</div>
			<!-- 分类资讯 end -->
			
			<!-- 广告 start -->
			<div class="ads mt10">
				<a href=""><img src="/Public/Home/images/canon.jpg" alt="" /></a>
			</div>
			<!-- 广告 end -->
		</div>
		<!-- 右侧 end -->

	</div>
	<!--1F 电脑办公 end -->

<!--内容主体end-->

	<div style="clear:both;"></div>

	<!-- 底部导航 start -->
	<div class="bottomnav w1210 bc mt10">
		<div class="bnav1">
			<h3><b></b> <em>购物指南</em></h3>
			<ul>
				<li><a href="">购物流程</a></li>
				<li><a href="">会员介绍</a></li>
				<li><a href="">团购/机票/充值/点卡</a></li>
				<li><a href="">常见问题</a></li>
				<li><a href="">大家电</a></li>
				<li><a href="">联系客服</a></li>
			</ul>
		</div>
		
		<div class="bnav2">
			<h3><b></b> <em>配送方式</em></h3>
			<ul>
				<li><a href="">上门自提</a></li>
				<li><a href="">快速运输</a></li>
				<li><a href="">特快专递（EMS）</a></li>
				<li><a href="">如何送礼</a></li>
				<li><a href="">海外购物</a></li>
			</ul>
		</div>

		
		<div class="bnav3">
			<h3><b></b> <em>支付方式</em></h3>
			<ul>
				<li><a href="">货到付款</a></li>
				<li><a href="">在线支付</a></li>
				<li><a href="">分期付款</a></li>
				<li><a href="">邮局汇款</a></li>
				<li><a href="">公司转账</a></li>
			</ul>
		</div>

		<div class="bnav4">
			<h3><b></b> <em>售后服务</em></h3>
			<ul>
				<li><a href="">退换货政策</a></li>
				<li><a href="">退换货流程</a></li>
				<li><a href="">价格保护</a></li>
				<li><a href="">退款说明</a></li>
				<li><a href="">返修/退换货</a></li>
				<li><a href="">退款申请</a></li>
			</ul>
		</div>

		<div class="bnav5">
			<h3><b></b> <em>特色服务</em></h3>
			<ul>
				<li><a href="">夺宝岛</a></li>
				<li><a href="">DIY装机</a></li>
				<li><a href="">延保服务</a></li>
				<li><a href="">家电下乡</a></li>
				<li><a href="">京东礼品卡</a></li>
				<li><a href="">能效补贴</a></li>
			</ul>
		</div>
	</div>
	<!-- 底部导航 end -->
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt10">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="/Public/Home/images/xin.png" alt="" /></a>
			<a href=""><img src="/Public/Home/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="/Public/Home/images/police.jpg" alt="" /></a>
			<a href=""><img src="/Public/Home/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->
</body>
<script type="text/javascript">
	$.get('<?php echo U("Member/ajaxChkLogin");?>','',function(res){
		var data=JSON.parse(res);
		if(data.ok == 1)
			var html = "您好，"+data.email+" <a href='<?php echo U('Home/Member/logout'); ?>'>[退出]</a>";
		else
			var html = "您好，欢迎来到京西！[<a href='<?php echo U('Home/Member/login'); ?>'>登录</a>] [<a href='<?php echo U('Home/Member/regist'); ?>'>免费注册</a>] ";
		$("#logInfo").html(html);
	})
</script>
</html>