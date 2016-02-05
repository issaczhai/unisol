<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/StudentStatusManager.php");
include_once("./Manager/SessionManager.php");
include_once("./Manager/StudentManager.php");
include_once("./Manager/CourseManager.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$statusMgr = new StudentStatusManager();
$sessionMgr = new SessionManager();
$studentMgr = new StudentManager();
$courseMgr = new CourseManager();
$response = array();
$operation = addslashes(filter_input(INPUT_POST, 'operation'));
$lang = 'en';
if($operation === 'retrievePendingList'){
    $statusList = $statusMgr->getList('pending');
    foreach($statusList as $status){
        $session = $sessionMgr->getSession($lang, $status['courseID'], $status['sessionID']);
        $student = $studentMgr->getStudentByID($status['studentID']);
        $course = $courseMgr->getCourse($lang, $status['courseID']);
        $status['session'] = $session;
        $status['student'] = $student;
        $status['course'] = $course;
        array_push($response, $status);
    }
}elseif ($operation === 'admin_operation'){
    if (isset($_POST['approve'])) {
        //approve student's application
        $studentid = filter_input(INPUT_POST, 'studentid');
        $courseid = filter_input(INPUT_POST, 'courseid');
        $sessionid = filter_input(INPUT_POST, 'sessionid');
        $statusMgr->updateStudentStatus($studentid, $courseid, $sessionid, "upcoming");
        $sessionMgr->updateVacancy($lang, $courseid, $sessionid, -1);
        $sessionMgr->addToClassList($lang, $courseid, $sessionid, $studentid);
        //SEND EMAIL
        
        header("Location: ./admin/application.php");
    } else if (isset($_POST['reject'])) {
        //reject student's application
        
        
        //SEND NOTIFICATION EMAIL
        
    }
}elseif ($operation === 'retrieveIndividualApplication'){
    $studentid = filter_input(INPUT_POST, 'studentid');
    $courseid = filter_input(INPUT_POST, 'courseid');
    $sessionid = filter_input(INPUT_POST, 'sessionid');
    $course = $courseMgr->getCourse($lang, $courseid);
    $student = $studentMgr->getStudentByID($studentid);
    $session = $sessionMgr->getSession($lang, $courseid, $sessionid);
    $certs = $statusMgr->getSubmittedDocument($studentid, $courseid, $sessionid);
    $response['course'] = $course;
    $response['session'] = $session;
    $response['student'] = $student;
    $response['certificate'] = $certs;
}

echo json_encode($response);