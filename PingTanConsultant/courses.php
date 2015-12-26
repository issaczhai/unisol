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
    <div class="wrapper">
    	
	    <div class="container container-padding-none">
	    	<!-- filter bar -->
	    	<div class="row filter-bar"> 
	    		<div class="col-md-12 col-center">
	    			<ul class="course-filter-bar">
	    				<li>Filter By: </li>
	    				<li class="cat-filter">
	    					<div class="btn-group">
			                    <button type="button" class="btn btn-default dropdown-toggle  dd-filter"
			                            data-toggle="dropdown">
			                            <span class="sort-value" id='sort_type'>Language</span> <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu" role="menu">
			                        <li><a href="javascript:sort('default');">Chinese</a></li>
			                        <li><a href="javascript:sort('priceLH');">English</a></li>
			                        <li><a href="javascript:sort('priceHL');">Bengali</a></li>
			                    </ul>
			                </div>
	    				</li>
	    				<li class="cat-filter">
	    					<div class="btn-group">
			                    <button type="button" class="btn btn-default dropdown-toggle  dd-filter"
			                            data-toggle="dropdown">
			                            <span class="sort-value" id='sort_type'>Target Audience</span> <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu" role="menu">
			                        <li><a href="javascript:sort('default');">Safety Professional</a></li>
			                        <li><a href="javascript:sort('priceLH');">Normal Worker</a></li>
			                        <li><a href="javascript:sort('priceHL');">Consultant</a></li>
			                    </ul>
			                </div>
	    				</li>
	    				<li class="cat-filter">
	    					<div class="btn-group">
			                    <button type="button" class="btn btn-default dropdown-toggle  dd-filter"
			                            data-toggle="dropdown">
			                            <span class="sort-value" id='sort_type'>Course Type</span> <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu" role="menu">
			                        <li><a href="javascript:sort('default');">Full-time</a></li>
			                        <li><a href="javascript:sort('priceLH');">Part-time</a></li>
			                    </ul>
			                </div>
	    				</li>
	    			</ul>
	    		</div>
	        </div>

	        <!-- display courses -->
	    	<div class="row course">
	    		<div class="col-md-2">
	    			<h3 class="yellow-default title-courses">All Courses</h3>
	    		</div>
	    		<div class="col-md-12 result">
	    			<div class="col-md-3 thumbnail-course">
						<img class="img-course-thumbnail" src="./public_html/img/course-thumbnail.png">
						<h5>In-Memory Data Management</h5>
						<div class="block-ellipsis">
							Digitization is reinventing the global economy; individuals, businesses, and societies are becoming interconnected in real time, leading
						</div>
						<h5 class="title-lang"><i class="fa fa-language"></i>&nbsp;English</h5>
						<h5 class="title-calendar"><i class="fa fa-calendar"></i>&nbsp;Mon - Fri: 7pm - 9pm</h5>
						<div class="course-thumbnail-btns">
							<a class="pull-left" type="button">Register</a>
							<a class="pull-right" type="button">View Details</a>
						</div>
	    			</div>

	    			<div class="col-md-3 thumbnail-course">
						<img class="img-course-thumbnail" src="./public_html/img/course-thumbnail.png">
						<h5>In-Memory Data Management</h5>
						<div class="block-ellipsis">
							Digitization is reinventing the global economy; individuals, businesses, and societies are becoming interconnected in real time, leading
						</div>
						<h5 class="title-lang"><i class="fa fa-language"></i>&nbsp;English</h5>
						<h5 class="title-calendar"><i class="fa fa-calendar"></i>&nbsp;Mon - Fri: 7pm - 9pm</h5>
						<div class="course-thumbnail-btns">
							<a class="pull-left" type="button">Register</a>
							<a class="pull-right" type="button">View Details</a>
						</div>
	    			</div>

	    			<div class="col-md-3 thumbnail-course">
						<img class="img-course-thumbnail" src="./public_html/img/course-thumbnail.png">
						<h5>In-Memory Data Management</h5>
						<div class="block-ellipsis">
							Digitization is reinventing the global economy; individuals, businesses, and societies are becoming interconnected in real time, leading
						</div>
						<h5 class="title-lang"><i class="fa fa-language"></i>&nbsp;English</h5>
						<h5 class="title-calendar"><i class="fa fa-calendar"></i>&nbsp;Mon - Fri: 7pm - 9pm</h5>
						<div class="course-thumbnail-btns">
							<a class="pull-left" type="button">Register</a>
							<a class="pull-right" type="button">View Details</a>
						</div>
	    			</div>

	    			<div class="col-md-3 thumbnail-course">
						<img class="img-course-thumbnail" src="./public_html/img/course-thumbnail.png">
						<h5>In-Memory Data Management</h5>
						<div class="block-ellipsis">
							Digitization is reinventing the global economy; individuals, businesses, and societies are becoming interconnected in real time, leading
						</div>
						<h5 class="title-lang"><i class="fa fa-language"></i>&nbsp;English</h5>
						<h5 class="title-calendar"><i class="fa fa-calendar"></i>&nbsp;Mon - Fri: 7pm - 9pm</h5>
						<div class="course-thumbnail-btns">
							<a class="pull-left" type="button">Register</a>
							<a class="pull-right" type="button">View Details</a>
						</div>
	    			</div>

	    			<div class="col-md-3 thumbnail-course">
						<img class="img-course-thumbnail" src="./public_html/img/course-thumbnail.png">
						<h5>In-Memory Data Management</h5>
						<div class="block-ellipsis">
							Digitization is reinventing the global economy; individuals, businesses, and societies are becoming interconnected in real time, leading
						</div>
						<h5 class="title-lang"><i class="fa fa-language"></i>&nbsp;English</h5>
						<h5 class="title-calendar"><i class="fa fa-calendar"></i>&nbsp;Mon - Fri: 7pm - 9pm</h5>
						<div class="course-thumbnail-btns">
							<a class="pull-left" type="button">Register</a>
							<a class="pull-right" type="button">View Details</a>
						</div>
	    			</div>

	    			<div class="col-md-3 thumbnail-course">
						<img class="img-course-thumbnail" src="./public_html/img/course-thumbnail.png">
						<h5>In-Memory Data Management</h5>
						<div class="block-ellipsis">
							Digitization is reinventing the global economy; individuals, businesses, and societies are becoming interconnected in real time, leading
						</div>
						<h5 class="title-lang"><i class="fa fa-language"></i>&nbsp;English</h5>
						<h5 class="title-calendar"><i class="fa fa-calendar"></i>&nbsp;Mon - Fri: 7pm - 9pm</h5>
						<div class="course-thumbnail-btns">
							<a class="pull-left" type="button">Register</a>
							<a class="pull-right" type="button">View Details</a>
						</div>
	    			</div>

	    			<div class="col-md-3 thumbnail-course">
						<img class="img-course-thumbnail" src="./public_html/img/course-thumbnail.png">
						<h5>In-Memory Data Management</h5>
						<div class="block-ellipsis">
							Digitization is reinventing the global economy; individuals, businesses, and societies are becoming interconnected in real time, leading
						</div>
						<h5 class="title-lang"><i class="fa fa-language"></i>&nbsp;English</h5>
						<h5 class="title-calendar"><i class="fa fa-calendar"></i>&nbsp;Mon - Fri: 7pm - 9pm</h5>
						<div class="course-thumbnail-btns">
							<a class="pull-left" type="button">Register</a>
							<a class="pull-right" type="button">View Details</a>
						</div>
	    			</div>

	    			<div class="col-md-3 thumbnail-course">
						<img class="img-course-thumbnail" src="./public_html/img/course-thumbnail.png">
						<h5>In-Memory Data Management</h5>
						<div class="block-ellipsis">
							Digitization is reinventing the global economy; individuals, businesses, and societies are becoming interconnected in real time, leading
						</div>
						<h5 class="title-lang"><i class="fa fa-language"></i>&nbsp;English</h5>
						<h5 class="title-calendar"><i class="fa fa-calendar"></i>&nbsp;Mon - Fri: 7pm - 9pm</h5>
						<div class="course-thumbnail-btns">
							<a class="pull-left" type="button">Register</a>
							<a class="pull-right" type="button">View Details</a>
						</div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
    </div> <!-- end of wrapper -->
    <!-- Footer -->
    <?php
        include_once("./templates/footer.php");
    ?>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>