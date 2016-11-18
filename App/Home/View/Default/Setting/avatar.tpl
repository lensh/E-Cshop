<extend name="Base/common" />

<block name="head">
<!--上传js-->
<script type="text/javascript" src="__UPLOADIFY__/jquery.uploadify.min.js"></script>
<!--裁剪js-->
<script type="text/javascript" src="__JS__/jquery-migrate-1.2.1.js"></script>
<script type="text/javascript" src="__JS__/jquery.Jcrop.js"></script>
<!--自己的js-->
<script type="text/javascript" src="__JS__/setting.js"></script>
<!--上传的css-->
<link rel="stylesheet" href="__UPLOADIFY__/uploadify.css">
<!--裁剪的css-->
<link rel="stylesheet" href="__CSS__/jquery.Jcrop.css">
<!--自己的css-->
<link rel="stylesheet" href="__CSS__/setting.css">
</block>

<block name="main">
	<div class="main_left">
		<ul>
			<li><a href="{:U('Setting/index')}">个人设置</a></li>
			<li><a href="{:U('Setting/avatar')}" class="selected">头像设置</a></li>
			<li><a href="{:U('Setting/domain')}">个性域名</a></li>
			<li><a href="{:U('Setting/refer')}">@提及到我</a></li>
			<li><a href="{:U('Setting/approve')}">申请认证</a></li>
		</ul>
	</div>
	<div class="main_right">
		<h2>头像设置</h2>
		<p class="face_info">请上传一张头像图片，尺寸大小不低于200px*200px</p>
		<div class="face">
			<empty name="bigFace">
			<img id="face" src="__IMG__/big.jpg">
			<else />
			<img id="face" src="__ROOT__{$bigFace}">
			</empty>
			<span id="preview_box" class="crop_preview"><img id="crop_preview" src="__IMG__/big.jpg" /></span>
			<a href="javascript:void(0)" class="save" style="display:none;margin:10px 0 0 0;">保存</a>
			<a href="javascript:void(0)" class="cancel" style="display:none;margin:10px 0 0 0;">取消</a>
			<input type="hidden" id="x" name="x">
			<input type="hidden" id="y" name="y">
			<input type="hidden" id="w" name="w">
			<input type="hidden" id="h" name="h">
			<input type="hidden" id="url" name="url">
			<input type="file" name="file" id="file">
		</div>
	</div>
</block>






