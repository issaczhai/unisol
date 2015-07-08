<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
$product_id = addslashes(filter_input(INPUT_POST, 'selected_product_id'));
$qty = addslashes(filter_input(INPUT_POST, 'qty'));
//$url = filter_input(INPUT_POST, 'url');
//print_r($url);
$productMgr = new ProductManager();
$stock = $productMgr->getStock($product_id);
session_start();
$userid = null;
$cart_data = array();

if(!empty($_SESSION["userid"])){
    // $userid is customer email address
    $userid = $_SESSION["userid"];
    $cart_data['error_not_logged_in']=false;
    //add product to the shopping cart
    $productMgr->addProductToShoppingCart($userid, $product_id, $qty);

    //get the number of item in customer's shopping cart
    $cart_qty = $productMgr->retrieveTotalNumberOfItemsInShoppingCart($userid);
    $cart_unique_qty = $productMgr->retrieveTotalNumberOfUniqueItemsInShoppingCart($userid);
    $item_qty = $productMgr->retrieveItemQtyInShoppingCart($userid, $product_id);
    $product_name = $productMgr->getProductName($product_id);
    $cart_data['cart_qty'] = $cart_qty;
    $cart_data['cart_unique_qty'] = $cart_unique_qty;
    $cart_data['add_item_id'] = $product_id;
    $cart_data['item_qty'] = $item_qty;
    $cart_data['product_name'] = $product_name;
    $cart_data['userid'] = $userid;
}else{
    $cart_data['error_not_logged_in']=true;
    
    $_SESSION['temp_product_id_to_cart'] = $product_id;
    $_SESSION['temp_product_qty_to_cart'] = $qty;
    /*
    $url=$url.'?user=no';
    header("Location: $url");
    exit;
    */
}

echo json_encode($cart_data);