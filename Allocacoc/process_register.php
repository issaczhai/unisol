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

$customerMgr = new CustomerManager();
$creditMgr = new CreditManager();
$errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
// get the user FB ID if login using FB
$fbId = addslashes(filter_input(INPUT_POST, 'fbId'));
$random_no = (string)rand(0,10000000000);
$invitation_link = 'invite.php?src='.$random_no;

$pwd = addslashes(filter_input(INPUT_POST, 'pwd'));
$pwdConfirm = addslashes(filter_input(INPUT_POST, 'pwdConfirm'));
$form_data['success'] = true;
$email = addslashes(filter_input(INPUT_POST, 'email'));
$fbFirst = true;
//$register_location = '';
    
if($pwd!=$pwdConfirm){
    $form_data['success'] = false;
    $form_data['errors'] = "password re-entered is not matched!";
}else{

    $customer = $customerMgr->getCustomer($email);

    if($customer !== []){
        $form_data['success'] = false;
        $form_data['errors']  = "The email has been registered!";
        $form_data['email'] = $email;
        $form_data['pwd'] = $pwd;
        $form_data['pwdConfirm'] = $pwdConfirm;
    }
}
$verify = "false";
if($form_data['success']=="true"){
    //add into database
    $customerMgr->addCustomer($email, $pwd, $email, 0.0, $invitation_link,$verify);
    //send email to email
    $activation_code = sha1($random_no);
    $message = "To activate your account, please click on the link:\n\n";
    $message = $message."trustedbrandsonline.com/verify.php?email=".urldecode($email)."&key=$activation_code";
    mail($email, 'Registration Confirmation', $message, 'From: allocacoc@trustedbrandsonline.com');
    
    session_start();
    $form_data['status'] = "unverified";
    $form_data['email'] = $email;
    $form_data['pwd'] = $pwd;
    $form_data['pwdConfirm'] = $pwdConfirm;
    $form_data['message'] = "Thank you for registering! A confirmation email has been sent to ".$email." <br />Please click on the Activation Link to Activate your account";
//    $_SESSION["userid"] = $email;
    
//Add credit to the new signed-up account if there is credit sender information in session
//    if (isset($_COOKIE["sender_email"])){
//        $sender_email = $_COOKIE["sender_email"];
//        $creditMgr->addCredit($sender_email, $email);        
//        $customerMgr->updateCredit($email, 10.0);
//        $form_data['status'] = 'success';
//        $form_data['message'] = "Congratulations! You have got $10 credits from your friend!";
//        setcookie('sender_email','' , time()-1);
//    }
//    
//    Add cart item in temporary status into the cart of new signed-up account
//    if(isset($_SESSION['temp_product_id_to_cart']) && !empty($_SESSION['temp_product_id_to_cart'])){
//        if($productMgr->retrieveItemQtyInShoppingCart($userid, $_SESSION['temp_product_id_to_cart']) > 0){
//            $addedQty = $productMgr->retrieveItemQtyInShoppingCart($userid, $_SESSION['temp_product_id_to_cart']);
//            $totalQty = $addedQty + $_SESSION['temp_product_qty_to_cart'];
//            $productMgr->updateItemQty($userid, $_SESSION['temp_product_id_to_cart'], $totalQty);
//        }else{
//
//            $productMgr->addProductToShoppingCart($userid, $_SESSION['temp_product_id_to_cart'], $_SESSION['temp_product_qty_to_cart']);
//        }
//        
//        unset($_SESSION['temp_product_id_to_cart']);
//        unset($_SESSION['temp_product_qty_to_cart']);
//    }
    
}

//Return the data back to modal.php
echo json_encode($form_data);