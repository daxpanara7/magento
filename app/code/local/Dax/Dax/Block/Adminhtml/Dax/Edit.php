<?php
class Dax_Dax_Block_Adminhtml_Dax_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{	
	public function __construct()
	{		
		$this->_blockGroup = 'dax';
        $this->_controller = 'adminhtml_dax';
        $this->_headerText = 'Add Dax';
        parent::__construct();
        if(!$this->getRequest()->getParam('set') && !$this->getRequest()->getParam('id'))
		{
			$this->_removeButton('save');
		} 
	}
}