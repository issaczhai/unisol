
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
// define the filter type chosen before sort if any
$filter_type_get = addslashes(filter_input(INPUT_POST, 'filter_type'));
$customer_id = filter_input(INPUT_POST, 'customer_id');
if(empty($customer_id)){
    $customer_id = '';
}
//$pos = strpos($filter_type_get, " ");
//$filter_type_lower = strtolower(substr($filter_type_get, 0, $pos));
$filter_type_lower = strtolower($filter_type_get);
$filter_type = $filter_type_lower;

//$display = '';
switch ($filter_type_lower) {
            case "powercube":
                //$display = 'POWERCUBE FAMILY';
                $filter_type = 'PowerCube';
                break;
            case "rewirable":
                //$display = 'REWIRABLE FAMILY';
                $filter_type = 'ReWirable';
                break;
            case "remote":
                //$display = 'REMOTE FAMILY';
                $filter_type = 'Remote';
                break;

            default: 
                //$display = 'ALL PRODUCTS';
                break;
}
// define the sort type chosen by user
$sort_type_get = addslashes(filter_input(INPUT_POST, 'sort_type'));
$sort_type = '';
if($sort_type_get=='priceHL'){
    $sort_type = 'DESC';
}else if($sort_type_get=='priceLH'){
    $sort_type = 'ASC';
}else{
    $sort_type = 'default';
}

$productMgr = new ProductManager();
$sorted_products = [];

if($filter_type=='all' && $sort_type!='default'){
    $sorted_products = $productMgr->sortAll($sort_type);
}else if($filter_type!='all' && $sort_type=='default'){
    $sorted_products = $productMgr->filterProduct($filter_type);
    
}else if($filter_type=='all' && $sort_type=='default'){
    $sorted_products = $productMgr->getAllProduct();
}else{
    $sorted_products = $productMgr->sortWithFilter($filter_type,$sort_type);
}

    if(!empty($sorted_products)) {
   /*     
?>
        <h2 class="title text-center"><?=$display ?></h2>
<?php
   
   */
        //put the result into session
        $_SESSION['results'] = $sorted_products;
        foreach ($sorted_products as $eachProduct){
            $product_name = $eachProduct["product_name"];
            $price = $eachProduct["price"];
            $product_id = $eachProduct["product_id"];
?>
            <div class='col-sm-6'>
                <div class='product-wrapper'>
                    <div class='product-img'>
                        <a href="./product_detail.php?selected_product_id=<?=$product_id ?>&customer_id=<?=$customer_id ?>">
                        <img src='./public_html/img/productImg/GE.png'>
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