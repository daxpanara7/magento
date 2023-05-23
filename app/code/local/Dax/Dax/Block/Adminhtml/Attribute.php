<?php
class Dax_Dax_Block_Adminhtml_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_attribute';
        $this->_blockGroup = 'dax';
        $this->_headerText = Mage::helper('dax')->__('Manage Attributes');
        $this->_addButtonLabel = Mage::helper('dax')->__('Add New Attribute');
        parent::__construct();
    }

}
