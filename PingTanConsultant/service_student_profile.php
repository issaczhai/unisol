<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/StudentManager.php");
include_once("./Manager/CourseManager.php");
include_once("./Manager/SessionManager.php");
include_once("./Manager/StudentStatusManager.php");

$studentMgr = new StudentManager();
$courseMgr = new CourseManager();
$sessionMgr = new SessionManager();
$statusMgr = new StudentStatusManager();

$response = array();
$error = array();
$taken = array();
$taking = array();
$upcoming = array();
$document = array();
$languages = 'en';
$email = addslashes(filter_input(INPUT_POST, 'email'));
$studentID = addslashes(filter_input(INPUT_POST, 'studentID'));
$sessionList = $statusMgr -> getStudentStatus($studentID);
for($i = 0; $i < sizeof($sessionList); $i++){
	$sessionRecord = [];
	$eachPair = $sessionList[$i];
	$courseID = $eachPair['courseID'];
	$sessionID = $eachPair['sessionID'];
	$session = $sessionMgr -> getSession($languages, $courseID, $sessionID);
	$course = $courseMgr -> getCourse($languages, $courseID);
	array_push($document, $course['documents']);
	$sessionRecord['name'] = $course['name'];
	$sessionRecord['courseID'] = $course['courseID'];
	$sessionRecord['price'] = $course['price'];
	$sessionRecord['description'] = $course['description'];
	$sessionRecord['type'] = $eachPair['type'] === 'fulltime' ? $session['fulltime'] : $session['parttime'];
	$sessionRecord['language'] = $eachPair['language'];

	switch($eachPair['status']){
		case 'upcoming':
				array_push($upcoming, $sessionRecord);
		break;

		case 'taking':
				
				array_push($taking, $sessionRecord);
		break;

		case 'taken':
				array_push($taken, $sessionRecord);
		break;

		default:
				array_push($error, 'no record');
	}
}

$response['error'] = $error;
$response['upcoming'] = $upcoming;
$response['taking'] = $taking;
$response['taken'] = $taken;
$response['document'] = $document;

echo json_encode($response);




