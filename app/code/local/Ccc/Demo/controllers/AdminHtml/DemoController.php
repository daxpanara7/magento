<?php

class Ccc_Demo_Adminhtml_DemoController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('demo/manage');
    }

    public function preDispatch()
    {
        $this->_setForcedFormKeyActions(array('delete', 'massDelete'));
        return parent::preDispatch();
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->_title($this->__("EAV Attribute Grid"));
        $this->_addContent($this->getLayout()->createBlock('demo/adminhtml_demo'));
        $this->renderLayout();
    }


    public function newAction() {
        $this->_forward('edit');
    }   

    public function editAction(){
        $id = $this->getRequest()->getParam('attribute_id');
        $model = Mage::getModel('demo/demo')->load($id);
        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('current_demo', $model);
                 
            $this->loadLayout();
            $this->_setActiveMenu('demo/items');
             
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('demo Manager'), Mage::helper('adminhtml')->__('demo Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('demo News'), Mage::helper('adminhtml')->__('demo News'));
             
            $this->_addContent($this->getLayout()->createBlock(' demo/adminhtml_demo_edit'))
            ->_addLeft($this->getLayout()->createBlock('demo/adminhtml_demo_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('demo')->__('demo does not exist'));
            $this->_redirect('*/*/');
        }

    }


    // public function editAction() {
    //     $id = $this->getRequest()->getParam('id');
    //     if (!$id) {
    //         $model1 = Mage::getModel('demo/demo');
    //     }else{
    //         $model1 = Mage::getModel('demo/demo')->load($id);
    //     }
    //     echo "<pre>";
    //     print_r($model1);
    //     // if (!$model1 = Mage::getModel('demo/demo')->load($id)){
    //     //     $model1 = Mage::getModel('demo/demo');
    //     // }

    //     // if (!$model2 = Mage::getModel('demo/demo_address')->load($id)){
    //     //     $model2 = Mage::getModel('demo/demo_address');
    //     // }

    //     echo "<pre>";
    //     print_r($model1->getData());
    //     die;

    //     if ($model1->getId() || $id == 0) {
    //         $data = Mage::getSingleton('admnhtml/session')->getFormData(true);
    //         if (!empty($data)) {
    //             $model1->setData($data);
    //         }

    //     if ($model2->getId() || $id == 0) {
    //         $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
    //     }
    //     if (!empty($data)) {
    //         $model2->setData($data);
    //     }
    //     Mage::register('demo_data', $model1);
    //     Mage::register('demo_address_data', $model2);
    //     $this->loadLayout();
    //     $this->_setActiveMenu('demo/items');
    //     $this->_addContent($this->getLayout()->createBlock(' demo/adminhtml_demo_edit'))
    //         ->_addLeft($this->getLayout()->createBlock('demo/adminhtml_demo_edit_tabs'));
    //     $this->renderLayout();
    //     } else {
    //         Mage::getSingleton('adminhtml/session')->addError(Mage::helper('demo')->__('demo does not exist'));
    //         $this->_redirect('*/*/');
    //     }
    // }

    public function saveAction()
    {
        if ($this->getRequest()->getParam('back')) {
            $this->_redirect('*/*/edit', array('id' => $model->getId()));
            return;
        }

        if ($data = $this->getRequest()->getPost()) {
            $demo = $data['demo'];
            $address = $data['address'];
            $model = Mage::getModel('demo/demo');
            $addressModel = Mage::getModel('demo/demo_address');
            $model->setData($demo)->setId($this->getRequest()->getParam('id'));
            $addressModel->setData($address);
            try {
                if ($model->demo_id != null) {
                    $model->updated_at = date('Y-m-d H:i:s');
                    $model->save();
                    $addressModel->demo_id = $model->demo_id;
                } else {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->save();
                    $addressModel->demo_id = $model->demo_id;
                    $addressModel->getResource()->setPrimaryKey('address_id');
                }
                $addressModel->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('demo')->__('demo was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                 
                if ($this->getRequest()->getParam('back')) {
                  $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($demo);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('demo')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }


    public function deleteAction()
    {   
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('demo/demo');
                 
                $model->setId($this->getRequest()->getParam('id'))
                ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('demo was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function exportCsvAction()
    {
        $fileName   = 'demos.csv';
        $content    = $this->getLayout()->createBlock('demo/adminhtml_demo_grid')
            ->getCsvFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'demos.xml';
        $content    = $this->getLayout()->createBlock('demo/adminhtml_demo_grid')
            ->getExcelFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }


    public function massDeleteAction()
    {
        $demoIDs = $this->getRequest()->getParam('demo_id');
        if(!is_array($demoIDs)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select demo(s).'));
        } else {
            try {
                $demo = Mage::getModel('demo/demo');
                foreach ($demoIDs as $demoId) {
                    $demo->reset()
                        ->load($demoId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($demoIDs))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

}