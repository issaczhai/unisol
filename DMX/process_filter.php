<?php

if (session_status()!=PHP_SESSION_ACTIVE) {
        session_start();
}
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProjectManager.php");
$filterType = addslashes(filter_input(INPUT_POST, 'filterType'));
$filterValue = filter_input(INPUT_POST, 'filterValue');
$pageNumber = filter_input(INPUT_POST, 'page');
$projectMgr = new ProjectManager();
$filteredProjects = [];
$results = [];
$itemPerPage = 10;

if($filterType=='all'){
    $filteredProjects = $projectMgr->getAllProjects();
}else if($filterType=='alphabet'){
    $filteredProjects = $projectMgr->filterProjectAlphabet($filterValue);
}else{
    $filteredProjects = $projectMgr->filterProject($filterType, $filterValue);
}

//get total number of records from database
$totalNumberProjects = count($filteredProjects);
print_r($totalNumberProjects);
//break records into pages
$totalPages = ceil($totalNumberProjects/$itemPerPage);

//fetch position of record
$pagePosition = (($pageNumber-1) * $itemPerPage);

//Fetch part of records using SQL LIMIT clause
for($i=$pagePosition; $i<($pagePosition+$itemPerPage);$i++){
    array_push($results,$filteredProjects[$i]);
}
//$display = '';


if(!empty($results)) {
        //$_SESSION['results'] = $filteredProjects;
?>
        <div id='thumbnails' class='col-md-10'>
<?php
        foreach ($results as $eachProject){
            //$_SESSION['results'] = $filteredProjects;
            $project_name = $eachProject["project_name"];
            $project_id = $eachProject["project_id"];
?>
            <div class='col-md-2 project' style='height:200px;'>
                <a href="#"><img class="project-image" style="width:200px;height:200px" src="./public_html/img/sample1.jpg" alt="" /></a>
                <div class="projectName-overlay"><span><?=$project_name ?></span></div>
                <div class="project-overlay">
                    <h4><a href='#'>Location 1</a></h4>
                    <h4><a href='#'>Location 2</a></h4>
                </div>
            </div>
<?php
        }
?>
        </div>
<?php
        
    }else{
?>
        <div align="center">
            <h2 style="font-family:'Arial Black', Gadget, sans-serif;font-size:30px;color:#0099FF;">No Results with this filter</h2>
        </div>
<?php
    } 
?>
        <div class="col-md-6 col-md-offset-3 project-pagination">
<?php
        echo paginate_function($itemPerPage, $pageNumber, $totalNumberProjects, $totalPages);
?>
        </div>
<?php
function paginate_function($item_per_page, $currentPage, $total_records, $totalPages)
{
    $pagination = '';
    if($totalPages > 0 && $totalPages != 1 && $currentPage <= $totalPages){ //verify total pages and current page number
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
                
                $next_link = ($i > $totalPages)? $totalPages : $i;
                $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" data-page="'.$totalPages.'" title="Last">&raquo;</a></li>'; //last link
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
}   