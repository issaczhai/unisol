<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/StudentStatusManager.php");
include_once("./Manager/StudentManager.php");
include_once("./Manager/CompanyManager.php");
include_once("./Manager/GroupManager.php");
include_once("./Manager/CourseManager.php");
include_once("./Manager/SessionManager.php");
$studentMgr = new StudentManager();
$companyMgr = new CompanyManager();
$groupMgr = new GroupManager();
$studentStatusMgr = new StudentStatusManager();
$courseMgr = new CourseManager();
$sessionMgr = new SessionManager();
$response = array();
$error = array();
$sessions = array();
$default = array();
$companyDistStudentList = array();
$prerequisiteList = array();
$error['error'] = false;
$companyID = isset($_COOKIE['companyID']) ? $_COOKIE['companyID'] : 'null';
// Need to set selected details as default value for company registration form
$selectCourseID = addslashes(filter_input(INPUT_POST, 'courseID'));
$selectSessionID = addslashes(filter_input(INPUT_POST, 'sessionID'));
$selectCourseType = addslashes(filter_input(INPUT_POST, 'courseType'));
$selectDateTime = addslashes(filter_input(INPUT_POST, 'dateTime'));
$selectStartDate = addslashes(filter_input(INPUT_POST, 'startDate'));
$selectLanguage = addslashes(filter_input(INPUT_POST, 'language'));
$selectDuration = addslashes(filter_input(INPUT_POST, 'duration'));
$language = 'en';

$default['courseID'] = $selectCourseID ? $selectCourseID : 'null';
$default['sessionID'] = $selectSessionID ? $selectSessionID : 'null';
$default['courseType'] = $selectCourseType ? $selectCourseType : 'null';
$default['dateTime'] = $selectDateTime ? $selectDateTime : 'null';
$default['startDate'] = $selectStartDate ? $selectStartDate : 'null';
$default['language'] = $selectLanguage ? $selectLanguage : 'null';
$default['duration'] = $selectDuration ? $selectDuration : 'null';

$course = $courseMgr -> getCourse($language, $selectCourseID);
$prerequisites = explode(',', $course['prerequisite']);
if($prerequisites[0] !== 'No'){
	for($i = 0; $i < sizeof($prerequisites); $i++){
		$eachPrerequisite = [];
		$eachPrerequisite['courseID'] = $prerequisites[$i];
		$eachPrerequisite['courseName'] = $courseMgr -> getCourseName($language, 
			$eachPrerequisite['courseID']);
		array_push($prerequisiteList, $eachPrerequisite);
	}
}
if($companyID !== "null") $companyDistStudentList = $groupMgr -> getGroupListByCompanyID($companyID);
$sessions = $sessionMgr -> getFutureSessionListByCourse($language, $selectCourseID);

$response['course'] = $course;
$response['sessions'] = $sessions;
$response['prerequisites'] = $prerequisiteList;
$response['default'] = $default;
$response['companyStudents'] = $companyDistStudentList;

echo json_encode($response);