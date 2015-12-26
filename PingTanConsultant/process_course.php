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
    return $courseID.'_'.time().'_'.substr($filename,0,strrpos($filename,"."));
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
    $description = "";
    if(!empty($_POST['description'])){
        $description = $_POST['description'];
    }
    if (!file_exists($courseDB. $courseID)){
        mkdir($courseDB.$courseID ,0777, true);
    }
    if (!file_exists($courseDB. $courseID."/documents")){
        mkdir($courseDB.$courseID."/documents" ,0777, true);
    }
    
    $path_arr=array();
    $x=0;
    foreach($_FILES['documents']['name'] as $filename){
        $file_name = self::upload_savename_by_gf($courseID,$filename);
        $file_path = $courseDB.$courseID."/documents/".$file_name;
        move_uploaded_file($_FILES["documents"]['tmp_name'][$x], $file_path);
        $path_arr[$x] = $file_path;
        $x+=1;
    }
    $documents = json_encode($path_arr);
    $courseMgr->addCourse($courseID, $name, $instructor, $price, $description, $documents, $requiredCert, $receivedCert, $prerequisite);
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
}elseif ($operation === "delete") {
    $courseID = filter_input(INPUT_POST,'courseID');
    $courseMgr->deleteCourse($courseID);
    $sessionMgr->deleteSessionByCourse($courseID);
    self::deldir($courseDB.$courseID);
}