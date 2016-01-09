<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/StudentStatusManager.php");
include_once("./Manager/StudentManager.php");

$studentMgr = new StudentManager();
$response = array();
$response['error'] = false;

//retrieve the post data

$registerType = addslashes(filter_input(INPUT_POST, 'registerType'));


if($registerType == "individual"){
	$fName = addslashes(filter_input(INPUT_POST, 'fName'));
	$lName = addslashes(filter_input(INPUT_POST, 'lName'));
	$username = $fName;
	$email = addslashes(filter_input(INPUT_POST, 'email'));
	$password = addslashes(filter_input(INPUT_POST, 'rePasswordEncrypt'));
	$studentID = (string)rand(0,10000000000);
	$student = $studentMgr -> getStudentByEmail($email);
	if(!empty($student)){
		$response['error'] = true;
		$response['errorMsg'] = "The email address you entered has been registered!";
	}else{
		$studentMgr -> addStudent($studentID,$username,$password,$email,"null","null","null","null",$fName,$lName,"null");
	}
	$response['empty'] = $student;

}else if($registerType == "company"){
	$companyName = addslashes(filter_input(INPUT_POST, 'companyName'));
	$registrationId = addslashes(filter_input(INPUT_POST, 'registrationId'));
	$street = addslashes(filter_input(INPUT_POST, 'street'));
	$unitNo = addslashes(filter_input(INPUT_POST, 'unitNo'));
	$postal = addslashes(filter_input(INPUT_POST, 'postal'));
	$cFName = addslashes(filter_input(INPUT_POST, 'cFName'));
	$cLName = addslashes(filter_input(INPUT_POST, 'cLName'));
	$cEmail = addslashes(filter_input(INPUT_POST, 'cEmail'));
	$cLTel = addslashes(filter_input(INPUT_POST, 'cLTel'));
	$cLFax = addslashes(filter_input(INPUT_POST, 'cLFax'));
}

echo json_encode($response);