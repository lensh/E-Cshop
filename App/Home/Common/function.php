<?php
//检测验证码
function check_verify($code, $id = 1) {
	$Verify = new \Think\Verify();
	$Verify->reset = false;
	return $Verify->check($code, $id);
}

/**
 * cookie加密
 */
function encryption($username, $type = 0) {
	$key = sha1(C('COOKIE_key'));   //config.php里的COOKIE_key
	
	if (!$type) {
		return base64_encode($username ^ $key);  //加密
	}
	
	$username = base64_decode($username);
	return $username ^ $key;
}

/**
 * 发送邮件
 */
function sendMail($to, $title, $content)
{
	require_once('./PHPMailer_v5.1/class.phpmailer.php');
    $mail = new PHPMailer();
    // 设置为要发邮件
    $mail->IsSMTP();
    // 是否允许发送HTML代码做为邮件的内容
    $mail->IsHTML(TRUE);
    // 是否需要身份验证
    $mail->SMTPAuth=TRUE;
    $mail->CharSet='UTF-8';
    /*  邮件服务器上的账号是什么 */
    $mail->From=C('MAIL_ADDRESS');
    $mail->FromName=C('MAIL_FROM');
    $mail->Host=C('MAIL_SMTP');
    $mail->Username=C('MAIL_LOGINNAME');
    $mail->Password=C('MAIL_PASSWORD');
    // 发邮件端口号默认25
    $mail->Port = 25;
    // 收件人
    $mail->AddAddress($to);
    // 邮件标题
    $mail->Subject=$title;
    // 邮件内容
    $mail->Body=$content;
    return($mail->Send());
}