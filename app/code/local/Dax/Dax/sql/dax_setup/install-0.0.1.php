<?php 

$this->startSetup();

$this->addEntityType(Dax_Dax_Model_Resource_Dax::ENTITY,[
	'entity_model'=>'dax/dax',
	'attribute_model'=>'dax/attribute',
	'table'=>'dax/dax',
	'increment_per_store'=> '0',
	'additional_attribute_table' => 'dax/eav_attribute',
	'entity_attribute_collection' => 'dax/dax_attribute_collection'
]);

$this->createEntityTables('dax');
$this->installEntities();

$default_attribute_set_id = Mage::getModel('eav/entity_setup', 'core_setup')
    						->getAttributeSetId('dax', 'Default');

$this->run("UPDATE `eav_entity_type` SET `default_attribute_set_id` = {$default_attribute_set_id} WHERE `entity_type_code` = 'dax'");

$this->endSetup();