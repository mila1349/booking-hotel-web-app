<?php
//start session
session_start();
//create constants to store non repeating values
define('SITEURL', 'http://localhost/hotel/');
$filename = 'hotel.sql';
$host = "localhost";
$user = "root";
$pass = "";
$db   = "hotel";

$conn = mysqli_connect($host, $user, $pass);       //database connection
$db_select = mysqli_select_db($conn, $db);      //selecting database

//IF DATABASE NOT EXIST THEN CREATE DATABASE
if(!$db_select){
    $sql="CREATE DATABASE hotel;";
    $res=mysqli_query($conn,$sql);
    if($res){
        $link=mysqli_connect($host, $user, $pass, $db);
        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        $lines = file($filename);
        // Loop through each line
        foreach ($lines as $line) {
        // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';') {
                // Perform the query
                mysqli_query($link, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                // Reset temp variable to empty
                $templine = '';
            }
        }
    }
}

?>