<?php
namespace Home\Controller;

class IndexController extends BaseController{
	public function index($value=''){
	    $this->setPageInfo(1,'京西商城-首页','首页','首页',array('index'),array('index'));
		$this->display();
	}
}

