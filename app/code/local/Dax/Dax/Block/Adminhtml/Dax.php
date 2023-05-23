<?php
class Dax_Dax_Block_Adminhtml_Dax extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'dax';
        $this->_controller = 'adminhtml_dax';
        $this->_headerText = Mage::helper('dax')->__('Manage Data');

        parent::__construct();

        if ($this->_isAllowedAction('save')) {
            $this->_updateButton('add', 'label', Mage::helper('dax')->__('Add New Data'));
        } else {
            $this->_removeButton('add');
        }

    }
    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('dax/adminhtml_dax/' . $action);
    }

}