<?php
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model {

	//自动验证
	protected $_validate = array(
		array('username', 'require', '姓名不能为空！', 1),
		array('password', 'require', '密码不能为空', 1),
		array('captcha', 'require', '验证码不能为空', 1),
		array('captcha', 'check_verify', '验证码不正确!', 1, 'callback')
	);

	/**
	 * 登陆验证
	 * @return [type] [description]
	 */
    public function login($data){
    	if($this->create($data)){  //调用create方法时会自动验证
    		//取到用户名和密码
    		$username=$data['username']; 
    		$password=$data['password'];

    		$map=array('username'=>$username);
    		$user=$this->where($map)->find(); 
    		if($user){  //验证用户名是否存在
    			if($user['password']==$password) {//验证密码是否正确
    				if($user['is_use']==1||$user['id']==1){  //验证是否可用以及是否为超级管理员
    					session('id',$user['id']);
    					session('username',$user['username']);
    					return 1;
    				}else{
    					$this->error='账号被禁用';
    					return 0;
    				}
    			}else{
    				$this->error='密码不正确';
    				return 0;
    			}
    		}else{
    			$this->error='用户名不存在';
    			return 0;
    		}
    		
    	}else{
    		return 0;
    	}
    }

    /**
     * 检查验证码
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public function check_verify($code){
    	$verify=new \Think\Verify();
    	return $verify->check($code);
    }
	
}










