<?php

class Ccc_Demo_Block_Adminhtml_Demo_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('demo')->__('Demo Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('demo_section', array(
        'label' => Mage::helper('demo')->__('Eav Attribute Information'),
        'title' => Mage::helper('demo')->__('Eav Attribute Information'),
        'content' => $this->getLayout()->createBlock('demo/adminhtml_demo_edit_tab_demo')->toHtml(),
        ));

        $this->addTab('address_section', array(
        'label' => Mage::helper('demo')->__('Eav Attribute Address Information'),
        'title' => Mage::helper('demo')->__('Eav Attribute Address Information'),
        'content' => $this->getLayout()->createBlock('demo/adminhtml_demo_edit_tab_address')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
}
