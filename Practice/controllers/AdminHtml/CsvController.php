<?php
/**
 * 
 */
class Ccc_Practice_Adminhtml_CsvController extends Mage_Adminhtml_Controller_Action
{

    protected $_data = array();
    protected $_header = array();
    
    protected $_categoryData = array();
    protected $_categoryHeader = array();
    
    protected $_dataFinal = array();
    
    protected $_categoryFile = 'C:\xampp\htdocs\2023\magento\magento-mirror\csv\CATEGORY.csv';
    protected $_optionFile = 'C:\xampp\htdocs\2023\magento\magento-mirror\csv\ATTRIBUTE-OPTIONS.csv';
    protected $_fileReport = 'C:\xampp\htdocs\2023\magento\magento-mirror\csv\category-attribute-option.csv';

    public function indexAction()
    {   
        $csv = new Varien_File_Csv();

        $this->_prepareData();
        $this->_formatData();
        $csv->saveData($this->_fileReport, $this->_dataFinal);

        echo "completed";
        // die;
    }
        
    protected function _prepareData()
    {
        $csv = new Varien_File_Csv();

        $optionData = $csv->getData($this->_optionFile);
        $categoryData = $csv->getData($this->_categoryFile);
        // echo "<pre>"; 

        // print_r($categoryData);
        // die();

        if(!$optionData)
        {
            throw new Exception("option Data is not available in file");
        }
        
        if(!$categoryData)
        {
            throw new Exception("Category data is not available in file");
        }

        foreach ($categoryData as $row)
        {
            if(!$this->_categoryHeader)
            {
                $this->_categoryHeader = $row;
            }
            else
            {
                $row = array_combine($this->_categoryHeader, $row);
                $this->_categoryData[] = $row;
            }
        }    

        foreach ($optionData as $row) 
        {
            if(!$this->_header)
            {
                $this->_header = $row;
            }
            else
            {
                $row = array_combine($this->_header, $row);
                $option = $row['OPTION'];
                $this->_data[$option] = $row;

            }
        }  
    }
    
    protected function _formatData()
    {
        if(!$this->_data)
        {
            throw new Exception("Data is not available");
        }
        
        if(!$this->_categoryData)
        {
            throw new Exception("Category data is not available");
        }
        $this->_dataFinal[] = array('index','category','attribute' ,'option');
        $categoryData = array_unique(array_column($this->_categoryData,'CATEGORY'));
        $index = 1;
        foreach($categoryData as $_category)
        {
            foreach($this->_data as $opt =>$data)
            {
                $output = array(
                    'index' => $index,
                    'category' => $_category,
                    'attribute' => $data['ATTRIBUTE'],
                    'option' => $data['OPTION'],
                );
                $this->_dataFinal[] = $output; 
                $index ++;
            }
        }
    }
    
    public function getData()
    {
        return $this->_data;
    }

    public function getCategoryData()
    {
        return $this->_categoryData;
    }

    public function getDataFinal()
    {
        return $this->_dataFinal;
    }
}