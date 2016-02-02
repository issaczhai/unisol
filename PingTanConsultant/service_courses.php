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
			if(!empty($sessionList)){
				//use anyone of session in the session list
				//assume each session under the same course 
				//has same parttime and fulltime schedule
				//and languages
				$session = $sessionList[0];
				$course['partTime'] = $session['parttime'] ? $session['parttime'] : 'Not Available';
				$course['fullTime'] = $session['fulltime'] ? $session['fulltime'] : 'Not Available';
				$course['languages'] = $session['languages'];
			}else{
			// return session false to indicate there's no session added under this particular course
				$course['session'] = false;
			}
			
			array_push($response, $course);
		}
	}
}

echo json_encode($response);