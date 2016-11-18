<?php
namespace Home\Model;
use Think\Model\RelationModel;

class TopicModel extends RelationModel {
	
	//微博表自动验证
	protected $_validate = array(
		//-1,'微博长度不合法！'
		array('allContent', '1,280', -1, self::EXISTS_VALIDATE,'length'),
	);
	
	//微博表自动完成
	protected $_auto = array(
			array('create', 'time', self::MODEL_INSERT, 'function'),
	);
	
	//一对多微博关联
	protected $_link = array(
		'images'=>array(
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Image',
			'foreign_key'=>'tid',
			'mapping_fields'=>'data',
		),
	);
	
	//发布微博
	public function publish($allContent, $uid, $reid = 0) {
		//微博内容分离
		$len = mb_strlen($allContent, 'utf8');
		$content = $contentOver = '';
		if ($len > 255) {
			$content = mb_substr($allContent, 0, 255, 'utf8');
			$contentOver = mb_substr($allContent, 255, 25, 'utf8');
		} else {
			$content = $allContent;
		}
		
		
		$data = array(
			'allContent'=>$allContent,
			'content'=>$content,
			'ip'=>get_client_ip(1),
			'uid'=>$uid,
		);
		
		if (!empty($contentOver)) {
			$data['content_over'] = $contentOver;
		}
		
		if ($reid > 0) {
			$data['reid'] = $reid;
		}
		
		if ($this->create($data)) {
			$tid = $this->add();
			if ($tid) {
				if (S('weibo'.$uid)) {
					$weibo = S('weibo'.$uid);
					$weibo[] = array($tid, NOW_TIME);
					S('weibo'.$uid, $weibo);
				} else {
					S('weibo'.$uid, array(array($tid, NOW_TIME)));  //因为缓存里要存放很多人的微博id以及发布的时间
					//所以是个二维数组，为什么要加时间呢，因为判断微博有没有更新的条件就是发布时间是否大于缓存里存的时间
				}
				//统计转播次数
				if ($reid > 0) $this->reCount($reid);
				//@提醒
				$this->refer($allContent, $tid);
				return $tid;
			} else {
				return 0;
			}
			//return $uid ? $uid : 0;
		} else {
			return $this->getError();
		}
	}
	
	//@提醒
	private function refer($content, $tid) {
		$pattern = '/(@\S+)\s/i';
		preg_match_all($pattern, $content, $arr);
		
		if (!empty($arr[0])) {
			$User = D('user');
			$Refer = D('Refer');
			foreach ($arr[0] as $key=>$value) {
				$username = substr($value, 1);
				$uid = $User->getUser3($username)['id'];
				if ($uid) {
					$rid = $Refer->referTo($tid, $uid);
					if (!$rid) return $this->getError();
				}
			}
		}
	}
	
	//被转发的源微博+1
	private function reCount($reid) {
		$map['id'] = $reid;
		$this->where($map)->setInc('recount');
	}
	
	//被评论的源微博+1
	public function comCount($tid) {
		$map['id'] = $tid;
		$this->where($map)->setInc('comcount');
	}
	
	//获取微博列表
	public function getList($first, $total) {
		return $this->format($this->relation(true)
									->table('__TOPIC__ a, __USER__ b')
									->field('a.id,a.content,a.content_over,a.create,a.uid,a.reid,a.recount,b.username,b.face,b.domain')
									->limit($first, $total)
									->order('a.create DESC')
									->where('a.uid=b.id')
									->select());
	}
	
	//格式化配图JSON
	public function format($list) {
		foreach ($list as $key=>$value) {
			if (!is_null($value['images'])) {
				foreach ($value['images'] as $key2=>$value2) {
					$value['images'][$key2] = json_decode($value2['data'], true);
				}
			}
			$list[$key] = $value;
			$list[$key]['count'] = count($value['images']);
			$time = NOW_TIME - $list[$key]['create'];
			if ($time < 60) {
				$list[$key]['time'] = '刚刚发布';
			} else if ($time < 60 * 60) {
				$list[$key]['time'] = floor($time / 60).'分钟之前';
			} else if (date('Y-m-d') == date('Y-m-d', $list[$key]['create'])) {
				$list[$key]['time'] = '今天'.date('H:i', $list[$key]['create']);
			} else if (date("Y-m-d",strtotime("-1 day")) == date('Y-m-d',$list[$key]['create'])) {
				$list[$key]['time'] = '昨天'.date('H:i', $list[$key]['create']);
			} else if (date('Y') == date('Y', $list[$key]['create'])) {
				$list[$key]['time'] = date('m月d日 H:i', $list[$key]['create']);
			} else {
				$list[$key]['time'] = date('Y年m月d日 H:i', $list[$key]['create']);
			}
			
			//表情解析
			$list[$key]['content'] .= $list[$key]['content_over'];
			$list[$key]['content'] = preg_replace('/\[(a|b|c|d)_([0-9])+\]/i', '<img src="'.__ROOT__.'/Public/'.MODULE_NAME.'/face/$1/$2.gif" border="0">', $list[$key]['content']);
		
			//textarea专用，不转换
			$list[$key]['textarea'] = $list[$key]['content'];
			
			//解析@帐号
			$list[$key]['content'] .= ' ';   //为了一解决某些只@，不写其它内容的问题
			$pattern = '/(@\S+)\s/i';
			$list[$key]['content'] = preg_replace($pattern, '<a href="'.__ROOT__.'/$1" class="space" target="_blank">$1</a>', $list[$key]['content']);
			
			//头像解析
			$list[$key]['face'] = json_decode($list[$key]['face'])->small;
		
			//获取转播的微博
			if ($list[$key]['reid'] > 0) {
				$list[$key]['recontent'] = $this->getReContent($list[$key]['reid']);
			}
		}
		return $list;
	}
	
	//获取被转播的微博内容
	private function getReContent($reid) {
		return $this->format2($this->relation(true)
				->table('__TOPIC__ a, __USER__ b')
				->field('a.id,a.content,a.content_over,a.create,a.uid,a.reid,a.recount,b.username,b.face,b.domain')
				->where('a.uid=b.id AND a.id='.$reid)
				->find());
	}
	
	//格式化被转发的微博
	private function format2($list) {
		if (!is_null($list['images'])) {
			foreach ($list['images'] as $key=>$value) {
				$list['images'][$key] = json_decode($value['data'], true);
			}
		}
		$list['count'] = count($list['images']);
		
		//表情解析
		$list['content'] .= $list['content_over'];
		$list['content'] = preg_replace('/\[(a|b|c|d)_([0-9])+\]/i', '<img src="'.__ROOT__.'/Public/'.MODULE_NAME.'/face/$1/$2.gif" border="0">', $list['content']);
		
		//解析@帐号
		$list['content'] .= ' ';
		$pattern = '/(@\S+)\s/i';
		$list['content'] = preg_replace($pattern, '<a href="'.__ROOT__.'/$1" class="space" target="_blank">$1</a>', $list['content']);
			
		//原微博时间
		$time = NOW_TIME - $list['create'];
		if ($time < 60) {
			$list['time'] = '刚刚发布';
		} else if ($time < 60 * 60) {
			$list['time'] = floor($time / 60).'分钟之前';
		} else if (date('Y-m-d') == date('Y-m-d', $list['create'])) {
			$list['time'] = '今天'.date('H:i', $list['create']);
		} else if (date("Y-m-d",strtotime("-1 day")) == date('Y-m-d',$list['create'])) {
			$list['time'] = '昨天'.date('H:i', $list['create']);
		} else if (date('Y') == date('Y', $list['create'])) {
			$list['time'] = date('m月d日 H:i', $list['create']);
		} else {
			$list['time'] = date('Y年m月d日 H:i', $list['create']);
		}
		
		
		return $list;
	}
	
	
	
}