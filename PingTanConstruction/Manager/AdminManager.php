<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminManager
 *
 * @author User
 */
class AdminManager {
    //put your code here
    function getAdmin($username,$pwd){
        $admin = [];
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username,$pwd);
        $stmt->execute();
        $stmt->bind_result($username,$pwd,$profilePic,$email);
        while ($stmt->fetch())
        {   $admin['username'] = $username;
            $admin['password'] = $pwd;
            $admin['profilePic'] = $profilePic;
            $admin['email'] = $email;
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $admin;
    }
    
    function updatePassword($username,$pwd){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE admin SET password=? WHERE username=?");
        $stmt->bind_param("ss", $pwd, $username);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
}
