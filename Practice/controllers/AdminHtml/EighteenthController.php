<?php

class Ccc_Practice_Adminhtml_EighteenthController extends Mage_Core_Controller_Front_Action
{
 
    public function indexAction()
       {
         $helper = Mage::helper('practice');
         print_r($helper);
       }

}
