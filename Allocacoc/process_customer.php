<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (session_status()!=PHP_SESSION_ACTIVE) {
	session_start();
}
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/CustomerManager.php");
$customerMgr = new CustomerManager();
$customer_id = $_SESSION["userid"];
$customer = $customerMgr->getCustomer($customer_id);

$operation = filter_input(INPUT_POST,'operation');
if($operation === 'change_information'){
    
    $first_name = filter_input(INPUT_POST,'first_name');
    $last_name = filter_input(INPUT_POST,'last_name');
    $email = filter_input(INPUT_POST,'email');
    $contact_no = filter_input(INPUT_POST,'contact_no');
    $errors='';
    if(strpos($email,'@') === false){
        $errors = 'Invalid email address!';
    }
    
    if($errors === ''){
        $customerMgr->updateCustomer($customer_id, $customer['password'], $email, $first_name, $last_name, $contact_no, $customer['credit']);
header("Location:account.php");
        echo 'jalat';
    }else{
header("Location: account.php?info_errorMsg=".$errors);
    }
    
    
}elseif($operation === 'change_password'){
    $current_password = filter_input(INPUT_POST,'password');
    $new_password = filter_input(INPUT_POST,'new_password');
    $confirm_password = filter_input(INPUT_POST,'confirm_new_password');
    $errors = '';
    if($current_password !== $customer['password']){
        $errors = 'Incorrect current password';
        
        
    }
    if($new_password !== $confirm_password){
        $errors = 'Password re-entered is not matched!';
        
    }
    if($errors === ''){
        $customerMgr->updatePassword($customer_id, $new_password);
header("Location: account.php");
    }else{
header("Location: account.php?pwd_errorMsg=".$errors);
    }
    
    
    
}