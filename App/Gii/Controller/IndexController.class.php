<?php
namespace Gii\Controller;
use Think\Controller;
define('GII_PATH', APP_PATH.'Gii/');
define('GII_CONFIG_PATH', GII_PATH.'Table_configs/');
define('GII_TEMPLATE_PATH', GII_PATH.'Code_templates/');
class IndexController extends Controller 
{
	public function index()
	{
		if(IS_POST)
		{
			/********************************** 生成表的配置文件 **********************/
			$type = I('post.type');
			if($type == 2)
			{
				$this->makeConfigFile();
				exit;
			}
			/********************************** 生成代码 ***************************/
			$configName = I('post.config_name');
			if(!$configName)
				$this->error('配置文件名称不能为空！');
			if(!file_exists(GII_CONFIG_PATH.$configName))
				$this->error('配置文件不存在！');
			$config = include(GII_CONFIG_PATH.$configName);
			// 表名转成tp中的名字
			$tpName = $this->_dbName2TpName($config['tableName']);
			// 1.生成对应模块的目录结构
			$moduleDir = APP_PATH.$config['moduleName'];
			$cDir = APP_PATH.$config['moduleName'].'/Controller';
			$mDir = APP_PATH.$config['moduleName'].'/Model';
			$vDir = APP_PATH.$config['moduleName'].'/View';
			$v1Dir = APP_PATH.$config['moduleName'].'/View/'.$tpName;
			if(!is_dir($moduleDir))
				mkdir($moduleDir, 0777);
			if(!is_dir($cDir))
				mkdir($cDir, 0777);
			if(!is_dir($mDir))
				mkdir($mDir, 0777);
			if(!is_dir($vDir))
				mkdir($vDir, 0777);
			if(!is_dir($v1Dir))
				mkdir($v1Dir, 0777);
			// 2. 在view目录下生成对应的表单add.html
			ob_start();
			include(GII_TEMPLATE_PATH . 'add.html');
			$str = ob_get_clean();
			file_put_contents($v1Dir.'/add.html', $str);
			// 3. 生成控制器文件
			ob_start();
			include(GII_TEMPLATE_PATH.'Controller.php');
			$str = ob_get_clean();
			file_put_contents($cDir.'/'.$tpName.'Controller.class.php', "<?php\r\n".$str);
			// 4. 生成模型文件
			ob_start();
			include(GII_TEMPLATE_PATH.'Model.php');
			$str = ob_get_clean();
			file_put_contents($mDir.'/'.$tpName.'Model.class.php', "<?php\r\n".$str);
			// 5. 生成lst.html页面
			ob_start();
			include(GII_TEMPLATE_PATH.'lst.html');
			$str = ob_get_clean();
			file_put_contents($v1Dir.'/lst.html', $str);
			// 6. 生成edit.html页面
			ob_start();
			include(GII_TEMPLATE_PATH.'edit.html');
			$str = ob_get_clean();
			file_put_contents($v1Dir.'/edit.html', $str);
			$this->success('代码生成成功！');
			exit;
		}
		$this->display();
	}
	private function _dbName2TpName($tableName)
	{
		$tableName = explode('_', $tableName);
		unset($tableName[0]);
		$tableName = array_map('ucfirst', $tableName);
		return implode($tableName);
	}
	public function makeConfigFile()
	{
		$db = M();
		$tableName = I('post.config_name');
		if($tableName)
		{
			$tableName = explode(',', $tableName);
			foreach ($tableName as $___v)
			{
				// 取出表的信息
				$_tableInfo = $db->query("show table status WHERE Name LIKE '$___v'");
				if($_tableInfo)
				{
					$_tableInfo = $_tableInfo[0];
					// 取出表的字段
					$_tableFields = $db->query("SHOW FULL FIELDS FROM $___v");
					$tpName = $this->_dbName2TpName($___v);
					ob_start();
					include(GII_TEMPLATE_PATH . 'config.php');
					$str = ob_get_clean();
					file_put_contents(GII_CONFIG_PATH.$___v.'.php', "<?php\r\n".$str);
				}
				else 
					$this->error('表不存在！');
			}
			$this->success('成功！');
			exit;
		}
		else 
			$this->error('请输入表名！');
	}
}