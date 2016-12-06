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
	 * ajax获取会员价格和浏览量
	 */
	public function ajaxGetPrice(){
		//计算会员价格
		$goodsId=I('get.goodsId');	
		$price=D('Admin/Goods')->getMemberPrice($goodsId);
		//用1个数组记录浏览量,保存最近10件商品的id，但是COOKIE只能存字符串，不能存数组，所以要序列化。
		//当要把一个复杂的数据类型持久化时，需要序列化.serialize，取出时用unserialize反序列化。
		$recentView=isset($_COOKIE['recentView'])?unserialize($_COOKIE['recentView']):array();
		//把最新的放到数组的第一个位置
		array_unshift($recentView,$goodsId); 
		//去重
		$recentView=array_unique($recentView);
		//只取前10个，如果超过10个就切掉后面的
		if(count($recentView)>10){
			$recentView=array_slice($recentView,0,10); //从第一个元素开始截，截10个
		}
		//把处理好的数组保存回cookie
		$savetime=time()+30*86400;
		setCookie('recentView',serialize($recentView),$savetime); //序列化存储
	    //setCookie('recentView',serialize($recentView),$savetime,'/','lensh.com');  放到服务器上后这样写
		//第三个参数跨目录，根目录下有效。第四个参数跨域，二级域名
		echo $price;
	}

	/**
	 * ajax获取最近浏览的商品
	 * @return [type] [description]
	 */
	public function ajaxGetRecent(){
		$recentView=isset($_COOKIE['recentView'])?unserialize($_COOKIE['recentView']):array();
		$ids=implode(',',$recentView);
		$map=array('id'=>array('in',$recentView));
		if($recentView){
			$goodsData=M('Goods')->field('id,goods_name,sm_logo')->where($map)
			->order("INSTR(',$ids,',CONCAT(',',id,','))")->select();
			//MYSQL不排序
			echo json_encode($goodsData);
		}
	}

	/**
	 * ajax获取登陆状态
	 * @return [type] [description]
	 */
	public function ajaxGetComment(){
		$ret=array('login'=>0);
		if(session('mid')){
			$ret['login']=1;	
		}
		echo json_encode($ret);
	}

    /**
	 * ajax获取从哪个评论页点进登陆的,以便跳回原来的地方
	 */
	public function saveAndLogin(){
		session('returnUrl',$_SERVER['HTTP_REFERER']);
	}
}

