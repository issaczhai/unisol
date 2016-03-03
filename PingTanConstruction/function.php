<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//(string,string,bol,bol,array of string)
function uploadMultipleFiles($inputName,$location,$checkPhoto,$checkSize,$indexArray){//(string,string,bol,bol,array of string)
    $return = array();
    $errors = array();
    $success = 0;
    $pathList = array();
    if(!empty($_FILES[$inputName]['name'][0])){
        for($j=0; $j < count($_FILES[$inputName]['name']); $j++) {
            $bol = true;
            $filename = $_FILES[$inputName]['name'][$j]; 
            $filesize = $_FILES[$inputName]['size'][$j];
            $type = strstr($filename, '.');
            $count = $j+1; 
            if($checkPhoto){
                if($type != ".gif" && $type != ".jpg" && $type != ".png" && $type != ".jpeg"){//check whether the file is image file  
                    array_push($errors,"invalid image type for file ".$count);
                    $bol = false;
                }
            }
            
            if($checkSize && $filesize > 3072000){
                array_push($errors,"file size cannot exceed 3m for file ".$count);
                $bol = false;
            }
            
            if($bol){//process with file upload
                $random = (string)rand(0, 10000);
                $file_name = date("YmdHis").$random.$filename;
                $file_path = $location.$file_name;
                move_uploaded_file($_FILES[$inputName]['tmp_name'][$j], $file_path);
                if(sizeof($indexArray) === 0){
                    $index = (string)rand(100000, 999999);
                    $pathList[$index]=$file_path;
                }else{
                    if(sizeof($indexArray) <= $j || $indexArray[$j] == ''){
                        //if the element at the index position is empty or the array is shorter than expected
                        $index = (string)rand(100000, 999999);
                        $pathList[$index]=$file_path;
                    }else{
                        $pathList[$indexArray[$j]]=$file_path;
                    }
                }
                $success+=1;
            }  
            
        }
    }else{
        array_push($errors,"no files chosen");
    }
    $return['errors'] = $errors;
    $return['success'] = $success;
    $return['pathList'] = $pathList;
    return $return;
}

//(string,string,bol,bol)
function uploadSingleFile($inputName,$location,$checkPhoto,$checkSize){//(string,string,bol,bol)
    $return = array();
    $error = array();
    $bol = true;
    $filename = $_FILES[$inputName]['name']; 
    $filesize = $_FILES[$inputName]['size'];
    $path = "";
    if ($filename != "") {
        if ($checkSize && $filesize > 3072000) {  
            array_push($error,'file size cannot exceed 3m');
            $bol = false;
        } 
        $type = strstr($filename, '.');
        if ($checkPhoto && $type != ".gif" && $type != ".jpg" && $type != ".png" && $type != ".jpeg") {
            array_push($error,'invalid image type');
            $bol = false;
        }
        if($bol){
            $rand = rand(0, 10000); 
            $file = date("YmdHis") . $rand . $filename;
            $path = $location.$file;
            move_uploaded_file($_FILES[$inputName]['tmp_name'], $path);
        }   
    }else{
        array_push($error,'no file chosen');
    }
    $return['error'] = $error;
    $return['path'] = $path;
    return $return;
}