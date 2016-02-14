<?php

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/StudentStatusManager.php");
include_once("./Manager/SessionManager.php");
include_once("./Manager/StudentManager.php");
include_once("./Manager/CourseManager.php");
require_once "./email.php";
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
        $studentid = filter_input(INPUT_POST, 'studentid');
        $courseid = filter_input(INPUT_POST, 'courseid');
        $sessionid = filter_input(INPUT_POST, 'sessionid');
        
        /*//Delete aplication record from studentstatus table
        $statusMgr->removeRecord($studentid, $courseid, $sessionid);
        //SEND NOTIFICATION EMAIL
        // Send email to inform student for rejection
	$subject = 'Reject Class Registration <'.$courseid.' '.$sessionid.'>';
	$sender = 'jackyfeng1218@gmail.com';
	$receiver = $studentMgr->getEmail($studentid);
	$replyTo = 'jackyfeng1218@gmail.com';
	$linkAction = 'localhost/PingTanConsultant/admin/index.php';
	$email = new Email($subject, $sender, $receiver, $replyTo, $linkAction);
	// TO-DO: need Async to send email
	$email -> initEmailBody($subject);
	// set flag true means sending email using SMTP
        $sendstatus = $email -> send(true);*/
        
        header("Location: ./admin/application.php");
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
}elseif($operation === 'batchEnroll'){
    $applicationsStr = filter_input(INPUT_POST, 'applications');
    $applications = json_decode($applicationsStr);
    foreach($applications as $application){
        $studentid = $application[0];
        $courseid = $application[1];
        $sessionid = $application[2];
        $statusMgr->updateStudentStatus($studentid, $courseid, $sessionid, "upcoming");
        $sessionMgr->updateVacancy($lang, $courseid, $sessionid, -1);
        $sessionMgr->addToClassList($lang, $courseid, $sessionid, $studentid);
    }
}

echo json_encode($response);