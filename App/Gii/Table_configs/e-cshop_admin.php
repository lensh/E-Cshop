<?php
return array(
	'tableName' => 'e-cshop_admin',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array()",
	'updateFields' => "array('id',)",
	'validate' => "
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
	),
);