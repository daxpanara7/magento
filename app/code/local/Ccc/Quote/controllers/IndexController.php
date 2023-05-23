<?php 

class Ccc_Demo_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo '<pre>';
        print_r(get_class_methods($this->getLayout())); 
        print_r(Mage::helper('demo/demo')); 
        print_r(Mage::helper('demo')); 
    }
  
}