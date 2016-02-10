<!DOCTYPE html>
<html>

<head>	
	<meta name="keywords" content="PingTan, safety school, construction">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./public_html/css/style.css">
</head>
<body>
	<!-- Header -->
	<?php		
        include_once("./templates/header.php");
        include_once("./register_course_individual.php");
    ?>
    <!-- Content -->
	    <div class="container-fluid course-detail-content">
	    	<div class="row row-course-detail">
	    		<div class="col-md-5 col-md-offset-1 course-detail-img">
	    			<h3 class="title-session yellow-default">Work at Height for Assessors</h3>
	    			<img src="./public_html/img/course-detail.png">
	    		</div>
	    		<div class="col-md-5 course-detail-info">
	    			<div class="row course-detail-info-row">
	    				<div class="col-md-1">
	    					<i class="fa fa-language fa-lg"></i>
	    				</div>
	    				<div class="col-md-3">
	    					<span>Language:</span>
	    				</div>
	    				<div class="col-md-8">
	    					<select class="select-languages" name="languages">
	    					</select>
	    				</div>
	    			</div>
	    			<div class="row course-detail-info-row">
	    				<div class="col-md-1">
	    					<i class="fa fa-map-marker fa-lg"></i>
	    				</div>
	    				<div class="col-md-3">
	    					<span>Location:</span>
	    				</div>
	    				<div class="col-md-8">
	    					<span>8 New Industrial Road LHK 3 Building #06-04 Singapore 536200</span>
	    				</div>
	    			</div>
	    			<div class="row course-detail-info-row">
	    				<div class="col-md-1">
	    					<i class="fa fa-calendar fa-lg"></i>
	    				</div>
	    				<div class="col-md-3">
	    					<span>Course Type:</span>
	    				</div>
	    				<div class="col-md-8">
	    					<select class="select-course-type" name="course-type">
	    						<option class="option-fullTime" value="full-time">Full-Time</option>
	    						<option class="option-partTime" value="part-time">Part-Time</option>
	    					</select>
	    				</div>
	    			</div>
	    			<div class="row course-detail-info-row row-fulltime">
	    				<div class="col-md-1">
	    					<i class="fa fa-clock-o fa-lg"></i>
	    				</div>
	    				<div class="col-md-3 title-dateTime">
	    					<span>Date and Time:</span>
	    				</div>
	    				<div class="col-md-8 dateTime">
	    					<span>Monday - Friday, 9AM - 6PM</span>
	    				</div>
	    			</div>
	    			<div class="row course-detail-info-row row-parttime">
	    				<div class="col-md-1">
	    					<i class="fa fa-hourglass-half fa-lg"></i>
	    				</div>
	    				<div class="col-md-3 titled-duration">
	    					<span>Total Hours:</span>
	    				</div>
	    				<div class="col-md-8 duration">
	    					<span>40 Hours</span>
	    				</div>
	    			</div>
	    			<div class="row course-detail-info-row">
	    				<div class="col-md-1">
	    					<i class="fa fa-calendar-check-o fa-lg"></i>
	    				</div>
	    				<div class="col-md-3">
	    					<span>Start Date:</span>
	    				</div>
	    				<div class="col-md-8">
	    					<select class="select-start-date" name="start-date">
	    						
	    					</select>
	    				</div>
	    			</div>
	    			<div class="row course-detail-info-row">
	    				<div class="col-md-1">
	    					<i class="fa fa-users fa-lg"></i>
	    				</div>
	    				<div class="col-md-3">
	    					<span>Vacancy: </span>
	    				</div>
	    				<div class="col-md-8 vacancy">
	    					<span></span>
	    				</div>
	    			</div>
	    			<div class="row course-detail-info-row">
	    				<div class="col-md-1">
	    					<i class="fa fa-usd fa-lg"></i>
	    				</div>
	    				<div class="col-md-3 titled-price">
	    					<span>Price:</span>
	    				</div>
	    				<div class="col-md-8 price">
	    					<span class="red-default detail-price"> SGD 100 (GST Inclusive)</span>
	    				</div>
	    			</div>
	    			<div class="row course-detail-info-row">
	    				<div class="col-md-12">
			    			<a class="btn-enrollment" type="button">Enroll me for this course</a>		
						</div>
	    			</div>
	    		</div>
	    		<!-- Warning Msg When No Future Session is available -->
	    		<div class="col-md-5 warning-no-session">
	    			<h5>Sorry, there's no upcoming sessions for this course yet.</h5>
	    		</div>
	    	</div>



	    	<div class="row">
	    		<div class="col-md-6 col-md-offset-1 course-info">
	    			<h3>Course Information</h3>
	    			<h4>Course Summary</h4>
	    			<p class="detail-description">
	    				Work at Height for Assessors course is to provide the participants with the requisite work at height knowledge to assess work at height activities so that work is carried out properly and safely. It is a requirement that participants must have completed and passed the WAH supervisor course.
	    			</p>
	    			<h4>Course Content</h4>
	    			<ul class="list-course-content">
	    				
	    			</ul>
	    			<h4>Why This Course ?</h4>
	    			<p class="detail-objective">Upon successful completion of the course and passing the examination, a certificate of successful completion endorsed by PingTan Consultant Pte Ltd will be issued to the participants.
	    			</p>
	    			<h4>Certification</h4>
	    			<p>Upon successful completion of the course and passing the examination, a certificate of successful completion endorsed by PingTan Consultant Pte Ltd will be issued to the participants.
	    			</p>
	    		</div>
	    		<div class="col-md-4 course-prerequisite">
	    			<h3>Prerequisites</h3>
	    		</div>
	    	</div>
	    </div>


    <!-- Footer -->
    <?php
        include_once("./templates/footer.php");
    ?>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="./public_html/js/request.js"></script>
<script src="./public_html/js/cookie.js"></script>
<script src="./public_html/js/pingtan.js"></script>
<script src="./public_html/js/authValidation.js"></script>
<script src="./public_html/js/auth.js"></script>
<script src="./public_html/js/service.js"></script>
<script src="./public_html/js/course_registration.js"></script>
</body>

</html>