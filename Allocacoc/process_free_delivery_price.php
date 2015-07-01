<?php
foreach(glob($_SERVER['DOCUMENT_ROOT'].'/Allocacoc/Manager/*.php') as $file) {
     include_once $file;
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$fdpMgr = new FdpManager();
$new_free_delivery_price = $_GET["new_free_delivery_price"];

$fdpMgr->updateFreeDeliveryPrice($new_free_delivery_price);
header("Location: admin.php");

?>