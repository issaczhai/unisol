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
    

    function addProduct($product_id, $product_name, $symbol_code, $price, $color, $description, $stock){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO product (product_id, product_name, symbol_code, price, color, description, stock) VALUES (?,?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssd", $product_id, $product_name, $symbol_code, $price, $color, $description, $stock);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    
    function addProductToShoppingCart($customer_id,$product_id,$qty, $color){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO cart (customer_id, product_id, color, quantity, create_time, pay_time) VALUES (?, ?, ?, ?, ?, ?)");
        date_default_timezone_set('Asia/Singapore');
        $creat_time = date('Y-m-d H:i:s');
        $date = new DateTime('2000-01-01');
        $pay_time = $date->format('Y-m-d H:i:s');
        $stmt->bind_param("sssiss", $customer_id, $product_id, $color, $qty, $creat_time, $pay_time);
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
        $stmt->bind_result($customer_id,$product_id,$color,$quantity,$create_time,$pay_time);
        while ($stmt->fetch())
        {
            $product = array();
            $product['customer_id'] = $customer_id;
            $product['product_id'] = $product_id;
            $product['color'] = $color;
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
    
    function retrieveItemQtyInShoppingCart($customer_id,$product_id, $color){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $productQty = 0;
        $date = new DateTime('2000-01-01');
        $var = $date->format('Y-m-d H:i:s');
        $stmt = $conn->prepare("SELECT quantity FROM cart WHERE customer_id=? AND product_id=? AND color=? AND pay_time = ?");
        $stmt->bind_param("ssss", $customer_id,$product_id,$color,$var);
        $stmt->execute();
        $stmt->bind_result($quantity);
        while ($stmt->fetch())
        {
            $productQty = $quantity;
        }
        return $productQty;
    }
    
    function updateItemQty($customer_id, $color, $item_id, $changed_qty){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $date = new DateTime('2000-01-01');
        $var = $date->format('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE cart SET quantity=? WHERE customer_id=? AND product_id=? AND color=? AND pay_time = ?");
        $stmt->bind_param("issss", $changed_qty, $customer_id, $item_id, $color, $var);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function deleteCartItem($customer_id,$item_id, $color){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $date = new DateTime('2000-01-01');
        $var = $date->format('Y-m-d H:i:s');
        $stmt = $conn->prepare("DELETE from cart WHERE customer_id=? AND product_id=? AND color=?");
        $stmt->bind_param("sss",$customer_id, $item_id, $color);
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
    
    function updateColor($product_id,$new_color_string){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE product SET color = ? WHERE product_id=?");
        $stmt->bind_param("ss",$new_color_string,$product_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getProductSymbolCode($product_id){
        $code = "";
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT symbol_code FROM product WHERE product_id=?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($symbol_code);
        while ($stmt->fetch())
        {
            $code = $symbol_code;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $code;
    }
    
    function getProduct($product_id){
        $product = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM product WHERE product_id=?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($product_id,$product_name,$symbol_code,$price,$color,$description,$stock);
        while ($stmt->fetch())
        {   $product['product_id'] = $product_id;
            $product['product_name'] = $product_name;
            $product['symbol_code'] = $symbol_code;
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
        $stmt->bind_result($product_id,$product_name,$symbol_code,$price,$color,$description,$stock);
        while ($stmt->fetch())
        {   $product = array();
            $product['product_id'] = $product_id;
            $product['product_name'] = $product_name;
            $product['symbol_code'] = $symbol_code;
            $product['price'] = $price;
            $product['color'] = $color;
            $product['description'] = $description;
            $product['stock'] = $stock;
            array_push($product_arr,$product);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $product_arr;
    }
    
    function updateProduct($product_id, $product_name, $symbol_code, $price, $color, $description, $stock){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE product SET product_name=?, symbol_code=?, price=?, color=?, description=?, stock=? WHERE product_id=?");
        $stmt->bind_param("sssssds", $product_name, $symbol_code, $price, $color, $description, $stock,$product_id);
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
        $stmt->bind_result($product_id,$product_name,$symbol_code,$price,$color,$description,$stock);
        while ($stmt->fetch())
        {   $product = array();
            $product['product_id'] = $product_id;
            $product['product_name'] = $product_name;
            $product['symbol_code'] = $symbol_code;
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
        $stmt->bind_result($product_id,$product_name,$symbol_code,$price,$color,$description,$stock);
        while ($stmt->fetch())
        {   $product = array();
            $product['product_id'] = $product_id;
            $product['product_name'] = $product_name;
            $product['symbol_code'] = $symbol_code;
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
        $stmt->bind_result($product_id,$product_name,$symbol_code,$price,$color,$description,$stock);
        while ($stmt->fetch())
        {   $product = array();
            $product['product_id'] = $product_id;
            $product['product_name'] = $product_name;
            $product['symbol_code'] = $symbol_code;
            $product['price'] = $price;
            $product['color'] = $color;
            $product['description'] = $description;
            $product['stock'] = $stock;
            array_push($product_arr,$product);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $product_arr;
    }
    
    function addProductColorOptionalCode($product_id, $color, $color_optional_code){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO optional_code (product_id, color, optional_code) VALUES (?,?, ?)");
        $stmt->bind_param("sss", $product_id, $color, $color_optional_code);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updateProductColorOptionalCode($product_id, $color, $color_optional_code){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE optional_code SET optional_code = ? WHERE product_id = ? AND color = ?");
        $stmt->bind_param("sss", $color_optional_code, $product_id, $color);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getAllColorOptionalCodeByProduct($product_id){
        $fullList = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT color, optional_code FROM optional_code WHERE product_id=?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($color, $optional_code);
        while ($stmt-> fetch())
        {   
            $fullList[$color] = $optional_code;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $fullList;
    }
    
    function getColorOptionalCodeByProductColor($product_id,$color){
        $code = '';
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT optional_code FROM optional_code WHERE product_id = ? AND color = ?");
        $stmt->bind_param("ss", $product_id,$color);
        $stmt->execute();
        $stmt->bind_result($optional_code);
        while ($stmt-> fetch())
        {   
            $code = $optional_code;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $code;
    }
    
    function deleteColorOptionalCodeByProductColor($product_id,$color){
        $code = '';
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM optional_code WHERE product_id = ? AND color = ?");
        $stmt->bind_param("ss", $product_id,$color);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getFullCodeByProductColor($product_id,$color){
        $product = self::getProductSymbolCode($product_id);
        $color_code = '';
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT optional_code FROM optional_code WHERE product_id = ? AND color = ?");
        $stmt->bind_param("ss", $product_id,$color);
        $stmt->execute();
        $stmt->bind_result($optional_code);
        while ($stmt-> fetch())
        {   
            $color_code = $optional_code;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $product."-".$color_code;
    }
    
    function updateColorInOptionalCodeTable($product_id,$new_color,$old_color){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE optional_code SET color = ? WHERE product_id = ? AND color = ?");
        $stmt->bind_param("sss", $new_color, $product_id, $old_color);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
}