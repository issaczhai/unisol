<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddressManager
 *
 * @author User
 */
class AddressManager {
    //put your code here
    function addAddress($address_no,$customer_id,$first_name,$last_name,$street,$block_no,$floor,$unit,$building_name,$company_name,$postal_code,$instruction){
        
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO address (address_no,customer_id,first_name,last_name,street,block_no,floor,unit,building_name,company_name,postal_code,instruction) VALUES (?, ? ,? ,?, ?, ? ,? ,?, ?, ? ,? ,?)");
        $stmt->bind_param("ssssssssssss",$address_no,$customer_id,$first_name,$last_name,$street,$block_no,$floor,$unit,$building_name,$company_name,$postal_code,$instruction);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function deleteAddress($address_no,$customer_id){
    	
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE * FROM address WHERE address_no = ? AND customer_id = ?");
        $stmt->bind_param("ss",$address_no,$customer_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getAddress($customer_id){
        $address_list = [];
        
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM address WHERE customer_id=?");
        $stmt->bind_param("s", $customer_id);
        $stmt->execute();
        $stmt->bind_result($address_no,$customer_id,$first_name,$last_name,$street,$block_no,$floor,$unit,$building_name,$company_name,$postal_code,$instruction);
        $count=0;
        while ($stmt->fetch())
        {   $address = [];
            $address['address_no'] = $address_no;
            $address['customer_id'] = $customer_id;
            $address['first_name'] = $first_name;
            $address['last_name'] = $last_name;
            $address['street'] = $street;
            $address['block_no'] = $block_no;
            $address['floor'] = $floor;
            $address['unit'] = $unit;
            $address['building_name'] = $building_name;
            $address['company_name'] = $company_name;
            $address['postal_code'] = $postal_code;
            $address['instruction'] = $instruction;
            $address_list[$count]=$address;
            $count+=1;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $address_list;
    }
    
    function getGeneralAddress($customer_id,$address_no){
        
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM address WHERE customer_id=? AND address_no=?");
        $stmt->bind_param("si", $customer_id,$address_no);
        $stmt->execute();
        $stmt->bind_result($address_no,$customer_id,$first_name,$last_name,$street,$block_no,$floor,$unit,$building_name,$company_name,$postal_code,$instruction);
        $address = '';
        while ($stmt->fetch())
        {   
            $address =  $floor.'-'.$unit.' Blk'.$block_no.' '.$building_name.' '.$street.' Singapore '.$postal_code;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $address;
    }
    
    function getPostalCode($customer_id,$address_no){
        
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT postal_code FROM address WHERE customer_id=? AND address_no=?");
        $stmt->bind_param("si", $customer_id,$address_no);
        $stmt->execute();
        $stmt->bind_result($postal_code);
        $postalcode = '';
        while ($stmt->fetch())
        {   
            $postalcode = $postal_code;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $postalcode;
    }
}