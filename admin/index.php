<?php include ('partials/navbar.php')?>

    <div class="container">
        <div class="title">
           <h1>OCCUPIED ROOM</h1>
           <?php
                if(isset($_SESSION['occupied-room'])){
                    echo $_SESSION['occupied-room'];
                    unset($_SESSION['occupied-room']);
                }
           ?>
        </br></br>
        </div>
        <table>
            <tr>
                <th>S.N</th>
                <th>NO ROOM</th>
                <th>CUSTOMER NAME</th>
                <th>CHECK IN</th>
                <th>CHECK OUT</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>

<?php
    $sql="SELECT `tbl_room`.`id`,`tbl_booking`.`customer_name`,`tbl_booking`.`check_in`,`tbl_booking`.`check_out`,`tbl_booking`.`id` 
        FROM `tbl_room`,`tbl_booking` 
        WHERE `tbl_room`.`id_booking`=`tbl_booking`.`id` AND `tbl_room`.`status`='occupied';";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    if($count>0){
        $sn=1;
        while($rows=mysqli_fetch_array($res)){
            $no_room=$rows[0];
            $customer_name=$rows[1];
            $check_in=$rows[2];
            $check_out=$rows[3];
            $id_booking=$rows[4];
            ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $no_room; ?></td>
                <td><?php echo $customer_name; ?></td>
                <td><?php echo $check_in; ?></td>
                <td><?php echo $check_out; ?></td>
                <form action="" method="POST">
                <td>
                    <select name="status">
                        <option value="occupied" <?php echo "Selected"; ?>>OCCUPIED</option>
                        <option value="not-occupied">NOT-OCCUPIED</option>
                    </select>
                </td>
                <td>
                    <input type="hidden" name="no-room" value="<?php  echo $no_room;?>">
                    <input type="hidden" name="id-booking" value="<?php  echo $id_booking;?>">
                    <input type="submit" name="submit" value="submit" class="btn">
                </td>
                </form>
            </tr> 
            <?php

        }
    }

?> 
        </table>
        

    </div>
</body>
</html>
<?php 
    if(isset($_POST['submit'])){
        $status=$_POST['status'];
        $no_room=$_POST['no-room'];
        $id_booking=$_POST['id-booking'];

        if($status=='not-occupied'){
            //1. CHANGE STATUS OF ROOM AND REMOVE BOOKING_ID
            $sql2="UPDATE `tbl_room` SET `status`='$status', `id_booking`='0' WHERE `id`='$no_room';";
            $res2=mysqli_query($conn,$sql2);
            if($res2){
                //2. DELETE BOOKING DATA
                $sql3="DELETE FROM `tbl_booking` WHERE `id`='$id_booking';";
                $res3=mysqli_query($conn,$sql3);
                if($sql3){
                    $_SESSION["occupied-room"]="Room is Ready to Accept Guest";
                    header("location:".SITEURL.'admin/index.php');
                }else{
                    $_SESSION["occupied-room"]="Failed";
                    header("location:".SITEURL.'admin/index.php');
                }
            }else{
                $_SESSION["occupied-room"]="Failed";
                header("location:".SITEURL.'admin/index.php');
            }
            

        }
        
    }
?>