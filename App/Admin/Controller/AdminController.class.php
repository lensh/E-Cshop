<?php
namespace Admin\Controller;
/**
 * 管理员控制器
 */
class AdminController extends BaseController{

    /**
     * 添加管理员
     */
    public function add(){
    	if(IS_POST){
    		$model = D('Admin');
    		if($model->create(I('post.'), 1)){
    			if($model->addAdmin(I('post.'))){
    				$this->success('添加成功！', U('Admin/Admin/lst?p='.I('get.p')));
    				return;
    			}
    		}
    		$this->error($model->getError());
    	}
        $role=M('Role');   
        $roleData=$role->field('id,role_name')->select(); //查找所有角色信息
        $this->assign('roleData',$roleData);
		$this->display();
    }

    /**
     * 编辑管理员
     */
    public function edit(){
    	$id = I('get.id');
        $adminId=session('id');  //取出当前管理员的id
        if($adminId>1 && $adminId!=$id){   //普通管理员不可以修改其它管理员的信息
            $this->error('您无权修改其它管理员的信息');
            return;
        }
    	if(IS_POST){
    		$model = D('Admin');
    		if($model->create(I('post.'), 2)){
    			if($model->updateAdmin(I('post.'))){
    				$this->success('修改成功！', U('Admin/Admin/lst', array('p' => I('get.p', 1))));
    				return;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Admin');
    	$data = $model->find($id); //查找当前管理员的信息
        $role=M('Role');   
        $roleData=$role->field('id,role_name')->select(); //查找所有角色信息
        $this->assign(array('data'=>$data,'roleData'=>$roleData));
		$this->display();
    }

    /**
     * 删除管理员
     */
    public function delete(){
    	$model = D('Admin');
    	if($model->deleteAdmin(I('get.id'))){
    		$this->success('删除成功！', U('Admin/Admin/lst'));
    		return;
    	}
    	else {
    		$this->error($model->getError());
    	}
    }

    /**
     * 管理员列表
     */
    public function lst(){
        $admin=D('Admin');
        $data=$admin->searchAdmin();
    	$this->assign('data',$data);
    	$this->display();
    }

    /**
     * 设置禁用
     */
    public function setUnuse(){
        header("Pragma:no-cache");
        $adminId=I('get.id');
        $admin=M('Admin');
        $info=$admin->field('is_use')->find($adminId);
        if($info['is_use']==1){ //如果是启用
            $admin->where(array('id'=>$adminId))->setField('is_use',0);
            echo 0;
        }elseif($info['is_use']==0){
            $admin->where(array('id'=>$adminId))->setField('is_use',1);
            echo 1;
        }
    }
}