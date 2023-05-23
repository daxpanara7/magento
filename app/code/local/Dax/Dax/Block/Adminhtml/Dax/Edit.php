<?php
class Dax_Dax_Block_Adminhtml_Dax_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{

		$this->_objectId = 'entity_id';
		$this->_blockGroup = 'dax';
		$this->_controller = 'adminhtml_dax';



		$this->_updateButton('save', 'label', Mage::helper('dax')->__('Save'));
		$this->_updateButton('delete', 'label', Mage::helper('dax')->__('Delete'));

		$this->_addButton('saveandcontinue', array(
		'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
		'onclick' => 'saveAndContinueEdit()',
		'class' => 'save',
		), -100);

		parent::__construct();
	}
	public function getHeaderText()
	{
		return Mage::helper('dax')->__('dax');
	}
}