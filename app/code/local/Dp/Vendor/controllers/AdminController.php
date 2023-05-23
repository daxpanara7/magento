<?php
/**
 * 
 */
class Dp_Vendor_AdminController extends Mage_Core_Controller_Front_Action
{
	
	function indexAction()
	{
		$this->_title($this->__('Customers'))->_title($this->__('Manage Customers'));
		$this->loadLayout();
		$block = $this->getLayout()->createBlock('vendor/Vendor');
		$helper = Mage::helper('vendor/vendor');
		$helper = Mage::helper('vendor/data');
		$this->renderLayout();
		print_r(get_class_methods('Dp_Vendor_IndexController'));
		 
	}

}