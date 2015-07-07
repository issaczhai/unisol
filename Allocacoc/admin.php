<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
$_SESSION["admin_id"] = "michael";
include 'protect/admin_protect.php'; 

foreach(glob($_SERVER['DOCUMENT_ROOT'].'/Manager/*.php') as $file) {
     include_once $file;
}

$admin = $_SESSION["admin_id"];

$productMgr = new ProductManager();
$product_list = $productMgr->getAllProduct();
$no_of_products = sizeof($product_list);


$creditMgr = new CreditManager();
$total_no_invitation = $creditMgr->getNoOfInvitation();

$fdpMgr = new FdpManager();

$current_free_delivery_fee = $fdpMgr->getFreeDeliveryPrice();

?>

<html>   
    <head>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script> 
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Administration</title>
        
        <!-- Bootstrap Core CSS -->
        <link href="public_html/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="public_html/css/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="public_html/css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="public_html/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
        <style>
            .btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block; 
            *display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px; 
            *line-height:20px;color:#fff; 
            text-align:center;vertical-align:middle;cursor:pointer;background:#5bb75b; 
            border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf; 
            border-bottom-color:#b3b3b3;-webkit-border-radius:4px; 
            -moz-border-radius:4px;border-radius:4px;} 
            .btn input{position: absolute;top: 0; right: 0;margin: 0;border:solid transparent; 
            opacity: 0;filter:alpha(opacity=0); cursor: pointer;} 
            .btn button{position: absolute;top: 0; right: 0;margin: 0;border:solid transparent; 
            opacity: 0;filter:alpha(opacity=0); cursor: pointer;} 
        </style>
        
    </head>
    
   
    <body>
        <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php">Allocacoc Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $admin ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-user"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="dashboard_tab" class="active">
                        <a href="#dashboard" data-toggle="tab"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li id="addProduct_tab">
                        <a href="#addProduct" data-toggle="tab"><i class="fa fa-fw fa-plus"></i> Add Product</a>
                    </li>
                    <li id="viewProduct_tab">
                        <a href="#viewProduct" data-toggle="tab"><i class="fa fa-fw fa-table"></i> View Products</a>
                    </li>
                    <li id="freeDeliveryPrice_tab">
                        <a href="#freeDeliveryPrice" data-toggle="tab"><i class="fa fa-fw fa-usd"></i> Free Delivery Price</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

            <div class="tab-content">
                <div class="tab-pane fade active in" id="dashboard">
                    <div id="page-wrapper">

                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        Dashboard <small style="font-size: 50%">Statistics Overview</small>
                                    </h1>
                                    <ol class="breadcrumb">
                                        <li class="active">
                                            <i class="fa fa-dashboard"></i> Summary
                                        </li>
                                    </ol>
                                </div>
                            </div>

                            <!-- /.row -->

                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-tasks fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge"><?php echo $no_of_products ?></div>
                                                    <div>Products</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="panel panel-green">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-share fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge"><?php echo $total_no_invitation ?></div>
                                                    <div> Invitations</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="panel panel-yellow">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">TOP 3</div>
                                                    <div>Popular Products</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- /#page-wrapper -->

                </div>
                
                <!--addProduct tab content-->
                <div class="tab-pane fade" id="addProduct">
                    <div id="page-wrapper">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        Add Product
                                    </h1>
                                </div>
                            </div>
                            
                            <!--ADD PRODUCT TABLE ROW-->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" id="add_product_table">
                                                    <tbody>
                                                        <form id='addProductForm' method='POST' enctype='multipart/form-data' action='process_product.php'>
                                                            <input type='hidden' name='operation' value='add_product'/>
                                                        <tr>
                                                        <td>Product Name</td>
                                                        <td>
                                                            <input id="product_name" type="text" name="product_name" maxlength="50" required/>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>Price</td>
                                                        <td>
                                                            <input id="price" type="text" name="price" required/>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>Color</td>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td><input type="checkbox" class="add_product_checkbox" id="color" name="color[]" value="ffffff">White</td>
                                                                    <td><input type="checkbox" class="add_product_checkbox" id="color" name="color[]" value="000000">Black</td>
                                                                    <td><input type="checkbox" class="add_product_checkbox" id="color" name="color[]" value="c0c0c0">Silver</td>
                                                                    <td><input type="checkbox" class="add_product_checkbox" id="color" name="color[]" value="808080">Gray</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="checkbox" class="add_product_checkbox" id="color" name="color[]" value="ff0000">Red</td>
                                                                    <td><input type="checkbox" class="add_product_checkbox" id="color" name="color[]" value="f0f8ff">Blue</td>
                                                                    <td><input type="checkbox" class="add_product_checkbox" id="color" name="color[]" value="008000">Green</td>
                                                                    <td><input type="checkbox" class="add_product_checkbox" id="color" name="color[]" value="ffa500">Orange</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Description</td>					
                                                            <td>
                                                                <textarea rows="5" cols="55" id="add_product_description" name="add_product_description"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Stock</td>
                                                            <td>
                                                                <input type='text' id='add_product_stock' name='add_product_stock' required/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Photo</td>
                                                            <td>
                                                                <table width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="40%">
                                                                                
                                                                                
                                                                                <div class="btn" style="width:80%">
                                                                                <span>  Photo (167 x 167) </span>
                                                                                <input type="file" name="1_photo_input" id="1_photo_input" onchange="check('1_photo')"/>
                                                                                </div>
                                                                                <div id="1_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                                <div id="1_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>

                                                                            </td>
                                                                            <td width="40%">
                                                                                <div class="btn" style="width:80%">
                                                                                <span>  Photo (280 x 280) </span>
                                                                                <input type="file" name="2_photo_input" id="2_photo_input" onchange="check('2_photo')"/>
                                                                                </div>
                                                                                <div id="2_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                                <div id="2_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>

                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td><div class="btn"><span>  Add  </span><input type="submit" name='submit'/></div></td>
                                                        </tr>
                                                        </form>
                                                    </tbody>
                                                </table>
                                            </div>
<!--                                        <div class="text-right">
                                                <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- /#page-wrapper -->
                </div>
                
                
                <!--viewProduct tab content-->
                <div class="tab-pane fade" id="viewProduct">
                    <div id="page-wrapper">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        View Product
                                    </h1>
                                </div>
                            </div>
                            
                            <!--VIEW PRODUCT TABLE ROW-->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="fa fa-table fa-fw"></i> Product List</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" id="display_product">
                                                    <thead>
                                                        <tr>
                                                            <th>Product ID</th>
                                                            <th>Product Name</th>
                                                            <th>Price</th>
                                                            <th>Color</th>
                                                            <th>Stock</th>
                                                            <th width="10%">Edit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $photoMgr = new PhotoManager();
                                                        foreach ($product_list as $product){
                                                           
                                                           $p_id = $product["product_id"];
                                                           $p_name = $product["product_name"];
                                                           $p_price = $product["price"];
                                                           $p_color = $product["color"];
                                                           $description = $product["description"];
                                                           $p_stock = $product["stock"];
                                                           $photo_url_arr = [];
                                                           $photo_url_arr =$photoMgr->getPhotos($p_id);
                                                        ?>
                                                           <tr>
                                                               <td><?php echo $p_id; ?></td>
                                                               <td><?php echo $p_name; ?></td>
                                                               <td><?php echo $p_price; ?></td>
                                                               <td><?php echo $p_color; ?></td>
                                                               <td><?php echo $p_stock; ?></td>
                                                               <td><div class="btn"><span>Edit<i class="fa fa-edit"></i></span><input type="button" onclick="showEditTab();populateEditField('<?php echo $p_id ?>','<?php echo $p_name ?>','<?php echo $p_price ?>','<?php echo $p_color ?>','<?php echo $p_stock ?>','<?php echo $description ?>','<?php echo $photo_url_arr['1'] ?>','<?php echo $photo_url_arr['2'] ?>');" value="Edit Product"/></div></td>
                                                           </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
<!--                                        <div class="text-right">
                                                <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /#page-wrapper -->
                </div>
                
                <!-- Edit Product page -->
                <!-- Only appear when user click "EDIT" button in dispay product table -->
                <div class="tab-pane fade" id="editProduct">
                    <div id="page-wrapper"> 
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        Edit Product
                                    </h1>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="fa fa-table fa-fw"></i> Edit Product </h3>
                                        </div>
                                        
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" id="edit_product">
                                                    
                                                    <tbody>
                                                    <form id='editProductForm' enctype='multipart/form-data' method='POST' action='process_product.php'>
                                                        <input type='hidden' id='operation' name='operation' value='edit_product'/>
                                                        <input type='hidden' id='edit_product_id' name='edit_product_id'/>
                                                        <tr>
                                                            <td>Product Name</td>
                                                            <td>
                                                                <input id="edit_product_name" type="text" name="edit_product_name" maxlength="50" required/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Price</td>
                                                            <td>
                                                                <input id="edit_price" type="text" name="edit_price" required/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Color</td>
                                                            <td>
                                                                <table>
                                                                    <tr>
                                                                        <td><input type="checkbox" class="edit_product_checkbox" id="edit_color1" name="edit_color[]" value="ffffff">White</td>
                                                                        <td><input type="checkbox" class="edit_product_checkbox" id="edit_color2" name="edit_color[]" value="000000">Black</td>
                                                                        <td><input type="checkbox" class="edit_product_checkbox" id="edit_color3" name="edit_color[]" value="c0c0c0">Silver</td>
                                                                        <td><input type="checkbox" class="edit_product_checkbox" id="edit_color4" name="edit_color[]" value="808080">Gray</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><input type="checkbox" class="edit_product_checkbox" id="edit_color5" name="edit_color[]" value="ff0000">Red</td>
                                                                        <td><input type="checkbox" class="edit_product_checkbox" id="edit_color6" name="edit_color[]" value="f0f8ff">Blue</td>
                                                                        <td><input type="checkbox" class="edit_product_checkbox" id="edit_color7" name="edit_color[]" value="008000">Green</td>
                                                                        <td><input type="checkbox" class="edit_product_checkbox" id="edit_color8" name="edit_color[]" value="ffa500">Orange</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Description</td>					
                                                            <td>
                                                                <textarea rows="5" cols="55" id="edit_product_description" name="edit_product_description"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Stock</td>
                                                            <td>
                                                                <input type='text' id='edit_product_stock' name='edit_product_stock' required/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Photo</td>
                                                            <td>
                                                                <table width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="20%">
                                                                                
                                                                                
                                                                                <div class="btn" style="width:80%">
                                                                                <span>  Photo 1  </span>
                                                                                <input type="file" name="edit_1_photo_input" id="edit_1_photo_input" onchange="check('edit_1_photo')"/>
                                                                                </div>
                                                                                <div id="edit_1_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                                <div id="edit_1_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>
<!--                                                                                <input type="hidden" id="imgURL_overall"/>-->
                                                                                <a class="thumbnail">
                                                                                    <img id="imgURL_1_thumbnail" src="./public_html/img/no-image.png" alt="..." height="100" width="100">
                                                                                </a>
                                                                            </td>
                                                                            <td width="20%">
                                                                                <div class="btn" style="width:80%">
                                                                                <span>  Photo 2  </span>
                                                                                <input type="file" name="edit_2_photo_input" id="edit_2_photo_input" onchange="check('edit_2_photo')"/>
                                                                                </div>
                                                                                <div id="edit_2_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                                <div id="edit_2_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>
<!--                                                                                <input type="hidden" id="imgURL_left"/>-->
                                                                                <a class="thumbnail">
                                                                                    <img id="imgURL_2_thumbnail" src="./public_html/img/no-image.png" alt="..." height="100" width="100">
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td><div class="btn"><span>Update<i class="fa fa-check"></i></span><input type="submit" value='Confirm'/></div></td>
                                                        </tr>
                                                    </form>
                                                    </tbody>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                
                
                <!--freeDeliveryPrice tab content-->
                <div class="tab-pane fade" id="freeDeliveryPrice">
                    <div id="page-wrapper">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        Free Delivery Price
                                    </h1>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped" id="display_product">
                                            <thead>
                                                <tr>
                                                    <th width="60%">Current Free Delivery Price</th>
                                                    <th width="40%">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td> $ <span id="current_free_delivery_fee"><?php echo $current_free_delivery_fee; ?></span>
                                                    <input id="free_delivery_price_entry" name="new_free_delivery_price" type="text" style="display:none;"></input>
                                                    <button id="confirm_free_delivery_price_change" style="display:none" onclick="update_free_delivery_price()">OK</button>
                                                </td>
                                                <td>
                                                    <div class="btn" style="background: #0083C9"><span> Edit <i class="fa fa-edit"></i></span><input type="button" name='show_update_free_delivery_price_button' onclick="show_update_free_delivery_price_input()" value='Update'/></div>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- /#wrapper -->
            </div>
        
        </div>
        


<!-- jQuery Version 1.11.0 -->


<!-- Bootstrap Core JavaScript -->
<script src="public_html/js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="public_html/js/plugins/morris/raphael.min.js"></script>
<script src="public_html/js/plugins/morris/morris.min.js"></script>
<script src="public_html/js/plugins/morris/morris-data.js"></script>
        
<script>

function check(id){
    var fd = new FormData(document.getElementById("addProductForm"));
    $.ajax({
        type: 'post',
        url: 'check_photo.php?photo='+id+'_input',
        data: fd,
        dataType: 'json',
        contentType: false,
        processData: false,
        error: function(data){
            console.log(data.responseText);
            document.getElementById(id+'_close').style.display="block";
            document.getElementById(id+'_check').style.display="none";
        },
        success: function(data){
            document.getElementById(id+'_check').style.display="block";
            document.getElementById(id+'_close').style.display="none";

        }
    });
}


function show_update_free_delivery_price_input(){
    $('#confirm_free_delivery_price_change').css('display','');
    $('#free_delivery_price_entry').css('display','');
    $('#current_free_delivery_fee').css('display','none');
    

}

function update_free_delivery_price(){
    var new_free_delivery_priceStr = "";
    var  new_free_delivery_price;
    if($( "#free_delivery_price_entry" ).val()!==null){
        new_free_delivery_priceStr = $('#free_delivery_price_entry').val();
    }
    var valid = true;
    
    if(isNaN(new_free_delivery_priceStr)){
        valid = false;

    }else{ 
        if(new_free_delivery_priceStr.length>0){
            new_free_delivery_price = parseFloat(new_free_delivery_priceStr);	
        }else{
            valid = false;

        }
    }
    $('#confirm_free_delivery_price_change').css('display','none');
    $('#free_delivery_price_entry').css('display','none');
    $('#current_free_delivery_fee').css('display','');
    if(valid){
        var redirect_path= './process_free_delivery_price.php?new_free_delivery_price='+new_free_delivery_price;
        
        document.location.href =redirect_path;
    }
    
}

function showEditTab(){
    document.getElementById("editProduct").className = "tab-pane fade active in";
    document.getElementById("viewProduct").className = "tab-pane fade";
}



function hideEditTab(){
    document.getElementById("editProduct").className = "tab-pane fade";
    document.getElementById("viewProduct").className = "tab-pane fade active in";
}

function populateEditField(product_id,p_name,p_price,p_color,p_stock,p_description,url1,url2){
    document.getElementById("edit_product_id").value = product_id;
    document.getElementById("edit_product_name").value = p_name;
    document.getElementById("edit_price").value = p_price;
    var color_arr = p_color.split(',');
    for(i=1;i<9;i++){
        if($.inArray(document.getElementById("edit_color"+i).value,color_arr) !== -1){
            document.getElementById("edit_color"+i).checked = true;
        }   
    }
    var photo_url_array = [url1,url2];
    
    for (i=0;i<2;i++){
        var angle = '';
        switch(i) {
            case 0:
                angle = '1';
                break;
            case 1:
                angle = '2';
                break;
        }
        if(photo_url_array[i]){
            document.getElementById("imgURL_"+angle+"_thumbnail").src =photo_url_array[i];
        }
        
    }
    
    document.getElementById("edit_product_stock").value = p_stock;
    document.getElementById("edit_product_description").value = p_description;
}
</script>
    </body>
</html>