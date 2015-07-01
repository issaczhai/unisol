<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php 
            if (session_status()!=PHP_SESSION_ACTIVE) {
                    session_start();
            }
            include_once("./Manager/ConnectionManager.php");
            include_once("./Manager/ProjectManager.php");
            /*
            $projectMgr = new ProjectManager();
            $projects = [];
            
            if(isset($_SESSION['results']) && !empty($_SESSION['results'])){
                $projects = $_SESSION['results'];
            }else{
                $projects = $projectMgr->getAllProjects();
            }
            */
        ?>
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
            #subscribe_btn{
                border-radius:0;
            }
            
            .dropdown-menu{
                margin:0;
                width:100%
            }
            .dropdown-menu li > ul{
                width:100%;
                padding-left:35px;
            }
            .dropdown-menu li > ul li{
                width:20px
            }
            .dropdown-menu li > ul li:hover{
                background: #E6E6E6;
            }
            h5{
                text-align: center;
                margin-top: 0
            }
            .caret{
                margin-top:8px
            }
            #all{
                width:100%;
            }
            .btn-default{
                border-radius: 0;
            }
            .project{
                width: 200px;
                margin-right:10px;
                margin-bottom: 15px;
                padding:0;
                overflow: hidden
            }
            .project-overlay{
                -webkit-transition: all 0.7s ease;
                transition: all 0.7s ease;
                position:absolute;
                margin-top:-370px;
                padding-top:50px;
                height:170px;
                text-align:center;
                width:100%;
                opacity:0.7;
                background-color: #000000;
                z-index:1000
            }
            .project:hover > .project-overlay{
                margin-top:-200px;
            }
            .project-overlay h4{
                
                z-index:1000
            }
            .project-overlay h4 a{
                color:#fff;
                
            }
            .project-overlay h4 a:hover{
                color:#A3A3A3;
                
            }
            .projectName-overlay{
                position:absolute;
                margin-top:-30px;
                height:30px;
                text-align:center;
                width:100%;
                opacity:0.7;
                background-color: #000000;
                z-index:1000
            }
            .projectName-overlay span{
                color:#fff;
                line-height:2em;
                z-index:1000
            }
            .project-pagination{
                text-align: center;
            }
            .pagination li a:hover{
                background-color: rgb(192, 192, 186) !important;
            }
            .not-active {
                pointer-events: none;
                cursor: default;
                background-color:#fff !important;
            }
            
        </style>
        
        <meta charset="UTF-8">
        <title>Projects</title>
    </head>
    <body>
    <?php
    include_once("./templates/header.php");
    ?>
        <div class='container-fluid' style='margin-top:100px'>
            <div class='row' style='height:50px;background-color: rgb(153, 153, 153)'>
            </div>
            <div class='row pull-right' style='height:40px;margin-top:-40px;background:none;border-top: 1px #FFF solid; border-left: 1px #FFF solid;padding-left:1151px'>
            </div>
            <div class='row' style='margin-top:30px'>
                <div id='sidebar' class='col-md-2'>
                    <h5>REFINE BY</h5>
                    <button id='all' type="button" class="btn btn-default" style='margin-bottom:20px'>
                        <span class="sort-value">ALL</span>
                    </button>
                    <div class="btn-group-justified">
                        <div class="btn-group sort-panel">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                    <span class="sort-value">ALPHABET</span> <span class="caret pull-right"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <ul class="list-inline">
                                        <li><a class='alphabet' href="#a">A</a></li>
                                        <li><a class='alphabet' href="#b">B</a></li>
                                        <li><a class='alphabet' href="#c">C</a></li>
                                        <li><a class='alphabet' href="#d">D</a></li>
                                        <li><a class='alphabet' href="#e">E</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="list-inline">
                                       <li><a class='alphabet' href="#f">F</a></li>
                                       <li><a class='alphabet' href="#g">G</a></li>
                                       <li><a class='alphabet' href="#h">H</a></li>
                                       <li><a class='alphabet' href="#i">I</a></li>
                                       <li><a class='alphabet' href="#j">J</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="list-inline">
                                       <li><a class='alphabet' href="#k">K</a></li>
                                       <li><a class='alphabet' href="#l">L</a></li>
                                       <li><a class='alphabet' href="#m">M</a></li>
                                       <li><a class='alphabet' href="#n">N</a></li>
                                       <li><a class='alphabet' href="#o">O</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="list-inline">
                                       <li><a class='alphabet' href="#p">P</a></li>
                                       <li><a class='alphabet' href="#q">Q</a></li>
                                       <li><a class='alphabet' href="#r">R</a></li>
                                       <li><a class='alphabet' href="#s">S</a></li>
                                       <li><a class='alphabet' href="#t">T</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="list-inline">
                                       <li><a class='alphabet' href="#u">U</a></li>
                                       <li><a class='alphabet' href="#v">V</a></li>
                                       <li><a class='alphabet' href="#w">W</a></li>
                                       <li><a class='alphabet' href="#x">X</a></li>
                                       <li><a class='alphabet' href="#y">Y</a></li>
                                       <li><a class='alphabet' href="#z">Z</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <br>
                    <div class="btn-group-justified">
                        <div class="btn-group sort-panel">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                <span class="sort-value">COUNTRY</span> <span class="caret pull-right"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class='country' href="#sg">Singapore</a></li>
                                <li><a class='country' href="#cn">China</a></li>
                                <li><a class='country' href="#my">Malaysia</a></li>
                                <li><a class='country' href="#in">Indonesia</a></li>
                            </ul>
                        </div>
                    </div>
                    <br>    
                    <div class="btn-group-justified">
                        <div class="btn-group sort-panel">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                    <span class="sort-value">YEAR</span> <span class="caret pull-right"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class='year' href="#2015">2015</a></li>
                                <li><a class='year' href="#2014">2014</a></li>
                                <li><a class='year' href="#2013">2013</a></li>
                                <li><a class='year' href="#2012">2012</a></li>
                            </ul>
                        </div>
                    </div>
                    <br>
                    <div class="btn-group-justified">
                        <div class="btn-group sort-panel">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                    <span class="sort-value">TYPE</span> <span class="caret pull-right"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class='type' href="#studio">Studio</a></li>
                                <li><a class='type' href="#office">Office</a></li>
                                <li><a class='type' href="#school">School</a></li>
                                <li><a class='type' href="#building">Building</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="loaderID" style="display:none;position:absolute; top:200px; left:50%; z-index:10; opacity:1"><img src="./public_html/img/ajax-loader.gif" /></div>
                <div id="results">
                    <!--
                    <div id='thumbnails' class='col-md-10'>
                        
                       // <?php
                            //foreach ($projects as $eachProject){
                                //$project_name = $eachProject['project_name'];
                        ?>
                                <div class='col-md-2 project' style='height:200px;'>
                                    <a href="#"><img class="project-image" style="width:200px;height:200px" src="./public_html/img/sample1.jpg" alt="" /></a>
                                    <div class="projectName-overlay"><span><?php //$project_name ?></span></div>
                                    <div class="project-overlay">
                                        <h4><a href='#'>Location 1</a></h5>
                                        <h4><a href='#'>Location 2</a></h5>
                                    </div>
                                </div>
                        <?php

                            //}

                        ?>
                    -->
                </div>
                    
                </div>
            </div>
        </div>    
        
        
        
        
    <?php
        //include_once("./templates/footer.php");
    ?>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="./public_html/js/main.js"></script>
    <script>
        
        $('#all').on('click','.sort-value',function(){
            var filterType = 'all';
            var filterValue = $(this).text();
            filter(filterType, filterValue);
            console.log(filterType + ', ' + filterValue);
        });
        
        $('.alphabet').on('click',function(){
            var filterType = 'alphabet';
            var filterValue = $(this).text();
            filter(filterType, filterValue);
        });
        
        $('.country').on('click',function(){
            var filterType = 'country';
            var filterValue = $(this).text();
            filter(filterType, filterValue);
        });
        
        $('.year').on('click',function(){
            var filterType = 'year';
            var filterValue = $(this).text();
            filter(filterType, filterValue);
        });
        
        $('.type').on('click',function(){
            var filterType = 'type';
            var filterValue = $(this).text();
            filter(filterType, filterValue);
        });
        
        function filter(filterType, filterValue) {
            $('#results').hide();
            $("#loaderID").show();
            
            //Validate fields if required using jQuery
            var filter_data = 'filterType=' + filterType + '&filterValue=' + filterValue + '&page=1';
            console.log('type:' + filterType + ', value: ' + filterValue);
            event.preventDefault();
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_filter.php', //Your form processing file URL
                data      : filter_data, //Forms name
                cache     : false,
                success   : function(html) {
                                $('#loaderID').hide();
                                $('#results').html(html);
                                $('#results').show();
                            }
            });
        };
        
        $(document).ready(function() {
            var data = ''; //get page number from link
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_pagination.php', //Your form processing file URL
                data      : data, //Forms name
                cache     : false,
                success   : function(html) {
                                $('#loaderID').hide();
                                $('#results').html(html);
                                $('#results').show();
                            }
            });

            //executes code below when user click on pagination links
            $("#results").on( "click", ".pagination a", function (e){
                e.preventDefault();
                $('#results').hide();
                $("#loaderID").show(); //show loading element
                var data = 'page=' + $(this).attr("data-page"); //get page number from link
                $.ajax({ //Process the form using $.ajax()
                    type      : 'POST', //Method type
                    url       : './process_pagination.php', //Your form processing file URL
                    data      : data, //Forms name
                    cache     : false,
                    success   : function(html) {
                                    $('#loaderID').hide();
                                    $('#results').html(html);
                                    $('#results').show();
                                }
                });
                //$("#results").load("./process_pagination.php",{"page":page}, function(){ //get content from PHP page
                    //$("#loaderID").hide(); //once done, hide loading element
                //});

            });
        });

    </script>
    </body>
</html>
