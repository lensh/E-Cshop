<?php
return array(
	'tableName' => 'ecshop_type',    // 表名
	'tableCnName' => '类型表',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array('type_name')",
	'updateFields' => "array('id','type_name')",
	'validate' => "
		array('type_name', 'require', '商品类型不能为空！', 1, 'regex', 3),
		array('type_name', '1,30', '商品类型的值最长不能超过 30 个字符！', 1, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'type_name' => array(
			'text' => '商品类型',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('type_name', 'normal', '', 'like', '商品类型'),
	),
);