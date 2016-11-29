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
    				exit;
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
        var_dump($data);
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
        // SELECT a.*,b.* FROM ecshop_goods_attr a LEFT JOIN ecshop_attr b ON a.attr_id=b.id
        $gaData = $gaModel->field('a.*,b.*')->alias('a')->join('LEFT JOIN ecshop_attr b ON a.attr_id=b.id')->where(array('a.goods_id'=>array('eq', $id)))->order('a.attr_id ASC')->select();
        /**************************** 取出当前商品属性不存在的后添加的新的属性 **************************/
        // 循环属性数组取出当前商品已经拥有的属性ID
        $attr_id = array();
        foreach ($gaData as $k => $v){
            $attr_id[] = $v['attr_id'];
        }
        $attr_id = array_unique($attr_id);
        // 取出当前类型下的后添加的新属性
        $attrModel = M('Attr');
        $otherAttr = $attrModel->field('*')->where(array('type_id'=>array('eq', $data['type_id']), 'id'=>array('not in', $attr_id)))->select();
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
}