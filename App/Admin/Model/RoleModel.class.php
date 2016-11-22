<?php
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model 
{
	protected $insertFields = array('role_name','auth_id');
	protected $updateFields = array('id','role_name','auth_id');
	protected $_validate = array(
		array('role_name', 'require', '角色名称不能为空！', 1, 'regex', 3),
		array('role_name', '1,30', '角色名称的值最长不能超过 30 个字符！', 1, 'length', 3)
	);

	/**
     * 查找角色及所拥有的权限
     * @return [type] [description]
     */
	public function searchRole(){
		$data = $this->select();  //角色的信息
        $auth=M('Auth');   
        $authData=$auth->field('id,auth_name')->select(); //查找所有权限的信息
        foreach ($data as $k=>$v) {
            $auth_names='';
            foreach ($authData as $key => $value) {
                if(strpos(','.$v['auth_id'].',',','.$value['id'].',')!==false){    
                    $auth_names.=','.$value['auth_name'];
                }    
            }  
            $data[$k]['auth_names']=substr($auth_names,1);
        }
        return $data;
		/*  用这种方法也可以，但效率更低
		$results=array();
		if(empty($results)){
    		$roles=$this->select();   //角色的信息	
			foreach ($roles as $role) {
				$admin=M('Auth');
				$map['id']=array('in',$role['auth_id']);
				$auth_names_array=$admin->field('auth_name')->where($map)->select();
				$auth_names='';
				foreach ($auth_names_array as $k) {
				    $auth_names.=','.$k['auth_name'];
				}
				$results[$role['id']]['role_name']=$role['role_name'];
				$results[$role['id']]['auth_name']=substr($auth_names,1);
			}
			return $results;
		}
		*/
	}

    /**
     * 添加角色
     * @return [type] [description]
     */
	public function addRole($data){
		if(empty($data['auth_id'])){
			$this->error='权限不能为空';
			return 0;
		}
		$auth_ids=implode(',', $data['auth_id']);
		$roleData=array(
			'role_name'=>$data['role_name'],
			'auth_id'=>$auth_ids
		);
		if($this->create($roleData,1)){
			return $this->add($roleData)?1:0;
		}else{
			return 0;
		}
	}

	/**
	 * 编辑角色
	 * @return
	 */
	public function updateRole($data){
		if(empty($data['auth_id'])){
			$this->error='权限不能为空';
			return 0;
		}	
		$auth_ids=implode(',', $data['auth_id']);
		$roleData=array(
			'id'=>$data['id'],
			'role_name'=>$data['role_name'],
			'auth_id'=>$auth_ids
		);
		if($this->create($roleData,2)){
			return $this->save($roleData)?1:0;
		}else{
			return 0;
		}	
	}

	/**
	 * 删除角色
	 * @param  id
	 * @return int
	 */
	public function deleteRole($id){
		$admin=M('Admin');
		$role_ids=$admin->field('role_id')->select();
		foreach ($role_ids as $k => $v) {
			//如果有管理员属于该角色，则返回0
			if(strpos(','.$v['role_id'].',',','.$id.',')!==false){
				$this->error='有管理员属于该角色，无法删除';
				return 0;
			}
		}
		return $this->delete($id);
	}
}