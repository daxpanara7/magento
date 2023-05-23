<?php
class Dax_Dax_Model_Resource_Dax extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('dax/dax', 'entity_id');
    }    
}