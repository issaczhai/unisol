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
        <title>Delivery</title>
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
                    <h1>Delivery FAQ's</h1><br>
                    <h2>When will I receive my order?</h2>
                    <p>Usually, you can expect to receive your order within 3 to 7 working days.</p>

                    <h2>How much is the delivery fee?</h2>
                    <p>Generally, the delivery fee is $5. However, you will enjoy free delivery for orders above $69. </p>
                    
                    <h2>I ordered multiple items, but I only received 1, where are my other items?</h2>
                    <p>If you ordered multiple items but found some items missing in your parcel then please reach out to us at allocacoc@xxx.com and we will investigate the matter for you right away.</p>
                    
                    <h2>Can I prearrange the date I want to get the delivery?</h2>
                    <p>We apologize that we are unable to accommodate specific delivery time requests at the moment. If you are not available at the time of your delivery attempt the courier partner will try to re-deliver to you at another time.</p>
                    
                    <h2>Do you deliver during weekends and holidays?</h2>
                    <p>Some of our courier partners may attempt deliveries during the weekend. However, if you are not available at the given address on the weekend they will re-attempt the delivery on a working day. We recommend you to provide your shipping address expecting your delivery to arrive on a working day.</p>
                    
                    <h2>I need my order now, Can Allocacoc speed up the delivery?</h2>
                    <p>Unfortunately, we are unable to expediate the delivery of orders. However, we try our best to ensure your parcel is delivered within the promised delivery time.</p>
                    
                    <h2>How can I know exact date and time of the delivery?</h2>
                    <p>We apologize that we are unable to give you an exact date and time of delivery. You may track your order with the <a href="https://app.detrack.com/tracking/c2ed7ab0c381d61e1959731ff286cbb0ba590cb4">Order Tracking Tool</a>. Usually, you will receive the order within 3 - 7 workings. You will receive email notifications for all orders from our system keeping you informed of the status of the order.</p>
                    
                    <h2>Can I receive a call before delivery?</h2>
                    <p>Unfortunately our delivery partners are unable to guarantee a call before the delivery. Some couriers may call you before attempting delivery or when they arrive at the delivery address. If you are not available at the time of your delivery attempt the courier partner will try to re-deliver to you at another time.</p>
                    
                    <h2>What if I am not at home when the package arrives?</h2>
                    <p>If you are unavailable to receive your package when it arrives, we may try to re-deliver it to you at another time.

Kindly contact us at allocacoc@xxx.com  and we will update you on the status of your parcel.</p>
                    
                    <h2>Can you deliver the item to my condo/building/office reception?</h2>
                    <p>Our delivery partner will attempt delivery to your stated shipping address first. If you are unreachable at your address, the driver will only be able to handover the parcel to your reception staff if you have given prior authorization to them and if your building's policy allows it.</p>
                    
                    <h2>Can I pick up my order at Allocacoc office?</h2>
                    <p>Allocacoc doesn't offer this option for now.</p>
                    
                    <h2>Why did I receive a notification that my item is Delivered when I have not yet received the item?</h2>
                    <p>Please contact us at www.lazada.sg/contact right away if you received a notification that your item is Delivered, but you have not yet received the item.</p>

                    <p>Our Customer Service team will investigate the matter and get back to you as soon as possible.</p>

                    <p>In the mean-time, we suggest you to confirm with your family members or other persons who might have received the parcel on your behalf.</p>
                    
                    </section>

            </div>
        </div>
    </div>

        <?php
        $currentPage = "delivery";
        include_once("./templates/footer.php");
        ?>
    
    </body>
</html>