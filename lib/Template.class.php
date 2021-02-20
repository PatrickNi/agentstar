<?php
require_once(__SMARTY_LIB_PATH.'Smarty.class.php');
class Template extends Smarty{
   	
    function Template() {
    	$this->Smarty();
		$this->template_dir	= __SMARTY_TPL_PATH;
		$this->compile_dir		= __SMARTY_CPL_PATH;
		$this->config_dir		= __SMARTY_CFG_PATH;
		$this->cache_dir		= __SMARTY_CAH_PATH;
		$this->caching			= false;
    }
}
?>