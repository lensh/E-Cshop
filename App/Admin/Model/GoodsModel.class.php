<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model {
	protected $insertFields = array('goods_name','extend_cat_id','cat_id','brand_id','market_price','shop_price','jifen','jyz','jifen_price','is_promote','promote_price','promote_start_time','promote_end_time','is_hot','is_new','is_best','is_on_sale','seo_keyword','seo_description','type_id','sort_num','is_delete','goods_desc');
	protected $updateFields = array('id','goods_name','cat_id','brand_id','market_price','shop_price','jifen','jyz','jifen_price','is_promote','promote_price','promote_start_time','promote_end_time','is_hot','is_new','is_best','is_on_sale','seo_keyword','seo_description','type_id','sort_num','is_delete','goods_desc');
	/**
	 * 自动验证字段
	 * @var array
	 */
	protected $_validate = array(
		array('goods_name', 'require', '商品名称不能为空！', 1, 'regex', 3),
		array('goods_name', '1,45', '商品名称的值最长不能超过 45 个字符！', 1, 'length', 3),
		array('cat_id', 'require', '主分类的id不能为空！', 1, 'regex', 3),
		array('cat_id', 'number', '主分类的id必须是一个整数！', 1, 'regex', 3),
		array('brand_id', 'require', '品牌的id不能为空！', 1, 'regex', 3),
		array('brand_id', 'number', '品牌的id必须是一个整数！', 1, 'regex', 3),
		array('market_price', 'currency', '市场价必须是货币格式！', 2, 'regex', 3),
		array('shop_price', 'currency', '本店价必须是货币格式！', 2, 'regex', 3),
		array('jifen', 'require', '赠送积分不能为空！', 1, 'regex', 3),
		array('jifen', 'number', '赠送积分必须是一个整数！', 1, 'regex', 3),
		array('jyz', 'require', '赠送经验值不能为空！', 1, 'regex', 3),
		array('jyz', 'number', '赠送经验值必须是一个整数！', 1, 'regex', 3),
		array('jifen_price', 'require', '如果要用积分兑换，需要的积分数不能为空！', 1, 'regex', 3),
		array('jifen_price', 'number', '如果要用积分兑换，需要的积分数必须是一个整数！', 1, 'regex', 3),
		array('is_promote', 'number', '是否促销必须是一个整数！', 2, 'regex', 3),
		array('promote_price', 'currency', '促销价必须是货币格式！', 2, 'regex', 3),
		array('is_hot', 'number', '是否热卖必须是一个整数！', 2, 'regex', 3),
		array('is_new', 'number', '是否新品必须是一个整数！', 2, 'regex', 3),
		array('is_best', 'number', '是否精品必须是一个整数！', 2, 'regex', 3),
		array('is_on_sale', 'number', '是否上架：1：上架，0：下架必须是一个整数！', 2, 'regex', 3),
		array('seo_keyword', '1,150', 'seo优化[搜索引擎【百度、谷歌等】优化]_关键字的值最长不能超过 150 个字符！', 2, 'length', 3),
		array('seo_description', '1,150', 'seo优化[搜索引擎【百度、谷歌等】优化]_描述的值最长不能超过 150 个字符！', 2, 'length', 3),
		array('type_id', 'number', '商品类型id必须是一个整数！', 2, 'regex', 3),
		array('sort_num', 'number', '排序数字必须是一个整数！', 2, 'regex', 3),
		array('is_delete', 'number', '是否放到回收站：1：是，0：否必须是一个整数！', 2, 'regex', 3),
	);
	/**
	 * 查找商品
	 * @param  integer $pageSize  [description]
	 * @param  integer $is_delete [description]
	 * @return [type]             [description]
	 */
	public function search($pageSize = 20,$is_delete=0){
		/**************************************** 搜索 ****************************************/
		$where['is_delete'] = $is_delete;
		if($goods_name = I('get.goods_name'))
			$where['goods_name'] = array('like', "%$goods_name%");
		if($cat_id = I('get.cat_id'))
			$where['cat_id'] = array('eq', $cat_id);
		if($brand_id = I('get.brand_id'))
			$where['brand_id'] = array('eq', $brand_id);
		$shop_pricefrom = I('get.shop_pricefrom');
		$shop_priceto = I('get.shop_priceto');
		if($shop_pricefrom && $shop_priceto)
			$where['shop_price'] = array('between', array($shop_pricefrom, $shop_priceto));
		elseif($shop_pricefrom)
			$where['shop_price'] = array('egt', $shop_pricefrom);
		elseif($shop_priceto)
			$where['shop_price'] = array('elt', $shop_priceto);
		$is_hot = I('get.is_hot');
		if($is_hot != '' && $is_hot != '-1')
			$where['is_hot'] = array('eq', $is_hot);
		$is_new = I('get.is_new');
		if($is_new != '' && $is_new != '-1')
			$where['is_new'] = array('eq', $is_new);
		$is_best = I('get.is_best');
		if($is_best != '' && $is_best != '-1')
			$where['is_best'] = array('eq', $is_best);
		$is_on_sale = I('get.is_on_sale');
		if($is_on_sale != '' && $is_on_sale != '-1')
			$where['is_on_sale'] = array('eq', $is_on_sale);
		if($type_id = I('get.type_id'))
			$where['type_id'] = array('eq', $type_id);
		$startTime = I('get.startTime');
		$endTime = I('get.endTime');
		if($startTime && $endTime)
			$where['addtime'] = array('between', array(strtotime("$startTime 00:00:00"), strtotime("$endTime 23:59:59")));
		elseif($startTime)
			$where['addtime'] = array('egt', strtotime("$startTime 00:00:00"));
		elseif($endTime)
			$where['addtime'] = array('elt', strtotime("$endTime 23:59:59"));
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->field('a.*,IFNULL(sum(b.goods_number),0) gn')->alias('a')
		->join('left join ecshop_goods_number b on a.id=b.goods_id')
		->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	/**
	 * 添加前
	 * @param  [type] &$data  [description]
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	protected function _before_insert(&$data, $option){
		$data['addtime']=time();
		$promote_start_time=I('post.promote_start_time');
		$promote_end_time=I('post.promote_end_time');
		$data['promote_start_time']=strtotime("$promote_start_time 00:00:00");
		$data['promote_end_time']=strtotime("$promote_end_time 00:00:00");
		if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){
			$ret = uploadOne('logo', 'Goods', array(
				array(150, 150, 2)
			));
			if($ret['ok'] == 1){
				$data['logo'] = $ret['images'][0];
				$data['sm_logo'] = $ret['images'][1];
			}
			else {
				$this->error = $ret['error'];
				return FALSE;
			}
		}
	}

	/**
	 * 添加后处理关联的表
	 */
	protected function _after_insert(&$data, $option){

		/*****处理商品的扩展分类****/
		$extend_cat_id=I('post.extend_cat_id');
		if($extend_cat_id){
			$model=M('GoodsCat');
			foreach ($extend_cat_id as $v) {
				if(empty($v)) continue;
				$model->add(array(
					'goods_id'=>$data['id'],
					'cat_id'=>$v
				));
			}
		}

		/*****处理会员价格********/
		$mp=I('post.mp');
		if($mp){
			$model1=M('MemberPrice');
			foreach ($mp as $k => $v) {
				if(empty($v)) continue;
			    $model1->add(array(
					'goods_id'=>$data['id'],
					'level_id'=>$k,
					'price'=>$v
				));
			}
		}

		/*******处理商品属性********/
	    $attr=I('post.attr');
	    $attr_price=I('post.attr_price');  
	    if($attr){
	    	$model2=M('GoodsAttr');
	    	foreach ($attr as $k=> $v) {
	    		foreach ($v as $k1 => $v1) {
	    			if(empty($v1)) continue;
	    			$price = isset($attr_price[$k][$k1])?$attr_price[$k][$k1]:'';
	    			$model2->add(array(
						'goods_id'=>$data['id'],
						'attr_id'=>$k,
						'attr_value'=>$v1,
						'attr_price'=>$price
					));	
	    		}
	    	}
	    }

	    /*******处理商品相册********/
	    if(hasImage('pics')){
	    	//批量上传之后的图片数组，改造成多个一维数组
	    	$pics=array();
	    	foreach ($_FILES['pics']['name'] as $k => $v) {
	    		if($_FILES['pics']['size'][$k]==0)  continue;
	    		$pics[]=array(
	    			'name'=>$v,
	    			'type'=>$_FILES['pics']['type'][$k],
	    			'tmp_name'=>$_FILES['pics']['tmp_name'][$k],
	    			'error'=>$_FILES['pics']['error'][$k],
	    			'size'=>$_FILES['pics']['size'][$k]
	    		);
	    	}
	    	//在调用uploadOne上传时会使用$_FILES数组上传图片
	    	$_FILES=$pics;
	    	//循环所有的图片一张一张上传
	    	$goodsPicModel=M('GoodsPics');
	    	foreach ($pics as $k => $v) {
	    		$ret=uploadOne($k,'Goods',array(
	    			array('150','150')
	    		));
	    		//如果上传成功，则插到数据库里
	    		if($ret['ok']==1){
	    			$goodsPicModel->add(array(
	    				'goods_id'=>$data['id'],
	    				'pic'=>$ret['images'][0],
	    				'sm_pic'=>$ret['images'][1],
	    			));
	    		}
	    	}
	    }
	}	
	/**
	 * 修改前
	 * @param  [type] &$data  [description]
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	protected function _before_update(&$data, $option){
	    if(!I('post.is_promote'))  $data['is_promote']=0;
	    //修改促销时间
		$promote_start_time=I('post.promote_start_time');
		$promote_end_time=I('post.promote_end_time');
		if($promote_start_time&&$promote_end_time){
			$data['promote_start_time']=strtotime("$promote_start_time 00:00:00");
			$data['promote_end_time']=strtotime("$promote_end_time 00:00:00");
		}
		//判断商品类型有没有修改，如果修改了则删除该商品原来的属性
		if(I('post.old_type_id')!=I('post.type_id')){
			$gamodel=M('GoodsAttr');
			$gamodel->where(array('goods_id'=>$option['where']['id']))->delete();
		}
		if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){
			$ret = uploadOne('logo', 'Goods', array(
				array(150, 150, 2)
			));
			if($ret['ok'] == 1){
				$data['logo'] = $ret['images'][0];
				$data['sm_logo'] = $ret['images'][1];
			}
			else {
				$this->error = $ret['error'];
				return FALSE;
			}
			deleteImage(array(
				I('post.old_logo'),
				I('post.old_sm_logo')
			));
		}
	}

	/**
	 * 修改后处理相关联的表
	 */
	protected function _after_update($data, $option){

		/*****处理商品的扩展分类****/
		$ext_cat_id=I('post.ext_cat_id');
		if($ext_cat_id){
			$model=M('GoodsCat');
		    //先清除商品原来的扩展分类数据
		    $model->where(array('goods_id'=>$option['where']['id']))->delete();
		    //再添加
			foreach ($ext_cat_id as $v) {
				if(empty($v)) continue;
				$model->add(array(
					'goods_id'=>$data['id'],
					'cat_id'=>$v
				));
			}
		}

		/*****处理会员价格********/
		$mp=I('post.mp');
		if($mp){
			$model1=M('MemberPrice');
			//先清除商品原来的扩展分类数据
		    $model1->where(array('goods_id'=>$option['where']['id']))->delete();
			foreach ($mp as $k => $v) {
				if(empty($v)) continue;
			    $model1->add(array(
					'goods_id'=>$data['id'],
					'level_id'=>$k,
					'price'=>$v
				));
			}
		}

		/*******处理商品属性********/
		//1.处理新加的属性,名字不带old_
	    $attr=I('post.ga');
	    $attr_price=I('post.attr_price');  
	    if($attr){
	    	$model2=M('GoodsAttr');
	    	foreach ($attr as $k=> $v) {
	    		foreach ($v as $k1 => $v1) {
	    			if(empty($v1)) continue;
	    			$price = isset($attr_price[$k][$k1])?$attr_price[$k][$k1]:'';
	    			$model2->add(array(
						'goods_id'=>$option['where']['id'],
						'attr_id'=>$k,
						'attr_value'=>$v1,
						'attr_price'=>$price
					));	
	    		}
	    	}
	    }
	    //2.处理原属性
   		$old_attr=I('post.old_ga');
	    $old_attr_price=I('post.old_attr_price');  
	    if($old_attr){
	    	$model2=M('GoodsAttr');
	    	foreach ($old_attr as $k=> $v) {
	    		foreach ($v as $k1 => $v1) {
	    			if(empty($v1)) continue;
	    			$price = isset($old_attr_price[$k][$k1])?$old_attr_price[$k][$k1]:'';
	    			$model2->save(array(
						'id'=>$k1,
						'attr_value'=>$v1,
						'attr_price'=>$price
					));	
	    		}
	    	}
	    }	    

	    /*******处理商品相册********/
	    if(hasImage('pics')){
	    	//批量上传之后的图片数组，改造成多个一维数组
	    	$pics=array();
	    	foreach ($_FILES['pics']['name'] as $k => $v) {
	    		if($_FILES['pics']['size'][$k]==0)  continue;
	    		$pics[]=array(
	    			'name'=>$v,
	    			'type'=>$_FILES['pics']['type'][$k],
	    			'tmp_name'=>$_FILES['pics']['tmp_name'][$k],
	    			'error'=>$_FILES['pics']['error'][$k],
	    			'size'=>$_FILES['pics']['size'][$k]
	    		);
	    	}
	    	//在调用uploadOne上传时会使用$_FILES数组上传图片
	    	$_FILES=$pics;
	    	//循环所有的图片一张一张上传
	    	$goodsPicModel=M('GoodsPics');
	    	foreach ($pics as $k => $v) {
	    		$ret=uploadOne($k,'Goods',array(
	    			array('150','150')
	    		));
	    		//如果上传成功，则插到数据库里
	    		if($ret['ok']==1){
	    			$goodsPicModel->add(array(
	    				'goods_id'=>$option['where']['id'],
	    				'pic'=>$ret['images'][0],
	    				'sm_pic'=>$ret['images'][1],
	    			));
	    		}
	    	}
	    }

	}

	/**
	 * 删除前
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	protected function _before_delete($option){
		if(is_array($option['where']['id'])){
			$this->error = '不支持批量删除';
			return FALSE;
		}
		$images = $this->field('logo,sm_logo')->find($option['where']['id']);
		deleteImage($images);
	    /**********先删除商品的其他的信息*********/
		// 扩展分类
		$model = M('GoodsCat');
		$model->where(array('goods_id'=>array('eq', $option['where']['id'])))->delete();
		// 会员价格
		$model = M('MemberPrice');
		$model->where(array('goods_id'=>array('eq', $option['where']['id'])))->delete();
		// 商品属性
		$model = M('GoodsAttr');
		$model->where(array('goods_id'=>array('eq', $option['where']['id'])))->delete();
		// 商品库存量
		$model = M('GoodsNumber');
		$model->where(array('goods_id'=>array('eq', $option['where']['id'])))->delete();
		// 商品图片
		$model = M('GoodsPics');
		// 先取出图片的路径
		$pics = $model->field('pic,sm_pic')->where(array('goods_id'=>array('eq', $option['where']['id'])))->select();
		// 循环每个图片进行删除
		foreach ($pics as $p){
			deleteImage($p);
		}
		$model->where(array('goods_id'=>array('eq', $option['where']['id'])))->delete();
	}
    
    /**
     * 前台取出处于促销期间的商品
     * @return [type] [description]
     */
	public function getPromote($limit=5){
		if(S('promote_goods')){
			return S('promote_goods');
		}
		$map=array(
			'is_promote'=>1,
			'is_delete'=>0,
			'is_on_sale'=>1,
			'promote_start_time'=>array('elt',time()),
			'promote_end_time'=>array('egt',time())
		);
		$data=$this->field('id,goods_name,promote_price,sm_logo')->where($map)
		->order('sort_num desc')->limit($limit)->select();
		S('promote_goods',$data);
		return $data;
	}

	/**
     * 前台取出最新的商品
     * @return [type] [description]
     */
	public function getNew($limit=5){
		if(S('new_goods')){
			return S('new_goods');
		}
		$map=array(
			'is_new'=>1,
			'is_delete'=>0,
			'is_on_sale'=>1
		);
		$data=$this->field('id,goods_name,shop_price,sm_logo')->where($map)
		->order('sort_num desc')->limit($limit)->select();
		S('new_goods',$data);
		return $data;
	}

	/**
     * 前台取出最热的商品
     * @return [type] [description]
     */
	public function getHot($limit=5){
		if(S('hot_goods')){
			return S('hot_goods');
		}
		$map=array(
			'is_hot'=>1,
			'is_delete'=>0,
			'is_on_sale'=>1
		);
		$data=$this->field('id,goods_name,shop_price,sm_logo')->where($map)
		->order('sort_num desc')->limit($limit)->select();
		S('hot_goods',$data);
		return $data;
	}

	/**
     * 前台取出最精的商品
     * @return [type] [description]
     */
	public function getBest($limit=5){
		if(S('best_goods')){
			return S('best_goods');
		}
		$map=array(
			'is_best'=>1,
			'is_delete'=>0,
			'is_on_sale'=>1
		);
		$data=$this->field('id,goods_name,shop_price,sm_logo')->where($map)
		->order('sort_num desc')->limit($limit)->select();
		S('best_goods',$data);
		return $data;
	}

    /**
	 * 前台商品详情页ajax获取会员价格
	 */
	public function getMemberPrice($goods_id){
		$now = time();
		// 先判断是否有促销价格
		$price = $this->field('shop_price,is_promote,promote_price,promote_start_time,promote_end_time')->find($goodsId);
		if($price['is_promote'] == 1 && ($price['promote_start_time'] < $now && $price['promote_end_time'] > $now))
		{
			return $price['promote_price'];
		}
		// 如果会员没登录直接使用本店价
		$memberId = session('mid');
		if(!$memberId){
			return $price['shop_price'];
		}
		// 计算会员价格
		$mpModel = M('MemberPrice');
		$mprice = $mpModel->field('price')->where(array('goods_id'=>array('eq', $goodsId), 'level_id'=>array('eq', session('level_id'))))->find();		
		// 如果有会员价格就直接使用会员价格
		if($mprice)
			return $mprice['price'];
		else 
			// 如果没有设置会员价格，就按这个级别的折扣率来算
			return session('rate') * $price['shop_price'];
	}

	/**
	 * 转化商品属性ID为商品属性字符串
	 */
	public function convertGoodsAttrIdToGoodsAttrStr($gaid){
		if($gaid){
			$sql = 'SELECT GROUP_CONCAT( CONCAT( b.attr_name,  ":", a.attr_value ) SEPARATOR  "<br />" ) gastr FROM ecshop_goods_attr a LEFT JOIN ecshop_attr b ON a.attr_id = b.id WHERE a.id IN ('.$gaid.')';
			$ret = $this->query($sql);
			return $ret[0]['gastr'];
		}
		else 
			return '';
	}
}