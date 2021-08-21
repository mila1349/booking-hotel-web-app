<?php include ('partials/config.php')?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="login">
    <div class="container">
        <div class="title">
            <h1>LOGIN</h1>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['auth'])){
                    echo $_SESSION['auth'];
                    unset($_SESSION['auth']);
                }
            ?>
        </div>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="pass"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn" name="submit" value="Login">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

</body>
</html>

<?php
    if(isset($_POST['submit'])){
        echo $name=$_POST['name'];
        echo $pass=md5($_POST['pass']);
        // echo $pass=$_POST['pass'];

        $sql="SELECT * FROM `tbl_admin` WHERE `name`='$name' AND `pass`='$pass';";
        $res=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($res);
        if($count==1){
            $rows=mysqli_fetch_assoc($res);
            $id=$rows['id'];
            $_SESSION['user']=$id;
            $_SESSION['login']="Login Successfull";
            header("location:".SITEURL.'admin/admin.php');
        }else{
            $_SESSION['login']="Sorry, you don't have an account";
            header("location:".SITEURL.'admin/login.php');
        }
    }
?>