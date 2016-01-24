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
    function addSession($lang,$courseID,$sessionID,$fulltime,$parttime,$startDate, $endDate, $venue, $vacancy, $languages, $classlist){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO session_".$lang." (courseID,sessionID,fulltime,parttime,startDate, endDate, venue, vacancy, languages, classlist) VALUES (?, ?, ?,?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssiss",$courseID,$sessionID,$fulltime,$parttime,$startDate, $endDate, $venue, $vacancy, $languages, $classlist);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updateSession($lang,$courseID,$sessionID,$fulltime,$parttime,$startDate, $endDate, $venue, $vacancy, $languages, $classlist){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE session_".$lang." SET fulltime = ?,parttime = ?,startDate=?, endDate = ?,venue=?, vacancy=?, languages=?, classlist = ? WHERE courseID = ? AND sessionID = ?");
        $stmt->bind_param("ssssissss",$fulltime,$parttime,$startDate, $endDate, $venue, $vacancy, $languages, $classlist,$courseID,$sessionID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function deleteSession($lang,$courseID,$sessionID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM session_".$lang." WHERE courseID = ? AND sessionID = ?");
        $stmt->bind_param("ss", $courseID,$sessionID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function deleteSessionByCourse($lang,$courseID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM session_".$lang." WHERE courseID = ?");
        $stmt->bind_param("s", $courseID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getSession($lang,$courseID,$sessionID){
        $session = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM session_".$lang." WHERE courseID = ? AND sessionID=?");
        $stmt->bind_param("ss", $courseID,$sessionID);
        $stmt->execute();
        $stmt->bind_result($courseID,$sessionID,$fulltime,$parttime, $startDate,$endDate,$venue, $vacancy, $languages, $classlist);
        while ($stmt->fetch())
        {   $session['courseID'] = $courseID;
            $session['sessionID'] = $sessionID;
            $session['fulltime'] = $fulltime;
            $session['parttime'] = $parttime;
            $session['startDate'] = $startDate;
            $session['endDate'] = $endDate;
            $session['venue'] = $venue;
            $session['vacancy'] = $vacancy;
            $session['languages'] = $languages;
            $session['classlist'] = $classlist;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $session;
    }
    
    function getSessionListByCourse($lang,$courseID){
        $sessionList=[];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM session_".$lang." WHERE courseID = ?");
        $stmt->bind_param("s", $courseID);
        $stmt->execute();
        $stmt->bind_result($courseID,$sessionID,$fulltime,$parttime, $startDate, $endDate, $venue, $vacancy, $languages, $classlist);
        while ($stmt->fetch())
        {   
            $session = [];
            $session['courseID'] = $courseID;
            $session['sessionID'] = $sessionID;
            $session['fulltime'] = $fulltime;
            $session['parttime'] = $parttime;
            $session['startDate'] = $startDate;
            $session['endDate'] = $endDate;
            $session['venue'] = $venue;
            $session['vacancy'] = $vacancy;
            $session['languages'] = $languages;
            $session['classlist'] = $classlist;
            array_push($sessionList, $session);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $sessionList;
    }
    
    function getCompletedSessions($lang){
        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $sessionList=[];
        $courseMgr = new CourseManager();
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM session_".$lang." WHERE endDate < ? ORDER BY endDate ASC");
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $stmt->bind_result($courseID,$sessionID,$fulltime,$parttime, $startDate, $endDate, $venue, $vacancy, $languages, $classlist);
        while ($stmt->fetch())
        {   
            $session = [];
            $session['courseID'] = $courseID;
            $session['sessionID'] = $sessionID;
            $session['fulltime'] = $fulltime;
            $session['parttime'] = $parttime;
            $session['startDate'] = $startDate;
            $session['endDate'] = $endDate;
            $session['venue'] = $venue;
            $session['vacancy'] = $vacancy;
            $session['languages'] = $languages;
            $session['classlist'] = $classlist;
            $result = $courseMgr->getCourseNameAndCert($lang, $session['courseID']);
            $session['courseName'] = $result['name'];
            $session['certificate'] = $result['cert'];
            array_push($sessionList, $session);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $sessionList;
    }
    
    function getClassList($lang, $courseID,$sessionID){
        $studentIDlist = array();
        $studentlist=array();
        $studentMgr = new StudentManager();
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT classlist FROM session_".$lang." WHERE courseID = ? AND sessionID=?");
        $stmt->bind_param("ss", $courseID,$sessionID);
        $stmt->execute();
        $stmt->bind_result($classlist);
        while ($stmt->fetch())
        {   
            if(!empty($classlist)){
                $studentIDlist = explode(",", $classlist);
            }
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        foreach ($studentIDlist as $id) {
            $student = array();
            $student['studentID']=$id;
            $student['name'] = $studentMgr->getName($id);
            array_push($studentlist, $student);
        }
        return $studentlist;
    }
}
