<?php
namespace Home\Controller;
use Think\Verify;

class LoginController extends HomeController {
	public function index() {
		if (!session('?user_auth')) {  // session('?user_auth')是判断session是否存在
			$this->display();
		} else {
			$this->redirect('Index/index');
		}
	}
	public function verify() {
		$Verify = new Verify();
		$Verify->entry(1);
	}
}