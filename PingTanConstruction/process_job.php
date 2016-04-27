<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/JobManager.php");
require 'function.php';
$jobMgr = new JobManager();
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
if ($operation === "postjob"){
    $jobid = (string)rand(100000, 999999);
    $jobname = filter_input(INPUT_POST,'jobname');
    $location = filter_input(INPUT_POST,'location');
    $description = filter_input(INPUT_POST,'job_description');
    $type = filter_input(INPUT_POST,'type');
    $category = filter_input(INPUT_POST,'category');
    $contact = filter_input(INPUT_POST,'contact');
    $postdate = date("Y-m-d");
    $qualification = json_encode($_POST['qualification']);
    $offer = json_encode($_POST['offer']);
    $jobMgr->addJob($jobid, $jobname, $location,$description, $type, $category, $qualification, $offer, $contact, $postdate);
    header("location: admin/job.php");
    
}elseif ($operation === "edit"){
    $jobid = filter_input(INPUT_POST,'jobid');
    $jobname = filter_input(INPUT_POST,'jobname');
    $location = filter_input(INPUT_POST,'location');
    $description = filter_input(INPUT_POST,'job_description');
    $type = filter_input(INPUT_POST,'type');
    $category = filter_input(INPUT_POST,'category');
    $contact = filter_input(INPUT_POST,'contact');
    $postdate = filter_input(INPUT_POST,'postdate');
    $lastedit = date("Y-m-d");
    $qualification = $_POST['qualification'];
    array_shift($qualification);
    $qualification_json = json_encode($qualification);
    $offer = $_POST['offer'];
    array_shift($offer);
    $offer_json = json_encode($offer);
    $jobMgr->updateJob($jobid, $jobname, $location, $description, $type, $category, $qualification_json, $offer_json, $contact,$postdate,$lastedit);
    header("location: admin/job.php");
}elseif ($operation === "delete"){
    $jobid = filter_input(INPUT_POST,'jobid');
    $jobMgr->deleteJob($jobid);
    $response=[];
    echo json_encode($response);
}elseif ($operation === "getJobList"){
    $list = $jobMgr->getAllJobs();
    echo json_encode($list);
}elseif ($operation === "populateJobInfo"){
    $jobid = filter_input(INPUT_POST,'jobid');
    $job=$jobMgr->getJobById($jobid);
    echo json_encode($job);
}