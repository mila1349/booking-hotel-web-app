<?php include('partials/navbar.php') ?>

<?php
    $booking_id=$_GET['id'];
    $no_room=$_GET['no'];
    $name_type=$_GET['name'];
    $sql="SELECT * FROM `tbl_booking` WHERE `id`='$booking_id';";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    $name=$row['customer_name'];
    $check_in=$row['check_in'];
    $check_out=$row['check_out'];
    $total=$row['total'];
?>
<div class="invoice">
    <div class="box-invoice">
        <h1>INVOICE</h1>
        <span>
            <small>Name</small>
            <small><?php echo $name; ?></small>
        </span>
        <span>
            <small>Check in</small>
            <small><?php echo $check_in; ?></small>
        </span>
        <span>
            <small>Check out</small>
            <small><?php echo $check_out; ?></small>
        </span>
        <span>
            <small>Name Room</small>
            <small><?php echo $name_type; ?></small>
        </span>
        <span>
            <small>No Room</small>
            <small><?php echo $no_room; ?></small>
        </span>
        <span>
            <small>Total</small>
            <small><?php echo $total; ?></small>
        </span>
    </div>
</div>

</body>
</html>