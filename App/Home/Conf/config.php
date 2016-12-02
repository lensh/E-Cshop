<?php
return array(
	//页面Trace
	'SHOW_PAGE_TRACE'=>true,	
	//启用路由功能
	'URL_ROUTER_ON'=>true,
	//配置路由规则
	'URL_ROUTE_RULES'=>array(
		//每条键值对，对应一个路由规则
		'i/:domain'=>'Space/index',
		//对应的URL就是Space/index/i/xiaoxin
	)
);