<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/StudentStatusManager.php");
include_once("./Manager/StudentManager.php");
include_once("./Manager/CourseManager.php");
include_once("./Manager/SessionManager.php");
$studentMgr = new StudentManager();
$courseMgr = new CourseManager();
$sessionMgr = new SessionManager();
$studentId = isset($_COOKIE['studentID']) ? $_COOKIE['studentID'] : 'null';
$response = array();
$error = array();
$sessions = array();
$prerequisiteList = array();
$error['error'] = false;
$languages = 'en';

$courseID = addslashes(filter_input(INPUT_POST, 'courseID'));

$course = $courseMgr -> getCourse($languages, $courseID);
$prerequisites = explode(',', $course['prerequisite']);
if($prerequisites[0] !== 'No'){
	for($i = 0; $i < sizeof($prerequisites); $i++){
		$eachPrerequisite = [];
		$eachPrerequisite['courseID'] = $prerequisites[$i];
		$eachPrerequisite['courseName'] = $courseMgr -> getCourseName($languages, $eachPrerequisite['courseID']);
		array_push($prerequisiteList, $eachPrerequisite);
	}
}

$sessions = $sessionMgr -> getFutureSessionListByCourse($languages, $courseID);
$response['student'] = $studentMgr -> getStudentByID($studentId);
$response['course'] = $course;
$response['sessions'] = $sessions;
$response['prerequisites'] = $prerequisiteList;

echo json_encode($response);