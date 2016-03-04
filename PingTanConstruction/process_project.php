<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProjectManager.php");
require 'function.php';
$projectMgr = new ProjectManager();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$operation="";
$operation = filter_input(INPUT_POST,'operation');
if($operation==""){
    $operation = $_GET['operation'];
}
if ($operation === "addProject"){
    $projectId = (string)rand(0,1000000);
    $projectName = filter_input(INPUT_POST,'projectName');
    $startDate = filter_input(INPUT_POST,'startDate');
    $endDate = filter_input(INPUT_POST,'endDate');
    $value = filter_input(INPUT_POST,'value');
    $scopeOfWork = filter_input(INPUT_POST,'scopeOfWork');
    $contract = filter_input(INPUT_POST,'contract');
    $client = filter_input(INPUT_POST,'client');
    $status = filter_input(INPUT_POST,'status');
    $indexArray=[];
    $location = "images/project/".$projectId;//include a '/' at the end of location path
    if (!file_exists($location)){
        mkdir($location,0777, true);
    }
    $inputName = "photo";
    $location.="/";
    $checkPhoto = true;
    $checkSize = true;
    $return = uploadMultipleFiles($inputName, $location, $checkPhoto, $checkSize, $indexArray);//($inputName,$location,$checkPhoto,$checkSize,$indexArray)
    $pathList = json_encode($return['pathList']);
    $projectMgr->addProject($projectId, $projectName, $startDate, $endDate, $value, $scopeOfWork, $contract, $client, $pathList, $status);
    
    header("Location: admin/projects.php");
    
}elseif ($operation === "populateProjectInfo"){
    $projectId = filter_input(INPUT_POST,'projectId');
    $project = $projectMgr->getProject($projectId);
    
    echo json_encode($project);
}elseif ($operation === "populateProjectPhoto"){
    $projectId = filter_input(INPUT_POST,'projectId');
    $project = $projectMgr->getProject($projectId);
    echo json_encode($project);
}elseif ($operation === "editProjectInfo"){
    $projectId = filter_input(INPUT_POST,'projectId');
    $projectName = filter_input(INPUT_POST,'projectName');
    $startDate = filter_input(INPUT_POST,'startDate');
    $endDate = filter_input(INPUT_POST,'endDate');
    $value = filter_input(INPUT_POST,'value');
    $scopeOfWork = filter_input(INPUT_POST,'scopeOfWork');
    $contract = filter_input(INPUT_POST,'contract');
    $client = filter_input(INPUT_POST,'client');
    $status = filter_input(INPUT_POST,'status');
    $projectMgr->updateProjectInfo($projectId, $projectName, $startDate, $endDate, $value, $scopeOfWork, $contract, $client,$status);
    
    header("Location: admin/projects.php");
    
}elseif ($operation === "editProjectPhoto"){
    $projectId = filter_input(INPUT_POST,'projectId');
    $project = $projectMgr->getProject($projectId);
    $photoList = json_decode($project['photo'],true);
    $toBeDelId = [];
    if(isset($_POST['delId'])){
        $toBeDelId = $_POST['delId'];
    }
    //remove deleted photos
    foreach($toBeDelId as $id){
        unlink($photoList[$id]);
        unset($photoList[$id]);
    }
    
    //add newly uploaded photo
    $inputName = "photo";
    $location = "images/project/".$projectId."/";
    $checkPhoto = true;
    $checkSize = true;
    $indexArray = [];
    $return = uploadMultipleFiles($inputName, $location, $checkPhoto, $checkSize, $indexArray);//($inputName,$location,$checkPhoto,$checkSize,$indexArray)
    $returnList = $return['pathList'];//return path array of uploaded photo
    //merge two photo array
    $merge = $photoList;
    if(!empty($returnList)){
        $merge = array_merge($photoList, $returnList);
    }
    $photo = json_encode($merge);
    $projectMgr->updateProjectPhoto($projectId, $photo);
    header("Location: admin/projects.php");
    
    
}elseif ($operation === "delete"){
    $projectId = filter_input(INPUT_POST,'projectId');
    $project = $projectMgr->getProject($projectId);
    $photoList = json_decode($project['photo']);
    //delete from database
    $projectMgr->deleteProject($projectId);
    //delete photo
    foreach($photoList as $key => $value){
        unlink($value);
    }
    $response=[];
    echo json_encode($response);
}elseif ($operation === "getProjectList"){
    $list = $projectMgr->getAllProjects();
    echo json_encode($list);
}