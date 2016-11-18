<?php
namespace Home\Controller;

class IndexController extends HomeController {
    public function index(){
		if ($this->login()) {
			$Topic = D('Topic');
			$topicList = $Topic->getList(0,10);
			$this->assign('topicList', $topicList);
			$this->assign('smallFace', session('user_auth')['face']->small);
			$this->assign('bigFace', session('user_auth')['face']->big);
			S('user'.session('user_auth')['id'], NOW_TIME);  //获取当前刷新的时间 
			$this->display();
		}
    }
    
    public function getWeibo() {
    	$ids = array();
    	$weibo = array_merge(S('weibo9'),S('weibo19')); //数组合并，是个二维数组
    	foreach ($weibo as $value) {
    		if ($value[1] > S('user'.session('user_auth')['id'])) {  //$value[1]是新微博的发布时间
    			$ids[] = $value[0];  //$value[0]是用户的id，把这个存放在数组里
    		}
    	}
    	$this->ajaxReturn($ids);
    }
    
}