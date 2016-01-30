<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/NewsManager.php");

$newsMgr = new NewsManager();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$operation="";
$operation = filter_input(INPUT_POST,'operation');

if ($operation === "add"){
    $newsID = (string)rand(0,1000000);
    $title = filter_input(INPUT_POST,'title');
    $content = $_POST['content'];
    $newsMgr->addNews($newsID, $title, $content);
    header("Location: ./admin/news.php");
}elseif($operation === "delete"){
    $newsID = filter_input(INPUT_POST,'newsID');
    $newsMgr->deleteNews($newsID);
}