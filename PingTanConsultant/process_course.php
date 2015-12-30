<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/CourseManager.php");
include_once("./Manager/SessionManager.php");

$courseMgr = new CourseManager();
$sessionMgr = new SessionManager();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function upload_savename_by_gf($courseID,$filename){
    return $courseID.'_'.time().'_'.$filename;
}

function deldir($dir) {
  //先删除目录下的文件：
  $dh=opendir($dir);
  while ($file=readdir($dh)) {
    if($file!="." && $file!="..") {
      $fullpath=$dir."/".$file;
      if(!is_dir($fullpath)) {
          unlink($fullpath);
      } else {
          deldir($fullpath);
      }
    }
  }
 
  closedir($dh);
  //删除当前文件夹：
  if(rmdir($dir)) {
    return true;
  } else {
    return false;
  }
}

$courseDB="public_html/course/";

$operation="";
$operation = filter_input(INPUT_POST,'operation');
if ($operation === "add"){
    $courseID = filter_input(INPUT_POST,'courseID');
    $name = filter_input(INPUT_POST,'name');
    $instructor = filter_input(INPUT_POST,'instructor');
    $price = floatval(filter_input(INPUT_POST,'price'));
    $requiredCert = filter_input(INPUT_POST,'requiredCert');
    $prerequisite = filter_input(INPUT_POST,'prerequisite');
    $receivedCert = filter_input(INPUT_POST,'receivedCert');
    /******************************************************************************************************/
    $description = "";
    if(!empty($_POST['description'])){
        $description = $_POST['description'];
    }
    /******************************************************************************************************/
    $objective = "";
    if(!empty($_POST['objective'])){
        $objective = $_POST['objective'];
    }
    /******************************************************************************************************/
    $syllabusArray=[];
    $syllabusRow = intval(filter_input(INPUT_POST,'syllabusRow'));
    for ($x=1; $x<=$syllabusRow; $x++) {
        $unit = filter_input(INPUT_POST,'unit'.strval($x));
        $content = filter_input(INPUT_POST,'content'.strval($x));
        
        $syllabusArray[$unit]=$content;
        
    }
    $syllabus = json_encode($syllabusArray);
    /******************************************************************************************************/        
    if (!file_exists($courseDB. $courseID)){
        mkdir($courseDB.$courseID ,0777, true);
    }
    if (!file_exists($courseDB. $courseID."/documents")){
        mkdir($courseDB.$courseID."/documents" ,0777, true);
    }
    $path_arr=array();
    for($j=0; $j < count($_FILES["documents"]['name']); $j++) { 
        $file_name = upload_savename_by_gf($courseID,$_FILES["documents"]['name'][$j]);
        $file_path = $courseDB.$courseID."/documents/".$file_name;
        move_uploaded_file($_FILES["documents"]['tmp_name'][$j], $file_path);
        array_push($path_arr, $file_path);
    }
    $documents = json_encode($path_arr);
    /******************************************************************************************************/
    $courseMgr->addCourse($courseID, $name, $instructor, $price, $description,$syllabus,$objective, $documents, $requiredCert, $receivedCert, $prerequisite);
    header("Location: admin/course.php");
    
    
}elseif ($operation === "checkCourseID") {
    $courseID = filter_input(INPUT_POST,'courseID');
    $course = $courseMgr->getCourse($courseID);
    $course = array_filter($course);
    $arr=array();
    if (!empty($course)) {
        $arr['status'] = "used";
    }else{
        $arr['status'] = "available";
    }
    echo json_encode($arr);
}elseif ($operation === "checkSession"){
    $courseID = filter_input(INPUT_POST,'courseID');
    $sessionID = filter_input(INPUT_POST,'sessionID');
    $seesion = $sessionMgr->getSession($courseID,$sessionID);
    $arr=array();
    if (!empty($seesion)) {
        $arr['status'] = "used";
    }else{
        $arr['status'] = "available";
    }
    echo json_encode($arr);
}elseif($operation === "delete") {
    $courseID = filter_input(INPUT_POST,'courseID');
    $courseMgr->deleteCourse($courseID);
    $sessionMgr->deleteSessionByCourse($courseID);
    deldir($courseDB.$courseID);
}elseif ($operation==="addSession"){
    $courseID = filter_input(INPUT_POST,'courseID');
    $sessionID = filter_input(INPUT_POST,'sessionID');
    $timeType = filter_input(INPUT_POST,'timeType');
    $time = filter_input(INPUT_POST,'time');
    $startDate = new DateTime(filter_input(INPUT_POST,'startDate'));
    $startDate = $startDate->format('Y-m-d H:i:s');
    $venue = filter_input(INPUT_POST,'venue');
    $vacancy = intval(filter_input(INPUT_POST,'vacancy'));
    $languages = filter_input(INPUT_POST,'languages');
    $classlist = "";
    if($timeType==='fulltime'){
        $sessionMgr->addSession($courseID, $sessionID, $time, "",$startDate, $venue, $vacancy, $languages, $classlist);
    }elseif($timeType==='parttime'){
        $sessionMgr->addSession($courseID, $sessionID, "", $time,$startDate, $venue, $vacancy, $languages, $classlist);
    }
    header("Location: admin/course.php");
}elseif ($operation === 'deleteSession') {
    $courseID = filter_input(INPUT_POST,'courseID');
    $sessionID = filter_input(INPUT_POST,'sessionID');
    $sessionMgr->deleteSession($courseID, $sessionID);
}elseif ($operation === 'editSession'){
    
}