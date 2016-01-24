<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StudentManager
 *
 * @author User
 */
class StudentManager {
    //put your code here
    function addStudent($studentID,$username,$password,$email,$nationality,$contactNo,$occupation,$dateOfBirth,$firstname,$lastname,$nric,$userStatus){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO student (studentID,username,password,email,nationality,contactNo,occupation,dateOfBirth,firstname,lastname,NRIC,userStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("ssssssssssss", $studentID,$username,$password,$email,$nationality,$contactNo,$occupation,$dateOfBirth,$firstname,$lastname,$nric,$userStatus);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getPassword($studentID){
        $student_password = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT password FROM student WHERE studentID=?");
        $stmt->bind_param("s", $studentID);
        $stmt->execute();
        $stmt->bind_result($password);
        while ($stmt->fetch())
        {
            $student_password = $password;

        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $student_password;
    }
    
    function getEmail($studentID){
        $email = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT email FROM student WHERE studentID=?");
        $stmt->bind_param("s", $studentID);
        $stmt->execute();
        $stmt->bind_result($e);
        while ($stmt->fetch())
        {
            $email = $e;

        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $email;
    }
    
    function getName($studentID){
        $name = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT firstname, lastname FROM student WHERE studentID=?");
        $stmt->bind_param("s", $studentID);
        $stmt->execute();
        $stmt->bind_result($fn,$ln);
        while ($stmt->fetch())
        {   
            if(!empty($fn) && !empty($ln)){
                $name = $ln." ".$fn;
            }
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $name;
    }
    
    function getStudentByID($studentID){
        $student = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM student WHERE studentID=?");
        $stmt->bind_param("s", $studentID);
        $stmt->execute();
        $stmt->bind_result($studentID,$username,$password,$email,$nationality,$contactNo,$occupation,$dateOfBirth,$firstname,$lastname,$nric,$userStatus);
        while ($stmt->fetch())
        {   $student['studentID'] = $studentID;
            $student['username'] = $username;
            $student['password'] = $password;
            $student['email'] = $email;
            $student['nationality'] = $nationality;
            $student['contactNo'] = $contactNo;
            $student['occupation'] = $occupation;
            $student['dateOfBirth'] = $dateOfBirth;
            $student['firstname'] = $firstname;
            $student['lastname'] = $lastname;
            $student['nric'] = $nric;
            $student['userStatus'] = $userStatus;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        if(!empty($student)){
            $ssManager = new StudentStatusManager();
            $studentstatus = $ssManager->getStudentStatus($student['studentID']);
            $student['status'] = $studentstatus;
        }
        
        return $student;
    }
    
    function getStudentByEmail($email){
        $student = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM student WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($studentID,$username,$password,$email,$nationality,$contactNo,$occupation,$dateOfBirth,$firstname,$lastname,$nric,$userStatus);
        while ($stmt->fetch())
        {   $student['studentID'] = $studentID;
            $student['username'] = $username;
            $student['password'] = $password;
            $student['email'] = $email;
            $student['nationality'] = $nationality;
            $student['contactNo'] = $contactNo;
            $student['occupation'] = $occupation;
            $student['dateOfBirth'] = $dateOfBirth;
            $student['firstname'] = $firstname;
            $student['lastname'] = $lastname;
            $student['nric'] = $nric;
            $student['userStatus'] = $userStatus;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        if(!empty($student)){
            $ssManager = new StudentStatusManager();
            $studentstatus = $ssManager->getStudentStatus($student['studentID']);
            $student['status'] = $studentstatus;
        }
        return $student;
    }
    
    function getStudentByUsername($username){
        $student = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM student WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($studentID,$username,$password,$email,$nationality,$contactNo,$occupation,$dateOfBirth,$firstname,$lastname,$nric,$userStatus);
        while ($stmt->fetch())
        {   $student['studentID'] = $studentID;
            $student['username'] = $username;
            $student['password'] = $password;
            $student['email'] = $email;
            $student['nationality'] = $nationality;
            $student['contactNo'] = $contactNo;
            $student['occupation'] = $occupation;
            $student['dateOfBirth'] = $dateOfBirth;
            $student['firstname'] = $firstname;
            $student['lastname'] = $lastname;
            $student['nric'] = $nric;
            $student['userStatus'] = $userStatus;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        if(!empty($student)){
            $ssManager = new StudentStatusManager();
            $studentstatus = $ssManager->getStudentStatus($student['studentID']);
            $student['status'] = $studentstatus;
        }
        return $student;
    }
    
    function getStudentByUsernamePassword($username,$password){
        $student = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM student WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username,$password);
        $stmt->execute();
        $stmt->bind_result($studentID,$username,$password,$email,$nationality,$contactNo,$occupation,$dateOfBirth,$firstname,$lastname,$nric,$userStatus);
        while ($stmt->fetch())
        {   $student['studentID'] = $studentID;
            $student['username'] = $username;
            $student['password'] = $password;
            $student['email'] = $email;
            $student['nationality'] = $nationality;
            $student['contactNo'] = $contactNo;
            $student['occupation'] = $occupation;
            $student['dateOfBirth'] = $dateOfBirth;
            $student['firstname'] = $firstname;
            $student['lastname'] = $lastname;
            $student['nric'] = $nric;
            $student['userStatus'] = $userStatus;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        if(!empty($student)){
            $ssManager = new StudentStatusManager();
            $studentstatus = $ssManager->getStudentStatus($student['studentID']);
            $student['status'] = $studentstatus;
        }
        return $student;
    }
    
    function getStudentList(){
        $student_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT * FROM student");
        $stmt->execute();
        $stmt->bind_result($studentID,$username,$password,$email,$nationality,$contactNo,$occupation,$dateOfBirth,$firstname,$lastname,$nric,$userStatus);
        $ssManager = new StudentStatusManager();
        while ($stmt->fetch())
        {   $student = array();
            $student['studentID'] = $studentID;
            $student['username'] = $username;
            $student['password'] = $password;
            $student['email'] = $email;
            $student['nationality'] = $nationality;
            $student['contactNo'] = $contactNo;
            $student['occupation'] = $occupation;
            $student['dateOfBirth'] = $dateOfBirth;
            $student['firstname'] = $firstname;
            $student['lastname'] = $lastname;
            $student['nric'] = $nric;
            $student['userStatus'] = $userStatus;
            $studentstatus = $ssManager->getStudentStatus($student['studentID']);
            $student['status'] = $studentstatus;
            array_push($student_arr,$student);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $student_arr;
    }
    
    function resetPassword($studentID,$password){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE product SET password=? WHERE studentID=?");
        $stmt->bind_param("ss", $password, $studentID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function saveCert($studentID,$courseID,$name,$sessionID,$path){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO studentcertificate (studentID,courseID,name,sessionID,path) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss",$studentID,$courseID,$name,$sessionID,$path);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
//    function updateStudent($studentID,$student_password,$altenative_email,$first_name,$last_name,$contact_no,$credit){
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("UPDATE student SET password=?,alternative_email=?,first_name=?,last_name=?,contact_no=?,credit=? WHERE studentID = ?");
//        $stmt->bind_param("sssssds", $student_password,$altenative_email,$first_name,$last_name,$contact_no,$credit,$studentID);
//        $stmt->execute();
//        $ConnectionManager->closeConnection($stmt, $conn);
//    }
    
//    function updatePassword($studentID,$student_password){
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("UPDATE student SET password=? WHERE studentID = ?");
//        $stmt->bind_param("ss", $student_password,$studentID);
//        $stmt->execute();
//        $ConnectionManager->closeConnection($stmt, $conn);
//    }
//    
//    function activateAccount($studentID){
//        $verified="true";
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("UPDATE student SET verified=? WHERE studentID = ?");
//        $stmt->bind_param("ss", $verified,$studentID);
//        $stmt->execute();
//        $ConnectionManager->closeConnection($stmt, $conn);
//    }
    
}