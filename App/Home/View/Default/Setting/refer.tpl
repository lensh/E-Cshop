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
			<li><a href="{:U('Setting/refer')}" class="selected">@提及到我</a></li>
			<li><a href="{:U('Setting/approve')}">申请认证</a></li>
		</ul>
	</div>
	<div class="main_right">
		<h2>@提及到我</h2>
		<dl style="font-size:14px;">
			<volist name="getRefer" id="obj">
				<switch name="obj.read">
					<case value="0"><dd class="a">您被微博：<a href="javascript:alert('点击进入此微博详情！自行完成！')">“{$obj.topic.content|mb_substr=0,10,utf8}...”</a> 提及到！<b class="read red" rid="{$obj.id}">[未读]</b></dd></case>
					<case value="1"><dd class="b">您被微博：<a href="javascript:alert('点击进入此微博详情！自行完成！')">“{$obj.topic.content|mb_substr=0,10,utf8}...”</a> 提及到！<b class="read green">[已读]</b></dd></case>
				</switch>
			</volist>
		</dl>
	</div>
</block>