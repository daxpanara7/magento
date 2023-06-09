<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @eavmgmt    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml customer grid block
 *
 * @eavmgmt   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Dax_Eavmgmt_Block_Adminhtml_eavmgmt_Grid extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{


    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->setId('eavmgmtAdminhtmleavmgmtGrid');
    //     $this->setDefaultSort('eavmgmt_id');
    //     $this->setDefaultDir('ASC');
    // }

   protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('eavmgmt/eavmgmt_collection');
        /* @var $collection Mage_Cms_Model_Mysql4_Page_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();

    }

    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $baseUrl = $this->getUrl();

         $this->addColumnAfter('is_visible', array(
            'header'=>Mage::helper('eavmgmt')->__('Visible'),
            'sortable'=>true,
            'index'=>'is_visible_on_front',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('eavmgmt')->__('Yes'),
                '0' => Mage::helper('eavmgmt')->__('No'),
            ),
            'align' => 'center',
        ), 'frontend_label');

        $this->addColumnAfter('is_global', array(
            'header'=>Mage::helper('eavmgmt')->__('Scope'),
            'sortable'=>true,
            'index'=>'is_global',
            'type' => 'options',
            'options' => array(
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE =>Mage::helper('eavmgmt')->__('Store View'),
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE =>Mage::helper('eavmgmt')->__('Website'),
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL =>Mage::helper('eavmgmt')->__('Global'),
            ),
            'align' => 'center',
        ), 'is_visible');

        $this->addColumn('is_searchable', array(
            'header'=>Mage::helper('eavmgmt')->__('Searchable'),
            'sortable'=>true,
            'index'=>'is_searchable',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('eavmgmt')->__('Yes'),
                '0' => Mage::helper('eavmgmt')->__('No'),
            ),
            'align' => 'center',
        ), 'is_user_defined');

        $this->addColumnAfter('is_filterable', array(
            'header'=>Mage::helper('eavmgmt')->__('Use in Layered Navigation'),
            'sortable'=>true,
            'index'=>'is_filterable',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('eavmgmt')->__('Filterable (with results)'),
                '2' => Mage::helper('eavmgmt')->__('Filterable (no results)'),
                '0' => Mage::helper('eavmgmt')->__('No'),
            ),
            'align' => 'center',
        ), 'is_searchable');

        $this->addColumnAfter('is_comparable', array(
            'header'=>Mage::helper('eavmgmt')->__('Comparable'),
            'sortable'=>true,
            'index'=>'is_comparable',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('eavmgmt')->__('Yes'),
                '0' => Mage::helper('eavmgmt')->__('No'),
            ),
            'align' => 'center',
        ), 'is_filterable');

        $this->addColumnAfter('is_comparable', array(
            'header'=>Mage::helper('eavmgmt')->__('Comparable'),
            'sortable'=>true,
            'index'=>'is_comparable',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('eavmgmt')->__('Yes'),
                '0' => Mage::helper('eavmgmt')->__('No'),
            ),
            'align' => 'center',
        ), 'is_filterable');

         $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('eavmgmt')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('eavmgmt')->__('show options'),
                        'url'       => array('base'=> '*/*/showoption'),
                        'field'     => 'eavmgmt_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));



        $this->addExportType('*/*/exportCsv', Mage::helper('eavmgmt')->__('CSV'));

        return $this;

    }

    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('eavmgmt_id' => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('attribute_id');
        $this->getMassactionBlock()->setFormFieldName('attribute_id');

        $this->getMassactionBlock()->addItem('import_attribute', array(
             'label'    => Mage::helper('eavmgmt')->__('Export'),
             'url'      => $this->getUrl('*/*/selectedExport'),
             'confirm'  => Mage::helper('eavmgmt')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('import_attribute_options', array(
             'label'    => Mage::helper('eavmgmt')->__('Export Options'),
             'url'      => $this->getUrl('*/*/selectedExportOptions'),
             'confirm'  => Mage::helper('eavmgmt')->__('Are you sure?')
        ));
        return $this;
    }  
   
}