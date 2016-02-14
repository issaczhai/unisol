<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FdpManager
 *
 * @author User
 */
class StudentStatusManager {

    function addStudentStatus($studentID, $courseID, $sessionID, $certificatePath, $status){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO studentstatus (studentID, courseID, sessionID, certificate, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $studentID,$courseID,$sessionID,$certificatePath,$status);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }

    //put your code herefunction getCharge(){
    function getStudentStatus($studentID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $courseIDList = [];
        $stmt = $conn->prepare("SELECT courseID, sessionID, certificate, status FROM studentstatus WHERE studentID = ?");
        $stmt->bind_param("s", $studentID);
        $stmt->execute();
        $stmt->bind_result($courseID, $sessionID, $certificate, $status);
        while ($stmt->fetch())
        {   
            $pair = [];
            $pair['courseID'] = $courseID;
            $pair['sessionID'] = $sessionID;
            $pair['certificate'] = $certificate;
            $pair['status'] = $status;
            array_push($courseIDList, $pair);
        }
        
        $ConnectionManager->closeConnection($stmt, $conn);
        return $courseIDList;
    }
    
    function checkStatusByStudentCourse($studentID,$courseID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $status = '';
        $stmt = $conn->prepare("SELECT status FROM studentstatus WHERE studentID=? AND courseID = ?");
        $stmt->bind_param("ss", $studentID,$courseID);
        $stmt->execute();
        $stmt->bind_result($s);
        while ($stmt->fetch())
        {   
            $status=$s;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $status;
    }
   
    function getList($s){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $result = array();
        $stmt = $conn->prepare("SELECT * FROM studentstatus WHERE status = ?");
        $stmt->bind_param("s", $s);
        $stmt->execute();
        $stmt->bind_result($studentID, $courseID, $sessionID, $certificate, $status);
        while ($stmt->fetch())
        {   
            $applicatino = array();
            $applicatino['studentID'] = $studentID;
            $applicatino['courseID'] = $courseID;
            $applicatino['sessionID'] = $sessionID;
            $applicatino['certificate'] = $certificate;
            $applicatino['status'] = $status;
            array_push($result, $applicatino);
        }
        
        $ConnectionManager->closeConnection($stmt, $conn);
        return $result;
    }
    
    function updateStudentStatus($studentID,$courseID,$sessionID,$changetostatus){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE studentstatus SET status=? WHERE studentID = ? AND courseID = ? AND sessionID = ?");
        $stmt->bind_param("ssss",$changetostatus,$studentID,$courseID,$sessionID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getSubmittedDocument($studentid,$courseid,$sessionid){
        $status = 'pending';
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $certificateList = json_encode(array());
        $stmt = $conn->prepare("SELECT certificate FROM studentstatus WHERE studentID = ? AND courseID = ? AND sessionID = ? AND status = ?");
        $stmt->bind_param("ssss", $studentid,$courseid,$sessionid,$status);
        $stmt->execute();
        $stmt->bind_result($c);
        while ($stmt->fetch())
        {   
            $certificateList = $c;
        }
        
        $ConnectionManager->closeConnection($stmt, $conn);
        return $certificateList;
    }
    
    function removeRecord($studentid,$courseid,$sessionid){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM studentstatus WHERE studentID = ? AND courseID = ? AND sessionID = ?");
        $stmt->bind_param("sss", $studentid,$courseid,$sessionid);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
//    function truncate(){
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("TRUNCATE TABLE studentstatus");
//        $stmt->execute();
//        $ConnectionManager->closeConnection($stmt, $conn);
//    }
    
}