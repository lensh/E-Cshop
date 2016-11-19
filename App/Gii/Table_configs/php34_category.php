<?php
return array(
	'tableName' => 'php34_category',    // 表名
	'tableCnName' => '商品分类',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 1,             // 是否无限级（递归）
	'diguiName' => 'cat_name',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array('cat_name','parent_id')",
	'updateFields' => "array('id','cat_name','parent_id')",
	'validate' => "
		array('cat_name', 'require', '分类名称不能为空！', 1, 'regex', 3),
		array('cat_name', '1,30', '分类名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('parent_id', 'number', '上级分类的ID，0：代表顶级必须是一个整数！', 2, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'cat_name' => array(
			'text' => '分类名称',
			'type' => 'text',
			'default' => '',
		),
		'parent_id' => array(
			'text' => '上级分类的ID，0：代表顶级',
			'type' => 'text',
			'default' => '0',
		),
	),
	/**************** 搜索字段的配置 **********************/
);