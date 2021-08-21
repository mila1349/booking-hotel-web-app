<?php include('partials/navbar.php') ?>

    <!-------------HOME SECTION------------------>
    <div class="home">
        <div class="wrapper">
            <img src="images/bg.png" alt="">
            <div class="text">
                <h1>HOTEL </br>LUXURY</h1>
                <small>5 STAR LUXURY IN BANDUNG </small></br>
                <small id="desc"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis aspernatur provident, quas est vel reprehenderit sapiente maiores nisi officiis unde Lorem ipsum dolor sit amet.</small>
            </div>
        </div>
        <div class="wrapper">
            <span>
                <small>+62 2454 9873 </br>BOOKINGHOTEL.COM</small>
            </span>
            <span>
                <a href="<?php echo SITEURL; ?>rooms.php" id="btn-book"><h2>BOOK A ROOM</h2></a>
            </span>
        </div>
    </div>

    <!-------------BOOKING SECTION---------->
    <div class="booking">
        <form action="" method="POST">
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
            <input type="submit" name="booking-index" value="SEARCH FOR ROOM" class="btn" >  
        </form>
    </div>    
    
    <?php
    if(isset($_POST['booking-index'])){
        //get data turn it to session
        $_SESSION['check-in']=$_POST['check-in'];
        $_SESSION['check-out']=$_POST['check-out'];
        $_SESSION['guest']=$_POST['guest'];
        //redirect
        header("location:".SITEURL.'rooms.php');
    }
    ?>
    
    <!-------------ROOM SECTION---------->
    <div class="room">
        <h1>ROOM COLLECTION</h1>
        <small>ACCOMODATION AND COMFORT</small>
        <div class="container">
            <?php  
                $sql="SELECT * FROM `tbl_type` LIMIT 3;";
                $res=mysqli_query($conn,$sql);
                if($res){
                    $count=mysqli_num_rows($res);
                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            $id=$rows['id'];
                            $name=$rows['name'];
                            $price=$rows['price'];
                            $img_name=$rows['img_name'];
                            ?>
                            <div class="box">
                                <a href="<?php echo SITEURL; ?>detail.php?id=<?php echo $id;?>"><img src="<?php echo SITEURL;?>/images/types/<?php echo $img_name;?>" alt=""></a>
                                <h2><?php echo $name; ?></h2>
                                <small>Rp. <?php echo $price; ?> /Night</small>
                            </div>
                            <?php
                        }
                    }else{
                        echo "no room yet";
                    }
                }
            ?>
        </div>
    </div>

    <!-------------ADDITIONAL SECTION---------->
    <div class="additional">
        <h1>ADDITIONAL SERVICE</h1>
        <small>VACATION AT EASE</small>
        <div class="container">
            <div class="icon">
                <img src="images/bag.png" alt="">
                <small>Airport Pickup</small>
            </div>
            <div class="icon">
                <img src="images/eat.png" alt="">
                <small>Free Breakfast</small>
            </div>
            <div class="icon">
                <img src="images/bulding.png" alt="">
                <small>City Tour</small>
            </div>
            <div class="icon">
                <img src="images/bbq.png" alt="">
                <small>Bbq Party</small>
            </div>
        </div>
    </div>

    <!-------------ADDITIONAL SECTION---------->
    <div class="escape">
        <h1>THE GREAT ESCAPE</br>YOU'LL REMEMBER</h1>
        <small>EXPLORE - WONDER - DISAPPEAR</small>
    </div>

    <!------------BRAND SECTION---------->
    <div class="brand">
        <img src="images/brand1.png" alt="">
        <img src="images/brand2.png" alt="">
        <img src="images/brand3.png" alt="">
        <img src="images/brand4.png" alt="">
        <img src="images/lg.png" alt="">
    </div>

    <!------------FOOTER SECTION---------->
    <div class="footer">
        <div class="container">
            <div class="box">
                <h2>LUXURY</h2>
                <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem quo totam, architecto ab dolore maxime repellat dolores molestiae autem consequuntur!</small>
            </div>
            <div class="box">
                <h2>CONTACT US</h2>
                <ul>
                    <li><img src="images/location.png" alt=""><small>221. Coblong, Bandung</small></li>
                    <li><img src="images/phone.png" alt=""><small>+62 1343 4353</small></li>
                    <li><img src="images/email.png" alt=""><small>paaihotel.gmail.com</small></li>
                </ul>
            </div>
            <div class="box">
                <h2>QUICK LINKS</h2>
                <ul>
                    <li><small>Home</small></li>
                    <li><small>Terms & Condition</small></li>
                    <li><small>FAQ</small></li>
                    <li><small>Newsletter</small></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="copyright">
        <small>Copyright @ 2021 by Semangat-Team</small>
    </div>

</body>
</html>
