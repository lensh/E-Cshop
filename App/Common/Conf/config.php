<?php
return array(
	//设置可访问目录
	'MODULE_ALLOW_LIST'=>array('Home','Admin'),
	//设置默认目录
	'DEFAULT_MODULE'=>'Admin',
	//数据库配置
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'localhost',
	'DB_PORT'=>'3306',
	'DB_USER'=>'root',
	'DB_PWD'=>'',
	'DB_NAME'=>'php34',
	'DB_PREFIX'=>'php34_',
	//URL模式
	'URL_MODEL'=>2,   //url重写模式
	/*图片相关的配置*/
	'IMG_maxSize' => '3M',
	'IMG_exts' => array('jpg', 'pjpeg', 'bmp', 'gif', 'png', 'jpeg'),
	'UPLOAD_PATH' => './Public/Uploads/',
	/*修改I函数底层过滤时使用的函数*/
	'DEFAULT_FILTER' => 'trim,removeXSS',
);