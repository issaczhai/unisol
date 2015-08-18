<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductManager
 *
 * @author User
 */
class ProductManager {
    
    //put your code here
    

    function addProduct($product_id, $product_name, $price, $color, $description, $stock){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO product (product_id, product_name, price, color, description, stock) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssd", $product_id, $product_name, $price, $color, $description, $stock);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    
    function addProductToShoppingCart($customer_id,$product_id,$qty){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO cart (customer_id, product_id, quantity, create_time, pay_time) VALUES (?, ?, ?, ?, ?)");
        date_default_timezone_set('Asia/Singapore');
        $creat_time = date('Y-m-d H:i:s');
        $date = new DateTime('2000-01-01');
        $pay_time = $date->format('Y-m-d H:i:s');
        $stmt->bind_param("ssiss", $customer_id, $product_id, $qty, $creat_time, $pay_time);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updateShoppingCartPayTime($customer_id,$product_id,$create_time){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE cart SET pay_time = ? WHERE customer_id = ? AND product_id = ? AND create_time = ?");
        date_default_timezone_set('Asia/Singapore');
        $pay_time= date('Y-m-d H:i:s');
        $stmt->bind_param("ssss", $pay_time, $customer_id, $product_id,$create_time);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function retrieveFromShoppingCart($customer_id){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $shopping_cart_products = array();
        $date = new DateTime('2000-01-01');
        $var = $date->format('Y-m-d H:i:s');
        $stmt = $conn->prepare("SELECT * FROM cart WHERE customer_id=? AND pay_time = ? ORDER BY create_time desc");
        $stmt->bind_param("ss", $customer_id,$var);
        $stmt->execute();
        $stmt->bind_result($customer_id,$product_id,$quantity,$create_time,$pay_time);
        while ($stmt->fetch())
        {
            $product = array();
            $product['customer_id'] = $customer_id;
            $product['product_id'] = $product_id;
            $product['quantity'] = $quantity;
            $product['create_time'] = $create_time;
            $product['pay_time'] = $pay_time;
            array_push($shopping_cart_products,$product);
        }
        
        return $shopping_cart_products;
    }
    
    function retrieveTotalNumberOfItemsInShoppingCart($customer_id){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $total = 0;
        $date = new DateTime('2000-01-01');
        $var = $date->format('Y-m-d H:i:s');
        $stmt = $conn->prepare("SELECT quantity FROM cart WHERE customer_id=? AND pay_time = ?");
        $stmt->bind_param("ss", $customer_id,$var);
        $stmt->execute();
        $stmt->bind_result($quantity);
        while ($stmt->fetch())
        {
            $total = $total+$quantity;
        }
        return $total;
    }
    
    function retrieveTotalNumberOfUniqueItemsInShoppingCart($customer_id){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $total = 0;
        $date = new DateTime('2000-01-01');
        $var = $date->format('Y-m-d H:i:s');
        $stmt = $conn->prepare("SELECT count(*) FROM cart WHERE customer_id = ? AND pay_time = ?");
        $stmt->bind_param("ss", $customer_id,$var);
        $stmt->execute();
        $stmt->bind_result($quantity);
        while ($stmt->fetch())
        {
            $total = $quantity;
        }
        return $total;
    }
    
    function retrieveItemQtyInShoppingCart($customer_id,$product_id){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $productQty = 0;
        $date = new DateTime('2000-01-01');
        $var = $date->format('Y-m-d H:i:s');
        $stmt = $conn->prepare("SELECT count(*) FROM cart WHERE customer_id=? AND product_id=? AND pay_time = ?");
        $stmt->bind_param("sss", $customer_id,$product_id,$var);
        $stmt->execute();
        $stmt->bind_result($quantity);
        while ($stmt->fetch())
        {
            $productQty = $quantity;
        }
        return $productQty;
    }
    
    function updateItemQty($customer_id,$item_id, $changed_qty){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $date = new DateTime('2000-01-01');
        $var = $date->format('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE cart SET quantity=? WHERE customer_id=? AND product_id=? AND pay_time = ?");
        $stmt->bind_param("isss", $changed_qty, $customer_id, $item_id, $var);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function deleteCartItem($customer_id,$item_id){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $date = new DateTime('2000-01-01');
        $var = $date->format('Y-m-d H:i:s');
        $stmt = $conn->prepare("DELETE from cart WHERE customer_id=? AND product_id=? AND pay_time=?");
        $stmt->bind_param("sss",$customer_id, $item_id,$var);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getStock($product_id){
        $stock = 0;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT stock FROM product WHERE product_id=?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($stock);
        while ($stmt->fetch())
        {
            $stock = $stock;
            
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $stock;
    }
    
    function getProductName($product_id){
        $product_name = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT product_name FROM product WHERE product_id=?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($product_name);
        while ($stmt->fetch())
        {
            $product_name = $product_name;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $product_name;
    }
    
    
    function getDescription($product_id){
        $description = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT description FROM product WHERE product_id=?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($description);
        while ($stmt->fetch())
        {
            $description = $description;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $description;
    }
    
    function getPrice($product_id){
        $price = 0.0;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT price FROM product WHERE product_id=?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($price);
        while ($stmt->fetch())
        {
            $price = $price;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $price;
    }
    
    function getColor($product_id){
        $color = 0.0;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT color FROM product WHERE product_id=?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($color);
        while ($stmt->fetch())
        {
            $color = $color;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $color;
    }
    
    function getProduct($product_id){
        $product = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM product WHERE product_id=?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($product_id,$product_name,$price,$color,$description,$stock);
        while ($stmt->fetch())
        {   $product['product_id'] = $product_id;
            $product['product_name'] = $product_name;
            $product['price'] = $price;
            $product['color'] = $color;
            $product['description'] = $description;
            $product['stock'] = $stock;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $product;
    }
    
    function getAllProduct(){
        $product_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT * FROM product");
        $stmt->execute();
        $stmt->bind_result($product_id,$product_name,$price,$color,$description,$stock);
        while ($stmt->fetch())
        {   $product = array();
            $product['product_id'] = $product_id;
            $product['product_name'] = $product_name;
            $product['price'] = $price;
            $product['color'] = $color;
            $product['description'] = $description;
            $product['stock'] = $stock;
            array_push($product_arr,$product);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $product_arr;
    }
    
    function updateProduct($product_id, $product_name, $price, $color, $description, $stock){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE product SET product_name=?, price=?, color=?, description=?, stock=? WHERE product_id=?");
        $stmt->bind_param("ssssds", $product_name, $price, $color, $description, $stock,$product_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function filterProduct($filter_type){
        $product_arr = [];
        $filter_para = '%'.$filter_type.'%';
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM product WHERE product_name LIKE ?");
        $stmt->bind_param("s", $filter_para);
        $stmt->execute();
        $stmt->bind_result($product_id,$product_name,$price,$color,$description,$stock);
        while ($stmt->fetch())
        {   $product = array();
            $product['product_id'] = $product_id;
            $product['product_name'] = $product_name;
            $product['price'] = $price;
            $product['color'] = $color;
            $product['description'] = $description;
            $product['stock'] = $stock;
            array_push($product_arr,$product);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $product_arr;
    }
    
    function sortWithFilter($filter_type,$sort_type){
        $product_arr = [];
        $filter_para = '%'.$filter_type.'%';
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM product WHERE product_name LIKE ? ORDER BY price $sort_type");
        $stmt->bind_param("s", $filter_para);
        $stmt->execute();
        $stmt->bind_result($product_id,$product_name,$price,$color,$description,$stock);
        while ($stmt->fetch())
        {   $product = array();
            $product['product_id'] = $product_id;
            $product['product_name'] = $product_name;
            $product['price'] = $price;
            $product['color'] = $color;
            $product['description'] = $description;
            $product['stock'] = $stock;
            array_push($product_arr,$product);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $product_arr;
    }
    
    function sortAll($sort_type){
        $product_arr = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM product ORDER BY price $sort_type");
        $stmt->execute();
        $stmt->bind_result($product_id,$product_name,$price,$color,$description,$stock);
        while ($stmt->fetch())
        {   $product = array();
            $product['product_id'] = $product_id;
            $product['product_name'] = $product_name;
            $product['price'] = $price;
            $product['color'] = $color;
            $product['description'] = $description;
            $product['stock'] = $stock;
            array_push($product_arr,$product);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $product_arr;
    }
}