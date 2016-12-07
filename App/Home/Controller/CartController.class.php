<?php
namespace Home\Controller;
/**
 * 购物车控制器
 */
class CartController extends BaseController {
	/**
	 * 添加到购物车
	 */
	public function add(){
		$cartModel = D('Cart');
		$goodsAttrId = I('post.goods_attr_id');
		if($goodsAttrId){
			// 把属性ID升序排列，因为后台存属性的存量时是升序的，为了能取出库存量
			sort($goodsAttrId);
			$goodsAttrId = implode(',', $goodsAttrId);
		}
		$cartModel->addToCart(I('post.goods_id'), $goodsAttrId, I('post.amount'));
		redirect(U('lst'));
	}
	
	/**
	 * 购物车列表
	 * @return [type] [description]
	 */
	public function lst(){
		$cartModel = D('Cart');
		$data = $cartModel->cartList();
		
		$this->assign('data', $data);
		
		$this->setPageInfo('购物车', '购物车', '购物车', 1, array('cart'), array('cart1'));
		$this->display();
	}

	/**
	 * ajax更新数据
	 * @return [type] [description]
	 */
	public function ajaxUpdateData(){
		$gid = I('get.gid');
		$gaid = I('get.gaid', '');  //如果没有属性则默认为
		$gn = I('get.gn');
		$cartModel = D('Cart');
		$data = $cartModel->updateData($gid, $gaid, $gn);
	}
}




















