<?php include ('partials/navbar.php')?>

<div class="container">
    <div class="title">
        <h1>ADD ADMIN</h1>
        <?php
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
                    <input type="text" name="name" placeholder="Enter your name" max="20">
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" placeholder="Enter your password">
                </td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td>
                    <input type="password" name="confirm" placeholder="Confirm your password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="btn" name="submit" value="Add Admin">
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
<?php  
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $password=md5($_POST['password']);
        $confirm=md5($_POST['confirm']);

        if($password==$confirm){
            //insert to database
            $sql="INSERT INTO `tbl_admin` (`name`,`pass`) VALUES ('$name','$password');";
            $res=mysqli_query($conn,$sql);
            if($res){
                $_SESSION['add']="Admin Added Successfully";
                header("location:".SITEURL.'admin/admin.php');
            }else{
                $_SESSION['add']="Failed to Add Admin";
                header("location:".SITEURL.'admin/admin.php');
            }
        }else{
            $_SESSION['match']="Password must be same as confirm password";
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

?>
