<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerManager
 *
 * @author User
 */
class CustomerManager {
    //put your code here
    function addCustomer($customer_id,$customer_password,$alternative_email,$credit,$invitation_link,$verify){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $first_name = "";
        $last_name = "";
        $contact_no = "";
        $stmt = $conn->prepare("INSERT INTO customer (customer_id,password,alternative_email,first_name,last_name,contact_no,credit,invitation_link,verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("ssssssdss", $customer_id,$customer_password,$alternative_email,$first_name,$last_name,$contact_no,$credit,$invitation_link,$verify);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getPassword($customer_id){
        $customer_password = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT password FROM customer WHERE customer_id=?");
        $stmt->bind_param("s", $customer_id);
        $stmt->execute();
        $stmt->bind_result($password);
        while ($stmt->fetch())
        {
            $customer_password = $password;

        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $customer_password;
    }
    
    function getEmail($customer_id){
        $email = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT alternative_email FROM customer WHERE customer_id=?");
        $stmt->bind_param("s", $customer_id);
        $stmt->execute();
        $stmt->bind_result($alternative_email);
        while ($stmt->fetch())
        {
            $email = $alternative_email;

        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $email;
    }
    
    function getFirstName($customer_id){
        $first_name = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT first_name FROM customer WHERE customer_id=?");
        $stmt->bind_param("s", $customer_id);
        $stmt->execute();
        $stmt->bind_result($first_name);
        while ($stmt->fetch())
        {
            $first_name = $first_name;

        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $first_name;
    }
    
    function getLastName($customer_id){
        $last_name = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT last_name FROM customer WHERE customer_id=?");
        $stmt->bind_param("s", $customer_id);
        $stmt->execute();
        $stmt->bind_result($last_name);
        while ($stmt->fetch())
        {
            $last_name = $last_name;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $last_name;
    }
    
    function getContactNo($customer_id){
        $contact_no = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT contact_no FROM customer WHERE customer_id=?");
        $stmt->bind_param("s", $customer_id);
        $stmt->execute();
        $stmt->bind_result($contact_no);
        while ($stmt->fetch())
        {
            $contact_no = $contact_no;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $contact_no;
    }
    
    function getCredit($customer_id){
        $credit = 0.0;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT credit FROM customer WHERE customer_id=?");
        $stmt->bind_param("s", $customer_id);
        $stmt->execute();
        $stmt->bind_result($credit);
        while ($stmt->fetch())
        {
            $credit = $credit;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $credit;
    }
    
    function updateCredit($customer_id,$amt){
        $credit = 0.0;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT credit FROM customer WHERE customer_id=?");
        $stmt->bind_param("s", $customer_id);
        $stmt->execute();
        $stmt->bind_result($credit);
        while ($stmt->fetch())
        {
            $credit = floatval($credit);
        }
        $credit+=$amt;
        
        $stmt = $conn->prepare("UPDATE customer SET credit=? WHERE customer_id=?");
        $stmt->bind_param("ds",$credit,$customer_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
        
    }
    
    
    function getInvitationLink($customer_id){
        $invitation_link = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT invitation_link FROM customer WHERE customer_id=?");
        $stmt->bind_param("s", $customer_id);
        $stmt->execute();
        $stmt->bind_result($invitation_link);
        while ($stmt->fetch())
        {
            $invitation_link = $invitation_link;

        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $invitation_link;
    }
    
    function getCustomer($customer_id){
        $customer = [];
        $verify="true";
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM customer WHERE customer_id=? AND verified = ?");
        $stmt->bind_param("ss", $customer_id,$verify);
        $stmt->execute();
        $stmt->bind_result($customer_id,$password,$alternative_email,$first_name,$last_name,$contact_no,$credit,$invitation_link,$verified);
        while ($stmt->fetch())
        {   $customer['customer_id'] = $customer_id;
            $customer['password'] = $password;
            $customer['email'] = $alternative_email;
            $customer['first_name'] = $first_name;
            $customer['last_name'] = $last_name;
            $customer['contact_no'] = $contact_no;
            $customer['credit'] = $credit;
            $customer['invitation_link'] = $invitation_link;

        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $customer;
    }
    
    function getCustomerByEmail($email){
        $customer = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM customer WHERE alternative_email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($customer_id,$password,$alternative_email,$first_name,$last_name,$contact_no,$credit,$invitation_link);
        while ($stmt->fetch())
        {   $customer['customer_id'] = $customer_id;
            $customer['password'] = $password;
            $customer['email'] = $alternative_email;
            $customer['first_name'] = $first_name;
            $customer['last_name'] = $last_name;
            $customer['contact_no'] = $contact_no;
            $customer['credit'] = $credit;
            $customer['invitation_link'] = $invitation_link;

        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $customer;
    }
    
    function getCustomerByIDPassword($customer_id,$password){
        $customer = [];
        $verify="true";
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM customer WHERE customer_id=? AND password=? AND verified = ?");
        $stmt->bind_param("sss", $customer_id,$password,$verify);
        $stmt->execute();
        $stmt->bind_result($customer_id,$password,$alternative_email,$first_name,$last_name,$contact_no,$credit,$invitation_link,$verify);
        while ($stmt->fetch())
        {   $customer['customer_id'] = $customer_id;
            $customer['password'] = $password;
            $customer['email'] = $alternative_email;
            $customer['first_name'] = $first_name;
            $customer['last_name'] = $last_name;
            $customer['contact_no'] = $contact_no;
            $customer['credit'] = $credit;
            $customer['invitation_link'] = $invitation_link;
            $customer['verify'] = $verify;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $customer;
    }
    
    function getCustomerByInvitationLink($invitation_link){
        $customer = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM customer WHERE invitation_link=?");
        $stmt->bind_param("s", $invitation_link);
        $stmt->execute();
        $stmt->bind_result($customer_id,$password,$alternative_email,$first_name,$last_name,$contact_no,$credit,$invitation_link);
        while ($stmt->fetch())
        {   $customer['customer_id'] = $customer_id;
            $customer['password'] = $password;
            $customer['email'] = $alternative_email;
            $customer['first_name'] = $first_name;
            $customer['last_name'] = $last_name;
            $customer['contact_no'] = $contact_no;
            $customer['credit'] = $credit;
            $customer['invitation_link'] = $invitation_link;

        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $customer;
    }
    
    
    function updateCustomer($customer_id,$customer_password,$altenative_email,$first_name,$last_name,$contact_no,$credit){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE customer SET password=?,alternative_email=?,first_name=?,last_name=?,contact_no=?,credit=? WHERE customer_id = ?");
        $stmt->bind_param("sssssds", $customer_password,$altenative_email,$first_name,$last_name,$contact_no,$credit,$customer_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updatePassword($customer_id,$customer_password){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE customer SET password=? WHERE customer_id = ?");
        $stmt->bind_param("ss", $customer_password,$customer_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function activateAccount($customer_id){
        $verified="true";
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE customer SET verified=? WHERE customer_id = ?");
        $stmt->bind_param("ss", $verified,$customer_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
}