<?php
return array(
	//设置模版替换变量
	'TMPL_PARSE_STRING' => array(
		'__CSS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/css',
		'__JS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/js',
		'__IMG__'=>__ROOT__.'/Public/'.MODULE_NAME.'/img',
	),
	//页面Trace
	'SHOW_PAGE_TRACE'=>true,	
	//启用路由功能
	'URL_ROUTER_ON'=>true,
	//配置路由规则
	'URL_ROUTE_RULES'=>array(
		//每条键值对，对应一个路由规则
		'i/:domain'=>'Space/index',
		//对应的URL就是Space/index/i/xiaoxin
	),
);