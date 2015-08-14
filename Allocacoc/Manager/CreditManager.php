<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreditManager
 *
 * @author User
 */
class CreditManager {
    //put your code here
    
    function addCredit($sender_id,$receiver_id){
        $status = 'false';
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO credit_history (sender_id, receiver_id, status) VALUES (? ,? ,?)");
        $stmt->bind_param("sss",$sender_id,$receiver_id,$status);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updateCreditStatusToTrue($sender_id,$receiver_id){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE credit_history SET status = ? WHERE sender_id = ? AND receiver_id = ?");
        $stmt->bind_param("sss","true",$sender_id,$receiver_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getNoOfInvitation(){
        $no_of_invitation = 0;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT count(*) as no FROM credit_history");
        $stmt->execute();
        $stmt-> bind_result($no);
        while ($stmt-> fetch())
        {
            $no_of_invitation = $no;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $no_of_invitation;
    }
    
    function checkInvitationStatus($sender_id,$receiver_id){
        $status = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT status FROM credit_history WHERE sender_id = ? AND receiver_id = ?");
        $stmt->bind_param("ss",$sender_id,$receiver_id);
        $stmt->execute();
        $stmt-> bind_result($status);
        while ($stmt-> fetch())
        {
            $status = $status;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        # status = null: no such invitation exist
        # status = 'false': receiver has received credit but have not used
        # status = 'true': receiver has received and used credit AND sender received return credit
        return $status;
    }
    
    function getUnusedCreditListByReceiverId($receiver_id){
        $creditList = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT sender_id, receiver_id FROM credit_history WHERE receiver_id = ? AND status = false");
        $stmt->bind_param("s",$receiver_id);
        $stmt->execute();
        $stmt-> bind_result($sender_id,$receiver_id);
        while ($stmt-> fetch())
        {
            $credit=[];
            $credit["sender_id"] = $sender_id;
            $credit["receiver_id"] = $receiver_id;
            array_push($creditList, $credit);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $creditList;
    }
}