<?php
class Dax_Product_Model_Observer extends Varien_Event_Observer
{
   public function __construct()
   {
 
   }
   
   public function saveProductObserve($observer)
   {
        $event = $observer->getEvent();     
        $model = $event->getPage();
   }
}