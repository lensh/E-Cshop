<?php
return array(
	'tableName' => 'php34_admin',    // 表名
	'tableCnName' => '管理员',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array('username','password','is_use')",
	'updateFields' => "array('id','username','password','is_use')",
	'validate' => "
		array('username', 'require', '账号不能为空！', 1, 'regex', 3),
		array('username', '1,30', '账号的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('password', 'require', '密码不能为空！', 1, 'regex', 3),
		array('password', '1,32', '密码的值最长不能超过 32 个字符！', 1, 'length', 3),
		array('is_use', 'number', '是否启用 1：启用0：禁用必须是一个整数！', 2, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'username' => array(
			'text' => '账号',
			'type' => 'text',
			'default' => '',
		),
		'password' => array(
			'text' => '密码',
			'type' => 'password',
			'default' => '',
		),
		'is_use' => array(
			'text' => '是否启用 1：启用0：禁用',
			'type' => 'radio',
			'values' => array(
				'1' => '启用',
				'0' => '禁用',
			),
			'default' => '1',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('username', 'normal', '', 'like', '账号'),
		array('is_use', 'in', '1-启用,0-禁用', '', '是否启用'),
	),
);