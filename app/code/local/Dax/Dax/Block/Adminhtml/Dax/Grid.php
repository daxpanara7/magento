<?php
class Dax_Dax_Block_Adminhtml_Dax_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('daxAdminhtmldaxGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('entity_id');
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('dax')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('dax')->__('Are you sure?')
        ));
         
        return $this;
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('dax/dax')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('dax')->__('Entity Id'),
            'align'     => 'left',
            'index'     => 'entity_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('dax')->__('Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));

       
        $this->addColumn('status', array(
            'header'    => Mage::helper('dax')->__('status'),
            'align'     => 'left',
            'index'     => 'status'
        ));

        $this->addColumn('description', array(
            'header'    => Mage::helper('dax')->__('Description'),
            'align'     => 'left',
            'index'     => 'description'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('entity_id' => $row->getId()));
    }
   
}