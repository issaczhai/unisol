<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactManager
 *
 * @author User
 */
class ContactManager {
    //put your code here
    function updateContact($contactId, $address, $freephone, $telephone, $fax, $email){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE contact SET address=?, freephone=?, telephone=?, fax=?, email=? WHERE contactId=?");
        $stmt->bind_param("ssssss", $address, $freephone, $telephone, $fax, $email, $contactId);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getContact($contactId){
        $contact = [];
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT * FROM contact WHERE contactId = ?");
        $stmt->bind_param("s", $contactId);
        $stmt->execute();
        $stmt->bind_result($contactId, $address, $freephone, $telephone, $fax, $email);
        while ($stmt->fetch())
        {   $contact['contactId'] = $contactId;
            $contact['address'] = $address;
            $contact['freephone'] = $freephone;
            $contact['telephone'] = $telephone;
            $contact['fax'] = $fax;
            $contact['email'] = $email;
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $contact;
    }
}
