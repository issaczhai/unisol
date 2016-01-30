<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/CompanyManager.php");
header("Content-type: text/html;charset=utf-8");
$companyMgr = new CompanyManager();

$operation="";
$operation = filter_input(INPUT_POST,'operation');
if ($operation === "reset"){
    $companyID = filter_input(INPUT_POST,'companyID');
    $password = "12345";
    $companyMgr->resetPassword($companyID, md5($password));
}elseif($operation === "getContact"){
    $companyID = filter_input(INPUT_POST,'companyID');
    $contact = $companyMgr->getCompanyContact($companyID);
    echo json_encode($contact);
}elseif($operation === "editContact"){
    $companyID = filter_input(INPUT_POST,'companyID');
    $cName = filter_input(INPUT_POST,'cName');
    $cTel = filter_input(INPUT_POST,'cTel');
    $cEmail = filter_input(INPUT_POST,'cEmail');
    $cFax = filter_input(INPUT_POST,'cFax');
    $companyMgr->updateCompanyContact($companyID, $cName, $cEmail, $cTel, $cFax); 
    header("Location: ./admin/company.php");
    
}elseif($operation === "getAddress"){
    $result= array();
    $companyID = filter_input(INPUT_POST,'companyID');
    $address = $companyMgr->getCompanyAddress($companyID);
    $result['address'] = $address;
    echo json_encode($result);
}elseif($operation === "editAddress"){
    $companyID = filter_input(INPUT_POST,'companyID');
    $cAddress = filter_input(INPUT_POST,'cAddress');
    $companyMgr->updateCompanyAddress($companyID, $cAddress);
    header("Location: ./admin/company.php");
        
}