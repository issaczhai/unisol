<?php
include_once("../Manager/ConnectionManager.php");
include_once("../Manager/JobManager.php");

$jobMgr = new JobManager();

$response = array();
$error = array();
$error['error'] = false;
$jobId = $_POST['jobId'];
$job = $jobMgr -> getJobById($jobId);

if(empty($job)){
	$error['error'] = true;
	echo json_encode($error);
	return;
}else{
	array_push($response, $job);
}

echo json_encode($response);