<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
        session_start();
}
if(isset($_SESSION["loggedIn"])){
    if($_SESSION["loggedIn"] != true) {
        header("Location: login.php");
        exit();
    }
}else{
    header("Location: login.php");
        exit();
}
