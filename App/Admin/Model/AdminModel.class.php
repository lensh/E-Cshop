<?php
namespace Admin\Model;
use Think\Model;
/**
 * 管理员模型
 */
class AdminModel extends Model 
{
	/*插入或更新时限制的字段*/
	protected $insertFields = array('username','password','is_use');
	protected $updateFields = array('id','username','password','is_use');

	/*自动验证*/
	protected $_validate = array(
		array('username', 'require', '账号不能为空！', 1, 'regex', 3),
		array('username', '1,30', '账号的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('password', 'require', '密码不能为空！', 1, 'regex', 3),
		array('password', '1,32', '密码的值最长不能超过 32 个字符！', 1, 'length', 3),
		array('is_use', 'number', '是否启用 1：启用0：禁用必须是一个整数！', 2, 'regex', 3),
	);

	/*登陆验证*/
	protected $rules= array(
		array('username', 'require', '姓名不能为空！', 1),
		array('password', 'require', '密码不能为空', 1),
		array('captcha', 'require', '验证码不能为空', 1),
		array('captcha', 'check_verify', '验证码不正确!', 1, 'callback')
	);
	
	/**
	 * 钩子函数，删除前
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	protected function _before_delete($option){
		if(is_array($option['where']['id'])){
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}

	/**
	 * 登陆验证
	 * @return [type] [description]
	 */
    public function login($data){
    	//取到用户名和密码
    	$username=$data['username']; 
    	$password=$data['password'];
    	//取记录
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