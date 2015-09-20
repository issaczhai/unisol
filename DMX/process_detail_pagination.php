<?php

if (session_status()!=PHP_SESSION_ACTIVE) {
        session_start();
}
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProjectManager.php");
include_once("./Manager/PhotoManager.php");

//Get page number from Ajax
if(isset($_POST["page"])){
    $pageNumber = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
    if(!is_numeric($pageNumber)){die('Invalid page number!');} //incase of invalid page number
}else{
    $pageNumber = 1; //if there's no page number, set it to 1
}
$project_id = filter_input(INPUT_POST, 'project_id');
$projectMgr = new ProjectManager();
$photoMgr = new PhotoManager();
$photoPerPage = 9;
$results = [];


//get total number of records from database
$totalNumberImages = $photoMgr->getTotalNumberOfThumbnailPhotosOfProject($project_id);
//break records into pages
$totalPages = ceil($totalNumberImages/$photoPerPage);

//fetch position of record
$pagePosition = (($pageNumber-1) * $photoPerPage);

//Fetch part of records using SQL LIMIT clause
$results = $photoMgr->getPaginatedResults($pagePosition,$photoPerPage, $project_id);  

//Display fetched records
if(!empty($results)) {
        //$_SESSION['results'] = $filteredProjects;
        
        
?>
        <div id='thumbnails'>
<?php
        if($pageNumber == 1){
            $count = 0;    
        }else{
            $count = $pagePosition;
        }
        
        foreach ($results as $eachPhoto){
            
            $hd_photos = $photoMgr -> getHDPhotosByid($project_id);
?>
            <div class="col-xs-6 col-md-4 detail-thumbnail blur">
                <img class="thumbnail-link" data-img="<?= $hd_photos[$count] ?>" src="<?= $eachPhoto ?>">
            </div>
<?php
            $count ++;
        }
?>  
        <!-- Pagination --> 
        </div>   
<?php
        echo paginate_function($photoPerPage, $pageNumber, $totalNumberImages, $totalPages);
?>


<?php
        
    }else{
?>
        <div align="center">
            <h2 style="font-family:'Arial Black', Gadget, sans-serif;font-size:30px;color:#0099FF;">No Results with this filter</h2>
        </div>
<?php
    } 

function paginate_function($item_per_page, $currentPage, $total_records, $totalPages){
    $pagination = '';
    if($totalPages > 0  && $totalPages!=1 && $currentPage <= $totalPages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
        
        $right_links    = $currentPage + 5; 
        $previous       = $currentPage - 1; //previous link 
        $next_link           = $currentPage + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($currentPage > 1){
            $previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li class="first"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($currentPage-2); $i < $currentPage; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first"><a class="not-active" href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a class="not-active" href="#" title="Previous">&lt;</a></li>'; //previous link
            //$pagination .= '<li class="first active">'.$currentPage.'</li>';
            $pagination .= '<li><a class="not-active" href="#">'.$currentPage.'</a></li>';
        }elseif($currentPage == $totalPages){ //if it's the last active link
            $pagination .= '<li><a class="not-active" href="#">'.$currentPage.'</a></li>';
            $pagination .= '<li><a class="not-active" href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
            $pagination .= '<li class="not-active" class="last"><a href="#" title="Last">&raquo;</a></li>'; //last link
        }else{ //regular current link
            $pagination .= '<li><a class="not-active" href="#">'.$currentPage.'</a></li>';
        }
                
        for($i = $currentPage+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$totalPages){
                $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($currentPage < $totalPages){ 
                
                $next_link = ($currentPage + 1 > $totalPages)? $totalPages : ($currentPage+1);
                $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" data-page="'.$totalPages.'" title="Last">&raquo;</a></li>'; //last link
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
}