<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/CourseManager.php");
include_once("./Manager/SessionManager.php");
include_once("./Manager/StudentManager.php");
header("Content-type: text/html;charset=utf-8");
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
    $lang = filter_input(INPUT_POST,'lang');
    $name = filter_input(INPUT_POST,'name');
    $instructor = filter_input(INPUT_POST,'instructor');
    $price = floatval(filter_input(INPUT_POST,'price'));
    $requiredCert = filter_input(INPUT_POST,'requiredCert');
    $prerequisite = filter_input(INPUT_POST,'prerequisite');
    $receivedCert = filter_input(INPUT_POST,'receivedCert');
    /**************************************Display Picture****************************************************************/
    if (!file_exists($courseDB. $courseID)){
        mkdir($courseDB.$courseID ,0777, true);
    }
    if (!file_exists($courseDB. $courseID."/documents")){
        mkdir($courseDB.$courseID."/documents" ,0777, true);
    }
    if (!file_exists($courseDB. $courseID."/displayPic")){
        mkdir($courseDB.$courseID."/displayPic" ,0777, true);
    }
    $picname = $_FILES['displayPic']['name']; 
    $picsize = $_FILES['displayPic']['size'];
    $pic_path = "";
    if ($picname != "") {
//        if ($picsize > 5120000) {  
//            echo 'image size cannot exceed 5m'; 
//            exit; 
//        } 
          $type = strstr($picname, '.');  
//        if ($type != ".gif" && $type != ".jpg" && $type != ".png") { 
//            echo 'invalid image type'; 
//            exit; 
//        }
        $rand = rand(10000, 99999); 
        $pics = strstr($picname,'.',true) . date("YmdHis") . $rand .'displayPic'. $type;
        $pic_path = $courseDB.$courseID."/displayPic/".$pics;
        move_uploaded_file($_FILES['displayPic']['tmp_name'], $pic_path);
                
    }
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
    
//    $path_arr=array();
//    if(!empty($_FILES['documents']['name'][0])){
//        for($j=0; $j < count($_FILES["documents"]['name']); $j++) { 
//            $file_name = upload_savename_by_gf($courseID,$_FILES["documents"]['name'][$j]);
//            $file_path = $courseDB.$courseID."/documents/".$file_name;
//            move_uploaded_file($_FILES["documents"]['tmp_name'][$j], $file_path);
//            array_push($path_arr, $file_path);
//        }
//    }
//    $documents = json_encode($path_arr);
    $documents = "";
    /******************************************************************************************************/
    $courseMgr->addCourse($lang,$courseID, $name, $instructor, $price, $pic_path,$description,$syllabus,$objective, $documents, $requiredCert, $receivedCert, $prerequisite);
    header("Location: admin/course.php");
    
    
}elseif ($operation === "checkCourseID") {
    $courseID = filter_input(INPUT_POST,'courseID');
    $lang = filter_input(INPUT_POST,'lang');
    $course = $courseMgr->getCourse($lang,$courseID);
    $course = array_filter($course);
    $arr=array();
    if (!empty($course)) {
        $arr['status'] = "used";
    }else{
        $arr['status'] = "available";
    }
    echo json_encode($arr);
}elseif($operation === "delete") {
    $courseID = filter_input(INPUT_POST,'courseID');
    $language=['en','cn'];
    foreach($language as $lang){
        $courseMgr->deleteCourse($lang,$courseID);
        $sessionMgr->deleteSessionByCourse($lang,$courseID);
    }
    deldir($courseDB.$courseID);
}elseif($operation === 'edit'){
    $courseID = filter_input(INPUT_POST,'courseID');
    $lang = filter_input(INPUT_POST,'lang');
    $name = filter_input(INPUT_POST,'name');
    $instructor = filter_input(INPUT_POST,'instructor');
    $price = floatval(filter_input(INPUT_POST,'price'));
    $requiredCert = filter_input(INPUT_POST,'requiredCert');
    $prerequisite = filter_input(INPUT_POST,'prerequisite');
    $receivedCert = filter_input(INPUT_POST,'receivedCert');
    /******************************************************************************************************/
    $picname = $_FILES['displayPic']['name']; 
    $picsize = $_FILES['displayPic']['size'];
    $pic_path = filter_input(INPUT_POST,'currentDisplayPic');
    if(strpos($pics,"../")!== false){
        $pics = substr($pics,strpos($pics,"../")+3);
    }
    if ($picname != "") {
        unlink($pics);
        $rand = rand(10000, 99999);
        $type = strstr($picname, '.');  
        $pics = strstr($picname,'.',true) . date("YmdHis") . $rand .'displayPic'. $type;
        $pic_path = $courseDB.$courseID."/displayPic/".$pics;
        move_uploaded_file($_FILES['displayPic']['tmp_name'], $pic_path);  
    }
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
//    $path_arr = array();
//    $existingPath = $_POST['existingDocuments'];
//    foreach($existingPath as $path){
//        array_push($path_arr,$path);
//    }
//    //var_dump($path_arr);
//    if (!file_exists($courseDB. $courseID)){
//        mkdir($courseDB.$courseID ,0777, true);
//    }
//    if (!file_exists($courseDB. $courseID."/documents")){
//        mkdir($courseDB.$courseID."/documents" ,0777, true);
//    }
//    if(!empty($_FILES['documents']['name'][0])){
//        for($j=0; $j < count($_FILES["documents"]['name']); $j++) {
//            $file_name = upload_savename_by_gf($courseID,$_FILES["documents"]['name'][$j]);
//            $file_path = $courseDB.$courseID."/documents/".$file_name;
//            //move_uploaded_file($_FILES["documents"]['tmp_name'][$j], $file_path);
//            array_push($path_arr, $file_path);
//        }
//    }
//    $documents = json_encode($path_arr);
    //var_dump($documents);
    /******************************************************************************************************/
    $courseMgr->updateCourse($lang,$courseID, $name, $instructor, $price, $pic_path, $description,$syllabus,$objective, $requiredCert, $receivedCert, $prerequisite);
    header("Location: admin/course.php");
    
}elseif ($operation === 'deleteDocument'){
    $courseID = filter_input(INPUT_POST,'courseID');
    $documentPath = filter_input(INPUT_POST,'documentPath');
    unlink($documentPath);
}elseif($operation === "deleteDocumentByCategory"){
    $courseID = filter_input(INPUT_POST,'courseID');
    $pathArr = json_decode(filter_input(INPUT_POST,'pathArr'));
    foreach ($pathArr as $path){
        unlink($path);
    }
}elseif ($operation === "editDocument"){
    $courseID = filter_input(INPUT_POST,'courseID');
    if (!file_exists($courseDB. $courseID)){
        mkdir($courseDB.$courseID ,0777, true);
    }
    if (!file_exists($courseDB. $courseID."/documents")){
        mkdir($courseDB.$courseID."/documents" ,0777, true);
    }
    $lang = filter_input(INPUT_POST,'lang');
    $catRowNo = intval(filter_input(INPUT_POST,'catRowNo'));
    $documents = array();
    for($row=1; $row <= $catRowNo; $row++){
        $catName = filter_input(INPUT_POST,'cat'.strval($row));
        
        $path_arr = array();
        if(isset($_POST['cat'.strval($row).'Documents'])){
            $existingPath = $_POST['cat'.strval($row).'Documents'];
            foreach($existingPath as $path){
                array_push($path_arr,$path);
            }
        }
        
        if(!empty($_FILES['cat'.$row.'Upload']['name'][0])){
            for($j=0; $j < count($_FILES['cat'.$row.'Upload']['name']); $j++) {
                $file_name = upload_savename_by_gf($courseID,$_FILES['cat'.$row.'Upload']['name'][$j]);
                $file_path = $courseDB.$courseID."/documents/".$file_name;
                //move_uploaded_file($_FILES["documents"]['tmp_name'][$j], $file_path);
                array_push($path_arr, $file_path);
            }
        }
        
        $documents[$catName] = $path_arr; 
    }
    $courseMgr->updateCourseDocuments($lang, $courseID, json_encode($documents));
    header("Location: admin/document.php");
}elseif ($operation === "checkSession"){
    $courseID = filter_input(INPUT_POST,'courseID');
    $sessionID = filter_input(INPUT_POST,'sessionID');
    $lang = filter_input(INPUT_POST,'lang');
    $seesion = $sessionMgr->getSession($lang,$courseID,$sessionID);
    $arr=array();
    if (!empty($seesion)) {
        $arr['status'] = "used";
    }else{
        $arr['status'] = "available";
    }
    echo json_encode($arr);
}elseif ($operation==="addSession"){
    $courseID = filter_input(INPUT_POST,'courseID');
    $sessionID = filter_input(INPUT_POST,'sessionID');
    $lang = filter_input(INPUT_POST,'lang');
    $timeType = filter_input(INPUT_POST,'timeType');
    $time = filter_input(INPUT_POST,'time');
    $startDate = new DateTime(filter_input(INPUT_POST,'startDate'));
    $startDate = $startDate->format('Y-m-d H:i:s');
    $endDate = new DateTime(filter_input(INPUT_POST,'endDate'));
    $endDate = $endDate->format('Y-m-d H:i:s');
    $venue = filter_input(INPUT_POST,'venue');
    $vacancy = intval(filter_input(INPUT_POST,'vacancy'));
    $languages = filter_input(INPUT_POST,'languages');
    $classlist = "";
    if($timeType==='fulltime'){
        $sessionMgr->addSession($lang,$courseID, $sessionID, $time, "",$startDate, $endDate,$venue, $vacancy, $languages, $classlist);
    }elseif($timeType==='parttime'){
        $sessionMgr->addSession($lang,$courseID, $sessionID, "", $time,$startDate, $endDate,$venue, $vacancy, $languages, $classlist);
    }
    header("Location: admin/course.php");
}elseif ($operation === 'deleteSession') {
    $courseID = filter_input(INPUT_POST,'courseID');
    $sessionID = filter_input(INPUT_POST,'sessionID');
    $language=['en','cn'];
    foreach($language as $lang){
        $sessionMgr->deleteSession($lang,$courseID, $sessionID);
    }
    
}elseif ($operation === 'editSession'){
    $courseID = filter_input(INPUT_POST,'courseID');
    $sessionID = filter_input(INPUT_POST,'sessionID');
    $lang = filter_input(INPUT_POST,'lang');
    $timeType = filter_input(INPUT_POST,'timeType');
    $time = filter_input(INPUT_POST,'time');
    $startDate = new DateTime(filter_input(INPUT_POST,'startDate'));
    $startDate = $startDate->format('Y-m-d H:i:s');
    $endDate = new DateTime(filter_input(INPUT_POST,'endDate'));
    $endDate = $endDate->format('Y-m-d H:i:s');
    $venue = filter_input(INPUT_POST,'venue');
    $vacancy = intval(filter_input(INPUT_POST,'vacancy'));
    $languages = filter_input(INPUT_POST,'languages');
    $classlist = "";
    if($timeType==='fulltime'){
        $sessionMgr->updateSession($lang,$courseID, $sessionID, $time, "",$startDate, $endDate,$venue, $vacancy, $languages, $classlist);
    }elseif($timeType==='parttime'){
        $sessionMgr->updateSession($lang,$courseID, $sessionID, "", $time,$startDate, $endDate,$venue, $vacancy, $languages, $classlist);
    }
    header("Location: admin/course.php");
}elseif ($operation === "retrieveSession"){
    $courseID = filter_input(INPUT_POST,'courseID');
    $sessionID = filter_input(INPUT_POST,'sessionID');
    $lang = filter_input(INPUT_POST,'lang');
    $session = $sessionMgr->getSession($lang, $courseID, $sessionID);
    echo json_encode($session);
}elseif ($operation === "getClassList"){
    $courseID = filter_input(INPUT_POST,'courseID');
    $sessionID = filter_input(INPUT_POST,'sessionID');
    $lang = 'en';
    $session = $sessionMgr->getClassList($lang, $courseID, $sessionID);
    echo json_encode($session);
}