<?php
namespace Admin\Model;
use Think\Model;
/**
 * 会员等级模型
 */
class MemberLevelModel extends Model {
	protected $insertFields = array('level_name','bottom_num','top_num','rate');
	protected $updateFields = array('id','level_name','bottom_num','top_num','rate');
	protected $_validate = array(
		array('level_name', 'require', '级别名称不能为空！', 1, 'regex', 3),
		array('level_name', '1,30', '级别名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('bottom_num', 'require', '积分下限不能为空！', 1, 'regex', 3),
		array('bottom_num', 'number', '积分下限必须是一个整数！', 1, 'regex', 3),
		array('top_num', 'require', '积分上限不能为空！', 1, 'regex', 3),
		array('top_num', 'number', '积分上限必须是一个整数！', 1, 'regex', 3),
		array('rate', 'number', '折扣率，90为9折必须是一个整数！', 2, 'regex', 3),
	);
	public function search($pageSize = 20){
		/**************************************** 搜索 ****************************************/
		$where = array();
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
	// 删除前
	protected function _before_delete($option){
		if(is_array($option['where']['id'])){
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
	/************************************ 其他方法 ********************************************/
}