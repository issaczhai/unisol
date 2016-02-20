<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/CourseManager.php");
include_once("./Manager/SessionManager.php");
include_once("./Manager/StudentStatusManager.php");
include_once("./Manager/StudentManager.php");
include_once("./Manager/CompanyManager.php");
include_once("./Manager/GroupManager.php");
//require_once "./email.php";

$courseMgr = new CourseManager();
$sessionMgr = new SessionManager();
$studentMgr = new StudentManager();
$companyMgr = new CompanyManager();
$groupMgr = new GroupManager();
$studentStatusMgr = new StudentStatusManager();
$response = array();
$error = array();
$groupStudentList = "";
$languages = 'en';
$root = './public_html/document/';
$companyID = $_COOKIE['companyID'];
$prerequisiteArr = [];
$prerequisiteJson;

$courseID = addslashes(filter_input(INPUT_POST, 'courseID'));
$sessionID = addslashes(filter_input(INPUT_POST, 'sessionID'));
$courseType = addslashes(filter_input(INPUT_POST, 'courseType'));
$time = addslashes(filter_input(INPUT_POST, 'time'));
$nric = addslashes(filter_input(INPUT_POST, 'nric'));
$dateTime = addslashes(filter_input(INPUT_POST, 'dateTime'));
$language = addslashes(filter_input(INPUT_POST, 'language'));
$startDate = addslashes(filter_input(INPUT_POST, 'startDate'));
// Note: can not use add slashes to json string, it will add slashed to every key and value, 
// thus json string can not be decoded by PHP, use $_POST[] instead;
$jsonStringParticipantList = $_POST['jsonParticipantList'];
$participantArrayObjects = json_decode($jsonStringParticipantList);
// add each new student to student table and set userStatus as companyID 
// to indicate this student is registered by and under company

foreach($participantArrayObjects as $participantObject){
	//convert object variables into array
	$participant = get_object_vars($participantObject);
	$studentID = (string)rand(0,10000000000);
	$password = $companyMgr -> getPasswordByCompanyID($companyID);
	$checkStudent = $studentMgr -> getStudentByEmail($participant['email']);
	if(sizeof($checkStudent) === 0){
		$studentMgr -> addStudent($studentID,$participant['firstName'],$password,$participant['email'],
		$participant['nationality'],$participant['contact'],$participant['occupation'],$participant['dob'],
		$participant['firstName'],$participant['lastName'],$participant['nric'],$companyID);
	}
	// add group student list
	if($groupStudentList === ""){
		$groupStudentList = $studentID;
	}else{
		$groupStudentList .= ",".$studentID;
	}
}
// create group under company, session and course
$groupMgr -> addNewGroup($companyID, $courseID, $sessionID, $groupStudentList);

$course = $courseMgr -> getCourse($languages, $courseID);
$courseName_ = str_replace(' ', '_', $course['name']);
$prerequisiteList = explode(',', $course['prerequisite']);
if(!file_exists($root.$companyID)){
	mkdir($root.$companyID);
}
if(!file_exists($root.$companyID."/prerequisite/")){
	mkdir($root.$companyID."/prerequisite/");
}
if(!file_exists($root.$companyID."/prerequisite/".$courseName_."/")){
	mkdir($root.$companyID."/prerequisite/".$courseName_."/");
}
$targetDir = $root.$companyID."/prerequisite/".$courseName_."/".$sessionID."/";
// upload all prerequisites document to target folder
// loop through $_FILES[] and add into folder

if($prerequisiteList[0] !== 'No'){
	foreach($_FILES as $file) {
		$fileName = $file['name'];
	  	if(!file_exists($targetDir)){
			mkdir($targetDir);
		}
		if(file_exists($targetDir.$fileName)){
			unlink($targetDir.$fileName);
		}
		
		if($file['size'] < 2000000){
			move_uploaded_file($file['tmp_name'], $targetDir.$fileName);
		}else{
			array_push($error, $fileName.': The size of each file is excced limit 2M');
		}
	}
}

$response['error'] = $error;

echo json_encode($response);