<?php include ('partials/navbar.php')?>

    <div class="container">
        <div class="title">
           <h1>ADMIN</h1>
           <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            ?>
            </br></br>
            <a href="add-admin.php" class="btn"><small>ADD ADMIN</small></a> 
            <a href="update-admin.php" class="btn"><small>UPDATE</small></a> 
        </div>
        <table>
            <tr>
                <th>S.N</th>
                <th>NAME</th>
                <th>ACTION</th>
            </tr>
            <?php
                $sql="SELECT * FROM `tbl_admin`;";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                $sn=1;
                if($count>0){
                    while($rows=mysqli_fetch_assoc($res)){
                        $id=$rows['id'];
                        $name=$rows['name'];
                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $name; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn">DELETE</a>
                                </td>
                            </tr>
                        <?php
                    }
                    
                }else{   
                    echo "Admin not Available, Please Add Admin";
                }
            ?>
            
        </table>
        

    </div>
</body>
</html>