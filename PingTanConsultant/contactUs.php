<!DOCTYPE html>
<html>

<head>	
	<meta name="keywords" content="PingTan, safety school, construction">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./public_html/css/style.css">

    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <?php
        //$address = $dlocation; // Google HQ
        $prepAddr = str_replace(' ','+','8 New Industrial Road LHK 3 Building Singapore 536200');
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output = json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
    ?>
    <!-- Map Script -->
	<script>
	    function initialize() {
	        var myLatlng = new google.maps.LatLng(<?= $latitude?>,<?= $longitude?>);
	        var mapProp = {
	          center:myLatlng,
	          zoom:18,
	          mapTypeId:google.maps.MapTypeId.ROADMAP
	        };
	        var map=new google.maps.Map(document.getElementById("map_canvas"),mapProp);
	        var marker = new google.maps.Marker({
	            position: myLatlng,
	            map: map,
	            title: 'Ping Tan Construction'
	        });
	    }
	    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>
	<!-- Header -->
	<?php
        include_once("./templates/header.php");
    ?>

    <!-- Content -->
	    <div class="container-fluid container-fluid-padding-none">
	    	<div class="row row-title-contact">
	    		<h3>Contact Us</h2>
	    	</div>
	    	<!-- Content -->
	    	<div class="row content-contact"> 
	    		<div class="col-md-3 col-md-offset-1 contact-left-content">
	    			<ul class="list-contact">
	    				<li>
	    					<table>
	    						<tbody>
		    						<tr>
		    							<td>Ping Tan Construction Pte Ltd</td>
		    						</tr>
		    						<tr>
		    							<td>8 New Industrial Road</td>
		    						</tr>
		    						<tr>
		    							<td>LHK 3 Building #06-04</td>
		    						</tr>
		    						<tr>
		    							<td>Singapore 536200</td>
		    						</tr>
	    						</tbody>
	    					</table>
	    				</li>
	    				<li>
	    					<table>
	    						<tbody>
		    						<tr>
		    							<td>Email: info@pingtan.com</td>
		    						</tr>
		    						<tr>
		    							<td>Tel: (65) 6747 6711</td>
		    						</tr>
		    						<tr>
		    							<td>Fax: (65) 6747 6711</td>
		    						</tr>
	    						</tbody>
	    					</table>
	    				</li>
	    			</ul>

	    			<div id="map_canvas" class="map-pingtan">
	    				
	    			</div>
	    		</div>

	    		<div class="col-md-7 contact-right-content">
	    			<div class="col-md-12 form-contact-header">
	    				<h1>CONTACT US</h1>
	    				<h3>Fill out the form below to learn more!</h3>
	    			</div>
		    		<form action="#">
		    			<div class="col-md-6 form-row">
		    				<label for="first-name">First Name</label>
		    				<input class="text-input" type="text" name="first-name" placeholder="First Name">
		    			</div>
		    			<div class="col-md-6 form-row">
		    				<label for="last-name">Last Name</label>
		    				<input class="text-input" type="text" name="last-name" placeholder="Last Name">
		    			</div>
		    			<div class="col-md-12 form-row">
		    				<label for="email">Email</label>
		    				<input class="text-input" type="email" name="email" placeholder="john@email.com">
		    			</div>
		    			<div class="col-md-12 form-row">
		    				<label for="comments">Comments</label>
		    				<textarea class="text-input" rows="8" name="comments"></textarea>
		    			</div>
		    			<div class="col-md-12 form-row">
		    				<div class="col-md-3 pull-left">
		    					<input class="btn-reset-enquiry" type="reset" value="Reset">
		    				</div>
		    				<div class="col-md-3 pull-right">
		    					<input class="btn-submit-enquiry" type="submit" value="Submit">
		    				</div>
		    			</div>
	    			</form>
	    		</div>
	    	</div>
	    </div>
    <!-- Footer -->
    <?php
        include_once("./templates/footer.php");
    ?>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="./public_html/js/cookie.js"></script>
<script src="./public_html/js/pingtan.js"></script>
<script src="./public_html/js/auth.js"></script>
</body>

</html>