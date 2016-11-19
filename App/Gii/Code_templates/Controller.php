namespace <?php echo $config['moduleName']; ?>\Controller;
use \Admin\Controller\IndexController;
class <?php echo $tpName; ?>Controller extends IndexController 
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('<?php echo $config['moduleName']; ?>/<?php echo $tpName; ?>');
    		if($model->create(I('post.'), 1))
    		{
    			if($id = $model->add())
    			{
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
<?php if($config['digui'] == 1): ?>
		$parentModel = D('<?php echo $config['moduleName']; ?>/<?php echo $tpName; ?>');
		$parentData = $parentModel->getTree();
		$this->assign('parentData', $parentData);
<?php endif; ?>

		$this->setPageBtn('添加<?php echo $config['tableCnName']; ?>', '<?php echo $config['tableCnName']; ?>列表', U('lst?p='.I('get.p')));
		$this->display();
    }
    public function edit()
    {
    	$<?php echo $config['pk']; ?> = I('get.<?php echo $config['pk']; ?>');
    	if(IS_POST)
    	{
    		$model = D('<?php echo $config['moduleName']; ?>/<?php echo $tpName; ?>');
    		if($model->create(I('post.'), 2))
    		{
    			if($model->save() !== FALSE)
    			{
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('<?php echo $tpName; ?>');
    	$data = $model->find($<?php echo $config['pk']; ?>);
    	$this->assign('data', $data);
<?php if($config['digui'] == 1): ?>
		$parentModel = D('<?php echo $config['moduleName']; ?>/<?php echo $tpName; ?>');
		$parentData = $parentModel->getTree();
		$children = $parentModel->getChildren($<?php echo $config['pk']; ?>);
		$this->assign(array(
			'parentData' => $parentData,
			'children' => $children,
		));
<?php endif; ?>

		$this->setPageBtn('修改<?php echo $config['tableCnName']; ?>', '<?php echo $config['tableCnName']; ?>列表', U('lst?p='.I('get.p')));
		$this->display();
    }
    public function delete()
    {
    	$model = D('<?php echo $config['moduleName']; ?>/<?php echo $tpName; ?>');
    	if($model->delete(I('get.id', 0)) !== FALSE)
    	{
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else 
    	{
    		$this->error($model->getError());
    	}
    }
    public function lst()
    {
    	$model = D('<?php echo $config['moduleName']; ?>/<?php echo $tpName; ?>');
<?php if($config['digui'] == 1): ?>
		$data = $model->getTree();
    	$this->assign(array(
    		'data' => $data,
    	));
<?php else: ?>
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));
<?php endif; ?>

		$this->setPageBtn('<?php echo $config['tableCnName']; ?>列表', '添加<?php echo $config['tableCnName']; ?>', U('add'));
    	$this->display();
    }
}