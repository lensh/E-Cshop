<extend name="Base/common" />

<block name="head">
<link rel="stylesheet" href="__CSS__/space.css">
</block>

<block name="main">
	<div class="main_left">
		<div class="header">
			<dl>
				<empty name="bigFace">
					<dt><img src="__IMG__/big.jpg" alt=""></dt>
				<else/>
					<dt><img src="__ROOT__/{$bigFace}" alt=""></dt>
				</empty>
				<dd class="username">{$user.username}
					<eq name="approve.state" value="1">
					<img src="__IMG__/approve.png" alt="认证个人" title="认证个人">
					</eq>
				</dd>
				<dd class="intro">个人简介：{$user.extend.intro}</dd>
			</dl>
		</div>
	</div>
	<div class="main_right">
		<eq name="approve.state" value="1">
			<dl>
				<dt>微博认证资料</dt>
				<dd>{$approve.name}，{$approve.info}</dd>
			</dl>
		</eq>
	</div>
</block>