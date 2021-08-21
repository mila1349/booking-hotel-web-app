<?php 
    //start session
    session_start();
    //create constants to store non repeating values
    define('SITEURL','http://localhost/hotel/');
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "hotel";

    $conn = mysqli_connect($host,$user,$pass);       //database connection
    $db_select = mysqli_select_db($conn,$db);      //selecting database
?>