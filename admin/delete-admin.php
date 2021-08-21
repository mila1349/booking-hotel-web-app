<?php include ('partials/navbar.php')?>
<?php
    echo $id=$_GET['id'];
    $sql="DELETE FROM `tbl_admin` WHERE `id`='$id';";
    $res=mysqli_query($conn,$sql);
    if($res==TRUE){
        //success
        $_SESSION["delete"]="Admin Deleted Successfully";
        header("location:".SITEURL.'admin/admin.php');
    }else{
        //failed
        $_SESSION["delete"]="Failed to Delete Admin";
        header("location:".SITEURL.'admin/admin.php');
    }
    
?>
