<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ContactManager.php");

$contactMgr = new ContactManager();

$operation="";
$operation = filter_input(INPUT_POST,'operation');
if($operation==""){
    $operation = $_GET['operation'];
}
if ($operation === "update"){
    $address = filter_input(INPUT_POST,'address');
    $freephone = filter_input(INPUT_POST,'freephone');
    $telephone = filter_input(INPUT_POST,'telephone');
    $fax = filter_input(INPUT_POST,'fax');
    $email = filter_input(INPUT_POST,'email');
    $id="1";
    $contactMgr->updateContact($id, $address, $freephone, $telephone, $fax, $email);
    header("location: admin/contact.php");
} elseif ($operation === "getContact"){
    $contactId = "1";
    $contact = $contactMgr->getContact($contactId);
    echo json_encode($contact);
}