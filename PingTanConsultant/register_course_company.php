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
    		<div class="col-md-6 content-center">
				<h3>Course Title</h3>
    				<div class="col-md-12 col-padding-none section-participants">
		    			<div class="col-md-6 form-login-row">
		    				<label for="enrollmentNum">Number of Enrollment</label>
		    				<input class="input-default" type="text" name="enrollmentNum" placeholder="" required>
		    			</div>
		    			<div class="col-md-6 form-login-row">
		    				<label for="start-date">Start Date</label><br>
		    				<select class="start-date" name="start-date">
	    						<option value="01012016">1 Jan 2016</option>
	    						<option value="01082016">8 Jan 2016</option>
	    					</select>
		    			</div>
		    			<div class="col-md-12 form-login-row">
		    				<label>Retrieve your employees</label>
		    				<div class="dropdown dd-default dd-participant">
							  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Retrieve Employees
							    <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="dLabel">
							    <li>Feng Xin</li>
							    <li>Issac</li>
							    <li>Jacky</li>
							    <li>Javi</li>
							  </ul>
							</div>
		    			</div>
		    			<div class="col-md-12 form-login-row name-tags">
		    				<span class="template-nameTag nameTag" value="feng xin">Feng Xin <i class="fa fa-times"></i></span>
		    				<span class="nameTag" value="feng xin">Feng Xin <i class="fa fa-times"></i></span>
		    			</div>
		    			<div class="col-md-12">
		    				<h4>Please fill in new participants details</h4>
		    			</div>
		    			<div class="template-participant participant col-md-12 form-login-row">
		    				<h4>Participant 1:</h4>
	    					<div class="col-md-6 form-login-row">
		                      <label for="ic">NRIC / Passport No.</label>
		                      <input class="input-default" type="text" name="ic" placeholder="NRIC or Passport" required>
		                    </div>
		                    <div class="col-md-6 form-login-row">
		                      <label for="nationality">Nationality</label>
		                      <input class="input-default" type="text" name="nationality" placeholder="" required>
		                    </div>
		                    <div class="col-md-6 form-login-row">
		                      <label for="contact">Contact No.</label>
		                      <input class="input-default" type="text" name="contact" placeholder="" required>
		                    </div>
		                    <div class="col-md-6 form-login-row">
			    				<label for="email">Email</label>
			    				<input class="input-default" type="email" name="email" placeholder="Email" required>
			    			</div>
		                    <div class="col-md-6 form-login-row">
		                      <label for="dob">Date of Birth</label>
		                      <input class="input-default" type="text" name="dob" placeholder="dd/mm/yyyy" required>
		                    </div>
		                    <div class="col-md-6 form-login-row">
		                      <label for="occupation">Occupation</label>
		                      <input class="input-default" type="text" name="occupation" placeholder="" required>
		                    </div>
		                    <div class="col-md-6 form-login-row">
		                      <label for="prerequisite">Upload Prerequisites</label>
		                      <input type="button" name="prerequisite" placeholder="" required>
		                    </div>
		                    
		    			</div>

	    			</div>
	    			<div class="col-md-6 form-login-row">
                    	<input type="button" class="btn btn-primary btn-add-participant" value="Add Participant">
                    </div>
                    <div class="col-md-12 form-login-row">
		    			<div class="col-md-6 form-login-row col-padding-none">
	    					<input class="btn btn-secondary btn-cancel" type="button" value="Cancel">
		    			</div>
		    			<div class="col-md-6 form-login-row">
	    					<input class="btn-login" type="button" value="Register">
		    			</div>
	    			</div>
    		</div>
    	</div>
    </div>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript">
var countNewParticipant = 1;

$('.dd-participant ul li').on('click', function(){
	var nameTag = createNameTag($(this).text());
	nameTag.removeClass('template-nameTag').addClass('nameTag');
	var close = document.createElement('i');
	$(close).addClass('fa').addClass('fa-times');
	nameTag.append(close);
	$('.name-tags').append(nameTag);
});

$('.nameTag').on('click','i', function(){
	deleteNameTag($(this).closest('span'));
});

$(".btn-add-participant").on('click', function(event) {
	countNewParticipant++;
	var participant = createNewParticipant();
	participant.removeClass('template-participant');
	participant.find('h4').text('Participant ' + countNewParticipant + ':');
	$('.section-participants').append(participant);

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