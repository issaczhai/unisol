<?php
    if (session_status()!=PHP_SESSION_ACTIVE) {
        session_start();
    }
    include_once("./Manager/ConnectionManager.php");
	include_once("./Manager/ProductManager.php");
    $username = null;
    include_once("./templates/modal.php");
    if(isset($_SESSION["userid"]) && !empty($_SESSION["userid"])){
        // $userid is customer email address
        $userid = $_SESSION["userid"];
        $pos = strpos($userid, "@");
        // $username is displayed in the header
        $username = substr($userid, 0, $pos);
        $productMgr = new ProductManager();
        $cart_total_qty = $productMgr->retrieveTotalNumberOfItemsInShoppingCart($userid);
    }
?>
<style>
	#logo{margin-top:20px;height:97px;}
	.allocacocLogo{
		position:absolute;
		margin-left:30px;
		z-index:-1;
	}
	
	.row{
        margin-right: 15px
    }
	
	.overlay-nav-item{
		display: inline;
		margin-top:17px
	}
	.overlay-nav > li:nth-child(2){
		margin-left:20px
	}
	.overlay-text{
		color: #626262;
		font-weight: 400;
		font-size: 16px;
	}
	#myNav{   
		border-top: 1px solid #EBEBEB;
		border-bottom: 1px solid #EBEBEB;
	}
	</style>

    <div id="logo" class="row">
        <div class="allocacocLogo">
            <img src="./public_html/img/allocacoc.png">
        </div>
    </div>
    <div id="myNav" class="row">
        <ul class="overlay-nav pull-left" style="margin-top:15px">
            <li class="overlay-nav-item">
                <a class='overlay-text' href="./shop.php"><i class="fa fa-gift fa-lg" ></i> shop</a>
            </li>
            <li class="overlay-nav-item">
                <a class='overlay-text' href="./cart.php"><i class="fa fa-shopping-cart fa-lg"></i> cart</a>
            </li>
        </ul>
        <?php 
        if(empty($username)){
        ?>
        <ul class="pull-right" style="margin-top:15px">
            <li class="overlay-nav-item" style="margin-right:17px">
                <a class='overlay-text' href="#signup" data-toggle="modal" data-target=".bs-modal-sm"> login</a>
            </li>
        </ul>
        <?php
        }else{
        ?>
        <ul class="pull-right" style="margin-top:15px">
            <li class="overlay-nav-item" style="margin-right:17px">
                <a class='overlay-text' href="./account.php"> <?php echo $username ?></a>
            </li>
            <li class="overlay-nav-item" style="margin-right:17px">
                <a class='overlay-text' href="./logout.php"> Logout</a>
            </li>
        </ul>
        <?php
        }?>
    </div>

