<?php
/**
 * 
 */
class Dax_Banner_Model_Source extends Mage_Core_Model_Abstract
{
	public function toOptionArray()
	{
		$groupCollection = Mage::getModel('banner/group')->getCollection();
		foreach ($groupCollection as $group) 
		{
			$options[] = ['value' => $group->getId(), 'label' => $group->getName()];
		}
		return $options;
	}
}