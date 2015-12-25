<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConnectionManager
 *
 * @author User
 */
class ConnectionManager {
    //put your code here
    static function getConnection(){
        $hostname = "localhost";
        $database = "pingtan_db";
        $userName = "root";
        $password = "";
        $conn = new mysqli($hostname, $userName, $password, $database);
        return $conn;
    }
    
    function closeConnection($stmt, $conn){
        $stmt->close();
        $conn->close();
    }
}