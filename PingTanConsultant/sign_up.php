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
	    		<div class="col-md-5 login-content">
    				<h3>Welcome to PingTan Consultant</h3>
		    		<!-- <form id="form-signUp" class="col-md-12" action="#"> -->
		    		<section class="col-md-12 section-signUp">
		    			<div id="errorMsgSignUp" class="col-md-12 form-login-row">
		    				
		    			</div>
		    			<div class="col-md-12 form-login-row">
		    				<div class="col-md-3 col-padding-none">
		    					<span>Register As: </span>
		    				</div>
		    				<div class="col-md-8 col-padding-none">
		    					<label class="radio-inline"><input class="radio-type" type="radio" value="individual" name="individual" checked="true">Individual</label>
		    					<label class="radio-inline"><input class="radio-type" type="radio" value="company" name="company">Company</label>
		    				</div>
		    			</div>
	    				
	    				<div class="col-md-12 col-padding-none signUp-content signUp-content-individual">
	    					<div class="col-md-6 form-login-row">
	    						<label for="fName">First Name</label>
			    				<input class="input-login" type="text" name="fName" placeholder="First Name" required>
			    			</div>
			    			<div class="col-md-6 form-login-row">
			    				<label for="lName">Last Name</label>
			    				<input class="input-login" type="text" name="lName" placeholder="Last Name" required>
			    			</div>
			    			<div class="col-md-12 form-login-row">
			    				<label for="email">Email</label>
			    				<input class="input-login" type="email" name="email" placeholder="Email" required>
			    			</div>
			    			<div class="col-md-12 form-login-row">
			    				<label for="password">Password</label>
			    				<input class="input-login" type="password" name="password" placeholder="Password" required>
			    			</div>
			    			<div class="col-md-12 form-login-row">
			    				<label for="rePassword">Re-enter Password</label>
			    				<input class="input-login" type="password" name="rePassword" placeholder="Re-enter Password" required>
			    			</div>
	    				</div>
	    				<div class="col-md-12 col-padding-none signUp-content signUp-content-company hide">
			    			<div class="col-md-6 form-login-row">
			    				<label for="companyName">Company Name</label>
			    				<input class="input-login" type="text" name="companyName" placeholder="Eg: Ping Tan Pte Ltd" required>
			    			</div>
			    			<div class="col-md-6 form-login-row">
			    				<label for="registrationId">Registration ID</label>
			    				<input class="input-login" type="text" name="registrationId" placeholder="Company Registration ID" required>
			    			</div>
			    			<div class="col-md-6 form-login-row">
			    				<label for="cPassword">Password</label>
			    				<input class="input-login" type="password" name="cPassword" placeholder="Password" required>
			    			</div>
			    			<div class="col-md-6 form-login-row">
			    				<label for="re-cPassword">Re-enter Password</label>
			    				<input class="input-login" type="password" name="reCPassword" placeholder="Re-enter Password" required>
			    			</div>
			    			<div class="col-md-12 form-login-row">
			    				<label for="street">Street</label>
			    				<input class="input-login" type="text" name="street" placeholder="" required>
			    			</div>
			    			<div class="col-md-6 form-login-row">
			    				<label for="unitNo">Unit No.</label>
			    				<input class="input-login" type="text" name="unitNo" placeholder="Eg: 01-01" required>
			    			</div>
			    			<div class="col-md-6 form-login-row">
			    				<label for="postal">Postal Code</label>
			    				<input class="input-login" type="text" name="postal" placeholder="Eg: S567890" required>
			    			</div>
			    			<div class="col-md-6 form-login-row">
			    				<label for="cFName">Contact Person First Name</label>
			    				<input class="input-login" type="text" name="cFName" placeholder="" required>
			    			</div>
			    			<div class="col-md-6 form-login-row">
			    				<label for="cLName">Contact Person Last Name</label>
			    				<input class="input-login" type="text" name="cLName" placeholder="" required>
			    			</div>
			    			<div class="col-md-12 form-login-row">
			    				<label for="cEmail">Contact Person Email</label>
			    				<input class="input-login" type="email" name="cEmail" placeholder="" required>
			    			</div>
			    			<div class="col-md-6 form-login-row">
			    				<label for="cLTel">Contact Person Tel.</label>
			    				<input class="input-login" type="text" name="cLTel" placeholder="65-67676767" required>
			    			</div>
			    			<div class="col-md-6 form-login-row">
			    				<label for="cLFax">Contact Person Fax</label>
			    				<input class="input-login" type="text" name="cLFax" placeholder="65-67676767" required>
			    			</div>
		    			</div>
		    			<div class="col-md-12 form-login-row">
	    					<input id="btn-signUp" class="btn-login" type="button" value="Register">
		    			</div>
		    		</section>
	    			<!-- </form> -->
	    		</div>
	    	</div>
	    </div>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/aes.js"></script>
<script src="./public_html/js/cookie.js"></script>
<script src="./public_html/js/request.js"></script>
<script src="./public_html/js/authValidation.js"></script>
<script src="./public_html/js/auth.js"></script>

<script type="text/javascript">
	$('.radio-type').on('click', function(event) {
		
		/* Act on the event */
		$('.radio-type').prop("checked", false);
		$(this).prop("checked", true);
		$(".signUp-content").removeClass('hide');
		if($(this).val() === "individual"){
			$(".signUp-content-company").addClass('hide');
		}else if ($(this).val() === "company"){
			$(".signUp-content-individual").addClass('hide');
		}
	});

	/*$('#btn-signUp').on('click', function(event) {
		signUp();
	});*/
</script>
</body>

</html>