<?php
return array(
	//页面Trace
	'SHOW_PAGE_TRACE'=>true,	
	//静态缓存
	'HTML_CACHE_ON'=> true, // 开启静态缓存
	'HTML_CACHE_TIME'=>60, // 全局静态缓存有效期（秒）
	'HTML_FILE_SUFFIX'=>'.shtml', //设置静态缓存文件后缀
    // 定义静态缓存规则
	'HTML_CACHE_RULES'=>array(  // 定义静态缓存规则，为前台的每个页面单独配置    
		 //  Index:index是Index控制器的index方法,后面的array的第一个参数
		 //是指生成的静态文件名,第二个参数是指有效时间
		 'Index:index'=>array('index',3600)
	 )
);