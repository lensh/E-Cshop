<?php
namespace Admin\Controller;
/**
 * 角色控制器
 */
class RoleController extends BaseController{

    /**
     * 添加角色
     */
    public function add(){
    	if(IS_POST){
    		$role = D('Role');
            if($role->addRole(I('post.'))){
                $this->success('添加成功！', U('lst?p='.I('get.p')));
            }else{
                $this->error($role->getError());
            }	
            return;
    	}
        $auth=D('Auth');
        $data=$auth->getTree();   //获取权限列表
        $this->assign('data',$data);
		$this->display();
    }

    /**
     * 编辑角色
     */
    public function edit(){
    	$id = I('get.id');
    	if(IS_POST){
    		$model = D('Role');
    		if($model->updateRole(I('post.'))){
    			$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    			return;
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Role');
    	$data = $model->find($id);   //角色的信息
        $auth=D('Auth');
        $data1=$auth->getTree();   //获取所有权限列表
        $this->assign('data',$data);
    	$this->assign('data1',$data1);
		$this->display();
    }

    /**
     * 删除角色
     */
    public function delete(){
    	$model = D('Role');
        if($model->deleteRole(I('get.id'))){
            $this->success('删除成功！', U('lst'));
        }else{
            $this->error($model->getError());
        }
    }

    /**
     * 角色列表
     */
    public function lst(){
    	$model = D('Role');
    	$data = $model->searchRole();
        $this->assign('data',$data);
        $this->display();
    }
}