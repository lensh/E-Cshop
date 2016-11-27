<?php
namespace Admin\Controller;
class GoodsController extends BaseController{
    public function add(){
    	if(IS_POST){
    		$model = D('Admin/Goods');
    		if($model->create(I('post.'), 1)){
    			if($id = $model->add()){
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
        $typeModel=M('Type');
        $typeData=$typeModel->select();
        $this->assign('typeData',$typeData);
		$this->display();
    }
    public function edit(){
    	$id = I('get.id');
    	if(IS_POST){
    		$model = D('Admin/Goods');
    		if($model->create(I('post.'), 2)){
    			if($model->save() !== FALSE){
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Goods');
    	$data = $model->find($id);
    	$this->assign('data', $data);
		$this->display();
    }
    public function delete(){
    	$model = D('Admin/Goods');
    	if($model->delete(I('get.id', 0)) !== FALSE){
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else {
    		$this->error($model->getError());
    	}
    }
    public function lst(){
    	$model = D('Admin/Goods');
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));
    	$this->display();
    }

    /**
     * AJAX获取商品属性
     * @return [type] [description]
     */
    public function ajaxGetAttr(){
        $type_id=I('get.type_id');
        //取出属性
        $attrData=M('Attr')->where(array('type_id'=>$type_id))->select();
        echo json_encode($attrData);
    }
}