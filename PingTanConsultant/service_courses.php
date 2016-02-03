<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/CourseManager.php");
include_once("./Manager/SessionManager.php");

$courseMgr = new CourseManager();
$sessionMgr = new SessionManager();
$response = array();
$error = array();
$error['error'] = false;
$languages = 'en';

$type = addslashes(filter_input(INPUT_POST, 'type'));

if($type === "all"){
	$allCourse = $courseMgr -> getCourseList($languages);
	if(empty($allCourse)){
		$error['error'] = true;
		echo json_encode($error);
		return;
	}else{
		for($i = 0; $i < sizeof($allCourse); $i++){
			$course = array();
			$course['session'] = true;
			$eachCourse = $allCourse[$i];
			$course['name'] = $eachCourse['name'];
			$course['courseID'] = $eachCourse['courseID'];
			$course['price'] = $eachCourse['price'];
			$course['description'] = $eachCourse['description'];
			$sessionList = $sessionMgr -> getSessionListByCourse($languages, $course['courseID']);
			$fullTimeQuery = "SELECT COUNT( * ) FROM  `session_en` WHERE  `courseID` ='".$course['courseID']."'AND  `fulltime` <>  ''";
			if(!empty($sessionList)){
				$session = $sessionList[0];
				$course['partTime'] = $sessionMgr -> checkParttime($languages, $course['courseID'], "");
				$course['fullTime'] = $sessionMgr -> checkFulltime($languages, $fullTimeQuery);
				$course['languages'] = $sessionMgr -> retrieveCourseLanguage($languages, $eachCourse['courseID']);
			}else{
			// return session false to indicate there's no session added under this particular course
				$course['session'] = false;
			}
			
			array_push($response, $course);
		}
	}
}

echo json_encode($response);