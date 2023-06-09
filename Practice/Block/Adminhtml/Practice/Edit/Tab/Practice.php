<?php

class Ccc_Practice_Block_Adminhtml_Practice_Edit_Tab_Practice extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('practice_data');
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('practice_form',array('legend'=>Mage::helper('practice')->__('practice information')));

        $fieldset->addField('name', 'text', array(
            'name'      => 'product[name]',
            'label'     => Mage::helper('practice')->__('Name'),
            'required'  => true,
        ));

        $fieldset->addField('sku', 'text', array(
            'name'      => 'product[sku]',
            'label'     => Mage::helper('practice')->__('Sku'),
            'required'  => true,
        ));

        $fieldset->addField('cost', 'text', array(
            'name'      => 'product[cost]',
            'label'     => Mage::helper('practice')->__('Cost'),
            'required'  => true,
        ));

        $fieldset->addField('price', 'text', array(
            'name'      => 'product[price]',
            'label'     => Mage::helper('practice')->__('Price'),
            'required'  => true,
        ));

        $fieldset->addField('quantity', 'text', array(
            'name'      => 'product[quantity]',
            'label'     => Mage::helper('practice')->__('Quantity'),
            'required'  => true,
        ));

        $fieldset->addField('description', 'text', array(
            'name'      => 'product[description]',
            'label'     => Mage::helper('practice')->__('Description'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('practice')->__('Status'),
            'title'     => Mage::helper('practice')->__('Status'),
            'name'      => 'product[status]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('practice')->__('Active'),
                '2' => Mage::helper('practice')->__('Inactive'),
            ),
        ));

        $fieldset->addField('color', 'select', array(
            'label'     => Mage::helper('practice')->__('Color'),
            'title'     => Mage::helper('practice')->__('Color'),
            'name'      => 'product[color]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('practice')->__('Color1'),
                '2' => Mage::helper('practice')->__('Color2'),
            ),
        ));

        $fieldset->addField('material', 'select', array(
            'label'     => Mage::helper('practice')->__('Material'),
            'title'     => Mage::helper('practice')->__('Material'),
            'name'      => 'product[material]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('practice')->__('Material1'),
                '2' => Mage::helper('practice')->__('Material2'),
            ),
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
