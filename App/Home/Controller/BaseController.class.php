<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller{

	/**
	 * 设置页面信息
	 */
	protected function setPageInfo($title='',$keywords='',$description='',$nav=0,$css=array(),$js=array()){
	    $this->assign('page_title',$title);
		$this->assign('page_keywords',$keywords);
		$this->assign('page_description',$description);
		$this->assign('nav',$nav);
		$this->assign('page_css',$css);
		$this->assign('page_js',$js);
	}
}

