<extend name="Base/common" />

<block name="head">
<script type="text/javascript" src="__JS__/setting.js"></script>
<link rel="stylesheet" href="__CSS__/setting.css">
</block>

<block name="main">
	<div class="main_left">
		<ul>
			<li><a href="{:U('Setting/index')}">个人设置</a></li>
			<li><a href="{:U('Setting/avatar')}">头像设置</a></li>
			<li><a href="{:U('Setting/domain')}" class="selected">个性域名</a></li>
			<li><a href="{:U('Setting/refer')}">@提及到我</a></li>
			<li><a href="{:U('Setting/approve')}">申请认证</a></li>
		</ul>
	</div>
	<div class="main_right">
		<h2>个性域名</h2>
		<dl>
			<dd>个性域名必须是4 ~ 10个字符范围内，只能是数字、字母组成，且必须没有被注册！注册后，无法修改！</dd>
			<empty name="domain">
				<dd><input type="text" name="domain" class="text"> <strong style="color:red;">*</strong></dd>
				<dd><input type="submit" class="register" value="注册"></dd>
			<else/>
				您的个性域名地址为：<a href="__ROOT__/i/{$domain}" target="_blank">http://{:$_SERVER['SERVER_NAME']}__ROOT__/i/{$domain}</a>
			</empty>
		</dl>
		<p style="margin:20px 0;font-size:13px;color:red;text-align:center;">(PS：这里不做前后端验证，不做域名唯一性验证，请自行完成)</p>
	</div>
</block>