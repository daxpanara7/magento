<?php

class Dax_Dax_Adminhtml_AttributeController extends Mage_Adminhtml_Controller_Action
{
   
    protected function _initAction()
    {
        $this->_title($this->__('Dax'))
             ->_title($this->__('Attributes'))
             ->_title($this->__('Manage Attributes'));

        if($this->getRequest()->getParam('popup')) {
            $this->loadLayout('popup');
        } else {
            $this->loadLayout()
                ->_setActiveMenu('dax/attributes')
                ->_addBreadcrumb(Mage::helper('dax')->__('dax'), Mage::helper('dax')->__('dax'))
                ->_addBreadcrumb(
                    Mage::helper('dax')->__('Manage Attributes'),
                    Mage::helper('dax')->__('Manage Attributes'))
            ;
        }
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('dax/adminhtml_attribute'))
            ->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('attribute_id');
        $model = Mage::getModel('catalog/resource_eav_attribute')
            ->setEntityTypeId($this->_entityTypeId);
        if ($id) {
            $model->load($id);

            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('dax')->__('This attribute no longer exists'));
                $this->_redirect('*/*/');
                return;
            }

            // entity type check
            if ($model->getEntityTypeId() != $this->_entityTypeId) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('dax')->__('This attribute cannot be edited.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        // set entered data if was error when we do save
        $data = Mage::getSingleton('adminhtml/session')->getAttributeData(true);
        if (! empty($data)) {
            $model->addData($data);
        }

        Mage::register('entity_attribute', $model);
       

        $this->_initAction();

        $this->_title($id ? $model->getName() : $this->__('New Attribute'));

        $item = $id ? Mage::helper('dax')->__('Edit Product Attribute')
                    : Mage::helper('dax')->__('New Product Attribute');

        $this->_addBreadcrumb($item, $item);

        $this->_addContent($this->getLayout()->createBlock('dax/adminhtml_attribute_edit'))
            ->_addLeft($this->getLayout()->createBlock('dax/adminhtml_attribute_edit_tabs'));

        // $this->getLayout()->getBlock('attribute_edit_js')
        //     ->setIsPopup((bool)$this->getRequest()->getParam('popup'));

        $this->renderLayout();

    }

    public function preDispatch()
    {
        $this->_setForcedFormKeyActions('delete');
        parent::preDispatch();
        $this->_entityTypeId = Mage::getModel('eav/entity')->setType(Dax_Dax_Model_Dax::ENTITY)->getTypeId();
    }
}
