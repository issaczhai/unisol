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
    ?>

    <!-- Content -->
    <div class="container-fluid container-fluid-padding-none">
    	<div class="row row-title-profile">
    		<h4 class="title-student-name">Hi, <a href="#">Feng Xin</a></h4>
    	</div>

    	<div class="row content-profile">
    		<div class="col-md-3 sidebar-profile">
    			<h3 class="yellow-default">My Documents</h3>
    			<ul  class="list-document">
    				<li>
    					<h5 class="yellow-default">In-Memory Data Management1 <i class="fa fa-chevron-circle-right fa-lg pull-right"></i></h5>
    					<ul class="list-document-titles">
                            <li class="outline">
                                Outline
                            </li>
                            <li>
                                <ul class="list-outline">
                                    <li>
                                        <a class="text-default" href="./tickets.pdf">Lecture 1</a><i class="fa fa-circle pull-right"></i>
                                    </li>
                                    <li>
                                        <a class="text-default" href="#">Lecture 2</a><i class="fa fa-circle pull-right"></i>
                                    </li>
                                    <li>
                                        <a class="text-default" href="#">Lecture 3</a><i class="fa fa-circle pull-right"></i>
                                    </li>
                                </ul>
    						</li>
                            <li class="course-material">
                                Course Material
                            </li>
                            <li>
                                <h5 class="hd-session">Session 1</h5>
                                <ul id="list-session1" class="list-session">
                                    <li>
                                        <a class="text-default" href="./tickets.pdf">Lecture 1</a><i class="fa fa-circle pull-right"></i>
                                    </li>
                                    <li>
                                        <a class="text-default" href="#">Lecture 2</a><i class="fa fa-circle pull-right"></i>
                                    </li>
                                    <li>
                                        <a class="text-default" href="#">Lecture 3</a><i class="fa fa-circle pull-right"></i>
                                    </li>
                                </ul>
                            </li>
    					</ul>
    				</li>
    				<li>
    					<h5 class="yellow-default">In-Memory Data Management2 <i class="fa fa-chevron-circle-right fa-lg pull-right"></i></h5>
    					<ul class="list-document-titles">
    						<li>
    							<a class="text-default" href="#">Lecture 1</a><i class="fa fa-circle pull-right"></i>
    						</li>
    						<li>
    							<a class="text-default" href="#">Lecture 2</a><i class="fa fa-circle pull-right"></i>
    						</li>
    						<li>
    							<a class="text-default" href="#">Lecture 3</a><i class="fa fa-circle pull-right"></i>
    						</li>
    					</ul>
    				</li>
    				<li>
    					<h5 class="yellow-default">In-Memory Data Management3 <i class="fa fa-chevron-circle-right fa-lg pull-right"></i></h5>
    					<ul class="list-document-titles">
    						<li>
    							<a class="text-default" href="#">Lecture 1</a><i class="fa fa-circle pull-right"></i>
    						</li>
    						<li>
    							<a class="text-default" href="#">Lecture 2</a><i class="fa fa-circle pull-right"></i>
    						</li>
    						<li>
    							<a class="text-default" href="#">Lecture 3</a><i class="fa fa-circle pull-right"></i>
    						</li>
    					</ul>
    				</li>
    			</ul>
    		</div>
    		<div class="col-md-8 result-profile">
    			<h4 class="yellow-default">My Current Courses</h4>
    			<div class="row row-taking">
    				<div class="thumbnail-taking-template col-md-4 thumbnail-course">
						<img class="img-course-thumbnail" src="./public_html/img/course-thumbnail.png">
						<h5 class="title-course">In-Memory Data Management</h5>
						<div class="block-ellipsis">
							Digitization is reinventing the global economy; individuals, businesses, and societies are becoming interconnected in real time, leading
						</div>
						<h5 class="title-lang"><i class="fa fa-language"></i>&nbsp;English</h5>
						<h5 class="title-calendar"><i class="fa fa-calendar"></i>&nbsp;Mon - Fri: 7pm - 9pm</h5>
						<div class="course-thumbnail-btns">
							<a class="pull-right btn-view-details" type="button">View Details</a>
						</div>
	    			</div>
    			</div>
    			<h4 class="yellow-default">My Upcoming Courses</h4>
    			<div class="row row-upcoming">
    				<div class="thumbnail-upcoming-template col-md-4 thumbnail-course">
						<img class="img-course-thumbnail" src="./public_html/img/course-thumbnail.png">
						<h5 class="title-course">In-Memory Data Management</h5>
						<div class="block-ellipsis">
							Digitization is reinventing the global economy; individuals, businesses, and societies are becoming interconnected in real time, leading
						</div>
						<h5 class="title-lang"><i class="fa fa-language"></i>&nbsp;English</h5>
						<h5 class="title-calendar"><i class="fa fa-calendar"></i>&nbsp;Mon - Fri: 7pm - 9pm</h5>
						<div class="course-thumbnail-btns">
							<a class="pull-left btn-deregister" type="button">Un-Register</a>
							<a class="pull-right btn-view-details" type="button">View Details</a>
						</div>
	    			</div>
    			</div>
    			<h4 class="yellow-default">My Completed Courses</h4>
    			<div class="row row-taken">
    				<div class="thumbnail-taken-template col-md-4 thumbnail-course">
						<img class="img-course-thumbnail" src="./public_html/img/course-thumbnail.png">
						<h5 class="title-course">In-Memory Data Management</h5>
						<div class="block-ellipsis">
							Digitization is reinventing the global economy; individuals, businesses, and societies are becoming interconnected in real time, leading
						</div>
						<h5 class="title-lang"><i class="fa fa-language"></i>&nbsp;English</h5>
						<h5 class="title-calendar"><i class="fa fa-calendar"></i>&nbsp;Mon - Fri: 7pm - 9pm</h5>
						<div class="course-thumbnail-btns">
							<a class="pull-right" type="button">View Details</a>
						</div>
	    			</div>
    			</div>
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
<script src="./public_html/js/auth.js"></script>
<script src="./public_html/js/service.js"></script>
<script type="text/javascript">
	/*toggle the sidebar course*/
	$('.fa-chevron-circle-right').on('click', function(e){
		
		if ($(this).parents().siblings('.list-document-titles').hasClass('list-opened')) {
			$(this).parents().siblings('.list-document-titles').removeClass('list-opened');
			$(this).removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-right');
		}else{
			$(this).parents().siblings('.list-document-titles').addClass('list-opened');
			$(this).removeClass('fa-chevron-circle-right').addClass('fa-chevron-circle-down');
		}
		
	});
    /*toggle session for each course */
    $('.hd-session').on('click', function(e){
        
        if ($(this).siblings('.list-session').hasClass('list-opened')) {
            $(this).siblings('.list-session').removeClass('list-opened');
        }else{
            $(this).siblings('.list-session').addClass('list-opened');
        }
        
    });
</script>
</body>

</html>