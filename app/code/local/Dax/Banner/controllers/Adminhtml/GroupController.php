<?php
class Dax_Banner_Adminhtml_GroupController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Banner Groups'))
             ->_title($this->__('Manage Banner Groups'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('banner/adminhtml_group'));
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('group_id');
        $model = Mage::getModel('banner/group')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('group_data', $model);
            $this->loadLayout();
            $this->_setActiveMenu('banner/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            $this->_addContent($this->getLayout()->createBlock(' banner/adminhtml_group_edit'))
                ->_addLeft($this->getLayout()->createBlock('banner/adminhtml_group_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('banner')->__('Banner does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {
            echo "<pre>";
            print_r($_POST);
            print_r($_POST['media_gallery']['images']);
            print_r($_FILES);
            // die('uploadAction');


            $id = $this->getRequest()->getParam('group_id');
            $banner_group = Mage::getModel('banner/group');
            $bannerGroupData = $this->getRequest()->getPost('group');
            $banner_group->setData($bannerGroupData)
                ->setId($this->getRequest()->getParam('group_id'));
            if ($banner_group->group_id == NULL) {
                $banner_group->created_at = date("y-m-d H:i:s");
            }

            $banner_group->save();

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('banner')->__('Banner Group was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(true);

            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $banner_group->getId()));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
        }
    }

    public function uploadAction()
    {
        try {
            $uploader = new Mage_Core_Model_File_Uploader('image');
            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
            $uploader->addValidateCallback('catalog_product_image',
                Mage::helper('catalog/image'), 'validateUploadFile');
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $uploader->addValidateCallback(
                Mage_Core_Model_File_Validator_Image::NAME,
                Mage::getModel('core/file_validator_image'),
                'validate'
            );
            $result = $uploader->save(
                Mage::getSingleton('catalog/product_media_config')->getBaseTmpMediaPath()
            );

            Mage::dispatchEvent('catalog_product_gallery_upload_image_after', array(
                'result' => $result,
                'action' => $this
            ));

            /**
             * Workaround for prototype 1.7 methods "isJSON", "evalJSON" on Windows OS
             */
            $result['tmp_name'] = str_replace(DS, "/", $result['tmp_name']);
            $result['path'] = str_replace(DS, "/", $result['path']);

            $result['url'] = Mage::getSingleton('catalog/product_media_config')->getTmpMediaUrl($result['file']);
            $result['file'] = $result['file'] . '.tmp';
            $result['cookie'] = array(
                'name'     => session_name(),
                'value'    => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path'     => $this->_getSession()->getCookiePath(),
                'domain'   => $this->_getSession()->getCookieDomain()
            );

        } catch (Exception $e) {
            $result = array(
                'error' => $e->getMessage(),
                'errorcode' => $e->getCode());
        }

        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }

    public function massDeleteAction()
    {
        $bannerIds = $this->getRequest()->getParam('group_id');
        if(!is_array($bannerIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('banner')->__('Please select banner(s).'));
        } else {
            try {
                $model = Mage::getModel('banner/group');
                foreach ($bannerIds as $bannerId) {
                    $model->load($bannerId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('banner')->__(
                    'Total of %d record(s) were deleted.', count($bannerIds)
                )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

}