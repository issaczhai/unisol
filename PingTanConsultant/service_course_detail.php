<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/CourseManager.php");
include_once("./Manager/SessionManager.php");

$courseMgr = new CourseManager();
$sessionMgr = new SessionManager();
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

$sessions = $sessionMgr -> getSessionListByCourse($languages, $courseID);

$response['course'] = $course;
$response['sessions'] = $sessions;
$response['prerequisites'] = $prerequisiteList;

echo json_encode($response);