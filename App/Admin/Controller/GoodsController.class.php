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
    				return;
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
    				return;
    			}
    		}
    		$this->error($model->getError());
    	}
        // 取出所有的商品类型
        $typeModel = M('Type');
        $typeData = $typeModel->select();
        $this->assign('typeData', $typeData);
        // 取出所有的商品分类
        $catModel = D('Category');
        $catData = $catModel->getTree();
        $this->assign('catData', $catData);
        // 取出所有的品牌
        $brandModel = M('Brand');
        $brandData = $brandModel->select();
        $this->assign('brandData', $brandData);
        // 取出所有的会员级别
        $mlModel = M('MemberLevel');
        $mlData = $mlModel->select();
        $this->assign('mlData', $mlData);
        
        // 取出要修改的商品的基本信息
        $model = M('Goods');
        $data = $model->find($id);
        $this->assign('data', $data);
        // 取出当前商品扩展分类的数据
        $gcModel = M('GoodsCat');
        $extCatId = $gcModel->field('cat_id')->where(array('goods_id'=>array('eq', $id)))->select();
        $this->assign('extCatId', $extCatId);
        // 取出当前商品会员价格的数据
        $mpModel = M('MemberPrice');
        $_mpData = $mpModel->where(array('goods_id'=>array('eq', $id)))->select();
        // 先把二维转一维
        $mpData = array();
        foreach ($_mpData as $k => $v)
        {
            $mpData[$v['level_id']] = $v['price'];
        }
        $this->assign('mpData', $mpData);
        // 取出当前商品的属性数据
        $gaModel = M('GoodsAttr');
        // SELECT a.*,b.attr_name,b.attr_type,b.attr_option_values FROM ecshop_goods_attr a LEFT JOIN ecshop_attr b ON a.attr_id=b.id
        $gaData = $gaModel->field('a.*,b.attr_name,b.attr_type,b.attr_option_values')->alias('a')->join('LEFT JOIN ecshop_attr b ON a.attr_id=b.id')->where(array('a.goods_id'=>array('eq', $id)))->order('a.attr_id ASC')->select();
        /**************************** 取出当前商品属性不存在的后添加的新的属性 **************************/
        // 循环属性数组取出当前商品已经拥有的属性ID
        $attr_id = array();
        foreach ($gaData as $k => $v){
            $attr_id[] = $v['attr_id'];
        }
        $attr_id = array_unique($attr_id);
        // 取出当前类型下的后添加的新属性
        $attrModel = M('Attr');
        //id attr_id 意思是给id取别名
        $otherAttr = $attrModel->field('id attr_id,attr_name,attr_type,attr_option_values')->where(array('type_id'=>array('eq', $data['type_id']), 'id'=>array('not in', $attr_id)))->select();
        if($otherAttr){
            // 把新的属性和原属性合并起来
            $gaData = array_merge($gaData, $otherAttr);
            // 重新根据attr_id字段重新排序这个合并之后二维数组
            usort($gaData, 'attr_id_sort');
        }
        $this->assign('gaData', $gaData);
        // 取出当前商品的图片
        $gpModel = M('GoodsPics');
        $gpData = $gpModel->where(array('goods_id'=>array('eq', $id)))->select();
        $this->assign('gpData', $gpData);
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

    /**
     * ajax删除商品图片
     */
    public function ajaxDeletePic(){
        //删除图片及缩略图
        $model=M('GoodsPics');
        $picData=$model->field('pic,sm_pic')->where(array('id'=>I('get.id')))->find();
        deleteImage($picData);
        echo $model->delete(I('get.id'))?1:0;
    }

   /**
     * ajax删除商品属性
     */
    public function ajaxDeleteAttr(){
        //删除商品属性
        $model=M('GoodsAttr');
        $AttrData=$model->field('id')->where(array('id'=>I('get.id')))->find();
        if($AttrData){
            echo $model->delete(I('get.id'))?1:0;
        }
    }

    /**
     * 商品放入回收站
     */
    public function recycle(){
        $id=I('get.id');
        $affect=M("Goods")->where(array('id'=>$id))->setField('is_delete',1);
        if($affect){
            $this->success('回收成功',U('lst'));
        }
    }

    /**
     * 商品还原
     */
    public function restore(){
        $id=I('get.id');
        $affect=M("Goods")->where(array('id'=>$id))->setField('is_delete',0);
        if($affect){
            $this->success('还原成功',U('recyclelst'));
        }
    }
    
    /**
     * 回收站列表
     * @return [type] [description]
     */
    public function recyclelst(){
        $model = D('Goods');
        $data = $model->search(15,1);
        $this->assign(array(
            'data' => $data['data'],
            'page' => $data['page'],
        ));
        $this->display();
    }

    /**
     * 库存量
     * @return [type] [description]
     */
    public function number(){
        $goods_id=I('get.id');
        if(IS_POST){
            $goods_attr_id=I('post.goods_attr_id');
            $goods_number=I('post.goods_number');
            $rate= count($goods_attr_id)/count($goods_number);//比例
            $gnmodel=M('GoodsNumber');
            $gnmodel->where(array('goods_id'=>$goods_id))->delete();
            $_i=0;  //从第几个开始拿
            foreach ($goods_number as $k => $v) {
                //把每次拿到的uid放到这个数组里
                $_arr=array();
                //到attr_id的数组里拿rate个
                for($i=0;$i<$rate;$i++){
                    $_arr[]=$goods_attr_id[$_i];
                    $_i++;
                }   
                //升序排列数组
                sort($_arr);        
                $gnmodel->add(array(
                    'goods_id'=>$goods_id,
                    'goods_number'=>$v,
                    'goods_attr_id'=>implode(',',$_arr),
                ));
            }
            $this->success('设置成功',U('lst'));
            return;
        }
        //先在goods_attr表里取出这件商品同一个属性有多个值的属性id，再在goods_attr表里找出attr_id
        //等于上面id的记录，最后去联attr表查询这个属性的名称
        $sql="select a.attr_name,b.* from ecshop_attr a left join ecshop_goods_attr b on 
         a.id=b.attr_id where b.attr_id in(select attr_id from ecshop_goods_attr
         where goods_id='$goods_id' group by attr_id having count(*)>1) and goods_id='$goods_id'";
        $attrData=M()->query($sql);
        $attr=array();
        foreach ($attrData as $k => $v) {
            $attr[$v['attr_id']][]=$v;
        }
        $this->assign('attr',$attr);

        //查找库存表,取出当前商品的库存量
        $gnData=M('GoodsNumber')->where(array('goods_id'=>$goods_id))->select();
        $this->assign('gnData',$gnData);
        $this->display();  
    }
}