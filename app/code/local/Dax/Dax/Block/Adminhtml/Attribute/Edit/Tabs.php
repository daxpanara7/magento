<?php

class Dax_Dax_Block_Adminhtml_Attribute_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('dax_attribute_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('dax')->__('Attribute Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main', array(
            'label'     => Mage::helper('dax')->__('Properties'),
            'title'     => Mage::helper('dax')->__('Properties'),
            'content'   => $this->getLayout()->createBlock('dax/adminhtml_attribute_edit_tab_main')->toHtml(),
            'active'    => true
        ));

        $model = Mage::registry('entity_attribute');

        return parent::_beforeToHtml();
    }

}
