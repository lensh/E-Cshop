<?php
namespace Home\Controller;
/**
 * 评论控制器
 */
class CommentController extends BaseController {

	/**
	 * ajax发表评论
	 */
	public function add(){
		// 判断有没有登录
		$mid = session('mid');
		if(!$mid){
			echo json_encode(array(
				'ok' => 0,
				'error' => '必须先登录',
			));
			return;
		}
		if(IS_AJAX){
			$model = D('Comment');
			// 根据表单并根据模型中定义的规则验证表单
			if($model->create(I('post.'), 1)){
				if($model->add()){
					// 取出会员的头像
					$memberModel = M('Member');
					$face = $memberModel->field('face')->find($mid);
					// 如果没有设置头像就返回默认头像
					$realFace = !$face['face'] ? '/E-Cshop/Public/Home/images/default_face.jpg' : '/E-Cshop/Public/Home/'.$face['face'];
					echo json_encode(array(
						'ok' => 1,
						'content' => I('post.content'), // 过滤之后的内容
						'addtime' => date('Y-m-d H:i'),
						'star' => I('post.star'),
						'email' => session('email'),
						'face' => $realFace,
					));
					return;
				}
			}
			echo json_encode(array(
				'ok' => 0,
				'error' => $model->getError(),
			));
		}
	}

    /**
     * ajax获取评论
     * @return [type] [description]
     */
	public function ajaxGetComment(){
		// 定义每页显示的条数
		$perpage = 5;
		$p = I('get.p');
		$offset = ($p-1)*$perpage;  // 从第几条记录开始取
		$goodsId = I('get.goods_id');
		$comment = M('Comment');
		$data = $comment->field('a.*,b.email,b.face,COUNT(c.id) reply_count')->alias('a')->join('LEFT JOIN ecshop_member b ON a.member_id=b.id LEFT JOIN ecshop_reply c ON a.id=c.comment_id')->where(array('a.goods_id'=>array('eq', $goodsId)))->limit("$offset,$perpage")->group('a.id')->order('a.id DESC')->select();
		// 处理一下数据
		foreach ($data as $k => $v){
			$data[$k]['face'] = $v['face'] ? '/E-Cshop/Public/Home/'.$v['face'] : '/E-Cshop/Public/Home/images/default_face.jpg';
			$data[$k]['addtime'] = date('Y-m-d H:i', $v['addtime']);
		}
		echo json_encode($data);
	}
}




















