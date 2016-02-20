<!DOCTYPE html>
<html>

<head>	
	<meta name="keywords" content="PingTan, safety school, construction">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./public_html/css/style.css">
</head>
<body class="body-bg-grey">
	<!-- Header -->
	<?php
        include_once("./templates/header.php");
    ?>

    <!-- Content -->
    <div class="container-fluid container-fluid-padding-none container-form-center">
    	<!-- Content -->
    	<div class="row"> 
    		<div class="col-md-10 content-center">
				<h3 id="title-course">Course Title</h3>
    				<div class="col-md-12 col-padding-none section-participants">
		    			<!-- <div class="col-md-2 form-login-row">
		    				<label for="enrollmentNum">No. of Enrollment</label>
		    				<input class="input-default" type="text" name="enrollmentNum" placeholder="" required>
		    			</div> -->
		    			<input class="hidden-courseID" type="hidden">
		    			<div class="col-md-2 form-login-row col-padding-none">
	                      <label for="course-type">Course Type:</label>
	                      <div class="col-md-12 col-padding-none">
	                        <select class="select-course-type select-default" name="course-type">
	                          <option class="option-fullTime" value="full-time">Full-Time</option>
	                          <option class="option-partTime" value="part-time">Part-Time</option>
	                        </select>
	                      </div>
	                    </div>
	                    <div class="col-md-2 form-login-row">
	                      <label for="languages">Language:</label>
	                      <div class="col-md-12 col-padding-none">
	                        <select class="select-languages select-default" name="languages">
	                        </select>
	                      </div>
	                    </div>
	                    <div class="col-md-2 form-login-row">
	                      <label for="start-date">Start Date:</label>
	                      <div class="col-md-12 col-padding-none">
	                        <select class="select-start-date select-default" name="start-date">
	                        </select>
	                      </div>
	                    </div>
	                    <div class="col-md-3 form-login-row">
	                      <label for="dateTime">Date and Time:</label>
	                      <div class="col-md-12 col-padding-none dateTime parameter-dateTime">
	                        <span>Monday - Friday, 9AM - 6PM</span>
	                      </div>
	                    </div>
	                    <div class="col-md-2 form-login-row">
	                      <label for="duration">Total Hours:</label>
	                      <div class="col-md-12 col-padding-none duration">
	                        <span>40 Hours</span>
	                      </div>
	                    </div>
	                    <div class="col-md-1 form-login-row">
	                      <label for="vacancy">Vacancy:</label>
	                      <div class="col-md-12 col-padding-none vacancy">
	                        <span>5</span>
	                      </div>
	                    </div>
		    			<div class="col-md-12 form-login-row col-padding-none seperate">
		    				<label>Retrieve your employees</label>
		    				<div class="dropdown dd-default dd-participant">
							  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Retrieve Employees
							    <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="dLabel">
							    
							  </ul>
							</div>
		    			</div>
		    			<div class="col-md-12 form-login-row name-tags">
		    				<span class="template-nameTag nameTag" value="feng xin">Feng Xin <i class="fa fa-times"></i></span>
		    			</div>
		    			<div class="col-md-12 col-padding-none seperate">
		    				<h4>Please fill in new participants details if any</h4>
		    			</div>
		    			<div class="template-participant participant col-md-6 form-login-row col-padding-none">
		    				<h4>Participant 1:</h4>
	    					<div class="col-md-6 form-login-row col-padding-none">
		                      <label for="ic">NRIC / Passport No.</label>
		                      <input class="input-default" type="text" name="ic" placeholder="NRIC or Passport" required>
		                    </div>
		                    <div class="col-md-6 form-login-row">
		                      <label for="firstName">First Name</label>
		                      <input class="input-default" type="text" name="firstName" placeholder="" required>
		                    </div>
		                    <div class="col-md-6 form-login-row col-padding-none">
		                      <label for="lastName">Last Name</label>
		                      <input class="input-default" type="text" name="lastName" placeholder="" required>
		                    </div>
		                    <div class="col-md-6 form-login-row">
		                      <label for="nationality">Nationality</label>
		                      <input class="input-default" type="text" name="nationality" placeholder="" required>
		                    </div>
		                    <div class="col-md-6 form-login-row col-padding-none">
		                      <label for="contact">Contact No.</label>
		                      <input class="input-default" type="text" name="contact" placeholder="" required>
		                    </div>
		                    <div class="col-md-6 form-login-row">
			    				<label for="email">Email</label>
			    				<input class="input-default" type="email" name="email" placeholder="Email" required>
			    			</div>
		                    <div class="col-md-6 form-login-row col-padding-none">
		                      <label for="dob">Date of Birth</label>
		                      <input class="input-default" type="text" name="dob" placeholder="dd/mm/yyyy" required>
		                    </div>
		                    <div class="col-md-6 form-login-row">
		                      <label for="occupation">Occupation</label>
		                      <input class="input-default" type="text" name="occupation" placeholder="" required>
		                    </div>
		                    <div class="col-md-6 form-login-row file-upload-template">
		                      <h5 class="label-prerequisite">Prerequisite</h5>
		                      <input class="input-default" type="file">
		                    </div>
		                    <div class="col-md-12 col-padding-none btn-remove-participant-template">
			                    <div class="col-md-3 col-padding-none">
			                    	<input type="button" class="btn btn-danger btn-remove-participant" value="Remove Participant">
		                    	</div>
		                    </div>
		    			</div>

	    			</div>
	    			<div class="col-md-12 form-login-row col-padding-none seperate">
                    	<input type="button" class="btn btn-primary btn-add-participant" value="Add Participant">
                    </div>
                    <div class="col-md-12 form-login-row">
                    	<div class="col-md-3 col-center">
		    				<a id="btn-company-register" type="button">Register</a>
		    			</div>
                    </div>
                    
    		</div>
    	</div>
    </div>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="./public_html/js/request.js"></script>
<script src="./public_html/js/cookie.js"></script>
<script src="./public_html/js/pingtan.js"></script>
<script src="./public_html/js/authValidation.js"></script>
<script src="./public_html/js/auth.js"></script>
<script src="./public_html/js/service.js"></script>
<script src="./public_html/js/course_registration.js"></script>
<script type="text/javascript">
var countNewParticipant = 1;
//add name tag
$('.dd-participant ul li').on('click', function(){
	var nameTag = createNameTag($(this).text());
	nameTag.removeClass('template-nameTag').addClass('nameTag');
	var close = document.createElement('i');
	$(close).addClass('fa').addClass('fa-times');
	nameTag.append(close);
	$('.name-tags').append(nameTag);
});
//delete name tag
$('.nameTag').on('click','i', function(){
	deleteNameTag($(this).closest('span'));
});
// delete participant
$(".btn-remove-participant").on('click', function(event){
	
	$(this).closest('.participant').remove();
	countNewParticipant--;
});
// add participant
$(".btn-add-participant, .dd-participant ul li").on('click', function(event) {
	countNewParticipant++;
	var participant = createNewParticipant();
	participant.removeClass('template-participant');
	participant.find('h4').text('Participant ' + countNewParticipant + ':');
	$('.section-participants').append(participant);
	if(!$(this).hasClass('btn-add-participant')){
		participant.find("input[name='ic']").val($(this).data('nric'));
		participant.find("input[name='firstName']").val($(this).data('firstName'));
		participant.find("input[name='lastName']").val($(this).data('lastName'));
		participant.find("input[name='contact']").val($(this).data('contactNo'));
		participant.find("input[name='nationality']").val($(this).data('nationality'));
		participant.find("input[name='dob']").val($(this).data('dob'));
		participant.find("input[name='email']").val($(this).data('email'));
		participant.find("input[name='occupation']").val($(this).data('occupation'));
	}

});

var createNameTag = function(name){
	var newNameTag = $('.template-nameTag').clone(true, true);
	newNameTag.val(name);
	newNameTag.text(name);
	return newNameTag;
};

var deleteNameTag = function(nameTag){
	nameTag.remove();
};

var createNewParticipant = function(){
	var newParticipant = $('.template-participant').clone(true, true);
	return newParticipant;
};
</script>
</body>

</html>