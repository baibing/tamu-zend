<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	/**
	 * Initialize the doctype
	 */
	 protected function _initDoctype() {
	 	$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('XHTML1_STRICT');
	 }


}

