<?php
/**
 * Magento
 *
 */
class Dp_Vendor_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        $this->setId('vendorAdminhtmlVendorGrid');
        $this->setDefaultSort('vendor_id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('vendor/vendor')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('first_name', array(
            'header'    => Mage::helper('vendor')->__('First Name'),
            'align'     => 'left',
            'index'     => 'first_name',
        ));

        $this->addColumn('last_name', array(
            'header'    => Mage::helper('vendor')->__('Last Name'),
            'align'     => 'left',
            'index'     => 'last_name'
        ));

        $this->addColumn('mobile', array(
            'header'    => Mage::helper('vendor')->__('mobile'),
            'align'     => 'left',
            'index'     => 'mobile'
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('vendor')->__('Email'),
            'align'     => 'left',
            'index'     => 'email'
        ));
       
        $this->addColumn('status', array(
            'header'    => Mage::helper('vendor')->__('Status'),
            'align'     => 'left',
            'renderer'     => 'Hk_Vendor_Block_Adminhtml_Vendor_Grid_Renderer_Status'
        ));


        return parent::_prepareColumns();
    }

    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('vendor_id' => $row->getId()));
    }
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('vendor_id');
        $this->getMassactionBlock()->setFormFieldName('vendor');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('vendor')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('vendor')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('statusactive', array(
             'label'    => Mage::helper('vendor')->__('Status Active'),
             'url'      => $this->getUrl('*/*/massStatusActiveUpdate'),
             'confirm'  => Mage::helper('vendor')->__('Are you sure?')
        ));
         $this->getMassactionBlock()->addItem('statusinactive', array(
             'label'    => Mage::helper('vendor')->__('Status InActive'),
             'url'      => $this->getUrl('*/*/massStatusInactiveUpdate'),
             'confirm'  => Mage::helper('vendor')->__('Are you sure?')
        ));
        return $this;
    }
   
}