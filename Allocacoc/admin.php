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

include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
include_once("./Manager/CreditManager.php");
include_once("./Manager/FdpManager.php");
include_once("./Manager/CustomerManager.php");
include_once("./Manager/PhotoManager.php");
include_once("./Manager/RewardManager.php");
include_once("./Manager/OrderManager.php");
include_once("./Manager/AddressManager.php");
$admin = $_SESSION["admin_id"];

$productMgr = new ProductManager();
$product_list = $productMgr->getAllProduct();
$no_of_products = sizeof($product_list);


$creditMgr = new CreditManager();
$total_no_invitation = $creditMgr->getNoOfInvitation();

$fdpMgr = new FdpManager();

$current_cutoff = $fdpMgr->getCutoff();
$current_charge = $fdpMgr->getCharge();
?>

<html>   
    <head>
        <script type="text/javascript" src="public_html/js/jquery-1.11.0.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script> 
        <script>
        $(window).load(function(){
            var hash = window.location.hash;
            if(hash != ''){
                $("#dashboard").attr('class','tab-pane fade');
                $("#dashboard_tab").attr('class', '');
                $(hash).attr('class','tab-pane fade active in');
                $(hash+"_tab").attr('class', 'active');
            }
            
        });
        </script>
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
        
        <!-- JS Color Picker -->
        <script type="text/javascript" src="public_html/js/jscolor.js"></script>
        
        <!-- nicEditor Script -->
        <script src="public_html/js/nicEdit.js" type="text/javascript"></script>
	<script type="text/javascript">
            bkLib.onDomLoaded(nicEditors.allTextAreas);
        </script>
        
        <!-- redirect script -->
        <script src="./public_html/js/jquery.redirect.js"></script>
        
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
            
            #displayPendingOrder th{
                text-align:center;
            }
            #displayPendingOrder td{
                text-align:center;
            }
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
                    <li id="manageReward_tab">
                        <a href="#manageReward" data-toggle="tab"><i class="fa fa-fw fa-trophy"></i> Manage Reward</a>
                    </li>
                    <li id="manageOrder_tab">
                        <a href="#manageOrder" data-toggle="tab"><i class="fa fa-fw fa-trophy"></i> Manage Order</a>
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
                                                    <form id='addProductForm' onsubmit="return populateAddJhtmlArea()" method='POST' enctype='multipart/form-data' action='process_product.php'>
                                                            <input type='hidden' name='operation' value='add_product'/>
                                                        <tr>
                                                        <td>Product Name</td>
                                                        <td>
                                                            <input id="product_name" type="text" name="product_name" maxlength="50" required/>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>Product Optional Code</td>
                                                        <td>
                                                            <input id="symbol_code" type="text" name="symbol_code" maxlength="50"/>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>Price</td>
                                                        <td>
                                                            <input id="price" type="text" name="price" required/>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>Shop Thumbnail</br>(167 x 167)</td>
                                                        <td>
                                                            <div class="btn" style="width:20%">
                                                            <span>  Upload </span>
                                                            <input type="file" name="thumbnail_photo_input" id="1_photo_input" onchange="check('thumbnail_photo')"/>
                                                            </div>
                                                            <div id="thumbnail_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                            <div id="thumbnail_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>

                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Photo and Color</br>(280 x 280)</td>
                                                            <td>
                                                                <table width="60%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th width="20%">Select</th>
                                                                            <th width="15%">Status</th>
                                                                            <th width="45%">Representing Color</th>
                                                                            <th width="30%">Color Code</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="btn">
                                                                                <span>  Select </span>
                                                                                <input type="file" name="1_photo_input" id="1_photo_input" onchange="check('1_photo')"/>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div id="1_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                                <div id="1_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>
                                                                            </td>
                                                                            <td>
                                                                                <input class="color" id="color1" name="color1" disabled="disabled"/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" id="color_symbol_code1" name="color_symbol_code1" disabled="disabled"/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="btn">
                                                                                <span>  Select </span>
                                                                                <input type="file" name="2_photo_input" id="2_photo_input" onchange="check('2_photo')"/>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div id="2_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                                <div id="2_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" id="color1" name="color2" class="color" disabled="disabled"/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" id="color_symbol_code2" name="color_symbol_code2" disabled="disabled"/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="btn">
                                                                                <span>  Select </span>
                                                                                <input type="file" name="3_photo_input" id="3_photo_input" onchange="check('3_photo')"/>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div id="3_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                                <div id="3_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" id="color3" name="color3" class="color" disabled="disabled"/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" id="color_symbol_code3" name="color_symbol_code3" disabled="disabled"/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="btn">
                                                                                <span>  Select </span>
                                                                                <input type="file" name="4_photo_input" id="4_photo_input" onchange="check('4_photo')"/>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div id="4_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                                <div id="4_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" id="color4" name="color4" class="color" disabled="disabled"/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" id="color_symbol_code4" name="color_symbol_code4" disabled="disabled"/>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Description</td>					
                                                            <td>
                                                                <textarea style="width: 700px; height: 250px;" id="add_product_description" name="add_product_description"></textarea>
                                                                <input type="hidden" value="" id="addTextarea" name="addTextarea"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Stock</td>
                                                            <td>
                                                                <input type='text' id='add_product_stock' name='add_product_stock' required/>
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
                                                            <th> </th>
                                                            <th>Product ID</th>
                                                            <th>Product Name</th>
                                                            <th>Symbol Code</th>
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
                                                           $p_symbol_code = $product["symbol_code"];
                                                           $p_price = $product["price"];
                                                           $p_color = $product["color"];
                                                           $description = htmlentities($product["description"]);
                                                           $p_stock = $product["stock"];
                                                           $photo_url_arr = $photoMgr->getPhotos($p_id);
                                                           $photo_url_string = str_replace('"', "&quot;", str_replace(array("{","}"),"",json_encode($photo_url_arr)));
                                                           $p_color_optional_code_arr = $productMgr->getAllColorOptionalCodeByProduct($p_id);
                                                           $p_color_optional_code_string = str_replace('"', "&quot;", str_replace(array("{","}"),"",json_encode($p_color_optional_code_arr)));
                                                           
                                                        ?>
                                                           <tr>
                                                               <td><input type="checkbox" class="productList_id" value="<?=$p_id?>"></td>
                                                               <td><?php echo $p_id; ?></td>
                                                               <td><?php echo $p_name; ?></td>
                                                               <td><?php echo $p_symbol_code; ?></td>
                                                               <td><?php echo number_format($p_price,2,'.',''); ?></td>
                                                               <td><?php echo $p_color; ?></td>
                                                               <td><?php echo $p_stock; ?></td>
                                                               <td><div class="btn"><span>Edit<i class="fa fa-edit"></i></span><input type="button" onclick="showEditTab();populateEditField('<?php echo $p_id ?>','<?php echo $p_name ?>','<?php echo $p_symbol_code ?>','<?php echo $p_price ?>','<?php echo $p_color ?>','<?php echo $p_stock ?>','<?php echo $description ?>','<?php echo $photo_url_string; ?>','<?php echo $p_color_optional_code_string; ?>');" value="Edit Product"/></div></td>
                                                           </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                           <tr>
                                                               <td colspan="8">
                                                                   <button class="btn-danger" onclick="DeleteProduct()">Delete Selected Product</button>
                                                               </td>
                                                           </tr>
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
                                                    <form id='editProductForm' onsubmit="return populateEditJhtmlArea()" enctype='multipart/form-data' method='POST' action='process_product.php'>
                                                        <input type='hidden' id='operation' name='operation' value='edit_product'/>
                                                        <input type='hidden' id='edit_product_id' name='edit_product_id'/>
                                                        <tr>
                                                            <td>Product Name</td>
                                                            <td>
                                                                <input id="edit_product_name" type="text" name="edit_product_name" maxlength="50" required/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Product Name</td>
                                                            <td>
                                                                <input id="edit_symbol_code" type="text" name="edit_symbol_code" maxlength="50"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Price</td>
                                                            <td>
                                                                <input id="edit_price" type="text" name="edit_price" required/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                        <td>Shop Thumbnail</br>(167 x 167)</td>
                                                        <td>
                                                            <div class="btn" style="width:20%">
                                                            <span>  Upload </span>
                                                            <input type="file" name="edit_thumbnail_photo_input" id="edit_thumbnail_photo_input" onchange="editCheck('edit_thumbnail_photo')"/>
                                                            </div>
                                                            <div id="edit_thumbnail_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                            <div id="edit_thumbnail_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>
                                                            <a class="thumbnail" id="edit_thumbnail_photo_a" style="width:25%">
                                                                <img id="edit_thumbnail_photo_preview" src="./public_html/img/no-image.png" alt="..." height="50px" width="50px">
                                                            </a>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>Photo and Color</br>(280 x 280)</td>
                                                        <td>
                                                            <table width="65%">
                                                                <tbody>
                                                                    <tr>
                                                                        <th width="15%">Select</th>
                                                                        <th width="45%">Status</th>
                                                                        <th width="20%">Representing Color</th>
                                                                        <th width="15%">Color Code</th>
                                                                        <th width="5%"></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="btn">
                                                                            <span>  Select </span>
                                                                            <input type="file" name="edit_1_photo_input" id="edit_1_photo_input" onchange="editCheck('edit_1_photo')"/>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div id="edit_1_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                            <div id="edit_1_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>
                                                                            <a class="thumbnail" id="edit_1_photo_a" style="width:50%">
                                                                                <img id="edit_1_photo_preview" src="./public_html/img/no-image.png" alt="..." height="50px" width="50px">
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            <input class="color" id="edit_1_photo_color" name="edit_1_photo_color" onchange="updateColor('1')" disabled="disabled"/>
                                                                            <input class="hidden" id="edit_1_photo_original_color" name="edit_1_photo_original_color"/>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="edit_color_symbol_code1" name="edit_color_symbol_code1" onchange="updateColorSymbolCode('1')" disabled="disabled"/>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" id="edit_1_photo_delete" style="display:none" onclick="deletePhoto('1')">x</button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="btn">
                                                                            <span>  Select </span>
                                                                            <input type="file" name="edit_2_photo_input" id="edit_2_photo_input" onchange="editCheck('edit_2_photo')"/>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div id="edit_2_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                            <div id="edit_2_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>
                                                                            <a class="thumbnail" id="edit_2_photo_a" style="width:50%">
                                                                                <img id="edit_2_photo_preview" src="./public_html/img/no-image.png" alt="..." height="50px" width="50px">
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            <input class="color" id="edit_2_photo_color" name="edit_2_photo_color" onchange="updateColor('2')" disabled="disabled"/>
                                                                            <input class="hidden" id="edit_2_photo_original_color" name="edit_2_photo_original_color"/>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="edit_color_symbol_code2" name="edit_color_symbol_code2" onchange="updateColorSymbolCode('2')" disabled="disabled"/>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" id="edit_2_photo_delete" style="display:none" onclick="deletePhoto('2')">x</button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="btn">
                                                                            <span>  Select </span>
                                                                            <input type="file" name="edit_3_photo_input" id="edit_3_photo_input" onchange="editCheck('edit_3_photo')"/>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div id="edit_3_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                            <div id="edit_3_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>
                                                                            <a class="thumbnail" id="edit_3_photo_a" style="width:50%">
                                                                                <img id="edit_3_photo_preview" src="./public_html/img/no-image.png" alt="..." height="50px" width="50px">
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            <input class="color" id="edit_3_photo_color" name="edit_3_photo_color" onchange="updateColor('3')" disabled="disabled"/>
                                                                            <input class="hidden" id="edit_3_photo_original_color" name="edit_3_photo_original_color"/>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="edit_color_symbol_code3" name="edit_color_symbol_code3" onchange="updateColorSymbolCode('3')" disabled="disabled"/>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" id="edit_3_photo_delete" style="display:none" onclick="deletePhoto('3')">x</button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="btn">
                                                                            <span>  Select </span>
                                                                            <input type="file" name="edit_4_photo_input" id="edit_4_photo_input" onchange="editCheck('edit_4_photo')"/>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div id="edit_4_photo_check" style="display:none;"><i class="fa fa-check"></i></div>
                                                                            <div id="edit_4_photo_close" style="display:none;"><i class="fa fa-times"> invalid image</i></div>
                                                                            <a class="thumbnail" id="edit_4_photo_a" style="width:50%">
                                                                                <img id="edit_4_photo_preview" src="./public_html/img/no-image.png" alt="..." height="50px" width="50px">
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            <input class="color" id="edit_4_photo_color" name="edit_4_photo_color" onchange="updateColor('4')" disabled="disabled"/>
                                                                            <input class="hidden" id="edit_4_photo_original_color" name="edit_4_photo_original_color"/>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="edit_color_symbol_code4" name="edit_color_symbol_code4" onchange="updateColorSymbolCode('4')" disabled="disabled"/>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" id="edit_4_photo_delete" style="display:none" onclick="deletePhoto('4')">x</button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Description</td>					
                                                            <td>
                                                                <textarea style="width: 700px; height: 250px;" id="edit_product_description" name="edit_product_description"></textarea>
                                                                <input type="hidden" value="" id="editTextarea" name="editTextarea"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Stock</td>
                                                            <td>
                                                                <input type='text' id='edit_product_stock' name='edit_product_stock' required/>
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
                                        Delivery
                                    </h1>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped" id="cutOffPriceTable">
                                            <thead>
                                                <tr>
                                                    <th width="60%">Current Cut-off Price</th>
                                                    <th width="40%">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td> $ <span id="current_cutoff"><?php echo $current_cutoff; ?></span>
                                                    <input id="current_cutoff_entry" name="current_cutoff_entry" type="text" style="display:none;"></input>
                                                    <button id="confirm_cutoff_change" style="display:none" onclick="update_cutoff()">OK</button>
                                                </td>
                                                <td>
                                                    <div class="btn" style="background: #0083C9"><span> Edit <i class="fa fa-edit"></i></span><input type="button" name='show_update_cutoff_button' onclick="show_update_cutoff_input()" value='Update'/></div>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <table class="table table-bordered table-hover table-striped" id="deliveryChargeTable">
                                            <thead>
                                                <tr>
                                                    <th width="60%">Current Delivery Charge</th>
                                                    <th width="40%">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td> $ <span id="current_charge"><?php echo $current_charge; ?></span>
                                                    <input id="charge_entry" name="charge_entry" type="text" style="display:none;"></input>
                                                    <button id="confirm_charge_change" style="display:none" onclick="update_charge()">OK</button>
                                                </td>
                                                <td>
                                                    <div class="btn" style="background: #0083C9"><span> Edit <i class="fa fa-edit"></i></span><input type="button" name='show_update_charge_button' onclick="show_update_charge_input()" value='Update'/></div>
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
                
                
                <!--manageReward tab content-->
                <div class="tab-pane fade" id="manageReward">
                    <div id="page-wrapper">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h1 class="page-header">
                                        Manage Reward
                                    </h1>
                                </div>
                                <div class="col-lg-2">
                                    <div class="page-header">
                                        <div class="btn">
                                            <span>Create Code <i class="fa fa-plus"></i></span>
                                            <input type="button" data-toggle="modal" data-target="#createCodeModal" value="Create Code"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!--Manage Reward TABLE ROW-->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="fa fa-table fa-fw"></i> Reward Code List</h3>
                                            
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" id="display_code">
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">S/N</th>
                                                            <th width="40%">Code</th>
                                                            <th width="25%">Beneficiaries</th>
                                                            <th width="25%" style="text-align:center" colspan="2">Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $rewardMgr = new RewardManager();
                                                        $rewardCodeList = $rewardMgr->getRewardCodeList();
                                                        $codeCount = 0;
                                                        foreach ($rewardCodeList as $rewardCode){
                                                           $codeCount+=1;
                                                           $noOfBeneficiary = $rewardMgr->getNoOfBeneficiary($rewardCode);
                                                        ?>
                                                           <tr>
                                                               <td><?php echo $codeCount; ?></td>
                                                               <td><?php echo $rewardCode; ?></td>
                                                               <td><?php echo $noOfBeneficiary; ?></td>
                                                               <td style="text-align:center">
                                                                   <button class="btn-danger" type="button" onclick="removeRewardCode('<?php echo $rewardCode ?>');">Remove <i class="fa fa-trash-o"></i></button>
                                                               </td>
                                                               <td style="text-align:center">   
                                                                    <input class="btn-primary" type="button" data-toggle="modal" data-target="#setGiftModal" value="Set Gift" onclick="setGift('<?php echo $rewardCode ?>');"/>
                                                                </td>
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
                                    
                                    
                                    <div id="createCodeModal" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                                                    <h4 class="modal-title">Create Code</h4>
                                                </div>
                                                <form role="form" action="process_reward.php?operation=create" method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="control-label">Please enter the number of reward code you want to create:</label>
                                                            <input type="text" name="numberOfCode" class="form-control" id="numberOfCode" required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-danger btn-default" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Create</button>
                                                    </div> 
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="setGiftModal" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                                                    <h4 class="modal-title">Set Gift</h4>
                                                </div>
                                                <form role="form" action="process_reward.php?operation=setGift" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" id="gift_code" name="gift_code" value=""/>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="gift_name" class="control-label">Gift Name:</label>
                                                            <input type="text" name="gift_name" class="form-control" id="gift_name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="gift_worth" class="control-label">Worth Price(SGD):</label>
                                                            <input type="text" name="gift_worth" class="form-control" id="gift_worth" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="gift_photo" class="control-label">Gift Photo:  </label>
                                                            <div class="btn" style="width:25%">
                                                                <span>  Gift Photo (1:1) </span>
                                                                <input type="file" name="gift_photo" id="gift_photo" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">OK</button>
                                                    </div> 
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                
                        </div>
                    </div>
                        
                </div>
                
                
                <!--viewProduct tab content-->
                <div class="tab-pane fade" id="manageOrder">
                    <div id="page-wrapper">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        Manage Order
                                    </h1>
                                </div>
                            </div>
                            
                            <!--VIEW PENDING ORDER TABLE ROW-->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-yellow">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="fa fa-file-o fa-fw"></i> Pending Order List</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" id="displayPendingOrder">
                                                    <thead>
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Customer ID</th>
                                                            <th>Total Price</th>
                                                            <th>Pay Time</th>
                                                            <th>Status</th>
                                                            <th width="10%">Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $orderMgr = new OrderManager();
                                                        $addressMgr = new AddressManager();
                                                        $pendingList = $orderMgr->getPendingOrder();
                                                        foreach($pendingList as $pendingOrder){
                                                            $pendingOrder_id = $pendingOrder["order_id"];
                                                            $pendingOrder_customerId = $pendingOrder["customer_id"];
                                                            $pendingOrder_status = $pendingOrder["status"];
                                                            $pendingOrder_payTime = $pendingOrder["payment_time"];
                                                            $pendingOrder_totalPrice = $pendingOrder["totalPrice"];
                                                            $pendingOrder_itemList = $pendingOrder["itemList"];
                                                            $pendingOrder_address=$addressMgr->getGeneralAddress($pendingOrder_customerId,  intval($pendingOrder['address_no']));
                                                            
                                                        ?>
                                                           <tr>
                                                               <td><?=$pendingOrder_id?></td>
                                                               <td><?=$pendingOrder_customerId?></td>
                                                               <td><?=number_format($pendingOrder_totalPrice,2,'.','') ?></td>
                                                               <td><?=$pendingOrder_payTime?></td>
                                                               <td><?=$pendingOrder_status?></td>
                                                               <td>
                                                                   <button id="viewButton<?=$pendingOrder_id?>" style="width:50px" onclick="showOrder('<?=$pendingOrder_id?>')">View</button>
                                                                   <button id="closeButton<?=$pendingOrder_id?>" style="display:none;width:50px" onclick="closeOrderDetail('<?=$pendingOrder_id ?>');">Close</button>
                                                               </td>
                                                           </tr>
                                                           <tr id="orderDetail<?=$pendingOrder_id?>" style="display:none">
                                                               <td colspan="6">
                                                                   <table width="30%">
                                                                       <tr>
                                                                           <th style="text-align: left">Item</th>
                                                                           <th>Quantity</th>
                                                                           <th>Price</th>
                                                                       </tr>
                                                                       <?php
                                                                       foreach($pendingOrder_itemList as $item){
                                                                       ?>
                                                                       <tr>
                                                                            <td style="text-align: left"><?=($productMgr->getProductSymbolCode($item['product_id']))."-".(($productMgr->getAllColorOptionalCodeByProduct($item['product_id'])[$item['color']]))?></td>
                                                                            <td><?=$item['quantity']?></td>
                                                                            <td><?=number_format($item['price'],2,'.','')?></td>
                                                                       </tr>
                                                                       <?php
                                                                       }
                                                                       ?>
                                                                   </table>
                                                                   <table width="100%">
                                                                       <tr>
                                                                           <td><strong>Address</strong></td>
                                                                           <td style="text-align: left;width:90%" colspan="2"><?=$pendingOrder_address?></td>
                                                                       </tr>
                                                                       <tr>
                                                                           <td style="text-align: right" colspan="2"> <a class="btn btn-default" style="color:#fff" target="_blank" href="https://app.detrack.com/tracking/c2ed7ab0c381d61e1959731ff286cbb0ba590cb4?q=<?=$pendingOrder_id?>">Track</a> </td>
                                                                           <td style="text-align: right;width:10%"> <button class="btn btn-info" type="button" onclick="printDeliveryLabel('<?=$pendingOrder_id?>')">Print Delivery Label</button> </td>
                                                                       </tr>
                                                                   </table>
                                                               </td>
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
                            
                            
                            <!--VIEW COMPLETED ORDER TABLE ROW-->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="fa fa-file-text-o fa-fw"></i> Completed Order List</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" id="displayCompletedOrder">
                                                    <thead>
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Customer ID</th>
                                                            <th>Total Price</th>
                                                            <th>Pay Time</th>
                                                            <th width="10%">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sentList = $orderMgr->getSentOrder();
                                                        foreach($sentList as $sentOrder){
                                                            $sentOrder_id = $sentOrder["order_id"];
                                                            $sentOrder_customerId = $sentOrder["customer_id"];
                                                            $sentOrder_status = $sentOrder["status"];
                                                            $sentOrder_payTime = $sentOrder["payment_time"];
                                                            $sentOrder_totalPrice = $sentOrder["totalPrice"];
                                                            $sentOrder_itemList = $sentOrder["itemList"];
                                                            
                                                        ?>
                                                           <tr>
                                                               <td><?=$sentOrder_id?></td>
                                                               <td><?=$sentOrder_customerId?></td>
                                                               <td><?=number_format($sentOrder_totalPrice,2,'.','') ?></td>
                                                               <td><?=$sentOrder_payTime?></td>
                                                               <td><?=$sentOrder_status?></td>
                                                           </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
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
                
                <!-- /#wrapper -->
            </div>
        
        </div>

<!-- Bootstrap Core JavaScript -->
<script src="public_html/js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="public_html/js/plugins/morris/raphael.min.js"></script>
<script src="public_html/js/plugins/morris/morris.min.js"></script>
<script src="public_html/js/plugins/morris/morris-data.js"></script>

<!-- All Javascript function in admin.php -->
<script src="public_html/js/admin.js"></script>
    </body>
</html>