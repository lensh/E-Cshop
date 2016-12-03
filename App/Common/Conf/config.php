<?php
return array(
	//设置可访问目录
	'MODULE_ALLOW_LIST'=>array('Home','Admin','Gii'),
	//设置默认目录
	'DEFAULT_MODULE'=>'Home',
	//数据库配置
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'localhost',
	'DB_PORT'=>'3306',
	'DB_USER'=>'root',
	'DB_PWD'=>'',
	'DB_NAME'=>'ecshop',
	'DB_PREFIX'=>'ecshop_',
	//URL模式
	'URL_MODEL'=>2,   //url重写模式
	/*图片相关的配置*/
	'IMG_maxSize' => '3M',
	'IMG_exts' => array('jpg', 'pjpeg', 'bmp', 'gif', 'png', 'jpeg'),
	'IMG_rootPath' => './Public/Uploads/',
	'IMG_URL'=>__ROOT__.'/Public/Uploads/',
	/*修改I函数底层过滤时使用的函数*/
	'DEFAULT_FILTER' => 'trim,removeXSS',
);