<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProjectManager.php");
include_once("./Manager/PhotoManager.php");

$projectMgr = new ProjectManager();
$photoMgr = new PhotoManager();
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

if ($operation === "create"){
$valid=true;
$random_no = (string)rand(0,10000);
$project_id = "P".$random_no;
$project_name = filter_input(INPUT_POST,'name');
$type = $_POST['type'];
$year = filter_input(INPUT_POST,'year');
$country = filter_input(INPUT_POST,'country');
$location = filter_input(INPUT_POST,'location');
$size = filter_input(INPUT_POST,'size');
$completion_date = filter_input(INPUT_POST,'completion_date');
$date = new DateTime($completion_date);
$date = $date->format('Y-m-d H:i:s');
$description = "";
    if(!empty($_POST['description'])){
        $description = $_POST['description'];
    }
$projectMgr->addProject($project_id, $project_name, $type, $year, $country, $size, $location, $date, $description);
$count=0;
$noOfPhoto = 20;
for ($x = 1; $x <= $noOfPhoto; $x++){
    $hdId="hd".strval($x)."_input";
    $thumbnailId="thumbnail".strval($x)."_input";
    
    $hdPicname = $_FILES[$hdId]['name'];
    if ($hdPicname != "") {
        $count++;
        $type = strstr($hdPicname, '.');  
        if ($type != ".gif" && $type != ".jpg" && $type != ".png") { 
            echo 'invalid image type'; 
            exit; 
        }
        $rand = rand(1000, 9999); 
        $pics = date("YmdHis") . $rand ."hd". $type;
        if (!file_exists("public_html/img/projectImg/". $project_id)){
            mkdir("public_html/img/projectImg/".$project_id ,0777, true);
        }
        $pic_path = "public_html/img/projectImg/". $project_id . "/". $pics;
        move_uploaded_file($_FILES[$hdId]['tmp_name'], $pic_path);
        $photoMgr->AddPhoto($project_id, "hd".strval($count), $pic_path);
    }
    
    $thumbnailPicname = $_FILES[$thumbnailId]['name'];
    if ($thumbnailPicname != "") {
        $type = strstr($thumbnailPicname, '.');  
        if ($type != ".gif" && $type != ".jpg" && $type != ".png") { 
            echo 'invalid image type'; 
            exit; 
        }
        $rand = rand(1000, 9999); 
        $pics = date("YmdHis") . $rand ."thumbnail". $type;
        if (!file_exists("public_html/img/projectImg/". $project_id)){
            mkdir("public_html/img/projectImg/".$project_id ,0777, true);
        }
        $pic_path = "public_html/img/projectImg/". $project_id . "/". $pics;
        move_uploaded_file($_FILES[$thumbnailId]['tmp_name'], $pic_path);
        $photoMgr->AddPhoto($project_id, "thumbnail".strval($count), $pic_path);
    }
}

$displayPic = $_FILES["display"]['name'];
if ($displayPic != "") {
    $type = strstr($displayPic, '.');  
    if ($type != ".gif" && $type != ".jpg" && $type != ".png") { 
        echo 'invalid image type'; 
        exit; 
    }
    $rand = rand(1000, 9999); 
    $pics = date("YmdHis") . $rand ."display". $type;
    if (!file_exists("public_html/img/projectImg/". $project_id)){
        mkdir("public_html/img/projectImg/".$project_id ,0777, true);
    }
    $pic_path = "public_html/img/projectImg/". $project_id . "/". $pics;
    move_uploaded_file($_FILES["display"]['tmp_name'], $pic_path);
    $photoMgr->AddPhoto($project_id, "display", $pic_path);
}

$msg="Project added successfully!";
header("Location: admin.php?message=".$msg);
}elseif ($operation === "delete"){
    $projectIdList_str = $_GET['projectIdList'];
    $projectIdList=explode(",",$projectIdList_str);
    foreach($projectIdList as $id){
        $projectMgr->deleteProject($id);
        $photoMgr->deleteAllPhotosByproject($id);
    }
$msg="Project deleted successfully!";
header("Location: admin.php?message=".$msg);
}elseif ($operation === "edit"){
    $edit_id = addslashes(filter_input(INPUT_POST, 'edit_id'));
    $project_name = filter_input(INPUT_POST,'name');
    $type = $_POST['type'];
    $year = filter_input(INPUT_POST,'year');
    $country = filter_input(INPUT_POST,'country');
    $location = filter_input(INPUT_POST,'location');
    $size = filter_input(INPUT_POST,'size');
    $completion_date = filter_input(INPUT_POST,'completion_date');
    $date = new DateTime($completion_date);
    $date = $date->format('Y-m-d H:i:s');
    $description = "";
    if(!empty($_POST['description'])){
        $description = $_POST['description'];
    }
    //UPDATE DB PROJECT TABLE
    $projectMgr->updateProject($edit_id, $project_name, $type, $year, $country, $location, $size, $date, $description);
    //UPDATE DISPLAY PIC
    $displayPic = $_FILES["display"]['name'];
if ($displayPic != "") {
    $type = strstr($displayPic, '.');  
    if ($type != ".gif" && $type != ".jpg" && $type != ".png") { 
        echo 'invalid image type'; 
        exit; 
    }
    $rand = rand(1000, 9999); 
    $pics = date("YmdHis") . $rand ."display". $type;
    if (!file_exists("public_html/img/projectImg/". $edit_id)){
        mkdir("public_html/img/projectImg/".$edit_id ,0777, true);
    }
    $pic_path = "public_html/img/projectImg/". $edit_id . "/". $pics;
    move_uploaded_file($_FILES["display"]['tmp_name'], $pic_path);
    
    if(($photoMgr->getSpecificPhotoURL($edit_id, "display"))!==''){
        $photoMgr->updateSpecificPhoto($edit_id, "display", $pic_path);
    }else{
        $photoMgr->AddPhoto($edit_id, "display", $pic_path);
    }
    
}
//UPDATE HD AND THUMBNAIL

$noOfPhoto = 20;
for ($x = 1; $x <= $noOfPhoto; $x++){
    $hdId="hd".strval($x)."_input";
    $thumbnailId="thumbnail".strval($x)."_input";
    $index=0;
    $hdPicname = $_FILES[$hdId]['name'];
    if ($hdPicname != "") {
        $type = strstr($hdPicname, '.');  
        if ($type != ".gif" && $type != ".jpg" && $type != ".png") { 
            echo 'invalid image type'; 
            exit; 
        }
        $rand = rand(1000, 9999); 
        $pics = date("YmdHis") . $rand ."hd". $type;
        if (!file_exists("public_html/img/projectImg/". $edit_id)){
            mkdir("public_html/img/projectImg/".$edit_id ,0777, true);
        }
        $pic_path = "public_html/img/projectImg/". $edit_id . "/". $pics;
        move_uploaded_file($_FILES[$hdId]['tmp_name'], $pic_path);
        if( ($photoMgr->getSpecificPhotoURL($edit_id, "hd".strval($x))) !== ''){
            $photoMgr->updateSpecificPhoto($edit_id, "hd".strval($x), $pic_path);
        }else{
            $photoList = $photoMgr->getPhotosByProject($edit_id);
            $index = intval(sizeof($photoList)/2)+1;
            $photoMgr->AddPhoto($edit_id, "hd".strval($index), $pic_path);
        }
    }
    
    $thumbnailPicname = $_FILES[$thumbnailId]['name'];
    if ($thumbnailPicname != "") {
        $type = strstr($thumbnailPicname, '.');  
        if ($type != ".gif" && $type != ".jpg" && $type != ".png") { 
            echo 'invalid image type'; 
            exit; 
        }
        $rand = rand(1000, 9999); 
        $pics = date("YmdHis") . $rand ."thumbnail". $type;
        if (!file_exists("public_html/img/projectImg/". $edit_id)){
            mkdir("public_html/img/projectImg/".$edit_id ,0777, true);
        }
        $pic_path = "public_html/img/projectImg/". $edit_id . "/". $pics;
        move_uploaded_file($_FILES[$thumbnailId]['tmp_name'], $pic_path);
        if( ($photoMgr->getSpecificPhotoURL($edit_id, "thumbnail".strval($x))) !== ''){
            $photoMgr->updateSpecificPhoto($edit_id, "thumbnail".strval($x), $pic_path);
        }else{
//            $photoList = $photoMgr->getPhotosByProject($edit_id);
//            $index = intval(sizeof($photoList)/2)+1;
            $photoMgr->AddPhoto($edit_id, "thumbnail".strval($index), $pic_path);
        }
    }
}
/****************************************************/
    
$msg="Project ".$edit_id." updated successfully!";
header("Location: admin.php?message=".$msg);
}elseif ($operation === "populate"){
    $projectid = addslashes(filter_input(INPUT_POST, 'projectid'));
    $project = $projectMgr->getProject($projectid);
    echo json_encode($project);
}elseif ($operation === 'deletePhoto'){
    $editid = addslashes(filter_input(INPUT_POST, 'editid'));
    $photo_no = addslashes(filter_input(INPUT_POST, 'photo_no'));
    $photoMgr->deleteSpecificPhoto($editid, 'hd'.$photo_no);
    $photoMgr->deleteSpecificPhoto($editid, 'thumbnail'.$photo_no);
    $return = [];
    $return['status']='success';
    echo json_encode($return);
}
?>