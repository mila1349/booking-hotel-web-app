<?php
    if(!isset($_SESSION['user'])){
        $_SESSION['auth']="You need to Login first";

        header("location:".SITEURL.'admin/login.php');
        
    }
?>