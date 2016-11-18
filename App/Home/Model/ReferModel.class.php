<?php
namespace Home\Model;
use Think\Model\RelationModel;

class ReferModel extends RelationModel {
	
	//微博表自动完成
	protected $_auto = array(
			array('create', 'time', self::MODEL_INSERT, 'function'),
	);
	
	//关联
	protected $_link = array(
		'topic'=>array(
			'mapping_type'=>self::BELONGS_TO,
			'class_name'=>'topic',
			'foreign_key'=>'tid',
			'mapping_fields'=>'content',
		),
	);

	//@提醒到
	public function referTo($tid, $uid) {
		$data = array(
			'tid'=>$tid,
			'uid'=>$uid,
		);
		
		if ($this->create($data)) {
			$rid = $this->add();
			if (S('refer'.$uid)) {  //如果这个有值
				$count = S('refer'.$uid);  //那我就先获取
				S('refer'.$uid, $count + 1);  //并且加1
			} else {
				S('refer'.$uid, 1);   //没有值则默认为1
			}
			return $rid ? $rid : 0;
		} else {
			return $this->getError();
		}
	}
	
	//获取@数据
	public function getRefer($uid) {
		$map['uid'] = $uid;
		return $this->relation(true)->field('id,tid,uid,read')->where($map)->select();
	}
	
	//设置阅读
	public function readRefer($id) {
		$map['id'] = $id;
		$count = S('refer'.session('user_auth')['id']);
		S('refer'.session('user_auth')['id'], $count - 1);
		return $this->where($map)->save(array('read'=>1));
	}
	
	//获取@数量
	public function getReferCount($uid) {
		$map = array(
			'uid'=>$uid,
			'read'=>0,
		);
		return $this->where($map)->count();
	}
	
}