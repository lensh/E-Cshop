<?php
namespace Admin\Controller;
class BrandController extends BaseController{
    /**
     * 添加品牌
     */
    public function add(){
    	if(IS_POST){
    		$model = D('Admin/Brand');
    		if($model->create(I('post.'), 1)){
    			if($id = $model->add()){
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				return;
    			}
    		}
    		$this->error($model->getError());
    	}
		$this->display();
    }
    /**
     * 修改品牌
     */
    public function edit(){
    	$id = I('get.id');
    	if(IS_POST){
    		$model = D('Admin/Brand');
    		if($model->create(I('post.'), 2)){
    			if($model->save() !== FALSE){
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Brand');
    	$data = $model->find($id);
    	$this->assign('data', $data);
		$this->display();
    }
    /**
     * 删除品牌
     */
    public function delete(){
    	$model = D('Admin/Brand');
    	if($model->delete(I('get.id', 0)) !== FALSE){
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else {
    		$this->error($model->getError());
    	}
    }
    /**
     * 品牌列表
     */
    public function lst(){
    	$model = D('Admin/Brand');
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));
    	$this->display();
    }
}