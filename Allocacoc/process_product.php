<?php
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
include_once("./Manager/PhotoManager.php");

$productMgr = new ProductManager();
$photoMgr = new PhotoManager();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$operation = filter_input(INPUT_POST,'operation');
//echo $operation;

if ($operation === "add_product"){
    $valid=true;
    $product_name = filter_input(INPUT_POST,'product_name');
    $random_no = (string)rand(0,10000);
    $product_id = "AL".$random_no;
    $price = filter_input(INPUT_POST,'price');
    $color_count = 0;
    $color="";
    if(!empty($_POST['color'])){
        foreach($_POST['color'] as $c) {
            $color_count += 1;
            if($color_count===1){
                $color.=$c;
            }else{
		$color.=(",".$c);
            }   
        }
    }
    $description = "";
    if(!empty($_POST['add_product_description'])){
        $description = $_POST['add_product_description'];
    }
    $stock = 0.0;
    if(is_numeric(filter_input(INPUT_POST,'add_product_stock'))){
        $stock = (float)filter_input(INPUT_POST,'add_product_stock');
    }else{
        $valid = false;
    }
    $photo_name_arr = ['1_photo_input','2_photo_input'];
    $imgURL_1=$imgURL_2="";
    foreach ($photo_name_arr as $photo_name){
        $picname = $_FILES[$photo_name]['name']; 
        $picsize = $_FILES[$photo_name]['size'];
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
            $rand = rand(10000, 99999); 
            $pics = $picname . date("YmdHis") . $rand . $type;
            switch ($photo_name) {
                case "1_photo_input":
                    $pic_path = "public_html/img/productImg/". $pics;
                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
                    $imgURL_1 = $pic_path;
                    break;
                case "2_photo_input":
                    $pic_path = "public_html/img/detailImg/". $pics;
                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
                    $imgURL_2 = $pic_path;
                    break;     
            }
        }
    }
    $productMgr->addProduct($product_id, $product_name, $price, $color, $description, $stock);
    $photoMgr->AddPhoto($product_id, '1', $imgURL_1);
    $photoMgr->AddPhoto($product_id, '2', $imgURL_2);
header("Location: admin.php");
}elseif ($operation === "edit_product") {
    $valid=true;
    $product_id = filter_input(INPUT_POST,'edit_product_id');
    $product_name = filter_input(INPUT_POST,'edit_product_name');
    $price = filter_input(INPUT_POST,'edit_price');
    $color_count = 0;
    $color="";
    
    if(!empty($_POST['edit_color'])){
        foreach($_POST['edit_color'] as $c) {
            
            $color_count += 1;
            if($color_count===1){
                $color.=$c;
            }else{

                $color.=(",".$c);
            }   
        }
    }
    //echo $color;
    $description = "";
    if(!empty($_POST['edit_product_description'])){
        $description = $_POST['edit_product_description'];
    }
    $stock = 0.0;
    if(is_numeric(filter_input(INPUT_POST,'edit_product_stock'))){
        $stock = (float)filter_input(INPUT_POST,'edit_product_stock');
    }else{
        $valid = false;
    }
    
    $productMgr->updateProduct($product_id, $product_name, $price, $color, $description, $stock);
    $photo_name_arr = ['edit_1_photo_input','edit_2_photo_input'];
    $imgURL_1=$imgURL_2="";

    foreach ($photo_name_arr as $photo_name){
        $picname = $_FILES[$photo_name]['name']; 
        $picsize = $_FILES[$photo_name]['size'];
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
            $rand = rand(10000, 99999); 
            $pics = $picname . date("YmdHis") . $rand . $type;
            switch ($photo_name) {
                case "edit_1_photo_input":
                    $pic_path = "public_html/img/productImg/". $pics;
                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
                    $imgURL_1 = $pic_path;
                    break;
                case "edit_2_photo_input":
                    $pic_path = "public_html/img/productImg/". $pics;
                    move_uploaded_file($_FILES[$photo_name]['tmp_name'], $pic_path);
                    $imgURL_2 = $pic_path;
                    break;      
            }
        }
    }
    $new_photo_arr = [$imgURL_1,$imgURL_2];
    $type = '';
    for($i=0;$i<2;$i++){
        switch ($i) {
                case 0:
                    $type = '1';
                    break;
                case 1:
                    $type = '2';
                    break;
            }
            
        if($new_photo_arr[$i] !== ""){
            $photoMgr->update($product_id, $type, $new_photo_arr[$i]);
        }
    }
header("Location: admin.php");
}elseif ($operation === "add_product_to_cart"){
    session_start();
    $customer_id = $_SESSION["userid"];
    //$customer_id = filter_input(INPUT_POST,'customer_id');
    $product_id = filter_input(INPUT_POST,'product_id');
    $qty = filter_input(INPUT_POST,'product_qty');
    $productMgr->addProductToShoppingCart($customer_id, $product_id, $qty);
    //$_SESSION["message_add_cart"] = "Your Selected Prodcut has been added";
	//header("Location: testAddToCart.php");
}
?>