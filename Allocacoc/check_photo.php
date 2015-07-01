<?php

    $picname = $_FILES[$_GET['photo']]['name']; 
    $picsize = $_FILES[$_GET['photo']]['size'];

    if ($picname != "") { 
        if ($picsize > 5120000) {  
            echo 'image size cannot exceed 5m'; 
            exit; 
        } 
        $type = strstr($picname, '.');  
        if ($type != ".gif" && $type != ".jpg" && $type != ".png") { 
            echo 'invalid image type'; 
            exit; 
        }
       
    }

        $arr = array( 
            
        ); 

        echo json_encode($arr);  
        

    
?>