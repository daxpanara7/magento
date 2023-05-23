<?php

/**
 * 
 */
class Dax_Dax_Adminhtml_DaxController extends Mage_Adminhtml_Controller_Action
{
	
	function indexAction()
	{
        
	  	$this->_title($this->__('Dax'))
             ->_title($this->__('Manage'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('dax/adminhtml_dax'));
        $this->renderLayout();
	}

    public function newAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('Dax/items');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
        $this->_addContent($this->getLayout()->createBlock(' dax/adminhtml_dax_edit'))->_addLeft($this->getLayout()->createBlock('dax/adminhtml_dax_edit_tabs'));
        $this->renderLayout();
    }

    public function editAction() 
    {
        $collection = Mage::getModel('dax/dax')->getCollection()->toArray();
        print_r($collection);


        die;
        $id = $this->getRequest()->getParam('entity_id');
        $model = Mage::getModel('dax/dax')->load($id);

        if ($model->getId() || $id == 0) {
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
        $model->setData($data);
        }

        Mage::register('dax_data', $model);

        $this->loadLayout();
        $this->_setActiveMenu('dax/items');

        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

        $this->_addContent($this->getLayout()->createBlock('dax/adminhtml_dax_edit'))
        ->_addLeft($this->getLayout()
        ->createBlock('dax/adminhtml_dax_edit_tabs'));
        $this->renderLayout();
        } else {
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('dax')->__('Item does not exist'));
        $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('dax/dax');
            $data = $this->getRequest()->getPost();
            
            if (!$this->getRequest()->getParam('entity_id'))
            {
                $model->setData($data)->setId($this->getRequest()->getParam('entity_id'));
            }

            $model->setData($data)->setId($this->getRequest()->getParam('entity_id'));

            if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL)
            {
                $model->setCreatedTime(now())->setUpdateTime(now());
            } 
            else {
                $model->setUpdateTime(now());
            }
             
            $model->save();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('product')->__('Data was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
             
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('entity_id' => $model->getId()));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('entity_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('dax')->__('Unable to find Data to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('entity_id') > 0 ) {
            try {
                $model = Mage::getModel('dax/dax');
                 
                $model->setId($this->getRequest()->getParam('entity_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Data was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('entity_id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $productId = $this->getRequest()->getParam('entity_id');
        if(!is_array($productId)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('dax')->__('Please select tax(es).'));
        } else {
            try {
                $model = Mage::getModel('dax/dax');
                foreach ($productId as $id) {
                    $model->load($id)->delete();
                }
                
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('dax')->__('Total of %d record(s) were deleted.', count($productId))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
         
        $this->_redirect('*/*/index');
    }



}