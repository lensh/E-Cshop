<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 登陆验证控制器
 */
class LoginController extends Controller {

	/**
	 * 后台登陆验证
	 * @return [type] [description]
	 */
	public function login(){
		if(IS_POST){
			$model=D('Admin');
			// 动态验证，由于模型里有两个规则，所以需要使用create的第二个参数
			// 7我们自己规定，代表登录说明这个表单是登录的表单
			// 不加7，那么模型里的$insertFields会生效
			if($model->validate($model->rules)->create(I('post.'),7)){
				if($model->login(I('post.'))){
					$this->redirect('Admin/Index/index');
				}else{
					$this->error($model->getError());
				}	
			}else{
				$this->error($model->getError());
			}
		}
		if(session('id')){  //如果已经登陆
			$this->redirect('Admin/Index/index');
			return;
		}
		$this->display();
	}

    /**
     * 登出
     * @return void
     */
    public function logout(){
        session(null);
        $this->redirect('Login/login');
    }

	/**
	 * 生成图片验证码
	 * @return [type] [description]
	 */
	public function chkcode(){
		$verify=new \Think\Verify(array('imageH'=>50,'imageW'=>142,'length'=>3));
		$verify->entry();
	}
}














