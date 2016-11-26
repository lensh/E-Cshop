<?php
namespace Admin\Controller;
/**
 * 属性控制器
 */
class AttrController extends BaseController{
    /**
     * 添加属性
     */
    public function add(){
    	if(IS_POST){
    		$model = D('Attr');
    		if($model->create(I('post.'), 1)){
    			if($id = $model->add()){
    				$this->success('添加成功！', U('lst?p='.I('get.p').'&type_id='.I('get.type_id')));
    				return;
    			}
    		}
    		$this->error($model->getError());
    	}
        //取出所有的类型
        $type_id=I('get.type_id');  //类型的id
        $TypeModel=M('Type');
        $typeData=$TypeModel->select();
        $this->assign(array(
            'typeData'=>$typeData,
            'type_id'=>$type_id
        ));
		$this->display();
    }
    /**
     * 编辑属性
     */
    public function edit(){
    	$id = I('get.id');
    	if(IS_POST){
    		$model = D('Attr');
    		if($model->create(I('post.'), 2)){
    			if($model->save() !== FALSE){
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1),'type_id'=>I('get.type_id'))));
    				return;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Attr');
    	$data = $model->find($id);
    	$this->assign('data', $data);
       //取出所有的类型
        $type_id=I('get.type_id');  //类型的id
        $TypeModel=M('Type');
        $typeData=$TypeModel->select();
        $this->assign(array(
            'typeData'=>$typeData,
            'type_id'=>$type_id
        ));
		$this->display();
    }

    /**
     * 删除属性
     */
    public function delete(){
    	$model = D('Attr');
    	if($model->delete(I('get.id', 0)) !== FALSE){
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1),'type_id'=>I('get.type_id'))));
    		exit;
    	}
    	else {
    		$this->error($model->getError());
    	}
    }

    /**
     * 属性列表
     */
    public function lst(){
    	$model = D('Attr');
    	$data = $model->search();
        //取出所有的类型
        $type_id=I('get.type_id');  //类型的id
        $TypeModel=M('Type');
        $typeData=$TypeModel->select();
        $this->assign(array(
            'data' => $data['data'],
            'page' => $data['page'],
            'typeData'=>$typeData,
            'type_id'=>$type_id
        ));
    	$this->display();
    }
}