<?php
 
class Ccc_Demo_Block_Adminhtml_Demo_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
         
        $this->setDefaultSort('attribute_id');
        $this->setId('adminhtmlDemoGrid');
        $this->setUseAjax(true);
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);

    }

    protected function _prepareCollection()
    {
        // $collection = Mage::getModel('demo/demo')->getCollection();
        // $this->setCollection($collection);
        $collection = Mage::getResourceModel('catalog/product_attribute_collection')->addvisibleFilter();
        $this->setCollection($collection);         
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('attribute_id',
            array(
                'header'=> $this->__('Attribute Id'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'vendor_id'
            )
        );
         
        $this->addColumn('first_name',
            array(
                'header'=> $this->__('First Name'),
                'index' => 'first_name'
            )
        );    

        $this->addColumn('last_name',
            array(
                'header'=> $this->__('Last Name'),
                'index' => 'last_name'
            )
        );       

        $this->addColumn('email',
            array(
                'header'=> $this->__('Email'),
                'index' => 'email'
            )
        );         

        $this->addColumn('gender',
            array(
                'header'=> $this->__('Gender'),
                'index' => 'gender'
            )
        );

        $this->addColumn('mobile',
            array(
                'header'=> $this->__('Mobile'),
                'index' => 'mobile'
            )
        );

        $this->addColumn('status',
            array(
                'header'=> $this->__('Status'),
                'index' => 'status'
            )
        );

        $this->addColumn('company',
            array(
                'header'=> $this->__('Company'),
                'index' => 'company'
            )
        );

        $this->addColumn('created_at',
            array(
                'header'=> $this->__('Created Date'),
                'index' => 'created_at'
            )
        );

        $this->addColumn('updated_at',
            array(
                'header'=> $this->__('Updated Date'),
                'index' => 'updated_at'
            )
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('attribute_id');
        $this->getMassactionBlock()->setFormFieldName('attribute_id');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('demo')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('demo')->__('Are you sure?')
        ));

        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=> true));
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}