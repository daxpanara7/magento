<?php

class Dax_Idx_Model_Source_Model extends Mage_Eav_Model_Entity_Attribute_Source_Abstract implements Mage_Eav_Model_Entity_Attribute_Source_Interface
{
    public function getAllOptions()
    {
        $idx = Mage::getModel('idx/idx')->getCollection()->getItems();
        $arr = array();
        foreach ($idx as $k=>$v) {
            $arr[] = array('value'=>$k, 'label'=>$v->name);
        }
        return $arr;
    }
}
