<?php
namespace Admin\Controller;
class CategoryController extends BaseController{

    /**
     * 新增分类
     */
    public function add(){
    	if(IS_POST){
    		$model = D('Category');
    		if($model->create(I('post.'), 1)){
    			if($id = $model->add()){
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
		$parentModel = D('Category');
		$parentData = $parentModel->getTree();
		$this->assign('parentData', $parentData);
		$this->display();
    }

    /**
     * 编辑分类
     */
    public function edit(){
    	$id = I('get.id');
    	if(IS_POST){
    		$model = D('Category');
    		if($model->create(I('post.'), 2)){
    			if($model->save() !== FALSE){
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    				return;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Category');
    	$data = $model->find($id);
    	$this->assign('data', $data);
		$parentModel = D('Category');
		$parentData = $parentModel->getTree();
		$children = $parentModel->getChildren($id);
		$this->assign(array(
			'parentData' => $parentData,
			'children' => $children,
		));
		$this->display();
    }

    /**
     * 删除分类
     */
    public function delete(){
    	$model = D('Category');
    	if($model->delete(I('get.id', 0)) !== FALSE){
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else {
    		$this->error($model->getError());
    	}
    }

    /**
     * 显示分类类表
     */
    public function lst(){
    	$model = D('Category');
		$data = $model->getTree();
    	$this->assign(array(
    		'data' => $data,
    	));
    	$this->display();
    }
}