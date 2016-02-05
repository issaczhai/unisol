<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/CourseManager.php");
include_once("./Manager/SessionManager.php");
include_once("./Manager/StudentManager.php");

$courseMgr = new CourseManager();
$sessionMgr = new SessionManager();
$studentMgr = new StudentManager();
$response = [];
$error = [];
$languages = 'en';
$root = './public_html/document/prerequisite/';
$studentID = $_COOKIE['studentID'];

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
if($prerequisiteList[0] !== 'No'){
	for($i = 0; $i < sizeof($prerequisiteList); $i++){
		$courseName = $courseMgr -> getCourseName($languages, $prerequisiteList[$i]);
		$prerequisiteName = 'file'.$courseName;
		$prerequisiteName_ = str_replace(' ', '_', $prerequisiteName);
		$fileName = $_FILES[$prerequisiteName_]['name'];
		if(!file_exists($root.$studentID)){
			mkdir($root.$studentID);
		}
		if(!file_exists($root.$studentID."/".$fileName)){

			$targetFile = $root.$studentID."/";
			if($_FILES[$prerequisiteName_]['size'] < 2000000){
				move_uploaded_file($_FILES[$prerequisiteName_]['tmp_name'], $targetFile.$fileName);
			}
			
		}
	}
}


array_push($response, $courseID);

echo json_encode($response);


