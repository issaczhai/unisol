<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="./public_html/css/webShop.css">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
// put your code here
?>
<div class='container'>
    
    <div class='row'>
        <div class='col-sm-10 banner'>
            <div class='col-sm-12 bannerPhoto'>
            <img src='./public_html/img/shopHeadBG/bg.png'>    
            </div>

            <div class='allocacocLogo'>
                <img src='public_html/img/allocacoc_NoText.png'><span class='logoText'>Webshop</span>
            </div>

            <div class="col-sm-12 overlay">
                <ul class="overlay-nav">
                    <li class="overlay-nav-item">
                        <a class='overlay-text' href="#">shop</a>
                    </li>
                    <li class="overlay-nav-item">
                        <a class='overlay-text' href="#"><i class="fa fa-shopping-cart fa-lg"></i> cart</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class='col-sm-9 category'>

            <div class='col-sm-6'>
                <div class='product-wrapper'>
                    <div class='product-img'>
                        <img src='./public_html/img/productImg/GE.png'>
                    </div>
                    <div class='product-summary'> 
                        <h5 class="product-name"><a href='#'>Product Name |Name|</a></h5>
                        <h5 class="price">$19.9 <span> incl.VAT</span></h5>
                    </div>
                </div>
            </div>
            
            <div class='col-sm-6 '>
                <div class='product-wrapper'>
                    <div class='product-img'>
                        <img src='./public_html/img/productImg/GEU.png'>
                    </div>
                    
                    <div class='product-summary'> 
                        <h5 class="product-name"><a href='#'>Product Name |Name|</a></h5>
                        <h5 class="price">$19.9 <span> incl.VAT</span></h5>
                    </div>
                </div>
            </div>
            
            <div class='col-sm-6'>
                <div class='product-wrapper'>
                    <div class='product-img'>
                        <img src='./public_html/img/productImg/GE.png'>
                    </div>
                    <div class='product-summary'> 
                        <h5 class="product-name"><a href='#'>Product Name |Name|</a></h5>
                        <h5 class="price">$19.9 <span> incl.VAT</span></h5>
                    </div>
                </div>
            </div>
            
            <div class='col-sm-6 '>
                <div class='product-wrapper'>
                    <div class='product-img'>
                        <img src='./public_html/img/productImg/GEU.png'>
                    </div>
                    
                    <div class='product-summary'> 
                        <h5 class="product-name"><a href='#'>Product Name |Name|</a></h5>
                        <h5 class="price">$19.9 <span> incl.VAT</span></h5>
                    </div>
                </div>
            </div>

            <div class='col-sm-6'>
                <div class='product-wrapper'>
                    <div class='product-img'>
                        <img src='./public_html/img/productImg/GE.png'>
                    </div>
                    <div class='product-summary'> 
                        <h5 class="product-name"><a href='#'>Product Name |Name|</a></h5>
                        <h5 class="price">$19.9 <span> incl.VAT</span></h5>
                    </div>
                </div>
            </div>
            
            <div class='col-sm-6 '>
                <div class='product-wrapper'>
                    <div class='product-img'>
                        <img src='./public_html/img/productImg/GEU.png'>
                    </div>
                    
                    <div class='product-summary'> 
                        <h5 class="product-name"><a href='#'>Product Name |Name|</a></h5>
                        <h5 class="price">$19.9 <span> incl.VAT</span></h5>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
    
    <?php
    $currentPage = "";
    include_once("./templates/footer.php");
    ?>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
</body>
</html>
