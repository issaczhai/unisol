<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
include_once("./Manager/PhotoManager.php");
include_once("./Manager/OrderManager.php");
$productMgr = new ProductManager();
$photoMgr = new PhotoManager();
$orderMgr = new OrderManager();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$operation = '';
$operation = filter_input(INPUT_POST,'operation');
if ($operation === ''){
    $operation = $_GET['operation'];
}

if ($operation === "add_product"){
    $valid=true;
    $errorList = [];
    $product_name = filter_input(INPUT_POST,'product_name');
    $random_no = (string)rand(0,10000);
    $product_id = "AL".$random_no;
    $symbol_code = filter_input(INPUT_POST,'symbol_code');
    if(empty($symbol_code)){
        $symbol_code='';
    }
    $price = filter_input(INPUT_POST,'price');

    $description = "";
    if(!empty($_POST['addTextarea'])){
        $description = $_POST['addTextarea'];
    }
    $stock = 0.0;
    if(is_numeric(filter_input(INPUT_POST,'add_product_stock'))){
        $stock = (float)filter_input(INPUT_POST,'add_product_stock');
    }else{
        $valid = false;
    }
    $imgURL_thumbnail = '';
    $picname = $_FILES['thumbnail_photo_input']['name']; 
    $picsize = $_FILES['thumbnail_photo_input']['size'];
    if ($picname != "") {
        $thumbnail_valid = true;
        if ($picsize > 5120000) {  
            array_push($errorList ,'image size of thumbnail exceed 5m'); 
            $valid=false; 
            $thumbnail_valid = false;
        } 
        $type = strstr($picname, '.');  
        if ($type != ".gif" && $type != ".jpg" && $type != ".png"&& $type != ".jpeg") { 
            array_push($errorList ,'invalid image type for thumbnail'); 
            $valid=false;  
            $thumbnail_valid = false;
        }
        if($thumbnail_valid&&$valid){
            $rand = rand(10000, 99999); 
            $pics = strstr($picname,'.',true) . date("YmdHis") . $rand .'thumbnail'. $type;
            $pic_path = "public_html/img/productImg/". $pics;
            move_uploaded_file($_FILES['thumbnail_photo_input']['tmp_name'], $pic_path);
            $imgURL_thumbnail = $pic_path;
        }     
    }
    
    $photo_name_arr = ['1_photo_input','2_photo_input','3_photo_input','4_photo_input'];
    $imgURL_arr = [];
    $colorOptionalCode_arr = [];
    $imgColor="";
    foreach ($photo_name_arr as $photo_name){
        $photo_valid= true;
        $picname = $_FILES[$photo_name]['name'];
        $picsize = $_FILES[$photo_name]['size'];
        if ($picname != "") {
            if ($picsize > 5120000) {  
                array_push($errorList ,'image size of '.$picname.' exceed 5m'); 
                $valid=false;  
                $photo_valid = false; 
            } 
            $type = strstr($picname, '.');  
            if ($type != ".gif" && $type != ".jpg" && $type != ".png"&& $type != ".jpeg") { 
                array_push($errorList ,'invalid image type for '.$picname); 
                $valid=false;  
                $photo_valid = false;
            }
            if($photo_valid&&$valid){
	            $rand = rand(10000, 99999); 
	            $pics = strstr($picname,'.',true) . date("YmdHis") . $rand .'detail'. $type;
	            switch ($photo_name) {
	                case "1_photo_input":
	                    $pic_path = "public_html/img/detailImg/". $pics;
	                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
	                    $imgColor = $_POST['color1'];
	                    $imgURL_arr[$imgColor]=$pic_path;
	                    $colorOptionalCode_arr[$imgColor]=$_POST['color_symbol_code1'];
	                    break;
	                case "2_photo_input":
	                    $pic_path = "public_html/img/detailImg/". $pics;
	                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
	                    $imgColor = $_POST['color2'];
	                    $imgURL_arr[$imgColor]=$pic_path;
	                    $colorOptionalCode_arr[$imgColor]=$_POST['color_symbol_code2'];
	                    break;
	                case "3_photo_input":
	                    $pic_path = "public_html/img/detailImg/". $pics;
	                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
	                    $imgColor = $_POST['color3'];
	                    $imgURL_arr[$imgColor]=$pic_path;
	                    $colorOptionalCode_arr[$imgColor]=$_POST['color_symbol_code3'];
	                    break;
	                case "4_photo_input":
	                    $pic_path = "public_html/img/detailImg/". $pics;
	                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
	                    $imgColor = $_POST['color4'];
	                    $imgURL_arr[$imgColor]=$pic_path;
	                    $colorOptionalCode_arr[$imgColor]=$_POST['color_symbol_code4'];
	                    break; 
	            }
            }
        }
    }
    if($valid){
            $colorArr = array_keys($imgURL_arr);
	    $colors=implode(",",$colorArr);
	    $productMgr->addProduct($product_id, $product_name, $symbol_code, $price, $colors, $description, $stock);
	    $photoMgr->AddPhoto($product_id, 'thumbnail', $imgURL_thumbnail);
	    foreach($colorArr as $color){
	        $photoMgr->AddPhoto($product_id, $color, $imgURL_arr[$color]);
	        $productMgr->addProductColorOptionalCode($product_id, $color, $colorOptionalCode_arr[$color]);
	    }
	header("Location: admin.php#viewProduct");
    }else{
        header("Location: admin.php#viewProduct");
    }
    


}elseif ($operation === "edit_product") {
    $valid=true;
    $errorList = [];
    $product_id = filter_input(INPUT_POST,'edit_product_id');
    $existingPhotoList = $photoMgr->getPhotos($product_id);
    $product_name = filter_input(INPUT_POST,'edit_product_name');
    $symbol_code = filter_input(INPUT_POST,'edit_symbol_code');
    if(empty($symbol_code)){
        $symbol_code='';
    }
    $price = filter_input(INPUT_POST,'edit_price');
    $color_count = 0;
    $color="";
    
    $description = "";
    if(!empty($_POST['editTextarea'])){
        $description = $_POST['editTextarea'];
    }
    $stock = 0.0;
    if(is_numeric(filter_input(INPUT_POST,'edit_product_stock'))){
        $stock = (float)filter_input(INPUT_POST,'edit_product_stock');
    }else{
        $valid = false;
    }
    
    $picname = $_FILES['edit_thumbnail_photo_input']['name']; 
    $picsize = $_FILES['edit_thumbnail_photo_input']['size'];
    if ($picname != "") {
        $thumbnail_valid = true;
        if ($picsize > 5120000) {  
                array_push($errorList ,'image size of thumbnail exceed 5m'); 
                $valid=false;  
                $thumbnail_valid = false;  
        } 
        $type = strstr($picname, '.');  
        if ($type != ".gif" && $type != ".jpg" && $type != ".png"&& $type != ".jpeg") { 
                array_push($errorList ,'invalid image type for thumbnail'); 
                $valid=false;  
                $thumbnail_valid = false;
        }
        if($thumbnail_valid &&$valid){
	        $rand = rand(10000, 99999); 
	        $pics = strstr($picname,'.',true) . date("YmdHis") . $rand .'thumbnail'. $type;
	        $pic_path = "public_html/img/productImg/". $pics;
	        move_uploaded_file($_FILES['edit_thumbnail_photo_input']['tmp_name'], $pic_path);
	        $thumbnail_exist=$photoMgr->checkThumbnail($product_id);
	        if($thumbnail_exist == false){
	            $photoMgr->AddPhoto($product_id, "thumbnail", $pic_path);
	        }else{
	            $photoMgr->updatePhoto($product_id, "thumbnail", "thumbnail", $pic_path);
	            unlink($existingPhotoList['thumbnail']);
	        }
        }
    }
    
    $originalColorStr = $productMgr->getColor($product_id);
    $colorArr = explode(",", $originalColorStr);
    $photo_name_arr = ['edit_1_photo_input','edit_2_photo_input','edit_3_photo_input','edit_4_photo_input'];
    $imgColor="";
    $imgOriginalColor="";
    foreach ($photo_name_arr as $photo_name){
        $photo_valid=true;
        $picname = $_FILES[$photo_name]['name']; 
        $picsize = $_FILES[$photo_name]['size'];
        if ($picname != "") {
            if ($picsize > 5120000) {  
                array_push($errorList ,'image size of '.$picname.' exceed 5m'); 
                $valid=false;  
                $photo_valid = false; 
            } 
            $type = strstr($picname, '.');  
            if ($type != ".gif" && $type != ".jpg" && $type != ".png"&& $type != ".jpeg") { 
                array_push($errorList ,'invalid mage type for '.$picname); 
                $valid=false;  
                $photo_valid = false; 
            }
            if($photo_valid&&$valid){
	            $rand = rand(10000, 99999); 
	            $pics = strstr($picname,'.',true) . date("YmdHis") . $rand . 'detail' . $type;
	            switch ($photo_name) {
	                case "edit_1_photo_input":
	                    $pic_path = "public_html/img/detailImg/". $pics;
	                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
	                    $imgColor = $_POST['edit_1_photo_color'];
	                    $imgOriginalColor = $_POST['edit_1_photo_original_color'];
	                    $key = array_search($imgOriginalColor, $colorArr);
	                    if($key === false){
	                        $photoMgr->AddPhoto($product_id, $imgColor, $pic_path);
	                        array_push($colorArr, $imgColor);
	                        $productMgr->addProductColorOptionalCode($product_id, $imgColor, $_POST['edit_color_symbol_code1']);
	                    }else{
	                        unset($colorArr[$key]);
	                        array_push($colorArr, $imgColor);
	                        $photoMgr->updatePhoto($product_id, $imgOriginalColor, $imgColor, $pic_path); 
	                        unlink($existingPhotoList[$imgOriginalColor]);
	                        $productMgr->updateProductColorOptionalCode($product_id, $imgColor, $_POST['edit_color_symbol_code1']);
	                    }
	                    
	                    break;
	                case "edit_2_photo_input":
	                    $pic_path = "public_html/img/detailImg/". $pics;
	                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
	                    $imgColor = $_POST['edit_2_photo_color'];
	                    $imgOriginalColor = $_POST['edit_2_photo_original_color'];
	                    $key = array_search($imgOriginalColor, $colorArr);
	                    if($key === false){
	                        $photoMgr->AddPhoto($product_id, $imgColor, $pic_path);
	                        array_push($colorArr, $imgColor);
	                        $productMgr->addProductColorOptionalCode($product_id, $imgColor, $_POST['edit_color_symbol_code2']);
	                    }else{
	                        unset($colorArr[$key]);
	                        array_push($colorArr, $imgColor);
	                        $photoMgr->updatePhoto($product_id, $imgOriginalColor, $imgColor, $pic_path);
	                        unlink($existingPhotoList[$imgOriginalColor]);
	                        $productMgr->updateProductColorOptionalCode($product_id, $imgColor, $_POST['edit_color_symbol_code2']);
	                    }
	                    break;
	                case "edit_3_photo_input":
	                    $pic_path = "public_html/img/detailImg/". $pics;
	                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
	                    $imgColor = $_POST['edit_3_photo_color'];
	                    $imgOriginalColor = $_POST['edit_3_photo_original_color'];
	                    $key = array_search($imgOriginalColor, $colorArr);
	                    if($key === false){
	                        $photoMgr->AddPhoto($product_id, $imgColor, $pic_path);
	                        array_push($colorArr, $imgColor);
	                        $productMgr->addProductColorOptionalCode($product_id, $imgColor, $_POST['edit_color_symbol_code3']);
	                    }else{
	                        unset($colorArr[$key]);
	                        array_push($colorArr, $imgColor);
	                        $photoMgr->updatePhoto($product_id, $imgOriginalColor, $imgColor, $pic_path);
	                        unlink($existingPhotoList[$imgOriginalColor]);
	                        $productMgr->updateProductColorOptionalCode($product_id, $imgColor, $_POST['edit_color_symbol_code3']);
	                    }
	                    break;
	                case "edit_4_photo_input":
	                    $pic_path = "public_html/img/detailImg/". $pics;
	                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
	                    $imgColor = $_POST['edit_4_photo_color'];
	                    $imgOriginalColor = $_POST['edit_4_photo_original_color'];
	                    $key = array_search($imgOriginalColor, $colorArr);
	                    if($key === false){
	                        $photoMgr->AddPhoto($product_id, $imgColor, $pic_path);
	                        array_push($colorArr, $imgColor);
	                        $productMgr->addProductColorOptionalCode($product_id, $imgColor, $_POST['edit_color_symbol_code4']);
	                    }else{
	                        unset($colorArr[$key]);
	                        array_push($colorArr, $imgColor);
	                        $photoMgr->updatePhoto($product_id, $imgOriginalColor, $imgColor, $pic_path); 
	                        unlink($existingPhotoList[$imgOriginalColor]);
	                        $productMgr->updateProductColorOptionalCode($product_id, $imgColor, $_POST['edit_color_symbol_code4']);
	                    }
	                    break;
	            }
            }
        }
    }
    if($valid){
        $colors=implode(",",$colorArr);
        $productMgr->updateProduct($product_id, $product_name, $symbol_code, $price, $colors, $description, $stock);
        header("Location: admin.php#viewProduct");
    }else{
        header("Location: admin.php#viewProduct");
    }
    
}elseif ($operation === "add_product_to_cart"){
    session_start();
    $customer_id = $_SESSION["userid"];
    //$customer_id = filter_input(INPUT_POST,'customer_id');
    $product_id = filter_input(INPUT_POST,'product_id');
    $qty = filter_input(INPUT_POST,'product_qty');
    $productMgr->addProductToShoppingCart($customer_id, $product_id, $qty);
    //$_SESSION["message_add_cart"] = "Your Selected Prodcut has been added";
	//header("Location: testAddToCart.php");
}elseif ($operation === "deletePhoto"){
    $product_id = addslashes(filter_input(INPUT_POST, 'product_id'));
    $photo_type = addslashes(filter_input(INPUT_POST, 'photo_type'));
    $photoMgr->deletePhoto($product_id,$photo_type);
    $color_str = $productMgr->getColor($product_id);
    $color_arr = explode(",", $color_str);
    if (($key = array_search($photo_type, $color_arr)) !== false) {
        unset($color_arr[$key]);
    }
    $new_color_str = implode(",", $color_arr);
    $productMgr->updateColor($product_id, $new_color_str);
    $productMgr->deleteColorOptionalCodeByProductColor($product_id, $photo_type);
    $return = [];
    $return['status']='success';
    echo json_encode($return);
}elseif ($operation === "updateColor"){
    $product_id = addslashes(filter_input(INPUT_POST, 'product_id'));
    $new_color = addslashes(filter_input(INPUT_POST, 'new_color'));
    $old_color = addslashes(filter_input(INPUT_POST, 'old_color'));
    $color_str = $productMgr->getColor($product_id);
    $new_color_str = str_replace($old_color,$new_color,$color_str);
    $productMgr->updateColor($product_id, $new_color_str);
    $productMgr->updateColorInOptionalCodeTable($product_id, $new_color, $old_color);
    $photoMgr->updateColorInPhotoTable($product_id, $new_color, $old_color);
    $return = [];
    $return['status']='success';
    echo json_encode($return);
}elseif ($operation === "updateColorSymbolCode"){
    $product_id = addslashes(filter_input(INPUT_POST, 'product_id'));
    $color = addslashes(filter_input(INPUT_POST, 'color'));
    $symbol_code = addslashes(filter_input(INPUT_POST, 'symbol_code'));
    $productMgr->updateProductColorOptionalCode($product_id, $color, $symbol_code);
    $return = [];
    $return['status']='success';
    echo json_encode($return);
}elseif ($operation === "deleteProduct"){
    $productIdList_str = filter_input(INPUT_POST,'productIdList');
    $productIdList=explode(",",$productIdList_str);
    foreach($productIdList as $id){
        $count = $orderMgr->checkProductPendingOrderStatus($id);
        if ($count===0){
            $productMgr->deleteProduct($id);//delete from product table
            $photoMgr->deleteAllPhotosByProduct($id);//delete from photo table
            $productMgr->deleteAllColorOptionalCodeByProduct($id);//delete from optional_code table
        } 
    }
header("Location: admin.php#viewProduct");
}
?>