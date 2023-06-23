<?php
class Dax_Dax_Model_Resource_Dax_Collection extends Mage_Catalog_Model_Resource_Collection_Abstract
{
	public function __construct()
	{
		$this->setEntity('dax');
		parent::__construct();	
	}
}