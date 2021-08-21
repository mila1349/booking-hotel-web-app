<?php include('partials/navbar.php') ?>

<?php  
    $id=$_GET['id'];
    $sql="SELECT * FROM `tbl_type` WHERE `id`='$id';";
    $res=mysqli_query($conn,$sql);
    $rows=mysqli_fetch_assoc($res);
    $name=$rows['name'];
    $description=$rows['description'];
    $price=$rows['price'];
    $img_name=$rows['img_name'];
    
?>
    <div class="detail">
        <h1><?php echo $name; ?></h1>
        <div class="desc">
            <img src="<?php echo SITEURL;?>/images/types/<?php echo $img_name;?>" alt="">
            <div class="text">
                <small><?php echo $description; ?></small>
                </br></br></br><small>Rp. <?php echo $price; ?> /Night</small>
            </div>
        </div>
       

        <!-------------BOOKING SECTION---------->
        <div class="booking">
            <form action="booking-form.php" method="POST">
                <div class="book">
                    <small>ARRIVAL</small>
                    <input type="date" name="check-in" required value="<?php if(isset($_SESSION['check-in'])){echo $_SESSION['check-in'];} ?>">
                </div>
                <div class="book">
                    <small>DEPARTURE</small>
                    <input type="date" name="check-out" required value="<?php if(isset($_SESSION['check-out'])){echo $_SESSION['check-out'];} ?>">
                </div>
                <div class="book">
                    <small>GUESTS</small>
                    <input type="number" name="guest" required max="5" value="<?php if(isset($_SESSION['guest'])){echo $_SESSION['guest'];} ?>">
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="submit" name="submit" value="BOOK NOW" class="btn" >  
            </form>
        </div>
    </div>
</body>
</html>

