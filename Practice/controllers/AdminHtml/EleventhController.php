// Task : 10. Understand and practice parent classes methods related to layout and blocks.

<?php

class Ccc_Practice_Adminhtml_EleventhController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        echo "<pre>";
        print_r(get_class_methods($this));
    }
}
