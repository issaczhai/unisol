<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/CourseManager.php");
include_once("./Manager/SessionManager.php");
include_once("./Manager/StudentStatusManager.php");
include_once("./Manager/StudentManager.php");
//require_once "./email.php";

$courseMgr = new CourseManager();
$sessionMgr = new SessionManager();
$studentMgr = new StudentManager();
$studentStatusMgr = new StudentStatusManager();
$response = array();
$error = array();
$languages = 'en';
$root = './public_html/document/prerequisite/';
$studentID = $_COOKIE['studentID'];
$prerequisiteArr = [];
$prerequisiteJson;

$courseID = addslashes(filter_input(INPUT_POST, 'courseID'));
$sessionID = addslashes(filter_input(INPUT_POST, 'sessionID'));
$courseType = addslashes(filter_input(INPUT_POST, 'courseType'));
$time = addslashes(filter_input(INPUT_POST, 'time'));
$nric = addslashes(filter_input(INPUT_POST, 'nric'));
$nationality = addslashes(filter_input(INPUT_POST, 'nationality'));
$contactNum = addslashes(filter_input(INPUT_POST, 'contactNum'));
$occupation = addslashes(filter_input(INPUT_POST, 'occupation'));
$dob = addslashes(filter_input(INPUT_POST, 'dob'));

$course = $courseMgr -> getCourse($languages, $courseID);
$prerequisiteList = explode(',', $course['prerequisite']);
// upload all prerequisites document to target folder
if($prerequisiteList[0] !== 'No'){
	for($i = 0; $i < sizeof($prerequisiteList); $i++){
		$courseName = $courseMgr -> getCourseName($languages, $prerequisiteList[$i]);
		$prerequisiteName = 'file'.$courseName;
		$prerequisiteName_ = str_replace(' ', '_', $prerequisiteName);
		$fileName = $_FILES[$prerequisiteName_]['name'];
		$targetDir = $root.$studentID."/";

		if(!file_exists($root.$studentID)){
			mkdir($root.$studentID);
		}
		if(file_exists($targetDir.$fileName)){
			unlink($targetDir.$fileName);
		}
		
		if($_FILES[$prerequisiteName_]['size'] < 2000000){
			move_uploaded_file($_FILES[$prerequisiteName_]['tmp_name'], $targetDir.$fileName);
			array_push($prerequisiteArr, $targetDir.$fileName);
		}else{
			array_push($error, 'The size of each file is limited to 2M');
		}
	}
}

if(sizeof($error) === 0){
	// Update Student Status DB
	$prerequisiteJson = json_encode($prerequisiteArr);
	$studentStatusMgr -> addStudentStatus($studentID, $courseID, $sessionID, $prerequisiteJson, "pending");

	// Send email to inform admin for new registration
	/*$subject = 'New Course Registration';
	$sender = 'jackyfeng1218@gmail.com';
	$receiver = 'xin.feng.2012@sis.smu.edu.sg';
	$replyTo = 'jackyfeng1218@gmail.com';
	$linkAction = 'localhost/PingTanConsultant/admin/index.php';
	$email = new Email($subject, $sender, $receiver, $replyTo, $linkAction);
	// TO-DO: need Async to send email
	$email -> initEmailBody($subject);
	// set flag true means sending email using SMTP
	if (!($email -> send(true))) array_push($error, 'registration email is failed');*/
}

$response['error'] = $error;

echo json_encode($response);


