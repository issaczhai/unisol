<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/StudentManager.php");

$studentMgr = new StudentManager();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$studentDB = "public_html/student/";
$operation="";
$operation = filter_input(INPUT_POST,'operation');
if ($operation === "certify"){
    $courseID =filter_input(INPUT_POST,'courseID');
    $sessionID = filter_input(INPUT_POST,'sessionID');
    $studentIDList = $_POST['student'];
    foreach($studentIDList as $id){
        if (!file_exists($studentDB.$id)){
            mkdir($studentDB.$id ,0777, true);
        }
        if (!file_exists($studentDB.$id."/certificate")){
            mkdir($studentDB.$id."/certificate" ,0777, true);
        }
        if (!file_exists($studentDB.$id."/certificate/".$courseID)){
            mkdir($studentDB.$id."/certificate/".$courseID ,0777, true);
        }
        $rand = rand(10000, 99999);
        $cert = $_FILES[$id.'cert']['name'];
        $type = strstr($cert, '.');
        $certName = filter_input(INPUT_POST,$id.'certName');
        $filename = $id . date("YmdHis") . $rand .$certName. $type;
        $cert_path = $studentDB.$id."/certificate/".$courseID."/".$filename;
        move_uploaded_file($_FILES[$id.'cert']['tmp_name'], $cert_path);
        $studentMgr->saveCert($id,$courseID,$certName,$sessionID,$cert_path);
    }
    header("Location: admin/certify.php");
}elseif($operation === "resetPassword"){
    $studentID =filter_input(INPUT_POST,'studentID');
    $password = "12345";
    $studentMgr->resetPassword($studentID, $password);
}