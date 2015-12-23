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
        $studentstatus = [];
        $status = ['taken','ongoing','upcoming'];
        foreach($status as $s){
            $courseIDList = [];
            $stmt = $conn->prepare("SELECT courseID FROM studentstatus WHERE studentID=? AND status = ?");
            $stmt->bind_param("ss", $studentID,$s);
            $stmt->execute();
            $stmt->bind_result($courseID);
            while ($stmt->fetch())
            {   
                array_push($courseIDList, $courseID);
            }
            $studentstatus[$s] = $courseIDList;
        }
        
        $ConnectionManager->closeConnection($stmt, $conn);
        return $studentstatus;
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