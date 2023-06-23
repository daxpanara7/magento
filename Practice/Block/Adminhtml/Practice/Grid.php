<?php
<<<<<> main
class Ccc_Practice_Block_Adminhtml_Practice_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('practiceAdminhtmlPracticeGrid');
        $this->setDefaultSort('practice_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('practice_id');
        $this->getMassactionBlock()->setFormFieldName('practice_id');
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('practice')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('practice')->__('Are you sure?')
        ));
         
        return $this;
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('practice/practice')->getCollection();
        $this->setCollection($collection);

         
        $this->setDefaultSort('product_id');
        $this->setId('adminhtmlPracticeGrid');
        $this->setUseAjax(true);
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);

    }

    protected function _getCollectionClass()
    {
        return 'practice/practice_collection';
    }
     
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
         
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('practice_id', array(
            'header'    => Mage::helper('practice')->__('practice Id'),
            'align'     => 'left',
            'index'     => 'practice_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('practice')->__('Practice Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('practice')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku'
        ));

        $this->addColumn('cost', array(
            'header'    => Mage::helper('practice')->__('Cost'),
            'align'     => 'left',
            'index'     => 'cost'
        ));

        $this->addColumn('price', array(
            'header'    => Mage::helper('practice')->__('Price'),
            'align'     => 'left',
            'index'     => 'price'
        ));

        $this->addColumn('quantity', array(
            'header'    => Mage::helper('practice')->__('Quantity'),
            'align'     => 'left',
            'index'     => 'quantity'
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('practice')->__('status'),
            'align'     => 'left',
            'index'     => 'status'
        ));

        $this->addColumn('description', array(
            'header'    => Mage::helper('practice')->__('Description'),
            'align'     => 'left',
            'index'     => 'description'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('practice_id' => $row->getId()));
    }
   

        $this->addColumn('product_id',
            array(
                'header'=> $this->__('product Id'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'product_id'
            )
        );
         
        $this->addColumn('name',
            array(
                'header'=> $this->__('Name'),
                'index' => 'name'
            )
        );    

        $this->addColumn('sku',
            array(
                'header'=> $this->__('Sku'),
                'index' => 'sku'
            )
        );       

        $this->addColumn('cost',
            array(
                'header'=> $this->__('Cost'),
                'index' => 'cost'
            )
        );         

        $this->addColumn('price',
            array(
                'header'=> $this->__('Price'),
                'index' => 'price'
            )
        );

        $this->addColumn('quantity',
            array(
                'header'=> $this->__('Quantity'),
                'index' => 'quantity'
            )
        );

        $this->addColumn('description',
            array(
                'header'=> $this->__('Description'),
                'index' => 'description'
            )
        );

        $this->addColumn('status',
            array(
                'header'=> $this->__('Status'),
                'index' => 'status'
            )
        );

        $this->addColumn('color',
            array(
                'header'=> $this->__('Color'),
                'index' => 'color'
            )
        );

        $this->addColumn('material',
            array(
                'header'=> $this->__('Material'),
                'index' => 'material'
            )
        );

        $this->addColumn('created_at',
            array(
                'header'=> $this->__('Created At'),
                'index' => 'created_at'
            )
        );

        $this->addColumn('updated_at',
            array(
                'header'=> $this->__('Updated At'),
                'index' => 'updated_at'
            )
        );

        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('practice')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('practice')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('practice')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('practice')->__('Excel XML'));
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('product_od');
        $this->getMassactionBlock()->setFormFieldName('product_od');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('practice')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('practice')->__('Are you sure?')
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