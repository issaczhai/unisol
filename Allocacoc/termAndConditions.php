<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
        session_start();
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        <title>Terms & Conditions</title>
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
                    <h1>terms & conditions</h1><br>
                    <h2>Acceptance of general terms and conditions</h2>
                    <p>By ordering from our site, you accept our general terms and conditions, including our Privacy Statement.</p>
                    
                    <h2>Price changes</h2>
                    <p>Allocacoc reserves the right to change prices. Prices at the time of placing an order are valid throughout the buying process. *At times where software or human errors for instance list products with an obvious faulty price, Allocacoc reserves the rights to cancel the order - notifications will be given.</p>
                    
                    <h2>Change of product assortment</h2>
                    <p>Allocacoc reserves the right to change its stock availability on the site and to remove items from the product range before a purchase has been registered.</p>
                    
                    <h2>Product information</h2>
                    <p>We do our best to make sure that all of the content on our site is correct. However, as we are only human, we reserve the right that unintentional errors may occur. Colors on your computer screen are not always 100 % accurate.</p>
                    
                    <h2>Under 18 years old?</h2>
                    <p>If you are under the age of 18, your parents’ or guardian’s consent is required to make purchases on this webshop.</p>
                    
                    <h2>Damage during transportation</h2>
                    <p>All shipped packages are insured. If the package and/or the content is damaged upon arrival, please report it to the courier upon delivery. When returning goods to us, do not use snail mail as this is uninsured (and you will not be reimbursed if the package is lost). Always keep your receipt. If you notice any damages when you unpack your items, please contact us.</p>
                    
                    <h2>Shopping, shipping and customs</h2>
                    <p>Only customers with a valid European address may place orders in this webshop. Unfortunately, we are currently not able to deliver our products outside of Europe.  In terms of payment, we accept credit cards: VISA and Mastercard only. Making purchases in our webshop is secure (SSL). We use state of the art technology to keep your credit card information safe. For details on our security measures, please see terms and conditions.  Prices are stated in EURO, GBP, USD depending on your destination country. Purchases can only be made in the currency available for the country where you choose your delivery to be made.</p>
                    
                    <h2>Viewing period</h2>
                    <p>If you are not satisfied with the goods you bought in our webshop, you are welcome to return these to us within 14 days after receiving them. To do so, please send us an e-mail to ask for a return number.</p>
                    
                    <h2>In this e-mail please specify:</h2>
                    <p>
                    <ul>
                        <li>the ordernumber</li>
                        <li>your name and address</li>
                        <li>your bankaccount information</li>
                        <li>if you would like to return the purchase or exchange it</li>
                        <li>the reason of return or exchange (not compulsory)</li>
                    </ul>
                    </p>
                    <br>
                    <h1>Privacy Statement</h1><br>
                    <h2>Allocacoc Webshop</h2>
                    <p>All content included on this site, such as text, graphics, logos, button icons, images, audio clips, digital downloads, data compilations, and software is the property of Allocacoc BV or its content suppliers and protected by international copyright laws. This site or any portion of it may not be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without the expressed written consent of Allocacoc AS.</p>
                    
                    <h2>Your privacy</h2>
                    <p>The Allocacoc privacy statement is designed to demonstrate our commitment to privacy. We respect your privacy. Any personal information that you provide is used for the purpose of giving you the best possible information. In our feedback form and digital catalog form, we ask you to give us certain contact information, which is needed to send/reply to the information you requested. We also ask for other information, much of which is optional. Please don’t tell us things you don’t want us to know. Allocacoc uses this information to better understand its consumer base in order to provide superior service.
Non-disclosure to third parties Unless we have your expressed consent, we will not disclose your personal information to any third parties. We will not sell, rent or trade your personal information to others for marketing purposes without your expressed consent. We may collect statistics regarding the use of our webshop, such as traffic patterns and related site information, but this information will not include any personal identifying information.</p>
                    
                    <h2>Security of your information</h2>
                    <p>We follow strict security procedures in the storage and disclosure of information that you have given us. This is to prevent unauthorized access or unlawful processing of your personal information.</p>
                    
                    <h2>E-mail</h2>
                    <p>Allocacoc will only send you e-mails if you ask for more information. We might also use your e-mail address to confirm your order/request and to respond to any inquiries you make online. We will not pester you if you don’t ask for more information!</p>
                    
                    <h2>Newsletter</h2>
                    <p>When you subscribe to our newsletter you can be assured that your personal information and email address will not be sold, exchanged, or in any way shared with third parties.  We keep your personal information private, and will only use your email address to send you the newsletters you requested. You can unsubscribe from our newsletter at anytime.</p>
                    
                    <h2>Children’s policy</h2>
                    <p>If you are under 18, you may use our webshop only with the involvement of a parent or guardian. In accordance with the Children’s Online Privacy Protection Act, we will not knowingly collect any information from children under the age of 13. If you are under 13, you cannot register or give us any personal information. Please have your parents contact us to enter this information.</p>
                    
                    <h2>Your consent</h2>
                    <p>By using our website you consent that we may collect and use your personal information in the manner set out in this privacy policy. Any changes to our privacy policy will be posted on this site.</p>
                    
                    </section>

            </div>
        </div>
    </div>

        <?php
        $currentPage = "terms & conditions";
        include_once("./templates/footer.php");
        ?>
    
    </body>
</html>