<volist name="ajaxList" id="obj">
<dl class="weibo_content_data">
	<dt><a href="javascript:void(0)">
	<empty name="obj.face">
		<img src="__IMG__/small_face.jpg" alt="">
	<else/>
		<img src="__ROOT__/{$obj.face}" alt="">
	</empty>
	</a></dt>
	<dd>
		<h4><a href="javascript:void(0)">{$obj.username}</a></h4>
		<p>{$obj.content}</p>
		<switch name="obj.count">
			<case value="0"></case>
			<case value="1">
				<div class="img" style="display:block;"><img src="__ROOT__/{$obj['images'][0]['thumb']}" alt=""></div>
				<div class="img_zoom" style="display:none">
					<ol>
						<li class="in"><a href="javascript:void(0)">收起</a></li>
						<li class="source"><a href="__ROOT__/{$obj['images'][0]['source']}" target="_blank">查看原图</a></li>
					</ol>
					<img data="__ROOT__/{$obj['images'][0]['unfold']}" src="__IMG__/loading_100.png" alt="">
				</div>
			</case>
			<default />
				<for start="0" end="$obj['count']">
					<div class="imgs"><img src="__ROOT__/{$obj['images'][$i]['thumb']}" unfold-src="__ROOT__/{$obj['images'][$i]['unfold']}" source-src="__ROOT__/{$obj['images'][$i]['source']}" alt=""></div>
				</for>
		</switch>
		<div class="footer">
			<span class="time">{$obj.time}</span>
			<span class="handler">赞(0) | 转播 | 评论 | 收藏</span>
		</div>
	</dd>
</dl>
</volist>