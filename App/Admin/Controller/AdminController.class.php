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
    			if($id = $model->add()){
    				$this->success('添加成功！', U('Admin/Admin/lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
		$this->display();
    }

    /**
     * 编辑管理员
     */
    public function edit(){
    	$id = I('get.id');
    	if(IS_POST){
    		$model = D('Admin');
    		if($model->create(I('post.'), 2)){
    			if($model->save() !== FALSE){
    				$this->success('修改成功！', U('Admin/Admin/lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Admin');
    	$data = $model->find($id);
    	$this->assign('data', $data);
		$this->display();
    }

    /**
     * 删除管理员
     */
    public function delete(){
    	$model = D('Admin');
    	if($model->delete(I('get.id', 0)) !== FALSE){
    		$this->success('删除成功！', U('Admin/Admin/lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else {
    		$this->error($model->getError());
    	}
    }

    /**
     * 管理员列表
     */
    public function lst(){
    	$model = M('Admin');
    	$data = $model->select();
    	$this->assign('data',$data);
    	$this->display();
    }
}