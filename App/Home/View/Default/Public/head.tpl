<meta charset="UTF-8">
<title>微博系统--我的首页</title>
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript" src="__JS__/jquery.ui.js"></script>
<script type="text/javascript" src="__JS__/base.js"></script>
<link rel="stylesheet" href="__CSS__/jquery.ui.css">
<link rel="stylesheet" href="__CSS__/base.css">
<block name="head"></block>
<script type="text/javascript">
var ThinkPHP = {
	'ROOT' : '__ROOT__',
	'MODULE' : '__MODULE__',
	'IMG' : '__PUBLIC__/{:MODULE_NAME}/img',
	'FACE' : '__PUBLIC__/{:MODULE_NAME}/face',
	'UPLOADIFY' : '__UPLOADIFY__',
	'IMAGEURL' : '{:U("File/image")}',
	'FACEURL' : '{:U("File/face")}',
	'BIGFACE' : '{:session("user_auth")["face"]->big}',
	'INDEX' : '{:U("Index/index")}',
};
</script>