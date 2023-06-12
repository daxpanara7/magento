<?php
class Dp_Vendor_Model_Vendor extends Mage_Core_Model_Abstract
{
    function __construct()
    {
        $this->_init('vendor/vendor');
    }

    public function getStatuses()
    {
        return [
            '1' => 'Active',
            '0' => 'Non Active'
        ]; 
    }

    public function setPassword($password)
    {
        $this->setData('password', md5($password));
        return $this;
    }
}