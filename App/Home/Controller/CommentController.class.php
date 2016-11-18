<?php
namespace Home\Controller;

class CommentController extends HomeController {
	//发布评论
	public function publish() {
		if (IS_AJAX) {
			$Comment = D('Comment');
			$cid = $Comment->publish(I('post.content'), session('user_auth')['id'], I('post.tid'));
			echo $cid;
		} else {
			$this->error('非法访问！');
		}
	}
	
	//获取评论列表
	public function getList() {
		if (IS_AJAX) {
			$Comment = D('Comment');
			$getList = $Comment->getList(I('post.tid'), I('post.page'));
			$this->assign('getList', $getList['list']);
			$this->assign('total', $getList['total']);
			$this->assign('page', I('post.page'));
			$this->display();
		} else {
			$this->error('非法访问！');
		}
	}
	
}