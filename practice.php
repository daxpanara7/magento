<?php

define('MAGENTO_ROOT', getcwd());
$mageFilename = MAGENTO_ROOT . '/app/Mage.php';
require_once $mageFilename;
Mage::setIsDeveloperMode(true);
Mage::app('default');

echo "<pre>";
$a =  Mage::getModel('practice/practice')->getcollection()->test()->test2();    



print_r($a);
?>
