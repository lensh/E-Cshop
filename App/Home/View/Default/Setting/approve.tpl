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
			<li><a href="{:U('Setting/domain')}">个性域名</a></li>
			<li><a href="{:U('Setting/refer')}">@提及到我</a></li>
			<li><a href="{:U('Setting/approve')}" class="selected">申请认证</a></li>
		</ul>
	</div>
	<div class="main_right">
		<h2>申请认证</h2>
		<dl>
			<switch name="approve.state">
				<case value="0">
					<dd>您的申请正在审核中，请耐心等待！</dd>
				</case>
				<case value="1">
					<dd>您已认证成功！认证信息如下：</dd>
					<dd>认证名称： {$approve.name}</dd>
					<dd>认证信息： {$approve.info}</dd>
				</case>
				<default />
					<dd>认证名称：<input type="text" name="name" class="text"> <strong style="color:red;">*</strong></dd>
					<dd><span>认证资料：</span><textarea name="info"></textarea> <strong style="color:red;">*</strong></dd>
					<dd><input type="submit" class="approve" value="申请认证"></dd>
			</switch>
		</dl>
		<p style="margin:20px 0;font-size:13px;color:red;text-align:center;">(PS：这里为了不再重复，不做前后端验证)</p>
	</div>
</block>