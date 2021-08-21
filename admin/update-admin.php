<?php include ('partials/navbar.php')?>

<?php
    $id=$_SESSION['user'];
    $sql="SELECT * FROM `tbl_admin` WHERE `id`='$id';";
    $res=mysqli_query($conn,$sql);
    $rows=mysqli_fetch_assoc($res);
    $name=$rows['name'];
    $current_password=$rows['pass'];
?>
<div class="container">
    <div class="title">
        <h1>UPDATE ACCOUNT</h1>
        <?php
           if(isset($_SESSION['update-old'])){
                echo $_SESSION['update-old'];
                unset($_SESSION['update-old']);
            }
            if(isset($_SESSION['match'])){
                echo $_SESSION['match'];
                unset($_SESSION['match']);
            }
        ?>
    </div>
    <form action="" method="POST">
        <table>
            <tr>
                <td>Name:</td>
                <td>
                    <input type="text" name="name" placeholder="Enter your name" max="20" value="<?php echo $name;?>">
                </td>
            </tr>
            <tr>
                <td>Current Password:</td>
                <td>
                    <input type="password" name="current" placeholder="Enter your password" required>
                </td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td>
                    <input type="password" name="new" placeholder="Enter your password" required>
                </td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td>
                    <input type="password" name="confirm" placeholder="Confirm your password" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="btn" name="submit" value="Update Acc">
                </td>
            </tr>
        </table>
    </form>
</div>

<?php
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $current=md5($_POST['current']);
        $new=md5($_POST['new']);
        $confirm=md5($_POST['confirm']);

        //1. CHECK IF CURRENT_PASS IS SAME
        if($current_password==$current){
            //2. CHECK IF CONFIRM PASS IS SAME
            if($new==$confirm){
                $sql2="UPDATE `tbl_admin` SET `name`='$name', `pass`='$new' WHERE `id`='$id';";
                $res2=mysqli_query($conn,$sql2);
                if($res2==TRUE){
                    $_SESSION["update"]="Admin Updated Susccessfully";
                    header("location:".SITEURL.'admin/admin.php');
                }else{
                    $_SESSION["update"]="Failed to update Admin";
                    header("location:".SITEURL.'admin/admin.php');
                }
            }else{
                $_SESSION["match"]="Password must be same as confirm password";
                header("location:".SITEURL.'admin/update-admin.php');
            }
        }else{
            $_SESSION["update-old"]="You Entered the Wrong Old Password";
            header("location:".SITEURL.'admin/update-admin.php');
        }
        

    }
?>