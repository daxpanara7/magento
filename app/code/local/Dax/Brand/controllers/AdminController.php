<?php
/**
 * 
 */
class Dax_Brand_AdminController extends Mage_Core_Controller_Front_Action
{
	
	function indexAction()
	{
		$this->_title($this->__('Customers'))->_title($this->__('Manage Customers'));
		$this->loadLayout();
		$block = $this->getLayout()->createBlock('brand/Brand');
		$helper = Mage::helper('brand/brand');
		$helper = Mage::helper('brand/data');

		// $this->getLayout();
		$this->renderLayout();
		print_r(get_class_methods('Dax_Brand_IndexController'));
		 
	}

}