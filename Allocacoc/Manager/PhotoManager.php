<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhotoManager
 *
 * @author User
 */
class PhotoManager {
    //put your code here
    function AddPhoto($product_id,$photo_type,$url){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO photo (product_id, photo_type, photo_url) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $product_id, $photo_type,$url);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getPhotos($product_id){
        $photo_arr = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT photo_type, photo_url FROM photo where product_id = ?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($photo_type, $photo_url);
        while ($stmt-> fetch())
        {   
            $photo_arr[$photo_type]= $photo_url;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $photo_arr;
    }
    
    function updatePhoto($product_id,$original_type,$new_type,$new_url){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE photo SET photo_type=?, photo_url=? WHERE product_id=? AND photo_type=?");
        $stmt->bind_param("ssss", $new_type, $new_url, $product_id,$original_type);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function checkThumbnail($product_id){
        $exist = false;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT photo_type FROM photo where product_id = ?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($photo_type);
        while ($stmt-> fetch())
        {   
            if($photo_type == "thumbnail"){
                $exist=true;
            }
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $exist;
    }
    
}