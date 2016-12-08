<?php
namespace Home\Controller;
/**
 * 会员控制器
 */
class MemberController extends BaseController{

	/**
	 * 注册
	 * @return [type] [description]
	 */
	public function regist(){
   		if(IS_POST){
   			$model = D('Member');
   			if($model->create(I('post.'), 1)){
   				if($model->add()){
   					$this->success('注册成功，请登录到您的邮件中完成验证！');
   					return;
   				}
   			}
   			$this->error($model->getError());
   		}
   		// 设置页面标题等信息
   		$this->setPageInfo('会员注册', '会员注册', '会员注册', 1, array('login'));
   		$this->display();
   }

   /**
    * 登陆
    * @return [type] [description]
    */
   public function login(){
   		if(IS_POST){
   			$model = D('Member');
   			if($model->validate($model->_login_validate)->create(I('post.'), 9))
   			{
   				if($model->login()){
   					if(session('returnUrl')){
   						//跳回到原来的页面
   						$returnUrl=session('returnUrl');
   						session('returnUrl',null);
   						redirect($returnUrl);
   					}
   					else{
   						redirect(U('Index/index'));  // 登录成功之后直接跳到首页
   					}
   				}		
   			}
   			$this->error($model->getError());
   		}
   		// 设置页面标题等信息
   		$this->setPageInfo('会员登录', '会员登录', '会员登录', 1, array('login'));
   		$this->display();
   }

   /**
    * 生成验证码的图片
    */
	public function chkcode(){
		$Verify = new \Think\Verify(array(
			'length' => 2,
			'useNoise' => FALSE,
		));
		$Verify->entry();
	}

	/**
	 * 接收会员传回来的验证码
	 */
	public function emailchk(){
		// 接收会员传回来的验证码
		$code = I('get.code');
		if($code){
			// 把这个验证码到数据库中比较一下即可
			$model = M('Member');
			$email = $model->where(array('email_code'=>array('eq', $code)))->find();
			if($email){
				// 设置这个账号为已验证
				$model->where(array('id'=>array('eq', $email['id'])))->setField('email_code', '');
				$this->success('已经完成验证，现在可以去登录', U('login'));
				return;
			}
		}
	}

	/**
	 * 登出
	 */
	public function logout(){
		session(null);
		redirect(U('Index/index'));
	}

	/**
	 * ajax验证登陆
	 */
	public function ajaxChkLogin(){
		if(session('mid')){
			$arr = array(
				'ok' => 1,
				'email' => session('email'),
			);
		}
		else{
			$arr = array('ok' => 0);
		}
		echo json_encode($arr);
	}
}

