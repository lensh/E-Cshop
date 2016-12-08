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

	/**
	 * 下订单
	 * @return [type] [description]
	 */
	public function order(){
		/************** 把用户选择的商品存到SESSION中，如果会员没有选择过商品就不能进入这个页面 *****************/
		$buythis = I('post.buythis');
		// 先判断表单中是否选择了
		if(!$buythis){
			$buythis = session('buythis');
			if(!$buythis){
				$this->error('必须先选择商品', U('lst'));
			}
		}
		else{
			session('buythis', $buythis);
		}
			
		$mid = session('mid');
		// 如果会员没有登录跳到登录页面，登录成功之后再跳回到这个页面
		if(!$mid){
			// 把当前这个页面的地址存到SESSION中，这样登录成功之后就跳回来了
			session('returnUrl', U('order'));
			redirect(U('Member/login'));
		}
		// 如果是下单的表单就处理
		if(IS_POST && !isset($_POST['buythis'])){
			$orderModel = D('Order');
			if($orderModel->create(I('post.'), 1)){
				if($id = $orderModel->add()){
					$this->success('下单成功！', U('order_ok?id='.$id));
					return;
				}
			}
			$this->error($orderModel->getError());
		}
		
		// 取出购物车中的商品
		$cartModel = D('Cart');
		$data = $cartModel->cartList();
		
		$this->assign('data', $data);
		
		// 显示表单
		$this->setPageInfo('下定单', '下定单', '下定单', 1, array('fillin'), array('cart2'));
		$this->display();
	}
}




















