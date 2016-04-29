<?php
include_once("../Manager/ConnectionManager.php");
include_once("../Manager/JobManager.php");

$jobMgr = new JobManager();

$response = array();
$error = array();
$allCategory = array();
$allJob = array();
$error['error'] = false;

$allJob = $jobMgr -> getAllJobs();

if(empty($allJob)){
	$error['error'] = true;
	echo json_encode($error);
	return;
}else{
	$allCategory = $jobMgr->getCareerCategory();
	for($i = 0; $i < sizeof($allCategory); $i++){
		$category = $allCategory[$i];
		$jobList = $jobMgr->getJobByCategory($category);
		
		array_push($response, $jobList);
	}
}

echo json_encode($response);