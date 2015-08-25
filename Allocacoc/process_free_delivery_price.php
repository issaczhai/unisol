<?php
include_once('./Manager/ConnectionManager.php');
include_once('./Manager/FdpManager.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$fdpMgr = new FdpManager();
$operation = $_GET["operation"];

if($operation == 'updateCutoff'){
$new_cutoff = $_GET["new_cutoff"];
$fdpMgr->updateCutoff($new_cutoff);
header("Location: admin.php#freeDeliveryPrice");
exit;
}elseif($operation == 'updateCharge'){
$new_charge = $_GET["new_charge"];
$fdpMgr->updateCharge($new_charge);
header("Location: admin.php#freeDeliveryPrice");
exit;
}

?>