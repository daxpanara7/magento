<?php
/**
 * 
 */
class Dax_Brand_IndexController extends Mage_Core_Controller_Front_Action
{
	
	function indexAction()
	{
		$this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Brands'));
        $this->renderLayout();
	}

}