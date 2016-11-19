<?php
namespace Admin\Controller;
/**
 * 商品控制器
 */
class GoodsController extends BaseController{

    /**
     * 发布商品信息
     */
	public function add(){
		if(IS_POST){
			$goods=D('Goods');
			if($goods->addGoods(I('post.'))){
				$this->success('商品添加成功');
			}else{
				$this->error('添加商品失败');
			}
			return;
		}
		$this->display();
	}

	/**
	 * 显示商品列表
	 * @return void
	 */
	public function lst(){
		$goods=D('Goods');
		$data=$goods->search();
		$this->assign(array(
			'data'=>$data['data'],
			'page'=>$data['page']
		));
		$this->display();
	}

	/**
	 * 删除商品
	 */
	public function delete(){
		$model=D('Goods');
		if($model->delete(I('get.id'))){
			$this->success('删除成功');
		};
	}

	/**
	 * 修改商品
	 * @return [type] [description]
	 */
	public function edit(){
		if(IS_POST){
			$model=D('Goods');
			if($model->update(I('post.'))){
				$this->success('修改成功',U('lst',array('p'=>I('get.p'))));
			}else{
				$this->error('修改失败');
			}
			return;
		}
		//显示修改界面
		$model=M('Goods');
		$data=$model->find(I('get.id'));
		$this->assign('data',$data);
		$this->display();
	}
}














