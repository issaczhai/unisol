<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OrderManager {
    
    function addOrder($order_id, $customer_id,$product_id,$quantity,$payment_time,$price){
        $status = "pending";
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO `order` (order_id, customer_id, product_id, quantity, price, payment_time, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssddss", $order_id, $customer_id, $product_id, $quantity,$price,$payment_time,$status);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updateOrderStatus($order_id,$status){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE `order` SET status = ? WHERE order_id = ?");
        $stmt->bind_param("ss", $status,$order_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getUniquePendingOrderIdList(){
        $order_id_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT DISTINCT order_id FROM `order`");
        $stmt->execute();
        $stmt->bind_result($order_id);
        while ($stmt->fetch())
        {   
            array_push($order_id_arr,$order_id);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $order_id_arr;
    }
    
    function getPendingOrder(){
        $order_id_arr = self::getUniquePendingOrderIdList();
        $order_arr = array();
        $ConnectionMgr = new ConnectionManager();
        foreach($order_id_arr as $o_id){
            $conn = $ConnectionMgr->getConnection();
            $count=0;
            $itemList = array();
            $totalPrice = 0.0;
            $stmt = $conn->prepare("SELECT * FROM `order` WHERE `order_id` = ? AND `status` = 'pending'");
            $stmt->bind_param("s", $o_id);
            $stmt->execute();
            $stmt->bind_result($order_id,$customer_id,$product_id,$quantity,$price,$payment_time,$status);
            while ($stmt->fetch())
            {   $count+=1;
                if($count == 1){
                    $order = array();
                    $order['order_id'] = $order_id;
                    $order['customer_id'] = $customer_id;
                    $order['payment_time'] = $payment_time;
                    $order['status'] = $status;
                }
                $item = array();
                $item['product_id'] = $product_id;
                $item['quantity'] = $quantity;
                $item['price'] = $price;
                $totalPrice += doubleval($price) * intval($quantity);
                array_push($itemList,$item);
            }
            if($count!=0){
                $order['totalPrice'] = $totalPrice;
                $order["itemList"] = $itemList;
                array_push($order_arr,$order);
            }
            
            $ConnectionMgr->closeConnection($stmt, $conn);
        }
        
        
        return $order_arr;
    }
    
    function getUniqueSentOrderIdList(){
        $order_id_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT DISTINCT order_id FROM `order`");
        $stmt->execute();
        $stmt->bind_result($order_id);
        while ($stmt->fetch())
        {   
            array_push($order_id_arr,$order_id);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $order_id_arr;
    }
    
    function getSentOrder(){
        $order_id_arr = self::getUniqueSentOrderIdList();
        $order_arr = array();
        $ConnectionMgr = new ConnectionManager();
        foreach($order_id_arr as $o_id){
            $conn = $ConnectionMgr->getConnection();
            $count=0;
            $itemList = array();
            $stmt = $conn->prepare("SELECT * FROM `order` WHERE `order_id` = ? AND `status` = 'sent'");
            $stmt->bind_param("s", $o_id);
            $stmt->execute();
            $stmt->bind_result($order_id,$customer_id,$product_id,$quantity,$price,$payment_time,$status);
            while ($stmt->fetch())
            {   $count+=1;
                if($count == 1){
                    $order = array();
                    $order['order_id'] = $order_id;
                    $order['customer_id'] = $customer_id;
                    $order['payment_time'] = $payment_time;
                    $order['status'] = $status;
                }
                $item = array();
                $item['product_id'] = $product_id;
                $item['quantity'] = $quantity;
                $item['price'] = $price;
                $totalPrice += doubleval($price) * intval($quantity);
                array_push($itemList,$item);
            }
            if($count!=0){
                $order['totalPrice'] = $totalPrice;
                $order["itemList"] = $itemList;
                array_push($order_arr,$order); 
            }
            
            $ConnectionMgr->closeConnection($stmt, $conn);
        }
        
        return $order_arr;
    }
    
    function getTop3Products(){
        $top_3_product_arr = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT product_id , sum(quantity) as total_orders FROM `order` GROUP BY product_id ORDER BY total_orders DESC");
        $stmt->execute();
        $stmt-> bind_result($product_id);
        $count = 0;
        while ($stmt-> fetch())
        {   $product = array();
            $count += 1;
            if($count<=3){
                $product["product_id"]= $product_id;
                array_push($top_3_product_arr,$product);
            }
            
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $top_3_product_arr;
    }
    
    
}