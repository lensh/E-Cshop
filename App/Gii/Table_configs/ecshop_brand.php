<?php
return array(
	'tableName' => 'ecshop_brand',    // 表名
	'tableCnName' => '品牌',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array('brand_name','site_url')",
	'updateFields' => "array('id','brand_name','site_url')",
	'validate' => "
		array('brand_name', 'require', '品牌名称不能为空！', 1, 'regex', 3),
		array('brand_name', '1,45', '品牌名称的值最长不能超过 45 个字符！', 1, 'length', 3),
		array('site_url', 'require', '品牌网站地址不能为空！', 1, 'regex', 3),
		array('site_url', '1,150', '品牌网站地址的值最长不能超过 150 个字符！', 1, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'brand_name' => array(
			'text' => '品牌名称',
			'type' => 'text',
			'default' => '',
		),
		'site_url' => array(
			'text' => '品牌网站地址',
			'type' => 'text',
			'default' => '',
		),
		'logo' => array(
			'text' => '品牌logo',
			'type' => 'file',
			'save_fields' => array('logo'),
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('brand_name', 'normal', '', 'like', '品牌名称')
	)
);