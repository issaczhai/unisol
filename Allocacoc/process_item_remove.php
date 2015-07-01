<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
// define the filter type chosen before sort if any
$remove_item_id = addslashes(filter_input(INPUT_GET, 'remove_item_id'));
$customer_id = addslashes(filter_input(INPUT_GET, 'customer_id'));

$productMgr = new ProductManager();
$productMgr->deleteCartItem($customer_id, $remove_item_id);
header("Location: ./cart.php");