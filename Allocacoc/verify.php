<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On');
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
include_once("./Manager/CustomerManager.php");
include_once("./Manager/CreditManager.php");
$customerMgr = new CustomerManager();
$creditMgr = new CreditManager();
$productMgr = new ProductManager();
$email='';
$key='';
if(isset($_GET['email'])){
    $email = $_GET['email'];
}
if(isset($_GET['key'])){
    $key = $_GET['key'];
}
$invitation_link = $customerMgr->getInvitationLink($email);
$retrieved_key = substr($invitation_link,strpos($invitation_link,"=")+1);
if(md5($retrieved_key)===$key){
session_start();
    $customerMgr->activateAccount($email);
    $_SESSION["userid"] = $email;
    $form_data['status'] = 'success';
    $form_data['message'] = "";
//Add credit to the new signed-up account if there is credit sender information in session
    if (isset($_COOKIE["sender_email"])){
        $sender_email = $_COOKIE["sender_email"];
        $creditMgr->addCredit($sender_email, $email);        
        $customerMgr->updateCredit($email, 10.0);
        $form_data['status'] = 'success';
        $form_data['message'] = "Congratulations! You have got $10 credits from your friend!";
        setcookie('sender_email','' , time()-1);
    }
//    Add cart item in temporary status into the cart of new signed-up account
    if(isset($_SESSION['temp_product_id_to_cart']) && !empty($_SESSION['temp_product_id_to_cart'])){
        if($productMgr->retrieveItemQtyInShoppingCart($userid, $_SESSION['temp_product_id_to_cart']) > 0){
            $addedQty = $productMgr->retrieveItemQtyInShoppingCart($userid, $_SESSION['temp_product_id_to_cart']);
            $totalQty = $addedQty + $_SESSION['temp_product_qty_to_cart'];
            $productMgr->updateItemQty($userid, $_SESSION['temp_product_id_to_cart'], $totalQty);
        }else{
            $productMgr->addProductToShoppingCart($userid, $_SESSION['temp_product_id_to_cart'], $_SESSION['temp_product_qty_to_cart']);
        } 
        unset($_SESSION['temp_product_id_to_cart']);
        unset($_SESSION['temp_product_qty_to_cart']);
    }
    if($form_data['message']!=""){
        header('location: index.php?status='.$form_data['status'].'&message='.$form_data['message']);
    }else{
        header('location: index.php?');
    }
    
}else{
    header('location: test.php');
}