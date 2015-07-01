<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$databaseConnection = null;
function getConnection(){
    $hostname = "localhost";
    $database = "allocacoc";
    $userName = "root";
    $password = "";
    global $databaseConnection;
    $databaseConnection = @mysql_connect($hostname, $userName, $password) or die(mysql_error());
    mysql_query("set names 'utf8");
    mysql_select_db($database,$databaseConnection) or die(mysql_error());
    
}
function closeConnection(){
    global $databaseConnection;
    if($databaseConnection){
        mysql_close($databaseConnection) or die(mysql_error());
    }
    
}

