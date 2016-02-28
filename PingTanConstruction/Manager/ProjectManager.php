<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectManager
 *
 * @author User
 */
class ProjectManager {
    //put your code here
    function addProject($projectId, $projectName, $startDate, $endDate, $value, $scopeOfWork, $contract, $client,$photo){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO project (projectId, projectName, startDate, endDate, value, scopeOfWork, contract, client,photo,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("sssssssss", $projectId, $projectName, $startDate, $endDate, $value, $scopeOfWork, $contract, $client,$photo);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updateProject($projectId, $projectName, $startDate, $endDate, $value, $scopeOfWork, $contract, $client,$photo){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE project SET projectName=?, startDate=?, endDate=?, value=?, scopeOfWork=?, contract=?, client=?,photo=?,status=? WHERE projectId = ?");
        $stmt->bind_param("sssssssss", $projectName, $startDate, $endDate, $value, $scopeOfWork, $contract, $client,$photo,$projectId);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function updateProjectStatus($projectId, $status){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE project SET status=? WHERE projectId = ?");
        $stmt->bind_param("ss", $status, $projectId);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getProject($projectId){
        $project = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM project WHERE projectId=?");
        $stmt->bind_param("s", $projectId);
        $stmt->execute();
        $stmt->bind_result($projectid, $projectName, $startDate, $endDate, $value, $scopeOfWork, $contract, $client,$photo,$status);
        while ($stmt->fetch())
        {   $project['projectId'] = $projectid;
            $project['projectName'] = $projectName;
            $project['startDate'] = $startDate;
            $project['endDate'] = $endDate;
            $project['value'] = $value;
            $project['scopeOfWork'] = $scopeOfWork;
            $project['contract'] = $contract;
            $project['client'] = $client;
            $project['photo'] = $photo;
            $project['status'] = $status;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $project;
    }
    
    function getAllProjects(){
        $projectList = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM project");
        $stmt->execute();
        $stmt->bind_result($projectid, $projectName, $startDate, $endDate, $value, $scopeOfWork, $contract, $client,$photo,$status);
        while ($stmt->fetch())
        {   $project = [];
            $project['projectId'] = $projectid;
            $project['projectName'] = $projectName;
            $project['startDate'] = $startDate;
            $project['endDate'] = $endDate;
            $project['value'] = $value;
            $project['scopeOfWork'] = $scopeOfWork;
            $project['contract'] = $contract;
            $project['client'] = $client;
            $project['photo'] = $photo;
            $project['status'] = $status;
            array_push($projectList, $project);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $projectList;
    }
    
    function getProjectsByType($scopeOfWork){
        $projectList = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM project WHERE scopeOfWork = ?");
        $stmt->bind_param("s", $scopeOfWork);
        $stmt->execute();
        $stmt->bind_result($projectid, $projectName, $startDate, $endDate, $value, $scopeOfWork, $contract, $client,$photo,$status);
        while ($stmt->fetch())
        {   $project = [];
            $project['projectId'] = $projectid;
            $project['projectName'] = $projectName;
            $project['startDate'] = $startDate;
            $project['endDate'] = $endDate;
            $project['value'] = $value;
            $project['scopeOfWork'] = $scopeOfWork;
            $project['contract'] = $contract;
            $project['client'] = $client;
            $project['photo'] = $photo;
            $project['status'] = $status;
            array_push($projectList, $project);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $projectList;
    }
    
    function getProjectsByStatus($status){
        $projectList = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM project WHERE status = ?");
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $stmt->bind_result($projectid, $projectName, $startDate, $endDate, $value, $scopeOfWork, $contract, $client,$photo,$status);
        while ($stmt->fetch())
        {   $project = [];
            $project['projectId'] = $projectid;
            $project['projectName'] = $projectName;
            $project['startDate'] = $startDate;
            $project['endDate'] = $endDate;
            $project['value'] = $value;
            $project['scopeOfWork'] = $scopeOfWork;
            $project['contract'] = $contract;
            $project['client'] = $client;
            $project['photo'] = $photo;
            $project['status'] = $status;
            array_push($projectList, $project);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $projectList;
    }
}
