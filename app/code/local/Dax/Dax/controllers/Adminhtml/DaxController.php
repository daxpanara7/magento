<?php 

class Dax_Dax_Adminhtml_DaxController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction(){
		$this->loadLayout();
		$this->_setActiveMenu('dax');
		$this->_title('Dax Grid');
		$this->_addContent($this->getLayout()->createBlock('dax/adminhtml_dax'));
		$this->renderLayout();
	}

	protected function _initDax()
    {
        $this->_title($this->__('Dax'))
            ->_title($this->__('Manage Daxs'));

        $daxId = (int) $this->getRequest()->getParam('id');
        $dax   = Mage::getModel('dax/dax')
            ->setStoreId($this->getRequest()->getParam('store', 0))
            ->load($daxId);

        if (!$daxId) {
            if ($setId = (int) $this->getRequest()->getParam('set')) {
                $dax->setAttributeSetId($setId);
            }
        }

        Mage::register('current_dax', $dax);
        Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));
        return $dax;
    }

	public function newAction(){
		$this->_forward('edit');
	}

	public function editAction(){ 
		$daxId = (int) $this->getRequest()->getParam('id');
        $dax   = $this->_initDax();
        
        if ($daxId && !$dax->getId()) {
            $this->_getSession()->addError(Mage::helper('dax')->__('This dax no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }

        $this->_title($dax->getName());

        $this->loadLayout();

        $this->_setActiveMenu('dax/dax');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->renderLayout();
	}

	public function saveAction()
    {
        try {
            $setId = (int) $this->getRequest()->getParam('set');
            $daxData = $this->getRequest()->getPost('account');            
            $dax = Mage::getSingleton('dax/dax');
            $dax->setAttributeSetId($setId);

            if ($daxId = $this->getRequest()->getParam('id')) {
                if (!$dax->load($daxId)) {
                    throw new Exception("No Row Found");
                }
                Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
            }
            
            $dax->addData($daxData);

            $dax->save();

            Mage::getSingleton('core/session')->addSuccess("dax data added.");
            $this->_redirect('*/*/');

        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction()
    {
        try {

            $daxModel = Mage::getModel('dax/dax');

            if (!($daxId = (int) $this->getRequest()->getParam('id')))
                throw new Exception('Id not found');

            if (!$daxModel->load($daxId)) {
                throw new Exception('dax does not exist');
            }

            if (!$daxModel->delete()) {
                throw new Exception('Error in delete record', 1);
            }

            Mage::getSingleton('core/session')->addSuccess($this->__('The dax has been deleted.'));

        } catch (Exception $e) {
            Mage::logException($e);
            $Mage::getSingleton('core/session')->addError($e->getMessage());
        }
        
        $this->_redirect('*/*/');
    }
}