<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (session_status()!=PHP_SESSION_ACTIVE) {
        session_start();
}
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
include_once("./Manager/PhotoManager.php");
$photoMgr = new PhotoManager();
$filter_type = addslashes(filter_input(INPUT_POST, 'filter_type'));
$customer_id = filter_input(INPUT_POST, 'customer_id');
if(empty($customer_id)){
    $customer_id = '';
}
$productMgr = new ProductManager();
$filtered_products = [];
//$display = '';
if($filter_type=='allproducts'){
    $filtered_products = $productMgr->getAllProduct();
}else{
    $filtered_products = $productMgr->filterProduct($filter_type);
}

    if(!empty($filtered_products)) {
        $_SESSION['results'] = $filtered_products;
        foreach ($filtered_products as $eachProduct){
            $product_name = $eachProduct["product_name"];
            $price = $eachProduct["price"];
            $product_id = $eachProduct["product_id"];
            $photoList = $photoMgr->getPhotos($product_id);
            $photo_url = $photoList["thumbnail"];
?>
            <div class='col-sm-6'>
                <div class='product-wrapper'>
                    <div class='product-img'>
                        <a href="./product_detail.php?selected_product_id=<?=$product_id ?>&customer_id=<?=$customer_id ?>">
                            <img src='<?=$photo_url?>'>
                        </a>
                    </div>
                    <div class='product-summary'> 
                        <h5 class="product-name"><a href='./product_detail.php?selected_product_id=<?=$product_id ?>&customer_id=<?=$customer_id ?>'><?= $product_name ?></a></h5>
                        <h5 class="price">$<?= number_format($price,1,'.','') ?> <span> incl.VAT</span></h5>
                    </div>
                </div>
            </div>
<?php
        }
    }else{
?>
            <div align="center">
                <h2 style="font-family:'Arial Black', Gadget, sans-serif;font-size:30px;color:#0099FF;">No Results with this filter</h2>
            </div>
<?php
    }    