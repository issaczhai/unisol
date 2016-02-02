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
    //put your code herefunction getCharge(){
    function getStudentStatus($studentID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $courseIDList = [];
        $stmt = $conn->prepare("SELECT courseID, sessionID, type, language, status FROM studentstatus WHERE $studentID = ?");
        $stmt->bind_param("s", $studentID);
        $stmt->execute();
        $stmt->bind_result($courseID, $sessionID, $type, $language, $status);
        while ($stmt->fetch())
        {   
            $pair = [];
            $pair['courseID'] = $courseID;
            $pair['sessionID'] = $sessionID;
            $pair['type'] = $type;
            $pair['language'] = $language;
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
   
    
//    function truncate(){
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("TRUNCATE TABLE studentstatus");
//        $stmt->execute();
//        $ConnectionManager->closeConnection($stmt, $conn);
//    }
    
}