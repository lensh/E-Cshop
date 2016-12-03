<?php
namespace Home\Controller;

class IndexController extends BaseController{

	/**
	 * 显示首页
	 */
	public function index($value=''){
		//设置页面信息
	    $this->setPageInfo('京西商城-首页','首页','首页',1,array('index'),array('index'));
	    //获取疯狂抢购的商品
	    $promote_goods=D('Admin/Goods')->getPromote();
	    $this->assign('promote_goods',$promote_goods);
	    //精品
	    $best_goods=D('Admin/Goods')->getBest();
	    $this->assign('best_goods',$best_goods);
	    //热品
	    $hot_goods=D('Admin/Goods')->getHot();
	    $this->assign('hot_goods',$hot_goods);
	    //新品
	    $new_goods=D('Admin/Goods')->getNew();
	    $this->assign('new_goods',$new_goods);
		$this->display();
	}

	/**
	 * 商品详情页
	 */
	public function goods(){
		// 接收商品的ID
		$goodsId = $_GET['id'];
		// 取出商品的基本信息
		$goodsModel = M('Goods');
		$info = $goodsModel->find($goodsId);
		// 取出商品的图
		$gpModel = M('GoodsPics');
		$gpData = $gpModel->where(array('goods_id'=>$goodsId))->select();
		/*********** 取出商品属性 ******************/
		// 取出商品的单选属性
		$gaModel = M('GoodsAttr');  // php34_goods_attr
		$_gaData1 = $gaModel->field('a.*,b.attr_name')->alias('a')->join('LEFT JOIN ecshop_attr b ON a.attr_id=b.id')->where(array('a.goods_id'=>$goodsId, 'b.attr_type'=>1))->select();
		$gaData1 = array(); // 处理之后的数组结构
		// 处理二维变三维（把属性相同的放到一起）
		foreach ($_gaData1 as $k => $v){
			$gaData1[$v['attr_name']][] = $v;
		}
		
		// 取出商品的唯一的属性
		$gaData2 = $gaModel->field('a.*,b.attr_name')->alias('a')->join('LEFT JOIN ecshop_attr b ON a.attr_id=b.id')->where(array('a.goods_id'=>$goodsId,'b.attr_type'=>0))->select();
		// 把取出来的数据assign到页面中
		$this->assign(array(
			'info' => $info,
			'gpData' => $gpData,
			'gaData1' => $gaData1,
			'gaData2' => $gaData2,
		));
	    // 设置页面的信息
		$this->setPageInfo($info['goods_name'].'-商品详情页', $info['seo_keyword'], $info['seo_description'], 0, array('goods','common','jqzoom'), array('goods','jqzoom-core'));
		$this->display();
	}

	/**
	 * ajax获取会员价格
	 */
	public function ajaxGetPrice($goodsId)
	{
		$now = time();
		$gmodel=M('Goods');
		// 先判断是否有促销价格
		$price = $gmodel->field('shop_price,is_promote,promote_price,promote_start_time,promote_end_time')->find($goodsId);
		if($price['is_promote'] == 1 && ($price['promote_start_time'] < $now && $price['promote_end_time'] > $now))
		{
			echo $price['promote_price'];
			return;
		}
		// 如果会员没登录直接使用本店价
		$memberId = session('mid');
		if(!$memberId){
			echo $price['shop_price'];
			return;
		}
		// 计算会员价格
		$mpModel = M('MemberPrice');
		$mprice = $mpModel->field('price')->where(array('goods_id'=>array('eq', $goodsId), 'level_id'=>array('eq', session('level_id'))))->find();		
		// 如果有会员价格就直接使用会员价格
		if($mprice)
			echo $mprice['price'];
		else 
			// 如果没有设置会员价格，就按这个级别的折扣率来算
			echo session('rate') * $price['shop_price'];
	}
}

