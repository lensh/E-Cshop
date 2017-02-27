<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 基础控制器，负责验证用户有没有登陆以及检查权限
 */
class BaseController extends Controller {

	public function __construct(){
		parent::__construct();
        if(!session('id')){
            redirect("Admin/Login/login");
        }
        //权限认证
        if(!$this->checkAuth()){
        	$this->error('您无权限访问');
        };
        $this->showMenu();
	}

	/**
	 * 验证权限
	 * @return boolean 如果管理员有当前页面的权限则返回true
	 */
	protected function checkAuth(){
		//Index后台所有人都可以访问
		if(CONTROLLER_NAME=='Index') return true;
		//得到当前管理员的所有权限的id
		$auth_ids=$this->getAuthIdsByAdminId();
		//找到当前路径的权限id
		$map=array(
			'module_name'=>MODULE_NAME,
			'controller_name'=>CONTROLLER_NAME,
			'action_name'=>ACTION_NAME
		);
		$auth_id=M('Auth')->field('id')->where($map)->find();
		return in_array($auth_id['id'], $auth_ids);
	}

	/**
     * 根据当前管理员的id得到所有权限的id,不重复
     * @return array
     */
    protected function getAuthIdsByAdminId(){
        //得到当前管理员的角色的id
        $admin=M('Admin')->field('role_id')->find(session('id'));
        $role_ids=$admin['role_id'];
        $auth_ids=array();
        $role=M('Role')->field('auth_id')->where("id in ($role_ids)")->select();
        foreach ($role as $key => $value) {
            $arr=explode(',',$value['auth_id']);
            foreach ($arr as $k => $v) {
                $auth_ids[]=$v;
            }
        }
        return array_unique($auth_ids);
    }

    /**
     * 菜单左侧显示权限
     */
    protected function showMenu(){
        $auth_ids_arr=$this->getAuthIdsByAdminId();
        $auth_ids=implode(',', $auth_ids_arr);
        $btn=array();
        $auth=M('Auth')->where("id in($auth_ids)")->select();
        foreach ($auth as $k => $v) {
           if($v['pid']==0){
                foreach ($auth as $k1 => $v1) {
                   if($v1['pid']==$v['id'])
                     $v['children'][]=$v1;
                }
                $btn[]=$v;
           }
        }
        $this->assign('btn',$btn);
    }
}














