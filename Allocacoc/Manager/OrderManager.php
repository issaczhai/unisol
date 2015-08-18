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
        $stmt = $conn->prepare("INSERT INTO order (order_id, customer_id, product_id, quantity, price, payment_time, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdds", $order_id, $customer_id, $product_id, $quantity,$price,$payment_time,$status);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updateOrderStatus($order_id,$status){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE order SET status = ? WHERE order_id = ?");
        $stmt->bind_param("ss", $status,$order_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getTop3Products(){
        $top_3_product_arr = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT product_id , sum(quantity) as total_orders FROM order GROUP BY product_id ORDER BY total_orders DESC");
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