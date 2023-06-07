<?php
/**
 * 
 */
class Dax_Brand_ViewController extends Mage_Core_Controller_Front_Action
{
	
	function indexAction()
	{
		 $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Test'));
        $block = $this->getLayout()->createBlock('Dax_Brand_Block_View','test');
        $this->renderLayout();
	}

}