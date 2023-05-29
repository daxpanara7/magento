<?php
class Dax_Idx_Block_Adminhtml_Idx_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$idxField = $form->addFieldset('idx_form',array('legend'=>Mage::helper('idx')->__('Idx information')));


		$idxField->addField('name', 'text', array(
            'label' => Mage::helper('idx')->__('Idx Name'),
            'required' => true,
            'name' => 'name',
		));


        $idxField->addField('image', 'file', array(
            'label' => Mage::helper('idx')->__('Image'),
            'required' => true,
            'name' => 'image',
		));

		$idxField->addField('description', 'text', array(
            'label' => Mage::helper('idx')->__('Description'),
            'required' => true,
            'name' => 'description',
		));

		if ( Mage::getSingleton('adminhtml/session')->getidxData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getidxData());
			Mage::getSingleton('adminhtml/session')->setidxData(null);
		} 
		elseif ( Mage::registry('idx_data') ) 
		{
			$form->setValues(Mage::registry('idx_data')->getData());
		}
		return parent::_prepareForm();
	}
}
