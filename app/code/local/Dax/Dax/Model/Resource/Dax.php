<?php 
class Dax_Dax_Model_Resource_Dax extends Mage_Eav_Model_Entity_Abstract
{
	const ENTITY = 'dax';
	public function __construct()
	{
		$this->setType(self::ENTITY)
			 ->setConnection('core_read', 'core_write');
	   parent::__construct();
    }
}