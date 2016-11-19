<?php
return array(
	'tableName' => 'php34_goods',    // 表名
	'tableCnName' => '商品',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 0,             // 是否无限级（递归）0:不是 1：是
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array('goods_name','price','goods_desc','is_on_sale','is_delete')",
	'updateFields' => "array('id','goods_name','price','goods_desc','is_on_sale','is_delete')",
	'validate' => "
		array('goods_name', 'require', '商品名称不能为空！', 1, 'regex', 3),
		array('goods_name', '1,45', '商品名称的值最长不能超过 45 个字符！', 1, 'length', 3),
		array('price', 'currency', '商品价格必须是货币格式！', 2, 'regex', 3),
		array('is_on_sale', 'number', '是否上架：1：上架，0：下架必须是一个整数！', 2, 'regex', 3),
		array('is_delete', 'number', '是否已经删除，1：已经删除 0：未删除必须是一个整数！', 2, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'goods_name' => array(
			'text' => '商品名称',
			'type' => 'text',
			'default' => '',
		),
		'logo' => array(
			'text' => '商品logo',
			'type' => 'file',
			// 缩略图的配置
			'thumbs' => array(
				array(150, 150, 2),
			),
			// 数据库中用来存图片的字段名称，第一个是存原图的字段，第二个是存第一个缩略图的字段。。。
			'save_fields' => array('logo', 'sm_logo'),
			'default' => '',
		),
		'price' => array(
			'text' => '商品价格',
			'type' => 'text',
			'default' => '0.00',
		),
		'goods_desc' => array(
			'text' => '商品描述',
			'type' => 'html',
			'default' => '',
		),
		'is_on_sale' => array(
			'text' => '是否上架',
			'type' => 'radio',
			'values' => array(
				'1' => '上架',
				'0' => '下架',
			),
			'default' => '1',
		),
		'is_delete' => array(
			'text' => '是否已经删除',
			'type' => 'radio',
			'values' => array(
				'1' => '已经删除',
				'0' => '未删除',
			),
			'default' => '0',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('goods_name', 'normal', '', 'like', '商品名称'),
		array('price', 'between', 'pricefrom,priceto', '', '价　　格'),
		array('addtime', 'betweenTime', 'sa,ea', '', '添加时间'),
	),
);