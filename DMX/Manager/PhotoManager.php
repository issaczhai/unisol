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
    function AddPhoto($project_id,$photo_no,$photo_url){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO photo (project_id, photo_no, photo_url) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $project_id,$photo_no,$photo_url);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getPhotosByProject($project_id){
        $photo_arr = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT photo_no, photo_url FROM photo where project_id = ?");
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $stmt->bind_result($photo_no, $photo_url);
        while ($stmt-> fetch())
        {   
            $photo_arr[$photo_no]= $photo_url;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $photo_arr;
    }
    
    function getAllPhotosInJson(){
        $fullList = [];
        $reference = "";
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM photo");
        $stmt->execute();
        $stmt->bind_result($project_id, $photo_no, $photo_url);
        while ($stmt-> fetch())
        {   
            if($reference != $project_id){
                $reference = $project_id;
            }
            $fullList[$reference][$photo_no] = $photo_url;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return json_encode($fullList);
    }
    
    function deleteAllPhotosByproject($project_id){
        $urlList=self::getPhotosByProject($project_id);
        foreach ($urlList as $url){
            unlink($url);
        }
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM photo WHERE project_id = ?");
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getSpecificPhotoURL($project_id,$photo_no){
        $url = '';
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT photo_url FROM photo where project_id = ? AND photo_no=?");
        $stmt->bind_param("ss", $project_id,$photo_no);
        $stmt->execute();
        $stmt->bind_result($photo_url);
        while ($stmt-> fetch())
        {   
            $url= $photo_url;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $url;
    }
    
    function deleteSpecificPhoto($project_id,$photo_no){
        $url=self::getSpecificPhotoURL($project_id,$photo_no);
        unlink($url);
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM photo WHERE project_id = ? AND photo_no=?");
        $stmt->bind_param("ss", $project_id, $photo_no);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updateSpecificPhoto($project_id,$photo_no,$new_url){
        $url=self::getSpecificPhotoURL($project_id,$photo_no);
        unlink($url);
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE photo SET photo_url=? WHERE project_id=? AND photo_no=?");
        $stmt->bind_param("sss", $new_url, $project_id,$photo_no);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
}