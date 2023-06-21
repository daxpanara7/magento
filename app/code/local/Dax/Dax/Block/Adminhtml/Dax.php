<?php 
class Dax_Dax_Block_Adminhtml_Dax extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'dax';
		$this->_controller = 'adminhtml_dax';
		$this->_headerText = $this->__('Dax Grid');
		$this->_addButtonLabel = $this->__('Add Dax');
		parent::__construct();
	}
}