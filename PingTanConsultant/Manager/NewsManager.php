<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newsManager
 *
 * @author User
 */
class NewsManager {
    //put your code here
    function addNews($newsID, $title, $content){
        date_default_timezone_set("Asia/Singapore");
        $date = date('Y-m-d H:i:s');
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("INSERT INTO news (newsID, date, title, content) VALUES (?,?, ?,?)");
        $stmt->bind_param("ssss", $newsID, $date, $title, $content);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
    
    function getNewsList(){
        $newsList = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT * FROM news");
        $stmt->execute();
        $stmt->bind_result($newsID, $date, $title, $content);
        while ($stmt->fetch())
        {   $news = array();
            $news['newsID'] = $newsID;
            $news['date'] = $date;
            $news['title'] = $title;
            $news['$content'] = $content;
            array_push($newsList,$news);
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $newsList;
    }
    
    function getNews($newsID){
        $news = array();
        $ConnectionMgr = new ConnectionManager();
        $conn = $ConnectionMgr->getConnection();
        $stmt = $conn->prepare("SELECT * FROM news WHERE newsID = ?");
        $stmt->bind_param("s", $newsID);
        $stmt->execute();
        $stmt->bind_result($newsID, $date, $title, $content);
        while ($stmt->fetch())
        {  
            $news['newsID'] = $newsID;
            $news['date'] = $date;
            $news['title'] = $title;
            $news['$content'] = $content;
        }
        $ConnectionMgr->closeConnection($stmt, $conn);
        return $news;
    }
    
    function deleteNews($newsID){
        $ConnectionManager = new ConnectionManager();
        $conn = $ConnectionManager->getConnection();
        $stmt = $conn->prepare("DELETE FROM news WHERE newsID = ?");
        $stmt->bind_param("s", $newsID);
        $stmt->execute();
        $ConnectionManager->closeConnection($stmt, $conn);
    }
}
