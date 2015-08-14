<?php

error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/RewardManager.php");
if (!isset($_SESSION)) {
  session_start();
}
$userid = null;
$userid = $_SESSION["userid"];
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
    $code = addslashes(filter_input(INPUT_POST, 'code'));
    $exist = $rewardMgr->checkCode($code);
    $used = $rewardMgr->checkHistory($userid, $code);
    if($exist === false || $used === true){
        $arr = array();
        $arr['code'] = $code;
        $arr['status'] = $exist;
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
}