<?php include ('partials/navbar.php')?>
<?php include ('authentication.php')?>

<?php
    session_destroy();
    header("location:".SITEURL.'admin/login.php');
?>