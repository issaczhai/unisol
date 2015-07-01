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
        /*
        switch ($filter_type) {
            case "PowerCube":
                $display = 'POWERCUBE FAMILY';
                break;
            case "ReWirable":
                $display = 'REWIRABLE FAMILY';
                break;
            case "Remote":
                $display = 'REMOTE FAMILY';
                break;

            default: $display = 'ALL PRODUCTS';
                break;
        }
?>
        <ul class="refine_bar" style='border:1px solid #000000;height:40px;padding-top: 10px'>
            <li><a href="javascript:filter('allproducts')">All</a></li>
            <li><a href="javascript:filter('PowerCube')">PowerCube</a></li>
            <li><a href="javascript:filter('ReWirable')">ReWirable</a></li>
            <li><a href="javascript:filter('Remote')">Remote</a></li>
        </ul>
<?php
         */
        $_SESSION['results'] = $filtered_products;
        foreach ($filtered_products as $eachProduct){
            $product_name = $eachProduct["product_name"];
            $price = $eachProduct["price"];
            $product_id = $eachProduct["product_id"];
?>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                       <div class="productinfo text-center">
                           <div class="productImg" style="width:206px;height:238px;overflow:hidden;position:relative">
                               <a href="./product_detail.php?selected_product_id=<?=$product_id ?>&customer_id=<?=$customer_id ?>"><img class="product-image" style="position:absolute !important;" src="./public_html/img/GE.png" alt="" onload="OnProductImageLoad(event);" /></a>
                           </div>

                           <!--<div  style="white-space:nowrap;overflow:hidden; text-overflow:ellipsis">-->
                           <div style="height:45px">
                               <a href="./product_detail.php?selected_product_id=<?=$product_id ?>&customer_id=<?=$customer_id ?>" style="text-decoration: none;"><h5><?=$product_name ?></h5></a>
                           </div>
                           <p>SGD <?= number_format($price,1,'.','') ?></p>

                       </div>
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