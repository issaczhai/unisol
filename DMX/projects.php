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
        <link rel="stylesheet" href="./public_html/css/main.css">
        <link rel="stylesheet" href="./public_html/css/dmx_style.css">
        <style>
            /**** change the divider width as the side scroll bar existence ****/
            .navbar-dmx .divider{
                width: 75.7%;
            }
            .search_box .form-control:focus{
                border-color: #cccccc;
                -webkit-box-shadow: none;
                box-shadow: none;
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
            .alphabet{
                color: #000;
            }
            .project{
                float:none;
                display:inline-block;
                width: 200px;
                height: 200px;
                margin-right:10px;
                margin-bottom: 8px;
                padding:0;
                overflow: hidden
            }
            .project img{
                position:absolute;
                height: 200px;
                width:200px;
            }
            .project-location-overlay{
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
            .project:hover > .project-location-overlay{
                margin-top:-200px;
            }
            .project-location-overlay h4{
                
                z-index:1000
            }
            .project-location-overlay h4 a{
                color:#fff;
                
            }
            .project-location-overlay h4 a:hover{
                color:#A3A3A3;
                
            }
            .projectName-overlay{
                position:relative;
                margin-top:170px;
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
            /*.projectName-overlay span:hover{
                color: rgb(255, 0, 0);
            }*/
            .project-pagination{
                float:none;
                margin:0 auto;
            }
            .pagination li a:hover{
                background-color: rgb(192, 192, 186) !important;
            }
            .not-active {
                pointer-events: none;
                cursor: default;
                background-color:#fff !important;
            }
            footer{
                bottom: auto;
            }
            
        </style>
        
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script>
        function ScaleImage(srcwidth, srcheight, targetwidth, targetheight, fLetterBox) {

            var result = { width: 0, height: 0, fScaleToTargetWidth: true };

            if ((srcwidth <= 0) || (srcheight <= 0) || (targetwidth <= 0) || (targetheight <= 0)) {
                return result;
            }

            // scale to the target width
            var scaleX1 = targetwidth;
            var scaleY1 = (srcheight * targetwidth) / srcwidth;

            // scale to the target height
            var scaleX2 = (srcwidth * targetheight) / srcheight;
            var scaleY2 = targetheight;

            // now figure out which one we should use
            var fScaleOnWidth = (scaleX2 > targetwidth);
            if (fScaleOnWidth) {
                fScaleOnWidth = fLetterBox;
            }
            else {
               fScaleOnWidth = !fLetterBox;
            }

            if (fScaleOnWidth===true) {
                result.width = Math.floor(scaleX1);
                result.height = Math.floor(scaleY1);
                result.fScaleToTargetWidth = true;
            }
            else {
                result.width = Math.floor(scaleX2);
                result.height = Math.floor(scaleY2);
                result.fScaleToTargetWidth = false;
            }
            result.targetleft = Math.floor((targetwidth - result.width) / 2);
            result.targettop = Math.floor((targetheight - result.height) / 2);

            return result;
        }
        </script>
        <script>
        function OnProjectImageLoad(evt) {
            var img = evt.currentTarget;

            // what's the size of this image and it's parent
            var w = img.naturalWidth;
            var h = img.naturalHeight;
            var tw = $(".project-image").width();
            var th = $(".project-image").height();

            // compute the new size and offsets
            var result = ScaleImage(w, h, tw, th, true);

            // adjust the image coordinates and size
            $(img).width(result.width);
            $(img).height(result.height);
            $(img).css("left", result.targetleft);
            $(img).css("top", result.targettop);
        }
        </script>
        <meta charset="UTF-8">
        <title>Projects</title>
    </head>
    <body>
    <div class="modal fade confirmSubscribeModal" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Subscription</h4>
          </div>
          <div class="modal-body">
            <p>Congradulations! You have successfully subscribed to our newsletter!</p>
          </div>
        </div>
      </div>
    </div>
    <div class="wrapper">
    <?php
    include_once("./templates/new_header.html");
    ?>
        <div class='container-fluid content'>
            <div class="above-header-bg">
            </div>
            <div class="below-header-bg">
            </div>
            <div class='row' style='height:50px;background-color: rgb(153, 153, 153)'>
            </div>
            <div class='row pull-right' style='height:40px;margin-top:-40px;background:none;border-top: 1px #FFF solid; border-left: 1px #FFF solid;padding-left:84%'>
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
                                    </ul>
                                </li>
                                <li>
                                    <ul class="list-inline">
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
                                <?php
                                    
                                ?>
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
                    
                </div>
                    
            </div>
        </div>
        <?php
            include_once("./templates/footer.php");
        ?>
    </div>
    
    <script src="./public_html/js/main.js"></script>
    <script src="./public_html/js/dmx.js"></script>
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
            // kill the filter results session when the page is reloaded
            $("#loaderID").show();
            <?php
            if(isset($_SESSION['filterResults'])){
                unset($_SESSION['filterResults']);
            }
            
            ?>
            var data = ''; //get page number from link
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : './process_pagination.php', //processing file URL
                data      : data,
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
                    url       : './process_pagination.php', //processing file URL
                    data      : data, 
                    cache     : false,
                    success   : function(html) {
                                    $('#loaderID').hide();
                                    $('#results').html(html);
                                    $('#results').show();
                                }
                });

            });
        });

    </script>
    </body>
</html>
