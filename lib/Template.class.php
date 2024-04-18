<?php
require_once(__SMARTY_LIB_PATH.'Smarty.class.php');
class Template extends Smarty{
   	
    function __construct() {
//    	$this->Smarty();
  	parent::__construct();
	$this->setTemplateDir(__SMARTY_TPL_PATH);
	$this->setCompileDir(__SMARTY_CPL_PATH);
        $this->setConfigDir(__SMARTY_CFG_PATH);
	$this->caching = Smarty::CACHING_OFF;
    }
}
?>
