<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/AdminManager.php");

$adminMgr = new AdminManager();

$operation="";
$operation = filter_input(INPUT_POST,'button');
if ($operation === "login"){
    $username = filter_input(INPUT_POST,'username');
    $password = filter_input(INPUT_POST,'password');
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
    
}