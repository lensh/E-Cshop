<?php
namespace Home\Model;
use Think\Model;
/**
 * 购物车模型
 */
class CartModel extends Model {

	/**
	 * 加入到购物车
	 * @param [type]  $goods_id      [description]
	 * @param [type]  $goods_attr_id [description]
	 * @param integer $goods_number  [description]
	 */
	public function addToCart($goods_id, $goods_attr_id, $goods_number = 1){
		$mid = session('mid');
		// 如果登录了就加入到数据库中，否则就加入到COOKIE中
		if($mid){
			$cartModel = M('Cart');
			$has = $cartModel->where(array(
				'member_id' => $mid,
				'goods_id' => $goods_id,
				'goods_attr_id' => $goods_attr_id
			))->find();
			// 判断是否商品已经存在
			if($has)
				$cartModel->where('id='.$has['id'])->setInc('goods_number', $goods_number);
			else 
				$cartModel->add(array(
					'goods_id' => $goods_id,
					'goods_attr_id' => $goods_attr_id,
					'goods_number' => $goods_number,
					'member_id' => $mid,
				));
		}
		else {
			// 先从COOKIE中取出购物车的数组
			$cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
			// 把商品加入到这个数组中
			$key = $goods_id . '-' . $goods_attr_id;
			// 先判断数组中有没有这件商品
			if(isset($cart[$key]))
				$cart[$key] += $goods_number;
			else
				$cart[$key] = $goods_number;
			// 把这个数组存回到cookie
			$aMonth = 30 * 86400;
			setcookie('cart', serialize($cart), time() + $aMonth,'/');
		}
	}

	/**
	 * 购物车列表
	 */
	public function cartList(){
		$mid = session('mid');
		if($mid){
			$cartModel = M('Cart');
			$_cart = $cartModel->where(array('member_id'=>array('eq', $mid)))->select();
		}
		else {
			$_cart_ = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
			// 转化这个数组结构和从数据库中取出的数组结构一样，都是二维的
			$_cart = array();
			foreach ($_cart_ as $k => $v){
				// 从下标中解析出商品ID和商品属性ID
				$_k = explode('-', $k);
				$_cart[] = array(
					'goods_id' => $_k[0],
					'goods_attr_id' => $_k[1],
					'goods_number' => $v,
					'member_id' => 0,
				);
			}
		}
		/****************** 循环购物车中每件商品，根据ID取出商品详情页信息 *****************/
		$goodsModel = D('Admin/Goods');
		foreach ($_cart as $k => $v){
			$ginfo = $goodsModel->field('sm_logo,goods_name')->find($v['goods_id']);
			$_cart[$k]['goods_name'] = $ginfo['goods_name'];
			$_cart[$k]['sm_logo'] = $ginfo['sm_logo'];
			// 计算会员价格
			$_cart[$k]['price'] = $goodsModel->getMemberPrice($v['goods_id']);
			// 把商品属性ID转化成商品属性字符串
			$_cart[$k]['goods_attr_str'] = $goodsModel->convertGoodsAttrIdToGoodsAttrStr($v['goods_attr_id']);
		}
		return $_cart;
	}

	/**
	 * 把COOKIE中的数据转移到数据库中并清空COOKIE中的数据
	 */
	public function moveDataToDb(){
		$mid = session('mid');
		if($mid){
			// 先从COOKIE中取出购物车的数据
			$cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
			if($cart){
				// 循环每件商品加入到数据库中
				foreach ($cart as $k => $v){
					// 从下标出解析出商品ID，和商品属性ID
					$_k = explode('-', $k);
					$this->addToCart($_k[0], $_k[1], $v);
				}
				// 清空COOKIE中的数据
				setcookie('cart', '', time()-1,'/');
			}
		}
	}

	/**
	 * 更新数据
	 * @param  [type] $gid  [description]
	 * @param  [type] $gaid [description]
	 * @param  [type] $gn   [description]
	 * @return [type]       [description]
	 */
	public function updateData($gid, $gaid, $gn){
		$mid = session('mid');
		if($mid){
			$cartModel = M('Cart');
			$map=array(
				'goods_id' => $gid,
				'goods_attr_id' => $gaid,
				'member_id' => $mid
			);
			if($gn == 0) $cartModel->where($map)->delete();
			else $cartModel->where($map)->setField('goods_number', $gn);
		}
		else {
			// 先从COOKIE中取出购物车的数组
			$cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
			$key = $gid . '-' . $gaid;
			if($gn == 0)
				unset($arr[$key]);
			else
				$arr[$key] = $gn;
			// 把这个数组存回到cookie
			$aMonth = 30 * 86400;
			setcookie('cart', serialize($cart), time() + $aMonth,'/');
		}
	}

	/**
	 * 清空购物车
	 */
	public function clearDb(){
		$mid = session('mid');
		if($mid){
			// 取出勾选的商品
			$buythis = session('buythis');
			$cartModel = M('Cart');
			// 循环勾选的商品进行删除
			foreach ($buythis as $k => $v){
				// 从字符串解析出商品ID和商品属性ID
				$_v = explode('-', $v);
				$cartModel->where(array('member_id'=>$mid, 'goods_id'=>$_v[0], 'goods_attr_id'=>$_v[1]))->delete();
			}
		}
	}
}


















