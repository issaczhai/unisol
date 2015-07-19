<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
include_once("./Manager/CustomerManager.php");
include_once("./Manager/CreditManager.php");
$errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`

/* Validate the form on the server side */
$userid = addslashes(filter_input(INPUT_POST, 'userid'));
$pwd = addslashes(filter_input(INPUT_POST, 'pwdInput'));
$customerMgr = new CustomerManager();
$customer = $customerMgr->getCustomerByIDPassword($userid, $pwd);
$creditMgr = new CreditManager();
$productMgr = new ProductManager();

session_start();
//echo mysql_num_rows($resultSet);
if($customer !== []){
    
    $form_data['success'] = true;
    $_SESSION["userid"] = $userid;
    if (isset($_COOKIE["sender_email"])){
        $sender_email = $_COOKIE["sender_email"];
        if($sender_email !== $userid){
            $has_received = $creditMgr->checkInvitationStatus($sender_email, $userid);
            if($has_received === null){
                $creditMgr->addCredit($sender_email, $userid);        
                $customerMgr->updateCredit($userid, 10.0);
                setcookie('sender_email','' , time()-1);
                $form_data['status'] = 'success';
                $form_data['message'] = "Congratulations! You have got $10 credits from your friend!";

            }else{
                $form_data['status'] = 'fail';
                $form_data['message'] = "You have already received credit from your friend!";
                setcookie('sender_email','' , time()-1);

            }
            
        }else{
            $form_data['status'] = 'fail';
            $form_data['message'] = "Cyclic referral detected!";
            setcookie('sender_email','' , time()-1);
        }
        
    }
    if(isset($_SESSION['temp_product_id_to_cart']) && !empty($_SESSION['temp_product_id_to_cart'])){
        $stock = $productMgr->getStock($_SESSION['temp_product_id_to_cart']);
        $qty = $_SESSION['temp_product_id_to_cart'];
        $productMgr->addProductToShoppingCart($userid, $_SESSION['temp_product_id_to_cart'], $_SESSION['temp_product_qty_to_cart']);
        
        unset($_SESSION['temp_product_id_to_cart']);
        unset($_SESSION['temp_product_qty_to_cart']);
    }
}else{
    $form_data['success'] = false;
    $form_data['errors']  = "Invalid email or password!";
}

//Return the data back to modal.php
echo json_encode($form_data);