<?php
return array(
	'tableName' => 'ecshop_goods',    // 表名
	'tableCnName' => '商品',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array('goods_name','cat_id','brand_id','market_price','shop_price','jifen','jyz','jifen_price','is_promote','promote_price','promote_start_time','promote_end_time','is_hot','is_new','is_best','is_on_sale','seo_keyword','seo_description','type_id','sort_num','is_delete','goods_desc')",
	'updateFields' => "array('id','goods_name','cat_id','brand_id','market_price','shop_price','jifen','jyz','jifen_price','is_promote','promote_price','promote_start_time','promote_end_time','is_hot','is_new','is_best','is_on_sale','seo_keyword','seo_description','type_id','sort_num','is_delete','goods_desc')",
	'validate' => "
		array('goods_name', 'require', '商品名称不能为空！', 1, 'regex', 3),
		array('goods_name', '1,45', '商品名称的值最长不能超过 45 个字符！', 1, 'length', 3),
		array('cat_id', 'require', '主分类的id不能为空！', 1, 'regex', 3),
		array('cat_id', 'number', '主分类的id必须是一个整数！', 1, 'regex', 3),
		array('brand_id', 'require', '品牌的id不能为空！', 1, 'regex', 3),
		array('brand_id', 'number', '品牌的id必须是一个整数！', 1, 'regex', 3),
		array('market_price', 'currency', '市场价必须是货币格式！', 2, 'regex', 3),
		array('shop_price', 'currency', '本店价必须是货币格式！', 2, 'regex', 3),
		array('jifen', 'require', '赠送积分不能为空！', 1, 'regex', 3),
		array('jifen', 'number', '赠送积分必须是一个整数！', 1, 'regex', 3),
		array('jyz', 'require', '赠送经验值不能为空！', 1, 'regex', 3),
		array('jyz', 'number', '赠送经验值必须是一个整数！', 1, 'regex', 3),
		array('jifen_price', 'require', '如果要用积分兑换，需要的积分数不能为空！', 1, 'regex', 3),
		array('jifen_price', 'number', '如果要用积分兑换，需要的积分数必须是一个整数！', 1, 'regex', 3),
		array('is_promote', 'number', '是否促销必须是一个整数！', 2, 'regex', 3),
		array('promote_price', 'currency', '促销价必须是货币格式！', 2, 'regex', 3),
		array('promote_start_time', 'number', '促销开始时间必须是一个整数！', 2, 'regex', 3),
		array('promote_end_time', 'number', '促销结束时间必须是一个整数！', 2, 'regex', 3),
		array('is_hot', 'number', '是否热卖必须是一个整数！', 2, 'regex', 3),
		array('is_new', 'number', '是否新品必须是一个整数！', 2, 'regex', 3),
		array('is_best', 'number', '是否精品必须是一个整数！', 2, 'regex', 3),
		array('is_on_sale', 'number', '是否上架：1：上架，0：下架必须是一个整数！', 2, 'regex', 3),
		array('seo_keyword', '1,150', 'seo优化[搜索引擎【百度、谷歌等】优化]_关键字的值最长不能超过 150 个字符！', 2, 'length', 3),
		array('seo_description', '1,150', 'seo优化[搜索引擎【百度、谷歌等】优化]_描述的值最长不能超过 150 个字符！', 2, 'length', 3),
		array('type_id', 'number', '商品类型id必须是一个整数！', 2, 'regex', 3),
		array('sort_num', 'number', '排序数字必须是一个整数！', 2, 'regex', 3),
		array('is_delete', 'number', '是否放到回收站：1：是，0：否必须是一个整数！', 2, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'goods_name' => array(
			'text' => '商品名称',
			'type' => 'text',
			'default' => '',
		),
		'cat_id' => array(
			'text' => '主分类的id',
			'type' => 'text',
			'default' => '',
		),
		'brand_id' => array(
			'text' => '品牌的id',
			'type' => 'text',
			'default' => '',
		),
		'market_price' => array(
			'text' => '市场价',
			'type' => 'text',
			'default' => '0.00',
		),
		'shop_price' => array(
			'text' => '本店价',
			'type' => 'text',
			'default' => '0.00',
		),
		'jifen' => array(
			'text' => '赠送积分',
			'type' => 'text',
			'default' => '',
		),
		'jyz' => array(
			'text' => '赠送经验值',
			'type' => 'text',
			'default' => '',
		),
		'jifen_price' => array(
			'text' => '如果要用积分兑换，需要的积分数',
			'type' => 'text',
			'default' => '',
		),
		'is_promote' => array(
			'text' => '是否促销',
			'type' => 'text',
			'default' => '0',
		),
		'promote_price' => array(
			'text' => '促销价',
			'type' => 'text',
			'default' => '0.00',
		),
		'promote_start_time' => array(
			'text' => '促销开始时间',
			'type' => 'text',
			'default' => '0',
		),
		'promote_end_time' => array(
			'text' => '促销结束时间',
			'type' => 'text',
			'default' => '0',
		),
		'logo' => array(
			'text' => 'logo原图',
			'type' => 'file',
			'thumbs' => array(
				array(150, 150, 2)
			),
			'save_fields' => array('logo','sm_logo'),
			'default' => '',
		),
		'is_hot' => array(
			'text' => '是否热卖',
			'type' => 'radio',
			'values'=>array(
				'1'=>'是',
				'0'=>'否'
			),
			'default' => '0'
		),
		'is_new' => array(
			'text' => '是否新品',
			'type' => 'radio',
			'values'=>array(
				'1'=>'是',
				'0'=>'否'
			),
			'default' => '0',
		),
		'is_best' => array(
			'text' => '是否精品',
			'type' => 'radio',
			'values'=>array(
				'1'=>'是',
				'0'=>'否'
			),
			'default' => '0',
		),
		'is_on_sale' => array(
			'text' => '是否上架：1：上架，0：下架',
			'type' => 'radio',
			'values'=>array(
				'1'=>'上架',
				'0'=>'下架'
			),
			'default' => '1',
		),
		'seo_keyword' => array(
			'text' => 'seo优化[搜索引擎【百度、谷歌等】优化]_关键字',
			'type' => 'text',
			'default' => '',
		),
		'seo_description' => array(
			'text' => 'seo优化[搜索引擎【百度、谷歌等】优化]_描述',
			'type' => 'text',
			'default' => '',
		),
		'type_id' => array(
			'text' => '商品类型id',
			'type' => 'text',
			'default' => '0',
		),
		'sort_num' => array(
			'text' => '排序数字',
			'type' => 'text',
			'default' => '100',
		),
		'goods_desc' => array(
			'text' => '商品描述',
			'type' => 'html',
			'default' => '',
		)
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('goods_name', 'normal', '', 'like', '商品名称'),
		array('cat_id', 'normal', '', 'eq', '主分类的id'),
		array('brand_id', 'normal', '', 'eq', '品牌的id'),
		array('shop_price', 'between', 'shop_pricefrom,shop_priceto', '', '本店价'),
		array('is_hot', 'in', '1-是,0-否','eq', '是否热卖'),
		array('is_new', 'in', '1-是,0-否','eq', '是否新品'),
		array('is_best','in', '1-是,0-否','eq', '是否精品'),
		array('is_on_sale','in','1-上架,0-下架','eq', '是否上架：1：上架，0：下架'),
		array('type_id', 'normal', '', 'eq', '商品类型id'),
		array('addtime', 'betweenTime', 'startTime,endTime', 'eq', '添加时间'),
	)
);