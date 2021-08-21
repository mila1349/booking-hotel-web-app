<?php include('partials/navbar.php') ?>
<?php
    $id_type=$_POST['id'];
    $name_type=$_POST['name'];
    $price=$_POST['price'];
    $check_in=$_POST['check-in'];
    $check_out=$_POST['check-out'];
    $guest=$_POST['guest'];

    //1. CHECK ROOM OF THAT SPECIFIC TYPE WHETER ITS AVAILABLE
    $sql="SELECT * FROM `tbl_room` WHERE `id_type`='$id_type' AND `status`='not_occupied';";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    if($count>0){
        $row=mysqli_fetch_assoc($res);
        $id_room=$row['id'];
    }else{
        $_SESSION['occupied']="Sorry, All Room of That Type is Occupied, Book Another Room";
        header("location:".SITEURL.'rooms.php');
    }
    
    //2. IF CHECK IN > CHECK OUT CHANGE VALUE
    if($check_in>$check_out){
        $temp=$check_in;
        $check_in=$check_out;
        $check_out=$temp;
    }
    //3. CALCULATE TOTAL
    $date1 = new DateTime($check_in);
    $date2 = new DateTime($check_out);
    $diff = $date1->diff($date2);
    $night=($diff->days);   // NUM OF NIGHT
    $total=$price*$night;  //TOTAL

?>
<div class="booking-form">
    <div class="booking">
        <form action="" method="POST">
            <div class="book">
                <small>Name:</small>
                <input type="text" name="name-customer" required>
            </div>
            <div class="book">
                <small>Email:</small>
                <input type="email" name="email" required>
            </div>
            <div class="book">
                <small>Name Room:</small>
                <h2><?php echo $name_type; ?></h2>
            </div>
            <div class="book">
                <small>No Room:</small>
                <h2><?php echo $id_room; ?></h2>
            </div>
            <div class="book">
                <small>Check in: </small>
                <h2><?php echo $check_in; ?></h2>
            </div>
            <div class="book">
                <small>Check out:</small>
                <h2><?php echo $check_out; ?></h2>
            </div>
            <div class="book">
                <small>Guest:</small>
                <h2><?php echo $guest; ?></h2>
            </div>
            <div class="book">
                <small># of Nights:</small>
                <h2><?php echo $night; ?></h2>
            </div>
            <div class="book">
                <small>Price:</small>
                <h2>Rp. <?php echo $price; ?>/ Night</h2>
            </div>
            <div class="book">
                <small>Total:</small>
                <h2>Rp. <?php echo $total; ?></h2>
            </div>
            <div class="book">
                <input type="hidden" name="check-in" value="<?php echo $check_in; ?>">
                <input type="hidden" name="check-out" value="<?php echo $check_out; ?>">
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                <input type="hidden" name="id-room" value="<?php echo $id_room; ?>">
                <input type="hidden" name="name-type" value="<?php echo $name_type; ?>">
                <input type="submit" name="book" value="BOOK NOW" class="btn">
            </div>  
        </form>
    </div>
</div>
<?php
    //1. GET DATA
    if(isset($_POST['book'])){
        $customer_name=$_POST['name-customer'];
        $customer_email=$_POST['email'];
        $check_in=$_POST['check-in'];
        $check_out=$_POST['check-out'];
        $total=$_POST['total'];
        $id_room=$_POST['id-room'];
        $name_type=$_POST['name-type'];
        
        

        //2. INSERT TO DATABASE
        $sql2="INSERT INTO `tbl_booking` (`customer_name`,`customer_email`,`total`,`check_in`,`check_out`) VALUES 
            ('$customer_name','$customer_email','$total','$check_in','$check_out');";
        $res2=mysqli_query($conn,$sql2);
        if($res2){
            //3. GET BOOKING ID
            $booking_id=mysqli_insert_id($conn);
            //4. CHANGE STATUS OF ROOM AND NAME
            $sql3="UPDATE `tbl_room` SET `id_booking`='$booking_id', `status`='occupied' WHERE `id`='$id_room';";
            $res3=mysqli_query($conn,$sql3);
            if($res3){
                session_destroy();
                header("location:".SITEURL.'invoice.php?id='.$booking_id.'&no='.$id_room.'&name='.$name_type);
            }else{
                $_SESSION["booking"]="Booking Failed";
                header("location:".SITEURL.'rooms.php');
            }
        }else{
            $_SESSION["booking"]="Booking Failed";
            header("location:".SITEURL.'rooms.php');
        }
        
    }
    
    
    //4. MAKE ARRAY SESSION FOR INVOICE

?>