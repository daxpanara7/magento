<?php
class Dax_Dax_Model_Resource_Dax_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('dax/dax');
    }

}