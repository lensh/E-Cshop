<?php
namespace Admin\Controller;
class AuthController extends BaseController {

    /**
     * 显示权限列表
     * @return void
     */
    public function lst(){
        $model = D('Auth');
        $data = $model->getTree();
        $this->assign(array(
            'data' => $data,
        ));
        $this->display();
    }

    /**
     * 新增权限
     * @return [type] [description]
     */
    public function add()
    {
    	if(IS_AJAX){
    		$model = D('Auth');
            echo $model->add(I('post.'))?1:0;
            return;
    	}
		$parentModel = D('Auth');
		$parentData = $parentModel->getTree();
		$this->assign('parentData', $parentData);
		$this->display();
    }

    /**
     * 编辑权限
     * @return [type] [description]
     */
    public function edit(){
    	$id = I('get.id');
    	if(IS_AJAX){    //修改权限
    	   $model = D('Auth');
            if($model->create(I('post.'),2)){
               echo $model->save()?1:0;
               return;
            }
    	}
    	$model = M('Auth');
        //查找当前权限的信息
    	$data = $model->find($id);  
        //查找当前权限的父权限的信息
        $data_p = $model->field('auth_name,auth_level,id')->find($data['pid']);
        //查找所有权限的信息
		$parentData = $model->select();
		$this->assign(array( 
            'data'=>$data,
            'data_p'=>$data_p,
			'parentData' =>$parentData,
		));
		$this->display();
    }

    /**
     * 删除权限
     * @return [type] [description]
     */
    public function delete(){
    	$model = D('Auth');
    	if($model->delete(I('get.id', 0)) !== FALSE){
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else {
    		$this->error($model->getError());
    	}
    }
}