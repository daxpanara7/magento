<?php
class Dax_Dax_Block_Adminhtml_Dax_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$daxField = $form->addFieldset('dax_form',array('legend'=>Mage::helper('dax')->__('Data information')));


		$daxField->addField('name', 'text', array(
            'label' => Mage::helper('dax')->__('Name'),
            'required' => true,
            'name' => 'name',
		));

		$daxField->addField('status', 'select', array(
            'label' => Mage::helper('dax')->__('Status'),
            'required' => true,
            'name' => 'status',
            'type' => 'select',
            'options' => array(
            	'1' => Mage::helper('dax')->__('Active'),
            	'2' => Mage::helper('dax')->__('Inactive')
            )
		));

		$daxField->addField('description', 'text', array(
            'label' => Mage::helper('dax')->__('Description'),
            'required' => true,
            'name' => 'description',
		));

		if ( Mage::getSingleton('adminhtml/session')->getdaxData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getdaxData());
			Mage::getSingleton('adminhtml/session')->setdaxData(null);
		} 
		elseif ( Mage::registry('dax_data') ) 
		{
			$form->setValues(Mage::registry('dax_data')->getData());
		}
		return parent::_prepareForm();
	}
}
