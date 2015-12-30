<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SessionManager
 *
 * @author User
 */
class SessionManager {
    //put your code here
    function addSession($courseID,$sessionID,$fulltime,$parttime,$startDate, $venue, $vacancy, $languages, $classlist){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO session (courseID,sessionID,fulltime,parttime,startDate, venue, vacancy, languages, classlist) VALUES (?, ?, ?,?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiss",$courseID,$sessionID,$fulltime,$parttime,$startDate, $venue, $vacancy, $languages, $classlist);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function deleteSession($courseID,$sessionID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM session WHERE courseID = ? AND sessionID = ?");
        $stmt->bind_param("ss", $courseID,$sessionID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function deleteSessionByCourse($courseID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM session WHERE courseID = ?");
        $stmt->bind_param("s", $courseID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getSession($courseID,$sessionID){
        $session = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM session WHERE courseID = ? AND sessionID=?");
        $stmt->bind_param("ss", $courseID,$sessionID);
        $stmt->execute();
        $stmt->bind_result($courseID,$sessionID,$fulltime,$parttime, $startDate,$venue, $vacancy, $languages, $classlist);
        while ($stmt->fetch())
        {   $session['courseID'] = $courseID;
            $session['sessionID'] = $sessionID;
            $session['fulltime'] = $fulltime;
            $session['parttime'] = $parttime;
            $session['startDate'] = $startDate;
            $session['venue'] = $venue;
            $session['vacancy'] = $vacancy;
            $session['languages'] = $languages;
            $session['classlist'] = $classlist;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $session;
    }
    
    function getSessionListByCourse($courseID){
        $sessionList=[];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM session WHERE courseID = ?");
        $stmt->bind_param("s", $courseID);
        $stmt->execute();
        $stmt->bind_result($courseID,$sessionID,$fulltime,$parttime, $startDate, $venue, $vacancy, $languages, $classlist);
        while ($stmt->fetch())
        {   
            $session = [];
            $session['courseID'] = $courseID;
            $session['sessionID'] = $sessionID;
            $session['fulltime'] = $fulltime;
            $session['parttime'] = $parttime;
            $session['startDate'] = $startDate;
            $session['venue'] = $venue;
            $session['vacancy'] = $vacancy;
            $session['languages'] = $languages;
            $session['classlist'] = $classlist;
            array_push($sessionList, $session);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $sessionList;
    }
}
