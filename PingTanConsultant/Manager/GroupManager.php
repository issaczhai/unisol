<?php

class GroupManager {

	function addNewGroup($companyID, $courseID, $sessionID, $studentList){
		$ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO `group` (companyID,courseID,sessionID,studentList) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss",$companyID,$courseID,$sessionID,$studentList);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
	}

	function getGroupList($companyID, $courseID, $sessionID){
        $studentIDlist = array();
        $grouplist=array();
        $studentMgr = new StudentManager();
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("SELECT studentList FROM `group` WHERE companyID = ? AND courseID = ? AND sessionID=?");
        $stmt->bind_param("sss", $companyID,$courseID,$sessionID);
        $stmt->execute();
        $stmt->bind_result($studentList);
        while ($stmt->fetch())
        {   
            if(!empty($studentList)){
                $studentIDlist = explode(",", $studentList);
            }
        }
        $ConnectionManager->closeConnection($stmt, $conn);
        foreach ($studentIDlist as $id) {
            $student = array();
            $student['studentID']=$id;
            $student['name'] = $studentMgr->getName($id);
            array_push($grouplist, $student);
        }
        return $grouplist;
    }

    function getGroupListByCompanyID($companyID){
    	
        $companyStudentList = array();
        $companyDistList = array();
        $studentMgr = new StudentManager();
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        if($stmt = $conn->prepare("SELECT studentList FROM `group` WHERE companyID = ?")){
	        $stmt->bind_param("s", $companyID);
	        $stmt->execute();
	        $stmt->bind_result($studentList);
	        while ($stmt->fetch())
	        {   
	            if(!empty($studentList)){

	                $studentIDlist = explode(",", $studentList);
	                foreach ($studentIDlist as $id) {

			            $student = array();

		            	if(!in_array($id, $companyDistList)){
			            	
			            	$student = $studentMgr->getStudentByID($id);
			            	// add the distinct student to the list to return to front end
			            	array_push($companyStudentList, $student);
			            	// add the none-exist student id in the distinct student list of company
			            	array_push($companyDistList, $id);
			            }
			            
			        }
	            }
	        }

	        $ConnectionManager->closeConnection($stmt, $conn);
	        
	        
	    }else{
	    	printf("Errormessage: %s\n", $conn->error);
	    }

	    return $companyStudentList;
    }
}