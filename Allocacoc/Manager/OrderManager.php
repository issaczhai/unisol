<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OrderManager {
    
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