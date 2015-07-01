<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
	session_start();
}
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/AddressManager.php");
$form_data = array();
$errors = array();
$operation=$_GET['operation'];
$customer_id = $_SESSION["userid"];
if($operation === 'add'){
$success = true;
$firstname= addslashes(filter_input(INPUT_POST, 'firstname'));
$lastname= addslashes(filter_input(INPUT_POST, 'lastname'));
$street= addslashes(filter_input(INPUT_POST, 'street'));
$blockno= addslashes(filter_input(INPUT_POST, 'blockno'));
$floor= addslashes(filter_input(INPUT_POST, 'floor'));
$unit= addslashes(filter_input(INPUT_POST, 'unit'));
$postalcode= addslashes(filter_input(INPUT_POST, 'postalcode'));
$addressMgr = new AddressManager();
if(empty($firstname)){
	$success = false;
	$form_data['status'] = 'fail';
	$form_data['message'] = 'You need to specify receiver firstname';
}
if(empty($lastname)){
	$success = false;
	$form_data['status'] = 'fail';
	$form_data['message'] = 'You need to specify receiver lastname';
}
if(empty($street)){
	$success = false;
	$form_data['status'] = 'fail';
	$form_data['message'] = 'You need to specify street';
}
if(empty($blockno)){
	$success = false;
	$form_data['status'] = 'fail';
	$form_data['message'] = 'You need to specify block no';
}
if(empty($floor)){
	$success = false;
	$form_data['status'] = 'fail';
	$form_data['message'] = 'You need to specify floor';
}
if(empty($unit)){
	$success = false;
	$form_data['status'] = 'fail';
	$form_data['message'] = 'You need to specify unit';
}
if(empty($postalcode)){
	$success = false;
	$form_data['status'] = 'fail';
	$form_data['message'] = 'You need to specify postal code';
}

$address_no= (string)rand(0,10000);
if($success === true){
	$addressMgr -> addAddress($address_no,$customer_id,$firstname,$lastname,$street,$blockno,$floor,$unit,'','',$postalcode,'');
}

}elseif($operation === 'delete'){
$remove_list = array();
	foreach ($remove_list as $address_no){
		$addressMgr -> deleteAddress($address_no,$customer_id);
	}
}

echo json_encode($form_data );