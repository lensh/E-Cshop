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
    	if(IS_POST){
    		$model = D('Auth');
    		if($model->create(I('post.'), 1)){
    			if($id = $model->add()){
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
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
    	if(IS_POST){    //修改权限
    		$model = D('Auth');
    		if($model->create(I('post.'), 2)){          
    			if($model->save()!== FALSE){
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
                    return;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Auth');
    	$data = $model->find($id);   
    	$this->assign('data', $data);  //当前权限的信息
        $model_p= M('Auth');
        $data_p = $model_p->field('auth_name,id')->find($data['pid']);
        $this->assign('data_p',$data_p);   //父权限的信息
		$parentModel = D('Auth');
		$parentData = $parentModel->getTree();
		$children = $parentModel->getChildren($id);
		$this->assign(array(   //当前权限的父权限和顶级权限
			'parentData' => $parentData,
			'children' => $children,
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