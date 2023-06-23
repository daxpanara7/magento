// Task : 17. How to overweite core or local blocks into local folder? Prepare 3 examples.

<?php

class Ccc_Practice_Adminhtml_SeventeenthController extends Mage_Core_Controller_Front_Action
{

   public function indexAction()
   {
      echo "<pre>";
        $block = $this->getLayout()->createBlock('practice/adminhtml_NewPractice');
        print_r($block);

   }
}
