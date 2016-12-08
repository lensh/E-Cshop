<?php
namespace Home\Model;
use Think\Model;
class OrderModel extends Model 
{
	// 表单允许提交的字段
	protected $insertFields = array('shr_name','shr_province','shr_city','shr_area','shr_tel','shr_address','pay_method','post_method');
	protected $_validate = array(
		array('shr_name', 'require', '收货人姓名不能为空！', 1, 'regex', 3),
		array('shr_province', 'require', '收货人所在省不能为空！', 1, 'regex', 3),
		array('shr_city', 'require', '收货人城市不能为空！', 1, 'regex', 3),
		array('shr_area', 'require', '收货人地区不能为空！', 1, 'regex', 3),
		array('shr_address', 'require', '收货人地址不能为空！', 1, 'regex', 3),
		array('shr_tel', 'require', '收货人电话不能为空！', 1, 'regex', 3),
		array('pay_method', 'require', '支付方式不能为空！', 1, 'regex', 3),
		array('post_method', 'require', '发货方式不能为空！', 1, 'regex', 3),
	);

	/**
	 * 插入前，检查库存，加锁
	 * @param  [type] &$data  [description]
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	protected function _before_insert(&$data, $option){
		// 判断购物车中是否有商品
		$cartModel = D('Cart');
		$cartData = $cartModel->cartList();
		if(count($cartData) == 0){
			$this->error = '必须先购买商品才能下单';
			return FALSE;
		}
		// 加锁-> 高并发下单时，库存量会出现混乱的问题，加锁来解决
		$this->fp = fopen('./order.lock', 'r');
		flock($this->fp, LOCK_EX);
		$tp = 0; // 总价
		$gnModel = M('GoodsNumber');

		// 循环购物车中每件商品检查库存量够不够，并且计算总价
		$buythis = session('buythis');
		foreach ($cartData as $k => $v){
			// 判断这件商品有没有被选择
			if(!in_array($v['goods_id'].'-'.$v['goods_attr_id'], $buythis))
				continue;
			// 取出这件商品的库存量
			$gn = $gnModel->field('goods_number')->where(array(
				'goods_id' => $v['goods_id'],
				'goods_attr_id' => $v['goods_attr_id']
			))->find();
		
			if($gn['goods_number'] < $v['goods_number']){
				$this->error = '商品库存量不足无法下单';
				return FALSE;
			}
			// 计算总价
			$tp += $v['price'] * $v['goods_number'];
		}

		// 下单前把定单的其他信息补就即可
		$data['member_id'] = session('mid');
		$data['addtime'] = time();
		$data['total_price'] = $tp;

		// 启用事务
		mysql_query('START TRANSACTION');
	}

	/**
	 * 插入后，减少库存量，插入到定单商品表
	 * @param  [type] $data   [description]
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	protected function _after_insert($data, $option){
		// 把购物车中的数据存到定单商品表即可
		$cartModel = D('Cart');
		$cartData = $cartModel->cartList();

		$gnModel = M('GoodsNumber'); // 库存量模型
		$ogModel = M('OrderGoods');  // 定单商品模型
		$buythis = session('buythis');
		foreach ($cartData as $k => $v){
			// 如果这件商品没有勾选就不处理
			if(!in_array($v['goods_id'].'-'.$v['goods_attr_id'], $buythis))
				continue;

			// 减少库存量
			$rs = $gnModel->where(array(
				'goods_id' => $v['goods_id'],
				'goods_attr_id' => $v['goods_attr_id']
			))->setDec('goods_number', $v['goods_number']);
			if($rs === FALSE){
				mysql_query('ROLLBACK');
				return FALSE;
			}

			// 插入到定单商品表
			$rs = $ogModel->add(array(
				'order_id' => $data['id'],
				'member_id' => session('mid'),
				'goods_id' => $v['goods_id'],
				'goods_attr_id' => $v['goods_attr_id'],
				'goods_attr_str' => $v['goods_attr_str'],
				'goods_price' => $v['price'],
				'goods_number' => $v['goods_number'],
			));
			if($rs === FALSE){
				mysql_query('ROLLBACK');
				return FALSE;
			}
		}

		mysql_query('COMMIT'); // 提交事务
		// 释放锁
		flock($this->fp, LOCK_UN);
		fclose($this->fp);

		// 清空购物车中所选择的商品
		$cartModel->clearDb();
		// 把SESSION保存的勾选的数据删除
		session('buythis', null);
	}

	/**
	 *  设置定单为已支付的状态
	 */
	public function setPaid($id){
		// 更新定单的状态为已支付的状态
		$this->where(array('id'=>array('eq', $id)))->setField('pay_status', 1);
		// 增加会员的经验值和积分 - 定单的总价是多少就加多少经验值和积分
		$info = $this->field('total_price,member_id')->find($id);
		$this->execute('UPDATE ecshop_member SET jyz=jyz+'.$info['total_price'],',jifen=jifen+'.$info['total_price'].' WHERE id='.$info['member_id']);
	}
}




















