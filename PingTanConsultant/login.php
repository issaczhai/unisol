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
	    		<div class="col-md-4 login-content">
    				<h3>Login</h3>
		    		<section class="col-md-12" action="#">
		    			<div class="col-md-12 form-login-row">
		    				<input class="input-login" type="email" name="email" placeholder="Email" required>
		    			</div>
		    			<div class="col-md-12 form-login-row">
		    				<input class="input-login" type="password" name="password" placeholder="Password" required>
		    			</div>
		    			<div class="col-md-12 form-login-row row-remember-me">
		    				<div class="col-md-6 pull-left">
		    					<input type="checkbox" name="rememberme" id="rememberme-0" value="Remember me"> <span>Remember Me</span>
		    				</div>
		    				<div class="col-md-6 pull-right">
		    					<a href="">Forgot Password?</a>
		    				</div>
		    			</div>
		    			<div class="col-md-12 form-login-row">
	    					<input class="btn-login" type="submit" value="Login">
		    			</div>
		    			<div class="col-md-12 form-login-row">
	    					<span>Don't have an account? </span><a class="btn-sign-up" type="button" href="./sign_up.php">Sign Up Here</a>
		    			</div>
	    			</section>
	    		</div>
	    	</div>
	    </div>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>