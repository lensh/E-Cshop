<?php
namespace Admin\Controller;
class MemberLevelController extends BaseController{
    public function add(){
    	if(IS_POST){
    		$model = D('Admin/MemberLevel');
    		if($model->create(I('post.'), 1)){
    			if($id = $model->add()){
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
		$this->display();
    }
    public function edit(){
    	$id = I('get.id');
    	if(IS_POST){
    		$model = D('Admin/MemberLevel');
    		if($model->create(I('post.'), 2)){
    			if($model->save() !== FALSE){
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('MemberLevel');
    	$data = $model->find($id);
    	$this->assign('data', $data);
		$this->display();
    }
    public function delete(){
    	$model = D('Admin/MemberLevel');
    	if($model->delete(I('get.id', 0)) !== FALSE){
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else {
    		$this->error($model->getError());
    	}
    }
    public function lst(){
    	$model = D('Admin/MemberLevel');
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));
    	$this->display();
    }
}