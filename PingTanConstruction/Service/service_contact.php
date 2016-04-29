<?php
include_once("../Manager/ConnectionManager.php");
include_once("../Manager/ContactManager.php");

$contactMgr = new ContactManager();

$response = array();
$error = array();
$error['error'] = false;

$contact = $contactMgr -> getContact(1);

if(empty($contact)){
	$error['error'] = true;
	echo json_encode($error);
	return;
}else{
	array_push($response, $contact);
}

echo json_encode($response);