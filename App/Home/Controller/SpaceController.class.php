<?php
namespace Home\Controller;

class SpaceController extends HomeController {
    //显示主页
	public function index($id = 0, $domain = ''){
		if ($id == 0 && $domain == '') $this->error('非法访问！');
		if ($this->login()) {
			$User = D('User');
			$Approve = D('Approve');
			if ($id) {
				$getUser = $User->getUser($id);
				if ($getUser) {
					$this->assign('user', $getUser);
					$this->assign('bigFace', json_decode($getUser['face'])->big);
					
					$obj = $Approve->getApprove($id);
					$this->assign('approve', $obj);
					
					$this->display();
				} else {
					$this->error('不存在此用户！');
				}
			}
			if ($domain) {
				$getUser = $User->getUser2($domain);
				if ($getUser) {
					$this->assign('user', $getUser);
					$this->assign('bigFace', json_decode($getUser['face'])->big);
					
					$obj = $Approve->getApprove($getUser['id']);
					$this->assign('approve', $obj);
					
					$this->display();
				} else {
					$this->error('不存在此用户！');
				}
			}
		}
    }
    
    
    //设置URL
    public function setUrl($username = '') {
    	if (IS_AJAX && $username != '') {
			$User = D('User');
			$getUser = $User->getUser3($username);
			if (is_array($getUser)) {
				if (empty($getUser['domain'])) {
					echo U('Space/index', array('id'=>$getUser['id']));
				} else {
					echo __ROOT__.'/i/'.$getUser['domain'];
				}
			}
    	} else {
    		$this->error('非法访问！');
    	}
    }
    
    
    
    
    
    
    
    
}