<?php
namespace Home\Model;
use Think\Model;

class ImageModel extends Model {
	//配图入库
	public function storage($img, $tid) {
		foreach ($img as $key=>$value) {
			$data = array(
				'data'=>$value,
				'tid'=>$tid,
			);
			if (!$this->add($data)) {
				return 0;
			}
		}
		return 1;
	}
}