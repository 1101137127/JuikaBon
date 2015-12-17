<?php
//include ("connectDB.php");
    session_start(true);
    if($_SESSION['store_id'] == null){
        $url = "../login/login_home.php";
        header("Location:$url");       
    }
    
?>

