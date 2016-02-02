<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyManager
 *
 * @author User
 */
class CompanyManager {
    
    //put your code here
    

    function addCompany($companyID, $username, $password, $address, $contactPersonName,$contactPersonEmail,$contactPersonTel, $contactPersonFax, $registrationID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO company (companyID, username, password, address, contactPersonName,contactPersonEmail,contactPersonTel, contactPersonFax, registrationID) VALUES (?,?, ?,?,?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss",$companyID, $username, $password, $address, $contactPersonName,$contactPersonEmail,$contactPersonTel, $contactPersonFax, $registrationID);
        
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function deleteCompany($companyID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM company WHERE companyID = ?");
        $stmt->bind_param("s", $companyID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getCompany($companyID){
        $company = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM company WHERE companyID=?");
        $stmt->bind_param("s", $companyID);
        $stmt->execute();
        $stmt->bind_result($companyID, $username, $password, $address, $contactPersonName,$contactPersonEmail,$contactPersonTel, $contactPersonFax, $registrationID);
        while ($stmt->fetch())
        {   $company['companyID'] = $companyID;
            $company['username'] = $username;
            $company['password'] = $password;
            $company['address'] = $address;
            $company['contactPersonName'] = $contactPersonName;
            $company['contactPersonEmail'] = $contactPersonEmail;
            $company['contactPersonTel'] = $contactPersonTel;
            $company['contactPersonFax'] = $contactPersonFax;
            $company['registrationID'] = $registrationID;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $company;
    }

     function getCompanyContact($companyID){
        $contact = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT contactPersonName,contactPersonEmail,contactPersonTel, contactPersonFax FROM company WHERE companyID=?");
        $stmt->bind_param("s", $companyID);
        $stmt->execute();
        $stmt->bind_result($contactPersonName,$contactPersonEmail,$contactPersonTel, $contactPersonFax);
        while ($stmt->fetch())
        {   
            $contact['contactPersonName'] = $contactPersonName;
            $contact['contactPersonEmail'] = $contactPersonEmail;
            $contact['contactPersonTel'] = $contactPersonTel;
            $contact['contactPersonFax'] = $contactPersonFax;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $contact;
    }
    
    function getCompanyAddress($companyID){
        $address = "";
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT address FROM company WHERE companyID=?");
        $stmt->bind_param("s", $companyID);
        $stmt->execute();
        $stmt->bind_result($a);
        while ($stmt->fetch())
        {   
            $address = $a;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $address;
    }

    function getCompanyByEmail($contactPersonEmail){
        $company = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM company WHERE contactPersonEmail=?");
        $stmt->bind_param("s", $contactPersonEmail);
        $stmt->execute();
        $stmt->bind_result($companyID, $username, $password, $address, $contactPersonName,$contactPersonEmail,$contactPersonTel, $contactPersonFax, $registrationID);
        while ($stmt->fetch())
        {   $company['companyID'] = $companyID;
            $company['username'] = $username;
            $company['password'] = $password;
            $company['address'] = $address;
            $company['contactPersonName'] = $contactPersonName;
            $company['contactPersonEmail'] = $contactPersonEmail;
            $company['contactPersonTel'] = $contactPersonTel;
            $company['contactPersonFax'] = $contactPersonFax;
            $company['registrationID'] = $registrationID;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $company;
    }

    function getPasswordByEmail($contactPersonEmail){
        $company_password = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT password FROM company WHERE contactPersonEmail=?");
        $stmt->bind_param("s", $contactPersonEmail);
        $stmt->execute();
        $stmt->bind_result($password);
        while ($stmt->fetch())
        {   
            $company_password = $password;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $company_password;
    }
    
    function getCompanyList(){
        $company_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT * FROM company");
        $stmt->execute();
        $stmt->bind_result($companyID, $username, $password, $address, $contactPersonName,$contactPersonEmail,$contactPersonTel, $contactPersonFax, $registrationID);
        while ($stmt->fetch())
        {   $company = array();
            $company['companyID'] = $companyID;
            $company['username'] = $username;
            $company['password'] = $password;
            $company['address'] = $address;
            $company['contactPersonName'] = $contactPersonName;
            $company['contactPersonEmail'] = $contactPersonEmail;
            $company['contactPersonTel'] = $contactPersonTel;
            $company['contactPersonFax'] = $contactPersonFax;
            $company['registrationID'] = $registrationID;
            array_push($company_arr,$company);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $company_arr;
    }
    
    function updateCompany($companyID, $username, $password, $address, $contactPersonName,$contactPersonEmail,$contactPersonTel, $contactPersonFax, $registrationID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE company SET username=?, password=?, address=?, contactPersonName=?, contactPersonEmail=?, contactPersonTel=? ,contactPersonFax=?, registrationID=? WHERE companyID=?");
        $stmt->bind_param("sssssssss", $username, $password, $address, $contactPersonName,$contactPersonEmail,$contactPersonTel, $contactPersonFax, $registrationID,$companyID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }

     function updateCompanyContact($companyID,$contactPersonName,$contactPersonEmail,$contactPersonTel, $contactPersonFax){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE company SET contactPersonName=?, contactPersonEmail=?, contactPersonTel=? ,contactPersonFax=? WHERE companyID=?");
        $stmt->bind_param("sssss", $contactPersonName,$contactPersonEmail,$contactPersonTel, $contactPersonFax,$companyID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updateCompanyAddress($companyID,$address){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE company SET address=? WHERE companyID=?");
        $stmt->bind_param("ss", $address,$companyID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }

     function resetPassword($companyID,$password){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE company SET password=? WHERE companyID=?");
        $stmt->bind_param("ss", $password, $companyID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
}
