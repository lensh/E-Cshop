<?php
namespace Admin\Model;
use Think\Model;
/**
 * 品牌模型
 */
class BrandModel extends Model {
	protected $insertFields = array('brand_name','site_url');
	protected $updateFields = array('id','brand_name','site_url');
	//自动验证
	protected $_validate = array(
		array('brand_name', 'require', '品牌名称不能为空！', 1, 'regex', 3),
		array('brand_name', '1,45', '品牌名称的值最长不能超过 45 个字符！', 1, 'length', 3),
		array('site_url', 'require', '品牌网站地址不能为空！', 1, 'regex', 3),
		array('site_url', '1,150', '品牌网站地址的值最长不能超过 150 个字符！', 1, 'length', 3),
	);
	/**
	 * 查找品牌
	 * @param  integer $pageSize [description]
	 * @return [type]            [description]
	 */
	public function search($pageSize = 20){
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($brand_name = I('get.brand_name'))
			$where['brand_name'] = array('like', "%$brand_name%");
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->alias('a')->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}

	/**
	 * 添加前
	 */ 
	protected function _before_insert(&$data, $option){
		if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){
			$ret = uploadOne('logo', 'Brand', array());
			if($ret['ok'] == 1){
				$data['logo'] = $ret['images'][0];
			}
			else {
				$this->error = $ret['error'];
				return FALSE;
			}
		}
	}

	/**
	 * 修改前
	 */
	protected function _before_update(&$data, $option){
		if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){
			$ret = uploadOne('logo', 'Brand', array());
			if($ret['ok'] == 1){
				$data['logo'] = $ret['images'][0];
			}
			else {
				$this->error = $ret['error'];
				return FALSE;
			}
			deleteImage(array(
				I('post.old_logo'),
			));
		}
	}

	/**
	 * 删除前
	 */
	protected function _before_delete($option){
		if(is_array($option['where']['id'])){
			$this->error = '不支持批量删除';
			return FALSE;
		}
		$images = $this->field('logo')->find($option['where']['id']);
		deleteImage($images);
	}
}