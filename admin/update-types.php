<?php include ('partials/navbar.php')?>
<?php
    
    echo $id=$_GET['id'];
    
    $sql="SELECT * FROM `tbl_type` WHERE `id`='$id';";
    $res=mysqli_query($conn,$sql);
    $rows=mysqli_fetch_assoc($res);
    $name=$rows['name'];
    $description=$rows['description'];
    $price=$rows['price'];
    $prev_img=$rows['img_name'];
?>

<div class="container">
    <div class="title">
        <h1>UPDATE TYPE</h1>
        <?php
            
        ?>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Name:</td>
                <td>
                    <input type="text" name="name" max="20" value="<?php echo $name; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="40" rows="5" required><?php echo $description; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Price / Night:</td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Previous Image:</td>
                <td>
                    <?php
                        if($prev_img!=''){
                            ?>
                                <img src="<?php echo SITEURL;?>/images/types/<?php echo $prev_img;?>" width="100px">
                            <?php
                        }else{
                            echo "Image not Available";
                        }
                    ?>
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
                    <input type="submit" class="btn" name="submit" value="Update Type">
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
        $description=$_POST['description'];
        $price=$_POST['price'];

        //1. GET IMG IF SELECTED
        if(isset($_FILES['image']['name'])){
            $img_name=$_FILES['image']['name'];
            if($img_name!==''){
                 //2. RENAME IMG
                $ext=end(explode('.',$img_name));
                $img_name="Type".rand(000,999).'.'.$ext;
                //3. UPLOAD TO FOLDER (need source path and destinaton)
                $source_path=$_FILES['image']['tmp_name'];
                $destination='../images/types/'.$img_name;
                $upload=move_uploaded_file($source_path,$destination);
                if($upload){
                    //4. REMOVE PREV IMG IF AVAILABLE
                    if($prev_img!==''){
                        $path='../images/types/'.$prev_img;
                        $remove=unlink($path);
                        if($remove==FALSE){
                            //if failed to remove
                            $_SESSION["remove"]="Failed to Remove Image, Product Updated, you can delete it yourself (img=$prev_img)";
                        }
                    }
                }else{
                    $_SESSION['image']="Failed to Upload Image, No Types Updated";
                    header("location:".SITEURL.'admin/types.php');
                    die();      //if failed dont execute code below
                }

            }else{
                $img_name=$prev_img;
            }
        }else{
            $img_name=$prev_img;
        }

        //5.UPDATE DATABASE
        $sql2="UPDATE `tbl_type` SET 
            `name`='$name',
            `description`='$description',
            `price`='$price',
            `img_name`='$img_name' WHERE `id`='$id';";
        $res2=mysqli_query($conn,$sql2);
        if($res2){
            $_SESSION["update"]="Type Updated Successfully";
            header("location:".SITEURL.'admin/types.php');
        }else{
            $_SESSION["update"]="Failed to Update type";
            header("location:".SITEURL.'admin/types.php');
        }
    }
?>