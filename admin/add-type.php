<?php include ('partials/navbar.php')?>

<div class="container">
    <div class="title">
        <h1>ADD TYPE</h1>
        <?php
            
        ?>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Name:</td>
                <td>
                    <input type="text" name="name" max="20" required>
                </td>
            </tr>
            <tr>
                <td>Number of Rooms:</td>
                <td>
                    <input type="number" name="num" required>
                </td>
            </tr>
            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="40" rows="5" required></textarea>
                </td>
            </tr>
            <tr>
                <td>Price / Night:</td>
                <td>
                    <input type="number" name="price" required>
                </td>
            </tr>
            <tr>
                <td>Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="btn" name="submit" value="Add Type">
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
        $num=$_POST['num'];
        $description=$_POST['description'];
        $price=$_POST['price'];

        //1. GET IMG IF SELECTED
        if(isset($_FILES['image']['name'])){
            $img_name=$_FILES['image']['name'];     //pick img_name
            //2. RENAME IMG
            if($img_name!=''){
                $ext=end(explode('.',$img_name));
                $img_name="Type".rand(000,999).'.'.$ext;
                //3. UPLOAD TO FOLDER (need source path and destinaton)
                $source_path=$_FILES['image']['tmp_name'];
                $destination='../images/types/'.$img_name;
                $upload=move_uploaded_file($source_path,$destination);
                
                if($upload==FALSE){
                    echo "failed";
                    $_SESSION['image']="Failed to Add Image, No Types Added";
                    header("location:".SITEURL.'admin/types.php');
                    die();      //if failed dont execute code below
                } 
            }
        }
        
        
        //4. INSERT DATA TO DATABASE
        $sql="INSERT INTO `tbl_type` (`name`,`description`,`price`,`num_of_room`,`img_name`) VALUES ('$name','$description','$price','$num','$img_name');";
        $res=mysqli_query($conn,$sql);
        if($res){
            //5.MAKE A ROOM IN DATABASE (LOOPING)
            //pick id type
            $id=mysqli_insert_id($conn);
            for($i=0; $i<$num; $i++){
                $sql3="INSERT INTO `tbl_room` (`id_type`,`status`) VALUES ('$id','not_occupied');";
                $res3=mysqli_query($conn,$sql3);
            }
            if($res3){
                $_SESSION['add']="Type Added Successfully";
                header("location:".SITEURL.'admin/types.php');
            }else{
                $_SESSION['add']="Failed to Add Type, no Rooms Added";
                header("location:".SITEURL.'admin/types.php');
            }
            
        }else{
            $_SESSION['add']="Failed to Add Type, no Rooms Added";
            header("location:".SITEURL.'admin/types.php');
        }
    }
?>