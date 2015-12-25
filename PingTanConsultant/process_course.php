<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/CourseManager.php");

$courseMgr = new CourseManager();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$operation="";
$operation = filter_input(INPUT_POST,'operation');
if ($operation === "add"){
    $courseID = filter_input(INPUT_POST,'courseID');
    $name = filter_input(INPUT_POST,'country');
    $instructor = filter_input(INPUT_POST,'instructor');
    $price = filter_input(INPUT_POST,'price');
    $requiredCert = filter_input(INPUT_POST,'requiredCert');
    $prerequisite = filter_input(INPUT_POST,'prerequisite');
    $receivedCert = filter_input(INPUT_POST,'receivedCert');
    $description = "";
    if(!empty($_POST['description'])){
        $description = $_POST['description'];
    }
    $courseMgr->addCourse($courseID, $name, $instructor, $price, $description, $documents, $requiredCert, $receivedCert, $prerequisite);
    header("Location: admin/course.php");
    
    
}