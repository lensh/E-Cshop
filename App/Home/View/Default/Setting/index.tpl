<extend name="Base/common" />

<block name="head">
<script type="text/javascript" src="__JS__/setting.js"></script>
<link rel="stylesheet" href="__CSS__/setting.css">
</block>

<block name="main">
	<div class="main_left">
		<ul>
			<li><a href="{:U('Setting/index')}" class="selected">个人设置</a></li>
			<li><a href="{:U('Setting/avatar')}">头像设置</a></li>
			<li><a href="{:U('Setting/domain')}">个性域名</a></li>
			<li><a href="{:U('Setting/refer')}">@提及到我</a></li>
			<li><a href="{:U('Setting/approve')}">申请认证</a></li>
		</ul>
	</div>
	<div class="main_right">
		<h2>个人设置</h2>
		<dl>
			<dd>帐号名称：{$user.username}</dd>
			<dd>电子邮箱：<input type="text" name="email" value="{$user.email}" class="text"> <strong style="color:red;">*</strong></dd>
			<dd><span>个人简介：</span><textarea name="intro">{$user.extend.intro}</textarea></dd>
			<dd><input type="submit" class="submit" value="修改"></dd>
		</dl>
		<p style="margin:20px 0;font-size:13px;color:red;text-align:center;">(PS：这里为了不再重复，不做前后端验证)</p>
	</div>
</block>