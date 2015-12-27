<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/StudentManager.php");

$studentMgr = new StudentManager();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$operation="";
$operation = filter_input(INPUT_POST,'operation');
if ($operation === "add"){
    
}else if($operation === "resetPassword"){
    $studentID =filter_input(INPUT_POST,'studentID');
    $password = "12345";
    $studentMgr->resetPassword($studentID, $password);
}