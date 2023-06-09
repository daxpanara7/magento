<?php
ini_set('memory_limit','512M');

class Ccc_Practice_Adminhtml_Csv2Controller extends Mage_Adminhtml_Controller_Action
{
    protected $_data = array();
    protected $_header = array();
    
    protected $_categoryData = array();
    protected $_categoryHeader = array();
    
    protected $_dataFinal = array();
    
    protected $_categoryFile = "C:\Users\daxpanara\Downloads\category-attribute.csv";
    protected $_file = "C:\Users\daxpanara\Downloads\attribute-option.csv";
    protected $_fileReport = 'C:\Users\daxpanara\Downloads\report.csv';
        
    protected function _loadFile()
    {
        $handler = fopen($this->_categoryFile, "r");
        if($handler)
        {
            $rowCnt = 0;
            while($row = fgetcsv($handler, 4096, ",", "\""))
            {
                if(!$this->_categoryHeader)
                {
                    $this->_categoryHeader = $row;
                }
                else
                {
                    $row = array_combine($this->_categoryHeader, $row);
                    $this->_categoryData[$row["category"]][] = $row["attribute_code"];
                }
            }    
            fclose($handler);
        }
        else
        {
            throw new Exception("Unable to open file");     
        }
        
        $handler = fopen($this->_file, "r");
        if($handler)
        {
            $rowCnt = 0;
            while($row = fgetcsv($handler, 4096, ",", "\""))
            {
                if(!$this->_header)
                {
                    $this->_header = $row;
                }
                else
                {
                    $row = array_combine($this->_header, $row);
                    $this->_data[$row["attribute_code"]][] = $row["option"];
                }
            }    
            fclose($handler);
        }
        else
        {
            throw new Exception("Unable to open file");     
        }
        
    }
    
    public function runAction()
    {   
        echo "<pre>"; 
        $this->_loadFile();
        $this->_formatData();
        $this->_generateReport();
        
        echo "DONE";
        
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
        
        foreach($this->_categoryData as $_category => $attribute)
        {
            foreach($attribute as $att)
            {
                $tmp = array(
                    "category" => $_category, 
                    "attribute" => $att
                );
                
                if(!isset($this->_data[$att]))
                {
                    continue;
                    //throw new ErrorException("Attribute missing in file : ".$att);
                }
                
                foreach($this->_data[$att] as $option)
                {
                    $tmp["option"] = $option;
                    $this->_dataFinal[] = $tmp;
                }
            }
        }
    }
    
    protected function _generateReport()
    {   
        if($this->_dataFinal)
        {
            $handler = fopen($this->_fileReport, "a"); 
            
            if($handler)
            {   
                $cnt = 0;
                foreach($this->_dataFinal as $key => $_data)
                {
                    if($cnt==0)
                    {
                        fputcsv($handler, array_keys($_data), ",", "\"");
                        $cnt++;
                    }
                    
                    fputcsv($handler, $_data, ",", "\"");
                }
                
                fclose($handler);
            }
            else
            {
                throw new Exception("Unable to open file to write");     
            }
        }
    }    
}

// $obj = new Ccc_Practice_Adminhtml_Csv2Controller();
// $obj->run();

?>