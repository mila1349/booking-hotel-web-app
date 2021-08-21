<?php include('partials/config.php'); ?>
<?php
    $id=$_GET['id'];
    $img_name=$_GET['img_name'];
    //1. DELETE ROWS IN TBL_TYPE
    $sql="DELETE FROM `tbl_type` WHERE `id`='$id';";
    $res=mysqli_query($conn,$sql);
    if($res){
        //2. REMOVE IMG IF AVAILABLE
        if($img_name!==''){
            $path='../images/types/'.$img_name;
            $remove=unlink($path);
            if($remove==FALSE){
                //if failed to remove
                $_SESSION["remove"]="Failed to Remove Image, Type Deleted, you can delete it yourself (img=$img_name)";
            }
        }
        //3. DELETE ALL ROWS IN TBL_ROOM THAT HAVE THE SAME ID AS TBL_TYPE 
        $sql2="DELETE FROM `tbl_room` WHERE `id_type`='$id';";
        $res2=mysqli_query($conn,$sql2);
        if($res){
            $_SESSION["delete"]="Type and Rooms Deleted Successfully";
            header("location:".SITEURL.'admin/types.php');
        }else{
            $_SESSION["delete"]="Type Deleted, but Failed to Delete Rooms";
            header("location:".SITEURL.'admin/types.php');
        }
    }else{
        //failed
        $_SESSION["delete"]="Failed to Delete Typeand Rooms";
        header("location:".SITEURL.'admin/types.php');
    }
    
    
?>
