<?php
class Dax_Idx_Block_Adminhtml_Idx_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('idxAdminhtmlIdxGrid');
        $this->setDefaultSort('index');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('idx_id');
        $this->getMassactionBlock()->setFormFieldName('idx_id');
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('idx')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('idx')->__('Are you sure?')
        ));
         
        return $this;
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('idx/idx')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        // $this->addColumn('index', array(
        //     'header'    => Mage::helper('idx')->__('Index'),
        //     'align'     => 'left',
        //     'index'     => 'index',
        // ));

        $this->addColumn('product_id', array(
            'header'    => Mage::helper('idx')->__('Product'),
            'align'     => 'left',
            'index'     => 'product_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('idx')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('idx')->__('Sku'),
            'align'     => 'left',
            'index'     => 'sku',
        ));
        $this->addColumn('price', array(
            'header'    => Mage::helper('idx')->__('Price'),
            'align'     => 'left',
            'index'     => 'price',
        ));
        $this->addColumn('cost', array(
            'header'    => Mage::helper('idx')->__('Cost'),
            'align'     => 'left',
            'index'     => 'cost',
        ));
        $this->addColumn('quantity', array(
            'header'    => Mage::helper('idx')->__('Quantity'),
            'align'     => 'left',
            'index'     => 'quantity',
        ));
        $this->addColumn('brand', array(
            'header'    => Mage::helper('idx')->__('Brand'),
            'align'     => 'left',
            'index'     => 'brand',
        ));
        $this->addColumn('brand_id', array(
            'header'    => Mage::helper('idx')->__('Brand_id'),
            'align'     => 'left',
            'index'     => 'brand_id',
        ));
        $this->addColumn('collection', array(
            'header'    => Mage::helper('idx')->__('Collection'),
            'align'     => 'left',
            'index'     => 'collection',
        ));
        $this->addColumn('collection_id', array(
            'header'    => Mage::helper('idx')->__('Collection_id'),
            'align'     => 'left',
            'index'     => 'collection_id',
        ));
        $this->addColumn('description', array(
            'header'    => Mage::helper('idx')->__('Description'),
            'align'     => 'left',
            'index'     => 'description',
        ));
        $this->addColumn('status', array(
            'header'    => Mage::helper('idx')->__('Status'),
            'align'     => 'left',
            'index'     => 'status',
        ));

        // $this->addColumn('created_at', array(
        //     'header'    => Mage::helper('idx')->__('Created_at'),
        //     'align'     => 'left',
        //     'index'     => 'created_at',
        // ));
        // $this->addColumn('updated_at', array(
        //     'header'    => Mage::helper('idx')->__('Updated_at'),
        //     'align'     => 'left',
        //     'index'     => 'updated_at',
        // ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('idx_id' => $row->getId()));
    }
   
}