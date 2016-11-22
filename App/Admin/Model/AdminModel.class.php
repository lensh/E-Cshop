<?php
namespace Admin\Model;
use Think\Model;
/**
 * 管理员模型
 */
class AdminModel extends Model 
{
	/*自动验证*/
	protected $_validate = array(
		//第四个参数是验证条件，1为必须验证，0为存在就验证，2为值不为空才验证
		//第六个参数是验证时间，1为新增时验证，2为修改时验证，3为都验证
		array('username', 'require', '账号不能为空！', 1, 'regex', 3),
		array('username', '1,30', '账号的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('username', '', '该账号已存在！', 1, 'unique', 3),
		array('password', 'require', '密码不能为空！', 1, 'regex',3),
		array('password', '1,32', '密码的值最长不能超过 32 个字符！', 1, 'length', 3),
		array('cpassword', 'password', '两次密码输入不一致！', 1, 'confirm', 3),
		array('is_use', 'number', '是否启用 1：启用0：禁用必须是一个整数！', 2, 'regex', 3),
	);

	/*登陆验证,必须是public*/ 
	public $rules= array(
		array('username', 'require', '姓名不能为空！', 1),
		array('password', 'require', '密码不能为空', 1),
		array('captcha', 'require', '验证码不能为空', 1),
		array('captcha', 'check_verify', '验证码不正确!', 1, 'callback')
	);
	
    /**
     * 添加管理员
     * @return [type] [description]
     */
	public function addAdmin($data){
		if(empty($data['role_id'])){
			$this->error='必须分配角色';
			return 0;
		}else{
			$arr=array(
				'username'=>$data['username'],
				'password'=>md5($data['password'].C('md5_key')),
				'role_id'=>implode(',', $data['role_id']),
				'is_use'=>$data['is_use']
			);
			return $this->add($arr);
		}
	}

    /**
     * 查找管理员的信息
     * @return array
     */
    public function searchAdmin(){
    	$data = $this->select();  //管理员的信息
        $role=M('Role');   
        $roleData=$role->field('id,role_name')->select(); //查找所有角色信息
        foreach ($data as $k=>$v) {
            $role_names='';
            foreach ($roleData as $key => $value) {
                if(strpos(','.$v['role_id'].',',','.$value['id'].',')!==false){
                    $role_names.=','.$value['role_name'];
                }       
            }  
            $data[$k]['role_names']=substr($role_names,1);
        }
        return $data;
    }

    /**
     * 修改管理员的信息
     * @return [type] [description]
     */
	public function updateAdmin(&$data){
		if(empty($data['role_id'])){
			$this->error='必须分配角色';
			return 0;
		}
		$arr=array(
				'id'=>$data['id'],
				'username'=>$data['username'],
				'password'=>md5($data['password'].C('md5_key')),
				'role_id'=>implode(',', $data['role_id']),
				'is_use'=>$data['id']==1?1:$data['is_use']
			);
		return $this->save($arr);
	}

    /**
     * 删除管理员
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteAdmin($id){
        if($id==1){
            $this->error='超级管理员不能删';
            return 0;
        }
        return $this->delete($id);
    }

	/**
	 * 登陆验证
	 * @return [type] [description]
	 */
    public function login($data){
    	//取到用户名和密码
    	$username=$data['username']; 
    	$password=md5($data['password'].C('md5_key'));
        $map=array(
            'username'=>$username
        );
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