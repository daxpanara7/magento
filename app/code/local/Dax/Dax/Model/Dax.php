<?php

class Dax_Dax_Model_Dax extends Mage_Core_Model_Abstract
{
    protected $_attributes;

    const ENTITY = 'dax';
    
	protected function _construct()
    {
        $this->_init('dax/dax');
    }


    
}