<?php
namespace Home\Model;
use Think\Model;

class ApproveModel extends Model {
	
	//用户表自动验证
	protected $_validate = array(
		//-1,'认证帐号不得为空！'
		array('name', 'require', -1, self::EXISTS_VALIDATE),
		//-2,'申请信息不得为空！'
		array('info', 'require', -2, self::EXISTS_VALIDATE),
	);
	
	//微博表自动完成
	protected $_auto = array(
		array('create', 'time', self::MODEL_INSERT, 'function'),
	);
	
	//申请认证
	public function apply($name, $info, $uid) {
		$data = array(
			'name'=>$name,
			'info'=>$info,
			'uid'=>$uid,	
		);
		
		if ($this->create($data)) {
			$aid = $this->add();
			return $aid ? $aid : 0;
		} else {
			return $this->getError();
		}
	}
	
	//获取申请认证
	public function getApprove($uid) {
		$map['uid'] = $uid;
		return $this->field('name,info,state')->where($map)->find(); 
	}
	
}