<?php
namespace Home\Model;
use Think\Model;
/**
 * 会员模型
 */
class MemberModel extends Model 
{
	//插入时允许接收的字段
	protected $insertFields = array('email', 'password', 'cpassword', 'chkcode', 'mustclick');
	// 注册时的表单验证规则
	protected $_validate = array(
		array('mustclick','require', '必须同意注册协议才能注册！', 1),
		array('email', 'require', 'email不能为空！', 1),
		array('email', 'email', 'email格式不正确！', 1),
		array('email', '', 'email已被占用！', 1, 'unique'),
		array('password', 'require', '密码不能为空！', 1),
		array('password', '6,20', '密码必须是6-20位的字符！', 1, 'length'),
		array('cpassword', 'password', '两次密码输入不一致！', 1, 'confirm'),
		array('chkcode', 'require', '验证码不能为空！', 1),
		array('chkcode', 'chk_chkcode', '验证码不正确！', 1, 'callback'),
	);
    // 登录时使用的表单验证规则
	public $_login_validate = array(
		array('email', 'require', 'email不能为空！', 1),
		array('email', 'email', 'email格式不正确！', 1),
		array('password', 'require', '密码不能为空！', 1),
		array('password', '6,20', '密码必须是6-20位的字符！', 1, 'length'),
		array('chkcode', 'require', '验证码不能为空！', 1),
		array('chkcode', 'chk_chkcode', '验证码不正确！', 1, 'callback'),
	);
	/**
	 * 检查验证码
	 * @param  [type] $code [description]
	 * @return [type]       [description]
	 */
	public function chk_chkcode($code){
		 $verify = new \Think\Verify();
		 return $verify->check($code);
	}

	/**
	 * 在会员记录插入到数据库之前先补充字段
	 */
	protected function _before_insert(&$data, $option){
		$data['addtime'] = time();  // 注册的当前时间
		// 生成验证email用的验证码
		$data['email_code'] = md5(uniqid());
		// 先把会员的密码加密
		$data['password'] = md5($data['password'] . C('MD5_KEY'));
	}
	// 在会员注册成功之后
	protected function _after_insert($data, $option)
	{
		// heredoc的语法
		$content =<<<HTML
		<p>欢迎您成为本站会员，请点击以下链接地址完成email验证。</p>
		<p><a href="http://localhost/E-Cshop/index.php/Home/Member/emailchk/code/{$data['email_code']}">点击完成验证</a></p>
HTML;
		// 把生成的验证码发到会员的邮箱中
		sendMail($data['email'], 'ECshop网email验证',$content);
	}
    /**
     * 验证用户登陆
     */
    public function login(){
		$email = $this->email;
		$password = $this->password;
		$user = $this->where(array('email'=>array('eq', $email)))->find();
		if($user){
			// 判断是否已经通过email验证
			if(empty($user['email_code'])){
				// 判断密码是否正确
				if($user['password'] == md5($password . C('MD5_KEY'))){
					session('mid', $user['id']);
					session('email', $user['email']);
					session('jyz', $user['jyz']);
					// 取出当前登录会员所在的级别ID和这个级别的折扣率
					$mlModel = M('MemberLevel');
					$ml = $mlModel->field('id,rate')->where("{$user['jyz']} BETWEEN bottom_num AND top_num")->find();
					session('level_id', $ml['id']);
					session('rate', $ml['rate']/100);	
					// 把购物车中的数据从COOKIE移动到数据库
					$cartModel = D('Cart');
					$cartModel->moveDataToDb();			
					return TRUE;
				}
				else {
					$this->error = '密码不正确！';
					return FALSE;
				}
			}
			else {
				$this->error = '账号还没有通过email验证！';
				return FALSE;
			}
		}
		else {
			$this->error = '账号不存在！';
			return FALSE;
		}
	}

}