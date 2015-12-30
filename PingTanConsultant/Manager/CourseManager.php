<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CourseManager
 *
 * @author User
 */
class CourseManager {
    
    //put your code here
    

    function addCourse($courseID, $name, $instructor, $price, $description,$syllabus,$objective, $documents, $requiredCert, $receivedCert, $prerequisite){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO course (courseID, name, instructor, price, description,syllabus,objective, documents, requiredCert, receivedCert, prerequisite) VALUES (?,?, ?,?,?, ?, ?, ?, ?,?,?)");
        $stmt->bind_param("sssdsssssss", $courseID, $name, $instructor, $price, $description,$syllabus,$objective, $documents, $requiredCert, $receivedCert, $prerequisite);
        
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function deleteCourse($courseID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM course WHERE courseID = ?");
        $stmt->bind_param("s", $courseID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getCourse($courseID){
        $course = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM course WHERE courseID=?");
        $stmt->bind_param("s", $courseID);
        $stmt->execute();
        $stmt->bind_result($courseID, $name, $instructor, $price, $description,$syllabus,$objective, $documents, $requiredCert, $receivedCert, $prerequisite);
        while ($stmt->fetch())
        {   $course['courseID'] = $courseID;
            $course['name'] = $name;
            $course['instructor'] = $instructor;
            $course['price'] = $price;
            $course['description'] = $description;
            $course['syllabus'] = $syllabus;
            $course['objective'] = $objective;
            $course['documents'] = $documents;
            $course['requiredCert'] = $requiredCert;
            $course['receivedCert'] = $receivedCert;
            $course['prerequisite'] = $prerequisite;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $course;
    }
    
    function getCourseList(){
        $course_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT * FROM course");
        $stmt->execute();
        $stmt->bind_result($courseID, $name, $instructor, $price, $description,$syllabus,$objective, $documents, $requiredCert, $receivedCert, $prerequisite);
        while ($stmt->fetch())
        {   $course = array();
            $course['courseID'] = $courseID;
            $course['name'] = $name;
            $course['instructor'] = $instructor;
            $course['price'] = $price;
            $course['description'] = $description;
            $course['syllabus'] = $syllabus;
            $course['objective'] = $objective;
            $course['documents'] = $documents;
            $course['requiredCert'] = $requiredCert;
            $course['receivedCert'] = $receivedCert;
            $course['prerequisite'] = $prerequisite;
            array_push($course_arr,$course);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $course_arr;
    }
    
    function updateCourse($courseID, $name, $instructor, $price, $description,$syllabus,$objective, $documents, $requiredCert, $receivedCert, $prerequisite){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE course SET name=?, instructor=?, price=?, description=?, syllabus=?, objective=? ,documents=?, requiredCert=?,receivedCert=?, prerequisite=? WHERE courseID=?");
        $stmt->bind_param("ssdssssssss",$name, $instructor, $price, $description,$syllabus,$objective, $documents, $requiredCert, $receivedCert, $prerequisite,$courseID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    
//    function retrieveFromShoppingCart($customer_id){
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $shopping_cart_courses = array();
//        $date = new DateTime('2000-01-01');
//        $var = $date->format('Y-m-d H:i:s');
//        $stmt = $conn->prepare("SELECT * FROM cart WHERE customer_id=? AND pay_time = ? ORDER BY create_time desc");
//        $stmt->bind_param("ss", $customer_id,$var);
//        $stmt->execute();
//        $stmt->bind_result($customer_id,$courseID,$color,$quantity,$create_time,$pay_time);
//        while ($stmt->fetch())
//        {
//            $course = array();
//            $course['customer_id'] = $customer_id;
//            $course['courseID'] = $courseID;
//            $course['color'] = $color;
//            $course['quantity'] = $quantity;
//            $course['create_time'] = $create_time;
//            $course['pay_time'] = $pay_time;
//            array_push($shopping_cart_courses,$course);
//        }
//        
//        return $shopping_cart_courses;
//    }
//    
//    function retrieveTotalNumberOfItemsInShoppingCart($customer_id){
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $total = 0;
//        $date = new DateTime('2000-01-01');
//        $var = $date->format('Y-m-d H:i:s');
//        $stmt = $conn->prepare("SELECT quantity FROM cart WHERE customer_id=? AND pay_time = ?");
//        $stmt->bind_param("ss", $customer_id,$var);
//        $stmt->execute();
//        $stmt->bind_result($quantity);
//        while ($stmt->fetch())
//        {
//            $total = $total+$quantity;
//        }
//        return $total;
//    }
//    
//    function deleteCartItem($customer_id,$item_id, $color){
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $date = new DateTime('2000-01-01');
//        $var = $date->format('Y-m-d H:i:s');
//        $stmt = $conn->prepare("DELETE from cart WHERE customer_id=? AND courseID=? AND color=?");
//        $stmt->bind_param("sss",$customer_id, $item_id, $color);
//        $stmt->execute();
//        $ConnectionManager->closeConnection($stmt, $conn);
//    }
//    
//    function getStock($courseID){
//        $stock = 0;
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("SELECT stock FROM course WHERE courseID=?");
//        $stmt->bind_param("s", $courseID);
//        $stmt->execute();
//        $stmt->bind_result($stock);
//        while ($stmt->fetch())
//        {
//            $stock = $stock;
//            
//        }
//        $ConnectionManager->closeConnection($stmt, $conn);
//        return $stock;
//    }
//    
//    function getCourseName($courseID){
//        $course_name = null;
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("SELECT name FROM course WHERE courseID=?");
//        $stmt->bind_param("s", $courseID);
//        $stmt->execute();
//        $stmt->bind_result($name);
//        while ($stmt->fetch())
//        {
//            $course_name = $name;
//        }
//        $ConnectionManager->closeConnection($stmt, $conn);
//        return $course_name;
//    }
//    
//    
//    function getDescription($courseID){
//        $description = null;
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("SELECT description FROM course WHERE courseID=?");
//        $stmt->bind_param("s", $courseID);
//        $stmt->execute();
//        $stmt->bind_result($description);
//        while ($stmt->fetch())
//        {
//            $description = $description;
//        }
//        $ConnectionManager->closeConnection($stmt, $conn);
//        return $description;
//    }
//    
//    function getPrice($courseID){
//        $price = 0.0;
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("SELECT price FROM course WHERE courseID=?");
//        $stmt->bind_param("s", $courseID);
//        $stmt->execute();
//        $stmt->bind_result($price);
//        while ($stmt->fetch())
//        {
//            $price = $price;
//        }
//        $ConnectionManager->closeConnection($stmt, $conn);
//        return $price;
//    }
//    
//    function getColor($courseID){
//        $color = 0.0;
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("SELECT color FROM course WHERE courseID=?");
//        $stmt->bind_param("s", $courseID);
//        $stmt->execute();
//        $stmt->bind_result($color);
//        while ($stmt->fetch())
//        {
//            $color = $color;
//        }
//        $ConnectionManager->closeConnection($stmt, $conn);
//        return $color;
//    }
//    
//    function updateColor($courseID,$new_color_string){
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("UPDATE course SET color = ? WHERE courseID=?");
//        $stmt->bind_param("ss",$new_color_string,$courseID);
//        $stmt->execute();
//        $ConnectionManager->closeConnection($stmt, $conn);
//    }
//    
//    function getCourseSymbolCode($courseID){
//        $code = "";
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("SELECT symbol_code FROM course WHERE courseID=?");
//        $stmt->bind_param("s", $courseID);
//        $stmt->execute();
//        $stmt->bind_result($symbol_code);
//        while ($stmt->fetch())
//        {
//            $code = $symbol_code;
//        }
//        $ConnectionManager->closeConnection($stmt, $conn);
//        return $code;
//    }
//    
//    
//    function filterCourse($filter_type){
//        $course_arr = [];
//        $filter_para = '%'.$filter_type.'%';
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("SELECT * FROM course WHERE course_name LIKE ?");
//        $stmt->bind_param("s", $filter_para);
//        $stmt->execute();
//        $stmt->bind_result($courseID,$course_name,$symbol_code,$price,$color,$description,$stock);
//        while ($stmt->fetch())
//        {   $course = array();
//            $course['courseID'] = $courseID;
//            $course['course_name'] = $course_name;
//            $course['symbol_code'] = $symbol_code;
//            $course['price'] = $price;
//            $course['color'] = $color;
//            $course['description'] = $description;
//            $course['stock'] = $stock;
//            array_push($course_arr,$course);
//        }
//        $ConnectionManager->closeConnection($stmt, $conn);
//        return $course_arr;
//    }
//    
//    function sortWithFilter($filter_type,$sort_type){
//        $course_arr = [];
//        $filter_para = '%'.$filter_type.'%';
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("SELECT * FROM course WHERE course_name LIKE ? ORDER BY price $sort_type");
//        $stmt->bind_param("s", $filter_para);
//        $stmt->execute();
//        $stmt->bind_result($courseID,$course_name,$symbol_code,$price,$color,$description,$stock);
//        while ($stmt->fetch())
//        {   $course = array();
//            $course['courseID'] = $courseID;
//            $course['course_name'] = $course_name;
//            $course['symbol_code'] = $symbol_code;
//            $course['price'] = $price;
//            $course['color'] = $color;
//            $course['description'] = $description;
//            $course['stock'] = $stock;
//            array_push($course_arr,$course);
//        }
//        $ConnectionManager->closeConnection($stmt, $conn);
//        return $course_arr;
//    }
//    
//    function sortAll($sort_type){
//        $course_arr = [];
//        $ConnectionManager = new ConnectionManager();
//        $conn = $ConnectionManager->getConnection();
//        $stmt = $conn->prepare("SELECT * FROM course ORDER BY price $sort_type");
//        $stmt->execute();
//        $stmt->bind_result($courseID,$course_name,$symbol_code,$price,$color,$description,$stock);
//        while ($stmt->fetch())
//        {   $course = array();
//            $course['courseID'] = $courseID;
//            $course['course_name'] = $course_name;
//            $course['symbol_code'] = $symbol_code;
//            $course['price'] = $price;
//            $course['color'] = $color;
//            $course['description'] = $description;
//            $course['stock'] = $stock;
//            array_push($course_arr,$course);
//        }
//        $ConnectionManager->closeConnection($stmt, $conn);
//        return $course_arr;
//    }
    
}