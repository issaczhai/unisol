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
$operation = filter_input(INPUT_POST,'operation');

if ($operation === "add_product"){
$valid=true;
$random_no = (string)rand(0,10000);
$project_id = "AL".$random_no;
$project_name = filter_input(INPUT_POST,'name');
$type = $_POST['type'];
$year = filter_input(INPUT_POST,'year');
$country = filter_input(INPUT_POST,'country');
$location = filter_input(INPUT_POST,'location');
$size = filter_input(INPUT_POST,'size');
$completion_date = filter_input(INPUT_POST,'completion_date');
$description = "";
    if(!empty($_POST['description'])){
        $description = $_POST['description'];
    }
$projectMgr->addProject($project_id, $project_name, $type, $year, $country, $size, $location, $completion_date, $description);
$count=0;
$countStr='';
$photo_name_arr = ['photo1','photo2','photo3','photo4','photo5','photo6','photo7','photo8','photo9','photo10','photo11','photo12','photo13','photo14','photo15'];
foreach ($photo_name_arr as $photo_name){
	$picname = $_FILES[$photo_name]['name']; 
	$picsize = $_FILES[$photo_name]['size'];
	if ($picname != "") {
		//if ($picsize > 5120000) {  
		//	echo 'image size cannot exceed 5m'; 
		//	exit; 
		//} 
		$type = strstr($picname, '.');  
		if ($type != ".gif" && $type != ".jpg" && $type != ".png") { 
			echo 'invalid image type'; 
			exit; 
		}
		$rand = rand(1000, 9999); 
		$pics = date("YmdHis") . $rand . $type;

		$pic_path = "image/". $pics;
		move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
		$count+=1;
		$countStr = strval($count);
		$photoMgr->AddPhoto($project_id, $countStr, $pic_path);
	}
}
    
header("Location: admin.html");
}
?>