<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductManager
 *
 * @author User
 */
class ProjectManager {
    
    //put your code here
    function addProject($project_id, $project_name, $type, $year, $country, $location, $size, $completion_date, $description){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO project (project_id, project_name, type, year, country, location, size, completion_date, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $project_id, $project_name, $type, $year, $country, $location, $size, $completion_date, $description);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getProject($project_id){
        $project = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM project WHERE project_id=?");
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $stmt->bind_result($project_id, $project_name, $type, $year, $country, $location, $size, $completion_date, $description);
        while ($stmt->fetch())
        {   $project['project_id'] = $project_id;
            $project['project_name'] = $project_name;
            $project['type'] = $type;
            $project['year'] = $year;
            $project['country'] = $country;
            $project['location'] = $location;
            $project['size'] = $size;
            $project['completion_date'] = $completion_date;
            $project['description'] = $description;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        $photoMgr = new PhotoManager();
        $photo_arr = $photoMgr->getPhotosByProject($project_id);
        $project['photo_arr'] = $photo_arr;
        return $project;
    }
    
    function getProjectWithProjectName($project_name){
        $project_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT * FROM project WHERE project_name = ?");
        $stmt->bind_param("s", $project_name);
        $stmt->execute();
        $stmt->bind_result($project_id, $project_name, $type, $year, $country, $location, $size, $completion_date, $description);
        while ($stmt->fetch())
        {   
            $project['project_id'] = $project_id;
            $project['project_name'] = $project_name;
            $project['type'] = $type;
            $project['year'] = $year;
            $project['country'] = $country;
            $project['location'] = $location;
            $project['size'] = $size;
            $project['completion_date'] = $completion_date;
            $project['description'] = $description;
            array_push($project_arr,$project);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $project_arr;
    }

    function getAllProjects(){
        $project_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT * FROM project GROUP BY project_name ORDER BY year DESC");
        $stmt->execute();
        $stmt->bind_result($project_id, $project_name, $type, $year, $country, $location, $size, $completion_date, $description);
        while ($stmt->fetch())
        {   $project['project_id'] = $project_id;
            $project['project_name'] = $project_name;
            $project['type'] = $type;
            $project['year'] = $year;
            $project['country'] = $country;
            $project['location'] = $location;
            $project['size'] = $size;
            $project['completion_date'] = $completion_date;
            $project['description'] = $description;
            array_push($project_arr,$project);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $project_arr;
    }
    
    function getTotalNumberOfProjects(){
        $totalNo = 0;
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT count(DISTINCT project_name) FROM project");
        $stmt->execute();
        $stmt->bind_result($count);
        while ($stmt->fetch())
        {   $totalNo = $count;
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $totalNo;
    }
    
    function getPaginatedResults($pageNo, $itemPerPage){
        $project_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT * FROM project GROUP BY project_name ORDER BY year DESC LIMIT ".$pageNo.",".$itemPerPage);
        $stmt->execute();
        $stmt->bind_result($project_id, $project_name, $type, $year, $country, $location, $size, $completion_date, $description);
        while ($stmt->fetch())
        {   $project['project_id'] = $project_id;
            $project['project_name'] = $project_name;
            $project['type'] = $type;
            $project['year'] = $year;
            $project['country'] = $country;
            $project['location'] = $location;
            $project['size'] = $size;
            $project['completion_date'] = $completion_date;
            $project['description'] = $description;
            array_push($project_arr,$project);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $project_arr;
    }
    
    function updateProject($project_id, $project_name, $type, $year, $country, $location, $size, $completion_date, $description){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE project SET project_name=?, type=?, year=?, country=?, location=?, size=?, completion_date=?, description=? WHERE project_id=?");
        $stmt->bind_param("sssssssss", $project_name, $type, $year, $country, $location, $size, $completion_date, $description, $project_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function filterProject($filterType,$filterValue){
        $projectArr = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM project WHERE ".$filterType."=? GROUP BY project_name ORDER BY year DESC");
        $stmt->bind_param("s",$filterValue);
        $stmt->execute();
        $stmt->bind_result($project_id, $project_name, $type, $year, $country, $location, $size, $completion_date, $description);
        while ($stmt->fetch())
        {   $project = array();
            $project['project_id'] = $project_id;
            $project['project_name'] = $project_name;
            $project['type'] = $type;
            $project['year'] = $year;
            $project['country'] = $country;
            $project['location'] = $location;
            $project['size'] = $size;
            $project['completion_date'] = $completion_date;
            $project['description'] = $description;
            array_push($projectArr,$project);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $projectArr;
    }
    
    function filterProjectAlphabet($filterValue){
        $projectArr = [];
        $filter_para = $filterValue.'%';
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM project WHERE project_name LIKE ? GROUP BY project_name ORDER BY year DESC");
        $stmt->bind_param("s",$filter_para);
        $stmt->execute();
        $stmt->bind_result($project_id, $project_name, $type, $year, $country, $location, $size, $completion_date, $description);
        while ($stmt->fetch())
        {   $project = array();
            $project['project_id'] = $project_id;
            $project['project_name'] = $project_name;
            $project['type'] = $type;
            $project['year'] = $year;
            $project['country'] = $country;
            $project['location'] = $location;
            $project['size'] = $size;
            $project['completion_date'] = $completion_date;
            $project['description'] = $description;
            array_push($projectArr,$project);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $projectArr;
    }
    
	
	function getTypeList(){
        $type_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT DISTINCT type FROM project ORDER BY year DESC");
        $stmt->execute();
        $stmt->bind_result($type);
        while ($stmt->fetch())
        {   
            $project_type = $type;
            array_push($type_arr,$project_type);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $type_arr;
    }
	
	function getYearList(){
        $year_arr = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT DISTINCT year FROM project ORDER BY year DESC");
        $stmt->execute();
        $stmt->bind_result($year);
        while ($stmt->fetch())
        {   
            $project_year = $year;
            array_push($year_arr,$project_year);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $year_arr;
    }
    
    function deleteProject($project_id){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM project WHERE project_id = ?");
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
}