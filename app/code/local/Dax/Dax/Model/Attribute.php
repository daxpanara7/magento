<?php

class Dax_Dax_Model_Attribute extends Mage_Eav_Model_Attribute
{
    const MODULE_NAME = 'Dax_Dax';
    protected $_eventObject = 'attribute';

    protected function _construct()
    {
        $this->_init('dax/attribute');
    }
}