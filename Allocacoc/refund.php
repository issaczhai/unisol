<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
        session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public_html/css/main.css">
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="./public_html/js/allocacoc.js"></script>
        <style>
            body{
                background-color:#ffffff;
            }
            
            section{
                    padding-left: 30px;
                    padding-right: 20px;
                    padding-top:10px;
            }
            section > h1{
                    color: #6E6E6E;
                    font-family: "Century Gothic";
                    font-weight: 900;
                    font-size: 30px; 
            }
            section > h2{
                    color: #6E6E6E;
                    font-family: "Century Gothic";
                    font-weight: 800;
                    font-size: 16px; 
            }
            section > p{
                    color: #848484;
                    font-family: "Century Gothic";
            }
            section > ul {
                list-style-type: none;
            }
            section > ul > li:before {
                content: "- ";
            }
            section > ul > li{
                    color: #848484;
                    font-family: "Century Gothic";
            }
        </style>
        <meta charset="UTF-8">
        <title>Refund</title>
    </head>
    <body>
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <?php
            // put your code here
            include_once("./templates/header2.php");
            ?>
            <div class="row">
                <section>
                    <h1>Refund and Exchange Policy</h1><br>
                    <p>By ordering from our site, you accept our general terms and conditions, including our Privacy Statement.</p>
                    
                    <p>1.    You shall examine the goods upon collection for any deficiencies and/or damages. If any product is found to be expired, missing, incorrect or damaged inside after receiving the order, Claims for return (if any) must be lodged to our store staff at the time of collection (for store collection only), or our customer service via the ‘Contact Us’ in our website or call +65 6339 8456, within the next 7 working days from the date of delivery or collection; otherwise we shall have the discretion to refuse your request and claims, after 7 working days from the date of delivery/collection. All requests for refund will be reviewed on case-by-case basis and subjected to the company’s approval.</p>

                    <p>2.    Products are returned due to the following reasons:<br>
                    i.    If the product is expired / incorrect/ damaged, in its original packaging upon delivered.<br>
                    ii.    If the product is expired / incorrect/ damaged, in its original packaging upon collection at the store.</p>
                    <p>3.    Goods will be refunded at the price value per order confirmation.</p>

                    <p>4.    For refund cases of orders made with member points redemption, member points will be refunded to card member’s account and remaining outstanding balance amount will then be refunded via eVouchers, according to the price value per order confirmation. </p>

                    <p>5.    Delivery charges, promotional discounts or coupons are non-refundable. </p>

                    <p>6.    Only one-time Return & Refund is allowed per order. Watsons reserve the rights to reject any subsequent returns or refund requests for the same order or product.</p>

                    <p>7.    Returned items will be refunded via eVouchers of price value excluding delivery charges, member points refund/deduction and other promotional discounts), upon approval of return & refund request. </p>

                    <p>8.    All return and refund requests are subjected to Watson’s Management approval. Watsons reserve the rights to reject any return requests according to returned products’ or unforeseen conditions.</p>

                    <p>9.    Refund eVoucher will be issued to customer within 3 working days upon successful approval of Return request. </p>

                    <p>10.    Watsons reserve the rights to reject any exchange or refund for opened or used product. We shall not be liable to you for any losses, liabilities, costs, damages, charges or expenses as a result.</p>

                    </section>

            </div>
        </div>
    </div>

        <?php
        $currentPage = "refund";
        include_once("./templates/footer.php");
        ?>
    
    </body>
</html>