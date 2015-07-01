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

        <!-- Optional theme -->
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public_html/css/carouselHome.css">
        <link rel="stylesheet" href="./public_html/css/main.css">
        <style>
            @media screen and (min-width: 1367px){#myNavbar{margin-left:13%;margin-right:13%;}}
            .search_box .form-control:focus{
                border-color: #cccccc;
                -webkit-box-shadow: none;
                box-shadow: none;
            }
            #myNavbar{
                background: -webkit-linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* For Firefox 3.6 to 15 */
                background: linear-gradient(rgb(223, 223, 223), rgb(248, 248, 248),rgb(223, 223, 223)); /* Standard syntax */
            }
            .carousel-indicators li{
                border:none;
            }
            #subscribe_btn{
                border-radius:0;
            }
        </style>
		<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
                <script src="http://maps.googleapis.com/maps/api/js"></script>
                <?php
                //$address = $dlocation; // Google HQ
                $prepAddr = str_replace(' ','+','75 Duxton Road Singapore 089534');
                $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
                $output= json_decode($geocode);
                $latitude = $output->results[0]->geometry->location->lat;
                $longitude = $output->results[0]->geometry->location->lng;
                ?>
                <!--Map Script-->
		<script>
                function initialize() {
                    var myLatlng = new google.maps.LatLng(<?php echo $latitude?>,<?php echo $longitude?>);
                    var mapProp = {
                      center:myLatlng,
                      zoom:15,
                      mapTypeId:google.maps.MapTypeId.ROADMAP
                    };
                    var map=new google.maps.Map(document.getElementById("map_canvas"),mapProp);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: ''
                    });
                }
                google.maps.event.addDomListener(window, 'load', initialize);
                </script>
                
                <script>
		function showRow(id){
			document.getElementById(id+"_contact").style.display = '';
			document.getElementById(id).setAttribute('onclick','hideRow("'+id+'")');
		}
		function hideRow(id){
			document.getElementById(id+"_contact").style.display = 'none';
			document.getElementById(id).setAttribute('onclick','showRow("'+id+'")');
		}
		</script>
		<link rel="stylesheet" href="./public_html/js/main.js">
        <meta charset="UTF-8">
        <title>Contacts</title>
    </head>
    <body>
        <?php
        include_once("./templates/header.php");
        ?>
        <div class='container-fluid' style='margin-top:100px'>
			<style>
			#title{
				position: relative;
			    height: 40px;
			    width: 196px;
			    background-color: #BDBDBD;
			    color: #FFFFFF;
			    font-size: 19px;
			    bottom: 0;
			    text-align: center;
			    vertical-align: text-bottom;
			    margin-top: 10px;
                        }
			#title-name{
				position:absolute;
				left:45px;
				bottom: 0
			}
			#sidebar{
				background-color: #FAFAFA;
				margin-right: 1px;
				padding-left:20px;
                                padding-right:0;
				font-size: 14px;
				width: 196px;
				height: 450px;
			}
			#contact{
				background-color: #FAFAFA;
				width: 230px;
				height: 450px;
				margin-right: 1px;
			}
			#form{
				background-color: #E6E6E6;
				height: 450px;
				margin-top: 0;
			}
                        img{
                            width: 60px;
                            height: 80px;
                        }
                        #map_canvas{
                            width:250px;
                            height:250px;
                        }
			</style>
            <div class='row' style='height:50px;background-color: rgb(153, 153, 153);'>
                <div id="title">
                <span id="title-name">CONTACTS<span>
                </div>
            </div>
            <div class='row pull-right' style='height:40px;margin-top:-40px;background:none;border-top: 1px #FFF solid; border-left: 1px #FFF solid;padding-left:1151px'>
            </div>
            <div class='row' style='margin-top:2px'>
                <div id='sidebar' class='col-md-2'>
                    <div style='margin-top:8px'>
                        <table style="border-collapse: separate;border-spacing: 6px;">
                            <tr><td><a id="singapore" onclick="showRow('singapore')" style="color: #000000;"> +  SINGAPORE</a></td></tr>
                            <tr id="singapore_contact" style="display: none;"><td>
                                <table>
                                    <tbody>
                                        <tr>
                                                <td valign="top" align="left">Add:</td>
                                                <td style="padding-left: 5px;">75 Duxton Road <br>Singapore 089534</td>
                                        </tr>
                                        <tr>
                                                <td valign="top" align="left">Tel:</td>
                                                <td style="padding-left: 5px;">+65 62238747 <br>+65 62238768</td>
                                        </tr>
                                        <tr>
                                                <td valign="top" align="left">Fax:</td>
                                                <td style="padding-left: 5px;">+65 62270811</td>
                                        </tr>
                                        <tr>
                                                <td valign="top" align="left" colspan="2">Email:</td>
                                        </tr>
                                        <tr>
                                                <td valign="top" align="left" colspan="2">mail@dmxchange.com</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            </tr>
                            <tr><td><a id="china" onclick="showRow('china')" style="color: #000000;"> +  CHINA</a></tr>
                            <tr id="china_contact" style="display: none;"><td>
                                <table>
                                    <tbody>
                                        <tr>
                                                <td valign="top" align="left">Add:</td>
                                                <td style="padding-left: 5px;">68 Alamak Road <br>Singapore 147258</td>
                                        </tr>
                                        <tr>
                                                <td valign="top" align="left">Tel:</td>
                                                <td style="padding-left: 5px;">+65 1234567 <br>+65 67676767</td>
                                        </tr>
                                        <tr>
                                                <td valign="top" align="left">Fax:</td>
                                                <td style="padding-left: 5px;">+65 45667881</td>
                                        </tr>
                                        <tr>
                                                <td valign="top" align="left" colspan="2">Email:</td>
                                        </tr>
                                        <tr>
                                                <td valign="top" align="left" colspan="2">jalat@dmxchange.com</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id='contact' class='col-md-2'>
                    <div class="row" id="contact-title" style="padding-top: 8px;padding-left: 15px;font-size: 18px">
                        MARKETING
                    </div>
                    <div id="contact-content">
                        <table style="border-collapse: separate;width: 100%;border-spacing: 0 20px">
                            <tbody>
                                <tr>
                                <td><img src="https://media.licdn.com/mpr/mpr/shrink_100_100/p/6/005/090/0fe/084b18b.jpg"/></td>
                                <td style="padding-left: 10px">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td colspan="2">Zhang Jiahang</td>
                                            </tr>
                                            <tr>
                                                <td>EMAIL:</td>
                                                <td>123@123.com</td>
                                            </tr>
                                            <tr>
                                                <td>TEL:</td>
                                                <td>12332112</td>
                                            </tr>
                                            <tr>
                                                <td>FAX:</td>
                                                <td>12345678</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="https://s-media-cache-ak0.pinimg.com/avatars/bodui_1368172952_140.jpg"/></td>
                                <td style="padding-left: 10px">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td colspan="2">Bie Yaqing</td>
                                            </tr>
                                            <tr>
                                                <td>EMAIL:</td>
                                                <td>sb@sb.com</td>
                                            </tr>
                                            <tr>
                                                <td>TEL:</td>
                                                <td>54213</td>
                                            </tr>
                                            <tr>
                                                <td>FAX:</td>
                                                <td>594213</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id='form' class='col-md-8'>
                    <div id="form_div" class="col-md-8" style='margin-top:5px;margin-left: 8px;' >
                        <form id="contactForm" action="" method="post">
                        <table width="90%" style="border-collapse: separate;border-spacing: 20px;">
                                <tbody>
                                <tr>
                                        <td width="15%" align="left">NAME</td>
                                        <td width="85%" align="left"><input type="text" name="name" id="name" size="35" style="border-color:transparent;"/></td>
                                </tr>
                                <tr>
                                        <td width="15%" align="left">EMAIL</td>
                                        <td width="85%" align="left"><input type="text" name="email" id="email" size="35" style="border-color:transparent;"/></td>
                                </tr>
                                <tr>
                                        <td width="15%" align="left">PHONE</td>
                                        <td width="85%" align="left"><input type="text" name="phone" id="phone" size="35" style="border-color:transparent;"/></td>
                                </tr>
                                <tr>
                                        <td width="15%" align="left">SUBJECT</td>
                                        <td width="85%" align="left"><input type="text" name="subject" id="subject" size="35" style="border-color:transparent;"/></td>
                                </tr>
                                <tr>
                                        <td width="15%" valign="top">MESSAGE</td>
                                        <td width="85%" align="left"><textarea name="message" id="message" rows="7" cols="70" style="background-color: #ffffff"></textarea></td>
                                </tr>
                                <tr>
                                        <td colspan="2" align="right">
                                        <input type="submit" value=" SUBMIT " style="border-color:transparent;"/>
                                        </td>
                                </tr>
                                </tbody>
                        </table>
                        </form>
                    </div>

                    <div id="map" style='margin-top:5px;' class='col-md-3'>
                        <div id="map_canvas">
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
        include_once("./templates/footer.php");
        ?>
    
    
    </body>
</html>
