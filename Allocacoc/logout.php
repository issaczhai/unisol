<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if(!empty($_SESSION["userid"])){
	unset($_SESSION["userid"]);
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php';
header('Location: '.$extra);
}elseif (!empty($_SESSION["admin_id"])) {
	unset($_SESSION["admin_id"]);
	$host  = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php';
header('Location: '.$extra);
}
