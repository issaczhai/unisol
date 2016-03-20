<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/AdminManager.php");

$adminMgr = new AdminManager();

$operation="";
if(isset($_POST['button'])){
    $operation = filter_input(INPUT_POST,'button');
}
if(isset($_POST['operation'])){
    $operation = filter_input(INPUT_POST,'operation');
}

$result = [];
if ($operation === "login"){
    $username = filter_input(INPUT_POST,'username');
    $password = sha1(filter_input(INPUT_POST,'password'));
    $admin = $adminMgr->getAdmin($username, $password);
    if(empty($admin)){
        $err = 'Incorrect username and password';
        header('Location: admin/login.php?errorMsg='.$err); 
    }else{
        session_start();
        $_SESSION["loggedIn"] = true;
        $_SESSION["admin"] = $admin;
        header('Location: admin/index.php'); 
    }
    
}elseif($operation === "checkCurrentPwd"){
    
    $username = "pingtanAdmin";
    $password = sha1(filter_input(INPUT_POST,'pwd'));
    $admin = $adminMgr->getAdmin($username, $password);
    if(empty($admin)){
        $result['status'] = 'false';
    }else{
        $result['status'] = 'true';
    }
   
    echo json_encode($result);
}elseif($operation === "checkNewPwd"){
    $newPwd = filter_input(INPUT_POST,'newPwd');
    $cfm_newPwd = filter_input(INPUT_POST,'cfm_newPwd');
    if($newPwd === $cfm_newPwd){
        $result["status"] = "true";
    }else{
        $result["status"] = "false";
    }
    echo json_encode($result);
}elseif($operation === "edit"){
    $username = "pingtanAdmin";
    $pwd = filter_input(INPUT_POST,'cfm_newPwd');
    $password = sha1($pwd);
    $adminMgr->updatePassword($username, $password);
    session_unset();
    $admin = $adminMgr->getAdmin($username, $password);
    $_SESSION["loggedIn"] = true;
    $_SESSION["admin"] = $admin;
//    var_dump($pwd);
//    var_dump($password);
//    var_dump($admin);
    header('Location: admin/index.php');
}