<?php
class Dax_Dax_Block_Adminhtml_Dax_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('form_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('dax')->__('Data Information'));
	}

	protected function _beforeToHtml()
	{
		$this->addTab('form_section', array(
		'label' => Mage::helper('dax')->__('Data Information'),
		'title' => Mage::helper('dax')->__('Data Information'),
		'content' => $this->getLayout()->createBlock('dax/adminhtml_dax_edit_tab_form')->toHtml(),
		));
		return parent::_beforeToHtml();
	}
}