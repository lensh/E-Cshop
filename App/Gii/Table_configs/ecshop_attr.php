<?php
return array(
	'tableName' => 'ecshop_attr',    // 表名
	'tableCnName' => '属性',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array('type_id','attr_name','attr_type','attr_option_values')",
	'updateFields' => "array('id','type_id','attr_name','attr_type','attr_option_values')",
	'validate' => "
		array('type_id', 'require', '所在的类型的id不能为空！', 1, 'regex', 3),
		array('type_id', 'number', '所在的类型的id必须是一个整数！', 1, 'regex', 3),
		array('attr_name', 'require', '属性名不能为空！', 1, 'regex', 3),
		array('attr_name', '1,30', '属性名的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('attr_type', 'require', '属性的类型0：唯一 1：可选不能为空！', 1, 'regex', 3),
		array('attr_type', 'number', '属性的类型0：唯一 1：可选必须是一个整数！', 1, 'regex', 3),
		array('attr_option_values', 'require', '属性的可选值，多个可选值用，隔开不能为空！', 1, 'regex', 3),
		array('attr_option_values', '1,150', '属性的可选值，多个可选值用，隔开的值最长不能超过 150 个字符！', 1, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'type_id' => array(
			'text' => '所在的类型的id',
			'type' => 'text',
			'default' => '',
		),
		'attr_name' => array(
			'text' => '属性名',
			'type' => 'text',
			'default' => '',
		),
		'attr_type' => array(
			'text' => '属性的类型0：唯一 1：可选',
			'type' => 'radio',
			'values' =>array(
				'0'=>'唯一',
				'1'=>'可选'
				)
		),
		'attr_option_values' => array(
			'text' => '属性的可选值，多个可选值用，隔开',
			'type' => 'text',
			'default' => '',
		),
	)
);