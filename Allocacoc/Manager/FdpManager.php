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
class FdpManager {
    //put your code here
    
    function getCutoff(){
        $cutoff = 0.0;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT price FROM free_delivery_price");
        $stmt->execute();
        $stmt->bind_result($price);
        while ($stmt->fetch())
        {	
            $cutoff = $price;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $cutoff;
    }
    
    function getCharge(){
        $current_delivery_charge = 0.0;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT delivery_charge FROM free_delivery_price");
        $stmt->execute();
        $stmt->bind_result($delivery_charge);
        while ($stmt->fetch())
        {	
            $current_delivery_charge = $delivery_charge;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $current_delivery_charge;
    }
    
    function updateCutoff($new_cutoff){
        $current_charge = self::getCharge();
        self::truncate();
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
//        var_dump($current_charge);
//        var_dump(($current_charge == null));
        if($current_charge == null){
            $current_charge = 0.0; 
        }
        $stmt = $conn->prepare("INSERT INTO free_delivery_price (price, delivery_charge) VALUES (?,?)");
        $stmt->bind_param("dd",$new_cutoff, $current_charge);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updateCharge($current_charge){
        $new_cutoff = self::getCutoff();
        self::truncate();
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        if($new_cutoff == null){
            $new_cutoff = 0.0;
        }
        $stmt = $conn->prepare("INSERT INTO free_delivery_price (price, delivery_charge) VALUES (?,?)");
        $stmt->bind_param("dd",$new_cutoff, $current_charge);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function truncate(){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("TRUNCATE TABLE free_delivery_price");
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
}