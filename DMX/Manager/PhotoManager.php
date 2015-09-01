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
    
    function getPhotos($project_id){
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
    function getTotalNumberOfThumbnailPhotosOfProject($project_id){
        $totalNo = 0;
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT count(*) FROM photo WHERE project_id=? AND photo_no LIKE 'thumbnail%' ");
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $stmt->bind_result($count);
        while ($stmt->fetch())
        {   
            $totalNo = $count;
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $totalNo;
    }
    function getProjectDisplay($project_id){
        $display_url = null;
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT photo_url FROM photo where project_id = ? AND photo_no = 'display' ");
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $stmt->bind_result($photo_url);
        while ($stmt-> fetch())
        {   
            $display_url = $photo_url;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $display_url;
    }
    function getThumbnailPhotosByid($project_id){
        $photo_arr = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT photo_url FROM photo where project_id = ? AND photo_no LIKE 'thumbnail%' ");
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $stmt->bind_result($photo_url);
        while ($stmt-> fetch())
        {   
            array_push($photo_arr,$photo_url);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $photo_arr;
    }
    function getHDPhotosByid($project_id){
        $photo_arr = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT photo_url FROM photo WHERE project_id = ? AND photo_no LIKE 'hd%' ");
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $stmt->bind_result($photo_url);
        while ($stmt-> fetch())
        {   
            array_push($photo_arr,$photo_url);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $photo_arr;
    }
    function getPaginatedResults($pageNo, $photoPerPage, $project_id){
        $photo_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT photo_url FROM photo WHERE project_id = ? AND photo_no LIKE 'thumbnail%' ORDER BY photo_no ASC LIMIT ".$pageNo.",".$photoPerPage);
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $stmt->bind_result($photo_url);        
        while ($stmt->fetch())
        {   
            array_push($photo_arr,$photo_url);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
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
    
    function update($project_id,$photo_no,$new_url){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE photo SET photo_url=? WHERE project_id=? AND photo_no=?");
        $stmt->bind_param("sss", $new_url, $project_id,$photo_no);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function deletePhoto($project_id){
        $urlList=self::getPhotos($project_id);
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
    
}