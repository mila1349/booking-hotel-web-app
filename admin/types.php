<?php include ('partials/navbar.php')?>


    <div class="container">
        <div class="title">
           <h1>TYPES OF ROOM</h1>
           <?php
                if(isset($_SESSION['image'])){
                    echo $_SESSION['image'];
                    unset($_SESSION['image']);
                }
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
           ?>
           </br></br>
            <a href="add-type.php" class="btn"><small>ADD TYPES</small></a> 
        </div>
        <table>
            <tr>
                <th>S.N</th>
                <th>NAME</th>
                <th>NUM OF ROOM</th>
                <th>IMAGE</th>
                <th>PRICE / NIGHT</th>
                <th>ACTION</th>
            </tr>
            <?php
                $sql="SELECT * FROM `tbl_type`;";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                $sn=1;
                if($count>0){
                    while($rows=mysqli_fetch_assoc($res)){
                        $id=$rows['id'];
                        $name=$rows['name'];
                        $num=$rows['num_of_room'];
                        $img_name=$rows['img_name'];
                        $price=$rows['price'];
                        ?>
                           <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $num; ?></td>
                                <td>
                                    <?php
                                        if($img_name!=''){
                                            ?>
                                                <img src="<?php echo SITEURL;?>/images/types/<?php echo $img_name;?>" width="100px">
                                            <?php
                                        }else{
                                            echo "Image not Available";
                                        }
                                    ?>
                                </td>
                                <td>Rp. <?php echo $price; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-types.php?id=<?php echo $id;?>" class="btn">UPDATE</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-types.php?id=<?php echo $id;?>&img_name=<?php echo $img_name; ?>" class="btn">DELETE</a>
                                </td>
                            </tr> 
                        <?php
                        
                    }
                }else{
                    echo "No Type Available, Please Add Type";
                }
            ?>
            
        </table>
        

    </div>
</body>
</html>