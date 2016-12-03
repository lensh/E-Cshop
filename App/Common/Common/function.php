<?php
/**
 * 防止XSS攻击
 * @param  [type] $val [description]
 * @return [type]      [description]
 */
function removeXSS($val)
{
	// 实现了一个单例模式，这个函数调用多次时只有第一次调用时生成了一个对象之后再调用使用的是第一次生成的对象（只生成了一个对象），使性能更好
	static $obj = null;
	if($obj === null)
	{
		require('./HTMLPurifier/HTMLPurifier.includes.php');
		$config = HTMLPurifier_Config::createDefault();
		// 保留a标签上的target属性
		$config->set('HTML.TargetBlank', TRUE);
		$obj = new HTMLPurifier($config);  
	}
	return $obj->purify($val);  
}

/**
 * 上传图片
 * @param  string $imgName 原图地址
 * @param  string $dirName 保存到哪个目录
 * @param  array  $thumb   缩略图的数组
 * @return array  
 */
function uploadOne($imgName, $dirName, $thumb = array())
{
	// 上传LOGO
	if(isset($_FILES[$imgName]) && $_FILES[$imgName]['error'] == 0)
	{
		$rootPath = C('IMG_rootPath');
		$upload = new \Think\Upload(array(
			'rootPath' => $rootPath,
		));// 实例化上传类
		$upload->maxSize = (int)C('IMG_maxSize') * 1024 * 1024;// 设置附件上传大小
		$upload->exts = C('IMG_exts');// 设置附件上传类型
		/// $upload->rootPath = $rootPath; // 设置附件上传根目录
		$upload->savePath = $dirName . '/'; // 图片二级目录的名称
		// 上传文件 ,TP调用Upload时，会把表单中所有的图片都上传
		$info = $upload->upload(array($imgName=>$_FILES[$imgName]));
		if(!$info)
		{
			return array(
				'ok' => 0,
				'error' => $upload->getError(),
			);
		}
		else
		{
			$ret['ok'] = 1;
		    $ret['images'][0] = $logoName = $info[$imgName]['savepath'] . $info[$imgName]['savename'];
		    // 判断是否生成缩略图
		    if($thumb)
		    {
		    	$image = new \Think\Image();
		    	// 循环生成缩略图
		    	foreach ($thumb as $k => $v)
		    	{
		    		$ret['images'][$k+1] = $info[$imgName]['savepath'] . 'thumb_'.$k.'_' .$info[$imgName]['savename'];
		    		// 打开要处理的图片
				    $image->open($rootPath.$logoName);
				    $image->thumb($v[0], $v[1])->save($rootPath.$ret['images'][$k+1]);
		    	}
		    }
		    return $ret;
		}
	}
}

/**
 * 显示图片
 * @param  [type] $url    [description]
 * @param  string $width  [description]
 * @param  string $height [description]
 * @return [type]         [description]
 */
function showImage($url, $width='', $height='')
{
	$url = C('IMG_URL').$url;
	if($width)
		$width = "width='$width'";
	if($height)
		$height = "height='$height'";
	echo "<img src='$url' $width $width />";
}

/**
 * 删除图片
 * @param  array $images 一维数组：所有要删除的图片的路径
 * @return void 
 */
function deleteImage($images){
	// 先取出图片所在目录
	$rp = C('IMG_rootPath');
	foreach ($images as $v)
	{
		// @错误抵制符：忽略掉错误,一般在删除文件时都添加上这个
		@unlink($rp . $v);
	}
}

/**
 * 判断批量上传的数组有没有图片
 * @param  [type]  $imgName [description]
 * @return boolean          [description]
 */
function hasImage($imgName){
	foreach ($_FILES[$imgName]['error'] as $v) {
		if($v==0)  return true;
	}
	return false;
}

/**
 * 按attr_id排序
 * @param  [type] $a [description]
 * @param  [type] $b [description]
 * @return [type]    [description]
 */
function attr_id_sort($a,$b){
	if($a['attr_id']==$b['attr_id'])  
		return 0;
	return $a['attr_id']<$b['attr_id']?-1:1;
}