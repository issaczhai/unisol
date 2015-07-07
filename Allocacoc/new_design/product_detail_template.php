<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./public_html/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public_html/font-awesome-4.1.0/css/font-awesome.min.css">
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

        <div class="col-sm-10 product-detail">
            <div class="col-sm-4 img-detail">
                <img src='./public_html/img/detailImg/typeG_Extended_S.jpg'>
            </div>

            <div class="col-sm-8 product-overview">
                <h2 class="product-name">PowerCube |Original|</h2>
                <span>multiply your socket</span>
                <h3 class="price-lg">$19.9 <span> incl.VAT</span></h3>
                <form class="cart-form">
                    <div class="form-wrapper">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default">
                                <span class="sort-value">5ft (1.5m) cable</span>
                            </button>
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php
                                    
                                ?>
                                <li><a href="#">10ft (2.0m) cable</a></li>
                                <li><a href="#">15ft (2.5m) cable</a></li>
                                <li><a href="#">20ft (3.0m) cable</a></li>
                                <li><a href="#">25ft (3.5m) cable</a></li>
                            </ul>
                        </div>
                        <div class="btn-group color-selection">
                               <div>choose color </div>
                               <div class="color">
                                   <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                   <label for="inlineRadio3" style="background-color: rgb(31, 92, 153)">
                                   </label>
                               </div>
                               <div class="color">
                                   <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
                                   <label for="inlineRadio3" style="background-color: rgb(31, 92, 153)">
                                   </label>
                               </div>
                               <div class="color">
                                   <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
                                   <label for="inlineRadio3" style="background-color: rgb(31, 92, 153)">
                                   </label>
                               </div>
                               <div class="color">
                                   <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
                                   <label for="inlineRadio3" style="background-color: rgb(31, 92, 153)">
                                   </label>
                               </div>
                                
                        </div>
                        <div class="input-group number-spinner" style="">
                            <span class="qty-text">qty  </span>
                            <span class="input-group-btn">
                                <button class="btn btn-default" data-dir="dwn" data-stock=''><span class="glyphicon glyphicon-minus"></span></button>
                            </span>
                            <input id='' type="text"  data-id='' data-stock='' class="form-control text-center qty-input" value="1">
                            <span class="input-group-btn">
                                <button class="btn btn-default" data-dir="up" data-stock=''><span class="glyphicon glyphicon-plus"></span></button>
                            </span>

                        </div>

                        <button class="btn btn-default cart-button"> add to cart </button>

                    </div>
                </form>
            </div>

        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-10  product-description">
            <div class="row single-characteristic">
                <div class="col-sm-2">
                <img src='./public_html/img/questionMark.png'>
                </div>

                <div class="col-sm-10 char-description">
                <p>
                    Often we will find ourselves short of power sockets at home to supply power to all the appliances that we want to use at the same time. Either because they are blocked by bulky plugs and cannot be used anymore, or there are just a few near us. Using regular extension cords to multiply sockets, often deals with long unnecessary cords.
                </p>
                </div>
            </div>
            
            <div class="row single-characteristic">
                <div class="col-sm-2">
                <img src='./public_html/img/lightBulb.png'>
                </div>

                <div class="col-sm-10 char-description">
                    <h4>PowerCube |Original|</h4>
                </div>
            </div>

            <div class="row single-characteristic">
                <div class="col-sm-2">
                <img src='./public_html/img/tick-lg.png'>
                </div>

                <div class="col-sm-10 char-description">
                    <ul>
                        <li>Provides five additional outlets, and can expand to even more outlets when combined</li>
                        <li>Prevents plugs from blocking each other, due to cubic shape</li>
                        <li>Compact design</li>
                    </ul>
                </div>
            </div>

            <div class="row single-characteristic">
                <div class="col-sm-2">
                <img src='./public_html/img/star.png'>
                </div>

                <div class="col-sm-10 char-description">
                    <ul>
                        <li>Provides five additional outlets, and can expand to even more outlets when combined</li>
                        <li>Prevents plugs from blocking each other, due to cubic shape</li>
                        <li>Compact design</li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</div>
    <?php
        $currentPage = "product";
        include_once("./templates/footer.php");
        ?>
<script src="./public_html/js/jquery-1.11.0.js"></script>
<script src="./public_html/js/bootstrap.min.js"></script> 
<script>
        $(document).on('click', '.number-spinner button', function () {    
            console.log($(this).attr('data-stock'));
            
            var oldValue = $(this).closest('.number-spinner').find('input').val();
            var newVal = 0;
            var stock = $(this).attr('data-stock');
            if ($(this).attr('data-dir') === 'up') {
                if(parseInt(oldValue)<stock){
                    newVal = parseInt(oldValue) + 1;
                }else{
                    //$(this).addClass('disabled');
                    newVal = stock;
                }
            } else {
                    console.log('down');
                    if (oldValue > 1) {
                            newVal = parseInt(oldValue) - 1;
                    } else {
                            newVal = 1;
                    }
            }
            console.log(newVal);
            $('.number-spinner').find('input').val(newVal);
        });

        function changeImg(source){
            document.getElementById('display_img').src = source;
        }
    </script>
</body>
</html>
