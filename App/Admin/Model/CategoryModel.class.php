<?php
namespace Admin\Model;
use Think\Model;
/**
 * 分类模型
 */
class CategoryModel extends Model {
	protected $insertFields = array('cat_name','pid');
	protected $updateFields = array('id','cat_name','pid');
	protected $_validate = array(
		array('cat_name', 'require', '分类名称不能为空！', 1, 'regex', 3),
		array('cat_name', '1,30', '分类名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('pid', 'number', '上级分类的ID，0：代表顶级必须是一个整数！', 2, 'regex', 3),
	);
	/************************************* 递归相关方法 *************************************/
	public function getTree(){
		$data = $this->select();
		return $this->_reSort($data);
	}
	private function _reSort($data, $pid=0, $level=0, $isClear=TRUE){
		static $ret = array();
		if($isClear)
			$ret = array();
		foreach ($data as $k => $v){
			if($v['pid'] == $pid){
				$v['level'] = $level;
				$ret[] = $v;
				$this->_reSort($data, $v['id'], $level+1, FALSE);
			}
		}
		return $ret;
	}
	public function getChildren($id){
		$data = $this->select();
		return $this->_children($data, $id);
	}
	private function _children($data, $pid=0, $isClear=TRUE){
		static $ret = array();
		if($isClear)
			$ret = array();
		foreach ($data as $k => $v){
			if($v['pid'] == $pid)
			{
				$ret[] = $v['id'];
				$this->_children($data, $v['id'], FALSE);
			}
		}
		return $ret;
	}

	/**
	 * 前台首页获取分类数据
	 * @return [type] [description]
	 */
	public function getNavCat(){
		//从缓存里获取
		if(S('data')){
			return S('data');
		}
		$ret=array();
		$data=$this->select();
		foreach ($data as $k => $v) {
			//顶级分类
			if($v['pid']==0){
				foreach ($data as $k1 => $v1) {
					//二级分类
					if($v1['pid']==$v['id']){
						foreach ($data as $k2 => $v2) {
							//三级分类
							if($v2['pid']==$v1['id'])
								$v1['children'][]=$v2;
						}
						$v['children'][]=$v1;
					}
				}
				$ret[]=$v;
			}
		}
		S('data',$ret);
		return $ret;
	}
	/**
	 * 删除前
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	public function _before_delete($option){
		// 先找出所有的子分类
		$children = $this->getChildren($option['where']['id']);
		// 如果有子分类都删除掉
		if($children){
			$children = implode(',', $children);
			$this->execute("DELETE FROM ecshop_category WHERE id IN($children)");
		}
	}
}