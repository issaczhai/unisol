<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FdpManager
 *
 * @author User
 */
class RewardManager {
    //put your code here
    
    function getRewardCodeList(){
        $codeList = array();
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM reward");
        $stmt->execute();
        $stmt->bind_result($code);
        while ($stmt->fetch())
        {	
            array_push($codeList,$code);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $codeList;
    }
    
    function createRewardCode($number){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $number; $i++) {
            $randomString = '';
            for ($j = 0; $j < $charactersLength; $j++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $stmt = $conn->prepare("INSERT INTO reward (code) VALUES (?)");
            $stmt->bind_param("s", $randomString);
            $stmt->execute();
        }
        
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
}