<?php
namespace Admin\Model;
use Think\Model;
/**
 * 属性模型
 */
class AttrModel extends Model {
	protected $insertFields = array('type_id','attr_name','attr_type','attr_option_values');
	protected $updateFields = array('id','type_id','attr_name','attr_type','attr_option_values');
	//自动验证
	protected $_validate = array(
		array('type_id', 'require', '所在的类型的id不能为空！', 1, 'regex', 3),
		array('type_id', 'number', '所在的类型的id必须是一个整数！', 1, 'regex', 3),
		array('attr_name', 'require', '属性名不能为空！', 1, 'regex', 3),
		array('attr_name', '1,30', '属性名的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('attr_type', 'require', '属性的类型0：唯一 1：可选不能为空！', 1, 'regex', 3),
		array('attr_type', 'number', '属性的类型0：唯一 1：可选必须是一个整数！', 1, 'regex', 3)
	);

	/**
	 * 查找属性
	 * @param  integer $pageSize [description]
	 * @return [type]            [description]
	 */
	public function search($pageSize = 20){
		/**************************************** 搜索 ****************************************/
		$where['type_id']=I('get.type_id');
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
	 * 删除前
	 */
	protected function _before_delete($option){
		if(is_array($option['where']['id'])){
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
}