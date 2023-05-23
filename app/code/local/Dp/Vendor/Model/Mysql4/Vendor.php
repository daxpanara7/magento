<?php

class Dp_Vendor_Model_Mysql4_Vendor extends Dp_Vendor_Model_Resource_Vendor
{
    protected function _construct()
    {
        $this->_init('vendor/vendor', 'vendor_id');
    }

    
}