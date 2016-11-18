<?php
//检测验证码
function check_verify($code, $id = 1) {
	$Verify = new \Think\Verify();
	$Verify->reset = false;
	return $Verify->check($code, $id);
}

//cookie加密
function encryption($username, $type = 0) {
	$key = sha1(C('COOKIE_key'));   //config.php里的COOKIE_key
	
	if (!$type) {
		return base64_encode($username ^ $key);  //加密
	}
	
	$username = base64_decode($username);
	return $username ^ $key;
}