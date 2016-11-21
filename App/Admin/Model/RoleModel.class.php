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
     * 添加角色
     * @return [type] [description]
     */
	public function addRole($data){
		if(empty($data['auth_id'])){
			$this->error='权限不能为空';
			return 0;
		}
		$auth_ids=implode(',', $data['auth_id']);
		$Roledata=array(
			'role_name'=>$data['role_name'],
			'auth_id'=>$auth_ids
		);
		if($this->create($Roledata,2)){
			return $this->add($Roledata)?1:0;
		}else{
			return 0;
		}
	}

	// 修改前
	protected function _before_update(&$data, $option)
	{
	}

	// 删除前
	protected function _before_delete($option)
	{
		if(is_array($option['where']['id']))
		{
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
    
    /**
     * 查找角色及所拥有的权限
     * @return [type] [description]
     */
	public function search(){
		$role_ids=$this->select();
		return $role_ids;
	}
	
}