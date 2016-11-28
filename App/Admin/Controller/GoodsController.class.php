<?php
namespace Admin\Controller;
class GoodsController extends BaseController{
    /**
     * 添加商品
     */
    public function add(){
    	if(IS_POST){
    		$model = D('Goods');
    		if($model->create(I('post.'), 1)){
    			if($id = $model->add()){
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
        //取出商品的类型
        $typeModel=M('Type');
        $typeData=$typeModel->select();
        $this->assign('typeData',$typeData);
        //取出所有的商品分类
        $categoryData=D('Category')->getTree();
        $this->assign('categoryData',$categoryData);
        //取出所有的品牌
        $brandData=M('Brand')->field('id,brand_name')->select();
        $this->assign('brandData',$brandData);
        //取出所有的会员级别
        $memberLevelData=M('MemberLevel')->select();
        $this->assign('memberLevelData',$memberLevelData);
		$this->display();
    }

    /**
     * 修改商品
     */
    public function edit(){
    	$id = I('get.id');
    	if(IS_POST){
    		$model = D('Goods');
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

    /**
     * 删除商品
     */
    public function delete(){
    	$model = D('Goods');
    	if($model->delete(I('get.id', 0)) !== FALSE){
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else {
    		$this->error($model->getError());
    	}
    }

    /**
     * 商品列表
     */
    public function lst(){
    	$model = D('Goods');
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));
    	$this->display();
    }

    /**
     * AJAX获取商品属性
     * @return string
     */
    public function ajaxGetAttr(){
        $type_id=I('get.type_id');
        //取出属性
        $attrData=M('Attr')->where(array('type_id'=>$type_id))->select();
        echo json_encode($attrData);
    }
}