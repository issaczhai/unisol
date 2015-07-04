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
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public_html/css/main.css">
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
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
            section > p{
                    color: #848484;
                    font-family: "Century Gothic";
            }
        </style>
        <meta charset="UTF-8">
        <title>Disclaimer</title>
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
                    <h1>disclaimer</h1><br>
                    <p>The information contained in this website is for general information purposes only. The information is provided by alocacoc by and while we endeavour to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk. In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website.</p>
                    <br>
                    <p>Through this website you are able to link to other websites which are not under the control of allocacoc bv. We have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them. Every effort is made to keep the websiteup and running smoothly. However, allocaco bv takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.</p>
                </section>

            </div>
        </div>
    </div>

        <?php
        $currentPage = "disclaimer";
        include_once("./templates/footer.php");
        ?>
    
    </body>
</html>
