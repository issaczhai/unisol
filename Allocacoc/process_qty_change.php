<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
// define the filter type chosen before sort if any
$changed_item_id = addslashes(filter_input(INPUT_POST, 'changed_item_id'));
$qty_to_change = $_POST["qty_to_change"];
$customer_id = addslashes(filter_input(INPUT_POST, 'customer_id'));
$productMgr = new ProductManager();
$stock = $productMgr->getStock($changed_item_id);
$data_form = array();
if($stock>=$qty_to_change){
    $productMgr->updateItemQty($customer_id, $changed_item_id, $qty_to_change);
    $stock = $productMgr->getStock($changed_item_id);
    $subtotal = 0;
    $shipping_fee = 0;
    $cart_items = $productMgr->retrieveFromShoppingCart($customer_id);
    foreach($cart_items as $each_cart_product){
        $each_cart_item_id = $each_cart_product['product_id'];
        $each_cart_item_name = $productMgr->getProductName($each_cart_item_id);
        $each_cart_item_price = $productMgr->getPrice($each_cart_item_id);
        $each_cart_item_qty = $each_cart_product['quantity'];
        $each_cart_item_total = $each_cart_item_price * $each_cart_item_qty;
        $subtotal += $each_cart_item_total;
    }

    $total = $shipping_fee + $subtotal;

    $data_form['subtotal'] = number_format($subtotal,2,'.','');
    $data_form['shipping_fee'] = number_format($shipping_fee,2,'.','');
    $data_form['total'] = number_format($total,2,'.','');
    $data_form['error'] = false;
    
}else{
    $data_form['error'] = true;
}


echo json_encode($data_form);