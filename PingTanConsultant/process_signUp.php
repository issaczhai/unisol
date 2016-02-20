<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/StudentStatusManager.php");
include_once("./Manager/StudentManager.php");
include_once("./Manager/CompanyManager.php");

$studentMgr = new StudentManager();
$companyMgr = new CompanyManager();
$response = array();
$response['error'] = false;
$studentAdd = null;
$companyAdd = null;
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
	$company = $studentMgr -> getCompanyByEmail($email);
	// make sure the email address in unique in both student and company tables
	if(sizeof($student) !== 0 || sizeof($company) !== 0){
		$response['error'] = true;
		$response['errorMsg'] = "The email address you entered has been registered!";
	}else{
		$studentMgr -> addStudent($studentID,$username,$password,$email,
			"null","null","null","null",$fName,$lName,"null");
		$studentAdd = $studentMgr -> getStudentByEmail($email);
	}

	$response['student'] = $studentAdd;

}else if($registerType == "company"){
	$companyName = addslashes(filter_input(INPUT_POST, 'companyName'));
	$registrationID = addslashes(filter_input(INPUT_POST, 'registrationId'));
	$street = addslashes(filter_input(INPUT_POST, 'street'));
	$unitNo = addslashes(filter_input(INPUT_POST, 'unitNo'));
	$postal = addslashes(filter_input(INPUT_POST, 'postal'));
	$address = $street.', '.$unitNo.', '.$postal;
	$cFName = addslashes(filter_input(INPUT_POST, 'cFName'));
	$cLName = addslashes(filter_input(INPUT_POST, 'cLName'));
	$contactPersonName = $cFName.' '.$cLName;
	$cEmail = addslashes(filter_input(INPUT_POST, 'cEmail'));
	$cLTel = addslashes(filter_input(INPUT_POST, 'cLTel'));
	$cLFax = addslashes(filter_input(INPUT_POST, 'cLFax'));
	$cPassword = addslashes(filter_input(INPUT_POST, 'reCPassword'));
	$companyID = (string)rand(0,10000000000);

	$companyGet = $companyMgr -> getCompanyByRegID($registrationID);
	$student = $studentMgr -> getStudentByEmail($cEmail);
	$company = $studentMgr -> getCompanyByEmail($cEmail);
	// make sure the email address in unique in both student and company tables
	if(sizeof($student) !== 0 || sizeof($company) !== 0 || sizeof($companyGet) !== 0){
		$response['error'] = true;
		$response['errorMsg'] = "The company registration id has been registered with us.";
	}else{
		//TO-DO: Encrypt the password before store to DB
		$companyMgr -> addCompany($companyID, $companyName, $cPassword, $address, 
		$contactPersonName,$cEmail,$cLTel, $cLFax, $registrationID);
		$companyAdd = $companyMgr -> getCompany($companyID);
	}

	$response['company'] = $companyAdd;
}

echo json_encode($response);