<?php
namespace Admin\Model;
use Think\Model;
/**
 * 权限模型
 */
class AuthModel extends Model{
	//插入时维护的字段
	protected $insertFields=array('auth_name','module_name','controller_name','action_name','pid','auth_level');
	//更新时维护字段
	protected $updateFields=array('id','auth_name','module_name','controller_name','action_name','pid','auth_level');
	
	//自动验证
	protected $_validate = array(
		array('auth_name', 'require', '权限名称不能为空！', 1, 'regex', 3),
		array('auth_name', '1,30', '权限名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('module_name', 'require', '模块名称不能为空！', 1, 'regex', 3),
		array('module_name', '1,10', '模块名称的值最长不能超过 10 个字符！', 1, 'length', 3),
		array('controller_name', 'require', '控制器名称不能为空！', 1, 'regex', 3),
		array('controller_name', '1,10', '控制器名称的值最长不能超过 10 个字符！', 1, 'length', 3),
		array('action_name', 'require', '方法名称不能为空！', 1, 'regex', 3),
		array('action_name', '1,10', '方法名称的值最长不能超过 10 个字符！', 1, 'length', 3),
		array('pid', 'number', '上级权限的ID，0：代表顶级权限必须是一个整数！', 2, 'regex', 3),
	);

	/**
	 * 获取权限
	 * @return array 权限数组
	 */
	public function getAuth(){
		//获取总记录数
		$count=$this->field('id')->count();
		// 生成翻页对象
		$page = new \Think\Page($count,14);
		// 获取翻页字符串
		$pageString = $page->show();
		// 取出当前页的数据
		$data=$this->limit($page->firstRow.','.$page->listRows)->select();
		return array(
			'page' => $pageString,
			'data' => $data
		);
	}

	/**
	 * 获取带等级的权限
	 * @return array 权限数组
	 */
	public function getTree(){
		$data=$this->select();
		return $this->_reSort($data);
	}
	
	/**
	 * 无限极分类,获取每个权限是第几个等级
	 * @param  array    $data       数组数据
	 * @param  int 		$parent_id  父级id
	 * @param  int 		$level      等级
	 * @param  boolean  $isClear    是否清空
	 * @return array
	 */
	public function _reSort($data, $parent_id=0, $level=0, $isClear=TRUE){
		static $ret = array();
		if($isClear)
			$ret = array();
		foreach ($data as $k => $v){
			if($v['pid'] == $parent_id){
				$v['level'] = $level;
				$ret[] = $v;
				$this->_reSort($data, $v['id'], $level+1, FALSE);
			}
		}
		return $ret;
	}

	/**
	 * 获取某个父级权限的所有子权限的id
	 * @param  int $id   父级权限的id
	 * @return array     子权限的id
	 */
	public function getChildren($id){
		$data = $this->select();
		return $this->_children($data, $id);
	}

	/**
	 * 无限极分类，获取某个父级权限的所有子权限的id
	 * @param  array   $data      父级权限的数据
	 * @param  integer $parent_id 父级权限的id
	 * @param  boolean $isClear   是否清空
	 * @return array
	 */
	private function _children($data, $parent_id=0, $isClear=TRUE){
		static $ret = array();
		if($isClear)
			$ret = array();
		foreach ($data as $k => $v){
			if($v['p_id'] == $parent_id){
				$ret[] = $v['id'];
				$this->_children($data, $v['id'], FALSE);
			}
		}
		return $ret;
	}

	/**
	 * 钩子方法，前置删除方法，删除权限
	 * @param
	 * @return
	 */
	public function _before_delete($option){
		// 先找出所有的子分类
		$children = $this->getChildren($option['where']['id']);
		// 如果有子分类都删除掉
		if($children){
			$children = implode(',', $children);
			$this->execute("DELETE FROM ecshop_auth WHERE id IN($children)");
		}
	}
}