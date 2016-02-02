<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/StudentStatusManager.php");
include_once("./Manager/StudentManager.php");
include_once("./Manager/CompanyManager.php");

$studentMgr = new StudentManager();
$companyMgr = new CompanyManager();
$response = array();
$response['error'] = false;

//retrieve the post data

$emailInput = addslashes(filter_input(INPUT_POST, 'email'));
$passwordInput = addslashes(filter_input(INPUT_POST, 'password'));
$student = $studentMgr -> getStudentByEmail($emailInput);
$company = $companyMgr -> getCompanyByEmail($emailInput);

if(!empty($student)){
	$password = $student['password'];
	if($password != $passwordInput){
		$response['error'] = true;
		$response['errorMsg'] = 'The password is wrong!';
	}else{
		$response['username'] = $student["username"];
		$response['userType'] = 'student';
		$response['studentID'] = $student["studentID"];
	}
}else if(!empty($compnay)){
	$password = $companyMgr -> getPasswordByEmail($emailInput);
	if($password != $passwordInput){
		$response['error'] = true;
		$response['errorMsg'] = 'The password is wrong!';
	}else{
		$response['username'] = $company["username"];
		$response['userType'] = 'company';
	}
}else{
	$response['error'] = true;
	$response['errorMsg'] = 'The email address is not existed!';
}

echo json_encode($response);