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
        $stmt = $conn->prepare("SELECT code FROM reward");
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
            for ($j = 0; $j < 6; $j++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $stmt = $conn->prepare("INSERT INTO reward (code, product_name, worth, photo) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $randomString, "", "", "");
            $stmt->execute();
        }
        
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getNoOfBeneficiary($code){
        $noOfBeneficiary = 0;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT count(*) as number FROM reward_history WHERE code = ?");
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $stmt->bind_result($number);
        while ($stmt->fetch())
        {	
            $noOfBeneficiary = $number;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $noOfBeneficiary;
    }
    
    function removeRewardCode($code){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM reward WHERE code = ?");
        $stmt->bind_param("s",$code);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getGiftByRewardCode($code){
        $gift = array();
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT product_name, worth, photo FROM reward WHERE code = ?");
        $stmt->bind_param("s",$code);
        $stmt->execute();
        $stmt->bind_result($product_name,$worth,$photo);
        while ($stmt->fetch())
        {	
            $gift["product"]=$product_name;
            $gift["worth"]=$worth;
            $gift["photo"]=$photo;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $gift;
    }
    
    function checkCode($code){
        $exist = true;
        $count = 0;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT count(*) as number FROM reward WHERE code = ?");
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $stmt->bind_result($number);
        while ($stmt->fetch())
        {   $count = $number;
            
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        if($count === 0){
            $exist = false;
        }
        return $exist;
    }
    
    function checkHistory($customer_id, $code){
        $exist = true;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT count(*) as number FROM reward_history WHERE customer_id = ? AND code = ?");
        $stmt->bind_param("ss", $customer_id, $code);
        $stmt->execute();
        $stmt->bind_result($number);
        while ($stmt->fetch())
        {	
            if($number === 0){
                $exist = false;
            }
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $exist;
    }
    
    function addToHistory($customer_id, $code){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO reward_history (customer_id, code) VALUES (?,?)");
        $stmt->bind_param("ss", $customer_id, $code);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
}