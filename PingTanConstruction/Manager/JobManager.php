<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JobManager
 *
 * @author User
 */
class JobManager {
    //put your code here
    function addJob($jobid, $jobname, $location, $job_description, $type, $category, $qualification, $offer, $contact,$postdate){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        
        $stmt = $conn->prepare("INSERT INTO job (jobid, jobname, location, job_description, type, category, qualification, offer, contact,postdate,lastedit) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("sssssssssss", $jobid, $jobname, $location, $job_description, $type, $category, $qualification, $offer, $contact,$postdate,$postdate);
        
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function deleteJob($jobid){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM job WHERE jobid = ?");
        $stmt->bind_param("s", $jobid);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getAllJobs(){
        $jobList = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM job");
        $stmt->execute();
        $stmt->bind_result($jobid, $jobname, $location, $job_description, $type, $category, $qualification, $offer, $contact,$postdate,$lastedit);
        while ($stmt->fetch())
        {   $job = [];
            $job['jobid'] = $jobid;
            $job['jobname'] = $jobname;
            $job['location'] = $location;
            $job['description'] = $job_description;
            $job['type'] = $type;
            $job['category'] = $category;
            $job['qualification'] = $qualification;
            $job['offer'] = $offer;
            $job['contact'] = $contact;
            $job['postdate'] = $postdate;
            $job['lastedit'] = $lastedit;
            array_push($jobList, $job);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $jobList;
    }
    
    function getCareerCategory(){
        $categoryList = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT Distinct category FROM job");
        $stmt->execute();
        $stmt->bind_result($category);
        while ($stmt->fetch())
        {   
            array_push($categoryList, $category);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $categoryList;
    }

    function getJobByCategory($category){
        $jobList = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM job WHERE category = ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $stmt->bind_result($jobid, $jobname, $location, $job_description, $type, $category, $qualification, $offer, $contact,$postdate,$lastedit);
        while ($stmt->fetch())
        {   $job = [];
            $job['jobid'] = $jobid;
            $job['jobname'] = $jobname;
            $job['location'] = $location;
            $job['description'] = $job_description;
            $job['type'] = $type;
            $job['category'] = $category;
            $job['qualification'] = $qualification;
            $job['offer'] = $offer;
            $job['contact'] = $contact;
            $job['postdate'] = $postdate;
            $job['lastedit'] = $lastedit;
            array_push($jobList, $job);
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $jobList;
    }

    function getJobById($jobid){
        $job = [];
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT * FROM job WHERE jobid = ?");
        $stmt->bind_param("s", $jobid);
        $stmt->execute();
        $stmt->bind_result($jobid, $jobname, $location, $job_description, $type, $category, $qualification, $offer, $contact,$postdate,$lastedit);
        while ($stmt->fetch())
        {   
            $job['jobid'] = $jobid;
            $job['jobname'] = $jobname;
            $job['location'] = $location;
            $job['description'] = $job_description;
            $job['type'] = $type;
            $job['category'] = $category;
            $job['qualification'] = $qualification;
            $job['offer'] = $offer;
            $job['contact'] = $contact;
            $job['postdate'] = $postdate;
            $job['lastedit'] = $lastedit;
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        return $job;
    }
    
    function updateJob($jobid, $jobname, $location, $job_description, $type, $category, $qualification, $offer, $contact,$postdate,$lastedit){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("UPDATE job SET jobname=?, location=?, job_description=?, type=?, category=?, qualification=?, offer=?, contact=?,postdate=?,lastedit=? WHERE jobid = ?");
        $stmt->bind_param("sssssssssss",$jobname, $location, $job_description, $type, $category, $qualification, $offer, $contact,$postdate,$lastedit,$jobid);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
}
