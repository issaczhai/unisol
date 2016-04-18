<?php

error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/RewardManager.php");
if (!isset($_SESSION)) {
  session_start();
}

$rewardMgr = new RewardManager();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$operation = $_GET["operation"];
//echo $operation;

if ($operation === "remove"){
    $code = $_GET["code"];
    $rewardMgr->removeRewardCode($code);
header("Location: admin.php");
}else if($operation === "create"){
    $number = $_POST['numberOfCode'];
    $rewardMgr->createRewardCode($number);
    header("Location: admin.php");
}else if ($operation === "check") {
    $userid = null;
    $userid = $_SESSION["userid"];
    $code = addslashes(filter_input(INPUT_POST, 'code'));
    $exist = $rewardMgr->checkCode($code);
    $used = $rewardMgr->checkHistory($userid, $code);
    if($exist === false || $used === true){
        $arr = array();
        $arr['code'] = $code;
        $arr['status'] = false;
        echo json_encode($arr);
        exit;
    }
    $arr = array();
    $arr['code'] = $code;
    $arr['status'] = $exist;
    echo json_encode($arr);
}else if ($operation === "reward") {
    $code = addslashes(filter_input(INPUT_POST, 'code'));
    $gift = $rewardMgr->getGiftByRewardCode($code);
    echo json_encode($gift);
    exit;
}else if($operation === "setGift"){
    $code = filter_input(INPUT_POST,'gift_code');
    $gift_name = filter_input(INPUT_POST,'gift_name');
    $worth = filter_input(INPUT_POST,'gift_worth');
    $picname = $_FILES["gift_photo"]['name']; 
    $picsize = $_FILES["gift_photo"]['size'];
    $pic_path = "";
    var_dump(($picname != ""));
    if ($picname != "") {
        if ($picsize > 5120000) {  
            echo 'image size cannot exceed 5m'; 
            exit; 
        } 
        $type = strstr($picname, '.');  
        if ($type != ".gif" && $type != ".jpg" && $type != ".png" && $type != ".jpeg") { 
            echo 'invalid image type'; 
            exit; 
        }
        $rand = rand(100, 999); 
        $pics = $picname . date("YmdHis") . $rand . "gift" . $type;
        $pic_path = "public_html/img/productImg/". $pics;
        move_uploaded_file($_FILES["gift_photo"]['tmp_name'], $pic_path);
    }
    $rewardMgr->setGift($code, $gift_name, $worth, $pic_path);
    header("Location: admin.php");
}