Check all methods available in our row class and find out how it works in Magento
<?php
/**
 * 
 */
class Ccc_Practice_Adminhtml_NinthController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
    {
        $row = Mage::getSingleton('practice/resource_Practice');
        echo "<pre>";
        print_r(get_class_methods($row));
    }
}
