<?php
class Dax_Brand_Block_Adminhtml_Brand_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$brandField = $form->addFieldset('brand_form',array('legend'=>Mage::helper('brand')->__('Brand information')));

		$brandField->addField('url_key', 'text', array(
            'label' => Mage::helper('brand')->__('URL Key'),
            'required' => true,
            'name' => 'url_key',
		));

		$brandField->addField('name', 'text', array(
            'label' => Mage::helper('brand')->__('Brand Name'),
            'required' => true,
            'name' => 'name',
		));


        $brandField->addField('image', 'file', array(
            'label' => Mage::helper('brand')->__('Image'),
            'required' => true,
            'name' => 'image',
		));

        $brandField->addField('banner', 'file', array(
            'label' => Mage::helper('brand')->__('Banner'),
            'required' => true,
            'name' => 'banner',
		));
		$brandField->addField('description', 'text', array(
            'label' => Mage::helper('brand')->__('Description'),
            'required' => true,
            'name' => 'description',
		));

		if ( Mage::getSingleton('adminhtml/session')->getbrandData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getbrandData());
			Mage::getSingleton('adminhtml/session')->setbrandData(null);
		} 
		elseif ( Mage::registry('brand_data') ) 
		{
			$form->setValues(Mage::registry('brand_data')->getData());
		}
		return parent::_prepareForm();
	}
}
