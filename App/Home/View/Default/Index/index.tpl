<extend name="Base/common" />

<block name="head">
<script type="text/javascript" src="__JS__/rl_exp.js"></script>
<script type="text/javascript" src="__JS__/lee_pic.js"></script>
<script type="text/javascript" src="__JS__/jquery.scrollUp.js"></script>
<script type="text/javascript" src="__UPLOADIFY__/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="__JS__/index.js"></script>
<link rel="stylesheet" href="__CSS__/rl_exp.css">
<link rel="stylesheet" href="__UPLOADIFY__/uploadify.css">
<link rel="stylesheet" href="__CSS__/index.css">
</block>

<block name="main">
	<div class="main_left">
		<div class="weibo_form">
			<span class="left">和大家分享一点新鲜事吧？</span>
			<span class="right weibo_num">可以输入<strong>140</strong>个字</span>
			<textarea class="weibo_text" id="rl_exp_input"></textarea>
			<a href="javascript:void(0);" class="weibo_face" id="rl_exp_btn">表情<span class="face_arrow_top"></span></a>
			<div class="rl_exp" id="rl_bq" style="display:none;">
				<ul class="rl_exp_tab clearfix">
					<li><a href="javascript:void(0);" class="selected">默认</a></li>
					<li><a href="javascript:void(0);">拜年</a></li>
					<li><a href="javascript:void(0);">浪小花</a></li>
					<li><a href="javascript:void(0);">暴走漫画</a></li>
				</ul>
				<ul class="rl_exp_main clearfix rl_selected"></ul>
				<ul class="rl_exp_main clearfix" style="display:none;"></ul>
				<ul class="rl_exp_main clearfix" style="display:none;"></ul>
				<ul class="rl_exp_main clearfix" style="display:none;"></ul>
				<a href="javascript:void(0);" class="close">×</a>
			</div>
			<a href="javascript:void(0);" class="weibo_pic" id="pic_btn">图片<span class="pic_arrow_top"></span></a>
			<div class="weibo_pic_box" id="pic_box" style="display:none;">
				<div class="weibo_pic_header">
					<span class="weibo_pic_info">共 <span class="weibo_pic_total">0</span> 张，还能上传 <span class="weibo_pic_limit">8</span> 张（按住ctrl可选择多张）</span>
					<a href="javascript:void(0);" class="close">×</a>
				</div>
				<div class="weibo_pic_list"></div>
				<input type="file" name="file" id="file">
			</div>
			<input class="weibo_button" type="button" value="发布">
		</div>	
		<div class="weibo_content">
			<ul>
				<li><a href="javascript:void(0)" class="selected">我关注的<i class="nav_arrow"></i></a></li>
				<li><a href="javascript:void(0)">互听的</a></li>
			</ul>
			
			<div class="msg"></div>	
			
			<!--这里动态插入一个DOM节点-->
			
			<volist name="topicList" id="obj">
			<empty name="obj.reid">
			<dl class="weibo_content_data">
				<dt><a href="javascript:void(0)">
				<empty name="obj.face">
					<empty name="obj.domain">
						<a href="{:U('Space/index', array('id'=>$obj['uid']))}"><img src="__IMG__/small_face.jpg" border="0" alt=""></a>
					<else/>
						<a href="__ROOT__/i/{$obj.domain}"><img src="__IMG__/small_face.jpg" border="0" alt=""></a>
					</empty>
				<else/>
					<empty name="obj.domain">
						<a href="{:U('Space/index', array('id'=>$obj['uid']))}"><img src="__ROOT__/{$obj.face}" border="0" alt=""></a>
					<else/>
						<a href="__ROOT__/i/{$obj.domain}"><img src="__ROOT__/{$obj.face}" border="0" alt=""></a>
					</empty>
				</empty>
				</a></dt>
				<dd>
					<h4>
						<empty name="obj.domain">
							<a href="{:U('Space/index', array('id'=>$obj['uid']))}">{$obj.username}</a>
						<else/>
							<a href="__ROOT__/i/{$obj.domain}">{$obj.username}</a>
						</empty>
					</h4>
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
						<span class="handler">赞(0) | <a href="javascript:void(0)" class="re">转播({$obj.recount})</a> | <a href="javascript:void(0)" class="comment">评论</a> | 收藏</span>
						<div class="re_box re_com_box" style="display:none;">
							<p>表情、字数限制自行完成</p>
							<textarea class="re_text re_com_text" name="commend"></textarea>
							<input type="hidden" name="reid" value="{$obj.id}" />
							<input class="re_button" type="button" value="转播">
						</div>
						<div class="com_box re_com_box" style="display:none;">
							<p>表情、字数限制自行完成</p>
							<textarea class="com_text re_com_text" name="commend"></textarea>
							<input type="hidden" name="tid" value="{$obj.id}" />
							<input class="com_button" type="button" value="评论">
							<div class="comment_content">
								
							</div>
						</div>	
					</div>
				</dd>
			</dl>
			<else/>
			<dl class="weibo_content_data">
				<dt><a href="javascript:void(0)">
				<empty name="obj.face">
					<empty name="obj.domain">
						<a href="{:U('Space/index', array('id'=>$obj['uid']))}"><img src="__IMG__/small_face.jpg" border="0" alt=""></a>
					<else/>
						<a href="__ROOT__/i/{$obj.domain}"><img src="__IMG__/small_face.jpg" border="0" alt=""></a>
					</empty>
				<else/>
					<empty name="obj.domain">
						<a href="{:U('Space/index', array('id'=>$obj['uid']))}"><img src="__ROOT__/{$obj.face}" border="0" alt=""></a>
					<else/>
						<a href="__ROOT__/i/{$obj.domain}"><img src="__ROOT__/{$obj.face}" border="0" alt=""></a>
					</empty>
				</empty>
				</a></dt>
				<dd>
					<h4>
						<empty name="obj.domain">
							<a href="{:U('Space/index', array('id'=>$obj['uid']))}">{$obj.username}</a>
						<else/>
							<a href="__ROOT__/i/{$obj.domain}">{$obj.username}</a>
						</empty>
					</h4>
					<p>{$obj.content}</p>
					<div class="re_content" style="overflow:auto;">
						<h5>
							<empty name="obj.recontent.domain">
								<a href="{:U('Space/index', array('id'=>$obj['recontent']['uid']))}">@{$obj.recontent.username}</a>
							<else/>
								<a href="__ROOT__/i/{$obj.recontent.domain}">@{$obj.recontent.username}</a>
							</empty>
						</h5>
						<p>{$obj.recontent.content}</p>
						<switch name="obj.recontent.count">
							<case value="0"></case>
							<case value="1">
								<div class="img" style="display:block;"><img src="__ROOT__/{$obj['recontent']['images'][0]['thumb']}" alt=""></div>
								<div class="img_zoom" style="display:none">
									<ol>
										<li class="in"><a href="javascript:void(0)">收起</a></li>
										<li class="source"><a href="__ROOT__/{$obj['recontent']['images'][0]['source']}" target="_blank">查看原图</a></li>
									</ol>
									<img data="__ROOT__/{$obj['recontent']['images'][0]['unfold']}" src="__IMG__/loading_100.png" alt="">
								</div>
							</case>
							<default />
								<for start="0" end="$obj['recontent']['count']">
									<div class="imgs"><img src="__ROOT__/{$obj['recontent']['images'][$i]['thumb']}" unfold-src="__ROOT__/{$obj['recontent']['images'][$i]['unfold']}" source-src="__ROOT__/{$obj['recontent']['images'][$i]['source']}" alt=""></div>
								</for>
						</switch>
						<div class="footer">
							<span class="time">{$obj.recontent.time} 该微博共被转播了{$obj.recontent.recount}次</span>
						</div>
					</div>
					<div class="footer">
						<span class="time">{$obj.time}</span>
						<span class="handler">赞(0) | <a href="javascript:void(0)" class="re">转播</a> | <a href="javascript:void(0)" class="comment">评论</a> | 收藏</span>
						<div class="re_box re_com_box" style="display:none;">
							<p>表情、字数限制自行完成</p>
							<textarea class="re_text re_com_text" name="commend"> || @{$obj.username} : {$obj.textarea}</textarea>
							<input type="hidden" name="reid" value="{$obj.reid}" />
							<input class="re_button" type="button" value="转播">
						</div>
						<div class="com_box re_com_box" style="display:none;">
							<p>表情、字数限制自行完成</p>
							<textarea class="com_text re_com_text" name="commend"></textarea>
							<input type="hidden" name="tid" value="{$obj.reid}" />
							<input class="com_button" type="button" value="评论">
							<div class="comment_content">
								
							</div>
						</div>	
					</div>
				</dd>
			</dl>
			</empty>
			</volist>
			
			<div id="loadmore">加载更多 <img src="__IMG__/loadmore.gif" alt=""></div>
			
			<div id="imgs">
				<ol>
					<li class="source"><a href="javascript:void(0)" target="_blank">查看原图</a></li>
				</ol>
				<img src="__IMG__/loading_100.png" alt="">
			</div>
			<img src="__IMG__/close.png" class="imgs_close" alt="">
			
			<!--无配图-->
			<div id="ajax_html1" style="display:none;">
				<dl class="weibo_content_data">
					<dt><a href="javascript:void(0)">
					<empty name="smallFace">
						<img src="__IMG__/small_face.jpg" alt="">
					<else/>
						<img src="__ROOT__/{$smallFace}" alt="">
					</empty>
					</a></dt>
					<dd>
						<h4><a href="javascript:void(0)">{:session('user_auth')['username']}</a></h4>
						<p>#内容#</p>
						<div class="footer">
							<span class="time">刚刚发布</span>
							<span class="handler">赞(0) | 转播 | 评论 | 收藏</span>
						</div>
					</dd>
				</dl>
			</div>
			
			<!--一张配图-->
			<div id="ajax_html2" style="display:none;">
				<dl class="weibo_content_data">
					<dt><a href="javascript:void(0)">
					<empty name="smallFace">
						<img src="__IMG__/small_face.jpg" alt="">
					<else/>
						<img src="__ROOT__/{$smallFace}" alt="">
					</empty>
					</a></dt>
					<dd>
						<h4><a href="javascript:void(0)">{:session('user_auth')['username']}</a></h4>
						<p>#内容#</p>
						<div class="img" style="display:block;"><img src="__ROOT__/#缩略图#" alt=""></div>
						<div class="img_zoom" style="display:none">
							<ol>
								<li class="in"><a href="javascript:void(0)">收起</a></li>
								<li class="source"><a href="__ROOT__/#原图#" target="_blank">查看原图</a></li>
							</ol>
							<img data="__ROOT__/#放大图#" src="__IMG__/loading_100.png" alt="">
						</div>
						<div class="footer">
							<span class="time">刚刚发布</span>
							<span class="handler">赞(0) | 转播 | 评论 | 收藏</span>
						</div>
					</dd>
				</dl>
			</div>
			
			<!--多配图-->
			<div id="ajax_html3" style="display:none;">
				<dl class="weibo_content_data">
					<dt><a href="javascript:void(0)">
					<empty name="smallFace">
						<img src="__IMG__/small_face.jpg" alt="">
					<else/>
						<img src="__ROOT__/{$smallFace}" alt="">
					</empty>
					</a></dt>
					<dd>
						<h4><a href="javascript:void(0)">{:session('user_auth')['username']}</a></h4>
						<p>#内容#</p>
						<div class="footer">
							<span class="time">刚刚发布</span>
							<span class="handler">赞(0) | 转播 | 评论 | 收藏</span>
						</div>
					</dd>
				</dl>
			</div>
			
		</div>
	</div>
	<div class="main_right">
		<empty name="bigFace">
			<img src="__IMG__/big.jpg" alt="" class="face">
		<else/>
			<img src="__ROOT__{$bigFace}" alt="" class="face">
		</empty>
		<span class="user">
			<a href="javascript:void(0)">{:session('user_auth')['username']}</a>
		</span>
	</div>
</block>