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
    
    function getFreeDeliveryPrice(){
        $free_delivery_price = 0.0;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM free_delivery_price");
        $stmt->execute();
        $stmt->bind_result($price);
        while ($stmt->fetch())
        {	
            $free_delivery_price = $price;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $free_delivery_price;
    }
    
    function updateFreeDeliveryPrice($new_free_delivery_price){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $truncate_stmt = $conn->prepare("TRUNCATE TABLE free_delivery_price");
        $truncate_stmt->execute();
        $stmt = $conn->prepare("INSERT INTO free_delivery_price (price) VALUES (?)");
        $stmt->bind_param("d", $new_free_delivery_price);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
}