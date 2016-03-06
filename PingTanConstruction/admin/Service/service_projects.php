<?php
include_once("../Manager/ConnectionManager.php");
include_once("../Manager/ProjectManager.php");

$projectMgr = new ProjectManager();

$response = array();
$error = array();
$error['error'] = false;

$type = addslashes(filter_input(INPUT_POST, 'type'));

if($type === "all"){
	$allProject = $projectMgr -> getAllProjects();
	if(empty($allProject)){
		$error['error'] = true;
		echo json_encode($error);
		return;
	}else{
		for($i = 0; $i < sizeof($allProject); $i++){
			$project = array();
			$eachProject = $allProject[$i];
			
			array_push($response, $eachProject);
		}
	}
}

echo json_encode($response);