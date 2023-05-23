<?php

class Ccc_Demo_Block_Adminhtml_Demo_Edit_Tab_Demo extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('demo_data');
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('demo_form',array('legend'=>Mage::helper('demo')->__('Eav Attribute information')));

        $fieldset->addField('first_name', 'text', array(
            'name'      => 'demo[first_name]',
            'label'     => Mage::helper('demo')->__('First Name'),
            'required'  => true,
        ));

        $fieldset->addField('last_name', 'text', array(
            'name'      => 'demo[last_name]',
            'label'     => Mage::helper('demo')->__('Last Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'demo[email]',
            'label'     => Mage::helper('demo')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('gender', 'select', array(
            'label'     => Mage::helper('demo')->__('Gender'),
            'title'     => Mage::helper('demo')->__('Gender'),
            'name'      => 'demo[gender]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('demo')->__('Male'),
                '2' => Mage::helper('demo')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'name'      => 'demo[mobile]',
            'label'     => Mage::helper('demo')->__('Mobile'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('demo')->__('Status'),
            'title'     => Mage::helper('demo')->__('Status'),
            'name'      => 'demo[status]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('demo')->__('Active'),
                '2' => Mage::helper('demo')->__('Inactive'),
            ),
        ));

        $fieldset->addField('company', 'text', array(
            'name'      => 'demo[company]',
            'label'     => Mage::helper('demo')->__('Company'),
            'required'  => true,
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
